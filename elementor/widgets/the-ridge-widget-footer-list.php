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

		$repeater->add_control(
			'list_color',
			[
				'label' => esc_html__( 'Color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}'
				],
			]
		);

		$repeater->add_control(
			'list_link_external',
	        [
	            'label' => __( 'List Link', 'the-ridge-core' ),
	            'type' => \Elementor\Controls_Manager::URL,
	            'placeholder' => __( 'https://your-external-link.com', 'the-ridge-core' ),
	            'show_external' => true,
	            'default' => [
	                'url' => '',
	                'is_external' => true,
	                'nofollow' => true,
	            ],
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
						'list_title' => esc_html__( 'Title #1', 'textdomain' ),
						'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'textdomain' ),
						'list_link_external'=> esc_html__( 'Item content. Click the edit button to change this text.', 'textdomain' ),
					],
					[
						'list_title' => esc_html__( 'Title #2', 'textdomain' ),
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
		$cta_link = $settings['list_link_external']['url'] ? $settings['list_link_external']['url'] : '#';

		if ( $settings['list'] ) {
			echo '<dl>';
			foreach (  $settings['list'] as $item ) {
				echo '<dt class="elementor-repeater-item-' . esc_attr( $item['_id'] ) . '">' . $item['list_title'] . '</dt>';
				echo '<dd>' . $item['list_content'] . '</dd>';
				echo '<dd>' . esc_url( $cta_link ) . '</dd>';
			}
			echo '</dl>';
		}
	}

	protected function content_template() {
		?>
		<# if ( settings.list.length ) { #>
			<dl>
			<# _.each( settings.list, function( item ) { #>
				<dt class="elementor-repeater-item-{{ item._id }}">{{{ item.list_title }}}</dt>
				<dd>{{{ item.list_content }}}</dd>
				<dd>{{{ item.list_link_external }}}</dd>
			<# }); #>
			</dl>
		<# } #>
		<?php
	}
}