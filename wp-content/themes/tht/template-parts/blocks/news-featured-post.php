<?php
    $post = get_field('featured_post');
    if ($post):
?>
<div class="article-wrap wrapper">
    <div id="newsFeature">
        <?php
            setup_postdata($post);
            $title =  get_field('title', $post->ID);
            $logo =  get_field('logo', $post->ID);
            $description =  get_field('description', $post->ID);
            $image =  get_field('image', $post->ID);
        ?>
            <div class="feature--content">
                <?php if ($logo) : ?>
                    <div class="feature--content__top">
                        <?= wpbfm_get_img_html($logo, 'news-featured-logo'); ?>
                    </div>
                <?php endif; ?>
                <div class="feature--content__bottom">
                    <div class="date">
                        <?= get_the_date('m/d/Y'); ?>
                    </div>
                    <div class="title">
                        <?= $title;?>
                    </div>
                    <div class="excerpt">
                        <?= $description;?>
                    </div>
                </div>
            </div>

            <div class="feature--img">
                <?php if ($image) : ?>
                    <?= wpbfm_get_img_html($image, 'news-featured-image'); ?>
                <?php endif; ?>
            </div>
    </div>
</div>
<?php endif; ?>
