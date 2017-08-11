<?php

add_filter('widgets_init', array('LTP_Widget_Contact_Info_4_Columns', 'register_widget'));

class LTP_Widget_Contact_Info_4_Columns extends Kopa_Widget {

    public $kpb_group = 'contact';

    public static function register_widget($blocks){
        register_widget('LTP_Widget_Contact_Info_4_Columns');
    }

    public function __construct() {
        $this->widget_cssclass    = 'widget-infomation';
        $this->widget_description = esc_html__( 'Display contact info 4 columns. Recommend use shortcode.', 'luxicar-lite-toolkit' );
        $this->widget_id          = 'luxicar-toolkit-plus-widget-contact-info-4-columns';
        $this->widget_name        = esc_html__( 'Luxicar - Contact Info 4 Columns', 'luxicar-lite-toolkit' );
        $this->settings           = array(
            'col_1'  => array(         
                'type'  => 'textarea',
                'std'   => '',
                'rows'  => 5,
                'desc' => esc_html__( 'Recommend shortcode [info icon="fa-envelope" title="Title"]Content[/info]', 'luxicar-lite-toolkit' ),
                'label' => esc_html__( 'Column 1', 'luxicar-lite-toolkit' )
            ),
            'col_2'  => array(         
                'type'  => 'textarea',
                'std'   => '',
                'rows'  => 5,
                'desc' => esc_html__( 'Recommend shortcode [info icon="fa-envelope" title="Title"]Content[/info]', 'luxicar-lite-toolkit' ),
                'label' => esc_html__( 'Column 2', 'luxicar-lite-toolkit' )
            ),              
            'col_3'  => array(
                'type'  => 'textarea',
                'std'   => '',
                'rows'  => 5,
                'desc' => esc_html__( 'Recommend shortcode [info icon="fa-envelope" title="Title"]Content[/info]', 'luxicar-lite-toolkit' ),
                'label' => esc_html__( 'Column 3', 'luxicar-lite-toolkit' )
            ),
            'col_4'  => array(
                'type'  => 'textarea',
                'std'   => '',
                'rows'  => 5,
                'desc' => esc_html__( 'Recommend shortcode [info icon="fa-envelope" title="Title"]Content[/info]', 'luxicar-lite-toolkit' ),
                'label' => esc_html__( 'Column 4', 'luxicar-lite-toolkit' )
            )
        );  

        parent::__construct();
    }

    public function widget( $args, $instance ) {
        ob_start();

        extract( $args );
        
        $instance = wp_parse_args((array) $instance, $this->get_default_instance());
        
        extract( $instance );

        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

        echo wp_kses_post( $before_widget );
        ?>
            <div class="widget-content">
                <?php if( $col_1 ) : ?>
                    <div class="list-col">
                        <?php echo do_shortcode( $col_1 ); ?>
                    </div>
                <?php endif; ?>

                <?php if( $col_2 ) : ?>
                    <div class="list-col">
                        <?php echo do_shortcode( $col_2 ); ?>
                    </div>
                <?php endif; ?>

                <?php if( $col_3 ) : ?>
                    <div class="list-col">
                        <?php echo do_shortcode( $col_3 ); ?>
                    </div>
                <?php endif; ?>

                <?php if( $col_4 ) : ?>
                    <div class="list-col">
                        <?php echo do_shortcode( $col_4 ); ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php
        echo wp_kses_post( $after_widget );

        $content = ob_get_clean();

        echo sprintf( '%s', $content );     
    }

}