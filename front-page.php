<?php
/**
 * Front page — every major section is a registered widget area
 * (see inc/widget-areas.php). Add a Custom HTML widget to a section's
 * area in Appearance > Widgets to override its copy; leave it empty to
 * keep the default design shown below.
 */
get_header();
?>

<!-- ================= HERO ================= -->
<?php svrgn_section( 'home-hero', function () { ?>
<section class="hero" id="hero">
  <div class="hero-video-wrap">
    <video class="hero-video" id="heroVideo" autoplay muted loop playsinline preload="auto">
      <source src="https://cdn.sanity.io/files/8nn8fua5/production/c6fb986a862cbe643c40cbdd0318ebc495efb187.mp4" type="video/mp4">
    </video>
  </div>
  <div class="hero-scrim"></div>
  <div class="hero-grain"></div>

  <button class="mute-toggle" id="muteToggle" type="button" aria-label="Unmute background video">
    <svg class="icon-on" viewBox="0 0 24 24"><path d="M4 9v6h4l5 5V4L8 9H4z"/><path d="M16.5 8.5a5 5 0 0 1 0 7"/></svg>
    <svg class="icon-off" viewBox="0 0 24 24"><path d="M4 9v6h4l5 5V4L8 9H4z"/><path d="M16 9l5 5M21 9l-5 5"/></svg>
  </button>

  <div class="hero-frame">
    <span class="hero-corner tr">Costa Mesa, CA · Est. Performance Studio</span>
    <span class="hero-corner bl">Strategy — Creative — Media — Data</span>
  </div>

  <div class="hero-inner">
    <div class="hero-eyebrow eyebrow">Boutique Creative-Performance Studio</div>
    <h1 class="hero-title">
      <span class="line"><span>BUILT TO SCALE.</span></span>
      <span class="line"><span class="accent-word">NOT STALL.</span></span>
    </h1>

    <div class="hero-foot">
      <p class="hero-sub">SVRGN Media is a boutique creative-performance studio for growth-stage ecommerce brands. We find what's actually holding growth back, then build the system to fix it.</p>
      <div class="hero-actions">
        <a href="#contact" class="btn btn-solid">
          Schedule a Strategy Call
          <?php echo svrgn_arrow_icon(); ?>
        </a>
        <a href="#system" class="btn btn-ghost">See How We Work</a>
      </div>
      <div class="hero-stats">
        <div class="hero-stat"><b data-count="40" data-suffix="%">0%</b><span>YoY Growth</span></div>
        <div class="hero-stat"><b data-count="10" data-suffix="x">0x</b><span>Blended ROAS</span></div>
        <div class="hero-stat"><b data-count="7" data-suffix="-Fig">0</b><span>Revenue Lift / 6mo</span></div>
      </div>
    </div>
  </div>

  <div class="scroll-cue"><span>Scroll</span><span class="bar"></span></div>
</section>
<?php } ); ?>

<!-- ================= PROBLEM ================= -->
<section class="section divider-top" id="problem">
  <div class="wrap">
    <?php svrgn_section( 'home-problem', function () { ?>
    <div class="head-row">
      <div>
        <div class="eyebrow">Why Growth Stalls</div>
        <h2>Most brands don't<br>have a traffic problem.</h2>
      </div>
      <p class="lead">They have a system problem. As spend increases, the cracks show up fast — and they compound.</p>
    </div>

    <div class="problem-grid">
      <ul class="problem-list" data-reveal-list>
        <li><b>01</b><p>Creative fatigues faster than it's replaced, so CPMs climb and CTR erodes.</p></li>
        <li><b>02</b><p>Media gets optimized in isolation from message — the ad and the offer stop agreeing.</p></li>
        <li><b>03</b><p>Funnels that worked at low volume become inefficient the moment spend scales.</p></li>
        <li><b>04</b><p>Budget gets spent re-testing the basics instead of compounding what already works.</p></li>
      </ul>
      <div class="problem-quote" data-clip-reveal>
        Scaling requires <span>a system</span> — not more ads.
      </div>
    </div>
    <?php } ); ?>
  </div>
</section>

