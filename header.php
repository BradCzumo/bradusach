<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package bradusach
 */
?><!DOCTYPE html>
	<html <?php language_attributes(); ?>>
	<head>
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
	<?php include (TEMPLATEPATH . '/myGallery/gallery_header_include.php'); ?>
</head>


<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'bradusach' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
	
	<!-- If there is an image set up a link and display header image if clicked, 
	take to front of the site THIS IS REALLY COOL! and took some time to figure out...
	 conditional statement-->
	
	<?php if ( get_header_image() && ('blank' == get_header_textcolor() ) ) : ?>
	<div class="header-image">
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
	</a>
	</div>
	<?php endif; // End header image check. ?>
<!-- this is our fail save in the case we do not use a background header, the format
of the website will use the existing background styling to take its place-->
		<?php 
    if ( get_header_image() && !('blank' == get_header_textcolor()) ) { 
        echo '<div class="site-branding header-background-image" style="background-image: url(' . get_header_image() . ')">'; 
    } else {
        echo '<div class="site-branding">';
    }
    
  
    
?>
		<div class="title-box">
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			</div>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle" aria-controls="menu" aria-expanded="false"><?php _e( 'Primary Menu', 'bradusach' ); ?></button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			<?php bradusach_social_menu(); ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
	
	