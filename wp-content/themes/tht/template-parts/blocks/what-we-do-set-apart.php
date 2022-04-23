<?= (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' : '';
	$title = get_field('title');
	$lists = get_field('list'); 
?>

<div id="setApart" class="block block__alt">
	<div class="wrapper">
		<?php if ($title) : ?>
			<div class="block--title aligncenter"><?= $title; ?></div>
		<?php endif; ?>
		<div class="tabcordion">
			<?php if ($lists) : ?>
				<nav class="desktop-only">
					<?php foreach ($lists as $k=>$list): ?>
						<div class="tab--trigger <?php if($k == 0): echo 'is-active'; endif;?>" data-tab="tab--content__<?= $k; ?>">
							<div class="icon">
								<?php if ($list['icon']) : ?>
									<?= wpbfm_get_img_html($list['icon'], 'full'); ?>
								<?php endif; ?>
							</div>
							<?php if ($list['title']) : ?>
								<div><?= $list['title']; ?></div>
							<?php endif; ?>
						</div>
					<?php endforeach;  ?>
				</nav>
			<?php endif; ?>
			<?php if ($lists) : ?>
				<?php foreach ($lists as $k=>$list): ?>
					<div id="tab--content__<?= $k;?>" class="tab--content <?php if($k == 0): echo 'is-active'; endif;?>">
						<div class="tab-down tab--trigger" data-tab="tab--content__<?= $k; ?>">
							<div class="icon">
								<?php if ($list['icon']) : ?>
									<?= wpbfm_get_img_html($list['icon'], 'full'); ?>
								<?php endif; ?>
							</div>
							<?php if ($list['title']) : ?>
								<div><?= $list['title']; ?></div>
							<?php endif; ?>
						</div>
						<div class="tab--content__inner" <?php if ($list['bg_image']) : echo wpbfm_get_img_src($list['bg_image'], 'sets-apart-banner'); endif;?>>
							<?php if ($list['description']) : ?>
								<p><?= $list['description']; ?></p>
							<?php endif; ?>
						</div>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</div>
<?= (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' : ''; ?>