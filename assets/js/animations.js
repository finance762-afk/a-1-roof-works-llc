/**
 * animations.js — A-1 Roof Works LLC
 * Scroll-reveal animations via IntersectionObserver.
 * Handles: fade-up, fade-right, fade-left, scale-in, wipe-right
 * Also handles: stat counter count-up animation
 *
 * CSS partner: [data-animate] / .is-visible rules in framework.css
 */

(function () {
  'use strict';

  /* ── Respect prefers-reduced-motion ───────────────────────────────────── */
  var prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  if (prefersReducedMotion) {
    /* Show everything immediately — no animation */
    document.querySelectorAll('[data-animate]').forEach(function (el) {
      el.classList.add('is-visible');
    });
    return;
  }

  /* ── IntersectionObserver for scroll reveals ───────────────────────────── */
  if (!('IntersectionObserver' in window)) {
    /* Fallback: make all animated elements visible right away */
    document.querySelectorAll('[data-animate]').forEach(function (el) {
      el.classList.add('is-visible');
    });
    return;
  }

  var observer = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        entry.target.classList.add('is-visible');
        observer.unobserve(entry.target);
      }
    });
  }, {
    threshold: 0.15,
    rootMargin: '0px 0px -40px 0px'
  });

  /* Observe all data-animate elements present at load */
  function initAnimations() {
    document.querySelectorAll('[data-animate]').forEach(function (el) {
      observer.observe(el);
    });
  }

  /* ── Stat counter count-up ────────────────────────────────────────────── */
  var counterObserver = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        animateCounter(entry.target);
        counterObserver.unobserve(entry.target);
      }
    });
  }, { threshold: 0.5 });

  function animateCounter(el) {
    var target = parseInt(el.getAttribute('data-counter'), 10);
    if (isNaN(target)) return;

    var duration  = 1800;   /* ms */
    var start     = null;
    var startVal  = 0;

    function step(timestamp) {
      if (!start) start = timestamp;
      var progress = Math.min((timestamp - start) / duration, 1);
      /* Ease-out cubic */
      var eased   = 1 - Math.pow(1 - progress, 3);
      var current = Math.round(startVal + eased * (target - startVal));

      /* Preserve suffix ('+', '%', etc.) that was originally appended */
      var suffix = el.dataset.counterSuffix || '';
      el.textContent = current.toLocaleString() + suffix;

      if (progress < 1) {
        requestAnimationFrame(step);
      } else {
        el.textContent = target.toLocaleString() + suffix;
      }
    }

    requestAnimationFrame(step);
  }

  function initCounters() {
    document.querySelectorAll('[data-counter]').forEach(function (el) {
      /* Preserve any suffix (+ sign, %) visible after the number */
      var originalText = el.textContent.trim();
      var numericPart  = parseInt(originalText.replace(/[^0-9]/g, ''), 10);
      var suffixMatch  = originalText.match(/[^0-9,]+$/);
      if (suffixMatch) {
        el.dataset.counterSuffix = suffixMatch[0];
      }
      el.textContent = '0' + (el.dataset.counterSuffix || '');
      counterObserver.observe(el);
    });
  }

  /* ── Init on DOMContentLoaded ─────────────────────────────────────────── */
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', function () {
      initAnimations();
      initCounters();
    });
  } else {
    initAnimations();
    initCounters();
  }

}());
