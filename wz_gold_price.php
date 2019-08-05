<?php

/**
 * @wordpress-plugin
 * Plugin Name:       Gold Price Widget
 * Plugin URI:        https://github.com/nuttaruj/wz-gold-price
 * Description:       Gold Price(THB) Widget for Wordpress
 * Version:           1.1.1
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
 */
define( 'WZ_GOLD_PRICE_VERSION', '1.1.1' );

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

$myUpdateChecker->getVcsApi()->enableReleaseAssets();