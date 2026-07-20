<?php
/**
 * SVRGN Media theme functions.
 *
 * Architecture notes for Tanvir:
 * - Homepage sections are each a widget area (matches the widget-area-per-section
 *   pattern used on the earlier svrgn-media build). Drop Text/HTML (Custom HTML)
 *   widgets into Appearance > Widgets to edit copy without touching code.
 * - "Selected Work" on the homepage and the Case Studies page template both pull
 *   live from the case_study CPT. The Services page template pulls from service.
 * - About + Contact pages are 100% widget-driven (page-about.php / page-contact.php),
 *   matched by page slug. Create pages with slugs "about" and "contact".
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'SVRGN_VER', '1.0.0' );
define( 'SVRGN_DIR', get_template_directory() );
define( 'SVRGN_URI', get_template_directory_uri() );

/* -----------------------------------------------------------
 * Theme setup
 * --------------------------------------------------------- */
function svrgn_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
	add_theme_support( 'custom-logo', array(
		'height'      => 60,
		'width'       => 200,
		'flex-height' => true,
		'flex-width'  => true,
	) );

	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'svrgn-media' ),
		'footer'  => __( 'Footer Navigation', 'svrgn-media' ),
	) );

	// Card thumbnails used across case studies / services / projects.
	add_image_size( 'svrgn-card', 900, 1100, true );
}
add_action( 'after_setup_theme', 'svrgn_setup' );

/* -----------------------------------------------------------
 * Assets
 * --------------------------------------------------------- */
