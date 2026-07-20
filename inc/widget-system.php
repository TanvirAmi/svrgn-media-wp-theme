<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * SVRGN System widget — "One system. Not four vendors." with the
 * four-node circuit diagram (Strategy / Creative / Media / Data).
 * The diagram geometry stays fixed; node labels + descriptions are
 * editable fields. Drop into "Home — System Diagram Intro".
 */
class SVRGN_System_Widget extends SVRGN_Fields_Widget {

	protected $fields = array(
		'eyebrow'       => array( 'Eyebrow', 'text' ),
		'heading_line1' => array( 'Heading — line 1', 'text' ),
		'heading_line2' => array( 'Heading — line 2', 'text' ),
		'lead'          => array( 'Lead paragraph', 'textarea' ),
		'node1_label'   => array( 'Node 1 — label', 'text' ),
		'node1_desc'    => array( 'Node 1 — description', 'text' ),
		'node2_label'   => array( 'Node 2 — label', 'text' ),
		'node2_desc'    => array( 'Node 2 — description', 'text' ),
		'node3_label'   => array( 'Node 3 — label', 'text' ),
		'node3_desc'    => array( 'Node 3 — description', 'text' ),
		'node4_label'   => array( 'Node 4 — label', 'text' ),
		'node4_desc'    => array( 'Node 4 — description', 'text' ),
		'loop_caption'  => array( 'Center caption', 'text' ),
	);

	public function __construct() {
		parent::__construct( 'svrgn_system_widget', 'SVRGN: System Diagram', array(
			'description' => 'The "one system, not four vendors" section with the circuit diagram.',
		) );
	}

	protected function defaults() {
		return array(
			'eyebrow'       => "How We're Built",
			'heading_line1' => 'One system.',
			'heading_line2' => 'Not four vendors.',
			'lead'          => "Strategy, creative, media, and data don't operate in silos here. They're one connected loop — each stage feeding the next, so performance compounds instead of stalling.",
			'node1_label'   => 'STRATEGY',
			'node1_desc'    => 'Diagnosis & roadmap',
			'node2_label'   => 'CREATIVE',
			'node2_desc'    => 'Concept & production',
			'node3_label'   => 'MEDIA',
			'node3_desc'    => 'Meta · Google · YouTube',
			'node4_label'   => 'DATA',
			'node4_desc'    => 'Signal & iteration',
			'loop_caption'  => 'THE LOOP COMPOUNDS',
		);
	}

