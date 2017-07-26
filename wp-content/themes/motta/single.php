<?php
/**
* The template for displaying all single posts
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
*
* @package Motta
*/

get_header(); ?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">
    <div class="container-fluid">

      <!--  Skeleton -->
      <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
              
              <?php
              while (have_posts()) {
                  the_post();
                  get_template_part('template-parts/content', get_post_type());
              }
              ?>

        </div>
      </div>

    </div>
  </main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();