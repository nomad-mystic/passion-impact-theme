<?php

namespace PassionImpact\Admin;

use PassionImpact\Interfaces\PassionImpactClassInterface;
use PassionImpact\PassionImpactSingleton;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * @class AdminPluginDeactivation
 * @implements PassionImpactClassInterface
 * @extends PassionImpactSingleton
 * @package PassionImpact
 * @todo Disallow users from updating plugins.
 */
class AdminPluginDeactivation extends PassionImpactSingleton implements PassionImpactClassInterface
{
    /**
     * @inheritDoc
     */
    public function init(): void
    {

        add_filter('plugin_action_links', [&$this, 'preventPluginDeactivation'], 10, 4);

    }

    /**
     * @description
     * @author Keith Murphy | nomadmystics@gmail.com
     *
     * @param array $actions
     * @param string $plugin_file
     * @param array $plugin_data
     * @param string $context
     * @return array
     */
    public function preventPluginDeactivation(array $actions, string $plugin_file, array $plugin_data, string $context): array
    {
        $must_use_plugins = [
            'advanced-custom-fields/acf.php',
            'advanced-custom-fields-pro/acf.php',
            'acf-extended/acf-extended.php',
            'cloudflare/cloudflare.php',
            'wordpress-seo/wp-seo.php',
            'better-wp-security/better-wp-security.php',
        ];

        if (function_exists('is_wpe')) {

            if (array_key_exists('deactivate', $actions) &&
                in_array($plugin_file, $must_use_plugins)
            ) {

                unset( $actions['deactivate'] );
            }

        }

        return $actions;
    }
}
