<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * SVRGN Results widget — "Proof, not promises." The 3 stat counters stay
 * manually-entered fields (they're headline numbers, not tied to any post).
 * The 4-card highlight grid now pulls live from the Case Study CPT, using
 * each case study's Tag, Featured Image, Title, and "Result headline"
 * meta field (falls back to a trimmed excerpt if that field is empty).
 * Drop into "Home — Results & Impact".
 */
class SVRGN_Results_Widget extends SVRGN_Fields_Widget {

	protected $fields = array(
		'eyebrow'      => array( 'Eyebrow', 'text' ),
		'heading'      => array( 'Heading', 'text' ),
		'lead'         => array( 'Lead paragraph', 'textarea' ),

		'stat1_value'  => array( 'Stat 1 — number', 'text' ),
		'stat1_suffix' => array( 'Stat 1 — suffix (%, x, etc.)', 'text' ),
		'stat1_desc'   => array( 'Stat 1 — description', 'textarea' ),
		'stat2_value'  => array( 'Stat 2 — number', 'text' ),
		'stat2_suffix' => array( 'Stat 2 — suffix', 'text' ),
		'stat2_desc'   => array( 'Stat 2 — description', 'textarea' ),
		'stat3_value'  => array( 'Stat 3 — value (e.g. "7-Fig", static, no counter)', 'text' ),
		'stat3_desc'   => array( 'Stat 3 — description', 'textarea' ),

		'count'        => array( 'Number of case studies to highlight', 'text' ),
	);

	public function __construct() {
		parent::__construct( 'svrgn_results_widget', 'SVRGN: Results & Impact', array(
			'description' => 'The "proof, not promises" stats + highlight grid, pulled live from Case Studies.',
		) );
	}

	protected function defaults() {
		return array(
			'eyebrow'      => 'Results & Impact',
			'heading'      => 'Proof, not promises.',
			'lead'         => 'Our work is measured by outcomes, not activity — systems that hold up as spend increases.',
			'stat1_value'  => '40', 'stat1_suffix' => '%', 'stat1_desc' => 'Year-over-year growth for a DTC brand — a multi-million-dollar revenue increase in year one.',
			'stat2_value'  => '10', 'stat2_suffix' => 'x', 'stat2_desc' => 'Blended ROAS achieved across Meta campaigns.',
			'stat3_value'  => '7-Fig', 'stat3_desc' => 'Revenue lift delivered in six months for a growth-stage brand.',
			'count'        => '4',
		);
	}

	public function widget( $args, $instance ) {
		$d = wp_parse_args( $instance, $this->defaults() );
		$count = max( 1, (int) $d['count'] );
		?>
		<div class="head-row">
		  <div>
		    <div class="eyebrow"><?php echo esc_html( $d['eyebrow'] ); ?></div>
		    <h2><?php echo esc_html( $d['heading'] ); ?></h2>
		  </div>
		  <p class="lead"><?php echo esc_html( $d['lead'] ); ?></p>
		</div>

		<div class="stat-row" data-reveal-list>
		  <div class="stat-card"><div class="num"><span data-count="<?php echo esc_attr( $d['stat1_value'] ); ?>" data-suffix="<?php echo esc_attr( $d['stat1_suffix'] ); ?>">0<?php echo esc_html( $d['stat1_suffix'] ); ?></span></div><p><?php echo esc_html( $d['stat1_desc'] ); ?></p></div>
		  <div class="stat-card"><div class="num"><span data-count="<?php echo esc_attr( $d['stat2_value'] ); ?>" data-suffix="<?php echo esc_attr( $d['stat2_suffix'] ); ?>">0<?php echo esc_html( $d['stat2_suffix'] ); ?></span></div><p><?php echo esc_html( $d['stat2_desc'] ); ?></p></div>
		  <div class="stat-card"><div class="num"><?php echo esc_html( $d['stat3_value'] ); ?></div><p><?php echo esc_html( $d['stat3_desc'] ); ?></p></div>
		</div>

		<?php
		$highlights = new WP_Query( array(
			'post_type'      => 'case_study',
			'posts_per_page' => $count,
			'orderby'        => 'menu_order date',
			'order'          => 'ASC',
		) );
		if ( $highlights->have_posts() ) :
		?>
		<div class="case-grid" data-reveal-list>
		  <?php while ( $highlights->have_posts() ) : $highlights->the_post();
		    $result = get_post_meta( get_the_ID(), '_case_result', true );
		    if ( ! $result ) $result = wp_trim_words( get_the_excerpt(), 10 );
		  ?>
		  <div class="case-card" data-tilt>
		    <div class="case-art">
		      <div class="case-parallax">
		        <?php if ( has_post_thumbnail() ) : ?>
		          <?php the_post_thumbnail( 'svrgn-card', array( 'class' => 'case-img', 'loading' => 'lazy' ) ); ?>
		        <?php else : ?>
		          <img class="case-img" src="https://picsum.photos/seed/svrgn-<?php echo esc_attr( get_the_ID() ); ?>/900/1200" alt="<?php the_title_attribute(); ?>" loading="lazy">
		        <?php endif; ?>
		      </div>
		      <div class="case-tint"></div>
		    </div>
		    <div class="case-content">
		      <span class="case-tag"><?php echo esc_html( get_post_meta( get_the_ID(), '_case_tag', true ) ); ?></span>
		      <div>
		        <div class="case-title"><?php the_title(); ?></div>
		        <div class="case-result"><?php echo esc_html( $result ); ?></div>
		      </div>
		    </div>
		  </div>
		  <?php endwhile; wp_reset_postdata(); ?>
		</div>
		<?php else : ?>
		  <p class="stone">Add Case Studies from the WP admin to populate this highlight grid.</p>
		<?php endif; ?>
		<?php
	}
}

add_action( 'widgets_init', function () { register_widget( 'SVRGN_Results_Widget' ); } );
