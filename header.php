<!DOCTYPE html>
<html lang="<?php echo esc_attr( get_bloginfo( 'language' ) ); ?>">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php if ( is_singular() && get_the_excerpt() ) : ?>
<meta name="description" content="<?php echo esc_attr( wp_strip_all_tags( get_the_excerpt() ) ); ?>">
<?php endif; ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Anton&family=Archivo:ital,wght@0,400;0,500;0,600;0,700;0,800;1,500&family=IBM+Plex+Mono:wght@400;500;600&display=swap" rel="stylesheet">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php if ( is_front_page() ) : ?>
<div class="progress-bar"><i id="progressFill"></i></div>
<?php endif; ?>

<header id="siteHeader">
  <div class="wrap nav">

    <?php if ( has_custom_logo() ) : ?>
      <?php the_custom_logo(); ?>
    <?php else : ?>
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
        <span class="checker"><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i></span>
        <span class="logo-text"><span><?php echo esc_html( get_theme_mod( 'svrgn_logo_text_sub', 'Media / Performance Creative' ) ); ?></span></span>
      </a>
    <?php endif; ?>

    <nav class="nav-links" id="siteNavLinks">
      <?php if ( has_nav_menu( 'primary' ) ) : ?>
        <?php
        wp_nav_menu( array(
          'theme_location' => 'primary',
          'container'      => false,
          'items_wrap'     => '%3$s',
          'depth'          => 0, // 0 = unlimited, so child/dropdown menu items render
        ) );
        ?>
      <?php else : ?>
        <a href="<?php echo esc_url( home_url( '/#work' ) ); ?>">Work</a>
        <a href="<?php echo esc_url( home_url( '/#projects' ) ); ?>">Projects</a>
        <a href="<?php echo esc_url( home_url( '/#results' ) ); ?>">Results</a>
        <a href="<?php echo esc_url( home_url( '/#engage' ) ); ?>">Approach</a>
        <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>">Contact</a>
      <?php endif; ?>

      <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="btn btn-solid nav-mobile-cta">
        Book a Call
        <?php echo svrgn_arrow_icon(); ?>
      </a>
    </nav>

    <button class="hamburger-btn" id="mobileMenuToggle" type="button" aria-label="Toggle menu" aria-expanded="false" aria-controls="siteNavLinks">
      <span></span><span></span><span></span>
    </button>

    <div class="nav-cta">
      <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="btn btn-solid">
        Book a Call
        <?php echo svrgn_arrow_icon(); ?>
      </a>
    </div>
  </div>

  <div class="mobile-nav-scrim" id="mobileNavScrim"></div>
</header>
