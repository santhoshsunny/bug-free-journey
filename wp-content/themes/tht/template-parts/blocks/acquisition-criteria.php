<?= (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' : '';
    $lists = get_field('list');
?>
<div id="criteriaBlock" class="block background__full background__alt">
    <div class="wrapper">
        <div class="block--title" data-aos="fade-down">
            <?= get_field('title');?>
        </div>
        <div class="block--content" data-aos="fade-down" data-aos-delay="250" data-aos-anchor="#criteriaBlock .block--title">
            <?= get_field('sub_title'); ?>
        </div>
        <?php if ($lists) :?>
            <div class="criteria wrapper__narrow" data-aos="fade" data-aos-delay="500" data-aos-anchor="#criteriaBlock .block--title">
                <?php foreach ($lists as $list): ?>
                    <div class="criterion" data-aos="fade">
                        <?php if($list['product']):?>
                            <div class="criterion--title">
                                <?= $list['product']->name;?>
                            </div>
                        <?php endif;?>
                        <?php if ($list['product_desc']) : ?>
                            <div class="criterion--desc">
                                <?php echo ($list['product_desc']); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>




<?= (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' : ''; ?>

