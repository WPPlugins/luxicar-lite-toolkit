<?php
/**
 * Get config options for post widget
 * @package  luxicar-toolkit
 * @version 1.0.0
 * @return void
 */ 
function luxicar_toolkit_get_post_widget_args(){
	
	$all_cats = get_categories();
	$categories = array('' => esc_html__('-- none --', 'luxicar-lite-toolkit'));
	foreach ( $all_cats as $cat ) {
		$categories[ $cat->slug ] = $cat->name;
	}

	$all_tags = get_tags();
	$tags = array('' => esc_html__('-- none --', 'luxicar-lite-toolkit'));
	foreach( $all_tags as $tag ) {
		$tags[ $tag->slug ] = $tag->name;
	}

	return array(
		'title'  => array(
			'type'  => 'text',
			'std'   => '',
			'label' => esc_html__( 'Title:', 'luxicar-lite-toolkit' ),
		),
		'categories' => array(
			'type'    => 'multiselect',
			'std'     => '',
			'label'   => esc_html__( 'Categories:', 'luxicar-lite-toolkit' ),
			'options' => $categories,
			'size'    => '5',
		),
		'relation'    => array(
			'type'    => 'select',
			'label'   => esc_html__( 'Relation:', 'luxicar-lite-toolkit' ),
			'std'     => 'OR',
			'options' => array(
				'AND' => esc_html__( 'AND', 'luxicar-lite-toolkit' ),
				'OR'  => esc_html__( 'OR', 'luxicar-lite-toolkit' ),
			),
		),
		'tags' => array(
			'type'    => 'multiselect',
			'std'     => '',
			'label'   => esc_html__( 'Tags:', 'luxicar-lite-toolkit' ),
			'options' => $tags,
			'size'    => '5',
		),
		'order' => array(
			'type'  => 'select',
			'std'   => 'DESC',
			'label' => esc_html__( 'Order:', 'luxicar-lite-toolkit' ),
			'options' => array(
				'ASC'  => esc_html__( 'ASC', 'luxicar-lite-toolkit' ),
				'DESC' => esc_html__( 'DESC', 'luxicar-lite-toolkit' ),
			),
		),
		'orderby' => array(
			'type'  => 'select',
			'std'   => 'date',
			'label' => esc_html__( 'Orderby:', 'luxicar-lite-toolkit' ),
			'options' => array(
				'date'          => esc_html__( 'Date', 'luxicar-lite-toolkit' ),
				'rand'          => esc_html__( 'Random', 'luxicar-lite-toolkit' ),
				'comment_count' => esc_html__( 'Number of comments', 'luxicar-lite-toolkit' ),
			),
		),
		'number' => array(
			'type'    => 'number',
			'std'     => '5',
			'label'   => esc_html__( 'Number of posts:', 'luxicar-lite-toolkit' ),
			'min'     => '1',
		)
	);
}

/**
 * Get query for post widget
 * @package  luxicar-toolkit
 * @version 1.0.0
 * @return array $args for WP_Query()
 */ 
function luxicar_toolkit_get_post_widget_query( $instance ){
	$query = array(
		'post_type'      => 'post',
		'posts_per_page' => $instance['number'],
		'order'          => $instance['order'] == 'ASC' ? 'ASC' : 'DESC',
		'orderby'        => $instance['orderby'],
		'ignore_sticky_posts' => true
	);

	if ( $instance['categories'] ) {		
		if($instance['categories'][0] == '')
			unset($instance['categories'][0]);

		if ( $instance['categories'] ) {
			$query['tax_query'][] = array(
				'taxonomy' => 'category',
				'field'    => 'slug',
				'terms'    => $instance['categories'],
			);
		}
	}

	if ( $instance['tags'] ) {
		if($instance['tags'][0] == '')
			unset($instance['tags'][0]);

		if ( $instance['tags'] ) {
			$query['tax_query'][] = array(
				'taxonomy' => 'post_tag',
				'field'    => 'slug',
				'terms'    => $instance['tags'],
			);
		}
	}

	if ( isset( $query['tax_query'] ) && 
		 count( $query['tax_query'] ) === 2 ) {
		$query['tax_query']['relation'] = $instance['relation'];
	}

	return apply_filters( 'luxicar_toolkit_get_post_widget_query', $query );
}

/**
 * Get a specify shortcode by shortcode tag
 * @package  luxicar-toolkit
 * @version 1.0.0
 * @return array $codes shortcodes
 */ 
function luxicar_toolkit_get_shortcode($content, $enable_multi = false, $shortcodes = array()) {
    
	$codes         = array();
	$regex_matches = '';
	$regex_pattern = get_shortcode_regex();
    
    preg_match_all('/' . $regex_pattern . '/s', $content, $regex_matches);

    foreach ($regex_matches[0] as $shortcode) {
        $regex_matches_new = '';
        preg_match('/' . $regex_pattern . '/s', $shortcode, $regex_matches_new);

        if (in_array($regex_matches_new[2], $shortcodes)) :
            $codes[] = array(
				'shortcode' => $regex_matches_new[0],
				'type'      => $regex_matches_new[2],
				'content'   => $regex_matches_new[5],
				'atts'      => shortcode_parse_atts($regex_matches_new[3])
            );

            if (false == $enable_multi) {
                break;
            }
        endif;
    }

    return $codes;
}