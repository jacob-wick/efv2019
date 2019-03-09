<?php

class EFRVS_Theme {

	private $footer_options;
	private $social_channels;
	private $cta_options;

  function __construct()
  {
		$this->footer_options  = self::get_footer_options();
		$this->social_channels = self::get_social_channel_options();
		$this->cta_options     = self::get_cta_options();
  }
  

  /**
   * Used to determine the environment by checking provided
	 * parameter against the home url
	 * 
	 * @param 	string 		environment		options: prod, dev, stage
	 * @return	boolean
   */
	public static function is_environment($environment=false)
	{

		$url = get_home_url();
		$string = false;

		if ( $environment === 'prod' ) {
			$string = 'effervescencela.com';
		} else if ( $environment === 'dev' ) {
			$string = 'efferves.mamp';
		} else if ( $environment === 'stage' ) {
			$string = 'staging.wpengine.com';
		}

		if (!$string) {
			return;
		}

		if (strpos($url, $string) !== false) {
			return true;
		}

	}


	public static function enqueue_theme_styles_and_scripts()
	{
		wp_enqueue_script('jquery');
		// wp_enqueue_style('fonts', 'https://fonts.googleapis.com/css?family=Fjalla+One|Montserrat:300,300i,400', array(), LAWRYS_THEME_VERSION);
		wp_enqueue_style('screen', get_template_directory_uri() . '/assets/dist/css/screen.min.css', array(), EFRVS_THEME_VERSION);
		wp_enqueue_script('main', get_template_directory_uri() . '/assets/dist/js/theme.min.js', array('jquery'), EFRVS_THEME_VERSION, true);
  }
  

	public static function register_theme_menus()
	{
		register_nav_menus(
			array(
				'main-menu' => __('Main Menu', EFRVS_THEME_TDOMAIN),
				'footer-menu' => __('Footer Menu', EFRVS_THEME_TDOMAIN)
			)
		);
	}


	public static function before_getting_posts($query)
	{

		$today = current_time('Ymd');

		if (!is_admin() && $query->is_main_query() && is_home()) {
			$query->set('post_type', 'efrvs_event');
		}

		if (!is_admin() && $query->is_main_query() && is_post_type_archive('efrvs_event') ) {

			if ( !isset($_GET['events']) ) {

				// order events by their start date meta
				$query->set('meta_query', array(
					'relation' => 'AND',
					'date_clause' => array(
						'key' => 'event_start_date',
						'value'	  => $today,
						'compare' => '>='
					),
					'time_clause' => array(
						'key' => 'event_start_time',
					), 
				));
				
				$query->set('orderby', array(
					'date_clause' => 'ASC',
					'time_clause' => 'ASC'
				));

				$query->set('order', 'ASC');

			}

		}
	
		return $query;
	}


	public static function get_main_menu()
	{
		$args = array(
			'menu'  			 		=> 'main-menu',
			'menu_class' 	 		=> 'main-menu',
			'menu_id'					=> 'mainMenu',
			'container'		 		=> 'div',
			'container_class'	=> 'layover__menu'
		);

		wp_nav_menu($args);
	}


	/**
	 * Gets the title of a menu as defined in the WordPress menu editor
	 * 
	 * @param		string		menu_location		Must refer to a theme menu location
	 * @return	string										The name of a menu, if one is found
	 * @since		1.0.0
	 */
	public static function get_menu_title($menu_location='')
	{
		if (empty($menu_location)) return;

		$locations = get_nav_menu_locations();
		$menu_id = $locations[$menu_location];
		$menu = wp_get_nav_menu_object($menu_id);

		if ($menu) {
			return $menu->name;
		}
	}


	public static function get_pass_list_classes()
	{
		$passes = get_field('event_passes');

		if ($passes && count($passes) > 1) {
			return 'pass-list--multiple';
		}
	}


	public static function get_pass_list_button_classes()
	{
		$passes = get_field('event_passes');

		if ($passes && count($passes) > 1) {
			return 'pass-list-button--multiple';
		}
	}


