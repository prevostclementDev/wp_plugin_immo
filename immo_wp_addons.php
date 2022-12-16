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

    require_once('plugin_function/page/IWA-admin.php');

    function register_my_admin_menu() {

        $option = unserialize(get_option('reservation'));

        $notif = '';

        if ( $option != false && count($option) != 0 ) {

            $notif = '<span class="awaiting-mod">'.count($option).'</span>';

        }

        add_menu_page(
            __( 'Reservation', 'reserve' ),
            'Réservations'.$notif,
            'manage_options',
            'reservation',
            'generate_reservation_iwa_page',
            'dashicons-lock',
            22
        );
    }

    add_action( 'admin_menu', 'register_my_admin_menu' );

    require_once('plugin_function/content_type.php');
    require_once('plugin_function/metaxbox.php');