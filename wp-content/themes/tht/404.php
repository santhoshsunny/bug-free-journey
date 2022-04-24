<?php
echo (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' :'';
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 */

get_header();
?>
<section class="general-page wrapper main-content">
	<main class="main-section">
		<div class="breadcrumbs">
			<?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );}?>
		</div>
		<header class="general-page__header">
			<h1><?php _e('404. Page Not Found.', 'tht'); ?></h1>
		</header>
		<p>
			<?php
				echo sprintf(
					__( 'Sorry, either you do not have access to this article, or the article no longer exists. Please use the <a href="%s">Contact Us</a> link if you need further assistance.', 'tht' ),
					esc_url(home_url('/contact-us'))
					);
			// _e('Sorry - that page is missing or does not exist.<br>Please navigate home and try again.', 'tht');
			?>
		</p>
	</main>
</section>
<?php
get_footer();

echo (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' :'';