<?php
/**
 * Template Name: About Chambers
 *
 * @package ZCA_Legal
 */

get_header();
?>

  <!-- Page Banner -->
  <section class="section section-dark" style="padding: 4rem 0 3.5rem; text-align: center; border-bottom: 2px solid var(--color-gold);">
    <div class="container">
      <span class="section-subtitle">Chambers Profile</span>
      <h1 style="color: #fff; margin-bottom: 0.75rem;">About ZCA LEGAL</h1>
      <p style="color: #cbd5e1; max-width: 680px; margin: 0 auto; font-size: 1.1rem;">
        Where Law Meets Leadership, and Legal Strategy Drives Business Success in Bangladesh.
      </p>
    </div>
  </section>

  <!-- 1. INTRODUCTION SECTION -->
  <section class="section">
    <div class="container">
      <div class="about-preview-grid">
        <div class="about-img-box">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/WhatsApp Image 2026-08-22 at 13.51.52.jpeg" alt="Advocate Md. Zahid Chowdhury">
          <div class="about-floating-badge">
            <div class="about-floating-badge-title">Adv. Md. Zahid Chowdhury</div>
            <div class="about-floating-badge-desc">Head of Chamber | Advocate, Supreme Court of Bangladesh. DCCI Standing Committee Member.</div>
          </div>
        </div>

        <div>
          <span class="section-subtitle">Firm Introduction</span>
          <h2 class="section-title">Dynamic Legal Excellence</h2>
          <p style="font-size: 1.05rem; color: #1e293b; line-height: 1.8; margin-bottom: 1rem; font-weight: 500;">
            <strong>ZCA LEGAL</strong> is a dynamic law firm led by a team of young, energetic, and skilled lawyers with the expertise to handle a wide range of business and corporate legal matters.
          </p>
          <p style="font-size: 0.95rem; color: #475569; line-height: 1.8; margin-bottom: 1.5rem;">
            We are deeply committed to providing comprehensive legal services, maintaining continuous communication with our clients, and delivering excellence in every aspect of our work. Our focus on quality service and constant improvement has earned us the lasting trust and confidence of those we serve.
          </p>

          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; padding: 14px;">
              <strong style="color: #091528; display: block; margin-bottom: 4px;"><i class="fa-solid fa-award" style="color: #c59b4e;"></i> Commitment & Integrity</strong>
              <span style="font-size: 0.8rem; color: #64748b;">Continuous client communication and unyielding adherence to professional legal ethics.</span>
            </div>
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; padding: 14px;">
              <strong style="color: #091528; display: block; margin-bottom: 4px;"><i class="fa-solid fa-briefcase" style="color: #c59b4e;"></i> Corporate Expertise</strong>
              <span style="font-size: 0.8rem; color: #64748b;">End-to-end statutory vetting, commercial advisory, and litigation representation.</span>
            </div>
          </div>

          <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
            <button class="btn btn-primary" onclick="openModal('consultationModal')">
              <i class="fa-regular fa-calendar-check"></i> Book Consultation
            </button>
            <a href="<?php echo esc_url(home_url('/contact-us/')); ?>" class="btn btn-navy">
              <i class="fa-solid fa-location-dot"></i> Chamber Locations
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 2. PRACTICE WINGS DIAGRAM SECTION (INFOGRAPHIC DESIGN) -->
  <section class="wings-diagram-section">
    <div class="container">
      <div style="text-align: center; max-width: 740px; margin: 0 auto 2.5rem;">
        <span class="section-subtitle" style="color: #c59b4e;">Chambers Infrastructure & Specialized Departments</span>
        <h2 class="section-title" style="color: #ffffff;">Our Practice Wings & Specializations</h2>
        <p style="color: #cbd5e1; font-size: 1rem;">
          ZCA LEGAL operates through 6 specialized practice wings providing dedicated legal counsel across court divisions and statutory bodies.
        </p>
      </div>

      <!-- Wings Interactive Diagram Grid -->
      <div class="wings-diagram-grid">
        <!-- Wing 1 -->
        <div class="wing-card">
          <div class="wing-header">
            <div class="wing-icon"><i class="fa-solid fa-file-invoice-dollar"></i></div>
            <h3 class="wing-title">Income Tax Wing</h3>
          </div>
          <div class="wing-desc">
            Return Submission, Audit, Company Return Filing, and Appellate Tax Representation.
          </div>
        </div>

        <!-- Wing 2 -->
        <div class="wing-card">
          <div class="wing-header">
            <div class="wing-icon"><i class="fa-solid fa-landmark-flag"></i></div>
            <h3 class="wing-title">Land Registration Wing</h3>
          </div>
          <div class="wing-desc">
            Registration, Mutation, Govt. Permissions, Property Vetting, and Misc Cases.
          </div>
        </div>

        <!-- Wing 3 -->
        <div class="wing-card">
          <div class="wing-header">
            <div class="wing-icon"><i class="fa-solid fa-gavel"></i></div>
            <h3 class="wing-title">Supreme Court Wing</h3>
          </div>
          <div class="wing-desc">
            Writ Petitions, Appellate Division Hearings, Civil, Criminal, Appeal, and Revision.
          </div>
        </div>

        <!-- Central Hub Circle -->
        <div class="wings-hub-card">
          <div class="wings-hub-circle">
            <span>ZCA</span>
            <span>LEGAL</span>
          </div>
        </div>

        <!-- Wing 4 -->
        <div class="wing-card">
          <div class="wing-header">
            <div class="wing-icon"><i class="fa-solid fa-scale-balanced"></i></div>
            <h3 class="wing-title">Lower Court Wing (Judge Court)</h3>
          </div>
          <div class="wing-desc">
            Bail, Cheque Dishonor Cases (NI Act), Child Custody, Regular Hearing etc.
          </div>
        </div>

        <!-- Wing 5 -->
        <div class="wing-card">
          <div class="wing-header">
            <div class="wing-icon"><i class="fa-solid fa-building-user"></i></div>
            <h3 class="wing-title">Company Wing / Secretarial Services</h3>
          </div>
          <div class="wing-desc">
            RJSC - (Company Registration, Return Filing, AGM, DVC, Share Transfer etc.)
          </div>
        </div>

        <!-- Wing 6 -->
        <div class="wing-card">
          <div class="wing-header">
            <div class="wing-icon"><i class="fa-solid fa-lightbulb"></i></div>
            <h3 class="wing-title">Intellectual Property Wing</h3>
          </div>
          <div class="wing-desc">
            Trademark, Copyright, Design, Patent Registration, and IP Appeal.
          </div>
        </div>
      </div>

      <!-- Retainer Services Banner -->
      <div class="retainer-service-banner">
        <div class="retainer-banner-title">
          <i class="fa-solid fa-handshake"></i> Monthly Retainer Services
        </div>
        <div class="retainer-banner-text">
          We provide legal services on monthly retainer basis, to ensure our clients' convenience and a smooth, uninterrupted working relationship.
        </div>
      </div>
    </div>
  </section>

  <!-- 3. AWARDS, RECOGNITIONS AND MEMBERSHIP SECTION -->
  <section class="awards-section">
    <div class="container">
      <div style="text-align: center; max-width: 720px; margin: 0 auto 2.5rem;">
        <span class="section-subtitle">Honors & Accreditation</span>
        <h2 class="section-title">Awards, Recognitions & Membership</h2>
        <p class="section-description">
          Prestigious national & international leadership recognitions and official trade chamber accreditations awarded to ZCA LEGAL.
        </p>
      </div>

      <!-- Top Row: 2 Awards -->
      <div class="awards-grid">
        <!-- Award 1 -->
        <div class="award-card">
          <div class="award-img-wrap">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/award-star-excellence-2025.jpg" alt="Star Excellence Award 2025">
          </div>
          <div class="award-content">
            <span class="award-badge">Legal Excellence & Human Rights</span>
            <h3 class="award-title">Star Excellence Award 2025</h3>
            <p class="award-desc">
              Awarded for outstanding contribution in the sector of Legal Profession & Human Rights to <strong>Adv. Md. Zahid Chowdhury</strong> (Head of Chamber & Advocate, Supreme Court of Bangladesh).
            </p>
          </div>
        </div>

        <!-- Award 2 -->
        <div class="award-card">
          <div class="award-img-wrap">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/award-global-iconic-2026.jpg" alt="Global Iconic Leadership Award 2026">
          </div>
          <div class="award-content">
            <span class="award-badge">Global Leadership Forum</span>
            <h3 class="award-title">Global Iconic Leadership Award 2026</h3>
            <p class="award-desc">
              Presented by Global Business and Leadership Forum in recognition of exemplary legal leadership and corporate advocacy.
            </p>
          </div>
        </div>
      </div>

      <!-- Bottom Row: DCCI Membership Certificate -->
      <div class="membership-card">
        <div class="membership-img-wrap">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/dcci-membership-certificate.jpg" alt="DCCI Membership Certificate">
        </div>
        <div class="membership-content">
          <span class="award-badge" style="background: rgba(9, 21, 40, 0.08); color: #091528; border-color: #c59b4e;">
            Official Trade Accreditation
          </span>
          <h3 style="font-family: var(--font-accent, 'Outfit', sans-serif); font-size: 1.5rem; font-weight: 800; color: #091528; margin: 0.5rem 0 0.75rem;">
            Dhaka Chamber of Commerce & Industry (DCCI) Membership
          </h3>
          <p style="font-size: 0.95rem; color: #475569; line-height: 1.7; margin-bottom: 1.25rem;">
            Official Membership Certificate issued by the Dhaka Chamber of Commerce & Industry (DCCI), certifying <strong>Zahid Chowdhury & Associates (ZCA LEGAL)</strong> as a General Member engaged in Law Consultancy.
          </p>
          <div style="display: flex; gap: 12px; align-items: center; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px 16px;">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/dcci-logo.svg" alt="DCCI Logo" style="height: 32px;">
            <div>
              <strong style="color: #091528; display: block; font-size: 0.85rem;">Standing Committee Leadership</strong>
              <span style="font-size: 0.78rem; color: #64748b;">Adv. Md. Zahid Chowdhury serves as a DCCI Standing Committee Member.</span>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- 4. CONTACT INFORMATION SECTION -->

  <section class="section">
    <div class="container">
      <div style="text-align: center; margin-bottom: 2.5rem;">
        <span class="section-subtitle">Chamber Directory</span>
        <h2 class="section-title">Contact Information & Chambers</h2>
        <p class="section-description" style="max-width: 640px; margin: 0.5rem auto 0;">
          Reach out directly to ZCA LEGAL chambers for consultations, legal retainers, and court advocacy.
        </p>
      </div>

      <!-- 3 Chamber Cards -->
      <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; margin-bottom: 2.5rem;">
        <!-- Corporate Chamber -->
        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 1.5rem; box-shadow: var(--shadow-xs); transition: all 0.3s ease;">
          <div style="color: var(--color-gold); font-size: 1.6rem; margin-bottom: 0.75rem;"><i class="fa-solid fa-building-columns"></i></div>
          <h3 style="font-size: 1.1rem; color: #091528; margin-bottom: 0.5rem; font-weight: 700;">Corporate Chamber</h3>
          <p style="font-size: 0.875rem; color: #475569; line-height: 1.6; margin-bottom: 1rem;">
            Flat C2, House 1188, Avenue 11, Mirpur DOHS, Dhaka 1216, Bangladesh
          </p>
          <a href="https://maps.google.com/?q=Mirpur+DOHS+Dhaka" target="_blank" style="font-size: 0.8rem; color: var(--color-gold); font-weight: bold; text-decoration: none;">
            <i class="fa-solid fa-location-arrow"></i> Get Directions
          </a>
        </div>

        <!-- Supreme Court Chamber -->
        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 1.5rem; box-shadow: var(--shadow-xs); transition: all 0.3s ease;">
          <div style="color: var(--color-gold); font-size: 1.6rem; margin-bottom: 0.75rem;"><i class="fa-solid fa-gavel"></i></div>
          <h3 style="font-size: 1.1rem; color: #091528; margin-bottom: 0.5rem; font-weight: 700;">Supreme Court Chamber</h3>
          <p style="font-size: 0.875rem; color: #475569; line-height: 1.6; margin-bottom: 1rem;">
            Room 1010 (Annex Building), Supreme Court Bar Association, Dhaka 1000
          </p>
          <a href="https://maps.google.com/?q=Supreme+Court+Bar+Association+Dhaka" target="_blank" style="font-size: 0.8rem; color: var(--color-gold); font-weight: bold; text-decoration: none;">
            <i class="fa-solid fa-location-arrow"></i> Get Directions
          </a>
        </div>

        <!-- Judge Court Chamber -->
        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 1.5rem; box-shadow: var(--shadow-xs); transition: all 0.3s ease;">
          <div style="color: var(--color-gold); font-size: 1.6rem; margin-bottom: 0.75rem;"><i class="fa-solid fa-scale-balanced"></i></div>
          <h3 style="font-size: 1.1rem; color: #091528; margin-bottom: 0.5rem; font-weight: 700;">Judge Court Chamber</h3>
          <p style="font-size: 0.875rem; color: #475569; line-height: 1.6; margin-bottom: 1rem;">
            Room No. B 36, Parjoar Center, 22 Court House Street, Kotwali, Dhaka 1000
          </p>
          <a href="https://maps.google.com/?q=Dhaka+Judge+Court" target="_blank" style="font-size: 0.8rem; color: var(--color-gold); font-weight: bold; text-decoration: none;">
            <i class="fa-solid fa-location-arrow"></i> Get Directions
          </a>
        </div>
      </div>

      <!-- Phone, Email & Website Communication Hub -->
      <div style="background: linear-gradient(135deg, #091528 0%, #152744 100%); border: 1px solid rgba(197, 155, 78, 0.4); border-radius: 14px; padding: 2.25rem 2rem; color: #ffffff; display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; text-align: center; box-shadow: var(--shadow-md);">
        <!-- Phone Column -->
        <div>
          <i class="fa-solid fa-phone" style="color: #c59b4e; font-size: 1.6rem; margin-bottom: 0.6rem; display: block;"></i>
          <strong style="display: block; color: #ffffff; margin-bottom: 6px; font-size: 1.05rem;">Phone & Direct Lines</strong>
          <span style="font-size: 0.875rem; color: #cbd5e1; display: block; margin-bottom: 3px;">
            <i class="fa-solid fa-phone-volume" style="color: #c59b4e;"></i> Office: <strong>+88 09617 400 600</strong>
          </span>
          <span style="font-size: 0.875rem; color: #cbd5e1; display: block; margin-bottom: 3px;">
            <i class="fa-brands fa-whatsapp" style="color: #25D366;"></i> WhatsApp: <strong>+88 01713 203 275</strong>
          </span>
          <span style="font-size: 0.875rem; color: #cbd5e1; display: block;">
            <i class="fa-solid fa-mobile-screen" style="color: #c59b4e;"></i> Direct: <strong>+88 01873 414 400</strong>
          </span>
        </div>

        <!-- Email Column -->
        <div>
          <i class="fa-solid fa-envelope" style="color: #c59b4e; font-size: 1.6rem; margin-bottom: 0.6rem; display: block;"></i>
          <strong style="display: block; color: #ffffff; margin-bottom: 6px; font-size: 1.05rem;">Official E-mail Addresses</strong>
          <a href="mailto:info@zcalegal.com" style="font-size: 0.9rem; color: #c59b4e; font-weight: bold; display: block; margin-bottom: 4px; text-decoration: none;">
            info@zcalegal.com
          </a>
          <a href="mailto:zcalawfirm@gmail.com" style="font-size: 0.875rem; color: #cbd5e1; display: block; text-decoration: none;">
            zcalawfirm@gmail.com
          </a>
        </div>

        <!-- Website Column -->
        <div>
          <i class="fa-solid fa-globe" style="color: #c59b4e; font-size: 1.6rem; margin-bottom: 0.6rem; display: block;"></i>
          <strong style="display: block; color: #ffffff; margin-bottom: 6px; font-size: 1.05rem;">Official Website</strong>
          <a href="https://www.zcalegal.com" target="_blank" style="font-size: 1.05rem; color: #c59b4e; font-weight: 800; display: block; margin-bottom: 8px; text-decoration: none;">
            www.zcalegal.com
          </a>
          <span style="font-size: 0.8rem; color: #94a3b8;">Zahid Chowdhury & Associates</span>
        </div>
      </div>
    </div>
  </section>

  <!-- Core Pillars Bar -->
  <section class="why-us-bar">
    <div class="container">
      <div class="why-us-grid">
        <div class="why-us-item">
          <div class="why-us-icon"><i class="fa-solid fa-scale-balanced"></i></div>
          <div>
            <div class="why-us-title">Supreme Court Practice</div>
            <div class="why-us-text">Direct representation before High Court & Appellate Division</div>
          </div>
        </div>
        <div class="why-us-item">
          <div class="why-us-icon"><i class="fa-solid fa-file-contract"></i></div>
          <div>
            <div class="why-us-title">Commercial Precision</div>
            <div class="why-us-text">Drafting watertight contracts and M&A agreements</div>
          </div>
        </div>
        <div class="why-us-item">
          <div class="why-us-icon"><i class="fa-solid fa-briefcase"></i></div>
          <div>
            <div class="why-us-title">Corporate Retainer</div>
            <div class="why-us-text">Continuous legal counsel for growing businesses & SMEs</div>
          </div>
        </div>
        <div class="why-us-item">
          <div class="why-us-icon"><i class="fa-solid fa-shield-halved"></i></div>
          <div>
            <div class="why-us-title">100% Privilege</div>
            <div class="why-us-text">Strict confidentiality and attorney-client trust</div>
          </div>
        </div>
      </div>
    </div>
  </section>

<?php
get_footer();
