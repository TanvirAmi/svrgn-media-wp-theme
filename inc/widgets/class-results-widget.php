<?php
/**
 * SVRGN Media Results Widget
 * Displays stats cards and case study grid
 */

class SVRGN_Results_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'svrgn_results_widget',
            __( 'SVRGN Results Section', 'svrgn-media' )
        );
    }

    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        
        $eyebrow = ! empty( $instance['eyebrow'] ) ? $instance['eyebrow'] : 'Results & Impact';
        $heading = ! empty( $instance['heading'] ) ? $instance['heading'] : 'Proof, not promises.';
        $lead = ! empty( $instance['lead'] ) ? $instance['lead'] : 'Our work is measured by outcomes, not activity — systems that hold up as spend increases.';
        ?>
        <section class="section light-section divider-top" id="results">
            <div class="wrap">
                <div class="head-row">
                    <div>
                        <div class="eyebrow"><?php echo esc_html( $eyebrow ); ?></div>
                        <h2><?php echo wp_kses_post( $heading ); ?></h2>
                    </div>
                    <p class="lead"><?php echo wp_kses_post( $lead ); ?></p>
                </div>
            </div>

            <div class="wrap">
                <div class="stat-row" data-reveal-list>
                    <?php
                    for ( $i = 1; $i <= 3; $i++ ) :
                        $stat_num = ! empty( $instance[ "stat_{$i}_num" ] ) ? $instance[ "stat_{$i}_num" ] : '';
                        $stat_desc = ! empty( $instance[ "stat_{$i}_desc" ] ) ? $instance[ "stat_{$i}_desc" ] : '';
                        if ( $stat_num ) :
                            ?>
                            <div class="stat-card"><div class="num"><span><?php echo esc_html( $stat_num ); ?></span></div><p><?php echo wp_kses_post( $stat_desc ); ?></p></div>
                            <?php
                        endif;
                    endfor;
                    ?>
                </div>

                <div class="case-grid" data-reveal-list>
                    <?php
                    $case_posts = get_posts( [
                        'post_type' => 'case_study',
                        'posts_per_page' => 4,
                        'orderby' => 'menu_order',
                        'order' => 'ASC',
                    ] );

                    foreach ( $case_posts as $index => $post ) :
                        setup_postdata( $post );
                        $case_tag = get_post_meta( $post->ID, '_case_tag', true );
                        $case_result = get_post_meta( $post->ID, '_case_result', true );
                        ?>
                        <div class="case-card" data-tilt>
                            <div class="case-art">
                                <div class="case-parallax">
                                    <?php if ( has_post_thumbnail( $post ) ) :
                                        echo get_the_post_thumbnail( $post, 'large', [ 'class' => 'case-img' ] );
                                    endif; ?>
                                </div>
                                <div class="case-tint"></div>
                            </div>
                            <div class="case-content">
                                <span class="case-tag"><?php echo esc_html( $case_tag ); ?></span>
                                <div>
                                    <div class="case-title"><?php the_title(); ?></div>
                                    <div class="case-result"><?php echo esc_html( $case_result ); ?></div>
                                </div>
                            </div>
                        </div>
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
            <label for="<?php echo esc_attr( $this->get_field_id( 'heading' ) ); ?>"><?php _e( 'Section Heading:', 'svrgn-media' ); ?></label>
            <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'heading' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'heading' ) ); ?>" value="<?php echo esc_attr( $heading ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'lead' ) ); ?>"><?php _e( 'Lead Text:', 'svrgn-media' ); ?></label>
            <textarea class="widefat" rows="2" id="<?php echo esc_attr( $this->get_field_id( 'lead' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'lead' ) ); ?>"><?php echo esc_textarea( $lead ); ?></textarea>
        </p>
        <hr style="margin: 15px 0;">
        <p><strong><?php _e( 'Result Stats', 'svrgn-media' ); ?></strong></p>
        <?php
        for ( $i = 1; $i <= 3; $i++ ) :
            $num = ! empty( $instance[ "stat_{$i}_num" ] ) ? $instance[ "stat_{$i}_num" ] : '';
            $desc = ! empty( $instance[ "stat_{$i}_desc" ] ) ? $instance[ "stat_{$i}_desc" ] : '';
            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( "stat_{$i}_num" ) ); ?>"><?php printf( __( 'Stat %d Number:', 'svrgn-media' ), $i ); ?></label>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( "stat_{$i}_num" ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( "stat_{$i}_num" ) ); ?>" value="<?php echo esc_attr( $num ); ?>">
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( "stat_{$i}_desc" ) ); ?>"><?php printf( __( 'Stat %d Description:', 'svrgn-media' ), $i ); ?></label>
                <textarea class="widefat" rows="2" id="<?php echo esc_attr( $this->get_field_id( "stat_{$i}_desc" ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( "stat_{$i}_desc" ) ); ?>"><?php echo esc_textarea( $desc ); ?></textarea>
            </p>
        <?php endfor; ?>
        <p style="background: #f1f1f1; padding: 10px; border-radius: 3px; font-size: 12px;">
            <strong>Note:</strong> Case study cards are pulled automatically from Case Study posts. Add custom fields:<br>
            <code>_case_tag</code> (category/tag)<br>
            <code>_case_result</code> (result text)
        </p>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = [];
        $instance['eyebrow'] = ! empty( $new_instance['eyebrow'] ) ? sanitize_text_field( $new_instance['eyebrow'] ) : '';
        $instance['heading'] = ! empty( $new_instance['heading'] ) ? sanitize_text_field( $new_instance['heading'] ) : '';
        $instance['lead'] = ! empty( $new_instance['lead'] ) ? wp_kses_post( $new_instance['lead'] ) : '';
        
        for ( $i = 1; $i <= 3; $i++ ) {
            $instance[ "stat_{$i}_num" ] = ! empty( $new_instance[ "stat_{$i}_num" ] ) ? sanitize_text_field( $new_instance[ "stat_{$i}_num" ] ) : '';
            $instance[ "stat_{$i}_desc" ] = ! empty( $new_instance[ "stat_{$i}_desc" ] ) ? wp_kses_post( $new_instance[ "stat_{$i}_desc" ] ) : '';
        }
        
        return $instance;
    }
}
