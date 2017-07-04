<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $comment;
$verified = wc_review_is_from_verified_owner( $comment->comment_ID );

if ( '0' === $comment->comment_approved ) { ?>

	<p class="meta"><em><?php esc_attr_e( 'Your comment is awaiting approval', 'zack' ); ?></em></p>

<?php } else { ?>

	<div class="comment-meta">
		<p class="comment-author">
			<strong itemprop="author"><?php comment_author(); ?></strong> <?php

			if ( 'yes' === get_option( 'woocommerce_review_rating_verification_label' ) && $verified ) {
				echo '<em class="verified">(' . esc_attr__( 'verified owner', 'zack' ) . ')</em> ';
			}
			?>
		</p>

		<p class="comment-date">
			<time itemprop="datePublished" datetime="<?php echo get_comment_date( 'c' ); ?>"><?php echo get_comment_date( wc_date_format() ); ?></time>
		</p>
	</div>

<?php }
