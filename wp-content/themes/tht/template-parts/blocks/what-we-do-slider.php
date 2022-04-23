<?= (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' : '';
      $images = get_field('image_gallery');
      $lists = get_field('list');
?>

<div id="whatWeDo" class="block greyDiagonal">
      <div class="wrapper">
            <?php if ($images) : ?>
                  <div id="imageGallery" class="simple-slider__slider is-slider" data-dots="true" data-arrows="true">
                        <?php foreach ($images as $image_id) : ?>
                              <div class="simple-slider__slider___slide">
                                    <?= wpbfm_get_img_html($image_id, 'gallery-image'); ?>
                              </div>
                        <?php endforeach; ?>
                  </div>
            <?php endif; ?>
            <?php if ($lists):  ?>
                  <div class="content wrapper__xs">
                        <?php foreach ($lists as $list):
                              if ($list['title']): ?>
                                    <div class="subheading">
                                          <?= $list['title']; ?>
                                    </div>
                              <?php endif; ?>
                              <?php if ($list['text']): ?>
                                    <p><?= $list['text']; ?></p>
                              <?php endif; ?>
                        <?php endforeach; ?>
                  </div>
            <?php endif; ?>
      </div>
</div>

<?= (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' : '';?>
