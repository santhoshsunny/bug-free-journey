<?= (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' : '';
$title = get_field('title');
$left_image =  get_field('left_image');
$right_image =  get_field('right_image');
$funds_disclaimer = get_field('funds_disclaimer');
?>
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

<div id="investmentGraphs" class="block background__full aligncenter">
    <div class="wrapper__wide">
        <?php if ($title) : ?>
            <div class="block--title">
                <?= $title; ?>
            </div>
        <?php endif; ?>
        <div class="infographs">
            <div class="graphOuter">
                <div class="graphWrap">
                    <div id="graph--left" class="graphitem"></div>
                    <div class="graph--title" data-aos="fade" data-aos-anchor="#graph--left"><?php _e('Geography'); ?></div>
                </div>
                <div id="left-legend"></div>
            </div>
            <div class="graphOuter">
                <div class="graphWrap">
                    <div id="graph--right" class="graphitem"></div>
                    <div class="graph--title" data-aos="fade" data-aos-anchor="#graph--right"><?php _e('Property Type'); ?></div>
                </div>
                <div id="right-legend"></div>
            </div>
        </div>
        <div class="infographs-desc">
            <p><?php _e('-As of'); ?> <?= date("F Y"); ?></p>
            <?php if ($funds_disclaimer) : ?>
                <p>
                    <?= $funds_disclaimer; ?>
                </p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' : ''; ?>