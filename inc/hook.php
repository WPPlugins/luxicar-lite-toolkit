<?php
function luxicar_toolkit_meta_box_wrap_start($wrap, $value, $loop_index){
    if(0 == $loop_index){
        $wrap = '<div class="luxicar-tp-metabox-wrap luxicar-tp-metabox-wrap-first luxicar-tp-row">';
    }else{
        $wrap = '<div class="luxicar-tp-metabox-wrap luxicar-tp-row">';   
    }
    
    if ( $value['title'] ) {
        $wrap .= '<div class="luxicar-tp-col-xs-3">';
        $wrap .= esc_html($value['title']);
        $wrap .= '</div>';
        $wrap .= '<div class="luxicar-tp-col-xs-9">';
    }else{
        $wrap .= '<div class="luxicar-tp-col-xs-12">';
    }

    return $wrap;
}

function luxicar_toolkit_meta_box_wrap_end($wrap, $value, $loop_index){
    $wrap = '';

    if ( $value['desc'] ) {
        $wrap .= '<p class="luxicar-tp-help">'. $value['desc'] . '</p>';       
    }

    $wrap .= '</div>';
    $wrap .= '</div>';

    return $wrap;
}

function luxicar_toolkit_register_metabox_description(){
    $post_type = array('post', 'page', 'portfolio', 'product', 'service');
    
    $args = array(
        'id'       => 'luxicar-tp-post-page-options-metabox',
        'title'    => esc_html__('Description', 'luxicar-lite-toolkit'),
        'desc'     => '',
        'pages'    => $post_type,
        'context'  => 'normal',
        'priority' => 'low',
        'fields'   => array(                         
            array(
                'title' => esc_html__('Description', 'luxicar-lite-toolkit'),
                'type'  => 'textarea',
                'id'    => 'luxicar_tp_description',
                'desc'  => esc_html__('This option show description in header.', 'luxicar-lite-toolkit'),
            ),            
        )
    );          
    
    kopa_register_metabox( $args ); 
}

function luxicar_toolkit_add_social_field($profile_fields){
	// Add new fields
	$profile_fields['twitter']   = esc_html__('Twitter URL', 'luxicar-lite-toolkit');

	return $profile_fields;
}

function luxicar_toolkit_print_single_post_author(){
    global $post;
    $user_id = $post->post_author;
    $social_links = array(); 
    $social_links['twitter'] = get_user_meta($user_id, 'twitter', true);
    if($social_links['twitter']) : ?>
        <a class="author-follow" href="<?php echo esc_url($social_links['twitter']); ?>"><?php echo esc_attr('Follow me on Twitter', 'luxicar-lite-toolkit'); ?></a>
    <?php endif; 
}