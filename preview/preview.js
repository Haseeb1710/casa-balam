/**
 * CASA BĀLAM - Interactive Storefront Preview Script
 */

(function() {
  'use strict';

  document.addEventListener('DOMContentLoaded', function() {
    initStickyHeader();
    initMobileDrawer();
    initLandingPageControls();
    updateCopyrightYear();
  });

  /**
   * Transparent to Sticky Header Transition on Scroll
   */
  function initStickyHeader() {
    const header = document.getElementById('cb-site-header');
    if (!header) return;

    const scrollThreshold = 80;

    function handleScroll() {
      const scrollY = window.scrollY || window.pageYOffset;
      if (scrollY > scrollThreshold) {
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
    }

    window.addEventListener('scroll', handleScroll, { passive: true });
    handleScroll();
  }

  /**
   * Mobile Menu Drawer Toggle
   */
  function initMobileDrawer() {
    const toggleBtn = document.querySelector('.cb-mobile-toggle');
    const drawer = document.getElementById('cb-mobile-nav');
    const closeBtn = document.querySelector('.cb-drawer-close');

    if (!toggleBtn || !drawer) return;

    // Self-healing: create backdrop if somehow missing from DOM
    let backdrop = document.getElementById('cb-nav-backdrop');
    if (!backdrop) {
      backdrop = document.createElement('div');
      backdrop.id = 'cb-nav-backdrop';
      backdrop.className = 'cb-backdrop';
      document.body.appendChild(backdrop);
    }

    function openDrawer() {
      drawer.classList.add('is-open');
      drawer.removeAttribute('aria-hidden');
      backdrop.classList.add('is-active');
      toggleBtn.setAttribute('aria-expanded', 'true');
      document.body.style.overflow = 'hidden';
    }

    function closeDrawer() {
      drawer.classList.remove('is-open');
      drawer.setAttribute('aria-hidden', 'true');
      backdrop.classList.remove('is-active');
      toggleBtn.setAttribute('aria-expanded', 'false');
      document.body.style.overflow = '';
    }

    toggleBtn.addEventListener('click', function(e) {
      e.preventDefault();
      drawer.classList.contains('is-open') ? closeDrawer() : openDrawer();
    });

    if (closeBtn) {
      closeBtn.addEventListener('click', function(e) {
        e.preventDefault();
        closeDrawer();
      });
    }

    backdrop.addEventListener('click', closeDrawer);

    // Close drawer when a menu link is tapped (navigates to section)
    drawer.querySelectorAll('.cb-mobile-menu a').forEach(function(link) {
      link.addEventListener('click', closeDrawer);
    });

    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape' && drawer.classList.contains('is-open')) {
        closeDrawer();
      }
    });
  }


  /**
   * Interactive Landing Page Display Controls (Header/Footer hide simulation)
   */
  function initLandingPageControls() {
    const headerCheck = document.getElementById('toggle-hide-header');
    const footerCheck = document.getElementById('toggle-hide-footer');

    if (headerCheck) {
      headerCheck.addEventListener('change', function() {
        if (this.checked) {
          document.body.classList.add('hide-header');
          showStatusNotice('Header & Navigation hidden (Performance Landing Page Mode active)');
        } else {
          document.body.classList.remove('hide-header');
          showStatusNotice('Header & Navigation restored (Default Storefront Mode)');
        }
      });
    }

    if (footerCheck) {
      footerCheck.addEventListener('change', function() {
        if (this.checked) {
          document.body.classList.add('hide-footer');
          showStatusNotice('Site Footer hidden (Performance Landing Page Mode active)');
        } else {
          document.body.classList.remove('hide-footer');
          showStatusNotice('Site Footer restored (Default Storefront Mode)');
        }
      });
    }
  }

  /**
   * Transient status toast
   */
  function showStatusNotice(msg) {
    let toast = document.getElementById('cb-status-toast');
    if (!toast) {
      toast = document.createElement('div');
      toast.id = 'cb-status-toast';
      toast.style.cssText = `
        position: fixed;
        top: 24px;
        right: 24px;
        background: #F5E3E6;
        color: #3B302B;
        border: 1px solid rgba(216, 184, 180, 0.6);
        font-family: 'Montserrat', sans-serif;
        font-size: 0.8rem;
        font-weight: 500;
        letter-spacing: 0.04em;
        padding: 12px 20px;
        border-radius: 8px;
        box-shadow: 0 8px 24px rgba(59, 48, 43, 0.12);
        z-index: 10000;
        transition: opacity 0.3s ease, transform 0.3s ease;
        opacity: 0;
        transform: translateY(-10px);
      `;
      document.body.appendChild(toast);
    }
    toast.textContent = msg;
    toast.style.opacity = '1';
    toast.style.transform = 'translateY(0)';

    clearTimeout(window.cbToastTimer);
    window.cbToastTimer = setTimeout(function() {
      toast.style.opacity = '0';
      toast.style.transform = 'translateY(-10px)';
    }, 2600);
  }

  /**
   * Ensure Current Dynamic Year
   */
  function updateCopyrightYear() {
    const yearEl = document.getElementById('cb-dynamic-year');
    if (yearEl) {
      yearEl.textContent = new Date().getFullYear();
    }
  }

})();
