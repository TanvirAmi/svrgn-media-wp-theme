<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * SVRGN Hero Video widget.
 *
 * A proper classic widget (not just a Custom HTML block) so the video URL,
 * headline, subtext, buttons, and stat counters are each their own field
 * in Appearance > Widgets — no HTML editing required.
 *
 * Drag it into the "Home — Hero" widget area to take over that section.
 * Leave the area empty and the original hard-coded hero in front-page.php
 * is shown instead (see svrgn_section() in inc/template-tags.php).
 */
class SVRGN_Hero_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'svrgn_hero_widget',
			'SVRGN: Hero Video',
			array(
				'description'                 => 'The homepage hero: background video, headline, subtext, two buttons, and three stat counters.',
				'customize_selective_refresh' => true,
			)
		);
	}

	private function defaults() {
		return array(
			'video_url'     => 'https://cdn.sanity.io/files/8nn8fua5/production/c6fb986a862cbe643c40cbdd0318ebc495efb187.mp4',
			'corner_top'    => 'Costa Mesa, CA · Est. Performance Studio',
			'corner_bottom' => 'Strategy — Creative — Media — Data',
			'eyebrow'       => 'Boutique Creative-Performance Studio',
			'heading_line1' => 'BUILT TO SCALE.',
			'heading_line2' => 'NOT STALL.',
			'subtext'       => "SVRGN Media is a boutique creative-performance studio for growth-stage ecommerce brands. We find what's actually holding growth back, then build the system to fix it.",
			'btn1_text'     => 'Schedule a Strategy Call',
			'btn1_link'     => '#contact',
			'btn2_text'     => 'See How We Work',
			'btn2_link'     => '#system',
			'stat1_value'   => '40',
			'stat1_suffix'  => '%',
			'stat1_label'   => 'YoY Growth',
			'stat2_value'   => '10',
			'stat2_suffix'  => 'x',
			'stat2_label'   => 'Blended ROAS',
			'stat3_value'   => '7',
			'stat3_suffix'  => '-Fig',
			'stat3_label'   => 'Revenue Lift / 6mo',
		);
	}

	/* ---------------- Front-end output ---------------- */
	public function widget( $args, $instance ) {
		$d = wp_parse_args( $instance, $this->defaults() );
		?>
		<section class="hero" id="hero">
		  <div class="hero-video-wrap">
		    <video class="hero-video" id="heroVideo" autoplay muted loop playsinline preload="auto">
		      <source src="<?php echo esc_url( $d['video_url'] ); ?>" type="video/mp4">
		    </video>
		  </div>
		  <div class="hero-scrim"></div>
		  <div class="hero-grain"></div>

		  <button class="mute-toggle" id="muteToggle" type="button" aria-label="Unmute background video">
		    <svg class="icon-on" viewBox="0 0 24 24"><path d="M4 9v6h4l5 5V4L8 9H4z"/><path d="M16.5 8.5a5 5 0 0 1 0 7"/></svg>
		    <svg class="icon-off" viewBox="0 0 24 24"><path d="M4 9v6h4l5 5V4L8 9H4z"/><path d="M16 9l5 5M21 9l-5 5"/></svg>
		  </button>

		  <div class="hero-frame">
		    <span class="hero-corner tr"><?php echo esc_html( $d['corner_top'] ); ?></span>
		    <span class="hero-corner bl"><?php echo esc_html( $d['corner_bottom'] ); ?></span>
		  </div>

		  <div class="hero-inner">
		    <div class="hero-eyebrow eyebrow"><?php echo esc_html( $d['eyebrow'] ); ?></div>
		    <h1 class="hero-title">
		      <span class="line"><span><?php echo esc_html( $d['heading_line1'] ); ?></span></span>
		      <span class="line"><span class="accent-word"><?php echo esc_html( $d['heading_line2'] ); ?></span></span>
		    </h1>

		    <div class="hero-foot">
		      <p class="hero-sub"><?php echo esc_html( $d['subtext'] ); ?></p>
		      <div class="hero-actions">
		        <a href="<?php echo esc_url( $d['btn1_link'] ); ?>" class="btn btn-solid">
		          <?php echo esc_html( $d['btn1_text'] ); ?>
		          <?php echo svrgn_arrow_icon(); ?>
		        </a>
		        <a href="<?php echo esc_url( $d['btn2_link'] ); ?>" class="btn btn-ghost"><?php echo esc_html( $d['btn2_text'] ); ?></a>
		      </div>
		      <div class="hero-stats">
		        <div class="hero-stat"><b data-count="<?php echo esc_attr( $d['stat1_value'] ); ?>" data-suffix="<?php echo esc_attr( $d['stat1_suffix'] ); ?>">0<?php echo esc_html( $d['stat1_suffix'] ); ?></b><span><?php echo esc_html( $d['stat1_label'] ); ?></span></div>
		        <div class="hero-stat"><b data-count="<?php echo esc_attr( $d['stat2_value'] ); ?>" data-suffix="<?php echo esc_attr( $d['stat2_suffix'] ); ?>">0<?php echo esc_html( $d['stat2_suffix'] ); ?></b><span><?php echo esc_html( $d['stat2_label'] ); ?></span></div>
		        <div class="hero-stat"><b data-count="<?php echo esc_attr( $d['stat3_value'] ); ?>" data-suffix="<?php echo esc_attr( $d['stat3_suffix'] ); ?>">0</b><span><?php echo esc_html( $d['stat3_label'] ); ?></span></div>
		      </div>
		    </div>
		  </div>

		  <div class="scroll-cue"><span>Scroll</span><span class="bar"></span></div>
		</section>
		<?php
	}

	/* ---------------- Admin form ---------------- */
	public function form( $instance ) {
		$d = wp_parse_args( $instance, $this->defaults() );
		$fields = array(
			'video_url'     => array( 'Background Video URL (.mp4)', 'url' ),
			'corner_top'    => array( 'Top-right corner label', 'text' ),
			'corner_bottom' => array( 'Bottom-left corner label', 'text' ),
			'eyebrow'       => array( 'Eyebrow text', 'text' ),
			'heading_line1' => array( 'Headline — line 1', 'text' ),
			'heading_line2' => array( 'Headline — line 2 (accent color)', 'text' ),
			'subtext'       => array( 'Subtext', 'textarea' ),
			'btn1_text'     => array( 'Button 1 — label', 'text' ),
			'btn1_link'     => array( 'Button 1 — link', 'text' ),
			'btn2_text'     => array( 'Button 2 — label', 'text' ),
			'btn2_link'     => array( 'Button 2 — link', 'text' ),
			'stat1_value'   => array( 'Stat 1 — number', 'text' ),
			'stat1_suffix'  => array( 'Stat 1 — suffix (%, x, etc.)', 'text' ),
			'stat1_label'   => array( 'Stat 1 — label', 'text' ),
			'stat2_value'   => array( 'Stat 2 — number', 'text' ),
			'stat2_suffix'  => array( 'Stat 2 — suffix', 'text' ),
			'stat2_label'   => array( 'Stat 2 — label', 'text' ),
			'stat3_value'   => array( 'Stat 3 — number', 'text' ),
			'stat3_suffix'  => array( 'Stat 3 — suffix', 'text' ),
			'stat3_label'   => array( 'Stat 3 — label', 'text' ),
		);
		foreach ( $fields as $key => $meta ) {
			list( $label, $type ) = $meta;
			$id   = $this->get_field_id( $key );
			$name = $this->get_field_name( $key );
			$val  = $d[ $key ];
			echo '<p><label for="' . esc_attr( $id ) . '">' . esc_html( $label ) . '</label>';
			if ( 'textarea' === $type ) {
				echo '<textarea class="widefat" rows="3" id="' . esc_attr( $id ) . '" name="' . esc_attr( $name ) . '">' . esc_textarea( $val ) . '</textarea>';
			} else {
				echo '<input class="widefat" type="text" id="' . esc_attr( $id ) . '" name="' . esc_attr( $name ) . '" value="' . esc_attr( $val ) . '">';
			}
			echo '</p>';
		}
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		foreach ( array_keys( $this->defaults() ) as $key ) {
			if ( ! isset( $new_instance[ $key ] ) ) continue;
			$instance[ $key ] = 'subtext' === $key
				? sanitize_textarea_field( $new_instance[ $key ] )
				: sanitize_text_field( $new_instance[ $key ] );
		}
		return $instance;
	}
}

function svrgn_register_hero_widget() {
	register_widget( 'SVRGN_Hero_Widget' );
}
add_action( 'widgets_init', 'svrgn_register_hero_widget' );
