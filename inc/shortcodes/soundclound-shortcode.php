<?php

/* Register oEmbed provider
  *
  * To get wordpress shortcode soundclound: 
  * 1. To soundclound link: https://soundcloud.com/showtekmusic/david-guetta-showtek-ft
  * 2. Click Share
  * 3. Click Embed button and tick Wordpress Code
  * 4. Edit Width, Height: 848 x 154
  * 
   -------------------------------------------------------------------------- */

wp_oembed_add_provider('#https?://(?:api\.)?soundcloud\.com/.*#i', 'http://soundcloud.com/oembed', true);


/* Register SoundCloud shortcode
   -------------------------------------------------------------------------- */

add_shortcode("soundcloud", "luxicar_toolkit_plus_soundcloud_shortcode");


/**
 * SoundCloud shortcode handler
 * @param  {string|array}  $atts     The attributes passed to the shortcode like [soundcloud attr1="value" /].
 *                                   Is an empty string when no arguments are given.
 * @param  {string}        $content  The content between non-self closing [soundcloud]…[/soundcloud] tags.
 * @return {string}                  Widget embed code HTML
 */
function luxicar_toolkit_plus_soundcloud_shortcode($atts, $content = null) {

  // Custom shortcode options
  $shortcode_options = array_merge(array('url' => trim($content)), is_array($atts) ? $atts : array());
  // Turn shortcode option "param" (param=value&param2=value) into array
  $shortcode_params = array();
  if (isset($shortcode_options['params'])) {
    parse_str(html_entity_decode($shortcode_options['params']), $shortcode_params);
  }
  $shortcode_options['params'] = $shortcode_params;

  $player_type = luxicar_toolkit_plus_soundcloud_booleanize('player_type', 'visual');
  $isIframe    = $player_type !== 'flash';
  $isVisual    = !$player_type || $player_type === 'visual';


  // User preference options
  $plugin_options = array_filter(array(
    'iframe' => $isIframe,
    'width'  => luxicar_toolkit_plus_soundcloud_booleanize('player_width'),
    'height' => luxicar_toolkit_plus_soundcloud_url_has_tracklist($shortcode_options['url']) ? luxicar_toolkit_plus_soundcloud_booleanize('player_height_multi') : luxicar_toolkit_plus_soundcloud_booleanize('player_height'),
    'params' => array_filter(array(
      'auto_play'     => luxicar_toolkit_plus_soundcloud_booleanize('auto_play'),
      'show_comments' => luxicar_toolkit_plus_soundcloud_booleanize('show_comments'),
      'color'         => luxicar_toolkit_plus_soundcloud_booleanize('color'),
      'visual'        => ($isVisual ? 'true' : 'false')
    )),
  ));
  // Needs to be an array
  if (!isset($plugin_options['params'])) { $plugin_options['params'] = array(); }

  // plugin options < shortcode options
  $options = array_merge(
    $plugin_options,
    $shortcode_options
  );

  // plugin params < shortcode params
  $options['params'] = array_merge(
    $plugin_options['params'],
    $shortcode_options['params']
  );

  // The "url" option is required
  if (!isset($options['url'])) {
    return '';
  } else {
    $options['url'] = trim($options['url']);
  }

  // Both "width" and "height" need to be integers
  if (isset($options['width']) && !preg_match('/^\d+$/', $options['width'])) {
    // set to 0 so oEmbed will use the default 100% and WordPress themes will leave it alone
    $options['width'] = 0;
  }
  if (isset($options['height']) && !preg_match('/^\d+$/', $options['height'])) { unset($options['height']); }

  // The "iframe" option must be true to load the iframe widget
  $iframe = luxicar_toolkit_plus_get_soundcloud_booleanize($options['iframe']);

  // Remove visual parameter from Flash widget or when it's false because that's the default
  if ($options['params']['visual'] && (!$iframe || !luxicar_toolkit_plus_get_soundcloud_booleanize($options['params']['visual']))) {
    unset($options['params']['visual']);
  }

  // Merge in "url" value
  $options['params'] = array_merge(array(
    'url' => $options['url']
  ), $options['params']);

  // Return html embed code
  if ($iframe) {
    return luxicar_toolkit_plus_soundcloud_iframe_flash_widget($options);
  } else {
    return luxicar_toolkit_plus_soundcloud_flash_widget($options);
  }

}

