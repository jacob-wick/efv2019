<li class="media-list-item">
  
  <?php

    $pubs = wp_get_post_terms(get_the_ID(), 'efrvs_publication');
    $pub = false;

    if ($pubs && is_array($pubs)) {
      $pub = $pubs[0]->name;
    }

    $url = get_field('news_outbound_url', get_the_ID());

  ?>

  <div class="media-list-item__image">
    <a href="<?php esc_attr_e($url); ?>" target="_blank" class="opacity-hover block">
      <?php if ( has_post_thumbnail() ) the_post_thumbnail('medium', ['class' => 'responsive-image']); ?>
    </a>
  </div>

  <div class="media-list-item__text">
    <h3 class="h4-sans mb-1"><a class="opacity-hover" href="<?php esc_attr_e($url); ?>" target="_blank"><?php the_title(); ?></a></h3>
    
    <div class="wysiwyg wysiwyg--sans mb-1">
      <?php the_excerpt(); ?>
    </div>
    
    <p class="p-sans">
      <?php the_time("F d, Y"); ?>
    </p>
    
    <?php if ($pub) : ?>
      <p class="p-sans mb-1">
        <?php echo $pub; ?>
      </p>
    <?php endif; ?>

</div>

</li>