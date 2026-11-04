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
 * Archive (list / grid / newsletter / ebook) widget.
 *
 * Content controls map 1:1 onto the [pdfev_viewer] shortcode attributes;
 * Style controls write scoped CSS through Elementor selectors, so every
 * instance can be styled independently of the global Brand Colors.
 * Control IDs from the original widget are kept so existing pages keep
 * their settings.
 */
class PDFEV_Grid_Widget extends Widget_Base {

	public function get_name() {
		return 'pdfev-archive-view';
	}

	public function get_title() {
		return __( 'PDF Archive View', 'pdf-embed-viewer' );
	}

	public function get_icon() {
		return 'eicon-archive-posts';
	}

	public function get_categories() {
		return [ 'pdfev-elementor-category' ];
	}

	public function get_keywords() {
		return [ 'pdf', 'flipbook', 'archive', 'grid', 'list', 'ebook', 'newsletter', 'library' ];
	}

	/**
	 * Shared selector prefixes for the four archive templates.
	 */
	private function items_selector() {
		return '{{WRAPPER}} .archive-grid-style > .pdfev-load-more-items, {{WRAPPER}} .archive-ebook-style > .pdfev-load-more-items';
	}

	private function card_selector() {
		return '{{WRAPPER}} .archive-grid-style .grid-item, {{WRAPPER}} .archive-ebook-style .grid-item, {{WRAPPER}} .archive-list-style .list-item';
	}

	private function title_selector() {
		return '{{WRAPPER}} .archive-grid-style .grid-item h2 a, {{WRAPPER}} .archive-ebook-style .grid-item h2, {{WRAPPER}} .archive-ebook-style .grid-item h2 a, {{WRAPPER}} .archive-list-style .list-content h2 a, {{WRAPPER}} .archive-newsletter-style td > a';
	}

	protected function register_controls() {
		$this->register_content_controls();
		$this->register_style_layout_controls();
		$this->register_style_card_controls();
		$this->register_style_text_controls();
		$this->register_style_image_controls();
		$this->register_style_button_controls();
		$this->register_style_load_more_controls();
	}

	/* ------------------------------------------------------------------ Content */

