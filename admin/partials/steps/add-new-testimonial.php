<?php
/**
 * Add new testimonial functionality of the plugin.
 *
 * @author  : gingerplugins <gingerplugins@gmail.com>
 * @license : GPL2
 * */



$postId = 0;
?>
<div class="gp-form-wrapper">
    <div class="gp-form-header">
        <div class="gp-header-left">
            <?php esc_html_e("New Testimonials", "superb-testimonials"); ?>
        </div>
    </div>
    <div class="gp-setting-page">
        <form action="<?php echo admin_url("admin-ajax.php") ?>" id="new_testimonial_form" autocomplete="off" method="post" >
            <div class="setting-body">
                <div class="setting-input">
                    <div class="setting-input-left">
                        <label for=""><?php esc_html_e("Testimonial Title:", "superb-testimonials"); ?><span class="text-danger">*</span> </label>
                    </div>
                    <div class="setting-input-right">
                        <input type="text" class="is-required" name="testimonial_settings[title]" placeholder="<?php esc_html_e("Enter testimonial title", "superb-testimonials"); ?>">
                    </div>
                </div>

                <div class="setting-input">
                    <div class="setting-input-left">
                        <label for="st_text"><?php esc_html_e("Testimonial Description:", "superb-testimonials"); ?></label>
                    </div>
                    <div class="setting-input-right">
                        <div class="st-text-area">
                            <?php
                            $settings = [
                                'media_buttons'    => false,
                                'wpautop'          => false,
                                'drag_drop_upload' => false,
                                'textarea_name'    => 'st_text',
                                'textarea_rows'    => 10,
                                'quicktags'        => false,
                                'placeholder'      => 'itis test',
                                'tinymce'          => [
                                    'toolbar2' => '',
                                    'toolbar3' => '',
                              'content_css' => get_stylesheet_directory_uri() . '/superb-testimonial-admin.css'
                                ],
                            ];
                            wp_editor("", "st_text", $settings);
                            ?>
                        </div>
                    </div>
                </div>

                <div class="setting-input">
                    <div class="setting-input-left">
                        <label for=""><?php esc_html_e("Author Name:", "superb-testimonials"); ?><span class="text-danger">*</span></label>
                    </div>
                    <div class="setting-input-right">
                        <input type="text" class="is-required" name="testimonial_settings[client_name]" placeholder="<?php esc_html_e("Enter author name", "superb-testimonials"); ?>">
                    </div>
                </div>

                <div class="setting-input">
                    <div class="setting-input-left">
                        <label for=""><?php esc_html_e("Author Image:", "superb-testimonials"); ?></label>
                    </div>
                    <div class="setting-input-right">
                        <div class="client-image-preview"></div>
                        <div class="image-buttons">
                            <button type="button" class="upload-button upload-image"><span class="dashicons dashicons-upload dashiicon-margin"></span><?php esc_html_e("Upload Image", "superb-testimonials"); ?></button>
                            <button type="button" class="remove-button remove-image"><i class="fa fa-trash"></i></button>
                            <input type="hidden" name="testimonial_settings[client_image]" id="client_image">
                        </div>
                    </div>
                </div>

                <div class="setting-input">
                    <div class="setting-input-left">
                        <label for=""><?php esc_html_e("Designation:", "superb-testimonials"); ?></label>
                    </div>
                    <div class="setting-input-right">
                        <input type="text" name="testimonial_settings[designation]" placeholder="<?php esc_html_e("Enter designation", "superb-testimonials"); ?>">
                    </div>
                </div>

                <div class="setting-input">
                    <div class="setting-input-left">
                        <label for=""><?php esc_html_e("Company:", "superb-testimonials"); ?></label>
                    </div>
                    <div class="setting-input-right">
                        <input type="text" name="testimonial_settings[company]" placeholder="<?php esc_html_e("Enter company", "superb-testimonials"); ?>">
                    </div>
                </div>

                <div class="setting-input">
                    <div class="setting-input-left">
                        <label for=""><?php esc_html_e("Location:", "superb-testimonials"); ?></label>
                    </div>
                    <div class="setting-input-right">
                        <input type="text" name="testimonial_settings[location]" placeholder="<?php esc_html_e("Enter location", "superb-testimonials"); ?>">
                    </div>
                </div>

                <div class="setting-input">
                    <div class="setting-input-left">
                        <label for="st_stars">Rating:</label>
                    </div>
                    <div class="setting-input-right">
                        <div class='rating-stars'>
                            <ul id='stars'>
                                <li class='star selected' data-value='1'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star selected' data-value='2'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star selected' data-value='3'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star selected' data-value='4'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star selected' data-value='5'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                            </ul>
                            <input type="hidden" name="testimonial_settings[st_stars]" id="st_stars" value="5" />
                        </div>
                    </div>
                </div>

                <div class="setting-input">
                    <div class="setting-input-left">
                        <label for=""><?php esc_html_e("Categories:", "superb-testimonials"); ?></label>
                    </div>
                    <div class="setting-input-right">
                        <?php
                            $arg   = [
                                'taxonomy'   => 'testimonial_categories',
                                'hide_empty' => false,
                                'order'      => "ASC",
                                'orderby'    => 'name',
                            ];
                            $terms = get_terms($arg);
                            ?>
                        <select name="testimonial_taxonomy[]" class="st-categories" multiple="multiple">
                            <?php foreach ($terms as $term) { ?>
                             <option value="<?php echo esc_attr($term->term_id) ?>"><?php echo esc_attr($term->name) ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

            </div>
            <div class="setting-footer">
                <button type="submit" name="submit" class="gp-submit-btn save-changes"><span class="gp-loader"><i class="fas fa-spin fa-sync"></i></span><span class="gp-default"><i class="far fa-check-circle"></i></span> <?php esc_html_e("Save Changes", "superb-testimonials"); ?></button>
                <input type="hidden" name="action" value="save_superb_testimonial_setting" />
                <input type="hidden" id="button_setting_nonce" name="nonce" value="<?php echo wp_create_nonce("save_superb_testimonial_setting".esc_attr($postId)) ?>" />
                <input type="hidden" id="button_setting_id" name="testimonial_id" value="<?php echo esc_attr($postId) ?>" />
            </div>
        </form>
    </div>
</div>
