<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @package Superb_Testimonials
 *
 * @author  : gingerplugins <gingerplugins@gmail.com>
 * @license : GPL2
 * @link    gingerplugins
 * @since   1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:       Superb Testimonials
 * Plugin URI:        https://www.gingerplugins.com/downloads/superb-testimonials/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Ginger Plugins
 * Author URI:        https://www.gingerplugins.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       superb-testimonials
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (! defined('WPINC')) {
    die;
}

/*
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */

define('SUPERB_TESTIMONIALS_VERSION', '1.0.0');
define('SUPERB_TESTIMONIALS_URL', plugin_dir_url(__FILE__));
if (!defined('SUPERB_TESTIMONIALS_DEV_VERSION')) {
    define("SUPERB_TESTIMONIALS_DEV_VERSION", true);
}


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-superb-testimonials-activator.php
 */
function activate_superb_testimonials()
{
    include_once plugin_dir_path(__FILE__).'includes/class-superb-testimonials-activator.php';
    Superb_Testimonials_Activator::activate();

}//end activate_superb_testimonials()


/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-superb-testimonials-deactivator.php
 */
function deactivate_superb_testimonials()
{
    include_once plugin_dir_path(__FILE__).'includes/class-superb-testimonials-deactivator.php';
    Superb_Testimonials_Deactivator::deactivate();

}//end deactivate_superb_testimonials()


register_activation_hook(__FILE__, 'activate_superb_testimonials');
register_deactivation_hook(__FILE__, 'deactivate_superb_testimonials');

/*
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */

require plugin_dir_path(__FILE__).'includes/class-superb-testimonials.php';


// Redirect on setting page on activation.
add_action('activated_plugin', 'superb_testimonials_redirect_on_activate');


/**
 * Redirect to a setting page when plugin is activated.
 *
 * @param string $plugin Plugin name
 */
function superb_testimonials_redirect_on_activate($plugin)
{
    if ($plugin == plugin_basename(__FILE__)) {
        $adminUrl = esc_url(admin_url('admin.php?page=superb-testimonials'));
        wp_redirect($adminUrl);
        exit;
    }

}//end superb_testimonials_redirect_on_activate()


/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since 1.0.0
 */
function run_superb_testimonials()
{

    $plugin = new Superb_Testimonials();
    $plugin->run();

}//end run_superb_testimonials()


run_superb_testimonials();
