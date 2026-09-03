<?php
/**
 * Template Name: Monthly Retainer Packages
 *
 * @package ZCA_Legal
 */

get_header();
?>

  <!-- Page Banner -->
  <section class="section section-dark" style="padding: 4rem 0 3.5rem; text-align: center; border-bottom: 2px solid var(--color-gold);">
    <div class="container">
      <span class="section-subtitle">Dedicated Corporate Legal Support</span>
      <h1 style="color: #fff; margin-bottom: 0.75rem;">Monthly Legal Retainer Plans</h1>
      <p style="color: #cbd5e1; max-width: 680px; margin: 0 auto; font-size: 1.1rem;">
        Get proactive, full-service in-house legal counsel for a predictable monthly fee. Protect your business from day one.
      </p>
    </div>
  </section>

  <!-- Retainer Plans Grid -->
  <section class="section retainer-section" style="border: none;">
    <div class="container">
      
      <div class="retainer-grid" style="margin-top: 0;">
        <!-- Plan 1 -->
        <div class="retainer-card">
          <h3 class="retainer-plan-name">Startup Retainer</h3>
          <p class="retainer-plan-desc">For early-stage tech ventures, OPCs, and growing SMEs needing compliance.</p>
          <div class="retainer-price">BDT 25,000 <span>/ Month</span></div>
          <div class="retainer-feature-list">
            <div class="retainer-feature-item"><i class="fa-solid fa-circle-check"></i><span>Drafting & vetting up to 4 commercial agreements</span></div>
            <div class="retainer-feature-item"><i class="fa-solid fa-circle-check"></i><span>Ongoing RJSC statutory & annual compliance advisory</span></div>
            <div class="retainer-feature-item"><i class="fa-solid fa-circle-check"></i><span>Direct WhatsApp & phone legal counsel</span></div>
            <div class="retainer-feature-item"><i class="fa-solid fa-circle-check"></i><span>Standard NDA and employee contracts</span></div>
            <div class="retainer-feature-item"><i class="fa-solid fa-circle-check"></i><span>Legal notice drafting & response</span></div>
          </div>
          <button class="btn btn-outline-gold" onclick="openModal('consultationModal')">Subscribe Startup Plan</button>
        </div>

        <!-- Plan 2 -->
        <div class="retainer-card featured">
          <div class="retainer-card-badge">Most Popular Retainer</div>
          <h3 class="retainer-plan-name">Corporate Retainer</h3>
          <p class="retainer-plan-desc">For established companies, factories, and commercial enterprises.</p>
          <div class="retainer-price">BDT 50,000 <span>/ Month</span></div>
          <div class="retainer-feature-list">
            <div class="retainer-feature-item"><i class="fa-solid fa-circle-check"></i><span>10 routine contract drafting & vendor vetting</span></div>
            <div class="retainer-feature-item"><i class="fa-solid fa-circle-check"></i><span>Statutory Legal Notice drafting under NI Act 138</span></div>
            <div class="retainer-feature-item"><i class="fa-solid fa-circle-check"></i><span>Labor Act compliance & HR disciplinary rules</span></div>
            <div class="retainer-feature-item"><i class="fa-solid fa-circle-check"></i><span>Priority physical chamber meetings in Mirpur DOHS</span></div>
            <div class="retainer-feature-item"><i class="fa-solid fa-circle-check"></i><span>Supreme Court litigation case assessment</span></div>
          </div>
          <button class="btn btn-primary" onclick="openModal('consultationModal')">Subscribe Corporate Plan</button>
        </div>

        <!-- Plan 3 -->
        <div class="retainer-card">
          <h3 class="retainer-plan-name">Enterprise Retainer</h3>
          <p class="retainer-plan-desc">For conglomerates, multinational corporations, and banks.</p>
          <div class="retainer-price">Custom <span>/ Tailored Scope</span></div>
          <div class="retainer-feature-list">
            <div class="retainer-feature-item"><i class="fa-solid fa-circle-check"></i><span>Dedicated Supreme Court Senior Advocate assigned</span></div>
            <div class="retainer-feature-item"><i class="fa-solid fa-circle-check"></i><span>Full M&A due diligence & transaction advisory</span></div>
            <div class="retainer-feature-item"><i class="fa-solid fa-circle-check"></i><span>High Court writ litigation representation</span></div>
            <div class="retainer-feature-item"><i class="fa-solid fa-circle-check"></i><span>24/7 emergency legal emergency assistance</span></div>
          </div>
          <button class="btn btn-outline-gold" onclick="openModal('consultationModal')">Inquire Enterprise Scope</button>
        </div>
      </div>

    </div>
  </section>

<?php
get_footer();
