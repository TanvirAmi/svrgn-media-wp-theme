<?php
/**
 * SVRGN Media Post Types Loader
 * Register all custom post types
 */

class SVRGN_Post_Types_Loader {

    public function __construct() {
        require_once SVRGN_THEME_INC . '/post-types/class-case-study-post-type.php';
        require_once SVRGN_THEME_INC . '/post-types/class-service-post-type.php';
        require_once SVRGN_THEME_INC . '/post-types/class-project-post-type.php';

        new SVRGN_Case_Study_Post_Type();
        new SVRGN_Service_Post_Type();
        new SVRGN_Project_Post_Type();
    }
}
