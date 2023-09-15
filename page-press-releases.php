<?php

/*
 * Template Name: Press Releases
 */

get_header();

?>

<section>
    <div class="wrapper">
        <div class="press-releases">
            <header>
                <div class="press-releases__header page-header-container">
                    <div class="press-releases__title page-title">
                        <h1>Press Releases</h1>
                    </div>
                </div>
            </header>

            <section>
                <div class="press-releases__content">
                    <?php $emptyImage = get_template_directory_uri() . '/src/img/passion-impact-logo.png'; ?>

                    <post-cards fetch-u-r-l="/wp-json/wp/v2/press-releases/?_embed" empty-image="<?php echo isset($emptyImage) ? $emptyImage : ''; ?>"></post-cards>
                </div>
            </section>
        </div>
    </div>
</section>

<?php

get_footer();
