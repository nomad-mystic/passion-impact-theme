<?php

use PassionImpact\Utils\SiteUtils;

// ACF fields
$header_sub_title = get_field('header_sub_title', 'option') ?? '';
$header_donate_link = get_field('header_donate_link', 'option') ?? '';

get_template_part('head');

?>
<header>
    <div class="header">
        <section>
            <div class="wrapper">
                <div class="header__secondary-content">
                    <h3 class="sub-title"><?php echo isset($header_sub_title) ? $header_sub_title : ''; ?></h3>

                    <?php

                    get_template_part('partials/components/social-media');

                    ?>
                </div>
            </div>
        </section>
        <section>
            <div class="wrapper">
                <div class="header__main-content-flex">
                    <div class="header__branding-nav-branding-flex">
                        <div class="header__branding">
                            <a href="<?php echo home_url(); ?>" class="site-link">
                                <img src="<?php echo SiteUtils::get_site_logo_image_src(); ?>" alt="This is the main logo for the site. A tree with shaping the world map.">
                            </a>
                        </div>
                    </div>
                    <div class="header__nav-container-flex">
                        <span class="header__nav-bars" id="js-off-canvas-open-span"><i class="fas fa-bars" id="js-off-canvas-open-i"></i></span>
                        <div class="header__donate non-mobile">
                            <a href="<?php echo isset($header_donate_link) ? $header_donate_link : ''; ?>" class="light-button">Donate</a>
                        </div>
                        <div class="header__large-nav">
                            <primary-nav-desktop>
                                <nav>
                                    <?php
                                    if (has_nav_menu('primary')) {

                                        wp_nav_menu([
                                            'theme_location' => 'primary',
                                            'menu_class' => 'nav-primary-menu'
                                        ]);

                                    }
                                    ?>
                                </nav>
                            </primary-nav-desktop>
                        </div>
                    </div>
                </div>
            </div><!-- end wrapper -->
        </section>
        <section>
            <div class="wrapper">
                <primary-nav-mobile>
                    <div class="header__nav-primary-mobile" id="js-nav-primary-mobile">
                        <div id="nav-primary-menu-container">
                            <div class="close-icon-container">
                                <span class="header__nav-bars close-span" id="js-off-canvas-close-span"><i class="fas fa-plus close-i" id="js-off-canvas-close-i"></i></span>
                            </div>
                            <nav>
                                <?php
                                if (has_nav_menu('primary')) {

                                    wp_nav_menu([
                                        'theme_location' => 'primary',
                                        'menu_class' => 'nav-primary-menu'
                                    ]);

                                }
                                ?>

                                <div class="header__donate">
                                    <a href="<?php echo isset($header_donate_link) ? $header_donate_link : ''; ?>" class="light-button">Donate</a>
                                </div>

                                <?php

                                get_template_part('partials/components/social-media');

                                ?>
                            </nav>
                        </div>
                    </div>
                </primary-nav-mobile>
            </div>
        </section>
    </div>
</header>
