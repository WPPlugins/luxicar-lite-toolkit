<?php

add_shortcode('luxicar_stickynote', 'luxicar_toolkit_shortcode_stickynote');

function luxicar_toolkit_shortcode_stickynote($atts, $content = null) {
    extract(shortcode_atts(array('class' => ''), $atts));
    
    if($content){
        $output = sprintf('<div class="kopa-sticky-note"><div class="%s"><p>%s</p></div></div>',$class, do_shortcode($content));
    }
    return apply_filters('luxicar_toolkit_shortcode_stickynote', $output);
}
