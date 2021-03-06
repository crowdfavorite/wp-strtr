<?php
/**
 * strtr functions and definitions
 *
 * @package strtr
 */
show_admin_bar( false );

if ( ! function_exists( 'strtr_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function strtr_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on strtr, use a find and replace
	 * to change 'strtr' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'strtr', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary_menu_slot' => esc_html__( 'Primary Menu Slot', 'strtr' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
// 	add_theme_support( 'post-formats', array(
// 		'aside',
// 		'image',
// 		'video',
// 		'quote',
// 		'link',
// 	) );

}
endif; // strtr_setup
add_action( 'after_setup_theme', 'strtr_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function strtr_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Primary Sidebar', 'strtr' ),
		'id'            => 'sidebar-primary',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'strtr_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function strtr_scripts() {

	$assets_url = get_stylesheet_directory_uri() . '/assets/';

	wp_enqueue_style( 'strtr-style', get_stylesheet_uri() );

	wp_enqueue_script(
		'strtr-skip-link-focus-fix',
		$assets_url . 'js/skip-link-focus-fix.js',
		array(),
		date( "YM" ),
		true
	);

	wp_register_script(
		'strtr-main',
		$assets_url . '/js/main.js',
		array( 'jquery' ),
		date( "YM" ),
		true
	);

	// "Localized" vars to be used by our main JS file.
	$vars = array(
		'ajaxUrl' => admin_url( 'admin-ajax.php' ),
	);
	wp_localize_script( 'strtr-main', 'strtrThemeVars', $vars );
	wp_enqueue_script( 'strtr-main' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'strtr_scripts' );

/**
 * Add-to and modify the CSS classes applied to body tag.
 */
function strtr_body_class( $classes ) {

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	if ( strtr_is_aggregation_view() ) {
		$classes[] = 'aggregation-view';
	} else {
		$classes[] = 'non-aggregation-view';
	}

	return $classes;
}
add_filter( 'body_class', 'strtr_body_class' );

/**
 * Add custom CSS classes to posts via post_class filter.
 */
function strtr_post_class( $classes, $class, $post_id ) {

	global $wp_query;

	if ( isset( $wp_query->current_post ) ) {
		// Class for which result this item is within the loop where it's being called.
		$classes[] = 'loop-item-' . intval( $wp_query->current_post + 1 );
		// Class for which pagination page this is being rendered inside.
		$classes[] = strtr_get_pagination_class_for_hentry();
	}
	return $classes;
}
add_filter( 'post_class', 'strtr_post_class', 10, 3 );

/**
 * Apply "async=async" attribute to selected enqueued JS.
 *
 * Any scripts you wish to have marked as "async" should be added within this
 * method to the `$async_js` array. Only useful on script tags that include
 * an `src` attribute (not inline scripts).
 *
 * The `async` attribute:
 *
 * "HTML parsing may continue and the script will be executed as soon as
 *  it's ready."
 * (From {@link http://peter.sh/experiments/asynchronous-and-deferred-javascript-execution-explained/)
 *
 * Call via `script_loader_tag` filter.
 *
 * @see https://developer.wordpress.org/reference/hooks/script_loader_tag/
 *
 * @return str
 */
function strtr_async_scripts( $tag, $handle ) {

	// Populate with script handles to be async.
	$async_js = array(
		// ...
	);

	if ( in_array( $handle, $async_js ) ) {
		return str_replace( ' src', ' async="async" src', $tag );
	}
	return $tag;
}
add_filter( 'script_loader_tag', 'strtr_async_scripts', 10, 2 );

/**
 * Apply "defer=defer" attribute to selected enqueued JS.
 *
 * Any scripts you wish to have marked as "defer" should be added within this
 * method to the `$defer_js` array. Only useful on script tags that include
 * an `src` attribute (not inline scripts).
 *
 * The `defer` attribute:
 *
 * "Simply put: delaying script execution until the HTML parser has finished.
 *  A positive effect of this attribute is that the DOM will be available for
 *  your script."
 * (From {@link http://peter.sh/experiments/asynchronous-and-deferred-javascript-execution-explained/)
 *
 * Call via `script_loader_tag` filter.
 *
 * @see https://developer.wordpress.org/reference/hooks/script_loader_tag/
 *
 * @return str
 */
function strtr_defer_scripts( $tag, $handle ) {

	// Populate with script handles to be deferred.
	$defer_js = array(
		// ...
	);

	if ( in_array( $handle, $defer_js ) ) {
		return str_replace( ' src', ' defer="defer" src', $tag );
	}
	return $tag;
}
add_filter( 'script_loader_tag', 'strtr_defer_scripts', 10, 2 );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
