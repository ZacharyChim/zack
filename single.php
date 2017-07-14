<?php get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();

			if ( has_post_format( array( 'video', 'image' ) ) ) {
				get_template_part( 'template-parts/content', get_post_format() );
			} else {
				get_template_part( 'template-parts/content', 'single' );
			}

			if ( zacklive_setting( 'blog_display_author_box' ) ) :
				zack_author_box();
			endif;

			if ( ! is_attachment() && zacklive_setting( 'blog_display_related_posts' ) ) :
				zack_related_posts( $post->ID );
			endif;

			if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'sharedaddy'  )  && function_exists( 'sharing_display' ) ) : ?>
				<h2 class="share-this heading-strike"><?php esc_html_e( 'Share This', 'zack' ); ?></h2>
				<?php echo sharing_display();
			endif;

			if ( zacklive_setting( 'navigation_post' ) ) :
				zack_the_post_navigation();
			endif;

			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
