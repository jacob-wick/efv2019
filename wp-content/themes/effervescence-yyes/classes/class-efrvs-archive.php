<?php

class EFRVS_Archive {


  public static function get_title()
  {
    $qo = get_queried_object();
    return $qo->name;
  }


  public static function get_packages()
  {
    $args = array(
      'hide_empty'  => false,
      'taxonomy'    => 'efrvs_event_package',
    );

    return get_terms($args);
  }


  public static function get_producers($parent, $suppress=false)
  {
    $args = array(
      'hide_empty'  => false,
      'taxonomy'    => 'efrvs_producer',
      'parent'      => $parent
    );

    if ($suppress) {
      $args['exclude'] = array($suppress);
    };

    return get_terms($args);
  }

  public static function get_chefs()
  {
    $args = array(
      'hide_empty'  => false,
      'taxonomy'    => 'efrvs_chef',
      'orderby'     => 'term_lname',
      'meta_key'    => 'term_lname',
      'meta_query'  => array(
        array(
          'key' => 'festival_year',
          'value' => date( 'Y' )
          ),
        ),
    );

    return get_terms($args);
  }

  public static function get_sommeliers()
  {
    $args = array(
      'hide_empty'  => false,
      'taxonomy'    => 'efrvs_sommelier',
      'orderby'     => 'term_lname',
      'meta_key'    => 'term_lname',
      'meta_query'  => array(
        array(
          'key' => 'festival_year',
          'value' => date( 'Y' )
          ),
        ),
    );

    return get_terms($args);
  }


  public static function get_speakers()
  {
    $args = array(
      'hide_empty'  => false,
      'taxonomy'    => 'efrvs_speaker',
      'orderby'     => 'term_lname',
      'meta_key'    => 'term_lname'
    );

    return get_terms($args);
  }

  public static function get_2018_participants()
  {
    $args = array(
      'hide_empty'  => false,
      'tax_query'    => array(
                            'relation' => 'OR',
                            array(
                              'taxonomy' => 'efrvs_sommelier',
                              'taxonomy' => 'efrvs_chef',
                              'taxonomy' => 'efrvs_speaker'
                              ),
                            ),  
      'orderby'     => 'term_lname',
      'meta_key'    => 'term_lname',
      'meta_query'  => array(
                        array(
                          'key' => 'festival_year',
                          'value' => '2018'
                          ),
                         ),
    );

    return get_terms($args);
  }

public static function get_2018_detail() {}

public static function get_participants()
  {
    $archive_type = get_field('participant_archive_type');

    if (!$archive_type) return;

    switch ($archive_type) :

      case 'sommelier':
        $participants = self::get_sommeliers();
        break;

      case 'chef':
        $participants = self::get_chefs();
        break;

      case 'speaker':
        $participants = self::get_speakers();
        break;
        
    endswitch;

    if (empty($participants)) return;

    return $participants;
  }


public static function get_participants_bottom()
  {
    $archive_type = get_field('participant_archive_type_bottom');

    if (!$archive_type) return;

    switch ($archive_type) :

      case 'sommelier':
        $participants_bottom = self::get_sommeliers();
        break;

      case 'chef':
        $participants_bottom = self::get_chefs();
        break;

      case 'speaker':
        $participants_bottom = self::get_speakers();
        break;
        
    endswitch;

    if (empty($participants_bottom)) return;

    return $participants_bottom;
  }



  public static function get_term_thumbnail($term)
  {
    if (!$term) return;

    $photo = get_field('term_photo', $term);

    if (!$photo) return;

    return '<img class="responsive-image" src="'.$photo['sizes']['medium'].'" width="'.$photo['sizes']['medium-width'].'" height="'.$photo['sizes']['medium-height'].'" alt="'.$photo['alt'].'">';
  }


  public static function get_events_and_group_by_type()
  {

    $year = date( 'Y' );
    $args = array(
      'post_type' => 'efrvs_event',
      'orderby'   => 'efrvs_event_type',
      'order'     => 'ASC',
      'date_query' => array(
        array(
                'year' => date( 'Y' ),
          ),
        ),
    );

    add_filter('posts_clauses', array('EFRVS_Archive','sort_events_by_type'), 10, 2 );
    $posts = new WP_Query($args);
    remove_filter('posts_clauses', array('EFRVS_Archive','sort_events_by_type'));

    return $posts;

  }

    public static function get_past_events_and_group_by_type()
  {

    $year = get_field( 'event_archive_year' );
    $args = array(
      'post_type' => 'efrvs_event',
      'orderby'   => 'efrvs_event_type',
      'order'     => 'ASC',
      'date_query' => array(
        array(
                'year' => $year
          ),
        ),
    );

    add_filter('posts_clauses', array('EFRVS_Archive','sort_events_by_type'), 10, 2 );
    $posts = new WP_Query($args);
    remove_filter('posts_clauses', array('EFRVS_Archive','sort_events_by_type'));

    return $posts;

  }


  public static function get_term_name($term_id)
  {
    if ( !$term_id ) return;

    $term = get_term($term_id);

    if ($term) return $term->name;
  }

  
  /**
   * Group posts by taxonomy when querying
   * 
   * @see http://scribu.net/wordpress/sortable-taxonomy-columns.html
   */
  public static function sort_events_by_type( $clauses, $wp_query )
  {
    global $wpdb;
  
    if ( isset( $wp_query->query['orderby'] ) && 'efrvs_event_type' == $wp_query->query['orderby'] ) {
  
      $clauses['join'] .= <<<SQL
LEFT OUTER JOIN {$wpdb->term_relationships} ON {$wpdb->posts}.ID={$wpdb->term_relationships}.object_id
LEFT OUTER JOIN {$wpdb->term_taxonomy} USING (term_taxonomy_id)
LEFT OUTER JOIN {$wpdb->terms} USING (term_id)
SQL;
  
      $clauses['where'] .= " AND (taxonomy = 'efrvs_event_type' OR taxonomy IS NULL)";
      $clauses['groupby'] = "object_id";
      $clauses['orderby']  = "GROUP_CONCAT({$wpdb->terms}.name ORDER BY name ASC) ";
      $clauses['orderby'] .= ( 'ASC' == strtoupper( $wp_query->get('order') ) ) ? 'ASC' : 'DESC';
    }
  
    return $clauses;
  }

}