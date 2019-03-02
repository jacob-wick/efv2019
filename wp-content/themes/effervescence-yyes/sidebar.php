<?php

  $Venue    = new EFRVS_Venue();
  $packages = EFRVS_Event::get_packages();

?>

<aside class="content__aside sidebar" role="complementary">    

  <?php // SOCIAL LIST - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  ?>
  <div class="sidebar__section">
    <?php get_template_part('parts/share-this'); ?>
  </div>

  <?php // PACKAGES LIST - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  ?>
  <?php if ($packages) : ?>
    <div class="sidebar__section">
      <h3 class="prehead mb-1-5"><?php _e('Also a part of', EFRVS_THEME_TDOMAIN); ?></h3>
      <ul class="nav-list">
        <?php foreach($packages as $package) : ?>
          <li class="nav-list-item">
            <a class="nav-list-item__a arrow-link opacity-hover" href="<?php echo home_url('/events/#packages'); ?>"><?php echo $package->name; ?></a>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>

  <?php // VENUE DETAILS - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  ?>
  <?php if ( $Venue->get_venue_name() ) : ?>
    <div class="sidebar__section">

      <?php if ( $Venue->get_venue_photo('a') ) : ?>
        <div class="sidebar-photos <?php if ($Venue->get_venue_photo('a') && $Venue->get_venue_photo('b')) { esc_attr_e('sidebar-photos--multiple'); } ?>">
          
          <?php if ($Venue->get_venue_photo('b')) : ?>
            <div class="sidebar-photos__photo sidebar-photos__photo--b animate">
              <span class="sidebar-photos__crop circle-crop">
                <?php echo $Venue->get_venue_photo('b'); ?>
              </span>
              <span class="thumbnail-flair thumbnail-flair--c">
                <span class="thumbnail-flair__dot thumbnail-flair__dot--1"></span>
                <span class="thumbnail-flair__dot thumbnail-flair__dot--2"></span>
                <span class="thumbnail-flair__dot thumbnail-flair__dot--3"></span>
                <span class="thumbnail-flair__curve"></span>
              </span>
            </div>
          <?php endif; ?>

          <?php if ($Venue->get_venue_photo('a')) : ?>
            <div class="sidebar-photos__photo sidebar-photos__photo--a animate">
              <span class="sidebar-photos__crop circle-crop">
                <?php echo $Venue->get_venue_photo('a'); ?>
              </span>
              <span class="thumbnail-flair thumbnail-flair--b">
                <span class="thumbnail-flair__curve"></span>
              </span>
            </div>
          <?php endif; ?>

        </div>
      <?php endif; ?>

      <h3 class="prehead mb-1-5"><?php _e('Venue', EFRVS_THEME_TDOMAIN); ?></h3>
      <h4 class="h3-sans mb-1"><?php echo $Venue->get_venue_name(); ?></h4>

      <?php if ( $Venue->get_venue_description() ) : ?>
        <div class="wysiwyg wysiwyg--sans wysiwyg--heavy mb-1">
          <?php echo apply_filters('the_content', $Venue->get_venue_description()); ?>
        </div>
      <?php endif; ?>

      <?php if ( $Venue->get_venue_address() ) : ?>
        <ul class="nav-list mb-1">
          <li class="nav-list-item">
            <a class="nav-list-item__a arrow-link opacity-hover" target="_blank" href="<?php echo $Venue->get_venue_map_url(); ?>"><?php _e('Map', EFRVS_THEME_TDOMAIN); ?></a>
          </li>
        </ul>
        <div class="wysiwyg">
          <?php echo apply_filters('the_content',$Venue->get_venue_address()); ?>
        </div>
      <?php endif; ?>

      <?php if ( $Venue->get_venue_phone() ) : ?>
        <div class="wysiwyg mt-1">
          <a href="tel:<?php echo $Venue->get_venue_phone(); ?>"><?php echo apply_filters('the_content',$Venue->get_venue_phone()); ?></a>
        </div>
      <?php endif; ?>

      <?php if ( $Venue->get_venue_note() ) : ?>
        <div class="wysiwyg wysiwyg--sans wysiwyg--heavy mt-2">
          <?php echo $Venue->get_venue_note(); ?>
        </div>
      <?php endif; ?>

    </div>
  <?php endif; ?>

</aside>