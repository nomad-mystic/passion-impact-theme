<?php

namespace PassionImpact\Utils;

use PassionImpact\Interfaces\PassionImpactClassInterface;
use PassionImpact\PassionImpactSingleton;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * @class SiteUtils
 * @implements PassionImpactClassInterface
 * @extends PassionImpactSingleton
 * @package PassionImpact
 */
class SiteUtils extends PassionImpactSingleton implements PassionImpactClassInterface
{

    /**
     * {@inheritdoc}
     */
    public function init(): void
    {
        add_action('admin_head', [&$this, 'isWPEngineSite']);
    }

    /**
     * @description Get base url for the site
     * @author Keith Murphy | nomadmystics@gmail.com
     *
     * @return string
     */
    static public function get_site_scheme_and_host(): string
    {
        $site_url_scheme = parse_url(get_permalink(), PHP_URL_SCHEME);
        $site_url_host = parse_url(get_permalink(), PHP_URL_HOST);

        return "{$site_url_scheme}://{$site_url_host}";
    }

    /**
     * @description Returns the src for the site logo
     * @author Keith Murphy | nomadmystics@gmail.com
     *
     * @return string
     */
    static public function get_site_logo_image_src(): string
    {
        if (function_exists('get_theme_mod')) {
            $custom_logo_id = get_theme_mod('custom_logo');
            $logo = wp_get_attachment_image_src($custom_logo_id , 'full');

            if (isset($logo) && !empty($logo)) {
                return $logo[0];
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    /**
     * @description This exposes a string bool if we are on a wp_engine site while in the Admin area
     * @author Keith Murphy | nomadmystics@gmail.com
     *
     * @return void
     */
    public function isWPEngineSite(): void
    {
        // Expose if we are on a wp_engine site
        $is_wpe_site = 'false';

        if (function_exists('is_wpe')) {
            $is_wpe_site = 'true';
        }

        ?>

        <div id="is-wp-engine-site" data-is-wp-engine-site="<?php echo $is_wpe_site; ?>"></div>

        <?php
    }
}
