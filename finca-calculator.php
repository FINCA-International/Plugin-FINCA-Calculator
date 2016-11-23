<?php

/**
 * FINCA Calculator
 * This plugin is a generic loan and saving calculator for all the subsidiaries
 *
 * @link              http://finca.org
 * @since             1.0.0
 * @package           FINCA-Calculator
 * @author 			  Luis Gomez Donis
 *
 * @wordpress-plugin
 * Plugin Name:       FINCA Calculator
 * Plugin URI:        http://finca.org/
 * Description:       This plugin is a generic loan and saving calculator for all the subsidiaries
 * Version:           1.0.0
 * Author:            FINCA International
 * Author URI:        http://finca.org/
 * License:           
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       FINCA-Calculator
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-name-activator.php
 */
function activate_plugin_name() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-finca-calculator-activator.php';
	Finca_Calculator_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-name-deactivator.php
 */
function deactivate_plugin_name() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-finca-calculator-deactivator.php';
	Finca_Calculator_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_plugin_name' );
register_deactivation_hook( __FILE__, 'deactivate_plugin_name' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-finca-calculator.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_finca_calculator() {

	$plugin = new Finca_Calculator();
	$plugin->run();

}
run_finca_calculator();
