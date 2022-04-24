<?php
echo (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' : '';
/*
Template Name: Contact Us
*/

get_header();
?>

<section class="main-content finance contact-desc">
	<main class="main-section">
		<?php if (have_posts()) :
			while (have_posts()) : the_post();
				the_content();
			endwhile;
		endif; ?>
	</main>
</section>
<?php
get_footer();

echo (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' : '';
