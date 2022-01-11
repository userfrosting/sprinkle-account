<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2021 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\I18n;

use UserFrosting\Sprinkle\Core\ServicesProvider\BaseServicesProvider;

/**
 * Locale service provider, replacing the Core one.
 *
 * Registers:
 *  - locale : \UserFrosting\Sprinkle\Account\I18n\SiteLocale
 */
class LocaleServicesProvider extends BaseServicesProvider
{
    /**
     * {@inheritdoc}
     */
    public function register(): void
    {
        $this->ci['locale'] = new SiteLocale($this->ci);
    }
}
