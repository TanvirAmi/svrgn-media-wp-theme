<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * SVRGN About Hero widget — "We Are SVRGN" intro + the 3 stat pills.
 * Drop into "About — Hero".
 */
class SVRGN_About_Hero_Widget extends SVRGN_Fields_Widget {

	protected $fields = array(
		'eyebrow'       => array( 'Eyebrow', 'text' ),
		'heading_line1' => array( 'Heading — line 1', 'text' ),
		'heading_line2' => array( 'Heading — line 2', 'text' ),
		'lead'          => array( 'Lead paragraph', 'textarea' ),
		'stat1_value'   => array( 'Stat 1 — value', 'text' ),
		'stat1_label'   => array( 'Stat 1 — label', 'text' ),
		'stat2_value'   => array( 'Stat 2 — value', 'text' ),
		'stat2_label'   => array( 'Stat 2 — label', 'text' ),
		'stat3_value'   => array( 'Stat 3 — value', 'text' ),
		'stat3_label'   => array( 'Stat 3 — label', 'text' ),
	);

	public function __construct() {
		parent::__construct( 'svrgn_about_hero_widget', 'SVRGN: About Hero', array(
			'description' => 'The About page intro — "We Are SVRGN" — with its 3 stat pills.',
		) );
	}

	protected function defaults() {
		return array(
			'eyebrow'       => 'About SVRGN',
			'heading_line1' => 'We Are',
			'heading_line2' => 'SVRGN',
			'lead'          => "A boutique creative-performance studio, built by people who've sat on both sides of the table — inside brands and inside agencies.",
			'stat1_value'   => '12+', 'stat1_label' => 'Years Combined',
			'stat2_value'   => '3',   'stat2_label' => 'Person Core Team',
			'stat3_value'   => '6+',  'stat3_label' => 'Categories Served',
		);
	}

	public function widget( $args, $instance ) {
		$d = wp_parse_args( $instance, $this->defaults() );
		?>
		<div class="cs-hero-row">
		  <div>
		    <div class="eyebrow"><?php echo esc_html( $d['eyebrow'] ); ?></div>
		    <h1 class="cs-title"><?php echo esc_html( $d['heading_line1'] ); ?><br><?php echo esc_html( $d['heading_line2'] ); ?></h1>
		  </div>
		  <div>
		    <p class="cs-lead"><?php echo esc_html( $d['lead'] ); ?></p>
		    <div class="cs-hero-stats">
		      <div class="cs-stat"><b><?php echo esc_html( $d['stat1_value'] ); ?></b><span><?php echo esc_html( $d['stat1_label'] ); ?></span></div>
		      <div class="cs-stat"><b><?php echo esc_html( $d['stat2_value'] ); ?></b><span><?php echo esc_html( $d['stat2_label'] ); ?></span></div>
		      <div class="cs-stat"><b><?php echo esc_html( $d['stat3_value'] ); ?></b><span><?php echo esc_html( $d['stat3_label'] ); ?></span></div>
		    </div>
		  </div>
		</div>
		<?php
	}
}

add_action( 'widgets_init', function () { register_widget( 'SVRGN_About_Hero_Widget' ); } );
