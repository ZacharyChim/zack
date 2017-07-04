<?php

	get_header();

	if ( atzack_setting( 'blog_featured_slider' ) && zack_has_featured_posts() ) : ?>

		<?php get_template_part( 'template-parts/featured', 'slider' ); ?>

	<?php endif; ?>

	<div id="primary" class="content-area">

		<main id="main" class="site-main" role="main">

			<?php get_template_part( 'loops/loop', 'blog' ); ?>

		</main><!-- #main -->

	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
