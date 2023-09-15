<?php

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="<?php echo get_template_directory_uri() ; ?>/favicon.ico" type="image/x-icon" />

    <title><?php echo get_bloginfo('name'); ?> | <?php echo get_bloginfo('description'); ?></title>

    <?php wp_head(); ?>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-34M67LKZH4"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-34M67LKZH4');
    </script>

    <!--
        This is used to build our custom variable in the team partial (Not ideal but will work)
        @see wp-content/themes/passion-impact/src/scss/pages/_front-page.scss
    -->
    <?php

    if (is_front_page()) {
        $home_team_members = get_field('home_our_team', 'option');
        $home_team_members_length = [];
        $grid_property = 'repeat(var(--team-members-count), 1fr)';

        if (!empty($home_team_members['team_members'])) {
            foreach($home_team_members['team_members'] as $detail) {
                if (!empty($detail['member_content']['show_on_homepage'])) {
                    $home_team_members_length[] = $detail['member_content']['show_on_homepage'];
                }
            }

            if (count($home_team_members_length) > 3) {

                $grid_property = 'repeat(auto-fill, minmax(280px, 1fr))';

            }
        }

        ?>
        <style>
            :root {
                --team-members-count: <?php echo !empty($home_team_members_length) ? count($home_team_members_length) : 3; ?>
            }

            .home .home-our-team .details {
                grid-template-columns: <?php echo $grid_property; ?>
            }
        </style>
        <?php
    }
    ?>

</head>

<body <?php body_class(); ?>>
<div id="passion-app">
