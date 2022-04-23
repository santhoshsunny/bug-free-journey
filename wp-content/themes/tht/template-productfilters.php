<?php echo (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' : '';

/*
Template Name: disposition
*/
get_header();
?>
<main class="main-section">
	<?php if (have_posts()) :
		while (have_posts()) : the_post();
			the_content();
		endwhile;
	endif; ?>
</main>

<?php
	$args = array(
		'taxonomy' => 'product_cat',
		'orderby' => 'name',
		'order'   => 'ASC'
	);

	$cats = get_categories($args);
?>
<div id="filter" class="background__full background__alt">
	<div class="wrapper__narrow">
		<form method="GET" name="product-filters" class="filter--container" id="product-filters">
			<?php if ($cats = get_terms('product_cat', array('hide_empty' => 0))) : ?>
				<div class="filter--box">
					<label for="product-category"><?php _e('Filter By:'); ?></label>
					<select id="product-category" name="product-category" class="style-select">
						<option value="">All Categories</option>
						<?php foreach ($cats as $cat) :
							$selected1 = (isset($_GET['product-category']) && $_GET['product-category'] == $cat->slug) ? "selected" : "";
							echo '<option ' . $selected1 . ' value="' . $cat->slug . '">' . $cat->name . '</option>'; ?>
						<?php endforeach; ?>
					</select>
				</div>
			<?php endif; ?>
			<div class="filter--box">
				<label for="select-sort"><?php _e('Sort By:'); ?></label>
				<select class="style-select" id="select-sort" name="select-sort" aria-label="sort">
					<option value="">Default</option>
					<?php $sortval = isset($_GET['select-sort']) ? $_GET['select-sort']  : ""; ?>
					<option <?= ($sortval == 'property_name') ? "selected" : ""; ?> value="property_name"><?php _e('Name'); ?></option>
					<option <?= ($sortval == 'state') ? "selected" : ""; ?> value="state"><?php _e('State'); ?></option>
					<option <?= ($sortval == 'size') ? "selected" : ""; ?> value="size"><?php _e('Size'); ?></option>
				</select>
			</div>
			<div class="filter--box">
			<label for="sort-order"><?php _e('Order:'); ?></label>
				<select class="style-select" id="sort-order" name="sort-order" aria-label="sort">
					<?php $sortorder = isset($_GET['sort-order']) ? $_GET['sort-order']  : ""; ?>
					<option <?= ($sortorder == 'ASC') ? "selected" : ""; ?> value="ASC"><?php _e('ASC'); ?></option>
					<option <?= ($sortorder == 'DESC') ? "selected" : ""; ?> value="DESC"><?php _e('DESC'); ?></option>
				</select>
			</div>
		</form>
	</div>
</div>

<?php
	$args = array(
		'post_type' => 'products',
		'posts_per_page' => -1
	);

	if (isset($_GET['product-category']) && !empty($_GET['product-category'])) {
		$productcat = $_GET['product-category'];
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'product_cat',
				'field'    => 'slug',
				'terms'    => $productcat
			)
		);
	}

	if (isset($_GET['select-sort']) && !empty($_GET['select-sort'])) {
		$args['orderby'] = 'meta_value';
		$args['meta_key'] = $_GET['select-sort'];
	}

	if (isset($_GET['sort-order']) && !empty($_GET['sort-order'])) {
		$args['order'] =  $_GET['sort-order'];
	}

$query = new WP_Query($args);

if ($query->have_posts()) :?>
	<div id="propertyList" class="background__full background__alt">
		<div class="wrapper__narrow">
			<?php while ($query->have_posts()) : $query->the_post(); ?>
				<?php
					$property_name =  get_field('property_name');
					$featured_image = get_field('featured_image');
					$city =  get_field('city');
					$state =  get_field('state');
					$size =  get_field('size');
					$gallery = get_field('gallery');
				?>
				<div class="property">
					<div class="property-cell">
						<?php if ($property_name) : ?>
							<div class="property-cell--label" tabindex="-1">Property Name:</div>
							<div><?= $property_name; ?></div>
						<?php endif; ?>
					</div>
					<div class="property-cell">
						<?php if ($city && $state) : ?>
							<div class="property-cell--label" tabindex="-1">City/State:</div>
							<div><?= $city.', '.$state; ?></div>
						<?php endif; ?>
					</div>
					<div class="property-cell">
					<?php if ($size) : ?>
						<div class="property-cell--label" tabindex="-1">Sq.Ft.:</div>
						<div><?= number_format($size); ?> SF</div>
					<?php endif; ?>
					</div>
					<div class="property-cell">
						<?php if ($gallery) : ?>
							<a href="javascript:void(0)"; class="cta__a gallery--trigger">View Images</a>

							<div class="property--gallery gallery--items" data-arrows="true" data-dots="true">
								<?php foreach ($gallery as $image):?>
									<div class="simple-slider__slider___slide">
										<?= wpbfm_get_img_html($image, 'gallery-image');?>
									</div>
								<?php endforeach;?>
							</div>
						<?php endif;?>
					</div>
				</div>
				<?php if ($featured_image) : ?>
					<?php //echo wpbfm_get_img_html($featured_image, ''); ?>
				<?php endif; ?>
			<?php endwhile; ?>
		</div>
	</div>
	<?php
	wp_reset_postdata();
	endif;
?>

<?php
get_footer();
echo (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' : '';
