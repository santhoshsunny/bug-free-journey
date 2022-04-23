<?= (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' : ''; ?>
<?php
$lists = get_field('list');
if ($lists) : ?>
	<div id="testimonials" class="block background__top">
		<div id="testimonial-slider" class="wrapper simple-slider__slider is-slider" data-dots="true" data-arrows="false">
			<?php foreach ($lists as $list) : ?>
				<div class="simple-slider__slider___slide">
					<div class="slide-content">
						<div class="quotes"></div>
						<div class="slide__text">
							<?php if ($list['text']) : ?>
								<?= $list['text']; ?>
							<?php endif; ?>
						</div>
						<div class="slide__meta">
							<div class="author"><?php if ($list['author']) : ?><?= $list['author']; ?><?php endif; ?></div>
							<div class="company"><?php if ($list['company']) : ?><?= wpbfm_get_cta_html($list['company']); ?><?php endif; ?></div>
						</div>
					</div>
					<div><?php if ($list['image']) : ?>
							<?= wpbfm_get_img_html($list['image'], 'homepage-testimonial'); ?><?php endif; ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
<?php endif; ?>
<?= (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' : ''; ?>