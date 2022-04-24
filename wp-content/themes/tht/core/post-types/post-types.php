<?php
/**
 * Post Type generation.
 *
 * @package    WordPress
 * @subpackage mediakix
 * @since      mediakix 1.0
 */

 $post_types = array(
    array(
        'name'          => 'Staff',
        'singular_name' => 'Staff',
        'args'          => array(
            'supports'      => array( 'title','editor','page-attributes', 'revisions','thumbnail' ),
            'rewrite'       => array( 'slug' => 'staff', 'with_front' => false),
            'menu_icon'     => 'dashicons-admin-post',
            'menu_position' => 20,
            'has_archive'   => false,

        ),
    ),
    array(
        'name'          => 'Products',
        'singular_name' => 'Products',
        'args'          => array(
            'supports'      => array( 'title','editor','page-attributes', 'revisions','thumbnail' ),
            'rewrite'       => array( 'slug' => 'product-slug', 'with_front' => false),
            'menu_icon'     => 'dashicons-admin-post',
            'menu_position' => 20,
            'has_archive'   => false,

        ),
    ),

);

theme_post_types_register( $post_types );


