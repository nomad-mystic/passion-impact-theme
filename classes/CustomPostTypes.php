<?php

namespace PassionImpact;

use PassionImpact\Interfaces\PassionImpactClassInterface;
use PassionImpact\Utils\ThemeVariables;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * @class CustomPostTypes
 * @implements PassionImpactClassInterface
 * @extends PassionImpactSingleton
 * @package PassionImpact
 */
class CustomPostTypes extends PassionImpactSingleton implements PassionImpactClassInterface
{
    /**
     * {@inherentDoc}
     */
    public function init(): void
    {
        add_action('init', [&$this, 'homePageSliders'], 0);
        add_action('init', [&$this, 'pressReleases'], 0);
        add_action('init', [&$this, 'pressReleaseTaxonomy'], 0);
    }

    /**
     * @author Keith Murphy | nomadmystics@gmail.com
     *
     * @return void
     */
    public function homePageSliders(): void
    {
        $labels = [
            'name' => _x('Home Sliders', 'Post Type General Name', ThemeVariables::getThemeVariables()['domain']),
            'singular_name' => _x('Home Slider', 'Post Type Singular Name', ThemeVariables::getThemeVariables()['domain']),
            'menu_name' => __('Home Sliders', ThemeVariables::getThemeVariables()['domain']),
            'name_admin_bar' => __('Home Sliders', ThemeVariables::getThemeVariables()['domain']),
            'archives' => __('Item Archives', ThemeVariables::getThemeVariables()['domain']),
            'attributes' => __('Item Attributes', ThemeVariables::getThemeVariables()['domain']),
            'parent_item_colon' => __('Parent Item:', ThemeVariables::getThemeVariables()['domain']),
            'all_items' => __('All Items', ThemeVariables::getThemeVariables()['domain']),
            'add_new_item' => __('Add New Item', ThemeVariables::getThemeVariables()['domain']),
            'add_new' => __('Add New', ThemeVariables::getThemeVariables()['domain']),
            'new_item' => __('New Item', ThemeVariables::getThemeVariables()['domain']),
            'edit_item' => __('Edit Item', ThemeVariables::getThemeVariables()['domain']),
            'update_item' => __('Update Item', ThemeVariables::getThemeVariables()['domain']),
            'view_item' => __('View Item', ThemeVariables::getThemeVariables()['domain']),
            'view_items' => __('View Items', ThemeVariables::getThemeVariables()['domain']),
            'search_items' => __('Search Item', ThemeVariables::getThemeVariables()['domain']),
            'not_found' => __('Not found', ThemeVariables::getThemeVariables()['domain']),
            'not_found_in_trash' => __('Not found in Trash', ThemeVariables::getThemeVariables()['domain']),
            'featured_image' => __('Featured Image', ThemeVariables::getThemeVariables()['domain']),
            'set_featured_image' => __('Set featured image', ThemeVariables::getThemeVariables()['domain']),
            'remove_featured_image' => __('Remove featured image', ThemeVariables::getThemeVariables()['domain']),
            'use_featured_image' => __('Use as featured image', ThemeVariables::getThemeVariables()['domain']),
            'insert_into_item' => __('Insert into item', ThemeVariables::getThemeVariables()['domain']),
            'uploaded_to_this_item' => __('Uploaded to this item', ThemeVariables::getThemeVariables()['domain']),
            'items_list' => __('Items list', ThemeVariables::getThemeVariables()['domain']),
            'items_list_navigation' => __('Items list navigation', ThemeVariables::getThemeVariables()['domain']),
            'filter_items_list' => __('Filter items list', ThemeVariables::getThemeVariables()['domain']),
        ];

        $args = [
            'label' => __('Home Slider', ThemeVariables::getThemeVariables()['domain']),
            'description' => __('Create Home Page Slides', ThemeVariables::getThemeVariables()['domain']),
            'labels' => $labels,
            'supports' => [
                'title',
                'custom-fields',
                'page-attributes',
                'editor',
                'thumbnail'
            ],
            'taxonomies' => ['home-slider'],
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => false,
            'menu_position' => 7,
            'menu_icon' => 'dashicons-welcome-widgets-menus',
            'show_in_admin_bar' => true,
            'can_export' => true,
            'has_archive' => true,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'capability_type' => 'page',
            'show_in_rest' => true,
            'acfe_admin_archive' => true,
        ];

        register_post_type('home_slider', $args);
    }

