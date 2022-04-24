<?php

/*
 * TODO: Review/ refactor this file
 */

/**
 * Class Default_Reset_Functions
 *
 */
class Default_Reset_Functions
{

	/**
	 * Default_Reset_Functions constructor.
	 */
	public function __construct()
	{
		$this->add_hooks();
	}

	/**
	 * Adds and remove different actions and filters
	 */
	public function add_hooks()
	{
		$email_encoder_filters = array(
			'the_content',
			'the_excerpt',
			'widget_text',
			'acf/format_value'
		);

		add_action('init', array($this, 'theme_init'));
		add_action('widgets_init', array($this, 'widgets_init'));
		add_action('pre_option_image_default_link_type', array($this, 'always_link_images_to_none'));
		add_action('do_feed', array($this, 'default_disable_feed'), 1);
		add_action('do_feed_rdf', array($this, 'default_disable_feed'), 1);
		add_action('do_feed_rss', array($this, 'default_disable_feed'), 1);
		add_action('do_feed_rss2', array($this, 'default_disable_feed'), 1);
		add_action('do_feed_atom', array($this, 'default_disable_feed'), 1);
		add_action('do_feed_rss2_comments', array($this, 'default_disable_feed'), 1);
		add_action('do_feed_atom_comments', array($this, 'default_disable_feed'), 1);
		add_action('after_setup_theme', array($this, 'theme_setup'));
		add_action('get_header', array($this, 'wp_maintenance_mode'));
		add_action('allowed_block_types', array($this, 'allowed_block_types'), 10, 2);
		add_action('wp_default_scripts', array($this, 'remove_jquery_migrate'));
		add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
		add_action('wp_mail_failed', array($this, 'wp_mail_failed'), 10, 1);

		remove_filter('the_title', 'wptexturize');
		remove_filter('the_content', 'wptexturize');
		remove_filter('the_excerpt', 'wptexturize');

		add_filter('run_wptexturize', '__return_false');
		add_filter('the_excerpt', array($this, 'the_excerpt'), 21);
		add_filter('excerpt_more', array($this, 'excerpt_more'), 21);
		add_filter('wpcf7_form_elements', array($this, 'wpcf7_form_elements'));
		add_filter('wpseo_breadcrumb_separator', array($this, 'custom_separator'), 10, 1);
		add_filter('wpseo_breadcrumb_single_link', array($this, 'remove_breadcrumb_title'), 10, 1);

		/* Remove user list endpoint from rest api	*/
		add_filter('rest_endpoints', function ($aryEndpoints) {
			if (isset($aryEndpoints['/wp/v2/users'])) {
				unset($aryEndpoints['/wp/v2/users']);
			}
			if (isset($aryEndpoints['/wp/v2/users/(?P<id>[\d]+)'])) {
				unset($aryEndpoints['/wp/v2/users/(?P<id>[\d]+)']);
			}

			return $aryEndpoints;
		});

		
		if (defined('WP_DEBUG') && WP_DEBUG) {
			add_action('wp_feed_options', function (&$feed) {
				$feed->enable_cache(false);
			}, 10, 1);

			add_filter('wp_feed_cache_transient_lifetime', function ($var) {
				return 60;
			}, 10, 1);
		}
	}

	/**
	 * Function for returning null to core filters
	 *
	 * @param $a
	 *
	 * @return null
	 */
	public function return_null($a)
	{
		return null;
	}

	/**
	 * Removes default hyperlinking images in content
	 *
	 * @return string
	 */
	public function always_link_images_to_none()
	{
		return 'none';
	}

	/**
	 * Message when somebody tries to access to rss
	 */
	public function default_disable_feed()
	{
		wp_die(('No feed available, please visit the <a href="' . esc_url(home_url('/')) . '">homepage</a>!'));
	}


