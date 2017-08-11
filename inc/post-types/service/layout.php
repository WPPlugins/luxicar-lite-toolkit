<?php

add_filter('kopa_layout_manager_settings', 'ltp_add_layout_service_single');
add_filter('kopa_custom_template_setting_id', 'ltp_service_set_setting_id');
add_filter('kopa_custom_template_setting', 'ltp_service_get_setting', 10, 2);
add_filter('kopa_custom_layout_arguments', 'ltp_edit_custom_layout_service' );

function ltp_add_layout_service_single($options){
	$positions = luxicar_lite_get_positions();
	$sidebars  = luxicar_lite_get_sidebars();

	$single_service = array(
		'title'     => esc_html__( 'Service Single', 'luxicar-lite-toolkit' ),
		'preview'   => LT_DIR . 'assets/images/layouts/service-single.png',
		'positions' => array(			
			'pos_top',
			'pos_middle',
			'pos_right',
			'pos_footer_1',
			'pos_footer_2'
        )
	);

	$options[] = array(
		'title'   => esc_html__( 'Service Single', 'luxicar-lite-toolkit' ),
		'type' 	  => 'title',
		'id' 	  => 'single-service'
	);

	$options[] = array(
		'title'     =>  esc_html__( 'Service Single',  'luxicar-lite-toolkit' ),
		'type'      => 'layout_manager',
		'id'        => 'layout-service',
		'positions' => $positions,
		'layouts'   => array(
			'single-service' => $single_service,
		),
		'default' => array(
			'layout_id' => 'single-service',
			'sidebars'  => array(
				'single-service' => $sidebars,		
			),
		),
	);

	return $options;
}

function ltp_service_set_setting_id($setting_id){	
	if(is_singular('service')){
		 $setting_id = 'layout-service';
	}
	
	return $setting_id;
}

function ltp_edit_custom_layout_service( $args ) {
	$args[] = array(
		'screen'   => 'service',
		'taxonomy' => false,
		'layout'   => 'layout-service',
	);

	return $args;
}

function ltp_service_get_setting($setting, $setting_id){
	if(empty($setting)){
		if('single-service' == $setting_id){
			$layouts = ltp_add_layout_service_single(array());
			if(isset($layouts[1]['default'])){
				$setting = $layouts[1]['default'];
			}
		}
	}	

	return $setting;
}