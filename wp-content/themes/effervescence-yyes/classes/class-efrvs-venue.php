<?php

class EFRVS_Venue {

  private $venue;
  private $venue_meta;


  function __construct()
  {
    $venue_meta = array();
  }


  public function get_venue()
  {

    if ($this->venue != null) {
      return $this->venue;
    } else {
      $venue = get_field('event_venue');
      $this->venue = $venue;
      return $venue;
    }

  }


  public function get_venue_name()
  {
    $venue = $this->get_venue();
    if ($venue) return $venue->name;
  }


  public function get_venue_description()
  {
    $venue = $this->get_venue();
    if ($venue) return $venue->description;
  }


  public function get_venue_archive_url()
  {
    $venue = $this->get_venue();
    return get_term_link($venue);
  }


  public function get_venue_address()
  {
    if (!empty($this->venue_meta['address'])) {
      return $this->venue_meta['address'];
    } else {
      $venue = $this->get_venue();
      $address = get_field('venue_address',$venue);
      $this->venue_meta['address'] = $address;
      return $address;
    }
  }


  public function get_venue_map_url()
  {
    $address = $this->get_venue_address();

    if (!$address) return;
    
    $address = wp_strip_all_tags($address);
    $address = urlencode($address);
    return 'https://www.google.com/maps/search/?api=1&query='.$address;
  }


  public function get_venue_phone()
  {
    if (!empty($this->venue_meta['phone'])) {
      return $this->venue_meta['phone'];
    } else {
      $venue = $this->get_venue();
      $phone = get_field('venue_phone',$venue);
      $this->venue_meta['phone'] = $phone;
      return $phone;
    }
  }


  public function get_venue_note()
  {
    if (!empty($this->venue_meta['note'])) {
      return $this->venue_meta['note'];
    } else {
      $venue = $this->get_venue();
      $note = get_field('venue_note',$venue);
      $this->venue_meta['note'] = $note;
      return $note;
    }
  }


  public function get_venue_photo($var=false)
  {

    if (!$var) $var = 'a';

    if (!empty($this->venue_meta['image_'.$var])) {
      
      return $this->venue_meta['image_'.$var];
    
    } else {
    
      $venue = $this->get_venue();
      $meta = get_field('venue_image_'.$var, $venue);
      $size = 'thumbnail';

      if (!$meta ) return;

      $html = '<img class="responsive-image" src="'.$meta['sizes'][$size].'" width="'.$meta['sizes'][$size.'-width'].'" height="'.$meta['sizes'][$size.'-height'].'" alt="'.$meta['alt'].'" />';
      
      $this->venue_meta['image_'.$var] = $html;

      return $html;
    
    }

  }

}