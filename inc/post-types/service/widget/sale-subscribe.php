<?php

add_action( 'kpb_get_widgets_list', array('LTP_Widget_Sale_Subscribe', 'register_block'));
	
class LTP_Widget_Sale_Subscribe extends Kopa_Widget {

	public $kpb_group = 'service';
	
	public static function register_block($blocks){
       	$blocks['LTP_Widget_Sale_Subscribe'] = new LTP_Widget_Sale_Subscribe();
        return $blocks;
    }
    
	public function __construct() {

		$args = array( 'posts_per_page' => -1, 'post_type' => 'service',);

		$services = get_posts( $args );

		$services_array = array('' => '---- None ----');

		foreach ( $services as $service ) : setup_postdata( $service );
			$services_array[$service->ID] = $service->post_title;
		endforeach; 
		wp_reset_postdata();

		$this->widget_cssclass    = 'kopa-sale-widget';
		$this->widget_description = esc_html__( 'Display service sale and subscribe form.', 'luxicar-lite-toolkit' );
		$this->widget_id          = 'lucixcar-toolkit-plus-widget-sale-subscribe';
		$this->widget_name        = esc_html__( 'Luxicar - Sale & Subscribe', 'luxicar-lite-toolkit' );
		$this->settings 		  = array(
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
			'service_id'  => array(
				'type'    => 'select',
				'std'     => '',
				'options' => $services_array,
				'label'   => esc_html__( 'Service', 'luxicar-lite-toolkit' )
			),
			'button_text'  => array(
				'type'    => 'text',
				'std'     => '',
				'label'   => esc_html__( 'Button Text', 'luxicar-lite-toolkit' )
			),
			'button_url'  => array(
				'type'    => 'text',
				'std'     => '',
				'label'   => esc_html__( 'Button URL', 'luxicar-lite-toolkit' )
			),
			'title_subscribe'  => array(
				'type'    => 'text',
				'std'     => '',
				'label'   => esc_html__( 'Title Subscribe', 'luxicar-lite-toolkit' )
			),
			'desc_subscribe'  => array(
				'type'    => 'textarea',
				'std'     => '',
				'label'   => esc_html__( 'Description Subscribe', 'luxicar-lite-toolkit' )
			),
			'service'  => array(
				'type'  => 'select',
				'label' => esc_html__( 'Mailchimp / Feedburner', 'luxicar-lite-toolkit' ),
				'std'     => 'feedburner',
				'options' => array(
					'mailchimp'  => esc_html__('Mailchimp ', 'luxicar-lite-toolkit'),
					'feedburner' => esc_html__('Feedburner', 'luxicar-lite-toolkit')
				)
			),
			'id'  => array(
				'type'  => 'text',
				'label' => esc_html__( 'ID / URL', 'luxicar-lite-toolkit' )
			),
			'extra'  => array(
				'type'    => 'textarea',
				'std'     => '',
				'label'   => esc_html__( 'Extra', 'luxicar-lite-toolkit' )
			)
		);	

		parent::__construct();
	}

	public function widget( $args, $instance ) {	
		ob_start();

		extract( $args );

		extract( $instance );
		
		echo wp_kses_post( $before_widget );

		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);			

		?>
			<?php if($title || $desc) : ?>
				<header>
					<?php 
						if($title) :
							echo '<h2>'.wp_kses_post( $before_title . $title .$after_title ).'</h2>'; 
						endif;
						if($desc) : 
							echo '<p>'.wp_kses_post( $desc ).'</p>';
						endif;
					?>
				</header>
			<?php endif; ?>

			<footer>
				<div class="row">
					<div class="col-xs-12 col-md-6">
						<div class="sale-left">
							<h4><?php echo get_the_title( $service_id ); ?></h4>

							<?php $service_price = get_post_meta( $service_id, LTP_PREFIX . 'service-price' , true ); ?>
							<div class="sale-off">
								<h5><?php echo wp_kses_post( $service_price ); ?></h5>
							</div>

							<?php 
								$service_include = get_post_meta( $service_id, LTP_PREFIX . 'service-include' , true );
							?>
							<?php if( $service_include || $service_icon ) : ?>
								<div class="row">
									<?php if( $service_include ) : ?>
										<div class="col-left">
											<h6><?php echo esc_html_e('Service Includes', 'luxicar-lite-toolkit'); ?>:</h6>
											<?php echo wp_kses_post( $service_include ); ?>
										</div>
									<?php endif; ?>
									<?php if( has_post_thumbnail( $service_id ) ) : ?>
										<div class="col-right">
											<?php echo get_the_post_thumbnail( $service_id, 'luxicar-widget-155x155' ); ?>
										</div>
									<?php endif; ?>
								</div>
							<?php endif; ?>
						</div>
					</div>

					<div class="col-xs-12 col-md-6">
						<div class="sale-right">
							<?php 
								if( $title_subscribe ) :
									echo '<h4>'.wp_kses_post( $title_subscribe ).'</h4>';
								endif; 
								if( $desc_subscribe ) :
									echo '<p>'.wp_kses_post( $desc_subscribe ).'</p>';
								endif;
							?>
							<?php if( $service == 'feedburner') : ?>
						        <form class="newsletter-form clearfix" method="post" action="http://feedburner.google.com/fb/a/mailverify" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo esc_html( $id ); ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520'); return true;">		            
						            <input type="text" onBlur="if (this.value == '')
						                this.value = this.defaultValue;" onFocus="if (this.value == this.defaultValue)
						                this.value = '';" value="Enter Your Email..." size="40" class="name"  name="name">
						                <input type="hidden" value="<?php echo esc_url( $id ); ?>" name="uri">
						            <button type="submit">
						                <?php esc_html_e('Subscribe', 'luxicar-lite-toolkit'); ?>
						            </button>                 
						        </form>
						    <?php endif; ?>
							    <?php if( $service == 'mailchimp') : ?>
							        <form class="newsletter-form clearfix" method="post" action="<?php echo esc_url( $id ); ?>">
							            <input type="text" onBlur="if (this.value == '')
							                this.value = this.defaultValue;" onFocus="if (this.value == this.defaultValue)
							                this.value = '';" value="Enter Your Email..." size="40" class="name"  name="name">
							            <input type="hidden" value="<?php echo esc_url( $id ); ?>" name="uri">
							            <button type="submit">
							                <?php esc_html_e('Subscribe', 'luxicar-lite-toolkit'); ?>
							            </button>                 
							        </form>
							    <?php endif; ?>
							<?php echo wp_kses_post( $extra ); ?>
						</div>
					</div>
				</div>
			</footer>
			<?php if( $button_text && $button_url ) : ?>
				<div class="more-1">
					<a href="<?php echo esc_url( $button_url ); ?>"><?php echo wp_kses_post( $button_text ); ?><span></span></a>
				</div>
			<?php endif; ?>
		<?php

		wp_reset_postdata();

		echo wp_kses_post( $after_widget );

		$content = ob_get_clean();

		echo sprintf('%s', $content);		
		
	}

}