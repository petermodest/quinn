<!DOCTYPE html>

<html <?php language_attributes( ); ?> xmlns:fb="http://ogp.me/ns/fb#">

<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php wp_title( '&#8212;', true, 'right' ); bloginfo( 'name' ); ?></title>

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<link rel="stylesheet" type="text/css" href="//cloud.typography.com/661378/702364/css/fonts.css" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />

	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<? if( in_array( $_SERVER['HTTP_HOST'], array( 'www.quinnsnacks.com', 'quinnsnacks.com' ) ) ) : ?>
		<meta name="google-site-verification" content="ndv2zMgIepeWMHXCLprnBD9uJk8F5ibs9cpYftr-kjs" />
	<? endif ?>

	<?php get_template_part( 'parts/include', 'page-specific' ); ?>
	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<?php get_template_part( 'parts/include', 'facebook' ); ?>

	<div class="header-wrapper" id="header-desktop">
		<div id="header-centering" class="<?php echo getHeaderColor(); ?>">

			<iframe id="minicart-iframe" src="http://store.quinnpopcorn.com/pages/minicart-for-wp" width="77" height="40" scrolling="no"></iframe>

			    <?php
			      wp_nav_menu( array(
			        'theme_location' => 'mainmenu-header', // Setting up the location for the main-menu, Main Navigation.
			        'menu_class' => 'dropdown', //Adding the class for dropdowns
			        'container_id' => 'mainmenu-header', //Add CSS ID to the containter that wraps the menu.
			        'fallback_cb' => 'wp_page_menu'
			            )
			        );
			    ?>

			<a href="<?php bloginfo( 'url' ); ?>" id="quinn-logo"></a>
			<div class="clearboth"></div>
		</div><!-- header-centering -->
	</div><!-- header-wrapper -->

	<div class="header-wrapper" id="header-mobile">

			<a href="<?php bloginfo( 'url' ); ?>" id="quinn-logo"></a>

			<div id="mobile-menu-trigger"></div>
			    <?php
			      wp_nav_menu( array(
			        'theme_location' => 'mainmenu-mobile', // Setting up the location for the main-menu, Main Navigation.
			        'menu_class' => 'dropdown', //Adding the class for dropdowns
			        'container_id' => 'mainmenu-mobile', //Add CSS ID to the containter that wraps the menu.
			        'fallback_cb' => 'wp_page_menu'
			            )
			        );
			    ?>

	</div><!-- header-wrapper mobile -->

	<?php if ( !is_page_template('template-frontpage-2.php') ) { ?>
		<div id="mobile-header-padding"></div>
	<?php } ?>

 	<?php if ( is_page_template('template-store.php') ) { ?>
		<div id="store-graystripe"></div>
	 <?php  } ?>

<div id="wrapper">
