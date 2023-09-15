<?php

use PassionImpact\Utils\ThemeVariables;

/**
 * @descriptino Display navigation to next/previous post when applicable.
 * @author Keith Murphy | nomadmystics@gmail.com
 *
 * @return void
 */
function passion_post_nav(): void
{
    // Don't print empty markup if there's nowhere to navigate.
    $previous = (is_attachment()) ? get_post(get_post()->post_parent) : get_adjacent_post(false, '', true);
    $next = get_adjacent_post(false, '', false);

    if (!$next && !$previous) {
        return;
    }

    ?>
    <nav class="navigation post-navigation" role="navigation">
        <h5 class="screen-reader-text"><?php _e('More Posts', ThemeVariables::getThemeVariables()['domain']); ?></h5>
        <div class="nav-links">
            <?php
            previous_post_link('<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', ThemeVariables::getThemeVariables()['domain']));
            next_post_link('<div class="nav-next">%link</div>', _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link',    ThemeVariables::getThemeVariables()['domain']));
            ?>
        </div><!-- .nav-links -->
    </nav><!-- .navigation -->
    <?php
}
