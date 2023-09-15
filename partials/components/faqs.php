<?php

?>

<div class="donate__faq-container faq-container">

    <h3 class="title"><?php echo (!empty($args['faq_title'])) ? $args['faq_title'] : '' ?></h3>

    <accordion>
        <?php if (!empty($args['faq_content'])): ?>

            <?php foreach($args['faq_content'] as $faq): ?>

                <?php if (!empty($faq)): ?>

                <div class="accordion-wrapper">
                    <button class="accordion-title"><?php echo (!empty($faq['title'])) ? $faq['title'] : ''; ?></button>

                    <div class="panel">
                        <p><?php echo (!empty($faq['description'])) ?  $faq['description'] : ''; ?></p>
                    </div>
                </div>

                <?php endif; ?>

            <?php endforeach; ?>

        <?php endif; ?>
    </accordion>
</div>
