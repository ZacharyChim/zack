<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>
	<?php if ( has_post_thumbnail() && atzack_setting( 'blog_featured_single' ) ) : ?>
		<div class="entry-thumbnail">
			<?php the_post_thumbnail( 'post-thumbnail', array( 'class' => 'aligncenter' ) ) ?>
		</div>
	<?php endif; ?>

	<header class="entry-header">
		<?php if ( atzack_page_setting( 'page_title' ) ) : ?>
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php endif; ?>
		<div class="entry-meta">
			<?php zack_post_meta(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'zack' ) . '</span>',
				'after'  => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php zack_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
