<?php

// Shamelessly taken from https://levelup.gitconnected.com/create-an-image-slider-with-html-css-and-javascript-3bf2c3e84060

$args = [
        'post_type' => 'home_slider',
        'post_status' => 'publish',
        'orderby' => 'menu_order',
        'numberposts'	=> -1,
        'meta_key' => 'slider_is_active',
        'meta_value' => true,
    ];

$the_query = new WP_Query($args);
$number_of_posts = count($the_query->posts);


// Our ACF fields
$home_slider_interval = get_field('home_slider_interval', 'home_slider_options');
$home_slider_automatic_updates = get_field('home_slider_automatic_updates', 'home_slider_options');
$automatic_updates_string = $home_slider_automatic_updates ? 'true' : 'false';

?>

<section>
    <div class="home-slider">
        <slider interval="<?php echo isset($home_slider_interval) ? $home_slider_interval : 5000; ?>"
                selector="home-slider"
                should-change="<?php echo $automatic_updates_string; ?>">
            <div class="slide-container">
                <?php if ($the_query->have_posts()): ?>
                    <?php while($the_query->have_posts()) : $the_query->the_post(); ?>
                        <?php
                        $image = get_field('image');
                        $imageURL = $image['url'];
                        $imageAlt = $image['alt'];
                        $link = get_field('link');

                        ?>
                        <div class="slide fade">
                            <a href="<?php echo isset($link) ? $link : ''; ?>">
                                <figure>
                                    <img src="<?php echo isset($imageURL) ? $imageURL : ''; ?>" alt="<?php echo isset($imageAlt) ? $imageAlt : ''; ?>" />
                                </figure>
                            </a>
                        </div>
                    <?php endwhile; ?>

                <?php endif; ?>

                <p class="prev" title="Previous">&#10094</p>
                <p class="next" title="Next">&#10095</p>
            </div>

            <div class="pagination">
                <?php

                $pagination_number = 1;

                ?>

                <ul>
                    <?php for ($number = 0; $number < $number_of_posts; $number++): ?>

                        <li class="page-paragraph"><?php echo $pagination_number++; ?></li>

                    <?php endfor; ?>
                </ul>
            </div>

        </slider>
    </div>
</section>
