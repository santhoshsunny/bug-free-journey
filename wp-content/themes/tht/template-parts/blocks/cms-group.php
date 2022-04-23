 <?php
	echo (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' : '';
	$lists = get_field('list');
	?>
 <?php if ($lists) :
		foreach ($lists as $list) { ?>
 		<?php if ($list['title']) : ?>
 			<?php echo ($list['title']); ?>
 		<?php endif; ?>
 		<?php if ($list['description']) : ?>
 			<?php echo ($list['description']); ?>
 		<?php endif; ?>
 		<?php if ($list['bg_color']) : ?>
 			<div style="width:300px; height:300px; background-color:<?php echo ($list['bg_color']) ?> ">
 			</div>
 		<?php endif; ?>
 	<?php } ?>
 <?php endif; ?>
 <?php
	echo (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' : '';
	?>