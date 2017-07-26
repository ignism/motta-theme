<?php
function generate_frontpage_block($post, $delay)
{
    $post_id = $post->ID;
    $post_type = $post->post_type;

    $type = get_field('type', $post_id);

    $aos_type = 'fade-up';
    if ($type == 'colored_text') {
      $aos_type = 'flip-right';
    }

    $offset = get_field('offset', $post_id);
    $curr_offset = $offset ? 'col-md-offset-1' : '';
    $aos = 'data-aos="' . $aos_type . '" data-aos-delay="' . $delay . '"';
    $html = '';

    if ($post_type == 'social_post') {
        $size = 'sm';
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


    return $html;
}
