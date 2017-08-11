<?php

add_filter('widgets_init', array('LTP_Widget_Multimenu', 'register_widget'));

class LTP_Widget_Multimenu extends Kopa_Widget {

    public $kpb_group = 'misc';

    public static function register_widget($blocks){
        register_widget('LTP_Widget_Multimenu');
    }

    public function __construct() {
        $menu_items = wp_get_nav_menus();
        $menu_array = array('' => esc_html__( '---- None ----', 'luxicar-lite-toolkit' ));
        foreach ( (array) $menu_items as $menu_item ) {
            $menu_array[$menu_item->term_id] = $menu_item->name;
        }
        $this->widget_cssclass    = 'widget-bottom-sidebar-2';
        $this->widget_description = esc_html__( 'Display multimenu, title and menu.', 'luxicar-lite-toolkit' );
        $this->widget_id          = 'luxicar-toolkit-plus-widget-multimenu';
        $this->widget_name        = esc_html__( 'Luxicar - Multimenu', 'luxicar-lite-toolkit' );
        $this->settings           = array(
            'menus'  => array(         
                'type'  => 'multiselect',
                'std'   => '',
                'options' => $menu_array,
                'label' => esc_html__( 'Menus', 'luxicar-lite-toolkit' )
            ),
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
            <?php if( $menus ) : ?>
                <div class="row">
                    <?php foreach ($menus as $menu) : ?>
                        <div class="list-item">
                            <?php $menu_object = wp_get_nav_menu_object( $menu ); ?>
                            <?php if( isset( $menu_object->name) ) : ?>
                                <h6><?php echo wp_kses_post( $menu_object->name ); ?></h6>
                            <?php endif; ?>
                            <?php wp_nav_menu( array( 'container' => false, 'fallback_cb' => '', 'menu' => $menu ) ); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        <?php
        echo wp_kses_post( $after_widget );

        $content = ob_get_clean();

        echo sprintf( '%s', $content );     
    }

}