<?php
namespace PDFEV;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * One dismissible "Pro is here" announcement for site admins, after a new
 * install or an update. Shown only on the Dashboard, the Plugins screen and
 * this plugin's own screens, only while the Pro add-on isn't active, and only
 * until that admin closes it (stored per user). Bump ANNOUNCEMENT_ID to show a
 * future announcement to everyone again.
 */
class Pro_Announcement {

    const ANNOUNCEMENT_ID = 'pro-launch-1';
    const USER_META       = 'pdfev_dismissed_notices';
    const NONCE_ACTION    = 'pdfev_dismiss_notice';

    public function __construct() {
        add_action( 'admin_notices', [ $this, 'render' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue' ] );
        add_action( 'wp_ajax_pdfev_dismiss_notice', [ $this, 'ajax_dismiss' ] );
    }

    private function should_show() {
        if ( ! current_user_can( 'manage_options' ) || class_exists( 'PDFEV_Pro_Functions' ) ) {
            return false;
        }
        $dismissed = get_user_meta( get_current_user_id(), self::USER_META, true );
        if ( is_array( $dismissed ) && in_array( self::ANNOUNCEMENT_ID, $dismissed, true ) ) {
            return false;
        }
        $screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;
        if ( ! $screen ) {
            return false;
        }
        return in_array( $screen->id, [ 'dashboard', 'plugins' ], true )
            || ( isset( $screen->post_type ) && 'pdfev_embed_viewer' === $screen->post_type );
    }

    public function enqueue() {
        if ( ! $this->should_show() ) {
            return;
        }
        wp_enqueue_style( 'pdfev-admin-notice', PDFEV_Const_URL . 'assets/css/admin-notice.css', [], PDFEV_Const_VERSION );
        wp_enqueue_script( 'pdfev-admin-notice', PDFEV_Const_URL . 'assets/js/admin-notice.js', [], PDFEV_Const_VERSION, true );
        wp_localize_script( 'pdfev-admin-notice', 'pdfevNotice', [
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'nonce'   => wp_create_nonce( self::NONCE_ACTION ),
        ] );
    }

    public function render() {
        if ( ! $this->should_show() ) {
            return;
        }
        $pro_url     = defined( 'PDFEV_Pro_URL' ) ? PDFEV_Pro_URL : 'https://lieusoft.com/pdf-embed-viewer/#pricing';
        $compare_url = 'https://flipbook.lieusoft.com/#compare';
        ?>
        <div class="notice pdfev-pro-notice" data-notice="<?php echo esc_attr( self::ANNOUNCEMENT_ID ); ?>">
            <div class="pdfev-pro-notice__art" aria-hidden="true">
                <svg viewBox="0 0 120 120" width="96" height="96">
                    <defs>
                        <linearGradient id="pdfevNoticePage" x1="0" y1="0" x2="0" y2="1">
                            <stop offset="0" stop-color="#ffffff"/>
                            <stop offset="1" stop-color="#ede9fe"/>
                        </linearGradient>
                    </defs>
                    <path d="M18 34c13-6 27-6 42 3v58c-15-9-29-9-42-3V34Z" fill="url(#pdfevNoticePage)" opacity=".95"/>
                    <path d="M102 34c-13-6-27-6-42 3v58c15-9 29-9 42-3V34Z" fill="url(#pdfevNoticePage)"/>
                    <path d="M28 48h22M28 57h22M28 66h16M70 48h22M70 57h22M70 66h16" stroke="#c4b5fd" stroke-width="3" stroke-linecap="round"/>
                    <circle cx="86" cy="84" r="20" fill="#1e1b4b"/>
                    <rect x="77" y="82" width="18" height="13" rx="3" fill="#fbbf24"/>
                    <path d="M80.5 82v-4.5a5.5 5.5 0 0 1 11 0V82" fill="none" stroke="#fbbf24" stroke-width="3"/>
                    <circle cx="86" cy="88.5" r="2" fill="#1e1b4b"/>
                </svg>
            </div>
            <div class="pdfev-pro-notice__body">
                <span class="pdfev-pro-notice__eyebrow"><?php esc_html_e( 'New', 'pdf-embed-viewer' ); ?> &middot; Flipbook PDF Viewer &amp; Embedder Pro</span>
                <h2 class="pdfev-pro-notice__title"><?php esc_html_e( 'Let readers flip through your PDFs, without downloading them.', 'pdf-embed-viewer' ); ?></h2>
                <p class="pdfev-pro-notice__text"><?php esc_html_e( 'Pro adds Lockdown: every page stays readable in the flipbook, but there is no file link to copy and no download or print button.', 'pdf-embed-viewer' ); ?></p>
                <ul class="pdfev-pro-notice__features">
                    <li><?php esc_html_e( 'Lockdown download protection', 'pdf-embed-viewer' ); ?></li>
                    <li><?php esc_html_e( 'Studio Light premium reader', 'pdf-embed-viewer' ); ?></li>
                    <li><?php esc_html_e( 'Single-page view on phones', 'pdf-embed-viewer' ); ?></li>
                </ul>
                <div class="pdfev-pro-notice__actions">
                    <a class="pdfev-pro-notice__cta" href="<?php echo esc_url( $pro_url ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Get Pro', 'pdf-embed-viewer' ); ?></a>
                    <a class="pdfev-pro-notice__link" href="<?php echo esc_url( $compare_url ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Compare Free and Pro', 'pdf-embed-viewer' ); ?></a>
                </div>
            </div>
            <button type="button" class="pdfev-pro-notice__close" aria-label="<?php esc_attr_e( 'Dismiss this notice', 'pdf-embed-viewer' ); ?>">
                <svg viewBox="0 0 20 20" width="16" height="16" aria-hidden="true"><path d="M5 5l10 10M15 5L5 15" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
            </button>
        </div>
        <?php
    }

    public function ajax_dismiss() {
        check_ajax_referer( self::NONCE_ACTION, 'nonce' );
        if ( ! current_user_can( 'manage_options' ) ) {
            wp_send_json_error( null, 403 );
        }
        $id = isset( $_POST['notice'] ) ? sanitize_key( wp_unslash( $_POST['notice'] ) ) : '';
        if ( self::ANNOUNCEMENT_ID !== $id ) {
            wp_send_json_error( null, 400 );
        }
        $user_id   = get_current_user_id();
        $dismissed = get_user_meta( $user_id, self::USER_META, true );
        $dismissed = is_array( $dismissed ) ? $dismissed : [];
        if ( ! in_array( $id, $dismissed, true ) ) {
            $dismissed[] = $id;
            update_user_meta( $user_id, self::USER_META, $dismissed );
        }
        wp_send_json_success();
    }
}

new Pro_Announcement();
