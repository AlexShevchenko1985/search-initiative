<?php
/**
 * Tech Blogging Hero Home two
 */

$tech_blogging_section_args = array(
    'tech_blogging_section_show_hide' => get_theme_mod('tech_blogging_section_show_hide', true),
    'tech_blogging_image' => get_theme_mod('tech_blogging_image_upload'),
    'tech_blogging_name' => get_theme_mod('tech_blogging_name'),
    'tech_blogging_title' => get_theme_mod('tech_blogging_title', __('Modern Technologies', 'tech-blogging')),
    'tech_blogging_description' => get_theme_mod('tech_blogging_description', __('Software & Tech Development for the Future', 'tech-blogging')),
    'tech_blogging_button_text' => get_theme_mod('tech_blogging_button_text', __('Discover', 'tech-blogging')),
    'tech_blogging_button_link' => get_theme_mod('tech_blogging_button_link', '#'),
);
if (true === $tech_blogging_section_args['tech_blogging_section_show_hide']) :
    if ($tech_blogging_section_args['tech_blogging_image'] == '') {
        $tech_blogging_section_args['tech_blogging_image'] = get_template_directory_uri() . '/assets/img/default.jpg';
    }
    if ($tech_blogging_section_args['tech_blogging_name'] == '') {
        $tech_blogging_section_args['tech_blogging_name'] = 'book cover mockup for ' . get_bloginfo('name');
    } else {
        $tech_blogging_section_args['tech_blogging_name'] = '3d book display image of ' . $tech_blogging_section_args['tech_blogging_name'];
    }
    $description = get_field('description', get_the_ID());
    $button      = get_field('button', get_the_ID());
    ?>
    <section class="book-display-area">
        <div class="book-image"
             style="background-image: url('<?php echo esc_url($tech_blogging_section_args['tech_blogging_image']); ?>')"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-7 align-self-center">
                    <div class="book-text">
                        <h1 class="mt-0"><?php the_title(); ?></h1>
                        <?php if (!empty($description)): ?>
                            <p class="mb-4"><?php echo $description; ?></p>
                        <?php endif; ?>
                        <?php if (!empty($button['url'])): ?>
                            <a href="<?php echo $button['url']; ?>" class="btn book-btn default-btn-style">
                                <?php echo (!empty($button['title']))? $button['title'] : ''; ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
endif;
?>