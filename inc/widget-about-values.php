<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * SVRGN About Values widget — "Built different, by design." with the
 * 3 value cards (A / B / C). Drop into "About — Values".
 */
class SVRGN_About_Values_Widget extends SVRGN_Fields_Widget {

	protected $fields = array(
		'eyebrow'       => array( 'Eyebrow', 'text' ),
		'heading_line1' => array( 'Heading — line 1', 'text' ),
		'heading_line2' => array( 'Heading — line 2', 'text' ),
		'lead'          => array( 'Lead paragraph', 'textarea' ),
		'value1_title'  => array( 'Value A — title', 'text' ),
		'value1_desc'   => array( 'Value A — description', 'textarea' ),
		'value2_title'  => array( 'Value B — title', 'text' ),
		'value2_desc'   => array( 'Value B — description', 'textarea' ),
		'value3_title'  => array( 'Value C — title', 'text' ),
		'value3_desc'   => array( 'Value C — description', 'textarea' ),
	);

	public function __construct() {
		parent::__construct( 'svrgn_about_values_widget', 'SVRGN: About Values', array(
			'description' => 'The "built different, by design" values section with its 3 cards.',
		) );
	}

	protected function defaults() {
		return array(
			'eyebrow'       => 'How We Operate',
			'heading_line1' => 'Built different,',
			'heading_line2' => 'by design.',
			'lead'          => "A few things that don't change no matter how big the account gets.",
			'value1_title'  => 'Senior-Led',
			'value1_desc'   => 'You talk directly to the people doing the work, every time — not a rotating cast of account managers.',
			'value2_title'  => 'Boutique by Choice',
			'value2_desc'   => "We stay small on purpose, not because we can't grow. It's what lets every account get real attention.",
			'value3_title'  => 'Systems, Not Stunts',
			'value3_desc'   => "Every deliverable ties back to the system behind it — not a one-off win that doesn't repeat.",
		);
	}

	public function widget( $args, $instance ) {
		$d = wp_parse_args( $instance, $this->defaults() );
		$values = array(
			array( 'A', $d['value1_title'], $d['value1_desc'] ),
			array( 'B', $d['value2_title'], $d['value2_desc'] ),
			array( 'C', $d['value3_title'], $d['value3_desc'] ),
		);
		?>
		<div class="split-head">
		  <div class="split-head-row">
		    <div>
		      <div class="eyebrow"><?php echo esc_html( $d['eyebrow'] ); ?></div>
		      <h2><?php echo esc_html( $d['heading_line1'] ); ?><br><?php echo esc_html( $d['heading_line2'] ); ?></h2>
		    </div>
		    <p class="lead"><?php echo esc_html( $d['lead'] ); ?></p>
		  </div>
		</div>

		<div class="values-list" data-reveal-list>
		  <?php foreach ( $values as $v ) : ?>
		  <div class="value-item">
		    <span class="value-mark"><?php echo esc_html( $v[0] ); ?></span>
		    <h3><?php echo esc_html( $v[1] ); ?></h3>
		    <p><?php echo esc_html( $v[2] ); ?></p>
		  </div>
		  <?php endforeach; ?>
		</div>
		<?php
	}
}

add_action( 'widgets_init', function () { register_widget( 'SVRGN_About_Values_Widget' ); } );
