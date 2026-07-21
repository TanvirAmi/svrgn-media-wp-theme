<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Outputs a registered widget area if it has widgets in it, otherwise
 * falls back to the original static design copy. This means the theme
 * looks correct out of the box, and every section becomes editable the
 * moment a Custom HTML widget is added to it in Appearance > Widgets.
 *
 * @param string   $sidebar_id  Widget area ID (see inc/widget-areas.php).
 * @param callable $fallback    Function that echoes the default markup.
 */
function svrgn_section( $sidebar_id, $fallback ) {
	if ( is_active_sidebar( $sidebar_id ) ) {
		dynamic_sidebar( $sidebar_id );
	} else {
		call_user_func( $fallback );
	}
}

/**
 * Formats the "01 / 06" style index used on case-study / service / project cards.
 */
function svrgn_index_label( $position, $total ) {
	return str_pad( $position, 2, '0', STR_PAD_LEFT ) . ' / ' . str_pad( $total, 2, '0', STR_PAD_LEFT );
}

/**
 * Returns the configured Contact Form 7 shortcode if the plugin is active
 * and a shortcode has been set in Customizer → Contact Form, otherwise
 * an empty string. Templates use this to decide whether to render CF7
 * or fall back to the theme's built-in contact form.
 */
function svrgn_get_cf7_shortcode() {
	if ( ! function_exists( 'wpcf7_contact_form' ) ) return '';
	$shortcode = get_theme_mod( 'svrgn_cf7_shortcode', '' );
	return trim( $shortcode );
}

/**
 * Shared arrow icon markup used on cards and buttons throughout the theme.
 */
function svrgn_arrow_icon() {
	return '<svg viewBox="0 0 24 24" fill="none"><path d="M6 18L18 6M18 6H9M18 6V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';
}
