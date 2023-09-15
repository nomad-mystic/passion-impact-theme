<?php ?>

<section>
    <div class="supporters__details">
        <h3 class="supporters__details-title page-sub-title"><?php echo !empty($args['title']) ? $args['title'] : ''; ?></h3>
        <article>
            <?php if (!empty($args['details'])): ?>

                <?php foreach ($args['details'] as $detail):

                    // Make our variables
                    $logo_url = $detail['info']['logo']['url'];
                    $logo_alt = $detail['info']['logo']['alt'];
                    $link = $detail['info']['link'];
                ?>

                <div class="supporters__detail">
                    <div class="supporters__detail-image-container">
                        <figure>
                            <a href="<?php echo isset($link) ? $link : ''; ?>" target="_blank">
                                <img class="page-image" src="<?php echo isset($logo_url) ? $logo_url : ''; ?>" alt="<?php echo isset($logo_alt) ? $logo_alt : ''; ?>">
                            </a>
                        </figure>
                    </div>
                    <h4 class="supporters__detail-name page-sub-title"><?php echo isset($detail['info']['name']) ? $detail['info']['name'] : ''; ?></h4>
                    <div class="supporters__detail-description page-paragraph"><?php echo isset($detail['description']) ? $detail['description'] : ''; ?></div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>

        </article>
    </div>
</section>



