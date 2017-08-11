<?php

add_shortcode('luxicar_social', 'luxicar_toolkit_shortcode_social');

function luxicar_toolkit_shortcode_social($atts, $content = null) {

    extract(shortcode_atts(array('title' => 'title', 'icon' => 'fa fa-facebook', 'url' => 'url'), $atts));
	$title = isset($atts['title']) ? $atts['title'] : '';
	$icon  = isset($atts['icon']) ? $atts['icon'] : 'fa fa-facebook';
	$url   = isset($atts['url']) ? $atts['url'] : '#';
    
	$html = '<div class="kopa-icon-social">';
	$html .= sprintf('<a href="%s"><i class="%s"></i><span>%s</span></a>', $url , $icon, $title);
	$html .= '</div>';
    return apply_filters('luxicar_toolkit_shortcode_social', $html, $atts, $content);
}