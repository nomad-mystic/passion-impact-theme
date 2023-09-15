<?php

// The single post template. Used when a single post is queried.
// For this and all other query templates, index.php is used if the query template is not present.

get_header();

$id = get_the_ID();
$post = get_post($id);

?>
<main>
    <div class="wrapper">
        <div class="blog-single basic-content">
            <article>
                <header>
                    <h1 class="basic-content-title"><?php the_title(); ?></h1>
                </header>

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

                <hr class="wp-block-separator">

                <?php passion_post_nav(); ?>

            </article>
            <aside>
                <?php if (is_active_sidebar('inner_pages')): ?>
                    <?php dynamic_sidebar('inner_pages'); ?>
                <?php endif; ?>
            </aside>
        </div>
    </div>
</main>

<?php

get_footer();
