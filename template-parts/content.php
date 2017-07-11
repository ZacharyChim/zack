<article id="post-<?php the_ID(); ?>" <?php post_class( 'archive-entry' ); ?>>
	<?php if( has_post_thumbnail() && zacklive_setting( 'blog_featured_archive' ) ) : ?>
		<div class="entry-thumbnail">
			<a href="<?php the_permalink() ?>">
				<?php the_post_thumbnail( 'post-thumbnail', array( 'class' => 'aligncenter' ) ); ?>
			</a>
		</div>
	<?php endif; ?>

	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			if ( zacklive_setting( 'blog_archive_content' ) == 'excerpt' ) the_excerpt();
			else the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'zack' ) . '</span>',
				'after'  => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
