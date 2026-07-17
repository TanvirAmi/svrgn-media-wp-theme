<?php
/**
 * SVRGN Media Service Post Type
 */

class SVRGN_Service_Post_Type {

    public function __construct() {
        add_action( 'init', [ $this, 'register_post_type' ] );
        add_filter( 'single_template', [ $this, 'load_custom_template' ] );
    }

    /**
     * Register service post type
     */
    public function register_post_type() {
        $args = [
            'label'               => __( 'Services', 'svrgn-media' ),
            'singular_name'       => __( 'Service', 'svrgn-media' ),
            'public'              => true,
            'publicly_queryable'  => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_rest'        => true,
            'query_var'           => true,
            'rewrite'             => [ 'slug' => 'service' ],
            'capability_type'     => 'post',
            'has_archive'         => true,
            'hierarchical'        => false,
            'menu_position'       => 6,
            'menu_icon'           => 'dashicons-briefcase',
            'supports'            => [ 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ],
        ];

        register_post_type( 'service', $args );
    }

    /**
     * Load custom template for service single page
     */
    public function load_custom_template( $template ) {
        if ( is_singular( 'service' ) ) {
            $custom_template = SVRGN_THEME_DIR . '/single-templates/single-service.php';
            if ( file_exists( $custom_template ) ) {
                return $custom_template;
            }
        }
        return $template;
    }
}
