<?php // TEMPLATE NAME: About

  get_header();
  
  global $EFRVS_Theme;
  $media_query = get_posts(array('post_type' => 'efrvs_news', 'post_status' => 'publish'));

?>
  
  <div class="content <?php esc_attr_e($EFRVS_Theme->get_main_content_css_classes()); ?>">
    
    <div class="content__top-curve">
      <?php include(locate_template('assets/dist/img/top-curve-1.svg')); ?>
    </div>

    <div class="content__background edge-pad">
      <div class="content__inner container">

        <header class="content-header">
          <h1 class="h1 mb-2"><?php the_title(); ?></h1>
          <div class="wysiwyg">
            <?php the_content(); ?>
          </div>
        </header>


        <?php if( have_rows('about_team') ) : ?>
          <h2 class="h3 mt-6 mb-4 b-rule-text"><?php _e('Our Team'); ?></h2>
          <ul class="participant-grid mb-2">
            <?php while ( have_rows('about_team') ) : the_row(); ?>
              <?php
              
                $img = get_sub_field('photo');
                $url = get_sub_field('url');

                $tags = array();
                $tags['photo']['open']  = '<span class="participant-grid-item__photo mb-1">';
                $tags['photo']['close'] = '</span>';
                $tags['title']['open']  = '';
                $tags['title']['close'] = '';

                if ($url) {
                  $tags['photo']['open']  = '<a class="participant-grid-item__photo opacity-hover mb-1" href="' . esc_attr(get_sub_field('url')) .'">';
                  $tags['photo']['close'] = '</a>';
                  $tags['title']['open']  = '<a class="opacity-hover" href="' . esc_attr(get_sub_field('url')) .'">';
                  $tags['title']['close'] = '</a>';
                }

              ?>
              <li class="participant-grid-item">
                <?php echo $tags['photo']['open']; ?>
                  <img class="responsive-image" src="<?php esc_attr_e($img['sizes']['thumbnail']); ?>"
                    width="<?php esc_attr_e($img['sizes']['thumbnail-width']); ?>"
                    height="<?php esc_attr_e($img['sizes']['thumbnail-height']); ?>"
                    alt="<?php esc_attr_e($img['alt']); ?>" />
                <?php echo $tags['photo']['close']; ?>
                <h3 class="h4-sans mb-1">
                  <?php echo $tags['title']['open']; ?>
                    <?php the_sub_field('name'); ?>
                  <?php echo $tags['title']['close']; ?>
                </h3>
                <p class="p-sans mb-1">
                  <?php the_sub_field('description'); ?>
                </p>
              </li>
            <?php endwhile; ?>
          </ul>
        <?php endif; ?>

        <?php if (count($media_query) > 0) : ?>
          <h2 class="h3 mb-3 b-rule-text" id="media"><?php _e('Media Mentions'); ?></h2>
          <div class="mb-5">
            <?php echo do_shortcode('[ajax_load_more id="media_mentions" container_type="ul" css_classes="media-list" post_type="efrvs_news" posts_per_page="3" scroll="false" images_loaded="true" button_label="Load More"]'); ?>
          </div>
        <?php endif; ?>
        
        <?php /*
        <h2 class="h3 mb-4 b-rule-text" id="contact"><?php _e('Contact Us'); ?></h2>
        <div class="btn-group btn-group--2-half text-center">

          <?php

            $btn_meta = array(
              'text'          => __('Email Us', EFRVS_THEME_TDOMAIN),
              'url'           => 'mailto:info@effervescencela.com',
              'color'         => 'Empty',
              'liquid_effect' => true,
              'target'        => false
            );
            echo EFRVS_Theme::get_button($btn_meta);

            $btn_meta = array(
              'text'          => __('Sign Up For Updates', EFRVS_THEME_TDOMAIN),
              'url'           => '#signup',
              'color'         => 'Empty',
              'liquid_effect' => true,
              'target'        => false
            );
            echo EFRVS_Theme::get_button($btn_meta);

          ?>
        </div>
        <p class="text-center p-sans mt-2 mb-4">
          <?php the_field('about_address'); ?>
        </p>


        <div class="mt-4 pt-4 t-rule-text btn-group btn-group--2-half text-center">

          <?php

            $btn_meta = array(
              'text'          => __('Local Guide', EFRVS_THEME_TDOMAIN),
              'url'           => '/local-guide/',
              'color'         => 'Empty',
              'liquid_effect' => true,
              'target'        => false
            );
            echo EFRVS_Theme::get_button($btn_meta);

            $btn_meta = array(
              'text'          => __('Common Questions', EFRVS_THEME_TDOMAIN),
              'url'           => '/questions/',
              'color'         => 'Empty',
              'liquid_effect' => true,
              'target'        => false
            );
            echo EFRVS_Theme::get_button($btn_meta);

          ?>
        
        </div>
        */ ?>

      </div>
    </div>
  </div>

<?php get_footer(); ?>
