<?php

add_filter('kpb_get_widgets_list', array('LTP_Widget_Portfolios_Loadmore', 'register_block'));

class LTP_Widget_Portfolios_Loadmore extends Kopa_Widget {

    public $kpb_group = 'portfolio';
    
    public static function register_block($blocks){
        $blocks['LTP_Widget_Portfolios_Loadmore'] = new LTP_Widget_Portfolios_Loadmore();        
        return $blocks;
    }

	public function __construct() {
		$this->widget_cssclass    = 'kopa-gallery-widget';
		$this->widget_description = esc_html__( 'Display list of portfolio & filter.', 'luxicar-lite-toolkit' );
		$this->widget_id          = 'lucixcar-toolkit-plus-widget-portfolio-loadmore';
		$this->widget_name        = esc_html__( 'Luxicar - Portfolio Filter', 'luxicar-lite-toolkit' );
		$this->settings 		  = array(
			'title'  => array(         
				'type'  => 'text',
				'std'   => '',
				'label' => esc_html__( 'Title', 'luxicar-lite-toolkit' )
			),
			'posts_per_page'  => array(
				'type'  => 'text',
				'std'   => 8,
				'label' => esc_html__( 'Number of portfolios', 'luxicar-lite-toolkit' )
			),	            
		);	

		parent::__construct();
	}

	public function widget( $args, $instance ) {
		extract( $args );

        extract( $instance );

        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

		echo wp_kses_post( $before_widget );

        $query = array(
            'post_type' => array('portfolio'),
            'posts_per_page' => (int) $posts_per_page,
            'post_status' => array('publish')
        );

        $result_set = new WP_Query($query);

        if ( $result_set->have_posts() ) :
            
            $data = '';
            $filter_bars = '';

            ob_start();
            ?>
            <div class="widget-content">
                <ul id="filter-content" class="tiles-wrap popup-wrapper">
                    <?php
                    while ($result_set->have_posts()):
                        $result_set->the_post();
                        $classes = array('kopa-all');
                        $terms = get_the_terms(get_the_ID(), 'portfolio-tag');
                        $image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );

                        
                        if(!empty($terms)){
                            foreach ($terms as $term) {
                                $classes[] = "kopa-{$term->slug}";
                                $filter_bars[$term->slug] = $term->name;
                            }
                        }

                        ?>
                        <li data-filter-class='["<?php echo implode('","', $classes); ?>"]'>
                            <div class="entry-item">
                                <div class="entry-thumb">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail( 'luxicar-widget-390x250' );?>
                                        <span class="icon-thumb"><i class="fa fa-expand"></i></span>
                                    </a>
                                </div>

                                <div class="entry-content">
                                    <h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
                                    <em><?php esc_html_e('By', 'luxicar-lite-toolkit'); ?> <?php the_author_posts_link(); ?></em>
                                </div>
                            </div>
                        </li>
                        <?php
                    endwhile;
                    ?>    
                </ul>
                <?php $url = wp_nonce_url(admin_url('admin-ajax.php?action=ltp_get_portfolio'), '$P$By.WhgC.styMXTVXajsHThQZgrlsVm1', 'ajax_security'); ?>
                <div id="load-more-wrap" href="<?php echo esc_url($url); ?>" data-paged="2" data-number="<?php echo wp_kses_post( $posts_per_page ); ?>">
                    <span id="load-more"><?php _e('Load more', 'luxicar-lite-toolkit'); ?></span>
                </div>
            </div>
            <?php
            $data = ob_get_clean();
            ?>
            <div class="widget-title">
                <div class="filters-tab">
                    <ol id="filters-tab">
                        <li class="active" data-filter="kopa-all"><?php esc_html_e('All fields', 'luxicar-lite-toolkit'); ?></li>
                        <?php
                            if($filter_bars){
                                foreach ($filter_bars as $slug => $name) { ?>
                                    <li data-filter="kopa-<?php echo esc_attr( $slug ); ?>"><?php echo esc_attr( $name ) ;?></li>
                                    <?php
                                }
                            }                                    
                        ?>
                    </ol>
                </div>
            </div>
            <?php echo sprintf( '%s', $data ); 
        endif;

        wp_reset_postdata();

		echo wp_kses_post( $after_widget );		
	}

}