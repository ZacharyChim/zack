<?php
if ( ! is_active_sidebar( 'main-sidebar' ) ) return;
if ( ! in_array( atzack_page_setting( 'layout', 'default' ), array( 'default','full-width-sidebar' ), true )  ) return;
?>

<aside id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'main-sidebar' ); ?>
</aside><!-- #secondary -->
