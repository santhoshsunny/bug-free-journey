<?= (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' : '';
$image =  get_field('image');
$cta = get_field('cta');
?>
<div id="homebanner" class="block">
    <?php if ($image) : ?>
        <div class="banner--img" <?= wptht_get_img_src($image);?>>
            <?php //echo wptht_get_img_html($image, 'homepage-banner'); ?>
        </div>
    <?php endif; ?>
    <div class="wrapper nopad">
        <div class="homebanner--content" data-aos="fade-down">
            <div class="homebanner--content__top">
                <h1 class="homebanner--title"><?= get_field('title'); ?></h1>
                <h2 class="homebanner--description"><?= get_field('description'); ?></h2>
            </div>
            <?php if ($cta) : ?>
                <?php echo wptht_get_cta_html($cta, 'btn__outline btn__outline__orange is-alt'); ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' : ''; ?>