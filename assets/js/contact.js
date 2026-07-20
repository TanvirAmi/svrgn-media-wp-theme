(function(){
  const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (typeof gsap === 'undefined') return;
  gsap.registerPlugin(ScrollTrigger);

  ScrollTrigger.normalizeScroll(true);
  ScrollTrigger.config({ ignoreMobileResize: true });
  gsap.ticker.lagSmoothing(500, 33);

  // ---- header state on scroll ----
  const header = document.getElementById('siteHeader');
  ScrollTrigger.create({
    start: 60, end: 99999,
    onUpdate: (self) => header.classList.toggle('scrolled', self.scroll() > 60)
  });

  // ---- reusable line-mask heading split ----
  function splitHeadingLines(h, delay) {
    const lines = h.innerHTML.split(/<br\s*\/?>/i).map(s => s.trim()).filter(Boolean);
    h.innerHTML = '';
    lines.forEach(line => {
      const mask = document.createElement('span');
      mask.className = 'line-mask';
      const inner = document.createElement('span');
      inner.className = 'line-inner';
      inner.innerHTML = line;
      mask.appendChild(inner);
      h.appendChild(mask);
    });
    return h.querySelectorAll('.line-inner');
  }

  // ---- hero heading line-mask reveal ----
  document.querySelectorAll('.cs-title').forEach(h => {
    const innerSpans = splitHeadingLines(h);
    gsap.set(innerSpans, {yPercent:110});
    gsap.to(innerSpans, {yPercent:0, duration:1, stagger:.12, ease:'power4.out', delay:.15});
  });
  gsap.from('.cs-hero .eyebrow, .cs-lead, .cs-hero-stats, .cs-back', {
    opacity:0, y:16, duration:.8, stagger:.08, ease:'power3.out', delay:.2
  });

  // ---- hero planet: entrance + scroll parallax + mouse parallax ----
  const heroPlanetScroll = document.getElementById('heroPlanetScroll');
  const heroPlanet = document.getElementById('heroPlanet');
  if (heroPlanet) {
    gsap.set(heroPlanet, {opacity:0, scale:.92, transformOrigin:'50% 50%'});
    gsap.to(heroPlanet, {opacity:1, scale:1, duration:1.8, ease:'power3.out', delay:.4});

    if (!reduceMotion) {
      // background drifts slower than the page scrolls past it, for depth
      if (heroPlanetScroll) {
        gsap.to(heroPlanetScroll, {
          y:130, ease:'none',
          scrollTrigger:{trigger:'.cs-hero', start:'top top', end:'bottom top', scrub:.6}
        });
      }
      // subtle drift opposite the cursor
      const heroSectionEl = document.querySelector('.cs-hero');
      if (heroSectionEl && window.matchMedia('(hover:hover)').matches) {
        const setPlanetX = gsap.quickTo(heroPlanet, 'x', {duration:.9, ease:'power2.out'});
        const setPlanetY = gsap.quickTo(heroPlanet, 'y', {duration:.9, ease:'power2.out'});
        heroSectionEl.addEventListener('mousemove', (e) => {
          const r = heroSectionEl.getBoundingClientRect();
          const px = (e.clientX - r.left) / r.width - .5;
          const py = (e.clientY - r.top) / r.height - .5;
          setPlanetX(px * -26);
          setPlanetY(py * -20);
        });
        heroSectionEl.addEventListener('mouseleave', () => {
          setPlanetX(0); setPlanetY(0);
        });
      }
    }
  }

  // ---- section heading reveals (Story / Team / Values / CTA) ----
  document.querySelectorAll('.split-head h2, .cs-cta h2').forEach(h => {
    const innerSpans = splitHeadingLines(h);
    gsap.set(innerSpans, {yPercent:110});
    gsap.to(innerSpans, {
      yPercent:0, duration:1, stagger:.12, ease:'power4.out',
      scrollTrigger:{trigger:h, start:'top 88%'}
    });
  });
  document.querySelectorAll('.split-head').forEach(head => {
    gsap.from(head.querySelectorAll('.eyebrow, .lead'), {
      opacity:0, y:16, duration:.8, stagger:.08, ease:'power3.out',
      scrollTrigger:{trigger:head, start:'top 88%'}
    });
  });

  // ---- story quote reveal ----
  document.querySelectorAll('[data-reveal]').forEach(el => {
    gsap.fromTo(el, {opacity:0, y:28}, {
      opacity:1, y:0, duration:.9, ease:'power3.out',
      scrollTrigger:{trigger:el, start:'top 85%'}
    });
  });

  // ---- staggered list/grid reveals (team cards, values) ----
  document.querySelectorAll('[data-reveal-list]').forEach(list => {
    gsap.fromTo(list.children, {opacity:0, y:32}, {
      opacity:1, y:0, duration:.8, stagger:.12, ease:'power3.out',
      scrollTrigger:{trigger:list, start:'top 85%'}
    });
  });

  // ---- location beacon: pulsing radar rings ----
  if (!reduceMotion) {
    const rings = gsap.utils.toArray('.beacon-ring');
    rings.forEach((ring, i) => {
      gsap.fromTo(ring, {attr:{r:14}, opacity:.7}, {
        attr:{r:90}, opacity:0, duration:3, ease:'power1.out',
        repeat:-1, delay:i * 1,
        scrollTrigger:{trigger:'.beacon-stage', start:'top 90%', once:true}
      });
    });
  }

  // ---- contact form: real submit via WP admin-ajax (inc/contact-form.php) ----
  const contactForm = document.getElementById('contactForm');
  const contactSubmit = document.getElementById('contactSubmit');
  const formSuccess = document.getElementById('formSuccess');
  const formError = document.getElementById('formError');
  if (contactForm && contactSubmit && formSuccess && typeof svrgnContact !== 'undefined') {
    contactForm.addEventListener('submit', (e) => {
      e.preventDefault();
      if (!contactForm.checkValidity()) {
        contactForm.reportValidity();
        return;
      }
      if (formError) formError.style.display = 'none';
      contactSubmit.disabled = true;
      const originalLabel = contactSubmit.innerHTML;
      contactSubmit.innerHTML = 'Sending…';

      const data = new FormData(contactForm);
      data.append('action', 'svrgn_contact_submit');
      data.append('nonce', svrgnContact.nonce);

      fetch(svrgnContact.ajaxUrl, { method: 'POST', body: data, credentials: 'same-origin' })
        .then(res => res.json())
        .then(res => {
          if (res.success) {
            contactForm.classList.add('is-hidden');
            formSuccess.classList.add('is-visible');
            gsap.fromTo(formSuccess, {opacity:0, y:16}, {opacity:1, y:0, duration:.7, ease:'power3.out'});
          } else {
            if (formError) {
              formError.textContent = (res.data && res.data.message) || 'Something went wrong. Please try again.';
              formError.style.display = 'block';
            }
            contactSubmit.disabled = false;
            contactSubmit.innerHTML = originalLabel;
          }
        })
        .catch(() => {
          if (formError) {
            formError.textContent = 'Something went wrong. Please email us directly.';
            formError.style.display = 'block';
          }
          contactSubmit.disabled = false;
          contactSubmit.innerHTML = originalLabel;
        });
    });
  }

  // ---- magnetic buttons ----
  function initMagneticButton(el, sx, sy) {
    const setX = gsap.quickTo(el, 'x', {duration:.5, ease:'power2.out'});
    const setY = gsap.quickTo(el, 'y', {duration:.5, ease:'power2.out'});
    el.addEventListener('mousemove', (e) => {
      const r = el.getBoundingClientRect();
      setX(((e.clientX - r.left) / r.width - .5) * sx);
      setY(((e.clientY - r.top) / r.height - .5) * sy);
    });
    el.addEventListener('mouseleave', () => {
      gsap.to(el, {x:0, y:0, duration:.6, ease:'elastic.out(1, 0.4)', overwrite:true});
    });
  }
  if (!reduceMotion && window.matchMedia('(hover:hover)').matches) {
    document.querySelectorAll('.btn').forEach(el => initMagneticButton(el, 12, 9));
  }
})();
