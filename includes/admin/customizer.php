<?php
/**
 * Customization options for form css
 *
 * @package MagicForms
 */

/**
 * Add a customizer section for this plugin
 *
 * @param mixed  $wp_customize WordPress customizer instance.
 * @param string $name of this customizer section.
 * @param string $label of this customizer section.
 * @param int    $priority defines order of sections.
 */
function mforms_add_customizer_section( $wp_customize, string $name, string $label, int $priority = 30 ) {
	$wp_customize->add_section(
		$name,
		array(
			'title'    => $label,
			'priority' => $priority,
		)
	);
}


/**
 * Add a customizer section for this plugin
 *
 * @param mixed  $wp_customize WordPress customizer instance.
 * @param string $section this customizer section.
 * @param string $name of the section.
 * @param string $default value of the section.
 * @param string $label of the section.
 * @param mixed  $control section controls.
 * @param array  $opts additional section options.
 * @param string $sanitize which sanitizer to use.
 */
function mforms_add_customizer(
	$wp_customize,
	string $section,
	string $name,
	string $default,
	string $label,
	$control,
	array $opts = [],
	string $sanitize = 'sanitize_hex_color'
	) {
	$setting_options = array(
		'transport' => 'refresh',
	);

	if ( is_array( $default ) ) {
		$setting_options = array_merge( $setting_options, $default );
	} else {
		$setting_options = array_merge(
			$setting_options,
			array(
				'default'  => $default,
				'sanitize' => $sanitize,
			)
		);
	}

	$wp_customize->add_setting( $name, $setting_options );

	$def_opts = array(
		'section'  => $section,
		'label'    => $label,
		'settings' => $name,
	);

	$options = array_merge( $def_opts, $opts );

	$wp_customize->add_control( new $control( $wp_customize, $name, $options ) );
}

/**
 * Returns default and customizer colors for wp_less
 */
function mforms_less_defaults() {
	if ( class_exists( 'WPLessPlugin' ) ) {
		$less = WPLessPlugin::getInstance();

		$attr_names = array(
			'input_text_color'             => '#aaa',
			'input_background_color'       => '#191919',
			'input_border_color'           => '#aaa',

			'input_text_color_hover'       => '#fff',
			'input_background_color_hover' => '#191919',
			'input_border_color_hover'     => '#fff',

			'error_color'                  => '#ed1c24',
			'warning_color'                => '#ffff22',
			'success_color'                => '#00ff00',
		);

		$colors = [];
		foreach ( $attr_names as $name => $val ) {
			$colors[ $name ] = get_theme_mod( $name, $val );
		}

		$less->setVariables( $colors );
	}
}

add_action( 'init', 'mforms_less_defaults' );

/**
 * Add customizer fields for all less variables defined in this file.
 *
 * @param mixed $wp_customize wp-customizer instance.
 */
function mforms_add_custom_customizer( $wp_customize ) {
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
}

add_action( 'customize_register', 'mforms_add_custom_customizer' );
