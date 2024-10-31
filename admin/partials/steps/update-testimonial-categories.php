<?php
/**
 * Update testimonial categories functionality of the plugin.
 *
 * @author  : gingerplugins <gingerplugins@gmail.com>
 * @license : GPL2
 * */

if (!defined('ABSPATH')) {
    exit;
}

$termName = get_term($termId)->name; ?>
<div class="gp-form-wrapper">
    <div class="gp-form-header">
        <div class="gp-header-left">
            <?php esc_html_e("Update Categories", "superb-testimonials"); ?>
        </div>
    </div>
    <div class="gp-setting-page">
        <form action="<?php echo admin_url("admin-ajax.php") ?>" id="new_testimonial_form" autocomplete="off" method="post">
            <div class="dashboard-list-body">
                <div class="setting-input">
                    <div class="setting-input-left">
                        <label for="">Name:</label>
                    </div>
                    <div class="setting-input-right-category ">
                        <input type="text" class="is-required" name="testimonial_term" value="<?php echo esc_attr($termName) ?>">
                    </div>
                </div>
            </div>
            <div class="dashboard-list-footer">
                <button type="submit" class="gp-submit-btn save-changes"><span class="gp-loader"><i class="fas fa-spin fa-sync"></i></span><span class="gp-default"><i class="far fa-check-circle"></i></span><?php esc_html_e("Save Changes", "superb-testimonials"); ?></button>
                <input type="hidden" name="action" value="save_superb_testimonial_taxonomy" />
                <input type="hidden" id="button_setting_nonce" name="taxonomy_nonce" value="<?php echo wp_create_nonce("save_superb_testimonial_taxonomy".esc_attr($termId)) ?>" />
                <input type="hidden" id="button_setting_id" name="taxonomy_id" value="<?php echo esc_attr($termId) ?>" />
            </div>
        </form>
    </div>
</div>
