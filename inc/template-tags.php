<?php
if ( ! function_exists( 'zack_archive_title' ) ) :
function zack_archive_title() {
	if ( zacklive_page_setting( 'page_title' ) ) : ?>
		<header class="page-header">
			<?php
				the_archive_title( '<h1 class="page-title"><span class="page-title-text">', '</span></h1>' );
				the_archive_description( '<div class="taxonomy-description">', '</div>' );
			?>
		</header><!-- .page-header -->
	<?php endif;
}
endif;

if ( ! function_exists( 'zack_author_box' ) ) :
function zack_author_box() { ?>
	<div class="author-box">
		<div class="author-avatar">
			<?php echo get_avatar( get_the_author_meta( 'ID' ), 120 ); ?>
		</div>
		<div class="author-description">
			<span class="post-author-title">
				<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
					<?php echo get_the_author(); ?>
				</a>
			</span>
			<div><?php echo wp_kses_post( get_the_author_meta( 'description' ) ); ?></div>
		</div>
	</div>
<?php }
endif;

function zack_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'zack_categories' ) ) ) {
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			'number'     => 2,
		) );

		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'zack_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		return true;
	} else {
		return false;
	}
}

function zack_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	delete_transient( 'zack_categories' );
}
add_action( 'edit_category', 'zack_category_transient_flusher' );
add_action( 'save_post',     'zack_category_transient_flusher' );

if ( ! function_exists( 'zack_comment' ) ) :
function zack_comment( $comment, $args, $depth ) {
	?>
	<li <?php comment_class() ?> id="comment-<?php comment_ID() ?>">
		<?php $type = get_comment_type( $comment->comment_ID ); ?>
		<div class="comment-box">
			<?php if ( $type == 'comment' ) : ?>
				<div class="avatar-container">
					<?php echo get_avatar( get_comment_author_email(), 70 ) ?>
				</div>
			<?php endif; ?>

			<div class="comment-container">
				<div class="info">
					<span class="author"><?php comment_author_link() ?></span><br>
					<span class="date"><?php comment_date() ?></span>
				</div>

				<div class="comment-content content">
					<?php comment_text() ?>
				</div>

				<?php if($depth <= $args['max_depth']) : ?>
					<?php comment_reply_link( array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ?>
				<?php endif; ?>
			</div>
		</div>
	<?php
}
endif;

if ( ! function_exists( 'zack_display_logo' ) ) :
function zack_display_logo() {
	$logo = zacklive_setting( 'branding_logo' );
	if ( ! empty( $logo ) ) {
		$attrs = apply_filters( 'zack_logo_attributes', array() );

		?><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<span class="screen-reader-text"><?php esc_html_e( 'Home', 'zack' ); ?></span><?php
			echo wp_get_attachment_image( $logo, 'full', false, $attrs );
		?></a><?php

	} elseif ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) {
		?><?php the_custom_logo(); ?><?php
	}
	else {
		if ( is_front_page() ) : ?>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		<?php else : ?>
			<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
		<?php endif;
	}
}
endif;

function zack_display_retina_logo( $attr ){
	$logo = zacklive_setting( 'branding_logo' );
	$retina = zacklive_setting( 'branding_retina_logo' );

	if( !empty( $retina ) ) {

		$srcset = array();

		$logo_src = wp_get_attachment_image_src( $logo, 'full' );
		$retina_src = wp_get_attachment_image_src( $retina, 'full' );

		if( !empty( $logo_src ) ) {
			$srcset[] = $logo_src[0] . ' 1x';
		}

		if( !empty( $logo_src ) ) {
			$srcset[] = $retina_src[0] . ' 2x';
		}

		if( ! empty( $srcset ) ) {
			$attr['srcset'] = implode( ',', $srcset );
		}
	}

	return $attr;
}
add_filter( 'zack_logo_attributes', 'zack_display_retina_logo', 10, 1 );


if ( ! function_exists( 'zack_entry_footer' ) ) :
function zack_entry_footer() {
	if ( 'post' === get_post_type() && zacklive_setting( 'blog_display_tags' ) ) { ?>
		<span class="tags-list"><?php the_tags('', '', ''); ?></span>
	<?php }

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'zack' ), esc_html__( '1 Comment', 'zack' ), esc_html__( '% Comments', 'zack' ) );
		echo '</span>';
	}

}
endif;

