<?php

add_filter('kpb_get_widgets_list', array('LTP_Widget_Contact_Info_2_Col', 'register_block'));

class LTP_Widget_Contact_Info_2_Col extends Kopa_Widget {

    public $kpb_group = 'contact';
    
    public static function register_block($blocks){
        $blocks['LTP_Widget_Contact_Info_2_Col'] = new LTP_Widget_Contact_Info_2_Col();        
        return $blocks;
    }

    public function __construct() {
        $this->widget_cssclass    = 'update';
        $this->widget_description = esc_html__( 'Display contact info 2 columns and description.', 'luxicar-lite-toolkit' );
        $this->widget_id          = 'lucixcar-toolkit-plus-widget-contact-info-2-columns';
        $this->widget_name        = esc_html__( 'Luxicar - Contact Info 2 Columns', 'luxicar-lite-toolkit' );
        $this->settings           = array(
            'title'  => array(         
                'type'  => 'text',
                'std'   => '',
                'label' => esc_html__( 'Title', 'luxicar-lite-toolkit' )
            ),
            'desc'  => array(         
                'type'  => 'textarea',
                'std'   => '',
                'label' => esc_html__( 'Description', 'luxicar-lite-toolkit' )
            ),
            'col_1'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => esc_html__( 'Column 1', 'luxicar-lite-toolkit' )
            ),   
            'col_2'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => esc_html__( 'Column 2', 'luxicar-lite-toolkit' )
            ),      
        );  

        parent::__construct();
    }

    public function widget( $args, $instance ) {
        extract( $args );

        extract( $instance );

        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

        echo wp_kses_post( $before_widget );
        ?>
            
        <?php 
        echo wp_kses_post( $after_widget );     
    }

}