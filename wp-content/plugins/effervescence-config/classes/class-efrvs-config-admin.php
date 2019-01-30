<?php

class EFRVS_Config_Admin {

  /**
   * Enqueue scripts for admin purposes only
   * 
   * @param   none   
   * @return  none
   * @since   1.0.0
   */
  public static function enqueue_admin_scripts()
  {
    // wp_enqueue_style('smartvest_admin_css', plugins_url('../assets/admin.css', __FILE__));

    global $current_screen;

    $screens = array('edit-efrvs_producer','edit-efrvs_sommelier','edit-efrvs_chef','edit-efrvs_speaker','edit-efrvs_event_package');

    if ( in_array($current_screen->id, $screens)) wp_enqueue_script('efrvs_term_editor', EFRVS_CONFIG_URL . 'assets/js/customize-term-editor.js');

  }


  /**
   * Removes various meta boxes from the admin UI
   * 
   * @see     https://codex.wordpress.org/Function_Reference/remove_meta_box
   * @since   1.0.0
   */
  public static function remove_meta_boxes()
  {
    // default dashboard boxes
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
    remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
    remove_meta_box('dashboard_primary', 'dashboard', 'side');
    remove_meta_box('dashboard_secondary', 'dashboard', 'normal');
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
    remove_meta_box('dashboard_right_now', 'dashboard', 'normal');
    remove_meta_box('dashboard_activity', 'dashboard', 'normal');
  }


 /**
   *
   * Remove admin menu items
   * 
   * @since   1.0.0
   * @see     https://codex.wordpress.org/Function_Reference/remove_menu_page
   **/
  public static function remove_admin_menus()
  {
    remove_menu_page('edit.php');
    remove_menu_page('edit-comments.php');
    remove_menu_page('link-manager.php');

    // disable this to show the menus items for all admins and/or other users
		if (!get_current_user_id() == 1) {
      remove_menu_page('ajax-load-more');
		}

  }


  /**
   * The admin bar gets filled up enough the way it is, this removes
	 * "howdy" near the user name to help save space
	 * 
	 * @param 	object 		$wp_admin_bar		admin bar object
	 * @return	nothing		
	 * @since		1.0.0
   */
	public static function remove_howdy($wp_admin_bar)
	{
		$my_account=$wp_admin_bar->get_node('my-account');
		$newtitle = str_replace('Howdy,', '', $my_account->title);
		$wp_admin_bar->add_node(array(
			'id' => 'my-account',
			'title' => $newtitle,
		));
  }
  

  /**
   * Change the order of admin menu items
   */
  public static function custom_menu_order($menu_ord)
  {
    
    if (!$menu_ord) return true;
    
    return array(
      'index.php', // Dashboard
      'separator1', // First separator
      // 'edit.php', // Posts
      'edit.php?post_type=efrvs_event',
      'edit.php?post_type=page',
      'edit.php?post_type=efrvs_news',
      'gf_edit_forms',
      'upload.php', // Media
      'separator2', // First separator
      'themes.php', // Appearance
      'plugins.php', // Plugins
      'users.php', // Users
      'tools.php', // Tools
      'options-general.php', // Settings
      'separator-last', // Last separator
    );
  }


  /**
   * Hide ACF menu from all users but primary developer admin
   */
	public static function acf_show_admin($show)
	{
		if (current_user_can('administrator') && get_current_user_id() == 1) {
			return true;
		}
	}
  

  /**
   * 
   * 
   */
  public static function acf_add_options_pages()
  {

    acf_add_options_sub_page(array(
      'page_title' 	=> 'Events Index',
      'menu_title'	=> 'Events Index',
      'parent_slug'	=> 'edit.php?post_type=efrvs_event',
    ));
    
    /* acf_add_options_sub_page(array(
      'page_title' 	=> 'Eventbrite',
      'menu_title'	=> 'Eventbrite',
      'parent_slug'	=> 'edit.php?post_type=efrvs_event',
    )); */

    acf_add_options_sub_page(array(
      'page_title' 	=> 'Footer Settings',
      'menu_title'	=> 'Footer',
      'parent_slug'	=> 'themes.php',
    ));

    acf_add_options_sub_page(array(
      'page_title' 	=> 'Social Settings',
      'menu_title'	=> 'Social',
      'parent_slug'	=> 'themes.php',
    ));

    acf_add_options_sub_page(array(
      'page_title' 	=> 'CTA Settings',
      'menu_title'	=> 'CTA',
      'parent_slug'	=> 'themes.php',
    ));

  }
  

