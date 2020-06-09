<?php
/**
 * Template part for displaying the topbar text
 *
 * @package Galaxis
 */

$topbar_text = get_theme_mod( 'set_topbar_text', '' );

if ( '' !== $topbar_text ) {
	?>
	<div class="site-topbar-text site-topbar__left">
		<?php
		echo wp_kses(
			$topbar_text,
			galaxis_site_info_allowed_tags()
		);
		?>
	</div>
	<?php
}
