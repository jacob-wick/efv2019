<?php get_header(); ?>
    
  <div class="content <?php esc_attr_e($EFRVS_Theme->get_main_content_css_classes()); ?>">
    
    <div class="content__top-curve">
      <?php include(locate_template('assets/dist/img/top-curve-1.svg')); ?>
    </div>

    <div class="content__background edge-pad">
      <div class="content__inner container">

        <div class="content__pinch1 mb-6">

          <header class="content-header">
            <div class="content-header__intro">
              <h1 class="h1 mb-2"><?php the_field('event_archive_title','option'); ?></h1>
              <div class="wysiwyg">
                <?php the_field('event_archive_description','option'); ?>
              </div>
            </div>
          </header>

          <div class="btn-group" id="list">
            <a class="btn btn--no-arrow btn--liquid" href="<?php echo get_post_type_archive_link('efrvs_event') ?>#list">
              <span class="btn__label"><?php _e('By Schedule', EFRVS_THEME_TDOMAIN); ?></span>
              <span class="btn__effect"></span>
            </a>
            <a class="btn btn--no-arrow btn--liquid btn--right" href="<?php echo get_post_type_archive_link('efrvs_event') ?>?events=type#list">
              <span class="btn__label"><?php _e('By Event Type', EFRVS_THEME_TDOMAIN); ?></span>
              <span class="btn__effect"></span>
            </a>
          </div>

        </div>

        <?php if ( !isset($_GET['events']) && have_posts() ) : $counter = 0; $previous_day = ''; ?>
          <ul class="event-list">
            <?php
              while ( have_posts() ) : the_post();
                
                $EFRVS_Event = new EFRVS_Event();
                $EFRVS_Venue = new EFRVS_Venue();

                $counter++;
                $day = get_field('event_start_date');
                $day = date('l', strtotime($day));

                if ($day != $previous_day) {
                  echo '<li class="event-list-item--divider-subhead" id="'.strtolower($day).'"><h3 class="h4-cap">' . $day . '</h3></li>';
                }

                include(locate_template('parts/li-event.php'));

                $previous_day = $day;

              endwhile;
            ?>
          </ul>
        <?php endif; ?>

        <?php if ( isset($_GET['events']) && $_GET['events'] == 'type' ) : ?>
          
          <?php $posts = EFRVS_Archive::get_events_and_group_by_type(); ?>

          <?php if ($posts->have_posts()) : $counter = 0; $previous_subtitle = ''; ?>
            <ul class="event-list">
              <?php
              
                while ( $posts->have_posts() ) : $posts->the_post();
                  
                  $EFRVS_Event = new EFRVS_Event();
                  $EFRVS_Venue = new EFRVS_Venue();

                  $subtitle = EFRVS_Event::get_type_term_name();
                  $counter++;

                  if ($subtitle != $previous_subtitle) {
                    echo '<li class="event-list-item--divider-subhead" id="'.strtolower( sanitize_title_with_dashes($subtitle) ).'"><h3 class="h4-cap">' . $subtitle . '</h3></li>';
                  }

                  include(locate_template('parts/li-event.php'));
                  
                  $previous_subtitle = $subtitle;
                
                endwhile;
              
              ?>
            </ul>
          <?php endif; wp_reset_postdata(); ?>

        <?php endif; ?>

        <?php get_template_part('parts/packages'); ?>

      </div>
    </div>
  </div>

<?php get_footer(); ?>