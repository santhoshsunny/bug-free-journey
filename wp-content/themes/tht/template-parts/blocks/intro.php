<?= (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' : '';
    $title = get_field('title');
    $description = get_field('description');
?>

<div id="page-intro" class="block background__full">
    <div class="wrapper__narrow">
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
</div>

<?= (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' : '';?>