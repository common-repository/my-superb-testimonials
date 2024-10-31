<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @package    Superb_Testimonials
 * @subpackage Superb_Testimonials/admin
 *
 * @author  : gingerplugins <gingerplugins@gmail.com>
 * @license : GPL2
 *
 * @link  gingerplugins
 * @since 1.0.0
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Superb_Testimonials
 * @subpackage Superb_Testimonials/admin
 * @author     gingerplugins <gingerplugins@gmail.com>
 */

if (!defined('ABSPATH')) {
    exit;
}

class Superb_Testimonials_Admin
{

    /**
     * The ID of this plugin.
     *
     * @var    string    $pluginName    The ID of this plugin.
     * @since  1.0.0
     * @access private
     */
    private $pluginName;

    /**
     * The version of this plugin.
     *
     * @var    string    $version    The current version of this plugin.
     * @since  1.0.0
     * @access private
     */
    private $version;

    /**
     * The version of this plugin.
     *
     * @var    boolean    $isPluginPage    Check plugin page.
     * @since  1.0.0
     * @access public
     */
    public $isPluginPage = false;


    /**
     * Initialize the class and set its properties.
     *
     * @param string $pluginName The name of this plugin.
     * @param string $version    The version of this plugin.
     *
     * @since 1.0.0
     */
    public function __construct($pluginName, $version)
    {

        $this->pluginName = $pluginName;
        $this->version    = $version;
        $pages            = filter_input(INPUT_GET, 'page');
        $page = isset($pages) ? sanitize_text_field($pages) : "";
        if (in_array($page, [$this->pluginName, $this->pluginName."-categories", $this->pluginName."-short-codes", $this->pluginName."-testimonials", $this->pluginName."-pro"])) {
            $this->isPluginPage = true;
        }

    }//end __construct()


    /**
     * Register a post type.
     *
     * @since 1.0.0
     */
    public function register_post_type()
    {
        register_post_type(
            'superb_testimonials',
            // CPT Options.
             [
                 'labels'       => [
                     'name'          => __('Superb Testimonials', 'superb-testimonials'),
                     'singular_name' => __('Superb Testimonials', 'superb-testimonials'),
                 ],
                 'public'       => false,
                 'has_archive'  => false,
                 'rewrite'      => ['slug' => 'superb_testimonials'],
                 'show_in_rest' => false,
             ]
        );
        register_taxonomy(
            'testimonial_categories',
            'superb_testimonials',
            [
                "hierarchical"      => true,
                "label"             => "Categories",
                "singular_label"    => "Category",
                'query_var'         => true,
                'rewrite'           => [
                    'slug'       => 'testimonial_categories',
                    'with_front' => false,
                ],
                'public'            => true,
                'show_ui'           => true,
                'show_tagcloud'     => true,
                '_builtin'          => false,
                'show_in_nav_menus' => false,
            ]
        );
        register_post_type(
            'superb_code',
            // CPT Options.
             [
                 'labels'       => [
                     'name'          => __('Testimonials Shortcode', 'superb-testimonials'),
                     'singular_name' => __('Testimonials Shortcode', 'superb-testimonials'),
                 ],
                 'public'       => false,
                 'has_archive'  => false,
                 'rewrite'      => ['slug' => 'superb_code'],
                 'show_in_rest' => false,
             ]
        );

    }//end register_post_type()


    /**
     * Create a menu of the plugin.
     *
     * @since 1.0.0
     */
    public function admin_menu()
    {
        add_menu_page(
            "Superb Testimonials",
            "Superb Testimonials",
            'manage_options',
            $this->pluginName,
            [
                $this,
                'all_testimonials',
            ],
            'dashicons-format-quote'
        );

        add_submenu_page(
            $this->pluginName,
            esc_html__('All Testimonials', 'superb-testimonials'),
            esc_html__('All Testimonials', 'superb-testimonials'),
            'manage_options',
            $this->pluginName,
            [
                $this,
                'all_testimonials',
            ]
        );

        add_submenu_page(
            $this->pluginName,
            esc_html__('Categories', 'superb-testimonials'),
            esc_html__('Categories', 'superb-testimonials'),
            'manage_options',
            $this->pluginName."-categories",
            [
                $this,
                'testimonial_categories',
            ]
        );

        add_submenu_page(
            $this->pluginName,
            esc_html__('Shortcodes', 'superb-testimonials'),
            esc_html__('Shortcodes', 'superb-testimonials'),
            'manage_options',
            $this->pluginName."-short-codes",
            [
                $this,
                'short_codes',
            ]
        );

    }//end admin_menu()


