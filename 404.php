<?php

// The 404 Not Found template. Used when WordPress cannot find a post or page that matches the query.

use PassionImpact\Utils\SiteUtils;

$site_url = get_site_url();

get_header();

?>

<section>
    <div class="wrapper">
        <div class="page-404">

            <header>
                <div class="page-404__header page-header-container">
                    <h1 class="page-title">Not Found!</h1>
                    <h3 class="page-paragraph">Search the site or get me out of <a href="<?php echo get_home_url(); ?>">here!</a></h3>
                </div>
            </header>

            <main>
                <section>
                    <div class="page-404__search">
                        <?php get_search_form() ?>
                    </div>
                </section>

                <section>
                    <div class="page-404__content">
                        <h5 class="categories-title page-sub-title">Try one of these categories:</h5>
                        <?php

                        $the_categories = get_categories();

                        ?>

                        <div class="categories-items">
                            <?php foreach ($the_categories as $category): ?>

                                <?php if (!empty($category)): ?>

                                    <div class="categories-item">
                                        <p class="page-paragraph">
                                            <a class="basic-link" href="<?php echo isset($category->slug) ?  $site_url . '/category/' .  $category->slug : ''; ?>">
                                                <?php echo isset($category->name) ? $category->name : ''; ?>
                                            </a>
                                        </p>
                                    </div>

                                <?php endif; ?>

                            <?php endforeach; ?>
                        </div>
                    </div><!-- End page-404__content -->
                </section>

            </main>
        </div><!-- End page-404 -->
    </div>
</section>

<?php

get_footer();
