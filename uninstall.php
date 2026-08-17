<?php
defined( 'WP_UNINSTALL_PLUGIN' ) || exit;

// Adding this file makes WordPress ignore the register_uninstall_hook()
// call in pdf-embed-viewer.php entirely, so that cleanup is repeated here.
unregister_post_type( 'pdfev_embed_viewer' );
delete_option( 'pdfev_archive_template_lists' );
delete_option( 'pdfev_archive_title' );
delete_option( 'pdfev_archive_slug' );
delete_option( 'pdfev_archive_template' );
delete_option( 'pdfev_archive_download' );
delete_option( 'pdfev_css_colors' );

require_once __DIR__ . '/vendor/appneck/wordpress-sdk/appneck-sdk.php';

\Appneck\Sdk\Sdk::uninstall(
    'pk_NurTf7YKoxbzurJTlG7CQyTPWX73xLQe',
    'sk_zZXfQb1i30owdpbZCKbuCeJjMrnW1gx7qzp2NqhyoNJmeXRk',
    'https://appneck.com'
);
