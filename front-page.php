<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Tech Blogging
 */
get_header();

$show_hide_banner_section = get_theme_mod('tech_blogging_section_show_hide', true);

if (true === $show_hide_banner_section) {
    get_template_part('template-parts/banner/banner', 'section');
}
?>
    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <?php do_action('tech_blogging_before_default_page'); ?>
            <h5><?php pll_e('Best SaaS software in'); ?><?php echo date('Y') ?></h5>
            <div class="posts-container">
                <?php
                $the_query = new WP_Query(
                    [
                        'post_type' => 'reviews',
                        'order' => 'ASC'
                    ]
                );
                if ($the_query->have_posts()) :
                    while ($the_query->have_posts()) :
                        $the_query->the_post();
                        get_template_part('template-parts/content/content', 'item');
                    endwhile;
                    tech_blogging_navigation();
                else :
                    get_template_part('template-parts/content/content', 'none');
                endif;
                do_action('tech_blogging_after_default_page');
                ?>
            </div>
        </main><!-- #main -->
    </div>
<?php
get_footer();
