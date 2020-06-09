<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Galaxis
 */

?>
	</div><!-- #content -->

	<footer id="footer" class="site-footer">
		<?php do_action( 'galaxis_after_footer_start' ); ?>

		<section class="site-footer__text">
			<div class="wrapper">
				<div class="columns columns--gutters-large v-center-mdl">

					<div class="columns__md-4 columns__md-4--larger">
						<?php get_template_part( 'template-parts/footer/copyright' ); ?>
					</div>

					<?php if ( has_nav_menu( 'footer' ) ) { ?>
					<div class="columns__md-8 columns__md-8--smaller">
						<nav class="footer-menu">
							<?php
							wp_nav_menu(
								array(
									'theme_location' => 'footer',
									'depth'          => 1,
									'menu_id'        => 'footer-menu',
								)
							);
							?>
						</nav>
					</div>
					<?php } ?>

				</div>
			</div>
		</section>

		<?php do_action( 'galaxis_before_footer_end' ); ?>
	</footer><!-- #footer -->

	<?php if ( get_theme_mod( 'set_back_to_top', true ) ) { ?>
	<a href="#" class="back-to-top"><span class="screen-reader-text"><?php esc_html_e( 'Back to Top', 'galaxis' ); ?></span></a>
	<?php } ?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
