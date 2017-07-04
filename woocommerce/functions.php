<?php
include get_template_directory() . '/woocommerce/template-tags.php';

function zack_woocommerce_setup() {
	add_theme_support( 'woocommerce' );

	add_theme_support( 'wc-product-gallery-slider' );

	if ( atzack_setting( 'woocommerce_product_gallery' ) == 'slider-lightbox' ) {
		add_theme_support( 'wc-product-gallery-lightbox' );
	}
	elseif ( atzack_setting( 'woocommerce_product_gallery' ) == 'slider-zoom' ) {
		add_theme_support( 'wc-product-gallery-zoom' );
	}
	elseif ( atzack_setting( 'woocommerce_product_gallery' ) == 'slider-lightbox-zoom' ) {
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-zoom' );
	}

	add_image_size( 'cart_item_image_size', 80, 80, true );

}
add_action( 'after_setup_theme', 'zack_woocommerce_setup' );

function zack_woocommerce_add_to_cart_text( $text ) {
	return $text;
}
add_filter( 'woocommerce_product_single_add_to_cart_text', 'zack_woocommerce_add_to_cart_text' );

function zack_woocommerce_enqueue_styles( $styles ) {
	$styles['unwind-woocommerce'] = array(
		'src' => get_template_directory_uri() . '/woocommerce/woocommerce.min.css',
		'deps' => array( 'woocommerce-layout', 'zack-style' ),
		'version' => ATZACK_THEME_VERSION,
		'media' => 'all'
	);

	return $styles;
}
add_filter( 'woocommerce_enqueue_styles', 'zack_woocommerce_enqueue_styles' );

function zack_woocommerce_enqueue_scripts() {
	if ( ! function_exists( 'is_woocommerce' ) ) return;

	if ( is_woocommerce() || is_cart() ) {
		wp_enqueue_script( 'zack-woocommerce', get_template_directory_uri() . '/js/woocommerce.js', array( 'jquery', 'wc-add-to-cart-variation' ), ATZACK_THEME_VERSION );

		$script_data = array(
			'chevron_down' => '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="10" height="10" viewBox="0 0 32 32"><path d="M30.054 14.429l-13.25 13.232q-0.339 0.339-0.804 0.339t-0.804-0.339l-13.25-13.232q-0.339-0.339-0.339-0.813t0.339-0.813l2.964-2.946q0.339-0.339 0.804-0.339t0.804 0.339l9.482 9.482 9.482-9.482q0.339-0.339 0.804-0.339t0.804 0.339l2.964 2.946q0.339 0.339 0.339 0.813t-0.339 0.813z"></path></svg>',
			'ajaxurl' => admin_url( 'admin-ajax.php' )
		);
		wp_localize_script( 'zack-woocommerce', 'so_unwind_data', $script_data );
	}
}
add_filter( 'wp_enqueue_scripts', 'zack_woocommerce_enqueue_scripts' );

if ( ! function_exists( 'zack_woocommerce_loop_shop_columns' ) ) :
function zack_woocommerce_loop_shop_columns() {
	return 3;
}
endif;
add_filter( 'loop_shop_columns', 'zack_woocommerce_loop_shop_columns' );

function zack_woocommerce_related_product_args( $args ) {
	$args['columns'] = 4;
	$args['posts_per_page'] = 4;
	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'zack_woocommerce_related_product_args' );

if ( ! function_exists( 'zack_woocommerce_output_upsells' ) ) :
function zack_woocommerce_output_upsells() {
	woocommerce_upsell_display( 4, 4 );
}
endif;

function zack_cart_item_thumbnail( $thumb, $cart_item, $cart_item_key ) {
	$product = wc_get_product( $cart_item['product_id'] );
	return $product->get_image( 'cart_item_image_size' );
}
add_filter( 'woocommerce_cart_item_thumbnail', 'zack_cart_item_thumbnail', 10, 3 );

function zack_woocommerce_tag_cloud_widget() {
	$args['unit'] = 'px';
	$args['largest'] = 12;
	$args['smallest'] = 12;
	$args['taxonomy'] = 'product_tag';
	return $args;
}
add_filter( 'woocommerce_product_tag_cloud_widget_args', 'zack_woocommerce_tag_cloud_widget' );

if ( ! function_exists( 'zack_woocommerce_update_cart_count' ) ) :
function zack_woocommerce_update_cart_count( $fragments ) {
	ob_start();
	?>
	<span class="shopping-cart-count"><?php echo WC()->cart->cart_contents_count;?></span>
	<?php

	$fragments['span.shopping-cart-count'] = ob_get_clean();

	return $fragments;
}
endif;
add_filter( 'add_to_cart_fragments', 'zack_woocommerce_update_cart_count' );

if ( ! function_exists( 'zack_wc_columns' ) ) :
function zack_wc_columns() {
	return atzack_setting( 'woocommerce_archive_columns' );
}
endif;
add_filter( 'loop_shop_columns', 'zack_wc_columns' );
