<?php
/**
 * Insert demo class
 * @author Shahadat Hossain <raselsha@gmail.com>
 * @version 1.0.1
 * @since 1.1.1
 */
namespace PDFEV;
defined('ABSPATH') || exit;

class Insert_Demo {

    public function __construct() {
        add_action('wp_ajax_pdfev_import_demo_data', array($this,'import_demo_data')); 
        add_action('admin_notices', [$this, 'show_import_notice']);
    }

    public static function show_import_notice(){
        if ( get_option('pdfev_dummy_import_notice') ) {
            ?>
            <div class="notice notice-success is-dismissible">
                <p>
                <strong><?php _e('3D Flipbook PDF Viewer & Embedder Activated!','pdf-embed-viewer') ?></strong>
                <?php _e('Go to','pdf-embed-viewer') ?> 
                <a href="<?php echo admin_url('admin.php?page=pdfev-import'); ?>"><?php _e('Settings','pdf-embed-viewer') ?></a>
                <?php _e('Or','pdf-embed-viewer') ?>
                 <span class="demo-import-success"></span> 
                <input  type="button" class="button-primary pdfev-import-demo-content" value="<?php _e('Import Dummy data','pdf-embed-viewer') ?>"> 
                </p>
            </div>
            <?php
            delete_option('pdfev_dummy_import_notice');
        }
    }

    public function mark_import_done(){
        update_option('pdfev_dummy_import_done', true); // permanent flag
        delete_option('pdfev_dummy_import_notice'); // import হয়ে গেলে notice আর দরকার নাই
    }

    public function import_demo_data(){
        
        if( isset( $_POST['ajaxnonce'] ) ){
            if( ! wp_verify_nonce( sanitize_text_field( wp_unslash ( $_POST['ajaxnonce'] ) ) , 'pdf_ajax_nonce' ) ){
                wp_send_json_error('Invalid nonce');
                return;
            }
        }

        $success = $this->insert_demo_post_xml();

        // Prepare the response
        $response = array(
            'success' => $success, // This should be true or false based on the function result
            'message' => $success ? __('Dummy Data imported successfully!', 'pdf-embed-viewer') : __('Failed to import data.', 'pdf-embed-viewer')
        );
        wp_send_json($response);
        wp_die(); // End AJAX request

    }

    public function insert_demo_post_xml(){
        $dummy = $this->dummy_data();
        $taxonomy_ids = $this->ensure_demo_terms();

        foreach ($dummy as $key => $dummy_data) {
            $pdf_attached = \PDFEV_Functions::insert_media( $dummy_data['pdf_file'] );
            $image_attached = \PDFEV_Functions::insert_media($dummy_data['image_file']);
            $dummy_data['meta_data']['pdfev_meta_pdf_url'] = $pdf_attached['url'];
            $post_id = wp_insert_post([
                'post_title' => $dummy_data['title'],
                'post_status' => 'publish',
                'post_type' => \PDFEV_Functions::get_cpt_name(),
            ]);
            if (array_key_exists('meta_data', $dummy_data)) {
                $allowed_meta_keys = [
                    'pdfev_meta_pdf_url',
                    'pdfev_meta_download',
                    'pdfev_meta_description',
                    'pdfev_meta_published_year',
                    'pdfev_meta_version',
                    'pdfev_meta_filesize',
                    'pdfev_meta_total_pages',
                ];

                foreach ($dummy_data['meta_data'] as $meta_key => $data) {
                    if ( in_array( $meta_key, $allowed_meta_keys, true ) ) {
                        update_post_meta($post_id, $meta_key, $data);
                    }
                }
            }

            if ( ! empty( $dummy_data['author'] ) && isset( $taxonomy_ids['authors'][ $dummy_data['author'] ] ) ) {
                wp_set_object_terms( $post_id, $taxonomy_ids['authors'][ $dummy_data['author'] ], 'pdfev_author' );
            }
            if ( ! empty( $dummy_data['publisher'] ) && isset( $taxonomy_ids['publishers'][ $dummy_data['publisher'] ] ) ) {
                wp_set_object_terms( $post_id, $taxonomy_ids['publishers'][ $dummy_data['publisher'] ], 'pdfev_publisher' );
            }
            if ( ! empty( $dummy_data['categories'] ) ) {
                $category_ids = [];
                foreach ( $dummy_data['categories'] as $category_slug ) {
                    if ( isset( $taxonomy_ids['categories'][ $category_slug ] ) ) {
                        $category_ids[] = $taxonomy_ids['categories'][ $category_slug ];
                    }
                }
                if ( ! empty( $category_ids ) ) {
                    wp_set_object_terms( $post_id, $category_ids, 'pdfev_category' );
                }
            }

            set_post_thumbnail( $post_id, $image_attached['id']??'' );
            
        }
        $this->create_demo_pages();
        return true;
    }

