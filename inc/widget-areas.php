<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Every entry becomes one widget area (sidebar). Drop a Text/HTML
 * ("Custom HTML") widget into each from Appearance > Widgets to manage
 * that section's copy. If a widget area is left empty, the original
 * design copy is shown automatically (see svrgn_section() in
 * inc/template-tags.php), so the site never looks broken mid-edit.
 */
function svrgn_widget_area_map() {
	return array(
		// Homepage — one area per section
		'home-hero'            => 'Home — Hero',
		'home-problem'         => 'Home — Problem',
		'home-insight'         => 'Home — Insight',
		'home-system'          => 'Home — System Diagram Intro',
		'home-work'            => 'Home — What We Do',
		'home-projects-intro'  => 'Home — Selected Work',
		'home-results'         => 'Home — Results & Impact',
		'home-fit'             => 'Home — Who We Work With',
		'home-engage'          => 'Home — Engage',
		'home-different'       => 'Home — What Makes Us Different',
		'home-contact'         => 'Home — Contact CTA',

		// About page
		'about-hero'           => 'About — Hero',
		'about-story'          => 'About — Story / Philosophy',
		'about-team'           => 'About — Team',
		'about-values'         => 'About — Values',
		'about-cta'            => 'About — Closing CTA',

		// Contact page
		'contact-hero'         => 'Contact — Hero',
		'contact-info'         => 'Contact — Location & Info Card',
		'contact-process'      => 'Contact — What Happens Next',
		'contact-cta'          => 'Contact — Closing CTA',
	);
}

function svrgn_register_widget_areas() {
	foreach ( svrgn_widget_area_map() as $id => $name ) {
		register_sidebar( array(
			'id'            => $id,
			'name'          => $name,
			'description'   => 'Edit the content for this section with a Custom HTML widget.',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title screen-reader-text">',
			'after_title'   => '</h3>',
		) );
	}
}
add_action( 'widgets_init', 'svrgn_register_widget_areas' );
