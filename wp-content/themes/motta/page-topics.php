<?php
/**
* Template Name: Topics page
*
* @link https://codex.wordpress.org/Template_Hierarchy
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

          <div class="container-fluid"><!--  center-body -->

            <?php
            if (have_posts()) {
                $lastposts = get_posts(array(
                'post_type' => ['topic'],
                'posts_per_page' => 1000
              ));

                fill_blocks($lastposts);
            }
            ?>

          </div><!--  center-body -->

        </div>
      </div>
      <!-- Skeleton -->
    </div><!-- .container -->
  </main><!-- #main -->
</div><!-- #primary -->

<?php

get_footer();
