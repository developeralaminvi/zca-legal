<?php
/**
 * ZCA LEGAL - Footer Template
 *
 * @package ZCA_Legal
 */

if (!defined('ABSPATH')) {
    exit;
}

$hotline = zca_get_option('hotline', '09617400600');
$whatsapp = zca_get_option('whatsapp', '01713203275');
$email_primary = zca_get_option('email_primary', 'info@zcalegal.com');
$email_secondary = zca_get_option('email_secondary', 'zcalawfirm@gmail.com');
$chamber1_title = zca_get_option('chamber1_title', 'Mirpur DOHS Corporate Chamber');
$chamber1_address = zca_get_option('chamber1_address', 'Flat C2, House 1188, Avenue 11, Mirpur DOHS, Dhaka 1216');
$chamber2_title = zca_get_option('chamber2_title', 'Supreme Court Bar Chamber');
$chamber2_address = zca_get_option('chamber2_address', 'Room 1010 (Annex Building), Supreme Court Bar Association, Dhaka');
$chamber3_title = zca_get_option('chamber3_title', 'Dhaka Judge Court Chamber');
$chamber3_address = zca_get_option('chamber3_address', 'Room No. B 36, Parjoar Center, 22 Court House Street, Kotwali, Dhaka');
?>

  <!-- Footer Section -->
  <footer class="site-footer">
    <div class="container">
      
      <!-- Top Grid: 4 Columns -->
      <div class="footer-top-grid">
        <!-- Col 1: Law Firm Identity -->
        <div>
          <h4 class="footer-col-title">ZCA LEGAL</h4>
          <p style="font-size: 0.85rem; color: #94a3b8; line-height: 1.6; margin-bottom: 1rem;">
            A premier full-service law firm in Dhaka, Bangladesh providing business-driven legal strategy, corporate governance, and Supreme Court litigation advocacy.
          </p>
          <div style="display: flex; gap: 0.5rem;">
            <a href="https://wa.me/88<?php echo esc_attr(preg_replace('/[^0-9]/', '', $whatsapp)); ?>" target="_blank" class="btn btn-sm btn-whatsapp" style="padding: 0.4rem 0.8rem; font-size: 0.75rem;">
              <i class="fa-brands fa-whatsapp"></i> Chat WhatsApp
            </a>
            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $hotline)); ?>" class="btn btn-sm btn-outline-gold" style="padding: 0.4rem 0.8rem; font-size: 0.75rem;">
              <i class="fa-solid fa-phone"></i> Call Chamber
            </a>
          </div>
        </div>

        <!-- Col 2: Fast Navigation -->
        <div>
          <h4 class="footer-col-title">Navigation</h4>
          <ul class="footer-links-list">
            <li class="footer-link-item"><a href="<?php echo esc_url(home_url('/')); ?>">Home Portal</a></li>
            <li class="footer-link-item"><a href="<?php echo esc_url(home_url('/about-us/')); ?>">About Chambers</a></li>
            <li class="footer-link-item"><a href="<?php echo esc_url(home_url('/practice-areas/')); ?>">Practice Areas Directory</a></li>
            <li class="footer-link-item"><a href="<?php echo esc_url(home_url('/our-team/')); ?>">Lawyers & Advocates</a></li>
            <li class="footer-link-item"><a href="<?php echo esc_url(home_url('/monthly-retainer/')); ?>">Monthly Retainer Packages</a></li>
            <li class="footer-link-item"><a href="<?php echo esc_url(home_url('/blog/')); ?>">Legal Insights & Blog</a></li>
            <li class="footer-link-item"><a href="<?php echo esc_url(home_url('/contact-us/')); ?>">Chambers & Directions</a></li>
          </ul>
        </div>

        <!-- Col 3: 3 Chamber Locations -->
        <div>
          <h4 class="footer-col-title">3 Chamber Locations</h4>
          <ul class="footer-links-list" style="font-size: 0.8rem;">
            <li style="margin-bottom: 0.75rem;">
              <strong style="color: var(--color-gold); display: block;">1. Mirpur DOHS Corporate Chamber:</strong>
              <span style="color: #cbd5e1;"><?php echo esc_html($chamber1_address); ?></span>
            </li>
            <li style="margin-bottom: 0.75rem;">
              <strong style="color: var(--color-gold); display: block;">2. Supreme Court Bar Chamber:</strong>
              <span style="color: #cbd5e1;"><?php echo esc_html($chamber2_address); ?></span>
            </li>
            <li>
              <strong style="color: var(--color-gold); display: block;">3. Dhaka Judge Court Chamber:</strong>
              <span style="color: #cbd5e1;"><?php echo esc_html($chamber3_address); ?></span>
            </li>
          </ul>
        </div>

        <!-- Col 4: Hotlines & Retainer Inquiries -->
        <div>
          <h4 class="footer-col-title">Emergency Advisory</h4>
          <p style="font-size: 0.8rem; color: #94a3b8; margin-bottom: 0.75rem;">
            For urgent stay orders, bail applications, or police notices, contact chamber direct:
          </p>
          <div style="margin-bottom: 0.5rem;">
            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $hotline)); ?>" style="color: var(--color-gold); font-size: 1rem; font-weight: 700; display: block;">
              <i class="fa-solid fa-phone-volume"></i> +88 <?php echo esc_html($hotline); ?>
            </a>
          </div>
          <div style="margin-bottom: 0.75rem;">
            <a href="mailto:<?php echo esc_attr($email_primary); ?>" style="color: #cbd5e1; font-size: 0.825rem;">
              <i class="fa-solid fa-envelope"></i> <?php echo esc_html($email_primary); ?>
            </a>
          </div>
          <button class="btn btn-outline-gold btn-sm" onclick="openModal('consultationModal')" style="width: 100%;">
            <i class="fa-regular fa-calendar-check"></i> Book Consultation
          </button>
        </div>
      </div>

      <!-- Bottom Bar -->
      <div class="footer-bottom">
        <p class="footer-copyright">
          &copy; <?php echo date('Y'); ?> <strong>ZCA LEGAL (Zahid Chowdhury & Associates)</strong>. All Rights Reserved. Full-Service Corporate Law Firm & Supreme Court Litigation Chambers.
        </p>
        <div class="footer-bottom-links">
          <a href="<?php echo esc_url(home_url('/contact-us/')); ?>">Chambers</a>
          <a href="<?php echo esc_url(home_url('/monthly-retainer/')); ?>">Retainer</a>
          <a href="<?php echo esc_url(home_url('/practice-areas/')); ?>">Practice Areas</a>
        </div>
      </div>

    </div>
  </footer>

  <!-- 3. Floating WhatsApp & Hotline (Desktop & Mobile) -->
  <div class="floating-contact-wrap">
    <a href="javascript:void(0)" onclick="openWhatsApp('Hello ZCA Legal, I would like to inquire about legal retainer / consultation services.')" class="floating-whatsapp-btn" title="Live WhatsApp Consultation">
      <span class="floating-pulse-badge"></span>
      <i class="fa-brands fa-whatsapp"></i>
    </a>
    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $hotline)); ?>" class="floating-call-btn" title="Direct Chamber Call">
      <i class="fa-solid fa-phone"></i>
    </a>
  </div>

  <!-- 4. Modal 1: Consultation Appointment Booking (AJAX Powered) -->
  <div class="modal-backdrop" id="consultationModal">
    <div class="modal-container">
      <div class="modal-header">
        <h3 class="modal-title"><i class="fa-solid fa-calendar-check"></i> Schedule Chamber Consultation</h3>
        <button class="modal-close-btn" onclick="closeModal('consultationModal')">&times;</button>
      </div>
      <div class="modal-body">
        <p style="font-size: 0.85rem; color: #64748b; margin-bottom: 1.25rem;">
          Select your preferred chamber and time slot. Our advocate team will review your matter and confirm with an instant confirmation email and WhatsApp text.
        </p>

        <form id="booking-form" class="zca-ajax-booking-form">
          <div class="form-row">
            <div class="form-group">
              <label class="form-label">Full Name *</label>
              <input type="text" name="name" id="book-name" class="form-control" placeholder="e.g. Tariqul Islam" required>
            </div>
            <div class="form-group">
              <label class="form-label">Company / Organization</label>
              <input type="text" name="company" id="book-company" class="form-control" placeholder="e.g. Apex Tech Ltd">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label class="form-label">Phone / WhatsApp *</label>
              <input type="tel" name="phone" id="book-phone" class="form-control" placeholder="+88 01XXXXXXXXX" required>
            </div>
            <div class="form-group">
              <label class="form-label">Email Address *</label>
              <input type="email" name="email" id="book-email" class="form-control" placeholder="client@company.com" required>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label class="form-label">Chamber Location *</label>
              <select name="chamber" id="book-chamber" class="form-control" required>
                <option value="Mirpur DOHS Corporate Chamber">1. Mirpur DOHS Corporate Chamber</option>
                <option value="Supreme Court Annex Chamber">2. Supreme Court Annex Chamber 1010</option>
                <option value="Dhaka Judge Court Chamber">3. Dhaka Judge Court Chamber B 36</option>
                <option value="Online Virtual Zoom Consultation">4. Online Virtual Consultation (Zoom / Meet)</option>
              </select>
            </div>
            <div class="form-group">
              <label class="form-label">Legal Practice Area</label>
              <select name="practice" class="form-control">
                <option value="Corporate & Company Law">Corporate & Company Law</option>
                <option value="Supreme Court Writ Litigation">Supreme Court Writ & Litigation</option>
                <option value="Cheque Dishonor NI Act 138">Cheque Dishonor NI Act 138</option>
                <option value="Land Title & Property Vetting">Land Title & Property Vetting</option>
                <option value="Taxation, VAT & Customs">Taxation, VAT & Customs</option>
                <option value="Monthly Legal Retainer">Monthly Legal Retainer</option>
                <option value="Other Legal Services">Other Legal Services</option>
              </select>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label class="form-label">Preferred Date *</label>
              <input type="date" name="preferred_date" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
            </div>
            <div class="form-group">
              <label class="form-label">Time Slot</label>
              <select name="preferred_time" class="form-control">
                <option value="Morning (10:00 AM - 1:00 PM)">Morning (10:00 AM - 1:00 PM)</option>
                <option value="Afternoon (2:00 PM - 5:00 PM)">Afternoon (2:00 PM - 5:00 PM)</option>
                <option value="Evening (5:30 PM - 8:30 PM)">Evening (5:30 PM - 8:30 PM)</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">Matter Summary / Legal Question</label>
            <textarea name="notes" rows="2" class="form-control" placeholder="Briefly describe your case or requirements..."></textarea>
          </div>

          <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; padding: 0.85rem 1rem; font-size: 0.95rem; line-height: 1.35; white-space: normal;">
            <i class="fa-solid fa-paper-plane"></i> Confirm Consultation Request
          </button>
        </form>
      </div>
    </div>
  </div>

  <!-- 5. Modal 2: Online Fee & Retainer Payment Gateway -->
  <div class="modal-backdrop" id="paymentModal">
    <div class="modal-container">
      <div class="modal-header">
        <h3 class="modal-title"><i class="fa-solid fa-credit-card"></i> ZCA Legal Fee Payment Portal</h3>
        <button class="modal-close-btn" onclick="closeModal('paymentModal')">&times;</button>
      </div>
      <div class="modal-body">
        <p style="font-size: 0.85rem; color: #64748b; margin-bottom: 1rem;">
          Pay consultation fees, monthly retainer retainers, or court drafting fees securely:
        </p>

        <?php
        $enable_bkash  = zca_get_option('enable_bkash', '1') === '1';
        $enable_nagad  = zca_get_option('enable_nagad', '1') === '1';
        $enable_rocket = zca_get_option('enable_rocket', '1') === '1';
        $enable_bank   = zca_get_option('enable_bank', '1') === '1';

        $first_active = '';
        if ($enable_bkash) {
            $first_active = 'bkash';
        } elseif ($enable_nagad) {
            $first_active = 'nagad';
        } elseif ($enable_rocket) {
            $first_active = 'rocket';
        } elseif ($enable_bank) {
            $first_active = 'bank';
        }
        $has_any_payment = !empty($first_active);
        ?>

        <?php if ($has_any_payment) : ?>
          <!-- Payment Method Selector -->
          <label class="form-label">Select Payment Method</label>
          <div class="payment-methods-grid">
            <?php if ($enable_bkash) : ?>
              <div class="payment-method-item <?php echo ($first_active === 'bkash') ? 'active' : ''; ?>" data-method="bkash">
                <i class="fa-solid fa-mobile-screen-button" style="color: #e2136e; font-size: 1.5rem;"></i>
                <div class="payment-method-name">bKash</div>
              </div>
            <?php endif; ?>

            <?php if ($enable_nagad) : ?>
              <div class="payment-method-item <?php echo ($first_active === 'nagad') ? 'active' : ''; ?>" data-method="nagad">
                <i class="fa-solid fa-wallet" style="color: #f7941d; font-size: 1.5rem;"></i>
                <div class="payment-method-name">Nagad</div>
              </div>
            <?php endif; ?>

            <?php if ($enable_rocket) : ?>
              <div class="payment-method-item <?php echo ($first_active === 'rocket') ? 'active' : ''; ?>" data-method="rocket">
                <i class="fa-solid fa-building-columns" style="color: #8c3494; font-size: 1.5rem;"></i>
                <div class="payment-method-name">Rocket</div>
              </div>
            <?php endif; ?>

            <?php if ($enable_bank) : ?>
              <div class="payment-method-item <?php echo ($first_active === 'bank') ? 'active' : ''; ?>" data-method="bank">
                <i class="fa-solid fa-landmark" style="color: #091528; font-size: 1.5rem;"></i>
                <div class="payment-method-name">Bank Transfer</div>
              </div>
            <?php endif; ?>
          </div>

          <!-- Payment Details Panels -->
          <?php if ($enable_bkash) : ?>
            <div id="method-bkash" class="payment-detail-box <?php echo ($first_active === 'bkash') ? 'active' : ''; ?>">
              <div class="payment-instruction-badge">Personal / Merchant Wallet</div>
              <h4 style="margin: 0 0 0.5rem; color: #091528;">bKash Account: <?php echo esc_html(zca_get_option('bkash_no', '01713 203 275')); ?></h4>
              <p style="font-size: 0.825rem; color: #64748b; line-height: 1.5;">
                1. Go to your bKash App or dial *247#.<br>
                2. Choose <strong>Send Money</strong> to the number above.<br>
                3. Enter Reference: <em>Your Name</em>.<br>
                4. Inform chamber desk with Transaction ID (TrxID) via WhatsApp (+88 <?php echo esc_html($whatsapp); ?>).
              </p>
            </div>
          <?php endif; ?>

          <?php if ($enable_nagad) : ?>
            <div id="method-nagad" class="payment-detail-box <?php echo ($first_active === 'nagad') ? 'active' : ''; ?>">
              <div class="payment-instruction-badge">Nagad Wallet</div>
              <h4 style="margin: 0 0 0.5rem; color: #091528;">Nagad Account: <?php echo esc_html(zca_get_option('nagad_no', '01713 203 275')); ?></h4>
              <p style="font-size: 0.825rem; color: #64748b; line-height: 1.5;">
                Send money to the Nagad number above and share screenshot on WhatsApp.
              </p>
            </div>
          <?php endif; ?>

          <?php if ($enable_rocket) : ?>
            <div id="method-rocket" class="payment-detail-box <?php echo ($first_active === 'rocket') ? 'active' : ''; ?>">
              <div class="payment-instruction-badge">DBBL Rocket</div>
              <h4 style="margin: 0 0 0.5rem; color: #091528;">Rocket Account: <?php echo esc_html(zca_get_option('rocket_no', '01713 203 275-8')); ?></h4>
              <p style="font-size: 0.825rem; color: #64748b; line-height: 1.5;">
                Send fee via Dutch-Bangla Bank Rocket wallet and notify accounts.
              </p>
            </div>
          <?php endif; ?>

          <?php if ($enable_bank) : ?>
            <div id="method-bank" class="payment-detail-box <?php echo ($first_active === 'bank') ? 'active' : ''; ?>">
              <div class="payment-instruction-badge">Bank Direct Deposit / BEFTN / NPSB</div>
              <h4 style="margin: 0 0 0.5rem; color: #091528;">Chamber Corporate Bank Account</h4>
              <p style="font-size: 0.825rem; color: #64748b; line-height: 1.5; white-space: pre-line;">
                <?php echo esc_html(zca_get_option('bank_details', "Bank: Premier Bank Ltd / Sonali Bank\nA/C Name: ZCA LEGAL\nA/C No: 018810000XXXX\nBranch: Mirpur DOHS, Dhaka")); ?>
              </p>
            </div>
          <?php endif; ?>

        <?php else : ?>
          <div style="background: #f8fafc; border: 1px dashed #cbd5e1; border-radius: 8px; padding: 1.5rem; text-align: center;">
            <i class="fa-solid fa-headset" style="font-size: 2rem; color: #c59b4e; margin-bottom: 0.5rem;"></i>
            <h4 style="margin: 0 0 0.5rem; color: #091528;">Online Payment Channels Offline</h4>
            <p style="font-size: 0.85rem; color: #64748b; margin: 0;">
              Please contact our chamber desk directly via WhatsApp to arrange fee payment.
            </p>
          </div>
        <?php endif; ?>

        <div style="margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center;">
          <span style="font-size: 0.8rem; color: #64748b;">Need payment assistance?</span>
          <a href="https://wa.me/88<?php echo esc_attr(preg_replace('/[^0-9]/', '', $whatsapp)); ?>?text=Payment%20Confirmation" target="_blank" class="btn btn-sm btn-whatsapp">
            <i class="fa-brands fa-whatsapp"></i> Confirm on WhatsApp
          </a>
        </div>

      </div>
    </div>
  </div>

  <?php wp_footer(); ?>
</body>
</html>
