<?= (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' : '';
   $text = get_field('text');
   $lists = get_field('list');
?>
<?php if ($lists || $text) :?>
   <div id="acquisitionDetails" class="block background__full background__alt">
      <?php if($lists):?>
         <div class="details wrapper">
            <?php foreach ($lists as $k=> $list) : ?>
               <div class="detail-block detail-block__<?= ($k % 3); ?>" data-aos="fade">
                  <?php if ($list['title']) : ?>
                     <div class="detail-block--title">
                        <?= ($list['title']); ?>
                     </div>
                  <?php endif; ?>
                  <?php if ($list['text']) : ?>
                     <div class="detail-block--text">
                        <?= ($list['text']); ?>
                     </div>
                  <?php endif; ?>
               </div>
            <?php endforeach;?>
         </div>
      <?php endif;?>
      <?php if ($text) : ?>
         <div class="subtext wrapper">
            <?= $text; ?>
         </div>
      <?php endif; ?>
   </div>
<?php endif; ?>

<?= (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' : ''; ?>
