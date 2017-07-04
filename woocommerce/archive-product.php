<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

	<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

		<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>

	<?php endif; ?>

	<?php
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php
			do_action( 'woocommerce_archive_description' );
		?>

		<?php if ( have_posts() ) : ?>

			<?php
				do_action( 'woocommerce_before_shop_loop' );
			?>

			<?php woocommerce_product_loop_start(); ?>

				<?php woocommerce_product_subcategories(); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						do_action( 'woocommerce_shop_loop' );
					?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php
				do_action( 'woocommerce_after_shop_loop' );
			?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php do_action( 'woocommerce_no_products_found' ); ?>

		<?php endif; ?>

	<?php
		do_action( 'woocommerce_after_main_content' );
	?>

	<?php
		do_action( 'woocommerce_sidebar' );
	?>

<?php get_footer( 'shop' ); ?>
