<?= (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' : ''; 
$lists = get_field('list');
?>

<div id="opportunitiesLinks">
	<div class="horizontal-scroll">
		<div class="hs-wrapper">
			<?php foreach ($lists as $list): ?>
				<div class="sublink">
					<?= wpbfm_get_cta_html($list['cta']); ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>


<?= (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' : ''; ?>