	/**
	 * theme_setup.
	 *
	 * Sets up theme defaults and registers the various WordPress features that
	 * custom supports.
	 *
	 * @uses load_theme_textdomain() For translation/localization support.
	 * @uses add_editor_style() To add Visual Editor stylesheets.
	 * @uses add_theme_support() To add support for automatic feed links, post
	 * formats, and post thumbnails.
	 * @uses register_nav_menu() To add support for a navigation menu.
	 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
	 */
	public function theme_setup()
	{
		/*
		* Makes custom available for translation.
		*
		* Translations can be added to the /languages/ directory.
		* If you're building a theme based on custom, use a find and
		* replace to change 'custom' to the name of your theme in all
		* template files.
		*/
		load_theme_textdomain('custom', get_template_directory() . '/languages');

		// Adds RSS feed links to <head> for posts and comments.
		add_theme_support('automatic-feed-links');

		/*
		* Switches default core markup for search form, comment form,
		* and comments to output valid HTML5.
		*/
		add_theme_support('html5', array(
			'search-form',
		));

		register_nav_menus(array(
			'main-nav'           => __('Main Nav', 'tht'),
			'footer'          => __('Footer', 'tht'),
			'privacy-terms-nav'  => __('Privacy Policy and Terms Nav', 'tht'),
		));

		/*
		* This theme uses a custom image size for featured images, displayed on
		* "standard" posts and pages.
		*/
		add_theme_support('post-thumbnails');
		set_post_thumbnail_size(604, 270, true);

		// This theme uses its own gallery styles.
		add_filter('use_default_gallery_style', '__return_false');

		// Add support for Block Styles.
		add_theme_support('wp-block-styles');

		// Add support for full and wide align images.
		add_theme_support('align-wide');

		// Add support for page title.
		add_theme_support('title-tag');

		// Add support for page excerpt.
		add_post_type_support('page', 'excerpt');

		//add_image_size('homepage-hero', 950, 380, true);
		add_image_size('homepage-banner', 1920, 610, true);
		add_image_size('homepage-category', 456, 324, true);
		add_image_size('homepage-culture', 820, 520, true);
		add_image_size('homepage-testimonial', 820, 520, true);
		add_image_size('bg-image-banner', 1920, 475, true);
		add_image_size('company-statement', 1920, 665, true);
		add_image_size('company-staff', 290, 217, true);
		add_image_size('company-culture', 590, 392, true);
		add_image_size('sets-apart-banner', 1420, 435, true);
		add_image_size('news-featured-image', 1200, 548, true);
		add_image_size('news-featured-logo', 182, 85, true);
		add_image_size('news-image', 342, 257, true);
		add_image_size('career-image-banner', 1200, 800, true);
		add_image_size('career-inner-image', 170, 270, true);
		add_image_size('card-image', 497, 346, true);
		add_image_size('product-image', 306, 230, true);
		add_image_size('portfolio-image', 577, 520, true);
		add_image_size('sustainability-image', 375, 358, true);
		add_image_size('gallery-image', 1197, 798, true);
		add_image_size('gallery_featured',305,230,true);
		add_image_size('single-news',500,500,true);
	}

	/**
	 * Theme init
	 */
	public function theme_init()
	{
		// Disable the emoji's
		remove_action('wp_head', 'print_emoji_detection_script', 7);
		remove_action('admin_print_scripts', 'print_emoji_detection_script');
		remove_action('wp_print_styles', 'print_emoji_styles');
		remove_action('admin_print_styles', 'print_emoji_styles');
		remove_filter('the_content_feed', 'wp_staticize_emoji');
		remove_filter('comment_text_rss', 'wp_staticize_emoji');
		remove_filter('wp_mail', 'wp_staticize_emoji_for_email');


		// Custom logo.
		$logo_width  = 141;
		$logo_height = 92;

		add_theme_support(
			'custom-logo',
			array(
				'height'      => $logo_height,
				'width'       => $logo_width,
				'flex-height' => true,
				'flex-width'  => true,
			)
		);
	}


	// Activate WordPress Maintenance Mode
	public function wp_maintenance_mode()
	{
		if (defined('WP_MAINTENANCE') && WP_MAINTENANCE) {
			if (!current_user_can('edit_themes') || !is_user_logged_in()) {
				wp_die('<h1 style="color:red">Website under Maintenance</h1><br />We are performing scheduled maintenance. We will be back on-line shortly!');
			}
		}
	}

