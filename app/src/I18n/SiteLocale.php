<?php

/*
 * UserFrosting Account Sprinkle (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/sprinkle-account
 * @copyright Copyright (c) 2022 Alexander Weissman & Louis Charette
 * @license   https://github.com/userfrosting/sprinkle-account/blob/master/LICENSE.md (MIT License)
 */

namespace UserFrosting\Sprinkle\Account\I18n;

use Exception;
use UserFrosting\Config\Config;
use UserFrosting\Sprinkle\Account\Authenticate\Authenticator;
use UserFrosting\Sprinkle\Core\I18n\SiteLocale as CoreSiteLocale;

/**
 * Helper methods for the locale system.
 */
class SiteLocale extends CoreSiteLocale
{
    /**
     * @param Config        $config
     * @param Authenticator $authenticator
     */
    public function __construct(
        protected Config $config,
        protected Authenticator $authenticator,
    ) {
        parent::__construct($config);
    }

    /**
     * Returns the locale identifier (ie. en_US) to use.
     *
     * @return string Locale identifier
     */
    public function getLocaleIdentifier(): string
    {
        // If user is note logged in, get original translator
        try {
            $currentUser = $this->authenticator->user();
        } catch (Exception $e) {
            return parent::getLocaleIdentifier();
        }

        if ($currentUser === null) {
            return parent::getLocaleIdentifier();
        }

        // Get user locale identifier
        $userLocale = $currentUser->locale;

        // Make sure identifier exist. If not, fallback to default locale/translator
        if (!$this->isAvailable($userLocale)) {
            return parent::getLocaleIdentifier();
        }

        return $userLocale;
    }
}
