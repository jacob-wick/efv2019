      <?php global $EFRVS_Theme; ?>

      <?php get_template_part('parts/footer-cta'); ?>

      <footer class="footer edge-pad">
      
        <div class="container">

          <div class="footer__menu">
            <h3 class="h4-sans footer-subhead footer-subhead--left">Discover</h3>
            <?php EFRVS_Theme::get_footer_menu(); ?>
            <?php $EFRVS_Theme->get_social_logos(); ?>
          </div>

          <div class="footer__sponsors <?php if (!$EFRVS_Theme->has_footer_logos('sponsors')) { esc_attr_e('footer__sponsors--hide'); } ?>">
            <h3 class="h4-sans footer-subhead"><?php echo $EFRVS_Theme->get_footer_subhead('sponsors'); ?></h3>
            <?php $EFRVS_Theme->get_footer_logos('sponsors'); ?>
          </div>

          <div class="footer__beneficiaries <?php if (!$EFRVS_Theme->has_footer_logos('beneficiaries')) { esc_attr_e('ooter__beneficiaries--hide'); } ?>">
            <h3 class="h4-sans footer-subhead"><?php echo $EFRVS_Theme->get_footer_subhead('beneficiaries'); ?></h3>
            <?php $EFRVS_Theme->get_footer_logos('beneficiaries'); ?>
          </div>

        </div>

        <div class="container footer__copyright caption">
          <?php _e('Copyright', EFRVS_THEME_TDOMAIN); ?>
          &copy;<?php echo date('Y'); ?>
          <?php _e('Tasting The Stars, LLC', EFRVS_THEME_TDOMAIN); ?>
        </div>
  
      </footer>
      
    </div><?php // end .master ?>

    <div class="modal-hide">
      <?php get_template_part('parts/modals/signup'); ?>
    </div>
    
    <svg xmlns="http://www.w3.org/2000/svg" width="1700" height="65" viewBox="0 0 1700 65" preserveAspectRatio="none" style="display: none;">
      <defs>
        <clipPath id="curveClip1">
          <path d="M0.317526004,52.4961622 C67.616993,46.4506908 222.020965,21.2714445 480.16238,22.2516013 C738.303794,23.2317581 876.469643,42.9273199 1125.52862,42.9273199 C1374.58759,42.9273199 1609.42228,9.5275528 1700,0 C1700,1.77888942 1700,23.4455561 1700,65 L0,65 C0.193476042,62.4175526 0.299318044,58.2496067 0.317526004,52.4961622 Z" />
        </clipPath>
      </defs>
    </svg>

    <?php wp_footer(); ?>

    <!--[if lt IE 9]>
      <script src="<?php echo get_template_directory_uri(); ?>/assets/dist/js/rem.min.js"></script>
    <![endif]-->

  </body>
</html>