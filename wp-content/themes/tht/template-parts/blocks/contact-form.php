<?= (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' : '';
    $text = get_field('text');
    $form =  get_field('form');
?>

<div id="careerForm" class="block wrapper__xs">
    <?php if($text): ?>
        <div class="form-headline">
            <p class="form-headline__description">
                <?= $text; ?>
            </p>
        </div>
    <?php endif; ?>
    <?php if($form): ?>
        <?= $form; ?>
    <?php endif; ?>
</div>

<?= (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' : ''; ?>