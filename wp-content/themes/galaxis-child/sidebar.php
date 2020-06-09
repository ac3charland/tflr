<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Galaxis
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<div class="sidebar">
	<?php do_action( 'galaxis_before_main_sidebar' ); ?>

	<aside id="secondary" class="widget-area sidebar-1" role="complementary" aria-label="<?php esc_attr_e( 'Sidebar', 'galaxis' ); ?>">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</aside><!-- #secondary -->

	<?php do_action( 'galaxis_after_main_sidebar' ); ?>
</div><!-- .columns__md-4 -->
