<?php

add_shortcode('info', 'luxicar_toolkit_plus_shortcode_info');

function luxicar_toolkit_plus_shortcode_info($atts, $content = null) {
    extract(shortcode_atts(array('icon' => '', 'title' => '' , 'style' => ''), $atts));
	$icon  = isset($atts['icon']) ? $atts['icon'] : 'fa-rocket';
	$title = isset($atts['title']) ? $atts['title'] : '';
	$style = isset($atts['style']) ? $atts['style'] : '';

	if( $style ){
		$html = '<div class="contact-service">';
		$html .= '<span class="icon-contact icon-'.$style.'"></span>';
		$html .= '<h5>'.do_shortcode($content).'</h5>';
		$html .= '</div>';
	}else{
		$html = '<article>';
		$html .= '<span><i class="fa '.$icon.'"></i></span>';
		$html .= '<h4>'.$title.'</h4>';
		$html .= '<p>'.do_shortcode($content).'</p>';
		$html .= '</article>';
	}

    return apply_filters('luxicar_toolkit_plus_shortcode_info', $html, $atts, $content);
}