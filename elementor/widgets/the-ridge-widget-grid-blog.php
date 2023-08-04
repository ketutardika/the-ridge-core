<?php
class Elementor_The_Ridge_Widget_Grid_Blog extends \Elementor\Widget_Base {

	public function get_name() {
		return 'the_ridge_featured_grid_blog';
	}

	public function get_title() {
		return esc_html__( 'The Ridge Blog Grid', 'the-ridge-core' );
	}

	public function get_icon() {
		return 'eicon-dual-button';
	}

	public function get_categories() {
		return [ 'the-ridge-category' ];
	}

	public function get_keywords() {
		return [ 'the ridge', 'grid blog' ];
	}

	protected function register_controls() {

		// Content Tab Start

		$this->start_controls_section(
			'section_grid_blog',
			[
				'label' => esc_html__( 'Grid Blog', 'the-ridge-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
            'post_type',
            [
                'label' => __('Post Type', 'the-ridge-core'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'post',
                'options' => $this->get_available_post_types(),
            ]
        );

		$this->add_control(
            'post_count',
            [
                'label' => __('Number of Posts', 'the-ridge-core'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 3,
            ]
        );

		$this->add_control(
	        'cta_text',
	        [
	            'label' => __( 'Button Text', 'the-ridge-core' ),
	            'type' => \Elementor\Controls_Manager::TEXT,
	            'default' => __( 'Join Now', 'the-ridge-core' ),
	            'placeholder' => __( 'Enter your Button text', 'the-ridge-core' ),
	        ]
	    );

	    $this->add_control(
	        'cta_link_type',
	        [
	            'label' => __( 'Internal or External Link', 'the-ridge-core' ),
	            'type' => \Elementor\Controls_Manager::CHOOSE,
	            'options' => [
	                'external' => [
	                    'title' => __( 'External', 'the-ridge-core' ),
	                    'icon' => 'fa fa-external-link',
	                ],
	                'internal' => [
	                    'title' => __( 'Internal', 'the-ridge-core' ),
	                    'icon' => 'fa fa-link',
	                ],
	            ],
	            'default' => 'internal',
	            'toggle' => true,
	        ]
	    );

	    $this->add_control(
	        'cta_link_external',
	        [
	            'label' => __( 'External Link', 'the-ridge-core' ),
	            'type' => \Elementor\Controls_Manager::URL,
	            'placeholder' => __( 'https://your-external-link.com', 'the-ridge-core' ),
	            'show_external' => true,
	            'default' => [
	                'url' => '',
	                'is_external' => true,
	                'nofollow' => true,
	            ],
	            'condition' => [
	                'cta_link_type' => 'external',
	            ],
	        ]
	    );

	    $pages = get_pages();
	    $page_options = array();

	    foreach ( $pages as $page ) {
	        $page_options[ $page->ID ] = $page->post_title;
	    }

	    $this->add_control(
	        'cta_link_page',
	        [
	            'label' => __( 'Internal Link', 'the-ridge-core' ),
	            'type' => \Elementor\Controls_Manager::SELECT,
	            'options' => $page_options,
	            'default' => '',
	            'condition' => [
	                'cta_link_type' => 'internal',
	            ],
	        ]
	    );

		$this->end_controls_section();

		// Content Tab End


		// Style Tab Start

		$this->start_controls_section(
			'section_title_style',
			[
				'label' => esc_html__( 'Title', 'the-ridge-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Text Color', 'the-ridge-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hello-world' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		// Style Tab End

	}

	protected function render() {
	    $settings = $this->get_settings_for_display();
	    ?>

		<!-- Blog Grid Start -->
		<div class="container-fluid blog-section">
	    <div class="row justify-content-center">
	    	<?php
	    		$args = array(
			        'post_type' => $settings['post_type'],
			        'posts_per_page' => $settings['post_count'],
			    );

			    $query = new WP_Query($args);

			    if ($query->have_posts()) {
			    	while ($query->have_posts()) {
		            	$query->the_post();
		            	global $post;
		            	// Get the post title and truncate it to 122 characters
		            	$title = $this->get_truncated_title(8);
			            // Get the post description and truncate it to 122 characters
			            $description = $this->get_truncated_description(20);
			            // Get the first category for the current post
		            	$categories = get_the_category($post->ID);	            
		    			?>

		    			<div class="col-lg-4 col-md-6">
			                <div class="card overflow-hidden">
			                    <div class="image position-relative overflow-hidden">
			                    	<?php the_post_thumbnail( 'blog-post-grid', array('class' => 'img-fluid') ); ?>
			                    </div>

			                    <div class="card-body content">	                        	
			                        <?php 
			                        	if (!empty($categories)) {
							                $category = $categories[0];
    										$category_id = get_cat_ID( $category->name );
							                ?>
							                <h6 class="mt-3 display-9 section-heading-text text-color-primary">
							                	<a href="<?php echo esc_url( get_category_link($category_id) ); ?>">
							                			<?php echo $category->name; ?>
							                		</a>
							                </h6>
							            <?php
							            }
			                        ?>
			                        <h4 class="display-6 mb-3 text-color-secondary">
			                        	<a href="<?php echo get_the_permalink(); ?>"><?php echo $title; ?></a>
			                        </h4>
			                        <p class="display-8 para-desc mx-auto mb-0 text-color-primary"><?php echo $description; ?>
			                        </p>
			                    
			                        <div class="mt-4">
			                            <a href="<?php get_category_link($category->term_id); ?>" class="display-10 btn btn-ridge-secondary section-heading-text text-color-secondary">Continue Reading</i></a>
			                        </div>
			                    </div>
			                </div>
			            </div><!--end col-->
		            	<?php
	           		}
			    } 
			    else {
			        echo __('No posts found.', 'the-ridge-core');
			    }

	    wp_reset_postdata();
	    ?>
	    </div>
		</div>
        <!-- Blog Grid End -->
        <?php
	}

    // Helper function to get available post types
    private function get_available_post_types() {
        $post_types = get_post_types(['public' => true], 'objects');
        $options = [];

        foreach ($post_types as $post_type) {
            $options[$post_type->name] = $post_type->labels->singular_name;
        }

        return $options;
    }

	// Helper function to get truncated post description
	private function get_truncated_description($length) {
	    $post_excerpt = get_the_excerpt();
	    if (mb_strlen($post_excerpt) > $length) {
	        $post_excerpt = wp_trim_words($post_excerpt, $length, '...');
	    }
	    return $post_excerpt;
	}

	// Helper function to get truncated post description
	private function get_truncated_title($length) {
	    $post_title = get_the_title();
	    if (mb_strlen($post_title) > $length) {
	        $post_title = wp_trim_words($post_title, $length,'');
	    }
	    return $post_title;
	}
}