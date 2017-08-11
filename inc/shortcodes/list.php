<?php

add_shortcode('luxicar_li', 'luxicar_toolkit_shortcode_list');

function luxicar_toolkit_shortcode_list($atts, $content = null) {
    extract(shortcode_atts(array('url' => '#'), $atts));
	$url   = isset($atts['url']) ? $atts['url'] : '#';
	$title = isset($atts['title']) ? $atts['title'] : '#';
    
	$html = sprintf('<li><a href="%s">%s</a></li>', $url, $title);

    return apply_filters('luxicar_toolkit_shortcode_list', $html, $atts, $content);
}

add_shortcode('luxicar_ul', 'luxicar_toolkit_shortcode_ul');

function luxicar_toolkit_shortcode_ul($atts, $content = null) {
    extract(shortcode_atts(array('style' => '#'), $atts));
	$style = isset($atts['style']) ? $atts['style'] : 'kopa-ul kopa-ul-s1';
    
	$html = sprintf('<ul class="%s">', $style);
	$html .= do_shortcode( $content );
	$html .= '</ul>';
	
    return apply_filters('luxicar_toolkit_shortcode_ul', $html, $atts, $content);
}