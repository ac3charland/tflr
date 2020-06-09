<?php
/**
 * Sets all of our theme defaults.
 *
 * @package Galaxis
 */

if ( ! function_exists( 'galaxis_get_color_defaults' ) ) {
	/**
	 * Set default options.
	 */
	function galaxis_get_color_defaults() {
		return apply_filters(
			'galaxis_color_option_defaults',
			array(
				'topbar_bg_color'            => '#1291ee',
				'back_to_top_bg_color'       => '#299cf0',
				'back_to_top_hover_bg_color' => '#333333',
				'footer_bg_color'            => '#081d56',
			)
		);
	}
}

if ( ! function_exists( 'galaxis_copyright_default' ) ) {
	/**
	 * Set default copyright text.
	 */
	function galaxis_copyright_default() {
		/* translators: %s: blog name */
		return sprintf( esc_html__( 'Copyright &copy; %s. All rights reserved.', 'galaxis' ), get_bloginfo( 'name', 'display' ) );
	}
}
