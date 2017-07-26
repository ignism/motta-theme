<?php
/**
* The template for displaying search results pages
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
*
* @package Motta
*/

get_header(); ?>

<section id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div class="container-fluid">

			<!--  Skeleton -->
			<div class="row">
				<div class="col-sm-10 col-sm-offset-1">

					<div class="container-fluid"><!--  center-body -->

						<?php if (have_posts()) { ?>
							<header class="page-header">
								<h2 class="page-title">Search results for:
									<?php echo get_search_query(); ?>
								</h2>
							</header><!-- .page-header -->

							<?php

							fill_blocks($posts);

						}
						?>

					</div>

				</div>
			</div>

		</main><!-- #main -->
	</section><!-- #primary -->

	<?php
	get_sidebar();
	get_footer();
