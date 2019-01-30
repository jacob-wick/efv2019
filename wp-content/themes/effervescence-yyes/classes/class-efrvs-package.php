<?php

class EFRVS_Package {

  private $term;
  private $price;
  private $description;
  private $status;
  private $events;


  function __construct($term)
  {
    $this->term = $term;
    $this->set_package_properties();
    $this->get_package_events();
  }


  private function set_package_properties()
  {
    $this->description = get_field('term_description', $this->term);
    $this->price       = get_field('package_price', $this->term);
    $this->status      = get_field('package_sales_status', $this->term);
  }


  public function get_package_term()
  {
    return $this->term->slug;
  }


  public function get_price()
  {
    return $this->price;
  }


  public function get_description()
  {
    return $this->description;
  }


  public function on_sale()
  {
    if ($this->status) return true;
  }


  public function get_package_events()
  {
    
    if ( !empty($this->events) ) {

      return $this->events;

    } else {

      $args = array(
        'post_type'      => 'efrvs_event',
        'post_status'    => 'publish',
        'posts_per_page' => 199,
        'tax_query'      => array(
          array(
            'taxonomy' => 'efrvs_event_package',
            'field'    => 'slug',
            'terms'    => $this->term->slug
          )
        )
      );
  
      $events = get_posts($args);

      return $events;
    }

  }


}