	public static function get_banner_classes()
	{
		$classes = array();

		if ( is_page_template() || is_archive() ) {
			$classes[] = 'banner--short';
		}
		
		return implode(' ', $classes);
	}


	public function get_main_content_css_classes()
	{
		$classes = array();

		if ( $this->get_cta_meta('show_footer_cta') ) {
			$classes[] = 'content--for-bottom-curve';
		}

		return implode(' ', $classes);
	}

	
	public static function get_sponsor_grid_logo()
	{
    $logo = get_sub_field('logo');

    if (!$logo) return;

    return '<img class="responsive-image" src="'.$logo['sizes']['medium'].'" width="'.$logo['sizes']['medium-width'].'" height="'.$logo['sizes']['medium-height'].'" alt="'.$logo['alt'].'">';

	}


	public static function inject_third_party_header_scripts()
	{
		
		if ( !is_admin() && self::is_environment('prod') ) {
			get_template_part('parts/third-party/google-analytics');
		}

		if ( !is_admin() && is_front_page() && self::is_environment('prod') ) {
			get_template_part('parts/third-party/fb-pixel-home');
		}

		if ( !is_admin() && is_singular('efrvs_event') && self::is_environment('prod') ) {
			get_template_part('parts/third-party/fb-pixel-event');
		}

	}


	public static function get_banner_background_image()
	{
		
		$image = get_field('event_banner');

		if (get_field('post_banner')) {
			$image = get_field('post_banner');
		}

		if ( is_tax() ) {
			$term = get_queried_object();
			$image = get_field('term_banner_image', $term);
		}

		if ( is_post_type_archive('efrvs_event') ) {
			$image = get_field('event_archive_post_banner','option');
		}

		if ($image) {
			return 'background-image: url('.$image['sizes']['large'].')';
		}

	}


	public static function get_button_css_classes($meta)
	{
		if (!$meta) return;

		$classes = array('btn');

		if ($meta['liquid_effect']) {
			$classes[] = 'btn--liquid';

			if ($meta['color'] == 'Red') {
				$classes[] = 'btn--liquid-red';
			}
		}

		// check to see if we need to include the eventbrite class that we'll use
		// to launch the eventbrite modal. using javascript we watch for a link click
		// with this class and we simulate a click on a hidden button that's output
		// in the footer near the injected eventbrite script. see inject_footer()
		/* if ( array_key_exists('eventbrite', $meta) && $meta['eventbrite'] === true  ) {
			// $classes[] = 'open-eventbrite-modal';
		} */

		return implode(' ', $classes);
	}


	public static function get_button($meta)
	{
		
		if (!$meta) return;
		
		$target = '_self';

		if ($meta['target']) $target = '_blank';

		$html = '<a class="' . self::get_button_css_classes($meta) . '" ';

		if (strpos($meta['url'], '#signup') !== FALSE) {
			$html .= ' href="#" ';
			$html .= ' data-fancybox data-src="#signup" ';
		} else {
			$html .= ' href="' . $meta['url'] . '" ';
			$html .= ' target="' . $target . '" ';
		}

		$html .= '>';
		$html .= '<span class="btn__label">'.$meta['text'].'</span>';
		$html .= '<span class="btn__effect"></span>';
		$html .= '</a>';

		return $html;

	}


	public function get_social_logos()
	{

		$meta = $this->social_channels;
		
		if (empty($meta)) return;

    $logos = $meta['social_logos'];

		if ($logos) :

			echo '<ul class="icon-box-list">';
			foreach ($logos as $logo) :
				echo '<li class="icon-box-list-item"><a class="icon-box-list-item__a opacity-hover" href="'.$logo['url'].'" target="_blank"><img src="'.$logo['logo']['sizes']['thumbnail'].'" alt="'.$logo['logo']['alt'].'"></a></li>';
			endforeach;
			echo '</ul>';

		endif;

	}


	public static function get_thumbnail_flair_class($key)
	{

		switch($key%3) :
			
			case 1 :
				return "thumbnail-flair--d";
				break;
			
			case 2 :
				return "thumbnail-flair--e";
				break;

		endswitch;

	}


