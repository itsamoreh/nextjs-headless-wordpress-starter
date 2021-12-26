<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package byob
 */

if ( ! function_exists( 'byob_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 */
	function byob_setup() {
		add_theme_support( 'post-thumbnails' );

		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'bring-your-own-blocks' ),
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'byob_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 */
function byob_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'byob_content_width', 640 );
}
add_action( 'after_setup_theme', 'byob_content_width', 0 );

/**
 * Add custom editor styles.
 */
function byob_enable_editor_styles() {
	add_theme_support( 'editor-styles' );
	add_editor_style( 'style-editor.css' );
}
add_action( 'after_setup_theme', 'byob_enable_editor_styles' );

/**
 * Add Favicon.
 * Add a custom favicon to the WordPress admin panel.
 */
function byob_admin_favicon() {
	echo '<link rel="icon" href="' . get_template_directory_uri() . '/favicon.ico" />';
}
add_action( 'login_head', 'byob_admin_favicon' );
add_action( 'admin_head', 'byob_admin_favicon' );

/**
 * Remove customizer options.
 */
function byob_remove_customizer_options() {
	global $wp_customize;

	$wp_customize->remove_section( 'static_front_page' );
	$wp_customize->remove_section( 'title_tagline' );
	$wp_customize->remove_section( 'nav' );
	$wp_customize->remove_section( 'themes' );
	$wp_customize->remove_section( 'custom_css' );
}
add_action( 'customize_register', 'byob_remove_customizer_options', 30 );

/**
 * Disable Gutenberg's default fullscreen mode.
 */
function byob_disable_editor_fullscreen_mode() {
	$script = "window.onload = function() { const isFullscreenMode = wp.data.select( 'core/edit-post' ).isFeatureActive( 'fullscreenMode' ); if ( isFullscreenMode ) { wp.data.dispatch( 'core/edit-post' ).toggleFeature( 'fullscreenMode' ); } }";
	wp_add_inline_script( 'wp-blocks', $script );
}
add_action( 'enqueue_block_editor_assets', 'byob_disable_editor_fullscreen_mode' );