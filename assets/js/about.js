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

  // ---- team photo subtle scroll parallax ----
  if (!reduceMotion) {
    gsap.utils.toArray('.team-img').forEach(img => {
      gsap.fromTo(img, {yPercent:-5}, {
        yPercent:5, ease:'none',
        scrollTrigger:{trigger:img.closest('.team-card'), start:'top bottom', end:'bottom top', scrub:.6}
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
