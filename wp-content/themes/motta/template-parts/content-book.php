<?php
/**
* Template part for displaying posts
*
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package Motta
*/

?>

<?php
  $aos_type = 'fade-right';
  $aos_delay = '0';
  $aos = 'data-aos="'. $aos_type . '" data-aos-delay="' . $aos_delay . '"';
 ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="container-fluid">
    <header class="entry-header">
      <div class="row">
        <div <?php echo $aos ?> class="col-xs-12">
          <?php
          if ($header_image = get_field('header_image')) {
            echo '<img src="' . $header_image['sizes']['large'] . '">';
          }
          ?>
        </div>
      </div>
      <div class="row">
        <?php
          $aos_type = 'fade-left';
          $aos_delay = '0';
          $aos = 'data-aos="'. $aos_type . '" data-aos-delay="' . $aos_delay . '"';
         ?>

        <div  <?php echo $aos ?>  class="col-sm-10 col-sm-offset-1">
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

    <?php
      $aos_type = 'fade-up';
      $aos_delay = '200';
      $aos = 'data-aos="'. $aos_type . '" data-aos-delay="' . $aos_delay . '"';
     ?>


    <div class="entry-content">
      <?php
      if ($details = get_field('content_details')) {
        $html = '';
        $html .= '<div class="row">';
        $html .= '<div ' . $aos . ' class="col-sm-10 col-sm-offset-1 entry-details">';
        $html .= $details;
        $html .= '</div>';
        $html .= '</div>';

        echo $html;
      }

        $aos_type = 'fade-up';
        $aos_delay = '400';
        $aos = 'data-aos="'. $aos_type . '" data-aos-delay="' . $aos_delay . '"';


      if ($product_id = get_field('store_product')) {

        $currency = get_woocommerce_currency_symbol();
        $price = get_post_meta($product_id, '_regular_price', true);
        $stock_status = get_post_meta($product_id, '_stock_status', true);



        $html = '';
        $html .= '<div class="row">';
        $html .= '<div ' . $aos . ' class="col-sm-10 col-sm-offset-1 entry-store-product">';
        $html .= '<span class="price">' . $currency . $price . '</span>';

        if ($stock_status == 'instock') {
          $html .= '<a href="'.site_url().'/?add-to-cart='.$product_id.'" rel="nofollow" data-product_id="'.$product_id.'" data-product_sku=""><span class="order"> <i class="fa fa-shopping-cart" aria-hidden="true"></i></span></a>';
        } else {
          $html .= ' - sold out';
        }

        $html .= '</div>';
        $html .= '</div>';

        echo $html;
      }

      $aos_type = 'fade-up';
      $aos_delay = '800';
      $aos = 'data-aos="'. $aos_type . '" data-aos-delay="' . $aos_delay . '"';

      ?>
      <div <?php echo $aos ?> class="row">
        <div class="col-sm-10 col-sm-offset-1">
          <?php
          the_content();
          ?>
        </div>
      </div>

      <?php
      $action = get_field('content_action_button_type');
      if ($action != 'none') {
        if (get_field('content_action_button_url') ||
        get_field('content_action_button_url') ||
        get_field('content_action_button_url')) {
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
          echo $html;
        }
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

          if ($curr_post->post_type == 'book') {
            array_push($posts, $curr_post);
          } else {
            // its an topic, so find books in topic, non recursivly
            if ($topic_page_block_posts = get_field('page_block_posts', $curr_post->ID)) {
              foreach ($topic_page_block_posts as $topic_block) {
                $topic_curr_post = $topic_block['block'];
                if ($topic_curr_post->post_type == 'book') {
                  array_push($posts, $topic_curr_post);
                }
              }
            }
          }
        }

        // filter duplicates
        $filtered_posts = array();

        foreach ($posts as $block_post) {
          $is_unique = true;
          foreach ($filtered_posts as $filtered_block_post) {
            if ($block_post->ID == $filtered_block_post->ID) {
              $is_unique = false;
              break;
            }
          }
          if ($is_unique) {
            array_push($filtered_posts, $block_post);
          }
        }

        if ($filtered_posts) {
          echo '<div class="text-center"><h2>Related books</h2></div>';
          fill_blocks($filtered_posts);
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
          'post_type' => ['topic', 'book'],
          'post__not_in' => [get_the_ID()],
          'posts_per_page' => 5,
          'orderby' => 'rand',
          'category__in' => $category_ids
        ));
      } else {
        $query = get_posts(array(
          'post__not_in' => [get_the_ID()],
          'post_type' => ['topic'],
          'posts_per_page' => 5,
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
