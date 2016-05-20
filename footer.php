<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package strtr
 */

?>
		</div><!-- /.inner.for-content -->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="inner for-colophon">

			<div class="site-info">

				<div><a href="<?php echo esc_url( __( 'https://wordpress.org/', 'strtr' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'strtr' ), 'WordPress' ); ?></a></div>

			</div><!-- .site-info -->
		</div><!-- /.inner.for-colophon -->
	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
