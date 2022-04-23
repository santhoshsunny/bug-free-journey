<?php
echo (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' :'';
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 */
?>

<footer class="footer-section">
	<section id="get-in-touch" class="block background__full">
		<div class="wrapper">
			<div class="block-title">
				Get in touch
			</div>
			<div class="block-description">
				Lorem ipsum dolor sit atem, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolor
				magna aliqua consectetur adipiscing elit, sed do eiusmod tempor incididunt ut.
			</div>
			<div>
				<a href="/" class="btn__outline btn__outline__orange">Contact Us</a>
			</div>
		</div>
	</section>
	<section class="footer-menus">
		<div class="wrapper">
			<div class="menu__left">
				<?php the_custom_logo(); ?>
				<a href="http://maps.google.com/maps?q=220+East+42nd+Street,+New+York,+NY+10017" target="_blank" class="icon--div desktop-only">
					<div class="icon icon--pin"></div>
					<div>
						220 East 42nd Street,<br>
						New York, NY 10017
					</div>
				</a>
			</div>
			<?php
				$location = 'footer';
				$menu_obj = wpbfm_get_menu_by_location( $location );
				wp_nav_menu(
					array(
						'theme_location' => $location,
						'menu_id' => $location
					)
				);
			?>
			<div class="menu__right">
				<ul><li><a href="javascript:void(0);">Contact Us</a></li></ul>
				<a href="http://maps.google.com/maps?q=220+East+42nd+Street,+New+York,+NY+10017" target="_blank" class="icon--div tab-down">
					<div class="icon icon--pin"></div>
				</a>
				<a href="tel:+12126974740" class="icon--div">
					<div class="icon icon--phone"></div>
					<div class="text">
						212.697.4740
					</div>
				</a>
				<a href="fax:+12126974740" class="icon--div desktop-only">
					<div class="icon icon--fax"></div>
					<div class="text">
						212.697.4740
					</div>
				</a>
				<a href="mailto:contact@draadvisors.com" class="icon--div">
					<div class="icon icon--mail"></div>
					<div class="text">
						contact@DRAAdvisors.com
					</div>
				</a>
			</div>
		</div>
	</section>
	<section class="footer-copy wrapper">
		<div>
			&copy; <?= date('Y'); ?> DRA Advisors LLC.
		</div>
		<div>
			<?php wp_nav_menu(
					array(
						'theme_location' => 'privacy-terms-nav',
						'menu_id' => 'privacy-terms-nav',
						'container' => ''
					)
				);
			?>
		</div>
	</section>
</footer>

<?php wp_footer(); ?>
<?php echo get_field('ge_footer_cc', 'option'); ?>

</div> <!--#content-->
</div> <!--#page-->
<div id="modal"></div>

</body>
</html>

<?php echo (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' :''; ?>