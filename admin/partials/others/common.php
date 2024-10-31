<?php
/**
 * Popup box functionality of the plugin.
 *
 * @author  : gingerplugins <gingerplugins@gmail.com>
 * @license : GPL2
 * */

if (!defined('ABSPATH')) {
    exit;
}
?>
<div class="gp-popup small">
    <div class="gp-popup-overlay"></div>
    <div class="gp-popup-content">
        <div class="gp-popup-header">
            <?php esc_html_e("Popup title", "superb-testimonials"); ?>
            <button class="gp-hide-popup"><i class="fas fa-times"></i></button>
        </div>
        <div class="gp-popup-body">
        </div>
        <div class="gp-popup-footer text-right">
            <button class="gp-popup-btn danger"><?php esc_html_e("Danger", "superb-testimonials"); ?></button>
            <button class="gp-popup-btn secondary hide-gp-popup"><?php esc_html_e("Secondary", "superb-testimonials"); ?></button>
            <button class="gp-popup-btn primary"><?php esc_html_e("Primary", "superb-testimonials"); ?></button>
        </div>
    </div>
</div>

<div class="gp-popup" id="create-form">
    <div class="gp-popup-overlay"></div>
    <div class="gp-popup-content">
        <div class="gp-popup-header">
            <?php esc_html_e("Create Form", "superb-testimonials"); ?>
            <button class="gp-hide-popup"><i class="fas fa-times"></i></button>
        </div>
        <div class="gp-popup-body">

        </div>
        <div class="gp-popup-footer text-right">
            <button class="gp-popup-btn secondary hide-gp-popup"><?php esc_html_e("Cancel", "superb-testimonials"); ?></button>
            <button class="gp-popup-btn primary"><?php esc_html_e("Create form", "superb-testimonials"); ?></button>
        </div>
    </div>
</div>

<div class="gp-popup" id="copy-shortcode">
    <div class="gp-popup-overlay"></div>
    <div class="gp-popup-content">
        <div class="gp-popup-header">
            <?php esc_html_e("Clone Shortcode", "superb-testimonials"); ?>
            <button class="gp-hide-popup hide-gp-popup"><i class="fas fa-times"></i></button>
        </div>
        <div class="gp-popup-body">
            <div class="clone-setting-input">
                <label for="" style="margin-left:2px;"><?php esc_html_e("Shortcode name:", "superb-testimonials"); ?></label>
                <input type="text" required="" id="colne_name" autocomplete="off" name="setting[clone_shortcode_name]" style="margin: 10px 0;">
            </div>
        </div>
        <div class="gp-popup-footer text-right">
            <button class="gp-popup-btn secondary hide-gp-popup"><?php esc_html_e("Cancel", "superb-testimonials"); ?></button>
            <button class="gp-popup-btn primary" id="copy_shortcode"><?php esc_html_e("Create Shortcode", "superb-testimonials"); ?></button>
        </div>
    </div>
</div>

<div class="gp-popup small" id="delete-testimonial">
    <div class="gp-popup-overlay"></div>
    <div class="gp-popup-content">
        <div class="gp-popup-header">
            <?php esc_html_e("Delete Testimonial", "superb-testimonials"); ?>
            <button class="gp-hide-popup hide-gp-popup"><i class="fas fa-times"></i></button>
        </div>
        <div class="gp-popup-body popup-text">
            <?php esc_html_e("Are you sure, you want to delete this testimonial?", "superb-testimonials") ?>
        </div>
        <div class="gp-popup-footer text-right">
            <button class="gp-popup-btn secondary hide-gp-popup"><?php esc_html_e("Cancel", "superb-testimonials"); ?></button>
            <button class="gp-popup-btn danger" id="delete_testimonial"><?php esc_html_e("Delete", "superb-testimonials"); ?></button>
        </div>
    </div>
</div>

<div class="gp-popup small" id="delete-term">
    <div class="gp-popup-overlay"></div>
    <div class="gp-popup-content">
        <div class="gp-popup-header">
            <?php esc_html_e("Delete Category", "superb-testimonials"); ?>
            <button class="gp-hide-popup hide-gp-popup"><i class="fas fa-times"></i></button>
        </div>
        <div class="gp-popup-body popup-text">
            <?php esc_html_e("Are you sure, you want to delete this category?", "superb-testimonials") ?>
        </div>
        <div class="gp-popup-footer text-right">
            <button class="gp-popup-btn secondary hide-gp-popup"><?php esc_html_e("Cancel", "superb-testimonials"); ?></button>
            <button class="gp-popup-btn danger" id="delete_term"><?php esc_html_e("Delete", "superb-testimonials"); ?></button>
        </div>
    </div>
</div>

<div class="gp-popup small" id="delete-shortcode">
    <div class="gp-popup-overlay"></div>
    <div class="gp-popup-content">
        <div class="gp-popup-header">
            <?php esc_html_e("Delete Shortcode", "superb-testimonials"); ?>
            <button class="gp-hide-popup hide-gp-popup"><i class="fas fa-times"></i></button>
        </div>
        <div class="gp-popup-body popup-text">
            <?php esc_html_e("Are you sure, you want to delete this shortcode?", "superb-testimonials") ?>
        </div>
        <div class="gp-popup-footer text-right">
            <button class="gp-popup-btn secondary hide-gp-popup"><?php esc_html_e("Cancel", "superb-testimonials"); ?></button>
            <button class="gp-popup-btn danger" id="delete_shortcode"><?php esc_html_e("Delete", "superb-testimonials"); ?></button>
        </div>
    </div>
</div>
