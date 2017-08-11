<?php

add_filter('widgets_init', array('LTP_Widget_Contact_Form', 'register_widget'));

class LTP_Widget_Contact_Form extends Kopa_Widget {

    public $kpb_group = 'contact';

    public static function register_widget($blocks){
        register_widget('LTP_Widget_Contact_Form');
    }

	public function __construct() {
		$this->widget_cssclass    = 'kopa-form-widget';
		$this->widget_description = esc_html__( 'Display contact form.', 'luxicar-lite-toolkit' );
		$this->widget_id          = 'luxicar-toolkit-plus-widget-contact-form';
		$this->widget_name        = esc_html__( 'Luxicar - Contact Form', 'luxicar-lite-toolkit' );
		$this->settings 		  = array(
			'title'  => array(         
				'type'  => 'text',
				'std'   => '',
				'label' => esc_html__( 'Title', 'luxicar-lite-toolkit' )
			),           
            'desc'  => array(
                'type'  => 'textarea',
                'std'   => '',
                'rows'  => 10,
                'label' => esc_html__('Description', 'luxicar-lite-toolkit')
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
            <?php if( $title || $desc ) : ?>
                <div class="widget-title widget-title-1">
                    <?php if($title) : ?>
                        <h2><?php echo wp_kses_post( $title ); ?></h2>
                    <?php endif; ?>
                    <?php if($desc) : ?>
                        <p><?php echo wp_kses_post( $desc ); ?></p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <div class="widget-content">
                <form class="contact-form-1 clearfix" action="<?php echo admin_url('admin-ajax.php'); ?>" method="post" novalidate="novalidate">
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <input type="text" placeholder="<?php esc_html_e('Name', 'luxicar-lite-toolkit'); ?>" name="name" class="valid">
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <input type="text" placeholder="<?php esc_html_e('Email', 'luxicar-lite-toolkit'); ?>" name="email" class="valid">
                        </div>
                    </div>
                    <input type="text" placeholder="<?php esc_html_e('Subject', 'luxicar-lite-toolkit'); ?>" name="subject" class="valid">
                    <textarea name="message" id="contact_message" placeholder="<?php esc_html_e('Message', 'luxicar-lite-toolkit'); ?>" cols="88" rows="2"></textarea>
                    <input type="submit" value="<?php esc_html_e('SEND', 'luxicar-lite-toolkit'); ?>" id="submit-contact-1">
                    <input type="hidden" name="action" value="luxicar_send_contact_widget_1">
                    <?php echo wp_nonce_field('luxicar_send_contact_widget_1', 'ajax_nonce_luxicar_send_contact_widget_1', true, false); ?>
                </form>
                <div id="response"></div>
            </div>
        <?php
		echo wp_kses_post( $after_widget );

		$content = ob_get_clean();

		echo sprintf( '%s', $content );		
	}

}