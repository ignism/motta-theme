<?php
$remaining_blocks;
$delay = 0;

function fill_custom_blocks($blocks)
{
    $GLOBALS['remaining_posts'] = $blocks;

    echo '<div class="row">';
    while ($GLOBALS['remaining_posts']) {
        create_custom_row();
    }
    close_custom_row();
}

function create_custom_row()
{
    $curr_space_left = 12;

    while ($curr_space_left > 1 && $GLOBALS['remaining_posts']) {
        $curr_space_left = get_first_custom_fit($curr_space_left);
    }
}

function get_first_custom_fit($space_left)
{
    $delay = $GLOBALS['delay'];

    foreach ($GLOBALS['remaining_posts'] as $block_key => $block) {
        $curr_size = 0;

        if ($str_size = $block['custom_block_size']) {
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
        if ($offset = $block['custom_block_offset']) {
            if ($offset) {
                $curr_size++;
            }
        }

        if ($curr_size === 0) {
            // not a valid block type
            unset($GLOBALS['remaining_posts'][$block_key]);
        } elseif ($curr_size <= $space_left) {
            // found a candidate
            unset($GLOBALS['remaining_posts'][$block_key]);
            generate_custom_block($block, $delay * 200);
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

function generate_custom_block($block, $delay)
{
    $size = $block['custom_block_size'];
    $offset = $block['custom_block_offset'];
    $curr_offset = $offset ? 'col-md-offset-1' : '';
    $aos = 'data-aos="fade-up" data-aos-delay="' . $delay . '"';
    $html = '';

    switch ($size) {
        case 'xs':
        $html .= '<div ' . $aos . ' class="block col-sm-5 col-md-2 '. $curr_offset .'">';
        break;

        case 'sm':
        $html .= '<div ' . $aos . ' class="block col-sm-5 col-md-3 '. $curr_offset .'">';
        break;

        case 'md':
        $html .= '<div ' . $aos . ' class="block col-sm-7 col-md-4 '. $curr_offset .'">';
        break;

        case 'lg':
        $html .= '<div ' . $aos . ' class="block col-sm-7 col-md-8 '. $curr_offset .'">';
        break;

        default:
        $html .= '<div ' . $aos . ' class="block col-sm-10 col-sm-offset-1">';
        break;
    }

    $type = $block['custom_block_type'];

    switch ($type) {
        case 'image':
        $html .= get_custom_image_block($block);
        break;
        case 'image_text':
        $html .= get_custom_image_text_block($block);
        break;
        default:
        $html .= get_custom_text_block($block);
        break;
    }

    $html .= '</div>'; // closing .col-xs-#

    echo $html;
}

function get_custom_image_block($block)
{
    $image = $block['custom_block_image'];

    $block_html = '';

    $block_html .= '<div class="block__content block--image">';
    $block_html .= '<div class="block__image lazy" data-original="' . $image[sizes][large] . '">';
    $block_html .= '<img class="lazy" src="' . $image[sizes][large] . '" style="visibility: hidden">';
    $block_html .= '</div>';
    $block_html .= '</div>';

    return $block_html;
}

function get_custom_image_text_block($block)
{
    $image = $block['custom_block_image'];
    $text = $block['custom_block_text'];

    $block_html = '';

    $block_html .= '<div class="block__content block--image">';
    $block_html .= '<div class="block__image lazy" data-original="' . $image[sizes][large] . '">';
    $block_html .= '<img class="lazy" src="' . $image[sizes][large] . '" style="visibility: hidden">';
    $block_html .= '</div>';
    $block_html .= '</div>';

    $block_html .= '<div class="block__content block--text">';
    $block_html .= '<div class="block__text">';
    $block_html .= $text;
    $block_html .= '</div>';
    $block_html .= '</div>';

    return $block_html;
}

function get_custom_text_block($block)
{
    $text = $block['custom_block_text'];

    $block_html = '';

    $block_html .= '<div class="block__content block--text">';
    $block_html .= '<div class="block__text">';
    $block_html .= $text;
    $block_html .= '</div>';
    $block_html .= '</div>';

    return $block_html;
}

function close_custom_row()
{
    echo '</div>';
}
