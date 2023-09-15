<?php

/*
 * Template Name: Events
 */

get_header();

// Get our events options fro the settings page
$events = get_field('events_options', 'option')  ?? '';
$events_options = $events ?? [];

?>

<section>
    <div class="wrapper">
        <div class="events">
            <header>
                <div class="events__header page-header-container">
                    <div class="events__title page-title">
                        <h1>Events</h1>
                    </div>

                    <div class="events__sub-title page-sub-title">
                        <p>Passion Impact uses the services of <a href="https://www.givepulse.com/group/169540-Passion-Impact" target="_blank">GivePulse</a> to highlight volunteering efforts!</p>
                    </div>
                </div>
            </header>

            <section>
                <div class="events__header-navigation">
                <?php
                    $index = 0;


                ?>
                <?php foreach ($events_options as $events_option): ?>
                    <?php if (!empty($events_option)): ?>

                        <?php if (!empty($events_option['title'])): ?>

                            <events-titles id="<?php echo (string) $events_option['id']; ?>" title="<?php echo (string) $events_option['title']; ?>"></events-titles>

                        <?php endif; ?>

                    <?php endif; ?>
                <?php endforeach; ?>
                </div>

                <?php foreach ($events_options as $events_option): ?>
                    <?php if (!empty($events_option)): ?>
                        <section>
                            <div class="event-tab-<?php echo $events_option['id']; ?>">

                                <?php if (!empty($events_option['id'])): ?>

                                    <events :id="<?php echo $events_option['id']; ?>" title="<?php echo $events_option['title']; ?>"  index="<?php echo (int) $index; ?>"></events>

                                <?php endif; ?>
                            </div>
                        </section>
                        <?php $index++ ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </section>
        </div>
    </div>
</section>

<?php

get_footer();
