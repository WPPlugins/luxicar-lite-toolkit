<?php

/**
 * Get config options for post widget
 * @package  luxicar_toolkit_plus
 * @version 1.0.0
 * @return void
 */ 
function luxicar_toolkit_plus_get_post_widget_args(){

    $all_cats = get_categories();
    $categories = array('' => esc_html__('-- none --', 'luxicar'));
    foreach ( $all_cats as $cat ) {
        $categories[ $cat->slug ] = $cat->name;
    }

    $all_tags = get_tags();
    $tags = array('' => esc_html__('-- none --', 'luxicar'));
    foreach( $all_tags as $tag ) {
        $tags[ $tag->slug ] = $tag->name;
    }

    return array(
        'title'  => array(
            'type'  => 'text',
            'std'   => '',
            'label' => esc_html__( 'Title:', 'luxicar' ),
            ),
        'categories' => array(
            'type'    => 'multiselect',
            'std'     => '',
            'label'   => esc_html__( 'Categories:', 'luxicar' ),
            'options' => $categories,
            'size'    => '5',
            ),
        'relation'    => array(
            'type'    => 'select',
            'label'   => esc_html__( 'Relation:', 'luxicar' ),
            'std'     => 'OR',
            'options' => array(
                'AND' => esc_html__( 'AND', 'luxicar' ),
                'OR'  => esc_html__( 'OR', 'luxicar' ),
                ),
            ),
        'tags' => array(
            'type'    => 'multiselect',
            'std'     => '',
            'label'   => esc_html__( 'Tags:', 'luxicar' ),
            'options' => $tags,
            'size'    => '5',
            ),
        'order' => array(
            'type'  => 'select',
            'std'   => 'DESC',
            'label' => esc_html__( 'Order:', 'luxicar' ),
            'options' => array(
                'ASC'  => esc_html__( 'ASC', 'luxicar' ),
                'DESC' => esc_html__( 'DESC', 'luxicar' ),
                ),
            ),
        'orderby' => array(
            'type'  => 'select',
            'std'   => 'date',
            'label' => esc_html__( 'Orderby:', 'luxicar' ),
            'options' => array(
                'date'          => esc_html__( 'Date', 'luxicar' ),
                'rand'          => esc_html__( 'Random', 'luxicar' ),
                'comment_count' => esc_html__( 'Number of comments', 'luxicar' ),
                ),
            ),
        'limit_excerpt' => array(
            'type'    => 'number',
            'std'     => '10',
            'label'   => esc_html__( 'Number of word in excerpt', 'luxicar' ),
            'min'     => '1',
            ),
        'number' => array(
            'type'    => 'number',
            'std'     => '5',
            'label'   => esc_html__( 'Number of posts:', 'luxicar' ),
            'min'     => '1',
            )
        );
}

/**
 * Get query for post widget
 * @package  luxicar_toolkit_plus
 * @version 1.0.0
 * @return array $args for WP_Query()
 */ 
function luxicar_toolkit_plus_get_post_widget_query( $instance ){
    $query = array(
        'post_type'      => 'post',
        'posts_per_page' => $instance['number'],
        'order'          => $instance['order'] == 'ASC' ? 'ASC' : 'DESC',
        'orderby'        => $instance['orderby'],
        'ignore_sticky_posts' => true,
        'post_status' => 'publish'
        );
    if(isset($instance['paged']) && (int)$instance['paged'] >=1){
        $query['paged'] = $instance['paged'];
    }

    if ( isset($instance['categories']) && $instance['categories'] ) {
        if($instance['categories'][0] == '')
            unset($instance['categories'][0]);

        if ( $instance['categories'] ) {
            $query['tax_query'][] = array(
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => $instance['categories'],
                );
        }
    }

    if ( isset($instance['tags']) && $instance['tags'] ) {
        if($instance['tags'][0] == '')
            unset($instance['tags'][0]);

        if ( $instance['tags'] ) {
            $query['tax_query'][] = array(
                'taxonomy' => 'post_tag',
                'field'    => 'slug',
                'terms'    => $instance['tags'],
                );
        }
    }

    if ( isset( $query['tax_query'] ) && 
       count( $query['tax_query'] ) === 2 ) {
        $query['tax_query']['relation'] = $instance['relation'];
}

if ( isset($instance['post_format']) && !empty($instance['post_format']) ) {
    $query['tax_query'][] = array(
        'taxonomy' => 'post_format',
        'field' => 'slug',
        'terms' => array( $instance['post_format'] )
        );
}

return apply_filters( 'luxicar_toolkit_plus_get_post_widget_query', $query );
}

