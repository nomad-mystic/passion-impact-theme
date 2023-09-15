<?php

namespace PassionImpact;

use PassionImpact\Interfaces\PassionImpactClassInterface;
use \WP_Post;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * @class ApplyFilters
 * @implements PassionImpactClassInterface
 * @extends PassionImpactSingleton
 * @package PassionImpact
 */
class AddFilters extends PassionImpactSingleton implements PassionImpactClassInterface
{
    /**
     * {@inheritdoc}
     */
    public function init(): void
    {
        add_filter('use_block_editor_for_post', [&$this, 'gutenbergCanEditPostType'], 10, 2);
        add_filter( 'get_search_form', [&$this, 'buildCustomSearchForm']);
        add_filter('wp_nav_menu_objects', [&$this, 'modifyMenuItems'], 10, 2);
    }

    /**
     * @description Disabling the Gutenberg editor all post types except post.
     *
     * @param bool $can_edit  Whether to use the Gutenberg editor.
     * @param \WP_Post $post_type Name of WordPress post type.
     * @return bool $can_edit
     */
    public function gutenbergCanEditPostType(bool $can_edit, WP_Post $post_type): bool
    {
        // Slug of the page you don't want Gutenberg on
        $gutenberg_disabled_pages = [
            'donate-today',
            'donate-monthly',
            'about-us',
            'positions',
            'supporters',
            'press-releases-page'
        ];

        if ($post_type->post_type === 'page' && in_array($post_type->post_name, $gutenberg_disabled_pages, true)) {
            $can_edit = false;
        }

        if ($post_type->post_type === 'home_slider') {
            $can_edit = false;
        }

        return $can_edit;
    }

    /**
     * @param string $form
     * @return string
     */
    public function buildCustomSearchForm(string $form): string
    {
        /**
         * Generate custom search form
         *
         * @param string $form Form HTML.
         * @return string Modified form HTML.
         */
            $form = '<form role="search" method="get" id="passion-search-form" class="passion-search-form" action="' . home_url( '/' ) . '" >
            <div>
                <label class="screen-reader-text" for="s" style="display: none;">' . __( 'Search for:' ) . '</label>
                <input type="text" value="' . get_search_query() . '" name="s" id="s" class="passion-search-form__input" placeholder="Search the site..."/>
                <input type="submit" id="searchsubmit" class="passion-search-form__submit" value="'. esc_attr__('Search') .'" />
            </div>
        </form>';

            return $form;
    }

    /**
     * @description Add is-not-active class if the item was set in the admin
     * @author Keith Murphy | nomadmystics@gmail.com
     *
     * @param array $items
     * @param object $args
     * @return array
     */
    public function modifyMenuItems(array $items, object $args): array
    {
        foreach($items as &$item) {
            // Add our non-active class if the item has been set in admin
            if (isset($item) && !empty($item)) {
                // vars
                $is_active = get_field('nav_item_is_active', $item);

                if (isset($is_active) && empty($is_active)) {
                    array_push($item->classes, 'is-not-active');
                }
            }

        }

        return $items;
    }
}
