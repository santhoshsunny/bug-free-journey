<?= (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' : '';
$image =  get_field('image');
?>
<div id="homebanner" class="block">
    <?php if ($image) : ?>
        <div class="banner--img" <?= wptht_get_img_src($image);?>>
        </div>
    <?php endif; ?>
    <div class="wrapper nopad">
        <div class="homebanner--content aos-init aos-animate" data-aos="fade-down">
            <div class="homebanner--content__top">
                <h1 class="homebanner--title"><?= get_field('title'); ?></h1>
                <h2 class="homebanner--description"><?= get_field('description'); ?></h2>
            </div>
        </div>
    </div>
</div>
<?= (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' : ''; ?>