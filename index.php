<?php
/**
 * Fallback template (required by WP). Front page uses front-page.php;
 * case studies / services use their CPT + page templates. This only
 * renders for anything else (e.g. default blog posts, if ever used).
 */
get_header();
?>
<section class="cs-hero">
  <div class="wrap">
    <div class="cs-hero-row">
      <div>
        <div class="eyebrow"><?php is_home() ? _e( 'Journal' ) : ''; ?></div>
        <h1 class="cs-title"><?php wp_title( '' ); ?></h1>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="wrap" style="padding-block:2rem 5rem;max-width:92ch;">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <article <?php post_class(); ?> style="margin-bottom:3rem;">
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <div><?php the_excerpt(); ?></div>
      </article>
    <?php endwhile; else : ?>
      <p class="stone">Nothing found.</p>
    <?php endif; ?>
  </div>
</section>
<?php get_footer(); ?>
