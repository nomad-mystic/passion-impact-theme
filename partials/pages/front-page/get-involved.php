<?php

$home_get_involved_title = get_field('home_get_involved_title', 'option') ?? '';

$home_involvement_1_title = get_field('home_involvement_1_title', 'option') ?? '';
$home_involvement_1_description = get_field('home_involvement_1_description', 'option') ?? '';
$home_involvement_1_link = get_field('home_involvement_1_link', 'option') ?? '';
$home_involvement_1_image = get_field('home_involvement_1_image', 'option') ?? '';

$home_involvement_2_title = get_field('home_involvement_2_title', 'option') ?? '';
$home_involvement_2_description = get_field('home_involvement_2_description', 'option') ?? '';
$home_involvement_2_link = get_field('home_involvement_2_link', 'option') ?? '';
$home_involvement_2_image = get_field('home_involvement_2_image', 'option') ?? '';

$home_involvement_3_title = get_field('home_involvement_3_title', 'option') ?? '';
$home_involvement_3_description = get_field('home_involvement_3_description', 'option') ?? '';
$home_involvement_3_link = get_field('home_involvement_3_link', 'option') ?? '';
$home_involvement_3_image = get_field('home_involvement_3_image', 'option') ?? '';

$involvements = [
    'involvement_1' => [
        'title' => $home_involvement_1_title,
        'description' => $home_involvement_1_description,
        'link' => $home_involvement_1_link,
        'image' => $home_involvement_1_image,
    ],
    'involvement_2' => [
        'title' => $home_involvement_2_title,
        'description' => $home_involvement_2_description,
        'link' => $home_involvement_2_link,
        'image' => $home_involvement_2_image,
    ],
    'involvement_3' => [
        'title' => $home_involvement_3_title,
        'description' => $home_involvement_3_description,
        'link' => $home_involvement_3_link,
        'image' => $home_involvement_3_image,
    ],
];

?>

<section name="Get Involved">
    <div class="wrapper">
        <div class="home-get-involved">

            <h2 class="module-title"><?php echo isset($home_get_involved_title) ? $home_get_involved_title : ''; ?></h2>

            <section name="Get Involved Details">
                <div class="details">

                <?php foreach($involvements as $involve): ?>

                    <?php if (!empty($involve)): ?>
                    <section>
                        <div class="detail">
                            <?php if (!empty($involve['image'])): ?>
                            <div class="detail__image-container">
                                <figure>
                                    <img
                                        class="image"
                                        src="<?php echo $involve['image']['url'] ?>"
                                        alt="<?php echo $involve['image']['alt'] ?>">
                                </figure>
                            </div>
                            <?php endif; ?>

                            <?php if (!empty($involve['title'])): ?>

                            <h4 class="detail__title"><?php echo $involve['title']; ?></h4>

                            <?php endif; ?>

                            <?php if (!empty($involve['description'])): ?>

                            <p class="detail__copy-text"><?php echo $involve['description']; ?></p>

                            <?php endif; ?>

                            <?php if (!empty($involve['link'])): ?>

                            <a class="detail__link" href="<?php echo$involve['link']; ?>">Learn More</a>

                            <?php endif; ?>

                        </div>
                    </section>
                    <?php endif; ?>

                <?php endforeach; ?>

                </div>
            </section>
        </div>
    </div>
</section>
