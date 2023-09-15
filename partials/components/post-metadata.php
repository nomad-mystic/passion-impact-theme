<?php

$id = $args['id'];
$post = $args['post'];
$the_tags = get_the_tags($id);
$the_categories = get_the_category($id);
$site_url = get_site_url();

?>

<section>
    <div class="post-metadata">

        <div class="post-metadata__author">
            <p class="published">Published by:
                <a href="<?php echo !empty(get_author_posts_url($post->post_author)) ? get_author_posts_url($post->post_author) : ''; ?>">
                    <?php echo !empty(get_the_author_meta('display_name', $post->post_author)) ? get_the_author_meta('display_name', $post->post_author) : ''; ?>
                </a>
            </p>
        </div>

        <div class="post-metadata__categories">
            <p class="categories">Posted in:
                <?php if (!empty($the_categories)): ?>
                    <?php foreach ($the_categories as $key => $category): ?>

                        <?php if (!empty($category)): ?>

                            <?php if ($key === array_key_last($the_categories) || (count($the_categories) === 1)): ?>

                                <span><a href="<?php echo isset($category->slug) ? $site_url . '/category/' . $category->slug : ''; ?>"><?php echo isset($category->name) ? $category->name : ''; ?></a> </span>

                            <?php else: ?>
                                <!-- If its the last element don't show the trailing coma -->

                                <span><a href="<?php echo isset($category->slug) ? $site_url . '/category/' . $category->slug : ''; ?>"><?php echo isset($category->name) ? $category->name . ', ' : ''; ?></a> </span>

                            <?php endif; ?>

                        <?php endif; ?>

                    <?php endforeach; ?>

                <?php endif; ?>
            </p>
        </div>

        <div class="post-metadata__tags">
            <p class="tags">Tags:
            <?php if (!empty($the_tags)): ?>

                <?php foreach ($the_tags as $key => $tag): ?>

                    <?php if (!empty($tag)): ?>

                    <?php if ($key === array_key_last($the_tags) || (count($the_tags) === 1)): ?>

                        <span><a href="<?php echo isset($tag->slug) ? $site_url . '/tag/' . $tag->slug : ''; ?>"><?php echo isset($tag->name) ? $tag->name : ''; ?></a> </span>

                    <?php else: ?>
                        <!-- If its the last element don't show the trailing coma -->

                        <span><a href="<?php echo isset($tag->slug) ? $site_url . '/tag/' . $tag->slug : ''; ?>"><?php echo isset($tag->name) ? $tag->name . ', ' : ''; ?></a> </span>

                    <?php endif; ?>

                    <?php endif; ?>

                <?php endforeach; ?>

            <?php endif; ?>
            </p>
        </div><!-- End post-metadata__tags -->

    </div><!-- End post-metadata -->
</section>
