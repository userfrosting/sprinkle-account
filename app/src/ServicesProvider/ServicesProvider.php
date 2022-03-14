<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\ServicesProvider;

use Illuminate\Database\Capsule\Manager as Capsule;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use UserFrosting\Sprinkle\Account\Authorize\AuthorizationManager;
use UserFrosting\Sprinkle\Account\Database\Models\User;
use UserFrosting\Sprinkle\Account\Repository\PasswordResetRepository;
use UserFrosting\Sprinkle\Core\Log\MixedFormatter;

/**
 * Registers services for the account sprinkle, such as currentUser, etc.
 *
 * @author Alex Weissman (https://alexanderweissman.com)
 */
class ServicesProvider
{
    /**
     * Register UserFrosting's account services.
     *
     * @param ContainerInterface $container A DI container implementing ArrayAccess and psr-container.
     */
    public function register(ContainerInterface $container)
    {
        /*
         * Authorization check logging with Monolog.
         *
         * Extend this service to push additional handlers onto the 'auth' log stack.
         *
         * @return \Monolog\Logger
         */
        $container['authLogger'] = function ($c) {
            $logger = new Logger('auth');

            $logFile = $c->get('locator')->findResource('log://userfrosting.log', true, true);

            $handler = new StreamHandler($logFile);

            $formatter = new MixedFormatter(null, null, true);

            $handler->setFormatter($formatter);
            $logger->pushHandler($handler);

            return $logger;
        };

        /*
         * Authorization service.
         *
         * Determines permissions for user actions.  Extend this service to add additional access condition callbacks.
         *
         * @return \UserFrosting\Sprinkle\Account\Authorize\AuthorizationManager
         */
        $container['authorizer'] = function ($c) {
            $config = $c->config;

            // Default access condition callbacks.  Add more in your sprinkle by using $container->extend(...)
            $callbacks = [
                /*
                 * Unconditionally grant permission - use carefully!
                 * @return bool returns true no matter what.
                 */
                'always' => function () {
                    return true;
                },

                /*
                 * Check if the specified values are identical to one another (strict comparison).
                 * @param  mixed $val1 the first value to compare.
                 * @param  mixed $val2 the second value to compare.
                 * @return bool  true if the values are strictly equal, false otherwise.
                 */
                'equals' => function ($val1, $val2) {
                    return $val1 === $val2;
                },

                /*
                 * Check if the specified values are numeric, and if so, if they are equal to each other.
                 * @param  mixed $val1 the first value to compare.
                 * @param  mixed $val2 the second value to compare.
                 * @return bool  true if the values are numeric and equal, false otherwise.
                 */
                'equals_num' => function ($val1, $val2) {
                    if (!is_numeric($val1)) {
                        return false;
                    }
                    if (!is_numeric($val2)) {
                        return false;
                    }

                    return $val1 == $val2;
                },

                /*
                 * Check if the specified user (by user_id) has a particular role.
                 *
                 * @param  int  $user_id the id of the user.
                 * @param  int  $role_id the id of the role.
                 * @return bool true if the user has the role, false otherwise.
                 */
                'has_role' => function ($user_id, $role_id) {
                    return Capsule::table('role_users')
                        ->where('user_id', $user_id)
                        ->where('role_id', $role_id)
                        ->count() > 0;
                },

                /*
                 * Check if the specified value $needle is in the values of $haystack.
                 *
                 * @param  mixed        $needle   the value to look for in $haystack
                 * @param  array[mixed] $haystack the array of values to search.
                 * @return bool         true if $needle is present in the values of $haystack, false otherwise.
                 */
                'in' => function ($needle, $haystack) {
                    return in_array($needle, $haystack);
                },

                /*
                 * Check if the specified user (by user_id) is in a particular group.
                 *
                 * @param  int  $user_id  the id of the user.
                 * @param  int  $group_id the id of the group.
                 * @return bool true if the user is in the group, false otherwise.
                 */
                'in_group' => function ($user_id, $group_id) {
                    $user = User::findInt($user_id);

                    return $user->group_id == $group_id;
                },

                /*
                 * Check if the specified user (by user_id) is the master user.
                 *
                 * @param  int  $user_id the id of the user.
                 * @return bool true if the user id is equal to the id of the master account, false otherwise.
                 */
                'is_master' => function ($user_id) use ($config) {
                    // Need to use loose comparison for now, because some DBs return `id` as a string
                    return $user_id == $config['reserved_user_ids.master'];
                },

                /*
                 * Check if all values in the array $needle are present in the values of $haystack.
                 *
                 * @param  array[mixed] $needle   the array whose values we should look for in $haystack
                 * @param  array[mixed] $haystack the array of values to search.
                 * @return bool         true if every value in $needle is present in the values of $haystack, false otherwise.
                 */
                'subset' => function ($needle, $haystack) {
                    return count($needle) == count(array_intersect($needle, $haystack));
                },

                /*
                 * Check if all keys of the array $needle are present in the values of $haystack.
                 *
                 * This function is useful for whitelisting an array of key-value parameters.
                 * @param  array[mixed] $needle   the array whose keys we should look for in $haystack
                 * @param  array[mixed] $haystack the array of values to search.
                 * @return bool         true if every key in $needle is present in the values of $haystack, false otherwise.
                 */
                'subset_keys' => function ($needle, $haystack) {
                    return count($needle) == count(array_intersect(array_keys($needle), $haystack));
                },
            ];

            $authorizer = new AuthorizationManager($c, $callbacks);

            return $authorizer;
        };

        /*
         * Returns a callback that forwards to dashboard if user is already logged in.
         *
         * @return callable
         */
        $container['redirect.onAlreadyLoggedIn'] = function ($c) {
            /*
             * This method is invoked when a user attempts to perform certain public actions when they are already logged in.
             *
             * @todo Forward to user's landing page or last visited page
             * @param  \Psr\Http\Message\ServerRequestInterface $request
             * @param  \Psr\Http\Message\ResponseInterface      $response
             * @param  array                                    $args
             * @return \Psr\Http\Message\ResponseInterface
             */
            return function (Request $request, Response $response, array $args) use ($c) {
                $redirect = $c->router->pathFor('dashboard');

                return $response->withRedirect($redirect);
            };
        };

        /*
         * Repository for password reset requests.
         *
         * @return \UserFrosting\Sprinkle\Account\Repository\PasswordResetRepository
         */
        $container['repoPasswordReset'] = function ($c) {
            $classMapper = $c->classMapper;
            $config = $c->config;

            $repo = new PasswordResetRepository($classMapper, $config['password_reset.algorithm']);

            return $repo;
        };
    }
}
