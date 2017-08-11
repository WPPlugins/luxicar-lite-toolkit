<?php

function luxicar_toolkit_metabox_field_gallery($html, $wrap_start, $wrap_end, $field, $value){
    ob_start();

    echo $wrap_start;        
    ?>  
    <div class="luxicar-tp-gallery-box">
        <input 
        class="medium-text luxicar-tp-gallery" 
        type="text" 
        name="<?php echo esc_attr($field['id']);?>" 
        id="<?php echo esc_attr($field['id']);?>" 
        value="<?php echo esc_attr($value);?>"         
        autocomplete="off">

        <a href="#" class="luxicar-tp-gallery-config button button-secondary">
            <?php esc_html_e('Config', 'luxicar-toolkit'); ?>
        </a>
    </div>
    <?php
    echo $wrap_end;
    $html = ob_get_clean();

    return $html;
}