	public function allowed_block_types($allowed_blocks, $post)
	{
		/*
		//Common blocks
		'core/paragraph',
		'core/image',
		'core/heading',
		'core/list',
		'core/quote',
		'core/audio',
		'core/cover', //(previously core/cover-image)
		'core/file',
		'core/video',
		//Formatting
		'core/table',
		'core/verse',
		'core/code',
		'core/freeform', //Classic
		'core/html', //Custom HTML
		'core/preformatted',
		'core/pullquote',
		//Layout Elements
		'core/button',
		'core/columns',
		'core/media-text', //Media and Text
		'core/more',
		'core/nextpage', //Page break
		'core/separator',
		'core/spacer',
		//Widgets
		'core/shortcode',
		'core/archives',
		'core/categories',
		'core/latest-comments',
		'core/latest-posts',
		//Embeds
		'core/embed',
		'core-embed/twitter',
		'core-embed/youtube',
		'core-embed/facebook',
		'core-embed/instagram',
		'core-embed/wordpress',
		'core-embed/soundcloud',
		'core-embed/spotify',
		'core-embed/flickr',
		'core-embed/vimeo',
		'core-embed/animoto',
		'core-embed/cloudup',
		'core-embed/collegehumor',
		'core-embed/dailymotion',
		'core-embed/funnyordie',
		'core-embed/hulu',
		'core-embed/imgur',
		'core-embed/issuu',
		'core-embed/kickstarter',
		'core-embed/meetup-com',
		'core-embed/mixcloud',
		'core-embed/photobucket',
		'core-embed/polldaddy',
		'core-embed/reddit',
		'core-embed/reverbnation',
		'core-embed/screencast',
		'core-embed/scribd',
		'core-embed/slideshare',
		'core-embed/smugmug',
		'core-embed/speaker',
		'core-embed/ted',
		'core-embed/tumblr',
		'core-embed/videopress',
		'core-embed/wordpress-tv',
		*/


		$allowed_blocks = array(
			// wp core
			'core/heading',
			'core/paragraph',
			'core/image',
			'core/list',
			'core/gallery',
			// 'core/quote',
			// 'core/audio',
			// 'core/video',
			'core/table',
			'core/shortcode',
			'core/columns',

			'atomic-blocks/ab-container',
			'atomic-blocks/ab-layout',

			'acf/homepage-banner',
			'acf/homepage-our-investments',
			'acf/homepage-company-culture',
			'acf/homepage-statistics',
			'acf/testimonial',
			'acf/background-image-banner',
			'acf/backgroundimage-content-banner',
			'acf/our-company-our-team',
			'acf/our-company-our-culture',
			'acf/backgroundcolor-content',
			'acf/intro',
			'acf/what-we-do-slider',
			'acf/what-we-do-set-apart',
			'acf/image-content-section',
			'acf/investment-portfolio-chart',
			'acf/news-featured-post',
			'acf/careers-image-banner',
			'acf/careers-intro',
			'acf/careers-accordion',
			'acf/acquisition-criteria',
			'acf/acquisition-details',
			'acf/opportunities-intro',
			'acf/opportunities-links',
			'acf/contactform-address',
			'acf/contact-form',
			'acf/cms-special-links',
			'acf/cms-text-group',
			'acf/cms-image-banner',
			'acf/cms-paragraph',
		);

		return $allowed_blocks;
	}

	public function gb_table_block_render($attributes, $content)
	{
		return sprintf(
			'<div class="table-wrapper">%s</div>',
			$content
		);
	}

	//Remove JQuery migrate
	public function remove_jquery_migrate($scripts)
	{
		if (!is_admin() && isset($scripts->registered['jquery'])) {
			$script = $scripts->registered['jquery'];
			if ($script->deps) { // Check whether the script has any dependencies
				$script->deps = array_diff($script->deps, array('jquery-migrate'));
			}
		}

		if (is_page_template('template-portfolio.php')) {
			if (!is_admin() && isset($scripts->registered['jquery'])) {
				$scripts->registered = array_diff($scripts->registered, array('jquery'));
			}
		}
	}

