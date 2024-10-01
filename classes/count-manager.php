<?php
/**
 * @author Shahadat Hossain <raselsha@gmail.com>
 * @version 1.0.0
 */

if( ! defined('ABSPATH') ) { die( "Don't access directly" ); }

if( ! class_exists('PDFEV_Count_Manager') ){
    class PDFEV_Count_Manager{
        public function __construct() {
            add_action('wp_head', array($this,'track_post_views'));

            add_action('wp_ajax_pdfev_count_manager_download', array($this,'track_dowload_counts'));
            add_action('wp_ajax_nopriv_pdfev_count_manager_download', array($this,'track_dowload_counts'));

        }  

        public function track_dowload_counts() {
            if (isset($_POST['post_id'])) {
                $this->set_file_download_count($_POST['post_id']);
                $download_count = $this->get_download_count($_POST['post_id']);
                wp_send_json_success(array(
                    'message' => 'Download count incremented successfully!',
                    'download_count' => $download_count
                ));
            } else {
                wp_send_json_error('Invalid Post ID');
            }
            die;
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
                add_post_meta(get_the_ID(), $meta_key, '0');
            } else {
                $count++;
                update_post_meta(get_the_ID(), $meta_key, $count);
            }
        }
    }
    new PDFEV_Count_Manager();
}