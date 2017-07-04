<?php get_header(); ?>

	<?php if ( atzack_page_setting( 'page_title' ) ) : ?>
		<header class="page-header">
			<h1 class="page-title"><span class="page-title-text"><?php printf( esc_html__( 'Search Results: %s', 'zack' ), get_search_query() ); ?></span></h1>
		</header><!-- .page-header -->
	<?php endif; ?>

	<div id="primary" class="content-area">

		<main id="main" class="site-main" role="main">

			<?php
			if ( have_posts() ) :
				while ( have_posts() ) : the_post();
					get_template_part( 'template-parts/content', 'search' );
				endwhile;
				zack_posts_navigation();
			else :
				get_template_part( 'template-parts/content', 'none' );
			endif; ?>

		</main><!-- #main -->

	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
