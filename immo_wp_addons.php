<?php
    /**
     * Immo Wp Addons
     *
     * @package       IWA
     * @author        Prévost Clément
     *
     *
     * Plugin Name:   Immo Wp Addons
     * Description:   Add custom content to manage immo site
     * Version:       1.0.0
     * Author:        Prévost Clément
     * Author URI:    clementprevost-portfolio.com
     * Text Domain:   IVW
     */

    defined('ABSPATH') or die("nothing ;)");

    function add_js_css_admin () {

        wp_enqueue_script('IWA_js', plugin_dir_url( "immo_wp_addons" )."immo_wp_addons/js/IWA_js.js");
        wp_enqueue_style('IWA_css', plugin_dir_url( "immo_wp_addons" )."immo_wp_addons/css/IWA_css.css");

    }   

    add_action('admin_enqueue_scripts', 'add_js_css_admin');

    require_once('plugin_function/content_type.php');
    require_once('plugin_function/metaxbox.php');