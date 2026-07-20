<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * SVRGN Insight widget — the "You came for the ads. You'll stay for the
 * system." pivot section, with its two comparison columns.
 * Drop into the "Home — Insight" widget area.
 */
class SVRGN_Insight_Widget extends SVRGN_Fields_Widget {

	protected $fields = array(
		'eyebrow'       => array( 'Eyebrow', 'text' ),
		'heading_line1' => array( 'Heading — line 1', 'text' ),
		'heading_line2' => array( 'Heading — line 2', 'text' ),
		'lead'          => array( 'Lead paragraph', 'textarea' ),
		'left_heading'  => array( 'Left column heading', 'text' ),
		'left_items'    => array( 'Left column items (one per line)', 'textarea' ),
		'right_heading' => array( 'Right column heading', 'text' ),
		'right_items'   => array( 'Right column items (one per line)', 'textarea' ),
	);

	public function __construct() {
		parent::__construct( 'svrgn_insight_widget', 'SVRGN: Insight', array(
			'description' => 'The "you came for the ads, you\'ll stay for the system" comparison section.',
		) );
	}

	protected function defaults() {
		return array(
			'eyebrow'       => 'Where It Actually Starts',
			'heading_line1' => "You came for the ads.",
			'heading_line2' => "You'll stay for the system.",
			'lead'          => "Most brands come to us to fix media. Once we're inside the account, the real constraint is usually upstream.",
			'left_heading'  => 'What Brands Come To Us For',
			'left_items'    => "A stalled or declining ROAS\nRising CPMs and CPCs\nBetter Meta & Google account management\nA launch that needs to convert",
			'right_heading' => 'What We Usually Find',
			'right_items'   => "No repeatable content system behind the ads\nCreative that can't hold up as spend increases\nFunnel messaging disconnected from media\nA strategy layer missing beneath the spend",
		);
	}

	public function widget( $args, $instance ) {
		$d = wp_parse_args( $instance, $this->defaults() );
		$left  = $this->lines( $d['left_items'] );
		$right = $this->lines( $d['right_items'] );
		?>
		<div class="head-row">
		  <div>
		    <div class="eyebrow"><?php echo esc_html( $d['eyebrow'] ); ?></div>
		    <h2><?php echo esc_html( $d['heading_line1'] ); ?><br><?php echo esc_html( $d['heading_line2'] ); ?></h2>
		  </div>
		  <p class="lead"><?php echo esc_html( $d['lead'] ); ?></p>
		</div>

		<div class="pivot-grid" data-pivot-reveal>
		  <div class="pivot-col" data-slide="left">
		    <h4><?php echo esc_html( $d['left_heading'] ); ?></h4>
		    <ul>
		      <?php foreach ( $left as $item ) : ?>
		      <li><em>—</em><?php echo esc_html( $item ); ?></li>
		      <?php endforeach; ?>
		    </ul>
		  </div>
		  <div class="pivot-col hot" data-slide="right">
		    <h4><?php echo esc_html( $d['right_heading'] ); ?></h4>
		    <ul>
		      <?php foreach ( $right as $item ) : ?>
		      <li><em>+</em><?php echo esc_html( $item ); ?></li>
		      <?php endforeach; ?>
		    </ul>
		  </div>
		</div>
		<?php
	}
}

add_action( 'widgets_init', function () { register_widget( 'SVRGN_Insight_Widget' ); } );
