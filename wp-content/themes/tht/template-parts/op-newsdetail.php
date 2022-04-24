<?= (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' : '';
	$image =  get_field('image','option');
?>
<div id="page-banner" class="block">
	<?php if ($image): ?>
		<div class="banner--img">
			<?= wptht_get_img_html($image, 'bg-image-banner'); ?>
		</div>
	<?php endif; ?>
	<div class="banner--meta">
		<div class="banner--meta-content">
			<?php if (function_exists('yoast_breadcrumb')) {
				yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
			} ?>
			<h1 class="title"><?= get_the_title(); ?></h1>
		</div>
	</div>
</div>
<?= (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' : '';?>