<?php

require_once 'styles/index.php';

if ( is_admin() ) {
	require_once 'admin/requirements.php';
	// require_once 'admin/dashboard.php';
}

add_action('init', function() {
	// Load plugin text domain
  load_plugin_textdomain(
    MAGIC_FORMS_SLUG,
    FALSE,
    plugin_dir_path( __FILE__ ) . 'languages'
  );
} );
