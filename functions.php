<?php
/**
 * bradusach functions and definitions
 *
 * @package bradusach
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'bradusach_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function bradusach_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on bradusach, use a find and replace
	 * to change 'bradusach' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'bradusach', get_template_directory() . '/languages' );

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
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'bradusach' ),
		'social' => __ ( 'social menu', 'bradusach'),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
// 	add_theme_support( 'custom-background', apply_filters( 'bradusach_custom_background_args', array(
// 		'default-color' => 'ffffff',
// 		'default-image' => '',
// 	) ) );
}
endif; // bradusach_setup
add_action( 'after_setup_theme', 'bradusach_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function bradusach_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'bradusach' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'bradusach_widgets_init' );

/**
 * Enqueue scripts and styles. Allows googlefont and fontawesome to be used
 */
function bradusach_scripts() {

	wp_enqueue_style( 'bradusach-style', get_stylesheet_uri() );
	
	wp_enqueue_style( 'bradusach-content-sidebar', get_template_directory_uri() . '/layouts/content-sidebar.css' );
	
	/**
 * enques the sidebar widget that includes the calendar and recent posts. takes css stylign from content sidebare.css
 */	
	
	wp_enqueue_style( 'bradusach-google-fonts', 'https://fonts.googleapis.com/css?family=Lato:300,400|PT+Serif|Maven+Pro:400,700' );
	
	/**
 * allows us to use google fonts, lato font family
 */	
	
	wp_enqueue_style( 'bradusach-fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' );

/**
 * enques the font family combinations we selected on google fonts
 */	
	wp_enqueue_script( 'bradusach-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'bradusach-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'bradusach_scripts' );

/**
 * Implement the Custom Header feature. we had to enable this to have a cutom header image!
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

include (TEMPLATEPATH . '/myGallery/gallery_functions_include.php');
