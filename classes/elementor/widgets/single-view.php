<?php
namespace PDFEV\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class PDFEV_Single_Widget extends Widget_Base {

	public function get_name() {
		return 'pdfev-single-view';
	}

	public function get_title() {
		return __( 'PDF Single View', 'mage-eventpress' );
	}

	public function get_icon() {
		return 'eicon-single-post';
	}

	public function get_categories() {
		return [ 'pdfev-elementor-category' ];
	}

    protected function _register_controls() {

		$this->start_controls_section(
			'pdfev_viewer_settings',
			[
				'label' => __( 'Layout Settings', 'pdf-embed-viewer' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		// Template option
		$this->add_control(
			'post_id',
			[
				'label' => __( 'Select PDF Post', 'pdf-embed-viewer' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'options' => $this->get_pdf_post_options(), // Dynamic list
				'default' => '0',
				'multiple' => false, // Keep false for single post selection
			]
		);

		$this->end_controls_section();

	
	}

	private function get_pdf_post_options() {
		$options = [ '0' => __( 'Select a PDF', 'pdf-embed-viewer' ) ];

		$posts = get_posts([
			'post_type'      => 'pdfev_embed_viewer', // Replace with your custom post type slug
			'posts_per_page' => -1,
			'post_status'    => 'publish',
			'orderby'        => 'title',
			'order'          => 'ASC',
		]);

		foreach ( $posts as $post ) {
			$options[ $post->ID ] = $post->post_title;
		}

		return $options;
	}

   	protected function render() {
		$settings = $this->get_settings_for_display();

		// Build shortcode with selected post ID
		$post_id = intval( $settings['post_id'] );

		if ( $post_id > 0 ) {
			$shortcode = sprintf(
				'[pdfev_embed_viewer id="%d"]',
				$post_id
			);

			// Output rendered shortcode
			echo do_shortcode( $shortcode );
		} else {
			echo '<p>' . __( 'No PDF selected.', 'pdf-embed-viewer' ) . '</p>';
		}
	}

}