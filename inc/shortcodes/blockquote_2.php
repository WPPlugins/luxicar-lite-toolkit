<?php

add_shortcode('luxicar_blockquote_2', 'luxicar_toolkit_shortcode_blockquote_2');

function luxicar_toolkit_shortcode_blockquote_2($atts, $content = null) {
    extract(shortcode_atts(array('author_link' => '' ,'author_avatar' => '', 'author_name' => '', 'author_infor'=> '', 'author_rate' => ''), $atts));

    $output = NULL;

    if (!empty($content)) {
        $output = sprintf('<div class="kopa-blockquote s2"><article><p>%s</p></article>', $content);

        if (isset($atts['author_avatar']) || isset($atts['author_name']) || isset($atts['author_infor']) || isset($atts['author_rate'])) {
            $output.= '<footer>';
            if(isset($atts['author_avatar'])) {
                $output.= sprintf('<a href="%1$s"><img alt="" src="%2$s" class="img-responsive"></a>', $atts['author_link'], $atts['author_avatar']);   
            }
            if(isset($atts['author_name']) || isset($atts['author_infor'])){
                $output.= '<div class="draft">';
                $output.= sprintf('<h6><a href="%1$s">%2$s</a></h6>', $atts['author_link'], $atts['author_name']);
                $output.= sprintf('<p>%s</p>', $atts['author_infor']);
                $output.= '</div';
            }
            if(isset($atts['author_rate'])){
                $output.= '<div class="kopa-star">'; 
                $num_rate = (int)$atts['author_rate'];
                $i = 0;
                while($i < $num_rate){
                    $output.= '<i class="fa fa-star"></i>'; 
                    $i ++;
                }
                $output.= '</div>';
            }
            $output.= '</footer>';
        }
        $output .= '</div>';
    }

    return apply_filters('luxicar_toolkit_shortcode_blockquote_2', $output, $atts, $content);
}
