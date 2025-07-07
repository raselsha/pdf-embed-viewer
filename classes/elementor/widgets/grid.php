<?php
namespace PDFEV\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class PDFEV_Grid_Widget extends Widget_Base {

	public function get_name() {
		return 'pdfev-widgets';
	}

	public function get_title() {
		return __( 'E', 'mage-eventpress' );
	}

	public function get_icon() {
		return 'eicon-calendar';
	}

	public function get_categories() {
		return [ 'pdfev-elementor-category' ];
	}

	public function get_keywords() {
		return [ 'event', 'calendar', 'add to calendar', 'pdf', 'embed' ];
	}

}