	public function widget( $args, $instance ) {
		$d = wp_parse_args( $instance, $this->defaults() );
		?>
		<div class="head-row">
		  <div>
		    <div class="eyebrow"><?php echo esc_html( $d['eyebrow'] ); ?></div>
		    <h2><?php echo esc_html( $d['heading_line1'] ); ?><br><?php echo esc_html( $d['heading_line2'] ); ?></h2>
		  </div>
		  <p class="lead"><?php echo esc_html( $d['lead'] ); ?></p>
		</div>

		<div class="system-wrap">
		  <div class="system-stage">
		    <svg viewBox="0 0 900 540" id="systemSvg">
		      <defs>
		        <pattern id="circuitGrid" width="30" height="30" patternUnits="userSpaceOnUse">
		          <circle cx="1" cy="1" r="1" fill="var(--line-strong)"/>
		        </pattern>
		        <filter id="neonGlow" x="-150%" y="-150%" width="400%" height="400%">
		          <feGaussianBlur in="SourceGraphic" stdDeviation="2.5" result="blur"/>
		          <feMerge>
		            <feMergeNode in="blur"/>
		            <feMergeNode in="SourceGraphic"/>
		          </feMerge>
		        </filter>
		      </defs>

		      <rect x="60" y="50" width="780" height="440" fill="url(#circuitGrid)" opacity=".5"/>

		      <path class="sys-path" data-path="1" d="M 150 110 L 750 110" fill="none" stroke="var(--line-strong)" stroke-width="1.5"/>
		      <path class="sys-path" data-path="2" d="M 750 110 L 750 430" fill="none" stroke="var(--line-strong)" stroke-width="1.5"/>
		      <path class="sys-path" data-path="3" d="M 750 430 L 150 430" fill="none" stroke="var(--line-strong)" stroke-width="1.5"/>
		      <path class="sys-path" data-path="4" d="M 150 430 L 150 110" fill="none" stroke="var(--line-strong)" stroke-width="1.5"/>
		      <path id="pulsePath" d="M 150 110 L 750 110 L 750 430 L 150 430 L 150 110" fill="none" stroke="none"/>

		      <path class="sys-chevron" d="M 444 104 L 456 110 L 444 116" />
		      <path class="sys-chevron" d="M 744 264 L 750 276 L 756 264" />
		      <path class="sys-chevron" d="M 456 436 L 444 430 L 456 424" />
		      <path class="sys-chevron" d="M 156 276 L 150 264 L 144 276" />

		      <g class="sys-node" data-node="1" transform="translate(150,110)">
		        <circle class="node-halo" r="46"/>
		        <circle r="42" fill="var(--ink)" stroke="var(--accent)" stroke-width="1.5"/>
		        <text text-anchor="middle" y="-4" class="node-label" fill="var(--paper)"><?php echo esc_html( $d['node1_label'] ); ?></text>
		        <text text-anchor="middle" y="16" class="node-desc"><?php echo esc_html( $d['node1_desc'] ); ?></text>
		      </g>
		      <g class="sys-node" data-node="2" transform="translate(750,110)">
		        <circle class="node-halo" r="46"/>
		        <circle r="42" fill="var(--ink)" stroke="var(--accent)" stroke-width="1.5"/>
		        <text text-anchor="middle" y="-4" class="node-label" fill="var(--paper)"><?php echo esc_html( $d['node2_label'] ); ?></text>
		        <text text-anchor="middle" y="16" class="node-desc"><?php echo esc_html( $d['node2_desc'] ); ?></text>
		      </g>
		      <g class="sys-node" data-node="3" transform="translate(750,430)">
		        <circle class="node-halo" r="46"/>
		        <circle r="42" fill="var(--ink)" stroke="var(--accent)" stroke-width="1.5"/>
		        <text text-anchor="middle" y="-4" class="node-label" fill="var(--paper)"><?php echo esc_html( $d['node3_label'] ); ?></text>
		        <text text-anchor="middle" y="16" class="node-desc"><?php echo esc_html( $d['node3_desc'] ); ?></text>
		      </g>
		      <g class="sys-node" data-node="4" transform="translate(150,430)">
		        <circle class="node-halo" r="46"/>
		        <circle r="42" fill="var(--ink)" stroke="var(--accent)" stroke-width="1.5"/>
		        <text text-anchor="middle" y="-4" class="node-label" fill="var(--paper)"><?php echo esc_html( $d['node4_label'] ); ?></text>
		        <text text-anchor="middle" y="16" class="node-desc"><?php echo esc_html( $d['node4_desc'] ); ?></text>
		      </g>

		      <circle id="pulseDot" class="pulse-dot" r="5" fill="var(--accent)" filter="url(#neonGlow)"/>
		      <circle id="pulseDot2" class="pulse-dot trail" r="3.4" fill="var(--accent-glow)"/>
		      <circle id="pulseDot3" class="pulse-dot trail" r="2.2" fill="var(--paper)"/>
		      <text x="450" y="278" text-anchor="middle" class="node-desc" fill="var(--stone)" font-size="11" letter-spacing="1.5"><?php echo esc_html( $d['loop_caption'] ); ?></text>
		    </svg>
		  </div>
		</div>
		<?php
	}
}

add_action( 'widgets_init', function () { register_widget( 'SVRGN_System_Widget' ); } );
