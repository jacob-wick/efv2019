<?php

class EFRVS_Config_Tax {

  // Event Type Taxonomy
  public static function register_event_type_taxonomy()
  {
    $labels = array(
      'name'                       => _x( 'Event Types', 'Taxonomy General Name', EFRVS_CONFIG_TDOMAIN ),
      'singular_name'              => _x( 'Event Type', 'Taxonomy Singular Name', EFRVS_CONFIG_TDOMAIN ),
      'menu_name'                  => __( 'Types', EFRVS_CONFIG_TDOMAIN ),
      'all_items'                  => __( 'All Event Types', EFRVS_CONFIG_TDOMAIN ),
      'parent_item'                => __( 'Parent Type', EFRVS_CONFIG_TDOMAIN ),
      'parent_item_colon'          => __( 'Parent Type:', EFRVS_CONFIG_TDOMAIN ),
      'new_item_name'              => __( 'New Type', EFRVS_CONFIG_TDOMAIN ),
      'add_new_item'               => __( 'Add Type', EFRVS_CONFIG_TDOMAIN ),
      'edit_item'                  => __( 'Edit Type', EFRVS_CONFIG_TDOMAIN ),
      'update_item'                => __( 'Update Type', EFRVS_CONFIG_TDOMAIN ),
      'view_item'                  => __( 'View Type', EFRVS_CONFIG_TDOMAIN ),
      'separate_items_with_commas' => __( 'Separate types with commas', EFRVS_CONFIG_TDOMAIN ),
      'add_or_remove_items'        => __( 'Add or remove type', EFRVS_CONFIG_TDOMAIN ),
      'choose_from_most_used'      => __( 'Choose from the most used', EFRVS_CONFIG_TDOMAIN ),
      'popular_items'              => __( 'Popular types', EFRVS_CONFIG_TDOMAIN ),
      'search_items'               => __( 'Search types', EFRVS_CONFIG_TDOMAIN ),
      'not_found'                  => __( 'Not Found', EFRVS_CONFIG_TDOMAIN ),
      'no_terms'                   => __( 'No items', EFRVS_CONFIG_TDOMAIN ),
      'items_list'                 => __( 'Type list', EFRVS_CONFIG_TDOMAIN ),
      'items_list_navigation'      => __( 'Type list navigation', EFRVS_CONFIG_TDOMAIN ),
    );
    $args = array(
      'labels'                     => $labels,
      'hierarchical'               => true,
      'public'                     => true,
      'show_ui'                    => true,
      'show_admin_column'          => true,
      'show_in_nav_menus'          => true,
      'show_tagcloud'              => false,
      'rewrite'                     => array('slug' => 'event-type'),
      'show_in_rest'               => true,
    );
    register_taxonomy( 'efrvs_event_type', array('efrvs_event'), $args );
  }


  // Event Package Taxonomy
  public static function register_event_package_taxonomy()
  {
    $labels = array(
      'name'                       => _x( 'Event Packages', 'Taxonomy General Name', EFRVS_CONFIG_TDOMAIN ),
      'singular_name'              => _x( 'Event Package', 'Taxonomy Singular Name', EFRVS_CONFIG_TDOMAIN ),
      'menu_name'                  => __( 'Packages', EFRVS_CONFIG_TDOMAIN ),
      'all_items'                  => __( 'All Packages', EFRVS_CONFIG_TDOMAIN ),
      'parent_item'                => __( 'Parent Package', EFRVS_CONFIG_TDOMAIN ),
      'parent_item_colon'          => __( 'Parent Package:', EFRVS_CONFIG_TDOMAIN ),
      'new_item_name'              => __( 'New Package', EFRVS_CONFIG_TDOMAIN ),
      'add_new_item'               => __( 'Add Package', EFRVS_CONFIG_TDOMAIN ),
      'edit_item'                  => __( 'Edit Package', EFRVS_CONFIG_TDOMAIN ),
      'update_item'                => __( 'Update Package', EFRVS_CONFIG_TDOMAIN ),
      'view_item'                  => __( 'View Package', EFRVS_CONFIG_TDOMAIN ),
      'separate_items_with_commas' => __( 'Separate packages with commas', EFRVS_CONFIG_TDOMAIN ),
      'add_or_remove_items'        => __( 'Add or remove package', EFRVS_CONFIG_TDOMAIN ),
      'choose_from_most_used'      => __( 'Choose from the most used', EFRVS_CONFIG_TDOMAIN ),
      'popular_items'              => __( 'Popular packages', EFRVS_CONFIG_TDOMAIN ),
      'search_items'               => __( 'Search packages', EFRVS_CONFIG_TDOMAIN ),
      'not_found'                  => __( 'Not Found', EFRVS_CONFIG_TDOMAIN ),
      'no_terms'                   => __( 'No items', EFRVS_CONFIG_TDOMAIN ),
      'items_list'                 => __( 'Package list', EFRVS_CONFIG_TDOMAIN ),
      'items_list_navigation'      => __( 'Package list navigation', EFRVS_CONFIG_TDOMAIN ),
    );
    $args = array(
      'labels'                     => $labels,
      'hierarchical'               => false,
      'public'                     => false,
      'show_ui'                    => true,
      'show_admin_column'          => true,
      'show_in_nav_menus'          => false,
      'show_tagcloud'              => false,
      'rewrite'                    => array('slug' => 'package'),
      'show_in_rest'               => true,
    );
    register_taxonomy( 'efrvs_event_package', array('efrvs_event'), $args );
  }


