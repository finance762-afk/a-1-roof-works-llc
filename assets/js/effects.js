/**
 * effects.js — A-1 Roof Works LLC
 * Interactive visual effects:
 *   - Ripple on button clicks
 *   - Magnetic CTA hover (desktop only, disabled on touch devices)
 *   - VanillaTilt initialisation on .card elements (if library present)
 *
 * All effects degrade gracefully when the library or capability is absent.
 */

(function () {
  'use strict';

  /* ── Touch detection (disables magnetic effect on touch devices) ──────── */
  var isTouch = ('ontouchstart' in window) || (navigator.maxTouchPoints > 0);

  /* ── Respect prefers-reduced-motion ───────────────────────────────────── */
  var prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* ════════════════════════════════════════════════════════════════════════
     RIPPLE EFFECT
     Spawns a circular ripple at the click position on any .btn-primary,
     .btn-secondary, .btn-cta, .btn-nav-cta, .footer-cta-btn, or any
     element carrying [data-ripple].
  ════════════════════════════════════════════════════════════════════════ */
  function initRipple() {
    var selector = [
      '.btn-primary',
      '.btn-secondary',
      '.btn-nav-cta',
      '.footer-cta-btn',
      '.mobile-float-estimate',
      '[data-ripple]'
    ].join(', ');

    document.querySelectorAll(selector).forEach(function (btn) {
      /* Ensure overflow:hidden so ripple is clipped */
      var style = window.getComputedStyle(btn);
      if (style.overflow === 'visible') {
        btn.style.overflow = 'hidden';
      }
      btn.addEventListener('click', function (e) {
        createRipple(btn, e);
      });
    });

    /* Delegate future buttons added to the DOM (e.g. Swiper clones) */
    document.addEventListener('click', function (e) {
      var btn = e.target.closest(selector);
      if (btn) createRipple(btn, e);
    });
  }

  function createRipple(btn, e) {
    /* Remove any lingering ripple */
    var existing = btn.querySelector('.ripple-wave');
    if (existing) existing.remove();

    var rect     = btn.getBoundingClientRect();
    var size     = Math.max(rect.width, rect.height) * 2;
    var x        = e.clientX - rect.left - size / 2;
    var y        = e.clientY - rect.top  - size / 2;

    var ripple           = document.createElement('span');
    ripple.className     = 'ripple-wave';
    ripple.style.cssText = [
      'position:absolute',
      'border-radius:50%',
      'background:rgba(255,255,255,0.28)',
      'pointer-events:none',
      'transform:scale(0)',
      'opacity:1',
      'width:'  + size + 'px',
      'height:' + size + 'px',
      'left:'   + x    + 'px',
      'top:'    + y    + 'px',
      'animation:ripple-expand 0.55s cubic-bezier(0.4,0,0.2,1) forwards'
    ].join(';');

    btn.appendChild(ripple);

    ripple.addEventListener('animationend', function () {
      ripple.remove();
    });
  }

  /* Inject ripple keyframes once */
  function injectRippleCSS() {
    if (document.getElementById('ripple-keyframes')) return;
    var style       = document.createElement('style');
    style.id        = 'ripple-keyframes';
    style.textContent = '@keyframes ripple-expand{to{transform:scale(1);opacity:0}}';
    document.head.appendChild(style);
  }

  /* ════════════════════════════════════════════════════════════════════════
     MAGNETIC EFFECT (desktop, no-touch only)
     Applies to elements carrying [data-magnetic] or .btn-primary in hero
     sections. The element follows the cursor with a subtle offset.
  ════════════════════════════════════════════════════════════════════════ */
  function initMagnetic() {
    if (isTouch || prefersReducedMotion) return;

    document.querySelectorAll('[data-magnetic]').forEach(function (el) {
      var strength = parseFloat(el.dataset.magneticStrength) || 0.35;

      el.addEventListener('mousemove', function (e) {
        var rect    = el.getBoundingClientRect();
        var centerX = rect.left + rect.width  / 2;
        var centerY = rect.top  + rect.height / 2;
        var dx      = (e.clientX - centerX) * strength;
        var dy      = (e.clientY - centerY) * strength;
        el.style.transform = 'translate(' + dx + 'px, ' + dy + 'px)';
      });

      el.addEventListener('mouseleave', function () {
        el.style.transform = '';
        el.style.transition = 'transform 0.4s cubic-bezier(0.25,0.46,0.45,0.94)';
        setTimeout(function () { el.style.transition = ''; }, 400);
      });
    });
  }

  /* ════════════════════════════════════════════════════════════════════════
     VANILLATILT (desktop, no-touch only)
     Initialises card tilt on .card elements if the library is loaded.
  ════════════════════════════════════════════════════════════════════════ */
  function initTilt() {
    if (isTouch || prefersReducedMotion) return;
    if (typeof VanillaTilt === 'undefined') return;

    var cards = document.querySelectorAll('.card[data-tilt]');
    if (!cards.length) {
      /* Also init cards without explicit attribute if they carry the base class */
      cards = document.querySelectorAll('.card');
    }
    if (!cards.length) return;

    VanillaTilt.init(Array.from(cards), {
      max:       8,
      speed:     400,
      glare:     true,
      'max-glare': 0.15,
      perspective: 1000
    });
  }

  /* ── Init on DOMContentLoaded ─────────────────────────────────────────── */
  function init() {
    injectRippleCSS();
    initRipple();
    initMagnetic();
    /* VanillaTilt may load after this script; try immediately and once more */
    initTilt();
    window.addEventListener('load', initTilt, { once: true });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }

}());
