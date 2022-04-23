<?php
echo (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' : '';
$image =  get_field('image');
$image_description = get_field('description');
?>
<?php if ($image) : ?>
	<?php echo wpbfm_get_img_html($image, 'career-image-banner'); ?>
<?php endif; ?>

	<?php if ($image_description) : ?>
	<?php echo $image_description; ?>
	<?php endif; ?>
	<?php
	echo (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' : '';
	?>