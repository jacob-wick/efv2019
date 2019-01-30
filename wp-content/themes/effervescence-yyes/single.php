<?php

  get_header();

  global $EFRVS_Theme;
  global $EFRVS_Event;

  $EFRVS_Event = new EFRVS_Event();
  $participants = EFRVS_Event::get_group_participants(); 
  $event_options = get_field('event_options');

?>
  
  <div class="content <?php if ( have_rows('event_participant_groups') || ( !have_rows('event_participant_groups') && $EFRVS_Theme->get_cta_meta('show_footer_cta') ) ) { echo 'content--for-bottom-curve'; } ?> ">
    
    <div class="content__top-curve">
      <?php include(locate_template('assets/dist/img/top-curve-1.svg')); ?>
    </div>

    <div class="content__background edge-pad <?php if (!have_rows('event_participant_groups')) { echo 'pb-6'; } ?>">
      <div class="content__inner container">

        <?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>
          <header class="content-header">

            <span class="prehead mb-1-5"><?php echo EFRVS_Event::get_type_term_name(); ?></span>
            <h1 class="content-header__title h1 mb-2"><?php the_title(); ?></h1>

            <div class="content-header__intro wysiwyg">
              <?php the_field('event_excerpt'); ?>
            </div>

            <div class="content-header__date">
              <h3 class="prehead screen-reader-text"><?php _e('When', EFRVS_THEME_TDOMAIN); ?></h3>
              <ul class="event-details-date">
                <li class="h4-sans"><?php echo EFRVS_Event::get_display_date(); ?></li>
                <li class="h4-sans"><?php echo EFRVS_Event::get_display_time(); ?></li>
              </ul>
            </div>

          </header>

          <div>
            <div class="content__article" role="main">
              
              <?php get_template_part('parts/pass-list'); ?>

              <div class="wysiwyg">
                <?php the_field('event_content'); ?>
              </div>

              <div class="mt-3 btn-group">
                <?php
                  
                  if ( !$event_options['event_hide_guide_btn'] ) {
                    $btn_meta = array(
                      'text'          => __('Local Guide', EFRVS_THEME_TDOMAIN),
                      'url'           => '/local-guide/',
                      'color'         => 'Empty',
                      'liquid_effect' => true,
                      'target'        => false
                    );
                    echo EFRVS_Theme::get_button($btn_meta);
                  }

                  if ( !$event_options['event_show_faq_btn'] ) {
                    $btn_meta = array(
                      'text'          => __('Common Questions', EFRVS_THEME_TDOMAIN),
                      'url'           => '/questions/',
                      'color'         => 'Empty',
                      'liquid_effect' => true,
                      'target'        => false
                    );
                    echo EFRVS_Theme::get_button($btn_meta);
                  }

                ?>
              </div>

            </div>
          </div>

        <?php endwhile; endif; ?>

        <?php get_sidebar(); ?>
        
      </div>
    </div>

  </div>

  <?php if ( have_rows('event_participant_groups') ) : ?>
    <div class="content <?php esc_attr_e($EFRVS_Theme->get_main_content_css_classes()); ?>">
      <div class="content__top-curve">
        <?php include(locate_template('assets/dist/img/top-curve-1.svg')); ?>
      </div>
      <div class="content__background edge-pad">
        <div class="content__inner container">
          
          <?php while ( have_rows('event_participant_groups') ) : the_row(); ?>
            <?php $participants = EFRVS_Event::get_group_participants(); ?>
            <?php if ($participants) : ?>
              <h2 class="h3 mb-3"><?php the_sub_field('header'); ?></h2>
              <ul class="participant-list">
                <?php foreach($participants as $participant) : ?>
                  <li class="participant-list-item">
                    
                    <?php

                      if ($participant['url']) {
                        $target = '_self';

                        if ( $participant['type'] == 'efrvs_sommelier' ) {
                          $target = '_blank';
                        }

                        $tags['open']  = '<a class="participant-list-item__a opacity-hover" target="' . $target . '" href="' . esc_attr($participant['url']) . '">';
                        $tags['close'] = '</a>';
                      } else {
                        $tags['open']  = '<span class="participant-list-item__a">';
                        $tags['close'] = '</span>';
                      }

                      echo $tags['open'];
                      esc_html_e($participant['name']);
                      echo $tags['close'];
                      
                    ?>

                  </li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>
          <?php endwhile; ?>
          
        </div>
      </div>
    </div>
  <?php endif; ?>
  
<?php get_footer(); ?>