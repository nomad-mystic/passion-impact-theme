<?php
$images_index = 1;
$index = 1;

$home_our_board_title = get_field('home_our_board_title', 'option');
$home_our_board_sub_title = get_field('home_our_board_sub_title', 'option');
$home_our_members = get_field('home_our_members', 'option');

?>

<section>
    <div class="wrapper">
        <div class="home-our-board">
            <div class="home-number-of-members" data-number-of-members="<?php echo !empty($home_our_members['board_member']) ? count($home_our_members['board_member']) : ''; ?>"></div>

            <?php if (!empty($home_our_board_title)): ?>

            <h2 class="module-title"><?php echo $home_our_board_title; ?></h2>

            <?php endif; ?>

            <?php if (!empty($home_our_board_sub_title)): ?>

            <h3 class="module-sub-title"><?php echo $home_our_board_sub_title; ?></h3>

            <?php endif; ?>
            <section name="Our Board Members Images">
                <div class="board-images">
                <?php if (!empty($home_our_members['board_member'])): ?>

                <?php

                for ($member_image = 0; $member_image < count($home_our_members['board_member']); $member_image++):

                    if (!empty($home_our_members['board_member'][$member_image])):

                        $url = $home_our_members['board_member'][$member_image]['member_media']['image']['url'];
                ?>

                    <div class="board-images__image-container image js-board-image"
                         id="board-image-<?php echo $images_index ?>"
                         style="background-image: url(<?php echo $url ?? ''; ?>)"
                    ></div>

                    <?php endif; ?>
                    <?php $images_index++ ?>

                <?php endfor; ?>
                <?php endif; ?>
                </div>
            </section>
            <?php if (!empty($home_our_members['board_member'])): ?>

            <?php

            for ($member_detail = 0; $member_detail < count($home_our_members['board_member']); $member_detail++):
                if (!empty($home_our_members['board_member'][$member_detail])):

                    $media_url = $home_our_members['board_member'][$member_detail]['member_media']['image']['url'] ?? '';
                    $media_alt = $home_our_members['board_member'][$member_detail]['member_media']['image']['alt'] ?? '';
                    $media_website = $home_our_members['board_member'][$member_detail]['member_media']['website'] ?? '';
                    $media_linkedin = $home_our_members['board_member'][$member_detail]['member_media']['linkedin'] ?? '';
                    $media_twitter = $home_our_members['board_member'][$member_detail]['member_media']['twitter'] ?? '';
                    $media_facebook = $home_our_members['board_member'][$member_detail]['member_media']['facebook'] ?? '';
                    $media_instagram = $home_our_members['board_member'][$member_detail]['member_media']['instagram'] ?? '';
                    $content_name = $home_our_members['board_member'][$member_detail]['member_content']['name'] ?? '';
                    $content_position = $home_our_members['board_member'][$member_detail]['member_content']['position'] ?? '';
                    $content_location = $home_our_members['board_member'][$member_detail]['member_content']['location'] ?? '';
                    $content_description = $home_our_members['board_member'][$member_detail]['member_content']['description'] ?? '';

            ?>

            <section name="A Board Member Detail" class="js-board-detail js-board-detail-<?php echo $index; ?> is-invisible" id="js-board-detail-<?php echo $index; ?>">
                <div class="detail">
                    <div class="detail__image-container">
                        <figure>
                            <img
                                class="image"
                                src="<?php echo $media_url ?? ''; ?>)"
                            alt="<?php echo $media_alt ?? ''; ?>">
                        </figure>
                    </div>

                    <div class="detail__extras">

                        <h4 class="member-name"><?php echo $content_name ?? ''; ?></h4>

                        <p class="member-position"><?php echo $content_position ?? ''; ?></p>

                        <?php if (!empty($content_location)): ?>

                        <p class="member-location"><?php echo $content_location; ?></p>

                        <?php endif; ?>

                        <p class="copy-text"><?php echo $content_description ?? ''; ?></p>

                        <section>
                            <div class="social-container">

                                <?php if (!empty($media_twitter)): ?>
                                <a href="<?php echo $media_twitter; ?>" class="twitter-link link" target="_blank">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <?php endif; ?>

                                <?php if (!empty($media_facebook)): ?>
                                <a href="<?php echo $media_facebook; ?>" class="facebook-link link" target="_blank">
                                    <i class="fab fa-facebook"></i>
                                </a>
                                <?php endif; ?>

                                <?php if (!empty($media_instagram)): ?>
                                <a href="<?php echo  $media_instagram; ?>" class="instagram-link link" target="_blank">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <?php endif; ?>

                                <?php if (!empty($media_linkedin)): ?>
                                <a href="<?php echo  $media_linkedin; ?>" class="linkedin-link link" target="_blank">
                                    <i class="fab fa-linkedin"></i>
                                </a>
                                <?php endif; ?>

                                <?php if (!empty($media_website)): ?>
                                <a href="<?php echo  $media_website; ?>" class="website-link link" target="_blank">
                                    <i class="fas fa-globe"></i>
                                </a>
                                <?php endif; ?>
                            </div>
                        </section>
                    </div><!-- end detail__extras -->
                </div><!-- end detail -->
            </section>

                <?php endif; ?>
                <?php $index++ ?>
            <?php endfor; ?>
            <?php endif; ?>
        </div>
    </div>
</section>
