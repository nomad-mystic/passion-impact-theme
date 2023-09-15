<?php

$mobile_index = 1;
$index = 1;

$home_testimonials_title = get_field('home_testimonials_title', 'option') ?? '';

$home_testimonials_1_author = get_field('home_testimonials_1_author', 'option') ?? '';
$home_testimonials_1_author_title = get_field('home_testimonials_1_author_title', 'option') ?? '';
$home_testimonials_1_description = get_field('home_testimonials_1_description', 'option') ?? '';
$home_testimonials_1_author_image = get_field('home_testimonials_1_author_image', 'option') ?? '';

$home_testimonials_2_author = get_field('home_testimonials_2_author', 'option')  ?? '';
$home_testimonials_2_author_title = get_field('home_testimonials_2_author_title', 'option')  ?? '';
$home_testimonials_2_description = get_field('home_testimonials_2_description', 'option')  ?? '';
$home_testimonials_2_author_image = get_field('home_testimonials_2_author_image', 'option')  ?? '';

$home_testimonials_3_author = get_field('home_testimonials_3_author', 'option')  ?? '';
$home_testimonials_3_author_title = get_field('home_testimonials_3_author_title', 'option')  ?? '';
$home_testimonials_3_description = get_field('home_testimonials_3_description', 'option')  ?? '';
$home_testimonials_3_author_image = get_field('home_testimonials_3_author_image', 'option')  ?? '';

$testimonials = [
    'testimonials_1' => [
        'author' => $home_testimonials_1_author,
        'author_title' => $home_testimonials_1_author_title,
        'description' => $home_testimonials_1_description,
        'author_image' => $home_testimonials_1_author_image,
    ],
    'testimonials_2' => [
        'author' => $home_testimonials_2_author,
        'author_title' => $home_testimonials_2_author_title,
        'description' => $home_testimonials_2_description,
        'author_image' => $home_testimonials_2_author_image,
    ],
    'testimonials_3' => [
        'author' => $home_testimonials_3_author,
        'author_title' => $home_testimonials_3_author_title,
        'description' => $home_testimonials_3_description,
        'author_image' => $home_testimonials_3_author_image,
    ],
];

?>

<section name="Testimonials" class="dark-background">
    <div class="wrapper">
        <div class="home-testimonials">

            <h2 class="module-title"><?php echo isset($home_testimonials_title) ? $home_testimonials_title : ''; ?></h2>

            <div class="home-testimonials-glide">
                <div class="mobile-view" id="js-mobile-view">
                        <?php

                        set_query_var('home_testimonials', $testimonials);
                        get_template_part('partials/pages/front-page/details/testimonials-details');

                        ?>
                </div>
            </div>
            <div class="non-mobile-view non-mobile-detail" id="js-non-mobile-view">
                <?php

                set_query_var('home_testimonials', $testimonials);
                get_template_part('partials/pages/front-page/details/testimonials-details');

                ?>
            </div>
        </div>
    </div>
</section>
