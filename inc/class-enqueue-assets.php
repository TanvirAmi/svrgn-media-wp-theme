<?php
/**
 * SVRGN Media Enqueue Assets
 * Load CSS and JavaScript files
 */

class SVRGN_Enqueue_Assets {

    public function __construct() {
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_styles' ] );
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
    }

    /**
     * Enqueue styles
     */
    public function enqueue_styles() {
        wp_enqueue_style(
            'svrgn-main',
            SVRGN_THEME_URI . '/assets/css/style.css',
            [],
            SVRGN_THEME_VERSION
        );
    }

    /**
     * Enqueue scripts
     */
    public function enqueue_scripts() {
        // GSAP library
        wp_enqueue_script(
            'gsap',
            'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js',
            [],
            '3.12.5',
            true
        );

        wp_enqueue_script(
            'gsap-scroll-trigger',
            'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js',
            [ 'gsap' ],
            '3.12.5',
            true
        );

        wp_enqueue_script(
            'gsap-motion-path',
            'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/MotionPathPlugin.min.js',
            [ 'gsap' ],
            '3.12.5',
            true
        );

        wp_enqueue_script(
            'gsap-scroll-to',
            'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollToPlugin.min.js',
            [ 'gsap' ],
            '3.12.5',
            true
        );

        // Main theme script
        wp_enqueue_script(
            'svrgn-main',
            SVRGN_THEME_URI . '/assets/js/main.js',
            [ 'gsap', 'gsap-scroll-trigger', 'gsap-motion-path', 'gsap-scroll-to' ],
            SVRGN_THEME_VERSION,
            true
        );

        // Preload Google Fonts
        wp_enqueue_style(
            'svrgn-google-fonts',
            'https://fonts.googleapis.com/css2?family=Anton&family=Archivo:ital,wght@0,400;0,500;0,600;0,700;0,800;1,500&family=IBM+Plex+Mono:wght@400;500;600&display=swap',
            [],
            null
        );
    }
}
