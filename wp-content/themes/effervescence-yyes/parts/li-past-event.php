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
    
   
  </div>
</li>