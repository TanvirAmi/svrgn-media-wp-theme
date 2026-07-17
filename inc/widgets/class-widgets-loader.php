<?php
/**
 * SVRGN Media Widgets Loader
 * Register all custom widgets
 */

class SVRGN_Widgets_Loader {

    public function __construct() {
        add_action( 'widgets_init', [ $this, 'register_widgets' ] );
    }

    /**
     * Register all widgets
     */
    public function register_widgets() {
        require_once SVRGN_THEME_INC . '/widgets/class-hero-widget.php';
        require_once SVRGN_THEME_INC . '/widgets/class-problem-widget.php';
        require_once SVRGN_THEME_INC . '/widgets/class-system-widget.php';
        require_once SVRGN_THEME_INC . '/widgets/class-pillars-widget.php';
        require_once SVRGN_THEME_INC . '/widgets/class-results-widget.php';
        require_once SVRGN_THEME_INC . '/widgets/class-fit-widget.php';
        require_once SVRGN_THEME_INC . '/widgets/class-engage-widget.php';
        require_once SVRGN_THEME_INC . '/widgets/class-different-widget.php';
        require_once SVRGN_THEME_INC . '/widgets/class-story-widget.php';
        require_once SVRGN_THEME_INC . '/widgets/class-team-widget.php';
        require_once SVRGN_THEME_INC . '/widgets/class-values-widget.php';
        require_once SVRGN_THEME_INC . '/widgets/class-contact-form-widget.php';
        require_once SVRGN_THEME_INC . '/widgets/class-process-widget.php';

        register_widget( 'SVRGN_Hero_Widget' );
        register_widget( 'SVRGN_Problem_Widget' );
        register_widget( 'SVRGN_System_Widget' );
        register_widget( 'SVRGN_Pillars_Widget' );
        register_widget( 'SVRGN_Results_Widget' );
        register_widget( 'SVRGN_Fit_Widget' );
        register_widget( 'SVRGN_Engage_Widget' );
        register_widget( 'SVRGN_Different_Widget' );
        register_widget( 'SVRGN_Story_Widget' );
        register_widget( 'SVRGN_Team_Widget' );
        register_widget( 'SVRGN_Values_Widget' );
        register_widget( 'SVRGN_Contact_Form_Widget' );
        register_widget( 'SVRGN_Process_Widget' );
    }
}
