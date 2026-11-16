<?php
/**
 * Pro add-on promotion, kept light:
 *  - pro_url(): every "Get Pro" link carries UTM tags (so the store can tell
 *    which screen sent the visit) and, where we offer it, the free-user
 *    discount code;
 *  - a "Pro" tab in the PDF editor showing what Pro adds to that document;
 *  - a single thank-you offer for admins who have used the plugin for a
 *    while (14+ days, 3+ published PDFs). It can be dismissed for good or
 *    snoozed for 30 days, and never shows next to the launch announcement.
 *
 * Nothing here runs once the Pro add-on is active.
 *
 * @package pdf-embed-viewer
 */
namespace PDFEV;

defined( 'ABSPATH' ) || exit;

/** Free-user discount: 30% off the first Pro purchase (EDD discount code on lieusoft.com). */
const PRO_OFFER_CODE = 'FLIPBOOK30';

/**
 * The Pro page URL with UTM tags.
 *
 * @param string $medium Where the link sits, e.g. 'plugins-list', 'settings', 'metabox'.
 * @param bool   $offer  Add the free-user discount code (applied at checkout).
 * @return string
 */
function pro_url( $medium, $offer = false ) {
	$base = defined( 'PDFEV_Pro_URL' ) ? PDFEV_Pro_URL : 'https://lieusoft.com/pdf-embed-viewer/#pricing';
	$args = array(
		'utm_source'   => 'pdf-embed-viewer',
		'utm_medium'   => sanitize_key( $medium ),
		'utm_campaign' => $offer ? 'free-user-offer' : 'upgrade',
	);
	if ( $offer ) {
		$args['discount'] = PRO_OFFER_CODE;
	}
	return add_query_arg( $args, $base );
}

class Pro_Offer {

	const NOTICE_ID       = 'pdfev-pro-offer-30';
	const SNOOZE_META     = 'pdfev_pro_offer_snooze';
	const INSTALLED_OPT   = 'pdfev_installed_at';
	const MIN_DAYS        = 14;
	const MIN_PUBLISHED   = 3;

	public function __construct() {
		if ( class_exists( 'PDFEV_Pro_Functions' ) ) {
			return;
		}
		add_action( 'admin_init', array( $this, 'remember_install_date' ) );
		add_action( 'admin_notices', array( $this, 'render_notice' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
		add_action( 'wp_ajax_pdfev_snooze_notice', array( $this, 'ajax_snooze' ) );
		add_action( 'pdfev_metabox_tabs', array( $this, 'metabox_tab' ), 99 );
		add_action( 'pdfev_metabox_tabs_content', array( $this, 'metabox_tab_content' ), 99 );
	}

	/** First time we see an admin request, note the date (existing installs start counting now). */
	public function remember_install_date() {
		if ( ! get_option( self::INSTALLED_OPT ) ) {
			add_option( self::INSTALLED_OPT, time(), '', false );
		}
	}

	private function published_count() {
		$counts = wp_count_posts( 'pdfev_embed_viewer' );
		return isset( $counts->publish ) ? (int) $counts->publish : 0;
	}

	private function should_show_notice() {
		if ( class_exists( 'PDFEV_Pro_Functions' ) || ! current_user_can( 'manage_options' ) ) {
			return false;
		}
		$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;
		if ( ! $screen || ! ( 'dashboard' === $screen->id || ( isset( $screen->post_type ) && 'pdfev_embed_viewer' === $screen->post_type ) ) ) {
			return false;
		}
		$user_id   = get_current_user_id();
		$dismissed = get_user_meta( $user_id, Pro_Announcement::USER_META, true );
		$dismissed = is_array( $dismissed ) ? $dismissed : array();
		// One promotion at a time: wait until the launch announcement is gone.
		if ( in_array( self::NOTICE_ID, $dismissed, true ) || ! in_array( Pro_Announcement::ANNOUNCEMENT_ID, $dismissed, true ) ) {
			return false;
		}
		if ( (int) get_user_meta( $user_id, self::SNOOZE_META, true ) > time() ) {
			return false;
		}
		$installed = (int) get_option( self::INSTALLED_OPT );
		if ( ! $installed || ( time() - $installed ) < self::MIN_DAYS * DAY_IN_SECONDS ) {
			return false;
		}
		return $this->published_count() >= self::MIN_PUBLISHED;
	}

	public function enqueue() {
		if ( ! $this->should_show_notice() ) {
			return;
		}
		wp_enqueue_style( 'pdfev-admin-notice', PDFEV_Const_URL . 'assets/css/admin-notice.css', array(), PDFEV_Const_VERSION );
		wp_enqueue_script( 'pdfev-admin-notice', PDFEV_Const_URL . 'assets/js/admin-notice.js', array(), PDFEV_Const_VERSION, true );
		wp_localize_script( 'pdfev-admin-notice', 'pdfevNotice', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'nonce'   => wp_create_nonce( Pro_Announcement::NONCE_ACTION ),
		) );
	}

	public function render_notice() {
		if ( ! $this->should_show_notice() ) {
			return;
		}
		$count = $this->published_count();
		?>
		<div class="notice pdfev-pro-notice pdfev-pro-notice--offer" data-notice="<?php echo esc_attr( self::NOTICE_ID ); ?>">
			<div class="pdfev-pro-notice__art pdfev-pro-notice__art--offer" aria-hidden="true">
				<span>30%</span><small><?php esc_html_e( 'off', 'pdf-embed-viewer' ); ?></small>
			</div>
			<div class="pdfev-pro-notice__body">
				<span class="pdfev-pro-notice__eyebrow"><?php esc_html_e( 'Thank you for using Flipbook PDF Viewer', 'pdf-embed-viewer' ); ?></span>
				<h2 class="pdfev-pro-notice__title">
					<?php
					/* translators: %s: number of published PDFs */
					echo esc_html( sprintf( _n( 'You have published %s flipbook. Here is 30%% off Pro.', 'You have published %s flipbooks. Here is 30%% off Pro.', $count, 'pdf-embed-viewer' ), number_format_i18n( $count ) ) );
					?>
				</h2>
				<p class="pdfev-pro-notice__text">
					<?php
					/* translators: %s: discount code */
					echo esc_html( sprintf( __( 'Use code %s for 30%% off your first Pro purchase: on-brand toolbar skins, hidden PDF links and full download control. 14-day money-back guarantee.', 'pdf-embed-viewer' ), PRO_OFFER_CODE ) );
					?>
				</p>
				<div class="pdfev-pro-notice__actions">
					<a class="pdfev-pro-notice__cta" href="<?php echo esc_url( pro_url( 'offer-notice', true ) ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Get 30% off', 'pdf-embed-viewer' ); ?></a>
					<button type="button" class="pdfev-pro-notice__link pdfev-pro-notice__later"><?php esc_html_e( 'Remind me later', 'pdf-embed-viewer' ); ?></button>
				</div>
			</div>
			<button type="button" class="pdfev-pro-notice__close" aria-label="<?php esc_attr_e( 'Dismiss this notice', 'pdf-embed-viewer' ); ?>">
				<svg viewBox="0 0 20 20" width="16" height="16" aria-hidden="true"><path d="M5 5l10 10M15 5L5 15" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
			</button>
		</div>
		<?php
	}

	/** "Remind me later": hide the offer for 30 days for this admin. */
	public function ajax_snooze() {
		check_ajax_referer( Pro_Announcement::NONCE_ACTION, 'nonce' );
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error( null, 403 );
		}
		update_user_meta( get_current_user_id(), self::SNOOZE_META, time() + 30 * DAY_IN_SECONDS );
		wp_send_json_success();
	}

