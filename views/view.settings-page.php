<div class="wrap">
    <h2><?php esc_html_e(get_admin_page_title()); ?></h2>
    <h2 class="nav-tab-wrapper">
        <?php
            $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'general-info' ;


        ?>
        <a href="?page=newsletter-index&tab=general-info" class="nav-tab <?php esc_attr_e(($active_tab=='general-info') ? 'nav-tab-active' : '' ); ?>">General Info</a>
        <a href="?page=newsletter-index&tab=color-settings" class="nav-tab <?php esc_attr_e(($active_tab=='color-settings') ? 'nav-tab-active' : '' ); ?>">Color Settings</a>
    </h2>
    <form action="options.php" method="post">
        <?php settings_fields('newsletter_publisher_group'); ?>
        <?php if($active_tab=='general-info'): ?>
            <?php do_settings_sections('page1'); ?>
        <?php else: ?> 
            <?php do_settings_sections('page2'); ?>   
        <?php endif; ?>    
        <?php submit_button('Save'); ?>
    </form>
</div>