	/**
	 * Builds a share link for various social networks and email
	 *
	 * @param 	$channel - string that indicates social network channel
	 * @return 	string - url formatted for social sharing
	 **/
	public static function get_share_url($channel=false)
	{
		
		if (!$channel) return;

		global $post;
		
		if (!$post) return;

		$share_url 		= urlencode(wp_get_shortlink());
		$share_title 	= get_the_title();
		
		if ( is_singular('efrvs_event') ) {
			$share_title = get_the_title() . " - Learn more: ";
		} else {
			$share_title = "From Effervescence: " . get_the_title() . " - ";
		}
		
		$share_title = html_entity_decode($share_title);
		$share_title = urlencode($share_title);
		
		$share_source = urlencode(get_bloginfo('url'));
		$share_img = get_the_post_thumbnail_url('large');
		$share_summary = '';
		$share_hashtags = '';
		
		$share_link = false;

		switch($channel) {

			case 'facebook':
				$share_link = "http://www.facebook.com/sharer.php?u=$share_url";
				break;

			case 'twitter':
				$share_link = "https://twitter.com/share?url=$share_url&text=$share_title"; // &via=twitterHandle&hashtags=$share_hashtags
				break;

			case 'email':
				$share_link = "mailto:?subject=".get_the_title()."&body=Check this out from Effervescence: ".get_permalink();
				break;

		}
		
		echo $share_link;
	}


	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	// TRANSIENT STUFF
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

  public static function get_footer_options($clear=false)
  {
    $transient_name = 'efrvs_footer_content';
    
    if ($clear) delete_transient($transient_name);
    
    $transient = get_transient($transient_name);

    if ( empty($transient) ) {

      $footer_meta = array();

      $footer_meta['menu_head'] 				 = EFRVS_Theme::get_menu_title('footer-menu');
      $footer_meta['sponsor_head'] 			 = get_field('footer_sponsor_column_header','option');
      $footer_meta['sponsor_logos'] 		 = get_field('footer_sponsor_logos','option');
      $footer_meta['beneficiary_head'] 	 = get_field('footer_beneficiary_column_header','option');
      $footer_meta['beneficiary_logos']  = get_field('footer_beneficiary_logos','option');
			$footer_meta['show_footer_cta']    = get_field('show_footer_cta','option');
			$footer_meta['footer_cta_title']   = get_field('footer_cta_title','option');
			$footer_meta['footer_cta_message'] = get_field('footer_cta_message','option');
			$footer_meta['footer_cta_button']  = get_field('footer_cta_button','option');

      set_transient($transient_name, $footer_meta, WEEK_IN_SECONDS);

      $transient = $footer_meta;
    }

    return $transient;
	}
	
  public static function get_cta_options($clear=false)
  {
    $transient_name = 'efrvs_cta_options';
    
    if ($clear) delete_transient($transient_name);
    
    $transient = get_transient($transient_name);

    if ( empty($transient) ) {

      $cta_meta = array();
			
			$footer_cta_button = get_field('footer_cta_button','option');

			$cta_meta['show_footer_cta']    = get_field('show_footer_cta','option');
			$cta_meta['footer_cta_title']   = get_field('footer_cta_title','option');
			$cta_meta['footer_cta_message'] = get_field('footer_cta_message','option');
			$cta_meta['footer_cta_button']  = $footer_cta_button['button_options'];

			$cta_meta['event_cta_subtitle'] = get_field('event_cta_subtitle','option');
			$cta_meta['event_cta_message']  = get_field('event_cta_message','option');
			$cta_meta['event_cta_button']   = get_field('event_cta_btn__button_options','option');

			$cta_meta['show_overlay_cta']     = get_field('show_overlay_cta','option');
			$cta_meta['overlay_cta_title']    = get_field('overlay_cta_title','option');
			$cta_meta['overlay_cta_subtitle'] = get_field('overlay_cta_subtitle','option');
			$cta_meta['overlay_cta_message']  = get_field('overlay_cta_message','option');
			$cta_meta['overlay_cta_button']   = get_field('overlay_cta_btn__button_options','option');

      set_transient($transient_name, $cta_meta, WEEK_IN_SECONDS);

      $transient = $cta_meta;
    }

    return $transient;
	}

