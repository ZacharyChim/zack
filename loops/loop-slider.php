<?php
wp_enqueue_style( 'zack-flexslider' );
wp_enqueue_script( 'jquery-flexslider' );

if ( have_posts() ) : ?>

	<div class="flexslider featured-posts-slider">
		<ul class="slides featured-posts-slides">

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
			<?php $thumbnail = has_post_thumbnail() ? wp_get_attachment_url( get_post_thumbnail_id() ) : false; ?>

				<li class="featured-post-slide" <?php if ( ! empty( $thumbnail ) ) echo 'style="background-image: url( \''  . esc_url( $thumbnail ) . '\' )"'; ?>>

					<header class="slide-content <?php echo ( zacklive_setting( 'blog_featured_slider_overlay' ) ? 'slide-overlay' : '' ) ?>">
						<a class="slide-entry-link" href="<?php the_permalink(); ?>"></a>
						<div class="slide-inner">
							<div class="slide-inner-cell">

								<div class="entry-meta">
									<?php zack_post_meta(); ?>
								</div>

								<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>

								<div class="entry-button">
									<a class="button" href="<?php esc_url( the_permalink() ); ?>"><?php echo esc_html__( 'Read More', 'zack' ); ?></a>
								</div>

							</div>
						</div>
					</header>

				</li>

			<?php endwhile; ?>

		</ul>
	</div>

<?php endif; ?>