function svrgn_enqueue_assets() {

	// Shared vendor libs (GSAP) — every template uses at least core + ScrollTrigger.
	wp_enqueue_script( 'gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js', array(), '3.12.5', true );
	wp_enqueue_script( 'gsap-scrolltrigger', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js', array( 'gsap' ), '3.12.5', true );

	$page_css_handle = 'svrgn-case-studies'; // matches the else{} fallback below unless overridden

	if ( is_front_page() ) {
		wp_enqueue_script( 'gsap-motionpath', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/MotionPathPlugin.min.js', array( 'gsap' ), '3.12.5', true );
		wp_enqueue_script( 'gsap-scrollto', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollToPlugin.min.js', array( 'gsap' ), '3.12.5', true );

		wp_enqueue_style( 'svrgn-home', SVRGN_URI . '/assets/css/home.css', array(), SVRGN_VER );
		wp_enqueue_script( 'svrgn-home', SVRGN_URI . '/assets/js/home.js', array( 'gsap', 'gsap-scrolltrigger', 'gsap-motionpath', 'gsap-scrollto' ), SVRGN_VER, true );
		$page_css_handle = 'svrgn-home';

	} elseif ( is_page_template( 'page-templates/case-studies.php' ) || is_singular( 'case_study' ) ) {

		wp_enqueue_style( 'svrgn-case-studies', SVRGN_URI . '/assets/css/case-studies.css', array(), SVRGN_VER );
		wp_enqueue_script( 'svrgn-case-studies', SVRGN_URI . '/assets/js/case-studies.js', array( 'gsap', 'gsap-scrolltrigger' ), SVRGN_VER, true );
		$page_css_handle = 'svrgn-case-studies';

	} elseif ( is_page_template( 'page-templates/services.php' ) || is_singular( 'service' ) ) {

		wp_enqueue_style( 'svrgn-services', SVRGN_URI . '/assets/css/services.css', array(), SVRGN_VER );
		wp_enqueue_script( 'svrgn-services', SVRGN_URI . '/assets/js/services.js', array( 'gsap', 'gsap-scrolltrigger' ), SVRGN_VER, true );
		$page_css_handle = 'svrgn-services';

	} elseif ( is_page( 'about' ) || is_page_template( 'page-templates/about.php' ) ) {

		wp_enqueue_style( 'svrgn-about', SVRGN_URI . '/assets/css/about.css', array(), SVRGN_VER );
		wp_enqueue_script( 'svrgn-about', SVRGN_URI . '/assets/js/about.js', array( 'gsap', 'gsap-scrolltrigger' ), SVRGN_VER, true );
		$page_css_handle = 'svrgn-about';

	} elseif ( is_page( 'contact' ) || is_page_template( 'page-templates/contact.php' ) ) {

		wp_enqueue_style( 'svrgn-contact', SVRGN_URI . '/assets/css/contact.css', array(), SVRGN_VER );
		wp_enqueue_script( 'svrgn-contact', SVRGN_URI . '/assets/js/contact.js', array( 'gsap', 'gsap-scrolltrigger' ), SVRGN_VER, true );
		wp_localize_script( 'svrgn-contact', 'svrgnContact', array(
			'ajaxUrl' => admin_url( 'admin-ajax.php' ),
			'nonce'   => wp_create_nonce( 'svrgn_contact_form' ),
		) );
		$page_css_handle = 'svrgn-contact';

	} else {
		// Fallback: default to the case-studies stylesheet since it holds the
		// shared cs-hero / cs-cta / nav / footer rules used by inner pages.
		wp_enqueue_style( 'svrgn-case-studies', SVRGN_URI . '/assets/css/case-studies.css', array(), SVRGN_VER );
	}

	// Site-wide header: logo sizing, dropdown submenus, hamburger + mobile
	// drawer. Depends on the page stylesheet so it always prints after it —
	// needed since it overrides some of that stylesheet's nav rules.
	wp_enqueue_style( 'svrgn-site-header', SVRGN_URI . '/assets/css/site-header.css', array( $page_css_handle ), SVRGN_VER );
	wp_enqueue_script( 'svrgn-site-header', SVRGN_URI . '/assets/js/site-header.js', array(), SVRGN_VER, true );
}
add_action( 'wp_enqueue_scripts', 'svrgn_enqueue_assets' );

/* -----------------------------------------------------------
 * Custom Post Types: Case Studies + Services
 * --------------------------------------------------------- */
require_once SVRGN_DIR . '/inc/cpt-case-study.php';
require_once SVRGN_DIR . '/inc/cpt-service.php';
require_once SVRGN_DIR . '/inc/cpt-project.php';
require_once SVRGN_DIR . '/inc/widget-areas.php';
require_once SVRGN_DIR . '/inc/widget-hero.php';
require_once SVRGN_DIR . '/inc/widget-base.php';
require_once SVRGN_DIR . '/inc/widget-problem.php';
require_once SVRGN_DIR . '/inc/widget-insight.php';
require_once SVRGN_DIR . '/inc/widget-system.php';
require_once SVRGN_DIR . '/inc/widget-work.php';
require_once SVRGN_DIR . '/inc/widget-projects.php';
require_once SVRGN_DIR . '/inc/widget-results.php';
require_once SVRGN_DIR . '/inc/widget-fit.php';
require_once SVRGN_DIR . '/inc/widget-engage.php';
require_once SVRGN_DIR . '/inc/widget-different.php';
require_once SVRGN_DIR . '/inc/widget-contact.php';
require_once SVRGN_DIR . '/inc/widget-about-hero.php';
require_once SVRGN_DIR . '/inc/widget-about-story.php';
require_once SVRGN_DIR . '/inc/widget-about-team.php';
require_once SVRGN_DIR . '/inc/widget-about-values.php';
require_once SVRGN_DIR . '/inc/widget-about-cta.php';
require_once SVRGN_DIR . '/inc/widget-contact-hero.php';
require_once SVRGN_DIR . '/inc/widget-contact-info.php';
require_once SVRGN_DIR . '/inc/widget-contact-process.php';
require_once SVRGN_DIR . '/inc/widget-contact-page-cta.php';
require_once SVRGN_DIR . '/inc/contact-form.php';
require_once SVRGN_DIR . '/inc/template-tags.php';
require_once SVRGN_DIR . '/inc/customizer.php';
