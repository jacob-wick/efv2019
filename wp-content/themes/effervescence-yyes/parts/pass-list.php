<?php global $EFRVS_Theme; ?>

<?php if ( get_field('event_sales_status') && !EFRVS_Event::is_sold_out() ) : ?>

  <?php if (have_rows('event_passes')) : ?>
    <ul class="pass-list <?php esc_attr_e(EFRVS_Theme::get_pass_list_classes()); ?>">
      <?php while ( have_rows('event_passes') ) : the_row(); ?>
        <li class="pass-list-item">
          
          <h2 class="pass-list-item__title">
            <span class="pass-list-item__title-label h3-sans"><?php the_sub_field('title'); ?><span class="pass-list-item__title-colon">:</span></span>
            <span class="pass-list-item__title-price p c-text"><?php the_sub_field('price'); ?></span>
          </h2>

          <p class="pass-list-item__desc p-sans"><?php the_sub_field('description'); ?></p>

        </li>
      <?php endwhile; ?>
    </ul>

    <div class="pass-list-button <?php esc_attr_e(EFRVS_Theme::get_pass_list_button_classes()); ?>">
      <?php

        $btn_meta = array(
          'text'          => __('Purchase On Showclix', EFRVS_THEME_TDOMAIN),
          'url'           => get_field('showclix_url'),
          'color'         => 'Red',
          'liquid_effect' => true,
          'target'        => true,
          'eventbrite'    => true
        );
        echo EFRVS_Theme::get_button($btn_meta);

      ?>
    </div>

  <?php endif; ?>

<?php elseif ( EFRVS_Event::is_sold_out() ) : ?>

  <h3 class="h4-sans head-label mb-3"><?php _e('Sold Out', EFRVS_THEME_TDOMAIN); ?></h3>

<?php else : ?>

  <ul class="pass-list pass-list--signup">
    <li class="pass-list-item">
      
      <h2 class="pass-list-item__title">
        <span class="pass-list-item__title-label h3-sans"><?php echo $EFRVS_Theme->get_cta_meta('event_cta_subtitle'); ?></span>
      </h2>

      <p class="pass-list-item__desc p-sans">
        <?php echo $EFRVS_Theme->get_cta_meta('event_cta_message'); ?>
      </p>

      <?php
        $btn = $EFRVS_Theme->get_cta_meta('event_cta_button');
        echo EFRVS_Theme::get_button($btn);
      ?>

    </li>
  </ul>

<?php endif; ?>