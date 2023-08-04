<?php
class Elementor_The_Ridge_Widget_Footer_Text extends \Elementor\Widget_Base {

	public function get_name() {
		return 'the_ridge_featured_footer_text';
	}

	public function get_title() {
		return esc_html__( 'The Ridge Footer List Type 1', 'the-ridge-core' );
	}

	public function get_icon() {
		return 'eicon-footer';
	}

	public function get_categories() {
		return [ 'the-ridge-category' ];
	}

	public function get_keywords() {
		return [ 'the ridge', 'footer text' ];
	}

	protected function register_controls() {

		// Content Tab Start

		$this->start_controls_section(
			'section_footer_text',
			[
				'label' => esc_html__( 'Footer List Type 1', 'the-ridge-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'list_title',
			[
				'label' => esc_html__( 'Title', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'List Title' , 'textdomain' ),
				'label_block' => true,
			]
		);


		$repeater->add_control(
			'list_content',
			[
				'label' => esc_html__( 'Content', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'List Content' , 'textdomain' ),
				'show_label' => false,
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Menu Title', 'the-ridge-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Contact Us', 'the-ridge-core' ),
			]
		);

		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'Repeater List', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_title' => esc_html__( 'About The Ridge', 'textdomain' ),
						'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'textdomain' ),
					],
					[
						'list_title' => esc_html__( 'Explore The Villas', 'textdomain' ),
						'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'textdomain' ),
					],
				],
				'title_field' => '{{{ list_title }}}',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		if ( ! empty( $settings['website_link']['url'] ) ) {
			$this->add_link_attributes( 'website_link', $settings['website_link'] );
		}

		?>


		<!-- Grid column -->
        <div class="col-md-12">
          <h6 class="display-9 text-uppercase fw-medium mb-4 text-space-grotesk text-color-secondary">
            <?php echo $settings['title']; ?>
          </h6>
          
          	<?php
          	if ( $settings['list'] ) {
	          	foreach (  $settings['list'] as $item ) {
	          	?>
	          	<p class="display-8 text-color-primary">
	          		<?php echo $item['list_content']; ?>
	          	</p>
	          	<?php
          		}
          	}
          	?>
        </div>
        <!-- Grid column -->
     <?php
	}
}