    public function ensure_demo_terms(){
        $term_sets = [
            'authors' => [
                'Jack London',
                'William Shakespeare',
                'Arthur Conan Doyle',
                'L. Frank Baum',
                'J. M. Barrie',
            ],
            'publishers' => [
                'Macmillan',
                'Penguin Classics',
                'HarperCollins',
                'Vintage',
                'Random House',
            ],
            'categories' => [
                'Adventure',
                'Classic',
                'Drama',
                'Romance',
                'Fantasy',
            ],
        ];

        $taxonomy_ids = [
            'authors' => [],
            'publishers' => [],
            'categories' => [],
        ];

        foreach ( $term_sets as $group => $names ) {
            $taxonomy = $group === 'categories' ? 'pdfev_category' : 'pdfev_' . rtrim( $group, 's' );
            foreach ( $names as $name ) {
                $term = term_exists( $name, $taxonomy );
                if ( $term === 0 || $term === null ) {
                    $insert = wp_insert_term( $name, $taxonomy );
                    if ( ! is_wp_error( $insert ) && isset( $insert['term_id'] ) ) {
                        $term_id = absint( $insert['term_id'] );
                    } else {
                        continue;
                    }
                } else {
                    $term_id = is_array( $term ) ? absint( $term['term_id'] ) : absint( $term );
                }

                $taxonomy_ids[ $group ][ sanitize_title( $name ) ] = $term_id;
            }
        }

        return $taxonomy_ids;
    }

    public function dummy_data(){
        return [
            [
                'title' => 'The Call Of The Wild',
                'pdf_file' => PDFEV_Const_Path.'assets/demo/book-1.pdf',
                'image_file' => PDFEV_Const_Path.'assets/demo/cover-1.jpg',
                'author' => 'jack-london',
                'publisher' => 'macmillan',
                'categories' => [ 'adventure', 'classic' ],
                'meta_data' => [
                    'pdfev_meta_pdf_url' => '',
                    'pdfev_meta_download' => 'yes',
                    'pdfev_meta_description' => 'A thrilling wilderness adventure about a domesticated dog who returns to the wild and finds his true destiny.',
                    'pdfev_meta_published_year' => '1903',
                    'pdfev_meta_version' => '1.0',
                ],
            ],
            [
                'title' => 'Romeo And Juliet',
                'pdf_file' => PDFEV_Const_Path.'assets/demo/book-2.pdf',
                'image_file' => PDFEV_Const_Path.'assets/demo/cover-2.jpg',
                'author' => 'william-shakespeare',
                'publisher' => 'penguin-classics',
                'categories' => [ 'drama', 'romance' ],
                'meta_data' => [
                    'pdfev_meta_pdf_url' => '',
                    'pdfev_meta_download' => 'yes',
                    'pdfev_meta_description' => 'A timeless tragic love story between two young lovers from feuding families in Verona.',
                    'pdfev_meta_published_year' => '1597',
                    'pdfev_meta_version' => '1.1',
                ],
            ],
            [
                'title' => 'The Adventures of Sherlock Holmes',
                'pdf_file' => PDFEV_Const_Path.'assets/demo/book-3.pdf',
                'image_file' => PDFEV_Const_Path.'assets/demo/cover-3.jpg',
                'author' => 'arthur-conan-doyle',
                'publisher' => 'harpercollins',
                'categories' => [ 'fantasy', 'classic' ],
                'meta_data' => [
                    'pdfev_meta_pdf_url' => '',
                    'pdfev_meta_download' => 'yes',
                    'pdfev_meta_description' => 'A collection of detective stories featuring the brilliant Sherlock Holmes and his partner Dr. Watson.',
                    'pdfev_meta_published_year' => '1892',
                    'pdfev_meta_version' => '2.0',
                ],
            ],
            [
                'title' => 'The Little Lady of the Big House',
                'pdf_file' => PDFEV_Const_Path.'assets/demo/book-4.pdf',
                'image_file' => PDFEV_Const_Path.'assets/demo/cover-4.jpg',
                'author' => 'jack-london',
                'publisher' => 'vintage',
                'categories' => [ 'classic', 'fantasy' ],
                'meta_data' => [
                    'pdfev_meta_pdf_url' => '',
                    'pdfev_meta_download' => 'yes',
                    'pdfev_meta_description' => 'The story of a young woman who inherits a mansion and learns about wealth, independence, and love.',
                    'pdfev_meta_published_year' => '1916',
                    'pdfev_meta_version' => '1.0',
                ],
            ],
            [
                'title' => 'The Wonderful Wizard of Oz',
                'pdf_file' => PDFEV_Const_Path.'assets/demo/book-5.pdf',
                'image_file' => PDFEV_Const_Path.'assets/demo/cover-5.jpg',
                'author' => 'l-frank-baum',
                'publisher' => 'random-house',
                'categories' => [ 'fantasy', 'adventure' ],
                'meta_data' => [
                    'pdfev_meta_pdf_url' => '',
                    'pdfev_meta_download' => 'yes',
                    'pdfev_meta_description' => 'A magical journey through Oz with Dorothy and her friends as they seek the Wizard\'s help.',
                    'pdfev_meta_published_year' => '1900',
                    'pdfev_meta_version' => '1.2',
                ],
            ],
            [
                'title' => 'Peter and Wendy',
                'pdf_file' => PDFEV_Const_Path.'assets/demo/book-6.pdf',
                'image_file' => PDFEV_Const_Path.'assets/demo/cover-6.jpg',
                'author' => 'j-m-barrie',
                'publisher' => 'scholastic',
                'categories' => [ 'fantasy', 'adventure' ],
                'meta_data' => [
                    'pdfev_meta_pdf_url' => '',
                    'pdfev_meta_download' => 'yes',
                    'pdfev_meta_description' => 'The classic tale of Peter Pan, Wendy, and the adventures in Neverland.',
                    'pdfev_meta_published_year' => '1911',
                    'pdfev_meta_version' => '1.0',
                ],
            ],
        ];
    }