	/**
	 * Enqueue scripts and styles for the front end.
	 *
	 * @since custom 1.0
	 */
	public function enqueue_scripts()
	{
		/*
		* You can add standart plugin from core
		*
		* example:
		*
		*
		* Adds Masonry to handle vertical alignment of footer widgets.
		* wp_enqueue_script( 'jquery-masonry' );
		*
		*
		*
		* Adds JavaScript to pages with the comment form to support
		* sites with threaded comments (when in use).
		*
		* if (is_singular() && comments_open() && get_option('thread_comments')) {
		*      wp_enqueue_script('comment-reply');
		* }
		*
		*
		*
		* Full scripts list(scripts inclide in wp-includes/script-loader.php file):
		*
		utils                     /wp-admin/js/utils.js
		common                    /wp-admin/js/common.js
		sack                      /wp-includes/js/tw-sack.js
		quicktags                 /wp-includes/js/quicktags.js
		colorpicker               /wp-includes/js/colorpicker.js
		editor                    /wp-admin/js/editor.js
		wp-fullscreen             /wp-admin/js/wp-fullscreen.js
		prototype                 /wp-includes/js/prototype.js
		wp-ajax-response          /wp-includes/js/wp-ajax-response.js
		wp-pointer                /wp-includes/js/wp-pointer.js
		autosave                  /wp-includes/js/autosave.js
		wp-lists                  /wp-includes/js/wp-lists.js
		scriptaculous-root        /wp-includes/js/scriptaculous/wp-scriptaculous.js
		scriptaculous-builder     /wp-includes/js/scriptaculous/builder.js
		scriptaculous-dragdrop    /wp-includes/js/scriptaculous/dragdrop.js
		scriptaculous-effects	/wp-includes/js/scriptaculous/effects.js
		scriptaculous-slider	/wp-includes/js/scriptaculous/slider.js
		scriptaculous-sound	/wp-includes/js/scriptaculous/sound.js
		scriptaculous-controls	/wp-includes/js/scriptaculous/controls.js
		scriptaculous	scriptaculous-dragdrop, scriptaculous-slider, scriptaculous-controls, scriptaculous-root
		cropper                   /wp-includes/js/crop/cropper.js
		jquery                    /wp-includes/js/jquery/jquery.js
		jquery-ui-core            /wp-includes/js/jquery/ui/jquery.ui.core.min.js
		jquery-effects-core	/wp-includes/js/jquery/ui/jquery.effects.core.min.js
		jquery-effects-blind	/wp-includes/js/jquery/ui/jquery.effects.blind.min.js
		jquery-effects-bounce	/wp-includes/js/jquery/ui/jquery.effects.bounce.min.js
		jquery-effects-clip	/wp-includes/js/jquery/ui/jquery.effects.clip.min.js
		jquery-effects-drop	/wp-includes/js/jquery/ui/jquery.effects.drop.min.js
		jquery-effects-explode	/wp-includes/js/jquery/ui/jquery.effects.explode.min.js
		jquery-effects-fade	/wp-includes/js/jquery/ui/jquery.effects.fade.min.js
		jquery-effects-fold	/wp-includes/js/jquery/ui/jquery.effects.fold.min.js
		jquery-effects-highlight	/wp-includes/js/jquery/ui/jquery.effects.highlight.min.js
		jquery-effects-pulsate	/wp-includes/js/jquery/ui/jquery.effects.pulsate.min.js
		jquery-effects-scale	/wp-includes/js/jquery/ui/jquery.effects.scale.min.js
		jquery-effects-shake	/wp-includes/js/jquery/ui/jquery.effects.shake.min.js
		jquery-effects-slide	/wp-includes/js/jquery/ui/jquery.effects.slide.min.js
		jquery-effects-transfer	/wp-includes/js/jquery/ui/jquery.effects.transfer.min.js
		jquery-ui-accordion	/wp-includes/js/jquery/ui/jquery.ui.accordion.min.js
		jquery-ui-autocomplete	/wp-includes/js/jquery/ui/jquery.ui.autocomplete.min.js
		jquery-ui-button          /wp-includes/js/jquery/ui/jquery.ui.button.min.js
		jquery-ui-datepicker	/wp-includes/js/jquery/ui/jquery.ui.datepicker.min.js
		jquery-ui-dialog          /wp-includes/js/jquery/ui/jquery.ui.dialog.min.js
		jquery-ui-draggable	/wp-includes/js/jquery/ui/jquery.ui.draggable.min.js
		jquery-ui-droppable	/wp-includes/js/jquery/ui/jquery.ui.droppable.min.js
		jquery-ui-mouse           /wp-includes/js/jquery/ui/jquery.ui.mouse.min.js
		jquery-ui-position	/wp-includes/js/jquery/ui/jquery.ui.position.min.js
		jquery-ui-progressbar	/wp-includes/js/jquery/ui/jquery.ui.progressbar.min.js
		jquery-ui-resizable	/wp-includes/js/jquery/ui/jquery.ui.resizable.min.js
		jquery-ui-selectable	/wp-includes/js/jquery/ui/jquery.ui.selectable.min.js
		jquery-ui-slider          /wp-includes/js/jquery/ui/jquery.ui.slider.min.js
		jquery-ui-sortable	/wp-includes/js/jquery/ui/jquery.ui.sortable.min.js
		jquery-ui-tabs            /wp-includes/js/jquery/ui/jquery.ui.tabs.min.js
		jquery-ui-widget      	/wp-includes/js/jquery/ui/jquery.ui.widget.min.js
		jquery-form               /wp-includes/js/jquery/jquery.form.js
		jquery-color              /wp-includes/js/jquery/jquery.color.js
		jquery-query              /wp-includes/js/jquery/jquery.query.js
		jquery-serialize-object	/wp-includes/js/jquery/jquery.serialize-object.js
		jquery-hotkeys            /wp-includes/js/jquery/jquery.hotkeys.js
		jquery-table-hotkeys	/wp-includes/js/jquery/jquery.table-hotkeys.js
		jquery-masonry            /wp-includes/js/jquery/jquery.masonry.min.js
		suggest                   /wp-includes/js/jquery/suggest.js
		schedule                  /wp-includes/js/jquery/jquery.schedule.js
		thickbox                  /wp-includes/js/thickbox/thickbox.js
		jcrop                     /wp-includes/js/jcrop/jquery.Jcrop.js
		swfobject                 /wp-includes/js/swfobject.js
		plupload                  /wp-includes/js/plupload/plupload.js
		plupload-html5            /wp-includes/js/plupload/plupload.html5.js
		plupload-flash            /wp-includes/js/plupload/plupload.flash.js"
		plupload-silverlight	/wp-includes/js/plupload/plupload.silverlight.js
		plupload-html4            /wp-includes/js/plupload/plupload.html4.js
		plupload-full	plupload, plupload-html5, plupload-flash, plupload-silverlight, plupload-html4
		plupload-handlers         /wp-includes/js/plupload/handlers.js
		swfupload                 /wp-includes/js/swfupload/swfupload.js
		swfupload-swfobject	/wp-includes/js/swfupload/plugins/swfupload.swfobject.js
		swfupload-queue           /wp-includes/js/swfupload/plugins/swfupload.queue.js
		swfupload-speed           /wp-includes/js/swfupload/plugins/swfupload.speed.js
		swfupload-all             /wp-includes/js/swfupload/swfupload-all.js
		swfupload-handlers	/wp-includes/js/swfupload/handlers.js
		comment-reply             /wp-includes/js/comment-reply.js
		json2                     /wp-includes/js/json2.js
		imgareaselect             /wp-includes/js/imgareaselect/jquery.imgareaselect.js
		password-strength-meter	/wp-admin/js/password-strength-meter.js
		user-profile              /wp-admin/js/user-profile.js
		admin-bar                 /wp-includes/js/admin-bar.js
		wplink                    /wp-includes/js/wplink.js
		wpdialogs                 /wp-includes/js/tinymce/plugins/wpdialogs/js/wpdialog.js
		wpdialogs-popup           /wp-includes/js/tinymce/plugins/wpdialogs/js/popup.js
		word-count                /wp-admin/js/word-count.js
		media-upload              /wp-admin/js/media-upload.js
		*
		*/

		// Loads JavaScript file with functionality specific to custom.
		// wp_enqueue_style( 'fonts', custom_fonts_url(), array(), null);
		//wp_enqueue_style('style-select', get_template_directory_uri() . '/node_modules/select2/dist/css/select2.min.css', array(), filemtime(get_stylesheet_directory() . '/node_modules/select2/dist/css/select2.min.css'));
		wp_enqueue_style('style', get_template_directory_uri() . '/assets/dist/css/main.css', array(), filemtime(get_stylesheet_directory() . '/assets/dist/css/main.css'));
		wp_enqueue_script('script', get_template_directory_uri() . '/assets/dist/js/scripts.js', array('jquery'), filemtime(get_stylesheet_directory() . '/assets/dist/js/scripts.js'), true);

		wp_localize_script(
			'script',
			'wpthtjs',
			array(
				'ajax_url' => admin_url('admin-ajax.php'),
			)
		);
	}

