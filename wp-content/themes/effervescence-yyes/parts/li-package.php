<li class="package-list-item">
  <h3 class="h3 mb-1"><?php echo $package->name; ?></h3>


  <div class="wysiwyg">
    <?php echo $EFRVS_Package->get_description(); ?>
  </div>
  
  <?php if ($EFRVS_Package->on_sale()) : ?>
    
    <p class="p mb-1"><?php echo $EFRVS_Package->get_price(); ?><p>

    <?php
    
      $btn_meta = array(
        'text'          => __('Purchase On Showclix', EFRVS_THEME_TDOMAIN),
        'url'           => $EFRVS_Package->get_package_link(),
        'color'         => 'Red',
        'liquid_effect' => true,
        'target'        => true,
      );
      echo EFRVS_Theme::get_button($btn_meta);

    ?>

  <?php else : ?>
    
    <?php
    
      $btn_meta = array(
        'text'          => __('Sign Up For Updates', EFRVS_THEME_TDOMAIN),
        'url'           => '#signup',
        'color'         => 'Empty',
        'liquid_effect' => true,
        'target'        => false
      );
      echo EFRVS_Theme::get_button($btn_meta);

    ?>
  
  <?php endif; ?>
  
  <?php $events = $EFRVS_Package->get_package_events(); ?>

  <?php if ( $events ) : $posts = $events; ?>
    
    <?php $target_ref = 'accordion_item_'.$package->term_id; ?>
  
    <div class="package-accordion">
      <button class="package-accordion__head js-toggler toggler h4-sans mt-2" data-accordion-target="<?php esc_attr_e($target_ref); ?>">
        <?php _e('Package Overview', EFRVS_THEME_TDOMAIN); ?>
      </button>
      <ul class="package-accordion__content js-toggler-target toggler-target package-events-list mt-2" id="<?php esc_attr_e($target_ref); ?>">
        <?php foreach($posts as $post) : setup_postdata($post); ?>
          <?php $EFRVS_Venue = new EFRVS_Venue(); ?>
          <li class="page-events-list-item mb-2">
            <span class="block prehead"><?php echo EFRVS_Event::get_type_term_name(); ?></span>
            <h4 class="h4-sans"><a class="opacity-hover accordion-label" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
            <p class="p-sans">
              <?php echo EFRVS_Event::get_display_date(); ?><br>
              <?php echo EFRVS_Event::get_display_time(); ?><br>
              <?php echo $EFRVS_Venue->get_venue_name(); ?>
            </p>
          </li>
        <?php endforeach; wp_reset_postdata(); ?>
      </ul>
    </div>

  <?php endif; ?>

</li>