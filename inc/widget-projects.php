<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * SVRGN Selected Work widget — intro copy + the full pinned horizontal
 * gallery, with cards pulled live from the Project CPT (not Case Studies —
 * Projects are the lightweight homepage cards; Case Studies are the full
 * write-ups). Drop into "Home — Selected Work Intro".
 */
class SVRGN_Projects_Widget extends SVRGN_Fields_Widget {

	protected $fields = array(
		'eyebrow'       => array( 'Eyebrow', 'text' ),
		'heading_line1' => array( 'Heading — line 1', 'text' ),
		'heading_line2' => array( 'Heading — line 2', 'text' ),
		'lead'          => array( 'Lead paragraph', 'textarea' ),
		'count'         => array( 'Number of projects to show', 'text' ),
		'see_more_text' => array( '"See more" button label', 'text' ),
		'see_more_link' => array( '"See more" button link (leave blank to use the Case Studies page)', 'url' ),
	);

	public function __construct() {
		parent::__construct( 'svrgn_projects_widget', 'SVRGN: Selected Work', array(
			'description' => 'The homepage "Selected Work" gallery. Cards pull live from the Projects CPT.',
		) );
	}

	protected function defaults() {
		return array(
			'eyebrow'       => 'Selected Work',
			'heading_line1' => 'A few systems',
			'heading_line2' => "we've built.",
			'lead'          => 'A sample of engagements where strategy, creative, and media were built together — not bolted on after the fact.',
			'count'         => '6',
			'see_more_text' => 'See More Work',
			'see_more_link' => '',
		);
	}

	public function widget( $args, $instance ) {
		$d = wp_parse_args( $instance, $this->defaults() );
		$count = max( 1, (int) $d['count'] );
		?>
		<div class="head-row">
		  <div>
		    <div class="eyebrow"><?php echo esc_html( $d['eyebrow'] ); ?></div>
		    <h2><?php echo esc_html( $d['heading_line1'] ); ?><br><?php echo esc_html( $d['heading_line2'] ); ?></h2>
		  </div>
		  <p class="lead"><?php echo esc_html( $d['lead'] ); ?></p>
		</div>

		<?php
		$projects = new WP_Query( array(
			'post_type'      => 'project',
			'posts_per_page' => $count,
			'orderby'        => 'menu_order date',
			'order'          => 'ASC',
		) );
		if ( $projects->have_posts() ) :
			$total = $projects->post_count;
			$i = 0;
		?>
		<div class="gallery-pin" id="galleryPin">
		  <div class="gallery-viewport" id="galleryViewport">
		    <div class="gallery-track" id="galleryTrack" data-reveal-list>
		      <?php while ( $projects->have_posts() ) : $projects->the_post(); $i++; ?>
		      <a class="project-card" href="<?php the_permalink(); ?>" data-tilt>
		        <div class="project-art">
		          <div class="project-parallax">
		            <?php if ( has_post_thumbnail() ) : ?>
		              <?php the_post_thumbnail( 'svrgn-card', array( 'class' => 'project-img', 'loading' => 'lazy' ) ); ?>
		            <?php else : ?>
		              <img class="project-img" src="https://picsum.photos/seed/svrgn-<?php echo esc_attr( get_the_ID() ); ?>/800/1000" alt="<?php the_title_attribute(); ?>" loading="lazy">
		            <?php endif; ?>
		          </div>
		          <div class="project-tint"></div>
		        </div>
		        <div class="project-content">
		          <div class="project-top">
		            <span class="project-index"><?php echo esc_html( svrgn_index_label( $i, $total ) ); ?></span>
		            <span class="project-tag"><?php echo esc_html( get_post_meta( get_the_ID(), '_case_tag', true ) ); ?></span>
		          </div>
		          <div>
		            <div class="project-title"><?php the_title(); ?></div>
		            <p class="project-desc"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 22 ) ); ?></p>
		            <span class="project-view">View Project
		              <?php echo svrgn_arrow_icon(); ?>
		            </span>
		          </div>
		        </div>
		      </a>
		      <?php endwhile; wp_reset_postdata(); ?>
		    </div>
		  </div>

		  <div class="gallery-meta">
		    <span class="gallery-hint">
		      Scroll to explore
		      <svg viewBox="0 0 24 24"><path d="M4 12h16M14 6l6 6-6 6"/></svg>
		    </span>
		    <span class="gallery-count"><span id="galleryActive">01</span> / <span id="galleryTotal"><?php echo esc_html( str_pad( $total, 2, '0', STR_PAD_LEFT ) ); ?></span></span>
		  </div>
		  <div class="gallery-bar"><i id="galleryBarFill"></i></div>
		</div>

		<div class="see-more-wrap">
		  <?php
		  $see_more_url = $d['see_more_link'];
		  if ( ! $see_more_url ) {
		    $case_studies_page = get_page_by_path( 'case-studies' );
		    $see_more_url = $case_studies_page ? get_permalink( $case_studies_page ) : home_url( '/case-studies/' );
		  }
		  ?>
		  <a href="<?php echo esc_url( $see_more_url ); ?>" class="see-more-btn" id="seeMoreBtn">
		    <span class="see-more-fill"></span>
		    <span class="see-more-label"><?php echo esc_html( $d['see_more_text'] ); ?></span>
		    <span class="see-more-arrow">
		      <?php echo svrgn_arrow_icon(); ?>
		    </span>
		  </a>
		</div>
		<?php else : ?>
		  <p class="stone">Add Projects from the WP admin under "Projects" to populate this gallery.</p>
		<?php endif; ?>
		<?php
	}
}

add_action( 'widgets_init', function () { register_widget( 'SVRGN_Projects_Widget' ); } );
