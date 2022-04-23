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
			'comment_text',
			'comment_excerpt',
			'acf/format_value'
		);
		// add_action( 'admin_init', array( $this, 'theme_admin_init' ) );
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
		// add_action('init', array( $this, 'remove_comment_support' ), 100);
		// add_action( 'admin_menu', array( $this, 'remove_comment_admin_menu' ), 100);
		// add_action( 'wp_before_admin_bar_render', array( $this, 'remove_comment_admin_bar' ), 100);
		//remove_action('wp_head', array($this, 'feed_links_extra'), 3);
		//remove_action('wp_head', array($this, 'feed_links'), 2);
		add_action('after_setup_theme', array($this, 'theme_setup'));
		// add_action( 'admin_post_thumbnail_html', array( $this, 'add_featured_image_instruction' ), 10, 3 );
		add_action('get_header', array($this, 'wp_maintenance_mode'));
		add_action('allowed_block_types', array($this, 'allowed_block_types'), 10, 2);
		add_action('wp_default_scripts', array($this, 'remove_jquery_migrate'));
		add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
		//add_action('acf/save_post', array($this, 'save_post'), 20);
		add_action('wp_mail_failed', array($this, 'wp_mail_failed'), 10, 1);
		//add_action('template_redirect', array($this, 'template_redirect'));
		//add_action('pre_get_posts', array($this, 'pre_get_posts'));
		add_action('admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );


		remove_filter('the_title', 'wptexturize');
		remove_filter('the_content', 'wptexturize');
		remove_filter('the_excerpt', 'wptexturize');

		// add_filter( 'query_vars', array( $this, 'query_vars' ) );
		add_filter('tiny_mce_plugins', array($this, 'disable_emojis_tinymce'));
		add_filter('wp_resource_hints', array($this, 'disable_emojis_remove_dns_prefetch'), 10, 2);
		add_filter('run_wptexturize', '__return_false');
		// add_filter( 'the_title', array( $this, 'fix_curly_quotes' ), 10, 1 );
		// add_filter( 'the_content', array( $this, 'fix_curly_quotes' ), 10, 1 );
		// add_filter( 'the_excerpt', array( $this, 'fix_curly_quotes' ), 10, 1 );
		// add_filter( 'wp_insert_post_data', array( $this, 'modify_post_data' ), 99, 1 );
		add_filter('the_excerpt', array($this, 'the_excerpt'), 21);
		add_filter('excerpt_more', array($this, 'excerpt_more'), 21);
		add_filter('wpcf7_form_elements', array($this, 'wpcf7_form_elements'));
		add_action('init',array($this, 'wpbfm_wpcf7_file_upload'));
		//add_filter('content_edit_pre', array($this, 'content_edit_pre'), 10, 2);
		//add_filter('load-post-new.php', array($this, 'load_post_new'));
		//add_filter('admin_head-post.php', array($this, 'admin_head_post'));
		//add_filter('post_type_link', array($this, 'post_type_link'), 1, 3);

		add_filter( 'wpseo_breadcrumb_separator', array($this, 'custom_separator'), 10, 1);
		add_filter('wpseo_breadcrumb_single_link', array($this, 'remove_breadcrumb_title'), 10, 1 );

		if (!defined('EAE_FILTER_PRIORITY')) {
			define('EAE_FILTER_PRIORITY', 1000);
		}
		foreach ($email_encoder_filters as $filter) {
			add_filter($filter, array($this, 'eae_encode_emails'), EAE_FILTER_PRIORITY);
		}
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
	 * Removes editors and customizers
	 */
	public function theme_admin_init()
	{
		global $submenu;
		unset($submenu['themes.php'][6]); // remove sub menu Customize
		// unset( $submenu['themes.php'][7] ); // remove sub menu Widgets
		unset($submenu['themes.php'][15]); // remove sub menu Header
		unset($submenu['themes.php'][11]); // remove sub menu Editor
		unset($submenu['plugins.php'][15]); // remove sub menu Editor
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
	 * Removes page comment support.
	 */
	function remove_comment_support()
	{
		remove_post_type_support('post', 'comments');
		remove_post_type_support('page', 'comments');
	}

	/**
	 * Removes page comment admin option.
	 */
	function remove_comment_admin_menu()
	{
		remove_menu_page('edit-comments.php');
	}

	/**
	 * Removes page comment admin option.
	 */
	function remove_comment_admin_bar()
	{
		global $wp_admin_bar;
		$wp_admin_bar->remove_menu('comments');
	}

	/**
	 * Message when somebody tries to access to rss
	 */
	public function default_disable_feed()
	{
		wp_die(('No feed available, please visit the <a href="' . esc_url(home_url('/')) . '">homepage</a>!'));
	}

	/**
	 * Searches for plain email addresses in given $string and
	 * encodes them (by default) with the help of eae_encode_str().
	 *
	 * Regular expression is based on based on John Gruber's Markdown.
	 * http://daringfireball.net/projects/markdown/
	 *
	 * @param string $string Text with email addresses to encode
	 *
	 * @return string $string Given text with encoded email addresses
	 */
	public function eae_encode_emails($string)
	{

		// abort if `$string` isn't a string
		if (!is_string($string)) {
			return $string;
		}

		// abort if `eae_at_sign_check` is true and `$string` doesn't contain a @-sign
		if (apply_filters('eae_at_sign_check', true) && strpos($string, '@') === false) {
			return $string;
		}

		// override encoding function with the 'eae_method' filter
		$method = apply_filters('eae_method', 'eae_encode_str');

		// override regex pattern with the 'eae_regexp' filter
		$regexp = apply_filters(
			'eae_regexp',
			'{
			(?:mailto:)?
			(?:
				[-!#$%&*+/=?^_`.{|}~\w\x80-\xFF]+
			|
				".*?"
			)
			\@
			(?:
				[-a-z0-9\x80-\xFF]+(\.[-a-z0-9\x80-\xFF]+)*\.[a-z]+
			|
				\[[\d.a-fA-F:]+\]
			)
		}xi'
		);
		return preg_replace_callback(
			$regexp,
			// create_function(
			// 	'$matches',
			// 	'return ' . $method . '($matches[0]);'
			// ),
			array($this, 'eae_encode_str'),
			$string
		);
	}

	/**
	 * Encodes each character of the given string as either a decimal
	 * or hexadecimal entity, in the hopes of foiling most email address
	 * harvesting bots.
	 *
	 * Based on Michel Fortin's PHP Markdown:
	 *   http://michelf.com/projects/php-markdown/
	 * Which is based on John Gruber's original Markdown:
	 *   http://daringfireball.net/projects/markdown/
	 * Whose code is based on a filter by Matthew Wickline, posted to
	 * the BBEdit-Talk with some optimizations by Milian Wolff.
	 *
	 * @param string $string Text with email addresses to encode
	 *
	 * @return string $string Given text with encoded email addresses
	 */
	public function eae_encode_str($string)
	{
		$string = $string[0];
		$chars = str_split($string);
		$seed  = mt_rand(0, (int) abs(crc32($string) / strlen($string)));
		foreach ($chars as $key => $char) {
			$ord = ord($char);
			if ($ord < 128) { // ignore non-ascii chars
				$r = ($seed * (1 + $key)) % 100; // pseudo "random function"
				if ($r > 60 && $char != '@') {;
				} // plain character (not encoded), if not @-sign
				else if ($r < 45) {
					$chars[$key] = '&#x' . dechex($ord) . ';';
				} // hexadecimal
				else {
					$chars[$key] = '&#' . $ord . ';';
				} // decimal (ascii)
			}
		}
		return implode('', $chars);
	}

	/**
	 * Change curly quotes to straight quotes
	 */
	function fix_curly_quotes($text)
	{
		// $text = htmlspecialchars($text);

		$curly_single_quotes = array('‘', '’', '&lsquo;', '&rsquo;');
		$curly_double_quotes = array('“', '”', '&ldquo;', '&rdquo;');

		$text = str_replace($curly_single_quotes, '\'', $text);
		$text = str_replace($curly_double_quotes, '"', $text);

		return $text;
	}

	/**
	 * Apply fix_curly_quotes on post create/modify
	 */
	function modify_post_data($data)
	{
		$data['post_title'] =  $this->fix_curly_quotes($data['post_title']);
		$data['post_content'] =  $this->fix_curly_quotes($data['post_content']);

		return $data;
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
			'main-nav'           => __('Main Nav', 'dra'),
			'user-nav'           => __('User Nav', 'dra'),
			'footer'          => __('Footer', 'dra'),
			'privacy-terms-nav'  => __('Privacy Policy and Terms Nav', 'dra'),
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
		add_image_size('homepage-category',456,324,true);
		add_image_size('homepage-culture', 820, 520, true);
		add_image_size('homepage-testimonial',820,520,true);
		add_image_size('bg-image-banner', 1920, 475, true);
		add_image_size('company-statement', 1920, 665, true);
		add_image_size('company-staff',290,217,true);
		add_image_size('company-culture',590,392,true);
		add_image_size('sets-apart-banner',1420,435,true);
		add_image_size('news-featured-image',1200,548,true);
		add_image_size('news-featured-logo',182,85,true);
		add_image_size('news-image',342,257,true);
		add_image_size('career-intro-banner',1200,800,true);
		add_image_size('card-image',497,346,true);
		add_image_size('product-image',306,230,true);
		add_image_size('portfolio-image',577,520,true);
		add_image_size('sustainability-image',456,324,true);
		add_image_size('gallery-image',820,520,true);






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

		// Update core/table render block
		register_block_type(
			'core/table',
			array(
				'render_callback' => array($this, 'gb_table_block_render'),
			)
		);

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

	/**
	 * admin_enqueue_scripts
	 */
	public function admin_enqueue_scripts()
	{
		/*
		wp_enqueue_style('editor-style',
			get_template_directory_uri() . '/assets/dist/css/editor.css',
			array(),
			filemtime(get_stylesheet_directory() . '/assets/dist/css/editor.css'));
		*/
	}

	/**
	 * Filter function used to remove the tinymce emoji plugin.
	 *
	 * @param array $plugins
	 * @return array Difference betwen the two arrays
	 */
	public function disable_emojis_tinymce($plugins)
	{
		if (is_array($plugins)) {
			return array_diff($plugins, array('wpemoji'));
		} else {
			return array();
		}
	}

	/**
	 * Remove emoji CDN hostname from DNS prefetching hints.
	 *
	 * @param array $urls URLs to print for resource hints.
	 * @param string $relation_type The relation type the URLs are printed for.
	 * @return array Difference betwen the two arrays.
	 */
	public function disable_emojis_remove_dns_prefetch($urls, $relation_type)
	{
		if ('dns-prefetch' == $relation_type) {
			/** This filter is documented in wp-includes/formatting.php */
			$emoji_svg_url = apply_filters('emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/');
			$urls = array_diff($urls, array($emoji_svg_url));
		}
		return $urls;
	}

	public function add_featured_image_instruction($content, $thumbnail_id = null, $post = null)
	{
		$post = get_post($post);
		if ($post->post_type === 'product') {
			//return $content .= '<p>Recommended size: 265x425</p>';
		}

		return $content;
	}

	// Activate WordPress Maintenance Mode
	public function wp_maintenance_mode()
	{
		if ( defined('WP_MAINTENANCE') && WP_MAINTENANCE ) {
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
			'acf/bgimage-content-banner',
			'acf/our-company-our-team',
			'acf/our-company-our-culture',
			'acf/bgcolor-content',
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
			'acf/cms-special-text',
			'acf/cms-group',
			'acf/cms-image-banner',




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
			'wpbfmjs', array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
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
			'name'          => __('Main Sidebar', 'dra'),
			'id'            => 'sidebar-1',
			'description'   => __('Widgets in this area will be shown on all posts and pages.', 'dra'),
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

	// replace cf7 form submit with button
	public function wpbfm_wpcf7_file_upload() {
		if(function_exists('wpcf7_remove_form_tag')) {
			wpcf7_remove_form_tag('file');
			wpcf7_remove_form_tag('file*');
			//remove_action( 'admin_init', 'wpcf7_add_tag_generator_file', 55 );

			$bfm_cf7_module = TEMPLATEPATH . '/cf7/file.php';
            require_once $bfm_cf7_module;
		}
	}

	/**
	 * Stores wp_mail errors in debug.log.
	 * Requires WP_DEBUG == true
	 */
	public function wp_mail_failed( $wp_error )
	{
		return error_log(print_r($wp_error, true));
	}

	/**
	 * Wraps yoast breadcrumb separator for styling
	 */
	public function custom_separator( $separator ) {
		return '<span class="breadcrumb_separator">' . $separator . '</span>';
	}

	/*
	* Remove the last breadcrumb, the post title, from the Yoast SEO breadcrumbs
	* Previous breadcrumb will remain linked
	* Credit: David @ https://generatepress.com/forums/topic/how-to-hide-the-title-part-in-the-breadcrumb-im-using-yoast-seo/#post-614239
	* Last Tested: Apr 11 2020 using Yoast SEO 13.4.1 on WordPress 5.4
	*/
	public function remove_breadcrumb_title( $link_output) {
		if(strpos( $link_output, 'breadcrumb_last' ) !== false ) {
			$link_output = '';
		}
		return $link_output;
	}
}

new Default_Reset_Functions();

define( 'CORE_FN_FOLDER', get_template_directory() . '/core/functions' );
define( 'CORE_ACF_FOLDER', get_template_directory() . '/core/acf' );
define( 'CORE_CPT_FOLDER', get_template_directory() . '/core/post-types' );


include_once CORE_ACF_FOLDER . '/acf-setup.php';
include_once CORE_FN_FOLDER . '/theme.php';

/* Theme Setup | Custom Post Type */
include_once CORE_CPT_FOLDER . '/register.php'; // Functions that register custom post type/ taxonomies
include_once CORE_CPT_FOLDER . '/post-types.php';
include_once CORE_CPT_FOLDER . '/taxonomies.php';

/* Theme Setup | Functions */
include_once CORE_FN_FOLDER . '/acf-cf-contactform7.php';
include_once CORE_FN_FOLDER . '/cron.php';
include_once CORE_FN_FOLDER . '/format-phone.php';
include_once CORE_FN_FOLDER . '/menu-walker.php';
