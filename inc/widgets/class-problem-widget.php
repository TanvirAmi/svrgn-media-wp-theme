<?php
/**
 * SVRGN Media Problem Widget
 * Displays why growth stalls section with problem list and quote
 */

class SVRGN_Problem_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'svrgn_problem_widget',
            __( 'SVRGN Problem Section', 'svrgn-media' )
        );
    }

    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        
        $eyebrow = ! empty( $instance['eyebrow'] ) ? $instance['eyebrow'] : 'Why Growth Stalls';
        $heading = ! empty( $instance['heading'] ) ? $instance['heading'] : 'Most brands don\'t<br>have a traffic problem.';
        $lead = ! empty( $instance['lead'] ) ? $instance['lead'] : 'They have a system problem. As spend increases, the cracks show up fast — and they compound.';
        $quote = ! empty( $instance['quote'] ) ? $instance['quote'] : 'Scaling requires <span>a system</span> — not more ads.';
        ?>
        <section class="section divider-top" id="problem">
            <div class="wrap">
                <div class="head-row">
                    <div>
                        <div class="eyebrow"><?php echo esc_html( $eyebrow ); ?></div>
                        <h2><?php echo wp_kses_post( $heading ); ?></h2>
                    </div>
                    <p class="lead"><?php echo wp_kses_post( $lead ); ?></p>
                </div>

                <div class="problem-grid">
                    <ul class="problem-list" data-reveal-list>
                        <?php
                        for ( $i = 1; $i <= 4; $i++ ) :
                            $problem_text = ! empty( $instance[ "problem_{$i}" ] ) ? $instance[ "problem_{$i}" ] : '';
                            if ( $problem_text ) :
                                ?>
                                <li><b><?php printf( '%02d', $i ); ?></b><p><?php echo wp_kses_post( $problem_text ); ?></p></li>
                                <?php
                            endif;
                        endfor;
                        ?>
                    </ul>
                    <div class="problem-quote" data-clip-reveal><?php echo wp_kses_post( $quote ); ?></div>
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
        $quote = ! empty( $instance['quote'] ) ? $instance['quote'] : '';
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
        <p><strong><?php _e( 'Problem List Items', 'svrgn-media' ); ?></strong></p>
        <?php
        for ( $i = 1; $i <= 4; $i++ ) :
            $problem = ! empty( $instance[ "problem_{$i}" ] ) ? $instance[ "problem_{$i}" ] : '';
            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( "problem_{$i}" ) ); ?>"><?php printf( __( 'Problem %d:', 'svrgn-media' ), $i ); ?></label>
                <textarea class="widefat" rows="2" id="<?php echo esc_attr( $this->get_field_id( "problem_{$i}" ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( "problem_{$i}" ) ); ?>"><?php echo esc_textarea( $problem ); ?></textarea>
            </p>
        <?php endfor; ?>
        <hr style="margin: 15px 0;">
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'quote' ) ); ?>"><?php _e( 'Quote (HTML allowed for <span>):', 'svrgn-media' ); ?></label>
            <textarea class="widefat" rows="2" id="<?php echo esc_attr( $this->get_field_id( 'quote' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'quote' ) ); ?>"><?php echo esc_textarea( $quote ); ?></textarea>
        </p>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = [];
        $instance['eyebrow'] = ! empty( $new_instance['eyebrow'] ) ? sanitize_text_field( $new_instance['eyebrow'] ) : '';
        $instance['heading'] = ! empty( $new_instance['heading'] ) ? wp_kses_post( $new_instance['heading'] ) : '';
        $instance['lead'] = ! empty( $new_instance['lead'] ) ? wp_kses_post( $new_instance['lead'] ) : '';
        $instance['quote'] = ! empty( $new_instance['quote'] ) ? wp_kses_post( $new_instance['quote'] ) : '';
        
        for ( $i = 1; $i <= 4; $i++ ) {
            $instance[ "problem_{$i}" ] = ! empty( $new_instance[ "problem_{$i}" ] ) ? wp_kses_post( $new_instance[ "problem_{$i}" ] ) : '';
        }
        
        return $instance;
    }
}