if ( ! function_exists( 'zack_footer_text' ) ) :
function zack_footer_text() {
	$text = zacklive_setting( 'footer_text' );
	$text = str_replace(
		array( '{sitename}', '{year}' ),
		array( get_bloginfo( 'sitename' ), date( 'Y' ) ),
		$text
	);
	echo wp_kses_post( $text );
}
endif;

if ( ! function_exists( 'zack_read_more_link' ) ) :
function zack_read_more_link() {
	$read_more_text = esc_html__( 'Read More', 'zack' );
	return '<a class="more-link" href="' . get_permalink() . '"><span class="more-text">' . $read_more_text . '</a></span>';
}
endif;
add_filter( 'the_content_more_link', 'zack_read_more_link' );

if ( ! function_exists( 'zack_excerpt_more' ) ) :
function zack_excerpt_more( $more ) {
	if ( is_search() ) return;
	if ( zacklive_setting( 'blog_archive_content' ) == 'excerpt' && zacklive_setting( 'blog_excerpt_more', true ) ) {
		$read_more_text = esc_html__( 'Read More', 'zack' );
		return '<a class="more-link" href="' . get_permalink() . '"><span class="more-text">' . $read_more_text . '</a></span>';
	}
}
endif;
add_filter( 'excerpt_more', 'zack_excerpt_more' );

if ( ! function_exists( 'zack_post_meta' ) ) :
function zack_post_meta() {
	$categories_list = get_the_category_list( esc_html__( ', ', 'zack' ) );
	$num_comments = get_comments_number();

	if ( comments_open() ) {
		if ( $num_comments == 0 ) {
			$comments = esc_html__( 'Post a Comment', 'zack' );
		} elseif ( $num_comments > 1 ) {
			$comments = $num_comments . esc_html__( ' Comments', 'zack' );
		} else {
			$comments = esc_html__( '1 Comment', 'zack' );
		}
	} else {
		$comments = NULL;
	} ?>

	<?php if ( is_sticky() && is_home() && ! is_paged() ) {
		echo '<span class="featured-post">' . esc_html__( 'Sticky', 'zack' ) . '</span>';
	} ?>

	<?php if ( zacklive_setting( 'blog_display_date' ) ) { ?>
		<span class="entry-date">
			<?php echo ( ! is_singular() ) ? '<a href="' . get_the_permalink() . '" title="' . the_title_attribute( 'echo=0' ) .'">' : ''; ?>
				<?php the_time( apply_filters( 'zack_date_format', 'M d, Y' ) ); ?>
			<?php echo ( ! is_singular() ) ? '</a>' : ''; ?>
		</span>
	<?php } ?>


	<?php if ( $categories_list && zack_categorized_blog() && zacklive_setting( 'blog_display_category' ) ) {
		printf( '<span class="entry-category">' . esc_html__( '%1$s', 'zack' ) . '</span>', $categories_list );
	} ?>

	<?php if ( $comments && zacklive_setting( 'blog_display_comments' ) ) {
		echo '<span class="entry-comments"><a href="' . get_comments_link() .'">'. $comments.'</a></span>';
	} ?>

<?php }
endif;

if ( ! function_exists( 'zack_posts_navigation' ) ) :
function zack_posts_navigation() {
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation posts-navigation" role="navigation">
		<h3 class="screen-reader-text"><?php esc_html_e( 'Posts navigation', 'zack' ); ?></h3>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-next"><?php next_posts_link( esc_html__( 'Older posts', 'zack' ) . '<span>&rarr;</span>' ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-previous"><?php previous_posts_link( '<span>&larr;</span>' . esc_html__( 'Newer posts', 'zack' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'zack_the_post_navigation' ) ) :
function zack_the_post_navigation() {
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'zack' ); ?></h2>
		<div class="nav-links">
			<div class="nav-previous">
				<?php previous_post_link ( '%link', '<span class="sub-title"><span>&larr;</span> ' . __( 'Previous Post', 'zack' ) . '</span> <div>%title</div>' ); ?>
			</div>
			<div class="nav-next">
				<?php next_post_link( '%link', '<span class="sub-title">' . __( 'Next Post', 'zack' ) . ' <span>&rarr;</span></span> <div>%title</div>' ); ?>
			</div>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'zack_related_posts' ) ) :
