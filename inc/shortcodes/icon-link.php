<?php

add_shortcode('icon_link', 'luxicar_toolkit_plus_shortcode_icon_link');

function luxicar_toolkit_plus_shortcode_icon_link($atts, $content = null) {
    extract(shortcode_atts(array('icon' => '', 'target' => '', 'url' => ''), $atts));
	$icon   = isset($atts['icon']) ? $atts['icon'] : 'fa-rocket';
	$target = isset($atts['target']) ? $atts['target'] : '_self';
	$url = isset($atts['url']) ? $atts['url'] : '#';

	$html = '<li>';
	$html .= '<a href="'.$url.'" target="'.$target.'">';
	$html .= '<i class="fa '.$icon.'"></i>';
	$html .= '</a>';
	$html .= '</li>';
	
    return apply_filters('luxicar_toolkit_plus_shortcode_icon_link', $html, $atts, $content);
}