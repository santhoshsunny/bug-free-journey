<?= (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' : '';
	$image =  get_field('image');
?>
<div id="page-banner" class="block">
	<?php if ($image): ?>
		<div class="banner--img" <?= wptht_get_img_src($image); ?>></div>
	<?php endif; ?>
	<div class="banner--meta" data-aos="fade-up" data-aos-delay="250">
		<div class="banner--meta-content">
			<?php if (function_exists('yoast_breadcrumb')) {
				yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
			} ?>
			<h1 class="title"><?= get_the_title(); ?></h1>
		</div>
	</div>
	
</div>
<?= (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' : '';?>