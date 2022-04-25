<?= (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' : '';
$lists = get_field('list');
$title = get_field('title');
$delay = 0;
?>

<div id="statistics" class="block background__full">
  <div class="wrapper">
    <?php if ($title) : ?>
      <div class="statistics--title">
        <?= $title; ?>
      </div>
    <?php endif;
    if ($lists) : ?>
      <div class="statistics--list odometers">
        <?php foreach ($lists as $list) : ?>
          <div class="list--item" data-aos="fade-down" data-aos-delay="<?= $delay; ?>">
            <div class="list--item__img"><?php if ($list['icon']) : ?><?= wptht_get_img_html($list['icon'], 'full'); ?><?php endif; ?></div>
            <div class="list--item__title">
              <?php if ($list['text']) : ?><div class="list--item__title__text"><?= $list['text']; ?></div><?php endif; ?>
            </div>
            <div class="list--item__desc"><?php if ($list['description']) : ?><?= $list['description']; ?><?php endif; ?></div>
          </div>
        <?php 
        $delay += 200;
        endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</div>

<?= (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' : ''; ?>