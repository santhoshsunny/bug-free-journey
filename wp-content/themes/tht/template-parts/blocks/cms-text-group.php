<?php
echo (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' : '';
$lists = get_field('list');
?>
<section class="text-group">
    <?php if ($lists) :
        foreach ($lists as $list) { ?>
            <?php if ($list['bg_color']) : ?>
                <div style="width:100%; padding:50px 0;background-color:<?php echo ($list['bg_color']) ?> ">
                    <?php if ($list['title']) : ?>
                        <h2 style="color:<?php echo ($list['text_color']) ?> "><?php echo ($list['title']); ?></h2>
                    <?php endif; ?>
                    <?php if ($list['description']) : ?>
                        <p style="color:<?php echo ($list['text_color']) ?> "><?php echo ($list['description']); ?></p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        <?php } ?>
    <?php endif; ?>
    <section>
        <?php
        echo (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' : '';
        ?>