/**
 * Get query for post video widget
 * @package  luxicar_toolkit_plus
 * @version 1.0.0
 * @return array $args for WP_Query()
 */ 
function luxicar_toolkit_plus_get_post_video_widget_query( $instance ){
    $query = array(
        'post_type'      => 'post',
        'posts_per_page' => $instance['number'],
        'order'          => $instance['order'] == 'ASC' ? 'ASC' : 'DESC',
        'orderby'        => $instance['orderby'],
        'ignore_sticky_posts' => true,
        'post_status' => 'publish'
        );
    if(isset($instance['paged']) && (int)$instance['paged'] >=1){
        $query['paged'] = $instance['paged'];
    }

    if ( isset($instance['categories']) && $instance['categories'] ) {
        if($instance['categories'][0] == '')
            unset($instance['categories'][0]);

        if ( $instance['categories'] ) {
            $query['tax_query'][] = array(
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => $instance['categories'],
                );
        }
    }

    if ( isset($instance['tags']) && $instance['tags'] ) {
        if($instance['tags'][0] == '')
            unset($instance['tags'][0]);

        if ( $instance['tags'] ) {
            $query['tax_query'][] = array(
                'taxonomy' => 'post_tag',
                'field'    => 'slug',
                'terms'    => $instance['tags'],
                );
        }
    }

    if ( isset( $query['tax_query'] ) && 
       count( $query['tax_query'] ) === 2 ) {
        $query['tax_query']['relation'] = $instance['relation'];
}

    $query['tax_query'][] = array(
        'taxonomy' => 'post_format',
        'field' => 'slug',
        'terms' => array('post-format-video')
        );

return apply_filters( 'luxicar_toolkit_plus_get_post_video_widget_query', $query );
}

/**
 * Get query for post audio widget
 * @package  luxicar_toolkit_plus
 * @version 1.0.0
 * @return array $args for WP_Query()
 */ 
function luxicar_toolkit_plus_get_post_audio_widget_query( $instance ){
    $query = array(
        'post_type'      => 'post',
        'posts_per_page' => $instance['number'],
        'order'          => $instance['order'] == 'ASC' ? 'ASC' : 'DESC',
        'orderby'        => $instance['orderby'],
        'ignore_sticky_posts' => true,
        'post_status' => 'publish'
        );
    if(isset($instance['paged']) && (int)$instance['paged'] >=1){
        $query['paged'] = $instance['paged'];
    }

    if ( isset($instance['categories']) && $instance['categories'] ) {
        if($instance['categories'][0] == '')
            unset($instance['categories'][0]);

        if ( $instance['categories'] ) {
            $query['tax_query'][] = array(
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => $instance['categories'],
                );
        }
    }

    if ( isset($instance['tags']) && $instance['tags'] ) {
        if($instance['tags'][0] == '')
            unset($instance['tags'][0]);

        if ( $instance['tags'] ) {
            $query['tax_query'][] = array(
                'taxonomy' => 'post_tag',
                'field'    => 'slug',
                'terms'    => $instance['tags'],
                );
        }
    }

    if ( isset( $query['tax_query'] ) && 
       count( $query['tax_query'] ) === 2 ) {
        $query['tax_query']['relation'] = $instance['relation'];
}

    $query['tax_query'][] = array(
        'taxonomy' => 'post_format',
        'field' => 'slug',
        'terms' => array('post-format-audio')
        );

return apply_filters( 'luxicar_toolkit_plus_get_post_audio_widget_query', $query );
}

/**
 * Get query for post gallery widget
 * @package  luxicar_toolkit_plus
 * @version 1.0.0
 * @return array $args for WP_Query()
 */ 
