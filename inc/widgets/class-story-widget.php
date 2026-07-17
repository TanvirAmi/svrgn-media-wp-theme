<?php
/**
 * SVRGN Media Story Widget
 * Displays about page story and philosophy
 */

class SVRGN_Story_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'svrgn_story_widget',
            __( 'SVRGN Story Section', 'svrgn-media' )
        );
    }

    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        
        $eyebrow = ! empty( $instance['eyebrow'] ) ? $instance['eyebrow'] : 'How We Think';
        $heading = ! empty( $instance['heading'] ) ? $instance['heading'] : 'Small on purpose.';
        $lead = ! empty( $instance['lead'] ) ? $instance['lead'] : 'SVRGN stays intentionally small. Every account gets senior attention, not a rotating cast of coordinators.';
        $body_1 = ! empty( $instance['body_1'] ) ? $instance['body_1'] : '';
        $body_2 = ! empty( $instance['body_2'] ) ? $instance['body_2'] : '';
        $quote = ! empty( $instance['quote'] ) ? $instance['quote'] : 'Creative without strategy doesn\'t scale. <span>Strategy without creative doesn\'t convert.</span>';
        ?>
        <section class="about-story">
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
                <div class="story-grid">
                    <div class="story-body">
                        <?php if ( $body_1 ) : ?><p><?php echo wp_kses_post( $body_1 ); ?></p><?php endif; ?>
                        <?php if ( $body_2 ) : ?><p><?php echo wp_kses_post( $body_2 ); ?></p><?php endif; ?>
                    </div>
                    <div class="story-quote" data-reveal><?php echo wp_kses_post( $quote ); ?></div>
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
        $body_1 = ! empty( $instance['body_1'] ) ? $instance['body_1'] : '';
        $body_2 = ! empty( $instance['body_2'] ) ? $instance['body_2'] : '';
        $quote = ! empty( $instance['quote'] ) ? $instance['quote'] : '';
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
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'body_1' ) ); ?>"><?php _e( 'Body Paragraph 1:', 'svrgn-media' ); ?></label>
            <textarea class="widefat" rows="3" id="<?php echo esc_attr( $this->get_field_id( 'body_1' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'body_1' ) ); ?>"><?php echo esc_textarea( $body_1 ); ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'body_2' ) ); ?>"><?php _e( 'Body Paragraph 2:', 'svrgn-media' ); ?></label>
            <textarea class="widefat" rows="3" id="<?php echo esc_attr( $this->get_field_id( 'body_2' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'body_2' ) ); ?>"><?php echo esc_textarea( $body_2 ); ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'quote' ) ); ?>"><?php _e( 'Quote (HTML allowed for <span>):', 'svrgn-media' ); ?></label>
            <textarea class="widefat" rows="2" id="<?php echo esc_attr( $this->get_field_id( 'quote' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'quote' ) ); ?>"><?php echo esc_textarea( $quote ); ?></textarea>
        </p>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = [];
        $instance['eyebrow'] = ! empty( $new_instance['eyebrow'] ) ? sanitize_text_field( $new_instance['eyebrow'] ) : '';
        $instance['heading'] = ! empty( $new_instance['heading'] ) ? sanitize_text_field( $new_instance['heading'] ) : '';
        $instance['lead'] = ! empty( $new_instance['lead'] ) ? wp_kses_post( $new_instance['lead'] ) : '';
        $instance['body_1'] = ! empty( $new_instance['body_1'] ) ? wp_kses_post( $new_instance['body_1'] ) : '';
        $instance['body_2'] = ! empty( $new_instance['body_2'] ) ? wp_kses_post( $new_instance['body_2'] ) : '';
        $instance['quote'] = ! empty( $new_instance['quote'] ) ? wp_kses_post( $new_instance['quote'] ) : '';
        
        return $instance;
    }
}
