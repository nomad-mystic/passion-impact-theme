<?php

namespace PassionImpact;

use PassionImpact\Interfaces\PassionImpactClassInterface;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * @description Add our framework specific JS/CSS files here
 * @author Keith Murphy | nomadmystics@gmail.com
 * @class PassionImpactEnqueueScriptsAndStyles
 * @implements PassionImpactClassInterface
 * @extends PassionImpactSingleton
 * @package Nomad\WordPress
 */
class EnqueueScriptsAndStyles extends PassionImpactSingleton implements PassionImpactClassInterface
{
    /**
     * {@inheritdoc}
     */
    public function init(): void
    {
        add_action('enqueue_block_editor_assets', [&$this, 'enqueueEditorScripts']);
        add_action('admin_enqueue_scripts', [&$this, 'enqueueAdminScripts']);

        add_action('wp_enqueue_scripts', [&$this, 'enqueueScripts']);
        add_action('wp_enqueue_scripts', [&$this, 'enqueueStyles']);
    }

    /**
     * @author Keith Murphy | nomadmystics@gmail.com
     *
     * @return void
     */
    public function enqueueAdminScripts(): void
    {
        wp_register_script('passion-impact-admin-js', get_template_directory_uri()  . '/js/admin.js', [], '', true);

        wp_enqueue_script('passion-impact-admin-js');
    }

    /**
     * @author Keith Murphy | nomadmystics@gmail.com
     *
     * @return void
     */
    public function enqueueEditorScripts(): void
    {
        wp_register_script('passion-impact-editor-js', get_template_directory_uri()  . '/js/editor.js', [], '', true);

        wp_enqueue_script('passion-impact-editor-js');
    }

    /**
     * @description Add our framework specific JS files here
     *
     * @return void
     */
    public function enqueueScripts(): void
    {
        // Updated
        wp_register_script('passion-impact-webpack-vue-js', get_template_directory_uri()  . '/js/vue.js', [], '', true);
        wp_register_script('passion-impact-webpack-fort-awesome-js', get_template_directory_uri()  . '/js/fortawesome.js', [], '', true);
        wp_register_script('passion-impact-main-js',
            get_template_directory_uri()  . '/js/clientJS.js',
            [
                'passion-impact-webpack-fort-awesome-js',
                'passion-impact-webpack-vue-js',
            ],
            '1.0.0', true);

        wp_enqueue_script('passion-impact-webpack-fort-awesome-js');
        wp_enqueue_script('passion-impact-webpack-vue-js');
        wp_enqueue_script('passion-impact-main-js');
    }

    /**
     * @description Add our framework specific CSS files here
     *
     * @return void
     */
    public function enqueueStyles(): void
    {
        wp_register_style('passion-impact-vendor-css', get_template_directory_uri()  . '/css/vendor.css');
        wp_register_style('passion-impact-main-css', get_template_directory_uri()  . '/css/main.css');

        wp_enqueue_style('passion-impact-vendor-css');
        wp_enqueue_style('passion-impact-main-css');
    }
}
