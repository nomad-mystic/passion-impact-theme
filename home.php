<?php

/*
 * Our Blog Page
 * @todo Make sure to update the dashboard for using this template.
 */

$blog_query = [];

// Get our post to build the hone page
if (class_exists('WP_Query')) {
    $args = [
        'orderby' => 'date',
        'order' => 'DESC',
        'posts_per_page' => -1,
    ];

    $blog_query = new WP_Query($args);
}

get_header();

?>
<section>
    <div class="wrapper">
        <div class="blog">
            <section>
                <div class="blog__header page-header-container">
                    <div class="blog__header-title">
                        <h1 class="page-title">Blog Posts</h1>
                    </div>
                </div>
            </section>
            <section>
                <div class="blog__content cards__content">

                <?php if ( have_posts() ) : ?>

                    <!-- Start of the main loop. -->
                    <?php while ( have_posts() ) : the_post();

                        $id = get_the_ID();
                        $thumbnail = get_the_post_thumbnail_url();
                        $thumbnail_size = 'cover';

                        if (function_exists('has_post_thumbnail') && !has_post_thumbnail()) {
                            $thumbnail = get_template_directory_uri() . '/src/img/passion-impact-logo.png';
                            $thumbnail_size = 'contain';
                        }
                    ?>

                    <div class="blog__post-box cards__card">
                        <div class="blog__post-box-above cards__card-above">
                            <div class="blog__post-image cards__card-image" style="background-image: url(<?php echo $thumbnail; ?>); background-size: <?php echo $thumbnail_size; ?>"></div>
                            <div class="blog__post-date cards__card-date"><?php the_date(); ?></div>
                        </div>
                        <div class="blog__post-box-below cards__card-below">
                            <h3 class="blog__post-title cards__card-title"><?php echo get_the_title(); ?></h3>
                            <div class="blog__post-link cards__card-link hollow-button">
                                <a href="<?php the_permalink(); ?>" class="link">Read More</a>
                            </div>
                        </div>
                    </div>

                    <?php endwhile; ?>

                </div>
            </section>
            <!-- Add the pagination functions here. -->
            <section>
                <div class="blog__pagination">
                    <?php
                    $previous_posts_link = get_previous_posts_link('Newer Posts');
                    $next_posts_link = get_next_posts_link('Older Posts');

                    // Don't show the buttons if there isn't content
                    if (get_next_posts_link()) {
                        echo "<div class='blog__post-older-posts hollow-button'>{$next_posts_link}</div>";
                    }

                    if (get_previous_posts_link()) {
                        echo "<div class='blog__post-newer-posts hollow-button'>{$previous_posts_link}</div>";
                    }
                    ?>

                </div>
            </section>

            <?php else : ?>

                <?php _e('Sorry, no posts matched your criteria.'); ?>

            <?php endif; ?>
        </div>
    </div>
</section>

<?php

get_footer();
