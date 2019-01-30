<?php

class EFRVS_Event {


  // private $venue;
  // private $venue_meta;


  function __construct()
  {
    // $venue_meta = array();
  }


  public static function is_in_signup_mode()
  {
    $event_options = get_field('event_options');

    return $event_options['event_sign_up_mode'];
  }


  public static function is_sold_out()
  {
    return get_field('event_sold_out');
  }

  
  public static function get_modal_attributes()
  {
    if ( EFRVS_Event::is_in_signup_mode() ) {
      return ' data-fancybox data-src="#signup"';
    }
  }


  public static function get_url()
  {
    
    if ( EFRVS_Event::is_in_signup_mode() ) {
      return '#signup';
    } else {
      return get_the_permalink();
    }

  }


  public static function get_type_term_name()
  {
    $event_type = get_field('event_type');

    if ($event_type) {
      return $event_type->name;
    }
  }


  public static function get_display_date()
  {
    $date = get_field('event_start_date');

    if (!$date) return;

    $format = 'l, F j, Y';

    return date($format, strtotime($date));
  }


  public static function get_display_time()
  {
    if ( !get_field('event_start_time') ) return;

    $start  = get_field('event_start_time');
    $end    = get_field('event_end_time');
    $format = 'g:ia';
    
    if ( !get_field('event_end_time') ) return date($format, strtotime($start));

    return date($format, strtotime($start)) . ' &#8211; ' . date($format, strtotime($end));
  }


  public static function get_thumbnail()
  {
    $image = get_field('event_thumbnail');

    if (!$image) return;

    return '<img class="responsive-image" src="'.$image['sizes']['thumbnail'].'" width="'.$image['sizes']['thumbnail-width'].'" height="'.$image['sizes']['thumbnail-height'].'" alt="'.$image['alt'].'">';
  }


  public static function get_packages()
  {
    global $post;

    $packages = wp_get_post_terms($post->ID, 'efrvs_event_package');

    if ($packages) {
      return $packages;
    }
    
  }


  public static function get_group_participants()
  {
    $display      = get_sub_field('participants');
    $combined     = array();
    $participants = array();
    $count        = 0;

    $producers    = get_sub_field('producers');
    $chefs        = get_sub_field('chefs');
    $speakers     = get_sub_field('speakers');
    $sommeliers   = get_sub_field('sommeliers');

    if ($producers)  $combined = array_merge($combined, $producers);
    if ($chefs)      $combined = array_merge($combined, $chefs);
    if ($speakers)   $combined = array_merge($combined, $speakers);
    if ($sommeliers) $combined = array_merge($combined, $sommeliers);

    if (count($combined)) {
      foreach ($combined as $participant) {
        $participants[$count]['name'] = $participant->name;
        $participants[$count]['type'] = $participant->taxonomy;
        $participants[$count]['url']  = self::get_participant_url($participant);
        $count++;
      }
    }

    return $participants;
  }


  public static function get_participant_url($participant)
  {

    if ($participant->taxonomy == 'efrvs_sommelier') {
      $url = get_field('term_outbound_url', $participant);
      return $url;
    } else {
      return get_term_link($participant);
    }

  }

}