<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * SVRGN Contact Page Closing CTA widget — "Reach us directly."
 * Named distinctly from SVRGN_Contact_CTA_Widget (inc/widget-contact.php),
 * which is the homepage's "LET'S TALK" section — different widget, same
 * general idea. Drop this one into "Contact — Closing CTA".
 */
class SVRGN_Contact_Page_CTA_Widget extends SVRGN_Fields_Widget {

	protected $fields = array(
		'eyebrow'       => array( 'Eyebrow', 'text' ),
		'heading_line1' => array( 'Heading — line 1', 'text' ),
		'heading_line2' => array( 'Heading — line 2', 'text' ),
		'lead'          => array( 'Lead paragraph', 'textarea' ),
		'btn_text'      => array( 'Button — label', 'text' ),
		'btn_link'      => array( 'Button — link', 'text' ),
	);

	public function __construct() {
		parent::__construct( 'svrgn_contact_page_cta_widget', 'SVRGN: Contact Page Closing CTA', array(
			'description' => 'The Contact page\'s closing "reach us directly" CTA (distinct from the homepage Contact CTA widget).',
		) );
	}

	protected function defaults() {
		return array(
			'eyebrow'       => 'Skip The Form?',
			'heading_line1' => 'Reach us',
			'heading_line2' => 'directly.',
			'lead'          => 'Prefer email? Either way, a real person reads it — usually within a day.',
			'btn_text'      => 'Email andyg@svrgnmedia.com',
			'btn_link'      => 'mailto:andyg@svrgnmedia.com',
		);
	}

	public function widget( $args, $instance ) {
		$d = wp_parse_args( $instance, $this->defaults() );
		?>
		<div class="eyebrow" style="justify-content:center;"><?php echo esc_html( $d['eyebrow'] ); ?></div>
		<h2><?php echo esc_html( $d['heading_line1'] ); ?><br><?php echo esc_html( $d['heading_line2'] ); ?></h2>
		<p><?php echo esc_html( $d['lead'] ); ?></p>
		<a href="<?php echo esc_attr( $d['btn_link'] ); ?>" class="btn btn-solid">
		  <?php echo esc_html( $d['btn_text'] ); ?>
		  <?php echo svrgn_arrow_icon(); ?>
		</a>
		<?php
	}
}

add_action( 'widgets_init', function () { register_widget( 'SVRGN_Contact_Page_CTA_Widget' ); } );
