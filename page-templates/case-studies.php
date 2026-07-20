<?php
/**
 * Template Name: Case Studies
 * Lists all Case Study CPT entries using the original case-row markup.
 * The intro (cs-hero) and closing CTA (cs-cta) come from the page's own
 * content editor / Customizer-free defaults below, so you can still edit
 * the page title & lead via the normal WP editor if you want — otherwise
 * the defaults from the original design are shown.
 */
get_header();

$case_studies = new WP_Query( array(
	'post_type'      => 'case_study',
	'posts_per_page' => -1,
	'orderby'        => 'menu_order date',
	'order'          => 'ASC',
) );
$total = $case_studies->post_count;
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
        <div class="eyebrow">Selected Work</div>
        <h1 class="cs-title"><?php echo wp_kses_post( get_the_title() ?: 'Case<br>Studies' ); ?></h1>
      </div>
      <div>
        <?php if ( get_the_content() ) : ?>
          <div class="cs-lead"><?php the_content(); ?></div>
        <?php else : ?>
          <p class="cs-lead">A closer look at engagements where strategy, creative, and media were built together as one system — not bolted on after the fact.</p>
        <?php endif; ?>
        <div class="cs-hero-stats">
          <div class="cs-stat"><b>40%</b><span>YoY Growth</span></div>
          <div class="cs-stat"><b>10x</b><span>Blended ROAS</span></div>
          <div class="cs-stat"><b><?php echo esc_html( str_pad( $total, 2, '0', STR_PAD_LEFT ) ); ?></b><span>Featured Cases</span></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ================= CASE LIST ================= -->
<section>
  <div class="wrap">
    <?php if ( $case_studies->have_posts() ) : $i = 0; ?>
    <div class="case-list" data-reveal-list>
      <?php while ( $case_studies->have_posts() ) : $case_studies->the_post(); $i++; ?>
      <a class="case-row" href="<?php the_permalink(); ?>">
        <div class="case-content">
          <div class="case-meta-row">
            <span class="case-index"><?php echo esc_html( svrgn_index_label( $i, $total ) ); ?></span>
            <span class="case-tag"><?php echo esc_html( get_post_meta( get_the_ID(), '_case_tag', true ) ); ?></span>
          </div>
          <h2 class="case-title"><?php the_title(); ?></h2>
          <p class="case-desc"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 26 ) ); ?></p>
          <div class="case-foot">
            <span class="case-date"><b>Date</b><?php echo esc_html( get_the_date() ); ?></span>
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
      <p class="stone">No case studies yet. Add some from the WP admin under "Case Studies".</p>
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
