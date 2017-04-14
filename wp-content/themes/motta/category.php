<?php
/**
* The main template file
*
* This is the most generic template file in a WordPress theme
* and one of the two required files for a theme (the other being style.css).
* It is used to display a page when nothing more specific matches a query.
* E.g., it puts together the home page when no home.php file exists.
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
      $curr_category = get_category(get_query_var('cat'));
      $category_id = $curr_category->term_id;
      $parent = $curr_category->category_parent;

      if ($parent) {
          $parent = get_category($parent);
          $slug = $parent->slug;

          switch ($slug) {
            case 'books':
              $query = get_posts(array(
                'post_type' => ['book'],
                'posts_per_page' => 10,
                'cat' => $category_id
              ));

              fill_blocks($query);
              break;
            default:
              // silent
              break;
          }
      }



      // $args = array('child_of' => get_query_var('cat') );
      // $categories = get_categories($args);
      //
      // $numOfItems = 2; // Set no of category per page
      // $page = isset($_GET['cpage']) ? abs((int) $_GET['cpage']) : 1;
      // $to = $page * $numOfItems;
      // $current = $to - $numOfItems;
      // $total = sizeof($categories);
      //
      // echo '<ul class="content">';
      // for ($i=$current; $i<$to; ++$i) {
      //     $category = $categories[$i];
      //     if ($category->name) {
      //         echo '<li>Category: <a href="' . get_category_link($category->term_id) . '" title="' . sprintf(__("View all posts in %s"), $category->name) . '" ' . '>' . $category->name.'</a></li>';
      //     }
      // }
      // echo '</ul>';
      //
      // unset($category);
      //
      // /* For pagination */
      // echo paginate_links(array(
      //   'base' => add_query_arg('cpage', '%#%'),
      //   'format' => '',
      //   'prev_text' => __('&laquo;'),
      //   'next_text' => __('&raquo;'),
      //   'total' => ceil($total / $numOfItems),
      //   'current' => $page
      // ));
      ?>
    </div><!-- .container -->
  </main><!-- #main -->
</div><!-- #primary -->

<?php

get_footer();
