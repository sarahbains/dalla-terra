<?php

function dalla_terra_register_custom_post_types() {
    $labels = array(
        'name'               => _x( 'Locations', 'post type general name' ),
        'singular_name'      => _x( 'Location', 'post type singular name'),
        'menu_name'          => _x( 'Locations', 'admin menu' ),
        'name_admin_bar'     => _x( 'Locations', 'add new on admin bar' ),
        'add_new'            => _x( 'Add New', 'location' ),
        'add_new_item'       => __( 'Add New location' ),
        'new_item'           => __( 'New location' ),
        'edit_item'          => __( 'Edit location' ),
        'view_item'          => __( 'View locations' ),
        'all_items'          => __( 'All locations' ),
        'search_items'       => __( 'Search locations' ),
        'parent_item_colon'  => __( 'Parent location:' ),
        'not_found'          => __( 'No locations found.' ),
        'not_found_in_trash' => __( 'No locations found in Trash.' ),
        'archives'           => __( 'Location Archives'),
        'insert_into_item'   => __( 'Insert into location'),
        'uploaded_to_this_item' => __( 'Uploaded to this location'),
        'filter_item_list'   => __( 'Filter locations list'),
        'items_list_navigation' => __( 'Locations list navigation'),
        'items_list'         => __( 'Locations list'),
        'featured_image'     => __( 'Location featured image'),
        'set_featured_image' => __( 'Set location featured image'),
        'remove_featured_image' => __( 'Remove location featured image'),
        'use_featured_image' => __( 'Use as featured image'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'show_in_admin_bar'  => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'locations' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-location',
        'supports'           => array( 'title' ),
    );
    register_post_type( 'dt-locations', $args );
}
add_action( 'init', 'dalla_terra_register_custom_post_types' );

function dalla_terra_register_taxonomies() {

    $labels = array(
        'name'              => _x( 'Location Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Location Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Location Categories' ),
        'all_items'         => __( 'All Location Category' ),
        'parent_item'       => __( 'Parent Location Category' ),
        'parent_item_colon' => __( 'Parent Location Category:' ),
        'edit_item'         => __( 'Edit Location Category' ),
        'view_item'         => __( 'View Location Category' ),
        'update_item'       => __( 'Update Location Category' ),
        'add_new_item'      => __( 'Add New Location Category' ),
        'new_item_name'     => __( 'New Location Category Name' ),
        'menu_name'         => __( 'Location Category' ),
    );
    
    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'show_in_nav_menu'  => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'location-categories' ),
    );
    register_taxonomy( 'dt-location-category', array( 'dt-locations' ), $args );
}
add_action( 'init', 'dalla_terra_register_taxonomies');


function dalla_terra_rewrite_flush() {
    dalla_terra_register_custom_post_types();
    dalla_terra_register_taxonomies();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'dalla_terra_rewrite_flush' );