<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Tech Blogging
 */
use App\Helper\Helper;

$image = get_field('logo', get_the_ID());
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'tech-blogging-standard-post single-review' ); ?>>
	<div class="tech-blogging-standard-post__entry-content text-left">
		<div class="tech-blogging-standard-post__thumbnail post-header">
			<?php tech_blogging_post_thumbnail(); ?> 
		</div>
		<div class="tech-blogging-standard-post__content-wrapper">
			<div class="tech-blogging-standard-post__blog-meta p-0">
				<?php tech_blogging_categories(); ?>
			</div>
			<div class="tech-blogging-standard-post__blog-meta p-0 review-meta">
				<?php tech_blogging_posted_by( true ); ?>
				<?php tech_blogging_posted_on(); ?>
			</div>
			<div class="tech-blogging-standard-post__post-title p-0 review-title">
                <?php if (isset($image)): ?>
                    <img src="<?php echo $image['sizes']['thumbnail']; ?>"
                         alt="<?php echo ($image['alt'])?: get_the_title(); ?>">
                <?php endif; ?>
				<h1><?php the_title(); ?></h1>
                <?php if (!empty($tableOfContents = Helper::tableOfContents())): ?>
                <h5><?php pll_e('Table of contents:'); ?></h5>
                <ol>
                    <?php
                    $i=1;
                    foreach ($tableOfContents as $item): ?>
                        <li>
                            <a href="<?php echo '#part' . $i; ?>"><?php echo $item; ?></a>
                        </li>
                    <?php
                    $i++;
                    endforeach; ?>
                </ol>
                <?php endif ?>

			</div>
			<div class="tech-blogging-standard-post__full-summery text-left">
				<?php
					the_content();
					wp_link_pages(
						array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'tech-blogging' ),
							'after'  => '</div>',
						)
					);
					?>
			</div>
			<?php if ( has_tag() ) : ?>
			<div class="d-flex justify-content-between Tech Blogging-standard-post__share-wrapper">
				<div class="tech-blogging-standard-post__tags align-self-center">
					<?php tech_blogging_post_tag(); ?>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
