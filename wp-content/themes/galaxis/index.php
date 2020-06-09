<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Galaxis
 */

get_header();
?>

	<div class="wrapper u-t-margin">
		<div class="columns columns--gutters">

			<div id="primary" class="content-area columns__md-8 u-b-margin">
				<main id="main" class="site-main" role="main">

					<?php
					if ( have_posts() ) {
						while ( have_posts() ) {
							the_post();
							get_template_part( 'template-parts/content', get_post_type() );
						}

						the_posts_pagination();
					} else {
						get_template_part( 'template-parts/content', 'none' );
					}
					?>

				</main><!-- #main -->
			</div><!-- #primary -->

			<?php get_sidebar(); ?>

		</div><!-- .columns -->
	</div><!-- .wrapper -->

<?php
get_footer();
