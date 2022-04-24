<?php
echo (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' :'';
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 */

get_header();
    the_content();
get_footer();

echo (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' :'';