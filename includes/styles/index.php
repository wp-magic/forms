<?php
/**
 * Register the form styles.
 *
 * @package MagicForms
 * @since 0.0.1
 */

add_action(
	'wp_enqueue_scripts',
	function () {
		magic_register_style( 'magic-forms', dirname( plugin_basename( __FILE__ ) ) );
	}
);
