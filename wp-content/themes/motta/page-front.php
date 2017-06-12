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

<?php
// function fetchData($url)
// {
//     $ch = curl_init();
//     curl_setopt($ch, CURLOPT_URL, $url);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//     curl_setopt($ch, CURLOPT_TIMEOUT, 20);
//     $result = curl_exec($ch);
//     curl_close($ch);
//     return $result;
// }
// $access_token = get_field('instagram', 16);
// $user = explode('.', $access_token)[0];
// $url = 'https://api.instagram.com/v1/users/' . $user . '/media/recent/?access_token=' . $access_token;
//
// $result = fetchData($url);
// $result = json_decode($result);
//
// $instagram_post = array();
// foreach ($result->data as $post) {
//
//     $instagram_post['username'] = $post->user->username;
//     $instagram_post['image_url'] = $post->images->standard_resolution->url;
//     $instagram_post['tags'] = $post->tags;
//     $instagram_post['date'] = date('j M Y', $post->created_time);
//     $instagram_post['url'] = $post->link;
//     $instagram_post['likes'] = $post->likes;
//
//     break;
// }

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
                $permalink = get_the_permalink($header_block->ID);
                $title_left = get_the_title($header_block->ID);
                $size_left = get_field('header_block_size',  $page_id);

                $size_class = '';
                switch($size_left) {
                  case 'sm':
                    $size_class = ' col-sm-4';
                  break;
                  case 'lg':
                    $size_class = ' col-sm-8';
                  break;
                  default:
                    $size_class = ' col-sm-6';
                  break;
                }

                if ($header_block->post_type == 'sticky') {
                  $html .= '<div class="frontpage__block col-xs-6' . $size_class . '">';
                  $html .= generate_frontpage_block($header_block, 0);
                  $html .= '</div>';
                } else {
                  if ($header_image = get_field('header_image', $header_block->ID)) {
                    $html .= '<div class="col-xs-6' . $size_class . '">';
                    $html .= '<a href="' . $permalink . '">';
                    $html .= '<img src="' . $header_image['sizes']['large'] . '">';
                    $html .= '<div class="block__title">' . $title_left . '</div>';
                    $html .= '</a>';
                    $html .= '</div>';
                  }
                }

                if ($header_block_right = get_field('header_block_right', $page_id)) {
                  $permalink_right = get_the_permalink($header_block_right->ID);
                  $title_right = get_the_title($header_block_right->ID);
                  $size_right = get_field('header_block_right_size',  $page_id);
                  $size_class = '';
                  switch($size_right) {
                    case 'sm':
                      $size_class = ' col-sm-4';
                    break;
                    case 'lg':
                      $size_class = ' col-sm-8';
                    break;
                    default:
                      $size_class = ' col-sm-6';
                    break;
                  }

                  if ($header_block_right->post_type == 'sticky') {
                    $html .= '<div class="frontpage__block col-xs-6' . $size_class . '">';
                    $html .= generate_frontpage_block($header_block_right, 0);
                    $html .= '</div>';
                  } else {
                    if ($header_image = get_field('header_image', $header_block_right->ID)) {
                      $html .= '<div class="col-xs-6' . $size_class . '">';
                      $html .= '<a href="' . $permalink_right . '">';
                      $html .= '<img src="' . $header_image['sizes']['large'] . '">';
                      $html .= '<div class="block__title">' . $title_right. '</div>';
                      $html .= '</a>';
                      $html .= '</div>';
                    }
                  }
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
