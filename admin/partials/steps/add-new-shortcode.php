<?php
/**
 * Add new shortcode functionality of the plugin.
 *
 * @author  : gingerplugins <gingerplugins@gmail.com>
 * @license : GPL2
 * */

if (!defined('ABSPATH')) {
    exit;
}

$settings        = get_post_meta($codeId, "shortcode_settings", true);
$settings        = isset($settings)&&is_array($settings) ? $settings : [];
$defaultSettings = [
    'sc_type'               => '',
    'sc_style'              => '',
    'shortcode_name'        => '',
    'sc_column_radio'       => 3,
    'st_setting_categories' => [],
    'no_of_testimonial'     => '',
    'st_setting_order'      => 'date_ascending',
    'fields'                => [
        'title'       => 1,
        'desc'        => 1,
        'name'        => 1,
        'image'       => 1,
        'designation' => 1,
        'company'     => 1,
        'location'    => 1,
        'rating'      => 1,
    ],
];
$settings        = shortcode_atts($defaultSettings, $settings);

$settingsColor        = get_post_meta($codeId, "shortcode_settings_color", true);
$settingsColor        = isset($settingsColor)&&is_array($settingsColor) ? $settingsColor : [];
$defaultSettingsColor = [
    'title_color'       => '#000000',
    'description_color' => '#000000',
    'author_name'       => '#000000',
    'designation'       => '#000000',
    'company'           => '#000000',
    'location'          => '#000000',
    'rating'            => '#FFCC36',
    'desc_bg'           => '#f0f0f1',
];
$settingsColor        = shortcode_atts($defaultSettingsColor, $settingsColor);
?>
<div class="gp-form-wrapper">
    <div class="gp-form-header">
        <div class="gp-header-left">
            <?php esc_html_e("New Shortcode", "superb-testimonials"); ?>
        </div>
    </div>
    <div class="sc-columns">
        <div class="sc-first-column button-2">
        <!--            <button class="sc-button sc-first-button active" id="sc_type_button">--><?php
        // esc_html_e("Type", "superb-testimonials");?><!--</button>-->
            <button class="sc-button sc-second-button active" id="sc_style_button"><?php esc_html_e("Style", "superb-testimonials");?></button>
            <button class="sc-button" disabled id="sc_styling_button"><?php esc_html_e("Styling", "superb-testimonials");?></button>
            <button class="sc-button" disabled id="sc_setting_button"><?php esc_html_e("Setting", "superb-testimonials");?></button>
        </div>
        <div class="sc-second-column">
            <form action="<?php echo admin_url("admin-ajax.php") ?>" id="new_testimonial_form" autocomplete="off" method="post" >
                <div class="sc-type-style">
                    <div class="create-shortcode" id="sc_type">
                        <div class="sc-radio">
                        <div class="sc-type-radio" data-value="Grid" id="sc_type_Grid">
                               <input id="sc_grid" type="radio" name="setting[sc_type]" class="sr-only sc-type" value="Grid" <?php checked($settings['sc_type'], "Grid") ?>/>
                            <label for="sc_grid">
                                <svg xmlns="http://www.w3.org/2000/svg" width="98" height="93" viewBox="0 0 98 93">
                                    <g id="Group_1" data-name="Group 1" transform="translate(-138 -142)">
                                        <rect id="Rectangle_4" data-name="Rectangle 4" width="26" height="26" rx="3" transform="translate(138 142)" fill="#0091ff"/>
                                        <rect id="Rectangle_7" data-name="Rectangle 7" width="26" height="26" rx="3" transform="translate(138 176)" fill="#0091ff"/>
                                        <rect id="Rectangle_12" data-name="Rectangle 12" width="26" height="26" rx="3" transform="translate(138 209)" fill="#0091ff"/>
                                        <rect id="Rectangle_5" data-name="Rectangle 5" width="26" height="26" rx="3" transform="translate(174 142)" fill="#0091ff"/>
                                        <rect id="Rectangle_9" data-name="Rectangle 9" width="26" height="26" rx="3" transform="translate(210 142)" fill="#0091ff"/>
                                        <rect id="Rectangle_6" data-name="Rectangle 6" width="26" height="26" rx="3" transform="translate(174 176)" fill="#0091ff"/>
                                        <rect id="Rectangle_11" data-name="Rectangle 11" width="26" height="26" rx="3" transform="translate(174 209)" fill="#0091ff"/>
                                        <rect id="Rectangle_8" data-name="Rectangle 8" width="26" height="26" rx="3" transform="translate(210 176)" fill="#0091ff"/>
                                        <rect id="Rectangle_10" data-name="Rectangle 10" width="26" height="26" rx="3" transform="translate(210 209)" fill="#0091ff"/>
                                    </g>
                                </svg>
                                <p><?php esc_html_e("Grid", "superb-testimonials"); ?></p>
                            </label>
                        </div>
                        <div class="sc-type-radio" data-value="Wall" id="sc_type_Wall">
                            <input id="sc_wall" type="radio" name="setting[sc_type]" class="sr-only sc-type" value=Wall <?php checked($settings['sc_type'], "Wall") ?>/>
                            <label for="sc_wall">
                                <svg xmlns="http://www.w3.org/2000/svg" width="97" height="93" viewBox="0 0 97 93">
                                    <g id="Group_2" data-name="Group 2" transform="translate(-139 -142)">
                                        <rect id="Rectangle_4" data-name="Rectangle 4" width="26" height="93" rx="3" transform="translate(139 142)" fill="#0091ff"/>
                                        <rect id="Rectangle_5" data-name="Rectangle 5" width="26" height="93" rx="3" transform="translate(175 142)" fill="#0091ff"/>
                                        <rect id="Rectangle_9" data-name="Rectangle 9" width="26" height="93" rx="3" transform="translate(210 142)" fill="#0091ff"/>
                                    </g>
                                </svg>
                                <p><?php esc_html_e("Wall", "superb-testimonials"); ?></p>
                            </label>
                        </div>
                    </div>
                    </div>
                    <input type="hidden" name="setting[sc_type]" class="sc-type" value="Grid"/>
                    <div class="create-shortcode active" id="sc_style">
                        <?php $content = Superb_Testimonials::content_array();
                        ?>
                        <h2><?php esc_html_e("Step 1: Choose your testimonial style", "superb-testimonials")?></h2>
                        <div class="setting-body">
                            <div class="style-box" data-style="1" id="sc_style_1">
                                <div class="superb-style superb-style-1">
                                    <div class="superb-grid">
                                        <div class="superb-grid-row">
                                        <?php for ($i = 0;$i < 3;$i++) {
                                            $key = rand(1,6);?>
                                            <div class="grid-col-3">
                                                <div class="superb-testimonial">
                                                    <div class="superb-content">
                                                        <div class="superb-title"><?php echo esc_attr($content[$key]['title']) ?></div>
                                                        <?php echo esc_attr($content[$key]['content']) ?>
                                                    </div>
                                                    <div class="superb-bottom">
                                                        <div class="superb-left">
                                                            <div class="author-image">
                                                                <img src="<?php echo esc_url($content[$key]['author_image']) ?>">
                                                            </div>
                                                        </div>
                                                        <div class="superb-right">
                                                            <div class="author-name"><?php echo esc_attr($content[$key]['author_name']) ?></div>
                                                            <div class="author-info">
                                                                <span class="author-designation"><?php echo esc_attr($content[$key]['designation']) ?></span> <span class="author-company"><?php echo esc_attr($content[$key]['company']) ?></span> <span class="author-location"><?php echo esc_attr($content[$key]['location']) ?></span>
                                                            </div>
                                                            <div class="author-rating">
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php }//end for
                                        ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="style-overlay">
                                    <a href="#" class="select-style"><?php esc_html_e("Customize Style", "superb-testimonials"); ?></a>
                                </div>
                            </div>

                            <div class="style-box" data-style="2" id="sc_style_2">
                                <div class="superb-style superb-style-2">
                                    <div class="superb-grid">
                                        <div class="superb-grid-row">
                                            <?php for ($i = 0;$i < 3;$i++) {
                                                $key = rand(1,6); ?>
                                                <div class="grid-col-3">
                                                    <div class="superb-testimonial">
                                                        <div class="superb-bottom">
                                                            <div class="superb-left">
                                                                <div class="author-image">
                                                                    <img src="<?php echo esc_url($content[$key]['author_image']) ?>">
                                                                </div>
                                                            </div>
                                                            <div class="superb-right">
                                                                <div class="author-name"><?php echo esc_attr($content[$key]['author_name']) ?></div>
                                                                <div class="author-info">
                                                                    <span class="author-designation"><?php echo esc_attr($content[$key]['designation']) ?></span> <span class="author-company"><?php echo esc_attr($content[$key]['company']) ?></span> <span class="author-location"><?php echo esc_attr($content[$key]['location']) ?></span>
                                                                </div>
                                                                <div class="author-rating">
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="superb-content">
                                                            <div class="superb-title"><?php echo esc_attr($content[$key]['title']) ?></div>
                                                            <?php echo esc_attr($content[$key]['content']) ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php }//end for
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="style-overlay">
                                    <a href="#" class="select-style"><?php esc_html_e("Customize Style", "superb-testimonials"); ?></a>
                                </div>
                            </div>

                            <div class="style-box" data-style="3" id="sc_style_3">
                                <div class="superb-style superb-style-3">
                                    <div class="superb-grid">
                                        <div class="superb-grid-row">
                                        <?php for ($i = 0;$i < 3;$i++) {
                                            $key = rand(1,6); ?>
                                            <div class="grid-col-3">
                                                <div class="superb-content">
                                                    <div class="author-image">
                                                        <img src="<?php echo esc_url($content[$key]['author_image']) ?>">
                                                    </div>
                                                    <div class="superb-title"><?php echo esc_attr($content[$key]['title']) ?></div>
                                                    <?php echo esc_attr($content[$key]['content']) ?>
                                                </div>
                                                <div class="superb-bottom">
                                                    <div class="author-name"><?php echo esc_attr($content[$key]['author_name']) ?></div>
                                                    <div class="author-info">
                                                        <span class="author-designation"><?php echo esc_attr($content[$key]['designation']) ?></span> <span class="author-company"><?php echo esc_attr($content[$key]['company']) ?></span> <span class="author-location"><?php echo esc_attr($content[$key]['location']) ?></span>
                                                    </div>
                                                    <div class="author-rating">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php }//end for
                                        ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="style-overlay">
                                    <a href="#" class="select-style"><?php esc_html_e("Customize Style", "superb-testimonials"); ?></a>
                                </div>
                            </div>

                            <div class="style-box" data-style="4" id="sc_style_4">
                                <div class="superb-style superb-style-4">
                                    <div class="superb-grid">
                                        <div class="superb-grid-row">
                                            <?php for ($i = 0;$i < 3;$i++) {
                                                $key = rand(1,6); ?>
                                                <div class="grid-col-3">
                                                    <div class="superb-top">
                                                        <div class="author-name"><?php echo esc_attr($content[$key]['author_name']) ?></div>
                                                        <div class="author-info">
                                                            <span class="author-designation"><?php echo esc_attr($content[$key]['designation']) ?></span> <span class="author-company"><?php echo esc_attr($content[$key]['company']) ?></span> <span class="author-location"><?php echo esc_attr($content[$key]['location']) ?></span>
                                                        </div>
                                                        <div class="author-rating">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                    </div>
                                                    <div class="superb-content">
                                                        <div class="author-image">
                                                            <img src="<?php echo esc_url($content[$key]['author_image']) ?>">
                                                        </div>
                                                        <div class="superb-title"><?php echo esc_attr($content[$key]['title']) ?></div>
                                                        <?php echo esc_attr($content[$key]['content']) ?>
                                                    </div>
                                                </div>
                                            <?php }//end for
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="style-overlay">
                                    <a href="#" class="select-style"><?php esc_html_e("Customize Style", "superb-testimonials"); ?></a>
                                </div>
                            </div>
                            <input type="hidden" name="setting[sc_style]" id="sc_style_value" value="<?php echo esc_attr($settings['sc_style']) ?>">
                        </div>
                    </div>
                </div>
                <div class="sc-style-setting">
                    <div class="style-setting-left">
                        <div class="create-shortcode" id="sc_styling">
                            <h2><?php esc_html_e("Step 2: Choose your styling", "superb-testimonials")?></h2>
                            <div class="setting-body">
                                <div class="setting-input">
                                <div class="setting-input-left">
                                    <label for=""><?php esc_html_e("Testimonial Title:", "superb-testimonials"); ?></label>
                                </div>
                                <div class="setting-input-right testimonial-color">
                                    <input type="text" name="setting_color[title_color]" class="fab-color-picker" id="widget_bg_color" value="<?php echo esc_attr($settingsColor['title_color']) ?>" />
                                </div>
                            </div>
                                <div class="setting-input">
                                    <div class="setting-input-left">
                                        <label for=""><?php esc_html_e("Testimonial Description:", "superb-testimonials"); ?></label>
                                    </div>
                                    <div class="setting-input-right testimonial-color">
                                        <input type="text" name="setting_color[description_color]" class="fab-color-picker" id="widget_bg_color" value="<?php echo esc_attr($settingsColor['description_color']) ?>" />
                                    </div>
                                </div>
                                <div class="setting-input">
                                    <div class="setting-input-left">
                                        <label for=""><?php esc_html_e("Author Name:", "superb-testimonials"); ?></label>
                                    </div>
                                    <div class="setting-input-right testimonial-color">
                                        <input type="text" name="setting_color[author_name]" class="fab-color-picker" id="widget_bg_color" value="<?php echo esc_attr($settingsColor['author_name']) ?>" />
                                    </div>
                                </div>
                                <div class="setting-input">
                                    <div class="setting-input-left">
                                        <label for=""><?php esc_html_e("Designation:", "superb-testimonials"); ?></label>
                                    </div>
                                    <div class="setting-input-right testimonial-color">
                                        <input type="text" name="setting_color[designation]" class="fab-color-picker" id="widget_bg_color" value="<?php echo esc_attr($settingsColor['designation']) ?>" />
                                    </div>
                                </div>
                                <div class="setting-input">
                                    <div class="setting-input-left">
                                        <label for=""><?php esc_html_e("Company:", "superb-testimonials"); ?></label>
                                    </div>
                                    <div class="setting-input-right testimonial-color">
                                        <input type="text" name="setting_color[company]" class="fab-color-picker" id="widget_bg_color" value="<?php echo esc_attr($settingsColor['company']) ?>" />
                                    </div>
                                </div>
                                <div class="setting-input">
                                    <div class="setting-input-left">
                                        <label for=""><?php esc_html_e("Location:", "superb-testimonials"); ?></label>
                                    </div>
                                    <div class="setting-input-right testimonial-color">
                                        <input type="text" name="setting_color[location]" class="fab-color-picker" id="widget_bg_color" value="<?php echo esc_attr($settingsColor['location']) ?>" />
                                    </div>
                                </div>
                                <div class="setting-input">
                                    <div class="setting-input-left">
                                        <label for=""><?php esc_html_e("Rating:", "superb-testimonials"); ?></label>
                                    </div>
                                    <div class="setting-input-right testimonial-color">
                                        <input type="text" name="setting_color[rating]" class="fab-color-picker" id="widget_bg_color" value="<?php echo esc_attr($settingsColor['rating']) ?>" />
                                    </div>
                                </div>
                                <div class="setting-input">
                                    <div class="setting-input-left">
                                        <label for=""><?php esc_html_e("Description Color:", "superb-testimonials"); ?></label>
                                    </div>
                                    <div class="setting-input-right testimonial-color">
                                        <input type="text" name="setting_color[desc_bg]" class="fab-color-picker" id="widget_bg_color" value="<?php echo esc_attr($settingsColor['desc_bg']) ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="setting-footer">
                                <button type="button" class="secondary-button prev-style"><i class="fas fa-angle-left"></i><?php esc_html_e("Back", "superb-testimonials")?></button>
                                <button type="button" class="gp-submit-btn next-setting"><?php esc_html_e("Next", "superb-testimonials")?><i class="fas fa-angle-right"></i></button>
                            </div>
                        </div>

                        <div class="create-shortcode" id="sc_setting">
                            <h2><?php esc_html_e("Step 3: Settings", "superb-testimonials")?></h2>
                            <div class="setting-body">
                                <div class="setting-input">
                                    <div class="setting-input-left">
                                        <label for=""><?php esc_html_e("Shortcode name:", "superb-testimonials"); ?></label>
                                    </div>
                                    <div class="setting-input-right">
                                        <input type="text" class="is-required" name="setting[shortcode_name]" value="<?php echo esc_attr($settings['shortcode_name']) ?>">
                                    </div>
                                </div>
                                <div class="setting-input">
                                    <div class="setting-input-left">
                                        <label for=""><?php esc_html_e("Columns:", "superb-testimonials"); ?></label>
                                    </div>
                                    <div class="setting-input-right setting-column">
                                        <div class="fabulo-testimonial-radio-box">
                                            <?php for ($i = 1; $i <= 4; $i++) { ?>
                                                <div class="fabulo-testimonial-radio">
                                                    <input type="radio" class="sr-only" name="setting[sc_column_radio]" value="<?php echo esc_attr($i) ?>" id="column_<?php echo esc_attr($i) ?>" <?php checked($settings['sc_column_radio'], $i) ?>>
                                                    <label for="column_<?php echo esc_attr($i) ?>"><?php echo esc_attr($i) ?></label>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="setting-input">
                                    <div class="setting-input-left">
                                        <label for=""><?php esc_html_e("No. of testimonial:", "superb-testimonials"); ?></label>
                                    </div>
                                    <div class="setting-input-right">
                                        <input type="number" class="is-required" name="setting[no_of_testimonial]" min="1" value="<?php echo esc_attr($settings['no_of_testimonial']) ?>">
                                    </div>
                                </div>
                                <div class="setting-input">
                                    <div class="setting-input-left">
                                        <label for=""><?php esc_html_e("Order:", "superb-testimonials"); ?></label>
                                    </div>
                                    <div class="setting-input-right order-setting">
                                        <select name="setting[st_setting_order]" class="st-setting-order">
                                            <option <?php selected($settings['st_setting_order'], "date_ascending") ?> value="date_ascending"><?php esc_html_e("Date ascending", "superb-testimonials") ?></option>
                                            <option <?php selected($settings['st_setting_order'], "date_descending") ?> value="date_descending"><?php esc_html_e("Date descending", "superb-testimonials") ?></option>
                                            <option <?php selected($settings['st_setting_order'], "title_ascending") ?> value="title_ascending"><?php esc_html_e("Title ascending", "superb-testimonials") ?></option>
                                            <option <?php selected($settings['st_setting_order'], "title_descending") ?> value="title_descending"><?php esc_html_e("Title descending", "superb-testimonials") ?></option>
                                        </select>
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
                                        <select name="setting[st_setting_categories][]" class="st-setting-categories" multiple="multiple">
                                            <?php foreach ($terms as $term) {
                                                $selected = in_array($term->term_id, $settings['st_setting_categories']) ? "selected" : "";?>
                                                <option <?php echo esc_attr($selected) ?> value="<?php echo esc_attr($term->term_id) ?>"><?php echo esc_attr($term->name) ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <?php
                                $fields = $settings['fields'];
                                ?>
                                <div class="setting-input">
                                <div class="setting-input-left">
                                    <label for=""><?php esc_html_e("Fields:", "superb-testimonials"); ?></label>
                                </div>
                                <div class="setting-input-right">
                                    <div class="gp-checkbox">
                                        <input type="hidden" name="setting[fields][title]" value="0" />
                                        <input id="testimonial_title" type="checkbox" name="setting[fields][title]" class="sr-only setting-fields" value="1" <?php checked($fields['title'], 1) ?>/>
                                        <label for="testimonial_title"><?php esc_html_e("Testimonial Title", "superb-testimonials"); ?></label>
                                    </div>
                                    <div class="gp-checkbox">
                                        <input type="hidden" name="setting[fields][name]" value="0" />
                                        <input id="author_name" type="checkbox" name="setting[fields][name]" class="sr-only setting-fields" value="1" <?php checked($fields['name'], 1) ?> />
                                        <label for="author_name"><?php esc_html_e("Author Name", "superb-testimonials"); ?></label>
                                    </div>
                                    <div class="gp-checkbox">
                                        <input type="hidden" name="setting[fields][image]" value="0" />
                                        <input id="author_image" type="checkbox" name="setting[fields][image]" class="sr-only setting-fields" value="1" <?php checked($fields['image'], 1) ?> />
                                        <label for="author_image"><?php esc_html_e("Author Image", "superb-testimonials"); ?></label>
                                    </div>
                                    <div class="gp-checkbox">
                                        <input type="hidden" name="setting[fields][designation]" value="0" />
                                        <input id="designation" type="checkbox" name="setting[fields][designation]" class="sr-only setting-fields" value="1" <?php checked($fields['designation'], 1) ?> />
                                        <label for="designation"><?php esc_html_e("Designation", "superb-testimonials"); ?></label>
                                    </div>
                                    <div class="gp-checkbox">
                                        <input type="hidden" name="setting[fields][company]" value="0" />
                                        <input id="company" type="checkbox" name="setting[fields][company]" class="sr-only setting-fields" value="1" <?php checked($fields['company'], 1) ?> />
                                        <label for="company"><?php esc_html_e("Company", "superb-testimonials"); ?></label>
                                    </div>
                                    <div class="gp-checkbox">
                                        <input type="hidden" name="setting[fields][location]" value="0" />
                                        <input id="location" type="checkbox" name="setting[fields][location]" class="sr-only setting-fields" value="1" <?php checked($fields['location'], 1) ?> />
                                        <label for="location"><?php esc_html_e("Location", "superb-testimonials"); ?></label>
                                    </div>
                                    <div class="gp-checkbox">
                                        <input type="hidden" name="setting[fields][rating]" value="0" />
                                        <input id="rating" type="checkbox" name="setting[fields][rating]" class="sr-only setting-fields" value="1" <?php checked($fields['rating'], 1) ?> />
                                        <label for="rating"><?php esc_html_e("Rating", "superb-testimonials"); ?></label>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="setting-footer">
                                <button type="button" class="secondary-button prev-style"><i class="fas fa-angle-left"></i><?php esc_html_e("Back", "superb-testimonials")?></button>
                                <button type="submit" name="submit" class="gp-submit-btn save-changes"><span class="gp-loader"><i class="fas fa-spin fa-sync"></i></span><span class="gp-default"><i class="far fa-check-circle"></i></span> <?php esc_html_e("Save Changes", "superb-testimonials"); ?></button>
                                <input type="hidden" name="action" value="save_superb_testimonial_shortcode_setting" />
                                <input type="hidden" id="button_shortcode_nonce" name="nonce" value="<?php echo wp_create_nonce("save_superb_testimonial_shortcode_setting".esc_attr($codeId)) ?>" />
                                <input type="hidden" id="button_shortcode_id" name="shortcode_id" value="<?php echo esc_attr($codeId) ?>" />
                                <?php
                                $paged = filter_input(INPUT_GET,"paged");
                                ?>
                                <input type="hidden" id="page_no" name="page_num" value="<?php echo esc_attr($paged) ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="style-setting-right">
                        <div class="sc-third-column">
                            <div class="styling-preview">

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