	private function register_content_controls() {
		$this->start_controls_section(
			'pdfev_viewer_settings',
			[
				'label' => __( 'Query & Layout', 'pdf-embed-viewer' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'template',
			[
				'label'   => __( 'Template', 'pdf-embed-viewer' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'ebook',
				'options' => [
					'ebook'      => __( 'Ebook', 'pdf-embed-viewer' ),
					'grid'       => __( 'Grid', 'pdf-embed-viewer' ),
					'list'       => __( 'List', 'pdf-embed-viewer' ),
					'newsletter' => __( 'Newsletter', 'pdf-embed-viewer' ),
				],
			]
		);

		$options    = [ '' => __( 'All categories', 'pdf-embed-viewer' ) ];
		$categories = get_terms( [ 'taxonomy' => 'pdfev_category', 'hide_empty' => false ] );
		if ( ! is_wp_error( $categories ) ) {
			foreach ( $categories as $category ) {
				$options[ $category->slug ] = $category->name;
			}
		}
		$this->add_control(
			'category',
			[
				'label'   => __( 'Category', 'pdf-embed-viewer' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => $options,
			]
		);

		$this->add_control(
			'order',
			[
				'label'   => __( 'Order', 'pdf-embed-viewer' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'dsc',
				'options' => [
					'asc' => __( 'ASC (Oldest First)', 'pdf-embed-viewer' ),
					'dsc' => __( 'DSC (Newest First)', 'pdf-embed-viewer' ),
				],
			]
		);

		$this->add_control(
			'limit',
			[
				'label'       => __( 'Items per page', 'pdf-embed-viewer' ),
				'description' => __( 'More items load with the "Load More" button.', 'pdf-embed-viewer' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => 10,
				'min'         => 1,
				'max'         => 100,
			]
		);

		$this->add_control(
			'rtl_layout',
			[
				'label'        => __( 'Right-to-left layout', 'pdf-embed-viewer' ),
				'description'  => __( 'Mirror the layout for Arabic, Urdu, Hebrew and other RTL libraries.', 'pdf-embed-viewer' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'pdfev_elements_section',
			[
				'label' => __( 'Card Elements', 'pdf-embed-viewer' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$switches = [
			'read'              => [ __( 'Read Button', 'pdf-embed-viewer' ), 'yes' ],
			'reading_count'     => [ __( 'Reading Count', 'pdf-embed-viewer' ), 'yes' ],
			'download'          => [ __( 'Download Button', 'pdf-embed-viewer' ), 'yes' ],
			'downloading_count' => [ __( 'Download Count', 'pdf-embed-viewer' ), 'yes' ],
			'description'       => [ __( 'Description', 'pdf-embed-viewer' ), '' ],
			'author'            => [ __( 'Author', 'pdf-embed-viewer' ), '' ],
			'publisher'         => [ __( 'Publisher', 'pdf-embed-viewer' ), '' ],
			'year'              => [ __( 'Published Year', 'pdf-embed-viewer' ), '' ],
			'edition'           => [ __( 'Edition', 'pdf-embed-viewer' ), '' ],
			'file_size'         => [ __( 'File Size', 'pdf-embed-viewer' ), '' ],
			'total_pages'       => [ __( 'Total Pages', 'pdf-embed-viewer' ), '' ],
		];
		foreach ( $switches as $id => $def ) {
			$this->add_control(
				$id,
				[
					'label'        => $def[0],
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => __( 'Show', 'pdf-embed-viewer' ),
					'label_off'    => __( 'Hide', 'pdf-embed-viewer' ),
					'return_value' => 'yes',
					'default'      => $def[1],
				]
			);
		}

		$this->end_controls_section();
	}

	/* ------------------------------------------------------------------ Style: layout */

	private function register_style_layout_controls() {
		$this->start_controls_section(
			'pdfev_style_layout',
			[
				'label' => __( 'Layout', 'pdf-embed-viewer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'columns',
			[
				'label'          => __( 'Columns', 'pdf-embed-viewer' ),
				'description'    => __( 'Grid and Ebook templates. Leave empty for automatic.', 'pdf-embed-viewer' ),
				'type'           => Controls_Manager::SELECT,
				'options'        => [ '' => __( 'Auto', 'pdf-embed-viewer' ), '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8' ],
				'default'        => '',
				'selectors'      => [
					$this->items_selector() => 'grid-template-columns: repeat({{VALUE}}, minmax(0, 1fr));',
				],
			]
		);

		$this->add_responsive_control(
			'column_gap',
			[
				'label'      => __( 'Column Gap', 'pdf-embed-viewer' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem' ],
				'range'      => [ 'px' => [ 'min' => 0, 'max' => 80 ] ],
				'selectors'  => [
					$this->items_selector() => 'column-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'row_gap',
			[
				'label'      => __( 'Row Gap', 'pdf-embed-viewer' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem' ],
				'range'      => [ 'px' => [ 'min' => 0, 'max' => 120 ] ],
				'selectors'  => [
					$this->items_selector() => 'row-gap: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .archive-list-style > .pdfev-load-more-items' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'max_width',
			[
				'label'      => __( 'Max Width', 'pdf-embed-viewer' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'vw' ],
				'range'      => [ 'px' => [ 'min' => 300, 'max' => 2000 ] ],
				'selectors'  => [
					'{{WRAPPER}} .pdfev-embed-viewer' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/* ------------------------------------------------------------------ Style: card */

	private function register_style_card_controls() {
		$this->start_controls_section(
			'pdfev_style_card',
			[
				'label'     => __( 'Card', 'pdf-embed-viewer' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [ 'template!' => 'newsletter' ],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'card_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => $this->card_selector(),
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'card_border',
				'selector' => $this->card_selector(),
			]
		);

		$this->add_responsive_control(
			'card_radius',
			[
				'label'      => __( 'Border Radius', 'pdf-embed-viewer' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					$this->card_selector() => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'card_shadow',
				'selector' => $this->card_selector(),
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'card_shadow_hover',
				'label'    => __( 'Hover Shadow', 'pdf-embed-viewer' ),
				'selector' => '{{WRAPPER}} .archive-grid-style .grid-item:hover, {{WRAPPER}} .archive-ebook-style .grid-item:hover, {{WRAPPER}} .archive-list-style .list-item:hover',
			]
		);

		$this->add_responsive_control(
			'card_padding',
			[
				'label'       => __( 'Inner Padding', 'pdf-embed-viewer' ),
				'description' => __( 'Grid: text, tags, image and buttons. List: the whole card.', 'pdf-embed-viewer' ),
				'type'        => Controls_Manager::DIMENSIONS,
				'size_units'  => [ 'px', 'em' ],
				'selectors'   => [
					'{{WRAPPER}} .archive-grid-style .pdfev-card-head' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .archive-grid-style .pdfev-card-tags' => 'padding-left: {{LEFT}}{{UNIT}}; padding-right: {{RIGHT}}{{UNIT}};',
					'{{WRAPPER}} .archive-grid-style .grid-item .image' => 'margin-left: {{LEFT}}{{UNIT}}; margin-right: {{RIGHT}}{{UNIT}};',
					'{{WRAPPER}} .archive-grid-style .grid-item .action' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .archive-list-style .list-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'card_hover_lift',
			[
				'label'        => __( 'Lift on Hover', 'pdf-embed-viewer' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
				'prefix_class'       => 'pdfev-lift-',
				'classes_dictionary' => [ '' => 'off' ],
			]
		);

		$this->end_controls_section();
	}

	/* ------------------------------------------------------------------ Style: text */

	private function register_style_text_controls() {
		$this->start_controls_section(
			'pdfev_style_text',
			[
				'label' => __( 'Typography & Colors', 'pdf-embed-viewer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		// Kicker (grid "01 — Category" line).
		$this->add_control(
			'kicker_heading',
			[
				'label'     => __( 'Label (Grid)', 'pdf-embed-viewer' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => [ 'template' => 'grid' ],
			]
		);
		$this->add_control(
			'kicker_color',
			[
				'label'     => __( 'Color', 'pdf-embed-viewer' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [ 'template' => 'grid' ],
				'selectors' => [ '{{WRAPPER}} .pdfev-card-kicker' => 'color: {{VALUE}};' ],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'kicker_typography',
				'condition' => [ 'template' => 'grid' ],
				'selector'  => '{{WRAPPER}} .pdfev-card-kicker',
			]
		);

		// Title.
		$this->add_control(
			'title_heading',
			[
				'label'     => __( 'Title', 'pdf-embed-viewer' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Color', 'pdf-embed-viewer' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ $this->title_selector() => 'color: {{VALUE}};' ],
			]
		);
		$this->add_control(
			'title_hover_color',
			[
				'label'     => __( 'Hover Color', 'pdf-embed-viewer' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .archive-grid-style .grid-item h2 a:hover, {{WRAPPER}} .archive-ebook-style .grid-item h2 a:hover, {{WRAPPER}} .archive-list-style .list-content h2 a:hover, {{WRAPPER}} .archive-newsletter-style td > a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => $this->title_selector(),
			]
		);
		$this->add_responsive_control(
			'title_align',
			[
				'label'     => __( 'Alignment', 'pdf-embed-viewer' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [ 'title' => __( 'Left', 'pdf-embed-viewer' ), 'icon' => 'eicon-text-align-left' ],
					'center' => [ 'title' => __( 'Center', 'pdf-embed-viewer' ), 'icon' => 'eicon-text-align-center' ],
					'right'  => [ 'title' => __( 'Right', 'pdf-embed-viewer' ), 'icon' => 'eicon-text-align-right' ],
				],
				'selectors' => [
					'{{WRAPPER}} .archive-grid-style .grid-item h2, {{WRAPPER}} .archive-ebook-style .grid-item .content, {{WRAPPER}} .archive-list-style .list-content' => 'text-align: {{VALUE}};',
				],
			]
		);

		// Description.
		$this->add_control(
			'desc_heading',
			[
				'label'     => __( 'Description', 'pdf-embed-viewer' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'desc_color',
			[
				'label'     => __( 'Color', 'pdf-embed-viewer' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ '{{WRAPPER}} .pdfev-archive-description, {{WRAPPER}} .pdfev-archive-description p, {{WRAPPER}} .list-description' => 'color: {{VALUE}};' ],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'desc_typography',
				'selector' => '{{WRAPPER}} .pdfev-archive-description, {{WRAPPER}} .pdfev-archive-description p, {{WRAPPER}} .list-description',
			]
		);
		$this->add_control(
			'desc_lines',
			[
				'label'     => __( 'Max Lines (Grid)', 'pdf-embed-viewer' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 12,
				'condition' => [ 'template' => 'grid' ],
				'selectors' => [ '{{WRAPPER}} .archive-grid-style .grid-item .pdfev-archive-description' => '-webkit-line-clamp: {{VALUE}};' ],
			]
		);

		// Meta.
		$this->add_control(
			'meta_heading',
			[
				'label'     => __( 'Meta (author, pages, year…)', 'pdf-embed-viewer' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'meta_color',
			[
				'label'     => __( 'Color', 'pdf-embed-viewer' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ '{{WRAPPER}} .pdfev-archive-meta, {{WRAPPER}} .pdfev-archive-meta li' => 'color: {{VALUE}};' ],
			]
		);
		$this->add_control(
			'meta_divider_color',
			[
				'label'     => __( 'Divider Color (Grid)', 'pdf-embed-viewer' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [ 'template' => 'grid' ],
				'selectors' => [ '{{WRAPPER}} .archive-grid-style .pdfev-archive-meta-tags' => 'border-top-color: {{VALUE}};' ],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'meta_typography',
				'selector' => '{{WRAPPER}} .pdfev-archive-meta',
			]
		);

		$this->end_controls_section();
	}

	/* ------------------------------------------------------------------ Style: image */

	private function register_style_image_controls() {
		$this->start_controls_section(
			'pdfev_style_image',
			[
				'label'     => __( 'Cover Image', 'pdf-embed-viewer' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [ 'template!' => 'newsletter' ],
			]
		);

		$this->add_responsive_control(
			'image_height',
			[
				'label'      => __( 'Image Area Height (Grid)', 'pdf-embed-viewer' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'vh' ],
				'range'      => [ 'px' => [ 'min' => 120, 'max' => 700 ] ],
				'condition'  => [ 'template' => 'grid' ],
				'selectors'  => [ '{{WRAPPER}} .archive-grid-style .grid-item .image' => 'height: {{SIZE}}{{UNIT}};' ],
			]
		);

		$this->add_responsive_control(
			'cover_width',
			[
				'label'      => __( 'Cover Width (Grid)', 'pdf-embed-viewer' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range'      => [ '%' => [ 'min' => 20, 'max' => 100 ], 'px' => [ 'min' => 60, 'max' => 400 ] ],
				'condition'  => [ 'template' => 'grid' ],
				'selectors'  => [ '{{WRAPPER}} .archive-grid-style .pdfev-card-cover' => 'width: {{SIZE}}{{UNIT}}; max-width: none;' ],
			]
		);

		$this->add_control(
			'image_effect',
			[
				'label'        => __( 'Dither Effect (Grid)', 'pdf-embed-viewer' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'pdf-embed-viewer' ),
				'label_off'    => __( 'Off', 'pdf-embed-viewer' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [ 'template' => 'grid' ],
				'prefix_class'       => 'pdfev-dither-',
				'classes_dictionary' => [ '' => 'off' ],
			]
		);

		$this->add_control(
			'image_area_bg',
			[
				'label'     => __( 'Image Area Background', 'pdf-embed-viewer' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [ 'template' => 'grid' ],
				'selectors' => [ '{{WRAPPER}} .archive-grid-style .grid-item .image' => 'background-color: {{VALUE}};' ],
			]
		);

		$this->add_responsive_control(
			'image_radius',
			[
				'label'      => __( 'Border Radius', 'pdf-embed-viewer' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .archive-grid-style .grid-item .image, {{WRAPPER}} .archive-list-style .list-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'list_image_width',
			[
				'label'      => __( 'Image Width (List)', 'pdf-embed-viewer' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [ 'px' => [ 'min' => 60, 'max' => 400 ] ],
				'condition'  => [ 'template' => 'list' ],
				'selectors'  => [ '{{WRAPPER}} .archive-list-style .list-image' => 'width: {{SIZE}}{{UNIT}}; min-width: {{SIZE}}{{UNIT}};' ],
			]
		);

		$this->end_controls_section();
	}

	/* ------------------------------------------------------------------ Style: buttons */

	private function register_button_style( $key, $label, $selector ) {
		$this->add_control(
			$key . '_heading',
			[
				'label'     => $label,
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->start_controls_tabs( $key . '_tabs' );

		$this->start_controls_tab( $key . '_normal', [ 'label' => __( 'Normal', 'pdf-embed-viewer' ) ] );
		$this->add_control(
			$key . '_color',
			[
				'label'     => __( 'Text Color', 'pdf-embed-viewer' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ $selector => 'color: {{VALUE}};' ],
			]
		);
		$this->add_control(
			$key . '_bg',
			[
				'label'     => __( 'Background', 'pdf-embed-viewer' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ $selector => 'background-color: {{VALUE}};' ],
			]
		);
		$this->add_control(
			$key . '_border_color',
			[
				'label'     => __( 'Border Color', 'pdf-embed-viewer' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ $selector => 'border-color: {{VALUE}};' ],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab( $key . '_hover', [ 'label' => __( 'Hover', 'pdf-embed-viewer' ) ] );
		$hover = implode( ', ', array_map( function ( $s ) { return trim( $s ) . ':hover'; }, explode( ',', $selector ) ) );
		$this->add_control(
			$key . '_color_hover',
			[
				'label'     => __( 'Text Color', 'pdf-embed-viewer' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ $hover => 'color: {{VALUE}};' ],
			]
		);
		$this->add_control(
			$key . '_bg_hover',
			[
				'label'     => __( 'Background', 'pdf-embed-viewer' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ $hover => 'background-color: {{VALUE}}; filter: none;' ],
			]
		);
		$this->add_control(
			$key . '_border_color_hover',
			[
				'label'     => __( 'Border Color', 'pdf-embed-viewer' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ $hover => 'border-color: {{VALUE}};' ],
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();
	}

	private function register_style_button_controls() {
		$this->start_controls_section(
			'pdfev_style_buttons',
			[
				'label' => __( 'Read & Download Buttons', 'pdf-embed-viewer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$both = '{{WRAPPER}} .read-btn, {{WRAPPER}} .download-btn';

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_typography',
				'selector' => $both,
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label'      => __( 'Padding', 'pdf-embed-viewer' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [ $both => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
			]
		);

		$this->add_responsive_control(
			'button_radius',
			[
				'label'      => __( 'Border Radius', 'pdf-embed-viewer' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [ $both => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
			]
		);

		$this->add_control(
			'button_width',
			[
				'label'     => __( 'Width', 'pdf-embed-viewer' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''     => __( 'Default', 'pdf-embed-viewer' ),
					'fill' => __( 'Equal, fill the card', 'pdf-embed-viewer' ),
					'auto' => __( 'Fit content', 'pdf-embed-viewer' ),
				],
				'selectors_dictionary' => [ 'fill' => 'flex: 1 1 0;', 'auto' => 'flex: 0 0 auto;' ],
				'selectors' => [ '{{WRAPPER}} .action .btn, {{WRAPPER}} .list-actions .btn' => '{{VALUE}}' ],
			]
		);

		$this->register_button_style( 'read_btn', __( 'Read Button', 'pdf-embed-viewer' ), '{{WRAPPER}} .read-btn' );
		$this->register_button_style( 'download_btn', __( 'Download Button', 'pdf-embed-viewer' ), '{{WRAPPER}} .download-btn' );

		$this->add_control(
			'count_heading',
			[
				'label'     => __( 'Count Badge', 'pdf-embed-viewer' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'count_color',
			[
				'label'     => __( 'Text Color', 'pdf-embed-viewer' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ '{{WRAPPER}} .pdfev-count' => 'color: {{VALUE}};' ],
			]
		);
		$this->add_control(
			'count_bg',
			[
				'label'     => __( 'Background', 'pdf-embed-viewer' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ '{{WRAPPER}} .pdfev-count' => 'background-color: {{VALUE}};' ],
			]
		);

		$this->end_controls_section();
	}

	/* ------------------------------------------------------------------ Style: load more */

	private function register_style_load_more_controls() {
		$this->start_controls_section(
			'pdfev_style_load_more',
			[
				'label' => __( 'Load More Button', 'pdf-embed-viewer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$sel = '{{WRAPPER}} .pdfev-load-more-button';

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'load_more_typography',
				'selector' => $sel,
			]
		);
		$this->add_responsive_control(
			'load_more_align',
			[
				'label'     => __( 'Alignment', 'pdf-embed-viewer' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'flex-start' => [ 'title' => __( 'Start', 'pdf-embed-viewer' ), 'icon' => 'eicon-h-align-left' ],
					'center'     => [ 'title' => __( 'Center', 'pdf-embed-viewer' ), 'icon' => 'eicon-h-align-center' ],
					'flex-end'   => [ 'title' => __( 'End', 'pdf-embed-viewer' ), 'icon' => 'eicon-h-align-right' ],
				],
				'selectors' => [ '{{WRAPPER}} .pdfev-load-more-wrap' => 'justify-content: {{VALUE}};' ],
			]
		);
		$this->add_responsive_control(
			'load_more_radius',
			[
				'label'      => __( 'Border Radius', 'pdf-embed-viewer' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [ $sel => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
			]
		);
		$this->register_button_style( 'load_more', __( 'Colors', 'pdf-embed-viewer' ), $sel );

		$this->end_controls_section();
	}

	/* ------------------------------------------------------------------ Render */

	protected function render() {
		$settings = $this->get_settings_for_display();

		// A switched-off SWITCHER returns '', which the shortcode would read
		// as "not set" and fall back to the global option — send an explicit
		// "no" instead so the widget's own toggles always win.
		$yn = function ( $key ) use ( $settings ) {
			return ( isset( $settings[ $key ] ) && 'yes' === $settings[ $key ] ) ? 'yes' : 'no';
		};

		$shortcode = sprintf(
			'[pdfev_viewer template="%s" category="%s" limit="%d" order="%s" read="%s" download="%s" reading_count="%s" downloading_count="%s" show_description="%s" show_author="%s" show_publisher="%s" show_year="%s" show_edition="%s" show_filesize="%s" show_total_pages="%s"]',
			esc_attr( $settings['template'] ),
			esc_attr( $settings['category'] ?? '' ),
			max( 1, intval( $settings['limit'] ) ),
			esc_attr( $settings['order'] ),
			$yn( 'read' ),
			$yn( 'download' ),
			$yn( 'reading_count' ),
			$yn( 'downloading_count' ),
			$yn( 'description' ),
			$yn( 'author' ),
			$yn( 'publisher' ),
			$yn( 'year' ),
			$yn( 'edition' ),
			$yn( 'file_size' ),
			$yn( 'total_pages' )
		);

		$rtl = ( $settings['rtl_layout'] ?? '' ) === 'yes';
		echo $rtl ? '<div dir="rtl">' : '';
		echo do_shortcode( $shortcode );
		echo $rtl ? '</div>' : '';
	}
}
