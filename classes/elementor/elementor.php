<?php
/**
 * Elementor integration for PDF Embed Viewer plugin.
 * 
 * @author Shahadat Hossain <raselsha@gmail.com>
 * @package pdf-embed-viewer
 * @version 1.0.1
 */

namespace PDFEV;

defined( 'ABSPATH' ) || exit;

use Elementor\Plugin as ElementorPlugin;

class Elementor_Settings {

    public function __construct() {
        // Check if Elementor is active
        if ( did_action( 'elementor/loaded' ) ) {
            add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );
            add_action( 'elementor/elements/categories_registered', [ $this, 'add_widget_categories' ] );
            add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
        }
    }

    /**
     * Register custom widget scripts (if needed)
     */
    public function widget_scripts() {
        // Example: Register your widget-specific JS here if needed
        // wp_register_script( 'pdf-embed-script', plugins_url( '/assets/js/pdf-viewer.js', __FILE__ ), [ 'jquery' ], false, true );
    }

    /**
     * Add a custom Elementor widget category
     */
    public function add_widget_categories( $elements_manager ) {
        $elements_manager->add_category(
            'pdfev-elementor-category',
            [
                'title' => __( 'PDF Embed Viewer', 'pdf-embed-viewer' ),
                'icon'  => 'fa fa-plug',
            ]
        );
    }

    /**
     * Include widget files
     */
    private function include_widgets_files() {
        require_once PDFEV_Const_Path . 'classes/elementor/widgets/grid.php';
    }

    /**
     * Register widgets with Elementor
     */
    public function register_widgets() {
        $this->include_widgets_files();
        // Register the widget class (assuming it's defined inside the included file)
        ElementorPlugin::instance()->widgets_manager->register( new \PDFEV\Widgets\PDFEV_Grid_Widget() );
    }
}

// Initialize the class
new Elementor_Settings();
