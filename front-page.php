<?php
/**
 * Master Front Page Template for ZCA LEGAL
 *
 * @package ZCA_Legal
 */

get_header();

$hotline = zca_get_option('hotline', '09617400600');
$whatsapp = zca_get_option('whatsapp', '01713203275');
$hero_img = zca_get_option('hero_image', get_template_directory_uri() . '/assets/images/WhatsApp Image 2026-08-22 at 13.51.52.jpeg');
?>

  <!-- 1. Hero Section (With Prominent Advocate Portrait Image Card) -->
  <section class="hero-section">
    <div class="container">
      <div class="hero-grid">
        
        <!-- Left: Hero Text & Value Proposition -->
        <div>
          <div class="hero-badge-retainer">
            <i class="fa-solid fa-crown"></i> Monthly Retainer & Full-Service Law Firm
          </div>

          <h1 class="hero-title">
            Legal Strategy.<br>
            Corporate Counsel.<br>
            <span>Decisive Results.</span>
          </h1>

          <p class="hero-description">
            Led by <strong>Advocate Md. Zahid Chowdhury</strong>, Supreme Court of Bangladesh & DCCI Standing Committee Member. Providing high-impact corporate advisory, writ litigation, and business dispute resolution across Dhaka.
          </p>

          <div class="hero-pills">
            <div class="hero-pill-item">
              <i class="fa-solid fa-circle-check"></i> <span>Supreme Court of Bangladesh</span>
            </div>
            <div class="hero-pill-item">
              <i class="fa-solid fa-circle-check"></i> <span>3 Dhaka Chamber Locations</span>
            </div>
            <div class="hero-pill-item">
              <i class="fa-solid fa-circle-check"></i> <span>50+ Corporate Retainers</span>
            </div>
          </div>

          <div class="hero-cta-group">
            <button class="btn btn-primary btn-lg" onclick="openModal('consultationModal')">
              <i class="fa-regular fa-calendar-check"></i> Book Consultation
            </button>
            <a href="<?php echo esc_url(home_url('/monthly-retainer/')); ?>" class="btn btn-navy btn-lg">
              Monthly Retainer Plans
            </a>
            <div class="hero-call-box">
              <div class="hero-call-icon">
                <i class="fa-solid fa-phone-volume"></i>
              </div>
              <div class="hero-call-content">
                <span class="hero-call-sub">Chamber Hotline</span>
                <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $hotline)); ?>" class="hero-call-num">
                  +88 <?php echo esc_html($hotline); ?>
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- Right: Prominent Advocate Hero Portrait Image Card -->
        <div>
          <div class="hero-portrait-card">
            
            <div class="hero-portrait-frame">
              <img src="<?php echo esc_url($hero_img); ?>" alt="Advocate Md. Zahid Chowdhury" class="hero-portrait-img">
              <div class="hero-portrait-overlay"></div>
            </div>

            <!-- Fast Action Beneath Portrait -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 12px;">
              <button class="btn btn-whatsapp btn-sm" onclick="openWhatsApp('Hello Adv. Zahid Chowdhury, I would like to consult ZCA Legal chambers.')" style="width: 100%;">
                <i class="fa-brands fa-whatsapp"></i> Chat WhatsApp
              </button>
              <button class="btn btn-primary btn-sm" onclick="openModal('consultationModal')" style="width: 100%;">
                <i class="fa-regular fa-calendar-check"></i> Book Meeting
              </button>
            </div>

          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- 2. Trust Stats Bar -->
  <section class="trust-strip">
    <div class="container">
      <div class="trust-strip-grid">
        <div class="trust-item">
          <div class="trust-icon"><i class="fa-solid fa-award"></i></div>
          <div>
            <div class="trust-number"><?php echo esc_html(zca_get_option('stat_exp', '15+ Years')); ?></div>
            <div class="trust-label">Legal Excellence</div>
          </div>
        </div>
        <div class="trust-item">
          <div class="trust-icon"><i class="fa-solid fa-building-circle-check"></i></div>
          <div>
            <div class="trust-number"><?php echo esc_html(zca_get_option('stat_clients', '50+ Corporate')); ?></div>
            <div class="trust-label">Retainer Clients</div>
          </div>
        </div>
        <div class="trust-item">
          <div class="trust-icon"><i class="fa-solid fa-scale-balanced"></i></div>
          <div>
            <div class="trust-number"><?php echo esc_html(zca_get_option('stat_cases', '3,500+ Cases')); ?></div>
            <div class="trust-label">Successfully Resolved</div>
          </div>
        </div>
        <div class="trust-item">
          <div class="trust-icon"><i class="fa-solid fa-shield-halved"></i></div>
          <div>
            <div class="trust-number">100%</div>
            <div class="trust-label">Privilege & Integrity</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 2.5. How We Can Help You Section (Clean Card Grid with Vector Icons) -->
  <section class="help-you-section">
    <div class="container">
      <div class="help-you-header">
        <h2 class="help-you-title">HOW WE CAN HELP YOU</h2>
        <div class="help-you-title-line"></div>
      </div>

      <div class="help-you-grid">
        <?php
        $help_cards = array(
            array(
                'title' => 'CIVIL CASES',
                'slug'  => 'civil-cases',
                'desc'  => 'Representation in all types of civil litigation matters.'
            ),
            array(
                'title' => 'CRIMINAL CASES',
                'slug'  => 'criminal-cases',
                'desc'  => 'Defense in criminal cases at all stages of the proceedings.'
            ),
            array(
                'title' => 'WRIT FILE',
                'slug'  => 'writ-file',
                'desc'  => 'Filing writ petitions in High Court Division for your rights.'
            ),
            array(
                'title' => 'BAIL',
                'slug'  => 'bail',
                'desc'  => 'Bail matters in criminal cases with urgency.'
            ),
            array(
                'title' => 'CHEQUE MATTER',
                'slug'  => 'cheque-matter',
                'desc'  => 'Legal assistance in cheque dishonour and related cases.'
            ),
            array(
                'title' => 'COMPANY REGISTRATION',
                'slug'  => 'company-registration',
                'desc'  => 'Company formation and all RJSC related services.'
            ),
            array(
                'title' => 'TRADEMARK REGISTRATION',
                'slug'  => 'trademark-registration',
                'desc'  => 'Trademark search, filing and registration related services.'
            ),
            array(
                'title' => 'SHARE TRANSFER',
                'slug'  => 'share-transfer',
                'desc'  => 'Share transfer, allotment and other company matters.'
            ),
            array(
                'title' => 'INCOME TAX VAT & CUSTOMS',
                'slug'  => 'income-tax-vat-customs',
                'desc'  => 'Tax planning, VAT, Customs and Income Tax related services.'
            ),
            array(
                'title' => 'FAMILY MATTERS',
                'slug'  => 'family-matters',
                'desc'  => 'Divorce, maintenance, child custody and other family issues.'
            ),
        );

        foreach ($help_cards as $card) :
            $card_post = get_page_by_path($card['slug'], OBJECT, 'practice_area');
            if ($card_post) {
                $link = get_permalink($card_post->ID);
            } else {
                $link = home_url('/practice-area/' . $card['slug'] . '/');
            }
        ?>
          <a href="<?php echo esc_url($link); ?>" class="help-you-card">
            <div class="help-you-icon-box">
              <?php echo zca_get_practice_svg_icon($card['slug']); ?>
            </div>
            <h3 class="help-you-card-title"><?php echo esc_html($card['title']); ?></h3>
            <div class="help-you-card-line"></div>
            <p class="help-you-card-desc"><?php echo esc_html($card['desc']); ?></p>
          </a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>


  <!-- 3. Practice Areas Showcase (Dynamic CPT Grid with Images) -->
  <section class="section section-alt">
    <div class="container">
      <div class="section-header">
        <span class="section-subtitle">Chamber Practice Domains</span>
        <h2 class="section-title">Core Legal Practice Areas</h2>
        <p class="section-description">
          Business-driven legal advice, statutory drafting, and litigation advocacy before Supreme Court and Special Tribunals.
        </p>
      </div>

      <div class="practice-image-grid">
        <?php
        $practice_query = new WP_Query(array(
            'post_type'      => 'practice_area',
            'posts_per_page' => 6,
            'post_status'    => 'publish',
        ));

        if ($practice_query->have_posts()) : while ($practice_query->have_posts()) : $practice_query->the_post();
            $icon = get_post_meta(get_the_ID(), '_zca_practice_icon', true);
            if (!$icon) $icon = 'fa-solid fa-scale-balanced';
            $badge = get_post_meta(get_the_ID(), '_zca_practice_badge', true);
            $terms = get_the_terms(get_the_ID(), 'practice_category');
            $cat_name = ($terms && !is_wp_error($terms)) ? $terms[0]->name : 'Legal Practice';
            $img_url = get_the_post_thumbnail_url(get_the_ID(), 'zca-card-thumb');
            if (!$img_url) $img_url = get_template_directory_uri() . '/assets/images/adv-zahid-presentation.jpeg';
        ?>
            <div class="practice-img-card">
              <div class="practice-card-thumb">
                <img src="<?php echo esc_url($img_url); ?>" alt="<?php the_title_attribute(); ?>">
                <div class="practice-thumb-overlay"></div>
                <div class="practice-thumb-icon"><?php echo zca_get_practice_svg_icon(get_the_title() . ' ' . $icon); ?></div>
              </div>
              <div class="practice-card-body">
                <span class="practice-card-badge"><?php echo esc_html($cat_name); ?></span>
                <h3 class="practice-card-heading"><?php the_title(); ?></h3>
                <p class="practice-card-text"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 20)); ?></p>
                <div class="practice-card-footer">
                  <a href="<?php the_permalink(); ?>" class="practice-card-link">View Scope & Book <i class="fa-solid fa-arrow-right"></i></a>
                  <button class="btn btn-sm btn-outline-gold" onclick="openModal('consultationModal')">Book</button>
                </div>
              </div>
            </div>
        <?php endwhile; wp_reset_postdata(); else: ?>
            <div class="practice-img-card">
              <div class="practice-card-thumb">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/adv-zahid-presentation.jpeg" alt="Corporate Law">
                <div class="practice-thumb-overlay"></div>
                <div class="practice-thumb-icon"><?php echo zca_get_practice_svg_icon('Corporate & Company Law'); ?></div>
              </div>
              <div class="practice-card-body">
                <span class="practice-card-badge">Corporate Practice</span>
                <h3 class="practice-card-heading">Corporate & Company Law</h3>
                <p class="practice-card-text">Company formation, RJSC approvals, One Person Company (OPC), share transfers (Form 117), and foreign investments.</p>
                <div class="practice-card-footer">
                  <a href="<?php echo esc_url(home_url('/practice-areas/')); ?>" class="practice-card-link">View Scope & Book <i class="fa-solid fa-arrow-right"></i></a>
                </div>
              </div>
            </div>
        <?php endif; ?>
      </div>

      <div style="text-align: center; margin-top: 2.5rem;">
        <a href="<?php echo esc_url(home_url('/practice-areas/')); ?>" class="btn btn-navy btn-lg">
          <i class="fa-solid fa-list-check"></i> Explore All 24 Practice Areas
        </a>
      </div>
    </div>
  </section>

  <!-- 4. Monthly Legal Retainer Section -->
  <section class="section retainer-section">
    <div class="container">
      <div class="section-header">
        <span class="section-subtitle">Dedicated Corporate Legal Support</span>
        <h2 class="section-title" style="color: #fff;">Monthly Legal Retainer Plans</h2>
        <p class="section-description" style="color: #cbd5e1;">
          Ensure continuous statutory protection, contract drafting, and priority Supreme Court advocacy with our flexible monthly retainer packages.
        </p>
      </div>

      <div class="retainer-grid">
        <div class="retainer-card">
          <h3 class="retainer-plan-name">Startup Legal Retainer</h3>
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

        <div class="retainer-card">
          <h3 class="retainer-plan-name">Enterprise / Group Retainer</h3>
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

  <!-- 5. Head of Chambers & About Profile -->
  <section class="section">
    <div class="container">
      <div class="about-preview-grid">
        <div class="about-img-box">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/WhatsApp Image 2026-08-22 at 13.51.52.jpeg" alt="Advocate Md. Zahid Chowdhury">
          <div class="about-floating-badge">
            <div class="about-floating-badge-title">Adv. Md. Zahid Chowdhury</div>
            <div class="about-floating-badge-desc">Head of Chamber & Advocate, Supreme Court of Bangladesh. DCCI Standing Committee Member.</div>
          </div>
        </div>

        <div>
          <span class="section-subtitle">Chamber Leadership</span>
          <h2 class="section-title">Where Law Meets Leadership</h2>
          <p style="font-size: 1rem; color: #475569; line-height: 1.7; margin-bottom: 1rem;">
            <strong>ZCA LEGAL (Zahid Chowdhury & Associates)</strong> is recognized for delivering sophisticated legal counsel tailored to corporate entities, financial institutions, and international investors navigating Bangladesh’s legal landscape.
          </p>
          <p style="font-size: 0.925rem; color: #64748b; line-height: 1.7; margin-bottom: 1.5rem;">
            With chambers strategically located at <strong>Mirpur DOHS, Supreme Court Bar Association, and Dhaka Judge Court</strong>, our team provides responsive representation in corporate governance, commercial disputes, and constitutional writ litigation.
          </p>

          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; padding: 12px;">
              <strong style="color: #091528; display: block; margin-bottom: 4px;">Advocacy & Strategy</strong>
              <span style="font-size: 0.8rem; color: #64748b;">Supreme Court writ, bail, injunctions, and appellate litigation.</span>
            </div>
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; padding: 12px;">
              <strong style="color: #091528; display: block; margin-bottom: 4px;">Corporate Retainer</strong>
              <span style="font-size: 0.8rem; color: #64748b;">Contract drafting, RJSC compliance, and commercial debt recovery.</span>
            </div>
          </div>

          <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
            <a href="<?php echo esc_url(home_url('/about-us/')); ?>" class="btn btn-navy">About Our Chambers</a>
            <a href="<?php echo esc_url(home_url('/our-team/')); ?>" class="btn btn-outline-gold">Our Legal Team</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 6. Awards & DCCI Recognition -->
  <section class="section section-alt">
    <div class="container">
      <div class="section-header">
        <span class="section-subtitle">Distinctions & Accreditations</span>
        <h2 class="section-title">Awards & Professional Honors</h2>
        <p class="section-description">
          Recognized nationally and internationally for outstanding contributions in legal strategy, leadership, and commercial advocacy.
        </p>
      </div>

      <div class="awards-grid">
        <div class="award-card">
          <div class="award-img-wrap">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/award-star-excellence-2025.jpeg" alt="Star Excellence Awards 2025">
          </div>
          <div class="award-content">
            <span class="award-year">Award Winner 2025</span>
            <h3 class="award-title">Star Excellence Awards 2025</h3>
            <p class="award-desc">Honored with the Star Excellence Award 2025 in Legal Advocacy for outstanding performance in corporate strategy and litigation.</p>
          </div>
        </div>

        <div class="award-card">
          <div class="award-img-wrap">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/award-global-iconic-2026.jpeg" alt="Global Iconic Leadership 2026">
          </div>
          <div class="award-content">
            <span class="award-year">Global Recognition 2026</span>
            <h3 class="award-title">Global Iconic Leadership Award</h3>
            <p class="award-desc">Awarded at the Global Youth Leadership Summit for transformative legal counsel and youth empowerment initiatives.</p>
          </div>
        </div>

        <div class="award-card">
          <div class="award-img-wrap">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/certificate-dcci.jpeg" alt="DCCI Standing Committee">
          </div>
          <div class="award-content">
            <span class="award-year">Accreditation</span>
            <h3 class="award-title">DCCI Standing Committee Member</h3>
            <p class="award-desc">Dhaka Chamber of Commerce & Industry (DCCI) standing committee session for commercial business policies.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 7. Chambers Directory & Fast Directions -->
  <section class="section">
    <div class="container">
      <div class="section-header">
        <span class="section-subtitle">Chamber Locations</span>
        <h2 class="section-title">Visit Our Chambers</h2>
        <p class="section-description">
          Conveniently located across 3 key strategic hubs in Dhaka for easy consultation access.
        </p>
      </div>

      <div class="chambers-grid">
        <div class="chamber-card">
          <div>
            <span class="chamber-badge">Head Corporate Chamber</span>
            <h3 class="chamber-title"><?php echo esc_html(zca_get_option('chamber1_title', 'Mirpur DOHS Corporate Chamber')); ?></h3>
            <p class="chamber-address">
              <i class="fa-solid fa-location-dot"></i>
              <span><?php echo esc_html(zca_get_option('chamber1_address', 'Flat C2, House 1188, Avenue 11, Mirpur DOHS, Dhaka 1216')); ?></span>
            </p>
          </div>
          <div class="chamber-actions">
            <a href="<?php echo esc_url(zca_get_option('chamber1_map', 'https://maps.google.com/?q=Mirpur+DOHS+Avenue+11+Dhaka')); ?>" target="_blank" class="btn btn-sm btn-navy">
              <i class="fa-solid fa-map-location-dot"></i> Directions
            </a>
            <button class="btn btn-sm btn-outline-gold" onclick="openModal('consultationModal')">
              Book Here
            </button>
          </div>
        </div>

        <div class="chamber-card">
          <div>
            <span class="chamber-badge">High Court Litigation Chamber</span>
            <h3 class="chamber-title"><?php echo esc_html(zca_get_option('chamber2_title', 'Supreme Court Bar Chamber')); ?></h3>
            <p class="chamber-address">
              <i class="fa-solid fa-scale-balanced"></i>
              <span><?php echo esc_html(zca_get_option('chamber2_address', 'Room 1010 (Annex Building), Supreme Court Bar Association, Dhaka 1000')); ?></span>
            </p>
          </div>
          <div class="chamber-actions">
            <a href="<?php echo esc_url(zca_get_option('chamber2_map', 'https://maps.google.com/?q=Supreme+Court+Bar+Association+Dhaka')); ?>" target="_blank" class="btn btn-sm btn-navy">
              <i class="fa-solid fa-map-location-dot"></i> Directions
            </a>
            <button class="btn btn-sm btn-outline-gold" onclick="openModal('consultationModal')">
              Book Here
            </button>
          </div>
        </div>

        <div class="chamber-card">
          <div>
            <span class="chamber-badge">District & Magistrate Chamber</span>
            <h3 class="chamber-title"><?php echo esc_html(zca_get_option('chamber3_title', 'Dhaka Judge Court Chamber')); ?></h3>
            <p class="chamber-address">
              <i class="fa-solid fa-landmark"></i>
              <span><?php echo esc_html(zca_get_option('chamber3_address', 'Room No. B 36, Parjoar Center, 22 Court House Street, Kotwali, Dhaka 1000')); ?></span>
            </p>
          </div>
          <div class="chamber-actions">
            <a href="<?php echo esc_url(zca_get_option('chamber3_map', 'https://maps.google.com/?q=Court+House+Street+Kotwali+Dhaka')); ?>" target="_blank" class="btn btn-sm btn-navy">
              <i class="fa-solid fa-map-location-dot"></i> Directions
            </a>
            <button class="btn btn-sm btn-outline-gold" onclick="openModal('consultationModal')">
              Book Here
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>

<?php
get_footer();
