<?php
/**
 * SVRGN Media Case Study Post Type
 */

class SVRGN_Case_Study_Post_Type {

    public function __construct() {
        add_action( 'init', [ $this, 'register_post_type' ] );
        add_action( 'init', [ $this, 'register_taxonomy' ] );
        add_filter( 'single_template', [ $this, 'load_custom_template' ] );
    }

    /**
     * Register case study post type
     */
    public function register_post_type() {
        $args = [
            'label'               => __( 'Case Studies', 'svrgn-media' ),
            'singular_name'       => __( 'Case Study', 'svrgn-media' ),
            'public'              => true,
            'publicly_queryable'  => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_rest'        => true,
            'query_var'           => true,
            'rewrite'             => [ 'slug' => 'case-study' ],
            'capability_type'     => 'post',
            'has_archive'         => true,
            'hierarchical'        => false,
            'menu_position'       => 5,
            'menu_icon'           => 'dashicons-format-image',
            'supports'            => [ 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ],
            'taxonomies'          => [ 'case_study_category' ],
        ];

        register_post_type( 'case_study', $args );
    }

    /**
     * Register case study category taxonomy
     */
    public function register_taxonomy() {
        $args = [
            'label'              => __( 'Case Study Categories', 'svrgn-media' ),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_rest'       => true,
            'hierarchical'       => true,
            'rewrite'            => [ 'slug' => 'case-category' ],
        ];

        register_taxonomy( 'case_study_category', 'case_study', $args );
    }

    /**
     * Load custom template for case study single page
     */
    public function load_custom_template( $template ) {
        if ( is_singular( 'case_study' ) ) {
            $custom_template = SVRGN_THEME_DIR . '/single-templates/single-case-study.php';
            if ( file_exists( $custom_template ) ) {
                return $custom_template;
            }
        }
        return $template;
    }
}
