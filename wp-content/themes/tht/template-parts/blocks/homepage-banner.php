<?= (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' : '';
$image =  get_field('image');
?>
<div id="homebanner" class="block">
    <?php if ($image) : ?>
        <div class="banner--img" <?= wptht_get_img_src($image);?>>
          <div class="content">
            <div class="title">
              <?= get_field('title'); ?>
            </div>
            <div class="description">
              <?= get_field('description'); ?>
            </div>
          </div>
        </div>
    <?php endif; ?>

    <!-- <div class="content">
      <div class="title">
        <?= get_field('title'); ?>
      </div>
      <div class="description">
        <?= get_field('description'); ?>
      </div>
    </div> -->
    <!-- <div class="wrapper nopad">
        <div class="homebanner--content aos-init aos-animate" data-aos="fade-down">
            <div class="homebanner--content__top">
                <h1 class="homebanner--title"><strong><?= get_field('title'); ?></strong></h1>
                <h2 class="homebanner--description"><strong><?= get_field('description'); ?></strong></h2>
            </div>
        </div>
    </div> -->
</div>
<?= (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' : ''; ?>