	/**
	 * Widgets Init
	 *
	 * @since custom 1.0
	 */
	public function widgets_init()
	{
		register_sidebar(array(
			'name'          => __('Main Sidebar', 'tht'),
			'id'            => 'sidebar-1',
			'description'   => __('Widgets in this area will be shown on all posts and pages.', 'tht'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widgettitle">',
			'after_title'   => '</h2>',
		));
	}

	/**
	 * Excerpt More
	 *
	 * @since custom 1.0
	 */
	public function excerpt_more($more)
	{
		return '';
	}

	/**
	 * The Excerpt
	 *
	 * @since custom 1.0
	 */
	public function the_excerpt($excerpt)
	{
		$post = get_post();
		$excerpt .= '... <a href="' . get_permalink($post->ID) . '">continue reading</a>.';
		return $excerpt;
	}

	/**
	 * Remove span wrap around cf7 input fields
	 *
	 * @since custom 1.0
	 */
	public function wpcf7_form_elements($content)
	{
		// $content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);
		$content = str_replace('<br />', '', $content);
		return $content;
	}

	/**
	 * Stores wp_mail errors in debug.log.
	 * Requires WP_DEBUG == true
	 */
	public function wp_mail_failed($wp_error)
	{
		return error_log(print_r($wp_error, true));
	}

	/**
	 * Wraps yoast breadcrumb separator for styling
	 */
	public function custom_separator($separator)
	{
		return '<span class="breadcrumb_separator">' . $separator . '</span>';
	}

	/*
	* Remove the last breadcrumb, the post title, from the Yoast SEO breadcrumbs
	* Previous breadcrumb will remain linked
	* Credit: David @ https://generatepress.com/forums/topic/how-to-hide-the-title-part-in-the-breadcrumb-im-using-yoast-seo/#post-614239
	* Last Tested: Apr 11 2020 using Yoast SEO 13.4.1 on WordPress 5.4
	*/
	public function remove_breadcrumb_title($link_output)
	{
		if (strpos($link_output, 'breadcrumb_last') !== false) {
			$link_output = '';
		}
		return $link_output;
	}
}

new Default_Reset_Functions();

define('CORE_FN_FOLDER', get_template_directory() . '/core/functions');
define('CORE_ACF_FOLDER', get_template_directory() . '/core/acf');
define('CORE_CPT_FOLDER', get_template_directory() . '/core/post-types');


include_once CORE_ACF_FOLDER . '/acf-setup.php';
include_once CORE_FN_FOLDER . '/theme.php';

/* Theme Setup | Custom Post Type */
include_once CORE_CPT_FOLDER . '/register.php'; // Functions that register custom post type/ taxonomies
include_once CORE_CPT_FOLDER . '/post-types.php';
include_once CORE_CPT_FOLDER . '/taxonomies.php';

/* Theme Setup | Functions */
include_once CORE_FN_FOLDER . '/acf-cf-contactform7.php';
include_once CORE_FN_FOLDER . '/menu-walker.php';