function luxicar_toolkit_plus_get_post_gallery_widget_query( $instance ){
    $query = array(
        'post_type'      => 'post',
        'posts_per_page' => $instance['number'],
        'order'          => $instance['order'] == 'ASC' ? 'ASC' : 'DESC',
        'orderby'        => $instance['orderby'],
        'ignore_sticky_posts' => true,
        'post_status' => 'publish'
        );
    if(isset($instance['paged']) && (int)$instance['paged'] >=1){
        $query['paged'] = $instance['paged'];
    }

    if ( isset($instance['categories']) && $instance['categories'] ) {
        if($instance['categories'][0] == '')
            unset($instance['categories'][0]);

        if ( $instance['categories'] ) {
            $query['tax_query'][] = array(
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => $instance['categories'],
                );
        }
    }

    if ( isset($instance['tags']) && $instance['tags'] ) {
        if($instance['tags'][0] == '')
            unset($instance['tags'][0]);

        if ( $instance['tags'] ) {
            $query['tax_query'][] = array(
                'taxonomy' => 'post_tag',
                'field'    => 'slug',
                'terms'    => $instance['tags'],
                );
        }
    }

    if ( isset( $query['tax_query'] ) && 
       count( $query['tax_query'] ) === 2 ) {
        $query['tax_query']['relation'] = $instance['relation'];
}

    $query['tax_query'][] = array(
        'taxonomy' => 'post_format',
        'field' => 'slug',
        'terms' => array('post-format-gallery')
        );

return apply_filters( 'luxicar_toolkit_plus_get_post_gallery_widget_query', $query );
}

/**
 * Get a specify shortcode by shortcode tag
 * @package  luxicar_toolkit_plus
 * @version 1.0.0
 * @return array $codes shortcodes
 */ 
function luxicar_toolkit_plus_get_shortcode($content, $enable_multi = false, $shortcodes = array()) {

    $codes         = array();
    $regex_matches = '';
    $regex_pattern = get_shortcode_regex();
    
    preg_match_all('/' . $regex_pattern . '/s', $content, $regex_matches);

    foreach ($regex_matches[0] as $shortcode) {
        $regex_matches_new = '';
        preg_match('/' . $regex_pattern . '/s', $shortcode, $regex_matches_new);

        if (in_array($regex_matches_new[2], $shortcodes)) :
            $codes[] = array(
                'shortcode' => $regex_matches_new[0],
                'type'      => $regex_matches_new[2],
                'content'   => $regex_matches_new[5],
                'atts'      => shortcode_parse_atts($regex_matches_new[3])
                );

        if (false == $enable_multi) {
            break;
        }
        endif;
    }

    return $codes;
}