function zack_related_posts( $post_id ) {
	if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'related-posts' ) ) {
		echo do_shortcode( '[jetpack-related-posts]' );
	} else { // The fallback loop
		$categories = get_the_category( $post_id );
		$first_cat = $categories[0]->cat_ID;
		$args=array(
			'category__in' => array( $first_cat ),
			'post__not_in' => array( $post_id ),
			'posts_per_page' => 3,
			'ignore_sticky_posts' => -1
		);
		$related_posts = new WP_Query( $args ); ?>

		<div class="related-posts-section">
			<h2 class="related-posts heading-strike"><?php esc_html_e( 'You may also like', 'zack' ); ?></h2>
			<?php if ( $related_posts ) : ?>
				<ol>
					<?php if ( $related_posts->have_posts() ) : ?>
						<?php while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
							<li>
								<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
									<?php if ( has_post_thumbnail() ) :?>
										<?php the_post_thumbnail( 'zack-263x174-crop' ); ?>
									<?php endif; ?>
									<h3 class="related-post-title"><?php the_title(); ?></h3>
									<p class="related-post-date"><?php the_time( apply_filters( 'zack_date_format', 'M d, Y' ) ); ?></p>
								</a>
							</li>
						<?php endwhile; ?>
					<?php endif; ?>
				</ol>
			<?php else : ?>
				<p><?php esc_html_e( 'No related posts.', 'zack' ); ?></p>
			<?php endif; ?>
		</div>
		<?php wp_reset_query();
	}
}
endif;

if ( ! function_exists( 'zack_tag_cloud' ) ) :
function zack_tag_cloud( $args ) {

	$args['unit'] = 'px';
	$args['largest'] = 12;
	$args['smallest'] = 12;
	return $args;
}
endif;
add_filter( 'widget_tag_cloud_args', 'zack_tag_cloud' );

if ( ! function_exists( 'zack_custom_icon' ) ):
function zack_custom_icon( $icon, $class ) {

	$id = zacklive_setting( $icon );
	$url = wp_get_attachment_url( $id );
	$filetype = wp_check_filetype( $url );
	$extension = $filetype['ext'];

	switch( $extension ) {
		case "svg":
		$attrs['class'] = "style-svg $class";
		break;

		default:
		$attrs['class'] = "$class";
	}

	echo wp_get_attachment_image( $id, 'full', false, $attrs );

}
endif;

