<?php
/**
 * Add and List categories functionality of the plugin.
 *
 * @author  : gingerplugins <gingerplugins@gmail.com>
 * @license : GPL2
 * */

if (!defined('ABSPATH')) {
    exit;
}

$termId = 0;

?>
<div class="gp-form-wrapper">
    <div class="gp-form-header">
        <div class="gp-header-left">
            <?php esc_html_e("Testimonial Categories", "superb-testimonials"); ?>
        </div>
    </div>
    <div class="gp-dashboard-data">
        <div class="gp-dashboard-lists mt-30">
            <div class="gp-dashboard-list">
                <form action="<?php echo admin_url("admin-ajax.php") ?>" id="new_testimonial_form" autocomplete="off" method="post">
                    <div class="dashboard-list-header">
                        <?php esc_html_e("Add Category", "superb-testimonials"); ?>
                    </div>
                    <div class="dashboard-list-body">
                        <div class="category-setting-input">
                            <div class="setting-input-left-category">
                                <label for="">Name:</label>
                            </div>
                            <div class="setting-input-right-category ">
                                <input type="text" class="is-required" name="testimonial_term" placeholder="<?php esc_html_e("Enter category name", "superb-testimonials"); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="dashboard-list-footer">
                        <button type="submit" class="gp-submit-btn save-changes"><span class="gp-loader"><i class="fas fa-spin fa-sync"></i></span><span class="gp-default"><i class="far fa-check-circle"></i></span><?php esc_html_e("Submit", "superb-testimonials"); ?></button>
                        <input type="hidden" name="action" value="save_superb_testimonial_taxonomy" />
                        <input type="hidden" id="button_setting_nonce" name="taxonomy_nonce" value="<?php echo wp_create_nonce("save_superb_testimonial_taxonomy".esc_attr($termId)) ?>" />
                        <input type="hidden" id="button_setting_id" name="taxonomy_id" value="<?php echo esc_attr($termId) ?>" />
                    </div>
                </form>
            </div>
            <div class="gp-dashboard-list">
                <div class="dashboard-list-header">
                    <?php esc_html_e("Categories", "superb-testimonials"); ?>
                </div>
                <div class="dashboard-list-body">
                    <?php
                        $terms = get_terms(
                            [
                                'taxonomy'   => 'testimonial_categories',
                                'hide_empty' => false,
                            ]
                        );
                        if (!empty($terms)) {
                            ?>
                    <table class="dashboard-list-table">
                        <thead>
                            <tr>
                                <th><?php esc_html_e("Title", "superb-testimonials"); ?></th>
                                <th class="action-col"><?php esc_html_e("Actions", "superb-testimonials"); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($terms as $term) { ?>
                            <tr data-nonce="<?php echo wp_create_nonce("term_action_".esc_attr($term->term_id)) ?>" class="term-col-<?php echo esc_attr($term->term_id) ?>">
                                <td><?php echo esc_attr($term->name) ?></td>
                                <td class="action-col actions">
                                    <a data-ginger-tooltip="<?php esc_html_e("Edit category", "superb-testimonials"); ?>" href="<?php echo esc_url(admin_url('admin.php?page=superb-testimonials-categories&task=edit-testimonial-category&edit='.esc_attr($term->term_id).'&nonce='.wp_create_nonce('edit_testimonials_category'.esc_attr($term->term_id)))) ?>" class="edit-form"><i class="fas fa-edit"></i></a>
                                    <a data-ginger-tooltip="<?php esc_html_e("Remove", "superb-testimonials"); ?>" href="#" class="remove-term remove-item" data-id="<?php echo esc_attr($term->term_id) ?>"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                        <?php } else {
                            ?>
                        <p class="no-data"><?php esc_html_e("No Categories are found", "superb-testimonials"); ?></p>
                        <?php }//end if
                        ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once dirname(__FILE__)."/../others/common.php";
