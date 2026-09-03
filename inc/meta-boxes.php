<?php
/**
 * Custom Meta Boxes for ZCA Legal
 *
 * @package ZCA_Legal
 */

if (!defined('ABSPATH')) {
    exit;
}

// Register Meta Boxes
function zca_legal_add_meta_boxes() {
    // Practice Area Meta Box
    add_meta_box(
        'zca_practice_details',
        __('Practice Area Details & Dynamic Roadmap Steps (ধাপসমূহ)', 'zca-legal'),
        'zca_legal_render_practice_meta_box',
        'practice_area',
        'normal',
        'high'
    );

    // Team Member Meta Box
    add_meta_box(
        'zca_team_details',
        __('Lawyer Credentials & Contact', 'zca-legal'),
        'zca_legal_render_team_meta_box',
        'team_member',
        'normal',
        'high'
    );

    // Gallery Item Meta Box
    add_meta_box(
        'zca_gallery_details',
        __('Award / Event Details', 'zca-legal'),
        'zca_legal_render_gallery_meta_box',
        'gallery_item',
        'normal',
        'high'
    );

    // Booking Details Meta Box
    add_meta_box(
        'zca_booking_details',
        __('Consultation Appointment Details', 'zca-legal'),
        'zca_legal_render_booking_meta_box',
        'zca_booking',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'zca_legal_add_meta_boxes');

// Render Practice Area Meta Box with Dynamic Step Repeater
function zca_legal_render_practice_meta_box($post) {
    wp_nonce_field('zca_practice_meta_nonce', 'zca_practice_nonce');
    $icon = get_post_meta($post->ID, '_zca_practice_icon', true);
    $badge = get_post_meta($post->ID, '_zca_practice_badge', true);
    $checklist = get_post_meta($post->ID, '_zca_practice_checklist', true);

    // Dynamic Roadmap Steps Repeater
    $steps = get_post_meta($post->ID, '_zca_practice_steps', true);
    if (empty($steps) || !is_array($steps)) {
        // Fallback / legacy migration
        $step1_title = get_post_meta($post->ID, '_zca_step1_title', true);
        $step1_desc = get_post_meta($post->ID, '_zca_step1_desc', true);
        $step2_title = get_post_meta($post->ID, '_zca_step2_title', true);
        $step2_desc = get_post_meta($post->ID, '_zca_step2_desc', true);
        $step3_title = get_post_meta($post->ID, '_zca_step3_title', true);
        $step3_desc = get_post_meta($post->ID, '_zca_step3_desc', true);
        $step4_title = get_post_meta($post->ID, '_zca_step4_title', true);
        $step4_desc = get_post_meta($post->ID, '_zca_step4_desc', true);

        $steps = array();
        if ($step1_title) $steps[] = array('title' => $step1_title, 'desc' => $step1_desc);
        if ($step2_title) $steps[] = array('title' => $step2_title, 'desc' => $step2_desc);
        if ($step3_title) $steps[] = array('title' => $step3_title, 'desc' => $step3_desc);
        if ($step4_title) $steps[] = array('title' => $step4_title, 'desc' => $step4_desc);

        if (empty($steps)) {
            $steps = array(
                array('title' => 'Initial Consultation & Strategy', 'desc' => 'Assessing legal facts, applicable statutes, and client business requirements.'),
                array('title' => 'Drafting & Statutory Vetting', 'desc' => 'Preparing customized legal petitions, agreements, and board resolutions.'),
                array('title' => 'Filing & Judicial Representation', 'desc' => 'Submitting to RJSC / Courts / NBR / BIDA and conducting hearings.'),
                array('title' => 'Execution & Compliance', 'desc' => 'Obtaining certified orders, licenses, and ongoing statutory maintenance.')
            );
        }
    }
    ?>
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
        <div>
            <label><strong>Icon Class (FontAwesome):</strong></label><br>
            <input type="text" name="zca_practice_icon" value="<?php echo esc_attr($icon ? $icon : 'fa-solid fa-scale-balanced'); ?>" style="width: 100%;" placeholder="e.g. fa-solid fa-city">
            <small style="color: #666;">Examples: fa-solid fa-city, fa-solid fa-file-signature, fa-solid fa-building</small>
        </div>
        <div>
            <label><strong>Badge (Optional):</strong></label><br>
            <input type="text" name="zca_practice_badge" value="<?php echo esc_attr($badge); ?>" style="width: 100%;" placeholder="e.g. Popular / Tech / Global">
        </div>
    </div>

    <hr style="margin: 15px 0;">
    
    <!-- Dynamic Step Repeater Component -->
    <div style="margin-bottom: 15px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
            <h4 style="margin: 0; color: #091528;">
                <strong>⚡ Legal Procedure Roadmap Steps (কাস্টম স্টেপ রিপিটার):</strong>
            </h4>
            <span style="font-size: 12px; color: #64748b;">আপনি ইচ্ছেমতো স্টেপ যোগ বা ডিলিট করতে পারবেন</span>
        </div>

        <div id="zca-steps-repeater-wrapper">
            <?php foreach ($steps as $index => $step) : ?>
                <div class="zca-step-item" style="background: #f8fafc; border: 1px solid #cbd5e1; border-radius: 6px; padding: 15px; margin-bottom: 12px; position: relative;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                        <strong style="color: #091528; font-size: 13px;">
                            <span class="step-num-badge" style="background: #091528; color: #c59b4e; padding: 2px 8px; border-radius: 3px; font-size: 11px;">Step <span class="step-index-display"><?php echo ($index + 1); ?></span></span>
                        </strong>
                        <button type="button" class="button button-small zca-remove-step-btn" style="color: #ef4444; border-color: #fca5a5;" onclick="zcaRemoveStep(this)">
                            ❌ Remove Step
                        </button>
                    </div>
                    <div style="margin-bottom: 8px;">
                        <label style="font-size: 12px; font-weight: 600;">Step Title:</label>
                        <input type="text" name="zca_steps[<?php echo $index; ?>][title]" value="<?php echo esc_attr($step['title']); ?>" style="width: 100%; margin-top: 3px;" placeholder="e.g. Preliminary Fact Assessment">
                    </div>
                    <div>
                        <label style="font-size: 12px; font-weight: 600;">Step Description:</label>
                        <textarea name="zca_steps[<?php echo $index; ?>][desc]" rows="2" style="width: 100%; margin-top: 3px;" placeholder="Details of this stage..."><?php echo esc_textarea($step['desc']); ?></textarea>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <button type="button" class="button button-primary button-large" id="zca-add-new-step-btn" style="background: #091528; border-color: #c59b4e; color: #c59b4e; font-weight: 600;">
            ➕ Add Another Step (নতুন ধাপ যুক্ত করুন)
        </button>
    </div>

    <hr style="margin: 15px 0;">
    <label><strong>Required Documents Checklist (One per line):</strong></label><br>
    <textarea name="zca_practice_checklist" rows="4" style="width: 100%;" placeholder="Enter required client documents, one per line..."><?php echo esc_textarea($checklist ? $checklist : "National ID / Passport copy of directors\nRegistered commercial office address proof\nTrade License & e-TIN certificates\nRelevant contract drafts or bank return memo"); ?></textarea>

    <!-- Repeater Client-side Script -->
    <script>
    function zcaReindexSteps() {
        jQuery('#zca-steps-repeater-wrapper .zca-step-item').each(function(idx) {
            jQuery(this).find('.step-index-display').text(idx + 1);
            jQuery(this).find('input[name*="[title]"]').attr('name', 'zca_steps[' + idx + '][title]');
            jQuery(this).find('textarea[name*="[desc]"]').attr('name', 'zca_steps[' + idx + '][desc]');
        });
    }

    function zcaRemoveStep(btn) {
        if (jQuery('#zca-steps-repeater-wrapper .zca-step-item').length <= 1) {
            alert('At least one step is required.');
            return;
        }
        if (confirm('Are you sure you want to remove this step?')) {
            jQuery(btn).closest('.zca-step-item').slideUp(200, function() {
                jQuery(this).remove();
                zcaReindexSteps();
            });
        }
    }

    jQuery(document).ready(function($) {
        $('#zca-add-new-step-btn').on('click', function(e) {
            e.preventDefault();
            var count = $('#zca-steps-repeater-wrapper .zca-step-item').length;
            var newIndex = count;
            var html = '<div class="zca-step-item" style="background: #f8fafc; border: 1px solid #cbd5e1; border-radius: 6px; padding: 15px; margin-bottom: 12px; position: relative;">' +
                '<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">' +
                    '<strong style="color: #091528; font-size: 13px;">' +
                        '<span class="step-num-badge" style="background: #091528; color: #c59b4e; padding: 2px 8px; border-radius: 3px; font-size: 11px;">Step <span class="step-index-display">' + (newIndex + 1) + '</span></span>' +
                    '</strong>' +
                    '<button type="button" class="button button-small zca-remove-step-btn" style="color: #ef4444; border-color: #fca5a5;" onclick="zcaRemoveStep(this)">❌ Remove Step</button>' +
                '</div>' +
                '<div style="margin-bottom: 8px;">' +
                    '<label style="font-size: 12px; font-weight: 600;">Step Title:</label>' +
                    '<input type="text" name="zca_steps[' + newIndex + '][title]" value="" style="width: 100%; margin-top: 3px;" placeholder="e.g. Legal Hearing & Advocacy">' +
                '</div>' +
                '<div>' +
                    '<label style="font-size: 12px; font-weight: 600;">Step Description:</label>' +
                    '<textarea name="zca_steps[' + newIndex + '][desc]" rows="2" style="width: 100%; margin-top: 3px;" placeholder="Details of this stage..."></textarea>' +
                '</div>' +
            '</div>';

            $('#zca-steps-repeater-wrapper').append(html);
            zcaReindexSteps();
        });
    });
    </script>
    <?php
}

// Render Team Member Meta Box
function zca_legal_render_team_meta_box($post) {
    wp_nonce_field('zca_team_meta_nonce', 'zca_team_nonce');
    $designation = get_post_meta($post->ID, '_zca_team_designation', true);
    $degree = get_post_meta($post->ID, '_zca_team_degree', true);
    $bar = get_post_meta($post->ID, '_zca_team_bar', true);
    $phone = get_post_meta($post->ID, '_zca_team_phone', true);
    $email = get_post_meta($post->ID, '_zca_team_email', true);
    $chamber = get_post_meta($post->ID, '_zca_team_chamber', true);
    ?>
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
        <div>
            <label><strong>Designation:</strong></label><br>
            <input type="text" name="zca_team_designation" value="<?php echo esc_attr($designation); ?>" style="width: 100%;" placeholder="e.g. Head of Chamber / Senior Associate">
        </div>
        <div>
            <label><strong>Academic Degree:</strong></label><br>
            <input type="text" name="zca_team_degree" value="<?php echo esc_attr($degree); ?>" style="width: 100%;" placeholder="e.g. LL.B. (Hons.), LL.M.">
        </div>
        <div>
            <label><strong>Bar Enrollment / Court:</strong></label><br>
            <input type="text" name="zca_team_bar" value="<?php echo esc_attr($bar); ?>" style="width: 100%;" placeholder="e.g. Supreme Court Bar Association">
        </div>
        <div>
            <label><strong>Chamber Branch:</strong></label><br>
            <input type="text" name="zca_team_chamber" value="<?php echo esc_attr($chamber ? $chamber : 'Mirpur DOHS Corporate Chamber'); ?>" style="width: 100%;">
        </div>
        <div>
            <label><strong>Phone / Hotline:</strong></label><br>
            <input type="text" name="zca_team_phone" value="<?php echo esc_attr($phone); ?>" style="width: 100%;">
        </div>
        <div>
            <label><strong>Email:</strong></label><br>
            <input type="email" name="zca_team_email" value="<?php echo esc_attr($email); ?>" style="width: 100%;">
        </div>
    </div>
    <?php
}

// Render Gallery Meta Box
function zca_legal_render_gallery_meta_box($post) {
    wp_nonce_field('zca_gallery_meta_nonce', 'zca_gallery_nonce');
    $award_year = get_post_meta($post->ID, '_zca_award_year', true);
    $issuer = get_post_meta($post->ID, '_zca_award_issuer', true);
    ?>
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
        <div>
            <label><strong>Year / Category Badge:</strong></label><br>
            <input type="text" name="zca_award_year" value="<?php echo esc_attr($award_year ? $award_year : '2026'); ?>" style="width: 100%;" placeholder="e.g. 2025 / Star Excellence">
        </div>
        <div>
            <label><strong>Issuing Authority / Event:</strong></label><br>
            <input type="text" name="zca_award_issuer" value="<?php echo esc_attr($issuer); ?>" style="width: 100%;" placeholder="e.g. DCCI / Star Awards / Global Summit">
        </div>
    </div>
    <?php
}

// Render Booking Meta Box
function zca_legal_render_booking_meta_box($post) {
    $service = get_post_meta($post->ID, '_zca_booking_service', true);
    $date = get_post_meta($post->ID, '_zca_booking_date', true);
    $phone = get_post_meta($post->ID, '_zca_booking_phone', true);
    $email = get_post_meta($post->ID, '_zca_booking_email', true);
    $notes = get_post_meta($post->ID, '_zca_booking_notes', true);
    $status = get_post_meta($post->ID, '_zca_booking_status', true);
    ?>
    <table class="form-table">
        <tr>
            <th>Client Name:</th>
            <td><strong><?php echo esc_html($post->post_title); ?></strong></td>
        </tr>
        <tr>
            <th>Phone:</th>
            <td><a href="tel:<?php echo esc_attr($phone); ?>"><?php echo esc_html($phone); ?></a></td>
        </tr>
        <tr>
            <th>Email:</th>
            <td><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></td>
        </tr>
        <tr>
            <th>Requested Service:</th>
            <td><?php echo esc_html($service); ?></td>
        </tr>
        <tr>
            <th>Preferred Date:</th>
            <td><?php echo esc_html($date); ?></td>
        </tr>
        <tr>
            <th>Case Overview:</th>
            <td><p style="background: #f8fafc; padding: 10px; border-radius: 4px;"><?php echo nl2br(esc_html($notes)); ?></p></td>
        </tr>
        <tr>
            <th>Status:</th>
            <td>
                <select name="zca_booking_status">
                    <option value="pending" <?php selected($status, 'pending'); ?>>⏳ Pending</option>
                    <option value="confirmed" <?php selected($status, 'confirmed'); ?>>✅ Confirmed</option>
                    <option value="completed" <?php selected($status, 'completed'); ?>>🏆 Completed</option>
                    <option value="cancelled" <?php selected($status, 'cancelled'); ?>>❌ Cancelled</option>
                </select>
            </td>
        </tr>
    </table>
    <?php
}

// Save Meta Box Data
function zca_legal_save_meta_boxes($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    // 1. Practice Area Save
    if (isset($_POST['zca_practice_nonce']) && wp_verify_nonce($_POST['zca_practice_nonce'], 'zca_practice_meta_nonce')) {
        if (isset($_POST['zca_practice_icon'])) {
            update_post_meta($post_id, '_zca_practice_icon', sanitize_text_field($_POST['zca_practice_icon']));
        }
        if (isset($_POST['zca_practice_badge'])) {
            update_post_meta($post_id, '_zca_practice_badge', sanitize_text_field($_POST['zca_practice_badge']));
        }
        if (isset($_POST['zca_practice_checklist'])) {
            update_post_meta($post_id, '_zca_practice_checklist', sanitize_textarea_field($_POST['zca_practice_checklist']));
        }

        // Save Dynamic Steps Repeater
        if (isset($_POST['zca_steps']) && is_array($_POST['zca_steps'])) {
            $clean_steps = array();
            foreach ($_POST['zca_steps'] as $st) {
                if (!empty($st['title']) || !empty($st['desc'])) {
                    $clean_steps[] = array(
                        'title' => sanitize_text_field($st['title']),
                        'desc'  => sanitize_textarea_field($st['desc'])
                    );
                }
            }
            update_post_meta($post_id, '_zca_practice_steps', $clean_steps);

            // Legacy backward-compatibility
            for ($i = 1; $i <= 4; $i++) {
                if (isset($clean_steps[$i - 1])) {
                    update_post_meta($post_id, "_zca_step{$i}_title", $clean_steps[$i - 1]['title']);
                    update_post_meta($post_id, "_zca_step{$i}_desc", $clean_steps[$i - 1]['desc']);
                }
            }
        }
    }

    // 2. Team Member Save
    if (isset($_POST['zca_team_nonce']) && wp_verify_nonce($_POST['zca_team_nonce'], 'zca_team_meta_nonce')) {
        $fields = array('zca_team_designation', 'zca_team_degree', 'zca_team_bar', 'zca_team_chamber', 'zca_team_phone', 'zca_team_email');
        foreach ($fields as $f) {
            if (isset($_POST[$f])) {
                update_post_meta($post_id, '_' . $f, sanitize_text_field($_POST[$f]));
            }
        }
    }

    // 3. Gallery Save
    if (isset($_POST['zca_gallery_nonce']) && wp_verify_nonce($_POST['zca_gallery_nonce'], 'zca_gallery_meta_nonce')) {
        if (isset($_POST['zca_award_year'])) {
            update_post_meta($post_id, '_zca_award_year', sanitize_text_field($_POST['zca_award_year']));
        }
        if (isset($_POST['zca_award_issuer'])) {
            update_post_meta($post_id, '_zca_award_issuer', sanitize_text_field($_POST['zca_award_issuer']));
        }
    }

    // 4. Booking Status Save
    if (isset($_POST['zca_booking_status'])) {
        update_post_meta($post_id, '_zca_booking_status', sanitize_text_field($_POST['zca_booking_status']));
    }
}
add_action('save_post', 'zca_legal_save_meta_boxes');
