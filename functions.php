 */
if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	require trailingslashit( get_template_directory() ) . 'inc/back-compat.php';
}

if ( ! function_exists( 'highresponsive_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *

 */
function highresponsive_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/highresponsive
	 * If you're building a theme based on High Responsive, use a find and replace
	 * to change 'highresponsive' to the name of your theme in all the template files
	 */
	load_theme_textdomain('highresponsive', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */

	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 100,
		'flex-height' => true,
		'flex-width' => true,
	) );


	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1068, 567, true );
	add_image_size( 'highresponsive-slider', 1920, 1080, true );
	add_image_size( 'highresponsive-featured', 666, 666, true );
	add_image_size( 'highresponsive-testimonial', 150, 150, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'menu-1'                => esc_html__( 'Primary Menu', 'highresponsive' ),
		'social-top'            => esc_html__( 'Social Top Menu', 'highresponsive' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'status',
		'audio',
		'chat',
	) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'assets/css/editor-style.css', highresponsive_fonts_url() ) );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif; // highresponsive_setup
add_action( 'after_setup_theme', 'highresponsive_setup' );

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *

 */
function highresponsive_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'highresponsive_content_width', 1037 );
}
add_action( 'after_setup_theme', 'highresponsive_content_width', 0 );

/**
 * Registers a widget area.

 */
function highresponsive_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'highresponsive' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'highresponsive' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'highresponsive' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'highresponsive' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'highresponsive' ),
		'id'            => 'sidebar-3',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'highresponsive' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'highresponsive' ),
		'id'            => 'sidebar-4',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'highresponsive' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'highresponsive_widgets_init' );

/**

 */
function highresponsive_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'sidebar-2' ) ) {
		$count++;
	}

	if ( is_active_sidebar( 'sidebar-3' ) ) {
		$count++;
	}

	if ( is_active_sidebar( 'sidebar-4' ) ) {
		$count++;
	}

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one';
			break;
		case '2':
			$class = 'two';
			break;
		case '3':
			$class = 'three';
			break;
	}

	if ( $class )
		echo 'class="widget-area footer-widget-area ' . $class . '"';
}

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.

 */
function highresponsive_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'highresponsive_javascript_detection', 0 );


if ( ! function_exists( 'highresponsive_fonts_url' ) ) :
/**

 */
function highresponsive_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Lato, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Lato font: on or off', 'highresponsive' ) ) {
		$fonts[] = 'Lato:300,400,700,900,300italic,400italic,700italic,900italic';
	}

	/* translators: If there are characters in your language that are not supported by Playfair Display, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Playfair Display font: on or off', 'highresponsive' ) ) {
		$fonts[] = 'Playfair Display:400,700,900,400italic,700italic,900italic';
	}

	/* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'highresponsive' ) ) {
		$fonts[] = 'Inconsolata:400';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * Enqueues scripts and styles.
 *
 */
function highresponsive_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'highresponsive-fonts', highresponsive_fonts_url(), array(), null );


	wp_enqueue_style( 'highresponsive-style', get_stylesheet_uri() );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'highresponsive-ie', get_template_directory_uri() . '/assets/css/ie.css', array( 'highresponsive-style' ), '20160816' );
	wp_style_add_data( 'highresponsive-ie', 'conditional', 'lt IE 10' );

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'highresponsive-ie8', get_template_directory_uri() . '/assets/css/ie8.css', array( 'highresponsive-style' ), '20160816' );
	wp_style_add_data( 'highresponsive-ie8', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'highresponsive-ie7', get_template_directory_uri() . '/assets/css/ie7.css', array( 'highresponsive-style' ), '20160816' );
	wp_style_add_data( 'highresponsive-ie7', 'conditional', 'lt IE 8' );

	// Load the html5 shiv.
	wp_enqueue_script( 'highresponsive-html5', get_template_directory_uri() . '/assets/js/html5.min.js', array(), '3.7.3' );
	wp_script_add_data( 'highresponsive-html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'highresponsive-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.min.js', array(), '20160816', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'highresponsive-keyboard-image-navigation', get_template_directory_uri() . '/assets/js/keyboard-image-navigation.min.js', array( 'jquery' ), '20160816' );
	}

 	wp_register_script( 'jquery-match-height', get_template_directory_uri() . '/assets/js/jquery.matchHeight.min.js', array( 'jquery' ), '20151215', true );

	wp_enqueue_script( 'highresponsive-script', get_template_directory_uri() . '/assets/js/functions.min.js', array( 'jquery', 'jquery-match-height' ), '20160816', true );

	wp_localize_script( 'highresponsive-script', 'screenReaderText', array(
		'expand'   => __( 'expand child menu', 'highresponsive' ),
		'collapse' => __( 'collapse child menu', 'highresponsive' ),
		'icon'     => highresponsive_get_svg( array(
			'icon'     => 'angle-down',
			'fallback' => true,
		) ),
	) );

	//Slider Scripts
	$enable_slider = get_theme_mod( 'highresponsive_slider_option', 'disabled' );
	$enable_testimonial = get_theme_mod( 'highresponsive_testimonial_option', 'homepage' );

	if ( highresponsive_check_section( $enable_slider ) || highresponsive_check_section( $enable_testimonial ) ) {
		wp_enqueue_script( 'jquery-cycle2', get_template_directory_uri() . '/assets/js/jquery.cycle/jquery.cycle2.min.js', array( 'jquery' ), '2.1.5', true );

		$transition_effects = array(
			get_theme_mod( 'highresponsive_slider_transition_effects', 'fade' ),
		);

		/**
		 * Condition checks for additional slider transition plugins
		 */
		// Scroll Vertical transition plugin addition.
		if ( in_array( 'scrollVert', $transition_effects, true ) ) {
			wp_enqueue_script( 'jquery-cycle2-scrollVert', get_template_directory_uri() . '/assets/js/jquery.cycle/jquery.cycle2.scrollVert.min.js', array( 'jquery-cycle2' ), '2.1.5', true );
		}

		// Flip transition plugin addition.
		if ( in_array( 'flipHorz', $transition_effects, true ) || in_array( 'flipVert', $transition_effects, true ) ) {
			wp_enqueue_script( 'jquery-cycle2-flip', get_template_directory_uri() . '/assets/js/jquery.cycle/jquery.cycle2.flip.min.js', array( 'jquery-cycle2' ), '2.1.5', true );
		}

		// Shuffle transition plugin addition.
		if ( in_array( 'tileSlide', $transition_effects, true ) || in_array( 'tileBlind', $transition_effects, true ) ) {
			wp_enqueue_script( 'jquery-cycle2-tile', get_template_directory_uri() . '/assets/js/jquery.cycle/jquery.cycle2.tile.min.js', array( 'jquery-cycle2' ), '2.1.5', true );
		}

		// Shuffle transition plugin addition.
		if ( in_array( 'shuffle', $transition_effects, true ) ) {
			wp_enqueue_script( 'jquery-cycle2-shuffle', get_template_directory_uri() . '/assets/js/jquery.cycle/jquery.cycle2.shuffle.min.js', array( 'jquery-cycle2' ), '2.1.5', true );
		}
	}

	// Enqueue fitvid if JetPack is not installed.
	if ( ! class_exists( 'Jetpack' ) ) {
		wp_enqueue_script( 'jquery-fitvids', get_template_directory_uri() . '/assets/js/fitvids.min.js', array( 'jquery' ), '1.1', true );
	}

}
add_action( 'wp_enqueue_scripts', 'highresponsive_scripts' );

