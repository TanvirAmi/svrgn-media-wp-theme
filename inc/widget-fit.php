<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * SVRGN Fit widget — "Built for brands ready to scale." with the 4 fit
 * criteria cards and the scrolling brand-name marquee. Icons are fixed
 * (they're purely decorative); everything else is editable.
 * Drop into "Home — Who We Work With".
 */
class SVRGN_Fit_Widget extends SVRGN_Fields_Widget {

	protected $fields = array(
		'eyebrow'        => array( 'Eyebrow', 'text' ),
		'heading_line1'  => array( 'Heading — line 1', 'text' ),
		'heading_line2'  => array( 'Heading — line 2', 'text' ),
		'lead'           => array( 'Lead paragraph', 'textarea' ),
		'fit1_text'      => array( 'Fit criterion 1', 'text' ),
		'fit2_text'      => array( 'Fit criterion 2', 'text' ),
		'fit3_text'      => array( 'Fit criterion 3', 'text' ),
		'fit4_text'      => array( 'Fit criterion 4', 'text' ),
		'marquee_label'  => array( 'Marquee label', 'text' ),
		'brand_names'    => array( 'Brand names (one per line)', 'textarea' ),
	);

	public function __construct() {
		parent::__construct( 'svrgn_fit_widget', 'SVRGN: Who We Work With', array(
			'description' => 'The "built for brands ready to scale" fit criteria + logo marquee.',
		) );
	}

	protected function defaults() {
		return array(
			'eyebrow'       => 'Who We Work With',
			'heading_line1' => 'Built for brands',
			'heading_line2' => 'ready to scale.',
			'lead'          => 'SVRGN partners with product-forward, growth-stage ecommerce brands serious about turning paid media into a predictable revenue engine.',
			'fit1_text'     => 'Established product-market fit',
			'fit2_text'     => 'Active paid media spend with intent to scale',
			'fit3_text'     => 'Clear growth goals and a long-term mindset',
			'fit4_text'     => 'Willingness to invest in creative and strategy',
			'marquee_label' => "Across categories we've built for",
			'brand_names'   => "Ridgeline Optics\nIronclad Moto\nNorthfield Apparel\nRival Athletics\nCarve & Co.\nRoller Culture",
		);
	}

	public function widget( $args, $instance ) {
		$d = wp_parse_args( $instance, $this->defaults() );
		$icons = array(
			'<svg viewBox="0 0 24 24"><path d="M12 2 L20 6 V12 C20 17 16.5 20.5 12 22 C7.5 20.5 4 17 4 12 V6 Z"/><path d="M8.5 12 L11 14.5 L16 9"/></svg>',
			'<svg viewBox="0 0 24 24"><path d="M3 17 L9 11 L13 15 L21 6"/><path d="M15 6 H21 V12"/></svg>',
			'<svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="5"/><circle cx="12" cy="12" r="1.2" fill="currentColor" stroke="none"/><path d="M12 2 V5 M12 19 V22 M2 12 H5 M19 12 H22"/></svg>',
			'<svg viewBox="0 0 24 24"><path d="M12 2 L14 9 L21 9 L15.5 13.5 L17.5 21 L12 16.5 L6.5 21 L8.5 13.5 L3 9 L10 9 Z"/></svg>',
		);
		$fits = array( $d['fit1_text'], $d['fit2_text'], $d['fit3_text'], $d['fit4_text'] );
		$brands = $this->lines( $d['brand_names'] );
		?>
		<div class="head-row">
		  <div>
		    <div class="eyebrow"><?php echo esc_html( $d['eyebrow'] ); ?></div>
		    <h2><?php echo esc_html( $d['heading_line1'] ); ?><br><?php echo esc_html( $d['heading_line2'] ); ?></h2>
		  </div>
		  <p class="lead"><?php echo esc_html( $d['lead'] ); ?></p>
		</div>

		<div class="fit-grid" data-reveal-list>
		  <?php foreach ( $fits as $i => $text ) : ?>
		  <div class="fit-card">
		    <div class="fit-icon"><?php echo $icons[ $i ]; /* fixed decorative markup */ ?></div>
		    <p><?php echo esc_html( $text ); ?></p>
		  </div>
		  <?php endforeach; ?>
		</div>

		<div class="logo-marquee-wrap">
		  <div class="logo-marquee-label"><?php echo esc_html( $d['marquee_label'] ); ?></div>
		  <div class="logo-marquee">
		    <div class="logo-track">
		      <?php
		      // Render the list twice back-to-back so the CSS marquee loop is seamless.
		      for ( $pass = 0; $pass < 2; $pass++ ) {
		        foreach ( $brands as $brand ) {
		          $hidden = $pass === 1 ? ' aria-hidden="true"' : '';
		          echo '<span class="logo-item"' . $hidden . '>' . esc_html( $brand ) . '</span><span class="logo-sep"' . $hidden . '></span>';
		        }
		      }
		      ?>
		    </div>
		  </div>
		</div>
		<?php
	}
}

add_action( 'widgets_init', function () { register_widget( 'SVRGN_Fit_Widget' ); } );
