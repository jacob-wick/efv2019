<?php

class EFRVS_Page {

  
  public static function get_beneficiary_logo()
  {
    $logo = get_sub_field('logo');

    if (!$logo) return;

    return '<img class="responsive-image" src="'.$logo['sizes']['thumb-full'].'" width="'.$logo['sizes']['thumb-full-width'].'" height="'.$logo['sizes']['thumb-full-height'].'" alt="'.$logo['alt'].'">';
  }


  public static function get_beneficiary_photo()
  {
    $photo = get_sub_field('photo');

    if (!$photo) return;

    return '<img class="responsive-image" src="'.$photo['sizes']['medium'].'" width="'.$photo['sizes']['medium-width'].'" height="'.$photo['sizes']['medium-height'].'" alt="'.$photo['alt'].'">';
  }


  public static function get_beneficiary_photo_caption()
  {
    $image = get_sub_field('photo');

    if (!$image) return;

    $attachment = get_post($image['ID']);
    return $attachment->post_excerpt;
  }


}