/**
 * Converts a HEX value to RGB.
 *

 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function highresponsive_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
	} else if ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( 'inc/template-tags.php' );

/**
 * Customizer additions.
 */
require get_parent_theme_file_path( 'inc/customizer/customizer.php' );

/**
 * Include Header Background Color Options
 */
require get_parent_theme_file_path( 'inc/header-background-color.php' );

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path( 'inc/icon-functions.php' );

/**
 * Custom functions that act independently of the theme templates.
 */
require get_parent_theme_file_path( 'inc/extras.php' );

/**
 * Load Jetpack compatibility file.
 */
require get_parent_theme_file_path( 'inc/jetpack.php' );

/**
 * Include Breadcrumb
 */
require get_parent_theme_file_path( '/inc/breadcrumb.php' );

/**
 * Include Slider
 */
require get_parent_theme_file_path( '/inc/featured-slider.php' );

/**
 * Include Service
 */
require get_parent_theme_file_path( '/inc/service.php' );

/**
 * Add Metaboxes
 */
require get_parent_theme_file_path( 'inc/metabox/metabox.php' );

/**
 * Include the TGM_Plugin_Activation class.
 */
require get_parent_theme_file_path( '/inc/class-tgm-plugin-activation.php' );

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function highresponsive_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		// Essential Content types.
		array(
			'name' => 'Essential Content Types',
			'slug' => 'essential-content-types',
		),
		// To Top.
		array(
			'name' => 'To top',
			'slug' => 'to-top',
		),
		// Catch Web Tools.
		array(
			'name' => 'Catch Web Tools',
			'slug' => 'catch-web-tools',
		),
		// Catch Instagram Feed Gallery Widget.
		array(
			'name' => 'Catch Instagram Feed Gallery & Widget',
			'slug' => 'catch-instagram-feed-gallery-widget',
		),
	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'highresponsive',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'highresponsive_register_required_plugins' );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images

 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function highresponsive_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	840 <= $width && $sizes = '(max-width: 709px) 94vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';

	if ( 'page' === get_post_type() ) {
		840 > $width && $sizes = '(max-width: ' . $width . 'px) 94vw, ' . $width . 'px';
	} else {
		840 > $width && 600 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
		600 > $width && $sizes = '(max-width: ' . $width . 'px) 94vw, ' . $width . 'px';
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'highresponsive_content_image_sizes_attr', 10 , 2 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *

 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function highresponsive_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( 'post-thumbnail' === $size ) {
		is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 94vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
		! is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 94vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'highresponsive_post_thumbnail_sizes_attr', 10 , 3 );

/**
 * Modifies tag cloud widget arguments to have all tags in the widget same font size.

 *
 * @param array $args Arguments for tag cloud widget.
 * @return array A new modified arguments.
 */
function highresponsive_widget_tag_cloud_args( $args ) {
	$args['largest'] = 1;
	$args['smallest'] = 1;
	$args['unit'] = 'em';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'highresponsive_widget_tag_cloud_args' );
