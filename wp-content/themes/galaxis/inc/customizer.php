<?php
/**
 * Galaxis Theme Customizer
 *
 * @package Galaxis
 */

/**
 * Add theme options and postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function galaxis_customize_register( $wp_customize ) {
	$wp_customize->register_section_type( Galaxis_Upsell_Section::class );

	$wp_customize->add_section(
		new Galaxis_Upsell_Section(
			$wp_customize,
			'galaxis_premium',
			array(
				'title'       => esc_html__( 'Galaxis Premium Available', 'galaxis' ),
				'button_text' => esc_html__( 'Buy Now', 'galaxis' ),
				'button_url'  => 'https://scriptstown.com/account/signup/galaxis-premium-wordpress-theme',
				'priority'    => 1,
			)
		)
	);

	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	$wp_customize->selective_refresh->add_partial(
		'blogname',
		array(
			'selector'        => '.site-title',
			'render_callback' => 'galaxis_customize_partial_blogname',
		)
	);

	$wp_customize->selective_refresh->add_partial(
		'blogdescription',
		array(
			'selector'        => '.site-description',
			'render_callback' => 'galaxis_customize_partial_blogdescription',
		)
	);

	// Section: General Options.
	$wp_customize->add_section(
		'sec_general',
		array(
			'title'       => esc_html__( 'General Options', 'galaxis' ),
			'description' => esc_html__( 'You can customize the general options in here.', 'galaxis' ),
			'priority'    => 155,
		)
	);

	// Setting: Blog content archive.
	$wp_customize->add_setting(
		'set_blog_content',
		array(
			'type'              => 'theme_mod',
			'default'           => 'summary',
			'transport'         => 'refresh',
			'sanitize_callback' => 'galaxis_sanitize_select',
		)
	);

	// Control: Blog content archive.
	$wp_customize->add_control(
		'set_blog_content',
		array(
			'section'     => 'sec_general',
			'type'        => 'radio',
			'choices'     => array(
				'full'    => esc_html__( 'Full text', 'galaxis' ),
				'summary' => esc_html__( 'Summary', 'galaxis' ),
			),
			'label'       => esc_html__( 'Blog Content Archive', 'galaxis' ),
			'description' => esc_html__( 'You can choose what to show in blog archive posts and pages.', 'galaxis' ),
		)
	);

	// Section: Header Options.
	$wp_customize->add_section(
		'sec_header',
		array(
			'title'       => esc_html__( 'Header Options', 'galaxis' ),
			'description' => esc_html__( 'You can customize the header options in here.', 'galaxis' ),
			'priority'    => 156,
		)
	);

	// Setting: Top bar text.
	$wp_customize->add_setting(
		'set_topbar_text',
		array(
			'type'              => 'theme_mod',
			'default'           => '',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'galaxis_sanitize_site_info_text',
		)
	);

	// Control: Top bar text.
	$wp_customize->add_control(
		'set_topbar_text',
		array(
			'section'     => 'sec_header',
			'type'        => 'textarea',
			'label'       => esc_html__( 'Top Bar Text', 'galaxis' ),
			'description' => esc_html__( 'You can enter the text to be shown on the left side of the top bar.', 'galaxis' ),
		)
	);

	// Selective refresh: Top bar text.
	$wp_customize->selective_refresh->add_partial(
		'set_topbar_text',
		array(
			'selector'            => '.site-topbar-text',
			'container_inclusive' => true,
			'render_callback'     => function() {
				get_template_part( 'template-parts/header/topbar-text' );
			},
		)
	);

	// Setting: Sticky main menu.
	$wp_customize->add_setting(
		'set_sticky_main_menu',
		array(
			'type'              => 'theme_mod',
			'default'           => true,
			'transport'         => 'refresh',
			'sanitize_callback' => 'galaxis_sanitize_checkbox',
		)
	);

	// Control: Sticky main menu.
	$wp_customize->add_control(
		'set_sticky_main_menu',
		array(
			'section'     => 'sec_header',
			'type'        => 'checkbox',
			'label'       => esc_html__( 'Sticky Main Menu', 'galaxis' ),
			'description' => esc_html__( 'You can enable or disable sticky main menu in the header when scrolling to the bottom.', 'galaxis' ),
		)
	);

	// Setting: Back to top button.
	$wp_customize->add_setting(
		'set_back_to_top',
		array(
			'type'              => 'theme_mod',
			'default'           => true,
			'transport'         => 'refresh',
			'sanitize_callback' => 'galaxis_sanitize_checkbox',
		)
	);

	// Control: Back to top button.
	$wp_customize->add_control(
		'set_back_to_top',
		array(
			'section'     => 'sec_header',
			'type'        => 'checkbox',
			'label'       => esc_html__( 'Back To Top Button', 'galaxis' ),
			'description' => esc_html__( 'You can enable or disable back to top button when scrolling to the bottom.', 'galaxis' ),
		)
	);

	// Section: Footer Options.
	$wp_customize->add_section(
		'sec_footer',
		array(
			'title'       => esc_html__( 'Footer Options', 'galaxis' ),
			'description' => esc_html__( 'You can customize the footer options in here.', 'galaxis' ),
			'priority'    => 157,
		)
	);

	// Setting: Copyright text.
	$wp_customize->add_setting(
		'set_copyright',
		array(
			'type'              => 'theme_mod',
			'default'           => galaxis_copyright_default(),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'galaxis_sanitize_site_info_text',
		)
	);

	// Control: Copyright text.
	$wp_customize->add_control(
		'set_copyright',
		array(
			'section'     => 'sec_footer',
			'type'        => 'textarea',
			'label'       => esc_html__( 'Copyright Text', 'galaxis' ),
			'description' => esc_html__( 'You can enter the copyright text to be shown in the footer.', 'galaxis' ),
		)
	);

	// Selective refresh: Copyright text.
	$wp_customize->selective_refresh->add_partial(
		'set_copyright',
		array(
			'selector'            => '.copyright',
			'container_inclusive' => true,
			'render_callback'     => function() {
				get_template_part( 'template-parts/footer/copyright' );
			},
		)
	);

	$default_colors = galaxis_get_color_defaults();

	// Setting: Top bar background color.
	$wp_customize->add_setting(
		'galaxis_colors[topbar_bg_color]',
		array(
			'default'           => $default_colors['topbar_bg_color'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	// Control: Top bar background color.
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'galaxis_colors[topbar_bg_color]',
			array(
				'section' => 'colors',
				'label'   => esc_html__( 'Top Bar Background Color', 'galaxis' ),
			)
		)
	);

	// Setting: Back to top background color.
	$wp_customize->add_setting(
		'galaxis_colors[back_to_top_bg_color]',
		array(
			'default'           => $default_colors['back_to_top_bg_color'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	// Control: Back to top background color.
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'galaxis_colors[back_to_top_bg_color]',
			array(
				'section' => 'colors',
				'label'   => esc_html__( 'Back to Top Background Color', 'galaxis' ),
			)
		)
	);

	// Setting: Back to top hover background color.
	$wp_customize->add_setting(
		'galaxis_colors[back_to_top_hover_bg_color]',
		array(
			'default'           => $default_colors['back_to_top_hover_bg_color'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	// Control: Back to top hover background color.
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'galaxis_colors[back_to_top_hover_bg_color]',
			array(
				'section' => 'colors',
				'label'   => esc_html__( 'Back to Top Hover Background Color', 'galaxis' ),
			)
		)
	);

	// Setting: Footer background color.
	$wp_customize->add_setting(
		'galaxis_colors[footer_bg_color]',
		array(
			'default'           => $default_colors['footer_bg_color'],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	// Control: Footer background color.
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'galaxis_colors[footer_bg_color]',
			array(
				'section' => 'colors',
				'label'   => esc_html__( 'Footer Background Color', 'galaxis' ),
			)
		)
	);
}
add_action( 'customize_register', 'galaxis_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function galaxis_customize_partial_blogname() {
	if ( is_front_page() && is_home() ) {
		?>
		<a class="site-link" href="<?php echo esc_url( home_url() ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
		<?php
	} else {
		?>
		<a class="site-link" href="<?php echo esc_url( home_url() ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
		<?php
	}
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function galaxis_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function galaxis_customize_preview() {
	wp_enqueue_script( 'galaxis-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview', 'jquery' ), GALAXIS_VERSION, true );

	wp_localize_script(
		'galaxis-customizer',
		'galaxis',
		array(
			'default_colors' => galaxis_get_color_defaults(),
		)
	);
}
add_action( 'customize_preview_init', 'galaxis_customize_preview' );

/**
 * Sanitize site info text.
 *
 * @param string $input Input text.
 * @return string
 */
function galaxis_sanitize_site_info_text( $input ) {
	$allowed = galaxis_site_info_allowed_tags();
	return wp_kses( $input, $allowed );
}

/**
 * Checkbox sanitization.
 *
 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked`
 * as a boolean value, either TRUE or FALSE.
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
function galaxis_sanitize_checkbox( $checked ) {
	return ( isset( $checked ) && true === $checked ) ? true : false;
}

/**
 * Sanitize select.
 *
 * @param string $input The input from the setting.
 * @param object $setting The selected setting.
 *
 * @return string $input|$setting->default The input from the setting or the default setting.
 */
function galaxis_sanitize_select( $input, $setting ) {
	$input   = sanitize_key( $input );
	$choices = $setting->manager->get_control( $setting->id )->choices;
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}
