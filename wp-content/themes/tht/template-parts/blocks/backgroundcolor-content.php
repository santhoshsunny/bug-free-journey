<?= (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' : '';
    $image =  get_field('image');
    $title = get_field('title');
    $description = get_field('description');
    $bg_color = get_field_object('bg-color');

?>
<div id="colorContent-Block" class="block background__full <?= ($bg_color['choices'][$bg_color['value']]); ?> " style="background-color:<?= ($bg_color['value']); ?> ">
    <div class="wrapper">
        <div class="content">
            <?php if ($title) : ?>
                <div class="block--title" data-aos="fade-right">
                    <?= $title; ?>
                </div>
            <?php endif; ?>
            <?php if ($description) : ?>
                <div class="block--content" data-aos="fade-right" data-aos-delay="250">
                    <?= $description; ?>
                </div>
            <?php endif; ?>
        </div>
        <?php if ($image) : ?>
            <div data-aos="fade-zoom-in" data-aos-duration="2500" data-aos-anchor="#colorContent-Block">
                <?= wptht_get_img_html($image, 'sustainability-image','bg--img desktop-only'); ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<?= (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' : '';?>