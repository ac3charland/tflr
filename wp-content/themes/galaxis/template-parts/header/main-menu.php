<?php
/**
 * Template part for displaying the main menu
 *
 * @package Galaxis
 */

?>

<div class="site-menu-content <?php echo esc_attr( galaxis_sticky_main_menu_class() ); ?>">
	<div class="site-menu-content__wrap wrapper">
		<div class="site-branding">
			<?php
			if ( has_custom_logo() ) {
				the_custom_logo();
			}
			?>
			<div class="site-branding__title-wrap">
				<?php
				if ( is_front_page() && is_home() ) {
					?>
					<h1 class="site-title"><a class="site-link" href="<?php echo esc_url( home_url() ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
				} else {
					?>
					<p class="site-title"><a class="site-link" href="<?php echo esc_url( home_url() ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
				}
				?>
				<p class="site-description"><?php bloginfo( 'description' ); ?></p>
			</div><!-- .site-branding__title-wrap -->
		</div><!-- .site-branding -->

		<?php if ( has_nav_menu( 'menu-1' ) || class_exists( 'WooCommerce' ) ) { ?>
		<nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'galaxis' ); ?>">

			<?php if ( has_nav_menu( 'menu-1' ) ) { ?>
				<button type="button" class="menu-button menu-toggle" aria-controls="primary-menu" aria-expanded="false">
					<span class="screen-reader-text"><?php esc_html_e( 'Primary Menu', 'galaxis' ); ?></span>
					<span class="main-navigation__icon">
						<span class="main-navigation__icon__middle"></span>
					</span>
				</button>
				<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'menu-1',
						'depth'           => 3,
						'menu_id'         => 'primary-menu',
						'container_class' => 'primary-menu-container',
						'walker'          => new Galaxis_Primary_Walker_Nav_Menu(),
					)
				);
				?>
			<?php } ?>

			<?php if ( class_exists( 'WooCommerce' ) ) { ?>
				<div class="site-cart-account">
					<div class="site-cart">
						<?php galaxis_woocommerce_header_cart(); ?>
					</div><!-- .site-cart -->

					<ul class="site-account-links">
						<?php galaxis_woocommerce_account_links(); ?>
					</ul><!-- .site-account-links -->
				</div><!-- .site-cart-account -->
			<?php } ?>

		</nav><!-- #site-navigation -->
		<?php } ?>
	</div><!-- .site-menu-content__wrap -->
</div><!-- .site-menu-content -->
