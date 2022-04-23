<?php
/**
 * Post Type generator function.
 *
 * @package    WordPress
 * @subpackage mediakix
 * @since      mediakix 1.0
 */

/**
 * Prepare post types array for post type generation.
 *
 * @param array $post_types Array with post type options.
 *                          name - entity name.
 *                          singular_name - singular post type name.
 *                          args - custom post type args (if needed).
 *                          labels - custom post type labels (if needed).
 *
 */
function theme_post_types_register( $post_types = array() ) 
{
	
	if ( ! empty( $post_types ) && is_array( $post_types ) ) {
		foreach ( $post_types as $post_type ) {
			$name          = '';
			$singular_name = '';
			$args          = array();
			$labels        = array();

			if ( ! empty( $post_type['name'] ) ) {
				$name = $post_type['name'];
			}

			if ( ! empty( $post_type['singular_name'] ) ) {
				$singular_name = $post_type['singular_name'];
			}

			if ( ! empty( $post_type['args'] ) ) {
				$args = $post_type['args'];
			}

			if ( ! empty( $post_type['labels'] ) ) {
				$labels = $post_type['labels'];
			}

			theme_post_type_register( $name, $singular_name, $args, $labels );
		}
	}
}


/**
 * Function for register post types.
 *
 * @param string $name          Post type name.
 * @param string $singular_name post type singular name.
 * @param array  $args_new      needed args.
 * @param array  $labels_new    needed labels.
 */
function theme_post_type_register( $name, $singular_name, $args_new = array(), $labels_new = array() ) 
{
	

	if ( empty( $name ) || empty( $singular_name ) ) {
		return;
	}

	$labels_default = array(
		'name'          => _x( ucfirst( $name ), 'post type general name' ),
		'singular_name' => _x( ucfirst( $name ), 'post type singular name' ),
		'all_items'     => __( 'All ' . strtolower( $name ) ),
		'add_new'       => _x( 'Add new ' . strtolower( $singular_name ), 'article' ),
		'add_new_item'  => __( 'Add new ' . strtolower( $singular_name ) ),
		'edit_item'     => __( 'Edit ' . strtolower( $singular_name ) ),
		'new_item'      => __( 'New ' . strtolower( $singular_name ) ),
		'view_item'     => __( 'View ' . strtolower( $singular_name ) ),
		'search_items'  => __( 'Search in ' . strtolower( $name ) ),
		'not_found'     => __( 'No ' . strtolower( $name ) . ' found' ),
		'not_found_in_trash' => __( 'No ' . strtolower( $name ) . ' in trash' ),
		'parent_item_colon' => '',
		'menu_name' => ucfirst( $name ),
	);

	$labels = array_merge( $labels_default, $labels_new );

	$args_default = array(
		'labels'              => $labels,
		'menu_position'       => 2,
		'supports'            => array( 'title' ),  // 'page-attributes' 'editor' 'thumbnail'
		'rewrite'             => true,
		'hierarchical'        => false,
		'public'              => true,
		'show_in_menu' => true,
		//'has_archive'         => false,
		'show_ui'             => true,
		//'show_in_rest'        => true,
		'show_in_nav_menus'   => false,
		'publicly_queryable'  => true,
		'exclude_from_search' => true,
		'query_var'           => true,
		'can_export'          => true,
		'capability_type'     => 'post',
		// 'template'      => array( array( 'core/quote', array( 'className' => 'is-style-large' ) ) ),
		// 'template_lock' => 'all',
	);

	$args = array_merge( $args_default, $args_new );
	register_post_type( str_replace( ' ', '_', trim( strtolower( $singular_name ) ) ), $args );
}


/**
 * Taxonomy generator.
 *
 * @package    WordPress
 * @subpackage bfm
 * @since      custom 1.0
 */

