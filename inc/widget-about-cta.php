<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * SVRGN About Closing CTA widget — "Ready to build your system?"
 * Drop into "About — Closing CTA".
 */
class SVRGN_About_CTA_Widget extends SVRGN_Fields_Widget {

	protected $fields = array(
		'eyebrow'       => array( 'Eyebrow', 'text' ),
		'heading_line1' => array( 'Heading — line 1', 'text' ),
		'heading_line2' => array( 'Heading — line 2', 'text' ),
		'lead'          => array( 'Lead paragraph', 'textarea' ),
		'btn_text'      => array( 'Button — label', 'text' ),
		'btn_link'      => array( 'Button — link', 'text' ),
	);

	public function __construct() {
		parent::__construct( 'svrgn_about_cta_widget', 'SVRGN: About Closing CTA', array(
			'description' => 'The About page\'s closing "ready to build your system?" CTA.',
		) );
	}

	protected function defaults() {
		return array(
			'eyebrow'       => "Let's Build Yours",
			'heading_line1' => 'Ready to build',
			'heading_line2' => 'your system?',
			'lead'          => "If you're a growth-stage ecommerce brand looking to turn paid media into a predictable revenue engine, let's talk.",
			'btn_text'      => 'Schedule a Strategy Call',
			'btn_link'      => '/#contact',
		);
	}

	public function widget( $args, $instance ) {
		$d = wp_parse_args( $instance, $this->defaults() );
		$link = ( 0 === strpos( $d['btn_link'], '/' ) ) ? home_url( $d['btn_link'] ) : $d['btn_link'];
		?>
		<div class="eyebrow" style="justify-content:center;"><?php echo esc_html( $d['eyebrow'] ); ?></div>
		<h2><?php echo esc_html( $d['heading_line1'] ); ?><br><?php echo esc_html( $d['heading_line2'] ); ?></h2>
		<p><?php echo esc_html( $d['lead'] ); ?></p>
		<a href="<?php echo esc_url( $link ); ?>" class="btn btn-solid">
		  <?php echo esc_html( $d['btn_text'] ); ?>
		  <?php echo svrgn_arrow_icon(); ?>
		</a>
		<?php
	}
}

add_action( 'widgets_init', function () { register_widget( 'SVRGN_About_CTA_Widget' ); } );