<!-- ================= PIVOT / INSIGHT ================= -->
<section class="section divider-top" id="insight">
  <div class="wrap">
    <?php svrgn_section( 'home-insight', function () { ?>
    <div class="head-row">
      <div>
        <div class="eyebrow">Where It Actually Starts</div>
        <h2>You came for the ads.<br>You'll stay for the system.</h2>
      </div>
      <p class="lead">Most brands come to us to fix media. Once we're inside the account, the real constraint is usually upstream.</p>
    </div>

    <div class="pivot-grid" data-pivot-reveal>
      <div class="pivot-col" data-slide="left">
        <h4>What Brands Come To Us For</h4>
        <ul>
          <li><em>—</em>A stalled or declining ROAS</li>
          <li><em>—</em>Rising CPMs and CPCs</li>
          <li><em>—</em>Better Meta &amp; Google account management</li>
          <li><em>—</em>A launch that needs to convert</li>
        </ul>
      </div>
      <div class="pivot-col hot" data-slide="right">
        <h4>What We Usually Find</h4>
        <ul>
          <li><em>+</em>No repeatable content system behind the ads</li>
          <li><em>+</em>Creative that can't hold up as spend increases</li>
          <li><em>+</em>Funnel messaging disconnected from media</li>
          <li><em>+</em>A strategy layer missing beneath the spend</li>
        </ul>
      </div>
    </div>
    <?php } ); ?>
  </div>
</section>

<!-- ================= SYSTEM DIAGRAM ================= -->
<section class="section divider-top" id="system">
  <div class="wrap">
    <?php svrgn_section( 'home-system', function () { ?>
    <div class="head-row">
      <div>
        <div class="eyebrow">How We're Built</div>
        <h2>One system.<br>Not four vendors.</h2>
      </div>
      <p class="lead">Strategy, creative, media, and data don't operate in silos here. They're one connected loop — each stage feeding the next, so performance compounds instead of stalling.</p>
    </div>

    <div class="system-wrap">
      <div class="system-stage">
        <svg viewBox="0 0 900 540" id="systemSvg">
          <defs>
            <pattern id="circuitGrid" width="30" height="30" patternUnits="userSpaceOnUse">
              <circle cx="1" cy="1" r="1" fill="var(--line-strong)"/>
            </pattern>
            <filter id="neonGlow" x="-150%" y="-150%" width="400%" height="400%">
              <feGaussianBlur in="SourceGraphic" stdDeviation="2.5" result="blur"/>
              <feMerge>
                <feMergeNode in="blur"/>
                <feMergeNode in="SourceGraphic"/>
              </feMerge>
            </filter>
          </defs>

          <rect x="60" y="50" width="780" height="440" fill="url(#circuitGrid)" opacity=".5"/>

          <path class="sys-path" data-path="1" d="M 150 110 L 750 110" fill="none" stroke="var(--line-strong)" stroke-width="1.5"/>
          <path class="sys-path" data-path="2" d="M 750 110 L 750 430" fill="none" stroke="var(--line-strong)" stroke-width="1.5"/>
          <path class="sys-path" data-path="3" d="M 750 430 L 150 430" fill="none" stroke="var(--line-strong)" stroke-width="1.5"/>
          <path class="sys-path" data-path="4" d="M 150 430 L 150 110" fill="none" stroke="var(--line-strong)" stroke-width="1.5"/>
          <path id="pulsePath" d="M 150 110 L 750 110 L 750 430 L 150 430 L 150 110" fill="none" stroke="none"/>

          <path class="sys-chevron" d="M 444 104 L 456 110 L 444 116" />
          <path class="sys-chevron" d="M 744 264 L 750 276 L 756 264" />
          <path class="sys-chevron" d="M 456 436 L 444 430 L 456 424" />
          <path class="sys-chevron" d="M 156 276 L 150 264 L 144 276" />

          <g class="sys-node" data-node="1" transform="translate(150,110)">
            <circle class="node-halo" r="46"/>
            <circle r="42" fill="var(--ink)" stroke="var(--accent)" stroke-width="1.5"/>
            <text text-anchor="middle" y="-4" class="node-label" fill="var(--paper)">STRATEGY</text>
            <text text-anchor="middle" y="16" class="node-desc">Diagnosis &amp; roadmap</text>
          </g>
          <g class="sys-node" data-node="2" transform="translate(750,110)">
            <circle class="node-halo" r="46"/>
            <circle r="42" fill="var(--ink)" stroke="var(--accent)" stroke-width="1.5"/>
            <text text-anchor="middle" y="-4" class="node-label" fill="var(--paper)">CREATIVE</text>
            <text text-anchor="middle" y="16" class="node-desc">Concept &amp; production</text>
          </g>
          <g class="sys-node" data-node="3" transform="translate(750,430)">
            <circle class="node-halo" r="46"/>
            <circle r="42" fill="var(--ink)" stroke="var(--accent)" stroke-width="1.5"/>
            <text text-anchor="middle" y="-4" class="node-label" fill="var(--paper)">MEDIA</text>
            <text text-anchor="middle" y="16" class="node-desc">Meta · Google · YouTube</text>
          </g>
          <g class="sys-node" data-node="4" transform="translate(150,430)">
            <circle class="node-halo" r="46"/>
            <circle r="42" fill="var(--ink)" stroke="var(--accent)" stroke-width="1.5"/>
            <text text-anchor="middle" y="-4" class="node-label" fill="var(--paper)">DATA</text>
            <text text-anchor="middle" y="16" class="node-desc">Signal &amp; iteration</text>
          </g>

          <circle id="pulseDot" class="pulse-dot" r="5" fill="var(--accent)" filter="url(#neonGlow)"/>
          <circle id="pulseDot2" class="pulse-dot trail" r="3.4" fill="var(--accent-glow)"/>
          <circle id="pulseDot3" class="pulse-dot trail" r="2.2" fill="var(--paper)"/>
          <text x="450" y="278" text-anchor="middle" class="node-desc" fill="var(--stone)" font-size="11" letter-spacing="1.5">THE LOOP COMPOUNDS</text>
        </svg>
      </div>
    </div>
    <?php } ); ?>
  </div>
