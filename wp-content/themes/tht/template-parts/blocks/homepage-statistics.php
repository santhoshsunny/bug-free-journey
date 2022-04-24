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
            <div class="list--item__img"><?php if ($list['icon']) : ?><?= wptht_get_img_html($list['icon'], 'homepage-statistics'); ?><?php endif; ?></div>
            <div class="list--item__title">
              <?php if ($list['number']) : ?>
                  <?php
                    $pattern = '/^([^0-9]*)([0-9]*)([^0-9]*)$/i';
                    //$replacement = '$1<span class="figure">0</span>$3';
                    preg_match($pattern, $list['number'], $matches);
                  ?>
                <div class="list--item__title__num">
                  <?= trim($matches[1]);?>
                  <span class="odometer odo-ready" data-digit="<?= $matches[2];?>">0</span>
                  <?= trim($matches[3]);?>
                </div>
              <?php endif; ?>
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