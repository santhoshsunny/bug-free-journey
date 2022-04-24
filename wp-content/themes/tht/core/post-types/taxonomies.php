<?php
/**
 * Taxonomy generation.
 *
 * @package    WordPress
 * @subpackage bfm
 * @since      custom 1.0
 */

$taxonomies = array(


	array(
        'name'       => __('Category', 'tht'),
		'singular_name' => __('Category', 'tht'),
		'tax_name' => 'product_cat',
        'post_types' => array( 'products' ),
        'args'          => array(
            'hierarchical'       => true,
            'show_in_rest'       => true,
            'show_ui'            => true,
            'show_admin_column'  => true,
            'show_in_nav_menus'  => true,
            'show_tagcloud'      => true,
        ),
    ),

);

theme_taxonomies_register( $taxonomies );
