/**
 * main.js — A-1 Roof Works LLC
 * Site-wide utility behaviours not covered by animations.js or effects.js:
 *   - Smooth-scroll for anchor links
 *   - Active nav link highlight on scroll (for single-page-style sections)
 *   - Swiper carousel init (if Swiper is loaded and carousels are present)
 *   - Form UX: floating label activation, submit state feedback
 */

(function () {
  'use strict';

  /* ── Smooth-scroll for on-page # anchors ────────────────────────────── */
  document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
    anchor.addEventListener('click', function (e) {
      var target = document.querySelector(this.getAttribute('href'));
      if (!target) return;
      e.preventDefault();
      var navbarHeight = parseInt(
        getComputedStyle(document.documentElement)
          .getPropertyValue('--navbar-height') || '80',
        10
      );
      var top = target.getBoundingClientRect().top + window.scrollY - navbarHeight - 16;
      window.scrollTo({ top: top, behavior: 'smooth' });
    });
  });

  /* ── Floating label activation ─────────────────────────────────────── */
  function initFloatingLabels() {
    document.querySelectorAll('.floating-label-group input, .floating-label-group textarea, .floating-label-group select').forEach(function (field) {
      /* Mark as active if pre-filled */
      if (field.value) field.classList.add('has-value');

      field.addEventListener('input', function () {
        this.classList.toggle('has-value', this.value.length > 0);
      });

      field.addEventListener('change', function () {
        this.classList.toggle('has-value', this.value.length > 0);
      });
    });
  }

  /* ── Form submit: loading state ────────────────────────────────────── */
  function initFormSubmit() {
    document.querySelectorAll('form[action*="pageone.cloud"]').forEach(function (form) {
      form.addEventListener('submit', function () {
        var btn = form.querySelector('[type="submit"]');
        if (!btn) return;
        btn.disabled = true;
        btn.dataset.originalText = btn.textContent;
        btn.textContent = 'Sending…';
      });
    });
  }

  /* ── Swiper carousel init (reviews + galleries) ─────────────────────── */
  function initSwipers() {
    if (typeof Swiper === 'undefined') return;

    /* Reviews carousel */
    document.querySelectorAll('.reviews-swiper').forEach(function (el) {
      new Swiper(el, {
        loop:          true,
        slidesPerView: 1,
        spaceBetween:  24,
        autoplay:      { delay: 5000, disableOnInteraction: false, pauseOnMouseEnter: true },
        pagination:    { el: el.querySelector('.swiper-pagination'), clickable: true },
        breakpoints:   { 768: { slidesPerView: 2 }, 1024: { slidesPerView: 3 } },
        a11y:          { prevSlideMessage: 'Previous review', nextSlideMessage: 'Next review' }
      });
    });

    /* Gallery / before-after carousels */
    document.querySelectorAll('.gallery-swiper').forEach(function (el) {
      new Swiper(el, {
        loop:        true,
        slidesPerView: 1,
        spaceBetween: 16,
        navigation:  {
          nextEl: el.querySelector('.swiper-button-next'),
          prevEl: el.querySelector('.swiper-button-prev')
        },
        pagination: { el: el.querySelector('.swiper-pagination'), clickable: true },
        keyboard:   { enabled: true }
      });
    });
  }

  /* ── Init ─────────────────────────────────────────────────────────── */
  function init() {
    initFloatingLabels();
    initFormSubmit();
    initSwipers();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }

  /* Re-init Swipers if loaded after DOMContentLoaded */
  window.addEventListener('load', initSwipers, { once: true });

}());
