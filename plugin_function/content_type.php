<?php

    defined('ABSPATH') or die("nothing ;)");

    function wp_type_sell() {

        $args_type = array(
            'labels'              => array(
                'name'                => _x( 'Biens à la ventes', 'Post Type General Name'),
                'singular_name'       => _x( 'Biens à la ventes', 'Post Type Singular Name'),
        
                'menu_name'           => __( 'Biens ventes'),
        
                'all_items'           => __( 'tous les biens à la ventes'),
                'view_item'           => __( 'voir les biens à la ventes'),
                'add_new_item'        => __( 'Ajouter un bien à la vente'),
                'add_new'             => __( 'Ajouter'),
                'edit_item'           => __( 'Modifier'),
                'update_item'         => __( 'Enregistrer les modifications'),
                'search_items'        => __( 'Rechercher un bien'),
                'not_found'           => __( 'Non trouvée'),
                'not_found_in_trash'  => __( 'Non trouvée dans la corbeille'),
            ),
            "hierarchical" => false,
            'description'         => 'Tous les biens à la ventes',
            'public'              => true,
            'menu_position'       => 21,
            'menu_icon'          => "dashicons-building",
            'supports' => ['title','page-attributes','excerpt','thumbnail'],
        );
    
        register_post_type( 'sell', $args_type );

    }

    function wp_type_loc() {

        $args_type = array(
            'labels'              => array(
                'name'                => _x( 'Biens à la locations', 'Post Type General Name'),
                'singular_name'       => _x( 'Biens à la locations', 'Post Type Singular Name'),
        
                'menu_name'           => __( 'Biens locations'),
        
                'all_items'           => __( 'tous les biens à la locations'),
                'view_item'           => __( 'voir les biens à la locations'),
                'add_new_item'        => __( 'Ajouter un bien à la location'),
                'add_new'             => __( 'Ajouter'),
                'edit_item'           => __( 'Modifier'),
                'update_item'         => __( 'Enregistrer les modifications'),
                'search_items'        => __( 'Rechercher un bien'),
                'not_found'           => __( 'Non trouvée'),
                'not_found_in_trash'  => __( 'Non trouvée dans la corbeille'),
            ),
            "hierarchical" => false,
            'description'         => 'Tous les biens à la locations',
            'public'              => true,
            'menu_position'       => 20,
            'menu_icon'          => "dashicons-building",
            'supports' => ['title','page-attributes','revisions','excerpt'],
        );
    
        register_post_type( 'loc', $args_type );

    }

    add_action( 'init', 'wp_type_sell');
    add_action( 'init', 'wp_type_loc');