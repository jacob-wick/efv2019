<?php

class EFRVS_Config_Cpt {

  /**
   * Register event custom post type
   */
  public static function register_event_cpt()
  {

    $labels = array(
      'name'                  => _x( 'Events', 'Post Type General Name', EFRVS_CONFIG_TDOMAIN ),
      'singular_name'         => _x( 'Event', 'Post Type Singular Name', EFRVS_CONFIG_TDOMAIN ),
      'menu_name'             => __( 'Events', EFRVS_CONFIG_TDOMAIN ),
      'name_admin_bar'        => __( 'Event', EFRVS_CONFIG_TDOMAIN ),
      'archives'              => __( 'Event Archive', EFRVS_CONFIG_TDOMAIN ),
      'attributes'            => __( 'Event Attributes', EFRVS_CONFIG_TDOMAIN ),
      'parent_item_colon'     => __( 'Parent Event:', EFRVS_CONFIG_TDOMAIN ),
      'all_items'             => __( 'All Events', EFRVS_CONFIG_TDOMAIN ),
      'add_new_item'          => __( 'Add New Event', EFRVS_CONFIG_TDOMAIN ),
      'add_new'               => __( 'Add New Event', EFRVS_CONFIG_TDOMAIN ),
      'new_item'              => __( 'New Event', EFRVS_CONFIG_TDOMAIN ),
      'edit_item'             => __( 'Edit Event', EFRVS_CONFIG_TDOMAIN ),
      'update_item'           => __( 'Update Event', EFRVS_CONFIG_TDOMAIN ),
      'view_item'             => __( 'View Event', EFRVS_CONFIG_TDOMAIN ),
      'view_items'            => __( 'View Events', EFRVS_CONFIG_TDOMAIN ),
      'search_items'          => __( 'Search Events', EFRVS_CONFIG_TDOMAIN ),
      'not_found'             => __( 'Not found', EFRVS_CONFIG_TDOMAIN ),
      'not_found_in_trash'    => __( 'Not found in Trash', EFRVS_CONFIG_TDOMAIN ),
      'featured_image'        => __( 'Featured Image', EFRVS_CONFIG_TDOMAIN ),
      'set_featured_image'    => __( 'Set featured image', EFRVS_CONFIG_TDOMAIN ),
      'remove_featured_image' => __( 'Remove featured image', EFRVS_CONFIG_TDOMAIN ),
      'use_featured_image'    => __( 'Use as featured image', EFRVS_CONFIG_TDOMAIN ),
      'insert_into_item'      => __( 'Insert into event', EFRVS_CONFIG_TDOMAIN ),
      'uploaded_to_this_item' => __( 'Uploaded to this event', EFRVS_CONFIG_TDOMAIN ),
      'items_list'            => __( 'Event list', EFRVS_CONFIG_TDOMAIN ),
      'items_list_navigation' => __( 'Event list navigation', EFRVS_CONFIG_TDOMAIN ),
      'filter_items_list'     => __( 'Filter events list', EFRVS_CONFIG_TDOMAIN ),
    );
    $args = array(
      'label'                 => __( 'Event', EFRVS_CONFIG_TDOMAIN ),
      'description'           => __( 'Event content', EFRVS_CONFIG_TDOMAIN ),
      'labels'                => $labels,
      'supports'              => array( 'title', 'thumbnail', 'custom-fields', 'revisions' ),
      'taxonomies'            => array( 'efrvs_event_type', 'efrvs_event_package', 'efrvs_venue', 'efrvs_sommelier', 'efrvs_producer', 'efrvs_chef', 'efrvs_speaker' ),
      'hierarchical'          => true,
      'public'                => true,
      'show_ui'               => true,
      'show_in_menu'          => true,
      'menu_position'         => 10,
      'menu_icon'             => 'dashicons-calendar-alt',
      'show_in_admin_bar'     => true,
      'show_in_nav_menus'     => true,
      'can_export'            => true,
      'has_archive'           => true,
      'rewrite'               => array('slug' => 'events'),
      'exclude_from_search'   => false,
      'publicly_queryable'    => true,
      'capability_type'       => 'page',
      'show_in_rest'          => true,
    );
    register_post_type('efrvs_event', $args);

  }