</section>

<!-- ================= WHAT WE DO ================= -->
<section class="section divider-top" id="work">
  <div class="wrap">
    <?php svrgn_section( 'home-work', function () { ?>
    <div class="head-row">
      <div>
        <div class="eyebrow">What We Do</div>
        <h2>Everything a growth<br>system needs.</h2>
      </div>
      <p class="lead">Under one roof, led by the same team — not handed between departments.</p>
    </div>
    <div class="pillar-grid" data-reveal-list>
      <div class="pillar">
        <span class="num">01</span>
        <h3>Strategy &amp; Diagnosis</h3>
        <p>Full-funnel account architecture, offer and positioning audits, and growth roadmaps built around where performance is actually breaking.</p>
      </div>
      <div class="pillar">
        <span class="num">02</span>
        <h3>Creative &amp; Production</h3>
        <p>Brand-forward, platform-native photo and video, engineered from data and funnel stage — not just what looks good in a deck.</p>
      </div>
      <div class="pillar">
        <span class="num">03</span>
        <h3>Paid Media</h3>
        <p>Meta, Google, and YouTube account management. Budget pacing, scaling methodology, and media planning led by creative, not guesswork.</p>
      </div>
      <div class="pillar">
        <span class="num">04</span>
        <h3>Content Systems</h3>
        <p>Repeatable content engines that keep creative fresh at scale, so output outruns fatigue instead of chasing it.</p>
      </div>
    </div>
    <?php } ); ?>
  </div>
</section>

