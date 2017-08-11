<?php

add_shortcode('counter', 'luxicar_toolkit_plus_shortcode_counter');

function luxicar_toolkit_plus_shortcode_counter($atts, $content = null) {
    if ($content) {
        extract(shortcode_atts(array('icon' => '', 'number' => ''), $atts));
		$icon   = isset($atts['icon']) ? $atts['icon'] : 'fa-rocket';
		$number = isset($atts['number']) ? $atts['number'] : '';
        
		$html = '<div class="list-item">';
		$html .= '<p class="counter-icon">';
		$html .= '<i class="fa '.$icon.'"></i>';
		$html .= '<span>'.$number.'</span>';
		$html .= '</p>';
		$html .= '<h6>'.do_shortcode($content).'</h6>';
		$html .= '</div>';
		
        return apply_filters('luxicar_toolkit_plus_shortcode_counter', $html, $atts, $content);
    }
}

add_shortcode('counter_style', 'luxicar_toolkit_plus_shortcode_counter_style');

function luxicar_toolkit_plus_shortcode_counter_style($atts, $content = null) {

        extract(shortcode_atts(array('style' => ''), $atts));
		$style   = isset($atts['style']) ? $atts['style'] : '1';
		if($style == '1'){
			$html = '<div class="widget kopa-counter-widget-1">';
			$html .= '<div class="widget-content">'.do_shortcode($content).'</div>';
			$html .= '</div>';
		}else{
			$html = '<div class="widget kopa-counter-widget-2">';
			$html .= '<div class="widget-content">'.do_shortcode($content).'</div>';
			$html .= '</div>';
		}
		
        return apply_filters('luxicar_toolkit_plus_shortcode_counter_style', $html, $atts, $content);

}