<?php
/**
 * SVRGN Media Team Widget
 * Displays team members from custom post type
 */

class SVRGN_Team_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'svrgn_team_widget',
            __( 'SVRGN Team Section', 'svrgn-media' )
        );
    }

    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        
        $eyebrow = ! empty( $instance['eyebrow'] ) ? $instance['eyebrow'] : 'The Team';
        $heading = ! empty( $instance['heading'] ) ? $instance['heading'] : 'Three people.<br>One system.';
        $lead = ! empty( $instance['lead'] ) ? $instance['lead'] : 'No account managers, no hand-offs. You work directly with the people doing the work.';
        ?>
        <section class="about-team">
            <div class="wrap">
                <div class="split-head">
                    <div class="split-head-row">
                        <div>
                            <div class="eyebrow"><?php echo esc_html( $eyebrow ); ?></div>
                            <h2><?php echo wp_kses_post( $heading ); ?></h2>
                        </div>
                        <p class="lead"><?php echo wp_kses_post( $lead ); ?></p>
                    </div>
                </div>

                <div class="team-grid" data-reveal-list>
                    <?php
                    $team_posts = get_posts( [
                        'post_type' => 'team_member',
                        'posts_per_page' => -1,
                        'orderby' => 'menu_order',
                        'order' => 'ASC',
                    ] );

                    foreach ( $team_posts as $index => $post ) :
                        setup_postdata( $post );
                        $role = get_post_meta( $post->ID, '_team_role', true );
                        $bio = get_post_meta( $post->ID, '_team_bio', true );
                        ?>
                        <a class="team-card" href="<?php the_permalink(); ?>">
                            <?php if ( has_post_thumbnail( $post ) ) :
                                echo get_the_post_thumbnail( $post, 'large', [ 'class' => 'team-img' ] );
                            endif; ?>
                            <div class="team-tint"></div>
                            <div class="team-scrim"></div>
                            <div class="team-content">
                                <div class="team-top">
                                    <span class="team-index"><?php printf( '%02d', $index + 1 ); ?></span>
                                    <span class="team-role"><?php echo esc_html( $role ); ?></span>
                                </div>
                                <div>
                                    <div class="team-name"><?php the_title(); ?></div>
                                    <p class="team-bio"><?php echo esc_html( $bio ); ?></p>
                                    <div class="team-social">
                                        <span aria-label="LinkedIn"><svg viewBox="0 0 24 24" fill="none"><path d="M4 4h16v16H4z" stroke="none"/><path d="M6.5 9.5v8M6.5 6.5v.01M11 17.5v-5c0-1.4 1-2.5 2.5-2.5S16 11 16 12.5v5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                                        <span aria-label="Email"><svg viewBox="0 0 24 24" fill="none"><path d="M4 6h16v12H4z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><path d="M4 7l8 6 8-6" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg></span>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <?php
                    endforeach;
                    wp_reset_postdata();
                    ?>
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
            <textarea class="widefat" rows="2" id="<?php echo esc_attr( $this->get_field_id( 'lead' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'lead' ) ); ?>"><?php echo esc_textarea( $lead ); ?></textarea>
        </p>
        <p style="background: #f1f1f1; padding: 10px; border-radius: 3px; font-size: 12px;">
            <strong>Note:</strong> Team members are pulled from Team Member custom posts. Add custom fields:<br>
            <code>_team_role</code> (job title)<br>
            <code>_team_bio</code> (short bio)
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