	public function metabox_tab( $post_id ) {
		?>
		<li class="pdfev-tab pdfev-tab--pro" data-tab-target="pdfev-tabs-pro">
			<span class="dashicons dashicons-lock" aria-hidden="true"></span>
			<?php esc_html_e( 'Pro', 'pdf-embed-viewer' ); ?>
		</li>
		<?php
	}

	public function metabox_tab_content( $post_id ) {
		$items = array(
			array( __( 'Lockdown: no file link, no download or print', 'pdf-embed-viewer' ), __( 'Readers flip through every page, but there is nothing to copy or save.', 'pdf-embed-viewer' ) ),
			array( __( 'Hide the file URL', 'pdf-embed-viewer' ), __( 'The PDF is streamed through a short-lived protected link instead of its real address.', 'pdf-embed-viewer' ) ),
			array( __( 'Download button for this PDF only', 'pdf-embed-viewer' ), __( 'Show, hide or protect the download button document by document.', 'pdf-embed-viewer' ) ),
			array( __( 'Studio Light premium toolbar', 'pdf-embed-viewer' ), __( 'Page slider, thumbnails, contents and search panels, in your brand colours.', 'pdf-embed-viewer' ) ),
		);
		?>
		<div class="pdfev-tab-content" data-tab="pdfev-tabs-pro">
			<div class="pdfev-metabox-section-header">
				<h2><?php esc_html_e( 'Protect and brand this flipbook with Pro', 'pdf-embed-viewer' ); ?></h2>
				<p><?php esc_html_e( 'The Pro add-on installs next to this plugin and switches these on for this document.', 'pdf-embed-viewer' ); ?></p>
			</div>
			<div class="pdfev-metabox-section-body">
				<ul class="pdfev-pro-features">
					<?php foreach ( $items as $item ) : ?>
						<li>
							<strong><span class="dashicons dashicons-lock" aria-hidden="true"></span> <?php echo esc_html( $item[0] ); ?> <span class="pdfev-pro-badge"><?php esc_html_e( 'PRO', 'pdf-embed-viewer' ); ?></span></strong>
							<span><?php echo esc_html( $item[1] ); ?></span>
						</li>
					<?php endforeach; ?>
				</ul>
				<div class="pdfev-pro-upsell">
					<span class="dashicons dashicons-tag" aria-hidden="true"></span>
					<span>
						<?php
						/* translators: %s: discount code */
						echo esc_html( sprintf( __( '30%% off your first purchase with code %s · 14-day money-back guarantee', 'pdf-embed-viewer' ), PRO_OFFER_CODE ) );
						?>
					</span>
					<a href="<?php echo esc_url( pro_url( 'metabox', true ) ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Unlock with Pro', 'pdf-embed-viewer' ); ?></a>
				</div>
			</div>
		</div>
		<?php
	}
}

new Pro_Offer();
