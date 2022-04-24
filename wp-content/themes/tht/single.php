<?php
echo (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' : '';
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 */

get_header();
?>

<?php get_template_part('template-parts/op', 'newsdetail'); ?>
<section class="wrapper main-content news-details">
	<main class="main-section">
	<div class="news-list">
		<?php
		$id = get_the_ID();
        $date = get_the_date('m/d/Y');
		$image  = get_field('image', $id);
		$title = get_field('title', $id);
		$description = get_field('description', $id);
		?>
		<div class="news-list-img">
		<?php if ($image) : ?>
			<?= wptht_get_img_html($image, 'single-news'); ?>
		<?php endif; ?>
		</div>
        <div class="date"><?php if ($date) : ?>
			<?= $date; ?>
		<?php endif; ?></div>
		<h2 class="title"><?php if ($title) : ?>
			<?= $title; ?>
		<?php endif; ?></h2>
		<div class="description"><?php if ($description) : ?>
			<?= $description; ?>
		<?php endif; ?></div>
</div>

	</main>
</section>
<?php
get_footer();

echo (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' : '';
