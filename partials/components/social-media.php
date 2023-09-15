<?php


$social_media_links = get_field('social_media_links', 'option');
$facebook = (isset($social_media_links['facebook_link'])) ? $social_media_links['facebook_link'] : '';
$twitter = (isset($social_media_links['twitter_link'])) ? $social_media_links['twitter_link'] : '';
$instagram = (isset($social_media_links['instagram_link'])) ? $social_media_links['instagram_link'] : '';
$youtube = (isset($social_media_links['youtube_link'])) ? $social_media_links['youtube_link'] : '';
$linkedin = (isset($social_media_links['linkedin_link'])) ? $social_media_links['linkedin_link'] : '';

?>


<section>
    <article class="social-media">
        <?php if (!empty($twitter)): ?>
            <div class="social-media__link-container">
                <a href="<?php echo $twitter; ?>" target="_blank" class="link social-media__twitter">
                    <i class="fab fa-twitter"></i>
                </a>
            </div>
        <?php endif; ?>

        <?php if (!empty($facebook)): ?>
        <div class="social-media__link-container">
            <a href="<?php echo $facebook; ?>" target="_blank" class="link social-media__facebook">
                <i class="fab fa-facebook"></i>
            </a>
        </div>
        <?php endif; ?>

        <?php if (!empty($instagram)): ?>
        <div class="social-media__link-container">
            <a href="<?php echo $instagram; ?>" target="_blank" class="link social-media__instagram">
                <i class="fab fa-instagram"></i>
            </a>
        </div>
        <?php endif; ?>

        <?php if (!empty($youtube)): ?>
        <div class="social-media__link-container">
            <a href="<?php echo $youtube; ?>" target="_blank" class="link social-media__youtube">
                <i class="fab fa-youtube"></i>
            </a>
        </div>
        <?php endif; ?>

        <?php if (!empty($linkedin)): ?>
        <div class="social-media__link-container">
            <a href="<?php echo $linkedin; ?>" target="_blank" class="link social-media__linkedin">
                <i class="fab fa-linkedin"></i>
            </a>
        </div>
        <?php endif; ?>
    </article>
</section>
