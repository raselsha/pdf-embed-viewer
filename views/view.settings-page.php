<div class="wrap">
    <h2><?php esc_html_e(get_admin_page_title()); ?></h2>
    <form action="options.php" method="post">
        <?php settings_fields('newsletter_publisher_group'); ?>
        <?php do_settings_sections('page1'); ?>
        <?php submit_button('Save'); ?>
    </form>
</div>