<?php
    $post = get_field('featured_post');
    if ($post):
?>
<div class="article-wrap wrapper">
    <div id="newsFeature" data-aos="fade-down">
        <?php
            setup_postdata($post);
            $title =  get_field('title', $post->ID);
            $logo =  get_field('logo', $post->ID);
            $description =  get_field('description', $post->ID);
            $image =  get_field('image', $post->ID);
        ?>
            <div class="feature--content">
                <?php if ($logo) : ?>
                    <div class="feature--content__top" data-aos="fade-down" data-aos-delay="250" data-aos-anchor="#newsFeature">
                        <?= wptht_get_img_html($logo, 'news-featured-logo'); ?>
                    </div>
                <?php endif; ?>
                <div class="feature--content__bottom">
                    <div class="date" data-aos="fade-down" data-aos-delay="500" data-aos-anchor="#newsFeature">
                        <?= get_the_date('m/d/Y'); ?>
                    </div>
                    <div class="title" data-aos="fade-down" data-aos-delay="750" data-aos-anchor="#newsFeature">
                      <h2> <?= $title;?></h2>
                    </div>
                    <div class="excerpt" data-aos="fade-down" data-aos-delay="1000" data-aos-anchor="#newsFeature">
                        <?= $description;?>
                    </div>
                </div>
            </div>

            <div class="feature--img">
                <?php if ($image) : ?>
                    <?= wptht_get_img_html($image, 'news-featured-image'); ?>
                <?php endif; ?>
            </div>
    </div>
</div>
<?php endif; ?>
