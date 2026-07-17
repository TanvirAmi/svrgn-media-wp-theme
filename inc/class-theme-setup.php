<?php
/**
 * SVRGN Media Theme Setup
 * Register theme supports, menus, and sidebars
 */

class SVRGN_Theme_Setup {

    public function __construct() {
        add_action( 'after_setup_theme', [ $this, 'setup_theme' ] );
        add_action( 'widgets_init', [ $this, 'register_sidebars' ] );
    }

    /**
     * Setup theme support
     */
    public function setup_theme() {
        // Add theme support
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'html5', [
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ] );
        add_theme_support( 'customize-selective-refresh-widgets' );
        add_theme_support( 'responsive-embeds' );
        add_theme_support( 'wp-block-styles' );

        // Register menus
        register_nav_menus( [
            'primary' => __( 'Primary Menu', 'svrgn-media' ),
            'footer' => __( 'Footer Menu', 'svrgn-media' ),
        ] );
    }

    /**
     * Register widget areas
     */
    public function register_sidebars() {
        // Homepage widgets
        register_sidebar( [
            'name'          => __( 'Homepage - Hero Section', 'svrgn-media' ),
            'id'            => 'homepage-hero',
            'description'   => __( 'Hero banner with background video', 'svrgn-media' ),
            'before_widget' => '',
            'after_widget'  => '',
        ] );

        register_sidebar( [
            'name'          => __( 'Homepage - Problem Section', 'svrgn-media' ),
            'id'            => 'homepage-problem',
            'description'   => __( 'Why growth stalls section', 'svrgn-media' ),
            'before_widget' => '',
            'after_widget'  => '',
        ] );

        register_sidebar( [
            'name'          => __( 'Homepage - System Section', 'svrgn-media' ),
            'id'            => 'homepage-system',
            'description'   => __( 'System diagram and explanation', 'svrgn-media' ),
            'before_widget' => '',
            'after_widget'  => '',
        ] );

        register_sidebar( [
            'name'          => __( 'Homepage - Pillars Section', 'svrgn-media' ),
            'id'            => 'homepage-pillars',
            'description'   => __( 'What we do - four pillars', 'svrgn-media' ),
            'before_widget' => '',
            'after_widget'  => '',
        ] );

        register_sidebar( [
            'name'          => __( 'Homepage - Results Section', 'svrgn-media' ),
            'id'            => 'homepage-results',
            'description'   => __( 'Results and case study grid', 'svrgn-media' ),
            'before_widget' => '',
            'after_widget'  => '',
        ] );

        register_sidebar( [
            'name'          => __( 'Homepage - Fit Section', 'svrgn-media' ),
            'id'            => 'homepage-fit',
            'description'   => __( 'Who we work with', 'svrgn-media' ),
            'before_widget' => '',
            'after_widget'  => '',
        ] );

        register_sidebar( [
            'name'          => __( 'Homepage - Engage Section', 'svrgn-media' ),
            'id'            => 'homepage-engage',
            'description'   => __( 'Engagement models and approach', 'svrgn-media' ),
            'before_widget' => '',
            'after_widget'  => '',
        ] );

        register_sidebar( [
            'name'          => __( 'Homepage - Different Section', 'svrgn-media' ),
            'id'            => 'homepage-different',
            'description'   => __( 'What makes SVRGN different', 'svrgn-media' ),
            'before_widget' => '',
            'after_widget'  => '',
        ] );

        // About page widgets
        register_sidebar( [
            'name'          => __( 'About Page - Story Section', 'svrgn-media' ),
            'id'            => 'about-story',
            'description'   => __( 'Story and philosophy content', 'svrgn-media' ),
            'before_widget' => '',
            'after_widget'  => '',
        ] );

        register_sidebar( [
            'name'          => __( 'About Page - Team Section', 'svrgn-media' ),
            'id'            => 'about-team',
            'description'   => __( 'Team members display', 'svrgn-media' ),
            'before_widget' => '',
            'after_widget'  => '',
        ] );

        register_sidebar( [
            'name'          => __( 'About Page - Values Section', 'svrgn-media' ),
            'id'            => 'about-values',
            'description'   => __( 'Company values and operations', 'svrgn-media' ),
            'before_widget' => '',
            'after_widget'  => '',
        ] );

        // Contact page widgets
        register_sidebar( [
            'name'          => __( 'Contact Page - Form Section', 'svrgn-media' ),
            'id'            => 'contact-form',
            'description'   => __( 'Contact form and location', 'svrgn-media' ),
            'before_widget' => '',
            'after_widget'  => '',
        ] );

        register_sidebar( [
            'name'          => __( 'Contact Page - Process Section', 'svrgn-media' ),
            'id'            => 'contact-process',
            'description'   => __( 'Process steps from message to plan', 'svrgn-media' ),
            'before_widget' => '',
            'after_widget'  => '',
        ] );
    }
}
