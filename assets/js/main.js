/**
 * ZCA LEGAL - Interactive Script Engine
 * Handles Sticky Nav, Modals, Payment Gateways, Dynamic Search & Filters, Off-Canvas Mobile Drawer, and Lightbox.
 */

document.addEventListener('DOMContentLoaded', () => {
  // 1. Sticky Header on Scroll
  const header = document.querySelector('.site-header');
  window.addEventListener('scroll', () => {
    if (window.scrollY > 40) {
      header?.classList.add('scrolled');
    } else {
      header?.classList.remove('scrolled');
    }
  });

  // 2. Mobile Navigation Drawer
  const hamburgerBtn = document.querySelector('.hamburger-btn');
  const navMenu = document.querySelector('.nav-menu');

  hamburgerBtn?.addEventListener('click', () => {
    hamburgerBtn.classList.toggle('active');
    navMenu?.classList.toggle('active');
  });

  document.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', () => {
      hamburgerBtn?.classList.remove('active');
      navMenu?.classList.remove('active');
    });
  });

  // 3. Modal Engine
  window.openModal = function(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
      modal.classList.add('active');
      document.body.style.overflow = 'hidden';
    }
  };

  window.closeModal = function(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
      modal.classList.remove('active');
      document.body.style.overflow = '';
    }
  };

  document.querySelectorAll('.modal-backdrop').forEach(backdrop => {
    backdrop.addEventListener('click', (e) => {
      if (e.target === backdrop) {
        backdrop.classList.remove('active');
        document.body.style.overflow = '';
      }
    });
  });

  // 4. Payment Gateway Simulation & Method Selector
  const paymentMethods = document.querySelectorAll('.payment-method-item');
  let selectedMethod = 'bkash';

  paymentMethods.forEach(method => {
    method.addEventListener('click', () => {
      paymentMethods.forEach(m => m.classList.remove('active'));
      method.classList.add('active');
      selectedMethod = method.getAttribute('data-method');
      
      // Switch active payment detail box
      document.querySelectorAll('.payment-detail-box').forEach(box => {
        box.classList.remove('active');
      });
      const targetBox = document.getElementById('method-' + selectedMethod);
      if (targetBox) {
        targetBox.classList.add('active');
      }
    });
  });

  // 5. Off-Canvas Filter Drawer (Mobile)
  window.openFilterDrawer = function(drawerId) {
    const drawer = document.getElementById(drawerId || 'filterDrawer');
    const backdrop = document.getElementById('filterDrawerBackdrop');
    if (drawer) {
      drawer.classList.add('active');
      if (backdrop) backdrop.classList.add('active');
      document.body.style.overflow = 'hidden';
    }
  };

  window.closeFilterDrawer = function(drawerId) {
    const drawer = document.getElementById(drawerId || 'filterDrawer');
    const backdrop = document.getElementById('filterDrawerBackdrop');
    if (drawer) {
      drawer.classList.remove('active');
      if (backdrop) backdrop.classList.remove('active');
      document.body.style.overflow = '';
    }
  };

  const filterBackdrop = document.getElementById('filterDrawerBackdrop');
  filterBackdrop?.addEventListener('click', () => {
    window.closeFilterDrawer('practiceFilterDrawer');
    window.closeFilterDrawer('blogFilterDrawer');
  });

  // 6. Practice Areas: Server-Synced AJAX Category Filter, Pagination & Live Keyword Search
  (function initPracticeFilter() {
    const grid = document.getElementById('practiceGridContainer');
    if (!grid) return;

    const desktopTabs = document.getElementById('practiceFilterTabs');
    const drawerList = document.querySelector('#practiceFilterDrawer .offcanvas-category-list');
    const paginationWrapper = document.getElementById('practicePaginationWrapper');
    const countInfo = document.getElementById('practiceCountInfo');
    const searchInput = document.getElementById('practiceSearchInput');
    const mobileSearch = document.getElementById('practiceMobileSearch');
    const searchClear = document.getElementById('practiceSearchClear');
    const triggerBtn = document.getElementById('practiceFilterTriggerBtn');
    const noResults = document.getElementById('practiceNoResults');

    let isFetching = false;

    // Core AJAX Content Fetcher
    async function fetchPracticeContent(url, pushState = true) {
      if (isFetching) return;
      isFetching = true;

      // Visual loading state
      grid.style.opacity = '0.35';
      grid.style.pointerEvents = 'none';
      grid.style.transition = 'opacity 0.2s ease';

      try {
        const response = await fetch(url, {
          headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });
        if (!response.ok) throw new Error(`HTTP ${response.status}`);
        const html = await response.text();
        const doc = new DOMParser().parseFromString(html, 'text/html');

        // 1. Update Grid Content
        const newGrid = doc.getElementById('practiceGridContainer');
        if (newGrid) {
          grid.innerHTML = newGrid.innerHTML;
        }

        // 2. Update Pagination Controls
        const newPagination = doc.getElementById('practicePaginationWrapper');
        if (newPagination && paginationWrapper) {
          paginationWrapper.innerHTML = newPagination.innerHTML;
          paginationWrapper.style.display = newPagination.style.display;
        }

        // 3. Update Result Count Text
        const newCount = doc.getElementById('practiceCountInfo');
        if (newCount && countInfo) {
          countInfo.innerHTML = newCount.innerHTML;
        }

        // 4. Synchronize Desktop Filter Tabs
        const newDesktopTabs = doc.getElementById('practiceFilterTabs');
        if (newDesktopTabs && desktopTabs) {
          desktopTabs.innerHTML = newDesktopTabs.innerHTML;
        }

        // 5. Synchronize Off-Canvas Drawer Category Items
        const newDrawerList = doc.querySelector('#practiceFilterDrawer .offcanvas-category-list');
        if (newDrawerList && drawerList) {
          drawerList.innerHTML = newDrawerList.innerHTML;
        }

        // 6. Update Mobile Filter Trigger Button Badge
        const parsedUrl = new URL(url, window.location.origin);
        const catSlug = parsedUrl.searchParams.get('category') || 'all';
        if (triggerBtn) {
          const visibleCount = grid.querySelectorAll('.practice-img-card, .practice-card').length;
          if (catSlug !== 'all') {
            triggerBtn.innerHTML = `<i class="fa-solid fa-sliders"></i> Filter (${catSlug.toUpperCase()}) • ${visibleCount}`;
          } else {
            triggerBtn.innerHTML = `<i class="fa-solid fa-sliders"></i> Filter & Categories (${visibleCount})`;
          }
        }

        // Reset search field
        if (searchInput) searchInput.value = '';
        if (mobileSearch) mobileSearch.value = '';
        if (searchClear) searchClear.style.display = 'none';
        if (noResults) noResults.style.display = 'none';

        // 7. Update browser URL & state
        if (pushState) {
          window.history.pushState({ type: 'practice', url: url }, '', url);
        }

        // Smooth scroll back to top of practice section if user scrolled down
        const section = grid.closest('section');
        if (section) {
          const targetY = section.getBoundingClientRect().top + window.pageYOffset - 100;
          if (window.pageYOffset > targetY) {
            window.scrollTo({ top: targetY, behavior: 'smooth' });
          }
        }
      } catch (err) {
        console.warn('Practice areas AJAX fetch failed, falling back to page reload:', err);
        window.location.href = url;
      } finally {
        grid.style.opacity = '1';
        grid.style.pointerEvents = 'auto';
        isFetching = false;
      }
    }

    // Intercept clicks on Desktop Category Tabs
    desktopTabs?.addEventListener('click', (e) => {
      const link = e.target.closest('.practice-filter-btn');
      if (link && link.href) {
        e.preventDefault();
        fetchPracticeContent(link.href, true);
      }
    });

    // Intercept clicks on Mobile Drawer Category Links
    drawerList?.addEventListener('click', (e) => {
      const link = e.target.closest('.practice-offcanvas-cat');
      if (link && link.href) {
        e.preventDefault();
        window.closeFilterDrawer('practiceFilterDrawer');
        fetchPracticeContent(link.href, true);
      }
    });

    // Intercept clicks on Pagination Links
    paginationWrapper?.addEventListener('click', (e) => {
      const link = e.target.closest('a.page-numbers');
      if (link && link.href) {
        e.preventDefault();
        fetchPracticeContent(link.href, true);
      }
    });

    // Reset Filter Function
    window.resetPracticeFilters = function() {
      const allTab = desktopTabs?.querySelector('.practice-filter-btn[data-category="all"]');
      const resetUrl = allTab ? allTab.href : window.location.pathname;
      window.closeFilterDrawer('practiceFilterDrawer');
      fetchPracticeContent(resetUrl, true);
    };

    // Instant In-Page Keyword Search
    function filterLoadedPracticeCards(query) {
      const q = (query || '').toLowerCase().trim();
      const cards = grid.querySelectorAll('.practice-img-card, .practice-card');
      let visible = 0;

      cards.forEach(card => {
        const text = card.innerText.toLowerCase();
        const matches = !q || text.includes(q);
        card.style.display = matches ? 'flex' : 'none';
        if (matches) visible++;
      });

      if (noResults) {
        noResults.style.display = visible === 0 ? 'block' : 'none';
      }

      if (countInfo) {
        if (q) {
          countInfo.textContent = `Found ${visible} matching practice area${visible !== 1 ? 's' : ''}`;
        } else {
          countInfo.textContent = `Showing all ${cards.length} practice areas`;
        }
      }
    }

    function handlePracticeSearch(query) {
      if (searchInput && searchInput.value !== query) searchInput.value = query;
      if (mobileSearch && mobileSearch.value !== query) mobileSearch.value = query;
      if (searchClear) searchClear.style.display = query ? 'block' : 'none';
      filterLoadedPracticeCards(query);
    }

    searchInput?.addEventListener('input', (e) => handlePracticeSearch(e.target.value));
    mobileSearch?.addEventListener('input', (e) => handlePracticeSearch(e.target.value));
    searchClear?.addEventListener('click', () => {
      handlePracticeSearch('');
      searchInput?.focus();
    });

    // Browser back/forward navigation support
    window.addEventListener('popstate', () => {
      if (document.getElementById('practiceGridContainer')) {
        fetchPracticeContent(window.location.href, false);
      }
    });
  })();

  // 7. Blog: Server-Synced AJAX Category Filter, Pagination & Live Keyword Search
  (function initBlogFilter() {
    const grid = document.getElementById('blogGridContainer');
    if (!grid) return;

    const desktopTabs = document.getElementById('blogFilterTabs');
    const drawerList = document.querySelector('#blogFilterDrawer .offcanvas-category-list');
    const paginationWrapper = document.getElementById('blogPaginationWrapper');
    const countInfo = document.getElementById('blogCountInfo');
    const searchInput = document.getElementById('blogSearchInput');
    const mobileSearch = document.getElementById('blogMobileSearch');
    const searchClear = document.getElementById('blogSearchClear');
    const triggerBtn = document.getElementById('blogFilterTriggerBtn');
    const noResults = document.getElementById('blogNoResults');

    let isFetching = false;

    // Core AJAX Content Fetcher
    async function fetchBlogContent(url, pushState = true) {
      if (isFetching) return;
      isFetching = true;

      // Visual loading state
      grid.style.opacity = '0.35';
      grid.style.pointerEvents = 'none';
      grid.style.transition = 'opacity 0.2s ease';

      try {
        const response = await fetch(url, {
          headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });
        if (!response.ok) throw new Error(`HTTP ${response.status}`);
        const html = await response.text();
        const doc = new DOMParser().parseFromString(html, 'text/html');

        // 1. Update Grid Content
        const newGrid = doc.getElementById('blogGridContainer');
        if (newGrid) {
          grid.innerHTML = newGrid.innerHTML;
        }

        // 2. Update Pagination Controls
        const newPagination = doc.getElementById('blogPaginationWrapper');
        if (newPagination && paginationWrapper) {
          paginationWrapper.innerHTML = newPagination.innerHTML;
          paginationWrapper.style.display = newPagination.style.display;
        }

        // 3. Update Result Count Text
        const newCount = doc.getElementById('blogCountInfo');
        if (newCount && countInfo) {
          countInfo.innerHTML = newCount.innerHTML;
        }

        // 4. Synchronize Desktop Filter Tabs
        const newDesktopTabs = doc.getElementById('blogFilterTabs');
        if (newDesktopTabs && desktopTabs) {
          desktopTabs.innerHTML = newDesktopTabs.innerHTML;
        }

        // 5. Synchronize Off-Canvas Drawer Category Items
        const newDrawerList = doc.querySelector('#blogFilterDrawer .offcanvas-category-list');
        if (newDrawerList && drawerList) {
          drawerList.innerHTML = newDrawerList.innerHTML;
        }

        // 6. Update Mobile Filter Trigger Button Badge
        const parsedUrl = new URL(url, window.location.origin);
        const catSlug = parsedUrl.searchParams.get('category') || 'all';
        if (triggerBtn) {
          const visibleCount = grid.querySelectorAll('.blog-post-card, article.award-card').length;
          if (catSlug !== 'all') {
            triggerBtn.innerHTML = `<i class="fa-solid fa-sliders"></i> Filter (${catSlug.toUpperCase()}) • ${visibleCount}`;
          } else {
            triggerBtn.innerHTML = `<i class="fa-solid fa-sliders"></i> Filter & Categories (${visibleCount})`;
          }
        }

        // Reset search field
        if (searchInput) searchInput.value = '';
        if (mobileSearch) mobileSearch.value = '';
        if (searchClear) searchClear.style.display = 'none';
        if (noResults) noResults.style.display = 'none';

        // 7. Update browser URL & state
        if (pushState) {
          window.history.pushState({ type: 'blog', url: url }, '', url);
        }

        // Smooth scroll back to top of blog section if user scrolled down
        const section = grid.closest('section');
        if (section) {
          const targetY = section.getBoundingClientRect().top + window.pageYOffset - 100;
          if (window.pageYOffset > targetY) {
            window.scrollTo({ top: targetY, behavior: 'smooth' });
          }
        }
      } catch (err) {
        console.warn('Blog AJAX fetch failed, falling back to page reload:', err);
        window.location.href = url;
      } finally {
        grid.style.opacity = '1';
        grid.style.pointerEvents = 'auto';
        isFetching = false;
      }
    }

    // Intercept clicks on Desktop Category Tabs
    desktopTabs?.addEventListener('click', (e) => {
      const link = e.target.closest('.blog-filter-btn');
      if (link && link.href) {
        e.preventDefault();
        fetchBlogContent(link.href, true);
      }
    });

    // Intercept clicks on Mobile Drawer Category Links
    drawerList?.addEventListener('click', (e) => {
      const link = e.target.closest('.blog-offcanvas-cat');
      if (link && link.href) {
        e.preventDefault();
        window.closeFilterDrawer('blogFilterDrawer');
        fetchBlogContent(link.href, true);
      }
    });

    // Intercept clicks on Pagination Links
    paginationWrapper?.addEventListener('click', (e) => {
      const link = e.target.closest('a.page-numbers');
      if (link && link.href) {
        e.preventDefault();
        fetchBlogContent(link.href, true);
      }
    });

    // Reset Filter Function
    window.resetBlogFilters = function() {
      const allTab = desktopTabs?.querySelector('.blog-filter-btn[data-category="all"]');
      const resetUrl = allTab ? allTab.href : window.location.pathname;
      window.closeFilterDrawer('blogFilterDrawer');
      fetchBlogContent(resetUrl, true);
    };

    // Instant In-Page Keyword Search
    function filterLoadedBlogCards(query) {
      const q = (query || '').toLowerCase().trim();
      const cards = grid.querySelectorAll('.blog-post-card, article.award-card');
      let visible = 0;

      cards.forEach(card => {
        const text = card.innerText.toLowerCase();
        const matches = !q || text.includes(q);
        card.style.display = matches ? 'flex' : 'none';
        if (matches) visible++;
      });

      if (noResults) {
        noResults.style.display = visible === 0 ? 'block' : 'none';
      }

      if (countInfo) {
        if (q) {
          countInfo.textContent = `Found ${visible} matching article${visible !== 1 ? 's' : ''}`;
        } else {
          countInfo.textContent = `Showing all ${cards.length} articles`;
        }
      }
    }

    function handleBlogSearch(query) {
      if (blogSearchInput && blogSearchInput.value !== query) blogSearchInput.value = query;
      if (blogMobileSearch && blogMobileSearch.value !== query) blogMobileSearch.value = query;
      if (blogSearchClear) blogSearchClear.style.display = query ? 'block' : 'none';
      filterLoadedBlogCards(query);
    }

    searchInput?.addEventListener('input', (e) => handleBlogSearch(e.target.value));
    mobileSearch?.addEventListener('input', (e) => handleBlogSearch(e.target.value));
    searchClear?.addEventListener('click', () => {
      handleBlogSearch('');
      searchInput?.focus();
    });

    // Browser back/forward navigation support
    window.addEventListener('popstate', () => {
      if (document.getElementById('blogGridContainer')) {
        fetchBlogContent(window.location.href, false);
      }
    });
  })();

  // 8. Gallery Filter & Lightbox
  const galleryFilterBtns = document.querySelectorAll('.gallery-filter-btn');
  const galleryItems = document.querySelectorAll('.gallery-item');

  galleryFilterBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      galleryFilterBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      const filter = btn.getAttribute('data-filter');

      galleryItems.forEach(item => {
        if (filter === 'all' || item.getAttribute('data-filter') === filter) {
          item.style.display = 'block';
        } else {
          item.style.display = 'none';
        }
      });
    });
  });

  window.openLightbox = function(imageSrc, captionText) {
    const lightbox = document.getElementById('lightboxModal');
    const lightboxImg = document.getElementById('lightboxImg');
    const lightboxCaption = document.getElementById('lightboxCaption');
    if (lightbox && lightboxImg) {
      lightboxImg.src = imageSrc;
      if (lightboxCaption) lightboxCaption.textContent = captionText || '';
      lightbox.classList.add('active');
    }
  };

  // 9. WhatsApp Quick Direct Connect
  window.openWhatsApp = function(customText) {
    const phone = "8801713203275";
    const msg = encodeURIComponent(customText || "Hello ZCA Legal, I would like to inquire about legal consultation and retainer services.");
    window.open(`https://wa.me/${phone}?text=${msg}`, '_blank');
  };

  // 10. Copy Post Link Handler
  window.copyPostLink = function(button, url) {
    const targetUrl = url || window.location.href;
    const origHtml = button.innerHTML;

    if (navigator.clipboard && window.isSecureContext) {
      navigator.clipboard.writeText(targetUrl).then(() => {
        showCopySuccess(button, origHtml);
      }).catch(() => {
        fallbackCopy(targetUrl, button, origHtml);
      });
    } else {
      fallbackCopy(targetUrl, button, origHtml);
    }
  };

  function fallbackCopy(text, button, origHtml) {
    const textArea = document.createElement('textarea');
    textArea.value = text;
    textArea.style.position = 'fixed';
    textArea.style.left = '-9999px';
    textArea.style.top = '0';
    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();
    try {
      document.execCommand('copy');
      showCopySuccess(button, origHtml);
    } catch (err) {
      console.error('Copy link failed', err);
    }
    document.body.removeChild(textArea);
  }

  function showCopySuccess(button, origHtml) {
    button.classList.add('copied');
    button.innerHTML = '<i class="fa-solid fa-check"></i> <span class="copy-text">Copied!</span>';
    setTimeout(() => {
      button.classList.remove('copied');
      button.innerHTML = origHtml;
    }, 2500);
  }
});
