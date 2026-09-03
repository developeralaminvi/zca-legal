<?php
/**
 * Admin Dashboard for ZCA Legal: Bookings & Inquiries Management
 *
 * @package ZCA_Legal
 */

if (!defined('ABSPATH')) {
    exit;
}

// Render Main Admin Dashboard
function zca_legal_render_admin_dashboard() {
    // Handle Quick Status Update
    if (isset($_POST['update_booking_status']) && isset($_POST['booking_id']) && check_admin_referer('zca_update_status_nonce')) {
        $b_id = intval($_POST['booking_id']);
        $new_status = sanitize_text_field($_POST['status']);
        update_post_meta($b_id, '_zca_booking_status', $new_status);
        echo '<div class="notice notice-success is-dismissible"><p>Booking status updated to ' . esc_html(strtoupper($new_status)) . '!</p></div>';
    }

    // Query Bookings
    $bookings_query = new WP_Query(array(
        'post_type'      => 'zca_booking',
        'posts_per_page' => 50,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC'
    ));

    $total_bookings = $bookings_query->found_posts;
    ?>
    <div class="wrap">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 10px;">
            <div>
                <h1 style="display: flex; align-items: center; gap: 10px; margin: 0;">
                    <span class="dashicons dashicons-shield" style="font-size: 32px; width: 32px; height: 32px; color: #091528;"></span>
                    ZCA LEGAL — Consultation Bookings & Inquiries
                </h1>
                <p style="color: #64748b; margin: 5px 0 0 0;">Manage incoming client consultation requests, chamber appointments, and inquiries in real time.</p>
            </div>
            <div>
                <a href="<?php echo admin_url('admin.php?page=zca-theme-settings'); ?>" class="button button-secondary">⚙️ Chamber Settings</a>
                <a href="<?php echo admin_url('admin.php?page=zca-demo-importer'); ?>" class="button button-primary">📥 1-Click Demo Importer</a>
            </div>
        </div>

        <!-- Metrics Cards -->
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 15px; margin-bottom: 25px;">
            <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 8px; padding: 15px; border-left: 4px solid #091528;">
                <div style="font-size: 12px; color: #64748b; text-transform: uppercase; font-weight: bold;">Total Bookings</div>
                <div style="font-size: 24px; font-weight: bold; color: #091528; margin-top: 5px;"><?php echo intval($total_bookings); ?></div>
            </div>
            <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 8px; padding: 15px; border-left: 4px solid #f59e0b;">
                <div style="font-size: 12px; color: #64748b; text-transform: uppercase; font-weight: bold;">Pending Confirmation</div>
                <div style="font-size: 24px; font-weight: bold; color: #f59e0b; margin-top: 5px;">
                    <?php
                    $pending_q = new WP_Query(array('post_type' => 'zca_booking', 'meta_key' => '_zca_booking_status', 'meta_value' => 'pending'));
                    echo intval($pending_q->found_posts);
                    ?>
                </div>
            </div>
            <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 8px; padding: 15px; border-left: 4px solid #10b981;">
                <div style="font-size: 12px; color: #64748b; text-transform: uppercase; font-weight: bold;">Confirmed Slots</div>
                <div style="font-size: 24px; font-weight: bold; color: #10b981; margin-top: 5px;">
                    <?php
                    $confirmed_q = new WP_Query(array('post_type' => 'zca_booking', 'meta_key' => '_zca_booking_status', 'meta_value' => 'confirmed'));
                    echo intval($confirmed_q->found_posts);
                    ?>
                </div>
            </div>
            <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 8px; padding: 15px; border-left: 4px solid #3b82f6;">
                <div style="font-size: 12px; color: #64748b; text-transform: uppercase; font-weight: bold;">Completed Consultations</div>
                <div style="font-size: 24px; font-weight: bold; color: #3b82f6; margin-top: 5px;">
                    <?php
                    $completed_q = new WP_Query(array('post_type' => 'zca_booking', 'meta_key' => '_zca_booking_status', 'meta_value' => 'completed'));
                    echo intval($completed_q->found_posts);
                    ?>
                </div>
            </div>
        </div>

        <!-- Bookings Table -->
        <div class="postbox" style="padding: 0; overflow: hidden;">
            <div style="padding: 15px 20px; background: #f8fafc; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center;">
                <h3 style="margin: 0; font-size: 15px;">Recent Consultation Appointments</h3>
                <span style="font-size: 12px; color: #64748b;">Showing latest 50 requests</span>
            </div>

            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th style="width: 14%;">Client Name</th>
                        <th style="width: 15%;">Contact / WhatsApp</th>
                        <th style="width: 18%;">Chamber Location</th>
                        <th style="width: 15%;">Practice Area</th>
                        <th style="width: 13%;">Preferred Slot</th>
                        <th style="width: 12%;">Status</th>
                        <th style="width: 13%;">Quick Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($bookings_query->have_posts()) : while ($bookings_query->have_posts()) : $bookings_query->the_post();
                        $b_id = get_the_ID();
                        $name = get_post_meta($b_id, '_zca_client_name', true);
                        $company = get_post_meta($b_id, '_zca_company', true);
                        $phone = get_post_meta($b_id, '_zca_phone', true);
                        $email = get_post_meta($b_id, '_zca_email', true);
                        $chamber = get_post_meta($b_id, '_zca_chamber', true);
                        $practice = get_post_meta($b_id, '_zca_practice', true);
                        $p_date = get_post_meta($b_id, '_zca_preferred_date', true);
                        $p_time = get_post_meta($b_id, '_zca_preferred_time', true);
                        $status = get_post_meta($b_id, '_zca_booking_status', true);
                        if (!$status) $status = 'pending';

                        $status_colors = array(
                            'pending'   => 'background: #fef3c7; color: #92400e; border: 1px solid #fde68a;',
                            'confirmed' => 'background: #d1fae5; color: #065f46; border: 1px solid #a7f3d0;',
                            'completed' => 'background: #e0e7ff; color: #3730a3; border: 1px solid #c7d2fe;',
                            'cancelled' => 'background: #fee2e2; color: #991b1b; border: 1px solid #fecaca;'
                        );
                    ?>
                        <tr>
                            <td>
                                <strong><?php echo esc_html($name ? $name : get_the_title()); ?></strong>
                                <?php if ($company): ?><br><small style="color: #64748b;"><?php echo esc_html($company); ?></small><?php endif; ?>
                            </td>
                            <td>
                                <a href="tel:<?php echo esc_attr($phone); ?>" style="font-weight: bold;"><?php echo esc_html($phone); ?></a><br>
                                <a href="https://wa.me/<?php echo esc_attr(preg_replace('/[^0-9]/', '', $phone)); ?>" target="_blank" style="color: #25D366; font-size: 11px;">💬 WhatsApp</a> | 
                                <a href="mailto:<?php echo esc_attr($email); ?>" style="font-size: 11px;"><?php echo esc_html($email); ?></a>
                            </td>
                            <td>
                                <span style="font-size: 12px; font-weight: 500;"><?php echo esc_html($chamber); ?></span>
                            </td>
                            <td>
                                <span style="font-size: 12px;"><?php echo esc_html($practice); ?></span>
                            </td>
                            <td>
                                <strong><?php echo esc_html($p_date); ?></strong><br>
                                <small style="color: #64748b;"><?php echo esc_html($p_time); ?></small>
                            </td>
                            <td>
                                <span style="display: inline-block; padding: 3px 8px; border-radius: 4px; font-size: 11px; font-weight: bold; text-transform: uppercase; <?php echo esc_attr(isset($status_colors[$status]) ? $status_colors[$status] : ''); ?>">
                                    <?php echo esc_html($status); ?>
                                </span>
                            </td>
                            <td>
                                <form method="post" style="display: flex; gap: 4px; align-items: center;">
                                    <?php wp_nonce_field('zca_update_status_nonce'); ?>
                                    <input type="hidden" name="booking_id" value="<?php echo esc_attr($b_id); ?>">
                                    <select name="status" style="font-size: 11px; padding: 2px;">
                                        <option value="pending" <?php selected($status, 'pending'); ?>>Pending</option>
                                        <option value="confirmed" <?php selected($status, 'confirmed'); ?>>Confirmed</option>
                                        <option value="completed" <?php selected($status, 'completed'); ?>>Completed</option>
                                        <option value="cancelled" <?php selected($status, 'cancelled'); ?>>Cancelled</option>
                                    </select>
                                    <input type="submit" name="update_booking_status" class="button button-small" value="✓">
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; wp_reset_postdata(); else: ?>
                        <tr><td colspan="7" style="text-align: center; padding: 30px; color: #64748b;">No consultation bookings found yet. Website booking submissions will automatically appear here.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
}
