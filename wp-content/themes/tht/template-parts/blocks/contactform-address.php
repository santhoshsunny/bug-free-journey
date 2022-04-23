<?= (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' : ''; ?>

<?php if (have_rows('list')) : ?>
	<div id="contactBlock" class="block background__full">
		<div class="wrapper__narrow">
			<?php while (have_rows('list')) : the_row(); ?>
				<div class="contact-office">
					<?php if(get_sub_field('title')): ?>
						<div class="contact-office__title"><?= (get_sub_field('title')); ?></div>
					<?php endif;?>
					<?php if (have_rows('items')) : while (have_rows('items')) : the_row(); ?>
						<?php if (get_sub_field('text')) : ?>
							<div class="contact-office__info">
								<?= get_sub_field('text'); ?>
							</div>
						<?php endif; ?>
					<?php endwhile;
					endif; ?>
				</div>
			<?php endwhile; ?>
		</div>
	</div>
<?php endif;?>

<?= (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' : ''; ?>
