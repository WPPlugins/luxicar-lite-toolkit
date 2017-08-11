<?php

add_shortcode('appointment', 'luxicar_toolkit_plus_shortcode_appointment');

function luxicar_toolkit_plus_shortcode_appointment($atts, $content = null) {
    extract(shortcode_atts(array('icon' => '', 'title' => '' , 'style' => ''), $atts));
	$icon  = isset($atts['icon']) ? $atts['icon'] : 'fa-rocket';
	$title = isset($atts['title']) ? $atts['title'] : '';

	$html = '<div class="kp-wrap">';
	$html .= '<div class="kp-heading">'.$title.'</div>';
	$html .= '<div class="kp-content">';
	$html .= '<i class="fa '.$icon.'"></i>';
	$html .= '<div class="text-wrap">'.do_shortcode($content).'</div>';
	$html .= '</div>';
	$html .= '</div>';

    return apply_filters('luxicar_toolkit_plus_shortcode_appointment', $html, $atts, $content);
}