  // Event Venue Taxonomy
  public static function register_event_venue_taxonomy()
  {
    $labels = array(
      'name'                       => _x( 'Event Venues', 'Taxonomy General Name', EFRVS_CONFIG_TDOMAIN ),
      'singular_name'              => _x( 'Event Venue', 'Taxonomy Singular Name', EFRVS_CONFIG_TDOMAIN ),
      'menu_name'                  => __( 'Venues', EFRVS_CONFIG_TDOMAIN ),
      'all_items'                  => __( 'All Venues', EFRVS_CONFIG_TDOMAIN ),
      'parent_item'                => __( 'Parent Venue', EFRVS_CONFIG_TDOMAIN ),
      'parent_item_colon'          => __( 'Parent Venue:', EFRVS_CONFIG_TDOMAIN ),
      'new_item_name'              => __( 'New Venue', EFRVS_CONFIG_TDOMAIN ),
      'add_new_item'               => __( 'Add Venue', EFRVS_CONFIG_TDOMAIN ),
      'edit_item'                  => __( 'Edit Venue', EFRVS_CONFIG_TDOMAIN ),
      'update_item'                => __( 'Update Venue', EFRVS_CONFIG_TDOMAIN ),
      'view_item'                  => __( 'View Venue', EFRVS_CONFIG_TDOMAIN ),
      'separate_items_with_commas' => __( 'Separate vanues with commas', EFRVS_CONFIG_TDOMAIN ),
      'add_or_remove_items'        => __( 'Add or remove venue', EFRVS_CONFIG_TDOMAIN ),
      'choose_from_most_used'      => __( 'Choose from the most used', EFRVS_CONFIG_TDOMAIN ),
      'popular_items'              => __( 'Popular venues', EFRVS_CONFIG_TDOMAIN ),
      'search_items'               => __( 'Search venues', EFRVS_CONFIG_TDOMAIN ),
      'not_found'                  => __( 'Not Found', EFRVS_CONFIG_TDOMAIN ),
      'no_terms'                   => __( 'No items', EFRVS_CONFIG_TDOMAIN ),
      'items_list'                 => __( 'Venue list', EFRVS_CONFIG_TDOMAIN ),
      'items_list_navigation'      => __( 'Venue list navigation', EFRVS_CONFIG_TDOMAIN ),
    );
    $args = array(
      'labels'                     => $labels,
      'hierarchical'               => false,
      'public'                     => false,
      'show_ui'                    => true,
      'show_admin_column'          => true,
      'show_in_nav_menus'          => false,
      'show_tagcloud'              => false,
      'rewrite'                     => array('slug' => 'venue'),
      'show_in_rest'               => true,
    );
    register_taxonomy( 'efrvs_venue', array('efrvs_event'), $args );
  }
  

