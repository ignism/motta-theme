<?php
/**
* Template part for displaying posts
*
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package Motta
*/

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="container-fluid">
    <header class="entry-header">
      <div class="row">
        <div class="col-xs-12">
          <?php
          if ($header_image = get_field('header_image')) {
            echo '<img src="' . $header_image['sizes']['large'] . '">';
          }
          ?>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
          <span class="entry-tag">
            <?php
            $tag = get_post_type() . ' ';
            $categories = get_the_category();
            if ($categories) {
              foreach ($categories as $category) {
                $name = $category->name;
                if ($name != 'Uncategorized') {
                  $tag .= $category->name . ' ';
                }
              }
            }
            echo $tag;
            ?>
          </span>
          <?php
          the_title('<h1 class="entry-title">', '</h1>');
          ?>
        </div>
      </div>
    </header><!-- .entry-header -->

    <div class="entry-content">
      <?php
      if ($details = get_field('content_details')) {
        $html = '';
        $html .= '<div class="row">';
        $html .= '<div class="col-sm-10 col-sm-offset-1 entry-details">';
        $html .= $details;
        $html .= '</div>';
        $html .= '</div>';

        echo $html;
      }
      ?>
      <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
          <?php
          the_content();
          ?>
        </div>
      </div>

      <?php
      if ($action = get_field('content_action_button_type')) {
        if ($action != 'none') {
          $html = '';
          $html .= '<div class="row">';
          $html .= '<div class="col-sm-10 col-sm-offset-1">';
          $html .= '<span class="entry-action">';

          switch ($action) {
            case 'url':
            $_url = get_field('content_action_button_url');
            $html .= '<a target="_blank" href="' . $_url . '">' . $_url . '</a>';
            break;
            case 'post':
            $_post = get_field('content_action_button_post');
            $_title = get_the_title($_post->ID);
            $_url = get_the_permalink($_post->ID);
            $html .= '<a href="' . $_url . '">' . $_title . '</a>';
            break;
            default:
            $text = get_field('content_action_button_text');
            $html .= $text;
            break;
          }

          $html .= '</span>';
          $html .= '</div>';
          $html .= '</div>';
        }

        echo $html;
      }

      if ($custom_blocks = get_field('custom_blocks')) {
        fill_custom_blocks($custom_blocks);
      }

      ?>

    </div><!-- .entry-content -->

    <footer class="entry-footer">
      <?php
      // custom fill selected blocks

      if ($page_block_posts = get_field('page_block_posts')) {
        $posts = array();
        foreach ($page_block_posts as $block) {
          $curr_post = $block['block'];
          array_push($posts, $curr_post);
        }


        if ($posts) {
          echo '<div class="text-center"><h2>Related books</h2></div>';
          fill_blocks($posts);
        }
      }


       ?>


      <?php
      //random fill by category

      $curr_category = get_the_category();
      $query = '';

      if ($curr_category) {
        $category_ids = array();

        foreach ($curr_category as $category) {
          array_push($category_ids, $category->term_id);
        }
        $query = get_posts(array(
          'post_type' => ['product'],
          'post__not_in' => [get_the_ID()],
          'posts_per_page' => 10,
          'orderby' => 'rand',
          'category__in' => $category_ids
        ));
      } else {
        $query = get_posts(array(
          'post__not_in' => [get_the_ID()],
          'post_type' => ['topic'],
          'posts_per_page' => 10,
          'cat' => $category_id
        ));
      }
      if ($query) {
        echo '<div class="text-center"><h2>Discover more ' . $curr_category[0]->name . '</h2></div>';
        fill_blocks($query);
      }

      ?>
    </footer><!-- .entry-footer -->
  </div>
</article><!-- #post-## -->
