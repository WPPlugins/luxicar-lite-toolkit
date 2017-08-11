<?php

add_shortcode('luxicar_progressbar', 'luxicar_toolkit_shortcode_progressbar');

function luxicar_toolkit_shortcode_progressbar($atts, $content = null) {
    extract(shortcode_atts(array('class' => '', 'value' => '10',), $atts));
    $output = '';
    if($content && $class && $value){
    	$output = sprintf('<div class="%s">
							<p class="type-probar">%s</p>
							<p class="percent-probar">%s</p>
							<div class="pro-bar-container">
								<div class="pro-bar bar-%s" data-pro-bar-percent="%s"></div>
							</div>
							<!-- /.pro-bar-container -->
						</div>',$class, do_shortcode($content), $value.'%', $value, $value);
    }

    return apply_filters('luxicar_toolkit_shortcode_progressbar', $output);
}

add_shortcode('luxicar_chart', 'luxicar_toolkit_shortcode_chart');

function luxicar_toolkit_shortcode_chart($atts, $content = null) {
    extract(shortcode_atts(array('color' => '', 'value' => '10', 'title' => 'tile',), $atts));
    $output = '';
    if($color && $value){
    	$output .= '<div class="kopa-pie-chart"> <div class="list-chart">';
    	$output .= sprintf('<div class="chart-circle" data-percent="%s" data-color="%s"><span>%s</span></div>', $value, $color, $value.'%');
    	if($title || $content){
    		$output .= '<div class="chart-content">';
    		if($title){
    			$output .= sprintf('<h5>%s</h5>', $title);
    		}
    		if($content){
    			$output .= sprintf('<p>%s</p>', $content);
    		}
    		$output .= '</div>';
    	}
    	$output .= '</div></div>';
    }

    return apply_filters('luxicar_toolkit_shortcode_chart', $output);
}