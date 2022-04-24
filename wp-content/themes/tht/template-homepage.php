<?php
echo (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' : '';
/*
Template Name: Homepage
*/

get_header();
?>

<section class="wrapper main-content">
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
