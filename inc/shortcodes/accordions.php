<?php

add_shortcode('luxicar_accordions', 'luxicar_toolkit_shortcode_accordions');
add_shortcode('luxicar_accordion', '__return_false');

function luxicar_toolkit_shortcode_accordions($atts, $content = null) {
    extract(shortcode_atts(array("style" => ''), $atts));

    $items = luxicar_toolkit_get_shortcode($content, true, array('luxicar_accordion'));

    $output = '';

    if ($items) {

        $parent_id = 'accordions-' . wp_generate_password(4, false, false);
        $is_first  = TRUE;
        if(!isset($style)){
            $style = 's1';
        }
        $output    .= sprintf('<div class="kopa-accordion %s" id="%s">', $style , $parent_id);

        foreach ($items as $item) {
            $child_id = 'accordion-' . wp_generate_password(4, false, false);
            
            $title = $item['atts']['title'];
            
            if ($is_first) {
                $output.= '<div class="acc-title active"><div class="icon-left match"><span></span></div>';
            } else {
                $output.= '<div class="acc-title"><div class="icon-left match"><span></span></div>';
            }
            if($style == 's3'){
                $output .= sprintf('<h5 class="match"><i class="%s"></i>%s</h5>', $item['atts']['icon'], $title);
            }else{
                $output .= sprintf('<h5 class="match">%s</h5>', $title);
            }
            $output .= '</div>';

            if ($is_first) {
                $output .= '<div class="acc-content" style="display: block;">';
            } else {
                $output .= '<div class="acc-content">';
            }
            if($style == 's2'){
                $output .= '<img src="'.$item['atts']['image'].'" alt="" class="img-responsive">';
            }
            $output .= '<p>'.do_shortcode($item['content']).'</p>';
            $output .= '</div>';

            $is_first = FALSE;
        }
    }

    $output.= '</div>';

    return apply_filters('luxicar_toolkit_shortcode_accordions', $output, $atts, $content);
}