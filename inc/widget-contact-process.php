<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * SVRGN Contact Process widget — "From message to a plan." with the
 * 3-step process list. Drop into "Contact — What Happens Next".
 */
class SVRGN_Contact_Process_Widget extends SVRGN_Fields_Widget {

	protected $fields = array(
		'eyebrow'       => array( 'Eyebrow', 'text' ),
		'heading_line1' => array( 'Heading — line 1', 'text' ),
		'heading_line2' => array( 'Heading — line 2', 'text' ),
		'lead'          => array( 'Lead paragraph', 'textarea' ),
		'step1_title'   => array( 'Step 01 — title', 'text' ),
		'step1_desc'    => array( 'Step 01 — description', 'textarea' ),
		'step2_title'   => array( 'Step 02 — title', 'text' ),
		'step2_desc'    => array( 'Step 02 — description', 'textarea' ),
		'step3_title'   => array( 'Step 03 — title', 'text' ),
		'step3_desc'    => array( 'Step 03 — description', 'textarea' ),
	);

	public function __construct() {
		parent::__construct( 'svrgn_contact_process_widget', 'SVRGN: Contact Process', array(
			'description' => 'The "what happens next" 3-step process section on the Contact page.',
		) );
	}

	protected function defaults() {
		return array(
			'eyebrow'       => 'What Happens Next',
			'heading_line1' => 'From message',
			'heading_line2' => 'to a plan.',
			'lead'          => "No black box. Here's exactly what happens after you hit send.",
			'step1_title'   => 'You Reach Out',
			'step1_desc'    => 'Tell us about your brand, your goals, and where things feel stuck right now.',
			'step2_title'   => 'We Take A Look',
			'step2_desc'    => 'We review your account and creative before we ever get on a call, so the conversation is useful from minute one.',
			'step3_title'   => 'We Talk',
			'step3_desc'    => 'A straight 30-minute call to figure out, together, whether SVRGN is the right fit.',
		);
	}

	public function widget( $args, $instance ) {
		$d = wp_parse_args( $instance, $this->defaults() );
		$steps = array(
			array( '01', $d['step1_title'], $d['step1_desc'] ),
			array( '02', $d['step2_title'], $d['step2_desc'] ),
			array( '03', $d['step3_title'], $d['step3_desc'] ),
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

		<div class="process-list" data-reveal-list>
		  <?php foreach ( $steps as $s ) : ?>
		  <div class="process-item">
		    <span class="process-mark"><?php echo esc_html( $s[0] ); ?></span>
		    <h3><?php echo esc_html( $s[1] ); ?></h3>
		    <p><?php echo esc_html( $s[2] ); ?></p>
		  </div>
		  <?php endforeach; ?>
		</div>
		<?php
	}
}

add_action( 'widgets_init', function () { register_widget( 'SVRGN_Contact_Process_Widget' ); } );
