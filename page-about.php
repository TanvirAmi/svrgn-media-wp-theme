<?php
/**
 * Template for the page with slug "about".
 * Every section is a widget area — manage all copy from
 * Appearance > Widgets. Defaults below match the original design.
 */
get_header();
?>

<section class="cs-hero">
  <div class="wrap">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="cs-back">
      <?php echo svrgn_arrow_icon(); ?>
      Back to home
    </a>
    <?php svrgn_section( 'about-hero', function () { ?>
    <div class="cs-hero-row">
      <div>
        <div class="eyebrow">About SVRGN</div>
        <h1 class="cs-title">We Are<br>SVRGN</h1>
      </div>
      <div>
        <p class="cs-lead">A boutique creative-performance studio, built by people who've sat on both sides of the table — inside brands and inside agencies.</p>
        <div class="cs-hero-stats">
          <div class="cs-stat"><b>12+</b><span>Years Combined</span></div>
          <div class="cs-stat"><b>3</b><span>Person Core Team</span></div>
          <div class="cs-stat"><b>6+</b><span>Categories Served</span></div>
        </div>
      </div>
    </div>
    <?php } ); ?>
  </div>
</section>

<!-- ================= STORY / PHILOSOPHY ================= -->
<section class="about-story">
  <div class="wrap">
    <?php svrgn_section( 'about-story', function () { ?>
    <div class="split-head">
      <div class="split-head-row">
        <div>
          <div class="eyebrow">How We Think</div>
          <h2>Small on purpose.</h2>
        </div>
        <p class="lead">SVRGN stays intentionally small. Every account gets senior attention, not a rotating cast of coordinators.</p>
      </div>
    </div>
    <div class="story-grid">
      <div class="story-body">
        <p>We started SVRGN because we kept seeing the same pattern: brands hiring a media buyer here, a video editor there, a strategist somewhere else — and wondering why nothing compounded.</p>
        <p>We'd rather do fewer things well than everything adequately. That means staying boutique by choice, not by accident, and turning away work that doesn't fit rather than diluting the system that makes SVRGN work in the first place.</p>
      </div>
      <div class="story-quote" data-reveal>
        Creative without strategy doesn't scale. <span>Strategy without creative doesn't convert.</span>
      </div>
    </div>
    <?php } ); ?>
  </div>
</section>

