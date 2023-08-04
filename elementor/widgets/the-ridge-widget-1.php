<?php
class Elementor_The_Ridge_Widget_1 extends \Elementor\Widget_Base {

	public function get_name() {
		return 'the_ridge_hero';
	}

	public function get_title() {
		return esc_html__( 'The Ridge Hero', 'the-ridge-core' );
	}

	public function get_icon() {
		return 'eicon-image-hotspot';
	}

	public function get_categories() {
		return [ 'the-ridge-category' ];
	}

	public function get_keywords() {
		return [ 'the ridge', 'hero' ];
	}

	protected function register_controls() {

		// Content Tab Start

		$this->start_controls_section(
			'section_hero_image',
			[
				'label' => esc_html__( 'Hero Section', 'the-ridge-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
            'hero_image',
            [
                'label' => __( 'Hero Image', 'the-ridge-core' ),
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
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Overlooking a Tropical Forest Above The Ayung River', 'the-ridge-core' ),
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

		<!-- Hero Start -->
        <section class="bg-half-170 bg-light pb-0 d-table w-100 bg-hero-ridge" style="background: url('<?php echo esc_url( $settings['hero_image']['url'], 'thumbnail' ); ?>');">
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

		<?php
	}
}