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
            add_action('pdfev_template_archive_view', [$this,'template_archive_view']);
            add_action('pdfev_template_archive_title', [$this,'template_archive_title']);
            add_action('pdfev_template_archive_list', [$this,'template_archive_list']);
            add_action('pdfev_template_archive_grid', [$this,'template_archive_grid']);
            add_action('pdfev_template_archive_newsletter', [$this,'template_archive_newsletter']);
        } 

        public function template_archive_view(){
            $template = get_option('pdfev_archive_template'); 
            $load_template = $template.'.php';
            require PDFEV_Functions::load_template($load_template);  
        }

        public function template_archive_title(){
            ?>
            <h2><?php PDFEV_Functions::archive_title(); ?></h2>
            <?php 
        }

        public function template_archive_list(){
        ?>
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
                    'order' => PDFEV_Functions::get_post_order(),
                    'posts_per_page'=> get_option( 'posts_per_page' ),
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
                                <?php PDFEV_Functions::read_button(); ?>
                                <?php PDFEV_Functions::download_button(); ?>
                            </td>
                        </tr>
                <?php endwhile; ?>
            </table>
        </div>
        <?php 
        }

        public function template_archive_grid(){
        ?>
            <div class="archive-grid-style">
                <?php
                    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                    $args = array(
                    'post_type'=>PDFEV_Functions::get_cpt_name(),
                    'order' => PDFEV_Functions::get_post_order(),
                    'post_status' => 'publish',
                    'posts_per_page'=> get_option( 'posts_per_page' ),
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
                                <?php PDFEV_Functions::read_button(); ?>
                                <?php PDFEV_Functions::download_button(); ?>
                            </div>
                        </div>
                <?php endwhile; ?>
            </div>
        <?php 
        }

        public function template_archive_newsletter(){
            $years =  PDFEV_CPT::get_posts_years_array();
        ?>
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
                                        <th><?php echo esc_html__('Month','pdf-embed-viewer') ?></th>
                                        <th><?php echo esc_html__('Title','pdf-embed-viewer') ?></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <?php
                                    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                                    $args = array(
                                    'post_type'=>PDFEV_Functions::get_cpt_name(),
                                    'order' => PDFEV_Functions::get_post_order(),
                                    'post_status' => 'publish',
                                    'posts_per_page'=> -1,
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
                                            <td width="10%"><?php the_time('F'); ?></td>
                                            <td width="60%"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></td>
                                            <td width="28%" style="text-align: right;">
                                                <?php PDFEV_Functions::read_button(); ?>
                                                <?php PDFEV_Functions::download_button(); ?>
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
        <?php
        }
    }
    new PDFEV_Template();
}