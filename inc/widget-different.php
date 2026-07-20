<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * SVRGN Different widget — "What makes SVRGN different." with the trust
 * paragraph and the numbered differentiator list. Drop into
 * "Home — What Makes Us Different".
 */
class SVRGN_Different_Widget extends SVRGN_Fields_Widget {

	protected $fields = array(
		'eyebrow'       => array( 'Eyebrow', 'text' ),
		'heading_line1' => array( 'Heading — line 1', 'text' ),
		'heading_line2' => array( 'Heading — line 2', 'text' ),
		'lead'          => array( 'Lead paragraph', 'textarea' ),
		'paragraph'     => array( 'Trust paragraph (left column)', 'textarea' ),
		'diff_items'    => array( 'Differentiators (one per line)', 'textarea' ),
	);

	public function __construct() {
		parent::__construct( 'svrgn_different_widget', 'SVRGN: What Makes Us Different', array(
			'description' => 'The "built different, by design" trust statement + numbered list.',
		) );
	}

	protected function defaults() {
		return array(
			'eyebrow'       => 'Built Different, By Design',
			'heading_line1' => 'What makes SVRGN',
			'heading_line2' => 'different.',
			'lead'          => 'A senior-led, boutique studio. Clients work directly with strategists — not a revolving door of account managers.',
			'paragraph'     => 'We believe trust is built through consistency and follow-through. What we commit to is what we deliver — no bait-and-switch, no inflated promises. This is how performance compounds.',
			'diff_items'    => "Creative and paid media under one roof\nPerformance-led creative direction, informed by data\nFull-funnel strategy, not isolated campaign optimization\nSenior-level oversight on every engagement\nSystems built to scale — not stall",
		);
	}

	public function widget( $args, $instance ) {
		$d = wp_parse_args( $instance, $this->defaults() );
		$items = $this->lines( $d['diff_items'] );
		?>
		<div class="head-row">
		  <div>
		    <div class="eyebrow"><?php echo esc_html( $d['eyebrow'] ); ?></div>
		    <h2><?php echo esc_html( $d['heading_line1'] ); ?><br><?php echo esc_html( $d['heading_line2'] ); ?></h2>
		  </div>
		  <p class="lead"><?php echo esc_html( $d['lead'] ); ?></p>
		</div>

		<div class="diff-grid">
		  <p class="stone" data-reveal style="font-size:1.05rem;line-height:1.7;max-width:44ch;"><?php echo esc_html( $d['paragraph'] ); ?></p>
		  <ul class="diff-list" data-reveal-list>
		    <?php foreach ( $items as $i => $item ) : ?>
		    <li><b><?php echo esc_html( str_pad( $i + 1, 2, '0', STR_PAD_LEFT ) ); ?></b><?php echo esc_html( $item ); ?></li>
		    <?php endforeach; ?>
		  </ul>
		</div>
		<?php
	}
}

add_action( 'widgets_init', function () { register_widget( 'SVRGN_Different_Widget' ); } );
