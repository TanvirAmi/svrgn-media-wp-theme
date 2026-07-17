<?php
/**
 * SVRGN Media Engage Widget
 * Displays engagement models
 */

class SVRGN_Engage_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'svrgn_engage_widget',
            __( 'SVRGN Engage Section', 'svrgn-media' )
        );
    }

    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        
        $eyebrow = ! empty( $instance['eyebrow'] ) ? $instance['eyebrow'] : 'How We Work Together';
        $heading = ! empty( $instance['heading'] ) ? $instance['heading'] : 'Engagements designed<br>for growth.';
        $lead = ! empty( $instance['lead'] ) ? $instance['lead'] : 'Flexible models built for brands at different stages — from strategic direction to full-scale execution.';
        ?>
        <section class="section divider-top" id="engage">
            <div class="wrap">
                <div class="head-row">
                    <div>
                        <div class="eyebrow"><?php echo esc_html( $eyebrow ); ?></div>
                        <h2><?php echo wp_kses_post( $heading ); ?></h2>
                    </div>
                    <p class="lead"><?php echo wp_kses_post( $lead ); ?></p>
                </div>

                <div class="engage-list" data-reveal-list>
                    <?php
                    for ( $i = 1; $i <= 3; $i++ ) :
                        $engage_mark = chr( 64 + $i );
                        $engage_title = ! empty( $instance[ "engage_{$i}_title" ] ) ? $instance[ "engage_{$i}_title" ] : '';
                        $engage_desc = ! empty( $instance[ "engage_{$i}_desc" ] ) ? $instance[ "engage_{$i}_desc" ] : '';
                        if ( $engage_title ) :
                            ?>
                            <div class="engage-item">
                                <span class="engage-mark"><?php echo esc_html( $engage_mark ); ?></span>
                                <h3><?php echo wp_kses_post( $engage_title ); ?></h3>
                                <p><?php echo wp_kses_post( $engage_desc ); ?></p>
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
        <p><strong><?php _e( 'Engagement Models (3 max)', 'svrgn-media' ); ?></strong></p>
        <?php
        for ( $i = 1; $i <= 3; $i++ ) :
            $title = ! empty( $instance[ "engage_{$i}_title" ] ) ? $instance[ "engage_{$i}_title" ] : '';
            $desc = ! empty( $instance[ "engage_{$i}_desc" ] ) ? $instance[ "engage_{$i}_desc" ] : '';
            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( "engage_{$i}_title" ) ); ?>"><?php printf( __( 'Model %d Title:', 'svrgn-media' ), $i ); ?></label>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( "engage_{$i}_title" ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( "engage_{$i}_title" ) ); ?>" value="<?php echo esc_attr( $title ); ?>">
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( "engage_{$i}_desc" ) ); ?>"><?php printf( __( 'Model %d Description:', 'svrgn-media' ), $i ); ?></label>
                <textarea class="widefat" rows="2" id="<?php echo esc_attr( $this->get_field_id( "engage_{$i}_desc" ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( "engage_{$i}_desc" ) ); ?>"><?php echo esc_textarea( $desc ); ?></textarea>
            </p>
        <?php endfor; ?>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = [];
        $instance['eyebrow'] = ! empty( $new_instance['eyebrow'] ) ? sanitize_text_field( $new_instance['eyebrow'] ) : '';
        $instance['heading'] = ! empty( $new_instance['heading'] ) ? wp_kses_post( $new_instance['heading'] ) : '';
        $instance['lead'] = ! empty( $new_instance['lead'] ) ? wp_kses_post( $new_instance['lead'] ) : '';
        
        for ( $i = 1; $i <= 3; $i++ ) {
            $instance[ "engage_{$i}_title" ] = ! empty( $new_instance[ "engage_{$i}_title" ] ) ? wp_kses_post( $new_instance[ "engage_{$i}_title" ] ) : '';
            $instance[ "engage_{$i}_desc" ] = ! empty( $new_instance[ "engage_{$i}_desc" ] ) ? wp_kses_post( $new_instance[ "engage_{$i}_desc" ] ) : '';
        }
        
        return $instance;
    }
}