  // News Publication Taxonomy
  public static function register_publication_taxonomy()
  {
    $labels = array(
      'name'                       => _x( 'Publications', 'Taxonomy General Name', EFRVS_CONFIG_TDOMAIN ),
      'singular_name'              => _x( 'Event Publication', 'Taxonomy Singular Name', EFRVS_CONFIG_TDOMAIN ),
      'menu_name'                  => __( 'Publications', EFRVS_CONFIG_TDOMAIN ),
      'all_items'                  => __( 'All Publications', EFRVS_CONFIG_TDOMAIN ),
      'parent_item'                => __( 'Parent Publication', EFRVS_CONFIG_TDOMAIN ),
      'parent_item_colon'          => __( 'Parent Publication:', EFRVS_CONFIG_TDOMAIN ),
      'new_item_name'              => __( 'New Publication', EFRVS_CONFIG_TDOMAIN ),
      'add_new_item'               => __( 'Add Publication', EFRVS_CONFIG_TDOMAIN ),
      'edit_item'                  => __( 'Edit Publication', EFRVS_CONFIG_TDOMAIN ),
      'update_item'                => __( 'Update Publication', EFRVS_CONFIG_TDOMAIN ),
      'view_item'                  => __( 'View Publication', EFRVS_CONFIG_TDOMAIN ),
      'separate_items_with_commas' => __( 'Separate publication with commas', EFRVS_CONFIG_TDOMAIN ),
      'add_or_remove_items'        => __( 'Add or remove publication', EFRVS_CONFIG_TDOMAIN ),
      'choose_from_most_used'      => __( 'Choose from the most used', EFRVS_CONFIG_TDOMAIN ),
      'popular_items'              => __( 'Popular publications', EFRVS_CONFIG_TDOMAIN ),
      'search_items'               => __( 'Search publications', EFRVS_CONFIG_TDOMAIN ),
      'not_found'                  => __( 'Not Found', EFRVS_CONFIG_TDOMAIN ),
      'no_terms'                   => __( 'No items', EFRVS_CONFIG_TDOMAIN ),
      'items_list'                 => __( 'Publication list', EFRVS_CONFIG_TDOMAIN ),
      'items_list_navigation'      => __( 'Publication list navigation', EFRVS_CONFIG_TDOMAIN ),
    );
    $args = array(
      'labels'                     => $labels,
      'hierarchical'               => true,
      'public'                     => true,
      'show_ui'                    => true,
      'show_admin_column'          => true,
      'show_in_nav_menus'          => false,
      'show_tagcloud'              => false,
      'show_in_rest'               => true,
    );
    register_taxonomy( 'efrvs_publication', array('efrvs_news'), $args );
  }


