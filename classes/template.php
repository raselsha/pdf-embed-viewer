<?php
/**
 * @author Shahadat Hossain <raselsha@gmail.com>
 * @version 1.0.1
 * @since 1.0.9
 */
namespace PDFEV;
defined('ABSPATH') || exit;
class Template{

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
        require \PDFEV_Functions::load_template($load_template);  
    }

    public function template_archive_title(){
        ?>
        <h2><?php \PDFEV_Functions::archive_title(); ?></h2>
        <?php 
    }

    public static function get_archive_query($atts = [], $paged = 1) {
        $args = array(
            'post_type'=> \PDFEV_Functions::get_cpt_name(),
            'post_status' => 'publish',
            'order' => isset($atts['order']) && $atts['order'] !== '' ? $atts['order'] : \PDFEV_Functions::get_post_order(),
            'posts_per_page'=> isset($atts['limit']) && absint($atts['limit']) ? absint($atts['limit']) : get_option( 'posts_per_page' ),
            'paged' => $paged,
        );

        if ( ! empty( $atts['category'] ) ) {
            $field = 'slug';
            if ( is_numeric( $atts['category'] ) ) {
                $field = 'term_id';
            } elseif ( strpos( $atts['category'], ' ' ) !== false ) {
                $field = 'name';
            }

            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'pdfev_category',
                    'field'    => $field,
                    'terms'    => $atts['category'],
                ),
            );
        }

        if ( ! empty( $atts['year'] ) ) {
            $args['date_query'] = array(
                array(
                    'year' => absint($atts['year']),
                ),
            );
        }

        return new \WP_Query($args);
    }

    public static function render_archive_list_items($WpQuery, $atts = []){
        if ( $WpQuery->have_posts() ) :
            while ( $WpQuery->have_posts() ) : $WpQuery->the_post();
                ?>
                <div class="list-item">
                    <div class="list-image">
                        <a href="<?php echo esc_url( get_permalink() ); ?>">
                            <?php the_post_thumbnail('medium'); ?>
                        </a>
                    </div>
                    <div class="list-content">
                        <h2><a href="<?php echo esc_url( get_permalink() ); ?>">
                            <?php echo esc_html( get_the_title() ); ?>
                        </a></h2>
                        <div class="list-description">
                            <?php echo esc_html( get_the_excerpt() ); ?>
                        </div>
                        <?php \PDFEV_Functions::archive_item_meta($atts); ?>
                        <div class="list-actions">
                            <?php \PDFEV_Functions::read_button($atts); ?>
                            <?php \PDFEV_Functions::download_button($atts); ?>
                        </div>
                    </div>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
        else:
            echo '<div class="pdfev-no-results">' . esc_html__( 'No PDF found', 'pdf-embed-viewer' ) . '</div>';
        endif;
    }

    public static function render_archive_grid_items($WpQuery, $atts = []){
        if ( $WpQuery->have_posts() ) :
            while ( $WpQuery->have_posts() ) : $WpQuery->the_post();
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
                    <?php \PDFEV_Functions::archive_item_meta($atts); ?>
                    <div class="action">
                        <?php \PDFEV_Functions::read_button($atts); ?>
                        <?php \PDFEV_Functions::download_button($atts); ?>
                    </div>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
        else:
            echo '<div class="pdfev-no-results">' . esc_html__( 'No PDF found', 'pdf-embed-viewer' ) . '</div>';
        endif;
    }

    public static function render_archive_ebook_items($WpQuery, $atts = []){
        if ( $WpQuery->have_posts() ) :
            while ( $WpQuery->have_posts() ) : $WpQuery->the_post();
                // The hover effect swings the cover open like a physical book —
                // hinged on the left by default (LTR). An RTL document's cover
                // physically opens from the right, so the animation mirrors
                // per-item to match, same pdfev_meta_rtl flag the single-view
                // reader and its Previous/Next arrows already key off of.
                $is_rtl = get_post_meta( get_the_ID(), 'pdfev_meta_rtl', true ) === 'yes';
                ?>
                <div class="grid-item">
                    <a href="<?php the_permalink(); ?>">
                        <?php
                        // data-pdfev-src feeds the hover preview below (frontend.js
                        // renders this document's actual page 2 into the .pages
                        // panel via pdf.js) — get_pdf_link() already resolves to the
                        // same-origin proxy for cross-origin files, so pdf.js's own
                        // fetch never hits a CORS wall here.
                        $pdf_src = \PDFEV_Functions::get_pdf_link( get_the_ID() );
                        ?>
                        <div class="image<?php echo $is_rtl ? ' pdfev-book-rtl' : ''; ?>" data-pdfev-src="<?php echo esc_url( $pdf_src ); ?>">
                            <div class="book">
                                <div class="front-cover">
                                    <?php the_post_thumbnail('medium'); ?>
                                </div>
                            </div>
                            <div class="pages">
                                <span class="pdfev-peek-spinner" aria-hidden="true"></span>
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
                        <?php \PDFEV_Functions::archive_item_meta($atts); ?>
                        <div class="action">
                            <?php \PDFEV_Functions::read_button($atts); ?>
                            <?php \PDFEV_Functions::download_button($atts); ?>
                        </div>
                    </div>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
        else:
            echo '<div class="pdfev-no-results">' . esc_html__( 'No PDF found', 'pdf-embed-viewer' ) . '</div>';
        endif;
    }

    public static function render_archive_newsletter_items($WpQuery, $atts = []){
        if ( $WpQuery->have_posts() ) :
            while ( $WpQuery->have_posts() ) : $WpQuery->the_post();
                ?>
                <tr>
                    <td><?php the_time('F'); ?></td>
                    <td>
                        <a href="<?php the_permalink(); ?>"><?php the_title();?></a>
                        <?php \PDFEV_Functions::archive_item_meta($atts); ?>
                    </td>
                    <td style="text-align: right;">
                        <?php \PDFEV_Functions::read_button($atts); ?>
                        <?php \PDFEV_Functions::download_button($atts); ?>
                    </td>
                </tr>
                <?php
            endwhile;
            wp_reset_postdata();
        endif;
    }

    public static function render_load_more_button($atts, $paged, $max_pages, $template = 'grid'){
        if ( $max_pages <= $paged ) {
            return;
        }

        $next_page = $paged + 1;
        $year = isset($atts['year']) ? sanitize_text_field($atts['year']) : '';
        ?>
        <div class="pdfev-load-more-wrap">
            <button type="button" class="button btn pdfev-load-more-button" 
                data-template="<?php echo esc_attr($template); ?>"
                data-next-page="<?php echo esc_attr($next_page); ?>"
                data-category="<?php echo esc_attr($atts['category'] ?? ''); ?>"
                data-limit="<?php echo esc_attr($atts['limit'] ?? ''); ?>"
                data-order="<?php echo esc_attr($atts['order'] ?? ''); ?>"
                data-read="<?php echo esc_attr($atts['read'] ?? ''); ?>"
                data-download="<?php echo esc_attr($atts['download'] ?? ''); ?>"
                data-show-description="<?php echo esc_attr($atts['show_description'] ?? ''); ?>"
                data-show-author="<?php echo esc_attr($atts['show_author'] ?? ''); ?>"
                data-show-publisher="<?php echo esc_attr($atts['show_publisher'] ?? ''); ?>"
                data-show-year="<?php echo esc_attr($atts['show_year'] ?? ''); ?>"
                data-show-edition="<?php echo esc_attr($atts['show_edition'] ?? ''); ?>"
                data-show-total-pages="<?php echo esc_attr($atts['show_total_pages'] ?? ''); ?>"
                data-show-filesize="<?php echo esc_attr($atts['show_filesize'] ?? ''); ?>"
                data-year="<?php echo esc_attr($year); ?>"
            >
                <?php echo esc_html__( 'Load More', 'pdf-embed-viewer' ); ?>
            </button>
        </div>
        <?php
    }

    public function template_archive_list($atts=[]){
    ?>
    <div class="pdfev-embed-viewer">
        <div class="archive-list-style">
            <div class="pdfev-load-more-items">
                <?php
                    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                    $WpQuery = self::get_archive_query($atts, $paged);
                ?>
                <?php self::render_archive_list_items($WpQuery, $atts); ?>
            </div>
            <?php self::render_load_more_button($atts, $paged, $WpQuery->max_num_pages, 'list'); ?>
        </div>
    </div>
    <?php 
    }

    public function template_archive_grid($atts=[]){
    ?>
    <div class="pdfev-embed-viewer">
        <div class="archive-grid-style">
            <div class="pdfev-load-more-items">
                <?php
                    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                    $WpQuery = self::get_archive_query($atts, $paged);
                ?>
                <?php self::render_archive_grid_items($WpQuery, $atts); ?>
            </div>
            <?php self::render_load_more_button($atts, $paged, $WpQuery->max_num_pages, 'grid'); ?>
        </div>
    </div>
    <?php 
    }

    public function template_archive_newsletter($atts=[]){
        $years =  \PDFEV\CPT::get_posts_years_array();
    ?>
    <div class="pdfev-embed-viewer">
        <?php if($years): ?>
            <div class="archive-newsletter-style pdfev-load-more-items">
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
                                'post_type'=> \PDFEV_Functions::get_cpt_name(),
                                'order' => isset($atts['order'])? $atts['order'] : \PDFEV_Functions::get_post_order(),
                                'post_status' => 'publish',
                                'posts_per_page'=> isset($atts['limit'])? $atts['limit'] : get_option( 'posts_per_page' ),
                                'paged' => $paged,
                                'date_query' => array(
                                    array(
                                        'year'  => $year,
                                    ),
                                ),
                            );
                            if ( ! empty( $atts['category'] ) ) {
                                $field = 'slug';
                                if ( is_numeric( $atts['category'] ) ) {
                                    $field = 'term_id';
                                } elseif ( strpos( $atts['category'], ' ' ) !== false ) {
                                    $field = 'name';
                                }

                                $args['tax_query'] = array(
                                    array(
                                        'taxonomy' => 'pdfev_category',
                                        'field'    => $field,
                                        'terms'    => $atts['category'],
                                    ),
                                );
                            }
                            $WpQuery = new \WP_Query($args);    
                                while ( $WpQuery->have_posts() ) :
                                    $WpQuery->the_post();
                                    ?>
                                    <tr>
                                        <td><?php the_time('F'); ?></td>
                                        <td>
                                            <a href="<?php the_permalink(); ?>"><?php the_title();?></a>
                                            <?php \PDFEV_Functions::archive_item_meta($atts); ?>
                                        </td>
                                        <td  style="text-align: right;">
                                            <?php \PDFEV_Functions::read_button($atts); ?>
                                            <?php \PDFEV_Functions::download_button($atts); ?>
                                        </td>

                                    </tr>
                            <?php endwhile; ?>
                            
                        </table>
                        <?php self::render_load_more_button(array_merge($atts, ['year' => $year]), $paged, $WpQuery->max_num_pages, 'newsletter'); ?>
                    
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
            <div class="pdfev-load-more-items">
                <?php
                    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                    $WpQuery = self::get_archive_query($atts, $paged);
                ?>
                <?php self::render_archive_ebook_items($WpQuery, $atts); ?>
            </div>
            <?php self::render_load_more_button($atts, $paged, $WpQuery->max_num_pages, 'ebook'); ?>
        </div>
    </div>
    <?php
    }

    //===================== single view ==================
    public function template_single_header(){
        // For an RTL document, "forward" reads right-to-left — Previous
        // should point the way the pages turn backward (right) and Next the
        // way they turn forward (left), the mirror of the LTR default. The
        // arrow's side of its label flips right along with it (a left arrow
        // always sits left of its text, a right arrow always sits right of
        // its text) — not fixed by Previous/Next role, which used to leave a
        // right-pointing arrow stranded on the left of "Previous" once RTL
        // swapped only the glyph and not its position.
        $rtl = get_post_meta(get_the_ID(), 'pdfev_meta_rtl', true) === 'yes';
        if ($rtl) {
            $prev_label = __('Previous','pdf-embed-viewer').' &rarr;';
            $next_label = '&larr; '.__('Next','pdf-embed-viewer');
        } else {
            $prev_label = '&larr; '.__('Previous','pdf-embed-viewer');
            $next_label = __('Next','pdf-embed-viewer').' &rarr;';
        }
        ?>
        <div class="header">
            <h1><?php the_title();?></h1>
            <div class="action">
                <?php \PDFEV_Functions::back_to_archive();?>
                <?php \PDFEV_Functions::download_button_single_page_view(get_the_ID()); ?>
            </div>
        </div>

        <div class="navigation">
            <?php previous_post_link('%link',$prev_label); ?>
            <?php next_post_link('%link',$next_label); ?>
        </div>
        <?php
    }
    public function template_single_book_reader(){
        $post_id = get_the_ID();
        $link = \PDFEV_Functions::get_pdf_link($post_id);
        $is_protected = apply_filters('pdfev_pdf_is_protected', false, $post_id);
        $display_link = $is_protected ? '' : $link;
        $rtl = get_post_meta($post_id, 'pdfev_meta_rtl', true) === 'yes';
        $flipbook = get_option('pdfev_flipbook_status');
        $flipbook = $flipbook ? $flipbook : 'yes';
    ?>
        <div class="pdfev-display-switcher">
            <div class="toggle-button">
                <a class="button btn pdfev-show-flipbook <?php echo esc_attr($flipbook=='yes'?'active':''); ?>"><i class="fas fa-book-open"></i> <?php _e('Flipbook','pdf-embed-viewer'); ?></a>
                <a class="button btn pdfev-show-traditional <?php echo esc_attr($flipbook=='yes'?'':'active'); ?>"><i class="fas fa-book"></i> <?php _e('Traditional','pdf-embed-viewer'); ?></a>
            </div>
            <div class="pdfev-3dbook-container" style="display: <?php echo esc_attr($flipbook=='yes'?'block':'none'); ?>;">
                <div class="pdfev-3dbook-viewer" id="pdfev-3dbook-<?php echo esc_attr($post_id); ?>" data-id="<?php echo esc_attr($post_id); ?>" data-pdfev-url="<?php echo esc_attr($display_link); ?>" data-pdfev-rtl="<?php echo $rtl ? 'yes' : 'no'; ?>" <?php echo $is_protected ? 'data-pdfev-protected="yes"' : ''; ?>></div>
            </div>
            <div class="pdfev-traditional-container" style="display: <?php echo esc_attr($flipbook=='yes'?'none':'block'); ?>;">
                <iframe class="pdf-viewer" data-id="<?php echo esc_attr($post_id); ?>" src="<?php echo esc_attr($display_link); ?>" <?php echo $is_protected ? 'data-pdfev-protected="yes"' : ''; ?> frameborder="0"></iframe>
            </div>
        </div>
    <?php
    }

    public function template_single_footer(){
        // See template_single_header() — same reasoning, kept as its own
        // copy rather than shared since this hooks a separate action.
        $rtl = get_post_meta(get_the_ID(), 'pdfev_meta_rtl', true) === 'yes';
        if ($rtl) {
            $prev_label = __('Previous','pdf-embed-viewer').' &rarr;';
            $next_label = '&larr; '.__('Next','pdf-embed-viewer');
        } else {
            $prev_label = '&larr; '.__('Previous','pdf-embed-viewer');
            $next_label = __('Next','pdf-embed-viewer').' &rarr;';
        }
    ?>
        <div class="navigation">
            <?php previous_post_link('%link',$prev_label); ?>
            <?php next_post_link('%link',$next_label); ?>
        </div>
    <?php
    }
}
new \PDFEV\Template();
