<?= (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' : '';
$gallery = get_field('gallery');
?>
<div id="homebanner" class="block">
<?php if ($gallery) : ?>
        <ul class="cg-gallery">
            <?php foreach ($gallery as $image_id) : ?>
                <li class="cg-gallery__item">
                    <?php echo wptht_get_img_html($image_id, 'our-firm-gallery'); ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="slick-custom-arrows">
            <div class="sca-prev"></div>
            <div class="sca-dots"></div>
            <div class="sca-next"></div>
        </div>
    <?php endif; ?>

</div>
<?= (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' : ''; ?>