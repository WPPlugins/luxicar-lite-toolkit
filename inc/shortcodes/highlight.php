<?php

add_shortcode('luxicar_highlight', 'luxicar_toolkit_shortcode_highlight');

function luxicar_toolkit_shortcode_highlight($atts, $content = null) {
    extract(shortcode_atts(array('class' => ''), $atts));
    
    if(!$class){
        $output = do_shortcode($content);
    } else {
        $output = sprintf('<span class="%s">%s</span>',$class, do_shortcode($content));
    }
    return apply_filters('luxicar_toolkit_shortcode_highlight', $output);
}
