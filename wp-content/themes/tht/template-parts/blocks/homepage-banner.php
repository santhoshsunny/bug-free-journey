<?= (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' : '';
$image =  get_field('image');
?>
<div id="homebanner" class="block">
  <?php if ($image) : ?>
    <div class="banner--img" <?= wptht_get_img_src($image); ?>>
      <div class="content">
        <h1 class="title">
          <?= get_field('title'); ?>
        </h1>
        <p class="description">
          <?= get_field('description'); ?>
        </p>
      </div>
    </div>
  <?php endif; ?>
</div>
<?= (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' : ''; ?>