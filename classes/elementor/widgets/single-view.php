<?php
namespace PDFEV\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Single flipbook widget.
 *
 * "Current post" makes it usable inside an Elementor Pro Theme Builder
 * Single template for the PDF post type: the template is designed once and
 * every PDF post renders its own book in it.
 */
class PDFEV_Single_Widget extends Widget_Base {

	public function get_name() {
		return 'pdfev-single-view';
	}

	public function get_title() {
		return __( 'PDF Single View', 'pdf-embed-viewer' );
	}

	public function get_icon() {
		return 'eicon-single-post';
	}

	public function get_categories() {
		return [ 'pdfev-elementor-category' ];
	}

	public function get_keywords() {
		return [ 'pdf', 'flipbook', 'book', 'single', 'viewer', 'reader' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'pdfev_viewer_settings',
			[
				'label' => __( 'PDF', 'pdf-embed-viewer' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'source',
			[
				'label'       => __( 'Source', 'pdf-embed-viewer' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'select',
				'options'     => [
					'current' => __( 'Current post (for Theme Builder single templates)', 'pdf-embed-viewer' ),
					'select'  => __( 'Choose a PDF', 'pdf-embed-viewer' ),
				],
				'label_block' => true,
			]
		);

		$this->add_control(
			'post_id',
			[
				'label'       => __( 'Select PDF Post', 'pdf-embed-viewer' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'options'     => $this->get_pdf_post_options(),
				'default'     => '0',
				'multiple'    => false,
				'condition'   => [ 'source' => 'select' ],
			]
		);

		$this->add_control(
			'show_author',
			[
				'label'        => __( 'Show Author', 'pdf-embed-viewer' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => '',
			]
		);
		$this->add_control(
			'show_year',
			[
				'label'        => __( 'Show Year', 'pdf-embed-viewer' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => '',
			]
		);
		$this->add_control(
			'show_download',
			[
				'label'       => __( 'Download Button', 'pdf-embed-viewer' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '',
				'options'     => [
					''    => __( 'Use the PDF\'s own setting', 'pdf-embed-viewer' ),
					'yes' => __( 'Show', 'pdf-embed-viewer' ),
					'no'  => __( 'Hide', 'pdf-embed-viewer' ),
				],
			]
		);

		$this->end_controls_section();

		/* -------- Style: container */
		$this->start_controls_section(
			'pdfev_style_container',
			[
				'label' => __( 'Viewer Container', 'pdf-embed-viewer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'max_width',
			[
				'label'      => __( 'Max Width', 'pdf-embed-viewer' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'vw' ],
				'range'      => [ 'px' => [ 'min' => 300, 'max' => 2000 ] ],
				'selectors'  => [ '{{WRAPPER}} .pdfev-embed-viewer-shortcode, {{WRAPPER}} .pdfev-embed-viewer' => 'max-width: {{SIZE}}{{UNIT}}; margin-left: auto; margin-right: auto;' ],
			]
		);

		$this->add_responsive_control(
			'book_height',
			[
				'label'       => __( 'Book Area Height', 'pdf-embed-viewer' ),
				'description' => __( 'As a share of the width (%) or a fixed height.', 'pdf-embed-viewer' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ '%', 'px', 'vh' ],
				'range'       => [ '%' => [ 'min' => 30, 'max' => 150 ], 'px' => [ 'min' => 200, 'max' => 1400 ], 'vh' => [ 'min' => 20, 'max' => 100 ] ],
				'selectors'   => [ '{{WRAPPER}} .pdfev-3dbook-container' => 'padding-top: {{SIZE}}{{UNIT}} !important;' ],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'container_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .pdfev-3dbook-container',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'container_border',
				'selector' => '{{WRAPPER}} .pdfev-3dbook-container',
			]
		);

		$this->add_responsive_control(
			'container_radius',
			[
				'label'      => __( 'Border Radius', 'pdf-embed-viewer' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [ '{{WRAPPER}} .pdfev-3dbook-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;' ],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'container_shadow',
				'selector' => '{{WRAPPER}} .pdfev-3dbook-container',
			]
		);

		$this->end_controls_section();

		/* -------- Style: buttons (Flipbook / Traditional toggles + Download) */
		$this->start_controls_section(
			'pdfev_style_buttons',
			[
				'label' => __( 'Buttons', 'pdf-embed-viewer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$buttons = '{{WRAPPER}} .toggle-button a, {{WRAPPER}} .download-btn';

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_typography',
				'selector' => $buttons,
			]
		);
		$this->add_responsive_control(
			'button_radius',
			[
				'label'      => __( 'Border Radius', 'pdf-embed-viewer' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [ $buttons => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
			]
		);
		$this->add_control(
			'toggle_color',
			[
				'label'     => __( 'View Toggle Color', 'pdf-embed-viewer' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .toggle-button a' => 'color: {{VALUE}}; border-color: {{VALUE}};',
					'{{WRAPPER}} .toggle-button a.active' => 'background-color: {{VALUE}}; color: #fff;',
				],
			]
		);
		$this->add_control(
			'download_color',
			[
				'label'     => __( 'Download Text Color', 'pdf-embed-viewer' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ '{{WRAPPER}} .download-btn' => 'color: {{VALUE}};' ],
			]
		);
		$this->add_control(
			'download_bg',
			[
				'label'     => __( 'Download Background', 'pdf-embed-viewer' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ '{{WRAPPER}} .download-btn' => 'background-color: {{VALUE}};' ],
			]
		);
		$this->add_control(
			'download_border',
			[
				'label'     => __( 'Download Border', 'pdf-embed-viewer' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ '{{WRAPPER}} .download-btn' => 'border-color: {{VALUE}};' ],
			]
		);
		$this->add_responsive_control(
			'buttons_align',
			[
				'label'     => __( 'Alignment', 'pdf-embed-viewer' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'flex-start' => [ 'title' => __( 'Start', 'pdf-embed-viewer' ), 'icon' => 'eicon-h-align-left' ],
					'center'     => [ 'title' => __( 'Center', 'pdf-embed-viewer' ), 'icon' => 'eicon-h-align-center' ],
					'flex-end'   => [ 'title' => __( 'End', 'pdf-embed-viewer' ), 'icon' => 'eicon-h-align-right' ],
				],
				'selectors' => [ '{{WRAPPER}} .pdfev-viewer-toolbar, {{WRAPPER}} .toggle-button' => 'justify-content: {{VALUE}};' ],
			]
		);

		$this->end_controls_section();
	}

	private function get_pdf_post_options() {
		$options = [ '0' => __( 'Select a PDF', 'pdf-embed-viewer' ) ];

		$posts = get_posts( [
			'post_type'      => 'pdfev_embed_viewer',
			'posts_per_page' => -1,
			'post_status'    => 'publish',
			'orderby'        => 'title',
			'order'          => 'ASC',
		] );

		foreach ( $posts as $post ) {
			$options[ $post->ID ] = $post->post_title;
		}

		return $options;
	}

	/**
	 * In the editor/preview of a Theme Builder template there is no real
	 * "current" PDF post, so fall back to the newest one to show a preview.
	 */
	private function resolve_post_id( $settings ) {
		if ( ( $settings['source'] ?? 'select' ) !== 'current' ) {
			return intval( $settings['post_id'] ?? 0 );
		}
		$id = get_the_ID();
		if ( $id && get_post_type( $id ) === 'pdfev_embed_viewer' ) {
			return $id;
		}
		$latest = get_posts( [ 'post_type' => 'pdfev_embed_viewer', 'posts_per_page' => 1, 'fields' => 'ids' ] );
		return $latest ? (int) $latest[0] : 0;
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$post_id  = $this->resolve_post_id( $settings );

		if ( $post_id <= 0 ) {
			echo '<p>' . esc_html__( 'No PDF selected.', 'pdf-embed-viewer' ) . '</p>';
			return;
		}

		$atts = sprintf(
			' id="%d" show_author="%s" show_year="%s"',
			$post_id,
			( $settings['show_author'] ?? '' ) === 'yes' ? 'yes' : 'no',
			( $settings['show_year'] ?? '' ) === 'yes' ? 'yes' : 'no'
		);
		if ( ! empty( $settings['show_download'] ) ) {
			$atts .= sprintf( ' show_download="%s"', $settings['show_download'] === 'yes' ? 'yes' : 'no' );
		}

		echo do_shortcode( '[pdfev_embed_viewer' . $atts . ']' );
	}
}