if ( ! function_exists( 'zack_display_icon' ) ) :
function zack_display_icon( $type ) {

	switch( $type ) {
		case 'search' :
			if ( zacklive_setting( 'icons_search' ) ): ?>
				<?php zack_custom_icon( 'icons_search', 'svg-icon-search' ); ?>
			<?php else : ?>
				<svg version="1.1" class="svg-icon-search" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32" height="32" viewBox="0 0 32 32">
					<path d="M20.943 4.619c-4.5-4.5-11.822-4.5-16.321 0-4.498 4.5-4.498 11.822 0 16.319 4.007 4.006 10.247 4.435 14.743 1.308 0.095 0.447 0.312 0.875 0.659 1.222l6.553 6.55c0.953 0.955 2.496 0.955 3.447 0 0.953-0.951 0.953-2.495 0-3.447l-6.553-6.551c-0.347-0.349-0.774-0.565-1.222-0.658 3.13-4.495 2.7-10.734-1.307-14.743zM18.874 18.871c-3.359 3.357-8.825 3.357-12.183 0-3.357-3.359-3.357-8.825 0-12.184 3.358-3.359 8.825-3.359 12.183 0s3.359 8.825 0 12.184z"></path>
				</svg>
			<?php endif;
			break;

		case 'close' :
			if ( zacklive_setting( 'icons_close_search' ) ): ?>
				<?php zack_custom_icon( 'icons_close_search', 'svg-icon-close' ); ?>
			<?php else : ?>
				<svg version="1.1" class="svg-icon-close" xmlns="http://www.w3.org/2000/svg" width="15.56" height="15.562" viewBox="0 0 15.56 15.562">
					<path id="icon_close" data-name="icon close" class="cls-1" d="M1367.53,39.407l-2.12,2.121-5.66-5.657-5.66,5.657-2.12-2.121,5.66-5.657-5.66-5.657,2.12-2.122,5.66,5.657,5.66-5.657,2.12,2.122-5.66,5.657Z" transform="translate(-1351.97 -25.969)"/>
				</svg>
			<?php endif;
			break;

		case 'menu':
			if ( zacklive_setting( 'icons_menu' ) ): ?>
				<?php zack_custom_icon( 'icons_menu', 'svg-icon-menu' ); ?>
			<?php else : ?>
				<svg version="1.1" class="svg-icon-menu" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="27" height="32" viewBox="0 0 27 32">
					<path d="M27.429 24v2.286q0 0.464-0.339 0.804t-0.804 0.339h-25.143q-0.464 0-0.804-0.339t-0.339-0.804v-2.286q0-0.464 0.339-0.804t0.804-0.339h25.143q0.464 0 0.804 0.339t0.339 0.804zM27.429 14.857v2.286q0 0.464-0.339 0.804t-0.804 0.339h-25.143q-0.464 0-0.804-0.339t-0.339-0.804v-2.286q0-0.464 0.339-0.804t0.804-0.339h25.143q0.464 0 0.804 0.339t0.339 0.804zM27.429 5.714v2.286q0 0.464-0.339 0.804t-0.804 0.339h-25.143q-0.464 0-0.804-0.339t-0.339-0.804v-2.286q0-0.464 0.339-0.804t0.804-0.339h25.143q0.464 0 0.804 0.339t0.339 0.804z"></path>
				</svg>
			<?php endif;
			break;
	}
}
endif;

if ( ! function_exists( 'zack_get_video' ) ) :
function zack_get_video() {
	$first_url    = '';
	$first_video  = '';

	$i = 0;

	preg_match_all( '|^\s*https?://[^\s"]+\s*$|im', get_the_content(), $urls );

	foreach ( $urls[0] as $url ) {
		$i++;

		if ( 1 === $i ) {
			$first_url = trim( $url );
		}

		$oembed = wp_oembed_get( esc_url( $url ) );

		if ( ! $oembed ) continue;

		$first_video = $oembed;

		break;
	}

	return ( '' !== $first_video ) ? $first_video : false;
}
endif;

if ( ! function_exists( 'zack_filter_video' ) ) :
function zack_filter_video( $content ) {
	if ( zack_get_video() ) {
		preg_match_all( '|^\s*https?://[^\s"]+\s*$|im', $content, $urls );

		if ( ! empty( $urls[0] ) ) {
			$content = str_replace( $urls[0], '', $content );
		}

		return $content;
	} else {
		return $content;
	}
}
endif;

if ( ! function_exists( 'zack_get_image' ) ) :
function zack_get_image() {
	$first_image = '';

	$output = preg_match_all( '/<img[^>]+\>/i', get_the_content(), $images );
	$first_image = $images[0][0];

	return ( '' !== $first_image ) ? $first_image : false;
}
endif;

if ( ! function_exists( 'zack_strip_image' ) ) :
function zack_strip_image( $content ) {
	return preg_replace( '/<img[^>]+\>/i', '', $content, 1 );
}
endif;

if ( ! function_exists( 'zack_jetpackme_related_posts_headline' ) ) :
function zack_jetpackme_related_posts_headline( $headline ) {
	$headline = sprintf(
	    '<h2 class="jp-relatedposts-headline related-posts heading-strike">%s</h2>',
	    esc_html( 'You may also like', 'zack' )
	);
	return $headline;
}
endif;
add_filter( 'jetpack_relatedposts_filter_headline', 'zack_jetpackme_related_posts_headline' );

if ( ! function_exists( 'zack_jetpackme_remove_rp' ) ) :
function zack_jetpackme_remove_rp() {
    if ( class_exists( 'Jetpack_RelatedPosts' ) ) {
        $jprp = Jetpack_RelatedPosts::init();
        $callback = array( $jprp, 'filter_add_target_to_dom' );
        remove_filter( 'the_content', $callback, 40 );
    }
}
endif;
add_filter( 'wp', 'zack_jetpackme_remove_rp', 20 );