function luxicar_toolkit_plus_weather_logic( $atts )
{
    $rtn                        = "";
    $weather_data               = array();
    $widget_title               = isset($atts['widget_title']) ? $atts['widget_title'] : false;
    $location                   = isset($atts['location']) ? $atts['location'] : false;
    $owm_city_id                = isset($atts['owm_city_id']) ? $atts['owm_city_id'] : false;
    $units                      = (isset($atts['units']) AND strtoupper($atts['units']) == "C") ? "metric" : "imperial";
    $max_min                    = (isset($atts['max_min']) AND (int)($atts['max_min']) == 1) ? 1 : 0;
    $override_title             = isset($atts['override_title']) ? $atts['override_title'] : false;
    
    $locale                     = 'en';
    $sytem_locale = get_locale();
    $available_locales = array( 'en', 'es', 'sp', 'fr', 'it', 'de', 'pt', 'ro', 'pl', 'ru', 'uk', 'ua', 'fi', 'nl', 'bg', 'sv', 'se', 'ca', 'tr', 'hr', 'zh', 'zh_tw', 'zh_cn', 'hu' ); 
    
    // CHECK FOR LOCALE
    if( in_array( $sytem_locale , $available_locales ) )
    {
        $locale = $sytem_locale;
    }
    
    // CHECK FOR LOCALE BY FIRST TWO DIGITS
    if( in_array(substr($sytem_locale, 0, 2), $available_locales ) )
    {
        $locale = substr($sytem_locale, 0, 2);
    }

    // NO LOCATION, ABORT ABORT!!!1!
    if( !$location ) { return luxicar_toolkit_plus_weather_error(); }
    
    //FIND AND CACHE CITY ID
    if( $owm_city_id )
    {
        $city_name_slug             = sanitize_title( $location );;
        $api_query                  = "id=" . $owm_city_id;
    }
    else if( is_numeric($location) )
    {
        $city_name_slug             = sanitize_title( $location );;
        $api_query                  = "id=" . $location;
    }
    else
    {
        $city_name_slug             = sanitize_title( $location );
        $api_query                  = "q=" . $location;
    }
    
    // TRANSIENT NAME
    $weather_transient_name         = 'awe_' . $city_name_slug . "_" . 1 . "_" . strtolower($units) . '_' . $locale;


    // TWO APIS USED (VERSION 2.5)
    //http://api.openweathermap.org/data/2.5/weather?q=London,uk&units=metric&cnt=7&lang=fr
    //http://api.openweathermap.org/data/2.5/forecast/daily?q=London&units=metric&cnt=7&lang=fr
    
    // CLEAR THE TRANSIENT
    if( isset($_GET['clear_awesome_widget']) )
    {
        delete_transient( $weather_transient_name );
    }
    
    // IF APPID, WE USE IT
    $appid_string = '';
    $appid = apply_filters( 'awesome_weather_appid', false );
    if($appid)
    {
        $appid_string = '&APPID=' . $appid;
    }
    
    // GET WEATHER DATA
    if( get_transient( $weather_transient_name ) )
    {
        $weather_data = get_transient( $weather_transient_name );
    }
    else
    {
        $weather_data['now'] = array();
        // NOW
        $now_ping = "http://api.openweathermap.org/data/2.5/weather?" . $api_query . "&lang=" . $locale . "&units=" . $units . $appid_string;

        $now_ping_get = wp_remote_get( $now_ping );
    
        if( is_wp_error( $now_ping_get ) ) 
        {
            return luxicar_toolkit_plus_weather_error( $now_ping_get->get_error_message()  ); 
        }   
    
        $city_data = json_decode( $now_ping_get['body'] );
        
        if( isset($city_data->cod) AND $city_data->cod == 404 )
        {
            return luxicar_toolkit_plus_weather_error( $city_data->message ); 
        }
        else
        {
            $weather_data['now'] = $city_data;
        }
        
        
        // FORECAST 
        
        if($weather_data['now'])
        {
            // SET THE TRANSIENT, CACHE FOR A LITTLE OVER THREE HOURS
            set_transient( $weather_transient_name, $weather_data, apply_filters( 'awesome_weather_cache', 1800 ) ); 
        }
    }

    // NO WEATHER
    if( !$weather_data OR !isset($weather_data['now'])) { return luxicar_toolkit_plus_weather_error(); }
    
    
    // TODAYS TEMPS
    $today          = $weather_data['now'];
    $today_temp     = round($today->main->temp);
    $today_high     = round($today->main->temp_max);
    $today_low      = round($today->main->temp_min);

    // DATA
    $header_title = $override_title ? $override_title : $today->name;
    
    
    // DISPLAY WIDGET
    if($max_min == 1) {
        $unit = ($units == 'imperial') ? 'F' : 'º'; 
        $rtn .= '<div class="widget kopa-widget-weather">';
        $rtn .= ($widget_title != false) ? '<h5 class="widget-title widget-title-5">'.$widget_title.'</h5>' : '';
        $rtn .= '<div class="widget-content">';
        $rtn .= '<h5>'.$header_title.'&nbsp;<span>'.$today_temp.'</span><sup>'.$unit.'</sup></h5>';
        $rtn .= '<small>min <span>'.$today_low.'</span><sup>'.$unit.'</sup> / max <span>'.$today_high.'</span><sup>'.$unit.'</sup></small>';
        $rtn .= '</div>';
        $rtn .= '<!-- /.widget-content -->';
        $rtn .= '</div>';
        $rtn .= '<!-- /.widget -->';
    } else {
        $unit = ($units == 'imperial') ? 'F' : 'º'; 
        $rtn .= '<div class="widget widget-weather-header hidden-xs hidden-sm">';
        $rtn .= '<p>'.$header_title.'&nbsp;<span>'.$today_temp.'</span><sup>'.$unit.'</sup></p>';
        $rtn .= '</div>';                      
    }

    return $rtn;
}

