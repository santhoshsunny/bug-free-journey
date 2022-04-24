<?= (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' : '';
$images =  get_field('gallery');
?>
<div id="whatWeDo" class="block greyDiagonal">
    <div class="wrapper">
        <?php if ($images) : ?>
            <div id="imageGallery" class="simple-slider__slider is-slider" data-dots="true" data-arrows="true">
                <?php foreach ($images as $image_id) : ?>
                    <div class="simple-slider__slider___slide">
                        <?= wptht_get_img_html($image_id, 'gallery-image'); ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<?= (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' : ''; ?>