<?php

// if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

while ( have_posts() ) : the_post();

	global $post, $product;

	if ( ! function_exists( 'zack_woocommerce_quick_view_class' ) ) :
	function zack_woocommerce_quick_view_class( $classes ) {
		$classes[] = "product-quick-view";
		return $classes;
	}
	endif;
	add_filter( 'post_class', 'zack_woocommerce_quick_view_class' );

	?>
	<div id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="product-content-wrapper">
			<div class="product-image-wrapper">
				<?php do_action( 'zack_woocommerce_quick_view_images' ); ?>
			</div>

			<div class="product-info-wrapper">

				<a href="<?php the_permalink(); ?>">
					<?php
					do_action( 'zack_woocommerce_quick_view_title' );
					?>
				</a>

				<?php do_action( 'zack_woocommerce_quick_view_content' ); ?>

			</div>

			<span class="quickview-close-icon">+</span>

		</div>

	</div>

<?php endwhile;
