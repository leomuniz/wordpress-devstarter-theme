<?php
/**
 * Customizer settings for this theme.
 *
 * @package WordPress
 * @subpackage Dev_Starter
 * @since Dev Starter 1.0
 */

if ( ! class_exists( 'DevStarter_Customize' ) ) {
	/**
	 * CUSTOMIZER SETTINGS
	 *
	 * @since Dev Starter 1.0
	 */
	class DevStarter_Customize {

		/**
		 * Register customizer options.
		 *
		 * @since Dev Starter 1.0
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		public static function register( $wp_customize ) {

			/**
			 * Site Title & Description.
			 * */
			$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
			$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

			$wp_customize->selective_refresh->add_partial(
				'blogname',
				array(
					'selector'        => '.site-title a',
					'render_callback' => 	function () {
						bloginfo( 'name' );
					},
				)
			);

			$wp_customize->selective_refresh->add_partial(
				'blogdescription',
				array(
					'selector'        => '.site-description',
					'render_callback' => 	function () {
						bloginfo( 'description' );
					},
				)
			);

			$wp_customize->selective_refresh->add_partial(
				'custom_logo',
				array(
					'selector'            => '.header-titles [class*=site-]:not(.site-description)',
					'container_inclusive' => true,
					'render_callback'     => function () {
						devstarter_site_logo();
					},
				)
			);

			$wp_customize->selective_refresh->add_partial(
				'retina_logo',
				array(
					'selector'        => '.header-titles [class*=site-]:not(.site-description)',
					'render_callback' => 'devstarter_customize_partial_site_logo',
				)
			);

			/**
			 * Site Identity
			 */

			/* 2X Header Logo ---------------- */
			$wp_customize->add_setting(
				'retina_logo',
				array(
					'capability'        => 'edit_theme_options',
					'sanitize_callback' => array( __CLASS__, 'sanitize_checkbox' ),
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				'retina_logo',
				array(
					'type'        => 'checkbox',
					'section'     => 'title_tagline',
					'priority'    => 10,
					'label'       => __( 'Retina logo', 'devstarter' ),
					'description' => __( 'Scales the logo to half its uploaded size, making it sharp on high-res screens.', 'devstarter' ),
				)
			);

			/**
			 * Theme Options
			 */

			$wp_customize->add_section(
				'options',
				array(
					'title'      => __( 'Theme Options', 'devstarter' ),
					'priority'   => 40,
					'capability' => 'edit_theme_options',
				)
			);

			/* Display full content or excerpts on the blog and archives --------- */

			$wp_customize->add_setting(
				'blog_content',
				array(
					'capability'        => 'edit_theme_options',
					'default'           => 'full',
					'sanitize_callback' => array( __CLASS__, 'sanitize_select' ),
				)
			);

			$wp_customize->add_control(
				'blog_content',
				array(
					'type'     => 'radio',
					'section'  => 'options',
					'priority' => 10,
					'label'    => __( 'On archive pages, posts show:', 'devstarter' ),
					'choices'  => array(
						'full'    => __( 'Full text', 'devstarter' ),
						'summary' => __( 'Summary', 'devstarter' ),
					),
				)
			);

			// Add custom background color picker on the theme customization.
			// @link https://developer.wordpress.org/themes/functionality/custom-backgrounds/
			add_theme_support(
				'custom-background',
				array(
					'default-color' => 'f5efe0',
					// 'default-image'      => get_template_directory_uri() . '/images/background.jpg',
					// 'default-position-x' => 'right',
					// 'default-position-y' => 'top',
					// 'default-repeat'     => 'no-repeat',
				)
			);

			// Allows customizing the logo on the theme customization screen.
			// @link https://developer.wordpress.org/themes/functionality/custom-logo/
			add_theme_support( 'custom-logo', CUSTOM_LOGO_ATTR );

		}

		/**
		 * Sanitize select.
		 *
		 * @since Dev Starter 1.0
		 *
		 * @param string $input   The input from the setting.
		 * @param object $setting The selected setting.
		 * @return string The input from the setting or the default setting.
		 */
		public static function sanitize_select( $input, $setting ) {
			$input   = sanitize_key( $input );
			$choices = $setting->manager->get_control( $setting->id )->choices;
			return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
		}

		/**
		 * Sanitize boolean for checkbox.
		 *
		 * @since Dev Starter 1.0
		 *
		 * @param bool $checked Whether or not a box is checked.
		 * @return bool
		 */
		public static function sanitize_checkbox( $checked ) {
			return ( ( isset( $checked ) && true === $checked ) ? true : false );
		}


		public static function maybe_hide_customizer( $classes ) {

			$classes .= HIDE_CUSTOMIZER ? 'no-customize-support' : '';

			return $classes;
		}

		public static function maybe_hide_theme_editor() {

			if ( HIDE_THEME_EDITOR ) {
				remove_submenu_page( 'themes.php', 'theme-editor.php' );
			}
		}
	}

	// Hooks
	// Setup the Theme Customizer settings and controls.
	add_action( 'customize_register', array( 'DevStarter_Customize', 'register' ) );

	// Maybe hide the Customize submenu (and also the Background color menu).
	add_filter( 'admin_body_class', array( 'DevStarter_Customize', 'maybe_hide_customizer' ), 1 );

	// Maybe hide the Theme Editor submenu.
	add_action( 'admin_menu', array( 'DevStarter_Customize', 'maybe_hide_theme_editor' ), 999 );
}
