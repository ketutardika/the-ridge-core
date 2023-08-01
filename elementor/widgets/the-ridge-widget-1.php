<?php
class Elementor_The_Ridge_Widget_1 extends \Elementor\Widget_Base {

	public function get_name() {
		return 'the_ridge_hero';
	}

	public function get_title() {
		return esc_html__( 'The Ridge Hero', 'elementor-addon' );
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

	protected function render() {
		?>

		<p> Hero Section </p>

		<?php
	}
}