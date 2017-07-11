<?php
$gallery = get_post_gallery( get_the_ID(), false );
if ( ! empty( $gallery ) && ! has_action( 'wp_footer', 'zack_enqueue_flexslider' ) ) {
	add_action( 'wp_footer', 'zack_enqueue_flexslider' );
}

$content = zack_strip_gallery( get_the_content() );
$content = str_replace( ']]>', ']]&gt;', apply_filters( 'the_content', $content ) );

$post_class = ( is_singular() ) ? 'entry' : 'archive-entry';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $post_class ); ?>>

		<?php if ( $gallery != '' ) : ?>
			<div class="flexslider gallery-format-slider">
				<ul class="slides gallery-format-slides">
					<?php foreach ( $gallery['src'] as $image ) : ?>
						<li class="gallery-format-slide">
							<img src="<?php echo $image; ?>">
						</li>
					<?php endforeach; ?>
				<ul>
			</div>
		<?php elseif ( has_post_thumbnail() && zacklive_setting( 'blog_featured_single' ) ) : ?>
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
		<?php if ( is_singular() ) : ?>
			<?php if ( zacklive_page_setting( 'page_title' ) ) : ?>
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			<?php endif; ?>
		<?php else : ?>
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		<?php endif; ?>
		<div class="entry-meta">
			<?php zack_post_meta(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php if ( zacklive_setting( 'blog_archive_content' ) == 'excerpt' && $post_class !== 'entry' ) the_excerpt();
		else echo $content; ?>
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
