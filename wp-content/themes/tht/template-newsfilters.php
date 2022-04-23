<?= (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' : '';
/*
Template Name: news
*/
get_header();
?>
<main class="main-section" id="news-banner">
	<div class="banner--meta">
		<div class="banner--meta-content">
			<?php if (function_exists('yoast_breadcrumb')) {
				yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
			} ?>
			<div class="title">News | Recent Activity</div>
		</div>
	</div>
	<?php if (have_posts()) :
		while (have_posts()) : the_post();
			the_content();
		endwhile;
	endif; ?>
</main>
<?php
$args = array(
	'taxonomy' => 'category',
	'orderby' => 'name',
	'order'   => 'ASC'
);
$cats = get_categories($args);
?>
<div class="wrapper">
	<div id="filter">
		<form method="GET" class="filter--container" name="news-filters" id="news-filters">
			<?php if ($cats = get_terms('category', array('hide_empty' => 0))) : ?>
				<div class="filter--box">
					<label for="news-category"><?php _e('Filter By:'); ?></label>
					<select id="news-category" name="news-category" class="style-select">
						<option value="">Select Category</option>
						<?php foreach ($cats as $cat) :
							$selected1 = ($_GET['news-category'] == $cat->slug) ? "selected" : "";
							echo '<option ' . $selected1 . ' value="' . $cat->slug . '">' . $cat->name . '</option>';
						endforeach; ?>
					</select>
				</div>
			<?php endif; ?>
			<div class="filter--box">
				<label for="select-sort"><?php _e('Sort By:'); ?></label>
				<select class="style-select" id="select-sort" name="select-sort" aria-label="sort">
					<?php $sortval = isset($_GET['select-sort']) ? $_GET['select-sort']  : ""; ?>
					<option <?= ($sortval == 'ASC') ? "selected" : ""; ?> value="ASC"><?php _e('ASC'); ?></option>
					<option <?= ($sortval == 'DESC') ? "selected" : ""; ?> value="DESC"><?php _e('DES'); ?></option>
				</select>
			</div>
		</form>
	</div>
	<?php
	$currentPage = get_query_var('paged');
	$args = array(
		'post_type' => 'post',
		'posts_per_page' => 5,
		'paged' => $currentPage
	);

	$newscat = '';

	if (isset($_GET['news-category']) && !empty($_GET['news-category'])) {
		$newscat = $_GET['news-category'];
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'category',
				'field'    => 'slug',
				'terms'    => $newscat
			)
		);
	}
	$args['order'] =  'ASC';

	if (isset($_GET['select-sort']) && !empty($_GET['select-sort'])) {
		$args['order'] =  $_GET['select-sort'];
	}

	$query = new WP_Query($args);

	if ($query->have_posts()) : ?>
		<div id="newsList">
			<?php while ($query->have_posts()) : $query->the_post();
				$id = get_the_ID();
				$date = get_the_date('m/d/Y');
				$logo  = get_field('logo', $id);
				$image  = get_field('image', $id);
				$title = get_field('title', $id);
				$description = get_field('description', $id);
			?>
				<div class="news-item">
					<div class="news-item--content">
						<?php if ($date) : ?>
							<div class="news-item--content__date">
								<?= $date; ?>
							</div>
						<?php endif; ?>
						<?php if ($title) : ?>
							<a href="<?= get_the_permalink();?>" class="news-item--content__title">
								<?= $title; ?>
							</a>
						<?php endif; ?>
						<?php if ($description) : ?>
							<div class="news-item--content__desc">
								<?= $description; ?>
							</div>
						<?php endif; ?>
					</div>
					<div class="news-item--img">
						<?php if ($image) : ?>
							<?= wpbfm_get_img_html($image, 'news-image'); ?>
						<?php endif; ?>
					</div>
				</div>
			<?php endwhile; ?>
		</div>
	<?php wp_reset_postdata();
	endif; ?>

	<div class="pagination">
		<?= paginate_links(array(
			'total' => $query->max_num_pages,
			'prev_text' => __('<'),
			'next_text' => __('>')
		)); ?>
	</div>
</div>

<?php get_footer();
echo (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' : '';
