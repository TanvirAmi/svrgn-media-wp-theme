<?php
/**
 * SVRGN Media Pillars Widget
 * Displays 4 service pillars
 */

class SVRGN_Pillars_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'svrgn_pillars_widget',
            __( 'SVRGN Pillars Section', 'svrgn-media' )
        );
    }

    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        
        $eyebrow = ! empty( $instance['eyebrow'] ) ? $instance['eyebrow'] : 'What We Do';
        $heading = ! empty( $instance['heading'] ) ? $instance['heading'] : 'Everything a growth<br>system needs.';
        $lead = ! empty( $instance['lead'] ) ? $instance['lead'] : 'Under one roof, led by the same team — not handed between departments.';
        ?>
        <section class="section divider-top" id="work">
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
                <div class="pillar-grid" data-reveal-list>
                    <?php
                    for ( $i = 1; $i <= 4; $i++ ) :
                        $pillar_title = ! empty( $instance[ "pillar_{$i}_title" ] ) ? $instance[ "pillar_{$i}_title" ] : '';
                        $pillar_desc = ! empty( $instance[ "pillar_{$i}_desc" ] ) ? $instance[ "pillar_{$i}_desc" ] : '';
                        if ( $pillar_title ) :
                            ?>
                            <div class="pillar">
                                <span class="num"><?php printf( '%02d', $i ); ?></span>
                                <h3><?php echo wp_kses_post( $pillar_title ); ?></h3>
                                <p><?php echo wp_kses_post( $pillar_desc ); ?></p>
                            </div>
                            <?php
                        endif;
                    endfor;
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
        <hr style="margin: 15px 0;">
        <p><strong><?php _e( 'Service Pillars', 'svrgn-media' ); ?></strong></p>
        <?php
        for ( $i = 1; $i <= 4; $i++ ) :
            $title = ! empty( $instance[ "pillar_{$i}_title" ] ) ? $instance[ "pillar_{$i}_title" ] : '';
            $desc = ! empty( $instance[ "pillar_{$i}_desc" ] ) ? $instance[ "pillar_{$i}_desc" ] : '';
            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( "pillar_{$i}_title" ) ); ?>"><?php printf( __( 'Pillar %d Title:', 'svrgn-media' ), $i ); ?></label>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( "pillar_{$i}_title" ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( "pillar_{$i}_title" ) ); ?>" value="<?php echo esc_attr( $title ); ?>">
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( "pillar_{$i}_desc" ) ); ?>"><?php printf( __( 'Pillar %d Description:', 'svrgn-media' ), $i ); ?></label>
                <textarea class="widefat" rows="3" id="<?php echo esc_attr( $this->get_field_id( "pillar_{$i}_desc" ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( "pillar_{$i}_desc" ) ); ?>"><?php echo esc_textarea( $desc ); ?></textarea>
            </p>
        <?php endfor; ?>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = [];
        $instance['eyebrow'] = ! empty( $new_instance['eyebrow'] ) ? sanitize_text_field( $new_instance['eyebrow'] ) : '';
        $instance['heading'] = ! empty( $new_instance['heading'] ) ? wp_kses_post( $new_instance['heading'] ) : '';
        $instance['lead'] = ! empty( $new_instance['lead'] ) ? wp_kses_post( $new_instance['lead'] ) : '';
        
        for ( $i = 1; $i <= 4; $i++ ) {
            $instance[ "pillar_{$i}_title" ] = ! empty( $new_instance[ "pillar_{$i}_title" ] ) ? wp_kses_post( $new_instance[ "pillar_{$i}_title" ] ) : '';
            $instance[ "pillar_{$i}_desc" ] = ! empty( $new_instance[ "pillar_{$i}_desc" ] ) ? wp_kses_post( $new_instance[ "pillar_{$i}_desc" ] ) : '';
        }
        
        return $instance;
    }
}
