<?php

  get_header();
  $qo = get_queried_object();
  $status = get_field('package_sales_status', $qo);

?>
  
  <div class="content <?php esc_attr_e($EFRVS_Theme->get_main_content_css_classes()); ?>">
    <div class="content__top-curve">
      <?php include(locate_template('assets/dist/img/top-curve-1.svg')); ?>
    </div>
    <div class="content__background">
      <div class="content__inner container">
  
        <header class="content-header">

          <span class="prehead mb-1-5"><?php _e('Package', EFRVS_THEME_TDOMAIN); ?></span>
          <h1 class="h1 mb-2"><?php echo $qo->name; ?></h1>
          
          <?php if ($status) : ?>
            <p class="h4-sans mb-2">
              <?php the_field('package_price',$qo); ?>
            </p>
          <?php endif; ?>

          <div class="content-header__intro">

            <div class="wysiwyg mb-2">
              <?php the_field('term_description',$qo); ?>
            </div>
            
            <?php if ($status) : ?>
              <a href="#" class="btn btn--liquid btn--liquid-red">
                <span class="btn__label"><?php _e('Purchase', EFRVS_THEME_TDOMAIN); ?></span>
                <span class="btn__effect"></span>
              </a>
            <?php endif; ?>

          </div>

          <div class="content-header__date">
            <h3 class="prehead screen-reader-text"><?php _e('Share this on', EFRVS_THEME_TDOMAIN); ?></h3>
            <ul class="icon-box-list">
              <li class="icon-box-item"><a class="icon-box-item__a" href="#"><span class="screen-reader-text">Twitter</span></a></li>
              <li class="icon-box-item"><a class="icon-box-item__a" href="#"><span class="screen-reader-text">Facebook</span></a></li>
              <li class="icon-box-item"><a class="icon-box-item__a" href="#"><span class="screen-reader-text">Email</span></a></li>
            </ul>
          </div>

        </header>
        
        <?php if ( have_posts() ) : ?>

          <h2 class="event-list-head h4-cap mb-4"><?php _e('Package Includes:', EFRVS_THEME_TDOMAIN); ?></h2>

          <ul class="event-list">
            <?php $counter = 0; ?>
            <?php while ( have_posts() ) : the_post(); $counter++; ?>
              <?php 
                $EFRVS_Event = new EFRVS_Event();
                $EFRVS_Venue = new EFRVS_Venue();
              ?>
              <li class="event-list-item <?php if ($counter % 2 == 0) { esc_attr_e('event-list-item--offset'); }; ?> animate mb-3">
                <div class="event-list-item__thumbnail">
                  <a class="event-list-item__thumbnail-crop opacity-hover" href="<?php the_permalink() ?>"><?php echo EFRVS_Event::get_thumbnail(); ?></a>
                  <span class="thumbnail-flair">
                    <span class="thumbnail-flair__dot thumbnail-flair__dot--1"></span>
                    <span class="thumbnail-flair__dot thumbnail-flair__dot--2"></span>
                    <span class="thumbnail-flair__dot thumbnail-flair__dot--3"></span>
                    <span class="thumbnail-flair__curve"></span>
                  </span>
                </div>
                <div class="event-list-item__detail">
                  <span class="prehead mb-0-5"><?php echo $EFRVS_Event->get_type_term_name(); ?></span>
                  <h2 class="event-list-item__title h2 mb-1"><a class="link-primary" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                  <p class="h4-sans"><?php echo EFRVS_Event::get_display_date(); ?></p>
                  <p class="h4-sans mb-1"><?php echo $EFRVS_Venue->get_venue_name(); ?></p>
                  <div class="event-list-item__excerpt wysiwyg mb-1">
                    <?php the_excerpt(); ?>
                  </div>
                </div>
              </li>
            <?php endwhile; ?>
          </ul>
  
        <?php endif; ?>

      </div>
    </div>
  </div>

<?php get_footer(); ?>