<?php
add_filter('kopa_admin_meta_box_field_datetime', 'ltp_metabox_field_datetime', 10, 5);

function ltp_metabox_field_datetime($html, $wrap_start, $wrap_end, $value, $option_value){
    ob_start();

    echo wp_kses_post( $wrap_start );   
    ?>
    
    <input 
    class="medium-text ltp-datetime" 
    type="text" 
    name="<?php echo esc_attr($value['id']);?>" 
    id="<?php echo esc_attr($value['id']);?>" 
    value="<?php echo esc_attr($option_value);?>"     
    data-timepicker="<?php echo esc_attr($value['timepicker']);?>"
    data-datepicker="<?php echo esc_attr($value['datepicker']);?>"
    data-format="<?php echo esc_attr($value['format']);?>"
    autocomplete="off">
    <?php
    echo wp_kses_post( $wrap_end );

    $html = ob_get_clean();
    return $html;
}