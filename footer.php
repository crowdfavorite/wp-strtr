<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package strtr
 */

?>
		<?php tha_content_bottom(); ?>
		</div><!-- /.inner.for-content -->
	</div><!-- #content -->

	<?php tha_footer_before(); ?>
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="inner for-colophon">
			<?php tha_footer_top(); ?>

			<div class="site-info">

				<div><a href="<?php echo esc_url( __( 'https://wordpress.org/', 'strtr' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'strtr' ), 'WordPress' ); ?></a></div>

			</div><!-- .site-info -->
			<?php tha_footer_bottom(); ?>
		</div><!-- /.inner.for-colophon -->
	</footer><!-- #colophon -->
	<?php tha_footer_after(); ?>

</div><!-- #page -->

<?php tha_body_bottom(); ?>
<?php wp_footer(); ?>

</body>
</html>
