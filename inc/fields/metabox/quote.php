<?php

function luxicar_toolkit_plus_metabox_field_quote($html, $wrap_start, $wrap_end, $field, $value){
    ob_start();

    $value = wp_parse_args((array) $value, array('quote'=> NULL, 'author' => NULL));
    extract($value );   

    echo wp_kses_post( $wrap_start );        
    ?>  
    <div class="luxicar-tp-clearfix">        
        <p class="luxicar-tp-block luxicar-tp-block-first">
            <code class="luxicar-tp-code luxicar-tp-pull-left"><?php _e('Message:', 'luxicar-lite-toolkit'); ?></code>
            <br/>
            <textarea 
                name="<?php echo esc_attr($field['id']);?>[quote]" 
                id="<?php echo esc_attr($field['id']);?>_quote" 
                value="<?php echo esc_attr($quote);?>" 
                autocomplete="off"
                class="large-text"/><?php echo esc_textarea($quote); ?></textarea>
        </p>
        <p class="luxicar-tp-block">            
            <code class="luxicar-tp-code luxicar-tp-pull-left"><?php _e('Author:', 'luxicar-lite-toolkit'); ?></code>
            <br/>
            <input type="text"
                name="<?php echo esc_attr($field['id']);?>[author]" 
                id="<?php echo esc_attr($field['id']);?>_author" 
                value="<?php echo esc_attr($author);?>" 
                autocomplete="off"
                class="luxicar-tp-pull-left medium-text"/>            
        </p>                
    </div>      
    <?php
    echo wp_kses_post( $wrap_end );
    $html = ob_get_clean();

    return $html;
}