<?= (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' : '';
$image =  get_field('image');
$cta = get_field('cta');
?>
<div id="homebanner" class="block">
    <?php if ($image) : ?>
        <div class="banner--img">
            <?php echo wpbfm_get_img_html($image, 'homepage-banner'); ?>
        </div>
    <?php endif; ?>
    <div class="wrapper nopad">
        <div class="homebanner--content">
            <div class="homebanner--content__top">
                <div class="homebanner--title"><?= get_field('title'); ?></div>
                <div class="homebanner--description"><?= get_field('description'); ?></div>
            </div>
            <?php if ($cta) : ?>
                <?php echo wpbfm_get_cta_html($cta, 'btn__outline btn__outline__orange is-alt'); ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' : ''; ?>