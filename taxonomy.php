<?php

// The search results template. Used when a search is performed.

get_header();

global $wp_query;

$total_results = $wp_query->found_posts;
$posts = $wp_query->posts;

?>

    <main>
        <div class="wrapper">
            <div class="search-page stacked-posts">
                <header>
                    <div class="search-page__header page-header-container">
                        <div class="stacked-posts__title">You can search for content here.</div>
                    </div>
                </header>

                <?php

                get_template_part('partials/components/stacked-posts', '', [
                    'class' => 'search-page',
                    'posts' => $posts,
                    'total_results' => $total_results,
                    'add_search' => true,
                ]);

                ?>

            </div><!-- End search-page -->
        </div><!-- End Wrapper -->
    </main>

<?php

get_footer();
