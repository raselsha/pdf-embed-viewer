<?php
namespace PDFEV\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class PDFEV_Grid_Widget extends Widget_Base {

	public function get_name() {
		return 'pdfev-archive-view';
	}

	public function get_title() {
		return __( 'PDF Archive View', 'mage-eventpress' );
	}

	public function get_icon() {
		return 'eicon-archive-posts';
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
			'template',
			[
				'label' => __( 'Template', 'pdf-embed-viewer' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'ebook',
				'options' => [
					'ebook' => __( 'Ebook', 'pdf-embed-viewer' ),
					'grid' => __( 'Grid', 'pdf-embed-viewer' ),
					'list' => __( 'List', 'pdf-embed-viewer' ),
					'newsletter' => __( 'Newsletter', 'pdf-embed-viewer' ),
				],
			]
		);

		// Category option
		$categories = get_terms( array(
			'taxonomy'   => 'pdfev_category',
			'hide_empty' => false,
		) );

		if ( ! is_wp_error( $categories ) && ! empty( $categories ) ) {

			$options = [
				'' => __( 'Select Category', 'pdf-embed-viewer' ),
			];

			foreach ( $categories as $category ) {
				$options[ $category->slug ] = $category->name;
			}

			$this->add_control(
				'category',
				[
					'label' => __( 'Category', 'pdf-embed-viewer' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => '',
					'options' => $options,
				]
			);
		}


		// Order
		$this->add_control(
			'order',
			[
				'label' => __( 'Order', 'pdf-embed-viewer' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'dsc',
				'options' => [
					'asc' => __( 'ASC (Oldest First)', 'pdf-embed-viewer' ),
					'dsc' => __( 'DSC (Newest First)', 'pdf-embed-viewer' ),
				],
			]
		);

		// Limit
		$this->add_control(
			'limit',
			[
				'label' => __( 'Limit', 'pdf-embed-viewer' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 10,
				'min' => 1,
				'max' => 100,
			]
		);

		

		// Read toggle
		$this->add_control(
			'read',
			[
				'label' => __( 'Show Read Button', 'pdf-embed-viewer' ),
				'type' => Controls_Manager::SWITCHER,
				'yes' => __( 'Yes', 'pdf-embed-viewer' ),
				'no' => __( 'No', 'pdf-embed-viewer' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		// Download toggle
		$this->add_control(
			'download',
			[
				'label' => __( 'Show Download Button', 'pdf-embed-viewer' ),
				'type' => Controls_Manager::SWITCHER,
				'yes' => __( 'Yes', 'pdf-embed-viewer' ),
				'no' => __( 'No', 'pdf-embed-viewer' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		// Reading count toggle
		$this->add_control(
			'reading_count',
			[
				'label' => __( 'Show Reading Count', 'pdf-embed-viewer' ),
				'type' => Controls_Manager::SWITCHER,
				'yes' => __( 'Yes', 'pdf-embed-viewer' ),
				'no' => __( 'No', 'pdf-embed-viewer' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		// Downloading count toggle
		$this->add_control(
			'downloading_count',
			[
				'label' => __( 'Show Downloading Count', 'pdf-embed-viewer' ),
				'type' => Controls_Manager::SWITCHER,
				'yes' => __( 'Yes', 'pdf-embed-viewer' ),
				'no' => __( 'No', 'pdf-embed-viewer' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->end_controls_section();

	
	}

    protected function render() {
		$settings = $this->get_settings_for_display();
		// Build shortcode string
		$shortcode = sprintf(
			'[pdfev_viewer template="%s" category="%s" limit="%d" order="%s" read="%s" download="%s" reading_count="%s" downloading_count="%s"]',
			esc_attr( $settings['template'] ),
			esc_attr( $settings['category'] ),
			intval( $settings['limit'] ),
			esc_attr( $settings['order'] ),
			esc_attr( $settings['read'] ?'yes':'no' ),
			esc_attr( $settings['download'] ?'yes':'no' ),
			esc_attr( $settings['reading_count'] ?'yes':'no' ),
			esc_attr( $settings['downloading_count'] ?'yes':'no' )
		);
		// Output
		echo do_shortcode( $shortcode );
        
    }
}