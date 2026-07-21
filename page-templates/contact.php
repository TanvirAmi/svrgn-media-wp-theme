<?php
/**
 * Template Name: Contact
 *
 * Selectable via Page Attributes → Template, so you're not tied to the
 * page slug being "contact". 4 sections are widget areas; the form
 * itself stays coded (functional AJAX submit via inc/contact-form.php)
 * since it collects data rather than displaying content.
 *
 * Widget areas used here: contact-hero, contact-info, contact-process,
 * contact-cta.
 */
get_header();
?>

<!-- ================= 1. HERO ================= -->
<section class="cs-hero">
  <div class="wrap">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="cs-back">
      <?php echo svrgn_arrow_icon(); ?>
      Back to home
    </a>
    <?php svrgn_section( 'contact-hero', function () { ?>
    <div class="cs-hero-row">
      <div>
        <div class="eyebrow">Get In Touch</div>
        <h1 class="cs-title">Let's<br>Talk</h1>
      </div>
      <div>
        <p class="cs-lead">Tell us where growth is stalling, and we'll tell you honestly whether SVRGN is the right partner to fix it. No pitch decks, no fluff — just a straight conversation.</p>
        <div class="cs-hero-stats">
          <div class="cs-stat"><b>&lt;24h</b><span>Response Time</span></div>
          <div class="cs-stat"><b>Free</b><span>Strategy Call</span></div>
          <div class="cs-stat"><b>CA</b><span>Costa Mesa Based</span></div>
        </div>
      </div>
    </div>
    <?php } ); ?>
  </div>
</section>

<!-- ================= FORM + LOCATION ================= -->
<section class="contact-section">
  <div class="wrap">
    <div class="contact-grid">

      <div>
        <?php $cf7_shortcode = svrgn_get_cf7_shortcode(); ?>
        <?php if ( $cf7_shortcode ) : ?>

        <div class="contact-form cf7-wrap">
          <?php echo do_shortcode( $cf7_shortcode ); ?>
        </div>

        <div class="form-success" id="formSuccess">
          <div class="check"><svg viewBox="0 0 24 24" fill="none"><path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
          <h3>Message Received</h3>
          <p>We read every submission personally. Expect to hear back within 24 hours.</p>
        </div>

        <?php else : ?>

        <form class="contact-form" id="contactForm" novalidate>
          <div class="field-row">
            <div class="field">
              <label for="fullName">Full Name</label>
              <div class="field-input-wrap">
                <input type="text" id="fullName" name="fullName" required>
                <span class="field-underline"></span>
              </div>
            </div>
            <div class="field">
              <label for="email">Email</label>
              <div class="field-input-wrap">
                <input type="email" id="email" name="email" required>
                <span class="field-underline"></span>
              </div>
            </div>
          </div>

          <div class="field-row">
            <div class="field">
              <label for="brand">Brand / Company</label>
              <div class="field-input-wrap">
                <input type="text" id="brand" name="brand" required>
                <span class="field-underline"></span>
              </div>
            </div>
            <div class="field">
              <label for="website">Website</label>
              <div class="field-input-wrap">
                <input type="url" id="website" name="website" placeholder="https://">
                <span class="field-underline"></span>
              </div>
            </div>
          </div>

          <div class="field">
            <label for="spend">Monthly Ad Spend</label>
            <div class="field-input-wrap">
              <select id="spend" name="spend" required>
                <option value="" disabled selected>Select a range</option>
                <option>Under $10k / mo</option>
                <option>$10k – $50k / mo</option>
                <option>$50k – $150k / mo</option>
                <option>$150k+ / mo</option>
              </select>
              <span class="field-underline"></span>
            </div>
          </div>

          <div class="field">
            <label for="message">Tell Us About Your Brand</label>
            <div class="field-input-wrap">
              <textarea id="message" name="message" placeholder="What's working, what isn't, and what you're hoping to fix." required></textarea>
              <span class="field-underline"></span>
            </div>
            <p class="field-note">The more specific, the more useful our first call will be.</p>
          </div>

          <button type="submit" class="btn btn-solid" id="contactSubmit" style="align-self:flex-start;">
            Send Message
            <?php echo svrgn_arrow_icon(); ?>
          </button>
        </form>

        <div class="form-success" id="formSuccess">
          <div class="check"><svg viewBox="0 0 24 24" fill="none"><path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
          <h3>Message Received</h3>
          <p>We read every submission personally. Expect to hear back within 24 hours.</p>
        </div>
        <p class="form-error" id="formError" style="display:none;color:var(--accent);margin-top:1rem;"></p>

        <?php endif; ?>
      </div>

      <div class="location-panel">
        <div class="beacon-stage">
          <svg viewBox="0 0 500 400" id="beaconSvg">
            <defs>
              <pattern id="beaconGrid" width="26" height="26" patternUnits="userSpaceOnUse">
                <circle cx="1" cy="1" r="1" fill="var(--line-strong)"/>
              </pattern>
            </defs>
            <rect x="0" y="0" width="500" height="400" fill="url(#beaconGrid)" opacity=".6"/>
            <line class="beacon-tick" x1="250" y1="0" x2="250" y2="400" stroke-dasharray="2 6" opacity=".4"/>
            <line class="beacon-tick" x1="0" y1="200" x2="500" y2="200" stroke-dasharray="2 6" opacity=".4"/>

            <circle class="beacon-ring" cx="250" cy="200" r="30"/>
            <circle class="beacon-ring" cx="250" cy="200" r="30"/>
            <circle class="beacon-ring" cx="250" cy="200" r="30"/>

            <circle cx="250" cy="200" r="7" fill="var(--accent)"/>
            <circle cx="250" cy="200" r="14" fill="none" stroke="var(--accent)" stroke-width="1" opacity=".5"/>

            <text x="250" y="248" text-anchor="middle" class="beacon-label" font-size="11" letter-spacing="2">COSTA MESA, CA</text>
            <text x="20" y="24" class="beacon-label" font-size="10">33.6846° N</text>
            <text x="20" y="382" class="beacon-label" font-size="10">117.9265° W</text>
          </svg>
        </div>

        <?php svrgn_section( 'contact-info', function () { ?>
        <div class="info-card">
          <div class="info-row"><span>Email</span><a href="mailto:andyg@svrgnmedia.com">andyg@svrgnmedia.com</a></div>
          <div class="info-row"><span>Location</span><span>Costa Mesa, California</span></div>
          <div class="info-row"><span>Hours</span><span>Mon–Fri, 9AM–6PM PT</span></div>
          <div class="info-row">
            <span>Directions</span>
            <a class="info-directions" href="https://www.google.com/maps/search/?api=1&query=Costa+Mesa%2C+CA" target="_blank" rel="noopener">
              Open in Maps
              <?php echo svrgn_arrow_icon(); ?>
            </a>
          </div>
        </div>
        <?php } ); ?>
      </div>

    </div>
  </div>