  // Producer Taxonomy
  public static function register_producer_taxonomy()
  {
    $labels = array(
      'name'                       => _x( 'Producers', 'Taxonomy General Name', EFRVS_CONFIG_TDOMAIN ),
      'singular_name'              => _x( 'Producer', 'Taxonomy Singular Name', EFRVS_CONFIG_TDOMAIN ),
      'menu_name'                  => __( 'Producers', EFRVS_CONFIG_TDOMAIN ),
      'all_items'                  => __( 'All Producers', EFRVS_CONFIG_TDOMAIN ),
      'parent_item'                => __( 'Parent Producer', EFRVS_CONFIG_TDOMAIN ),
      'parent_item_colon'          => __( 'Parent Producer:', EFRVS_CONFIG_TDOMAIN ),
      'new_item_name'              => __( 'New Producer', EFRVS_CONFIG_TDOMAIN ),
      'add_new_item'               => __( 'Add Producer', EFRVS_CONFIG_TDOMAIN ),
      'edit_item'                  => __( 'Edit Producer', EFRVS_CONFIG_TDOMAIN ),
      'update_item'                => __( 'Update Producer', EFRVS_CONFIG_TDOMAIN ),
      'view_item'                  => __( 'View Producer', EFRVS_CONFIG_TDOMAIN ),
      'separate_items_with_commas' => __( 'Separate producers with commas', EFRVS_CONFIG_TDOMAIN ),
      'add_or_remove_items'        => __( 'Add or remove producers', EFRVS_CONFIG_TDOMAIN ),
      'choose_from_most_used'      => __( 'Choose from the most used', EFRVS_CONFIG_TDOMAIN ),
      'popular_items'              => __( 'Popular producers', EFRVS_CONFIG_TDOMAIN ),
      'search_items'               => __( 'Search producers', EFRVS_CONFIG_TDOMAIN ),
      'not_found'                  => __( 'Not Found', EFRVS_CONFIG_TDOMAIN ),
      'no_terms'                   => __( 'No items', EFRVS_CONFIG_TDOMAIN ),
      'items_list'                 => __( 'Producer list', EFRVS_CONFIG_TDOMAIN ),
      'items_list_navigation'      => __( 'Producer list navigation', EFRVS_CONFIG_TDOMAIN ),
    );
    $args = array(
      'labels'                     => $labels,
      'hierarchical'               => true,
      'public'                     => true,
      'show_ui'                    => true,
      'show_admin_column'          => true,
      'show_in_nav_menus'          => false,
      'show_tagcloud'              => false,
      'rewrite'                     => array('slug' => 'producer'),
      'show_in_rest'               => true,
    );
    register_taxonomy( 'efrvs_producer', array('efrvs_event'), $args );
  }

  
  // Sommelier Taxonomy
  public static function register_sommelier_taxonomy()
  {
    $labels = array(
      'name'                       => _x( 'Sommeliers', 'Taxonomy General Name', EFRVS_CONFIG_TDOMAIN ),
      'singular_name'              => _x( 'Event Sommelier', 'Taxonomy Singular Name', EFRVS_CONFIG_TDOMAIN ),
      'menu_name'                  => __( 'Sommeliers', EFRVS_CONFIG_TDOMAIN ),
      'all_items'                  => __( 'All Sommeliers', EFRVS_CONFIG_TDOMAIN ),
      'parent_item'                => __( 'Parent Sommelier', EFRVS_CONFIG_TDOMAIN ),
      'parent_item_colon'          => __( 'Parent Sommelier:', EFRVS_CONFIG_TDOMAIN ),
      'new_item_name'              => __( 'New Sommelier', EFRVS_CONFIG_TDOMAIN ),
      'add_new_item'               => __( 'Add Sommelier', EFRVS_CONFIG_TDOMAIN ),
      'edit_item'                  => __( 'Edit Sommeliers', EFRVS_CONFIG_TDOMAIN ),
      'update_item'                => __( 'Update Sommelier', EFRVS_CONFIG_TDOMAIN ),
      'view_item'                  => __( 'View Sommelier', EFRVS_CONFIG_TDOMAIN ),
      'separate_items_with_commas' => __( 'Separate sommeliers with commas', EFRVS_CONFIG_TDOMAIN ),
      'add_or_remove_items'        => __( 'Add or remove sommeliers', EFRVS_CONFIG_TDOMAIN ),
      'choose_from_most_used'      => __( 'Choose from the most used', EFRVS_CONFIG_TDOMAIN ),
      'popular_items'              => __( 'Popular sommeliers', EFRVS_CONFIG_TDOMAIN ),
      'search_items'               => __( 'Search sommeliers', EFRVS_CONFIG_TDOMAIN ),
      'not_found'                  => __( 'Not Found', EFRVS_CONFIG_TDOMAIN ),
      'no_terms'                   => __( 'No items', EFRVS_CONFIG_TDOMAIN ),
      'items_list'                 => __( 'Sommelier list', EFRVS_CONFIG_TDOMAIN ),
      'items_list_navigation'      => __( 'Sommelier list navigation', EFRVS_CONFIG_TDOMAIN ),
    );
    $args = array(
      'labels'                     => $labels,
      'hierarchical'               => false,
      'public'                     => false,
      'show_ui'                    => true,
      'show_admin_column'          => true,
      'show_in_nav_menus'          => false,
      'show_tagcloud'              => false,
      'rewrite'                    => array('slug' => 'sommelier'),
      'show_in_rest'               => true,
    );
    register_taxonomy( 'efrvs_sommelier', array('efrvs_event'), $args );
  }


