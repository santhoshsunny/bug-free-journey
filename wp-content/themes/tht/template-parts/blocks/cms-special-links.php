<?php
echo (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' : '';
$lists = get_field('list');
?>
    <section class="special-links">
        <?php if ($lists) : ?>
            <?php foreach ($lists as $list) { ?>
                <?php if ($list['cta']) : ?>
                    <?php  echo wptht_get_cta_html($list['cta'], ''); ?>
                        <?php endif; ?>
                            <?php } ?>
                                <?php endif; ?>
    </section>
    <?php
echo (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' : '';
?>