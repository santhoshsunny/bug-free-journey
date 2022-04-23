<?php echo (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ] -->' : '';
    $text = get_field('text');
    $cta = get_field('cta');
?>

<div id="opportunities-intro" class="block background__full">
    <div class="wrapper__xs">
        <?php if ($text) : ?>
            <div class="block--content">
                <?= $text; ?>
            </div>
        <?php endif; ?>
        <?php if ($cta) : ?>
            <div class="block--btn">
                <?= wpbfm_get_cta_html($cta, 'btn btn__outline__blue'); ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php echo (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ] -->' : '';?>