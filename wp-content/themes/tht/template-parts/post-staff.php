<?= (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' : ''; ?>
<?php $_posts = new WP_Query(array(
	'post_type'         => 'staff',
	'posts_per_page'    => -1,
	'orderby'        => 'title',
	'order'          => 'ASC',
));
?>
<?php if ($_posts->have_posts()): ?>
	<div id="staff">
		<?php while ($_posts->have_posts()) :
			$_posts->the_post();
			$id = get_the_ID();
			$image = get_field('featured_image', $id);
			$title = get_field('title', $id);
			$job_title = get_field('job_title', $id);
			$content = get_field('content', $id);

			//$cta = get_field('cta', $id);
		?>
			<div class="staff--member modal--content">
				<div class="member--img">
					<?php if ($image) :
						echo wpbfm_get_img_html($image, 'full'); 
					else:
						echo wpbfm_get_img_placeholder();
					endif; ?>
				</div>
				<div class="member--info">
					<div>	
						<?php if ($title) : ?>
							<div class="name">
								<?= $title; ?>
							</div>
						<?php endif; ?>
						<?php if ($job_title) : ?>
							<div class="title">
								<?= $job_title; ?>
							</div>
						<?php endif; ?>
					</div>
					<a href="javascript:void(0);" class="cta cta__a modal--trigger">
						Read Bio
					</a>
					<?php if ($content) : ?>
						<div class="member--bio">
							<?= $content; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		<?php endwhile;
			wp_reset_postdata();
		?>
	</div>
<?php endif;?>

<?= (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' : '';?>