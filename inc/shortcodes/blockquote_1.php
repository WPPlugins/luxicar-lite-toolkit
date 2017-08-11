<?php

add_shortcode('luxicar_blockquote_1', 'luxicar_toolkit_shortcode_blockquote_1');

function luxicar_toolkit_shortcode_blockquote_1($atts, $content = null) {
    extract(shortcode_atts(array('class' => '', 'author_avatar' => '', 'author_name' => '', 'author_infor'=> ''), $atts));
    $class   = isset($atts['class']) ? $atts['class'] : 'kopa-blockquote';
    $classes = explode(' ', $class);
    $output = NULL;

    if (!empty($content)) {
        $output = sprintf('<div class="%s"><i>%s</i>', $class, $content);

        if (isset($atts['author_avatar']) || isset($atts['author_name']) || isset($atts['author_infor'])) {
            $output.= '<div class="user-reviews">';
            if(isset($atts['author_avatar'])) {
                $output.= sprintf('<img alt="" src="%1$s" class="img-responsive">', $atts['author_avatar']);   
            }
            if(isset($atts['author_name']) || isset($atts['author_infor'])){
                $output.= '<div class="text-user-reviews">';
                $output.= sprintf('<h5>%s</h5>', $atts['author_name']);
                $output.= sprintf('<p>%s</p>', $atts['author_infor']);
                $output.= '</div>';
            }
            $output.= '</div>';
        }
        $output.= '</div>';
    }

    return apply_filters('luxicar_toolkit_shortcode_blockquote_1', $output, $atts, $content);
}
