<?php

// The author template. Used when an author is queried.

get_header();

$current_author = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));

$query = new WP_Query([
    'author' => $current_author->ID,
]);

$posts = $query->posts;
$total_results = count($query->posts);

?>

<main>
    <div class="wrapper">
        <div class="author-page stacked-posts">

            <header class="page-header-container">
                <h1 class="author-page__title stacked-posts__title">Posts by <?php echo $current_author->display_name; ?>:</h1>
            </header>

            <?php

            get_template_part('partials/components/stacked-posts', '', [
                'class' => 'author-page',
                'posts' => $posts,
                'total_results' => $total_results,
                'add_search' => false,
            ]);

            ?>
        </div><!-- End author -->
    </div><!-- End wrapper -->
</main>

<?php

get_footer();
