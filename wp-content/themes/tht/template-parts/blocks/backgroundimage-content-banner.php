<?= (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' : '';
    $image =  get_field('bg_image');
    $title = get_field('title');
    $description = get_field('description');
    $randId = rand();
?>
<div id="image-content-<?=$randId;?>" class="block image-content">
    <?php if ($image) : ?>
        <div class="bg-image" <?= wptht_get_img_src($image, 'company-statement'); ?>></div>
    <?php endif; ?>
    <div class="content wrapper">
        <?php if ($title) : ?>
            <div class="content--title" data-aos="fade-left">
                <?=  $title; ?>
            </div>
        <?php endif; ?>
        <?php if ($description) : ?>
            <div class="content--text" data-aos="fade-left" data-aos-delay="250" data-aos-anchor = "#image-content-<?=$randId;?> .content--title">
                <?= $description; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' : '';  ?>