		</div><!-- .container -->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer <?php if ( ! atzack_setting( 'footer_constrained' ) ) echo 'unconstrained-footer'; if ( is_active_sidebar( 'footer-sidebar' ) ) echo ' footer-active-sidebar'; ?>" role="contentinfo">

		<?php if ( atzack_page_setting( 'display_footer_widgets', true ) ) : ?>
			<div class="container">
				<?php
				if ( is_active_sidebar( 'footer-sidebar' ) ) {
					$zack_sidebars = wp_get_sidebars_widgets();
					?>
					<div class="widgets widgets-<?php echo count( $zack_sidebars['footer-sidebar'] ) ?>" role="complementary" aria-label="<?php esc_html_e( 'Footer Sidebar', 'zack' ); ?>">
						<?php dynamic_sidebar( 'footer-sidebar' ); ?>
					</div>
					<?php
				}
				?>
			</div>
		<?php endif; ?>

		<div class="site-info">
			<div class="container">
				<?php
				zack_footer_text();

				$credit_text = apply_filters(
					'zack_footer_credits',
					sprintf( esc_html__( 'Designed by %s.', 'zack' ), '<a href="https://atzack.com/" rel="designer">AtZack WordPress Themes</a>' )
				);

				if ( ! empty( $credit_text ) ) {
					?>&nbsp;<?php
					echo wp_kses_post( $credit_text );
				}
				?>
			</div><!-- .container -->
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
