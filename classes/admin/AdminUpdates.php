<?php

namespace PassionImpact\Admin;

use PassionImpact\Interfaces\PassionImpactClassInterface;
use PassionImpact\PassionImpactSingleton;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * @description Update hooks if we are on a wpEngine environment.
 * @class AdminUpdates
 * @package PassionImpact
 *
 * @link https://wordpress.stackexchange.com/questions/119204/how-to-detect-that-site-is-hosted-on-wpengine
 * @link https://github.com/easy-updates-manager/easy-updates-manager/tree/dev/includes
 * @link https://wordpress.org/plugins/disable-wordpress-updates/
 *
 */
class AdminUpdates extends PassionImpactSingleton implements PassionImpactClassInterface
{
    /**
     * @inheritDoc
     */
    public function init(): void
    {
        $this->preventPluginUpdates();
        $this->preventThemesUpdates();
        $this->preventCoreUpdates();
        $this->removeAdminNotices();

        add_action('admin_init', [&$this, 'adminInit']);
    }

    /**
     * @description Prevent users from updating the core and plugins when on wpEngine. This is controlled through git.
     * @author Keith Murphy | nomadmystics@gmail.com
     * @link https://github.com/easy-updates-manager/easy-updates-manager/blob/dev/includes/MPSUM_Disable_Updates_Plugins.php
     *
     * @return void
     */
    public function preventPluginUpdates(): void
    {
        if (function_exists('is_wpe')) {
            add_filter('site_transient_update_plugins', '__return_false');
            add_filter('auto_update_plugin', '__return_false');
        }
    }

    /**
     * @description Prevent users from updating the core and plugins when on wpEngine. This is controlled through git.
     * @author Keith Murphy | nomadmystics@gmail.com
     * @link https://github.com/easy-updates-manager/easy-updates-manager/blob/dev/includes/MPSUM_Disable_Updates_Themes.php
     *
     * @return void
     */
    public function preventThemesUpdates(): void
    {
        if (function_exists('is_wpe')) {
            add_filter('auto_update_theme', '__return_false');
        }
    }

    /**
     * @description Prevent core updates
     * @author Keith Murphy | nomadmystics@gmail.com
     * @link https://github.com/easy-updates-manager/easy-updates-manager/blob/dev/includes/MPSUM_Disable_Updates_WordPress.php
     *
     * @return void
     */
    public function preventCoreUpdates(): void
    {
        if (function_exists('is_wpe')) {
            add_filter('automatic_updater_disabled', '__return_true');
            add_filter('allow_minor_auto_core_updates', '__return_false');
            add_filter('allow_major_auto_core_updates', '__return_false');
            add_filter('allow_dev_auto_core_updates', '__return_false');
            add_filter('auto_update_core', '__return_false');
            add_filter('wp_auto_update_core', '__return_false');
            add_filter('auto_core_update_send_email', '__return_false');
            add_filter('send_core_update_notification_email', '__return_false');
            add_filter('automatic_updates_send_debug_email', '__return_false');
            add_filter('automatic_updates_is_vcs_checkout', '__return_true');
        }
    }

    /**
     * @description Remove admin actions
     * @author Keith Murphy | nomadmystics@gmail.com
     *
     * @return void
     */
    public function adminInit(): void
    {
        if (function_exists('is_wpe')) {
            remove_action('wp_maybe_auto_update', 'wp_maybe_auto_update');
            remove_action('admin_init', 'wp_maybe_auto_update');
            remove_action('admin_init', 'wp_auto_update_core');
            wp_clear_scheduled_hook('wp_maybe_auto_update');
        }
    }

    /**
     * @description Don't show the user any notifications on updates.
     * @author Keith Murphy | nomadmystics@gmail.com
     *
     * @return void
     */
    public function removeAdminNotices(): void
    {
        if (function_exists('is_wpe')) {
            add_filter('auto_update_translation', '__return_false');

            add_filter('pre_site_transient_update_core', [&$this, 'removeCoreUpdates']);
            add_filter('pre_site_transient_update_plugins', [&$this, 'removeCoreUpdates']);
            add_filter('pre_site_transient_update_themes', [&$this, 'removeCoreUpdates']);
        }
    }

    /**
     * @description Send the right object back to the transients.
     * @author Keith Murphy | nomadmystics@gmail.com
     *
     * @return object
     */
    public function removeCoreUpdates(): object
    {
        global $wp_version;

        return (object) [
            'last_checked'=> time(),
            'version_checked'=> $wp_version,
            'updates' => [],
        ];
    }
}
