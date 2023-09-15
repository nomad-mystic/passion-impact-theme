<?php

namespace PassionImpact;

use PassionImpact\Interfaces\PassionImpactClassInterface;
use PassionImpact\Utils\ThemeVariables;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * @class ThemeOptions
 * @implements PassionImpactClassInterface
 * @extends PassionImpactSingleton
 * @package PassionImpact
 */
class ThemeOptions extends PassionImpactSingleton implements PassionImpactClassInterface
{
    /**
     * {@inheritDoc}
     */
    public function init(): void
    {
        add_action('after_setup_theme', [&$this, 'themeSupports']);
        add_action('after_setup_theme', [&$this, 'customBlockColors']);
        add_action('after_setup_theme', [&$this, 'customBlockFontSizes']);
        add_action('after_setup_theme', [&$this, 'registerNavs']);
        add_action('after_setup_theme', [&$this, 'registerWidgets']);
    }


    /**
     * @author Keith Murphy | nomadmystics@gmail.com
     * @description Add our theme supports here
     *
     * @return void
     */
    public function themeSupports(): void
    {
        add_theme_support('custom-logo');
        add_theme_support('post-thumbnails');
        add_theme_support('editor-styles');
        add_theme_support('align-wide');
        add_editor_style('css/editor.css');
    }

    /**
     * @description Use our theme colors in blocks
     * @author Keith Murphy | nomadmystics@gmail.com
     *
     * @return void
     */
    public function customBlockColors(): void
    {
        add_theme_support( 'editor-color-palette', [
            [
                'name' => __('Default', ThemeVariables::getThemeVariables()['domain']),
                'slug' => 'default',
                'color' => '#455A64',
            ],
            [
                'name' => __('White', ThemeVariables::getThemeVariables()['domain']),
                'slug' => 'white',
                'color' => '#ffffff',
            ],
            [
                'name' => __('Transparent', ThemeVariables::getThemeVariables()['domain']),
                'slug' => 'transparent',
                'color' => 'transparent',
            ],
            [
                'name' => __('Lightest Green', ThemeVariables::getThemeVariables()['domain']),
                'slug' => 'lightest-green',
                'color' => '#65ccaa',
            ],
            [
                'name' => __('Light Green', ThemeVariables::getThemeVariables()['domain']),
                'slug' => 'light-green',
                'color' => '#3cb48d',
            ],
            [
                'name' => __('Green', ThemeVariables::getThemeVariables()['domain']),
                'slug' => 'green',
                'color' => '#1fa67a',
            ],
            [
                'name' => __('Dark Green', ThemeVariables::getThemeVariables()['domain']),
                'slug' => 'dark-green',
                'color' => '#069163',
            ],
            [
                'name' => __('Darkest Green', ThemeVariables::getThemeVariables()['domain']),
                'slug' => 'darkest-green',
                'color' => '#00724c',
            ],
            [
                'name' => __('Lightest Yellow', ThemeVariables::getThemeVariables()['domain']),
                'slug' => 'lightest-yellow',
                'color' => '#ffcc7f',
            ],
            [
                'name' => __('Light Yellow', ThemeVariables::getThemeVariables()['domain']),
                'slug' => 'light-yellow',
                'color' => '#ffbb55',
            ],
            [
                'name' => __('Yellow', ThemeVariables::getThemeVariables()['domain']),
                'slug' => 'yellow',
                'color' => '#f9a82f',
            ],
            [
                'name' => __('Dark Yellow', ThemeVariables::getThemeVariables()['domain']),
                'slug' => 'dark-yellow',
                'color' => '#da8609',
            ],
            [
                'name' => __('Darkest Yellow', ThemeVariables::getThemeVariables()['domain']),
                'slug' => 'darkest-yellow',
                'color' => '#ab6600',
            ],
            [
                'name' => __('Lightest Red', ThemeVariables::getThemeVariables()['domain']),
                'slug' => 'lightest-red',
                'color' => '#f27995',
            ],
            [
                'name' => __('Light Red', ThemeVariables::getThemeVariables()['domain']),
                'slug' => 'light-red',
                'color' => '#ed4f74',
            ],
            [
                'name' => __('Red', ThemeVariables::getThemeVariables()['domain']),
                'slug' => 'red',
                'color' => '#e52b56',
            ],
            [
                'name' => __('Dark Red', ThemeVariables::getThemeVariables()['domain']),
                'slug' => 'dark-red',
                'color' => '#c80835',
            ],
            [
                'name' => __('Darkest Red', ThemeVariables::getThemeVariables()['domain']),
                'slug' => 'darkest-red',
                'color' => '#9d0025',
            ],
        ]);
    }


    /**
     * @description Update the font sizes for blocks
     * @author Keith Murphy | nomadmystics@gmail.com
     *
     * @return void
     */
    public function customBlockFontSizes(): void
    {
        add_theme_support( 'editor-font-sizes', [
            [
                'name' => __('Small', ThemeVariables::getThemeVariables()['domain']),
                'size' => 12,
                'slug' => 'small',
            ],
            [
                'name' => __('Normal', ThemeVariables::getThemeVariables()['domain']),
                'size' => 16,
                'slug' => 'normal',
            ],
            [
                'name' => __('Medium', ThemeVariables::getThemeVariables()['domain']),
                'size' => 24,
                'slug' => 'medium',
            ],
            [
                'name' => __('Large', ThemeVariables::getThemeVariables()['domain']),
                'size' => 36,
                'slug' => 'large',
            ],
            [
                'name' => __('Huge', ThemeVariables::getThemeVariables()['domain']),
                'size' => 48,
                'slug' => 'huge',
            ],
        ]);
    }


    /**
     * @description Register navs here
     * @author Keith Murphy | nomadmystics@gmail.com
     *
     * @return void
     */
    public function registerNavs(): void
    {
        register_nav_menus([
            'primary' => esc_html__('Primary Menu', ThemeVariables::getThemeVariables()['domain']),
            'footer-site-navigation' => esc_html__('Footer Site Navigation', ThemeVariables::getThemeVariables()['domain']),
            'footer-about-pi-navigation' => esc_html__('Footer About PI Navigation', ThemeVariables::getThemeVariables()['domain']),
        ]);
    }

    /**
     * @description Register our widgets here
     * @author Keith Murphy | nomadmystics@gmail.com
     *
     * @return void
     */
    public function registerWidgets(): void
    {
        /**
         * Register sidebars
         * @todo Maybe remove this
         */
        add_action('widgets_init', [&$this, 'innerPagesWidget']);
    }


    /**
     * @description Add our sidebar widget
     * @author Keith Murphy | nomadmystics@gmail.com
     *
     * @return void
     */
    public function innerPagesWidget(): void
    {
        $config = [
            'before_widget' => '<section class="widget %1$s %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h3>',
            'after_title' => '</h3>',
        ];

        register_sidebar([
            'name' => __('Inner Pages', ThemeVariables::getThemeVariables()['domain']),
            'id' => 'inner_pages',
        ] + $config);
    }
}
