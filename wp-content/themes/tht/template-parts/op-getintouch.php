<?= (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' : '';
$title = get_field('title','option');
$text = get_field('text','option');
$cta = get_field('cta','option');
?>

<section id="get-in-touch" class="block background__full">
    <div class="wrapper">
        <div class="block-title" data-aos="fade-right">
            <?php if ($title) : ?>
                <?= $title; ?>
            <?php endif; ?>
        </div>
        <div class="block-description" data-aos="fade-right" data-aos-delay="200">
            <?php if ($text) : ?>
                <?= $text; ?>
            <?php endif; ?>
        </div>
        <div data-aos="fade-right" data-aos-delay="200">
            <?php if ($cta) : ?>
                <?= wptht_get_cta_html($cta, 'btn__outline btn__outline__orange'); ?>
            <?php endif; ?>
        </div>
    </div>
</section>
<?= (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' : ''; ?>