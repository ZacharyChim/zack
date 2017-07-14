<?php
function zack_settings_localize( $loc ) {
	return wp_parse_args( array(
		'section_title' => esc_html__( 'Theme Settings', 'zack' ),
		'section_description' => esc_html__( 'Change settings for your theme.', 'zack' ),

		'variant' => esc_html__( 'Variant', 'zack' ),
		'subset' => esc_html__( 'Subset', 'zack' ),

		'meta_box' => esc_html__( 'Page settings', 'zack' ),
	), $loc);
}
add_filter( 'zacklive_settings_localization', 'zack_settings_localize' );

function zack_settings_init() {

	ZackLive_Settings::single()->configure( apply_filters( 'zack_settings_array', array(

		'branding' => array(
			'title' => esc_html__( 'Branding', 'zack' ),
			'fields' => array(
				'logo' => array(
					'type' => 'media',
					'label' => esc_html__( 'Logo', 'zack' ),
					'description' => esc_html__( 'Logo displayed in your header.', 'zack' )
				),
				'retina_logo' => array(
					'type' => 'media',
					'label' => esc_html__( 'Retina Logo', 'zack' ),
					'description' => esc_html__( 'A double sized logo to use on retina devices.', 'zack' )
				),
				'site_description' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Site Description', 'zack' ),
					'description' => esc_html__( 'Show your site description below your site title or logo.', 'zack' )
				),
				'accent' => array(
					'type' => 'color',
					'label' => esc_html__( 'Accent Color', 'zack' ),
					'description' => esc_html__( 'The color used for links and various other accents.', 'zack' ),
					'live' => true,
				),
				'accent_dark' => array(
					'type' => 'color',
					'label' => esc_html__( 'Dark Accent Color', 'zack' ),
					'description' => esc_html__( 'The color used for link hovers and various other accents.', 'zack' ),
					'live' => true,
				),
			)
		),

		'fonts' => array(
			'title' => esc_html__( 'Fonts', 'zack' ),
			'fields' => array(
				'details' => array(
					'type' => 'font',
					'label' => esc_html__( 'Details font', 'zack' ),
					'description' => esc_html__( 'Used for smaller details.', 'zack' ),
					'live' => true,
				),
				'main' => array(
					'type' => 'font',
					'label' => esc_html__( 'Main font', 'zack' ),
					'description' => esc_html__( 'Used for body text.', 'zack' ),
					'live' => true,
				),
				'headings' => array(
					'type' => 'font',
					'label' => esc_html__( 'Headings font', 'zack' ),
					'description' => esc_html__( 'Used for headings.', 'zack' ),
					'live' => true,
				),
				'text_light' => array(
					'type' => 'color',
					'label' => esc_html__( 'Light Text Color', 'zack' ),
					'description' => esc_html__( 'Used for smaller details.', 'zack' ),
					'live' => true,
				),
				'text_medium' => array(
					'type' => 'color',
					'label' => esc_html__( 'Medium Text Color', 'zack' ),
					'description' => esc_html__( 'Used for body text.', 'zack' ),
					'live' => true,
				),

				'text_dark' => array(
					'type' => 'color',
					'label' => esc_html__( 'Dark Text Color', 'zack' ),
					'description' => esc_html__( 'Used for headings.', 'zack' ),
					'live' => true,
				),
			),
		),

		'masthead' => array(
			'title' => esc_html__( 'Header', 'zack' ),
			'fields' => array(
				'padding'	=> array(
					'type'	=> 'measurement',
					'label'	=> esc_html__( 'Header Padding', 'zack' ),
					'description' => esc_html__( 'Top and bottom header padding.', 'zack' ),
					'live'	=> true,
				),
				'bottom_margin'	=> array(
					'type'	=> 'measurement',
					'label'	=> esc_html__( 'Bottom Margin', 'zack' ),
					'live'	=> true,
				),
			)
		),

		'navigation' => array(
			'title' => esc_html__( 'Navigation', 'zack' ),
			'fields' => array(
				'sticky' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Sticky menu', 'zack' ),
					'description' => esc_html__( 'Stick menu to top of screen.', 'zack' ),
				),
				'mobile_menu_collapse' => array(
					'label'       => esc_html__( 'Mobile Menu Collapse', 'zack' ),
					'type'        => 'number',
					'description' => esc_html__( 'The screen width in pixels when the primary menu changes to a mobile menu.', 'zack' )
				),
				'post' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Post navigation', 'zack' ),
					'description' => esc_html__( 'Display next and previous post navigation.', 'zack' ),
				),
			),
		),

		'icons' => array(
			'title' => esc_html__( 'Icons', 'zack' ),
			'fields' => array(
				'menu' => array(
					'type' => 'media',
					'label' => esc_html__( 'Mobile menu icon', 'zack' ),
				),
				'fullscreen_search' => array(
					'type' => 'media',
					'label' => esc_html__( 'Fullscreen search icon', 'zack' ),
				),
				'search' => array(
					'type' => 'media',
					'label' => esc_html__( 'Menu search icon', 'zack' ),
				),
				'close_search' => array(
					'type' => 'media',
					'label' => esc_html__( 'Menu close search icon', 'zack' ),
				),
			),
		),

		'layout' => array(
			'title' => esc_html__( 'Layout', 'zack' ),
			'fields' => array(
				'main_sidebar'	=> array(
					'type'	=> 'select',
					'label'	=> esc_html__( 'Main Sidebar Position', 'zack' ),
					'options' => array(
						'right' => esc_html__( 'Right', 'zack' ),
						'left'  => esc_html__( 'Left', 'zack' ),
					),
				),
			)
		),

		'blog' => array(
			'title' => esc_html__( 'Blog', 'zack' ),
			'fields' => array(
				'featured_archive' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Featured image on archive pages.', 'zack' ),
				),
				'featured_single' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Featured image on single post.', 'zack' ),
				),
				'archive_content'	=> array(
					'type'	=> 'select',
					'label'	=> esc_html__( 'Post Content', 'zack' ),
					'options' => array(
						'full' => esc_html__( 'Full Post', 'zack' ),
						'excerpt'  => esc_html__( 'Post Excerpt', 'zack' ),
					),
					'description' => esc_html__('Choose how to display your post content on the blog and archive pages. Select Full Post if using the "more" quicktag.', 'zack'),
				),
				'excerpt_more' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Post Excerpt Read More Link', 'zack' ),
					'description' => esc_html__( 'Display the Read More link below the post excerpt.', 'zack' ),
				),
				'display_date' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Date on single and archive posts.', 'zack' ),
				),
				'display_category' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Categories on single and archive posts.', 'zack' ),
				),
				'display_comments' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Comments link on single and archive posts.', 'zack' ),
				),
				'display_tags' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Tags on single posts.', 'zack' ),
				),
				'display_related_posts' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Related posts on single post.', 'zack' ),
				),
				'display_author_box' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Author box on single post.', 'zack' ),
				),
				'search_fallback' => array(
					'type' => 'media',
					'label' => esc_html__( 'Search fallback image', 'zack' ),
					'description' => esc_html__( "Used for blog posts with no featured image.", 'zack' ),
				),
			)
		),

		'footer' => array(
			'title' => esc_html__( 'Footer', 'zack' ),
			'fields' => array(

				'text' => array(
					'type' => 'text',
					'label' => esc_html__( 'Footer Text', 'zack' ),
					'description' => esc_html__( "{sitename} and {year} are your site's name and current year.", 'zack' ),
					'sanitize_callback' => 'wp_kses_post',
				),

				'constrained' => array(
					'type' => 'checkbox',
					'label' => esc_html__( 'Constrain', 'zack' ),
					'description' => esc_html__( "Constrain the footer width.", 'zack' ),
				),

				'top_padding'	=> array(
					'type'	=> 'measurement',
					'label'	=> esc_html__( 'Top Padding', 'zack' ),
					'live'	=> true,
				),

				'side_padding'	=> array(
					'type'	=> 'measurement',
					'label'	=> esc_html__( 'Side Padding', 'zack' ),
					'description' => esc_html__( "Applies if the footer width is not constrained.", 'zack' ),
					'live'	=> true,
				),

				'top_margin' => array(
					'type' => 'measurement',
					'label' => esc_html__( 'Top Margin', 'zack' ),
					'live' => true,
				),
			),
		),

	) ) );
}
add_action( 'zacklive_settings_init', 'zack_settings_init' );