/**
 * Plugin options getter
 * @param  {string|array}  $option   Option name
 * @param  {mixed}         $default  Default value
 * @return {mixed}                   Option value
 */
function luxicar_toolkit_plus_soundcloud_booleanize($option, $default = false) {
  $value = get_option('soundcloud_' . $option);
  return $value === '' ? $default : $value;
}

/**
 * Booleanize a value
 * @param  {boolean|string}  $value
 * @return {boolean}
 */
function luxicar_toolkit_plus_get_soundcloud_booleanize($value) {
  return is_bool($value) ? $value : $value === 'true' ? true : false;
}

/**
 * Decide if a url has a tracklist
 * @param  {string}   $url
 * @return {boolean}
 */
function luxicar_toolkit_plus_soundcloud_url_has_tracklist($url) {
  return preg_match('/^(.+?)\/(sets|groups|playlists)\/(.+?)$/', $url);
}

/**
 * Parameterize url
 * @param  {array}  $match  Matched regex
 * @return {string}          Parameterized url
 */
function luxicar_toolkit_plus_soundcloud_oembed_params_callback($match) {
  global $soundcloud_oembed_params;

  // Convert URL to array
  $url = parse_url(urldecode($match[1]));
  // Convert URL query to array
  parse_str($url['query'], $query_array);
  // Build new query string
  $query = http_build_query(array_merge($query_array, $soundcloud_oembed_params));

  return 'src="' . $url['scheme'] . '://' . $url['host'] . $url['path'] . '?' . $query;
}

/**
 * Iframe widget embed code
 * @param  {array}   $options  Parameters
 * @return {string}            Iframe embed code
 */
function luxicar_toolkit_plus_soundcloud_iframe_flash_widget($options) {

  // Build URL
  $url = 'https://w.soundcloud.com/player?' . http_build_query($options['params']);
  // Set default width if not defined
  $width = isset($options['width']) && $options['width'] !== 0 ? $options['width'] : '100%';
  // Set default height if not defined

  $height = isset($options['height']) && $options['height'] !== 0
              ? $options['height']
              : (luxicar_toolkit_plus_soundcloud_url_has_tracklist($options['url']) || (isset($options['params']['visual']) && luxicar_toolkit_plus_get_soundcloud_booleanize($options['params']['visual'])) ? '450' : '166');

  return sprintf('<iframe width="%s" height="%s" scrolling="no" frameborder="no" src="%s"></iframe>', $width, $height, $url);
}

/**
 * Legacy Flash widget embed code
 * @param  {array}   $options  Parameters
 * @return {string}            Flash embed code
 */
function luxicar_toolkit_plus_soundcloud_flash_widget($options) {

  // Build URL
  $url = 'https://player.soundcloud.com/player.swf?' . http_build_query($options['params']);
  // Set default width if not defined
  $width = isset($options['width']) && $options['width'] !== 0 ? $options['width'] : '100%';
  // Set default height if not defined
  $height = isset($options['height']) && $options['height'] !== 0 ? $options['height'] : (luxicar_toolkit_plus_soundcloud_url_has_tracklist($options['url']) ? '255' : '81');

  return preg_replace('/\s\s+/', "", sprintf('<object width="%s" height="%s">
                                <param name="movie" value="%s"></param>
                                <param name="allowscriptaccess" value="always"></param>
                                <embed width="%s" height="%s" src="%s" allowscriptaccess="always" type="application/x-shockwave-flash"></embed>
                              </object>', $width, $height, $url, $width, $height, $url));
}

