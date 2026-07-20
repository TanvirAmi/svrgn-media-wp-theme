<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * SVRGN Engage widget — "Engagements designed for growth." with the
 * 3 engagement model cards (A / B / C). Drop into "Home — Engage".
 */
class SVRGN_Engage_Widget extends SVRGN_Fields_Widget {

	protected $fields = array(
		'eyebrow'       => array( 'Eyebrow', 'text' ),
		'heading_line1' => array( 'Heading — line 1', 'text' ),
		'heading_line2' => array( 'Heading — line 2', 'text' ),
		'lead'          => array( 'Lead paragraph', 'textarea' ),
		'item1_title'   => array( 'Model A — title', 'text' ),
		'item1_desc'    => array( 'Model A — description', 'textarea' ),
		'item2_title'   => array( 'Model B — title', 'text' ),
		'item2_desc'    => array( 'Model B — description', 'textarea' ),
		'item3_title'   => array( 'Model C — title', 'text' ),
		'item3_desc'    => array( 'Model C — description', 'textarea' ),
	);

	public function __construct() {
		parent::__construct( 'svrgn_engage_widget', 'SVRGN: Engage', array(
			'description' => 'The "engagements designed for growth" section with its 3 models.',
		) );
	}

	protected function defaults() {
		return array(
			'eyebrow'       => 'How We Work Together',
			'heading_line1' => 'Engagements designed',
			'heading_line2' => 'for growth.',
			'lead'          => 'Flexible models built for brands at different stages — from strategic direction to full-scale execution.',
			'item1_title'   => 'Ongoing Performance Creative & Paid Media',
			'item1_desc'    => 'Integrated creative and media execution focused on scalable, profitable growth.',
			'item2_title'   => 'Fractional Paid Media Leadership',
			'item2_desc'    => 'Senior-level strategic oversight for brands that need experienced guidance without a full-time hire.',
			'item3_title'   => 'Strategy Intensives & Workshops',
			'item3_desc'    => 'Focused sessions designed to diagnose performance, define direction, and align teams around a clear roadmap.',
		);
	}

	public function widget( $args, $instance ) {
		$d = wp_parse_args( $instance, $this->defaults() );
		$items = array(
			array( 'A', $d['item1_title'], $d['item1_desc'] ),
			array( 'B', $d['item2_title'], $d['item2_desc'] ),
			array( 'C', $d['item3_title'], $d['item3_desc'] ),
		);
		?>
		<div class="head-row">
		  <div>
		    <div class="eyebrow"><?php echo esc_html( $d['eyebrow'] ); ?></div>
		    <h2><?php echo esc_html( $d['heading_line1'] ); ?><br><?php echo esc_html( $d['heading_line2'] ); ?></h2>
		  </div>
		  <p class="lead"><?php echo esc_html( $d['lead'] ); ?></p>
		</div>

		<div class="engage-list" data-reveal-list>
		  <?php foreach ( $items as $item ) : ?>
		  <div class="engage-item">
		    <span class="engage-mark"><?php echo esc_html( $item[0] ); ?></span>
		    <h3><?php echo esc_html( $item[1] ); ?></h3>
		    <p><?php echo esc_html( $item[2] ); ?></p>
		  </div>
		  <?php endforeach; ?>
		</div>
		<?php
	}
}

add_action( 'widgets_init', function () { register_widget( 'SVRGN_Engage_Widget' ); } );
