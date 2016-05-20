<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package strtr
 */

if ( ! is_active_sidebar( 'sidebar-primary' ) ) {
	return;
}
?>
<div id="secondary" class="widget-area" role="complementary"><?php
	dynamic_sidebar( 'sidebar-primary' );
?></div><!-- #secondary -->