<!-- ================= TEAM ================= -->
<section class="about-team">
  <div class="wrap">
    <?php svrgn_section( 'about-team', function () { ?>
    <div class="split-head">
      <div class="split-head-row">
        <div>
          <div class="eyebrow">The Team</div>
          <h2>Three people.<br>One system.</h2>
        </div>
        <p class="lead">No account managers, no hand-offs. You work directly with the people doing the work.</p>
      </div>
    </div>

    <div class="team-grid" data-reveal-list>

      <a class="team-card" href="<?php echo esc_url( home_url( '/#contact' ) ); ?>">
        <img class="team-img" src="<?php echo esc_url( SVRGN_URI . '/assets/img/placeholder-team-1.jpg' ); ?>" alt="Andy Griffin — Founder and Creative Director">
        <div class="team-tint"></div>
        <div class="team-scrim"></div>
        <div class="team-content">
          <div class="team-top">
            <span class="team-index">01</span>
            <span class="team-role">Founder — Creative Director</span>
          </div>
          <div>
            <div class="team-name">Andy Griffin</div>
            <p class="team-bio">15+ years building brand-forward creative systems for growth-stage ecommerce. Leads strategy and creative direction on every account.</p>
            <div class="team-social">
              <span aria-label="LinkedIn"><svg viewBox="0 0 24 24" fill="none"><path d="M4 4h16v16H4z" stroke="none"/><path d="M6.5 9.5v8M6.5 6.5v.01M11 17.5v-5c0-1.4 1-2.5 2.5-2.5S16 11 16 12.5v5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
              <span aria-label="Email"><svg viewBox="0 0 24 24" fill="none"><path d="M4 6h16v12H4z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><path d="M4 7l8 6 8-6" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg></span>
            </div>
          </div>
        </div>
      </a>

      <a class="team-card" href="<?php echo esc_url( home_url( '/#contact' ) ); ?>">
        <img class="team-img" src="<?php echo esc_url( SVRGN_URI . '/assets/img/placeholder-team-2.jpg' ); ?>" alt="Priya Nataraj — Head of Paid Media">
        <div class="team-tint"></div>
        <div class="team-scrim"></div>
        <div class="team-content">
          <div class="team-top">
            <span class="team-index">02</span>
            <span class="team-role">Head of Paid Media</span>
          </div>
          <div>
            <div class="team-name">Priya Nataraj</div>
            <p class="team-bio">Former in-house media lead turned fractional partner. Runs Meta, Google, and YouTube spend across the roster.</p>
            <div class="team-social">
              <span aria-label="LinkedIn"><svg viewBox="0 0 24 24" fill="none"><path d="M4 4h16v16H4z" stroke="none"/><path d="M6.5 9.5v8M6.5 6.5v.01M11 17.5v-5c0-1.4 1-2.5 2.5-2.5S16 11 16 12.5v5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
              <span aria-label="Email"><svg viewBox="0 0 24 24" fill="none"><path d="M4 6h16v12H4z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><path d="M4 7l8 6 8-6" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg></span>
            </div>
          </div>
        </div>
      </a>

      <a class="team-card" href="<?php echo esc_url( home_url( '/#contact' ) ); ?>">
        <img class="team-img" src="<?php echo esc_url( SVRGN_URI . '/assets/img/placeholder-team-3.jpg' ); ?>" alt="Jordan Cole — Creative Producer">
        <div class="team-tint"></div>
        <div class="team-scrim"></div>
        <div class="team-content">
          <div class="team-top">
            <span class="team-index">03</span>
            <span class="team-role">Creative Producer</span>
          </div>
          <div>
            <div class="team-name">Jordan Cole</div>
            <p class="team-bio">Directs photo and video from concept to cut, keeping every shoot tied back to what the data says will convert.</p>
            <div class="team-social">
              <span aria-label="LinkedIn"><svg viewBox="0 0 24 24" fill="none"><path d="M4 4h16v16H4z" stroke="none"/><path d="M6.5 9.5v8M6.5 6.5v.01M11 17.5v-5c0-1.4 1-2.5 2.5-2.5S16 11 16 12.5v5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
              <span aria-label="Email"><svg viewBox="0 0 24 24" fill="none"><path d="M4 6h16v12H4z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><path d="M4 7l8 6 8-6" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg></span>
            </div>
          </div>
        </div>
      </a>

    </div>
    <?php } ); ?>
  </div>
</section>

<!-- ================= VALUES ================= -->
<section class="about-values">
  <div class="wrap">
    <?php svrgn_section( 'about-values', function () { ?>
    <div class="split-head">
      <div class="split-head-row">
        <div>
          <div class="eyebrow">How We Operate</div>
          <h2>Built different,<br>by design.</h2>
        </div>
        <p class="lead">A few things that don't change no matter how big the account gets.</p>
      </div>
    </div>

    <div class="values-list" data-reveal-list>
      <div class="value-item">
        <span class="value-mark">A</span>
        <h3>Senior-Led</h3>
        <p>You talk directly to the people doing the work, every time — not a rotating cast of account managers.</p>
      </div>
      <div class="value-item">
        <span class="value-mark">B</span>
        <h3>Boutique by Choice</h3>
        <p>We stay small on purpose, not because we can't grow. It's what lets every account get real attention.</p>
      </div>
      <div class="value-item">
        <span class="value-mark">C</span>
        <h3>Systems, Not Stunts</h3>
        <p>Every deliverable ties back to the system behind it — not a one-off win that doesn't repeat.</p>
      </div>
    </div>
    <?php } ); ?>
  </div>
</section>

<!-- ================= CLOSING CTA ================= -->
<section class="cs-cta">
  <div class="wrap">
    <?php svrgn_section( 'about-cta', function () { ?>
    <div class="eyebrow" style="justify-content:center;">Let's Build Yours</div>
    <h2>Ready to build<br>your system?</h2>
    <p>If you're a growth-stage ecommerce brand looking to turn paid media into a predictable revenue engine, let's talk.</p>
    <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="btn btn-solid">
      Schedule a Strategy Call
      <?php echo svrgn_arrow_icon(); ?>
    </a>
    <?php } ); ?>
  </div>
</section>

<?php get_footer(); ?>
