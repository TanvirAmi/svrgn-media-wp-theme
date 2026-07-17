<?php
/**
 * SVRGN Media Contact Form Widget
 * Displays contact form and location info
 */

class SVRGN_Contact_Form_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'svrgn_contact_form_widget',
            __( 'SVRGN Contact Form', 'svrgn-media' )
        );
    }

    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        
        $email = ! empty( $instance['email'] ) ? $instance['email'] : 'andyg@svrgnmedia.com';
        $location = ! empty( $instance['location'] ) ? $instance['location'] : 'Costa Mesa, California';
        $hours = ! empty( $instance['hours'] ) ? $instance['hours'] : 'Mon–Fri, 9AM–6PM PT';
        ?>
        <section class="contact-section">
            <div class="wrap">
                <div class="contact-grid">
                    <div>
                        <form class="contact-form" id="contactForm" method="POST" action="#">
                            <div class="field-row">
                                <div class="field">
                                    <label for="fullName"><?php _e( 'Full Name', 'svrgn-media' ); ?></label>
                                    <div class="field-input-wrap">
                                        <input type="text" id="fullName" name="fullName" required>
                                        <span class="field-underline"></span>
                                    </div>
                                </div>
                                <div class="field">
                                    <label for="email"><?php _e( 'Email', 'svrgn-media' ); ?></label>
                                    <div class="field-input-wrap">
                                        <input type="email" id="email" name="email" required>
                                        <span class="field-underline"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="field-row">
                                <div class="field">
                                    <label for="brand"><?php _e( 'Brand / Company', 'svrgn-media' ); ?></label>
                                    <div class="field-input-wrap">
                                        <input type="text" id="brand" name="brand" required>
                                        <span class="field-underline"></span>
                                    </div>
                                </div>
                                <div class="field">
                                    <label for="website"><?php _e( 'Website', 'svrgn-media' ); ?></label>
                                    <div class="field-input-wrap">
                                        <input type="url" id="website" name="website" placeholder="https://">
                                        <span class="field-underline"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="field">
                                <label for="spend"><?php _e( 'Monthly Ad Spend', 'svrgn-media' ); ?></label>
                                <div class="field-input-wrap">
                                    <select id="spend" name="spend" required>
                                        <option value="" disabled selected><?php _e( 'Select a range', 'svrgn-media' ); ?></option>
                                        <option><?php _e( 'Under $10k / mo', 'svrgn-media' ); ?></option>
                                        <option><?php _e( '$10k – $50k / mo', 'svrgn-media' ); ?></option>
                                        <option><?php _e( '$50k – $150k / mo', 'svrgn-media' ); ?></option>
                                        <option><?php _e( '$150k+ / mo', 'svrgn-media' ); ?></option>
                                    </select>
                                    <span class="field-underline"></span>
                                </div>
                            </div>

                            <div class="field">
                                <label for="message"><?php _e( 'Tell Us About Your Brand', 'svrgn-media' ); ?></label>
                                <div class="field-input-wrap">
                                    <textarea id="message" name="message" placeholder="What's working, what isn't, and what you're hoping to fix." required></textarea>
                                    <span class="field-underline"></span>
                                </div>
                                <p class="field-note"><?php _e( 'The more specific, the more useful our first call will be.', 'svrgn-media' ); ?></p>
                            </div>

                            <button type="submit" class="btn btn-solid">
                                <?php _e( 'Send Message', 'svrgn-media' ); ?>
                                <svg viewBox="0 0 24 24" fill="none"><path d="M6 18L18 6M18 6H9M18 6V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </button>
                        </form>

                        <div class="form-success" id="formSuccess">
                            <div class="check"><svg viewBox="0 0 24 24" fill="none"><path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
                            <h3><?php _e( 'Message Received', 'svrgn-media' ); ?></h3>
                            <p><?php _e( 'We read every submission personally. Expect to hear back within 24 hours.', 'svrgn-media' ); ?></p>
                        </div>
                    </div>

                    <div class="location-panel">
                        <div class="beacon-stage">
                            <svg viewBox="0 0 500 400" id="beaconSvg">
                                <defs>
                                    <pattern id="beaconGrid" width="26" height="26" patternUnits="userSpaceOnUse">
                                        <circle cx="1" cy="1" r="1" fill="var(--line-strong)"/>
                                    </pattern>
                                </defs>
                                <rect x="0" y="0" width="500" height="400" fill="url(#beaconGrid)" opacity=".6"/>
                                <line class="beacon-tick" x1="250" y1="0" x2="250" y2="400" stroke-dasharray="2 6" opacity=".4"/>
                                <line class="beacon-tick" x1="0" y1="200" x2="500" y2="200" stroke-dasharray="2 6" opacity=".4"/>
                                <circle class="beacon-ring" cx="250" cy="200" r="30"/>
                                <circle class="beacon-ring" cx="250" cy="200" r="30"/>
                                <circle class="beacon-ring" cx="250" cy="200" r="30"/>
                                <circle cx="250" cy="200" r="7" fill="var(--accent)"/>
                                <circle cx="250" cy="200" r="14" fill="none" stroke="var(--accent)" stroke-width="1" opacity=".5"/>
                                <text x="250" y="248" text-anchor="middle" class="beacon-label" font-size="11" letter-spacing="2">COSTA MESA, CA</text>
                                <text x="20" y="24" class="beacon-label" font-size="10">33.6846° N</text>
                                <text x="20" y="382" class="beacon-label" font-size="10">117.9265° W</text>
                            </svg>
                        </div>

                        <div class="info-card">
                            <div class="info-row"><span><?php _e( 'Email', 'svrgn-media' ); ?></span><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></div>
                            <div class="info-row"><span><?php _e( 'Location', 'svrgn-media' ); ?></span><span><?php echo esc_html( $location ); ?></span></div>
                            <div class="info-row"><span><?php _e( 'Hours', 'svrgn-media' ); ?></span><span><?php echo esc_html( $hours ); ?></span></div>
                            <div class="info-row">
                                <span><?php _e( 'Directions', 'svrgn-media' ); ?></span>
                                <a class="info-directions" href="https://www.google.com/maps/search/?api=1&query=Costa+Mesa%2C+CA" target="_blank" rel="noopener">
                                    <?php _e( 'Open in Maps', 'svrgn-media' ); ?>
                                    <svg viewBox="0 0 24 24" fill="none"><path d="M6 18L18 6M18 6H9M18 6V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
        
        echo $args['after_widget'];
    }

    public function form( $instance ) {
        $email = ! empty( $instance['email'] ) ? $instance['email'] : '';
        $location = ! empty( $instance['location'] ) ? $instance['location'] : '';
        $hours = ! empty( $instance['hours'] ) ? $instance['hours'] : '';
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>"><?php _e( 'Contact Email:', 'svrgn-media' ); ?></label>
            <input type="email" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'email' ) ); ?>" value="<?php echo esc_attr( $email ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'location' ) ); ?>"><?php _e( 'Office Location:', 'svrgn-media' ); ?></label>
            <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'location' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'location' ) ); ?>" value="<?php echo esc_attr( $location ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'hours' ) ); ?>"><?php _e( 'Business Hours:', 'svrgn-media' ); ?></label>
            <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'hours' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'hours' ) ); ?>" value="<?php echo esc_attr( $hours ); ?>">
        </p>
        <p style="background: #f1f1f1; padding: 10px; border-radius: 3px; font-size: 12px;">
            <strong>Note:</strong> Form submissions require backend integration (e.g., Formspree, Netlify, or custom endpoint). Configure in theme settings.
        </p>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = [];
        $instance['email'] = ! empty( $new_instance['email'] ) ? sanitize_email( $new_instance['email'] ) : '';
        $instance['location'] = ! empty( $new_instance['location'] ) ? sanitize_text_field( $new_instance['location'] ) : '';
        $instance['hours'] = ! empty( $new_instance['hours'] ) ? sanitize_text_field( $new_instance['hours'] ) : '';
        
        return $instance;
    }
}
