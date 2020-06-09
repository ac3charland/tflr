<?php
/**
 * The template for displaying archive pages
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
						?>

						<header class="page-header gx-card-content gx-card-content--same-md-y u-b-margin">
							<?php
							the_archive_title( '<h1 class="page-title archive-title">', '</h1>' );
							the_archive_description( '<div class="archive-description">', '</div>' );
							?>
						</header><!-- .page-header -->

						<?php
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