	public static function get_social_channel_options($clear=false)
	{
    $transient_name = 'efrvs_social_channels';
    
    if ($clear) delete_transient($transient_name);
    
    $transient = get_transient($transient_name);

    if ( empty($transient) ) {

      $social_channels = array();
      $social_channels['social_logos'] = get_field('social_channels','option');
      
      set_transient($transient_name, $social_channels, WEEK_IN_SECONDS);

      $transient = $social_channels;
    }

    return $transient;
	}


	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	// CTA
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

	public function get_cta_meta($field)
	{
		if (!$field) return;

		$meta = $this->cta_options;

		if (!empty($meta[$field])) {
			return $meta[$field];
		}
	}

	
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	// FOOTER
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	
	public static function inject_footer()
	{
		
		// if ( is_front_page() || is_post_type_archive('efrvs_event') || is_singular('efrvs_event') ) {
			
			$eventbrite_modal_script = get_field('eventbrite_embed_code','option');

			if ($eventbrite_modal_script) {
				echo '<a href="javascript:void(0)" style="display:none" class="hidden-eventbrite-modal-link" ';
				echo 'id="eventbrite-widget-modal-trigger-' . trim(get_field('eventbrite_embed_id','option')) .'">';
				echo __('Buy Tickets', EFRVS_THEME_TDOMAIN).'</a>';
				echo '<!-- START: Eventbrite Modal Script -->';
				echo $eventbrite_modal_script;
				echo '<!-- END: Eventbrite Modal Script -->';
			}
		
		// }

	}

	public static function get_footer_menu()
	{
		$args = array(
			'menu'  			 		=> 'footer-menu',
			'menu_class' 	 		=> 'footer-menu',
			'menu_id'					=> 'footerMenu',
			'container'		 		=> false
		);

		wp_nav_menu($args);
	}

	public function has_footer_logos($logos=false)
	{

		if (!$logos) return;

		$footer_meta = $this->footer_options;

		if (empty($footer_meta)) return;

		switch ($logos) : 
			
			case 'sponsors':
				$logos = $footer_meta['sponsor_logos'];
				break;

			case 'beneficiaries':
				$logos = $footer_meta['beneficiary_logos'];
				break;

		endswitch;

		if ($logos) return true;
		 
	}

	public function get_footer_logos($logos=false)
	{

		if (!$logos) return;

		$footer_meta = $this->footer_options;
		
		if (empty($footer_meta)) return;

		switch ($logos) : 
			
			case 'sponsors':
				$logos = $footer_meta['sponsor_logos'];
				break;

			case 'beneficiaries':
				$logos = $footer_meta['beneficiary_logos'];
				break;

		endswitch;

		if ($logos) :

			echo '<ul class="footer-logos">';
			
			foreach ($logos as $logo) :

				$target = '_self';
				if ($logo['target']) $target = '_blank';

				echo '<li class="'.self::get_footer_logo_li_class($logo['size']).'">
					<a class="opacity-hover" href="'.$logo['url'].'" target="'.$target.'">
						<img src="'.$logo['logo']['sizes']['medium'].'" alt="'.$logo['logo']['alt'].'">
					</a>
				</li>';
			
			endforeach;
			
			echo '</ul>';

		endif;

	}

	public static function get_footer_logo_li_class($str=false)
	{
		if (!$str) return;

		switch ($str) :

			case '1':
				return 'full';
				break;

			case '1/2':
				return 'half';
				break;

			case '1/3':
				return 'one-third';
				break;

			case '2/3':
				return 'two-thirds';
				break;

		endswitch;

	}

	public function get_footer_subhead($subhead)
	{
		if (!$subhead) return;

		$footer_meta = $this->footer_options;
		
		if (empty($footer_meta)) return;

		switch ($subhead) : 
			
			case 'sponsors':
				return $footer_meta['sponsor_head'];
				break;

			case 'beneficiaries':
				return $footer_meta['beneficiary_head'];
				break;

		endswitch;

	}

}