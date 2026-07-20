<?php
/**
 * Template Name: Services
 * Lists all Service CPT entries using the original case-row markup
 * (services reuse the same card style as case studies, with an
 * "Includes" list instead of a date).
 */
get_header();

$services = new WP_Query( array(
	'post_type'      => 'service',
	'posts_per_page' => -1,
	'orderby'        => 'menu_order date',
	'order'          => 'ASC',
) );
$total = $services->post_count;
?>

<!-- ================= INTRO ================= -->
<section class="cs-hero">
  <div class="wrap">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="cs-back">
      <?php echo svrgn_arrow_icon(); ?>
      Back to home
    </a>
    <div class="cs-hero-row">
      <div>
        <div class="eyebrow">What We Do</div>
        <h1 class="cs-title"><?php echo wp_kses_post( get_the_title() ?: 'Our<br>Services' ); ?></h1>
      </div>
      <div>
        <?php if ( get_the_content() ) : ?>
          <div class="cs-lead"><?php the_content(); ?></div>
        <?php else : ?>
          <p class="cs-lead">Strategy, creative, media, and data — built as one connected system, not four separate vendors. Here's everything that system includes.</p>
        <?php endif; ?>
        <div class="cs-hero-stats">
          <div class="cs-stat"><b><?php echo esc_html( str_pad( $total, 2, '0', STR_PAD_LEFT ) ); ?></b><span>Core Services</span></div>
          <div class="cs-stat"><b>1</b><span>Connected System</span></div>
          <div class="cs-stat"><b>100%</b><span>Senior-Led</span></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ================= SCROLLING TEXT BAND ================= -->
<div class="svc-marquee-wrap">
  <div class="svc-marquee-track">
    <span class="svc-marquee-item is-filled">Strategy</span>
    <span class="svc-marquee-dot"></span>
    <span class="svc-marquee-item">Creative</span>
    <span class="svc-marquee-dot"></span>
    <span class="svc-marquee-item is-filled">Paid Media</span>
    <span class="svc-marquee-dot"></span>
    <span class="svc-marquee-item">Data</span>
    <span class="svc-marquee-dot"></span>
    <span class="svc-marquee-item is-filled">Production</span>
    <span class="svc-marquee-dot"></span>
    <span class="svc-marquee-item" aria-hidden="true">Strategy</span>
    <span class="svc-marquee-dot" aria-hidden="true"></span>
    <span class="svc-marquee-item is-filled" aria-hidden="true">Creative</span>
    <span class="svc-marquee-dot" aria-hidden="true"></span>
    <span class="svc-marquee-item" aria-hidden="true">Paid Media</span>
    <span class="svc-marquee-dot" aria-hidden="true"></span>
    <span class="svc-marquee-item is-filled" aria-hidden="true">Data</span>
    <span class="svc-marquee-dot" aria-hidden="true"></span>
    <span class="svc-marquee-item" aria-hidden="true">Production</span>
    <span class="svc-marquee-dot" aria-hidden="true"></span>
  </div>
</div>

<!-- ================= SERVICE LIST ================= -->
<section>
  <div class="wrap">
    <?php if ( $services->have_posts() ) : $i = 0; ?>
    <div class="case-list" data-reveal-list>
      <?php while ( $services->have_posts() ) : $services->the_post(); $i++;
        $includes = get_post_meta( get_the_ID(), '_case_includes', true );
        $includes_arr = $includes ? array_filter( array_map( 'trim', explode( "\n", $includes ) ) ) : array();
      ?>
      <a class="case-row" href="<?php the_permalink(); ?>">
        <div class="case-content">
          <div class="case-meta-row">
            <span class="case-index"><?php echo esc_html( svrgn_index_label( $i, $total ) ); ?></span>
            <span class="case-tag"><?php echo esc_html( get_post_meta( get_the_ID(), '_case_tag', true ) ); ?></span>
          </div>
          <h2 class="case-title"><?php the_title(); ?></h2>
          <p class="case-desc"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 26 ) ); ?></p>
          <div class="case-foot">
            <?php if ( ! empty( $includes_arr ) ) : ?>
            <span class="case-includes">
              <b>Includes</b>
              <?php foreach ( $includes_arr as $item ) : ?>
                <span><?php echo esc_html( $item ); ?></span>
              <?php endforeach; ?>
            </span>
            <?php endif; ?>
            <span class="case-arrow"><?php echo svrgn_arrow_icon(); ?></span>
          </div>
        </div>
        <div class="case-media">
          <div class="case-media-parallax">
            <?php if ( has_post_thumbnail() ) : ?>
              <?php the_post_thumbnail( 'svrgn-card', array( 'class' => 'case-img', 'loading' => 'lazy' ) ); ?>
            <?php else : ?>
              <img class="case-img" src="https://picsum.photos/seed/svrgn-<?php echo esc_attr( get_the_ID() ); ?>/900/1100" alt="<?php the_title_attribute(); ?>" loading="lazy">
            <?php endif; ?>
          </div>
          <div class="case-media-tint"></div>
          <span class="case-badge"><?php echo svrgn_arrow_icon(); ?></span>
        </div>
      </a>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>
    <?php else : ?>
      <p class="stone">No services yet. Add some from the WP admin under "Services".</p>
    <?php endif; ?>
  </div>
</section>

<!-- ================= CLOSING CTA ================= -->
<section class="cs-cta">
  <div class="wrap">
    <div class="eyebrow" style="justify-content:center;">Let's Build Yours</div>
    <h2>Ready to build<br>your system?</h2>
    <p>If you're a growth-stage ecommerce brand looking to turn paid media into a predictable revenue engine, let's talk.</p>
    <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="btn btn-solid">
      Schedule a Strategy Call
      <?php echo svrgn_arrow_icon(); ?>
    </a>
  </div>
</section>

<?php get_footer(); ?>