function zack_font_settings( $settings ) {

	$settings['fonts_details']  = array(
		'name'    => 'Lato',
		'weights' => array(
			300,
			400
		),
	);
	$settings['fonts_main']     = array(
		'name'    => 'Raleway',
		'weights' => array(
			400,
			700
		),
	);
	$settings['fonts_headings'] = array(
		'name'    => 'Raleway',
		'weights' => array(
			700
		),
	);

	return $settings;
}
add_filter( 'zacklive_settings_font_settings', 'zack_font_settings' );

function zack_settings_custom_css( $css ) {
	$css .= '/* style */
	body,button,input,select,textarea {
	color: ${fonts_text_medium};
	.font( ${fonts_main} );
	}
	h1,h2,h3,h4,h5,h6 {
	color: ${fonts_text_dark};
	.font( ${fonts_headings} );
	}
	blockquote {
	border-left: 3px solid ${branding_accent};
	}
	abbr,acronym {
	border-bottom: 1px dotted ${fonts_text_medium};
	}
	table {
	.font( ${fonts_details} );
	}
	table thead th {
	color: ${fonts_text_dark};
	}
	.button,#page #infinite-handle span button,button,input[type="button"],input[type="reset"],input[type="submit"] {
	color: ${fonts_text_dark};
	.font( ${fonts_details} );
	}
	.button:hover,#page #infinite-handle span button:hover,button:hover,input[type="button"]:hover,input[type="reset"]:hover,input[type="submit"]:hover {
	border-color: ${branding_accent};
	color: ${branding_accent};
	}
	.button:active,#page #infinite-handle span button:active,.button:focus,#page #infinite-handle span button:focus,button:active,button:focus,input[type="button"]:active,input[type="button"]:focus,input[type="reset"]:active,input[type="reset"]:focus,input[type="submit"]:active,input[type="submit"]:focus {
	border-color: ${branding_accent};
	color: ${branding_accent};
	}
	input[type="text"],input[type="email"],input[type="url"],input[type="password"],input[type="search"],input[type="number"],input[type="tel"],input[type="range"],input[type="date"],input[type="month"],input[type="week"],input[type="time"],input[type="datetime"],input[type="datetime-local"],input[type="color"],textarea {
	color: ${fonts_text_light};
	}
	input[type="text"]:focus,input[type="email"]:focus,input[type="url"]:focus,input[type="password"]:focus,input[type="search"]:focus,input[type="number"]:focus,input[type="tel"]:focus,input[type="range"]:focus,input[type="date"]:focus,input[type="month"]:focus,input[type="week"]:focus,input[type="time"]:focus,input[type="datetime"]:focus,input[type="datetime-local"]:focus,input[type="color"]:focus,textarea:focus {
	color: ${fonts_text_medium};
	}
	a {
	color: ${branding_accent};
	}
	a:hover,a:focus {
	color: ${branding_accent_dark};
	}
	.main-navigation > div ul ul a {
	.font( ${fonts_main} );
	}
	.main-navigation > div li a {
	color: ${fonts_text_medium};
	.font( ${fonts_details} );
	}
	.main-navigation > div li:hover > a,.main-navigation > div li.focus > a {
	color: ${fonts_text_dark};
	}
	.social-search .search-toggle .open .svg-icon-search path {
	fill: ${fonts_text_medium};
	}
	.social-search .search-toggle .close .svg-icon-close path {
	fill: ${fonts_text_medium};
	}
	.menu-toggle .svg-icon-menu path {
	fill: ${fonts_text_medium};
	}
	#mobile-navigation ul li a {
	color: ${fonts_text_medium};
	.font( ${fonts_details} );
	}
	#mobile-navigation ul li .dropdown-toggle .svg-icon-submenu path {
	fill: ${fonts_text_medium};
	}
	.comment-navigation a,.posts-navigation a,.post-navigation a {
	color: ${fonts_text_medium};
	}
	.comment-navigation a:hover,.posts-navigation a:hover,.post-navigation a:hover {
	border-color: ${branding_accent};
	color: ${branding_accent};
	}
	.posts-navigation .nav-links,.comment-navigation .nav-links {
	font-family: ${fonts_details} !important;
	}
	.pagination .page-numbers {
	color: ${fonts_text_medium};
	}
	.pagination .page-numbers:hover {
	background: ${branding_accent};
	border-color: ${branding_accent};
	}
	.pagination .dots:hover {
	color: ${fonts_text_medium};
	}
	.pagination .current {
	background: ${branding_accent};
	border-color: ${branding_accent};
	}
	.pagination .next,.pagination .prev {
	.font( ${fonts_details} );
	}
	.post-navigation {
	.font( ${fonts_main} );
	}
	.post-navigation a {
	color: ${fonts_text_medium};
	}
	.post-navigation a:hover {
	color: ${branding_accent};
	}
	.post-navigation a .sub-title {
	color: ${fonts_text_light};
	.font( ${fonts_details} );
	}
	#secondary .widget .widget-title,#colophon .widget .widget-title,#masthead-widgets .widget .widget-title {
	color: ${fonts_text_medium};
	}
	#secondary .widget a,#colophon .widget a,#masthead-widgets .widget a {
	color: ${fonts_text_medium};
	}
	#secondary .widget a:hover,#colophon .widget a:hover,#masthead-widgets .widget a:hover {
	color: ${branding_accent};
	}
	.widget_categories {
	color: ${fonts_text_light};
	}
	.widget_categories a {
	color: ${fonts_text_medium};
	}
	.widget_categories a:hover {
	color: ${fonts_text_dark};
	}
	.widget #wp-calendar caption {
	color: ${fonts_text_dark};
	.font( ${fonts_main} );
	}
	.widget #wp-calendar tfoot #prev a,.widget #wp-calendar tfoot #next a {
	color: ${branding_accent};
	}
	.widget #wp-calendar tfoot #prev a:hover,.widget #wp-calendar tfoot #next a:hover {
	color: ${branding_accent_dark};
	}
	.widget_recent_entries .post-date {
	color: ${fonts_text_light};
	}
	.recent-posts-extended h3 {
	color: ${fonts_text_medium};
	}
	.recent-posts-extended h3 a:hover {
	color: ${fonts_text_dark};
	}
	.recent-posts-extended time {
	color: ${fonts_text_light};
	}
	#secondary .widget_search .search-form button[type="submit"] svg,#colophon .widget_search .search-form button[type="submit"] svg,#masthead-widgets .widget_search .search-form button[type="submit"] svg {
	fill: ${fonts_text_medium};
	}
	#page .widget_tag_cloud a {
	color: ${fonts_text_medium};
	}
	#page .widget_tag_cloud a:hover {
	background: ${branding_accent};
	border-color: ${branding_accent};
	}
	#masthead {
	margin-bottom: ${masthead_bottom_margin};
	}
	#masthead .site-branding {
	padding: ${masthead_padding} 0;
	}
	#masthead .site-branding .site-title {
	.font( ${fonts_details} );
	}
	#masthead .site-branding .site-title a {
	color: ${fonts_text_dark};
	}
	#fullscreen-search h3 {
	color: ${fonts_text_medium};
	.font( ${fonts_details} );
	}
	#fullscreen-search form input[type="search"] {
	color: ${fonts_text_medium};
	}
	#fullscreen-search form button[type="submit"] svg {
	fill: ${fonts_text_light};
	}
	.entry-meta {
	.font( ${fonts_details} );
	}
	.entry-meta span {
	color: ${fonts_text_light};
	}
	.entry-meta span a:hover {
	color: ${branding_accent};
	}
	.entry-title {
	color: ${fonts_text_dark};
	}
	.entry-title a:hover {
	color: ${fonts_text_medium};
	}
	.more-link {
	color: ${fonts_text_dark};
	}
	.more-link .more-text {
	.font( ${fonts_details} );
	}
	.more-link .more-text:hover {
	border: 2px solid ${branding_accent};
	}
	.page-links .page-links-title {
	color: ${fonts_text_dark};
	}
	.page-links span:not(.page-links-title) {
	background: ${branding_accent};
	border: 1px solid ${branding_accent};
	}
	.page-links .page-links-title ~ a span {
	color: ${fonts_text_medium};
	}
	.page-links .page-links-title ~ a span:hover {
	background: ${branding_accent};
	border: 1px solid ${branding_accent};
	}
	.tags-list a {
	color: ${fonts_text_medium};
	}
	.tags-list a:hover {
	background: ${fonts_text_medium};
	}
	.archive .container > .page-header,.search .container > .page-header {
	margin-bottom: ${masthead_bottom_margin};
	}
	.archive .container > .page-header .page-title,.search .container > .page-header .page-title {
	.font( ${fonts_details} );
	}
	.page-title {
	color: ${fonts_text_dark};
	}
	.content-area .search-form button[type="submit"] svg {
	fill: ${fonts_text_medium};
	}
	.author-box .author-description {
	color: ${fonts_text_medium};
	}
	.author-box .author-description .post-author-title a {
	color: ${fonts_text_dark};
	}
	.author-box .author-description .post-author-title a:hover {
	color: ${fonts_text_medium};
	}
	.comment-list li.comment {
	color: ${fonts_text_medium};
	}
	.comment-list li.comment .author {
	color: ${fonts_text_dark};
	}
	.comment-list li.comment .author a {
	color: ${fonts_text_dark};
	}
	.comment-list li.comment .author a:hover {
	color: ${fonts_text_medium};
	}
	.comment-list li.comment .date {
	color: ${fonts_text_light};
	}
	.comment-list li.comment .comment-reply-link {
	color: ${fonts_text_dark};
	.font( ${fonts_details} );
	}
	.comment-list li.comment .comment-reply-link:hover {
	color: ${branding_accent};
	}
	.comment-reply-title #cancel-comment-reply-link {
	color: ${fonts_text_light};
	.font( ${fonts_details} );
	}
	.comment-reply-title #cancel-comment-reply-link:hover {
	color: ${branding_accent};
	}
	#commentform label {
	color: ${fonts_text_dark};
	}
	#commentform .comment-notes a,#commentform .logged-in-as a {
	color: ${fonts_text_medium};
	}
	#commentform .comment-notes a:hover,#commentform .logged-in-as a:hover {
	color: ${fonts_text_dark};
	}
	#commentform .comment-subscription-form label {
	color: ${fonts_text_medium};
	}
	#colophon {
	margin-top: ${footer_top_margin};
	}
	#colophon .widgets {
	padding: ${footer_top_padding} 0;
	}
	#colophon .site-info {
	color: ${fonts_text_medium};
	}
	#colophon .site-info a:hover {
	color: ${fonts_text_dark};
	}
	#colophon.unconstrained-footer .container {
	padding: 0 ${footer_side_padding};
	}';
	return $css;
}
add_filter( 'zacklive_settings_custom_css', 'zack_settings_custom_css' );

