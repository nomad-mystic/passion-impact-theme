<?php

$contact_email = get_field('contact_email', 'option') ?? '';
$contact_phone = get_field('contact_phone', 'option') ?? '';
$contact_address = get_field('contact_address', 'option') ?? '';

$footer_copyright = get_field('footer_copyright', 'option') ?? '';
$footer_sub_note = get_field('footer_sub_note', 'option') ?? '';

?>

<?php

get_template_part('partials/components/volunteer-join-banner');

?>

<footer class="footer">
    <div class="wrapper">
        <div class="footer__container">
            <section>
               <div class="footer__content">
                   <div class="footer__navigation">
                       <h3>Navigation</h3>

                       <?php
                       if (has_nav_menu('primary')) {

                           wp_nav_menu([
                               'theme_location' => 'footer-site-navigation',
                               'menu_class' => 'footer__site-navigation',
                           ]);

                       }
                       ?>

                   </div>
                   <div class="footer__about-pi">
                       <h3>About PI</h3>

                       <?php
                       if (has_nav_menu('primary')) {

                           wp_nav_menu([
                               'theme_location' => 'footer-about-pi-navigation',
                               'menu_class' => 'footer__about-pi-navigation',
                           ]);

                       }
                       ?>
                   </div>
                   <div class="footer__contact">
                       <h3>Contact</h3>
                       <section class="contact-details">

                           <!-- Setup our contact details in Vue -->
                           <footer-contact
                               email="<?php echo (isset($contact_email)) ? $contact_email : ''; ?>"
                               phone="<?php echo (isset($contact_phone)) ? $contact_phone : ''; ?>"
                               address="<?php echo (isset($contact_address)) ? $contact_address : ''; ?>"
                           >
                           </footer-contact>

                       </section>

                       <?php
                       get_template_part('partials/components/social-media');
                       ?>
                   </div>
                   <div class="footer__newsletter">

                       <?php

                       get_template_part('partials/layouts/footer/footer-newsletter');

                       ?>

                   </div>
               </div>
            </section>
            <span class="footer__span-decorator"></span>
            <section>
                <div class="footer__copyright">
                    <p><?php echo isset($footer_copyright) ? $footer_copyright : ''; ?></p>
                    <p><?php echo isset($footer_sub_note) ? $footer_sub_note : ''; ?></p>
                </div>
            </section>
        </div>
    </div>
</footer>

<!--End of the Vue app-->
</div>

<?php wp_footer(); ?>

</body>
</html>