  // Chef Taxonomy
  public static function register_chef_taxonomy()
  {
    $labels = array(
      'name'                       => _x( 'Chefs', 'Taxonomy General Name', EFRVS_CONFIG_TDOMAIN ),
      'singular_name'              => _x( 'Chef', 'Taxonomy Singular Name', EFRVS_CONFIG_TDOMAIN ),
      'menu_name'                  => __( 'Chefs', EFRVS_CONFIG_TDOMAIN ),
      'all_items'                  => __( 'All Chefs', EFRVS_CONFIG_TDOMAIN ),
      'parent_item'                => __( 'Parent Chef', EFRVS_CONFIG_TDOMAIN ),
      'parent_item_colon'          => __( 'Parent Chef:', EFRVS_CONFIG_TDOMAIN ),
      'new_item_name'              => __( 'New Chef', EFRVS_CONFIG_TDOMAIN ),
      'add_new_item'               => __( 'Add Chef', EFRVS_CONFIG_TDOMAIN ),
      'edit_item'                  => __( 'Edit Chef', EFRVS_CONFIG_TDOMAIN ),
      'update_item'                => __( 'Update Chef', EFRVS_CONFIG_TDOMAIN ),
      'view_item'                  => __( 'View Chef', EFRVS_CONFIG_TDOMAIN ),
      'separate_items_with_commas' => __( 'Separate chefs with commas', EFRVS_CONFIG_TDOMAIN ),
      'add_or_remove_items'        => __( 'Add or remove chefs', EFRVS_CONFIG_TDOMAIN ),
      'choose_from_most_used'      => __( 'Choose from the most used', EFRVS_CONFIG_TDOMAIN ),
      'popular_items'              => __( 'Popular chefs', EFRVS_CONFIG_TDOMAIN ),
      'search_items'               => __( 'Search chefs', EFRVS_CONFIG_TDOMAIN ),
      'not_found'                  => __( 'Not Found', EFRVS_CONFIG_TDOMAIN ),
      'no_terms'                   => __( 'No items', EFRVS_CONFIG_TDOMAIN ),
      'items_list'                 => __( 'Chef list', EFRVS_CONFIG_TDOMAIN ),
      'items_list_navigation'      => __( 'Chef list navigation', EFRVS_CONFIG_TDOMAIN ),
    );
    $args = array(
      'labels'                     => $labels,
      'hierarchical'               => false,
      'public'                     => true,
      'show_ui'                    => true,
      'show_admin_column'          => true,
      'show_in_nav_menus'          => false,
      'show_tagcloud'              => false,
      'rewrite'                     => array('slug' => 'chef'),
      'show_in_rest'               => true,
    );
    register_taxonomy( 'efrvs_chef', array('efrvs_event'), $args );
  }


  // Speaker Taxonomy
  public static function register_speaker_taxonomy()
  {
    $labels = array(
      'name'                       => _x( 'Speakers', 'Taxonomy General Name', EFRVS_CONFIG_TDOMAIN ),
      'singular_name'              => _x( 'Speaker', 'Taxonomy Singular Name', EFRVS_CONFIG_TDOMAIN ),
      'menu_name'                  => __( 'Speakers', EFRVS_CONFIG_TDOMAIN ),
      'all_items'                  => __( 'All Speakers', EFRVS_CONFIG_TDOMAIN ),
      'parent_item'                => __( 'Parent Speaker', EFRVS_CONFIG_TDOMAIN ),
      'parent_item_colon'          => __( 'Parent Speaker:', EFRVS_CONFIG_TDOMAIN ),
      'new_item_name'              => __( 'New Speaker', EFRVS_CONFIG_TDOMAIN ),
      'add_new_item'               => __( 'Add Speaker', EFRVS_CONFIG_TDOMAIN ),
      'edit_item'                  => __( 'Edit Speaker', EFRVS_CONFIG_TDOMAIN ),
      'update_item'                => __( 'Update Speaker', EFRVS_CONFIG_TDOMAIN ),
      'view_item'                  => __( 'View Speaker', EFRVS_CONFIG_TDOMAIN ),
      'separate_items_with_commas' => __( 'Separate speakers with commas', EFRVS_CONFIG_TDOMAIN ),
      'add_or_remove_items'        => __( 'Add or remove speakers', EFRVS_CONFIG_TDOMAIN ),
      'choose_from_most_used'      => __( 'Choose from the most used', EFRVS_CONFIG_TDOMAIN ),
      'popular_items'              => __( 'Popular speakers', EFRVS_CONFIG_TDOMAIN ),
      'search_items'               => __( 'Search speakers', EFRVS_CONFIG_TDOMAIN ),
      'not_found'                  => __( 'Not Found', EFRVS_CONFIG_TDOMAIN ),
      'no_terms'                   => __( 'No items', EFRVS_CONFIG_TDOMAIN ),
      'items_list'                 => __( 'Speaker list', EFRVS_CONFIG_TDOMAIN ),
      'items_list_navigation'      => __( 'Speaker list navigation', EFRVS_CONFIG_TDOMAIN ),
    );
    $args = array(
      'labels'                     => $labels,
      'hierarchical'               => false,
      'public'                     => true,
      'show_ui'                    => true,
      'show_admin_column'          => true,
      'show_in_nav_menus'          => false,
      'show_tagcloud'              => false,
      'rewrite'                     => array('slug' => 'speaker'),
      'show_in_rest'               => true,
    );
    register_taxonomy( 'efrvs_speaker', array('efrvs_event'), $args );
  }


}