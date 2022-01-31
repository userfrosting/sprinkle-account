<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Validators;

use UserFrosting\Sprinkle\Account\Database\Models\Interfaces\UserInterface;
use UserFrosting\Sprinkle\Account\Database\Models\User;
use UserFrosting\Sprinkle\Account\Exceptions\EmailNotUniqueException;
use UserFrosting\Sprinkle\Account\Exceptions\MissingRequiredParamException;
use UserFrosting\Sprinkle\Account\Exceptions\UsernameNotUniqueException;
use UserFrosting\Sprinkle\Account\Facades\Password;
use UserFrosting\Sprinkle\Account\Helpers\DynamicUserModel;
use UserFrosting\Support\Exception\HttpException;

/**
 * Process server side validation for the UserInterface Model.
 *
 * This should be used checks that can only be done server side. Other check
 * should be done inside the RequestSchema.
 */
class UserValidation
{
    use DynamicUserModel;

    /**
     * @var string[] The required properties to create a new user.
     */
    protected array $requiredProperties = [
        'user_name',
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    /**
     * Validate the user has all the required value before creation.
     *
     * @ throws HttpException If data doesn't validate
     *
     * @return bool Returns true if the data is valid
     */
    public function validate(UserInterface $user): bool
    {
        // Make sure all required fields are defined
        foreach ($this->requiredProperties as $property) {
            // @phpstan-ignore-next-line False positive. That's the point of the test
            if ($user->$property === null) {
                $e = new MissingRequiredParamException();
                // $e = new HttpException("Account can't be registered as '$property' is required to create a new user.");
                // $e->addUserMessage('USERNAME.IN_USE'); // TODO + inject missing param

                throw $e;
            }
        }

        // Check if username is unique
        if (!$this->usernameIsUnique($user->user_name)) {
            $e = new UsernameNotUniqueException();
            // $e->addUserMessage('USERNAME.IN_USE', ['user_name' => $this->user['user_name']]); // TODO

            throw $e;
        }

        // Check if email is unique
        if (!$this->emailIsUnique($user->email)) {
            $e = new EmailNotUniqueException();
            // $e->addUserMessage('EMAIL.IN_USE', ['email' => $this->user['email']]); // TODO

            throw $e;
        }

        // Validate password requirements
        // !TODO

        return true;
    }

    /**
     * Check Unique Username. Make sure the username is not already in use.
     *
     * @param string|null $username
     *
     * @return bool Return true if username is unique
     */
    public function usernameIsUnique(?string $username): bool
    {
        return $this->userModel::findUnique($username, 'user_name') === null;
    }

    /**
     * Check Unique Email. Make sure the email is not already in use.
     *
     * @param string|null $email
     *
     * @return bool Return true if email is unique
     */
    public function emailIsUnique(?string $email): bool
    {
        return $this->userModel::findUnique($email, 'email') === null;
    }

    /**
     * Get the required properties to create a new user.
     *
     * @return string[]
     */
    public function getRequiredProperties(): array
    {
        return $this->requiredProperties;
    }

    /**
     * Set the required properties to create a new user.
     *
     * @param string[] $requiredProperties
     *
     * @return static
     */
    public function setRequiredProperties(array $requiredProperties): static
    {
        $this->requiredProperties = $requiredProperties;

        return $this;
    }

    /**
     * Add property to the required list.
     *
     * @return static
     */
    public function addRequiredProperty(string $property): static
    {
        $this->requiredProperties[] = $property;

        return $this;
    }
}
