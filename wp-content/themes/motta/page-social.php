<?php
/**
* Template Name: Social page
*
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package Motta
*/

get_header(); ?>

  <?php

$access_token = get_field('instagram');
$user = explode('.', $access_token)[0];
$url = 'https://api.instagram.com/v1/users/' . $user . '/media/recent/?access_token=' . $access_token;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 20);
$result = curl_exec($ch);
curl_close($ch);

$result = json_decode($result);

$instagram_posts = array();

foreach ($result->data as $post) {
    $instagram_post['username'] = $post->user->username;
    $instagram_post['image_url'] = $post->images->standard_resolution->url;
    $instagram_post['tags'] = $post->tags;
    $instagram_post['date'] = date('j M Y', $post->created_time);
    $instagram_post['url'] = $post->link;
    $instagram_post['likes'] = $post->likes;

    array_push($instagram_posts, $instagram_post);
}


if (have_posts()) {
    $shortcodes = get_posts(array(
    'post_type' => ['social_post'],
    'posts_per_page' => 10
  ));

  foreach ($shortcodes as $shortcode ) {
    $key = get_field('instagram_shortcode', $shortcode->ID);

    $url = 'https://api.instagram.com/v1/media/shortcode/' . $key . '?access_token=' . $access_token;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
    $result = curl_exec($ch);
    curl_close($ch);
    $result = json_decode($result);

    $post = $result->data;

    $instagram_post['username'] = $post->user->username;
    $instagram_post['image_url'] = $post->images->standard_resolution->url;
    $instagram_post['tags'] = $post->tags;
    $instagram_post['date'] = date('j M Y', $post->created_time);
    $instagram_post['url'] = $post->link;
    $instagram_post['likes'] = $post->likes;

    array_push($instagram_posts, $instagram_post);

  }
}


// -----------------------------------------------------------------------------

// $media_id = '477570036_17251291';
// $url = 'https://api.instagram.com/v1/media/' . $media_id . '?access_token=' . $access_token;
// $result = fetchData($url);
// $result = json_decode($result);

// -----------------------------------------------------------------------------

// $key = 'cdyP0';
// $url = 'https://api.instagram.com/v1/media/shortcode/' . $key . '?access_token=' . $access_token;
// $result = fetchData($url);
// $result = json_decode($result);


?>

    <div id="primary" class="content-area">
      <main id="main" class="site-main" role="main">
        <div class="container-fluid">
          <!--  Skeleton -->
          <div class="row">
            <div class="col-sm-10 col-sm-offset-1">

              <div class="container-fluid">
                <!--  center-body -->
                <div class="row">
                  <?php
                  if ($instagram_posts) {
                    foreach ($instagram_posts as $post) {
                      $aos_type = 'fade-up';
                      $aos_delay = 200 * random_int( 0, 4 );
                      $aos = 'data-aos="'. $aos_type . '" data-aos-delay="' . $aos_delay . '"';

                      $html = '';

                      $html .= '<div ' . $aos . ' class="col-xs-6 col-sm-4">';
                      $html .= '<div class="block__instagram">';

                      $html .= '<a href="' . $post['url'] . '">';
                      $html .= '<div class="block__image lazy" data-original="' . $post['image_url'] . '">';
                      $html .= '<img class="lazy" src="' . $post['image_url']  . '" style="visibility: hidden">';
                      $html .= '</div></a>';

                      $html .= '<div class="block__tag">';
                      $html .= 'social instagram';
                      $html .= '</div>';

                      $html .= '<div class="block__title">' . $post['date'] . '</div>';

                      $html .= '<div class="block__text">';
                      foreach ($post['tags'] as $tag) {
                        $html .= $tag . ' ';
                      }
                      $html .= '</div>';

                      $html .= '</div>';
                      $html .= '</div>';

                      echo $html;
                    }
                  }
                  ?>
                </div>
              </div>
              <!--  center-body -->

            </div>
          </div>
          <!-- Skeleton -->
        </div>
        <!-- .container -->
      </main>
      <!-- #main -->
    </div>
    <!-- #primary -->

    <?php

get_footer();