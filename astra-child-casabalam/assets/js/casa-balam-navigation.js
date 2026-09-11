/**
 * Casa Bālam - Navigation & Sticky Header Behavior
 * 
 * Handles:
 * 1. Smooth transparent-to-sticky header transition on scroll
 * 2. Mobile navigation drawer open/close
 * 3. Accessibility controls
 * 
 * @package Astra_Child_Casa_Balam
 */

(function() {
  'use strict';

  document.addEventListener('DOMContentLoaded', function() {
    initStickyHeader();
    initMobileNav();
  });

  /**
   * Sticky Header Scroll Transition
   */
  function initStickyHeader() {
    const header = document.getElementById('cb-site-header');
    if (!header) return;

    let lastScrollY = window.scrollY;
    let ticking = false;
    const scrollThreshold = 70; // Transition trigger offset

    function updateHeader() {
      const currentScrollY = window.scrollY;

      if (currentScrollY > scrollThreshold) {
        if (!header.classList.contains('cb-header-is-sticky')) {
          header.classList.add('cb-header-is-sticky');
          header.classList.remove('transparent-header');
        }
      } else {
        if (header.classList.contains('cb-header-is-sticky')) {
          header.classList.remove('cb-header-is-sticky');
          header.classList.add('transparent-header');
        }
      }

      lastScrollY = currentScrollY;
      ticking = false;
    }

    window.addEventListener('scroll', function() {
      if (!ticking) {
        window.requestAnimationFrame(updateHeader);
        ticking = true;
      }
    }, { passive: true });

    // Initial check on load
    updateHeader();
  }

  /**
   * Mobile Drawer Navigation
   */
  function initMobileNav() {
    const toggleBtn = document.querySelector('.cb-mobile-toggle');
    const drawer = document.getElementById('cb-mobile-nav');
    const backdrop = document.getElementById('cb-nav-backdrop');
    const closeBtn = document.querySelector('.cb-drawer-close');

    if (!toggleBtn || !drawer || !backdrop) return;

    function openDrawer() {
      drawer.classList.add('is-open');
      backdrop.classList.add('is-active');
      toggleBtn.setAttribute('aria-expanded', 'true');
      drawer.setAttribute('aria-hidden', 'false');
      document.body.style.overflow = 'hidden';
    }

    function closeDrawer() {
      drawer.classList.remove('is-open');
      backdrop.classList.remove('is-active');
      toggleBtn.setAttribute('aria-expanded', 'false');
      drawer.setAttribute('aria-hidden', 'true');
      document.body.style.overflow = '';
    }

    toggleBtn.addEventListener('click', function(e) {
      e.preventDefault();
      const isOpen = drawer.classList.contains('is-open');
      if (isOpen) {
        closeDrawer();
      } else {
        openDrawer();
      }
    });

    if (closeBtn) {
      closeBtn.addEventListener('click', function(e) {
        e.preventDefault();
        closeDrawer();
      });
    }

    backdrop.addEventListener('click', closeDrawer);

    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape' && drawer.classList.contains('is-open')) {
        closeDrawer();
      }
    });
  }

})();
