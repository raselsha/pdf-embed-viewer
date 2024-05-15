<div class="wrap">
    <h2><?php esc_html_e(get_admin_page_title()); ?></h2>
    <h2 class="nav-tab-wrapper">
        <?php
            $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'settings' ;
        ?>
        <a href="?post_type=pdf-embed-viewer&page=settings&tab=settings" class="nav-tab <?php esc_attr_e(($active_tab=='settings') ? 'nav-tab-active' : '' ); ?>">Settings</a>
        <a href="?post_type=pdf-embed-viewer&page=settings&tab=support" class="nav-tab <?php esc_attr_e(($active_tab=='support') ? 'nav-tab-active' : '' ); ?>">Support</a>
    </h2>
    <form action="options.php" method="post">
        <?php settings_fields('pdfdownload_group'); ?>
        <?php if($active_tab=='settings'): ?>
            <?php do_settings_sections('page1'); ?>
            <?php submit_button('Save'); ?>
        <?php else: ?> 
            <?php do_settings_sections('page2'); ?>  
             
        <?php endif; ?>    
        
    </form>
</div>