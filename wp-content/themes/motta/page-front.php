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

      <!--  Skeleton -->
      <div class="row">
        <div class="col-sm-10 col-sm-offset-1">

          <div class="container-fluid"><!--  center-body -->

            <div class="row">
              <?php
              $html = '';
              if ($header_block = get_field('header_block', $page_id)) {
                  if ($header_image = get_field('header_image', $header_block->ID)) {
                      $html .= '<div class="col-sm-8">';
                      $html .= '<img src="' . $header_image['sizes']['large'] . '">';
                      $html .= '</div>';
                  }

                  if ($category = get_the_category($header_block->ID)) {
                      $category_ids = array();

                      foreach ($category as $curr_category) {
                          array_push($category_ids, $curr_category->term_id);
                      }

                      $related_post = get_posts(array(
                    'post_type' => ['book'],
                    'posts_per_page' => 1,
                    'category_in' => $category_ids
                  ))[0];

                      $category = get_the_category($related_post->ID);
                      $tag = '';
                      foreach ($category as $curr_category) {
                          if ($curr_category->name != 'Uncategorized') {
                              $tag .= $curr_category->name;
                              $tag .= ' ';
                          }
                      }
                      $title = get_the_title($related_post->ID);

                      $html .= '<div class="hidden-xs col-sm-4">';

                      if ($related_image = get_field('image', $related_post->ID)) {
                          $html .= '<img src="' . $related_image['sizes']['medium'] . '">';
                      } else {
                          $related_image = get_field('header_image', $related_post->ID);
                          $html .= '<img src="' . $related_image['sizes']['medium'] . '">';
                      }
                      if ($tag != '') {
                          $html .= '<div class="block__tag">' . $tag . '</div>';
                      }
                      $html .= '<div class="block__title">' . $title . '</div>';
                      $html .= '</div>';
                  }
              }
              echo $html;
              ?>
            </div>

            <div class="row">
              <div class="col-sm-10 col-sm-offset-1 block">
                <div class="front-content block--text">
                  <div class="block__text">
                    <?php
                    the_content();
                    wp_reset_postdata();
                    ?>
                  </div>
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

          </div><!--  center-body -->

        </div>
      </div>
      <!-- Skeleton -->

    </div><!-- .container -->
  </main><!-- #main -->
</div><!-- #primary -->

<?php

get_footer();
