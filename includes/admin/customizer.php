<?php

function mforms_add_customizer_section($wp_customize, $name, $label, $priority = 30) {
	$wp_customize->add_section( $name , array(
    'title'      => esc_html__($label, 'magic-grundstein'),
    'priority'   => $priority,
	) );
}

function mforms_add_customizer($wp_customize, $section, $name, $default, $label, $control, $opts = [], $sanitize = 'sanitize_hex_color') {
  $setting_options = array(
		'transport' => 'refresh',
  );
  if ( is_array($default) ) {
    $setting_options = array_merge($setting_options, $default);
  } else {
    $setting_options = array_merge($setting_options, array(
      'default' => $default,
      'sanitize' => $sanitize,
    ));
  }

  $wp_customize->add_setting( $name, $setting_options );

  $def_opts = array(
    'section' => $section,
    'label' => esc_html__($label, 'magic-grundstein'),
    'settings' => $name,
  );

	$options = array_merge($def_opts, $opts);

  $wp_customize->add_control( new $control( $wp_customize, $name, $options) );
}

add_action( 'init', function() {
  if (class_exists('WPLessPlugin')) {
    $less = WPLessPlugin::getInstance();

    $attr_names = array (
      'input_text_color' => '#aaa',
      'input_background_color' => '#191919',
      'input_border_color' => '#aaa',

      'input_text_color_hover' => '#fff',
      'input_background_color_hover' => '#191919',
      'input_border_color_hover' => '#fff',

      'error_color' => '#ed1c24',
      'warning_color' => '#ffff22',
      'success_color' => '#00ff00',
    );

    $colors = [];
    foreach ( $attr_names as $name => $val ) {
      $colors[$name] = get_theme_mod( $name, $val );
    }

    $less->setVariables( $colors );
  }
} );

add_action( 'customize_register', function ( $wp_customize ) {
	mforms_add_customizer_section( $wp_customize, MAGIC_FORMS_SLUG, 'Forms' );

	mforms_add_customizer( $wp_customize, MAGIC_FORMS_SLUG, 'input_text_color', '#aaa', 'Input Field Text Color', 'WP_Customize_Color_Control' );
	mforms_add_customizer( $wp_customize, MAGIC_FORMS_SLUG, 'input_background_color', '#191919', 'Input Field Background Color', 'WP_Customize_Color_Control' );
	mforms_add_customizer( $wp_customize, MAGIC_FORMS_SLUG, 'input_border_color', '#aaa', 'Input Field Border Color', 'WP_Customize_Color_Control' );

	mforms_add_customizer( $wp_customize, MAGIC_FORMS_SLUG, 'input_text_color_hover', '#fff', 'Hover Input Field Text Color', 'WP_Customize_Color_Control' );
	mforms_add_customizer( $wp_customize, MAGIC_FORMS_SLUG, 'input_background_color_hover', '#191919', 'Hover Input Field Background Color', 'WP_Customize_Color_Control' );
	mforms_add_customizer( $wp_customize, MAGIC_FORMS_SLUG, 'input_border_color_hover', '#fff', 'Hover Input Field Border Color', 'WP_Customize_Color_Control' );

  mforms_add_customizer( $wp_customize, MAGIC_FORMS_SLUG, 'error_color', '#ed1c24', 'Error Message Text Color', 'WP_Customize_Color_Control' );
  mforms_add_customizer( $wp_customize, MAGIC_FORMS_SLUG, 'warning_color', '#ffff22', 'Warn Message Text Color', 'WP_Customize_Color_Control' );
  mforms_add_customizer( $wp_customize, MAGIC_FORMS_SLUG, 'success_color', '#00ff00', 'Success Message Text Color', 'WP_Customize_Color_Control' );
} );
