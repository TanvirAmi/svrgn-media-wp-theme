<?php
/**
 * SVRGN Media System Widget
 * Displays system diagram and explanation
 */

class SVRGN_System_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'svrgn_system_widget',
            __( 'SVRGN System Section', 'svrgn-media' )
        );
    }

    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        
        $eyebrow = ! empty( $instance['eyebrow'] ) ? $instance['eyebrow'] : 'How We\'re Built';
        $heading = ! empty( $instance['heading'] ) ? $instance['heading'] : 'One system.<br>Not four vendors.';
        $lead = ! empty( $instance['lead'] ) ? $instance['lead'] : 'Strategy, creative, media, and data don\'t operate in silos here. They\'re one connected loop — each stage feeding the next, so performance compounds instead of stalling.';
        ?>
        <section class="section divider-top" id="system">
            <div class="wrap">
                <div class="head-row">
                    <div>
                        <div class="eyebrow"><?php echo esc_html( $eyebrow ); ?></div>
                        <h2><?php echo wp_kses_post( $heading ); ?></h2>
                    </div>
                    <p class="lead"><?php echo wp_kses_post( $lead ); ?></p>
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

                            <!-- connector paths (rectangular loop) -->
                            <path class="sys-path" data-path="1" d="M 150 110 L 750 110" fill="none" stroke="var(--line-strong)" stroke-width="1.5"/>
                            <path class="sys-path" data-path="2" d="M 750 110 L 750 430" fill="none" stroke="var(--line-strong)" stroke-width="1.5"/>
                            <path class="sys-path" data-path="3" d="M 750 430 L 150 430" fill="none" stroke="var(--line-strong)" stroke-width="1.5"/>
                            <path class="sys-path" data-path="4" d="M 150 430 L 150 110" fill="none" stroke="var(--line-strong)" stroke-width="1.5"/>
                            <path id="pulsePath" d="M 150 110 L 750 110 L 750 430 L 150 430 L 150 110" fill="none" stroke="none"/>

                            <!-- flow direction chevrons -->
                            <path class="sys-chevron" d="M 444 104 L 456 110 L 444 116" />
                            <path class="sys-chevron" d="M 744 264 L 750 276 L 756 264" />
                            <path class="sys-chevron" d="M 456 436 L 444 430 L 456 424" />
                            <path class="sys-chevron" d="M 156 276 L 150 264 L 144 276" />

                            <!-- nodes -->
                            <g class="sys-node" data-node="1" transform="translate(150,110)">
                                <circle class="node-halo" r="46"/>
                                <circle r="42" fill="var(--ink)" stroke="var(--accent)" stroke-width="1.5"/>
                                <text text-anchor="middle" y="-4" class="node-label" fill="var(--paper)">STRATEGY</text>
                                <text text-anchor="middle" y="16" class="node-desc">Diagnosis &amp; roadmap</text>
                            </g>
                            <g class="sys-node" data-node="2" transform="translate(750,110)">
                                <circle class="node-halo" r="46"/>
                                <circle r="42" fill="var(--ink)" stroke="var(--accent)" stroke-width="1.5"/>
                                <text text-anchor="middle" y="-4" class="node-label" fill="var(--paper)">CREATIVE</text>
                                <text text-anchor="middle" y="16" class="node-desc">Concept &amp; production</text>
                            </g>
                            <g class="sys-node" data-node="3" transform="translate(750,430)">
                                <circle class="node-halo" r="46"/>
                                <circle r="42" fill="var(--ink)" stroke="var(--accent)" stroke-width="1.5"/>
                                <text text-anchor="middle" y="-4" class="node-label" fill="var(--paper)">MEDIA</text>
                                <text text-anchor="middle" y="16" class="node-desc">Meta · Google · YouTube</text>
                            </g>
                            <g class="sys-node" data-node="4" transform="translate(150,430)">
                                <circle class="node-halo" r="46"/>
                                <circle r="42" fill="var(--ink)" stroke="var(--accent)" stroke-width="1.5"/>
                                <text text-anchor="middle" y="-4" class="node-label" fill="var(--paper)">DATA</text>
                                <text text-anchor="middle" y="16" class="node-desc">Signal &amp; iteration</text>
                            </g>

                            <circle id="pulseDot" class="pulse-dot" r="5" fill="var(--accent)" filter="url(#neonGlow)"/>
                            <circle id="pulseDot2" class="pulse-dot trail" r="3.4" fill="var(--accent-glow)"/>
                            <circle id="pulseDot3" class="pulse-dot trail" r="2.2" fill="var(--paper)"/>
                            <text x="450" y="278" text-anchor="middle" class="node-desc" fill="var(--stone)" font-size="11" letter-spacing="1.5">THE LOOP COMPOUNDS</text>
                        </svg>
                    </div>
                </div>
            </div>
        </section>
        <?php
        
        echo $args['after_widget'];
    }

    public function form( $instance ) {
        $eyebrow = ! empty( $instance['eyebrow'] ) ? $instance['eyebrow'] : '';
        $heading = ! empty( $instance['heading'] ) ? $instance['heading'] : '';
        $lead = ! empty( $instance['lead'] ) ? $instance['lead'] : '';
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'eyebrow' ) ); ?>"><?php _e( 'Section Eyebrow:', 'svrgn-media' ); ?></label>
            <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'eyebrow' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'eyebrow' ) ); ?>" value="<?php echo esc_attr( $eyebrow ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'heading' ) ); ?>"><?php _e( 'Section Heading (HTML allowed):', 'svrgn-media' ); ?></label>
            <textarea class="widefat" rows="2" id="<?php echo esc_attr( $this->get_field_id( 'heading' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'heading' ) ); ?>"><?php echo esc_textarea( $heading ); ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'lead' ) ); ?>"><?php _e( 'Lead Text:', 'svrgn-media' ); ?></label>
            <textarea class="widefat" rows="3" id="<?php echo esc_attr( $this->get_field_id( 'lead' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'lead' ) ); ?>"><?php echo esc_textarea( $lead ); ?></textarea>
        </p>
        <p style="background: #f1f1f1; padding: 10px; border-radius: 3px; font-size: 12px;">
            <strong>Note:</strong> System diagram SVG is static. Customize via CSS in theme assets.
        </p>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = [];
        $instance['eyebrow'] = ! empty( $new_instance['eyebrow'] ) ? sanitize_text_field( $new_instance['eyebrow'] ) : '';
        $instance['heading'] = ! empty( $new_instance['heading'] ) ? wp_kses_post( $new_instance['heading'] ) : '';
        $instance['lead'] = ! empty( $new_instance['lead'] ) ? wp_kses_post( $new_instance['lead'] ) : '';
        
        return $instance;
    }
}
