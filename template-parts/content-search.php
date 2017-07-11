<?php
$post_class = zacklive_setting( 'blog_search_fallback' ) ? 'has-fallback-image' : '';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $post_class ); ?>>
	<?php if ( has_post_thumbnail() || zacklive_setting( 'blog_search_fallback' ) ) : ?>
		<div class="entry-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php if ( has_post_thumbnail() ) : ?>
					<?php the_post_thumbnail( 'zack-360x238-crop' ); ?>
				<?php elseif ( zacklive_setting( 'blog_search_fallback' ) ) : ?>
					<?php echo wp_get_attachment_image( zacklive_setting( 'blog_search_fallback' ), 'zack-360x238-crop', false, '' ); ?>
				<?php endif; ?>
			</a>
		</div>
	<?php endif; ?>

	<div class="entry-content">
		<header class="entry-header">
			<?php if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta">
					<?php zack_post_meta(); ?>
				</div><!-- .entry-meta -->
			<?php
			endif; ?>

			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		</header><!-- .entry-header -->

		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
	</div>

</article><!-- #post-## -->
