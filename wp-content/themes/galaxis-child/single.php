<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Galaxis
 */

get_header();
?>

	<div class="flex-container">
		<div id="primary" class="articles-wrapper wrapper">
			<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) {
				the_post();

				get_template_part( 'template-parts/content', 'single' );

				the_post_navigation(
					array(
						'next_text' => '<div class="gx-card-content gx-card-content--same-md-y"><span class="meta-nav" aria-hidden="true">' . esc_html__( 'Next Post', 'galaxis' ) . '</span> ' .
							'<span class="screen-reader-text">' . esc_html__( 'Next post:', 'galaxis' ) . '</span> <br/>' .
							'<span class="post-title">%title</span></div>',
						'prev_text' => '<div class="gx-card-content gx-card-content--same-md-y"><span class="meta-nav" aria-hidden="true">' . esc_html__( 'Previous Post', 'galaxis' ) . '</span> ' .
							'<span class="screen-reader-text">' . esc_html__( 'Previous post:', 'galaxis' ) . '</span> <br/>' .
							'<span class="post-title">%title</span></div>',
					)
				);

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
			}
			?>

			</main><!-- #main -->
		</div><!-- #primary -->

		<?php get_sidebar(); ?>

	</div><!-- .wrapper -->

<?php
get_footer();
