<?php
$remaining_posts;
$current_category = '';
$delay = 0;

function fill_blocks($posts)
{
    $GLOBALS['remaining_posts'] = $posts;

    echo '<div class="row">';
    while ($GLOBALS['remaining_posts']) {
        create_row();
    }
    close_row();
}

function fill_blocks_with_category($posts, $category_name)
{
    $GLOBALS['remaining_posts'] = $posts;
    $GLOBALS['current_category'] = $category_name;

    echo '<div class="row">';
    while ($GLOBALS['remaining_posts']) {
        create_row();
    }
    close_row();
}

function create_row()
{
    $curr_space_left = 12;

    while ($curr_space_left >= 2 && $GLOBALS['remaining_posts']) {
        $curr_space_left = get_first_fit($curr_space_left);
    }
}

function get_first_fit($space_left)
{
    $delay = $GLOBALS['delay'];

    foreach ($GLOBALS['remaining_posts'] as $post_key => $post) {
        $post_id = $post->ID;
        $post_type = $post->post_type;

        $curr_size = 0;

        if ($post_type == 'social_post') {
            $curr_size = 4;
        } else if (get_field('size', $post_id)) {
            $str_size = get_field('size', $post_id);

            switch ($str_size) {
                case 'xs':
                $curr_size = 2;
                break;

                case 'sm':
                $curr_size = 3;
                break;

                case 'md':
                $curr_size = 4;
                break;

                case 'lg':
                $curr_size = 8;
                break;

                default:
                $curr_size = 12;
                break;
            }
        }

        if (get_field('offset', $post_id)) {
            $offset = get_field('offset', $post_id);

            if ($offset) {
                $curr_size++;
            }
        }

        if ($curr_size === 0) {
            // not a valid block type
            unset($GLOBALS['remaining_posts'][$post_key]);
        } elseif ($curr_size <= $space_left) {
            // found a candidate
            unset($GLOBALS['remaining_posts'][$post_key]);
            generate_block($post, $delay * 200);
            $delay = $delay + 1;
            if ($delay > 3) {
                $delay = 0;
            }
            $GLOBALS['delay'] = $delay;
            return $space_left - $curr_size;
        } else {
            // leave it, but doesnt fit now
        }
    }

    return 0;
}

function generate_block($post, $delay)
{
    $post_id = $post->ID;
    $post_type = $post->post_type;

    $size = get_field('size', $post_id);
    $offset = get_field('offset', $post_id);
    $curr_offset = $offset ? 'col-md-offset-1' : '';
    $aos = 'data-aos="fade-up" data-aos-delay="' . $delay . '"';
    $html = '';

    if ($post_type == 'social_post') {
        $size = 'sm';
    }

    switch ($size) {
        case 'xs':
        $html .= '<div ' . $aos . ' class="block col-xs-5 col-md-2 '. $curr_offset .'">';
        break;

        case 'sm':
        $html .= '<div ' . $aos . ' class="block col-xs-5 col-md-3 '. $curr_offset .'">';
        break;

        case 'md':
        $html .= '<div ' . $aos . ' class="block col-xs-7 col-md-4 '. $curr_offset .'">';
        break;

        case 'lg':
        $html .= '<div ' . $aos . ' class="block col-xs-7 col-md-8 '. $curr_offset .'">';
        break;

        default:
        $html .= '<div ' . $aos . ' class="block col-xs-10 col-xs-offset-1">';
        break;
    }

    $type = get_field('type', $post_id);
    if ($post_type == 'social_post') {
        $type = 'instagram';
    }


    switch ($type) {
        case 'image':
        $html .= get_image_block($post_id);
        break;
        case 'image_text':
        $html .= get_image_text_block($post_id);
        break;
        case 'colored_text':
        $html .= get_colored_text_block($post_id);
        break;
        case 'instagram':
        $html .= get_instagram_block($post_id);
        break;
        default:
        $html .= get_text_block($post_id);
        break;
    }


    $html .= '</div>'; // closing .col-xs-#

    echo $html;
}

function get_image_block($post_id)
{
    $image = get_field('image', $post_id);
    $caption = get_field('caption', $post_id);
    $caption_position = get_field('caption_position', $post_id);
    $caption_color = get_field('caption_color', $post_id);
    $permalink = get_the_permalink($post_id);
    $tag = get_post_type($post_id);

    $block = '';
    $block .= '<div class="block__content block--image">';
    if ($tag != 'sticky') {
        $block .= '<a href="' . $permalink . '">';
    }
    $block .= '<div class="block__image lazy" data-original="' . $image[sizes][large] . '">';
    $block .= '<img class="lazy" src="' . $image[sizes][large] . '" style="visibility: hidden">';
    $block .= '<div class="block__caption" style="' . $caption_position . ': 0; color: ' . $caption_color . '">' . $caption . '</div>';
    $block .= '</div>';
    if ($tag != 'sticky') {
        $block .= '</a>';
    }
    $block .= '</div>';

    return $block;
}

