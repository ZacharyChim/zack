<?php
$post_class = ( is_singular() ) ? 'entry' : 'archive-entry';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $post_class ); ?>>

	<?php if ( zack_get_video() ) : ?>
		<div class="entry-video">
			<?php echo zack_get_video(); ?>
		</div>
	<?php elseif ( has_post_thumbnail() && atzack_setting( 'blog_featured_single' ) ) : ?>
		<div class="entry-thumbnail">
			<?php if ( is_singular() ) : ?>
				<?php the_post_thumbnail(); ?>
			<?php else : ?>
				<a href="<?php the_permalink() ?>">
					<?php the_post_thumbnail() ?>
				</a>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<header class="entry-header">
			<?php if ( atzack_page_setting( 'page_title' ) ) : ?>
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			<?php endif; ?>
		<?php else : ?>
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		<?php endif; ?>
		<div class="entry-meta">
			<?php zack_post_meta(); ?>
		</div><!-- .entry-meta -->
		<?php if ( is_singular() ) : ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php if ( atzack_setting( 'blog_archive_content' ) == 'excerpt' && $post_class !== 'entry' ) the_excerpt();
		else echo apply_filters( 'the_content', zack_filter_video( get_the_content() ) ); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'zack' ) . '</span>',
				'after'  => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php if ( is_singular() ) : ?>
		<footer class="entry-footer">
			<?php zack_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-## -->