<!-- ================= SELECTED WORK / PROJECTS (from Case Study CPT) ================= -->
<section class="section divider-top" id="projects">
  <div class="projects-bg-layer is-first" id="projBgA"></div>
  <div class="projects-bg-layer" id="projBgB"></div>
  <div class="wrap">
    <?php svrgn_section( 'home-projects-intro', function () { ?>
    <div class="head-row">
      <div>
        <div class="eyebrow">Selected Work</div>
        <h2>A few systems<br>we've built.</h2>
      </div>
      <p class="lead">A sample of engagements where strategy, creative, and media were built together — not bolted on after the fact.</p>
    </div>

    <?php
    $projects = new WP_Query( array(
      'post_type'      => 'project',
      'posts_per_page' => 6,
      'orderby'        => 'menu_order date',
      'order'          => 'ASC',
    ) );
    if ( $projects->have_posts() ) :
      $total = $projects->post_count;
      $i = 0;
    ?>
    <div class="gallery-pin" id="galleryPin">
      <div class="gallery-viewport" id="galleryViewport">
        <div class="gallery-track" id="galleryTrack" data-reveal-list>
          <?php while ( $projects->have_posts() ) : $projects->the_post(); $i++; ?>
          <a class="project-card" href="<?php the_permalink(); ?>" data-tilt>
            <div class="project-art">
              <div class="project-parallax">
                <?php if ( has_post_thumbnail() ) : ?>
                  <?php the_post_thumbnail( 'svrgn-card', array( 'class' => 'project-img', 'loading' => 'lazy' ) ); ?>
                <?php else : ?>
                  <img class="project-img" src="https://picsum.photos/seed/svrgn-<?php echo esc_attr( get_the_ID() ); ?>/800/1000" alt="<?php the_title_attribute(); ?>" loading="lazy">
                <?php endif; ?>
              </div>
              <div class="project-tint"></div>
            </div>
            <div class="project-content">
              <div class="project-top">
                <span class="project-index"><?php echo esc_html( svrgn_index_label( $i, $total ) ); ?></span>
                <span class="project-tag"><?php echo esc_html( get_post_meta( get_the_ID(), '_case_tag', true ) ); ?></span>
              </div>
              <div>
                <div class="project-title"><?php the_title(); ?></div>
                <p class="project-desc"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 22 ) ); ?></p>
                <span class="project-view">View Project
                  <?php echo svrgn_arrow_icon(); ?>
                </span>
              </div>
            </div>
          </a>
          <?php endwhile; wp_reset_postdata(); ?>
        </div>
      </div>

      <div class="gallery-meta">
        <span class="gallery-hint">
          Scroll to explore
          <svg viewBox="0 0 24 24"><path d="M4 12h16M14 6l6 6-6 6"/></svg>
        </span>
        <span class="gallery-count"><span id="galleryActive">01</span> / <span id="galleryTotal"><?php echo esc_html( str_pad( $total, 2, '0', STR_PAD_LEFT ) ); ?></span></span>
      </div>
      <div class="gallery-bar"><i id="galleryBarFill"></i></div>
    </div>

    <div class="see-more-wrap">
      <?php $case_studies_page = get_page_by_path( 'case-studies' ); ?>
      <a href="<?php echo esc_url( $case_studies_page ? get_permalink( $case_studies_page ) : home_url( '/case-studies/' ) ); ?>" class="see-more-btn" id="seeMoreBtn">
        <span class="see-more-fill"></span>
        <span class="see-more-label">See More Work</span>
        <span class="see-more-arrow">
          <?php echo svrgn_arrow_icon(); ?>
        </span>
      </a>
    </div>
    <?php else : ?>
      <p class="stone">Add Projects from the WP admin under "Projects" to populate this gallery.</p>
    <?php endif; ?>
    <?php } ); ?>
  </div>
</section>

<!-- ================= RESULTS (light) ================= -->
<section class="section light-section divider-top" id="results">
  <div class="wrap">
    <?php svrgn_section( 'home-results', function () { ?>
    <div class="head-row">
      <div>
        <div class="eyebrow">Results &amp; Impact</div>
        <h2>Proof, not promises.</h2>
      </div>
      <p class="lead">Our work is measured by outcomes, not activity — systems that hold up as spend increases.</p>
    </div>

    <div class="stat-row" data-reveal-list>
      <div class="stat-card"><div class="num"><span data-count="40" data-suffix="%">0%</span></div><p>Year-over-year growth for a DTC brand — a multi-million-dollar revenue increase in year one.</p></div>
      <div class="stat-card"><div class="num"><span data-count="10" data-suffix="x">0x</span></div><p>Blended ROAS achieved across Meta campaigns.</p></div>
      <div class="stat-card"><div class="num">7-Fig</div><p>Revenue lift delivered in six months for a growth-stage brand.</p></div>
    </div>

    <div class="case-grid" data-reveal-list>
      <div class="case-card" data-tilt>
        <div class="case-art">
          <div class="case-parallax">
            <img class="case-img" src="https://picsum.photos/seed/svrgn-eyewear/900/1200" alt="Placeholder creative — eyewear DTC campaign" loading="lazy">
          </div>
          <div class="case-tint"></div>
        </div>
        <div class="case-content">
          <span class="case-tag">Eyewear · DTC</span>
          <div>
            <div class="case-title">Greatness Within Reach</div>
            <div class="case-result">Creative system → doubled store performance</div>
          </div>
        </div>
      </div>
      <div class="case-card" data-tilt>
        <div class="case-art">
          <div class="case-parallax">
            <img class="case-img" src="https://picsum.photos/seed/svrgn-powersports/900/1200" alt="Placeholder creative — powersports D2C campaign" loading="lazy">
          </div>
          <div class="case-tint"></div>
        </div>
        <div class="case-content">
          <span class="case-tag">Powersports · D2C</span>
          <div>
            <div class="case-title">Dominate, Don't Decorate</div>
            <div class="case-result">Reduced CPMs while lifting conversion efficiency</div>
          </div>
        </div>
      </div>
      <div class="case-card" data-tilt>
        <div class="case-art">
          <div class="case-parallax">
            <img class="case-img" src="https://picsum.photos/seed/svrgn-apparel/900/1200" alt="Placeholder creative — apparel sitewide campaign" loading="lazy">
          </div>
          <div class="case-tint"></div>
        </div>
        <div class="case-content">
          <span class="case-tag">Apparel · Sitewide</span>
          <div>
            <div class="case-title">Black Friday, 15% Off</div>
            <div class="case-result">7-figure revenue lift in 6 months</div>
          </div>
        </div>
      </div>
      <div class="case-card" data-tilt>
        <div class="case-art">
          <div class="case-parallax">
            <img class="case-img" src="https://picsum.photos/seed/svrgn-sport/900/1200" alt="Placeholder creative — sport performance campaign" loading="lazy">
          </div>
          <div class="case-tint"></div>
        </div>
        <div class="case-content">
          <span class="case-tag">Sport · Performance</span>
          <div>
            <div class="case-title">Rival</div>
            <div class="case-result">10x blended ROAS across Meta</div>
          </div>
        </div>
      </div>
    </div>
    <?php } ); ?>
  </div>
