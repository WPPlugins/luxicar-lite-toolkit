<?php

add_shortcode('luxicar_button', 'luxicar_toolkit_shortcode_button');

function luxicar_toolkit_shortcode_button($atts, $content = null) {
    extract(shortcode_atts(array('class' => '', 'link' => '', 'target' => '', 'icon' => ''), $atts));

    $link    = isset($atts['link']) ? $atts['link'] : '#';
    $class   = isset($atts['class']) ? $atts['class'] : 'btn';
    $target  = isset($atts['target']) ? $atts['target'] : '';    
    $icon    = isset($atts['icon']) ? $atts['icon'] : '';    
    $classes = explode(' ', $class);

    if(!$target){
        $target = '_self';
    }
    if($icon != ''){
        $output = sprintf('<a href="%s" class="%s" target="%s"><i class="fa %s"></i>%s</a>', $link, $class, $target, $icon,do_shortcode($content));
    } else {
        $output = sprintf('<a href="%s" class="%s" target="%s">%s</a>', $link, $class, $target, do_shortcode($content));
    }
    return apply_filters('luxicar_toolkit_shortcode_button', $output);
}
