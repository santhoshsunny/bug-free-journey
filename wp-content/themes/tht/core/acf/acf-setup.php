<?php

if (!defined('WP_DEBUG') || (defined('WP_DEBUG') && !WP_DEBUG)) {
	define('ACF_LITE', true); //acf from admin menu
}

/**
 * ACF Setup Functions
 *
 */
function wpbfm_acf_setup()
{
	if (function_exists('acf_register_block')) {
		// register all blocks
		foreach (glob(__DIR__ . '/acf-blocks/*.php') as $filename) {
			require_once $filename;
		}
	}
}
add_action('init', 'wpbfm_acf_setup');

/**
 * Register Block Categories
 *
 */
function wpbfm_block_category($categories, $post)
{
	return array_merge(
		$categories,
		array(
			array(
				'slug' => 'homepage',
				'title' => __('Homepage', 'Dra'),
			),
			array(
				'slug' => 'our_company',
				'title' => __('Our Company', 'Dra'),
			),
			array(
				'slug' => 'contactform',
				'title' => __('Contact Form', 'Dra'),
			),
			array(
				'slug' => 'careers',
				'title' => __('Careers', 'Dra'),
			),
			array(
				'slug' => 'opportunities',
				'title' => __('Opportunities', 'Dra'),
			),

			array(
				'slug' => 'cms',
				'title' => __('CMS', 'Dra'),
			),
			array(
				'slug' => 'what_we_do',
				'title' => __('What we do', 'Dra'),
			),
			array(
				'slug' => 'investment',
				'title' => __('Investments', 'Dra'),
			),
			array(
				'slug' => 'news',
				'title' => __('News', 'Dra'),
			),
			array(
				'slug' => 'general-blocks',
				'title' => __('General-Blocks', 'Dra'),
			),
		)
	);
}
add_filter('block_categories', 'wpbfm_block_category', 10, 2);

/**
 * Register Block Render callback
 *
 */
function wpbfm_acf_block_render_callback($block)
{
	// convert name ("acf/testimonial") into path friendly slug ("testimonial")
	$slug = str_replace('acf/', '', $block['name']);
	if (file_exists(get_theme_file_path("/template-parts/blocks/{$slug}.php"))) {
		include(get_theme_file_path("/template-parts/blocks/{$slug}.php"));
	}
}

/**
 * Adds acf options pages into the main wp menu.
 */
if (function_exists('acf_add_options_page')) {

	if (
		current_user_can('administrator')  // admin
	) {
		acf_add_options_page(
			array(
				'page_title' => 'Theme Settings',
				'menu_title' => 'Theme Settings',
				'menu_slug'  => 'theme-settings',
				'capability' => 'manage_options',
				'redirect'   => true,
			)
		);

	}
}
