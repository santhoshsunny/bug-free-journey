<?= (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' : '';
  $title = get_field('title');
  $lists = get_field('list');
?>
<div id="our-culture" class="block">
  <?php if ($title) : ?>
    <div class="culture--title"><?= $title; ?></div>
  <?php endif; ?>
  <?php if ($lists) : ?>
    <div class="culture--list">
      <?php foreach ($lists as $k=> $list): ?>
        <div class="culture--block <?= ($k % 2 == 0) ? 'even' : 'odd';?>">
          <div class="wrapper">
            <?php if ($list['image']) : ?>
              <div class="culture--block-img">
                <?= wpbfm_get_img_html($list['image'], 'company-culture'); ?>
              </div>
            <?php endif; ?>
            <div class="culture--block-text">
              <?php if ($list['title']) : ?>
                <div class="block--title">
                  <?= $list['title']; ?>
                </div>
              <?php endif; ?>
              <?php if ($list['description']) : ?>
                <?= $list['description']; ?>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>



<?= (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' : ''; ?>
