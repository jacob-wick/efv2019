<?php

  $term = get_queried_object();
  $EFRVS_Participant = new EFRVS_Participant($term);
  $big_photo = $EFRVS_Participant->get_photo();

  get_header();

  global $EFRVS_Theme;

?>
  
  <div class="content <?php esc_attr_e($EFRVS_Theme->get_main_content_css_classes()); ?>">
    <div class="content__top-curve">
      <?php include(locate_template('assets/dist/img/top-curve-1.svg')); ?>
    </div>
    <div class="content__background edge-pad">
      <div class="content__inner container">

        <div class="content-header content-header--term">

          <div class="content-header__logo">
            <?php if ($term->taxonomy != 'efrvs_producer') echo '<div class="circle-crop">'; ?>
              <?php echo $EFRVS_Participant->get_logo(); ?>
            <?php if ($term->taxonomy != 'efrvs_producer') echo '</div>'; ?>
          </div>

          <h1 class="h1 mb-2"><?php echo EFRVS_Archive::get_title(); ?></h1>
          <div class="content-header__intro">
            <div class="wysiwyg">
              <?php the_field('term_description', $term); ?>
            </div>
          </div>

          <?php if ( have_posts() ) : ?>
            <div class="content-header__event-list">
              <h3 class="prehead mb-1-5"><?php _e('Participating in:', EFRVS_THEME_TDOMAIN); ?></h3>
              <ul class="nav-list mb-1">
                <?php while ( have_posts() ) : the_post(); ?>
                  <li class="nav-list-item">
                    <a class="nav-list-item__a arrow-link opacity-hover" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                  </li>
                <?php endwhile;?>
              </ul>
            </div>
          <?php endif; ?>

        </div>

        <?php if ( $big_photo ) : ?>
          <div class="content__term-photo">
            <?php echo $big_photo; ?>
            <p class="content__term-photo-caption caption"><?php echo $EFRVS_Participant->get_photo_caption(); ?></p>
          </div>
        <?php endif; ?>
        
        <?php if ( $term->taxonomy == 'efrvs_producer' ) : ?>

          <div class="content__others-list">
            <?php
              $champagnes = EFRVS_Archive::get_producers(31, $term->term_id);
              $sparklings = EFRVS_Archive::get_producers(30, $term->term_id);
            ?>

            <?php if ($champagnes) : ?>
              <h2 class="h3 mb-3" id="media"><?php _e('Other Participating Champagne Producers', EFRVS_THEME_TDOMAIN); ?></h2>
              <ul class="participant-list">
                <?php foreach($champagnes as $champagne) : ?>
                  <li class="participant-list-item "><a class="participant-list-item__a opacity-hover" href="<?php echo get_term_link($champagne->term_id); ?>"><?php echo $champagne->name; ?></a></li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>

            <?php if ($sparklings) : ?>
              <h2 class="h3 mb-3" id="media"><?php _e('Other Participating Sparkling Wine Producers', EFRVS_THEME_TDOMAIN); ?></h2>
              <ul class="participant-list">
                <?php foreach($sparklings as $sparkling) : ?>
                  <li class="participant-list-item "><a class="participant-list-item__a opacity-hover" href="<?php echo get_term_link($sparkling->term_id); ?>"><?php echo $sparkling->name; ?></a></li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>
          </div>

        <?php endif; ?>

      </div>
    </div>
  </div>

<?php get_footer(); ?>