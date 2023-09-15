<?php

$index = 1;
$mobile_index = 1;
$arrows_index = 1;


$home_committees_title = get_field('home_committees_title', 'option');
$home_committees_sub_title = get_field('home_committees_sub_title', 'option');
$home_committees = get_field('home_committees', 'option');

?>

<section>
    <div class="wrapper">
        <div class="home-committees">
            <?php if (!empty($home_committees_title)): ?>

                <h2 class="module-title"><?php echo $home_committees_title ?></h2>

            <?php endif; ?>

            <?php if (!empty($home_committees_sub_title)): ?>

                <h2 class="module-sub-title"><?php echo $home_committees_sub_title ?></h2>

            <?php endif; ?>

            <div class="non-mobile-view" id="js-non-mobile-view">

                <?php

                set_query_var('home_committees', $home_committees);
                get_template_part('partials/pages/front-page/details/committees-details');

                ?>

            </div>
        </div>
    </div>
</section>

