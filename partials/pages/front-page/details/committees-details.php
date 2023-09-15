<?php

$index = 1;

?>

<?php foreach($home_committees as $detail): ?>
    <?php if (!empty($detail)): ?>
    <section>
        <div class="detail">
            <?php if (!empty($detail['image'])): ?>
                <div class="detail__image-container">
                    <figure>
                        <img
                            class="image"
                            src="<?php echo $detail['image']['url'] ?>"
                        alt="<?php echo $detail['image']['alt'] ?>">
                    </figure>
                </div>
            <?php endif; ?>

            <?php if (!empty($detail['title'])): ?>

                <p class="detail__title"><?php echo $detail['title'] ?></p>

            <?php endif; ?>

            <?php if (!empty($detail['description'])): ?>

                <p class="detail__copy-text"><?php echo $detail['description'] ?></p>

            <?php endif; ?>

            <?php if (!empty($detail['link'])): ?>

                <a class="detail__link button basic-link page-paragraph" href="<?php echo $detail['link'] ?>">Learn More</a>

            <?php endif; ?>
        </div>
    </section><!-- end detail -->
    <?php endif; ?>

<?php $index++; ?>

<?php endforeach; ?>
