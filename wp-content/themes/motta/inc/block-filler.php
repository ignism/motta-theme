<?php
$remaining_posts;

function fill_blocks($posts)
{
    $GLOBALS[$remaining_posts] = $posts;

    while ($GLOBALS[$remaining_posts]) {
        create_row();
    }
}

function create_row()
{
    $curr_space_left = 10;
    echo '<div class="row"><div class="col-xs-1"></div>';
    while ($curr_space_left > 1 && $GLOBALS[$remaining_posts]) {
        $curr_space_left = get_first_fit($curr_space_left);
    }

    close_row();
}

function get_first_fit($space_left)
{
    foreach ($GLOBALS[$remaining_posts] as $post_key => $post) {
        $post_id = $post->ID;

        $curr_size = 0;

        if (get_field('size', $post_id)) {
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
                    $curr_size = 7;
                    break;

                default:
                    $curr_size = 10;
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
            unset($GLOBALS[$remaining_posts][$post_key]);
        } elseif ($curr_size <= $space_left) {
            // found a candidate
            unset($GLOBALS[$remaining_posts][$post_key]);
            generate_block($post_id);
            return $space_left - $curr_size;
        } else {
            // leave it, but doesnt fit now
        }
    }

    return 0;
}

function generate_block($post_id)
{
    $size = get_field('size', $post_id);
    $offset = get_field('offset', $post_id);
    $curr_offset = $offset ? 'col-xs-offset-1' : '';
    $html = '';

    switch ($size) {
        case 'xs':
            $html .= '<div class="block col-xs-2 '. $curr_offset .'">';
            break;

        case 'sm':
            $html .= '<div class="block col-xs-3 '. $curr_offset .'">';
            break;

        case 'md':
            $html .= '<div class="block col-xs-4 '. $curr_offset .'">';
            break;

        case 'lg':
            $html .= '<div class="block col-xs-7 '. $curr_offset .'">';
            break;

        default:
            $html .= '<div class="block col-xs-8 col-xs-offset-1">';
            break;
    }

    $type = get_field('type', $post_id);



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
    $block = '';

    $block .= '<div class="block__content">';
    $block .= '<div class="block__image lazy" data-original="' . $image[sizes][large] . '">';
    $block .= '<img class="lazy" src="' . $image[sizes][large] . '" style="visibility: hidden">';
    $block .= '<div class="block__caption" style="' . $caption_position . ': 0; color: ' . $caption_color . '">' . $caption . '</div>';
    $block .= '</div>';
    $block .= '</div>';

    return $block;
}

function get_image_text_block($post_id)
{
    $image = get_field('image', $post_id);
    $text = get_field('text', $post_id);
    $block = '';

    $block .= '<div class="block__content">';
    $block .= '<div class="block__image lazy" data-original="' . $image[sizes][large] . '">';
    $block .= '<img class="lazy" src="' . $image[sizes][large] . '" style="visibility: hidden">';
    $block .= '</div>';
    $block .= '<div class="block__text">';
    $block .= '<p>' . $text . '</p>';
    $block .= '</div>';
    $block .= '</div>';

    return $block;
}

function get_colored_text_block($post_id)
{
    $text = get_field('text', $post_id);
    $background_color = get_field('background_color', $post_id);
    $block = '';

    $block .= '<div class="block__content">';
    $block .= '<div class="block__text--colored ' . $background_color . '">';
    $block .= '<p>' . $text . '</p>';
    $block .= '</div>';
    $block .= '</div>';

    return $block;
}

function get_text_block($post_id)
{
    $text = get_field('text', $post_id);
    $block = '';

    $block .= '<div class="block__content">';
    $block .= '<div class="block__text">';
    $block .= '<p>' . $text . '</p>';
    $block .= '</div>';
    $block .= '</div>';

    return $block;
}

function close_row()
{
    echo '</div>';
}

function debug($value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre><br><br>';
}
