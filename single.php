<?php
/**
 * Single Blog Post Template
 *
 * @package ZCA_Legal
 */

get_header();

while (have_posts()) : the_post();
    $categories = get_the_category();
    $cat_name = !empty($categories) ? $categories[0]->name : 'Legal Insights';
    $hotline = zca_get_option('hotline', '09617400600');
    $whatsapp = zca_get_option('whatsapp', '01713203275');
?>

  <!-- Breadcrumbs -->
  <div class="breadcrumb-bar">
    <div class="container">
      <div class="breadcrumb-list">
        <span class="breadcrumb-item"><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></span>
        <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right" style="font-size: 0.7rem;"></i></span>
        <span class="breadcrumb-item"><a href="<?php echo esc_url(home_url('/blog/')); ?>">Blog</a></span>
        <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right" style="font-size: 0.7rem;"></i></span>
        <span style="color: var(--color-gold); font-weight: 600;"><?php the_title(); ?></span>
      </div>
    </div>
  </div>

  <!-- Page Banner -->
  <section class="section section-dark" style="padding: 3.5rem 0 3rem; border-bottom: 2px solid var(--color-gold);">
    <div class="container">
      <span class="section-subtitle"><?php echo esc_html($cat_name); ?></span>
      <h1 class="single-post-title"><?php the_title(); ?></h1>
      <div style="display: flex; gap: 1.5rem; color: #94a3b8; font-size: 0.85rem; flex-wrap: wrap;">
        <span><i class="fa-regular fa-calendar"></i> <?php echo get_the_date(); ?></span>
        <span><i class="fa-regular fa-user"></i> By Advocate Md. Zahid Chowdhury</span>
        <span><i class="fa-regular fa-clock"></i> 6 Min Read</span>
      </div>
    </div>
  </section>

  <!-- Main Article & Sidebar -->
  <section class="section">
    <div class="container">
      <div class="single-page-layout">
        
        <!-- Left: Article Content -->
        <div>
          <div class="single-content-box">
            
            <!-- Featured Image -->
            <?php 
            $single_blog_img = zca_legal_get_blog_image_url(get_the_ID());
            ?>
            <div style="border-radius: 8px; overflow: hidden; margin-bottom: 2rem; max-height: 420px;">
              <img src="<?php echo esc_url($single_blog_img); ?>" alt="<?php the_title_attribute(); ?>" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.onerror=null;this.src='<?php echo get_template_directory_uri(); ?>/assets/images/default-blog-fallback.jpg';">
            </div>

            <!-- Key Takeaways Callout -->
            <div style="background: rgba(197, 155, 78, 0.08); border-left: 4px solid var(--color-gold); border-radius: 6px; padding: 1.25rem; margin-bottom: 2rem;">
              <strong style="color: #091528; display: block; font-size: 1rem; margin-bottom: 0.5rem;">
                <i class="fa-solid fa-lightbulb" style="color: var(--color-gold);"></i> Key Legal Highlights
              </strong>
              <p style="font-size: 0.875rem; color: #475569; margin: 0; line-height: 1.6;">
                Practical corporate advice from Supreme Court practitioners. Always consult legal counsel before signing founder equity schedules, RJSC filings, or commercial agreements.
              </p>
            </div>

            <!-- Article Body -->
            <div style="line-height: 1.85; font-size: 1rem; color: #334155;">
              <?php the_content(); ?>
            </div>

            <!-- Social Share Bar -->
            <?php
            $post_share_url   = urlencode(get_permalink());
            $post_share_title = urlencode(get_the_title());
            ?>
            <div class="post-share-section">
              <div class="post-share-header">
                <div class="post-share-title">
                  <i class="fa-solid fa-share-nodes"></i>
                  <span>Share This Legal Insight</span>
                </div>
                <span class="post-share-subtitle">Distribute practical legal intelligence with your network</span>
              </div>
              <div class="post-share-buttons">
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $post_share_url; ?>" target="_blank" rel="noopener noreferrer" class="share-btn share-facebook" title="Share on Facebook">
                  <i class="fa-brands fa-facebook-f"></i>
                  <span>Facebook</span>
                </a>
                <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $post_share_url; ?>" target="_blank" rel="noopener noreferrer" class="share-btn share-linkedin" title="Share on LinkedIn">
                  <i class="fa-brands fa-linkedin-in"></i>
                  <span>LinkedIn</span>
                </a>
                <a href="https://twitter.com/intent/tweet?url=<?php echo $post_share_url; ?>&text=<?php echo $post_share_title; ?>" target="_blank" rel="noopener noreferrer" class="share-btn share-twitter" title="Share on X (Twitter)">
                  <i class="fa-brands fa-x-twitter"></i>
                  <span>X (Twitter)</span>
                </a>
                <a href="https://api.whatsapp.com/send?text=<?php echo $post_share_title; ?>%20<?php echo $post_share_url; ?>" target="_blank" rel="noopener noreferrer" class="share-btn share-whatsapp" title="Share on WhatsApp">
                  <i class="fa-brands fa-whatsapp"></i>
                  <span>WhatsApp</span>
                </a>
                <a href="mailto:?subject=<?php echo $post_share_title; ?>&body=<?php echo $post_share_url; ?>" class="share-btn share-email" title="Share via Email">
                  <i class="fa-regular fa-envelope"></i>
                  <span>Email</span>
                </a>
                <button type="button" class="share-btn share-copy" onclick="copyPostLink(this, '<?php the_permalink(); ?>')" title="Copy Link to Clipboard">
                  <i class="fa-regular fa-copy"></i>
                  <span class="copy-text">Copy Link</span>
                </button>
              </div>
            </div>

            <!-- Author Bio Box -->
            <div class="single-author-bio">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/images/WhatsApp Image 2026-08-22 at 13.51.52.jpeg" alt="Adv. Zahid Chowdhury" class="single-author-avatar">
              <div class="single-author-info">
                <strong style="color: #091528; font-size: 1.05rem; display: block;">Advocate Md. Zahid Chowdhury</strong>
                <span style="font-size: 0.8rem; color: #c59b4e; font-weight: 600;">Head of Chamber | Advocate, Supreme Court of Bangladesh</span>
                <p style="font-size: 0.825rem; color: #64748b; margin-top: 4px; line-height: 1.5;">
                  Specializing in corporate governance, commercial contract litigation, and High Court writ matters. Standing Committee Member at DCCI.
                </p>
              </div>
            </div>

          </div>
        </div>

        <!-- Right: Sidebar Widget (Clean & High-Definition Design) -->
        <div class="single-sidebar">
          
          <!-- Consultation Widget -->
          <div class="sidebar-widget sidebar-widget-dark">
            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 8px;">
              <div style="width: 36px; height: 36px; border-radius: 6px; background: rgba(197, 155, 78, 0.2); color: var(--color-gold); display: flex; align-items: center; justify-content: center; font-size: 1.1rem; flex-shrink: 0;">
                <i class="fa-regular fa-calendar-check"></i>
              </div>
              <h3 style="font-family: var(--font-heading); font-size: 1.15rem; color: var(--color-gold); margin: 0; line-height: 1.2;">
                Consult Our Advocates
              </h3>
            </div>
            
            <div style="width: 100%; height: 1.5px; background: var(--color-gold-gradient); margin: 12px 0 14px;"></div>

            <p style="font-size: 0.85rem; color: #cbd5e1; line-height: 1.55; margin-bottom: 1.25rem;">
              Need strategic legal counsel on this topic? Schedule an appointment with our chamber advocates:
            </p>
            
            <button class="btn btn-primary" style="width: 100%; justify-content: center; margin-bottom: 0.75rem; padding: 0.85rem;" onclick="openModal('consultationModal')">
              <i class="fa-regular fa-calendar-check"></i> Book Appointment
            </button>
            
            <a href="https://wa.me/88<?php echo esc_attr(preg_replace('/[^0-9]/', '', $whatsapp)); ?>" target="_blank" class="btn btn-whatsapp" style="width: 100%; justify-content: center; padding: 0.85rem;">
              <i class="fa-brands fa-whatsapp"></i> Chat on WhatsApp
            </a>
          </div>

          <!-- Hotline Direct Box -->
          <div class="sidebar-widget">
            <h3 class="sidebar-widget-title">Direct Chamber Hotline</h3>
            <p style="font-size: 0.85rem; color: #64748b; margin-bottom: 1rem; line-height: 1.5;">
              Call our central desk for urgent legal notices and advice:
            </p>
            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $hotline)); ?>" class="btn btn-navy" style="width: 100%; justify-content: flex-start;">
              <i class="fa-solid fa-phone" style="color: #c59b4e;"></i>
              <span>+88 <?php echo esc_html($hotline); ?></span>
            </a>
          </div>

        </div>

      </div>
    </div>
  </section>

<?php
endwhile;

get_footer();
