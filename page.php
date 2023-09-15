<?php

// The page template. Used when an individual Page is queried.

get_header();

?>

<main>
    <div class="wrapper">
        <div class="default-page basic-content">
            <article>

                <div class="basic-content__content">
                    <?php the_content(); ?>
                </div>

            </article>
            <aside>
                <?php if (is_active_sidebar('inner_pages')): ?>
                    <?php dynamic_sidebar('inner_pages'); ?>
                <?php endif; ?>
            </aside>
        </div>
    </div><!-- end wrapper -->
</main>

<?php

get_footer();