    public function insert_demo_post() {
        $image = PDFEV_Const_Path.'assets/images/book-image.png';
        $pdf = PDFEV_Const_Path.'assets/images/pdf-book-sample.pdf';
        $image_attached = \PDFEV_Functions::insert_media($image);
        $pdf_attached = \PDFEV_Functions::insert_media($pdf);
        $months = ["", "January", "February", "March", "April", "May", "June"];
        // Create an array of demo post data
        for($i=1; $i<7;$i++){
            $post_data = array(
                'post_title'    => 'Newsletter '.$months[$i],
                'post_content'  => 'This is the content of demo post '.$i,
                'post_status'   => 'publish',
                'post_author'   => 1, // Change this to the author ID you want
                'post_date'     => '2024-'.$i.'-24 12:00:00',
                'post_type'     => \PDFEV_Functions::get_cpt_name(),
            );
            
            if ( ! get_page_by_path( 'demo-pdf-'.$i, OBJECT, \PDFEV_Functions::get_cpt_name() ) ) {
                $post_id = wp_insert_post( $post_data );
                if (!is_wp_error($post_id)) {
                    
                    $meta_data = array(
                        'pdfev_meta_pdf_url' => $pdf_attached['url']??'',
                        'pdfev_meta_download' => 'yes',
                    );

                    foreach ($meta_data as $meta_key => $meta_value) {
                        update_post_meta($post_id, $meta_key, $meta_value);
                    }

                    require_once(ABSPATH . "wp-admin" . '/includes/image.php');

                    set_post_thumbnail( $post_id, $image_attached['id']??'' );

                } else {
                    echo 'Error inserting post: ' . $post_id->get_error_message();
                }
            }
        }
        
        return true;
    }

    public function create_demo_pages() {
        $pages = [
            'Pdf List view'    =>  '[pdfev_viewer template="list"]',
            'Pdf Grid view'    =>  '[pdfev_viewer template="grid"]',
            'Pdf Newsletter view'    =>  '[pdfev_viewer template="newsletter"]',
            'Pdf Ebook view'    =>  '[pdfev_viewer template="ebook"]',
        ];
    
        foreach ( $pages as $title => $content ) {
            // Check if a page with the same title exists
            $existing_pages = get_posts([
                'post_type'      => 'page',
                'title'          => $title,
                'posts_per_page' => 1,
                'post_status'    => 'any',
            ]);

            if ( empty( $existing_pages ) ) {
                // Create the page if it doesn't exist
                wp_insert_post([
                    'post_title'   => $title,
                    'post_content' => $content,
                    'post_status'  => 'publish',
                    'post_type'    => 'page',
                ]);
            }
        }
        $this->mark_import_done();
    }        
}

new \PDFEV\Insert_Demo();
