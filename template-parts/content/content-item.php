<article class="tech-blogging-standard-post no-post-thumbnail reviews-card">
    <div class="tech-blogging-standard-post__entry-content text-left">
        <div class="tech-blogging-standard-post__content-wrapper">

            <?php
            $terms = get_the_terms( get_the_ID(), 'reviews-category' );
            if (!empty($terms)): ?>
            <div class="tech-blogging-standard-post__blog-meta mt-0 reviews-card-header">
                <span class="cat-links">
                    <?php foreach ($terms as $term): ?>
                        <a href="<?php echo get_term_link($term->term_id, $term->taxonomy) ; ?>">
                            <?php echo $term->name; ?>
                        </a>
                    <?php endforeach; ?>
                </span>
                <div class="wrap-rating">
                    <?php
                    $rating = get_field('rating', get_the_ID());
                    if ($rating):
                        for ($i = 1; $i <= $rating; $i++):?>
                            <img src="<?php echo get_stylesheet_directory_uri() . '/src/images/star.svg'; ?>" ]
                                 class="rating-star"
                                 alt="star">
                        <?php
                        endfor;
                    endif; ?>
                </div>
            </div>
            <?php endif; ?>

            <div class="tech-blogging-standard-post__post-title">
                <div class="post-post-title">
                    <?php
                    $image = get_field('logo', get_the_ID());
                    if (isset($image)): ?>
                        <img src="<?php echo $image['sizes']['thumbnail']; ?>"
                             alt="<?php echo ($image['alt'])?: get_the_title(); ?>">
                    <?php endif; ?>
                    <a href="<?php echo get_permalink(get_the_ID())?>">
                        <h3><?php echo get_the_title(get_the_ID())?></h3>
                    </a>
                </div>
                <?php
                $bonus = get_field('bonus', get_the_ID());
                if (!empty($bonus)): ?>
                    <p><?php echo $bonus; ?></p>
                <?php endif; ?>
                <a class="post-link" href="<?php echo get_permalink(get_the_ID())?>"><?php pll_e('Try it now!'); ?></a>
            </div>

            <?php
            $features = get_field('features', get_the_ID());
            if (!empty($features)): ?>
                <div class="tech-blogging-standard-post__blog-meta">
                    <a href="javascript:void(0)"
                       data-name-open="<?php pll_e('Show more'); ?>"
                       data-name-closed="<?php pll_e('Hide more'); ?>"
                       class="btn book-btn default-btn-style btn-features">
                        <?php pll_e('Show more'); ?>
                    </a>
                    <ul class="features-list">
                        <?php
                        $feature_arr = array_filter(explode(',', $features));
                        foreach ($feature_arr as $feature): ?>
                            <li><?php echo $feature; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
</article>
