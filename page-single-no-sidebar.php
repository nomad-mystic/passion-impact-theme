<?php

/*
 * Template Name: Single No Sidebar
 */

get_header();

$id = get_the_ID();
$post = get_post($id);

?>
<section>
    <div class="wrapper">
        <div class="press-release-parent basic-content">
            <article>
                <div class="basic-content__content">
                    <?php the_content(); ?>

                    <hr class="wp-block-separator">
                </div>

                <div class="blog-single__metadata ">
                <?php

                get_template_part('partials/components/post-metadata', '', [
                    'id' => $id,
                    'post' => $post,
                ]);

                ?>
                </div>

            </article>
        </div>
    </div>
</section>

<?php

get_footer();
