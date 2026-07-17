<?php
/**
 * SVRGN Media Values Widget
 * Displays company values/how we operate
 */

class SVRGN_Values_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'svrgn_values_widget',
            __( 'SVRGN Values Section', 'svrgn-media' )
        );
    }

    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        
        $eyebrow = ! empty( $instance['eyebrow'] ) ? $instance['eyebrow'] : 'How We Operate';
        $heading = ! empty( $instance['heading'] ) ? $instance['heading'] : 'Built different,<br>by design.';
        $lead = ! empty( $instance['lead'] ) ? $instance['lead'] : 'A few things that don\'t change no matter how big the account gets.';
        ?>
        <section class="about-values">
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

                <div class="values-list" data-reveal-list>
                    <?php
                    for ( $i = 1; $i <= 5; $i++ ) :
                        $value_title = ! empty( $instance[ "value_{$i}_title" ] ) ? $instance[ "value_{$i}_title" ] : '';
                        $value_desc = ! empty( $instance[ "value_{$i}_desc" ] ) ? $instance[ "value_{$i}_desc" ] : '';
                        if ( $value_title ) :
                            $mark = chr( 64 + $i );
                            ?>
                            <div class="value-item">
                                <span class="value-mark"><?php echo esc_html( $mark ); ?></span>
                                <h3><?php echo wp_kses_post( $value_title ); ?></h3>
                                <p><?php echo wp_kses_post( $value_desc ); ?></p>
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
        <p><strong><?php _e( 'Values (5 max)', 'svrgn-media' ); ?></strong></p>
        <?php
        for ( $i = 1; $i <= 5; $i++ ) :
            $title = ! empty( $instance[ "value_{$i}_title" ] ) ? $instance[ "value_{$i}_title" ] : '';
            $desc = ! empty( $instance[ "value_{$i}_desc" ] ) ? $instance[ "value_{$i}_desc" ] : '';
            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( "value_{$i}_title" ) ); ?>"><?php printf( __( 'Value %d Title:', 'svrgn-media' ), $i ); ?></label>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( "value_{$i}_title" ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( "value_{$i}_title" ) ); ?>" value="<?php echo esc_attr( $title ); ?>">
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( "value_{$i}_desc" ) ); ?>"><?php printf( __( 'Value %d Description:', 'svrgn-media' ), $i ); ?></label>
                <textarea class="widefat" rows="2" id="<?php echo esc_attr( $this->get_field_id( "value_{$i}_desc" ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( "value_{$i}_desc" ) ); ?>"><?php echo esc_textarea( $desc ); ?></textarea>
            </p>
        <?php endfor; ?>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = [];
        $instance['eyebrow'] = ! empty( $new_instance['eyebrow'] ) ? sanitize_text_field( $new_instance['eyebrow'] ) : '';
        $instance['heading'] = ! empty( $new_instance['heading'] ) ? wp_kses_post( $new_instance['heading'] ) : '';
        $instance['lead'] = ! empty( $new_instance['lead'] ) ? wp_kses_post( $new_instance['lead'] ) : '';
        
        for ( $i = 1; $i <= 5; $i++ ) {
            $instance[ "value_{$i}_title" ] = ! empty( $new_instance[ "value_{$i}_title" ] ) ? sanitize_text_field( $new_instance[ "value_{$i}_title" ] ) : '';
            $instance[ "value_{$i}_desc" ] = ! empty( $new_instance[ "value_{$i}_desc" ] ) ? wp_kses_post( $new_instance[ "value_{$i}_desc" ] ) : '';
        }
        
        return $instance;
    }
}
