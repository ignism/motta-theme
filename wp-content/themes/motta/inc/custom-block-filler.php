<?php
$remaining_blocks;

function fill_custom_blocks($blocks)
{
    $GLOBALS[$remaining_blocks] = $blocks;

    echo '<div class="row">';
    while ($GLOBALS[$remaining_blocks]) {
        create_custom_row();
    }
    close_custom_row();
}

function create_custom_row()
{
    $curr_space_left = 12;

    while ($curr_space_left > 2 && $GLOBALS[$remaining_blocks]) {
        $curr_space_left = get_first_custom_fit($curr_space_left);
    }
}

function get_first_custom_fit($space_left)
{
    foreach ($GLOBALS[$remaining_blocks] as $block_key => $block) {
        $curr_size = 0;

        if ($str_size = $block['custom_block_size']) {
            switch ($str_size) {
                case 'xs':
                $curr_size = 3;
                break;

                case 'sm':
                $curr_size = 4;
                break;

                case 'md':
                $curr_size = 5;
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
            unset($GLOBALS[$remaining_blocks][$block_key]);
        } elseif ($curr_size <= $space_left) {
            // found a candidate
            unset($GLOBALS[$remaining_blocks][$block_key]);
            generate_custom_block($block);
            return $space_left - $curr_size;
        } else {
            // leave it, but doesnt fit now
        }
    }

    return 0;
}

function generate_custom_block($block)
{
    $size = $block['custom_block_size'];
    $offset = $block['custom_block_offset'];
    $curr_offset = $offset ? 'col-md-offset-1' : '';
    $html = '';

    switch ($size) {
        case 'xs':
        $html .= '<div class="block col-sm-5 col-md-3 '. $curr_offset .'">';
        break;

        case 'sm':
        $html .= '<div class="block col-sm-5 col-md-4 '. $curr_offset .'">';
        break;

        case 'md':
        $html .= '<div class="block col-sm-7 col-md-5 '. $curr_offset .'">';
        break;

        case 'lg':
        $html .= '<div class="block col-sm-7 col-md-8 '. $curr_offset .'">';
        break;

        default:
        $html .= '<div class="block col-sm-10 col-sm-offset-1">';
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
