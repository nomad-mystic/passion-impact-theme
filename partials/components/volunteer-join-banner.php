<?php

$volunteer_join_banner_title = get_field('volunteer_join_banner_title', 'option');
$volunteer_join_banner_sub_title = get_field('volunteer_join_banner_sub_title', 'option');
$join_link = get_field('volunteer_join_link', 'option');

?>

<section>
    <div class="volunteer-join-banner">
        <div class="wrapper">
            <div class="volunteer-join-banner__content">
                <section>
                    <h3 class="title"><?php echo (!empty($volunteer_join_banner_title)) ? $volunteer_join_banner_title: '' ?></h3>
                    <h4 class="sub-title"><?php echo (!empty($volunteer_join_banner_sub_title)) ? $volunteer_join_banner_sub_title: '' ?></h4>
                </section>
                <section>
                    <div class="join-button white-button">
                        <a href="<?php echo (!empty($join_link)) ? $join_link: '' ?>" target="_blank">sign up!</a>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>
