<?php

add_filter('kopa_layout_manager_settings', 'ltp_add_layout_portfolio_single');
add_filter('kopa_custom_template_setting_id', 'ltp_portfolio_set_setting_id');
add_filter('kopa_custom_template_setting', 'ltp_portfolio_get_setting', 10, 2);
add_filter('kopa_custom_layout_arguments', 'ltp_edit_custom_layout_feature' );

function ltp_add_layout_portfolio_single($options){
	$positions = luxicar_lite_get_positions();
	$sidebars  = luxicar_lite_get_sidebars();

	$single_portfolio = array(
		'title'     => esc_html__( 'Portfolio Single', 'luxicar-lite-toolkit' ),
		'preview'   => LT_DIR . 'assets/images/layouts/portfolio-single.png',
		'positions' => array(			
			'pos_bottom_1',
			'pos_bottom_2',
			'pos_bottom_3',
			'pos_footer_1',
			'pos_footer_2',
        )
	);

	$options[] = array(
		'title'   => esc_html__( 'Portfolio Single', 'luxicar-lite-toolkit' ),
		'type' 	  => 'title',
		'id' 	  => 'single-portfolio'
	);

	$options[] = array(
		'title'     =>  esc_html__( 'Portfolio Single',  'luxicar-lite-toolkit' ),
		'type'      => 'layout_manager',
		'id'        => 'layout-portfolio',
		'positions' => $positions,
		'layouts'   => array(
			'single-portfolio' => $single_portfolio,
		),
		'default' => array(
			'layout_id' => 'single-portfolio',
			'sidebars'  => array(
				'single-portfolio' => $sidebars,		
			),
		),
	);

	return $options;
}

function ltp_portfolio_set_setting_id($setting_id){	
	if(is_singular('portfolio')){
		 $setting_id = 'layout-portfolio';
	}
	
	return $setting_id;
}

function ltp_edit_custom_layout_feature( $args ) {
	$args[] = array(
		'screen'   => 'portfolio',
		'taxonomy' => false,
		'layout'   => 'layout-portfolio',
	);

	return $args;
}

function ltp_portfolio_get_setting($setting, $setting_id){
	if(empty($setting)){
		if('single-portfolio' == $setting_id){
			$layouts = ltp_add_layout_portfolio_single(array());
			if(isset($layouts[1]['default'])){
				$setting = $layouts[1]['default'];
			}
		}
	}	

	return $setting;
}