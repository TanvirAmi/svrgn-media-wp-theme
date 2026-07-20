<?php
/**
 * Generic page fallback. About/Contact use their own page-{slug}.php,
 * Case Studies/Services use their explicit page-templates. Any other
 * WP Page falls back here with the cs-hero / content chrome.
 */
get_header();
while ( have_posts() ) : the_post();
?>
<section class="cs-hero">
  <div class="wrap">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="cs-back">
      <?php echo svrgn_arrow_icon(); ?>
      Back to home
    </a>
    <div class="cs-hero-row">
      <div>
        <div class="eyebrow">SVRGN Media</div>
        <h1 class="cs-title"><?php the_title(); ?></h1>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="wrap" style="padding-block:2rem 5rem;max-width:92ch;">
    <?php the_content(); ?>
  </div>
</section>
<?php endwhile; get_footer(); ?>
