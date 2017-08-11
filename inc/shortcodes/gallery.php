<?php

remove_shortcode('gallery', 'gallery_shortcode');
add_shortcode('gallery', 'luxicar_toolkit_gallery_shortcode');

function luxicar_toolkit_gallery_shortcode($atts, $content = null) {
    extract(shortcode_atts(array("ids" => '', "display_type" => 0), $atts));
    $output = '';

    if (isset($atts['ids'])) {
        $ids = explode(',', $atts['ids']);

        if ($ids) {
            
            $output .= '<div class="content-slider-10 load-slick">';
            foreach ($ids as $id) {
                $img = get_post($id);
                if(is_object($img)){
                    $caption = $img->post_excerpt;
                    $author_id = $img->post_author;
                    $img_link = $img->guid;
                    $author_name = get_userdata($author_id)->display_name; 
                    $image = wp_get_attachment_image_src($id, 'luxicar-gallery-single');
                    $image_link = !empty($image) ? $image[0] : '';
                    $output .= '<div class="entry-item">';
                    $output .= '<div class="entry-thumb">'; ?>

                    <?php
                    $output .= sprintf('<a href="%1$s"><img src="%1$s" width="635" height="350"></a>', $image_link);
                    $output .= '<span class="icon-thumb"><i class="fa fa-expand"></i></span>';
                    $output .= '</div>';
                    if ($caption || $author_id) {
                        $output .= sprintf('<div class="entry-content">
                                         <h6><a href="%1$s">%2$s</a></h6>
                                         <p>By %3$s</p>
                                     </div>', $img_link, $caption, $author_name);
                    }
                    $output .= '</div>';
                    wp_reset_query();
                }
            }
            $output .= '</div>';
        }
    }
    return $output;
}
