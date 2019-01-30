<?php

class EFRVS_Theme_Admin {

  /**
   * Adds custom styles to the TinyMCE editor in the admin
   * 
   * @see https://developer.wordpress.org/reference/functions/add_editor_style/
   */
  public static function add_editor_styles()
  {
    // add_editor_style('assets/dist/css/editor-style.css');
  }


  /**
   * 
   * 
   */
  public static function remove_meta_boxes()
  {
    remove_meta_box('efrvs_producerdiv', 'efrvs_event', 'side/main');
    remove_meta_box('efrvs_event_typediv', 'efrvs_event', 'side/main');
    
    remove_meta_box('tagsdiv-efrvs_event_package', 'efrvs_event', 'side/main');
    remove_meta_box('tagsdiv-efrvs_venue', 'efrvs_event', 'side/main');
    remove_meta_box('tagsdiv-efrvs_sommelier', 'efrvs_event', 'side/main');
    remove_meta_box('tagsdiv-efrvs_chef', 'efrvs_event', 'side/main');
    remove_meta_box('tagsdiv-efrvs_speaker', 'efrvs_event', 'side/main');
  }


  /**
   * Adds additional image sizes to the menu of available image sizes
   * that users can choose from when adding media to a post
   * 
   * @see 
   * @param   array   $sizes  the existing theme image sizes
   * @return  array   updated array with additional custom image sizes
   */
  public static function add_custom_image_size_names_to_chooser($sizes)
	{
		return array_merge( $sizes, array(
			// 'small' => __('Small'),
		));
	}


  /**
   * A series of actions that effectively disables emojis in the
   * theme. Emoji scripts and assets add unecessary overhead
   */
  public static function disable_theme_emoji()
  {
    // all actions related to emojis
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');

    // filter to remove TinyMCE emojis
    add_filter('tiny_mce_plugins', array('EFRVS_Theme_Admin','disable_emojicons_tinymce'));
  }


  /**
   * Disables emoji in the TinyMCE editor
   * @see self::disable_theme_emoji() for usage
   */
  public static function disable_emojicons_tinymce($plugins)
  {
    if ( is_array($plugins) ) {
      return array_diff( $plugins, array('wpemoji') );
    } else {
      return array();
    }
  }


  /**
   * Disable quick edit on events so there is no access to taxonomy
   * term settings for events outside of the post editor
   */
  public static function disable_quick_edit( $actions = array(), $post = null )
  {
    
    // Remove the Quick Edit link
    if ( get_post_type() == 'efrvs_event' && isset( $actions['inline hide-if-no-js'] ) ) {
        unset( $actions['inline hide-if-no-js'] );
    }
  
    // Return the set of links without Quick Edit
    return $actions;
  }
  

  /**
   * Demote the Yoast meta box on post editor
   */
	public static function demote_yoast()
	{
		return 'low';
  }
  

  /**
   * Show only published posts in ACF relationship fields
   * 
   */
  public static function show_only_published_posts_in_relationship_field( $args, $field, $post_id )
  {
    
    // only show published posts
    $args['post_status'] = 'publish';
  
    // return
    return $args;
    
  }
  

  /**
   * 
   * 
   */
  public static function do_on_acf_save_post($post_id)
  {

    $screen = get_current_screen();

    // update the footer options transient
    if (strpos($screen->id, "acf-options-footer") == true) {
      EFRVS_Theme::get_footer_options(true);
    }

    // update the footer options transient
    if (strpos($screen->id, "acf-options-social") == true) {
      EFRVS_Theme::get_social_channel_options(true);
    }

    // update the cta options transient
    if (strpos($screen->id, "acf-options-cta") == true) {
      EFRVS_Theme::get_cta_options(true);
    }

  }


  /**
   * 
   * 
   */
  public static function on_save_post($post_id, $post, $update)
  {

    $post_type    = get_post_type($post_id);
    $post_content = get_field('post_content', $post_id, false);

    // update event content and description with meta values

    if ($post_type == 'efrvs_event') {

      $event_content = get_field('event_content', $post_id, false);
      $event_excerpt = get_field('event_excerpt', $post_id, false);

      $args = array('ID' => $post_id);

      if ($event_content) $args['post_content'] = $event_content;
      if ($event_excerpt) $args['post_excerpt'] = $event_excerpt;

      if ( count($args) > 1 ) {
        remove_action('save_post', array('EFRVS_Theme_Admin','on_save_post'), 10, 3);
        wp_update_post($args);
        add_action('save_post', array('EFRVS_Theme_Admin','on_save_post'), 10, 3);
      }

      // if the event is marked as sold out, then disable its ticket sales
      if ( get_field('event_sold_out', $post_id) ) {
        delete_field('event_sales_status', $post_id);
      }

    }


    // update event content and description with meta values
    if ($post_content && $post_type != 'efrvs_event') {

      $args = array(
        'ID'           => $post_id,
        'post_content' => $post_content
      );

      remove_action('save_post', array('EFRVS_Theme_Admin','on_save_post'), 10, 3);
      wp_update_post($args);
      add_action('save_post', array('EFRVS_Theme_Admin','on_save_post'), 10, 3);
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


  /**
   * 
   * 
   */
  public static function delete_event_participant_terms($post_id)
  {
    if (!$post_id) return;

    wp_set_post_terms($post_id, array(), 'efrvs_producer', false);
    wp_set_post_terms($post_id, array(), 'efrvs_sommelier', false);
    wp_set_post_terms($post_id, array(), 'efrvs_chef', false);
    wp_set_post_terms($post_id, array(), 'efrvs_speaker', false);
  }

}