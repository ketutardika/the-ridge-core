<?php
class Elementor_The_Ridge_Widget_3 extends \Elementor\Widget_Base {

	public function get_name() {
		return 'the_ridge_featured_image_left';
	}

	public function get_title() {
		return esc_html__( 'The Ridge Featured Image 1', 'the-ridge-core' );
	}

	public function get_icon() {
		return 'eicon-featured-image';
	}

	public function get_categories() {
		return [ 'the-ridge-category' ];
	}

	public function get_keywords() {
		return [ 'the ridge', 'featured image' ];
	}

	protected function register_controls() {

		// Content Tab Start

		$this->start_controls_section(
			'section_featured_image',
			[
				'label' => esc_html__( 'Featured Image Section', 'the-ridge-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
            'featured_image',
            [
                'label' => __( 'Featured Image', 'the-ridge-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'the-ridge-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Magnificent views', 'the-ridge-core' ),
			]
		);

		$this->add_control(
			'subtitle',
			[
				'label' => esc_html__( 'Sub Title', 'the-ridge-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Overlooking a Tropical Forest Above The Ayung River', 'the-ridge-core' ),
			]
		);

		$this->add_control(
			'description',
			[
				'label' => esc_html__( 'Description', 'the-ridge-core' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.', 'the-ridge-core' ),
			]
		);

		$this->add_control(
	        'cta_text',
	        [
	            'label' => __( 'Button Text', 'the-ridge-core' ),
	            'type' => \Elementor\Controls_Manager::TEXT,
	            'default' => __( 'Find Out More', 'the-ridge-core' ),
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
		$cta_link = '';
		    if ( 'external' === $settings['cta_link_type'] && $settings['cta_link_external']['url'] ) {
		        $cta_link = $settings['cta_link_external']['url'] ? $settings['cta_link_external']['url'] : '#';
		    } elseif ( 'internal' === $settings['cta_link_type'] && $settings['cta_link_page'] ) {
		        $cta_link = get_permalink( $settings['cta_link_page'] );
		    }
		?>

		<!-- Hero Start -->
        <section class="bg-half-170 bg-light pb-0 d-table w-100 bg-hero-ridge" style="background: url('<?php echo esc_url( $settings['hero_image']['url'] ); ?>');">
            <div class="container-fluid">
                <div class="row justify-content-center mt-5">
                    <div class="col-lg-12 text-center">
                        <div class="title-heading mt-4">
                            <h1 class="display-3 text-white title-dark mb-3"> <?php echo $settings['title']; ?> </h1>
                            <h5 class="fw-medium text-white title-dark mb-3 section-heading-text"> <?php echo $settings['subtitle']; ?> </h5>   
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
            </div> <!--end container-fluid-->
        </section><!--end section-->
        <!-- Hero End -->


        <div class="container-fluid mt-5">
                <div class="row align-items-center">
                    <div class="col-lg-8 col-md-6">
                        <img src="<?php echo esc_url( $settings['featured_image']['url'] ); ?>" class="img-fluid shadow" alt="">
                    </div><!--end col-->

                    <div class="col-lg-4 col-md-6 mt-4 mt-sm-0 pt-2 pt-sm-0">
                        <div class="section-title">
                            <h6 class="display-9 section-heading-text text-color-primary"><?php echo $settings['title']; ?></h6>
                            <h4 class="display-6 mb-3 text-color-secondary"><?php echo $settings['subtitle']; ?>.</h4>
                            <p class="display-8 para-desc mx-auto mb-0 text-color-primary"><?php echo $settings['description']; ?>  
                            </p>

                            <div class="mt-4">
                                <?php if ( $settings['cta_text'] && $cta_link ) : ?>
							        <a class="display-10 btn btn-ridge-secondary section-heading-text text-color-secondary" href="<?php echo esc_url( $cta_link ); ?>">
							            <?php echo esc_html( $settings['cta_text'] ); ?>
							        </a>
							    <?php endif; ?>
                            </div>
                        
                            <div class="mt-4">
                                <a href="javascript:void(0)" class="display-10 btn btn-ridge-secondary section-heading-text text-color-secondary">explore the villas</i></a>
                            </div>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end container-fluid-->

		<?php
	}
}