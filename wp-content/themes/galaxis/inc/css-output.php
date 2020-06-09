<?php
/**
 * Output all of our dynamic CSS
 *
 * @package Galaxis
 */

if ( ! function_exists( 'galaxis_get_customizer_css' ) ) {
	/**
	 * Output the CSS in the <head> section using the Theme Customizer.
	 */
	function galaxis_get_customizer_css() {
		$default_colors = galaxis_get_color_defaults();

		$galaxis_colors = wp_parse_args(
			get_theme_mod( 'galaxis_colors', array() ),
			$default_colors
		);

		$css = new Galaxis_CSS();

		if ( $galaxis_colors['topbar_bg_color'] !== $default_colors['topbar_bg_color'] ) {
			$css->set_selector( '.site-topbar' );
			$css->add_property( 'background-color', esc_attr( $galaxis_colors['topbar_bg_color'] ) );
		}

		if ( $galaxis_colors['back_to_top_bg_color'] !== $default_colors['back_to_top_bg_color'] ) {
			$css->set_selector( '.back-to-top' );
			$css->add_property( 'background-color', esc_attr( $galaxis_colors['back_to_top_bg_color'] ) );
		}

		if ( $galaxis_colors['back_to_top_hover_bg_color'] !== $default_colors['back_to_top_hover_bg_color'] ) {
			$css->set_selector( '.back-to-top:hover' );
			$css->add_property( 'background-color', esc_attr( $galaxis_colors['back_to_top_hover_bg_color'] ) );
		}

		if ( $galaxis_colors['footer_bg_color'] !== $default_colors['footer_bg_color'] ) {
			$css->set_selector( '.site-footer__text' );
			$css->add_property( 'background-color', esc_attr( $galaxis_colors['footer_bg_color'] ) );
		}

		do_action( 'galaxis_colors_css', $css );

		return apply_filters( 'galaxis_css_output', $css->css_output() );
	}
}
