(function(){
  const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  if (typeof gsap === 'undefined') return;
  gsap.registerPlugin(ScrollTrigger, MotionPathPlugin, ScrollToPlugin);

  // ---- scroll performance tuning ----
  // smooths out scroll input across browsers/trackpads/touch and avoids the
  // jank mobile browsers cause by resizing the viewport on address-bar show/hide
  ScrollTrigger.normalizeScroll(true);
  ScrollTrigger.config({ ignoreMobileResize: true });
  gsap.ticker.lagSmoothing(500, 33);

  // ---- header state on scroll ----
  const header = document.getElementById('siteHeader');
  ScrollTrigger.create({
    start: 60,
    end: 99999,
    onUpdate: (self) => header.classList.toggle('scrolled', self.scroll() > 60)
  });

  // ---- hero title reveal ----
  gsap.set('.hero-title .line span', {yPercent: 110});
  gsap.set('.hero-eyebrow, .hero-sub, .hero-actions, .hero-stats, .hero-frame, .scroll-cue', {opacity:0});
  gsap.set('.hero-video-wrap, .hero-scrim', {opacity:0, scale:1.06});

  const tl = gsap.timeline({defaults:{ease:'power4.out'}});
  tl.to('.hero-video-wrap, .hero-scrim', {opacity:1, scale:1, duration:1.8, ease:'power3.out'}, 0)
    .to('.hero-frame', {opacity:1, duration:.6}, .2)
    .to('.hero-title .line span', {yPercent:0, duration:1.1, stagger:.12}, .3)
    .to('.hero-eyebrow', {opacity:1, duration:.6}, .3)
    .to('.hero-sub', {opacity:1, duration:.6}, .65)
    .to('.hero-actions', {opacity:1, duration:.6}, .75)
    .to('.hero-stats', {opacity:1, duration:.6}, .85)
    .to('.scroll-cue', {opacity:1, duration:.6}, 1);

  // ---- hero video: autoplay handling + mute toggle ----
  const heroVideo = document.getElementById('heroVideo');
  const muteToggle = document.getElementById('muteToggle');

  if (heroVideo) {
    heroVideo.muted = true;
    const playPromise = heroVideo.play();
    if (playPromise && playPromise.catch) playPromise.catch(() => {});

    if (reduceMotion) {
      // show a single frame rather than an auto-looping background for reduced-motion users
      heroVideo.addEventListener('loadeddata', () => heroVideo.pause(), {once:true});
    } else {
      // slow continuous Ken Burns drift once the entrance settles
      gsap.to('.hero-video-wrap', {
        scale: 1.09,
        duration: 22,
        ease: 'sine.inOut',
        repeat: -1,
        yoyo: true,
        delay: 1.8
      });
    }
  }

  if (muteToggle && heroVideo) {
    muteToggle.addEventListener('click', () => {
      heroVideo.muted = !heroVideo.muted;
      muteToggle.classList.toggle('is-unmuted', !heroVideo.muted);
      muteToggle.setAttribute('aria-label', heroVideo.muted ? 'Unmute background video' : 'Mute background video');
      if (!heroVideo.muted && heroVideo.paused) heroVideo.play().catch(() => {});
    });
  }

  // ---- count-up stats ----
  document.querySelectorAll('[data-count]').forEach(el => {
    const target = parseFloat(el.getAttribute('data-count'));
    const suffix = el.getAttribute('data-suffix') || '';
    const obj = {val:0};
    ScrollTrigger.create({
      trigger: el,
      start:'top 88%',
      once:true,
      onEnter:() => {
        gsap.to(obj, {
          val: target,
          duration: 1.6,
          ease:'power2.out',
          onUpdate:() => { el.textContent = Math.round(obj.val) + suffix; }
        });
      }
    });
  });

  // ---- generic reveal-on-scroll ----
  document.querySelectorAll('[data-reveal]').forEach(el => {
    gsap.fromTo(el, {opacity:0, y:28}, {
      opacity:1, y:0, duration:.9, ease:'power3.out',
      scrollTrigger:{trigger:el, start:'top 85%'}
    });
  });

  document.querySelectorAll('[data-reveal-list]').forEach(list => {
    const items = list.children;
    gsap.fromTo(items, {opacity:0, y:24}, {
      opacity:1, y:0, duration:.7, ease:'power3.out', stagger:.08,
      scrollTrigger:{trigger:list, start:'top 85%'}
    });
  });

  // ---- section head reveals: eyebrow / lead fade, heading lines slide up masked ----
  document.querySelectorAll('.head-row').forEach(row => {
    gsap.fromTo(row.querySelectorAll('.eyebrow, .lead'), {opacity:0, y:22}, {
      opacity:1, y:0, duration:.8, ease:'power3.out', stagger:.08,
      scrollTrigger:{trigger:row, start:'top 85%'}
    });
  });

  // ---- bold heading reveal: every h2 splits into masked lines that slide up on scroll ----
  const headingEls = document.querySelectorAll('.head-row h2, .contact-title');
  headingEls.forEach(h => {
    const lines = h.innerHTML.split(/<br\s*\/?>/i).map(s => s.trim()).filter(Boolean);
    if (lines.length === 0) return;
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
    const innerSpans = h.querySelectorAll('.line-inner');
    gsap.set(innerSpans, {yPercent: 110});
    gsap.to(innerSpans, {
      yPercent: 0,
      duration: 1,
      stagger: .12,
      ease: 'power4.out',
      scrollTrigger:{trigger:h, start:'top 88%'}
    });
  });

  // ---- fit-card icons pop in after the cards settle ----
  const fitGridEl = document.querySelector('.fit-grid');
  if (fitGridEl) {
    gsap.set('.fit-icon', {scale:0, rotation:-20, transformOrigin:'50% 50%'});
    gsap.to('.fit-icon', {
      scale:1, rotation:0, duration:.7, stagger:.1, ease:'back.out(2.2)',
      scrollTrigger:{trigger:fitGridEl, start:'top 82%'}
    });
  }

  // ---- system diagram (rectangular circuit loop) ----
  const paths = gsap.utils.toArray('.sys-path');
  paths.forEach(p => {
    const len = p.getTotalLength();
    gsap.set(p, {strokeDasharray: len, strokeDashoffset: len});
  });
  gsap.set('.sys-node', {opacity:0, scale:.7, transformOrigin:'50% 50%'});
  gsap.set('.sys-chevron', {opacity:0});
  gsap.set('.pulse-dot', {opacity:0});
  gsap.set('.node-halo', {opacity:0, scale:1, transformOrigin:'50% 50%'});

  const sysTl = gsap.timeline({
    scrollTrigger:{trigger:'#system', start:'top 70%'}
  });
  paths.forEach((p,i) => {
    sysTl.to(p, {strokeDashoffset:0, duration:.85, ease:'power2.inOut'}, i*.3);
    // quick bright "power surge" flash right as each edge finishes tracing
    sysTl.fromTo(p, {stroke:'#ff3d22'}, {stroke:'rgba(245,243,239,0.22)', duration:.5, ease:'power2.out'}, i*.3+.75);
  });
  sysTl.to('.sys-node', {opacity:1, scale:1, duration:.55, stagger:.22, ease:'back.out(1.9)'}, .15);
  sysTl.to('.sys-chevron', {opacity:.45, duration:.5, stagger:.15}, '-=.3');
  sysTl.to('.pulse-dot', {opacity:1, duration:.3, stagger:.05}, '-=.2');

  sysTl.call(() => {
    if (reduceMotion) return;

    // ---- comet trail: 3 dots chasing each other around the rectangular loop ----
    const loopDuration = 7;
    const dots = [
      {id:'#pulseDot', offset:0},
      {id:'#pulseDot2', offset:.045},
      {id:'#pulseDot3', offset:.09}
    ];
    dots.forEach(d => {
      const tween = gsap.to(d.id, {
        duration: loopDuration,
        repeat: -1,
        ease:'none',
        motionPath:{ path:'#pulsePath', align:'#pulsePath', alignOrigin:[.5,.5] }
      });
      tween.progress(d.offset);
    });

    // ---- corner surge: nodes flash brighter the instant the lead pulse arrives ----
    // fractions along the 1840-unit rectangular perimeter (600/320/600/320)
    const cornerFractions = [0, 600/1840, 920/1840, 1520/1840];
    const surgeTl = gsap.timeline({repeat:-1});
    cornerFractions.forEach((frac, i) => {
      const node = document.querySelector(`.sys-node[data-node="${i+1}"]`);
      const halo = node ? node.querySelector('.node-halo') : null;
      if (!node) return;
      surgeTl.to(node, {scale:1.12, duration:.22, ease:'power2.out'}, frac*loopDuration)
             .to(node, {scale:1, duration:.4, ease:'power2.inOut'}, frac*loopDuration+.22)
             .to(halo, {opacity:.7, scale:1.35, duration:.22, ease:'power2.out'}, frac*loopDuration)
             .to(halo, {opacity:0, scale:1, duration:.5, ease:'power2.inOut'}, frac*loopDuration+.2);
    });
  });

  // ---- pillar / case hover lift already CSS-driven ----

  // ---- scroll progress readout ----
  gsap.to('#progressFill', {
    scaleX: 1,
    ease:'none',
    scrollTrigger:{
      trigger: document.body,
      start:'top top',
      end:'bottom bottom',
      scrub:.3
    }
  });

  // ---- problem quote clip-path wipe ----
  document.querySelectorAll('[data-clip-reveal]').forEach(el => {
    gsap.fromTo(el, {clipPath:'inset(0 100% 0 0)'}, {
      clipPath:'inset(0 0% 0 0)',
      duration:1.1, ease:'power4.inOut',
      scrollTrigger:{trigger:el, start:'top 85%'}
    });
  });

  // ---- pivot columns slide in from opposite sides ----
  document.querySelectorAll('[data-pivot-reveal]').forEach(grid => {
    const left = grid.querySelector('[data-slide="left"]');
    const right = grid.querySelector('[data-slide="right"]');
    gsap.fromTo(left, {opacity:0, x:-50}, {opacity:1, x:0, duration:1, ease:'power3.out',
      scrollTrigger:{trigger:grid, start:'top 80%'}});
    gsap.fromTo(right, {opacity:0, x:50}, {opacity:1, x:0, duration:1, ease:'power3.out',
      scrollTrigger:{trigger:grid, start:'top 80%'}});
  });

  // ---- case study image parallax while scrolling through the grid ----
  if (!reduceMotion) {
    gsap.utils.toArray('.case-parallax').forEach(wrap => {
      gsap.fromTo(wrap, {yPercent:-8}, {
        yPercent:8, ease:'none',
        scrollTrigger:{trigger:wrap.closest('.case-card'), start:'top bottom', end:'bottom top', scrub:.6}
      });
    });
  }

  // ---- horizontal scrolling project gallery (desktop: pinned; mobile: native swipe) ----
  const galleryPin = document.getElementById('galleryPin');
  const galleryViewport = document.getElementById('galleryViewport');
  const galleryTrack = document.getElementById('galleryTrack');
  const galleryBarFill = document.getElementById('galleryBarFill');
  const galleryActiveEl = document.getElementById('galleryActive');
  const galleryCards = galleryTrack ? gsap.utils.toArray(galleryTrack.querySelectorAll('.project-card')) : [];
  const galleryImgs = galleryTrack ? gsap.utils.toArray(galleryTrack.querySelectorAll('.project-parallax')) : [];

  const galleryTotalEl = document.getElementById('galleryTotal');
  if (galleryTotalEl && galleryCards.length) {
    galleryTotalEl.textContent = String(galleryCards.length).padStart(2, '0');
  }

  function updateGalleryUI(progress, count) {
    if (galleryBarFill) galleryBarFill.style.width = (progress * 100) + '%';
    if (galleryActiveEl && count) {
      const idx = Math.min(count, Math.floor(progress * count) + 1);
      galleryActiveEl.textContent = String(idx).padStart(2, '0');
    }
  }

  if (galleryPin && galleryTrack && galleryViewport && galleryCards.length) {
    const mm = gsap.matchMedia();

    mm.add('(min-width: 981px)', () => {
      const getScrollAmount = () => Math.max(0, galleryTrack.scrollWidth - galleryViewport.offsetWidth);
      const imgSetters = galleryImgs.map((img, i) => gsap.quickSetter(img, 'xPercent'));

      const st = ScrollTrigger.create({
        trigger: galleryPin,
        start: 'top top+=84',
        end: () => '+=' + getScrollAmount(),
        pin: true,
        scrub: .6,
        anticipatePin: 1,
        invalidateOnRefresh: true,
        onUpdate: (self) => {
          const amount = getScrollAmount();
          gsap.set(galleryTrack, {x: -self.progress * amount});
          if (!reduceMotion) {
            imgSetters.forEach((setX, i) => {
              const dir = i % 2 === 0 ? -1 : 1;
              setX((self.progress - .5) * 16 * dir);
            });
          }
          updateGalleryUI(self.progress, galleryCards.length);
        }
      });

      return () => { st.kill(); gsap.set(galleryTrack, {x:0}); };
    });

    mm.add('(max-width: 980px)', () => {
      // native swipeable strip on mobile — just keep the readouts in sync
      const onScroll = () => {
        const max = galleryViewport.scrollWidth - galleryViewport.clientWidth;
        const progress = max > 0 ? galleryViewport.scrollLeft / max : 0;
        updateGalleryUI(progress, galleryCards.length);
      };
      galleryViewport.addEventListener('scroll', onScroll, {passive:true});
      onScroll();
      return () => galleryViewport.removeEventListener('scroll', onScroll);
    });
  }

  // ---- Projects section: ambient gradient background, randomly cycling every 2s ----
  const projBgA = document.getElementById('projBgA');
  const projBgB = document.getElementById('projBgB');
  if (projBgA && projBgB) {
    const ambientGradients = [
      'linear-gradient(135deg, #0a0a0b 0%, #1b1013 35%, #3a1410 65%, #0a0a0b 100%)', // ember red
      'linear-gradient(135deg, #0a0a0b 0%, #10181d 35%, #1c2c35 65%, #0a0a0b 100%)', // steel dusk
      'linear-gradient(135deg, #0a0a0b 0%, #1a130d 35%, #33210f 65%, #0a0a0b 100%)', // amber
      'linear-gradient(135deg, #0a0a0b 0%, #150f1a 35%, #241a33 65%, #0a0a0b 100%)', // violet dusk
      'linear-gradient(135deg, #0a0a0b 0%, #1c0e0b 30%, #3d160f 55%, #0a0a0b 100%)'  // vermilion ember
    ];

    let ambientIndex = 0;
    let activeLayer = projBgA;
    let idleLayer = projBgB;
    projBgA.style.backgroundImage = ambientGradients[0];

    function pickNextAmbientIndex() {
      let next = Math.floor(Math.random() * ambientGradients.length);
      if (next === ambientIndex) next = (next + 1) % ambientGradients.length;
      return next;
    }

    if (!reduceMotion) {
      setInterval(() => {
        ambientIndex = pickNextAmbientIndex();
        idleLayer.style.backgroundImage = ambientGradients[ambientIndex];
        gsap.to(idleLayer, {opacity:1, duration:1.6, ease:'sine.inOut'});
        gsap.to(activeLayer, {opacity:0, duration:1.6, ease:'sine.inOut'});
        const swap = activeLayer;
        activeLayer = idleLayer;
        idleLayer = swap;
      }, 2000);
    }
  }

  // ---- magnetic hover for every button on the site ----
  const seeMoreBtn = document.getElementById('seeMoreBtn');
  if (seeMoreBtn) {
    gsap.set(seeMoreBtn, {scale:.85, opacity:0});
    gsap.to(seeMoreBtn, {
      scale:1, opacity:1, duration:.8, ease:'back.out(1.8)',
      scrollTrigger:{trigger:seeMoreBtn, start:'top 92%'}
    });
  }

  function initMagneticButton(el, strengthX, strengthY) {
    const setX = gsap.quickTo(el, 'x', {duration:.5, ease:'power2.out'});
    const setY = gsap.quickTo(el, 'y', {duration:.5, ease:'power2.out'});
    el.addEventListener('mousemove', (e) => {
      const r = el.getBoundingClientRect();
      const px = (e.clientX - r.left) / r.width - .5;
      const py = (e.clientY - r.top) / r.height - .5;
      setX(px * strengthX);
      setY(py * strengthY);
    });
    el.addEventListener('mouseleave', () => {
      gsap.to(el, {x:0, y:0, duration:.6, ease:'elastic.out(1, 0.4)', overwrite:true});
    });
  }

  if (!reduceMotion && window.matchMedia('(hover:hover)').matches) {
    document.querySelectorAll('.btn').forEach(el => initMagneticButton(el, 12, 9));
    if (seeMoreBtn) initMagneticButton(seeMoreBtn, 18, 14);
  }

  // ---- pointer tilt on case-card & project-card photography ----
  if (!reduceMotion && window.matchMedia('(hover:hover)').matches) {
    const tiltEls = document.querySelectorAll('.case-card, .project-card');
    tiltEls.forEach(el => {
      const strength = 6;
      el.style.transformStyle = 'preserve-3d';
      gsap.set(el, {transformPerspective:900});
      const setRX = gsap.quickTo(el, 'rotateX', {duration:.5, ease:'power2.out'});
      const setRY = gsap.quickTo(el, 'rotateY', {duration:.5, ease:'power2.out'});
      el.addEventListener('mousemove', (e) => {
        const r = el.getBoundingClientRect();
        const px = (e.clientX - r.left) / r.width - .5;
        const py = (e.clientY - r.top) / r.height - .5;
        setRY(px * strength);
        setRX(-py * strength);
      });
      el.addEventListener('mouseleave', () => {
        gsap.to(el, {rotateY:0, rotateX:0, duration:.6, ease:'power3.out', overwrite:true});
      });
    });
  }

  // ---- smooth-scroll offset correction for anchor nav ----
  document.querySelectorAll('a[href^="#"]').forEach(a => {
    a.addEventListener('click', e => {
      const id = a.getAttribute('href');
      if (id.length < 2) return;
      const target = document.querySelector(id);
      if (!target) return;
      e.preventDefault();
      gsap.to(window, {duration:1, ease:'power3.inOut', scrollTo:{y:target, offsetY:70}});
    });
  });
})();
