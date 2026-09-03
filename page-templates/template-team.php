<?php
/**
 * Template Name: Our Team / Lawyers
 *
 * @package ZCA_Legal
 */

get_header();
?>

  <!-- Page Banner -->
  <section class="section section-dark" style="padding: 4rem 0 3.5rem; text-align: center; border-bottom: 2px solid var(--color-gold);">
    <div class="container">
      <span class="section-subtitle">Chambers Roster</span>
      <h1 style="color: #fff; margin-bottom: 0.75rem;">Our Legal Team, Associates & Staff</h1>
      <p style="color: #cbd5e1; max-width: 720px; margin: 0 auto; font-size: 1.1rem;">
        Experienced Supreme Court advocates, legal advisors, sector specialists, consultants, and dedicated chamber court clerks.
      </p>
    </div>
  </section>

  <!-- Team Members Grid -->
  <section class="section">
    <div class="container">
      <div class="team-grid">
        <?php
        $team_q = new WP_Query(array(
            'post_type'      => 'team_member',
            'posts_per_page' => -1,
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
            'post_status'    => 'publish'
        ));

        if ($team_q->have_posts()) : while ($team_q->have_posts()) : $team_q->the_post();
            $t_id = get_the_ID();
            $desig = get_post_meta($t_id, '_zca_team_designation', true);
            $deg = get_post_meta($t_id, '_zca_team_degree', true);
            $role = get_post_meta($t_id, '_zca_team_role', true);
            $phone = get_post_meta($t_id, '_zca_team_phone', true);
            $img_url = get_the_post_thumbnail_url($t_id, 'zca-team-thumb');
            
            $badge_label = $role ? $role : 'Advocate';
            if (strpos(strtolower(get_the_title()), 'clerk') !== false) {
                $badge_label = 'Court Clerk';
            } elseif (strpos(strtolower(get_the_title()), 'manager') !== false) {
                $badge_label = 'Manager';
            }
        ?>
            <div class="team-card">
              <div class="team-img-wrap">
                <?php if ($img_url) : ?>
                  <img src="<?php echo esc_url($img_url); ?>" alt="<?php the_title_attribute(); ?>">
                <?php else : ?>
                  <div class="team-avatar-placeholder">
                    <div class="team-avatar-circle">
                      <?php if (strpos(strtolower($badge_label), 'clerk') !== false || strpos(strtolower($badge_label), 'manager') !== false): ?>
                        <i class="fa-solid fa-clipboard-user"></i>
                      <?php elseif (strpos(strtolower($badge_label), 'advisor') !== false): ?>
                        <i class="fa-solid fa-user-shield"></i>
                      <?php else: ?>
                        <i class="fa-solid fa-user-tie"></i>
                      <?php endif; ?>
                    </div>
                    <span class="team-avatar-label"><?php echo esc_html($badge_label); ?></span>
                  </div>
                <?php endif; ?>
              </div>
              <div class="team-info">
                <h3 class="team-name"><?php the_title(); ?></h3>
                <div class="team-designation"><?php echo esc_html($desig ? $desig : 'Advocate'); ?></div>
                <div class="team-degree"><?php echo esc_html($deg ? $deg : 'LL.B. (Hons.), LL.M.'); ?></div>
                <?php if ($phone): ?>
                  <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $phone)); ?>" style="display: inline-block; margin-top: 8px; font-size: 0.8rem; color: var(--color-gold); font-weight: bold;">
                    <i class="fa-solid fa-phone"></i> <?php echo esc_html($phone); ?>
                  </a>
                <?php endif; ?>
              </div>
            </div>
        <?php endwhile; wp_reset_postdata(); endif; ?>
      </div>
    </div>
  </section>

<?php
get_footer();
