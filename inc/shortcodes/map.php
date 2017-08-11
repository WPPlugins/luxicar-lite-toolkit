<?php

add_shortcode('luxicar_map', 'luxicar_toolkit_shortcode_map');

function luxicar_toolkit_shortcode_map($atts, $content = null) {
    extract(shortcode_atts(array('place' => 'Ha Noi', 'latitude' => "21.029532", 'longitude' =>  "105.852345"), $atts));
	$place     = isset($atts['place']) ? $atts['place'] : 'Ha Noi';
	$latitude  = isset($atts['latitude']) ? $atts['latitude'] : '21.029532';
	$longitude = isset($atts['longitude']) ? $atts['longitude'] : '105.852345';
	$html = sprintf('<div class="kopa-map-box">
							<div id="kopa-map" class="kopa-map" data-place="%s" data-latitude="%s" data-longitude="%s"></div>
						</div>', $place, $latitude, $longitude);
    return $html;
}