<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( site_url() ) ?>">
	<label for='s' class='screen-reader-text'><?php esc_html_e( 'Search for:', 'zack' ); ?></label>
	<input type="search" name="s" placeholder="<?php esc_attr_e( 'Search', 'zack') ?>" value="<?php echo get_search_query() ?>" />
	<button type="submit">
		<label class="screen-reader-text"><?php esc_html_e( 'Search', 'zack' ); ?></label>
		<?php zack_display_icon( 'fullscreen-search' ); ?>
	</button>
</form>