</section>

<!-- ================= FIT ================= -->
<section class="section divider-top" id="fit">
  <div class="wrap">
    <?php svrgn_section( 'home-fit', function () { ?>
    <div class="head-row">
      <div>
        <div class="eyebrow">Who We Work With</div>
        <h2>Built for brands<br>ready to scale.</h2>
      </div>
      <p class="lead">SVRGN partners with product-forward, growth-stage ecommerce brands serious about turning paid media into a predictable revenue engine.</p>
    </div>

    <div class="fit-grid" data-reveal-list>
      <div class="fit-card">
        <div class="fit-icon">
          <svg viewBox="0 0 24 24"><path d="M12 2 L20 6 V12 C20 17 16.5 20.5 12 22 C7.5 20.5 4 17 4 12 V6 Z"/><path d="M8.5 12 L11 14.5 L16 9"/></svg>
        </div>
        <p>Established product-market fit</p>
      </div>
      <div class="fit-card">
        <div class="fit-icon">
          <svg viewBox="0 0 24 24"><path d="M3 17 L9 11 L13 15 L21 6"/><path d="M15 6 H21 V12"/></svg>
        </div>
        <p>Active paid media spend with intent to scale</p>
      </div>
      <div class="fit-card">
        <div class="fit-icon">
          <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="5"/><circle cx="12" cy="12" r="1.2" fill="currentColor" stroke="none"/><path d="M12 2 V5 M12 19 V22 M2 12 H5 M19 12 H22"/></svg>
        </div>
        <p>Clear growth goals and a long-term mindset</p>
      </div>
      <div class="fit-card">
        <div class="fit-icon">
          <svg viewBox="0 0 24 24"><path d="M12 2 L14 9 L21 9 L15.5 13.5 L17.5 21 L12 16.5 L6.5 21 L8.5 13.5 L3 9 L10 9 Z"/></svg>
        </div>
        <p>Willingness to invest in creative and strategy</p>
      </div>
    </div>

    <div class="logo-marquee-wrap">
      <div class="logo-marquee-label">Across categories we've built for</div>
      <div class="logo-marquee">
        <div class="logo-track">
          <span class="logo-item">Ridgeline Optics</span><span class="logo-sep"></span>
          <span class="logo-item">Ironclad Moto</span><span class="logo-sep"></span>
          <span class="logo-item">Northfield Apparel</span><span class="logo-sep"></span>
          <span class="logo-item">Rival Athletics</span><span class="logo-sep"></span>
          <span class="logo-item">Carve &amp; Co.</span><span class="logo-sep"></span>
          <span class="logo-item">Roller Culture</span><span class="logo-sep"></span>
          <span class="logo-item" aria-hidden="true">Ridgeline Optics</span><span class="logo-sep" aria-hidden="true"></span>
          <span class="logo-item" aria-hidden="true">Ironclad Moto</span><span class="logo-sep" aria-hidden="true"></span>
          <span class="logo-item" aria-hidden="true">Northfield Apparel</span><span class="logo-sep" aria-hidden="true"></span>
          <span class="logo-item" aria-hidden="true">Rival Athletics</span><span class="logo-sep" aria-hidden="true"></span>
          <span class="logo-item" aria-hidden="true">Carve &amp; Co.</span><span class="logo-sep" aria-hidden="true"></span>
          <span class="logo-item" aria-hidden="true">Roller Culture</span><span class="logo-sep" aria-hidden="true"></span>
        </div>
      </div>
    </div>
    <?php } ); ?>
  </div>
