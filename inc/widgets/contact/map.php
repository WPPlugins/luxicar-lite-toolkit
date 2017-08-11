<?php

add_filter('kpb_get_widgets_list', array('LTP_Widget_Map', 'register_block'));

class LTP_Widget_Map extends Kopa_Widget {

    public $kpb_group = 'contact';
    
    public static function register_block($blocks){
        $blocks['LTP_Widget_Map'] = new LTP_Widget_Map();        
        return $blocks;
    }

    public function __construct() {
        $this->widget_cssclass    = 'update';
        $this->widget_description = esc_html__( 'Display google map.', 'luxicar-lite-toolkit' );
        $this->widget_id          = 'lucixcar-toolkit-plus-widget-map';
        $this->widget_name        = esc_html__( 'Luxicar - Map', 'luxicar-lite-toolkit' );
        $this->settings           = array(
            'title'  => array(         
                'type'  => 'text',
                'std'   => '',
                'label' => esc_html__( 'Title', 'luxicar-lite-toolkit' )
            ),
            'place'  => array(         
                'type'  => 'text',
                'std'   => '',
                'label' => esc_html__( 'Place', 'luxicar-lite-toolkit' )
            ),
            'latitude'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => esc_html__( 'Latitude', 'luxicar-lite-toolkit' )
            ),   
            'longitude'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => esc_html__( 'Longitude', 'luxicar-lite-toolkit' )
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
            <?php if( $latitude && $longitude ) : ?>
                <div class="kopa-map-box">
                    <?php echo sprintf('<div id="kopa-map" class="kopa-map" data-place="%s" data-latitude="%s" data-longitude="%s"></div>', $place, $latitude, $longitude); ?>
                </div>
            <?php endif; ?>
        <?php 
        echo wp_kses_post( $after_widget );     
    }

}