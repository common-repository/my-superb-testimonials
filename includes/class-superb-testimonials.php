<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @package    Superb_Testimonials
 * @subpackage Superb_Testimonials/includes
 * @author     : gingerplugins <gingerplugins@gmail.com>
 * @license    : GPL2
 * @link       gingerplugins
 * @since      1.0.0
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Superb_Testimonials
 * @subpackage Superb_Testimonials/includes
 * @author     gingerplugins <gingerplugins@gmail.com>
 */

if (!defined('ABSPATH')) {
    exit;
}

class Superb_Testimonials
{

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @var    Superb_Testimonials_Loader    $loader    Maintains and registers all hooks for the plugin.
     * @since  1.0.0
     * @access protected
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @var    string    $plugin_name    The string used to uniquely identify this plugin.
     * @since  1.0.0
     * @access protected
     */
    protected $pluginName;

    /**
     * The current version of the plugin.
     *
     * @var    string    $version    The current version of the plugin.
     * @since  1.0.0
     * @access protected
     */
    protected $version;


    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        if (defined('SUPERB_TESTIMONIALS_VERSION')) {
            $this->version = SUPERB_TESTIMONIALS_VERSION;
        } else {
            $this->version = '1.0.0';
        }

        $this->pluginName = 'superb-testimonials';

        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();

    }//end __construct()


    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - Superb_Testimonials_Loader. Orchestrates the hooks of the plugin.
     * - Superb_Testimonials_i18n. Defines internationalization functionality.
     * - Superb_Testimonials_Admin. Defines all hooks for the admin area.
     * - Superb_Testimonials_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since  1.0.0
     * @access private
     */
    private function load_dependencies()
    {
        /*
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */

        include_once plugin_dir_path(dirname(__FILE__)).'includes/class-superb-testimonials-loader.php';

        /*
         * The class responsible for defining internationalization functionality
         * of the plugin.
         */

        include_once plugin_dir_path(dirname(__FILE__)).'includes/class-superb-testimonials-i18n.php';

        /*
         * The class responsible for defining all actions that occur in the admin area.
         */

        include_once plugin_dir_path(dirname(__FILE__)).'admin/class-superb-testimonials-admin.php';

        /*
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */

        include_once plugin_dir_path(dirname(__FILE__)).'public/class-superb-testimonials-public.php';

        $this->loader = new Superb_Testimonials_Loader();

    }//end load_dependencies()


    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the Superb_Testimonials_i18n class in order to set the domain and to register the hook
     * with WordPress.
     *
     * @since  1.0.0
     * @access private
     */
    private function set_locale()
    {

        $pluginI18n = new Superb_Testimonials_i18n();

        $this->loader->add_action('plugins_loaded', $pluginI18n, 'load_plugin_textdomain');

    }//end set_locale()


    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since  1.0.0
     * @access private
     */
    private function define_admin_hooks()
    {

        $pluginAdmin = new Superb_Testimonials_Admin($this->get_plugin_name(), $this->get_version());

        $this->loader->add_action('admin_enqueue_scripts', $pluginAdmin, 'enqueue_styles');
        $this->loader->add_action('admin_enqueue_scripts', $pluginAdmin, 'enqueue_scripts');
        $this->loader->add_action('init', $pluginAdmin, 'register_post_type');
        $this->loader->add_action('admin_menu', $pluginAdmin, 'admin_menu');
        $this->loader->add_action('wp_ajax_save_superb_testimonial_setting', $pluginAdmin, 'save_superb_testimonial_setting');
        $this->loader->add_action('wp_ajax_save_superb_testimonial_taxonomy', $pluginAdmin, 'save_superb_testimonial_taxonomy');
        $this->loader->add_action('wp_ajax_save_superb_testimonial_shortcode_setting', $pluginAdmin, 'save_superb_superb_code_setting');
        $this->loader->add_action('wp_ajax_superb_testimonials_remove_testimonial', $pluginAdmin, 'remove_testimonial');
        $this->loader->add_action('wp_ajax_superb_testimonials_remove_term', $pluginAdmin, 'remove_term');
        $this->loader->add_action('wp_ajax_superb_testimonials_remove_shortcode', $pluginAdmin, 'remove_shortcode');
        $this->loader->add_action('wp_ajax_superb_testimonials_clone_shortcode', $pluginAdmin, 'clone_shortcode');
        $this->loader->add_action('wp_ajax_superb_testimonials_save_sign_up_info', $pluginAdmin, 'save_sign_up_info');

    }//end define_admin_hooks()


    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since  1.0.0
     * @access private
     */
    private function define_public_hooks()
    {

        $pluginPublic = new Superb_Testimonials_Public($this->get_plugin_name(), $this->get_version());

        $this->loader->add_action('wp_enqueue_scripts', $pluginPublic, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $pluginPublic, 'enqueue_scripts');

    }//end define_public_hooks()


    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since 1.0.0
     */
    public function run()
    {
        $this->loader->run();

    }//end run()


    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since  1.0.0
     * @return string    The name of the plugin.
     */
    public function get_plugin_name()
    {
        return $this->pluginName;

    }//end get_plugin_name()


    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @since  1.0.0
     * @return Superb_Testimonials_Loader    Orchestrates the hooks of the plugin.
     */
    public function get_loader()
    {
        return $this->loader;

    }//end get_loader()


    /**
     * Retrieve the version number of the plugin.
     *
     * @since  1.0.0
     * @return string    The version number of the plugin.
     */
    public function get_version()
    {
        return $this->version;

    }//end get_version()

    public static function content_array() {
        return array(
            "1" => array(
                'title' => "Good Team to Work & Finish Project on Time",
                'content' => "The team is really excellent and very helpful. They professionally do their job and finish all the tasks on time. Sometimes even they spend extra time to finish the job before the deadline. We never faced any difficulties in communication, that’s the best part when you outsource the work.",
                'author_image' => SUPERB_TESTIMONIALS_URL.'admin/images/thumb-image-1.jpg',
                'author_name' => "Maria M Edwards",
                'designation' => "CTO,",
                'company' => "Sound Advice,",
                'location' => "USA"
            ),
            "2" => array(
                'title' => "Excellent Work Process to Get Started the Project",
                'content' => "I would sincerely thank you for showing the outstanding commitment to my project. I really appreciate the time taken by the team to understand the vision of the project and requirements. I am looking forward the same efforts for my other projects as well & I am sure I will get the best services.",
                'author_image' => SUPERB_TESTIMONIALS_URL.'admin/images/thumb-image-2.jpg',
                'author_name' => "Stephanie Crespo",
                'designation' => "CEO,",
                'company' => "Matrix Design,",
                'location' => "USA"
            ),
            "3" => array(
                'title' => "Best Quality of Work & Professionalism Together",
                'content' => "Are you searching for the company to develop your next product? You can definitely rely on Quicksol. This company stood out in terms of quality, professionalism and excellence. The process of work and documentation is their forte. We have never seen any deadline passed during the project.",
                'author_image' => SUPERB_TESTIMONIALS_URL.'admin/images/thumb-image-3.jpg',
                'author_name' => "Mai W Larson",
                'designation' => "COO,",
                'company' => "Modern Architecture,",
                'location' => "UK"
            ),
            "4" => array(
                'title' => "Experienced Team & Friendly Work Environment",
                'content' => "This is the best organization with skilled team that could understand the actual requirement of my project. The end-results are great. It was my pleasure to work with such amazing team. Thanks for making my dream project a reality. I would surely recommend this team as they work with full dedication.",
                'author_image' => SUPERB_TESTIMONIALS_URL.'admin/images/thumb-image-4.jpg',
                'author_name' => "Angela Wiles",
                'designation' => "CEO,",
                'company' => "Vinyl Fever,",
                'location' => "USA"
            ),
            "5" => array(
                'title' => "Professional Partnership & Great Support at Any Time",
                'content' => "I strongly recommend Proworks for your next work because they looked at our success as their own success. I love the way they develop the mutually professional partnership rather than a vendor developer relation. Even with the time difference, they are always available when we require.",
                'author_image' => SUPERB_TESTIMONIALS_URL.'admin/images/thumb-image-5.jpg',
                'author_name' => "Nellie Cook",
                'designation' => "CTO,",
                'company' => "Frame Scene,",
                'location' => "USA"
            ),
            "6" => array(
                'title' => "Quality Services & Appropriate Analysis",
                'content' => "When we started our project 2 years ago, the main struggle for us was the team of professional developers. We were looking for quality services. Our search ended when we found this client. They have developed many successful apps. And we’re also happy as our app is launched successfully.",
                'author_image' => SUPERB_TESTIMONIALS_URL.'admin/images/thumb-image-5.jpg',
                'author_name' => "Lynn Richardson",
                'designation' => "CTO,",
                'company' => "Liberty Wealth Planner,",
                'location' => "USA"
            )
        );
    }

}//end class
