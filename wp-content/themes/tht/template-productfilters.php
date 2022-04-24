<?php echo (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' : '';

/*
Template Name: Disposition
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
                    <label for="product-category">
                        <?php _e('Filter By:'); ?>
                    </label>
                    <select id="product-category" name="product-category" class="style-select">
                        <option value="">All Categories</option>
                        <?php foreach ($cats as $cat) :
                            $selected1 = (isset($_GET['product-category']) && $_GET['product-category'] == $cat->slug) ? "selected" : "";
                            echo '<option ' . $selected1 . ' value="' . $cat->slug . '">' . $cat->name . '</option>'; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
            <?php endif; ?>

            <?php /*
            <!--
            <div class="filter--box">
                <label for="select-sort">
                    <?php _e('Sort By:'); ?>
                </label>
                <select class="style-select" id="select-sort" name="select-sort" aria-label="sort">
                    <option value="">Default</option>
                    <?php $sortval = isset($_GET['select-sort']) ? $_GET['select-sort']  : ""; ?>
                    <option <?=( $sortval=='property_name' ) ? "selected" : ""; ?> value="property_name">
                        <?php _e('Name'); ?>
                    </option>
                    <option <?=( $sortval=='state' ) ? "selected" : ""; ?> value="state">
                        <?php _e('State'); ?>
                    </option>
                    <option <?=( $sortval=='size' ) ? "selected" : ""; ?> value="size">
                        <?php _e('Size'); ?>
                    </option>
                </select>
            </div> -->

            <div class="filter--box">
                <label for="sort-order">
                    <?php _e('Order:'); ?>
                </label>
                <select class="style-select" id="sort-order" name="sort-order" aria-label="sort">
                    <?php $sortorder = isset($_GET['sort-order']) ? $_GET['sort-order']  : ""; ?>
                    <option <?=( $sortorder=='ASC' ) ? "selected" : ""; ?> value="ASC">
                        <?php _e('ASC'); ?>
                    </option>
                    <option <?=( $sortorder=='DESC' ) ? "selected" : ""; ?> value="DESC">
                        <?php _e('DESC'); ?>
                    </option>
                </select>
            </div>
            */ ?>
            <div class="view--box">
                <label><?php _e('View:'); ?></label>
                <?php $viewmode = isset($_GET['view-mode']) ? $_GET['view-mode']  : "list"; ?>

                <input type="radio" class="view-toggle" name="view-mode" id="view-grid" value="grid" aria-label="View Grid Mode" <?=( $viewmode=='grid' ) ? "checked" : ""; ?>>
                    <label for="view-grid" <?=( $viewmode=='grid' ) ? "class='selected'" : ""; ?>><?php _e('grid'); ?></label>
                <input type="radio" class="view-toggle" name="view-mode" id="view-list" value="list" aria-label="View List Mode" <?=( $viewmode=='list' ) ? "checked" : ""; ?>>
                    <label for="view-list" <?=( $viewmode=='list' ) ? "class='selected'" : ""; ?>><?php _e('list'); ?></label>
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

if ($query->have_posts()) : ?>
    <div id="propertyList" class="background__full background__alt view-mode__<?= $viewmode; ?>">
        <div class="wrapper__narrow">
            <?php
            $i = 0;
            while ($query->have_posts()) : $query->the_post(); ?>
                <?php
                $id = get_the_id();
                $property_name =  get_field('property_name');
                $city =  get_field('location');
                $size =  get_field('sizes');
                $gallery = get_field('gallery');
                $contact_details = get_field('contact_details');
                $file = get_field('file');
                $terms = get_the_terms($id, 'product_cat');
                $cat = '';
                if ($terms) {
                    $cat = strtolower(str_replace('-', '', $terms[0]->slug));
                }
                ?>
                <div class="property">
                    <div class="property-grid-img">
                        <?php if ($gallery) :
                            echo wptht_get_img_html($gallery[0], 'gallery_featured');
                        endif;
                        ?>
                    </div>
                    <div class="propData">
                        <div class="data-close">Close</div>
                        <div class="property-cell show-grid propName">
                            <?php if ($property_name) : ?>
                                <div class="property-cell--label" tabindex="-1"><?php _e('Property Name:'); ?></div>
                                <div class="property-label-name">
                                    <?= $property_name; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="property-cell show-grid propLoc">
                            <?php if ($city) : ?>
                                <div class="property-cell--label" tabindex="-1"><?php _e('City/State:'); ?></div>
                                <div>
                                    <?= $city  ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="property-cell">
                            <?php if ($size) : ?>
                                <div class="property-cell--label" tabindex="-1"><?php _e('Size:'); ?></div>
                                <div>
                                    <?= number_format($size); ?>
                                    <?= ($cat == 'multifamily') ? _e(' Units') : _e(' SF'); ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="property-cell">
                            <!-- adding pdf -->
                            <?php if ($file) : ?>
                                <a class="cta__a pdf-link" href="<?php echo esc_html($file['url']); ?>" download="<?php echo esc_html($file['url']); ?>"><?php _e('View PDF'); ?></a>
                            <?php endif; ?>
                            <!--end pdf -->
                            <?php if ($gallery) : ?> <a id="gallery-link-<?php echo $i; ?>" href="javascript:void(0);" class="cta__a gallery--trigger gallery-link"><?php _e("View Images"); ?></a>
                                <div class="property--gallery gallery--items" data-arrows="true" data-dots="true">
                                    <?php foreach ($gallery as $image) : ?>
                                        <div class="simple-slider__slider___slide">
                                            <?= wptht_get_img_html($image, 'gallery-image'); ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!--adding contact details -->
                        <div class="property-cell">
                            <?php if ($contact_details) : ?>
                                <div class="property-cell--label" tabindex="-1"><?php _e('Contact Details:'); ?></div>
                                <div>
                                    <?= $contact_details; ?></div>
                            <?php endif; ?>
                        </div>
                        <!--end contact details -->
                    </div>
                </div>
            <?php $i++;
            endwhile; ?>
        </div>
        <div class="btn-div">
            <div id="loadMore"><?php _e('Load More'); ?></div>
        </div>
    </div>
<?php
    wp_reset_postdata();
endif;
?>
<footer class="footer-section">
    <?php get_template_part('template-parts/op', 'getintouch'); ?>
</footer>
<?php
get_footer();
echo (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' : '';