<?php

?>

<?php foreach($home_testimonials as $detail): ?>
    <?php if (!empty($detail)): ?>
        <section name="Testimonial Detail">
            <div class="detail">
                <div class="col">
                    <?php if (!empty($detail['author_image'])): ?>

                    <div class="detail__image-container">
                        <figure>
                            <img
                                class="image"
                                src="<?php echo $detail['author_image']['url']; ?>"
                                alt="<?php echo $detail['author_image']['alt']; ?>">
                        </figure>
                    </div>

                    <?php endif; ?>
                </div>
                <div class="col">
                    <?php if (!empty($detail['description'])): ?>

                    <p class="detail__copy-text">"<?php echo $detail['description']; ?>"</p>

                    <?php endif; ?>
                    <div class="row">
                        <?php if (!empty($detail['author'])): ?>

                        <h5 class="detail__author"><?php echo $detail['author']; ?></h5>

                        <?php endif; ?>

                        <?php if (!empty($detail['author_title'])): ?>

                        <h6 class="detail__relationship"><?php echo $detail['author_title']; ?></h6>

                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php endforeach; ?>

