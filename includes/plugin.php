<?php
/**
 * Plugin functionality entry file.
 *
 * @package MagicForms
 * @since 0.0.1
 */

/**
 * Enqueue Styles
 *
 * @since 0.0.1
 */
require_once 'styles/index.php';

/**
 * Form customizer settings section.
 */
require_once 'admin/customizer.php';

/**
 * Load textdomain.
 */
add_action(
	'init',
	function() {
		load_plugin_textdomain(
			MAGIC_FORMS_SLUG,
			false,
			plugin_dir_path( __FILE__ ) . 'languages'
		);
	}
);
