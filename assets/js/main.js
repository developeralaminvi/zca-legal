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

  // 6. Practice Areas: Instant Live Search & Dynamic Taxonomy Filter
  const practiceSearchInput = document.getElementById('practiceSearchInput');
  const practiceMobileSearch = document.getElementById('practiceMobileSearch');
  const practiceSearchClear = document.getElementById('practiceSearchClear');
  const practiceFilterBtns = document.querySelectorAll('.practice-filter-btn');
  const practiceOffcanvasItems = document.querySelectorAll('.practice-offcanvas-cat');
  const practiceCards = document.querySelectorAll('.practice-img-card, .practice-card');
  const practiceNoResults = document.getElementById('practiceNoResults');
  const practiceCountInfo = document.getElementById('practiceCountInfo');
  const practiceTriggerBtn = document.getElementById('practiceFilterTriggerBtn');

  let currentPracticeCategory = 'all';
  let currentPracticeQuery = '';

  function filterPracticeAreas() {
    let visibleCount = 0;
    const query = currentPracticeQuery.toLowerCase().trim();

    practiceCards.forEach(card => {
      const rawCat = (card.getAttribute('data-category') || '').toLowerCase();
      const cardCats = rawCat.split(' ');
      const textContent = card.innerText.toLowerCase();

      const matchesCategory = (
        currentPracticeCategory === 'all' || 
        cardCats.includes(currentPracticeCategory.toLowerCase()) ||
        rawCat === currentPracticeCategory.toLowerCase()
      );
      const matchesSearch = (!query || textContent.includes(query));

      if (matchesCategory && matchesSearch) {
        card.style.display = 'flex';
        visibleCount++;
      } else {
        card.style.display = 'none';
      }
    });

    if (practiceNoResults) {
      practiceNoResults.style.display = visibleCount === 0 ? 'block' : 'none';
    }

    if (practiceCountInfo) {
      if (query || currentPracticeCategory !== 'all') {
        practiceCountInfo.textContent = `Showing ${visibleCount} practice area${visibleCount !== 1 ? 's' : ''}`;
      } else {
        practiceCountInfo.textContent = `Showing all ${visibleCount} practice areas`;
      }
    }

    // Update Mobile Button Text
    if (practiceTriggerBtn) {
      if (currentPracticeCategory !== 'all') {
        practiceTriggerBtn.innerHTML = `<i class="fa-solid fa-sliders"></i> Filter (${currentPracticeCategory.toUpperCase()}) • ${visibleCount}`;
      } else {
        practiceTriggerBtn.innerHTML = `<i class="fa-solid fa-sliders"></i> Filter & Categories (${visibleCount})`;
      }
    }
  }

  // Handle Practice Search Input (Desktop & Mobile)
  function handlePracticeSearch(query) {
    currentPracticeQuery = query;
    if (practiceSearchInput && practiceSearchInput.value !== query) practiceSearchInput.value = query;
    if (practiceMobileSearch && practiceMobileSearch.value !== query) practiceMobileSearch.value = query;
    if (practiceSearchClear) {
      practiceSearchClear.style.display = query ? 'block' : 'none';
    }
    filterPracticeAreas();
  }

  practiceSearchInput?.addEventListener('input', (e) => handlePracticeSearch(e.target.value));
  practiceMobileSearch?.addEventListener('input', (e) => handlePracticeSearch(e.target.value));

  practiceSearchClear?.addEventListener('click', () => {
    handlePracticeSearch('');
    practiceSearchInput?.focus();
  });

  // Desktop Practice Filter Buttons
  practiceFilterBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      practiceFilterBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      currentPracticeCategory = btn.getAttribute('data-category') || 'all';

      // Sync off-canvas items
      practiceOffcanvasItems.forEach(item => {
        item.classList.toggle('active', item.getAttribute('data-category') === currentPracticeCategory);
      });

      filterPracticeAreas();
    });
  });

  // Mobile Off-Canvas Practice Filter Items
  practiceOffcanvasItems.forEach(item => {
    item.addEventListener('click', () => {
      practiceOffcanvasItems.forEach(i => i.classList.remove('active'));
      item.classList.add('active');
      currentPracticeCategory = item.getAttribute('data-category') || 'all';

      // Sync desktop buttons
      practiceFilterBtns.forEach(btn => {
        btn.classList.toggle('active', btn.getAttribute('data-category') === currentPracticeCategory);
      });

      filterPracticeAreas();
      window.closeFilterDrawer('practiceFilterDrawer');
    });
  });

  window.resetPracticeFilters = function() {
    handlePracticeSearch('');
    currentPracticeCategory = 'all';
    practiceFilterBtns.forEach(b => b.classList.remove('active'));
    document.querySelector('.practice-filter-btn[data-category="all"]')?.classList.add('active');
    practiceOffcanvasItems.forEach(i => i.classList.remove('active'));
    document.querySelector('.practice-offcanvas-cat[data-category="all"]')?.classList.add('active');
    filterPracticeAreas();
    window.closeFilterDrawer('practiceFilterDrawer');
  };

  // 7. Blog: Instant Live Search & Dynamic Taxonomy Filter
  const blogSearchInput = document.getElementById('blogSearchInput');
  const blogMobileSearch = document.getElementById('blogMobileSearch');
  const blogSearchClear = document.getElementById('blogSearchClear');
  const blogFilterBtns = document.querySelectorAll('.blog-filter-btn');
  const blogOffcanvasItems = document.querySelectorAll('.blog-offcanvas-cat');
  const blogCards = document.querySelectorAll('.blog-post-card, article.award-card');
  const blogNoResults = document.getElementById('blogNoResults');
  const blogCountInfo = document.getElementById('blogCountInfo');
  const blogTriggerBtn = document.getElementById('blogFilterTriggerBtn');

  let currentBlogCategory = 'all';
  let currentBlogQuery = '';

  function filterBlogPosts() {
    let visibleCount = 0;
    const query = currentBlogQuery.toLowerCase().trim();

    blogCards.forEach(card => {
      const rawCat = (card.getAttribute('data-category') || '').toLowerCase();
      const cardCats = rawCat.split(' ');
      const textContent = card.innerText.toLowerCase();

      const matchesCategory = (
        currentBlogCategory === 'all' || 
        cardCats.includes(currentBlogCategory.toLowerCase()) ||
        rawCat === currentBlogCategory.toLowerCase()
      );
      const matchesSearch = (!query || textContent.includes(query));

      if (matchesCategory && matchesSearch) {
        card.style.display = 'flex';
        visibleCount++;
      } else {
        card.style.display = 'none';
      }
    });

    if (blogNoResults) {
      blogNoResults.style.display = visibleCount === 0 ? 'block' : 'none';
    }

    if (blogCountInfo) {
      if (query || currentBlogCategory !== 'all') {
        blogCountInfo.textContent = `Showing ${visibleCount} article${visibleCount !== 1 ? 's' : ''}`;
      } else {
        blogCountInfo.textContent = `Showing all ${visibleCount} articles`;
      }
    }

    if (blogTriggerBtn) {
      if (currentBlogCategory !== 'all') {
        blogTriggerBtn.innerHTML = `<i class="fa-solid fa-sliders"></i> Filter (${currentBlogCategory.toUpperCase()}) • ${visibleCount}`;
      } else {
        blogTriggerBtn.innerHTML = `<i class="fa-solid fa-sliders"></i> Filter & Categories (${visibleCount})`;
      }
    }
  }

  function handleBlogSearch(query) {
    currentBlogQuery = query;
    if (blogSearchInput && blogSearchInput.value !== query) blogSearchInput.value = query;
    if (blogMobileSearch && blogMobileSearch.value !== query) blogMobileSearch.value = query;
    if (blogSearchClear) {
      blogSearchClear.style.display = query ? 'block' : 'none';
    }
    filterBlogPosts();
  }

  blogSearchInput?.addEventListener('input', (e) => handleBlogSearch(e.target.value));
  blogMobileSearch?.addEventListener('input', (e) => handleBlogSearch(e.target.value));

  blogSearchClear?.addEventListener('click', () => {
    handleBlogSearch('');
    blogSearchInput?.focus();
  });

  blogFilterBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      blogFilterBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      currentBlogCategory = btn.getAttribute('data-category') || 'all';

      blogOffcanvasItems.forEach(item => {
        item.classList.toggle('active', item.getAttribute('data-category') === currentBlogCategory);
      });

      filterBlogPosts();
    });
  });

  blogOffcanvasItems.forEach(item => {
    item.addEventListener('click', () => {
      blogOffcanvasItems.forEach(i => i.classList.remove('active'));
      item.classList.add('active');
      currentBlogCategory = item.getAttribute('data-category') || 'all';

      blogFilterBtns.forEach(btn => {
        btn.classList.toggle('active', btn.getAttribute('data-category') === currentBlogCategory);
      });

      filterBlogPosts();
      window.closeFilterDrawer('blogFilterDrawer');
    });
  });

  window.resetBlogFilters = function() {
    handleBlogSearch('');
    currentBlogCategory = 'all';
    blogFilterBtns.forEach(b => b.classList.remove('active'));
    document.querySelector('.blog-filter-btn[data-category="all"]')?.classList.add('active');
    blogOffcanvasItems.forEach(i => i.classList.remove('active'));
    document.querySelector('.blog-offcanvas-cat[data-category="all"]')?.classList.add('active');
    filterBlogPosts();
    window.closeFilterDrawer('blogFilterDrawer');
  };

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
