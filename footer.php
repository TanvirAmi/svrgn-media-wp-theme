<footer>
  <div class="wrap" style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:1rem;">
    <span><?php echo esc_html( svrgn_footer_copyright_text() ); ?></span>

    <?php if ( has_nav_menu( 'footer' ) ) : ?>
      <?php
      wp_nav_menu( array(
        'theme_location'  => 'footer',
        'container'       => 'nav',
        'container_class' => 'footer-nav',
        'menu_class'      => 'footer-nav-menu',
        'depth'           => 1,
      ) );
      ?>
    <?php else : ?>
      <span><?php echo esc_html( get_theme_mod( 'svrgn_footer_tagline', 'Strategy / Creative / Media / Data' ) ); ?></span>
    <?php endif; ?>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
