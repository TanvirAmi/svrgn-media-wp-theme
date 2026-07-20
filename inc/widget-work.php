<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * SVRGN Work widget — "Everything a growth system needs." with the
 * four service pillars. Drop into "Home — What We Do".
 */
class SVRGN_Work_Widget extends SVRGN_Fields_Widget {

	protected $fields = array(
		'eyebrow'       => array( 'Eyebrow', 'text' ),
		'heading_line1' => array( 'Heading — line 1', 'text' ),
		'heading_line2' => array( 'Heading — line 2', 'text' ),
		'lead'          => array( 'Lead paragraph', 'textarea' ),
		'pillar1_title' => array( 'Pillar 1 — title', 'text' ),
		'pillar1_desc'  => array( 'Pillar 1 — description', 'textarea' ),
		'pillar2_title' => array( 'Pillar 2 — title', 'text' ),
		'pillar2_desc'  => array( 'Pillar 2 — description', 'textarea' ),
		'pillar3_title' => array( 'Pillar 3 — title', 'text' ),
		'pillar3_desc'  => array( 'Pillar 3 — description', 'textarea' ),
		'pillar4_title' => array( 'Pillar 4 — title', 'text' ),
		'pillar4_desc'  => array( 'Pillar 4 — description', 'textarea' ),
	);

	public function __construct() {
		parent::__construct( 'svrgn_work_widget', 'SVRGN: What We Do', array(
			'description' => 'The "everything a growth system needs" section with the four pillars.',
		) );
	}

	protected function defaults() {
		return array(
			'eyebrow'       => 'What We Do',
			'heading_line1' => 'Everything a growth',
			'heading_line2' => 'system needs.',
			'lead'          => 'Under one roof, led by the same team — not handed between departments.',
			'pillar1_title' => 'Strategy & Diagnosis',
			'pillar1_desc'  => 'Full-funnel account architecture, offer and positioning audits, and growth roadmaps built around where performance is actually breaking.',
			'pillar2_title' => 'Creative & Production',
			'pillar2_desc'  => 'Brand-forward, platform-native photo and video, engineered from data and funnel stage — not just what looks good in a deck.',
			'pillar3_title' => 'Paid Media',
			'pillar3_desc'  => 'Meta, Google, and YouTube account management. Budget pacing, scaling methodology, and media planning led by creative, not guesswork.',
			'pillar4_title' => 'Content Systems',
			'pillar4_desc'  => 'Repeatable content engines that keep creative fresh at scale, so output outruns fatigue instead of chasing it.',
		);
	}

	public function widget( $args, $instance ) {
		$d = wp_parse_args( $instance, $this->defaults() );
		$pillars = array(
			array( '01', $d['pillar1_title'], $d['pillar1_desc'] ),
			array( '02', $d['pillar2_title'], $d['pillar2_desc'] ),
			array( '03', $d['pillar3_title'], $d['pillar3_desc'] ),
			array( '04', $d['pillar4_title'], $d['pillar4_desc'] ),
		);
		?>
		<div class="head-row">
		  <div>
		    <div class="eyebrow"><?php echo esc_html( $d['eyebrow'] ); ?></div>
		    <h2><?php echo esc_html( $d['heading_line1'] ); ?><br><?php echo esc_html( $d['heading_line2'] ); ?></h2>
		  </div>
		  <p class="lead"><?php echo esc_html( $d['lead'] ); ?></p>
		</div>

		<div class="pillar-grid" data-reveal-list>
		  <?php foreach ( $pillars as $p ) : ?>
		  <div class="pillar">
		    <span class="num"><?php echo esc_html( $p[0] ); ?></span>
		    <h3><?php echo esc_html( $p[1] ); ?></h3>
		    <p><?php echo esc_html( $p[2] ); ?></p>
		  </div>
		  <?php endforeach; ?>
		</div>
		<?php
	}
}

add_action( 'widgets_init', function () { register_widget( 'SVRGN_Work_Widget' ); } );
