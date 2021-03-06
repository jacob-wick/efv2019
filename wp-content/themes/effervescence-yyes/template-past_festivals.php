<?php // TEMPLATE NAME: Past Festivals

  $participants   = EFRVS_Archive::get_2018_participants();
  $anchor_top = get_field('post_content_top_html_id');
  $anchor_bottom = get_field('post_content_bottom_html_id');
  $bottom_content = get_field('post_content_bottom');
  get_header();
  
  global $EFRVS_Theme;

?>
  
  <div class="content <?php esc_attr_e($EFRVS_Theme->get_main_content_css_classes()); ?>">
    
    <div class="content__top-curve" id="<?php esc_attr_e(get_field('post_content_top_html_id')); ?>">
      <?php include(locate_template('assets/dist/img/top-curve-1.svg')); ?>
    </div>

    <div class="content__background edge-pad">
      <div class="content__inner container">

        <header class="content-header content-header--archive">
          <div class="content-header__intro">
            <h1 class="h1 mb-2"><?php the_title(); ?></h1>
            <div class="wysiwyg">
              <?php the_content(); ?>
            </div>
          </div>
        </header>
        
        <?php $posts = EFRVS_Archive::get_past_events_and_group_by_type(); ?>

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

                  include(locate_template('parts/li-past-event.php'));
                  
                  $previous_subtitle = $subtitle;
                
                endwhile;
              
              ?>
            </ul>
          <?php endif; wp_reset_postdata(); ?>

       <!-- <?php // endif; wp_reset_postdata(); ?> -->

        <?php if ($participants) : ?>
          <h2 class="h3 mt-6 mb-4 b-rule-text" id"<?php echo $anchor_top ?>"><?php _e('Personalities'); ?></h2>
          <ul class="participant-grid mb-4">
            <?php foreach($participants as $participant) : ?>

              <?php

                $EFRVS_Participant = new EFRVS_Participant($participant);
                $events = $EFRVS_Participant->get_events();
                $tags = array();

                if ( $EFRVS_Participant->get_custom_term_link() ) {
                  
                  $url    = $EFRVS_Participant->get_custom_term_link();
                  $ob_url = $EFRVS_Participant->get_outbound_url();
                  $target = $EFRVS_Participant->get_custom_term_link_target();

                  $tags['photo']['open']  = '<a class="participant-grid-item__photo opacity-hover" href="'.esc_attr($url).'" target="'.esc_attr($target).'">';
                  $tags['photo']['close'] = '</a>';
                  $tags['title']['open']  = '<a class="opacity-hover" href="'.esc_attr($url).'" target="'.esc_attr($target).'">';
                  $tags['title']['close'] = '</a>';
                  $tags['org']['open']    = '<a class="opacity-hover" href="'.esc_attr($ob_url).'" target="_blank">';
                  $tags['org']['close']   = '</a>';

                } else {
                  
                  $tags['photo']['open']  = '<span class="participant-grid-item__photo">';
                  $tags['photo']['close'] = '</span>';
                  $tags['title']['open']  = '<span>';
                  $tags['title']['close'] = '</span>';
                  $tags['org']['open']    = '<span>';
                  $tags['org']['close']   = '</a>';
                  $tags['name']['open']   = '<span>';
                  $tags['name']['close']  = '<span>';
                }

              ?>

              <li class="participant-grid-item animate slide-in-from-bottom">

                <?php echo $tags['photo']['open']; ?>
                  <?php echo $EFRVS_Participant->get_logo($participant); ?>
                <?php echo $tags['photo']['close']; ?>

                <h2 class="participant-grid-item__name h4-sans">
                  <?php echo $tags['title']['open']; ?><?php echo $participant->name; ?><?php echo $tags['title']['close']; ?>
                </h2>

               <!--comment out org-name <div class="participant-grid-item__org-name">
                  <?php /* echo $tags['org']['open']; ?><?php echo $EFRVS_Participant->get_org_name(); ?><?php echo $EFRVS_Participant->get_detail(); ?><?php echo $tags['org']['close']; */ ?>
                </div> -->

                <div class="participant-grid-item__org-name">
                  <?php echo $tags['name']['open']; ?><?php echo $EFRVS_Participant->get_detail(); ?><?php echo $tags['name']['close']; ?>
                </div>

                <?php if ($events) : ?>
                  <h3><?php _e('Participated in:', EFRVS_THEME_TDOMAIN); ?></h3>
                  <ul class="nav-list nav-list--small">
                    <?php foreach ($events as $post) : setup_postdata($post)  ?>
                      <li class="nav-list-item">
                        <a class="nav-list-item__a arrow-link opacity-hover" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                      </li>
                    <?php endforeach; wp_reset_postdata(); ?>
                  </ul>
                <?php endif; ?>

              </li>
            <?php endforeach; ?>
          </ul>
      <?php endif; ?>


      </div>
    </div>
  </div>

<?php get_footer(); ?>