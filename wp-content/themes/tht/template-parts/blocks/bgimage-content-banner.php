<?= (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' : '';
    $image =  get_field('bg_image');
    $title = get_field('title');
    $description = get_field('description');
?>
<div id="image-content" class="block">
    <?php if ($image) : ?>
        <div class="bg-image">
            <?= wpbfm_get_img_html($image, 'company-statement'); ?>
        </div>
    <?php endif; ?>
    <div class="content wrapper">
        <?php if ($title) : ?>
            <div class="content--title">
                <?=  $title; ?>
            </div>
        <?php endif; ?>
        <?php if ($description) : ?>
            <div class="content--text">
                <?= $description; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' : '';  ?>