<?php

/*
 * Template Name: Donate Monthly
 */

get_header();

$donate_monthly_title = get_field('donate_monthly_title') ?? '';
$donate_monthly_content = get_field('donate_monthly_content') ?? '';
$donate_monthly_levels_title = get_field('donate_monthly_levels_title') ?? '';
$donate_monthly_levels = get_field('donate_monthly_levels') ?? '';
$donate_monthly_little_green_light_form_id = get_field('donate_monthly_little_green_light_form_id') ?? '';
$donate_faqs_title = get_field('donate_faqs_title') ?? '';
$donate_faqs = get_field('donate_faqs') ?? '';

?>
<section>
    <div class="wrapper">
        <div class="donate">
            <div class="donate__top-container">
                <section>
                    <div class="donate__content-container">

                        <div class="title"><?php echo !empty($donate_monthly_title) ? $donate_monthly_title : ''; ?></div>
                        <div class="content"><?php echo !empty($donate_monthly_content) ? $donate_monthly_content : ''; ?></div>

                        <section class="donate__levels">

                            <h4 class="title"><?php echo (!empty($donate_monthly_levels_title)) ? $donate_monthly_levels_title : ''; ?></h4>

                            <?php

                            if (!empty($donate_monthly_levels)):
                            foreach ($donate_monthly_levels as $level):

                            ?>
                                <?php if (!empty($level)): ?>

                                    <div class="level">
                                        <h6 class="amount"><?php echo !empty($level['amount']) ? $level['amount'] : ''; ?></h6>
                                        <p class="description"><?php echo !empty($level['description']) ? $level['description'] : ''; ?></p>
                                    </div>

                                <?php endif; ?>
                            <?php

                            endforeach;
                            endif;
                            ?>
                        </section>
                    </div>
                </section>
                <section>
                    <div class="donate__form-container">
                        <?php if (!empty($donate_monthly_little_green_light_form_id)): ?>

                            <donate-form iframe-id="<?php echo (string) $donate_monthly_little_green_light_form_id; ?>" permalink="<?php echo (string) get_the_permalink(); ?>">
                                <noscript>
                                    <a href="https://secure.lglforms.com/form_engine/s/<?php echo $donate_monthly_little_green_light_form_id; ?>">Fill out my LGL form!</a>
                                </noscript>
                            </donate-form>

                        <?php endif; ?>
                    </div>
                </section>
            </div><!-- End donate__top-container -->

            <?php

            get_template_part('partials/components/faqs', '', [
                'faq_title' => $donate_faqs_title,
                'faq_content' => $donate_faqs,
            ]);

            ?>
        </div><!-- End Donate -->
    </div><!-- End Wrapper -->
</section>

<?php

get_footer();
