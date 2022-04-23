<?= (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' : '';
    $title = get_field('title');
    $left_image =  get_field('left_image');
    $right_image =  get_field('right_image');
?>

<div id="investmentGraphs" class="block background__full aligncenter">
    <div class="wrapper__wide">
        <?php if ($title) : ?>
            <div class="block--title">
                <?= $title; ?>
            </div>
        <?php endif; ?>
        <div class="infographs">
            <?php if ($left_image) : ?>
                <div class="graph">
                    <?= wpbfm_get_img_html($left_image, 'portfolio-image'); ?>
                </div>
            <?php endif; ?>
            <?php if ($right_image) : ?>
                <div class="graph">
                    <?= wpbfm_get_img_html($right_image, 'portfolio-image'); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' : '';?>