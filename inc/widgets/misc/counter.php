<?php

add_filter('kpb_get_widgets_list', array('LTP_Widget_Counter', 'register_block'));

class LTP_Widget_Counter extends Kopa_Widget {

    public $kpb_group = 'misc';

    public static function register_block($blocks){
        $blocks['LTP_Widget_Counter'] = new LTP_Widget_Counter();
        return $blocks;
    }

	public function __construct() {
		$this->widget_cssclass    = 'kopa-counter-widget-1';
		$this->widget_description = esc_html__( 'Display icon and number.', 'luxicar-lite-toolkit' );
		$this->widget_id          = 'luxicar-toolkit-plus-widget-counter';
		$this->widget_name        = esc_html__( 'Luxicar - Counter', 'luxicar-lite-toolkit' );
		$this->settings 		  = array(        
            'desc'  => array(
                'type'  => 'textarea',
                'std'   => '',
                'rows'  => 10,
                'desc'  => esc_html__('Recomend shortcode [counter icon="fa-rocket" number="20"]Title[/counter]', 'luxicar-lite-toolkit'),
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

		echo wp_kses_post( $before_widget );
        ?>
            <div class="widget-content">
                <?php echo do_shortcode( $desc ); ?>
            </div>
        <?php
		echo wp_kses_post( $after_widget );

		$content = ob_get_clean();

		echo sprintf( '%s', $content );		
	}

}