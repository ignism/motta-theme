<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Motta
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<div class="row">
						<div class="col-sm-10 col-sm-offset-1">
<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'motta' ); ?></h1>
						</div>

					</div>
				</header><!-- .page-header -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
