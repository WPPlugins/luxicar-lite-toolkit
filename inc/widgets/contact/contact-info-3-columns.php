<?php

add_filter('kpb_get_widgets_list', array('LTP_Widget_Contact_Info_3_Col', 'register_block'));

class LTP_Widget_Contact_Info_3_Col extends Kopa_Widget {

    public $kpb_group = 'contact';
    
    public static function register_block($blocks){
        $blocks['LTP_Widget_Contact_Info_3_Col'] = new LTP_Widget_Contact_Info_3_Col();        
        return $blocks;
    }

    public function __construct() {
        $this->widget_cssclass    = 'update';
        $this->widget_description = esc_html__( 'Display contact info 3 columns and description.', 'luxicar-lite-toolkit' );
        $this->widget_id          = 'lucixcar-toolkit-plus-widget-contact-info-3-columns';
        $this->widget_name        = esc_html__( 'Luxicar - Contact Info 3 Columns', 'luxicar-lite-toolkit' );
        $this->settings           = array(
            'title'  => array(         
                'type'  => 'text',
                'std'   => '',
                'label' => esc_html__( 'Title', 'luxicar-lite-toolkit' )
            ),
            'desc_row_1'  => array(         
                'type'  => 'textarea',
                'std'   => '',
                'label' => esc_html__( 'Description Row 1', 'luxicar-lite-toolkit' ),
                'rows' => 5
            ),
            'desc_row_2'  => array(
                'type'  => 'textarea',
                'std'   => '',
                'label' => esc_html__( 'Description Row 2', 'luxicar-lite-toolkit' ),
                'desc'  => esc_html__( 'Recommend use shortcode : [info style="1"]content[/info]', 'luxicar-lite-toolkit' ),
                'rows' => 5
            )       
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
                if( $title )
                    echo '<h5>'.wp_kses_post( $title ).'</h5>';
            ?>
            <?php echo '<p>'.wp_kses_post( $desc_row_1 ).'</p>'; ?>
            <?php echo do_shortcode( $desc_row_2 ); ?>
            
        <?php 
        echo wp_kses_post( $after_widget );     
    }

}