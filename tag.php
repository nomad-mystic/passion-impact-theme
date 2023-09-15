<?php

// The tag template. Used when a tag is queried.

global $wp_query;

get_header();

$tag_name = $wp_query->query['tag'];
$total_results = count($wp_query->posts);
$posts = $wp_query->posts;

?>

<main>
    <div class="wrapper">
        <div class="tag-page stacked-posts">
            <header>
                <div class="tag-page__header page-header-container">
                    <div class="tag-page__title stacked-posts__title">Current Tag: <span><?php echo $tag_name ?? ''; ?></span></div>
                </div>
            </header>

            <?php

            get_template_part('partials/components/stacked-posts', '', [
                'class' => 'tag-page',
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
