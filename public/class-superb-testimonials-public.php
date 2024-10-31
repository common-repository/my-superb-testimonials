<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @package    Superb_Testimonials
 * @subpackage Superb_Testimonials/public
 *
 * @author  : gingerplugins <gingerplugins@gmail.com>
 * @license : GPL2
 *
 * @link  gingerplugins
 * @since 1.0.0
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Superb_Testimonials
 * @subpackage Superb_Testimonials/public
 * @author     gingerplugins <gingerplugins@gmail.com>
 */

if (!defined('ABSPATH')) {
    exit;
}

class Superb_Testimonials_Public
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
     * Initialize the class and set its properties.
     *
     * @since 1.0.0
     * @param string $pluginName The name of the plugin.
     * @param string $version    The version of this plugin.
     */
    public function __construct($pluginName, $version)
    {

        $this->pluginName = $pluginName;
        $this->version    = $version;
        add_shortcode('fabulo_testimonial', [$this, 'add_testimonial']);

    }//end __construct()


    /**
     * Register the stylesheets for the public-facing side of the site.
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

        wp_enqueue_style($this->pluginName, plugin_dir_url(__FILE__).'css/superb-testimonials-public.css', [], $this->version, 'all');
        wp_enqueue_style($this->pluginName.'front-font-awesome', "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css");

    }//end enqueue_styles()


    /**
     * Register the JavaScript for the public-facing side of the site.
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

        $minified = ".min";
        if (SUPERB_TESTIMONIALS_DEV_VERSION) {
            $minified = "";
        }

        wp_enqueue_script($this->pluginName, plugin_dir_url(__FILE__).'js/superb-testimonials-public'.esc_attr($minified).'.js', [ 'jquery', 'masonry' ], $this->version, false);

    }//end enqueue_scripts()


    /**
     * Display testimonials for the public-facing side of the site.
     *
     * @since  1.0.0
     * @param  int $atts The id of the shortcode.
     * @return Design of testimonials.
     */
    public function add_testimonial($atts)
    {
        if (!isset($atts['id']) || $atts['id'] == "" || !is_numeric($atts['id']) || $atts['id'] <= 0) {
            return "";
        }

        ob_start();
        $codeId = $atts['id'];

        if (!empty($codeId)) {
            $settings       = get_post_meta($codeId, "shortcode_settings", true);
            $settings       = isset($settings)&&is_array($settings) ? $settings : [];
            $settingsFields = isset($settings['fields'])&&is_array($settings['fields']) ? $settings['fields'] : [];

            $setting = [];
            $type    = $settings['sc_type'];
            $setting['style']        = $settings['sc_style'];
            $setting['columns']      = $settings['sc_column_radio'];
            $setting['categories']   = isset($settings['st_setting_categories']) ? $settings['st_setting_categories'] : '';
            $setting['testimonials'] = $settings['no_of_testimonial'];
            $orders = $settings['st_setting_order'];
            $row    = "";
            $column = "";
            switch ($type) {
            case 'Grid':
                $row = 'superb-grid-row';
                break;
            case 'Wall':
                $row    = "superb-grid-row masonry-grid-row";
                $column = "masonry-grid-col-items";
                break;
            }

            switch ($orders) {
            case 'date_ascending':
                $setting['order']   = 'ASC';
                $setting['orderby'] = 'date';
                break;
            case 'date_descending':
                $setting['order']   = 'DESC';
                $setting['oredrby'] = 'date';
                break;
            case 'title_ascending':
                $setting['order']   = 'ASC';
                $setting['orderby'] = 'title';
                break;
            case 'title_descending':
                $setting['order']   = 'DESC';
                $setting['orderby'] = 'title';
                break;
            default:
                $setting['order']   = 'DESC';
                $setting['orderby'] = 'date';
                break;
            }//end switch

            $arg = shortcode_atts(
                [
                    'type'         => 'grid',
                    'style'        => '1',
                    'columns'      => '3',
                    'categories'   => [],
                    'testimonials' => '1',
                    'order'        => 'DESC',
                    'orderby'      => 'date',
                ],
                $setting
            );

            if ($arg['categories'] != '') {
                $args = [
                    'post_type'      => "superb_testimonials",
                    'posts_per_page' => $arg['testimonials'],
                    'tax_query'      => [
                        [
                            'taxonomy' => 'testimonial_categories',
                            'field'    => 'term_id',
                            'terms'    => $arg['categories'],
                        ],
                    ],
                    'order'          => $arg['order'],
                    'orderby'        => $arg['orderby'],
                ];
            } else {
                $args = [
                    'post_type'      => "superb_testimonials",
                    'posts_per_page' => $arg['testimonials'],
                    'order'          => $arg['order'],
                    'orderby'        => $arg['orderby'],
                ];
            }//end if

            $query = new WP_Query($args);

            $previewId = uniqid();

            if ($query->have_posts()) {
                echo "<div class='styling-preview-".esc_attr($previewId)."'>";
                echo "<div class='superb-style superb-style-".esc_attr($settings['sc_style'])."'>";
                echo "<div class='superb-grid'>";
                echo "<div class='".esc_attr($row)."'>";
                while ($query->have_posts()) {
                    $query->the_post();
                    $testimonialDetail = get_post_meta(get_the_ID(), "testimonial_settings", true);
                    $testimonialDetail = isset($testimonialDetail) && is_array($testimonialDetail) ? $testimonialDetail : [];
                    echo "<div class='grid-col-".esc_attr($settings['sc_column_radio'])." testimonial-box ".esc_attr($column)."'>";
                    include dirname(__FILE__)."/../admin/partials/templates/style-".esc_attr($settings['sc_style']).".php";
                    echo "</div>";
                }

                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";

                $settingsColor    = get_post_meta($codeId, "shortcode_settings_color", true);
                $settingsColor    = isset($settingsColor) && is_array($settingsColor) ? $settingsColor : [];
                $titleColor       = $settingsColor['title_color'];
                $descColor        = $settingsColor['description_color'];
                $nameColor        = $settingsColor['author_name'];
                $designationColor = $settingsColor['designation'];
                $companyColor     = $settingsColor['company'];
                $locationColor    = $settingsColor['location'];
                $ratingColor      = $settingsColor['rating'];
                $descBgColor      = $settingsColor['desc_bg'];

                echo "<style>";
                echo ".styling-preview-".esc_attr($previewId)." .superb-content .superb-title {color:".esc_attr($titleColor).";}";
                echo ".styling-preview-".esc_attr($previewId)." .superb-content {color:".esc_attr($descColor).";}";
                echo ".styling-preview-".esc_attr($previewId)." .author-name {color:".esc_attr($nameColor).";}";
                echo ".styling-preview-".esc_attr($previewId)." .author-info .author-designation {color:".esc_attr($designationColor).";}";
                echo ".styling-preview-".esc_attr($previewId)." .author-info .author-company {color:".esc_attr($companyColor).";}";
                echo ".styling-preview-".esc_attr($previewId)." .author-info .author-location {color:".esc_attr($locationColor).";}";
                echo ".styling-preview-".esc_attr($previewId)." .author-rating {color:".esc_attr($ratingColor).";}";
                echo ".styling-preview-".esc_attr($previewId)." .superb-content {background:".esc_attr($descBgColor).";}";
                echo ".styling-preview-".esc_attr($previewId)." .superb-style-1 .superb-content:after {border-top:8px solid ".esc_attr($descBgColor).";}";
                echo ".styling-preview-".esc_attr($previewId)." .superb-style-2 .superb-content:after {border-bottom:8px solid ".esc_attr($descBgColor).";}";
                echo "</style>";
            }//end if
        }//end if

        // Return output.
        return ob_get_clean();

    }//end add_testimonial()


}//end class
