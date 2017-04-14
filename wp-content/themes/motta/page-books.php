<?php
/**
* Template Name: Books page
*
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package Motta
*/

get_header(); ?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">
    <div class="container-fluid">

      <?php
      if (have_posts()) :
        $lastposts = get_posts(array(
          'post_type' => ['book'],
          'posts_per_page' => 10
        ));

        fill_blocks($lastposts);
      else :

        get_template_part('template-parts/content', 'none');

      endif; ?>
    </div><!-- .container -->
  </main><!-- #main -->
</div><!-- #primary -->

<?php

get_footer();