    /**
     * Register the stylesheets for the admin area.
     *
     * @since 1.0.0
     */
    public function enqueue_styles()
    {
        /*
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Superb_Testimonials_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Superb_Testimonials_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        if ($this->isPluginPage) {
            wp_enqueue_style($this->pluginName."-sumoselect", plugin_dir_url(__FILE__).'css/sumoselect.css', [], $this->version, 'all');
            wp_enqueue_style($this->pluginName, plugin_dir_url(__FILE__).'css/superb-testimonials-admin.css', [], $this->version, 'all');
            wp_enqueue_style($this->pluginName.'-admin-style', plugin_dir_url(__FILE__)."css/admin-style.css", [], $this->version);
            wp_enqueue_style($this->pluginName.'-style', plugin_dir_url(__FILE__)."../public/css/superb-testimonials-public.css", [], $this->version);
            wp_enqueue_style($this->pluginName.'font-awesome', "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css");
            $flag = get_option("superb_testimonials_signup_status");
            if($flag == 0){
                wp_enqueue_style($this->pluginName.'-signup-style', plugin_dir_url(__FILE__)."css/sign-up.css", [], $this->version);
            }
            wp_enqueue_style('wp-color-picker');
        }

    }//end enqueue_styles()


    /**
     * Register the JavaScript for the admin area.
     *
     * @since 1.0.0
     */
    public function enqueue_scripts()
    {
        /*
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Superb_Testimonials_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Superb_Testimonials_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        if ($this->isPluginPage) {
            $minified = ".min";
            if (SUPERB_TESTIMONIALS_DEV_VERSION) {
                $minified = "";
            }

            wp_enqueue_media();
            wp_enqueue_script($this->pluginName."-sumoselect", plugin_dir_url(__FILE__).'js/jquery.sumoselect'.esc_attr($minified).'.js', [ 'jquery' ], $this->version, false);
            wp_enqueue_script($this->pluginName, plugin_dir_url(__FILE__).'js/superb-testimonials-admin'.esc_attr($minified).'.js', ['jquery', 'wp-color-picker'], $this->version, false);
            wp_enqueue_script($this->pluginName.'-admin-script', plugin_dir_url(__FILE__).'js/common-script'.esc_attr($minified).'.js', ['jquery'], $this->version);
            wp_enqueue_script($this->pluginName."-ajaxsubmit", plugin_dir_url(__FILE__).'js/jquery.ajaxsubmit.js', [ 'jquery' ], $this->version, false);
            wp_localize_script(
                $this->pluginName,
                'SUPERB_TESTIMONIAL',
                [
                    'AJAX_URL' => admin_url("admin-ajax.php"),
                ]
            );
        }

    }//end enqueue_scripts()


    /**
     * Include a page of add, update and list of all testimonials.
     *
     * @since 1.0.0
     */
    public function all_testimonials()
    {
        $flag = get_option("superb_testimonials_signup_status");
        if($flag == 1){
            $task  = filter_input(INPUT_GET, 'task');
            $edit  = filter_input(INPUT_GET, 'edit');
            $nonce = filter_input(INPUT_GET, 'nonce');
            if (isset($task) && $task == "add-new") {
                include_once dirname(__FILE__)."/partials/steps/add-new-testimonial.php";
            } else if (isset($task) && $task == "edit-testimonial" && isset($edit) && isset($nonce)) {
                $postId = isset($edit) ? sanitize_text_field($edit) : 0;
                $nonce  = isset($nonce) ? sanitize_text_field($nonce) : "";
                if (wp_verify_nonce($nonce, "edit_testimonials_".esc_attr($postId))) {
                    $postData = get_post($postId);
                    if (!empty($postData) && isset($postData->post_type) && $postData->post_type == "superb_testimonials") {
                        $postContent = $postData->post_content;
                    }

                    include_once dirname(__FILE__)."/partials/steps/update-testimonial.php";
                }
            } else {
                include_once dirname(__FILE__)."/partials/steps/all-testimonials.php";
            }
        } else {
            include_once dirname(__FILE__)."/partials/steps/signup-page.php";
        }

    }//end all_testimonials()


    /**
     * Include a page of add, update and list of all testimonial categories.
     *
     * @since 1.0.0
     */
    public function testimonial_categories()
    {
        $task  = filter_input(INPUT_GET, 'task');
        $edit  = filter_input(INPUT_GET, 'edit');
        $nonce = filter_input(INPUT_GET, 'nonce');
        if (isset($task) && $task == "edit-testimonial-category" && isset($edit) && isset($nonce)) {
            $termId = isset($edit) ? sanitize_text_field($edit) : 0;
            $nonce  = isset($nonce) ? sanitize_text_field($nonce) : "";
            if (wp_verify_nonce($nonce, "edit_testimonials_category".esc_attr($termId))) {
                include_once dirname(__FILE__)."/partials/steps/update-testimonial-categories.php";
            }
        } else {
            include_once dirname(__FILE__)."/partials/steps/testimonial-categories.php";
        }

    }//end testimonial_categories()


    /**
     * Include a page of add and list of all shortcodes.
     *
     * @since 1.0.0
     */
    public function short_codes()
    {
        $task  = filter_input(INPUT_GET, 'task');
        $edit  = filter_input(INPUT_GET, 'edit');
        $nonce = filter_input(INPUT_GET, 'nonce');
        if (isset($task) && $task == "add-new-shortcode") {
            $codeId = 0;
            include_once dirname(__FILE__)."/partials/steps/add-new-shortcode.php";
        } else if (isset($task) && $task == "edit-shortcode" && isset($edit) && isset($nonce)) {
            $codeId = isset($edit) ? sanitize_text_field($edit) : 0;
            $nonce  = isset($nonce) ? sanitize_text_field($nonce) : "";
            if (wp_verify_nonce($nonce, "edit_shortcodes_".esc_attr($codeId))) {
                include_once dirname(__FILE__)."/partials/steps/add-new-shortcode.php";
            }
        } else {
            $posts = get_posts(
                [
                    "post_type"   => "superb_code",
                    "numberposts" => -1,
                ]
            );
            include_once dirname(__FILE__)."/partials/steps/all-shortcodes.php";
        }

    }//end short_codes()

    /**
     * Save and update data of testimonial settings in database
     *
     * @since 1.0.0
     */
    public function save_superb_testimonial_setting()
    {
        $nonce = filter_input(INPUT_POST, 'nonce');
        if (isset($nonce)) {
            $nonce = sanitize_text_field($nonce);
        }

        $postIds = filter_input(INPUT_POST, 'testimonial_id');
        if (isset($postIds)) {
            $postIds = sanitize_text_field($postIds);
        }

        $pageNum = filter_input(INPUT_POST, 'page_num');
        if (isset($pageNum)) {
            $pageNum = sanitize_text_field($pageNum);
        }

        $response = [
            'status'  => 0,
            'message' => esc_html__("Invalid Request, Please try again", "superb-testimonials"),
            'data'    => [
                "URL" => admin_url("admin.php?page=superb-testimonials&paged=".esc_attr($pageNum)),
            ],
        ];
        if (!empty($nonce) && wp_verify_nonce($nonce, "save_superb_testimonial_setting".esc_attr($postIds))) {
            $testimonialSettings = filter_input(INPUT_POST, 'testimonial_settings', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
            $stText = filter_input(INPUT_POST, 'st_text');
            $testimonialTaxonomy = filter_input(INPUT_POST, 'testimonial_taxonomy', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
            $testimonialSettings = isset($testimonialSettings) ? (array)$testimonialSettings : [];
            $testimonialText     = isset($stText) ? sanitize_text_field($stText) : '';
            $testimonialTaxonomy = isset($testimonialTaxonomy) ? $testimonialTaxonomy : [];
            $testimonialTitle    = $testimonialSettings['title'];

            if (empty($postIds)) {
                $postID = 0;

                if (empty($postID)) {
                    $post_data = [
                        'post_title'   => $testimonialTitle,
                        'post_status'  => 'publish',
                        'post_type'    => 'superb_testimonials',
                        'post_content' => $testimonialText,
                    ];
                    $postID    = wp_insert_post($post_data);
                }

                if (!empty($postID)) {
                    add_post_meta($postID, "testimonial_settings", $testimonialSettings);
                    if (!empty($testimonialTaxonomy)) {
                        wp_set_post_terms($postID, $testimonialTaxonomy, 'testimonial_categories', false);
                    }

                    $response['status']  = 1;
                    $response['message'] = esc_html__("Testimonial is saved successfully", "superb-testimonials");
                }
            } else {
                $post_data = [
                    'ID'           => $postIds,
                    'post_title'   => $testimonialTitle,
                    'post_status'  => 'publish',
                    'post_type'    => 'superb_testimonials',
                    'post_content' => $testimonialText,
                ];
                wp_update_post($post_data);
                if (!empty($postIds)) {
                    update_post_meta($postIds, "testimonial_settings", $testimonialSettings);
                    wp_delete_object_term_relationships($postIds, 'testimonial_categories');
                    if (!empty($testimonialTaxonomy)) {
                        wp_set_post_terms($postIds, $testimonialTaxonomy, 'testimonial_categories', true);
                    }

                    $response['status']  = 1;
                    $response['message'] = esc_html__("Testimonial is updated successfully", "superb-testimonials");
                }
            }//end if
        }//end if

        echo json_encode($response);
        exit;

    }//end save_superb_testimonial_setting()


    /**
     * Save and update data of testimonial categories in database
     *
     * @since 1.0.0
     */
    public function save_superb_testimonial_taxonomy()
    {
        $nonce = filter_input(INPUT_POST, 'taxonomy_nonce');
        if (isset($nonce)) {
            $nonce = sanitize_text_field($nonce);
        }

        $termId = filter_input(INPUT_POST, 'taxonomy_id');
        if (isset($termId)) {
            $termId = sanitize_text_field($termId);
        }

        $response = [
            'status'  => 0,
            'message' => esc_html__("Invalid Request, Please try again", "superb-testimonials"),
            'data'    => [
                "URL" => admin_url("admin.php?page=superb-testimonials-categories"),
            ],
        ];

        if (!empty($nonce) && wp_verify_nonce($nonce, "save_superb_testimonial_taxonomy".esc_attr($termId))) {
            $testimonialTerm = filter_input(INPUT_POST, 'testimonial_term');
            $termName        = isset($testimonialTerm) ? sanitize_text_field($testimonialTerm) : '';
            if (empty($termId)) {
                $result = wp_insert_term(
                    urldecode($termName),
                    // The term.
                    'testimonial_categories',
                    // The taxonomy.
                    ['parent' => 0]
                );
                if (!empty($result)) {
                    if (is_wp_error($result)) {
                        $response['status']  = 0;
                        $response['message'] = esc_html__("Category already exists", "superb-testimonials");
                    } else {
                        $response['status']  = 1;
                        $response['message'] = esc_html__("Category saved successfully", "superb-testimonials");
                    }
                }
            } else {
                $result = wp_update_term(
                    $termId,
                    'testimonial_categories',
                    ['name' => $termName]
                );
                if (!empty($result)) {
                    $response['status']  = 1;
                    $response['message'] = esc_html__("Category is updated successfully", "superb-testimonials");
                }
            }//end if
        }//end if

        echo json_encode($response);
        exit;

    }//end save_superb_testimonial_taxonomy()


    /**
     * Save and update data of shortcode in database
     *
     * @since 1.0.0
     */
    public function save_superb_superb_code_setting()
    {
        $nonce = filter_input(INPUT_POST, 'nonce');
        if (isset($nonce)) {
            $nonce = sanitize_text_field($nonce);
        }

        $codeIds = filter_input(INPUT_POST, 'shortcode_id');
        if (isset($codeIds)) {
            $codeIds = sanitize_text_field($codeIds);
        }

        $pageNum = filter_input(INPUT_POST, 'page_num');
        if (isset($pageNum)) {
            $pageNum = sanitize_text_field($pageNum);
        }

        $response = [
            'status'  => 0,
            'message' => esc_html__("Invalid Request, Please try again", "superb-testimonials"),
            'data'    => [
                "URL" => admin_url("admin.php?page=superb-testimonials-short-codes&paged=".esc_attr($pageNum)),
            ],
        ];
        if (!empty($nonce) && wp_verify_nonce($nonce, "save_superb_testimonial_shortcode_setting".esc_attr($codeIds))) {
            $setting        = filter_input(INPUT_POST, 'setting', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
            $settingColor   = filter_input(INPUT_POST, 'setting_color', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
            $settings       = isset($setting) ? (array) $setting : [];
            $settingColors  = isset($settingColor) ? (array) $settingColor : [];
            $shortcodeTitle = $settings['shortcode_name'];

            if (empty($codeIds)) {
                $codeID = 0;

                if (empty($codeID)) {
                    $post_data = [
                        'post_title'  => $shortcodeTitle,
                        'post_status' => 'publish',
                        'post_type'   => 'superb_code',

                    ];
                    $codeID = wp_insert_post($post_data);
                }

                if (!empty($codeID)) {
                    add_post_meta($codeID, "shortcode_settings", $settings);
                    add_post_meta($codeID, "shortcode_settings_color", $settingColors);
                    $response['status']  = 1;
                    $response['message'] = esc_html__("Shortcode is saved successfully", "superb-testimonials");
                }
            } else {
                $post_data = [
                    'ID'          => $codeIds,
                    'post_title'  => $shortcodeTitle,
                    'post_status' => 'publish',
                    'post_type'   => 'superb_code',
                ];
                wp_update_post($post_data);
                if (!empty($codeIds)) {
                    update_post_meta($codeIds, "shortcode_settings", $settings);
                    update_post_meta($codeIds, "shortcode_settings_color", $settingColors);
                    $response['status']  = 1;
                    $response['message'] = esc_html__("Shortcode is updated successfully", "superb-testimonials");
                }
            }//end if
        }//end if

        echo json_encode($response);
        exit;

    }//end save_superb_superb_code_setting()


    /**
     * Remove a data of testimonial settings from database
     *
     * @since 1.0.0
     */
    public function remove_testimonial()
    {
        $nonce = filter_input(INPUT_POST, 'nonce');
        if (isset($nonce)) {
            $nonce = sanitize_text_field($nonce);
        }

        $postId = filter_input(INPUT_POST, 'testimonial_id');
        if (isset($postId)) {
            $postId = sanitize_text_field($postId);
        }

        $response = [
            'status'  => 0,
            'message' => esc_html__("Testimonial has been removed", "superb-testimonials"),
            'data'    => [],
        ];
        if (!empty($nonce) && wp_verify_nonce($nonce, "testimonial_action_".esc_attr($postId))) {
            wp_delete_post($postId);
            $response['status'] = 1;
        }

        echo json_encode($response);
        exit;

    }//end remove_testimonial()


    /**
     * Remove a data of categories from database
     *
     * @since 1.0.0
     */
    public function remove_term()
    {
        $nonce = filter_input(INPUT_POST, 'nonce');
        if (isset($nonce)) {
            $nonce = sanitize_text_field($nonce);
        }

        $postId = filter_input(INPUT_POST, 'term_id');
        if (isset($postId)) {
            $postId = sanitize_text_field($postId);
        }

        $response = [
            'status'  => 0,
            'message' => esc_html__("Category has been removed", "superb-testimonials"),
            'data'    => [],
        ];
        if (!empty($nonce) && wp_verify_nonce($nonce, "term_action_".esc_attr($postId))) {
            wp_delete_term($postId, "testimonial_categories");
            $response['status'] = 1;
        }

        echo json_encode($response);
        exit;

    }//end remove_term()


    /**
     * Remove a data of shortcode from database
     *
     * @since 1.0.0
     */
    public function remove_shortcode()
    {
        $nonce = filter_input(INPUT_POST, 'nonce');
        if (isset($nonce)) {
            $nonce = sanitize_text_field($nonce);
        }

        $postId = filter_input(INPUT_POST, 'code_id');
        if (isset($postId)) {
            $postId = sanitize_text_field($postId);
        }

        $response = [
            'status'  => 0,
            'message' => esc_html__("Shortcode has been removed", "superb-testimonials"),
            'data'    => [],
        ];
        if (!empty($nonce) && wp_verify_nonce($nonce, "shortcode_action_".esc_attr($postId))) {
            wp_delete_post($postId);
            $response['status'] = 1;
        }

        echo json_encode($response);
        exit;

    }//end remove_shortcode()


    /**
     * Save a copy data of shortcode in database
     *
     * @since 1.0.0
     */
    public function clone_shortcode()
    {
        $nonce = filter_input(INPUT_POST, 'nonce');
        if (isset($nonce)) {
            $nonce = sanitize_text_field($nonce);
        }

        $postId = filter_input(INPUT_POST, 'clone_code_id');
        if (isset($postId)) {
            $postId = sanitize_text_field($postId);
        }

        $codeName = filter_input(INPUT_POST, 'clone_code_name');
        if (isset($codeName)) {
            $codeName = sanitize_text_field($codeName);
        }

        $response = [
            'status'  => 0,
            'message' => esc_html__("Invalid Request, Please try again", "superb-testimonials"),
            'data'    => [],
        ];
        if (!empty($nonce) && wp_verify_nonce($nonce, "shortcode_action_".esc_attr($postId))) {
            $settings = get_post_meta($postId, "shortcode_settings", true);
            $settings['shortcode_name'] = $codeName;
            $settingColors = get_post_meta($postId, "shortcode_settings_color", true);
            $codeID        = 0;
            if (empty($codeID)) {
                $post_data = [
                    'post_title'  => $codeName,
                    'post_status' => 'publish',
                    'post_type'   => 'superb_code',
                ];
                $codeID    = wp_insert_post($post_data);
            }

            if (!empty($codeID)) {
                add_post_meta($codeID, "shortcode_settings", $settings);
                add_post_meta($codeID, "shortcode_settings_color", $settingColors);
                $response['status']  = 1;
                $response['message'] = esc_html__("Shortcode are saved successfully", "superb-testimonials");
            }
        }//end if

        echo json_encode($response);
        exit;

    }//end clone_shortcode()


    /**
     * send email to given mail in database.
     *
     * @since 1.0.1
     */
    public function save_sign_up_info() {
        $skip = filter_input(INPUT_POST, "skip");
        if(isset($skip)) {
            $skip = sanitize_text_field($skip);
        }
        $emailId = filter_input(INPUT_POST, "email_id");
        if(isset($emailId)){
            $emailId = sanitize_text_field($emailId);
        }
        $isSignUp = filter_input(INPUT_POST, "is_signup");
        if(isset($emailId)){
            $isSignUp = sanitize_text_field($isSignUp);
        }
        $nonce = filter_input(INPUT_POST, "nonce");
        if(isset($nonce)) {
            $nonce = sanitize_text_field($nonce);
        }
        $response = [
            'status'  => 0,
            'message' => esc_html__("Invalid Request, Please try again", "superb-testimonials"),
            'data'    => [ "URL" => "" ],
        ];
        if(!empty($nonce) && wp_verify_nonce($nonce,"superb_testimonials_save_sign_up_info_nonce")) {
            if (!empty($skip)) {
                add_option("superb_testimonials_signup_status", $isSignUp);
                $response['status'] = 1;
            } else {
                $apiURL = "https://api.gingerplugins.com/email/signup.php";

                $params = [
                    'wp_plugin' => 'mst',
                    'email_id'  => $emailId,
                ];

                $apiResponse = wp_safe_remote_post($apiURL, ['body' => $params, 'timeout' => 15, 'sslverify' => true]);
                add_option("superb_testimonials_signup_status", $isSignUp);
                if (is_wp_error($apiResponse)) {
                    wp_safe_remote_post($apiURL, ['body' => $params, 'timeout' => 15, 'sslverify' => false]);
                }
            }
        }
        echo json_encode($response);
        exit;
    }//end save_sign_up_info()


}//end class
