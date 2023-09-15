<?php

/*
 * Template Name: About Us
 */

get_header();

$about_us_title = get_field('about_us_title') ?? '';
$about_us_sub_title = get_field('about_us_sub_title') ?? '';
$about_us_header_image = get_field('about_us_header_image') ?? '';
$about_us_header_content = get_field('about_us_header_content') ?? '';
$about_us_body_content = get_field('about_us_body_content') ?? '';

$about_us_links = get_field('about_us_links') ?? '';

?>

<section>
    <div class="about-us">
        <header>
            <div class="wrapper">
                <div class="about-us__header page-header-container">
                    <h1 class="about-us__header-title page-title"><?php echo $about_us_title ?? ''; ?></h1>
                    <h3 class="about-us__header-sub-title page-sub-title"><?php echo $about_us_sub_title ?? ''; ?></h3>

                    <div class="about-us__header-image">
                        <figure>
                            <img class="image page-image"
                                src="<?php echo $about_us_header_image['url'] ?? ''; ?>"
                                alt="<?php echo $about_us_header_image['alt'] ?? ''; ?>">
                        </figure>
                    </div>

                    <div class="about-us__header-content">
                        <?php foreach ($about_us_header_content['header_content'] as $content ): ?>
                           <?php if (!empty($content)): ?>
                                <div class="about-us__header-item">
                                    <section>
                                        <h3 class="item-title page-sub-title"><?php echo $content['title'] ?? ''; ?></h3>
                                        <p class="item-description page-paragraph"><?php echo $content['description'] ?? ''; ?></p>
                                    </section>
                                </div>
                           <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div><!-- End wrapper -->
        </header>

        <section>
            <div class="wrapper">
                <div class="about-us__content">
                    <?php if (!empty($about_us_body_content)): ?>
                        <?php foreach ($about_us_body_content as $content): ?>
                            <?php if (!empty($content)): ?>
                                <section>
                                   <div class="about-us__content-item">
                                       <h3 class="about-us__content-title page-sub-title"><?php echo $content['title'] ?? ''; ?></h3>
                                       <div class="about-us__content-description page-paragraph"><?php echo $content['description'] ?? ''; ?></div>
                                   </div>
                                </section>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div><!-- End wrapper -->
        </section>

        <section>
            <div class="google-map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2796.63845868179!2d-122.61215198444143!3d45.49722477910127!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x5495a065e35d7537%3A0xa4c08ced4c947438!2s5106%20SE%20Powell%20Blvd%20%231200%2C%20Portland%2C%20OR%2097206!5e0!3m2!1sen!2sus!4v1604820291482!5m2!1sen!2sus" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
        </section>

        <section>
            <div class="wrapper">
                <div class="about-us__links">

                    <div class="about-us__links-header">
                        <h3 class="about-us__links-title page-sub-title"><?php echo $about_us_links['about_us_links_title'] ?? ''; ?></h3>
                        <p class="about-us__links-sub-title page-paragraph"><?php echo $about_us_links['about_us_links_description'] ?? ''; ?></p>
                    </div>

                    <div class="about-us__links-buttons">
                        <?php if (!empty($about_us_links['links'])): ?>

                            <?php foreach ($about_us_links['links'] as $link): ?>

                                <?php if (!empty($link)): ?>

                                    <div class="about-us__link">
                                        <div class="about-us__link-button light-button">
                                            <a href="<?php echo $link['link_url'] ?? ''; ?>"><?php echo $link['link_text'] ?? ''; ?></a>
                                        </div>
                                    </div>

                                <?php endif; ?>

                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div><!-- End about-us__links-buttons -->

                </div><!-- end about-us__links -->
            </div><!-- End wrapper -->
        </section>
    </div><!-- End about-us -->
</section>

<?php

get_footer();
