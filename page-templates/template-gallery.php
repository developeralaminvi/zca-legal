<?php
/**
 * Template Name: Photo Gallery & Awards
 *
 * @package ZCA_Legal
 */

get_header();
?>

  <!-- Page Banner -->
  <section class="section section-dark" style="padding: 4rem 0 3.5rem; text-align: center; border-bottom: 2px solid var(--color-gold);">
    <div class="container">
      <span class="section-subtitle">Chamber Moments & Accreditations</span>
      <h1 style="color: #fff; margin-bottom: 0.75rem;">Photo Gallery & Awards Showcase</h1>
      <p style="color: #cbd5e1; max-width: 680px; margin: 0 auto; font-size: 1.1rem;">
        Moments of recognition, DCCI committee sessions, international leadership summits, and professional chamber engagements.
      </p>
    </div>
  </section>

  <!-- Gallery Section -->
  <section class="section">
    <div class="container">
      
      <!-- Filter Tabs -->
      <div class="filter-tabs gallery-filter-tabs" style="margin-bottom: 2.5rem;">
        <button class="filter-tab-btn gallery-filter-btn active" data-filter="all">All Photos</button>
        <button class="filter-tab-btn gallery-filter-btn" data-filter="awards">Awards & Honors</button>
        <button class="filter-tab-btn gallery-filter-btn" data-filter="chamber">Chamber & Client Meetings</button>
        <button class="filter-tab-btn gallery-filter-btn" data-filter="speaking">Keynote & Seminars</button>
      </div>

      <!-- Gallery Grid -->
      <div class="awards-grid">
        
        <!-- 1 -->
        <div class="award-card gallery-item" data-filter="awards" onclick="openLightbox('<?php echo get_template_directory_uri(); ?>/assets/images/award-star-excellence-2025.jpeg', 'Star Excellence Awards 2025 in Legal Advocacy')" style="cursor: pointer;">
          <div class="award-img-wrap">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/award-star-excellence-2025.jpeg" alt="Star Excellence Awards 2025">
          </div>
          <div class="award-content">
            <span class="award-year">Award 2025</span>
            <h3 class="award-title">Star Excellence Awards 2025</h3>
            <p class="award-desc">Adv. Zahid Chowdhury receiving the Star Excellence Award in recognition of outstanding corporate legal leadership.</p>
          </div>
        </div>

        <!-- 2 -->
        <div class="award-card gallery-item" data-filter="awards" onclick="openLightbox('<?php echo get_template_directory_uri(); ?>/assets/images/award-global-iconic-2026.jpeg', 'Global Iconic Leadership Award 2026')" style="cursor: pointer;">
          <div class="award-img-wrap">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/award-global-iconic-2026.jpeg" alt="Global Iconic Leadership 2026">
          </div>
          <div class="award-content">
            <span class="award-year">International Award</span>
            <h3 class="award-title">Global Iconic Leadership Award 2026</h3>
            <p class="award-desc">Recognized at the Global Youth Leadership Summit for transformative legal advocacy and youth leadership.</p>
          </div>
        </div>

        <!-- 3 -->
        <div class="award-card gallery-item" data-filter="awards" onclick="openLightbox('<?php echo get_template_directory_uri(); ?>/assets/images/certificate-dcci.jpeg', 'DCCI Standing Committee Induction')" style="cursor: pointer;">
          <div class="award-img-wrap">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/certificate-dcci.jpeg" alt="DCCI Induction">
          </div>
          <div class="award-content">
            <span class="award-year">Accreditation</span>
            <h3 class="award-title">DCCI Standing Committee Member</h3>
            <p class="award-desc">Dhaka Chamber of Commerce & Industry (DCCI) committee session for commercial business policies.</p>
          </div>
        </div>

        <!-- 4 -->
        <div class="award-card gallery-item" data-filter="chamber" onclick="openLightbox('<?php echo get_template_directory_uri(); ?>/assets/images/adv-zahid-chamber-meeting.jpeg', 'Mirpur DOHS Chamber Strategic Meeting')" style="cursor: pointer;">
          <div class="award-img-wrap">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/adv-zahid-chamber-meeting.jpeg" alt="Chamber Meeting">
          </div>
          <div class="award-content">
            <span class="award-year">Chamber Engagement</span>
            <h3 class="award-title">Corporate Consultation Meeting</h3>
            <p class="award-desc">Strategic contract drafting and M&A due diligence session with corporate retainer clients.</p>
          </div>
        </div>

        <!-- 5 -->
        <div class="award-card gallery-item" data-filter="speaking" onclick="openLightbox('<?php echo get_template_directory_uri(); ?>/assets/images/adv-zahid-presentation.jpeg', 'Corporate Law Keynote Presentation')" style="cursor: pointer;">
          <div class="award-img-wrap">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/adv-zahid-presentation.jpeg" alt="Keynote Speech">
          </div>
          <div class="award-content">
            <span class="award-year">Keynote Seminar</span>
            <h3 class="award-title">Legal Strategy Keynote</h3>
            <p class="award-desc">Presenting legal structures for FDI and startup venture financing in Bangladesh.</p>
          </div>
        </div>

        <!-- 6 -->
        <div class="award-card gallery-item" data-filter="speaking" onclick="openLightbox('<?php echo get_template_directory_uri(); ?>/assets/images/adv-zahid-speaking.jpeg', 'Youth Leadership Summit Address')" style="cursor: pointer;">
          <div class="award-img-wrap">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/adv-zahid-speaking.jpeg" alt="Global Youth Summit">
          </div>
          <div class="award-content">
            <span class="award-year">Leadership Summit</span>
            <h3 class="award-title">Global Youth Leadership Summit</h3>
            <p class="award-desc">Addressing legal empowerment and international youth initiatives as honored guest speaker.</p>
          </div>
        </div>

      </div>

    </div>
  </section>

<?php
get_footer();
