<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package strtr
 */

if ( ! is_active_sidebar( 'sidebar-primary' ) ) {
	return;
}

tha_sidebars_before(); ?>
<div id="secondary" class="widget-area" role="complementary"><?php
	tha_sidebar_top();
	dynamic_sidebar( 'sidebar-primary' );
	tha_sidebar_bottom();
?></div><!-- #secondary -->
<?php tha_sidebars_after();