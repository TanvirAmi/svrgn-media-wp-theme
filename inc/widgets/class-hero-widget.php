<?php
/**
 * SVRGN Media Hero Widget
 * Displays hero banner with background video, title, and stats
 */

class SVRGN_Hero_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'svrgn_hero_widget',
            __( 'SVRGN Hero Section', 'svrgn-media' )
        );
    }

    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        
        $video_url = ! empty( $instance['video_url'] ) ? $instance['video_url'] : 'https://cdn.sanity.io/files/8nn8fua5/production/c6fb986a862cbe643c40cbdd0318ebc495efb187.mp4';
        $eyebrow = ! empty( $instance['eyebrow'] ) ? $instance['eyebrow'] : 'Boutique Creative-Performance Studio';
        $title_line_1 = ! empty( $instance['title_line_1'] ) ? $instance['title_line_1'] : 'BUILT TO SCALE.';
        $title_line_2 = ! empty( $instance['title_line_2'] ) ? $instance['title_line_2'] : 'NOT STALL.';
        $description = ! empty( $instance['description'] ) ? $instance['description'] : 'SVRGN Media is a boutique creative-performance studio for growth-stage ecommerce brands.';
        $cta_text = ! empty( $instance['cta_text'] ) ? $instance['cta_text'] : 'Schedule a Strategy Call';
        $cta_url = ! empty( $instance['cta_url'] ) ? $instance['cta_url'] : '#contact';
        $secondary_cta_text = ! empty( $instance['secondary_cta_text'] ) ? $instance['secondary_cta_text'] : 'See How We Work';
        $secondary_cta_url = ! empty( $instance['secondary_cta_url'] ) ? $instance['secondary_cta_url'] : '#system';
        
        ?>
        <section class="hero" id="hero">
            <div class="hero-video-wrap">
                <video class="hero-video" id="heroVideo" autoplay muted loop playsinline preload="auto">
                    <source src="<?php echo esc_url( $video_url ); ?>" type="video/mp4">
                </video>
            </div>
            <div class="hero-scrim"></div>
            <div class="hero-grain"></div>

            <button class="mute-toggle" id="muteToggle" type="button" aria-label="Unmute background video">
                <svg class="icon-on" viewBox="0 0 24 24"><path d="M4 9v6h4l5 5V4L8 9H4z"/><path d="M16.5 8.5a5 5 0 0 1 0 7"/></svg>
                <svg class="icon-off" viewBox="0 0 24 24"><path d="M4 9v6h4l5 5V4L8 9H4z"/><path d="M16 9l5 5M21 9l-5 5"/></svg>
            </button>

            <div class="hero-frame">
                <span class="hero-corner tr">Costa Mesa, CA · Est. Performance Studio</span>
                <span class="hero-corner bl">Strategy — Creative — Media — Data</span>
            </div>

            <div class="hero-inner">
                <div class="hero-eyebrow eyebrow"><?php echo esc_html( $eyebrow ); ?></div>
                <h1 class="hero-title">
                    <span class="line"><span><?php echo esc_html( $title_line_1 ); ?></span></span>
                    <span class="line"><span class="accent-word"><?php echo esc_html( $title_line_2 ); ?></span></span>
                </h1>

                <div class="hero-foot">
                    <p class="hero-sub"><?php echo wp_kses_post( $description ); ?></p>
                    <div class="hero-actions">
                        <a href="<?php echo esc_url( $cta_url ); ?>" class="btn btn-solid">
                            <?php echo esc_html( $cta_text ); ?>
                            <svg viewBox="0 0 24 24" fill="none"><path d="M6 18L18 6M18 6H9M18 6V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </a>
                        <a href="<?php echo esc_url( $secondary_cta_url ); ?>" class="btn btn-ghost"><?php echo esc_html( $secondary_cta_text ); ?></a>
                    </div>
                    <div class="hero-stats">
                        <?php for ( $i = 1; $i <= 3; $i++ ) :
                            $count = ! empty( $instance[ "stat_{$i}_count" ] ) ? $instance[ "stat_{$i}_count" ] : '';
                            $suffix = ! empty( $instance[ "stat_{$i}_suffix" ] ) ? $instance[ "stat_{$i}_suffix" ] : '';
                            $label = ! empty( $instance[ "stat_{$i}_label" ] ) ? $instance[ "stat_{$i}_label" ] : '';
                            ?>
                            <div class="hero-stat"><b data-count="<?php echo esc_attr( $count ); ?>" data-suffix="<?php echo esc_attr( $suffix ); ?>">0<?php echo esc_html( $suffix ); ?></b><span><?php echo esc_html( $label ); ?></span></div>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>

            <div class="scroll-cue"><span>Scroll</span><span class="bar"></span></div>
        </section>
        <?php
        
        echo $args['after_widget'];
    }

    public function form( $instance ) {
        $video_url = ! empty( $instance['video_url'] ) ? $instance['video_url'] : '';
        $eyebrow = ! empty( $instance['eyebrow'] ) ? $instance['eyebrow'] : '';
        $title_line_1 = ! empty( $instance['title_line_1'] ) ? $instance['title_line_1'] : '';
        $title_line_2 = ! empty( $instance['title_line_2'] ) ? $instance['title_line_2'] : '';
        $description = ! empty( $instance['description'] ) ? $instance['description'] : '';
        $cta_text = ! empty( $instance['cta_text'] ) ? $instance['cta_text'] : '';
        $cta_url = ! empty( $instance['cta_url'] ) ? $instance['cta_url'] : '';
        $secondary_cta_text = ! empty( $instance['secondary_cta_text'] ) ? $instance['secondary_cta_text'] : '';
        $secondary_cta_url = ! empty( $instance['secondary_cta_url'] ) ? $instance['secondary_cta_url'] : '';
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'video_url' ) ); ?>"><?php _e( 'Video URL:', 'svrgn-media' ); ?></label>
            <input type="url" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'video_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'video_url' ) ); ?>" value="<?php echo esc_attr( $video_url ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'eyebrow' ) ); ?>"><?php _e( 'Eyebrow Text:', 'svrgn-media' ); ?></label>
            <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'eyebrow' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'eyebrow' ) ); ?>" value="<?php echo esc_attr( $eyebrow ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title_line_1' ) ); ?>"><?php _e( 'Title Line 1:', 'svrgn-media' ); ?></label>
            <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title_line_1' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title_line_1' ) ); ?>" value="<?php echo esc_attr( $title_line_1 ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title_line_2' ) ); ?>"><?php _e( 'Title Line 2 (Accent):', 'svrgn-media' ); ?></label>
            <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title_line_2' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title_line_2' ) ); ?>" value="<?php echo esc_attr( $title_line_2 ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"><?php _e( 'Description:', 'svrgn-media' ); ?></label>
            <textarea class="widefat" rows="3" id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>"><?php echo esc_textarea( $description ); ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'cta_text' ) ); ?>"><?php _e( 'Primary CTA Text:', 'svrgn-media' ); ?></label>
            <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'cta_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'cta_text' ) ); ?>" value="<?php echo esc_attr( $cta_text ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'cta_url' ) ); ?>"><?php _e( 'Primary CTA URL:', 'svrgn-media' ); ?></label>
            <input type="url" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'cta_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'cta_url' ) ); ?>" value="<?php echo esc_attr( $cta_url ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'secondary_cta_text' ) ); ?>"><?php _e( 'Secondary CTA Text:', 'svrgn-media' ); ?></label>
            <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'secondary_cta_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'secondary_cta_text' ) ); ?>" value="<?php echo esc_attr( $secondary_cta_text ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'secondary_cta_url' ) ); ?>"><?php _e( 'Secondary CTA URL:', 'svrgn-media' ); ?></label>
            <input type="url" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'secondary_cta_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'secondary_cta_url' ) ); ?>" value="<?php echo esc_attr( $secondary_cta_url ); ?>">
        </p>
        <hr style="margin: 15px 0;">
        <p><strong><?php _e( 'Hero Stats', 'svrgn-media' ); ?></strong></p>
        <?php for ( $i = 1; $i <= 3; $i++ ) :
            $count = ! empty( $instance[ "stat_{$i}_count" ] ) ? $instance[ "stat_{$i}_count" ] : '';
            $suffix = ! empty( $instance[ "stat_{$i}_suffix" ] ) ? $instance[ "stat_{$i}_suffix" ] : '';
            $label = ! empty( $instance[ "stat_{$i}_label" ] ) ? $instance[ "stat_{$i}_label" ] : '';
            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( "stat_{$i}_count" ) ); ?>"><?php printf( __( 'Stat %d Count:', 'svrgn-media' ), $i ); ?></label>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( "stat_{$i}_count" ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( "stat_{$i}_count" ) ); ?>" value="<?php echo esc_attr( $count ); ?>">
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( "stat_{$i}_suffix" ) ); ?>"><?php printf( __( 'Stat %d Suffix:', 'svrgn-media' ), $i ); ?></label>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( "stat_{$i}_suffix" ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( "stat_{$i}_suffix" ) ); ?>" value="<?php echo esc_attr( $suffix ); ?>">
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( "stat_{$i}_label" ) ); ?>"><?php printf( __( 'Stat %d Label:', 'svrgn-media' ), $i ); ?></label>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( "stat_{$i}_label" ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( "stat_{$i}_label" ) ); ?>" value="<?php echo esc_attr( $label ); ?>">
            </p>
        <?php endfor; ?>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = [];
        $instance['video_url'] = ! empty( $new_instance['video_url'] ) ? esc_url_raw( $new_instance['video_url'] ) : '';
        $instance['eyebrow'] = ! empty( $new_instance['eyebrow'] ) ? sanitize_text_field( $new_instance['eyebrow'] ) : '';
        $instance['title_line_1'] = ! empty( $new_instance['title_line_1'] ) ? sanitize_text_field( $new_instance['title_line_1'] ) : '';
        $instance['title_line_2'] = ! empty( $new_instance['title_line_2'] ) ? sanitize_text_field( $new_instance['title_line_2'] ) : '';
        $instance['description'] = ! empty( $new_instance['description'] ) ? wp_kses_post( $new_instance['description'] ) : '';
        $instance['cta_text'] = ! empty( $new_instance['cta_text'] ) ? sanitize_text_field( $new_instance['cta_text'] ) : '';
        $instance['cta_url'] = ! empty( $new_instance['cta_url'] ) ? esc_url_raw( $new_instance['cta_url'] ) : '';
        $instance['secondary_cta_text'] = ! empty( $new_instance['secondary_cta_text'] ) ? sanitize_text_field( $new_instance['secondary_cta_text'] ) : '';
        $instance['secondary_cta_url'] = ! empty( $new_instance['secondary_cta_url'] ) ? esc_url_raw( $new_instance['secondary_cta_url'] ) : '';
        
        for ( $i = 1; $i <= 3; $i++ ) {
            $instance[ "stat_{$i}_count" ] = ! empty( $new_instance[ "stat_{$i}_count" ] ) ? sanitize_text_field( $new_instance[ "stat_{$i}_count" ] ) : '';
            $instance[ "stat_{$i}_suffix" ] = ! empty( $new_instance[ "stat_{$i}_suffix" ] ) ? sanitize_text_field( $new_instance[ "stat_{$i}_suffix" ] ) : '';
            $instance[ "stat_{$i}_label" ] = ! empty( $new_instance[ "stat_{$i}_label" ] ) ? sanitize_text_field( $new_instance[ "stat_{$i}_label" ] ) : '';
        }
        
        return $instance;
    }
}
