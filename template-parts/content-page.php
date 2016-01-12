<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package strtr
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php tha_entry_top(); ?>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php tha_entry_content_before(); ?>
		<?php the_content(); ?>
		<?php tha_entry_content_after(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'strtr' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php edit_post_link( esc_html__( 'Edit', 'strtr' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
	<?php tha_entry_bottom(); ?>
</article><!-- #post-## -->

