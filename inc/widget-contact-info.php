<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * SVRGN Contact Info widget — the info-card next to the location beacon
 * (email, location, hours, directions link). The beacon graphic itself
 * stays fixed/decorative. Drop into "Contact — Location & Info Card".
 */
class SVRGN_Contact_Info_Widget extends SVRGN_Fields_Widget {

	protected $fields = array(
		'email'            => array( 'Email address', 'text' ),
		'location'         => array( 'Location', 'text' ),
		'hours'            => array( 'Hours', 'text' ),
		'directions_text'  => array( 'Directions link — label', 'text' ),
		'directions_url'   => array( 'Directions link — URL', 'url' ),
	);

	public function __construct() {
		parent::__construct( 'svrgn_contact_info_widget', 'SVRGN: Contact Info Card', array(
			'description' => 'The email / location / hours / directions info card on the Contact page.',
		) );
	}

	protected function defaults() {
		return array(
			'email'           => 'andyg@svrgnmedia.com',
			'location'        => 'Costa Mesa, California',
			'hours'           => 'Mon–Fri, 9AM–6PM PT',
			'directions_text' => 'Open in Maps',
			'directions_url'  => 'https://www.google.com/maps/search/?api=1&query=Costa+Mesa%2C+CA',
		);
	}

	public function widget( $args, $instance ) {
		$d = wp_parse_args( $instance, $this->defaults() );
		?>
		<div class="info-card">
		  <div class="info-row"><span>Email</span><a href="mailto:<?php echo esc_attr( $d['email'] ); ?>"><?php echo esc_html( $d['email'] ); ?></a></div>
		  <div class="info-row"><span>Location</span><span><?php echo esc_html( $d['location'] ); ?></span></div>
		  <div class="info-row"><span>Hours</span><span><?php echo esc_html( $d['hours'] ); ?></span></div>
		  <div class="info-row">
		    <span>Directions</span>
		    <a class="info-directions" href="<?php echo esc_url( $d['directions_url'] ); ?>" target="_blank" rel="noopener">
		      <?php echo esc_html( $d['directions_text'] ); ?>
		      <?php echo svrgn_arrow_icon(); ?>
		    </a>
		  </div>
		</div>
		<?php
	}
}

add_action( 'widgets_init', function () { register_widget( 'SVRGN_Contact_Info_Widget' ); } );
