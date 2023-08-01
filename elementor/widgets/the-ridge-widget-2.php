<?php
class Elementor_The_Ridge_Widget_2 extends \Elementor\Widget_Base {

	public function get_name() {
		return 'the_ridge_story';
	}

	public function get_title() {
		return esc_html__( 'The Ridge Story', 'the-ridge-core' );
	}

	public function get_icon() {
		return 'eicon-site-title';
	}

	public function get_categories() {
		return [ 'the-ridge-category' ];
	}

	public function get_keywords() {
		return [ 'the ridge', 'story' ];
	}

	protected function register_controls() {

		// Content Tab Start

		$this->start_controls_section(
			'section_story',
			[
				'label' => esc_html__( 'Story', 'the-ridge-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'the-ridge-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Dolore Magna Aliqua', 'the-ridge-core' ),
			]
		);

		$this->add_control(
			'subtitle',
			[
				'label' => esc_html__( 'Sub Title', 'the-ridge-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'The Collection', 'the-ridge-core' ),
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


		<!-- Start -->
        <section class="p-5 mt-5">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="text-center mb-4 pb-2">
                            <h6 class="display-9 section-heading-text text-color-primary"><?php echo $settings['subtitle']; ?></h6>
                            <h4 class="display-5 mt-2 mb-3 text-color-secondary"><?php echo $settings['title']; ?></h4>
                            <p class="display-8 mx-auto mb-0 text-color-secondary"><?php echo $settings['description']; ?></p>
                            <div class="mt-4">
                                <?php if ( $settings['cta_text'] && $cta_link ) : ?>
							        <a class="btn btn-ridge-primary display-9" href="<?php echo esc_url( $cta_link ); ?>">
							            <?php echo esc_html( $settings['cta_text'] ); ?>
							        </a>
							    <?php endif; ?>
                            </div>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
            </div>
        </section>

		<?php
	}
}