    /**
     * @author Keith Murphy | nomadmystics@gmail.com
     *
     * @return void
     */
    public function pressReleases(): void
    {
        $labels = [
            'name' => _x('Press Releases', 'Post Type General Name', ThemeVariables::getThemeVariables()['domain']),
            'singular_name' => _x('Press Release', 'Post Type Singular Name', ThemeVariables::getThemeVariables()['domain']),
            'menu_name' => __('Press Releases', ThemeVariables::getThemeVariables()['domain']),
            'name_admin_bar' => __('Press Releases', ThemeVariables::getThemeVariables()['domain']),
            'archives' => __('Release Archives', ThemeVariables::getThemeVariables()['domain']),
            'attributes' => __('Release Attributes', ThemeVariables::getThemeVariables()['domain']),
            'parent_item_colon' => __('Parent Release:', ThemeVariables::getThemeVariables()['domain']),
            'all_items' => __('All Release', ThemeVariables::getThemeVariables()['domain']),
            'add_new_item' => __('Add New Release', ThemeVariables::getThemeVariables()['domain']),
            'add_new' => __('Add New', ThemeVariables::getThemeVariables()['domain']),
            'new_item' => __('New Release', ThemeVariables::getThemeVariables()['domain']),
            'edit_item' => __('Edit Release', ThemeVariables::getThemeVariables()['domain']),
            'update_item' => __('Update Release', ThemeVariables::getThemeVariables()['domain']),
            'view_item' => __('View Release', ThemeVariables::getThemeVariables()['domain']),
            'view_items' => __('View Releases', ThemeVariables::getThemeVariables()['domain']),
            'search_items' => __('Search Release', ThemeVariables::getThemeVariables()['domain']),
            'not_found' => __('Not found', ThemeVariables::getThemeVariables()['domain']),
            'not_found_in_trash' => __('Not found in Trash', ThemeVariables::getThemeVariables()['domain']),
            'featured_image' => __('Featured Image', ThemeVariables::getThemeVariables()['domain']),
            'set_featured_image' => __('Set featured image', ThemeVariables::getThemeVariables()['domain']),
            'remove_featured_image' => __('Remove featured image', ThemeVariables::getThemeVariables()['domain']),
            'use_featured_image' => __('Use as featured image', ThemeVariables::getThemeVariables()['domain']),
            'insert_into_item' => __('Insert into item', ThemeVariables::getThemeVariables()['domain']),
            'uploaded_to_this_item' => __('Uploaded to this release', ThemeVariables::getThemeVariables()['domain']),
            'items_list' => __('Releases list', ThemeVariables::getThemeVariables()['domain']),
            'items_list_navigation' => __('Releases list navigation', ThemeVariables::getThemeVariables()['domain']),
            'filter_items_list' => __('Filter items list', ThemeVariables::getThemeVariables()['domain']),
        ];

        $args = [
            'label' => __('Press Release', ThemeVariables::getThemeVariables()['domain']),
            'description' => __('Create Press Releases', ThemeVariables::getThemeVariables()['domain']),
            'labels' => $labels,
            'supports' => [
                'title',
                'editor',
                'comments',
                'revisions',
                'trackbacks',
                'author',
                'excerpt',
                'page-attributes',
                'thumbnail',
                'custom-fields',
                'post-formats',
            ],
//            'taxonomies' => ['category', 'post_tag'],
            'taxonomies' => ['press-categories', 'post_tag'],
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 4,
            'menu_icon' => 'dashicons-admin-post',
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'can_export' => true,
            'has_archive' => true,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'capability_type' => 'page',
            'show_in_rest' => true,
        ];

        register_post_type('press-releases', $args);
    }

    // Register Custom Taxonomy
    public function pressReleaseTaxonomy(): void
    {
        $labels = [
            'name' => _x('Press Categories', 'Taxonomy General Name', ThemeVariables::getThemeVariables()['domain']),
            'singular_name' => _x('Press Category', 'Taxonomy Singular Name', ThemeVariables::getThemeVariables()['domain']),
            'menu_name' => __('Press Categories', ThemeVariables::getThemeVariables()['domain']),
            'all_items' => __('All Press Categories', ThemeVariables::getThemeVariables()['domain']),
            'parent_item' => __('Parent Press Category', ThemeVariables::getThemeVariables()['domain']),
            'parent_item_colon' => __('Parent Press Category:', ThemeVariables::getThemeVariables()['domain']),
            'new_item_name' => __('New Press Category', ThemeVariables::getThemeVariables()['domain']),
            'add_new_item' => __('Add Press Category', ThemeVariables::getThemeVariables()['domain']),
            'edit_item' => __('Edit Press Category', ThemeVariables::getThemeVariables()['domain']),
            'update_item' => __('Update Press Category', ThemeVariables::getThemeVariables()['domain']),
            'view_item' => __('View Press Category', ThemeVariables::getThemeVariables()['domain']),
            'separate_items_with_commas' => __('Separate Categories with commas', ThemeVariables::getThemeVariables()['domain']),
            'add_or_remove_items' => __('Add or remove Press Categories', ThemeVariables::getThemeVariables()['domain']),
            'choose_from_most_used' => __('Choose from the most used', ThemeVariables::getThemeVariables()['domain']),
            'popular_items' => __('Popular Press Categories', ThemeVariables::getThemeVariables()['domain']),
            'search_items' => __('Search Press Categories', ThemeVariables::getThemeVariables()['domain']),
            'not_found' => __('Not Found', ThemeVariables::getThemeVariables()['domain']),
            'no_terms' => __('No items', ThemeVariables::getThemeVariables()['domain']),
            'items_list' => __('Press Categories list', ThemeVariables::getThemeVariables()['domain']),
            'items_list_navigation' => __('Press Categories list navigation', ThemeVariables::getThemeVariables()['domain']),
        ];

        $args = [
            'labels' => $labels,
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_admin_column' => true,
            'show_in_nav_menus' => true,
            'show_tagcloud' => true,
            'show_in_rest' => true,
        ];

        register_taxonomy('press-categories', ['press-releases'], $args);
    }
}
