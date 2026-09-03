<?php
/**
 * Template Name: Contact & Chambers
 *
 * @package ZCA_Legal
 */

get_header();

$hotline = zca_get_option('hotline', '09617400600');
$whatsapp = zca_get_option('whatsapp', '01713203275');
$email_primary = zca_get_option('email_primary', 'info@zcalegal.com');
$chamber1_title = zca_get_option('chamber1_title', 'Mirpur DOHS Corporate Chamber');
$chamber1_address = zca_get_option('chamber1_address', 'Flat C2, House 1188, Avenue 11, Mirpur DOHS, Dhaka 1216');
$chamber2_title = zca_get_option('chamber2_title', 'Supreme Court Bar Chamber');
$chamber2_address = zca_get_option('chamber2_address', 'Room 1010 (Annex Building), Supreme Court Bar Association, Dhaka 1000');
$chamber3_title = zca_get_option('chamber3_title', 'Dhaka Judge Court Chamber');
$chamber3_address = zca_get_option('chamber3_address', 'Room No. B 36, Parjoar Center, 22 Court House Street, Kotwali, Dhaka 1000');
?>

  <!-- Page Banner -->
  <section class="section section-dark" style="padding: 4rem 0 3.5rem; text-align: center; border-bottom: 2px solid var(--color-gold);">
    <div class="container">
      <span class="section-subtitle">Chambers & Directions</span>
      <h1 style="color: #fff; margin-bottom: 0.75rem;">Contact ZCA LEGAL Chambers</h1>
      <p style="color: #cbd5e1; max-width: 680px; margin: 0 auto; font-size: 1.1rem;">
        Get in touch with our advocate team, visit any of our 3 chambers in Dhaka, or schedule a priority appointment.
      </p>
    </div>
  </section>

  <!-- 3 Chambers Cards -->
  <section class="section">
    <div class="container">
      
      <div class="chambers-grid" style="margin-bottom: 3.5rem;">
        <!-- Chamber 1 -->
        <div class="chamber-card">
          <div>
            <span class="chamber-badge">Head Corporate Chamber</span>
            <h3 class="chamber-title"><?php echo esc_html($chamber1_title); ?></h3>
            <p class="chamber-address">
              <i class="fa-solid fa-location-dot"></i>
              <span><?php echo esc_html($chamber1_address); ?></span>
            </p>
          </div>
          <div class="chamber-actions">
            <a href="<?php echo esc_url(zca_get_option('chamber1_map', 'https://maps.app.goo.gl/dkDADYmnUXVFAVf58')); ?>" target="_blank" class="btn btn-sm btn-navy">
              <i class="fa-solid fa-map-location-dot"></i> Google Maps
            </a>
            <button class="btn btn-sm btn-outline-gold" onclick="openModal('consultationModal')">
              Book Here
            </button>
          </div>
        </div>

        <!-- Chamber 2 -->
        <div class="chamber-card">
          <div>
            <span class="chamber-badge">High Court Chamber</span>
            <h3 class="chamber-title"><?php echo esc_html($chamber2_title); ?></h3>
            <p class="chamber-address">
              <i class="fa-solid fa-scale-balanced"></i>
              <span><?php echo esc_html($chamber2_address); ?></span>
            </p>
          </div>
          <div class="chamber-actions">
            <a href="<?php echo esc_url(zca_get_option('chamber2_map', 'https://maps.app.goo.gl/SKXRkX7U6PBtUoTJ9')); ?>" target="_blank" class="btn btn-sm btn-navy">
              <i class="fa-solid fa-map-location-dot"></i> Google Maps
            </a>
            <button class="btn btn-sm btn-outline-gold" onclick="openModal('consultationModal')">
              Book Here
            </button>
          </div>
        </div>

        <!-- Chamber 3 -->
        <div class="chamber-card">
          <div>
            <span class="chamber-badge">District & Magistrate Chamber</span>
            <h3 class="chamber-title"><?php echo esc_html($chamber3_title); ?></h3>
            <p class="chamber-address">
              <i class="fa-solid fa-landmark"></i>
              <span><?php echo esc_html($chamber3_address); ?></span>
            </p>
          </div>
          <div class="chamber-actions">
            <a href="<?php echo esc_url(zca_get_option('chamber3_map', 'https://maps.app.goo.gl/3GZLAVuaotGBPrqg9')); ?>" target="_blank" class="btn btn-sm btn-navy">
              <i class="fa-solid fa-map-location-dot"></i> Google Maps
            </a>
            <button class="btn btn-sm btn-outline-gold" onclick="openModal('consultationModal')">
              Book Here
            </button>
          </div>
        </div>
      </div>

      <!-- Contact Form & Info Grid -->
      <div style="display: grid; grid-template-columns: 1.2fr 0.8fr; gap: 3rem; align-items: start;">
        
        <!-- Left: AJAX Contact Form -->
        <div class="single-content-box">
          <h2 style="font-size: 1.5rem; margin-bottom: 0.5rem; color: #091528;">Send an Instant Legal Inquiry</h2>
          <p style="font-size: 0.875rem; color: #64748b; margin-bottom: 1.5rem;">
            Our associate advocates will review your message and reply via email or phone within 2-4 hours.
          </p>

          <form id="contact-page-form">
            <div class="form-row">
              <div class="form-group">
                <label class="form-label">Full Name *</label>
                <input type="text" name="name" class="form-control" placeholder="e.g. Tariqul Islam" required>
              </div>
              <div class="form-group">
                <label class="form-label">Company / Organization</label>
                <input type="text" name="company" class="form-control" placeholder="Company Name">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label class="form-label">Phone / WhatsApp *</label>
                <input type="tel" name="phone" class="form-control" placeholder="+88 01XXXXXXXXX" required>
              </div>
              <div class="form-group">
                <label class="form-label">Email Address *</label>
                <input type="email" name="email" class="form-control" placeholder="name@company.com" required>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label">Subject / Service Area</label>
              <input type="text" name="subject" class="form-control" placeholder="e.g. Company Incorporation / Writ Petition" required>
            </div>

            <div class="form-group">
              <label class="form-label">Message Details *</label>
              <textarea name="message" rows="4" class="form-control" placeholder="Please outline your legal requirements or case facts..." required></textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-lg" style="width: 100%;">
              <i class="fa-solid fa-paper-plane"></i> Send Legal Inquiry
            </button>
          </form>
        </div>

        <!-- Right: Direct Help Box -->
        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
          <div class="sidebar-widget sidebar-widget-dark">
            <h3 class="sidebar-widget-title" style="border-color: var(--color-gold);">
              <i class="fa-solid fa-phone-volume" style="color: var(--color-gold);"></i> Direct Hotlines
            </h3>
            <p style="color: #cbd5e1; font-size: 0.85rem; margin-bottom: 1.25rem;">
              For emergency stay orders, bails, or immediate legal notices:
            </p>
            <div style="margin-bottom: 1rem;">
              <strong style="color: #fff; font-size: 0.8rem; text-transform: uppercase;">Chamber Desk:</strong><br>
              <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $hotline)); ?>" style="color: var(--color-gold); font-size: 1.2rem; font-weight: bold;">
                +88 <?php echo esc_html($hotline); ?>
              </a>
            </div>
            <div style="margin-bottom: 1.5rem;">
              <strong style="color: #fff; font-size: 0.8rem; text-transform: uppercase;">Direct WhatsApp:</strong><br>
              <a href="https://wa.me/88<?php echo esc_attr(preg_replace('/[^0-9]/', '', $whatsapp)); ?>" target="_blank" style="color: #25D366; font-size: 1.1rem; font-weight: bold;">
                +88 <?php echo esc_html($whatsapp); ?>
              </a>
            </div>
            <a href="https://wa.me/88<?php echo esc_attr(preg_replace('/[^0-9]/', '', $whatsapp)); ?>" target="_blank" class="btn btn-whatsapp" style="width: 100%;">
              <i class="fa-brands fa-whatsapp"></i> Chat on WhatsApp Now
            </a>
          </div>

          <div class="sidebar-widget">
            <h3 class="sidebar-widget-title">Chamber Hours</h3>
            <p style="font-size: 0.85rem; color: #475569; margin-bottom: 0.5rem;">
              <strong>Saturday – Thursday:</strong> 10:00 AM – 8:30 PM
            </p>
            <p style="font-size: 0.85rem; color: #475569; margin-bottom: 1rem;">
              <strong>Friday:</strong> Prior Appointment Only
            </p>
            <button class="btn btn-sm btn-navy" style="width: 100%;" onclick="openModal('consultationModal')">
              Schedule Appointment
            </button>
          </div>
        </div>

      </div>

    </div>
  </section>

<?php
get_footer();
