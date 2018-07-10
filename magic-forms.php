<?php
/**
 * Magic Forms
 *
 * @package   Magic-Forms
 * @license   GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: Magic Forms
 * Plugin URI:
 * Description: Form post request handler, templates and other functionality for forms.
 * Version:     0.0.1
 * Author:      Jascha Ehrenreich
 * Author URI:  http://github.com/wp-magic/magic-forms
 * Text Domain: magic_forms
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
  die;
}

define( 'MAGIC_FORMS_SLUG', 'magic_forms' );

require_once plugin_dir_path( __FILE__ ) . 'includes/plugin.php';

// Register callback that is fired when the plugin is activated.
register_activation_hook( __FILE__, function () {
  flush_rewrite_rules();
} );

register_deactivation_hook( __FILE__, function () {
  flush_rewrite_rules();
} );
