<?php

add_shortcode('luxicar_alert', 'luxicar_toolkit_shortcode_alert');

function luxicar_toolkit_shortcode_alert($atts, $content = null) {
    if ($content) {
        extract(shortcode_atts(array('class' => 'alert alert-info alert-dismissable fade in'), $atts));
        $class = isset($atts['class']) ? $atts['class'] : 'alert alert-info alert-dismissable fade in';
        
		$html = sprintf('<div class="%s">', $class);
		$html .= '<button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true"><i class="fa fa-times-circle"></i></span></button>';
		$html .= do_shortcode($content);
		$html .= '</div>';
        return apply_filters('luxicar_toolkit_shortcode_alert', $html, $atts, $content);
    }
}