<?php

/*
Plugin Name: Effervescence Theme Config
Author: yyes
Plugin URI: http://yyes.org
Description: Custom post types, custom taxonomies and additional configuration settings for the Effervescence theme
Version: 0.1.0
Textdomain: efrvs-config
*/

define('EFRVS_CONFIG_URL', plugin_dir_url(__FILE__));
define('EFRVS_CONFIG_FILE', __FILE__);
define('EFRVS_CONFIG_TDOMAIN', 'efrvs-config');
define('EFRVS_CONFIG_VERSION', '1.0.0');

// dependencies
include(plugin_dir_path(__FILE__) . 'classes/class-efrvs-config-tax.php');
include(plugin_dir_path(__FILE__) . 'classes/class-efrvs-config-cpt.php');
include(plugin_dir_path(__FILE__) . 'classes/class-efrvs-config-admin.php');
// include(plugin_dir_path(__FILE__) . 'classes/class-efrvs-config-widgets.php');

// register custom taxonomies
add_action('init', array('EFRVS_Config_Tax','register_event_type_taxonomy'), 0);
add_action('init', array('EFRVS_Config_Tax','register_event_package_taxonomy'), 0);
add_action('init', array('EFRVS_Config_Tax','register_event_venue_taxonomy'), 0);
add_action('init', array('EFRVS_Config_Tax','register_publication_taxonomy'), 0);
add_action('init', array('EFRVS_Config_Tax','register_sommelier_taxonomy'), 0);
add_action('init', array('EFRVS_Config_Tax','register_producer_taxonomy'), 0);
add_action('init', array('EFRVS_Config_Tax','register_chef_taxonomy'), 0);
add_action('init', array('EFRVS_Config_Tax','register_speaker_taxonomy'), 0);

// register custom post types
add_action('init', array('EFRVS_Config_Cpt','register_event_cpt'), 0);
add_action('init', array('EFRVS_Config_Cpt','register_news_cpt'), 0);

// admin customizations
add_filter('acf/settings/show_admin', array('EFRVS_Config_Admin','acf_show_admin'));
add_action('admin_menu', array('EFRVS_Config_Admin','remove_admin_menus'));
add_filter('custom_menu_order', array('EFRVS_Config_Admin','custom_menu_order'));
add_filter('menu_order', array('EFRVS_Config_Admin','custom_menu_order'));
add_filter('admin_bar_menu', array('EFRVS_Config_Admin','remove_howdy'), 25);
add_action('admin_init', array('EFRVS_Config_Admin','remove_meta_boxes'));
add_action('admin_enqueue_scripts', array('EFRVS_Config_Admin','enqueue_admin_scripts'));

// add acf options pages
EFRVS_Config_Admin::acf_add_options_pages();

// ACF relatated
// add_action('acf/save_post', array('EFRVS_Config_Admin','on_acf_save_post'), 20);
// add_action('save_post', array('EFRVS_Config_Admin','on_save_post'), 10, 3);

// Register the new dashboard widget with the 'wp_dashboard_setup' action
// add_action('wp_dashboard_setup', array('EFRVS_Config_Widgets','add_dashboard_widgets'));

// Update efrvs stats from dashboard widget
// add_action('admin_init', array('EFRVS_Config_Widgets','update_connect_data'), 1);

// enable menu of additional styles in tinymce
add_filter('mce_buttons_2', array('EFRVS_Config_Admin','enable_tinymce_styleselect'));

// Custom module names for specific ACF flex field
// add_filter('acf/fields/flexible_content/layout_title/name=page_modules', array('EFRVS_Config_Admin','apply_custom_flex_module_name'), 10, 4);