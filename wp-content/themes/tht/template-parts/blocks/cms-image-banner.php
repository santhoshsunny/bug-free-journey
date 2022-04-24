<?php
echo (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' : '';
$image =  get_field('image');
$image_description = get_field('description');
?>
    <section class="image-banner">
        <?php if ($image) : ?>
            <?php echo wptht_get_img_html($image, 'career-image-banner'); ?>
                <?php endif; ?>
                    <?php if ($image_description) : ?>
                        <div class="description">
                            <?php echo $image_description; ?>
                        </div>
                        <?php endif; ?>
    </section>
    <?php
	echo (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' : '';
	?>