  /**
   * 
   * 
   */
  public static function on_acf_save_post($post_id)
  {

    $screen = get_current_screen();
    
    // update event content and description with meta values
    if (get_post_type() == 'efrvs_event') {

      $args = array(
        'ID'           => $post_id,
        'post_content' => get_field('event_content', false, false),
        'post_excerpt' => get_field('event_excerpt', false, false)
      );

      wp_update_post($args);
    }
    

    // update event content and description with meta values
    if (get_field('post_content')) {

      $args = array(
        'ID'           => $post_id,
        'post_content' => get_field('post_content', false, false)
      );

      wp_update_post($args);
    }


    // make sure event "group" repeater taxonomy terms are updated
    if ( get_post_type() == 'efrvs_event' ) {
      
      $post_id = get_the_ID();

      // first we'll delete all custom taxonomy data
      self::delete_event_participant_terms($post_id);
      $groups = get_field('event_participant_groups');
      
      $fields = array(
        array(
          'group' => 'producers',
          'taxonomy' => 'efrvs_producer'
        ),
        array(
          'group' => 'sommeliers',
          'taxonomy' =>'efrvs_sommelier'
        ),
        array(
          'group' => 'chefs',
          'taxonomy' =>'efrvs_chef'
        ),
        array(
          'group' => 'speakers',
          'taxonomy' =>'efrvs_speaker'
        )
      );

      // now we'll update the custom taxonomy terms for this post
      // based on what's defined in the ACF repeater field
      if ( is_array($groups) && count($groups) > 0 ) {

        foreach ( $groups as $group ) :
          foreach ($fields as $field) :
  
            if ( $group[$field['group']] ) {
  
              $ids = wp_list_pluck($group[$field['group']], 'term_id');
              
              if (is_array($ids) && count($ids) > 0) {
                wp_set_post_terms($post_id, $ids, $field['taxonomy'], true);
              }
  
            }
    
          endforeach;
        endforeach;

      }

    }

  }


  /**
   * 
   * 
   */
  /*
  public static function on_save_post($post_id, $post, $update)
  {

    $post_type = get_post_type($post_id);
    
    // update event content and description with meta values
    if ($post_type == 'efrvs_event') {

      $args = array(
        'ID'           => get_the_ID(),
        'post_content' => get_field('event_content', $post_id, false),
        'post_excerpt' => get_field('event_excerpt', $post_id, false)
      );

      remove_action('save_post', array('EFRVS_Config_Admin','on_save_post'), 10, 3);
      wp_update_post($args);
      add_action('save_post', array('EFRVS_Config_Admin','on_save_post'), 10, 3);
    }
    
    // update event content and description with meta values
    $post_content = get_field('post_content', $post_id, false);
    if ($post_content) {

      $args = array(
        'ID'           => $post_id,
        'post_content' => $post_content
      );

      remove_action('save_post', array('EFRVS_Config_Admin','on_save_post'), 10, 3);
      wp_update_post($args);
      add_action('save_post', array('EFRVS_Config_Admin','on_save_post'), 10, 3);
    }

    // make sure event "group" repeater taxonomy terms are updated
    if ( $post_type == 'efrvs_event' ) {
      
      // $post_id = get_the_ID();

      // first we'll delete all custom taxonomy data
      self::delete_event_participant_terms($post_id);
      $groups = get_field('event_participant_groups');
      
      $fields = array(
        array(
          'group' => 'producers',
          'taxonomy' => 'efrvs_producer'
        ),
        array(
          'group' => 'sommeliers',
          'taxonomy' =>'efrvs_sommelier'
        ),
        array(
          'group' => 'chefs',
          'taxonomy' =>'efrvs_chef'
        ),
        array(
          'group' => 'speakers',
          'taxonomy' =>'efrvs_speaker'
        )
      );

      // now we'll update the custom taxonomy terms for this post
      // based on what's defined in the ACF repeater field
      if ( is_array($groups) && count($groups) > 0 ) {

        foreach ( $groups as $group ) :
          foreach ($fields as $field) :
  
            if ( $group[$field['group']] ) {
  
              $ids = wp_list_pluck($group[$field['group']], 'term_id');
              
              if (is_array($ids) && count($ids) > 0) {
                wp_set_post_terms($post_id, $ids, $field['taxonomy'], true);
              }
  
            }
    
          endforeach;
        endforeach;

      }

    }

  }
  */

  
  /**
   * 
   * 
   */
  /*
  public static function delete_event_participant_terms($post_id)
  {
    if (!$post_id) return;

    wp_set_post_terms($post_id, array(), 'efrvs_producer', false);
    wp_set_post_terms($post_id, array(), 'efrvs_sommelier', false);
    wp_set_post_terms($post_id, array(), 'efrvs_chef', false);
    wp_set_post_terms($post_id, array(), 'efrvs_speaker', false);
  }
  */


  /**
   * 
   * 
   */
  public static function enable_tinymce_styleselect($buttons)
  {
    array_unshift($buttons, 'styleselect');
    return $buttons;
  }


  /**
   * 
   * 
   */
  public static function apply_custom_flex_module_name($title, $field, $layout, $i)
  {
    $text = get_sub_field('general_admin_panel_name');
    
    // load text sub field
    if($text) {	
      $title = $text;
    }
    
    // return
    return $title;
    
  }



}