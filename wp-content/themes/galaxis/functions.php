<?php
/**
 * Galaxis functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Galaxis
 */

define( 'GALAXIS_VERSION', wp_get_theme()->get( 'Version' ) );

if ( ! function_exists( 'galaxis_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 */
	function galaxis_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Galaxis, use a find and replace
		 * to change 'galaxis' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'galaxis', get_template_directory() . '/languages/' );

		// This theme uses wp_nav_menu() in three location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'galaxis' ),
				'footer' => esc_html__( 'Footer Menu', 'galaxis' ),
				'social' => esc_html__( 'Social Links Menu', 'galaxis' ),
			)
		);

		// Set content-width.
		$GLOBALS['content_width'] = apply_filters( 'galaxis_content_width', 740 );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 150,
				'width'       => 150,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'galaxis_custom_background_args',
				array( 'default-color' => 'f4f4f4' )
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for wide alignment.
		add_theme_support( 'align-wide' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );
	}
}
add_action( 'after_setup_theme', 'galaxis_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function galaxis_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Main Sidebar', 'galaxis' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'galaxis' ),
			'before_widget' => '<section id="%1$s" class="widget gx-card-content u-b-margin %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);
}
add_action( 'widgets_init', 'galaxis_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function galaxis_scripts() {
	// Enqueue Google Fonts.
	wp_enqueue_style( 'galaxis-fonts', galaxis_fonts_url(), array(), null );

	// Theme script.
	wp_enqueue_script( 'galaxis-script', get_template_directory_uri() . '/js/script.min.js', array(), GALAXIS_VERSION, true );

	// Theme stylesheet.
	wp_enqueue_style( 'galaxis-style', get_template_directory_uri() . '/style.min.css', array(), GALAXIS_VERSION );

	// Add output of customizer settings as inline style.
	wp_add_inline_style( 'galaxis-style', galaxis_get_customizer_css() );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'galaxis_scripts' );

/**
 * Register custom fonts.
 */
function galaxis_fonts_url() {
	$fonts_url = '';

	/*
	 * translators: If there are characters in your language that are not supported
	 * by Poppins or Muli, translate this to 'off'. Do not translate into your own language.
	 */
	$poppins = _x( 'on', 'Poppins font: on or off', 'galaxis' );
	$muli    = _x( 'on', 'Muli font: on or off', 'galaxis' );

	$font_families = array();

	if ( 'off' !== $poppins ) {
		$font_families[] = 'Poppins:400,400i';
	}

	if ( 'off' !== $muli ) {
		$font_families[] = 'Muli:500,500i,600,600i,700,700i';
	}

	$query_args = array(
		'family'  => rawurlencode( implode( '|', $font_families ) ),
		'display' => 'swap',
		'subset'  => rawurlencode( 'latin-ext' ),
	);

	$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

	return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts.
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function galaxis_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'galaxis-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'galaxis_resource_hints', 10, 2 );

/**
 * Layout functions.
 */
require get_template_directory() . '/inc/layout-functions.php';

/**
 * Main theme functions.
 */
require get_template_directory() . '/inc/theme-functions.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Theme defaults.
 */
require get_template_directory() . '/inc/defaults.php';

/**
 * Builds dynamic CSS class.
 */
require get_template_directory() . '/classes/class-galaxis-css.php';

/**
 * Custom CSS output.
 */
require get_template_directory() . '/inc/css-output.php';

/**
 * Upsell section class.
 */
require get_template_directory() . '/classes/class-galaxis-upsell-section.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * SVG Icons class.
 */
require get_template_directory() . '/classes/class-galaxis-svg-icons.php';

/**
 * SVG Icons related functions.
 */
require get_template_directory() . '/inc/icon-functions.php';

/**
 * Primary menu walker class.
 */
require get_template_directory() . '/classes/class-galaxis-primary-walker-nav-menu.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}
