<?php
if ( ! is_active_sidebar( 'shop-sidebar' ) ) return;
if ( ! in_array( atzack_page_setting( 'layout', 'default' ), array( 'default','full-width-sidebar' ), true )  ) return;
if ( is_product() ) return;
?>

<aside id="secondary" class="shop-widgets widget-area" role="complementary">
	<?php dynamic_sidebar( 'shop-sidebar' ); ?>
</aside><!-- #secondary -->
