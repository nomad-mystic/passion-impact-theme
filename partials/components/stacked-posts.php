<?php

$class = $args['class'];
$posts = $args['posts'];
$total_results = $args['total_results'];
$add_search = $args['add_search'];

?>

<section>
    <div class="<?php echo !empty($class) ?  $class . '__content' : ''; ?> stacked-posts__content">
        <div class="<?php echo !empty($class) ? $class . '__results' : ''; ?> stacked-posts__results">

            <?php if (!empty($add_search)): ?>
                <!-- Add this so they can search -->
                <?php get_search_form(); ?>

                <h4 class="page-sub-title">Results</h4>
            <?php endif; ?>

            <?php if (!empty($total_results) && $total_results > 0): ?>

                <?php if (!empty($posts)): ?>

                    <?php foreach ($posts as $post): ?>

                        <!-- If there isn't a title don't so that result -->
                        <?php if (!empty($post) && !empty($post->post_title)): ?>
                            <article>
                                <div class="<?php echo !empty($class) ?  $class . '__result' : ''; ?>  stacked-posts">
                                    <h3 class="<?php echo !empty($class) ?  $class . '__post-title' : ''; ?> page-paragraph stacked-posts__post-title">
                                        <a href="<?php echo isset($post->ID) ? get_permalink($post->ID) : ''; ?>">
                                            <?php echo isset($post->post_title) ? $post->post_title : ''; ?>
                                        </a>
                                    </h3>
                                    <p class="<?php echo !empty($class) ? $class . '__post-date' : ''; ?> stacked-posts__date"><?php echo isset($post->post_date_gmt) ? date('l, F jS, Y', get_post_time('U', false, $post->ID)) : ''; ?></p>
                                    <p class="<?php echo !empty($class) ? $class . '__post-author' : ''; ?> stacked-posts__author"><?php echo isset($post->post_author) ? get_the_author_meta('display_name', $post->post_author) : ''; ?></p>
                                    <p class="<?php echo !empty($class) ? $class . '__post-excerpt' : ''; ?> page-paragraph stacked-posts__excerpt"><?php echo isset($post->post_excerpt) ? $post->post_excerpt : ''; ?></p>
                                    <div class="<?php echo !empty($class) ? $class . '__post-divider' : ''; ?> stacked-posts__divider"></div>
                                </div>
                            </article>
                        <?php endif; ?>

                    <?php endforeach; ?>

                <?php endif; ?>

            <?php else: ?>

                <p class="page-sub-title">There are no results for that search</p>

            <?php endif; ?>
        </div><!-- End tag-page__results -->

        <aside>
            <?php if (is_active_sidebar('inner_pages')): ?>
                <?php dynamic_sidebar('inner_pages'); ?>
            <?php endif; ?>
        </aside>

    </div><!-- End tag-page__content -->
</section>
