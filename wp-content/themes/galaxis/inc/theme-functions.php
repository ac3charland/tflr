<?php
/**
 * Main theme functions
 *
 * @package Galaxis
 */

if ( ! function_exists( 'galaxis_show_excerpt' ) ) {
	/**
	 * Find out if we should show the excerpt or the content.
	 *
	 * @return bool Whether to show the excerpt.
	 */
	function galaxis_show_excerpt() {
		global $post;

		// Check if the more tag is being used.
		$more_tag = apply_filters( 'galaxis_more_tag', strpos( $post->post_content, '<!--more-->' ) );

		$format = ( false !== get_post_format() ) ? get_post_format() : 'standard';

		$show_excerpt = ( 'summary' === get_theme_mod( 'set_blog_content', 'summary' ) );

		$show_excerpt = ( 'standard' !== $format ) ? false : $show_excerpt;

		$show_excerpt = ( $more_tag ) ? false : $show_excerpt;

		$show_excerpt = ( is_search() ) ? true : $show_excerpt;

		return apply_filters( 'galaxis_show_excerpt', $show_excerpt );
	}
}

if ( ! function_exists( 'galaxis_show_topbar' ) ) {
	/**
	 * Find out if we should show the topbar.
	 *
	 * @return bool Whether to show the excerpt.
	 */
	function galaxis_show_topbar() {
		return ( get_theme_mod( 'set_topbar_text', '' ) || has_nav_menu( 'social' ) );
	}
}

/**
 * Get sticky main menu class name.
 *
 * @return string
 */
function galaxis_sticky_main_menu_class() {
	$sticky_main_menu = get_theme_mod( 'set_sticky_main_menu', true );

	if ( $sticky_main_menu ) {
		return 'site-menu-content--sticky';
	}

	return '';
}

if ( ! function_exists( 'galaxis_site_info_allowed_tags' ) ) {
	/**
	 * Get allowed tags for site info.
	 * Used for copyright and topbar text.
	 *
	 * @return string
	 */
	function galaxis_site_info_allowed_tags() {
		return array(
			'span'   => array( 'class' => array() ),
			'i'      => array( 'class' => array() ),
			'br'     => array(),
			'em'     => array(),
			'strong' => array(),
			'a'      => array(
				'href'  => array(),
				'title' => array(),
				'rel'   => array(),
				'class' => array(),
			),
		);
	}
}

/**
 * Get copyright text.
 *
 * @return array Copyright text.
 */
function galaxis_copyright() {
	return get_theme_mod( 'set_copyright', galaxis_copyright_default() );
}
