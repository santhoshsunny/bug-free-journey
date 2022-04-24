<?= (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' : ''; ?>

<?php $i = 0;
	$k = 1;
if (have_rows('list')) : ?>
	<div id="contactBlock" class="block background__full">
		<div class="wrapper__narrow">
			<?php while (have_rows('list')) : the_row(); ?>
				<div class="contact-office" id="office--<?=$i;?>" data-aos="fade" data-aos-delay="<?=($i*500);?>">
					<?php if(get_sub_field('title')): ?>
						<div class="contact-office__title" data-aos="fade-left" data-aos-anchor="#office--<?=$i;?>"><?= (get_sub_field('title')); ?></div>
					<?php endif;?>
					<?php if (have_rows('items')) : while (have_rows('items')) : the_row();	?>
						<?php if (get_sub_field('text')) : ?>
							<div class="contact-office__info" data-aos="fade-left" data-aos-delay="<?=($k*250);?>" data-aos-anchor="#office--<?=$i;?>">
								<?= get_sub_field('text'); ?>
							</div>
						<?php endif; ?>
					<?php $k ++; endwhile;
					endif; ?>
				</div>
			<?php $i++;
			endwhile; ?>
		</div>
	</div>
<?php endif;?>

<?= (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' : ''; ?>
