<?php

// The category template. Used when a category is queried.

global $wp_query;

// Get our data

$category_name = $wp_query->query['category_name'];
$total_results = count($wp_query->posts);
$posts = $wp_query->posts;

get_header();

?>

<main>
    <div class="wrapper">
        <div class="category-page  stacked-posts">

            <header>
                <header>
                    <div class="category-page__header page-header-container">
                        <div class="category-page__title stacked-posts__title">Current Category: <span><?php echo isset($category_name) ? $category_name : ''; ?></span></div>
                    </div>
                </header>
            </header>

            <?php

            get_template_part('partials/components/stacked-posts', '', [
                'class' => 'category-page',
                'posts' => $posts,
                'total_results' => $total_results,
                'add_search' => false,
            ]);

            ?>
        </div>
    </div>
</main>

<?php

get_footer();
