<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * SVRGN Contact CTA widget — the homepage's closing "LET'S TALK" section
 * with the button and the website/email/location rows.
 * Drop into "Home — Contact CTA".
 */
class SVRGN_Contact_CTA_Widget extends SVRGN_Fields_Widget {

	protected $fields = array(
		'eyebrow'         => array( 'Eyebrow', 'text' ),
		'title'           => array( 'Title', 'text' ),
		'lead'            => array( 'Lead paragraph', 'textarea' ),
		'btn_text'        => array( 'Button — label', 'text' ),
		'btn_link'        => array( 'Button — link', 'text' ),
		'website_display' => array( 'Website — display text', 'text' ),
		'website_url'     => array( 'Website — link', 'url' ),
		'email'           => array( 'Email address', 'text' ),
		'location'        => array( 'Location', 'text' ),
	);

	public function __construct() {
		parent::__construct( 'svrgn_contact_cta_widget', 'SVRGN: Contact CTA', array(
			'description' => 'The homepage\'s closing "LET\'S TALK" section.',
		) );
	}

	protected function defaults() {
		return array(
			'eyebrow'         => "Let's Build a System That Scales",
			'title'           => "LET'S TALK",
			'lead'            => "If you're a growth-stage ecommerce brand looking to turn paid media into a predictable revenue engine, we'd love to explore whether SVRGN is the right partner. Clarity first. Execution follows.",
			'btn_text'        => 'Schedule a Strategy Call',
			'btn_link'        => 'mailto:andyg@svrgnmedia.com',
			'website_display' => 'svrgnmedia.com',
			'website_url'     => 'https://svrgnmedia.com',
			'email'           => 'andyg@svrgnmedia.com',
			'location'        => 'Costa Mesa, CA',
		);
	}

	public function widget( $args, $instance ) {
		$d = wp_parse_args( $instance, $this->defaults() );
		?>
		<div class="eyebrow" data-reveal><?php echo esc_html( $d['eyebrow'] ); ?></div>
		<h2 class="contact-title" data-reveal><?php echo esc_html( $d['title'] ); ?></h2>

		<div class="contact-grid">
		  <p class="hero-sub" style="max-width:46ch;font-size:1.1rem;" data-reveal><?php echo esc_html( $d['lead'] ); ?></p>
		  <div>
		    <a href="<?php echo esc_attr( $d['btn_link'] ); ?>" class="btn btn-solid" style="margin-bottom:2rem;">
		      <?php echo esc_html( $d['btn_text'] ); ?>
		      <?php echo svrgn_arrow_icon(); ?>
		    </a>
		    <div class="contact-rows">
		      <div class="contact-row"><span>Website</span><a href="<?php echo esc_url( $d['website_url'] ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $d['website_display'] ); ?> <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M6 18L18 6M18 6H9M18 6V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></a></div>
		      <div class="contact-row"><span>Email</span><a href="mailto:<?php echo esc_attr( $d['email'] ); ?>"><?php echo esc_html( $d['email'] ); ?></a></div>
		      <div class="contact-row"><span>Location</span><span><?php echo esc_html( $d['location'] ); ?></span></div>
		    </div>
		  </div>
		</div>
		<?php
	}
}

add_action( 'widgets_init', function () { register_widget( 'SVRGN_Contact_CTA_Widget' ); } );
