<?php
/**
 * Single Practice Area Template with Embedded Direct Booking Form
 *
 * @package ZCA_Legal
 */

get_header();

while (have_posts()) : the_post();
    $p_id = get_the_ID();
    $icon = get_post_meta($p_id, '_zca_practice_icon', true);
    if (!$icon) $icon = 'fa-solid fa-scale-balanced';
    $badge = get_post_meta($p_id, '_zca_practice_badge', true);
    $terms = get_the_terms($p_id, 'practice_category');
    $cat_name = ($terms && !is_wp_error($terms)) ? $terms[0]->name : 'Legal Practice';

    // Dynamic Roadmap Steps from Repeater or Legacy Fallback
    $steps = get_post_meta($p_id, '_zca_practice_steps', true);
    if (empty($steps) || !is_array($steps)) {
        $step1_title = get_post_meta($p_id, '_zca_step1_title', true);
        $step1_desc = get_post_meta($p_id, '_zca_step1_desc', true);
        $step2_title = get_post_meta($p_id, '_zca_step2_title', true);
        $step2_desc = get_post_meta($p_id, '_zca_step2_desc', true);
        $step3_title = get_post_meta($p_id, '_zca_step3_title', true);
        $step3_desc = get_post_meta($p_id, '_zca_step3_desc', true);
        $step4_title = get_post_meta($p_id, '_zca_step4_title', true);
        $step4_desc = get_post_meta($p_id, '_zca_step4_desc', true);

        $steps = array();
        if ($step1_title) $steps[] = array('title' => $step1_title, 'desc' => $step1_desc);
        if ($step2_title) $steps[] = array('title' => $step2_title, 'desc' => $step2_desc);
        if ($step3_title) $steps[] = array('title' => $step3_title, 'desc' => $step3_desc);
        if ($step4_title) $steps[] = array('title' => $step4_title, 'desc' => $step4_desc);

        if (empty($steps)) {
            $steps = array(
                array('title' => 'Preliminary Consultation & Fact Assessment', 'desc' => 'Evaluating client business model, relevant laws, and drafting roadmap.'),
                array('title' => 'Document Vetting & Statutory Drafting', 'desc' => 'Preparing customized agreements, petitions, affidavits, and board resolutions.'),
                array('title' => 'Regulatory Filing & Hearings', 'desc' => 'Submitting to RJSC / High Court / NBR / BIDA and conducting judicial hearings.'),
                array('title' => 'Certified Execution & Compliance', 'desc' => 'Delivering certified licenses, court orders, and ongoing retainer support.')
            );
        }
    }

    $checklist_raw = get_post_meta($p_id, '_zca_practice_checklist', true);
    if ($checklist_raw) {
        $checklist_items = array_filter(array_map('trim', explode("\n", $checklist_raw)));
    } else {
        $checklist_items = array(
            'National ID / Passport copy of directors or applicants',
            'Registered commercial office tenancy agreement & utility bill',
            'Trade License, e-TIN, and relevant sector permits',
            'Draft agreements, bank return memos, or existing correspondence'
        );
    }

    $hotline = zca_get_option('hotline', '09617400600');
    $whatsapp = zca_get_option('whatsapp', '01713203275');
