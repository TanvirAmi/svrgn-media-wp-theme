<?php
/**
 * Single Service. Mirrors single-case_study.php styling.
 */
get_header();
while ( have_posts() ) : the_post();
	$includes = get_post_meta( get_the_ID(), '_case_includes', true );
	$includes_arr = $includes ? array_filter( array_map( 'trim', explode( "\n", $includes ) ) ) : array();
?>

<section class="cs-hero">
  <div class="wrap">
    <?php $archive_page = get_page_by_path( 'services' ); ?>
    <a href="<?php echo esc_url( $archive_page ? get_permalink( $archive_page ) : home_url( '/services/' ) ); ?>" class="cs-back">
      <?php echo svrgn_arrow_icon(); ?>
      Back to services
    </a>
    <div class="cs-hero-row">
      <div>
        <div class="eyebrow"><?php echo esc_html( get_post_meta( get_the_ID(), '_case_tag', true ) ?: 'Service' ); ?></div>
        <h1 class="cs-title"><?php the_title(); ?></h1>
      </div>
      <div>
        <p class="cs-lead"><?php echo esc_html( get_the_excerpt() ); ?></p>
        <?php if ( ! empty( $includes_arr ) ) : ?>
        <div class="cs-hero-stats">
          <?php foreach ( array_slice( $includes_arr, 0, 3 ) as $item ) : ?>
            <div class="cs-stat" style="min-width:0;"><span><?php echo esc_html( $item ); ?></span></div>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="wrap" style="padding-block:2rem 5rem;max-width:92ch;">
    <?php if ( has_post_thumbnail() ) : ?>
      <div style="margin-bottom:2.5rem;border-radius:.5rem;overflow:hidden;">
        <?php the_post_thumbnail( 'large', array( 'style' => 'width:100%;height:auto;display:block;' ) ); ?>
      </div>
    <?php endif; ?>
    <div class="case-study-body">
      <?php the_content(); ?>
    </div>
  </div>
</section>

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

<?php endwhile; get_footer(); ?>
