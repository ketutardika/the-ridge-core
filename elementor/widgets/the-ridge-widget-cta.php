<?php
class Elementor_The_Ridge_Widget_Cta extends \Elementor\Widget_Base {

	public function get_name() {
		return 'the_ridge_featured_cta';
	}

	public function get_title() {
		return esc_html__( 'The Ridge Featured CTA', 'the-ridge-core' );
	}

	public function get_icon() {
		return 'eicon-dual-button';
	}

	public function get_categories() {
		return [ 'the-ridge-category' ];
	}

	public function get_keywords() {
		return [ 'the ridge', 'featured cta' ];
	}

	protected function register_controls() {

		// Content Tab Start

		$this->start_controls_section(
			'section_featured_image_2',
			[
				'label' => esc_html__( 'Featured CTA', 'the-ridge-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'the-ridge-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Join our family', 'the-ridge-core' ),
			]
		);


		$this->add_control(
			'description',
			[
				'label' => esc_html__( 'Description', 'the-ridge-core' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Sign up now and embark on a journey of knowledge, inspiration, and exclusive benefits. Welcome to The Ridge family!' ),
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
		$cta_link = '';
		    if ( 'external' === $settings['cta_link_type'] && $settings['cta_link_external']['url'] ) {
		        $cta_link = $settings['cta_link_external']['url'] ? $settings['cta_link_external']['url'] : '#';
		    } elseif ( 'internal' === $settings['cta_link_type'] && $settings['cta_link_page'] ) {
		        $cta_link = get_permalink( $settings['cta_link_page'] );
		    }
		?>

		<!-- CTA Start -->
        <section class="p-5 pb-0 pt-0 mt-5 newsletter">
        <div class="container-fluid-fluid px-0 ">
            <div class="py-2 position-relative">
                <div class="container-fluid my-5">
                    <div class="row align-items-center">
                        <div class="col-lg-3 col-md-7">
                            <h5 class="display-6 h5 mb-0 text-white title-dark"><?php echo $settings['subtitle']; ?></h5>
                        </div><!--end col-->

                        <div class="col-lg-5 col-md-7">
                            <p class="display-8 mb-0 text-white title-dark"><?php echo $settings['description']; ?></p>
                        </div><!--end col-->

                        <div class="col-lg-4 col-md-5 text-md-center mt-4 mt-sm-0">
                            <?php if ( $settings['cta_text'] && $cta_link ) : ?>
						        <a class="btn btn-ridge-primary-reverse display-9 p-5 pt-2 pb-2 text-space-grotesk" href="<?php echo esc_url( $cta_link ); ?>">
						            <?php echo esc_html( $settings['cta_text'] ); ?>
						        </a>
						    <?php endif; ?>
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end container-fluid-->
            </div><!--end bg image-->
        </div><!--end container-fluid-->
        </section>
        <!-- CTA End -->
		<?php
	}
}