function luxicar_toolkit_plus_weather_error( $msg = false )
{
    if(!$msg) $msg = esc_html__('No weather information available', 'luxicar');
    
    // DISPLAY ADMIN
    if ( current_user_can( 'manage_options' ) ) 
    {
        return "<blockquote>" . $msg . "</blockquote>";
    }
    else
    {
        return apply_filters( 'luxicar_toolkit_plus_weather_error', "<!-- AWESOME WEATHER ERROR: " . $msg . " -->" );
    }
}

function luxicar_toolkit_plus_weather_admin_scripts( $hook )
{
    if( 'widgets.php' != $hook && 'post.php' != $hook ) return;
    
    wp_localize_script( 'awesome_weather_admin_script', 'awe_script', array(
            'no_owm_city'               => esc_attr(__("No city found in OpenWeatherMap.", 'luxicar')),
            'one_city_found'            => esc_attr(__('Only one location found. The ID has been set automatically above.', 'luxicar')),
            'confirm_city'              => esc_attr(__('Please confirm your city: &nbsp;', 'luxicar')),
        )
    );
}
add_action( 'admin_enqueue_scripts', 'luxicar_toolkit_plus_weather_admin_scripts' );

// get content post format
function luxicar_toolkit_plus_content_get_gallery($content, $enable_multi = false) {
    return luxicar_toolkit_plus_content_get_media($content, $enable_multi, array('gallery'));
}

function luxicar_toolkit_plus_content_get_video($content, $enable_multi = false) {
    return luxicar_toolkit_plus_content_get_media($content, $enable_multi, array('vimeo', 'youtube'));
}

function luxicar_toolkit_plus_content_get_audio($content, $enable_multi = false) {
    return luxicar_toolkit_plus_content_get_media($content, $enable_multi, array('audio', 'soundcloud'));
}

function luxicar_toolkit_plus_content_get_media($content, $enable_multi = false, $media_types = array()) {
    $media = array();
    $regex_matches = '';
    $regex_pattern = get_shortcode_regex();
    preg_match_all('/' . $regex_pattern . '/s', $content, $regex_matches);
    foreach ($regex_matches[0] as $shortcode) {
        $regex_matches_new = '';
        preg_match('/' . $regex_pattern . '/s', $shortcode, $regex_matches_new);

        if (in_array($regex_matches_new[2], $media_types)) :
            $media[] = array(
                'shortcode' => $regex_matches_new[0],
                'type' => $regex_matches_new[2],
                'url' => $regex_matches_new[5]
            );
            if (false == $enable_multi) {
                break;
            }
        endif;
    }

    return $media;
}

function luxicar_toolkit_plus_get_video_thumbnails_url($type, $url) {
    $thubnails = '';
    $matches = array();
    if ('youtube' === $type) {
        preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $url, $matches);
        $thubnails = 'http://img.youtube.com/vi/'.$matches[0].'/hqdefault.jpg';
    } else if ('vimeo' === $type) {
        preg_match_all('#(http://vimeo.com)/([0-9]+)#i', $url, $matches);
        $imgid           = $matches[2][0];
        $url             = 'http://vimeo.com/api/v2/video/'.$imgid.'.php';
        $video_thumbnail = wp_remote_get($url);
        $thubnails       = unserialize ( wp_remote_retrieve_body( $video_thumbnail ) );
        $thubnails       = $thubnails[0]['thumbnail_large'];
    }
    return $thubnails;
}

function luxicar_toolkit_plus_content_get_gallery_attachment_ids($content) {
    $gallery = luxicar_toolkit_plus_content_get_gallery($content);

    if (isset($gallery[0])) {
        $gallery = $gallery[0];
    } else {
        return '';
    }

    if (isset($gallery['shortcode'])) {
        $shortcode = $gallery['shortcode'];
    } else {
        return '';
    }

    // get gallery string ids
    preg_match_all('/ids=\"(?:\d+,*)+\"/', $shortcode, $gallery_string_ids);
    if (isset($gallery_string_ids[0][0])) {
        $gallery_string_ids = $gallery_string_ids[0][0];
    } else {
        return '';
    }

    // get array of image id
    preg_match_all('/\d+/', $gallery_string_ids, $gallery_ids);
    if (isset($gallery_ids[0])) {
        $gallery_ids = $gallery_ids[0];
    } else {
        return '';
    }

    return $gallery_ids;
}
