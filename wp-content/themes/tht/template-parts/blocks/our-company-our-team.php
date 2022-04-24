<?= (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' : '';
    $title = get_field('title');
    $description = get_field('description');
?>

<div id="our-team" class="block wrapper aligncenter">
    <?php if ($title) : ?>
        <div class="block--title" data-aos="fade-down">
            <?= $title; ?>
        </div>
    <?php endif; ?>
    <?php if ($description) : ?>
        <div class="block--content" data-aos="fade-down" data-aos-delay="250" data-aos-anchor="#our-team .block--title">
            <?php echo $description; ?>
        </div>
    <?php endif; ?>

    <?php echo get_template_part('template-parts/post', 'staff'); ?>
</div>

<?= (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' : '';?>