if ( ! function_exists( 'zack_menu_breakpoint_css' ) ) :

function zack_menu_breakpoint_css( $css, $settings ) {
	$breakpoint = isset( $settings[ 'theme_settings_navigation_mobile_menu_collapse' ] ) ? $settings[ 'theme_settings_navigation_mobile_menu_collapse' ] : 768;

	$css .= '@media screen and (max-width: ' . intval( $breakpoint ) . 'px) {
		.main-navigation .menu-toggle {
			display: block;
		}
		.main-navigation > div,
		.main-navigation > div ul {
			display: none;
		}
	}
	@media screen and (min-width: ' . ( 1 + $breakpoint ) . 'px) {
		#mobile-navigation {
			display: none !important;
		}
		.main-navigation > div ul {
			display: block;
		}
		.main-navigation .menu-toggle {
			display: none;
		}
	}';
	return $css;
}
endif;
add_filter( 'zacklive_settings_custom_css', 'zack_menu_breakpoint_css', 10, 2 );

function zack_settings_defaults( $defaults ) {

	// Branding defaults.
	$defaults['branding_logo']             = false;
	$defaults['branding_site_description'] = false;
	$defaults['branding_attribution']      = true;
	$defaults['branding_accent']           = '#24c48a';
	$defaults['branding_accent_dark']      = '#00a76a';

	// Font defaults.
	$defaults['fonts_text_light']  = '#adadad';
	$defaults['fonts_text_medium'] = '#626262';
	$defaults['fonts_text_dark']   = '#2d2d2d';

	// The masthead defaults.
	$defaults['masthead_padding']       = '23px';
	$defaults['masthead_bottom_margin'] = '60px';

	// Navigation defaults.
	$defaults['navigation_search']               = true;
	$defaults['navigation_sticky']               = true;
	$defaults['navigation_mobile_menu_collapse'] = 768;
	$defaults['navigation_post']                 = true;

	// Icons.
	$defaults['icons_menu']              = false;
	$defaults['icons_fullscreen_search'] = false;
	$defaults['icons_search']            = false;
	$defaults['icons_close_search']      = false;

	// Layout
	$defaults['layout_main_sidebar'] = 'right';

	// Blog settings.
	$defaults['blog_featured_archive']        = true;
	$defaults['blog_featured_single']         = true;
	$defaults['blog_archive_content']         = 'full';
	$defaults['blog_excerpt_more']         	  = false;
	$defaults['blog_display_related_posts']   = true;
	$defaults['blog_display_author_box']      = true;
	$defaults['blog_display_date']            = true;
	$defaults['blog_display_category']        = true;
	$defaults['blog_display_comments']        = true;
	$defaults['blog_display_tags']            = true;
	$defaults['blog_search_fallback']         = false;

	// Footer settings.
	$defaults['footer_text']         = esc_html__( '{year} &copy; {sitename}.', 'zack' );
	$defaults['footer_constrained']  = true;
	$defaults['footer_top_padding']  = '80px';
	$defaults['footer_side_padding'] = '40px';
	$defaults['footer_top_margin']   = '80px';

	return $defaults;
}
add_filter( 'zacklive_settings_defaults', 'zack_settings_defaults' );

