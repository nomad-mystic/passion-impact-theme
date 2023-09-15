<?php

$index = 1;

$home_our_team_title = get_field('home_our_team_title', 'option');
$home_our_team_sub_title = get_field('home_our_team_sub_title', 'option');

$home_team_members = get_field('home_our_team', 'option');

$home_team_members_length = count($home_team_members);
?>

<section name="Our Team">
    <div class="wrapper">
        <div class="home-our-team">
            <?php if (!empty($home_our_team_title)): ?>

            <h2 class="module-title"><?php echo $home_our_team_title; ?></h2>

            <?php endif; ?>

            <?php if (!empty($home_our_team_sub_title)): ?>

                <h2 class="module-sub-title"><?php echo $home_our_team_sub_title; ?></h2>

            <?php endif; ?>


            <section name="Our Team Details">
                <div class="details" style="">

                    <?php
                    set_query_var('home_team_members', $home_team_members);
                    get_template_part('partials/pages/front-page/details/our-team-details');
                    ?>

                </div>
            </section>
        </div>
    </div>
</section>
