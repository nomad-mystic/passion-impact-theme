<?php

$resources_title = get_field('resources_title', 'option');
$resources_description = get_field('resources_description', 'option');

?>

<section>
    <div class="wrapper">
        <div class="resources">

            <header>
                <div class="resources__header">
                    <h2 class="resources__title page-title"><?php echo isset($resources_title) ? $resources_title : ''; ?></h2>
                    <p class="resources__description page-sub-title"><?php echo isset($resources_description) ? $resources_description : ''; ?></p>
                </div>
            </header>


            <?php

            get_template_part('partials/components/resources-map');

            ?>
        </div>
    </div>
</section>