function get_image_text_block($post_id)
{
    $image = get_field('image', $post_id);
    $text = get_field('text', $post_id);
    $title = get_the_title($post_id);
    $categories = get_the_category($post_id);
    $tag = get_post_type($post_id);

    $permalink = get_the_permalink($post_id);
    if ($tag == 'post') {
        $tag = '';
    } else {
        $tag .= ' ';
    }
    if ($categories) {
        foreach ($categories as $category) {
            $name = $category->name;
            if ($name != 'Uncategorized') {
                if ($name == $GLOBALS['current_category']) {
                    $tag .= '| <span class="text-red">' . $category->name . '</span> ';
                } else {
                    $tag .= '| ' . $category->name . ' ';
                }
            }
        }
    }
    $block = '';

    $block .= '<div class="block__content block--image-text">';
    $block .= '<a href="' . $permalink . '">';
    $block .= '<div class="block__image lazy" data-original="' . $image[sizes][large] . '">';
    $block .= '<img class="lazy" src="' . $image[sizes][large] . '" style="visibility: hidden">';
    $block .= '</div></a>';
    if ($tag != '') {
        $block .= '<div class="block__tag">' . $tag . '</div>';
    }
    $block .= '<div class="block__title">' . $title . '</div>';
    if ($text != '') {
        $block .= '<div class="block__text">';
        $block .= $text;
        $block .= '</div>';
    }
    if ($action = get_field('action_button', $post_id)) {
        $block .= '<div class="block__action"><a>' . $action . '</a></div>';
    }

    $block .= '</div>';

    return $block;
}

function get_colored_text_block($post_id)
{
    $text = get_field('text', $post_id);
    $background_color = get_field('background_color', $post_id);
    $block = '';

    $block .= '<div class="block__content block--colored-text">';
    $block .= '<div class="block__text--colored ' . $background_color . '">';
    if ($link = get_field('link', $post_id)) {
        $block .= '<a href="' . $link . '">' . $text . '</a>';
    } else {
        $block .= $text;
    }

    $block .= '</div>';
    $block .= '</div>';

    return $block;
}

function get_text_block($post_id)
{
    $text = get_field('text', $post_id);
    $tag = get_post_type($post_id);
    $block = '';

    $block .= '<div class="block__content block--text">';
    if ($tag != 'sticky') {
        $block .= '<a href="' . $permalink . '">';
    }
    $block .= '<div class="block__text">';
    $block .= $text;
    $block .= '</div>';
    if ($action = get_field('action_button', $post_id)) {
        $block .= '<div class="block__action"><a>' . $action . '</a></div>';
    }
    if ($tag != 'sticky') {
        $block .= '</a>';
    }
    $block .= '</div>';

    return $block;
}

function get_instagram_block($post_id)
{
    $access_token = get_field('instagram', 16);
    $key = get_field('instagram_shortcode', $post_id);

    $url = 'https://api.instagram.com/v1/media/shortcode/' . $key . '?access_token=' . $access_token;
    $result = fetchData($url);
    $result = json_decode($result);

    $post = $result->data;

    $instagram_post['username'] = $post->user->username;
    $instagram_post['image_url'] = $post->images->standard_resolution->url;
    $instagram_post['tags'] = $post->tags;
    $instagram_post['date'] = date('j M Y', $post->created_time);
    $instagram_post['url'] = $post->link;
    $instagram_post['likes'] = $post->likes;

    $html = '';


    $html .= '<div class="block__instagram">';

    $html .= '<a href="' . $instagram_post['url'] . '">';
    $html .= '<div class="block__image lazy" data-original="' . $instagram_post['image_url'] . '">';
    $html .= '<img class="lazy" src="' . $instagram_post['image_url']  . '" style="visibility: hidden">';
    $html .= '</div></a>';

    $html .= '<div class="block__tag">';
    $html .= 'social instagram';
    $html .= '</div>';

    $html .= '<div class="block__title">' . $instagram_post['date'] . '</div>';

    $html .= '<div class="block__text">';
    foreach ($instagram_post['tags'] as $tag) {
    $html .= $tag . ' ';
    }
    $html .= '</div>';

    $html .= '</div>';


    return $html;
}

function fetchData($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

function close_row()
{
    echo '</div>';
}
