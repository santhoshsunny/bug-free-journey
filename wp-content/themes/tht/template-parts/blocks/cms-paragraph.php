<?php
echo (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' : '';
$paragraph = get_field('paragraph');
?>
<section class="blockquote-text">
    <?php if ($paragraph) : ?>
       <div class="quotes"></div>
        <?php echo $paragraph; ?>
    <?php endif; ?>

</section>
<?php
echo (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' : '';
?>