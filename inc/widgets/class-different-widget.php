<?php
/**
 * SVRGN Media Different Widget
 * Displays what makes SVRGN different
 */

class SVRGN_Different_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'svrgn_different_widget',
            __( 'SVRGN Different Section', 'svrgn-media' )
        );
    }

    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        
        $eyebrow = ! empty( $instance['eyebrow'] ) ? $instance['eyebrow'] : 'Built Different, By Design';
        $heading = ! empty( $instance['heading'] ) ? $instance['heading'] : 'What makes SVRGN<br>different.';
        $lead = ! empty( $instance['lead'] ) ? $instance['lead'] : 'A senior-led, boutique studio. Clients work directly with strategists — not a revolving door of account managers.';
        $philosophy = ! empty( $instance['philosophy'] ) ? $instance['philosophy'] : 'We believe trust is built through consistency and follow-through. What we commit to is what we deliver — no bait-and-switch, no inflated promises. This is how performance compounds.';
        ?>
        <section class="section divider-top" id="different">
            <div class="wrap">
                <div class="head-row">
                    <div>
                        <div class="eyebrow"><?php echo esc_html( $eyebrow ); ?></div>
                        <h2><?php echo wp_kses_post( $heading ); ?></h2>
                    </div>
                    <p class="lead"><?php echo wp_kses_post( $lead ); ?></p>
                </div>

                <div class="diff-grid">
                    <p class="stone" data-reveal><?php echo wp_kses_post( $philosophy ); ?></p>
                    <ul class="diff-list" data-reveal-list>
                        <?php
                        for ( $i = 1; $i <= 5; $i++ ) :
                            $diff_item = ! empty( $instance[ "diff_{$i}" ] ) ? $instance[ "diff_{$i}" ] : '';
                            if ( $diff_item ) :
                                ?>
                                <li><b><?php printf( '%02d', $i ); ?></b><?php echo wp_kses_post( $diff_item ); ?></li>
                                <?php
                            endif;
                        endfor;
                        ?>
                    </ul>
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
        $philosophy = ! empty( $instance['philosophy'] ) ? $instance['philosophy'] : '';
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
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'philosophy' ) ); ?>"><?php _e( 'Philosophy Text:', 'svrgn-media' ); ?></label>
            <textarea class="widefat" rows="3" id="<?php echo esc_attr( $this->get_field_id( 'philosophy' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'philosophy' ) ); ?>"><?php echo esc_textarea( $philosophy ); ?></textarea>
        </p>
        <hr style="margin: 15px 0;">
        <p><strong><?php _e( 'Differentiators (5 max)', 'svrgn-media' ); ?></strong></p>
        <?php
        for ( $i = 1; $i <= 5; $i++ ) :
            $item = ! empty( $instance[ "diff_{$i}" ] ) ? $instance[ "diff_{$i}" ] : '';
            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( "diff_{$i}" ) ); ?>"><?php printf( __( 'Difference %d:', 'svrgn-media' ), $i ); ?></label>
                <textarea class="widefat" rows="2" id="<?php echo esc_attr( $this->get_field_id( "diff_{$i}" ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( "diff_{$i}" ) ); ?>"><?php echo esc_textarea( $item ); ?></textarea>
            </p>
        <?php endfor; ?>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = [];
        $instance['eyebrow'] = ! empty( $new_instance['eyebrow'] ) ? sanitize_text_field( $new_instance['eyebrow'] ) : '';
        $instance['heading'] = ! empty( $new_instance['heading'] ) ? wp_kses_post( $new_instance['heading'] ) : '';
        $instance['lead'] = ! empty( $new_instance['lead'] ) ? wp_kses_post( $new_instance['lead'] ) : '';
        $instance['philosophy'] = ! empty( $new_instance['philosophy'] ) ? wp_kses_post( $new_instance['philosophy'] ) : '';
        
        for ( $i = 1; $i <= 5; $i++ ) {
            $instance[ "diff_{$i}" ] = ! empty( $new_instance[ "diff_{$i}" ] ) ? wp_kses_post( $new_instance[ "diff_{$i}" ] ) : '';
        }
        
        return $instance;
    }
}
