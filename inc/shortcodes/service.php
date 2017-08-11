<?php

add_shortcode('service', 'luxicar_toolkit_plus_shortcode_service');

function luxicar_toolkit_plus_shortcode_service($atts, $content = null) {
    extract(shortcode_atts(array('icon' => '', 'title' => '' ), $atts));
	$icon   = isset($atts['icon']) ? $atts['icon'] : 'fa-rocket';
	$title = isset($atts['title']) ? $atts['title'] : '';

	$html = '<div class="list-item">';
	$html .= '<span><i class="fa '.$icon.'"></i></span>';
	$html .= '<h5>'.$title.'</h5>';
	$html .= '<p>'.do_shortcode($content).'</p>';
	$html .= '</div>';
	
    return apply_filters('luxicar_toolkit_plus_shortcode_service', $html, $atts, $content);
}