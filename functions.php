<?php
define('ZACKLIVE_THEME_VERSION', '1.0.2');
define('ZACKLIVE_THEME_JS_PREFIX', '.min');

require get_template_directory() . '/inc/extras.php';
require get_template_directory() . '/inc/settings/settings.php';
require get_template_directory() . '/inc/settings.php';
require get_template_directory() . '/inc/template-tags.php';

if ( ! function_exists( 'zack_setup' ) ) :
function zack_setup() {
	load_theme_textdomain( 'zack', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo' );

	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'zack' ),
	) );

	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	add_theme_support( 'post-formats', array(
		'image',
		'video',
	) );

	add_image_size( 'zack-263x174-crop', 263, 174, true );
	add_image_size( 'zack-360x238-crop', 360, 238, true );

	add_theme_support( 'custom-background', apply_filters( 'zack_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	add_filter( 'term_description', 'shortcode_unautop' );
	add_filter( 'term_description', 'do_shortcode' );

	add_theme_support( 'zacklive-template-settings' );

}
endif; // zack_setup.
add_action( 'after_setup_theme', 'zack_setup' );

function zack_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'zacklive_uwnind_content_width', 1140 );
}
add_action( 'after_setup_theme', 'zack_content_width', 0 );

function zack_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'zack' ),
		'id'            => 'main-sidebar',
		'description'   => esc_html__( 'Visible on posts and pages that use the Default or Full Width, With Sidebar layout.', 'zack' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title heading-strike">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'zack' ),
		'id'            => 'footer-sidebar',
		'description'   => esc_html__( 'A column will be automatically assigned to each widget inserted', 'zack' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title heading-strike">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Masthead', 'zack' ),
		'id'            => 'masthead-sidebar',
		'description'   => esc_html__( 'Replaces the logo and description.', 'zack' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title heading-strike">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'zack_widgets_init' );

function zack_scripts() {
	wp_enqueue_style( 'zack-style', get_template_directory_uri() . '/style.min.css', array(), ZACKLIVE_THEME_VERSION );

	if ( ! class_exists( 'Jetpack' ) ) {
		wp_enqueue_script( 'jquery-fitvids', get_template_directory_uri() . '/js/jquery.fitvids' . ZACKLIVE_THEME_JS_PREFIX . '.js', array( 'jquery' ), 1.1, true );
	}

	wp_enqueue_script( 'zack-script', get_template_directory_uri() . '/js/zack' . ZACKLIVE_THEME_JS_PREFIX . '.js', array( 'jquery' ), ZACKLIVE_THEME_VERSION, true );

	wp_enqueue_script( 'zack-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'zack_scripts' );

if ( ! function_exists( 'zack_post_class_filter' ) ) :
function zack_post_class_filter( $classes ) {
	$classes[] = 'post';

	if ( is_page() ) {
		$class_key = array_search( 'hentry', $classes );

		if ( $class_key !== false) {
			unset( $classes[ $class_key ] );
		}
	}

	$classes = array_unique( $classes );
	return $classes;
}
endif;
add_filter( 'post_class', 'zack_post_class_filter' );
