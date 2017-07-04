<?php
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	if ( have_comments() ) : ?>
		<h2 class="comments-title heading-strike">
			<?php
				printf( // WPCS: XSS OK.
					esc_html( _nx( '1 Comment', '%1$s Comments', get_comments_number(), 'comments title', 'zack' ) ),
					number_format_i18n( get_comments_number() ),
					'<span>' . get_the_title() . '</span>'
				);
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'zack' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( '<span>&larr;</span>' . esc_html__( 'Older comments', 'zack' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer comments', 'zack' ) . '<span>&rarr;</span>' ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'ol',
					'callback' => 'zack_comment',
					'short_ping' => true,
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'zack' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( '<span>&larr;</span>' . esc_html__( 'Older comments', 'zack' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer comments', 'zack' ) . '<span>&rarr;</span>' ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php
		endif; // Check for comment navigation.

	endif; // Check for have_comments().

	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'zack' ); ?></p>
	<?php
	endif;

	comment_form();
	?>

</div><!-- #comments -->
