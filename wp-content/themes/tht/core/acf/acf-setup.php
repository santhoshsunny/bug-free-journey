<?php

if (!defined('WP_DEBUG') || (defined('WP_DEBUG') && !WP_DEBUG)) {
	define('ACF_LITE', true); //acf from admin menu
}

/**
 * ACF Setup Functions
 *
 */
function wptht_acf_setup()
{
	if (function_exists('acf_register_block')) {
		// register all blocks
		foreach (glob(__DIR__ . '/acf-blocks/*.php') as $filename) {
			require_once $filename;
		}
	}
}
add_action('init', 'wptht_acf_setup');

/**
 * Register Block Categories
 *
 */
function wptht_block_category($categories, $post)
{
	return array_merge(
		$categories,
		array(
			array(
				'slug' => 'homepage',
				'title' => __('Homepage', 'tht'),
			),
			array(
				'slug' => 'our_company',
				'title' => __('Our Company', 'tht'),
			),
			array(
				'slug' => 'contactform',
				'title' => __('Contact Form', 'tht'),
			),
			array(
				'slug' => 'careers',
				'title' => __('Careers', 'tht'),
			),
			array(
				'slug' => 'opportunities',
				'title' => __('Opportunities', 'tht'),
			),

			array(
				'slug' => 'cms',
				'title' => __('General CMS', 'tht'),
			),
			array(
				'slug' => 'what_we_do',
				'title' => __('What we do', 'tht'),
			),
			array(
				'slug' => 'investment',
				'title' => __('Investments', 'tht'),
			),
			array(
				'slug' => 'news',
				'title' => __('News', 'tht'),
			),
			array(
				'slug' => 'common_blocks',
				'title' => __('Common Blocks-Custom', 'tht'),
			),
		)
	);
}
add_filter('block_categories', 'wptht_block_category', 10, 2);

/**
 * Register Block Render callback
 *
 */
function wptht_acf_block_render_callback($block)
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
		acf_add_options_sub_page(
			array(
				'page_title'  => 'Get-In-Touch',
				'menu_title'  => 'Pre-Footer',
				'menu_slug'   => 'pre-footer-options',
				'parent_slug' => 'theme-settings',
			)
		);

		acf_add_options_sub_page(
			array(
				'page_title'  => 'Footer-Address',
				'menu_title'  => 'Footer-Address',
				'menu_slug'   => 'footer-address',
				'parent_slug' => 'theme-settings',
			)
		);
		acf_add_options_sub_page(
			array(
				'page_title'  => 'News-Detail-Banner',
				'menu_title'  => 'News-Detail',
				'menu_slug'   => 'news-detail-options',
				'parent_slug' => 'theme-settings',
			)
		);
		acf_add_options_sub_page(
			array(
				'page_title'  => 'GMT Tags',
				'menu_title'  => 'GMT Tags',
				'menu_slug'   => 'gmt-tags',
				'parent_slug' => 'theme-settings',
			)
		);
	}
}