</section>

<!-- ================= PROCESS ================= -->
<section class="process-section">
  <div class="wrap">
    <?php svrgn_section( 'contact-process', function () { ?>
    <div class="split-head">
      <div class="split-head-row">
        <div>
          <div class="eyebrow">What Happens Next</div>
          <h2>From message<br>to a plan.</h2>
        </div>
        <p class="lead">No black box. Here's exactly what happens after you hit send.</p>
      </div>
    </div>

    <div class="process-list" data-reveal-list>
      <div class="process-item">
        <span class="process-mark">01</span>
        <h3>You Reach Out</h3>
        <p>Tell us about your brand, your goals, and where things feel stuck right now.</p>
      </div>
      <div class="process-item">
        <span class="process-mark">02</span>
        <h3>We Take A Look</h3>
        <p>We review your account and creative before we ever get on a call, so the conversation is useful from minute one.</p>
      </div>
      <div class="process-item">
        <span class="process-mark">03</span>
        <h3>We Talk</h3>
        <p>A straight 30-minute call to figure out, together, whether SVRGN is the right fit.</p>
      </div>
    </div>
    <?php } ); ?>
  </div>
</section>

<!-- ================= CLOSING CTA ================= -->
<section class="cs-cta">
  <div class="wrap">
    <?php svrgn_section( 'contact-cta', function () { ?>
    <div class="eyebrow" style="justify-content:center;">Skip The Form?</div>
    <h2>Reach us<br>directly.</h2>
    <p>Prefer email? Either way, a real person reads it — usually within a day.</p>
    <a href="mailto:andyg@svrgnmedia.com" class="btn btn-solid">
      Email andyg@svrgnmedia.com
      <?php echo svrgn_arrow_icon(); ?>
    </a>
    <?php } ); ?>
  </div>
</section>

<?php get_footer(); ?>
