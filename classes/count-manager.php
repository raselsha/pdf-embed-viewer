<?php
/**
 * @author Shahadat Hossain <raselsha@gmail.com>
 * @version 1.0.1
 */
namespace PDFEV;
defined('ABSPATH') || exit;

    class Count_Manager{
        public function __construct() {
            add_action('wp_head', array($this,'track_post_views'));

            add_action('wp_ajax_pdfev_count_manager_download', array($this,'track_dowload_counts'));
            add_action('wp_ajax_nopriv_pdfev_count_manager_download', array($this,'track_dowload_counts'));

        }  

        public function track_dowload_counts() {
            check_ajax_referer( 'pdf_ajax_nonce', 'ajaxnonce' );

            $post_id = isset($_POST['post_id']) ? absint($_POST['post_id']) : 0;

            if ($post_id) {
                $this->set_file_download_count($post_id);
                $download_count = $this->get_download_count($post_id);

                $response = array(
                    'message' => 'Download count incremented successfully!',
                    'download_count' => $download_count,
                );

                // In Pro "Hide File URL" mode, mint a fresh single-use download
                // link in this same request instead of the button linking directly
                // to the file — see PDFEV_Functions::get_protected_download_url().
                $download_url = \PDFEV_Functions::get_protected_download_url($post_id);
                if ($download_url) {
                    $response['download_url'] = $download_url;
                }

                wp_send_json_success($response);
            } else {
                wp_send_json_error('Invalid Post ID');
            }
        }

        public function get_download_count($post_id) {
            $count_key = 'pdfev_meta_downloads_count';
            $count = get_post_meta($post_id, $count_key, true);
            return $count ? $count : 0;
        }

        public function set_file_download_count($postID) {
            
            $count_key = 'pdfev_meta_downloads_count';
            $count = get_post_meta($postID, $count_key, true);
            if ($count == '') {
                $count = 0;
                delete_post_meta($postID, $count_key);
                add_post_meta($postID, $count_key, '1');
            } else {
                $count++;
                update_post_meta($postID, $count_key, $count);
            }
            
        }

        public function track_post_views() {
            if (is_single()) {
                $this->set_post_view('pdfev_meta_views_count');
            }
        }

        function set_post_view($meta_key) {
            $count = get_post_meta(get_the_ID(), $meta_key, true);
            if ($count == '') {
                $count = 0;
                delete_post_meta(get_the_ID(), $meta_key);
                add_post_meta(get_the_ID(), $meta_key, '1');
            } else {
                $count++;
                update_post_meta(get_the_ID(), $meta_key, $count);
            }
        }
    }
    new \PDFEV\Count_Manager();
