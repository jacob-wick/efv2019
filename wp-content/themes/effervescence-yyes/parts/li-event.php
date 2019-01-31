<?php 
  
  $EFRVS_Event = new EFRVS_Event();
  $EFRVS_Venue = new EFRVS_Venue();
  $date = EFRVS_Event::get_display_date();
  $time = EFRVS_Event::get_display_time();
  $venue_name = $EFRVS_Venue->get_venue_name();

?>
<li class="event-list-item <?php if ($counter % 2 == 0) { esc_attr_e('event-list-item--offset'); }; ?> animate">
  <div class="event-list-item__thumbnail">
    <a class="event-list-item__thumbnail-crop opacity-hover animate slide-in-from-right"
      href="<?php esc_attr_e( EFRVS_Event::get_url() ); ?>" <?php echo EFRVS_Event::get_modal_attributes(); ?>>
        <?php echo EFRVS_Event::get_thumbnail(); ?>
    </a>
    <span class="thumbnail-flair <?php esc_attr_e(EFRVS_Theme::get_thumbnail_flair_class($counter)); ?>">
			<span class="thumbnail-flair__dot thumbnail-flair__dot--1"></span>
			<span class="thumbnail-flair__dot thumbnail-flair__dot--2"></span>
			<span class="thumbnail-flair__dot thumbnail-flair__dot--3"></span>
			<span class="thumbnail-flair__curve"></span>
		</span>
  </div>
  <div class="event-list-item__detail animate slide-in-from-right">
    
    <span class="event-list-item__pre-title prehead"><?php echo $EFRVS_Event->get_type_term_name(); ?></span>
    
    <h2 class="event-list-item__title h1">
      <a class="opacity-hover" href="<?php esc_attr_e( EFRVS_Event::get_url() ); ?>" <?php echo EFRVS_Event::get_modal_attributes(); ?>>
        <?php the_title(); ?>
      </a>
    </h2>
    
    <?php if ( EFRVS_Event::is_sold_out() ) : ?>
      <p class="caption head-label mb-1"><?php _e('Sold Out', EFRVS_THEME_TDOMAIN); ?></p>
    <?php endif; ?>

    <?php if ($date) : ?>
      <p class="h4-sans"><?php echo $date; ?></p>
    <?php endif; ?>

    <?php if ($time) : ?>
      <p class="h4-sans"><?php echo $time; ?></p>
    <?php endif; ?>

    <?php if ($venue_name) : ?>
      <p class="h4-sans"><?php echo $venue_name; ?></p>
    <?php endif; ?>
    
    <div class="event-list-item__excerpt wysiwyg mt-1 mb-1">
      <?php the_excerpt(); ?>
    </div>
    
    <div class="btn-group">

      <?php

        if ( EFRVS_Event::is_in_signup_mode() ) :

          $btn_meta = array(
            'text'          => __('Sign Up For Updates', EFRVS_THEME_TDOMAIN),
            'url'           => EFRVS_Event::get_url(),
            'color'         => 'Empty',
            'liquid_effect' => true,
            'target'        => false
          );
          echo EFRVS_Theme::get_button($btn_meta);

        else :

          $btn_meta = array(
            'text'          => __('Details', EFRVS_THEME_TDOMAIN),
            'url'           => get_permalink(),
            'color'         => 'Empty',
            'liquid_effect' => true,
            'target'        => false
          );
          echo EFRVS_Theme::get_button($btn_meta);
          
          if (get_field('event_sales_status') && !EFRVS_Event::is_sold_out()) :
            $btn_meta = array(
              'text'          => __('Purchase On Showclix', EFRVS_THEME_TDOMAIN),
              'url'           => get_field('showclix_url'),
              'color'         => 'Red',
              'liquid_effect' => true,
              'target'        => true,
              'eventbrite'    => true
            );
            echo EFRVS_Theme::get_button($btn_meta);
          endif;

        endif;

      ?>

    </div>
  </div>
</li>