<h3 class="prehead mb-1"><?php _e('Share this on', EFRVS_THEME_TDOMAIN); ?></h3>
<ul class="icon-box-list icon-box-list--left">
  <li class="icon-box-list-item">
    <a class="icon-box-list-item__a opacity-hover" href="<?php esc_attr_e( EFRVS_Theme::get_share_url('twitter') ); ?>">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/dist/img/social-icon-twitter-red@2x.png" width="42" height="42" alt="<?php _e('Share this on Twitter', EFRVS_THEME_TDOMAIN); ?>" />
    </a>
  </li>
  <li class="icon-box-list-item">
    <a class="icon-box-list-item__a opacity-hover" href="<?php esc_attr_e( EFRVS_Theme::get_share_url('facebook') ); ?>">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/dist/img/social-icon-facebook-red@2x.png" width="42" height="42" alt="<?php _e('Share this on Facebook', EFRVS_THEME_TDOMAIN); ?>" />
    </a>
  </li>
  <li class="icon-box-list-item">
    <a class="icon-box-list-item__a opacity-hover" href="<?php esc_attr_e( EFRVS_Theme::get_share_url('email') ); ?>">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/dist/img/social-icon-email-red@2x.png" width="42" height="42" alt="<?php _e('Share this via email', EFRVS_THEME_TDOMAIN); ?>" />
    </a>
  </li>
</ul>