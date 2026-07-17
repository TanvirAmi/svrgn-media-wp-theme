<?php
/**
 * SVRGN Media Fit Widget
 * Displays who we work with criteria
 */

class SVRGN_Fit_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'svrgn_fit_widget',
            __( 'SVRGN Fit Section', 'svrgn-media' )
        );
    }

    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        
        $eyebrow = ! empty( $instance['eyebrow'] ) ? $instance['eyebrow'] : 'Who We Work With';
        $heading = ! empty( $instance['heading'] ) ? $instance['heading'] : 'Built for brands<br>ready to scale.';
        $lead = ! empty( $instance['lead'] ) ? $instance['lead'] : 'SVRGN partners with product-forward, growth-stage ecommerce brands serious about turning paid media into a predictable revenue engine.';
        ?>
        <section class="section divider-top" id="fit">
            <div class="wrap">
                <div class="head-row">
                    <div>
                        <div class="eyebrow"><?php echo esc_html( $eyebrow ); ?></div>
                        <h2><?php echo wp_kses_post( $heading ); ?></h2>
                    </div>
                    <p class="lead"><?php echo wp_kses_post( $lead ); ?></p>
                </div>

                <div class="fit-grid" data-reveal-list>
                    <?php
                    for ( $i = 1; $i <= 4; $i++ ) :
                        $fit_text = ! empty( $instance[ "fit_{$i}" ] ) ? $instance[ "fit_{$i}" ] : '';
                        if ( $fit_text ) :
                            ?>
                            <div class="fit-card">
                                <div class="fit-icon"><svg viewBox="0 0 24 24"><path d="M12 2 L20 6 V12 C20 17 16.5 20.5 12 22 C7.5 20.5 4 17 4 12 V6 Z"/><path d="M8.5 12 L11 14.5 L16 9"/></svg></div>
                                <p><?php echo wp_kses_post( $fit_text ); ?></p>
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
            <textarea class="widefat" rows="3" id="<?php echo esc_attr( $this->get_field_id( 'lead' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'lead' ) ); ?>"><?php echo esc_textarea( $lead ); ?></textarea>
        </p>
        <hr style="margin: 15px 0;">
        <p><strong><?php _e( 'Fit Criteria Cards (4 max)', 'svrgn-media' ); ?></strong></p>
        <?php
        for ( $i = 1; $i <= 4; $i++ ) :
            $fit = ! empty( $instance[ "fit_{$i}" ] ) ? $instance[ "fit_{$i}" ] : '';
            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( "fit_{$i}" ) ); ?>"><?php printf( __( 'Criteria %d:', 'svrgn-media' ), $i ); ?></label>
                <textarea class="widefat" rows="2" id="<?php echo esc_attr( $this->get_field_id( "fit_{$i}" ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( "fit_{$i}" ) ); ?>"><?php echo esc_textarea( $fit ); ?></textarea>
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
            $instance[ "fit_{$i}" ] = ! empty( $new_instance[ "fit_{$i}" ] ) ? wp_kses_post( $new_instance[ "fit_{$i}" ] ) : '';
        }
        
        return $instance;
    }
}
