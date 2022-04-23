<?php
echo (WP_DEBUG) ? '<!-- BEGIN: [ ' . basename(__FILE__) . ' ]   -->' :'';
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <base href="/">
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>

    <?php wp_head(); ?>

<body <?php body_class(); ?> >

<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'dra_advisors'); ?></a>

		<header id="masthead" class="site-header">
			<div class="site-branding">
				<?php
				the_custom_logo();
				?>
			</div><!-- .site-branding -->
			<button class="hamburger hamburger--spring" type="button" aria-controls="primary-menu">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</button>
			<nav id="site-navigation" class="main-navigation">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'main-nav',
						'menu_id' => 'main-nav',
						'container' => ''
					)
				);
				?>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'user-nav',
						'menu_id' => 'user-nav',
						'menu_class' => 'n-header-buttons',
						'container' => ''
					)
				);
				?>
			</nav><!-- #site-navigation -->
		</header><!-- #masthead -->

		<div id="content" class="site-content">

<?php echo (WP_DEBUG) ? '<!-- END: [ ' . basename(__FILE__) . ' ]   -->' :''; ?>