/**
 * Prepare taxonomy array for taxonomy generation.
 *
 * @param array $taxonomies Array with taxonomy options.
 *                          name - taxonomy name.
 *                          singular_name - singular taxonomy name.
 *                          post_types - add taxonomy for this post types.
 *                          tax_prefix - prefix for taxonomy name.
 *                          args - custom post type args (if needed).
 *                          labels - custom post type labels (if needed).
 */
function theme_taxonomies_register( $taxonomies = array() ) 
{
	if ( ! empty( $taxonomies ) && is_array( $taxonomies ) ) {

		foreach ( $taxonomies as $taxonomy ) {
			$name = '';
			$singular_name = '';
			$post_types = '';
			$tax_prefix = '';
			$args = array();
			$labels = array();

			if ( ! empty( $taxonomy['name'] ) ) {
				$name = $taxonomy['name'];
			}

			if ( ! empty( $taxonomy['singular_name'] ) ) {
				$singular_name = $taxonomy['singular_name'];
			}

			if ( ! empty( $taxonomy['post_types'] ) ) {
				$post_types = $taxonomy['post_types'];
			}

			if ( ! empty( $taxonomy['tax_prefix'] ) ) {
				$tax_prefix = $taxonomy['tax_prefix'];
			}

			if ( ! empty( $taxonomy['args'] ) ) {
				$args = $taxonomy['args'];
			}

			if ( ! empty( $taxonomy['labels'] ) ) {
				$labels = $taxonomy['labels'];
			}

			if ( ! empty( $taxonomy['tax_name'] ) ) {
				$tax_name = $taxonomy['tax_name'];
			}

			theme_taxonomy_register( $name, $singular_name, $tax_name, $post_types, $tax_prefix, $args, $labels );
		}
	}
}

/**
 * Function for register taxonomies.
 *
 * @param  string $name          Taxonomy name.
 * @param  string $singular_name Taxonomy singular name.
 * @param  array  $post_types    Assigned post types.
 * @param  string $tax_prefix    Taxonomy name prefix.
 * @param  array  $args_new      needed args.
 * @param  array  $labels_new    needed labels.
 */
function theme_taxonomy_register( $name, $singular_name, $tax_name, $post_types, $tax_prefix = '', $args_new = array(), $labels_new = array() ) 
{
	if ( empty( $name ) || empty( $singular_name ) || empty( $post_types ) ) {
		return;
	}

	$labels_default = array(
		'name' => ucfirst( $name ),
		'singular_name' => ucfirst( $name ),
		'search_items' => 'Search ' . strtolower( $singular_name ),
		'all_items' => 'All ' . strtolower( $name ),
		'parent_item' => 'Parent ' . strtolower( $singular_name ),
		'parent_item_colon' => 'Parent ' . strtolower( $singular_name ) . ':',
		'edit_item' => 'Edit ' . strtolower( $singular_name ),
		'update_item' => 'Update ' . strtolower( $singular_name ),
		'add_new_item' => 'Add New ' . strtolower( $singular_name ),
		'new_item_name' => 'New ' . strtolower( $singular_name ),
		'menu_name' => ucfirst( $name ),
	);

	$labels = array_merge( $labels_default, $labels_new );

	$args_default = array(
		'label' => '',
		'labels' => $labels,
		'public' => true,
		'show_in_nav_menus' => true,
		
		'show_ui' => true,
		'show_tagcloud' => true,
		'show_admin_column' => true,
		'show_in_quick_edit' => true,
		'hierarchical' => true,
		'update_count_callback' => '',
		'rewrite' => true,
		'_builtin' => false,
	);

	$args = array_merge( $args_default, $args_new );

	// $filtered_name = str_replace( ' ', '_', trim( strtolower( $singular_name ) ) );
	// if ( ! empty( $post_types[0] ) ) {
	// 	$tax_prefix = $post_types[0];
	// }
	// register_taxonomy( $tax_prefix . '-' . $filtered_name, $post_types, $args );

	register_taxonomy( $tax_name, $post_types, $args );
}
