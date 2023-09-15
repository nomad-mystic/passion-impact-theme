<?php

namespace PassionImpact;

use PassionImpact\Interfaces\PassionImpactClassInterface;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * @class AdvancedCustomFields
 * @implements PassionImpactClassInterface
 * @extends PassionImpactSingleton
 * @package PassionImpact
 */
class AdvancedCustomFields extends PassionImpactSingleton implements PassionImpactClassInterface
{
    /**
     * {@inheritdoc}
     */
    public function init(): void
    {
        $this->addOptionsPage();
        $this->addHomePageSettingPage();
        $this->addFAQsPage();

        add_filter('acf/settings/load_json', [&$this, 'acfLoadJson'], 20);
        add_filter('acf/settings/save_json', [&$this, 'acfSaveJson'], 20);
    }

    /**
     * @decription Add our main Option Page and its children
     *
     * @return void
     */
    private function addOptionsPage(): void
    {
        if (function_exists('acf_add_options_page')) {
            acf_add_options_page([
                'page_title' 	=> 'Theme Options',
                'menu_title'	=> 'Theme Options',
                'menu_slug' 	=> 'theme-options',
                'capability'	=> 'edit_posts',
                'position' => '2',
                'redirect'		=> false,
            ]);

            if (function_exists('acf_add_options_sub_page')) {
                acf_add_options_sub_page([
                    'page_title' 	=> 'Social Media Links',
                    'menu_title'	=> 'Social Media Links',
                    'parent_slug'	=> 'theme-options',
                ]);

                acf_add_options_sub_page([
                    'page_title' 	=> 'Contact Details',
                    'menu_title'	=> 'Contact Details',
                    'parent_slug'	=> 'theme-options',
                ]);

                acf_add_options_sub_page([
                    'page_title' 	=> 'Volunteer Join Banner',
                    'menu_title'	=> 'Volunteer Join Banner',
                    'parent_slug'	=> 'theme-options',
                ]);

                acf_add_options_sub_page([
                    'page_title' 	=> 'Events',
                    'menu_title'	=> 'Events',
                    'parent_slug'	=> 'theme-options',
                ]);

                acf_add_options_sub_page([
                    'page_title' 	=> 'Header',
                    'menu_title'	=> 'Header',
                    'parent_slug'	=> 'theme-options',
                ]);

                acf_add_options_sub_page([
                    'page_title' 	=> 'Footer',
                    'menu_title'	=> 'Footer',
                    'parent_slug'	=> 'theme-options',
                ]);
            }
        }
    }

    /**
     * @description Add our ACF options to the home page settings
     *
     * @return void
     */
    private function addHomePageSettingPage(): void
    {
        if (function_exists('acf_add_options_page')) {
            acf_add_options_page([
                'page_title' 	=> 'Home Page Settings',
                'menu_title'	=> 'Home Page Settings',
                'menu_slug' 	=> 'home-page-settings',
                'capability'	=> 'edit_posts',
                'position' => '3',
                'redirect'		=> false,
            ]);

            if (function_exists('acf_add_options_sub_page')) {
                acf_add_options_sub_page([
                    'page_title' 	=> 'Create Impact',
                    'menu_title'	=> 'Create Impact',
                    'parent_slug'	=> 'home-page-settings',
                ]);

                acf_add_options_sub_page([
                    'page_title' 	=> 'Get Involved',
                    'menu_title'	=> 'Get Involved',
                    'parent_slug'	=> 'home-page-settings',
                ]);

                acf_add_options_sub_page([
                    'page_title' 	=> 'Testimonials',
                    'menu_title'	=> 'Testimonials',
                    'parent_slug'	=> 'home-page-settings',
                ]);

                acf_add_options_sub_page([
                    'page_title' 	=> 'Our Team',
                    'menu_title'	=> 'Our Team',
                    'parent_slug'	=> 'home-page-settings',
                ]);

                acf_add_options_sub_page([
                    'page_title' 	=> 'Our Board',
                    'menu_title'	=> 'Our Board',
                    'parent_slug'	=> 'home-page-settings',
                ]);

                acf_add_options_sub_page([
                    'page_title' 	=> 'Committees',
                    'menu_title'	=> 'Committees',
                    'parent_slug'	=> 'home-page-settings',
                ]);
            }
        }
    }

    /**
     * @description
     * @todo Not sure if this is used
     *
     * @return void
     */
    private function addFAQsPage()
    {
        if (function_exists('acf_add_options_page')) {
            acf_add_options_page([
                'page_title' 	=> 'Donate',
                'menu_title'	=> 'Donate',
                'menu_slug' 	=> 'home-page-settings',
                'capability'	=> 'edit_posts',
                'position' => '3',
                'redirect'		=> false,
            ]);

            if (function_exists('acf_add_options_sub_page')) {
                acf_add_options_sub_page([
                    'page_title' 	=> 'Committees',
                    'menu_title'	=> 'Committees',
                    'parent_slug'	=> 'home-page-settings',
                ]);
            }
        }
    }

    /**
     * @description Update the location ACF JSON is loaded from.
     *
     * @param mixed $paths
     * @return array
     */
    public function acfLoadJson(mixed $paths): array
    {
        // remove original path (optional)
        unset($paths[0]);

        // append path
        $paths[] = get_stylesheet_directory() . '/data/acf';

        // return
        return $paths;
    }

    /**
     * @description Update the location ACF JSON is saved.
     *
     * @param string $path
     * @return string
     */
    public function acfSaveJson(string $path): string
    {
        return  get_stylesheet_directory() . '/data/acf';
    }
}
