<?php
/**
 * SVRGN Media WordPress Theme
 * Main theme functions and setup
 */

define( 'SVRGN_THEME_VERSION', '1.0.0' );
define( 'SVRGN_THEME_DIR', get_template_directory() );
define( 'SVRGN_THEME_URI', get_template_directory_uri() );
define( 'SVRGN_THEME_INC', SVRGN_THEME_DIR . '/inc' );

// Load theme setup
require_once SVRGN_THEME_INC . '/class-theme-setup.php';

// Load enqueue assets
require_once SVRGN_THEME_INC . '/class-enqueue-assets.php';

// Load post types
require_once SVRGN_THEME_INC . '/post-types/class-post-types-loader.php';

// Load widgets
require_once SVRGN_THEME_INC . '/widgets/class-widgets-loader.php';

// Load theme helpers
require_once SVRGN_THEME_INC . '/theme-helpers.php';

// Initialize theme
new SVRGN_Theme_Setup();
new SVRGN_Enqueue_Assets();
new SVRGN_Post_Types_Loader();
new SVRGN_Widgets_Loader();
