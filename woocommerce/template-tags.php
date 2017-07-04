<?php
if ( ! function_exists( 'zack_woocommerce_change_hooks' ) ) :
function zack_woocommerce_change_hooks() {

	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
	add_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 35 );

	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
	add_action( 'woocommerce_after_single_product_summary', 'zack_woocommerce_output_upsells', 15 );

	remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );

	remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
	add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 5 );
	add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 15 );
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

	add_action( 'woocommerce_before_shop_loop_item_title', 'zack_woocommerce_loop_item_image', 10 );

	remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
	add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 5 );
	add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 15 );
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
}
endif;
add_action( 'after_setup_theme', 'zack_woocommerce_change_hooks' );

if( ! function_exists( 'zack_woocommerce_product_hooks' ) ) :
function zack_woocommerce_product_hooks() {
	if ( ! is_product() ) :
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
		add_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 8, 0 );
	endif;
}
endif;
add_action('template_redirect', 'zack_woocommerce_product_hooks' );

add_action( 'zack_woocommerce_quick_view_images', 'zack_woocommerce_quick_view_image', 5 );
add_action( 'zack_woocommerce_quick_view_title', 'woocommerce_template_single_title', 5 );
add_action( 'zack_woocommerce_quick_view_title', 'woocommerce_template_single_rating', 15 );
add_action( 'zack_woocommerce_quick_view_content', 'woocommerce_template_single_price', 10 );
add_action( 'zack_woocommerce_quick_view_content', 'woocommerce_template_single_excerpt', 15 );
add_action( 'zack_woocommerce_quick_view_content', 'woocommerce_template_single_add_to_cart', 20 );

if ( ! function_exists( 'zack_woocommerce_description_title' ) ) :
function zack_woocommerce_description_title() {
	return '';
}
endif;
add_filter( 'woocommerce_product_description_heading', 'zack_woocommerce_description_title' );

if ( ! function_exists( 'zack_woocommerce_loop_item_image' ) ) :
function zack_woocommerce_loop_item_image() { ?>
	<div class="loop-product-thumbnail">
		<?php woocommerce_template_loop_product_link_open(); ?>
		<?php woocommerce_template_loop_product_thumbnail(); ?>
		<?php woocommerce_template_loop_product_link_close(); ?>
		<?php woocommerce_template_loop_add_to_cart(); ?>
		<?php if ( atzack_setting( 'woocommerce_display_quick_view' ) ) {
			zack_woocommerce_quick_view_button();
		} ?>
	</div>
<?php }
endif;

if ( ! function_exists( 'zack_woocommerce_quick_view_button' ) ) :
function zack_woocommerce_quick_view_button() {
	global $product;
	echo '<a href="#" id="product-id-' . $product->get_id() . '" class="button product-quick-view-button" data-product-id="' . $product->get_id() . '">' . esc_html__( 'Quick View', 'zack') . '</a>';
}
endif;

if ( ! function_exists( 'zack_woocommerce_quick_view_image' ) ) :
function zack_woocommerce_quick_view_image() {
	echo woocommerce_get_product_thumbnail( 'shop_single' );
}
endif;

if ( ! function_exists( 'zack_woocommerce_quick_view' ) ) :
function zack_woocommerce_quick_view() { ?>
	<?php if ( atzack_setting( 'woocommerce_display_quick_view' ) ) : ?>
		<!-- WooCommerce Quick View -->
		<div id="quick-view-container">
			<div id="product-quick-view" class="quick-view"></div>
		</div>
	<?php endif; ?>
<?php }
endif;
add_action( 'wp_footer', 'zack_woocommerce_quick_view', 100 );

if ( ! function_exists( 'so_product_quick_view_ajax' ) ) :
function so_product_quick_view_ajax() {

	if ( ! isset( $_REQUEST['product_id'] ) ) {
		die();
	}
	$product_id = intval( $_REQUEST['product_id'] );

	wp( 'p=' . $product_id . '&post_type=product' );

	ob_start();

	wc_get_template( 'quick-view.php' );
	echo ob_get_clean();

	die();
}
endif;
add_action( 'wp_ajax_so_product_quick_view', 'so_product_quick_view_ajax' );
add_action( 'wp_ajax_nopriv_so_product_quick_view', 'so_product_quick_view_ajax' );