function zack_page_settings( $settings, $type, $id ) {

	$settings['layout'] = array(
		'type'    => 'select',
		'label'   => esc_html__( 'Page Layout', 'zack' ),
		'options' => array(
			'default'            => esc_html__( 'Default', 'zack' ),
			'no-sidebar'         => esc_html__( 'No Sidebar', 'zack' ),
			'full-width'         => esc_html__( 'Full Width', 'zack' ),
			'full-width-sidebar' => esc_html__( 'Full Width, With Sidebar', 'zack' ),
		),
	);

	$settings['page_title'] = array(
		'type'           => 'checkbox',
		'label'          => esc_html__( 'Page Title', 'zack' ),
		'checkbox_label' => esc_html__( 'Enable', 'zack' ),
		'description'    => esc_html__( 'Display the page title.', 'zack' )
	);

	$settings['masthead_margin'] = array(
		'type'           => 'checkbox',
		'label'          => esc_html__( 'Header Bottom Margin', 'zack' ),
		'checkbox_label' => esc_html__( 'Enable', 'zack' ),
		'description'    => esc_html__( 'Display the margin below the header.', 'zack' )
	);

	$settings['footer_margin'] = array(
		'type'           => 'checkbox',
		'label'          => esc_html__( 'Footer Top Margin', 'zack' ),
		'checkbox_label' => esc_html__( 'Enable', 'zack' ),
		'description'    => esc_html__( 'Display the margin above the footer.', 'zack' )
	);

	$settings['display_masthead'] = array(
		'type'           => 'checkbox',
		'label'          => esc_html__( 'Header', 'zack' ),
		'checkbox_label' => esc_html__( 'Enable', 'zack' ),
		'description'    => esc_html__( 'Display the header.', 'zack' )
	);

	$settings['display_footer_widgets'] = array(
		'type'           => 'checkbox',
		'label'          => esc_html__( 'Footer Widgets', 'zack' ),
		'checkbox_label' => esc_html__( 'Enable', 'zack' ),
		'description'    => esc_html__( 'Display the footer widgets.', 'zack' )
	);

	return $settings;
}
add_action( 'zacklive_page_settings', 'zack_page_settings', 10, 3 );

function zack_setup_page_setting_defaults( $defaults, $type, $id ){

	$defaults['layout']              	= 'default';
	$defaults['page_title']          	= true;
	$defaults['masthead_margin']     	= true;
	$defaults['footer_margin']       	= true;
	$defaults['display_masthead']       = true;
	$defaults['display_footer_widgets'] = true;

	if ( $type == 'template' && $id == 'home' ) {
		$defaults['page_title'] = false;
	}

	return $defaults;
}
add_filter( 'zacklive_page_settings_defaults', 'zack_setup_page_setting_defaults', 10, 3 );

function zack_page_settings_panels_defaults( $settings ){
	$settings['layout']     = 'no-sidebar';
	$settings['page_title'] = false;

	return $settings;
}
add_filter( 'zacklive_page_settings_panels_home_defaults', 'zack_page_settings_panels_defaults' );
