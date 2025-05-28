<?php
/**
 * @author Shahadat Hossain <raselsha@gmail.com>
 * @version 1.0.0
 * @since 1.0.9
 */
if( ! defined( 'ABSPATH' ) ) die;
if( ! class_exists( 'PDFEV_Template' ) ){
    class PDFEV_Template{

        public function __construct() {
            add_action('pdfev_template_archive_title', [$this,'template_archive_title']);
            add_action('pdfev_template_archive_view', [$this,'template_archive_view']);
            add_action('pdfev_template_archive_list', [$this,'template_archive_list']);
            add_action('pdfev_template_archive_grid', [$this,'template_archive_grid']);
            add_action('pdfev_template_archive_newsletter', [$this,'template_archive_newsletter']);
            add_action('pdfev_template_archive_ebook', [$this,'template_archive_ebook']);

            add_action('pdfev_template_single_header', [$this,'template_single_header']);
            // add_action('pdfev_template_book_reader', [$this,'template_single_book_reader']);
            add_action('pdfev_template_single_footer', [$this,'template_single_footer']);
        } 

        public function template_archive_view($atts){
            $template = get_option('pdfev_archive_template'); 
            $load_template = $template.'.php';
            require PDFEV_Functions::load_template($load_template);  
        }

        public function template_archive_title(){
            ?>
            <h2><?php PDFEV_Functions::archive_title(); ?></h2>
            <?php 
        }

        public function template_archive_list($atts=[]){
        ?>
        <div class="pdfev-embed-viewer">
            <div class="archive-list-style">
                <table>
                    <tr>
                        <th><?php echo esc_html__('Title','pdf-embed-viewer') ?></th>
                        <th><?php echo esc_html__('Date','pdf-embed-viewer') ?></th>
                        <th></th>
                    </tr>
                    <?php
                        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                        $args = array(
                        'post_type'=>PDFEV_Functions::get_cpt_name(),
                        'post_status' => 'publish',
                        'order' => isset($atts['order'])? $atts['order'] : PDFEV_Functions::get_post_order(),
                        'posts_per_page'=> isset($atts['limit'])? $atts['limit'] : get_option( 'posts_per_page' ),
                        'paged' => $paged
                    );
                    $WpQuery = new WP_Query($args);    
                        while ( $WpQuery->have_posts() ) :
                            $WpQuery->the_post();
                            ?>
                            <tr>
                                <td><a href="<?php the_permalink(); ?>"><?php the_title();?></a></td>
                                <td><?php the_time(get_option('date_format')); ?></td>
                                <td>
                                    <?php PDFEV_Functions::read_button($atts); ?>
                                    <?php PDFEV_Functions::download_button($atts); ?>
                                </td>
                            </tr>
                    <?php endwhile; ?>
                </table>
                <?php $this->pagination($WpQuery);?>
            </div>
        </div>
        <?php 
        }

        public function template_archive_grid($atts=[]){
        ?>
        <div class="pdfev-embed-viewer">
            <div class="archive-grid-style">
                <?php
                    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                    $args = array(
                    'post_type'=>PDFEV_Functions::get_cpt_name(),
                    'order' => isset($atts['order'])? $atts['order'] : PDFEV_Functions::get_post_order(),
                    'post_status' => 'publish',
                    'posts_per_page'=> isset($atts['limit'])? $atts['limit'] : get_option( 'posts_per_page' ),
                    'paged' => $paged
                );
                $WpQuery = new WP_Query($args);    
                    while ( $WpQuery->have_posts() ) :
                        $WpQuery->the_post();
                        ?>
                        <div class="grid-item">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"> 
                                <div class="image">
                                    <?php the_post_thumbnail() ?>
                                    <span class="date"><?php the_time('d-m-Y'); ?></span>
                                </div>
                            </a>
                            <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"> 
                                <?php
                                    $title = get_the_title(); 
                                    $trimmed_title = wp_html_excerpt($title, 80, '...');
                                    echo esc_html($trimmed_title);
                                ?>
                            </a></h2>
                            <div class="action">
                                <?php PDFEV_Functions::read_button($atts); ?>
                                <?php PDFEV_Functions::download_button($atts); ?>
                            </div>
                        </div>
                <?php endwhile; ?>
            </div>
            <?php $this->pagination($WpQuery);?>
        </div>
        <?php 
        }

        public function template_archive_newsletter($atts=[]){
            $years =  PDFEV_CPT::get_posts_years_array();
        ?>
        <div class="pdfev-embed-viewer">
            <?php if($years): ?>
                <div class="archive-newsletter-style">
                    <ul class="tabs">
                        <?php 
                            foreach($years as $year): ?>
                                <li class="tab <?php echo esc_attr($year==gmdate('Y')?'active':''); ?>" data-tab-target="#year-<?php echo esc_attr($year);?>" ><?php echo esc_attr($year);?></li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="tabs-content" >
                        <?php foreach($years as $year): ?>
                            <table  class="<?php echo esc_attr($year==gmdate('Y')?'active':''); ?>" data-tab-content  id="year-<?php echo esc_attr($year);?>">
                                <thead>
                                    <tr>         					    			
                                        <th width="10%"><?php echo esc_html__('Month','pdf-embed-viewer') ?></th>
                                        <th width="50%"><?php echo esc_html__('Title','pdf-embed-viewer') ?></th>
                                        <th width="40%" style="text-align: right;"></th>
                                    </tr>
                                </thead>
                                <?php
                                    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                                    $args = array(
                                    'post_type'=>PDFEV_Functions::get_cpt_name(),
                                    'order' => isset($atts['order'])? $atts['order'] : PDFEV_Functions::get_post_order(),
                                    'post_status' => 'publish',
                                    'posts_per_page'=> isset($atts['limit'])? $atts['limit'] : get_option( 'posts_per_page' ),
                                    'paged' => $paged,
                                    'date_query' => array(
                                        array(
                                            'year'  => $year,
                                        ),
                                    ),
                                );
                                $WpQuery = new WP_Query($args);    
                                    while ( $WpQuery->have_posts() ) :
                                        $WpQuery->the_post();
                                        ?>
                                        <tr>
                                            <td><?php the_time('F'); ?></td>
                                            <td><a href="<?php the_permalink(); ?>"><?php the_title();?></a></td>
                                            <td  style="text-align: right;">
                                                <?php PDFEV_Functions::read_button($atts); ?>
                                                <?php PDFEV_Functions::download_button($atts); ?>
                                            </td>

                                        </tr>
                                <?php endwhile; ?>
                                
                            </table>
                            
                        <?php endforeach; ?>
                            
                    </div>
                    
                </div>
            <?php else: ?>
                <h2><?php echo esc_html('No data found','pdf-embed-viewer'); ?></h2>
            <?php endif; ?>
        </div>
        <?php
        }

        public function template_archive_ebook($atts=[]){
        ?>
        <div class="pdfev-embed-viewer">
            <div class="archive-ebook-style">
                <?php
                    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                    $args = array(
                    'post_type'=>PDFEV_Functions::get_cpt_name(),
                    'order' => isset($atts['order'])? $atts['order'] : PDFEV_Functions::get_post_order(),
                    'post_status' => 'publish',
                    'posts_per_page'=> isset($atts['limit'])? $atts['limit'] : get_option( 'posts_per_page' ),
                    'paged' => $paged
                );
                $WpQuery = new WP_Query($args);    
                    while ( $WpQuery->have_posts() ) :
                        $WpQuery->the_post();
                        ?>
                        <div class="grid-item">
                            <a href="<?php the_permalink(); ?>">
                                <div class="image">
                                    <div class="book">
                                        <div class="front-cover">
                                            <?php the_post_thumbnail('medium'); ?>
                                        </div>
                                    </div>
                                    <div class="pages">
                                        <h2><?php the_title(); ?></h2>
                                    </div>
                                </div>
                            </a>				
                            <div class="content">
                                <h2><a href="<?php the_permalink(); ?>">
                                <?php
                                    $title = get_the_title(); 
                                    $trimmed_title = wp_html_excerpt($title, 80, '...');
                                    echo esc_html($trimmed_title);
                                ?>
                                </a></h2>
                                <div class="action">
                                    <?php PDFEV_Functions::read_button($atts); ?>
                                    <?php PDFEV_Functions::download_button($atts); ?>
                                </div>
                            </div>
                        </div>
                        
                <?php endwhile; ?>
            </div>
            <?php $this->pagination($WpQuery);?>
        </div>
            
        <?php
        }

        public function pagination($WpQuery){
            ?>
                <div class="pagination">
                    <?php PDFEV_CPT::pagination_bar( $WpQuery ); ?>
                </div>
            <?php
        }
        //===================== single view ==================
        public function template_single_header(){
            ?>
            <div class="header">
                <h1><?php the_title();?></h1>
                <div class="action">
                    <?php PDFEV_Functions::back_to_archive();?>
                    <?php  PDFEV_Functions::download_button_page_view(get_the_ID()); ?>
                </div>
            </div>
            
            <div class="navigation">
                <?php previous_post_link('%link','&larr;'.__(' Previous','pdf-embed-viewer') ); ?>
                <?php next_post_link('%link',__('Next ','pdf-embed-viewer').' &rarr;' ); ?>
            </div>
            <?php
        }
        public function template_single_book_reader(){
            $post_id = get_the_ID();
            $flipbook = get_option('pdfev_flipbook_status');
            $flipbook = $flipbook ? $flipbook : 'yes';
        ?>  
            <div class="pdfev-display-switcher">
                <div class="toggle-button">
                    <a class="button btn pdfev-show-flipbook <?php echo esc_attr($flipbook=='yes'?'active':''); ?>"><i class="fas fa-book-open"></i> <?php _e('Flipbook','pdf-embed-viewer'); ?></a>
                    <a class="button btn pdfev-show-traditional <?php echo esc_attr($flipbook=='yes'?'':'active'); ?>"><i class="fas fa-book"></i> <?php _e('Traditional','pdf-embed-viewer'); ?></a>
                </div>
                <div class="pdfev-3dbook-container" style="display: <?php echo esc_attr($flipbook=='yes'?'block':'none'); ?>;">
                    <div class="pdfev-3dbook-viewer" id="pdfev-3dbook-<?php echo esc_attr($post_id); ?>" data-id="<?php echo esc_attr($post_id); ?>" data-pdfev-url="<?php PDFEV_Functions::pdf_link(); ?>"></div>                
                </div>
                <div class="pdfev-traditional-container" style="display: <?php echo esc_attr($flipbook=='yes'?'none':'block'); ?>;">
                    <iframe class="pdf-viewer" src="<?php PDFEV_Functions::pdf_link(); ?>" frameborder="0"></iframe>
                </div>
            </div>
        <?php
        }

        public function template_single_footer(){
        ?>
            <div class="navigation">
                <?php previous_post_link('%link','&larr;'.__(' Previous','pdf-embed-viewer') ); ?>
                <?php next_post_link('%link',__('Next ','pdf-embed-viewer').' &rarr;' ); ?>
            </div>
        <?php
        }
    }
    new PDFEV_Template();
}