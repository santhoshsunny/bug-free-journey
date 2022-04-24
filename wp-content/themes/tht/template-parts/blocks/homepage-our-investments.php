<?= (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' : ''; ?>
<?php
$cta = get_field('cta');
$terms = get_terms(
	array(
		'taxonomy'   => 'product_cat',
		'hide_empty' => false,
		'orderby' => 'ID',
		'order' => 'ASC',
	)
);
?>

<div id="homecats" class="block greyDiagonal">
	<div class="wrapper">
		<div class="homecats--content" data-aos="fade-right">
			<div class="homecats--content__top">
				<div class="homecats--title">
					<?= get_field('title'); ?>
				</div>
				<div class="homecats--description">
					<?= get_field('description'); ?>
				</div>
			</div>
			<div class="homecats--content__bottom">
				<?php if ($cta) : ?>
					<?= wptht_get_cta_html($cta, 'cta__a'); ?>
				<?php endif; ?>
			</div>
		</div>

		<div class="homecats--categories">
			<?php
			if (!empty($terms) && is_array($terms)) :
				foreach ($terms as $i => $term) :
					$delay = ($i%2 == 0) ? 0 : 250;
					$image_id = (int) get_field('cat_dft_img', $term);
					$block_id = str_replace('-','',$term->slug);
					?>
					<div id="catBlock__<?= $block_id; ?>" class="categories--block" data-aos="fade-zoom-in" data-aos-delay="<?= $delay;?>">
						<?php $pagelink = get_page_link(219);
						$wix_post_id = '?product-category=' . $term->slug; ?>
						<a href="<?= esc_url($pagelink) . $wix_post_id; ?>">
							<?php if ($image_id) : ?>
								<?= wptht_get_img_html($image_id, 'homepage-investment'); ?>
							<?php endif; ?>
							<div class="categories--meta">
								<div class="meta--title"><?= $term->name; ?></div>
								<div class="meta--description">
									{0} <?= $term->name; ?> {1} and {2} {3}
								</div>
							</div>
						</a>
					</div>
			<?php
				endforeach;
			endif;
			?>
		</div>
	</div>
</div>
<?= (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' : ''; ?>