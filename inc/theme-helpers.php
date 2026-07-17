<?php
/**
 * SVRGN Media Theme Helpers
 * Utility functions for the theme
 */

/**
 * Get theme option with fallback
 */
function svrgn_get_option( $option, $default = '' ) {
    $value = get_theme_mod( $option, $default );
    return ! empty( $value ) ? $value : $default;
}

/**
 * Get hero video URL
 */
function svrgn_get_hero_video() {
    return svrgn_get_option( 'hero_video_url', 'https://cdn.sanity.io/files/8nn8fua5/production/c6fb986a862cbe643c40cbdd0318ebc495efb187.mp4' );
}

/**
 * Get brand stats
 */
function svrgn_get_hero_stats() {
    return [
        [
            'count' => svrgn_get_option( 'stat_1_count', '40' ),
            'suffix' => svrgn_get_option( 'stat_1_suffix', '%' ),
            'label' => svrgn_get_option( 'stat_1_label', 'YoY Growth' ),
        ],
        [
            'count' => svrgn_get_option( 'stat_2_count', '10' ),
            'suffix' => svrgn_get_option( 'stat_2_suffix', 'x' ),
            'label' => svrgn_get_option( 'stat_2_label', 'Blended ROAS' ),
        ],
        [
            'count' => svrgn_get_option( 'stat_3_count', '7' ),
            'suffix' => svrgn_get_option( 'stat_3_suffix', '-Fig' ),
            'label' => svrgn_get_option( 'stat_3_label', 'Revenue Lift / 6mo' ),
        ],
    ];
}

/**
 * Get contact email
 */
function svrgn_get_contact_email() {
    return svrgn_get_option( 'contact_email', 'andyg@svrgnmedia.com' );
}

/**
 * Get contact location
 */
function svrgn_get_contact_location() {
    return svrgn_get_option( 'contact_location', 'Costa Mesa, CA' );
}

/**
 * Get nav brand text
 */
function svrgn_get_nav_brand_text() {
    return svrgn_get_option( 'nav_brand_text', 'Media / Performance Creative' );
}
