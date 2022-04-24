<?php
/*
Template Name: Portfolio Map
*/
get_header();
?>

<main class="main-section" id="map-banner">
	<div class="banner--meta">
		<div class="banner--meta-content">
			<?php if (function_exists('yoast_breadcrumb')) {
				yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
			} ?>
			<h1 class="title"><?= the_title(); ?></h1>
		</div>
	</div>
</main>

<section class="wrapper main-content">
	<?php Bfm_Map_Public::render_map();
	?>
</section>
<footer class="footer-section">
	<?php get_template_part('template-parts/op', 'getintouch'); ?>
</footer>
<?php
get_footer();

echo (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' : '';
