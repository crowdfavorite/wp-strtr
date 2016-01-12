<?php
/**
 * The template for displaying all single posts.
 *
 * @package strtr
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php tha_content_while_before(); ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php tha_entry_before(); ?>

				<?php get_template_part( 'template-parts/content', 'single' ); ?>

				<?php the_post_navigation(); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>
				<?php tha_entry_after(); ?>
			<?php endwhile; // End of the loop. ?>
			<?php tha_content_while_after(); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
