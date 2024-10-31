<?php
/**
 * Third style template of testimonial of the plugin.
 *
 * @author  : gingerplugins <gingerplugins@gmail.com>
 * @license : GPL2
 * */

if (!defined('ABSPATH')) {
    exit;
}
?>
<div class="superb-content">
    <?php
    if ($settingsFields['image'] == 1) {
        $imageId  = isset($testimonialDetail['client_image']) ? $testimonialDetail['client_image'] : "";
        $imageUrl = "";
        if (!empty($imageId)) {
            $imageData = wp_get_attachment_image_src($imageId, "full");
            if (!empty($imageData) && isset($imageData[0])) {
                $imageUrl = $imageData[0];
            }
        }

        if (!empty($imageUrl)) {
            ?>
                <div class="author-image">
                    <img src="<?php echo esc_url($imageUrl) ?>">
                </div>
        <?php }
    } ?>
    <?php if ($settingsFields['title'] == 1) { ?>
        <div class="superb-title"><?php the_title() ?></div>
    <?php }
        the_content();
    ?>
</div>
<div class="superb-bottom">
    <?php if ($settingsFields['name'] == 1) { ?>
        <div class="author-name"><?php echo esc_attr($testimonialDetail['client_name']) ?></div>
    <?php } ?>
    <div class="author-info">
        <?php if ($settingsFields['designation'] == 1) { ?>
            <span class="author-designation"><?php echo esc_attr($testimonialDetail['designation']);
            echo ","; ?></span>
        <?php } ?>
        <?php if ($settingsFields['company'] == 1) { ?>
            <span class="author-company"><?php echo esc_attr($testimonialDetail['company']);
            echo ","; ?></span>
        <?php } ?>
        <?php if ($settingsFields['location'] == 1) { ?>
            <span class="author-location"><?php echo esc_attr($testimonialDetail['location']); ?></span>
        <?php } ?>
    </div>
    <?php if ($settingsFields['rating'] == 1) { ?>
        <div class="author-rating">
            <?php for ($star = 1;$star <= $testimonialDetail['st_stars'];$star++) { ?>
                <i class="fa fa-star"></i>
            <?php } ?>
        </div>
    <?php } ?>
</div>
