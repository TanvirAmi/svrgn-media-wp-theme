<?php
/**
 * SVRGN Media Project Post Type
 */

class SVRGN_Project_Post_Type {

    public function __construct() {
        add_action( 'init', [ $this, 'register_post_type' ] );
        add_filter( 'single_template', [ $this, 'load_custom_template' ] );
    }

    /**
     * Register project post type
     */
    public function register_post_type() {
        $args = [
            'label'               => __( 'Projects', 'svrgn-media' ),
            'singular_name'       => __( 'Project', 'svrgn-media' ),
            'public'              => true,
            'publicly_queryable'  => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_rest'        => true,
            'query_var'           => true,
            'rewrite'             => [ 'slug' => 'project' ],
            'capability_type'     => 'post',
            'has_archive'         => true,
            'hierarchical'        => false,
            'menu_position'       => 7,
            'menu_icon'           => 'dashicons-images-alt2',
            'supports'            => [ 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ],
        ];

        register_post_type( 'project', $args );
    }

    /**
     * Load custom template for project single page
     */
    public function load_custom_template( $template ) {
        if ( is_singular( 'project' ) ) {
            $custom_template = SVRGN_THEME_DIR . '/single-templates/single-project.php';
            if ( file_exists( $custom_template ) ) {
                return $custom_template;
            }
        }
        return $template;
    }
}
