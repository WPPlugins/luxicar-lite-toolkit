<?php

add_filter('widgets_init', array('LTP_Widget_Contact_Info_Logo', 'register_widget'));

class LTP_Widget_Contact_Info_Logo extends Kopa_Widget {

    public $kpb_group = 'contact';

    public static function register_widget($blocks){
        register_widget('LTP_Widget_Contact_Info_Logo');
    }

    public function __construct() {
        $this->widget_cssclass    = 'widget-bottom-sidebar-1';
        $this->widget_description = esc_html__( 'Display logo and contact info ( address, phone, mobile, email ).', 'luxicar-lite-toolkit' );
        $this->widget_id          = 'luxicar-toolkit-plus-widget-contact-info-logo';
        $this->widget_name        = esc_html__( 'Luxicar - Contact Info Logo', 'luxicar-lite-toolkit' );
        $this->settings           = array(
            'logo'  => array(         
                'type'  => 'upload',
                'std'   => '',
                'mines' => 'image',
                'label' => esc_html__( 'Logo', 'luxicar-lite-toolkit' )
            ),
            'desc'  => array(         
                'type'  => 'textarea',
                'std'   => '',
                'rows' => 5,
                'label' => esc_html__( 'Description', 'luxicar-lite-toolkit' )
            ),
            'add'  => array(         
                'type'  => 'text',
                'std'   => '',
                'label' => esc_html__( 'Add', 'luxicar-lite-toolkit' )
            ),              
            'email'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => esc_html__( 'Email', 'luxicar-lite-toolkit' )
            ),
            'mobile'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => esc_html__( 'Mobile', 'luxicar-lite-toolkit' )
            ),
            'phone'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => esc_html__( 'Phone', 'luxicar-lite-toolkit' )
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
            <?php if( $logo ) : ?>
                <div id="kopa-logo-footer">
                    <a href="<?php echo esc_url( home_url( '/' ) );?>"><img src="<?php echo esc_url( $logo ); ?>" alt=""></a>
                </div>
            <?php endif; ?>
            <?php 
                if( $desc ){
                    echo '<p>'.wp_kses_post( $desc ).'</p>';
                }
            ?>
            <ul>
                <?php if( $add || $email ) : ?>
                    <li>
                        <?php if( $add ) : ?>
                            <span><i class="fa fa-map-marker"></i><?php echo wp_kses_post( $add ); ?></span>
                        <?php endif; ?>
                        <?php if( $email ) : ?>
                            <span><i class="fa fa-envelope"></i><?php echo wp_kses_post( $email ); ?></span>
                        <?php endif; ?>
                    </li>
                <?php endif; ?>

                <?php if( $mobile || $phone ) : ?>
                    <li>
                        <?php if( $mobile ) : ?>
                            <span><i class="fa fa-mobile"></i><?php echo wp_kses_post( $mobile ); ?></span>
                        <?php endif; ?>
                        <?php if( $phone ) : ?>
                            <span><i class="fa fa-phone"></i><?php echo wp_kses_post( $phone ); ?></span>
                        <?php endif; ?>
                    </li>
                <?php endif; ?>
            </ul>
        <?php
        echo wp_kses_post( $after_widget );

        $content = ob_get_clean();

        echo sprintf( '%s', $content );     
    }

}