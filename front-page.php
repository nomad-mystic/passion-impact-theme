<?php

// The front page template.
get_header();

?>
<section name="Passion Impact Home Page">
    <div class="home">
        <?php
            get_template_part('partials/pages/front-page/slider');
            get_template_part('partials/pages/front-page/create-impact');
            get_template_part('partials/pages/front-page/get-involved');
            get_template_part('partials/pages/front-page/testimonials');
            get_template_part('partials/pages/front-page/our-team');
        ?>

        <home-board-committees>
            <div class="plain">
                <div class="plain__controls" id="js-plain-controls">
                    <p class="control is-panel-active" id="js-board-panel-control">Our Board</p>
                    <p class="control" id="js-committees-panel-control">Committees</p>
                </div>
                <div class="plain__our-board" id="js-board-panel">

                    <?php get_template_part('partials/pages/front-page/our-board'); ?>

                </div>

                <div class="plain__committees is-invisible" id="js-committees-panel">

                    <?php get_template_part('partials/pages/front-page/committees'); ?>

                </div>
            </div>
        </home-board-committees>
    </div>
</section>
<?php

get_footer();
