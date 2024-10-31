<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @package    Superb_Testimonials
 * @subpackage Superb_Testimonials/includes
 * @author     : gingerplugins <gingerplugins@gmail.com>
 * @license    : GPL2
 *
 * @link  gingerplugins
 * @since 1.0.0
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Superb_Testimonials
 * @subpackage Superb_Testimonials/includes
 * @author     gingerplugins <gingerplugins@gmail.com>
 */

if (!defined('ABSPATH')) {
    exit;
}
class Superb_Testimonials_i18n
{


    /**
     * Load the plugin text domain for translation.
     *
     * @since 1.0.0
     */
    public function load_plugin_textdomain()
    {

        load_plugin_textdomain(
            'superb-testimonials',
            false,
            dirname(dirname(plugin_basename(__FILE__))).'/languages/'
        );

    }//end load_plugin_textdomain()


}//end class
