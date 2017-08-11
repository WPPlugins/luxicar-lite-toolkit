<?php

add_shortcode('luxicar_fancy_heading', 'luxicar_toolkit_shortcode_fancy_heading');

function luxicar_toolkit_shortcode_fancy_heading($atts, $content = null) {
    if ($content) {
        extract(shortcode_atts(array('title' => 'title', 'class' => '', 'icon' => ''), $atts));
		$class = isset($atts['class']) ? $atts['class'] : 'kopa-fancy-heading s1';
		$title = isset($atts['title']) ? $atts['title'] : '';
		$icon  = isset($atts['icon']) ? $atts['icon'] : 'fa fa-car';
        
		$html = sprintf('<div class="%s">', $class);
		$html .= '<h2>'.$title.'</h2>';
		if($class == 'kopa-fancy-heading s3'){
			$html .= '<span class="fancy-line"><i class="'.$icon.'"></i></span>';
		}
		$html .= '<p>'.do_shortcode($content).'</p>';
		$html .= '</div>';
        return apply_filters('luxicar_toolkit_shortcode_fancy_heading', $html, $atts, $content);
    }
}