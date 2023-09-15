<?php

/*
 * Template Name: Positions
 */

get_header();

$positions_title = get_field('positions_title') ?? '';
$positions_description = get_field('positions_description') ?? '';

?>

<section>
    <div class="wrapper">
        <div class="positions">
            <header>
                <div class="positions__header page-header-container">
                    <div class="positions__title page-title">
                        <h1><?php echo $positions_title ?? ''; ?></h1>
                    </div>

                    <div class="positions__description page-sub-title">
                        <p><?php echo $positions_description ?? ''; ?></p>
                    </div>
                </div>
            </header>

            <section>
                <div class="positions__content">
                    <positions fetch-u-r-l="/wp-json/passion-impact/v1/events/positions"></positions>
                </div>
            </section>
        </div>
    </div>
</section>

<?php

get_footer();
