<?= (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' : '';
$lists = get_field('list');
$title = get_field('title');
?>

<div id="statistics" class="block background__full">
  <div class="wrapper">
    <?php if ($title) : ?>
      <div class="statistics--title">
        <?= $title; ?>
      </div>
    <?php endif;
    if ($lists) : ?>
      <div class="statistics--list">
        <?php foreach ($lists as $list) : ?>
          <div class="list--item">
            <div class="list--item__img"><?php if ($list['icon']) : ?><?= wpbfm_get_img_html($list['icon'], 'homepage-statistics'); ?><?php endif; ?></div>
            <div class="list--item__title">
              <?php if ($list['number']) : ?><div class="list--item__title__num"><?= $list['number']; ?></div><?php endif; ?>
              <?php if ($list['text']) : ?><div class="list--item__title__text"><?= $list['text']; ?></div><?php endif; ?>
            </div>
            <div class="list--item__desc"><?php if ($list['description']) : ?><?= $list['description']; ?><?php endif; ?></div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</div>

<?= (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' : ''; ?>