<?php

$create_impact_title = get_field('home_create_impact_title', 'option');
$create_impact_sub_title = get_field('home_create_impact_sub_title', 'option');

$impact_1_title = get_field('home_impact_1_title', 'option');
$impact_1_description = get_field('home_impact_1_description', 'option');

$impact_2_title = get_field('home_impact_2_title', 'option');
$impact_2_description = get_field('home_impact_2_description', 'option');

$impact_3_title = get_field('home_impact_3_title', 'option');
$impact_3_description = get_field('home_impact_3_description', 'option');

$impact_4_title = get_field('home_impact_4_title', 'option');
$impact_4_description = get_field('home_impact_4_description', 'option');

$impacts = [
    'impact_1' => [
        'title' => $impact_1_title,
        'description' => $impact_1_description,
    ],
    'impact_2' => [
        'title' => $impact_2_title,
        'description' => $impact_2_description,
    ],
    'impact_3' => [
        'title' => $impact_3_title,
        'description' => $impact_3_description,
    ],
    'impact_4' => [
        'title' => $impact_4_title,
        'description' => $impact_4_description,
    ],
];

?>

<section name="Create Impact">
    <div class="wrapper">
        <div class="home-create-impact">

            <h2 class="module-title"><?php echo isset($create_impact_title) ? $create_impact_title : '' ?></h2>

            <h3 class="module-sub-title"><?php echo isset($create_impact_sub_title) ? $create_impact_sub_title : '' ?></h3>

            <section name="Create Impact Details">
                <div class="details">
                <?php foreach ($impacts as $detail): ?>

                    <?php if (!empty($detail)): ?>
                    <section>
                        <div class="detail">
                            <?php if (!empty($detail['title'])): ?>

                            <h4 class="detail__title"><?php echo $detail['title']; ?></h4>

                            <?php endif; ?>

                            <?php if (!empty($detail['description'])): ?>

                            <p class="detail__copy-text"><?php echo trim($detail['description']); ?></p>

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