</section>

<!-- ================= ENGAGE ================= -->
<section class="section divider-top" id="engage">
  <div class="wrap">
    <?php svrgn_section( 'home-engage', function () { ?>
    <div class="head-row">
      <div>
        <div class="eyebrow">How We Work Together</div>
        <h2>Engagements designed<br>for growth.</h2>
      </div>
      <p class="lead">Flexible models built for brands at different stages — from strategic direction to full-scale execution.</p>
    </div>

    <div class="engage-list" data-reveal-list>
      <div class="engage-item">
        <span class="engage-mark">A</span>
        <h3>Ongoing Performance Creative &amp; Paid Media</h3>
        <p>Integrated creative and media execution focused on scalable, profitable growth.</p>
      </div>
      <div class="engage-item">
        <span class="engage-mark">B</span>
        <h3>Fractional Paid Media Leadership</h3>
        <p>Senior-level strategic oversight for brands that need experienced guidance without a full-time hire.</p>
      </div>
      <div class="engage-item">
        <span class="engage-mark">C</span>
        <h3>Strategy Intensives &amp; Workshops</h3>
        <p>Focused sessions designed to diagnose performance, define direction, and align teams around a clear roadmap.</p>
      </div>
    </div>
    <?php } ); ?>
  </div>
</section>

<!-- ================= DIFFERENT ================= -->
<section class="section divider-top" id="different">
  <div class="wrap">
    <?php svrgn_section( 'home-different', function () { ?>
    <div class="head-row">
      <div>
        <div class="eyebrow">Built Different, By Design</div>
        <h2>What makes SVRGN<br>different.</h2>
      </div>
      <p class="lead">A senior-led, boutique studio. Clients work directly with strategists — not a revolving door of account managers.</p>
    </div>

    <div class="diff-grid">
      <p class="stone" data-reveal style="font-size:1.05rem;line-height:1.7;max-width:44ch;">We believe trust is built through consistency and follow-through. What we commit to is what we deliver — no bait-and-switch, no inflated promises. This is how performance compounds.</p>
      <ul class="diff-list" data-reveal-list>
        <li><b>01</b>Creative and paid media under one roof</li>
        <li><b>02</b>Performance-led creative direction, informed by data</li>
        <li><b>03</b>Full-funnel strategy, not isolated campaign optimization</li>
        <li><b>04</b>Senior-level oversight on every engagement</li>
        <li><b>05</b>Systems built to scale — not stall</li>
      </ul>
    </div>
    <?php } ); ?>
  </div>
</section>

<!-- ================= CONTACT ================= -->
<section class="section divider-top contact" id="contact">
  <div class="wrap">
    <?php svrgn_section( 'home-contact', function () { ?>
    <div class="eyebrow" data-reveal>Let's Build a System That Scales</div>
    <h2 class="contact-title" data-reveal>LET'S TALK</h2>

    <div class="contact-grid">
      <p class="hero-sub" style="max-width:46ch;font-size:1.1rem;" data-reveal>If you're a growth-stage ecommerce brand looking to turn paid media into a predictable revenue engine, we'd love to explore whether SVRGN is the right partner. Clarity first. Execution follows.</p>
      <div>
        <a href="mailto:andyg@svrgnmedia.com" class="btn btn-solid" style="margin-bottom:2rem;">
          Schedule a Strategy Call
          <?php echo svrgn_arrow_icon(); ?>
        </a>
        <div class="contact-rows">
          <div class="contact-row"><span>Website</span><a href="https://svrgnmedia.com" target="_blank" rel="noopener">svrgnmedia.com <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M6 18L18 6M18 6H9M18 6V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></a></div>
          <div class="contact-row"><span>Email</span><a href="mailto:andyg@svrgnmedia.com">andyg@svrgnmedia.com</a></div>
          <div class="contact-row"><span>Location</span><span>Costa Mesa, CA</span></div>
        </div>
      </div>
    </div>
    <?php } ); ?>
  </div>
</section>

<?php get_footer(); ?>
