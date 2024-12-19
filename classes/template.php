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
        <?php 
        }

    }
    new PDFEV_Template();
}