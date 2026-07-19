<?php
/**
 * @author shahadat hossain <raselsha@gmail.com>
 * @version 1.0.0
 * @since 1.1.0
 */

namespace PDFEV;

defined('ABSPATH') || exit;

class Support_Settings{
    public function __construct() {
        add_action('pdfev_settings_tabs',array($this,'tabs'),30,0);
        add_action('pdfev_settings_tabs_content',array($this,'tabs_content'));
    }
    public function tabs(){
    ?>
        <button class="nav-tab" data-tab-target="pdfev_emd_vwr_admin_tabs_support">
            <span class="dashicons dashicons-sos" aria-hidden="true"></span>
            <?php echo esc_html__('Support','pdf-embed-viewer'); ?>
        </button>
    <?php
    }
    public function tabs_content() {
    // Handle form submission
    if ( isset($_POST['pev_feature_request_submit']) && check_admin_referer('pev_feature_request_action') ) {
        $name    = isset($_POST['feature_name']) ? sanitize_text_field($_POST['feature_name']) : '';
        $email   = isset($_POST['feature_email']) ? sanitize_email($_POST['feature_email']) : '';
        $message = isset($_POST['feature_message']) ? sanitize_textarea_field($_POST['feature_message']) : '';

        $subject = 'PDF Embed Viewer - Feature Request';
        $body    = "Name: $name\nEmail: $email\nMessage:\n$message";
        $to      = 'raselsha@gmail.com';

        $headers = [ 'Content-Type: text/plain; charset=UTF-8' ];

        if ( wp_mail( $to, $subject, $body, $headers ) ) {
            echo '<div class="notice notice-success is-dismissible"><p>' . esc_html__( 'Thank you! Your feature request has been sent.', 'pdf-embed-viewer' ) . '</p></div>';
        } else {
            echo '<div class="notice notice-error"><p>' . esc_html__( 'Please configure your email then try again.', 'pdf-embed-viewer' ) . '</p></div>';
        }
    }
    ?>

    <div class="pdfev-tab-content" data-tab="pdfev_emd_vwr_admin_tabs_support">
        <div class="pdf-embed-viewer-support">
            <div class="pdfev-support-links">
                <div class="pdfev-card">
                    <div class="pdfev-card-header">
                        <h2><?php esc_html_e( 'Need Help or Want to Share Your Experience?', 'pdf-embed-viewer' ); ?></h2>
                        <p><?php esc_html_e( 'A few quick ways to reach us.', 'pdf-embed-viewer' ); ?></p>
                    </div>
                    <div class="pdfev-card-body">
                        <ul class="pdfev-support-list">
                            <li>
                                <span class="dashicons dashicons-star-filled" aria-hidden="true"></span>
                                <span><?php esc_html_e( 'Give a review for your feedback', 'pdf-embed-viewer' ); ?></span>
                                <a target="_blank" href="<?php echo esc_url( 'https://wordpress.org/support/plugin/pdf-embed-viewer/reviews/#new-post' ); ?>">
                                    <?php esc_html_e( 'Add Review', 'pdf-embed-viewer' ); ?> &rarr;
                                </a>
                            </li>
                            <li>
                                <span class="dashicons dashicons-format-chat" aria-hidden="true"></span>
                                <span><?php esc_html_e( 'Create a support ticket', 'pdf-embed-viewer' ); ?></span>
                                <a target="_blank" href="<?php echo esc_url( 'https://wordpress.org/support/plugin/pdf-embed-viewer/' ); ?>">
                                    <?php esc_html_e( 'Support', 'pdf-embed-viewer' ); ?> &rarr;
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="pdfev-card pdfev-support-form-wrap">
                    <div class="pdfev-card-header">
                        <h2><?php esc_html_e( 'Feature Request Form', 'pdf-embed-viewer' ); ?></h2>
                        <p><?php esc_html_e( 'Tell us what you would like to see next.', 'pdf-embed-viewer' ); ?></p>
                    </div>
                    <div class="pdfev-card-body">
                        <form method="post">
                            <?php wp_nonce_field( 'pev_feature_request_action' ); ?>

                            <div class="pdfev-field-row pdfev-field-row--stacked">
                                <label for="feature_name"><?php esc_html_e( 'Your Name', 'pdf-embed-viewer' ); ?></label>
                                <input type="text" id="feature_name" name="feature_name" required class="pdfev-full-width-input">
                            </div>

                            <div class="pdfev-field-row pdfev-field-row--stacked">
                                <label for="feature_email"><?php esc_html_e( 'Your Email', 'pdf-embed-viewer' ); ?></label>
                                <input type="email" id="feature_email" name="feature_email" required class="pdfev-full-width-input">
                            </div>

                            <div class="pdfev-field-row pdfev-field-row--stacked">
                                <label for="feature_message"><?php esc_html_e( 'Feature Description', 'pdf-embed-viewer' ); ?></label>
                                <textarea id="feature_message" name="feature_message" rows="5" required class="pdfev-full-width-input"></textarea>
                            </div>

                            <div class="pdfev-form-footer">
                                <button type="submit" name="pev_feature_request_submit" class="pdfev-btn pdfev-btn-primary">
                                    <?php esc_html_e( 'Send Request', 'pdf-embed-viewer' ); ?>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
}

new \PDFEV\Support_Settings();
