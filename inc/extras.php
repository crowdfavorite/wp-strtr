<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * @package strtr
 */

/**
 * Get orientation of an attachment image.
 *
 * Result is based on the original image, not a resize.
 *
 * @param int $attachment_id
 * @return str|null
 *  One of: 'landscape'|'portrait'|'square' or null if there was a problem.
 */
function strtr_get_image_orientation( $attachment_id ) {
	$return   = null;
	$info     = wp_get_attachment_metadata( $attachment_id );
	if ( $info ) {
		$w = @$info['width'];
		$h = @$info['height'];
		if ( $w > $h ) {
			$return = 'landscape';
		} elseif ( $w < $h ) {
			$return = 'portrait';
		} else {
			$return = 'square';
		}
	}
	return $return;
}

/**
 * Get a post's featured image at a specified size.
 *
 * @see strtr_get_attachment_image_at_size()
 *
 * @param int $post_id ID of post.
 * @param str $size
 * @return str|null
 */
function strtr_get_featured_image_at_size( $post_id, $size = null ) {
	$img_id = get_post_thumbnail_id( $post_id );
	return strtr_get_attachment_image_at_size( $img_id, $size );
}

/**
 * Get an attachment image URL at a specified size.
 *
 * @param int $attachment_id ID of attachment.
 * @param str $size
 * @return str|null
 */
function strtr_get_attachment_image_at_size( $attachment_id, $size = null ) {

	if ( ! $attachment_id || ! is_numeric( $attachment_id ) ) {
		return null;
	}

	$size = ( $size ) ? $size : 'large'; // default to WP's 'large' if no size specified.

	$img_url = null;
	$img = wp_get_attachment_image_src( $attachment_id, $size );
	if ( $img && ! empty( $img[0] ) ) {
		$img_url = $img[0];
	}
	return $img_url;
}

/**
 * Get detailed information about all available image sizes.
 *
 * Adapted from example code at http://j.mp/1wvllzF.
 *
 * @param str $size A single size to return information about.
 * @return array
 *  Returns an array of info about all image sizes or just
 *  $size if it is provided.
 */
function strtr_get_image_sizes( $size = null ) {
	global $_wp_additional_image_sizes;

	$sizes = array();
	$get_intermediate_image_sizes = get_intermediate_image_sizes();

	// Create the full array with sizes and crop info
	foreach( $get_intermediate_image_sizes as $_size ) {
		if ( in_array( $_size, array( 'thumbnail', 'medium', 'large' ) ) ) {
			$sizes[ $_size ]['width'] = get_option( $_size . '_size_w' );
			$sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
			$sizes[ $_size ]['crop'] = (bool) get_option( $_size . '_crop' );
		} elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
			$sizes[ $_size ] = array(
				'width' => $_wp_additional_image_sizes[ $_size ]['width'],
				'height' => $_wp_additional_image_sizes[ $_size ]['height'],
				'crop' =>  $_wp_additional_image_sizes[ $_size ]['crop']
			);
		}
	}

	// Get only 1 size if found
	if ( $size ) {
		if ( isset( $sizes[ $size ] ) ) {
			return $sizes[ $size ];
		} else {
			return false;
		}
	}
	return $sizes;
}

/**
 * Find out if a string has an embedded gallery shortcode.
 *
 * Returns true if the content has one or more galleries embedded in
 * via the `[gallery]` shortcode. Be sure the content has not yet had
 * `apply_filters('the_content')` applied yet.
 *
 * @param str $content
 * @return bool
 */
function strtr_string_has_gallery_shortcode( $content ) {
	// Check the post content for a gallery short code.
	return ( strpos( $content, '[gallery' ) !== false ) ? true : false;
}

/**
 * Get image IDs from a gallery shortcode.
 *
 * Assumes the $gallery param provided is just has a single
 * gallery shortcode within.
 *
 * @param str $gallery
 * @return array
 */
function strtr_get_image_ids_from_gallery_shortcode( $gallery ) {

  $pattern = get_shortcode_regex();
  $matches = array();
  preg_match_all( "/$pattern/" , $gallery, $matches );

  $img_ids = array(); // We'll stash the image IDs here if we find any.

  // We're assuming the provided content has just a single gallery shortcode,
  // so we just grab the first gallery shortcode we find.
  if ( isset( $matches[2][0] ) ) {

    // Loop thru shortcode names to figure out the key to ref within
    // the other child arrays of $matches.
    foreach( $matches[2] as $sc_key => $sc_name ) {
      if ( 'gallery' === strtolower( $sc_name ) ) {

        // Parse the attributes (top-level key 3) for this 2nd-level key.
        $attrs = shortcode_parse_atts( $matches[3][ $sc_key ] );
        if ( is_array( $attrs ) && array_key_exists( 'ids', $attrs ) ) {
          $img_ids_str =  preg_replace( '/\s+/', '', $attrs['ids'] );
          $img_ids = explode( ',', $img_ids_str );
        }
      }
    }
  }
  return $img_ids;
}

/**
 * Get current page in a paginated display.
 *
 * Similar to value in $wp_query->query_vars['paged'], but returns 1 on
 * first page or in a non-paginated view (rather than 0).
 *
 * @return int
 */
function strtr_get_current_page_in_pagination() {
	global $wp_query;
	return empty( $wp_query->query_vars['paged'] ) ? 1 : (int) $wp_query->query_vars['paged'];
}

/**
 * Get a pagenum class to apply individual .hentry items in an aggregated set.
 *
 * This gets applied for you automatically via strtr_post_class().
 *
 * @see strtr_get_current_page_in_pagination()
 * @see strtr_post_class()
 *
 * @return str
 */
function strtr_get_pagination_class_for_hentry() {
	return 'for-pagenum-' . strtr_get_current_page_in_pagination();
}

/**
 * Determine if we're currently on an aggregation view.
 *
 * @return bool
 */
function strtr_is_aggregation_view() {
	return ( is_archive() || is_category() || is_home() || is_search() );
}

/**
 * Get name of the menu assigned to a menu location.
 *
 * @param str $location
 * @return str
 */
function strtr_get_menu_name_for_location( $location ) {

	$return           = '';
	$all_locations    = get_nav_menu_locations();

	if ( isset( $all_locations[ $location ] ) ) {
		$menu = wp_get_nav_menu_object( $all_locations[ $location ] );
		if ( $menu ) {
			$return = $menu->name;
		}
	}

	return $return;
}
