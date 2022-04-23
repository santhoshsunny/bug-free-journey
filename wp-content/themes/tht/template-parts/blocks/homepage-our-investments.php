<?= (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' : ''; ?>
<?php
$cta = get_field('cta');
$terms = get_terms(
	array(
		'taxonomy'   => 'product_cat',
		'hide_empty' => false,
	)
);
?>

<div id="homecats" class="block greyDiagonal">
	<div class="wrapper">
		<div class="homecats--content">
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
					<?= wpbfm_get_cta_html($cta, 'cta__a'); ?>
				<?php endif; ?>
			</div>
		</div>

		<div class="homecats--categories">
			<?php
			if (!empty($terms) && is_array($terms)) :
				foreach ($terms as $term) :
					$image_id = (int) get_field('cat_dft_img', $term); ?>
					<div class="categories--block">
						<?php $pagelink = get_page_link(219);
						$wix_post_id = '?product-category=' . $term->slug; ?>
						<a href="<?= esc_url($pagelink) . $wix_post_id; ?>">
							<?php if ($image_id) : ?>
								<?= wpbfm_get_img_html($image_id, 'homepage-investment'); ?>
							<?php endif; ?>
							<div class="categories--meta">
								<div class="meta--title"><?= $term->name; ?></div>
								<div class="meta--description"><?= $term->description; ?></div>
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