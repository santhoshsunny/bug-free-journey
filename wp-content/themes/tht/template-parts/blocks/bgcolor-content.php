<?= (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' : '';
    $image =  get_field('image');
    $title = get_field('title');
    $description = get_field('description');
    $bg_color =get_field('bg-color');
?>
<div id="sustainability" class="block background__full">
    <div class="wrapper">
        <div class="content">
            <?php if ($title) : ?>
                <div class="block--title">
                    <?= $title; ?>
                </div>
            <?php endif; ?>
            <?php if ($description) : ?>
                <div class="block--content">
                    <?= $description; ?>
                </div>
            <?php endif; ?>
        </div>
        <?php if ($image) : ?>
            <?= wpbfm_get_img_html($image, 'sustainability-image','bg--img desktop-only'); ?>
        <?php endif; ?>
        <?php if ($bg_color) : ?>
 			<div style="width:300px; height:300px; background-color:<?php echo ($bg_color) ?> ">
 			</div>
 		<?php endif; ?>
    </div>
</div>
<?= (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' : '';?>