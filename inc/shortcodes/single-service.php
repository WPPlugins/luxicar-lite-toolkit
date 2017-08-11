<?php
add_shortcode('single_service', 'luxicar_toolkit_plus_shortcode_single_service');

function luxicar_toolkit_plus_shortcode_single_service($atts, $content = null) {
    extract(shortcode_atts(array('title' => '', 'image' => ''), $atts));
	$title = isset($atts['title']) ? $atts['title'] : '';
	$image = isset($atts['image']) ? $atts['image'] : '';

	$html = '<article class="entry-item">';
	if($title){
		$html .= '<header><h4>'.$title.'</h4></header>';
	}
	$html .= '<div class="entry-box">';
	if($image){
		$html .= '<div class="entry-thumb"><img src="'.$image.'" alt="" class="img-responsive"></div>';
	}
	$html .= '<div class="entry-content">';
	$html .= do_shortcode( $content );
	$html .= '</div>';
	$html .= '</div>';
	$html .= '</article>';
	
    return apply_filters('luxicar_toolkit_plus_shortcode_single_service', $html, $atts, $content);
}

add_shortcode('single_service_include', 'luxicar_toolkit_plus_shortcode_single_service_include');

function luxicar_toolkit_plus_shortcode_single_service_include($atts, $content = null) {
    extract(shortcode_atts(array('title' => ''), $atts));
	$title = isset($atts['title']) ? $atts['title'] : '';

	$html = '<div class="meta-option">';
	if($title){
		$html .= '<strong>'.$title.'</strong>';
	}
	$html .= do_shortcode( $content );
	$html .= '</div>';
	
    return apply_filters('luxicar_toolkit_plus_shortcode_single_service_include', $html, $atts, $content);
}

add_shortcode('single_service_price', 'luxicar_toolkit_plus_shortcode_single_service_price');

function luxicar_toolkit_plus_shortcode_single_service_price($atts, $content = null) {
    extract(shortcode_atts(array('title' => '', 'price' => ''), $atts));
	$title = isset($atts['title']) ? $atts['title'] : '';

	$html = '<div class="meta-cost">';
	if($title){
		$html .= sprintf( '<p>%s : <span>%s</span></p>', $title, $price);
	}
	$html .= '</div>';
	
    return apply_filters('luxicar_toolkit_plus_shortcode_single_service_price', $html, $atts, $content);
}