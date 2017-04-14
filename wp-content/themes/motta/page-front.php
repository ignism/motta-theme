<?php
/**
* Template Name: Front page
*
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package Motta
*/

get_header();

$page_id = get_the_ID();
setup_postdata($page_id);
?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">
    <div class="container-fluid">
      <div class="row">
          <?php
          $html = '';
          if ($header_block = get_field('header_block', $page_id)) {
              if ($header_image = get_field('header_image', $header_block->ID)) {
                  $html .= '<div class="col-sm-8 col-sm-offset-1">';
                  $html .= '<img src="' . $header_image['sizes']['large'] . '">';
                  $html .= '</div>';
              }

              if ($category = get_the_category($header_block->ID)) {
                  $categories = array();
                  foreach ($category as $curr_category) {
                      array_push($categories, $curr_category->term_id);
                  }

                  $related_post = get_posts(array(
                    'post_type' => ['book'],
                    'posts_per_page' => 1,
                    'category__in' => $categories
                  ))[0];

                  $html .= '<div class="hidden-xs col-sm-2">';

                  if ($related_image = get_field('image', $related_post->ID)) {
                      $html .= '<img src="' . $related_image['sizes']['medium'] . '">';
                  } else {
                      $related_image = get_field('header_image', $header_block->ID);
                      $html .= '<img src="' . $related_image['sizes']['medium'] . '">';
                  }
                  $html .= '</div>';
              }
          }
          echo $html;
          ?>
      </div>

      <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
          <div class="front-content">
            <?php
            the_content();
            wp_reset_postdata();
            ?>
          </div>
        </div>
      </div>


      <?php
      if ($page_block_posts = get_field('page_block_posts')) {
          $posts = array();
          foreach ($page_block_posts as $block) {
              $curr_post = $block['block'];
              array_push($posts, $curr_post);
          }

          fill_blocks($posts);
      }
      ?>

    </div><!-- .container -->
  </main><!-- #main -->
</div><!-- #primary -->

<?php

get_footer();
