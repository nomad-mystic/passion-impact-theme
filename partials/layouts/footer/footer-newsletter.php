<?php

$footer_newsletter_content = get_field('footer_newsletter', 'option');
$header = $footer_newsletter_content['header'] ?? '';
$description = $footer_newsletter_content['description'] ?? '';
$footer_newsletter_green_light_id = $footer_newsletter_content['footer_newsletter_green_light_id'] ?? '';

$is_there_a_newsletter = isset($footer_newsletter_green_light_id) && empty($footer_newsletter_green_light_id) ? 'newsletter__form--ishidden' : '';
?>

<section>
    <div class="newsletter">
        <div class="text-content">
            <h3><?php echo $header; ?></h3>
            <h4><?php echo $description; ?></h4>
        </div>
        <form action="" class="newsletter__form <?php echo $is_there_a_newsletter; ?>" >

            <modal activate-element="newsletter__form-modal-button" modal-content-parent="newsletter__form-modal">

                <button type="submit" class="light-button" id="newsletter__form-modal-button">Subscribe</button>

                <!-- The Modal -->
                <div id="newsletter__form-modal" class="newsletter__form-modal modal-content-parent">

                    <!-- Modal content -->
                    <div class="modal-content">

                        <span class="close"><i class="fas fa-times fa-2x"></i></span>

                        <?php if (!empty($footer_newsletter_green_light_id)): ?>

                            <lgl-form iframe-id="<?php echo (string) $footer_newsletter_green_light_id;; ?>" permalink="<?php echo (string) get_the_permalink(); ?>">
                                <noscript>
                                    <a href="https://secure.lglforms.com/form_engine/s/<?php echo $donate_monthly_little_green_light_form_id; ?>">Fill out my LGL form!</a>
                                </noscript>
                            </lgl-form>

                        <?php endif; ?>

                    </div>
                </div>
            </modal>
        </form>
    </div>
</section>
