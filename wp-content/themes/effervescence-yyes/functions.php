<?php

$theme = wp_get_theme();
define("EFRVS_THEME_VERSION", $theme->get('Version'));
define("EFRVS_THEME_TDOMAIN", $theme->get('TextDomain'));

// include classes
include( TEMPLATEPATH . '/classes/class-efrvs-theme-admin.php');
include( TEMPLATEPATH . '/classes/class-efrvs-theme.php');
include( TEMPLATEPATH . '/classes/class-efrvs-event.php');
include( TEMPLATEPATH . '/classes/class-efrvs-venue.php');
include( TEMPLATEPATH . '/classes/class-efrvs-participant.php');
include( TEMPLATEPATH . '/classes/class-efrvs-archive.php');
include( TEMPLATEPATH . '/classes/class-efrvs-discover.php');
include( TEMPLATEPATH . '/classes/class-efrvs-page.php');
include( TEMPLATEPATH . '/classes/class-efrvs-package.php');

// enqueue styles and scripts
add_action('wp_enqueue_scripts', array('EFRVS_Theme','enqueue_theme_styles_and_scripts'));

// add theme support
add_theme_support('title-tag');
add_theme_support('post-thumbnails');
add_theme_support('menus');

// remove header elements
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'parent_post_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('wp_head', 'start_post_rel_link');

// Add custom image sizes
add_image_size('thumb-full', 300, 300, false);
// add_filter('image_size_names_choose', array('EFRVS_Theme_Admin','add_custom_image_size_names_to_chooser'));

// disable emoji
add_action('init', array('EFRVS_Theme_Admin','disable_theme_emoji'));
add_filter('emoji_svg_url', '__return_false');

// disable native responsive images
add_filter('wp_calculate_image_srcset', '__return_false');

// register menus
add_action('init', array('EFRVS_Theme','register_theme_menus'));

// remove admin meta boxes
add_action('admin_init', array('EFRVS_Theme_Admin','remove_meta_boxes'));

// disable quick edit on events
add_filter('page_row_actions', array('EFRVS_Theme_Admin','disable_quick_edit'), 10, 2);

// demote Yoast metabox
add_filter('wpseo_metabox_prio', array('EFRVS_Theme_Admin','demote_yoast'));

// before getting posts...
add_action('pre_get_posts', array('EFRVS_Theme','before_getting_posts'));

// inject third party scripts into header
add_action('wp_head', array('EFRVS_Theme','inject_third_party_header_scripts'));

// inject footer elements
add_action('wp_footer', array('EFRVS_Theme','inject_footer'));

// Do stuff on normal post saves
add_action('save_post', array('EFRVS_Theme_Admin','on_save_post'), 10, 3);

// Do stuff on ACF post saves
add_action('acf/save_post', array('EFRVS_Theme_Admin','do_on_acf_save_post'), 20);

// Show only published posts in ACF relationship fields
add_filter('acf/fields/relationship/query', array('EFRVS_Theme_Admin','show_only_published_posts_in_relationship_field'), 10, 3);



// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
//  TEST AREA - ALL CONTENTS SHOULD BE MOVED TO APPROPRIATE LOCATION



// END TEST AREA
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -