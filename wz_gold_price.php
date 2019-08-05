<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://walnutztudio.com
 * @since             1.0.0
 * @package           Wz_gold_price
 *
 * @wordpress-plugin
 * Plugin Name:       Gold Price Widget
 * Plugin URI:        https://walnutztudio.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            WalnutZtudio
 * Author URI:        https://walnutztudio.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wz_gold_price
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WZ_GOLD_PRICE_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wz_gold_price-activator.php
 */
function activate_wz_gold_price() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wz_gold_price-activator.php';
	Wz_gold_price_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wz_gold_price-deactivator.php
 */
function deactivate_wz_gold_price() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wz_gold_price-deactivator.php';
	Wz_gold_price_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wz_gold_price' );
register_deactivation_hook( __FILE__, 'deactivate_wz_gold_price' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wz_gold_price.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wz_gold_price() {

	$plugin = new Wz_gold_price();
	$plugin->run();

}
run_wz_gold_price();


require 'vendor/plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/nuttaruj/wz-gold-price/',
	__FILE__,
	'wz_gold_price'
);

//Optional: Set the branch that contains the stable release.
$myUpdateChecker->setBranch('master');