?>

  <!-- Breadcrumbs -->
  <div class="breadcrumb-bar">
    <div class="container">
      <div class="breadcrumb-list">
        <span class="breadcrumb-item"><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></span>
        <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right" style="font-size: 0.7rem;"></i></span>
        <span class="breadcrumb-item"><a href="<?php echo esc_url(home_url('/practice-areas/')); ?>">Practice Areas</a></span>
        <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right" style="font-size: 0.7rem;"></i></span>
        <span style="color: var(--color-gold); font-weight: 600;"><?php the_title(); ?></span>
      </div>
    </div>
  </div>

  <!-- Page Banner -->
  <section class="section section-dark" style="padding: 3.5rem 0 3rem; border-bottom: 2px solid var(--color-gold);">
    <div class="container">
      <span class="section-subtitle"><?php echo esc_html($cat_name); ?></span>
      <h1 style="color: #fff; margin-bottom: 0.5rem;"><?php the_title(); ?></h1>
      <p style="color: #cbd5e1; max-width: 780px; font-size: 1.05rem;">
        <?php echo esc_html(get_the_excerpt()); ?>
      </p>
    </div>
  </section>

  <!-- Main 2-Column Content with Direct Booking Sidebar -->
  <section class="section">
    <div class="container">
      <div class="single-page-layout">
        
        <!-- Left: Detailed Content -->
        <div>
          <div class="single-content-box">
            <h2 style="font-size: 1.5rem; margin-bottom: 1rem; color: #091528;">Scope of Legal Practice & Representation</h2>
            <div style="line-height: 1.8; color: #334155; margin-bottom: 2rem;">
              <?php the_content(); ?>
            </div>

            <!-- Dynamic Legal Procedure Roadmap (From Repeater) -->
            <h3 style="font-size: 1.3rem; margin: 2rem 0 1rem; color: #091528;">Step-by-Step Legal Procedure</h3>
            <div class="process-step-grid">
              <?php foreach ($steps as $index => $st) : ?>
                <div class="process-step-item">
                  <div class="process-step-num"><?php echo ($index + 1); ?></div>
                  <strong style="color: #091528; display: block; margin-bottom: 4px;"><?php echo esc_html($st['title']); ?></strong>
                  <span style="font-size: 0.85rem; color: #64748b;"><?php echo esc_html($st['desc']); ?></span>
                </div>
              <?php endforeach; ?>
            </div>

            <!-- Required Documents Checklist -->
            <h3 style="font-size: 1.3rem; margin: 2rem 0 0.75rem; color: #091528;">Required Documentation Checklist</h3>
            <div class="checklist-box">
              <?php foreach ($checklist_items as $c_item): ?>
                <div class="checklist-item">
                  <i class="fa-solid fa-circle-check"></i>
                  <span><?php echo esc_html($c_item); ?></span>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>

        <!-- Right: Embedded Direct Booking Form & Lawyer Info -->
        <div class="single-sidebar">
          
          <!-- Direct Consultation Booking Widget -->
          <div class="sidebar-widget sidebar-widget-dark">
            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 8px;">
              <div style="width: 36px; height: 36px; border-radius: 6px; background: rgba(197, 155, 78, 0.2); color: var(--color-gold); display: flex; align-items: center; justify-content: center; font-size: 1.1rem; flex-shrink: 0;">
                <i class="fa-regular fa-calendar-check"></i>
              </div>
              <h3 style="font-family: var(--font-heading); font-size: 1.15rem; color: var(--color-gold); margin: 0; line-height: 1.2;">
                Book Consultation
              </h3>
            </div>
            
            <div style="width: 100%; height: 1.5px; background: var(--color-gold-gradient); margin: 10px 0 14px;"></div>

            <p style="font-size: 0.825rem; color: #cbd5e1; margin-bottom: 1.25rem;">
              Directly schedule an in-person chamber appointment or Zoom session for this service:
            </p>

            <form id="practice-single-booking" class="zca-ajax-booking-form" data-service="<?php the_title_attribute(); ?>">
              <input type="hidden" name="service" value="<?php the_title_attribute(); ?>">

              <div class="form-group">
                <label class="form-label" style="color: #cbd5e1;">Your Full Name *</label>
                <input type="text" name="client_name" class="form-control" placeholder="e.g. Tariqul Islam" required>
              </div>

              <div class="form-group">
                <label class="form-label" style="color: #cbd5e1;">Phone / WhatsApp *</label>
                <input type="tel" name="phone" class="form-control" placeholder="+88 01XXXXXXXXX" required>
              </div>

              <div class="form-group">
                <label class="form-label" style="color: #cbd5e1;">Email Address *</label>
                <input type="email" name="email" class="form-control" placeholder="name@company.com" required>
              </div>

              <div class="form-group">
                <label class="form-label" style="color: #cbd5e1;">Chamber Choice *</label>
                <select name="chamber" class="form-control" required>
                  <option value="Mirpur DOHS Corporate Chamber">Mirpur DOHS Corporate Chamber</option>
                  <option value="Supreme Court Bar Chamber">Supreme Court Chamber 1010</option>
                  <option value="Dhaka Judge Court Chamber">Dhaka Judge Court B 36</option>
                  <option value="Online Video Conference">Online Virtual (Zoom / Meet)</option>
                </select>
              </div>

              <div class="form-group">
                <label class="form-label" style="color: #cbd5e1;">Preferred Date *</label>
                <input type="date" name="preferred_date" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
              </div>

              <div class="form-group">
                <label class="form-label" style="color: #cbd5e1;">Case Summary</label>
                <textarea name="notes" rows="2" class="form-control" placeholder="Specific questions..."></textarea>
              </div>

              <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; padding: 0.85rem;">
                <i class="fa-regular fa-paper-plane"></i> Submit Appointment Request
              </button>
            </form>
          </div>

          <!-- Practice Lead Card -->
          <div class="sidebar-widget">
            <h3 class="sidebar-widget-title">Practice Lead Advocate</h3>
            <div style="display: flex; gap: 12px; align-items: center; margin-bottom: 12px;">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/images/WhatsApp Image 2026-08-22 at 13.51.52.jpeg" alt="Adv. Zahid Chowdhury" style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover; border: 2px solid var(--color-gold);">
              <div>
                <strong style="color: #091528; font-size: 0.95rem; display: block;">Adv. Md. Zahid Chowdhury</strong>
                <span style="font-size: 0.775rem; color: #64748b;">Advocate, Supreme Court of Bangladesh</span>
              </div>
            </div>
            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', zca_get_option('hotline', '09617400600'))); ?>" class="btn btn-sm btn-navy" style="width: 100%;">
              <i class="fa-solid fa-phone"></i> Call Direct: <?php echo esc_html(zca_get_option('hotline', '09617400600')); ?>
            </a>
          </div>

        </div>

      </div>
    </div>
  </section>

<?php
endwhile;

get_footer();
