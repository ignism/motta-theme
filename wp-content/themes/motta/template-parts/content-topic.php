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
          $html = '';
          $html .= '<div class="row">';
          $html .= '<div class="col-sm-10 col-sm-offset-1">';
          $html .= '<span class="entry-action">';

          switch ($action) {
          case 'url':
          $html .= get_field('content_action_button_url');
          break;
          case 'post':
          $html .= get_field('content_action_button_post');
          default:
          $text = get_field('content_action_button_text');
          $html .= $text;
          break;
        }

          $html .= '</span>';
          $html .= '</div>';
          $html .= '</div>';

          echo $html;
      }
      ?>
      <div class="row">

        <?php
        if ($custom_blocks = get_field('custom_blocks')) {
            fill_custom_blocks($custom_blocks);
        }

        ?>
      </div>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
      ontdek meer

      <?php
      $curr_category = get_the_category();

      if ($curr_category) {
      } else {
          $query = get_posts(array(
          'post__not_in' => [get_the_ID()],
          'post_type' => ['topic'],
          'posts_per_page' => 5,
          'cat' => $category_id
        ));
          fill_blocks($query);
      }
      ?>
    </footer><!-- .entry-footer -->
  </div>
</article><!-- #post-## -->
