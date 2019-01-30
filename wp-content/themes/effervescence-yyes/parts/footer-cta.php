<?php global $EFRVS_Theme; ?>

<?php if ( $EFRVS_Theme->get_cta_meta('show_footer_cta') ) : ?>

  <div class="content">
    <div class="content__top-curve">
      <?php include(locate_template('assets/dist/img/top-curve-1.svg')); ?>
    </div>
    <div class="content__background edge-pad pb-5 pt-3">
      <div class="content__inner container text-center">

        <div class="animate slide-in-from-bottom" style="position: relative;">
          
          <h3 class="h1 mb-2"><?php echo $EFRVS_Theme->get_cta_meta('footer_cta_title'); ?></h3>
          
          <?php
            $btn = $EFRVS_Theme->get_cta_meta('footer_cta_button');
            echo EFRVS_Theme::get_button($btn);
          ?>

          <p class="p-sans-sm-cap mt-2 site-width-md">
            <?php echo $EFRVS_Theme->get_cta_meta('footer_cta_message'); ?>
          </p>

        </div>

      </div>
    </div>
  </div>

<?php endif; ?>