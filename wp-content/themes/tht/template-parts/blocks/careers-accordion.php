<?= (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' : '';
        $lists = get_field('list');
?>
<?php if ($lists):?>
    <div id="careersAccord" class="block background__full">
        <div class="wrapper">
            <dl class="accordion">
                <?php foreach ($lists as $k => $list): ?>
                        <?php if ($list['title']) : ?>
                            <dt class="<?= ($k == 0) ? 'is-active':''; ?>">
                                <?= ($list['title']); ?>
                            </dt>
                        <?php endif; ?>
                        <?php if ($list['description']) : ?>
                            <dd>
                                <span class="animate aFade--top"> <?= ($list['description']); ?></span>
                            </dd>
                        <?php endif; ?>
                <?php endforeach; ?>
            </dl>
        </div>
    </div>
<?php endif; ?>
<?= (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' : '';?>