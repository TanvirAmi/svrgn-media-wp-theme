<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Customizer additions.
 * - Image logo upload is already handled natively by WordPress under
 *   Appearance > Customize > Site Identity > Logo, enabled via
 *   add_theme_support( 'custom-logo' ) in functions.php.
 * - The fields below cover what core doesn't: the text fallback shown
 *   when no image logo is set, and the footer copyright/tagline text.
 */
function svrgn_customize_register( $wp_customize ) {

	/* ---------------- Logo (text fallback) ---------------- */
	$wp_customize->add_section( 'svrgn_logo_text', array(
		'title'       => 'Logo Text (fallback)',
		'description' => 'Shown only when no image logo is uploaded above under Site Identity → Logo.',
		'priority'    => 25,
	) );

	$wp_customize->add_setting( 'svrgn_logo_text_sub', array(
		'default'           => 'Media / Performance Creative',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'svrgn_logo_text_sub', array(
		'type'    => 'text',
		'section' => 'svrgn_logo_text',
		'label'   => 'Text',
	) );

	/* ---------------- Footer ---------------- */
	$wp_customize->add_section( 'svrgn_footer', array(
		'title'    => 'Footer',
		'priority' => 120,
	) );

	$wp_customize->add_setting( 'svrgn_footer_copyright', array(
		'default'           => '© {year} SVRGN Media — Performance Creative',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'svrgn_footer_copyright', array(
		'type'        => 'text',
		'section'     => 'svrgn_footer',
		'label'       => 'Copyright text',
		'description' => 'Use {year} anywhere you want the current year inserted automatically.',
	) );

	$wp_customize->add_setting( 'svrgn_footer_tagline', array(
		'default'           => 'Strategy / Creative / Media / Data',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'svrgn_footer_tagline', array(
		'type'    => 'text',
		'section' => 'svrgn_footer',
		'label'   => 'Right-side tagline',
	) );

	/* ---------------- Contact Form ---------------- */
	$wp_customize->add_section( 'svrgn_contact_form', array(
		'title'       => 'Contact Form',
		'description' => 'Optional: use Contact Form 7 instead of the built-in contact form on the Contact page.',
		'priority'    => 125,
	) );

	$wp_customize->add_setting( 'svrgn_cf7_shortcode', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'svrgn_cf7_shortcode', array(
		'type'        => 'text',
		'section'     => 'svrgn_contact_form',
		'label'       => 'Contact Form 7 shortcode',
		'description' => 'Paste the shortcode shown in Contact → Contact Forms for your form, e.g. [contact-form-7 id="123" title="Contact form"]. Requires the Contact Form 7 plugin to be active. Leave blank to keep using the built-in form.',
	) );
}
add_action( 'customize_register', 'svrgn_customize_register' );

/**
 * Returns the footer copyright text with {year} replaced.
 */
function svrgn_footer_copyright_text() {
	$text = get_theme_mod( 'svrgn_footer_copyright', '© {year} SVRGN Media — Performance Creative' );
	return str_replace( '{year}', date( 'Y' ), $text );
}
