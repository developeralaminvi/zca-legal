<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/logo-dcci.png" type="image/png">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

  <!-- 1. Top Bar (Desktop only, dynamically populated from Theme Settings) -->
  <div class="topbar">
    <div class="container">
      <div class="topbar-left">
        <span class="topbar-item">
          <i class="fa-solid fa-location-dot"></i> 
          <span><?php echo esc_html(zca_get_option('chamber1_title', 'Corporate Chamber: Mirpur DOHS, Dhaka 1216')); ?></span>
        </span>
        <span class="topbar-item">
          <i class="fa-solid fa-phone"></i> 
          <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', zca_get_option('hotline', '09617400600'))); ?>">
            +88 <?php echo esc_html(zca_get_option('hotline', '09617 400 600')); ?>
          </a>
        </span>
        <span class="topbar-item">
          <i class="fa-brands fa-whatsapp"></i> 
          <a href="https://wa.me/88<?php echo esc_attr(preg_replace('/[^0-9]/', '', zca_get_option('whatsapp', '01713203275'))); ?>" target="_blank">
            +88 <?php echo esc_html(zca_get_option('whatsapp', '01713 203 275')); ?>
          </a>
        </span>
        <span class="topbar-item">
          <i class="fa-solid fa-envelope"></i> 
          <a href="mailto:<?php echo esc_attr(zca_get_option('email_primary', 'info@zcalegal.com')); ?>">
            <?php echo esc_html(zca_get_option('email_primary', 'info@zcalegal.com')); ?>
          </a>
        </span>
      </div>
      <div class="topbar-right">
        <?php echo zca_legal_render_language_switcher('desktop'); ?>
        <span class="topbar-badge">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/dcci-logo.svg" alt="DCCI" class="topbar-dcci-icon">
          <span><?php echo esc_html(zca_get_option('dcci_badge', 'DCCI Standing Committee Member')); ?></span>
        </span>
        <button class="btn btn-sm btn-outline-gold" onclick="openModal('paymentModal')">
          <i class="fa-solid fa-credit-card"></i> Pay Online
        </button>
      </div>
    </div>
  </div>

  <!-- Hidden Google Translate Element Container -->
  <div id="google_translate_element_hidden" style="position:absolute; left:-9999px; top:-9999px; width:1px; height:1px; overflow:hidden; opacity:0; pointer-events:none;"></div>

  <script type="text/javascript">
  function googleTranslateElementInit() {
    new google.translate.TranslateElement({
      pageLanguage: 'en',
      includedLanguages: 'en,bn,ar,fr,zh-CN,es',
      layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
      autoDisplay: false
    }, 'google_translate_element_hidden');
  }

  function toggleZcaLangDropdown(e, suffix) {
    if (e) {
      if (e.stopPropagation) e.stopPropagation();
      if (e.preventDefault) e.preventDefault();
    }
    var menu = document.getElementById('zcaLangMenu_' + suffix);
    if (!menu) return;
    
    var isOpen = menu.classList.contains('open');
    
    document.querySelectorAll('.zca-lang-menu').forEach(function(m) {
      m.classList.remove('open');
    });

    if (!isOpen) {
      menu.classList.add('open');
    }
  }

  document.addEventListener('click', function(e) {
    if (!e.target.closest('.zca-lang-switcher')) {
      document.querySelectorAll('.zca-lang-menu').forEach(function(m) {
        m.classList.remove('open');
      });
    }
  });

  function zcaTriggerTranslate(langCode, flag, name, suffix) {
    // Update button UI across all switchers
    document.querySelectorAll('.zca-lang-switcher').forEach(function(sw) {
      var flagEl = sw.querySelector('.zca-curr-flag');
      var nameEl = sw.querySelector('.zca-curr-name');
      if (flagEl) flagEl.textContent = flag;
      if (nameEl) nameEl.textContent = name;
      
      var items = sw.querySelectorAll('.zca-lang-item');
      items.forEach(function(item) {
        if (item.getAttribute('data-lang') === langCode) {
          item.classList.add('active');
        } else {
          item.classList.remove('active');
        }
      });
    });

    // Save preference
    localStorage.setItem('zca_lang_code', langCode);
    localStorage.setItem('zca_lang_flag', flag);
    localStorage.setItem('zca_lang_name', name);

    // Close menus
    document.querySelectorAll('.zca-lang-menu').forEach(function(m) {
      m.classList.remove('open');
    });

    // Trigger Google Translate Select Element
    var select = document.querySelector('.goog-te-combo');
    if (select) {
      select.value = langCode;
      select.dispatchEvent(new Event('change'));
    } else {
      var value = (langCode === 'en') ? '/en/en' : '/en/' + langCode;
      document.cookie = "googtrans=" + value + "; path=/; domain=" + window.location.hostname;
      document.cookie = "googtrans=" + value + "; path=/";
      location.reload();
    }
  }

  // Restore saved language on load if available
  document.addEventListener('DOMContentLoaded', function() {
    var savedCode = localStorage.getItem('zca_lang_code') || 'en';
    var savedFlag = localStorage.getItem('zca_lang_flag') || '🇬🇧';
    var savedName = localStorage.getItem('zca_lang_name') || 'English';

    if (savedCode !== 'en') {
      document.querySelectorAll('.zca-lang-switcher').forEach(function(sw) {
        var flagEl = sw.querySelector('.zca-curr-flag');
        var nameEl = sw.querySelector('.zca-curr-name');
        if (flagEl) flagEl.textContent = savedFlag;
        if (nameEl) nameEl.textContent = savedName;
        
        var items = sw.querySelectorAll('.zca-lang-item');
        items.forEach(function(item) {
          if (item.getAttribute('data-lang') === savedCode) {
            item.classList.add('active');
          } else {
            item.classList.remove('active');
          }
        });
      });
    }
  });
  </script>
  <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>







  <!-- 2. Main Navigation Header (Clean on Mobile: Logo + Menu Icon Only) -->
  <header class="site-header">
    <div class="container">
      <nav class="navbar">
        
        <!-- Brand Logo (Custom Image or Default Golden Pillar) -->
        <a href="<?php echo esc_url(home_url('/')); ?>" class="brand-logo">
          <?php 
          $custom_logo_url = zca_get_option('custom_logo_url', '');
          if (!empty($custom_logo_url)) : ?>
            <img src="<?php echo esc_url($custom_logo_url); ?>" alt="<?php bloginfo('name'); ?>" class="custom-brand-logo" style="max-height: 46px; width: auto; object-fit: contain;">
          <?php elseif (has_custom_logo()) : ?>
            <?php the_custom_logo(); ?>
          <?php else : ?>
            <svg class="brand-icon-pillar" viewBox="0 0 24 24" fill="currentColor">
              <path d="M12 1L2 6v2h20V6L12 1zm-7 9v9h2v-9H5zm4 0v9h2v-9H9zm4 0v9h2v-9h-2zm4 0v9h2v-9h-2zM2 21h20v2H2v-2z"/>
            </svg>
            <div class="brand-text-wrap">
              <span class="brand-name">ZCA <span>LEGAL</span></span>
              <span class="brand-tagline">LAW | STRATEGY | SUCCESS</span>
            </div>
          <?php endif; ?>
        </a>

        <!-- Dynamic Nav Links & Mobile Menu Content -->
        <div class="nav-menu-wrapper">
          <?php
          if (has_nav_menu('primary')) {
              wp_nav_menu(array(
                  'theme_location' => 'primary',
                  'container'      => false,
                  'menu_class'     => 'nav-menu',
                  'fallback_cb'    => 'zca_legal_nav_fallback'
              ));
          } else {
              zca_legal_nav_fallback();
          }
          ?>
        </div>

        <!-- Desktop Action CTAs & Mobile Hamburger Icon -->
        <div class="nav-actions">
          <div class="mobile-nav-translate-wrap">
            <?php echo zca_legal_render_language_switcher('mobile_header'); ?>
          </div>

          <div class="nav-phone-direct">
            <span class="nav-phone-label">Direct Chamber Line</span>
            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', zca_get_option('hotline', '09617400600'))); ?>" class="nav-phone-num">
              <i class="fa-solid fa-phone-volume"></i> <?php echo esc_html(zca_get_option('hotline', '09617400600')); ?>
            </a>
          </div>
          <button class="btn btn-primary desktop-book-btn" onclick="openModal('consultationModal')">
            Book Consultation
          </button>
          
          <!-- Mobile Menu Trigger Icon -->
          <button class="hamburger-btn" aria-label="Toggle navigation">
            <span></span>
            <span></span>
            <span></span>
          </button>
        </div>


      </nav>
    </div>
  </header>
