<?php

/*
 * Template Name: Supporters
 */

get_header();

$supporters_title = get_field('supporters_title') ?? '';
$supporters_description = get_field('supporters_description') ?? '';

$supporters = get_field('supporters') ?? '';

// Foundations
$foundations_title = $supporters['foundations_title'] ?? '';
$foundations = $supporters['foundations'] ?? '';

// Sponsors
$sponsors_title = $supporters['sponsors_title'] ?? '';
$sponsors = $supporters['sponsors'] ?? '';

// Donors
$donors_title = $supporters['donors_title'] ?? '';
$donors = $supporters['donors'] ?? '';

// Build a custom array of supporters
$supportersArray = [
    'foundations' => [
        'title' => $foundations_title,
        'details' => $foundations,
    ],
    'sponsors' => [
        'title' => $sponsors_title,
        'details' => $sponsors,
    ],
    'donors' => [
        'title' => $donors_title,
        'details' => $donors,
    ],
];

//$about_us_header_image = get_field('about_us_header_image');
//$about_us_header_content = get_field('about_us_header_content');
//$about_us_body_content = get_field('about_us_body_content');


//die(var_dump($supportersArray));
?>

<main>
    <div class="supporters">
        <header>
            <div class="wrapper">
                <div class="supporters__header page-header-container">
                    <h1 class="supporters__header-title page-title"><?php echo $supporters_title ?? ''; ?></h1>
                    <h3 class="supporters__header-sub-title page-sub-title"><?php echo $supporters_description ?? ''; ?></h3>
            </div><!-- End wrapper -->
        </header>

        <section>
            <div class="wrapper">
                <div class="supporters__content">
                    <!-- Build our supporter details -->
                    <?php
                    if (!empty($supporters)) {
                        foreach($supportersArray as $supporter_type => $info) {
                            if (!empty($supporter_type)) {

                                get_template_part('partials/components/supporters-detail', '', [
                                    'title' => $info['title'],
                                    'details' => $info['details'],
                                ]);
                            }
                        }
                    }
                    ?>
                </div>
            </div><!-- End wrapper -->
        </section>

        <?php

        get_template_part('partials/components/google-map');

        ?>
    </div><!-- End supporters -->
</main>

<?php

get_footer();
