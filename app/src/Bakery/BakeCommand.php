<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2021 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\Bakery;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use UserFrosting\Sprinkle\Core\Bakery\BakeCommand as CoreBakeCommand;

/**
 * Bake command extension.
 * Adding Account provided `create-admin` to the bake command.
 */
class BakeCommand extends CoreBakeCommand
{
    /**
     * {@inheritdoc}
     */
    protected function executeConfiguration(InputInterface $input, OutputInterface $output)
    {
        parent::executeConfiguration($input, $output);

        $command = $this->getApplication()->find('create-admin');
        $command->run($input, $output);
    }
}