  /**
   * Register news custom post type
   */
  public static function register_news_cpt()
  {

    $labels = array(
      'name'                  => _x( 'News', 'Post Type General Name', EFRVS_CONFIG_TDOMAIN ),
      'singular_name'         => _x( 'News', 'Post Type Singular Name', EFRVS_CONFIG_TDOMAIN ),
      'menu_name'             => __( 'News', EFRVS_CONFIG_TDOMAIN ),
      'name_admin_bar'        => __( 'News', EFRVS_CONFIG_TDOMAIN ),
      'archives'              => __( 'News Archive', EFRVS_CONFIG_TDOMAIN ),
      'attributes'            => __( 'News Attributes', EFRVS_CONFIG_TDOMAIN ),
      'parent_item_colon'     => __( 'Parent News:', EFRVS_CONFIG_TDOMAIN ),
      'all_items'             => __( 'All News', EFRVS_CONFIG_TDOMAIN ),
      'add_new_item'          => __( 'Add News', EFRVS_CONFIG_TDOMAIN ),
      'add_new'               => __( 'Add News', EFRVS_CONFIG_TDOMAIN ),
      'new_item'              => __( 'New News', EFRVS_CONFIG_TDOMAIN ),
      'edit_item'             => __( 'Edit News', EFRVS_CONFIG_TDOMAIN ),
      'update_item'           => __( 'Update News', EFRVS_CONFIG_TDOMAIN ),
      'view_item'             => __( 'View News', EFRVS_CONFIG_TDOMAIN ),
      'view_items'            => __( 'View News', EFRVS_CONFIG_TDOMAIN ),
      'search_items'          => __( 'Search News', EFRVS_CONFIG_TDOMAIN ),
      'not_found'             => __( 'Not found', EFRVS_CONFIG_TDOMAIN ),
      'not_found_in_trash'    => __( 'Not found in Trash', EFRVS_CONFIG_TDOMAIN ),
      'featured_image'        => __( 'Featured Image', EFRVS_CONFIG_TDOMAIN ),
      'set_featured_image'    => __( 'Set featured image', EFRVS_CONFIG_TDOMAIN ),
      'remove_featured_image' => __( 'Remove featured image', EFRVS_CONFIG_TDOMAIN ),
      'use_featured_image'    => __( 'Use as featured image', EFRVS_CONFIG_TDOMAIN ),
      'insert_into_item'      => __( 'Insert into article', EFRVS_CONFIG_TDOMAIN ),
      'uploaded_to_this_item' => __( 'Uploaded to this article', EFRVS_CONFIG_TDOMAIN ),
      'items_list'            => __( 'News list', EFRVS_CONFIG_TDOMAIN ),
      'items_list_navigation' => __( 'News list navigation', EFRVS_CONFIG_TDOMAIN ),
      'filter_items_list'     => __( 'Filter news list', EFRVS_CONFIG_TDOMAIN ),
    );
    $args = array(
      'label'                 => __( 'News', EFRVS_CONFIG_TDOMAIN ),
      'description'           => __( 'News content', EFRVS_CONFIG_TDOMAIN ),
      'labels'                => $labels,
      'supports'              => array( 'title', 'editor', 'thumbnail' ),
      'taxonomies'            => array( 'efrvs_publication' ),
      'hierarchical'          => true,
      'public'                => false,
      'show_ui'               => true,
      'show_in_menu'          => true,
      'menu_position'         => 10,
      'menu_icon'             => 'dashicons-media-document',
      'show_in_admin_bar'     => true,
      'show_in_nav_menus'     => false,
      'can_export'            => true,
      'has_archive'           => false,
      'exclude_from_search'   => false,
      'publicly_queryable'    => true,
      'capability_type'       => 'page',
      'show_in_rest'          => true,
    );
    register_post_type('efrvs_news', $args);

  }

}