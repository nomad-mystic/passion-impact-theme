<?php

namespace PassionImpact;

use PassionImpact\Interfaces\PassionImpactClassInterface;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * @description Turn off Yoast notifications
 *
 * @class WpSEO
 * @implements PassionImpactClassInterface
 * @extends PassionImpactSingleton
 * @package PassionImpact
 */
class WpSEO extends PassionImpactSingleton implements PassionImpactClassInterface
{
    public function init(): void
    {
        if (function_exists('is_wpe') && is_wpe() === 1) {
            add_filter('wpseo_enable_notification_term_slug_change', '__return_false');
            add_filter('wpseo_enable_notification_term_delete', '__return_false');
            add_filter('wpseo_enable_notification_post_trash', '__return_false');
            add_filter('wpseo_enable_notification_post_trash', '__return_false');
        }
    }
}
