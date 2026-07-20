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

  // ---- hero heading line-mask reveal ----
  document.querySelectorAll('.cs-title').forEach(h => {
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
    gsap.set(h.querySelectorAll('.line-inner'), {yPercent:110});
    gsap.to(h.querySelectorAll('.line-inner'), {
      yPercent:0, duration:1, stagger:.12, ease:'power4.out', delay:.15
    });
  });
  gsap.from('.cs-hero .eyebrow, .cs-lead, .cs-hero-stats, .cs-back', {
    opacity:0, y:16, duration:.8, stagger:.08, ease:'power3.out', delay:.2
  });

  // ---- CTA heading reveal ----
  const ctaHeading = document.querySelector('.cs-cta h2');
  if (ctaHeading) {
    const lines = ctaHeading.innerHTML.split(/<br\s*\/?>/i).map(s => s.trim()).filter(Boolean);
    ctaHeading.innerHTML = '';
    lines.forEach(line => {
      const mask = document.createElement('span');
      mask.className = 'line-mask';
      const inner = document.createElement('span');
      inner.className = 'line-inner';
      inner.innerHTML = line;
      mask.appendChild(inner);
      ctaHeading.appendChild(mask);
    });
    gsap.set(ctaHeading.querySelectorAll('.line-inner'), {yPercent:110});
    gsap.to(ctaHeading.querySelectorAll('.line-inner'), {
      yPercent:0, duration:1, stagger:.12, ease:'power4.out',
      scrollTrigger:{trigger:ctaHeading, start:'top 88%'}
    });
  }

  // ---- case row entrance ----
  document.querySelectorAll('.case-row').forEach(row => {
    gsap.fromTo(row, {opacity:0, y:36}, {
      opacity:1, y:0, duration:.9, ease:'power3.out',
      scrollTrigger:{trigger:row, start:'top 85%'}
    });
  });

  // ---- image parallax while scrolling past each row ----
  if (!reduceMotion) {
    gsap.utils.toArray('.case-media-parallax').forEach(wrap => {
      gsap.fromTo(wrap, {yPercent:-6}, {
        yPercent:6, ease:'none',
        scrollTrigger:{trigger:wrap.closest('.case-row'), start:'top bottom', end:'bottom top', scrub:.6}
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
