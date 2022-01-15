<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\I18n;

use UserFrosting\Sprinkle\Core\I18n\SiteLocale as CoreSiteLocale;

/**
 * Helper methods for the locale system.
 *
 * @author Louis Charette
 */
class SiteLocale extends CoreSiteLocale
{
    /**
     * Returns the locale intentifier (ie. en_US) to use.
     *
     * @return string Locale intentifier
     */
    public function getLocaleIndentifier(): string
    {
        /** @var \UserFrosting\Sprinkle\Account\Authenticate\Authenticator $authenticator */
        $authenticator = $this->ci->authenticator;

        /** @var \UserFrosting\Sprinkle\Account\Database\Models\Interfaces\UserInterface */
        $currentUser = $this->ci->currentUser;

        // If user is note logged in, get original translator
        try {
            if (!$authenticator->check()) {
                return parent::getLocaleIndentifier();
            }
        } catch (\Exception $e) {
            return parent::getLocaleIndentifier();
        }

        // Get user locale identifier
        $userLocale = $currentUser->locale;

        // Make sure identifier exist. If not, fallback to default locale/translator
        if (!$this->isAvailable($userLocale)) {
            return parent::getLocaleIndentifier();
        }

        return $userLocale;
    }
}
