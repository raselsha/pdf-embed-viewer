<?php
namespace PDFEV\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Css_Filter;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Building blocks for a custom single PDF page in Elementor: title, cover,
 * meta, description, download button and navigation. Each one reads the
 * current PDF post (or a chosen one), so a single Elementor template —
 * Theme Builder (Pro) or the template picked in Settings → General (free) —
 * works for every PDF.
 */
abstract class PDFEV_Part_Widget extends Widget_Base {

	public function get_categories() {
		return [ 'pdfev-elementor-category' ];
	}

	public function get_keywords() {
		return [ 'pdf', 'flipbook', 'book', 'single' ];
	}

	protected function register_source_controls() {
		$this->add_control(
			'source',
			[
				'label'   => __( 'PDF', 'pdf-embed-viewer' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'current',
				'options' => [
					'current' => __( 'Current PDF post', 'pdf-embed-viewer' ),
					'select'  => __( 'Choose a PDF', 'pdf-embed-viewer' ),
				],
			]
		);

		$options = [ '0' => __( 'Select a PDF', 'pdf-embed-viewer' ) ];
		foreach ( get_posts( [ 'post_type' => 'pdfev_embed_viewer', 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC' ] ) as $post ) {
			$options[ $post->ID ] = $post->post_title;
		}
		$this->add_control(
			'post_id',
			[
				'label'       => __( 'Select PDF Post', 'pdf-embed-viewer' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'options'     => $options,
				'default'     => '0',
				'condition'   => [ 'source' => 'select' ],
			]
		);
	}

	/**
	 * Current PDF post, the chosen one, or — while editing a template, where
	 * there is no current PDF — the newest PDF as a preview.
	 */
	protected function pdf_id() {
		$settings = $this->get_settings_for_display();
		if ( ( $settings['source'] ?? 'current' ) === 'select' ) {
			return absint( $settings['post_id'] ?? 0 );
		}
		$id = get_the_ID();
		if ( $id && get_post_type( $id ) === 'pdfev_embed_viewer' ) {
			return $id;
		}
		$latest = get_posts( [ 'post_type' => 'pdfev_embed_viewer', 'posts_per_page' => 1, 'fields' => 'ids' ] );
		return $latest ? (int) $latest[0] : 0;
	}

	protected function add_text_style( $key, $label, $selector, $with_align = true ) {
		$this->add_control(
			$key . '_color',
			[
				'label'     => __( 'Color', 'pdf-embed-viewer' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ $selector => 'color: {{VALUE}};' ],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => $key . '_typography',
				'label'    => $label,
				'selector' => $selector,
			]
		);
		if ( $with_align ) {
			$this->add_responsive_control(
				$key . '_align',
				[
					'label'     => __( 'Alignment', 'pdf-embed-viewer' ),
					'type'      => Controls_Manager::CHOOSE,
					'options'   => [
						'left'    => [ 'title' => __( 'Left', 'pdf-embed-viewer' ), 'icon' => 'eicon-text-align-left' ],
						'center'  => [ 'title' => __( 'Center', 'pdf-embed-viewer' ), 'icon' => 'eicon-text-align-center' ],
						'right'   => [ 'title' => __( 'Right', 'pdf-embed-viewer' ), 'icon' => 'eicon-text-align-right' ],
						'justify' => [ 'title' => __( 'Justified', 'pdf-embed-viewer' ), 'icon' => 'eicon-text-align-justify' ],
					],
					'selectors' => [ '{{WRAPPER}} .elementor-widget-container' => 'text-align: {{VALUE}};' ],
				]
			);
		}
	}

	protected function lang_attr( $id ) {
		return method_exists( '\PDFEV_Functions', 'item_lang_attrs' ) ? \PDFEV_Functions::item_lang_attrs( $id ) : '';
	}

	protected function empty_notice() {
		echo '<p class="pdfev-empty">' . esc_html__( 'No PDF found.', 'pdf-embed-viewer' ) . '</p>';
	}
}

/* ====================================================================== Title */

class PDFEV_Title_Widget extends PDFEV_Part_Widget {
	public function get_name() { return 'pdfev-title'; }
	public function get_title() { return __( 'PDF Title', 'pdf-embed-viewer' ); }
	public function get_icon() { return 'eicon-post-title'; }

	protected function register_controls() {
		$this->start_controls_section( 'content', [ 'label' => __( 'Title', 'pdf-embed-viewer' ) ] );
		$this->register_source_controls();
		$this->add_control(
			'tag',
			[
				'label'   => __( 'HTML Tag', 'pdf-embed-viewer' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h1',
				'options' => [ 'h1' => 'H1', 'h2' => 'H2', 'h3' => 'H3', 'h4' => 'H4', 'div' => 'div', 'p' => 'p' ],
			]
		);
		$this->add_control(
			'link',
			[
				'label'        => __( 'Link to the PDF page', 'pdf-embed-viewer' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => '',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section( 'style', [ 'label' => __( 'Title', 'pdf-embed-viewer' ), 'tab' => Controls_Manager::TAB_STYLE ] );
		$this->add_text_style( 'title', __( 'Typography', 'pdf-embed-viewer' ), '{{WRAPPER}} .pdfev-el-title, {{WRAPPER}} .pdfev-el-title a' );
		$this->end_controls_section();
	}

	protected function render() {
		$id = $this->pdf_id();
		if ( ! $id ) { $this->empty_notice(); return; }
		$s     = $this->get_settings_for_display();
		$tag   = in_array( $s['tag'] ?? 'h1', [ 'h1', 'h2', 'h3', 'h4', 'div', 'p' ], true ) ? $s['tag'] : 'h1';
		$title = esc_html( get_the_title( $id ) );
		if ( ( $s['link'] ?? '' ) === 'yes' ) {
			$title = '<a href="' . esc_url( get_permalink( $id ) ) . '">' . $title . '</a>';
		}
		printf( '<%1$s class="pdfev-el-title"%2$s>%3$s</%1$s>', $tag, $this->lang_attr( $id ), $title ); // phpcs:ignore WordPress.Security.EscapeOutput -- tag whitelisted, title escaped above
	}
}

/* ====================================================================== Cover */

class PDFEV_Cover_Widget extends PDFEV_Part_Widget {
	public function get_name() { return 'pdfev-cover'; }
	public function get_title() { return __( 'PDF Cover', 'pdf-embed-viewer' ); }
	public function get_icon() { return 'eicon-featured-image'; }

	protected function register_controls() {
		$this->start_controls_section( 'content', [ 'label' => __( 'Cover', 'pdf-embed-viewer' ) ] );
		$this->register_source_controls();
		$this->add_control(
			'size',
			[
				'label'   => __( 'Image Size', 'pdf-embed-viewer' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'large',
				'options' => [ 'thumbnail' => 'Thumbnail', 'medium' => 'Medium', 'large' => 'Large', 'full' => 'Full' ],
			]
		);
		$this->add_control(
			'link',
			[
				'label'        => __( 'Link to the PDF page', 'pdf-embed-viewer' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => '',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section( 'style', [ 'label' => __( 'Cover', 'pdf-embed-viewer' ), 'tab' => Controls_Manager::TAB_STYLE ] );
		$this->add_responsive_control(
			'align',
			[
				'label'     => __( 'Alignment', 'pdf-embed-viewer' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [ 'title' => __( 'Left', 'pdf-embed-viewer' ), 'icon' => 'eicon-text-align-left' ],
					'center' => [ 'title' => __( 'Center', 'pdf-embed-viewer' ), 'icon' => 'eicon-text-align-center' ],
					'right'  => [ 'title' => __( 'Right', 'pdf-embed-viewer' ), 'icon' => 'eicon-text-align-right' ],
				],
				'selectors' => [ '{{WRAPPER}} .elementor-widget-container' => 'text-align: {{VALUE}};' ],
			]
		);
		$this->add_responsive_control(
			'width',
			[
				'label'      => __( 'Width', 'pdf-embed-viewer' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px', 'vw' ],
				'range'      => [ '%' => [ 'min' => 5, 'max' => 100 ], 'px' => [ 'min' => 40, 'max' => 1000 ] ],
				'selectors'  => [ '{{WRAPPER}} .pdfev-el-cover img' => 'width: {{SIZE}}{{UNIT}};' ],
			]
		);
		$this->add_group_control( Group_Control_Border::get_type(), [ 'name' => 'border', 'selector' => '{{WRAPPER}} .pdfev-el-cover img' ] );
		$this->add_responsive_control(
			'radius',
			[
				'label'      => __( 'Border Radius', 'pdf-embed-viewer' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [ '{{WRAPPER}} .pdfev-el-cover img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
			]
		);
		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [ 'name' => 'shadow', 'selector' => '{{WRAPPER}} .pdfev-el-cover img' ] );
		$this->add_group_control( Group_Control_Css_Filter::get_type(), [ 'name' => 'filters', 'selector' => '{{WRAPPER}} .pdfev-el-cover img' ] );
		$this->end_controls_section();
	}

	protected function render() {
		$id = $this->pdf_id();
		if ( ! $id || ! has_post_thumbnail( $id ) ) { $this->empty_notice(); return; }
		$s    = $this->get_settings_for_display();
		$img  = get_the_post_thumbnail( $id, $s['size'] ?? 'large', [ 'style' => 'height:auto;max-width:100%;display:inline-block;' ] );
		$link = ( $s['link'] ?? '' ) === 'yes';
		echo '<div class="pdfev-el-cover">' . ( $link ? '<a href="' . esc_url( get_permalink( $id ) ) . '">' : '' ) . $img . ( $link ? '</a>' : '' ) . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput -- core image markup
	}
}

/* ====================================================================== Meta */

class PDFEV_Meta_Widget extends PDFEV_Part_Widget {
	public function get_name() { return 'pdfev-meta'; }
	public function get_title() { return __( 'PDF Details', 'pdf-embed-viewer' ); }
	public function get_icon() { return 'eicon-post-info'; }

	private function fields() {
		return [
			'author'    => __( 'Author', 'pdf-embed-viewer' ),
			'publisher' => __( 'Publisher', 'pdf-embed-viewer' ),
			'category'  => __( 'Category', 'pdf-embed-viewer' ),
			'pages'     => __( 'Pages', 'pdf-embed-viewer' ),
			'filesize'  => __( 'File size', 'pdf-embed-viewer' ),
			'year'      => __( 'Year', 'pdf-embed-viewer' ),
			'edition'   => __( 'Edition', 'pdf-embed-viewer' ),
			'views'     => __( 'Views', 'pdf-embed-viewer' ),
			'downloads' => __( 'Downloads', 'pdf-embed-viewer' ),
		];
	}

	protected function register_controls() {
		$this->start_controls_section( 'content', [ 'label' => __( 'Details', 'pdf-embed-viewer' ) ] );
		$this->register_source_controls();
		$this->add_control(
			'items',
			[
				'label'       => __( 'Show', 'pdf-embed-viewer' ),
				'description' => __( 'Shown in the order selected.', 'pdf-embed-viewer' ),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'label_block' => true,
				'options'     => $this->fields(),
				'default'     => [ 'author', 'pages', 'filesize', 'year' ],
			]
		);
		$this->add_control(
			'layout',
			[
				'label'   => __( 'Layout', 'pdf-embed-viewer' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'inline',
				'options' => [
					'inline' => __( 'Inline row', 'pdf-embed-viewer' ),
					'list'   => __( 'Stacked list', 'pdf-embed-viewer' ),
					'table'  => __( 'Label / value table', 'pdf-embed-viewer' ),
				],
			]
		);
		$this->add_control(
			'show_labels',
			[
				'label'        => __( 'Show Labels', 'pdf-embed-viewer' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => '',
				'condition'    => [ 'layout!' => 'table' ],
			]
		);
		$this->add_control(
			'separator',
			[
				'label'     => __( 'Separator', 'pdf-embed-viewer' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '·',
				'condition' => [ 'layout' => 'inline' ],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section( 'style', [ 'label' => __( 'Details', 'pdf-embed-viewer' ), 'tab' => Controls_Manager::TAB_STYLE ] );
		$this->add_text_style( 'value', __( 'Value Typography', 'pdf-embed-viewer' ), '{{WRAPPER}} .pdfev-el-meta-value' );
		$this->add_control(
			'label_color',
			[
				'label'     => __( 'Label Color', 'pdf-embed-viewer' ),
				'type'      => Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => [ '{{WRAPPER}} .pdfev-el-meta-label' => 'color: {{VALUE}};' ],
			]
		);
		$this->add_group_control( Group_Control_Typography::get_type(), [ 'name' => 'label_typography', 'label' => __( 'Label Typography', 'pdf-embed-viewer' ), 'selector' => '{{WRAPPER}} .pdfev-el-meta-label' ] );
		$this->add_control(
			'sep_color',
			[
				'label'     => __( 'Separator / Divider Color', 'pdf-embed-viewer' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pdfev-el-meta-sep' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pdfev-el-meta--table .pdfev-el-meta-item, {{WRAPPER}} .pdfev-el-meta--list .pdfev-el-meta-item' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'gap',
			[
				'label'      => __( 'Spacing', 'pdf-embed-viewer' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range'      => [ 'px' => [ 'min' => 0, 'max' => 40 ] ],
				'selectors'  => [
					'{{WRAPPER}} .pdfev-el-meta--inline' => 'column-gap: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .pdfev-el-meta--list .pdfev-el-meta-item, {{WRAPPER}} .pdfev-el-meta--table .pdfev-el-meta-item' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}

	private function value( $id, $key ) {
		$terms = function ( $tax ) use ( $id ) {
			$names = wp_get_post_terms( $id, $tax, [ 'fields' => 'names' ] );
			return is_wp_error( $names ) ? '' : implode( ', ', $names );
		};
		switch ( $key ) {
			case 'author':    return $terms( 'pdfev_author' );
			case 'publisher': return $terms( 'pdfev_publisher' );
			case 'category':  return $terms( 'pdfev_category' );
			case 'pages':     $p = get_post_meta( $id, 'pdfev_meta_total_pages', true ); return $p ? number_format_i18n( (int) $p ) : '';
			case 'filesize':  $f = get_post_meta( $id, 'pdfev_meta_filesize', true ); return $f ? \PDFEV_Functions::convert_file_size( $f ) : '';
			case 'year':      return (string) get_post_meta( $id, 'pdfev_meta_published_year', true );
			case 'edition':   return (string) get_post_meta( $id, 'pdfev_meta_edition', true );
			case 'views':     return number_format_i18n( (int) get_post_meta( $id, 'pdfev_meta_views_count', true ) );
			case 'downloads': return number_format_i18n( (int) get_post_meta( $id, 'pdfev_meta_downloads_count', true ) );
		}
		return '';
	}

	protected function render() {
		$id = $this->pdf_id();
		if ( ! $id ) { $this->empty_notice(); return; }
		$s      = $this->get_settings_for_display();
		$layout = in_array( $s['layout'] ?? 'inline', [ 'inline', 'list', 'table' ], true ) ? $s['layout'] : 'inline';
		$labels = $layout === 'table' || ( $s['show_labels'] ?? '' ) === 'yes';
		$fields = $this->fields();
		$rows   = [];
		foreach ( (array) ( $s['items'] ?? [] ) as $key ) {
			if ( ! isset( $fields[ $key ] ) ) {
				continue;
			}
			$value = $this->value( $id, $key );
			if ( $value === '' ) {
				continue;
			}
			if ( $key === 'pages' && ! $labels ) {
				$value = sprintf( _n( '%s page', '%s pages', (int) str_replace( [ ',', '.' ], '', $value ), 'pdf-embed-viewer' ), $value );
			}
			$rows[] = [ $fields[ $key ], $value ];
		}
		if ( ! $rows ) {
			return;
		}
		echo '<ul class="pdfev-el-meta pdfev-el-meta--' . esc_attr( $layout ) . '"' . $this->lang_attr( $id ) . '>'; // phpcs:ignore WordPress.Security.EscapeOutput -- lang attr built with esc_attr()
		foreach ( $rows as $i => $row ) {
			if ( $layout === 'inline' && $i > 0 && ( $s['separator'] ?? '' ) !== '' ) {
				echo '<li class="pdfev-el-meta-sep" aria-hidden="true">' . esc_html( $s['separator'] ) . '</li>';
			}
			echo '<li class="pdfev-el-meta-item">';
			if ( $labels ) {
				echo '<span class="pdfev-el-meta-label">' . esc_html( $row[0] ) . ( $layout === 'table' ? '' : ': ' ) . '</span>';
			}
			echo '<span class="pdfev-el-meta-value">' . esc_html( $row[1] ) . '</span></li>';
		}
		echo '</ul>';
	}
}

/* ====================================================================== Description */

class PDFEV_Description_Widget extends PDFEV_Part_Widget {
	public function get_name() { return 'pdfev-description'; }
	public function get_title() { return __( 'PDF Description', 'pdf-embed-viewer' ); }
	public function get_icon() { return 'eicon-post-excerpt'; }

	protected function register_controls() {
		$this->start_controls_section( 'content', [ 'label' => __( 'Description', 'pdf-embed-viewer' ) ] );
		$this->register_source_controls();
		$this->end_controls_section();

		$this->start_controls_section( 'style', [ 'label' => __( 'Description', 'pdf-embed-viewer' ), 'tab' => Controls_Manager::TAB_STYLE ] );
		$this->add_text_style( 'desc', __( 'Typography', 'pdf-embed-viewer' ), '{{WRAPPER}} .pdfev-el-description, {{WRAPPER}} .pdfev-el-description p' );
		$this->add_responsive_control(
			'max_width',
			[
				'label'      => __( 'Max Width', 'pdf-embed-viewer' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'ch', 'px', '%' ],
				'range'      => [ 'ch' => [ 'min' => 20, 'max' => 120 ], 'px' => [ 'min' => 200, 'max' => 1400 ] ],
				'selectors'  => [ '{{WRAPPER}} .pdfev-el-description' => 'max-width: {{SIZE}}{{UNIT}};' ],
			]
		);
		$this->end_controls_section();
	}

	protected function render() {
		$id = $this->pdf_id();
		if ( ! $id ) { $this->empty_notice(); return; }
		$text = get_post_meta( $id, 'pdfev_meta_description', true );
		if ( $text === '' ) {
			return;
		}
		echo '<div class="pdfev-el-description"' . $this->lang_attr( $id ) . '>' . wp_kses_post( wpautop( $text ) ) . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput -- lang attr built with esc_attr()
	}
}

/* ====================================================================== Download */

class PDFEV_Download_Widget extends PDFEV_Part_Widget {
	public function get_name() { return 'pdfev-download'; }
	public function get_title() { return __( 'PDF Download Button', 'pdf-embed-viewer' ); }
	public function get_icon() { return 'eicon-download-button'; }

	protected function register_controls() {
		$this->start_controls_section( 'content', [ 'label' => __( 'Button', 'pdf-embed-viewer' ) ] );
		$this->register_source_controls();
		$this->add_control(
			'show_count',
			[
				'label'        => __( 'Show Download Count', 'pdf-embed-viewer' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		$this->add_control(
			'respect_post',
			[
				'label'        => __( 'Hide when the PDF disables downloads', 'pdf-embed-viewer' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		$this->add_responsive_control(
			'align',
			[
				'label'     => __( 'Alignment', 'pdf-embed-viewer' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'flex-start' => [ 'title' => __( 'Start', 'pdf-embed-viewer' ), 'icon' => 'eicon-h-align-left' ],
					'center'     => [ 'title' => __( 'Center', 'pdf-embed-viewer' ), 'icon' => 'eicon-h-align-center' ],
					'flex-end'   => [ 'title' => __( 'End', 'pdf-embed-viewer' ), 'icon' => 'eicon-h-align-right' ],
				],
				'selectors' => [ '{{WRAPPER}} .pdfev-el-download' => 'justify-content: {{VALUE}};' ],
			]
		);
		$this->add_responsive_control(
			'full_width',
			[
				'label'        => __( 'Full Width', 'pdf-embed-viewer' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => '',
				'selectors'    => [ '{{WRAPPER}} .pdfev-el-download .download-btn' => 'width: 100%;' ],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section( 'style', [ 'label' => __( 'Button', 'pdf-embed-viewer' ), 'tab' => Controls_Manager::TAB_STYLE ] );
		$sel = '{{WRAPPER}} .download-btn';
		$this->add_group_control( Group_Control_Typography::get_type(), [ 'name' => 'typography', 'selector' => $sel ] );
		$this->start_controls_tabs( 'tabs' );
		foreach ( [ 'normal' => '', 'hover' => ':hover' ] as $state => $suffix ) {
			$this->start_controls_tab( 'tab_' . $state, [ 'label' => $state === 'normal' ? __( 'Normal', 'pdf-embed-viewer' ) : __( 'Hover', 'pdf-embed-viewer' ) ] );
			$this->add_control( 'color_' . $state, [ 'label' => __( 'Text Color', 'pdf-embed-viewer' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ $sel . $suffix => 'color: {{VALUE}};' ] ] );
			$this->add_control( 'bg_' . $state, [ 'label' => __( 'Background', 'pdf-embed-viewer' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ $sel . $suffix => 'background-color: {{VALUE}};' ] ] );
			$this->add_control( 'border_color_' . $state, [ 'label' => __( 'Border Color', 'pdf-embed-viewer' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ $sel . $suffix => 'border-color: {{VALUE}};' ] ] );
			$this->end_controls_tab();
		}
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'padding',
			[
				'label'      => __( 'Padding', 'pdf-embed-viewer' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'separator'  => 'before',
				'selectors'  => [ $sel => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
			]
		);
		$this->add_responsive_control(
			'radius',
			[
				'label'      => __( 'Border Radius', 'pdf-embed-viewer' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [ $sel => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
			]
		);
		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [ 'name' => 'shadow', 'selector' => $sel ] );
		$this->end_controls_section();
	}

	protected function render() {
		$id = $this->pdf_id();
		if ( ! $id ) { $this->empty_notice(); return; }
		$s = $this->get_settings_for_display();
		if ( ( $s['respect_post'] ?? 'yes' ) === 'yes' && get_post_meta( $id, 'pdfev_meta_download', true ) === 'no' ) {
			return;
		}
		echo '<div class="pdfev-embed-viewer pdfev-el-download">';
		\PDFEV_Functions::get_download_button( [ 'post_id' => $id, 'downloading_count' => ( $s['show_count'] ?? '' ) === 'yes' ? 'yes' : 'no' ] );
		echo '</div>';
	}
}

/* ====================================================================== Navigation */

class PDFEV_Navigation_Widget extends PDFEV_Part_Widget {
	public function get_name() { return 'pdfev-navigation'; }
	public function get_title() { return __( 'PDF Navigation', 'pdf-embed-viewer' ); }
	public function get_icon() { return 'eicon-post-navigation'; }

	protected function register_controls() {
		$this->start_controls_section( 'content', [ 'label' => __( 'Navigation', 'pdf-embed-viewer' ) ] );
		$this->register_source_controls();
		$this->add_control( 'show_back', [ 'label' => __( 'Back Link', 'pdf-embed-viewer' ), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes' ] );
		$this->add_control( 'back_label', [ 'label' => __( 'Back Label', 'pdf-embed-viewer' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'Back to overview', 'pdf-embed-viewer' ), 'condition' => [ 'show_back' => 'yes' ] ] );
		$this->add_control(
			'back_url',
			[
				'label'       => __( 'Back Link URL', 'pdf-embed-viewer' ),
				'description' => __( 'Leave empty to use Settings → Back to Overview Page.', 'pdf-embed-viewer' ),
				'type'        => Controls_Manager::URL,
				'condition'   => [ 'show_back' => 'yes' ],
			]
		);
		$this->add_control( 'show_adjacent', [ 'label' => __( 'Previous / Next', 'pdf-embed-viewer' ), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes', 'separator' => 'before' ] );
		$this->add_control( 'show_titles', [ 'label' => __( 'Show PDF Titles', 'pdf-embed-viewer' ), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes', 'condition' => [ 'show_adjacent' => 'yes' ] ] );
		$this->add_control( 'prev_label', [ 'label' => __( 'Previous Label', 'pdf-embed-viewer' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'Previous', 'pdf-embed-viewer' ), 'condition' => [ 'show_adjacent' => 'yes' ] ] );
		$this->add_control( 'next_label', [ 'label' => __( 'Next Label', 'pdf-embed-viewer' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'Next', 'pdf-embed-viewer' ), 'condition' => [ 'show_adjacent' => 'yes' ] ] );
		$this->end_controls_section();

		$this->start_controls_section( 'style', [ 'label' => __( 'Navigation', 'pdf-embed-viewer' ), 'tab' => Controls_Manager::TAB_STYLE ] );
		$this->add_control( 'label_color', [ 'label' => __( 'Label Color', 'pdf-embed-viewer' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .pdfev-el-nav-label, {{WRAPPER}} .pdfev-el-back' => 'color: {{VALUE}};' ] ] );
		$this->add_group_control( Group_Control_Typography::get_type(), [ 'name' => 'label_typography', 'label' => __( 'Label Typography', 'pdf-embed-viewer' ), 'selector' => '{{WRAPPER}} .pdfev-el-nav-label, {{WRAPPER}} .pdfev-el-back' ] );
		$this->add_control( 'title_color', [ 'label' => __( 'Title Color', 'pdf-embed-viewer' ), 'type' => Controls_Manager::COLOR, 'separator' => 'before', 'selectors' => [ '{{WRAPPER}} .pdfev-el-nav-title' => 'color: {{VALUE}};' ] ] );
		$this->add_group_control( Group_Control_Typography::get_type(), [ 'name' => 'title_typography', 'label' => __( 'Title Typography', 'pdf-embed-viewer' ), 'selector' => '{{WRAPPER}} .pdfev-el-nav-title' ] );
		$this->add_control( 'box_bg', [ 'label' => __( 'Box Background', 'pdf-embed-viewer' ), 'type' => Controls_Manager::COLOR, 'separator' => 'before', 'selectors' => [ '{{WRAPPER}} .pdfev-el-nav-link' => 'background-color: {{VALUE}};' ] ] );
		$this->add_group_control( Group_Control_Border::get_type(), [ 'name' => 'box_border', 'selector' => '{{WRAPPER}} .pdfev-el-nav-link' ] );
		$this->add_control( 'box_border_hover', [ 'label' => __( 'Hover Border Color', 'pdf-embed-viewer' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .pdfev-el-nav-link:hover' => 'border-color: {{VALUE}};' ] ] );
		$this->add_responsive_control(
			'box_radius',
			[
				'label'      => __( 'Border Radius', 'pdf-embed-viewer' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [ '{{WRAPPER}} .pdfev-el-nav-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
			]
		);
		$this->add_responsive_control(
			'box_padding',
			[
				'label'      => __( 'Padding', 'pdf-embed-viewer' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [ '{{WRAPPER}} .pdfev-el-nav-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
			]
		);
		$this->end_controls_section();
	}

	private function back_url( $s ) {
		if ( ! empty( $s['back_url']['url'] ) ) {
			return $s['back_url']['url'];
		}
		$page = get_option( 'pdfev_shortcode_page_url' );
		return $page ? home_url( '/' . $page ) : get_post_type_archive_link( 'pdfev_embed_viewer' );
	}

	protected function render() {
		$id = $this->pdf_id();
		if ( ! $id ) { $this->empty_notice(); return; }
		$s = $this->get_settings_for_display();

		echo '<nav class="pdfev-el-nav" aria-label="' . esc_attr__( 'PDF navigation', 'pdf-embed-viewer' ) . '">';
		if ( ( $s['show_back'] ?? '' ) === 'yes' ) {
			echo '<a class="pdfev-el-back" href="' . esc_url( $this->back_url( $s ) ) . '">&larr; ' . esc_html( $s['back_label'] ) . '</a>';
		}
		if ( ( $s['show_adjacent'] ?? '' ) === 'yes' ) {
			// get_previous_post()/get_next_post() read the global post, which
			// is the template itself while editing — point it at the PDF.
			global $post;
			$saved = $post;
			$post  = get_post( $id ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride
			$prev  = get_previous_post();
			$next  = get_next_post();
			$post  = $saved; // phpcs:ignore WordPress.WP.GlobalVariablesOverride

			echo '<div class="pdfev-el-nav-pair">';
			foreach ( [ 'prev' => $prev, 'next' => $next ] as $dir => $item ) {
				if ( ! $item ) {
					echo '<span></span>';
					continue;
				}
				$label = $dir === 'prev' ? '&larr; ' . esc_html( $s['prev_label'] ) : esc_html( $s['next_label'] ) . ' &rarr;';
				echo '<a class="pdfev-el-nav-link pdfev-el-nav-' . esc_attr( $dir ) . '" href="' . esc_url( get_permalink( $item ) ) . '">';
				echo '<span class="pdfev-el-nav-label">' . $label . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput -- escaped above
				if ( ( $s['show_titles'] ?? '' ) === 'yes' ) {
					echo '<span class="pdfev-el-nav-title">' . esc_html( get_the_title( $item ) ) . '</span>';
				}
				echo '</a>';
			}
			echo '</div>';
		}
		echo '</nav>';
	}
}
