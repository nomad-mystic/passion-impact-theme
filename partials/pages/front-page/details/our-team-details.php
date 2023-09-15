<?php

$index = 1;

?>

<?php if (!empty($home_team_members['team_members'])): ?>
    <?php foreach($home_team_members['team_members'] as $detail): ?>

        <?php if (!empty($detail)): ?>

        <?php if (!empty($detail['member_content']['show_on_homepage'])): ?>
                <section>
                    <div class="detail">
                        <?php if (!empty($detail['member_media'])): ?>
                            <div class="detail__image-container">
                                <figure>
                                    <img
                                        class="image"
                                        src="<?php echo $detail['member_media']['image']['url'] ?? ''; ?>"
                                        alt="<?php echo $detail['member_media']['image']['alt'] ?? ''; ?>">
                                </figure>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($detail['member_content'])): ?>

                            <h5 class="detail__member-name"><?php echo $detail['member_content']['name'] ?? ''; ?></h5>

                        <?php endif; ?>

                        <?php if (!empty($detail['member_content'])): ?>

                            <h6 class="detail__member-title"><?php echo $detail['member_content']['position'] ?? ''; ?></h6>

                        <?php endif; ?>

                        <?php if (!empty($detail['member_content'])): ?>

                            <p class="detail__copy-text"><?php echo $detail['member_content']['description'] ?? ''; ?></p>

                        <?php endif; ?>

                        <section>
                            <div class="detail__social-container">
                                <?php if (!empty($detail['member_media'])): ?>
                                    <!-- twitter -->
                                    <?php if (!empty($detail['member_media']['twitter'])): ?>

                                        <a href="<?php echo $detail['member_media']['twitter']; ?>" class="twitter-link link" target="_blank"><i class="fab fa-twitter"></i></a>

                                    <?php endif; ?>

                                    <!-- facebook -->
                                    <?php if (!empty($detail['member_media']['facebook'])): ?>

                                        <a href="<?php echo $detail['member_media']['facebook']; ?>" class="facebook-link link" target="_blank"><i class="fab fa-facebook"></i></a>

                                    <?php endif; ?>

                                    <!-- instagram -->
                                    <?php if (!empty($detail['member_media']['instagram'])): ?>

                                        <a href="<?php echo $detail['member_media']['instagram']; ?>" class="instagram-link link" target="_blank"><i class="fab fa-instagram"></i></a>

                                    <?php endif; ?>

                                    <!-- linkedin -->
                                    <?php if (!empty($detail['member_media']['linkedin'])): ?>

                                        <a href="<?php echo $detail['member_media']['linkedin']; ?>" class="linkedin-link link" target="_blank"><i class="fab fa-linkedin"></i></a>

                                    <?php endif; ?>

                                    <!-- website -->
                                    <?php if (!empty($detail['member_media']['website'])): ?>

                                        <a href="<?php echo $detail['member_media']['website']; ?>" class="external-link link" target="_blank"><i class="fas fa-globe"></i></a>

                                    <?php endif; ?>

                                    <!-- email -->
                                    <?php if (!empty($detail['member_media']['email'])): ?>

                                        <a href="mailto:<?php echo $detail['member_media']['email']; ?>" class="external-link link" target="_blank"><i class="fas fa-envelope"></i></a>

                                    <?php endif; ?>

                                <?php endif; ?>
                            </div> <!-- end detail__social-container -->
                        </section>
                    </div><!-- end detail -->
                </section>
        <?php endif; ?><!-- End show_on_homepage -->

        <?php endif; ?><!-- End $detail -->

    <?php endforeach; ?>
<?php endif; ?>
