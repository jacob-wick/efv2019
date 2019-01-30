<?php

class EFRVS_Discover {

  public static function get_photo()
  {
    $photo = get_sub_field('photo');

    if (!$photo) return;

    return '<img class="responsive-image" src="'.$photo['sizes']['medium'].'" width="'.$photo['sizes']['medium-width'].'" height="'.$photo['sizes']['medium-height'].'" alt="'.$photo['alt'].'">';
  }


  public static function get_map_url()
  {
    $field = get_sub_field('address');
    $address = $field['street'] . ' ' . $field['city'] . ' ' . $field['state'] . ' ' . $field['zip'];
    $address = wp_strip_all_tags($address);
    $address = urlencode($address);
    return 'https://www.google.com/maps/search/?api=1&query='.$address;
  }

}