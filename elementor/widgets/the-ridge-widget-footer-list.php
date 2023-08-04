<?php
class Elementor_The_Ridge_Widget_Footer_List extends \Elementor\Widget_Base {

	public function get_name() {
		return 'the_ridge_featured_footer_list';
	}

	public function get_title() {
		return esc_html__( 'The Ridge Footer List', 'the-ridge-core' );
	}

	public function get_icon() {
		return 'eicon-dual-button';
	}

	public function get_categories() {
		return [ 'the-ridge-category' ];
	}

	public function get_keywords() {
		return [ 'the ridge', 'footer list' ];
	}

	protected function register_controls() {

		// Content Tab Start

		$this->start_controls_section(
			'section_featured_title',
			[
				'label' => esc_html__( 'Footer List', 'the-ridge-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'footer_title',
			[
				'label' => esc_html__( 'Footer Title', 'the-ridge-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Information' ),
			]
		);

		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'Footer List', 'the-ridge-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'field' => [
					[
						'name' => 'list_title',
						'label' => esc_html__( 'Title', 'textdomain' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => esc_html__( 'List Title' , 'textdomain' ),
						'label_block' => true,
					],
				],
				'default' => [
					[
						'list_title' => esc_html__( 'Title #1', 'textdomain' ),
					],
					[
						'list_title' => esc_html__( 'Title #2', 'textdomain' ),
					],
				],
				'title_field' => '{{{ list_title }}}',
			]
		);


		$this->end_controls_section();

		// Content Tab End

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( $settings['list'] ) {
			echo '<dl>';
			foreach (  $settings['list'] as $item ) {
				echo '<dt class="elementor-repeater-item-' . esc_attr( $item['_id'] ) . '">' . $item['list_title'] . '</dt>';
			}
			echo '</dl>';
		}
	}
}