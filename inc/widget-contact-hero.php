<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * SVRGN Contact Hero widget — "Let's Talk" intro + the 3 stat pills.
 * Drop into "Contact — Hero".
 */
class SVRGN_Contact_Hero_Widget extends SVRGN_Fields_Widget {

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
		parent::__construct( 'svrgn_contact_hero_widget', 'SVRGN: Contact Hero', array(
			'description' => 'The Contact page intro — "Let\'s Talk" — with its 3 stat pills.',
		) );
	}

	protected function defaults() {
		return array(
			'eyebrow'       => 'Get In Touch',
			'heading_line1' => "Let's",
			'heading_line2' => 'Talk',
			'lead'          => "Tell us where growth is stalling, and we'll tell you honestly whether SVRGN is the right partner to fix it. No pitch decks, no fluff — just a straight conversation.",
			'stat1_value'   => '<24h', 'stat1_label' => 'Response Time',
			'stat2_value'   => 'Free',  'stat2_label' => 'Strategy Call',
			'stat3_value'   => 'CA',    'stat3_label' => 'Costa Mesa Based',
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

add_action( 'widgets_init', function () { register_widget( 'SVRGN_Contact_Hero_Widget' ); } );
