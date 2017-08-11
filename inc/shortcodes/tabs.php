<?php

add_shortcode('luxicar_tabs', 'luxicar_toolkit_shortcode_tabs');
add_shortcode('luxicar_tab', '__return_false');

function luxicar_toolkit_shortcode_tabs($atts, $content = null) {
    extract(shortcode_atts(array('style' => ''), $atts));

    $items  = luxicar_toolkit_get_shortcode($content, true, array('luxicar_tab'));
    $navs   = array();
    $panels = array();

    if ($items) {
        $active = 'active';
        foreach ($items as $item) {
            $title    = $item['atts']['title'];
            $item_id  = 'tab-' . wp_generate_password(4, false, false);
            $navs[]   = sprintf('<li class="%s"><a href="#%s" data-toggle="tab">%s</a></li>', $active, $item_id, do_shortcode($title));
            if($style == "kopa-tab s1"){
                $panels[] = sprintf('<div class="tab-pane %s" id="%s"><article class="entry-item">
                                        <div class="entry-thumb">
                                            <img src="%s" alt="" class="img-responsive"></a>
                                        </div>

                                        <div class="entry-content">
                                            %s
                                        </div>
                                    </article></div>', $active, $item_id, $item['atts']['image'], do_shortcode($item['content']));
            }else{
                $panels[] = sprintf('<div class="tab-pane %s" id="%s">%s</div>', $active, $item_id, do_shortcode($item['content']));
            }
            $active   = '';
        }
    }

    $output = sprintf('<div class="%s">', $style);
    
    $output .= '<ul class="nav nav-tabs" >';
    $output .= implode('', $navs);
    $output .= '</ul>';
    
    $output .= '<div class="tab-content">';
    $output .= implode('', $panels);
    $output .= '</div>';
    
    $output .= '</div>';

    return apply_filters('luxicar_toolkit_shortcode_tabs', $output, $atts, $content);
}