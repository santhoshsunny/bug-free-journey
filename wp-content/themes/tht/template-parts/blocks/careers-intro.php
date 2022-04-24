<?php
 echo (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' : '';
 $img = get_field('image');
 $cards = get_field('cards');
?>
<div id="careersIntro" class="greyDiagonal block">
	<div class="wrapper">
		<?php if($img): ?>
			<div class="cms--img block" data-aos="fade-down">
				<?= wptht_get_img_html($img, 'career-intro-banner'); ?>
			</div>
		<?php endif;?>

		<?php if($cards) : ?>
			<div class="career--cards block nopad">
				<?php foreach ($cards as $k => $list): ?>
					<div class="content--card <?= ($k % 2 == 0)? 'even' : 'odd';?>" id="card--<?=$k;?>" data-aos="fade-down">
						<?php if ($list['image']) : ?>
							<div class="card--img" data-aos="zoom-in" data-aos-delay="500" data-aos-anchor="#card--<?=$k;?>">
								<?= wptht_get_img_html($list['image'], 'card-image'); ?>
							</div>
						<?php endif; ?>
						<div class="card--text">
							<?php if ($list['title']) : ?>
								<div class="card--title">
									<?= $list['title']; ?>
								</div>
							<?php endif; ?>
							<?php if ($list['description']) : ?>
								<div class="card--desc">
									<?= $list['description']; ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</div>



<?php
echo (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' : '';
?>