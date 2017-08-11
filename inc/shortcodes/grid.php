<?php

add_shortcode('luxicar_row', 'luxicar_toolkit_shortcode_row');
add_shortcode('luxicar_col', '__return_false');

function luxicar_toolkit_shortcode_row($atts, $content = null) {
    extract(shortcode_atts(array(), $atts));

    $items = luxicar_toolkit_get_shortcode($content, true, array('luxicar_col'));
    $panels = array();

    if ($items) {
        foreach ($items as $item) {
            $panels[] = sprintf('<div class="col-sm-%s">%s</div>', $item['atts']['col'], do_shortcode($item['content']));
        }
    }

    $output = '<div class="row clearfix">';
    $output.= implode('', $panels);
    $output.= '</div>';

    return apply_filters('luxicar_toolkit_shortcode_row', $output, $atts, $content);
}