<?php
class Elementor_The_Ridge_Widget_Footer_List extends \Elementor\Widget_Base {

	public function get_name() {
		return 'the_ridge_featured_footer_list';
	}

	public function get_title() {
		return esc_html__( 'The Ridge Footer List Type 2', 'the-ridge-core' );
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
				'label' => esc_html__( 'Footer List Type 2', 'the-ridge-core' ),
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
			'website_link',
	        [
	            'label' => esc_html__( 'Link', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
	        ]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Menu Title', 'the-ridge-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Information', 'the-ridge-core' ),
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
						'website_link' => esc_url__( 'http://staging.theridgebali.com/', 'textdomain' ),
					],
					[
						'list_title' => esc_html__( 'Explore The Villas', 'textdomain' ),
						'website_link' => esc_url__( 'http://staging.theridgebali.com/', 'textdomain' ),
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
          <p class="display-8 text-color-primary">
          	<?php
          	if ( $settings['list'] ) {
	          	foreach (  $settings['list'] as $item ) {
	          	?>
	            <a href="<?php echo esc_url($item['website_link']['url']); ?>" class="text-reset elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>"><?php echo $item['list_title'] ?> </a><br/>
	          	<?php
          		}
          	}
          	?>
          </p>
        </div>
        <!-- Grid column -->
     <?php
	}

	protected function content_template() {
		?>
		<!-- Grid column -->
        <div class="col-md-12">
          <h6 class="display-9 text-uppercase fw-medium mb-4 text-space-grotesk text-color-secondary">
            {{{ settings.title }}}
          </h6>
          <p class="display-8 text-color-primary">
		<# if ( settings.list.length ) { #>
			<dl>
			<# _.each( settings.list, function( item ) { #>
				<a href="{{{ item.website_link.url }}}" class="text-reset elementor-repeater-item-{{ item._id }}">{{{ item.list_content }}}</a><br/>
			<# }); #>
			</dl>
		<# } #>
		</p>
        </div>
        <!-- Grid column -->
     <?php
	}
}