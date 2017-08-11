<?php

add_shortcode('bottom-bar', 'luxicar_toolkit_plus_shortcode_bottom_bar');

function luxicar_toolkit_plus_shortcode_bottom_bar($atts, $content = null) {
    extract(shortcode_atts(array('icon' => '', 'url' => '', 'target' => '', 'title' => ''), $atts));
	$icon   = isset($atts['icon']) ? $atts['icon'] : 'fa-rocket';
	$target = isset($atts['target']) ? $atts['target'] : '_blank';
	$url    = isset($atts['url']) ? $atts['url'] : '';

	$html = '<div class="list-bottom-bar">';
	$html .= '<i class="fa '.$icon.'"></i>';
	$html .= '<h6><a href="'.$url.'">'.$title.'</a></h6>';
	$html .= '<a href="'.$url.'" class="add">'.do_shortcode($content).'</a>';
	$html .= '</div>';
	
    return apply_filters('luxicar_toolkit_plus_shortcode_bottom_bar', $html, $atts, $content);
}