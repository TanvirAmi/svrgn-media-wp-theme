<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * SVRGN About Story widget — "Small on purpose." with the two-paragraph
 * story body and the pull quote. Drop into "About — Story / Philosophy".
 */
class SVRGN_About_Story_Widget extends SVRGN_Fields_Widget {

	protected $fields = array(
		'eyebrow'      => array( 'Eyebrow', 'text' ),
		'heading'      => array( 'Heading', 'text' ),
		'lead'         => array( 'Lead paragraph', 'textarea' ),
		'paragraph1'   => array( 'Story — paragraph 1', 'textarea' ),
		'paragraph2'   => array( 'Story — paragraph 2', 'textarea' ),
		'quote_plain'  => array( 'Quote — plain part', 'text' ),
		'quote_accent' => array( 'Quote — accent part (colored span)', 'text' ),
	);

	public function __construct() {
		parent::__construct( 'svrgn_about_story_widget', 'SVRGN: About Story', array(
			'description' => 'The "small on purpose" story/philosophy section with its pull quote.',
		) );
	}

	protected function defaults() {
		return array(
			'eyebrow'      => 'How We Think',
			'heading'      => 'Small on purpose.',
			'lead'         => 'SVRGN stays intentionally small. Every account gets senior attention, not a rotating cast of coordinators.',
			'paragraph1'   => 'We started SVRGN because we kept seeing the same pattern: brands hiring a media buyer here, a video editor there, a strategist somewhere else — and wondering why nothing compounded.',
			'paragraph2'   => "We'd rather do fewer things well than everything adequately. That means staying boutique by choice, not by accident, and turning away work that doesn't fit rather than diluting the system that makes SVRGN work in the first place.",
			'quote_plain'  => "Creative without strategy doesn't scale.",
			'quote_accent' => "Strategy without creative doesn't convert.",
		);
	}

	public function widget( $args, $instance ) {
		$d = wp_parse_args( $instance, $this->defaults() );
		?>
		<div class="split-head">
		  <div class="split-head-row">
		    <div>
		      <div class="eyebrow"><?php echo esc_html( $d['eyebrow'] ); ?></div>
		      <h2><?php echo esc_html( $d['heading'] ); ?></h2>
		    </div>
		    <p class="lead"><?php echo esc_html( $d['lead'] ); ?></p>
		  </div>
		</div>
		<div class="story-grid">
		  <div class="story-body">
		    <p><?php echo esc_html( $d['paragraph1'] ); ?></p>
		    <p><?php echo esc_html( $d['paragraph2'] ); ?></p>
		  </div>
		  <div class="story-quote" data-reveal>
		    <?php echo esc_html( $d['quote_plain'] ); ?> <span><?php echo esc_html( $d['quote_accent'] ); ?></span>
		  </div>
		</div>
		<?php
	}
}

add_action( 'widgets_init', function () { register_widget( 'SVRGN_About_Story_Widget' ); } );
