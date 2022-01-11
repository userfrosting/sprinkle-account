<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2021 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account;

use UserFrosting\Sprinkle\Account\I18n\LocaleServicesProvider;
use UserFrosting\System\Sprinkle\Sprinkle;

/**
 * Bootstrapper class for the 'account' sprinkle.
 *
 * @author Alex Weissman (https://alexanderweissman.com)
 */
class AccountOld extends Sprinkle
{
    /**
     * @var string[] List of services provider to register
     */
    protected $servicesproviders = [
        LocaleServicesProvider::class,
    ];
}
