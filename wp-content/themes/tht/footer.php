<?php
echo (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' : '';
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

	<section class="footer-menus">
		<div class="wrapper">
			<div class="menu__left">
				<?php the_custom_logo(); ?>
				<?php $link = get_field('link', 'option'); ?>
				<a href="<?php echo $link; ?>" target="_blank" class="icon--div desktop-only">
					<div class="icon icon--pin"></div>
					<div>
						<?php $address = get_field('address', 'option');
						echo $address; ?>
					</div>
				</a>
			</div>
			<?php
			$location = 'footer';
			$menu_obj = wptht_get_menu_by_location($location);
			wp_nav_menu(
				array(
					'theme_location' => $location,
					'menu_id' => $location
				)
			);
			?>
			<div class="menu__right">
				<ul><?php $contact_us_footer = get_field('contact_us_footer', 'option'); ?>
					<li> <?php if ($contact_us_footer) :
								echo wptht_get_cta_html($contact_us_footer);
							endif; ?></li>
				</ul>
				<a href="https://www.google.com/maps/@40.7563245,-73.9804622,17z" target="_blank" class="icon--div tab-down">
					<div class="icon icon--pin"></div>
				</a>
				<?php $phone_number = get_field('phone_number', 'option');
				$fax_number = get_field('fax_number', 'option');
				$email = get_field('email', 'option'); ?>

				<a href="mailto:<?php echo $email; ?>" class="icon--div">
					<div class="icon icon--mail"></div>
					<div class="text">
						<?php echo $email; ?>
					</div>
				</a>
				<a href="tel:+<?php echo $phone_number; ?>" class="icon--div">
					<div class="icon icon--phone"></div>
					<div class="text">
						<?php echo $phone_number; ?>
					</div>
				</a>
				<a href="fax:+<?php echo $fax_number; ?>" class="icon--div desktop-only">
					<div class="icon icon--fax"></div>
					<div class="text">
						<?php echo $fax_number; ?>
					</div>
				</a>

			</div>
		</div>
	</section>
	<section class="footer-copy wrapper">
		<div>
			&copy; <?= date('Y'); ?> <?php _e('Tiny House Trailers NZ'); ?>
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

</div>
<!--#content-->
</div>
<!--#page-->
<div id="modal"></div>

</body>

</html>

<?php echo (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' : ''; ?>