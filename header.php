<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package strtr
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<script>
<!--
// Check for js support (replace no-js class on html)
document.documentElement.className=document.documentElement.className.replace(/\bno-js\b/,'') + ' js';
// Check for SVG support (replace no-svg class on html)
if (!!document.createElementNS && !!document.createElementNS('http://www.w3.org/2000/svg', "svg").createSVGRect) {
  document.documentElement.className=document.documentElement.className.replace(/\bno-svg\b/,'') + ' svg';
}
// -->
</script>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'strtr' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="inner for-masthead">
			<div class="site-branding">
				<div class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></div>
				<p class="site-description"><?php bloginfo( 'description' ); ?></p>
			</div><!-- .site-branding -->

			<nav id="site-navigation" class="primary-menu-slot main-navigation" role="navigation"><?php
				wp_nav_menu( array( 'theme_location' => 'primary_menu_slot', 'menu_id' => 'primary-menu' ) );
			?></nav><!-- #site-navigation -->
		</div><!-- /.inner.for-masthead -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
		<div class="inner for-content">
