<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * SVRGN Problem widget — "Most brands don't have a traffic problem."
 * with the numbered problem list and the clip-reveal pull quote.
 * Drop into "Home — Problem".
 */
class SVRGN_Problem_Widget extends SVRGN_Fields_Widget {

	protected $fields = array(
		'eyebrow'        => array( 'Eyebrow', 'text' ),
		'heading_line1'  => array( 'Heading — line 1', 'text' ),
		'heading_line2'  => array( 'Heading — line 2', 'text' ),
		'lead'           => array( 'Lead paragraph', 'textarea' ),
		'items'          => array( 'Problem list (one per line)', 'textarea' ),
		'quote_text'     => array( 'Quote — plain part', 'text' ),
		'quote_accent'   => array( 'Quote — accent part (colored span)', 'text' ),
		'quote_suffix'   => array( 'Quote — text after the accent part', 'text' ),
	);

	public function __construct() {
		parent::__construct( 'svrgn_problem_widget', 'SVRGN: Problem', array(
			'description' => 'The "most brands don\'t have a traffic problem" section with its numbered list + pull quote.',
		) );
	}

	protected function defaults() {
		return array(
			'eyebrow'       => 'Why Growth Stalls',
			'heading_line1' => "Most brands don't",
			'heading_line2' => 'have a traffic problem.',
			'lead'          => 'They have a system problem. As spend increases, the cracks show up fast — and they compound.',
			'items'         => "Creative fatigues faster than it's replaced, so CPMs climb and CTR erodes.\nMedia gets optimized in isolation from message — the ad and the offer stop agreeing.\nFunnels that worked at low volume become inefficient the moment spend scales.\nBudget gets spent re-testing the basics instead of compounding what already works.",
			'quote_text'    => 'Scaling requires',
			'quote_accent'  => 'a system',
			'quote_suffix'  => '— not more ads.',
		);
	}

	public function widget( $args, $instance ) {
		$d = wp_parse_args( $instance, $this->defaults() );
		$items = $this->lines( $d['items'] );
		?>
		<div class="head-row">
		  <div>
		    <div class="eyebrow"><?php echo esc_html( $d['eyebrow'] ); ?></div>
		    <h2><?php echo esc_html( $d['heading_line1'] ); ?><br><?php echo esc_html( $d['heading_line2'] ); ?></h2>
		  </div>
		  <p class="lead"><?php echo esc_html( $d['lead'] ); ?></p>
		</div>

		<div class="problem-grid">
		  <ul class="problem-list" data-reveal-list>
		    <?php foreach ( $items as $i => $item ) : ?>
		    <li><b><?php echo esc_html( str_pad( $i + 1, 2, '0', STR_PAD_LEFT ) ); ?></b><p><?php echo esc_html( $item ); ?></p></li>
		    <?php endforeach; ?>
		  </ul>
		  <div class="problem-quote" data-clip-reveal>
		    <?php echo esc_html( $d['quote_text'] ); ?> <span><?php echo esc_html( $d['quote_accent'] ); ?></span> <?php echo esc_html( $d['quote_suffix'] ); ?>
		  </div>
		</div>
		<?php
	}
}

add_action( 'widgets_init', function () { register_widget( 'SVRGN_Problem_Widget' ); } );
