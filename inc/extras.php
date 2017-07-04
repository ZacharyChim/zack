<?php
if ( ! function_exists( 'zack_body_classes' ) ) :
function zack_body_classes( $classes ) {
	$classes[] = 'css3-animations';

	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	function zack_pingback_header() {
		if ( is_singular() && pings_open() ) {
			echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
		}
	}
	add_action( 'wp_head', 'zack_pingback_header' );

	if ( is_home() && atzack_setting( 'blog_featured_slider' ) && zack_has_featured_posts() ) {
		$classes[] = 'homepage-has-slider';
	}

	if ( wp_is_mobile() ) {
		$classes[] = 'is_mobile';
	}

	$classes[] = 'no-js';

	if ( ! is_active_sidebar( 'main-sidebar' ) ) {
		$classes[] = 'no-active-sidebar';
	}
	if ( function_exists( 'is_woocommerce' ) && ! is_active_sidebar( 'shop-sidebar' ) ) {
		$classes[] = 'no-active-wc-sidebar';
	}

	$page_settings = atzack_page_setting();

	if ( ! empty( $page_settings ) ) {
		if ( ! empty( $page_settings['layout'] ) ) $classes[] = 'page-layout-' . $page_settings['layout'];
		if ( empty( $page_settings['masthead_margin'] ) ) $classes[] = 'page-layout-no-masthead-margin';
		if ( empty( $page_settings['footer_margin'] ) ) $classes[] = 'page-layout-no-footer-margin';
		if ( empty( $page_settings['masthead'] ) ) $classes[] = 'page-layout-hide-masthead';
		if ( empty( $page_settings['footer_widgets'] ) ) $classes[] = 'page-layout-hide-footer-widgets';
	}

	if ( atzack_setting( 'navigation_sticky' ) ) {
		$classes[] = 'sticky-menu';
	}

	if ( atzack_setting( 'layout_main_sidebar' ) == 'left' && is_active_sidebar( 'main-sidebar' ) ) {
		$classes[] = 'main-sidebar-left';
	}

	if ( function_exists( 'is_woocommerce' ) && atzack_setting( 'woocommerce_shop_sidebar' ) == 'right' && is_active_sidebar( 'shop-sidebar' ) ) {
		$classes[] = 'shop-sidebar-right';
	}

	if ( atzack_setting( 'woocommerce_archive_columns' ) ) {
		$classes[] = 'wc-columns-' . atzack_setting( 'woocommerce_archive_columns' );
	}

	return $classes;
}
endif;
add_filter( 'body_class', 'zack_body_classes' );

if ( ! function_exists( 'zack_excerpt_read_more' ) ) :
function zack_excerpt_read_more( $more ) {
    return '...';
}
endif;
add_filter( 'excerpt_more', 'zack_excerpt_read_more' );

//jetpack
function zack_jetpack_setup() {
	add_theme_support( 'jetpack-responsive-videos' );
}
add_action( 'after_setup_theme', 'zack_jetpack_setup' );
 function zack_remove_share() {
    remove_filter( 'the_content', 'sharing_display', 19 );
    remove_filter( 'the_excerpt', 'sharing_display', 19 );
    if ( class_exists( 'Jetpack_Likes' ) ) {
        remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
    }
}
add_action( 'loop_start', 'zack_remove_share' );
