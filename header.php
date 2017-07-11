<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'zack' ); ?></a>

	<?php if ( zacklive_page_setting( 'display_masthead', true ) ) : ?>
		<header id="masthead" class="site-header" role="banner">
			<div class="main-navigation-bar sticky-bar <?php if ( zacklive_setting( 'navigation_sticky' ) ) echo 'sticky-menu'; ?>">
			    <div class="container">
			        <div class="site-branding">
			            <?php zack_display_logo(); ?>
			            <?php if ( zacklive_setting( 'branding_site_description' ) ) : ?>
			                <p class="site-description"><?php bloginfo( 'description' ); ?></p>
			            <?php endif ?>
			        </div><!-- .site-branding -->
							<nav id="site-navigation" class="main-navigation" role="navigation">
								<button id="mobile-menu-button" class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php zack_display_icon( 'menu' ); ?></button>
								<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
							</nav><!-- #site-navigation -->
							<div id="mobile-navigation"></div>
			    </div><!-- .container -->
			</div>

		</header><!-- #masthead -->
	<?php endif; ?>

	<div id="content" class="site-content">
		<div class="container">
