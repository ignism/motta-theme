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

      <!--  Skeleton -->
      <div class="row">
        <div class="col-sm-10 col-sm-offset-1">

          <div class="container-fluid"><!--  center-body -->

            <?php
            $curr_category = get_category(get_query_var('cat'));
            $category_id = $curr_category->term_id;
            $category_name = $curr_category->name;
            $parent = $curr_category->category_parent;

            if ($parent) {
                $parent = get_category($parent);
                $slug = $parent->slug;

                switch ($slug) {
                case 'books':

                echo '<h2>' . $category_name . ' ' . $parent->name . '</h2>';

                $query = get_posts(array(
                  'post_type' => ['book'],
                  'posts_per_page' => 10,
                  'cat' => $category_id
                ));

                fill_blocks_with_category($query, $category_name);
                break;
                default:
                // silent
                break;
              }
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
