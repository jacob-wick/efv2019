<?php global $EFRVS_Theme; ?>

<div class="layover" id="layover">

  <div class="layover__cover"></div>

  <div class="layover__inner edge-pad mb-2">
    <?php EFRVS_Theme::get_main_menu(); ?>
  </div>

  <?php if ( $EFRVS_Theme->get_cta_meta('show_overlay_cta') ) : ?>

    <div class="layover__inner edge-pad">

      <div class="layover-cta">
        <div class="layover-cta__title">
          <h3 class="h2"><?php echo $EFRVS_Theme->get_cta_meta('overlay_cta_title'); ?></h3>
        </div>
        <div class="layover-cta__message">
          
        <h4 class="layover-cta__subtitle h4-sans mb-1"><?php echo $EFRVS_Theme->get_cta_meta('overlay_cta_subtitle'); ?></h4>
          
          <p class="p">
            <?php echo $EFRVS_Theme->get_cta_meta('overlay_cta_message'); ?>
          </p>

          <div class="layover-cta__links pt-2">
          
            <div class="layover-cta__button">
              <?php
                $btn = $EFRVS_Theme->get_cta_meta('overlay_cta_button');
                echo EFRVS_Theme::get_button($btn);
              ?>
            </div>
      
            <div class="layover-cta__social">
              <?php $EFRVS_Theme->get_social_logos(); ?>
            </div>
    
          </div>
        </div>
      </div>

    </div>
  
  <?php endif; ?>

</div>