<?php

class EFRVS_Participant {

  private $participant;
  private $participant_meta;
  private $term_link;

  
  function __construct($term)
  {
    $this->participant = $term;
    $this->participant_meta = array();
    $this->term_link = $this->set_custom_term_link();
  }

  // ok let's try to get the year in here

  public function get_detail()
  {

    $participant = $this->participant;

    if ($participant->taxonomy == 'efrvs_sommelier') {
      $detail = 'Sommelier';
    } elseif ($participant->taxonomy == 'efrvs_chef') {
      $detail = 'Chef';
    } elseif ($participant->taxonomy == 'efvrs_speaker') {
      $detail = 'Speaker';
    }

    return $detail;
  }
  
  public function get_org_name()
  {
    $participant = $this->participant;
    return get_field('term_organization_name', $participant);
  }


  public function get_outbound_url()
  {
    $participant = $this->participant;
    return get_field('term_outbound_url', $participant);
  }


  public function get_photo()
  {
    $participant = $this->participant;
    $photo = get_field('term_photo', $participant);

    if (!$photo) return;

    return '<img class="responsive-image" src="'.$photo['sizes']['medium'].'" width="'.$photo['sizes']['medium-width'].'" height="'.$photo['sizes']['medium-height'].'" alt="'.$photo['alt'].'">';
  }


  public function get_events()
  {
    $slug = $this->participant->slug;
    $taxonomy = $this->participant->taxonomy;

    $args = array(
      'post_type'  => 'efrvs_event',
      'tax_query'  => array(array(
        'taxonomy' => $taxonomy,
        'field'    => 'slug',
        'terms'    => $slug
      ))
    );

    return get_posts($args);
  }


  public static function get_term_photo($term=false)
  {
    if (!$term) $term = get_queried_object();

    $image = get_field('term_photo', $term);

    if ($image) {
      return '<img class="responsive-image" src="'.$image['sizes']['medium'].'" width="'.$image['sizes']['medium-width'].'" height="'.$image['sizes']['medium-height'].'" alt="'.$image['alt'].'">';
    }
  }


 public function set_custom_term_link()
  {
    $participant = $this->participant;
    $description = get_field('term_description', $participant);

    if ( empty($description) || trim($description) == '' ) {
      
      $url = get_field('term_outbound_url', $participant);

        if ( empty($url) || trim($url) == '' ) {
          return false;
         } else {
           return $url;
        }

      } else {

      return get_term_link($participant->term_id);

    }

  }


  public function get_custom_term_link()
  {
    return $this->term_link;
  }
  

  public function get_custom_term_link_target()
  {
    $participant = $this->participant;
    $description = get_field('term_description');


    if ( $description ) {
      return '_self';
    } else {
      return '_blank';
    }

  }


  public static function get_photo_caption()
  {
    $term = get_queried_object();
    $image = get_field('term_photo', $term);

    if (!$image) return;

    $attachment = get_post($image['ID']);
    return $attachment->post_excerpt;

  }


  public function get_logo()
  {
    
    $participant = $this->participant;
    $image = get_field('term_logo', $participant);

    $return = false;
    $size = 'thumbnail';

    if ( $participant->taxonomy == 'efrvs_producer' ) {
      $size = 'thumb-full';
    }

    $uses_photo_for_logo = array('efrvs_chef', 'efrvs_speaker');

    if ($image) {
      return '<img class="responsive-image" src="'.$image['sizes'][$size].'" width="'.$image['sizes'][$size.'-width'].'" height="'.$image['sizes'][$size.'-height'].'" alt="'.$image['alt'].'">';
    }

  }

}