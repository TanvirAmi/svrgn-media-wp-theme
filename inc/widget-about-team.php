<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * SVRGN About Team widget — "Three people. One system." with the 3 team
 * cards. Photos use the real media-library picker (see inc/widget-base.php).
 * Drop into "About — Team".
 */
class SVRGN_About_Team_Widget extends SVRGN_Fields_Widget {

	protected $fields = array(
		'eyebrow'         => array( 'Eyebrow', 'text' ),
		'heading_line1'   => array( 'Heading — line 1', 'text' ),
		'heading_line2'   => array( 'Heading — line 2', 'text' ),
		'lead'            => array( 'Lead paragraph', 'textarea' ),

		'member1_image'   => array( 'Member 1 — photo', 'image' ),
		'member1_name'    => array( 'Member 1 — name', 'text' ),
		'member1_role'    => array( 'Member 1 — role', 'text' ),
		'member1_bio'     => array( 'Member 1 — bio', 'textarea' ),
		'member1_linkedin' => array( 'Member 1 — LinkedIn URL (optional)', 'url' ),
		'member1_email'   => array( 'Member 1 — email (optional)', 'text' ),

		'member2_image'   => array( 'Member 2 — photo', 'image' ),
		'member2_name'    => array( 'Member 2 — name', 'text' ),
		'member2_role'    => array( 'Member 2 — role', 'text' ),
		'member2_bio'     => array( 'Member 2 — bio', 'textarea' ),
		'member2_linkedin' => array( 'Member 2 — LinkedIn URL (optional)', 'url' ),
		'member2_email'   => array( 'Member 2 — email (optional)', 'text' ),

		'member3_image'   => array( 'Member 3 — photo', 'image' ),
		'member3_name'    => array( 'Member 3 — name', 'text' ),
		'member3_role'    => array( 'Member 3 — role', 'text' ),
		'member3_bio'     => array( 'Member 3 — bio', 'textarea' ),
		'member3_linkedin' => array( 'Member 3 — LinkedIn URL (optional)', 'url' ),
		'member3_email'   => array( 'Member 3 — email (optional)', 'text' ),
	);

	public function __construct() {
		parent::__construct( 'svrgn_about_team_widget', 'SVRGN: About Team', array(
			'description' => 'The "three people, one system" team grid with photo picker, LinkedIn + email links.',
		) );
	}

	protected function defaults() {
		return array(
			'eyebrow'          => 'The Team',
			'heading_line1'    => 'Three people.',
			'heading_line2'    => 'One system.',
			'lead'             => 'No account managers, no hand-offs. You work directly with the people doing the work.',

			'member1_image'    => SVRGN_URI . '/assets/img/placeholder-team-1.jpg',
			'member1_name'     => 'Andy Griffin',
			'member1_role'     => 'Founder — Creative Director',
			'member1_bio'      => '15+ years building brand-forward creative systems for growth-stage ecommerce. Leads strategy and creative direction on every account.',
			'member1_linkedin' => '',
			'member1_email'    => '',

			'member2_image'    => SVRGN_URI . '/assets/img/placeholder-team-2.jpg',
			'member2_name'     => 'Priya Nataraj',
			'member2_role'     => 'Head of Paid Media',
			'member2_bio'      => 'Former in-house media lead turned fractional partner. Runs Meta, Google, and YouTube spend across the roster.',
			'member2_linkedin' => '',
			'member2_email'    => '',

			'member3_image'    => SVRGN_URI . '/assets/img/placeholder-team-3.jpg',
			'member3_name'     => 'Jordan Cole',
			'member3_role'     => 'Creative Producer',
			'member3_bio'      => 'Directs photo and video from concept to cut, keeping every shoot tied back to what the data says will convert.',
			'member3_linkedin' => '',
			'member3_email'    => '',
		);
	}

	/** LinkedIn/email icon markup, wrapped in a real link when a URL/email is set. */
	private function social_icon( $type, $value ) {
		$icons = array(
			'linkedin' => '<svg viewBox="0 0 24 24" fill="none"><path d="M4 4h16v16H4z" stroke="none"/><path d="M6.5 9.5v8M6.5 6.5v.01M11 17.5v-5c0-1.4 1-2.5 2.5-2.5S16 11 16 12.5v5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>',
			'email'    => '<svg viewBox="0 0 24 24" fill="none"><path d="M4 6h16v12H4z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><path d="M4 7l8 6 8-6" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg>',
		);
		$label = 'linkedin' === $type ? 'LinkedIn' : 'Email';
		if ( $value ) {
			$href = 'linkedin' === $type ? esc_url( $value ) : 'mailto:' . antispambot( sanitize_email( $value ) );
			echo '<a href="' . $href . '" target="_blank" rel="noopener" aria-label="' . esc_attr( $label ) . '" onclick="event.stopPropagation();">' . $icons[ $type ] . '</a>';
		} else {
			echo '<span aria-label="' . esc_attr( $label ) . '">' . $icons[ $type ] . '</span>';
		}
	}

	public function widget( $args, $instance ) {
		$d = wp_parse_args( $instance, $this->defaults() );
		$members = array( 1, 2, 3 );
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

		<div class="team-grid" data-reveal-list>
		  <?php foreach ( $members as $n ) :
		    $prefix = "member{$n}_";
		  ?>
		  <a class="team-card" href="<?php echo esc_url( home_url( '/#contact' ) ); ?>">
		    <img class="team-img" src="<?php echo esc_url( $d[ $prefix . 'image' ] ); ?>" alt="<?php echo esc_attr( $d[ $prefix . 'name' ] . ' — ' . $d[ $prefix . 'role' ] ); ?>">
		    <div class="team-tint"></div>
		    <div class="team-scrim"></div>
		    <div class="team-content">
		      <div class="team-top">
		        <span class="team-index"><?php echo esc_html( str_pad( $n, 2, '0', STR_PAD_LEFT ) ); ?></span>
		        <span class="team-role"><?php echo esc_html( $d[ $prefix . 'role' ] ); ?></span>
		      </div>
		      <div>
		        <div class="team-name"><?php echo esc_html( $d[ $prefix . 'name' ] ); ?></div>
		        <p class="team-bio"><?php echo esc_html( $d[ $prefix . 'bio' ] ); ?></p>
		        <div class="team-social">
		          <?php
		          $this->social_icon( 'linkedin', $d[ $prefix . 'linkedin' ] );
		          $this->social_icon( 'email', $d[ $prefix . 'email' ] );
		          ?>
		        </div>
		      </div>
		    </div>
		  </a>
		  <?php endforeach; ?>
		</div>
		<?php
	}
}

add_action( 'widgets_init', function () { register_widget( 'SVRGN_About_Team_Widget' ); } );
