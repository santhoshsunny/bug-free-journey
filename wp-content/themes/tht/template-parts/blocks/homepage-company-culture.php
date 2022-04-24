<?= (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' : ''; ?>
<?php
$image =  get_field('image');
$cta = get_field('cta');
$delay = ($image) ? 150 : 0;
?>

<!-- NOTE FROM FE: Use class 'content__left' or 'content__right' below to align the content block -->
<!-- NOTE FROM FE: Use class 'background__bottom', 'background__top', or background__full below to set background color position -->

<div id="img-text" class="block content__right background__bottom">
    <div class="wrapper">
        <?php if ($image) : ?>
            <div class="img-text--img" data-aos="fade-right">
                <?= wptht_get_img_html($image, 'full'); ?>
            </div>
        <?php endif; ?>
        <div class="img-text--content" data-aos="fade-zoom-in" data-delay="<?= $delay;?>">
            <div class="img-text--content__top">
                <div class="img-text--title">
                    <?= get_field('title'); ?>
                </div>
                <div class="img-text--description">
                    <?= get_field('text'); ?>
                </div>
            </div>
            <div class="img-text--content__bottom">
                <?php if ($cta) :
                    echo wptht_get_cta_html($cta, 'cta__a');
                endif; ?>
            </div>
        </div>
    </div>
</div>
<?= (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' : ''; ?>
