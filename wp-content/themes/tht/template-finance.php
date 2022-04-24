<?php
echo (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' : '';
/*
Template Name: Finance
*/

get_header();
?>
<section class="main-content finance">
	<main class="main-section">
		<?php if (have_posts()) :
			while (have_posts()) : the_post();
				the_content();
			endwhile;
		endif; ?>
	</main>
</section>
<footer class="footer-section">
	<?php get_template_part('template-parts/op', 'getintouch'); ?>
</footer>
<?php
get_footer();

echo (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' : '';
