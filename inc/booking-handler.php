<?php
/**
 * Consultation Booking & Inquiry AJAX Handler with Automated Email Notifications
 *
 * @package ZCA_Legal
 */

if (!defined('ABSPATH')) {
    exit;
}

// 1. Handle Consultation Booking AJAX
function zca_legal_ajax_handle_booking() {
    check_ajax_referer('zca_booking_nonce_action', 'security');

    $name           = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
    $company        = isset($_POST['company']) ? sanitize_text_field($_POST['company']) : '';
    $phone          = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';
    $email          = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $chamber        = isset($_POST['chamber']) ? sanitize_text_field($_POST['chamber']) : 'Mirpur DOHS Corporate Chamber';
    $practice       = isset($_POST['practice']) ? sanitize_text_field($_POST['practice']) : 'Corporate Legal Consultation';
    $preferred_date = isset($_POST['preferred_date']) ? sanitize_text_field($_POST['preferred_date']) : date('Y-m-d');
    $preferred_time = isset($_POST['preferred_time']) ? sanitize_text_field($_POST['preferred_time']) : 'Morning';
    $notes          = isset($_POST['notes']) ? sanitize_textarea_field($_POST['notes']) : '';

    if (empty($name) || empty($phone)) {
        wp_send_json_error(array('message' => __('Please provide your full name and phone number.', 'zca-legal')));
    }

    // Create Booking Record in CPT
    $post_title = sprintf('Booking: %s (%s) - %s', $name, $phone, $preferred_date);
    $booking_id = wp_insert_post(array(
        'post_title'   => $post_title,
        'post_type'    => 'zca_booking',
        'post_status'  => 'publish',
    ));

    if (is_wp_error($booking_id)) {
        wp_send_json_error(array('message' => __('Error saving appointment. Please call chamber directly.', 'zca-legal')));
    }

    // Save Meta Fields
    update_post_meta($booking_id, '_zca_client_name', $name);
    update_post_meta($booking_id, '_zca_company', $company);
    update_post_meta($booking_id, '_zca_phone', $phone);
    update_post_meta($booking_id, '_zca_email', $email);
    update_post_meta($booking_id, '_zca_chamber', $chamber);
    update_post_meta($booking_id, '_zca_practice', $practice);
    update_post_meta($booking_id, '_zca_preferred_date', $preferred_date);
    update_post_meta($booking_id, '_zca_preferred_time', $preferred_time);
    update_post_meta($booking_id, '_zca_notes', $notes);
    update_post_meta($booking_id, '_zca_booking_status', 'pending');

    // Send Automated HTML Thank You / Confirmation Email to User
    if (!empty($email) && is_email($email)) {
        $user_subject = __('Consultation Request Received - ZCA LEGAL', 'zca-legal');
        
        $headers = array(
            'Content-Type: text/html; charset=UTF-8',
            'From: ZCA LEGAL <info@zcalegal.com>'
        );

        $user_body = '
        <!DOCTYPE html>
        <html>
        <head>
          <style>
            body { font-family: "Helvetica Neue", Arial, sans-serif; background-color: #f4f6f9; color: #2d3748; margin: 0; padding: 20px; }
            .email-container { max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 8px; border: 1px solid #e2e8f0; overflow: hidden; }
            .email-header { background: #091528; padding: 25px; text-align: center; border-bottom: 3px solid #c59b4e; }
            .email-header h1 { color: #ffffff; margin: 0; font-size: 24px; letter-spacing: 2px; }
            .email-header h1 span { color: #c59b4e; }
            .email-body { padding: 30px; line-height: 1.6; }
            .booking-summary { background: #f8fafc; border-left: 4px solid #c59b4e; padding: 15px; margin: 20px 0; border-radius: 4px; }
            .email-footer { background: #040911; color: #94a3b8; padding: 20px; text-align: center; font-size: 12px; }
          </style>
        </head>
        <body>
          <div class="email-container">
            <div class="email-header">
              <h1>ZCA <span>LEGAL</span></h1>
              <div style="color: #c59b4e; font-size: 11px; letter-spacing: 3px; margin-top: 5px;">LAW | STRATEGY | SUCCESS</div>
            </div>
            <div class="email-body">
              <h2 style="color: #091528; font-size: 20px; margin-top: 0;">Thank You, ' . esc_html($name) . '!</h2>
              <p>We have successfully received your legal consultation request. Our chamber desk and associate advocates are reviewing your matter and will confirm your schedule shortly.</p>
              
              <div class="booking-summary">
                <p style="margin: 0 0 8px 0;"><strong>Chamber Location:</strong> ' . esc_html($chamber) . '</p>
                <p style="margin: 0 0 8px 0;"><strong>Practice Matter:</strong> ' . esc_html($practice) . '</p>
                <p style="margin: 0 0 8px 0;"><strong>Preferred Date:</strong> ' . esc_html($preferred_date) . ' (' . esc_html($preferred_time) . ')</p>
                <p style="margin: 0;"><strong>Contact Phone:</strong> ' . esc_html($phone) . '</p>
              </div>

              <p>For any urgent matter or immediate document sharing, feel free to contact our direct chamber hotline or connect on WhatsApp:</p>
              <p>
                📞 <strong>Chamber Hotline:</strong> <a href="tel:+8809617400600" style="color: #c59b4e; text-decoration: none;">+88 09617 400 600</a><br>
                💬 <strong>Direct WhatsApp:</strong> <a href="https://wa.me/8801713203275" style="color: #25D366; text-decoration: none;">+88 01713 203 275</a>
              </p>
              <p style="margin-top: 25px; font-size: 13px; color: #64748b;">
                Sincerely,<br>
                <strong>Advocate Md. Zahid Chowdhury & Team</strong><br>
                ZCA LEGAL (Zahid Chowdhury & Associates)<br>
                Advocate, Supreme Court of Bangladesh
              </p>
            </div>
            <div class="email-footer">
              © ' . date('Y') . ' ZCA LEGAL. Corporate Chamber: Mirpur DOHS, Dhaka 1216, Bangladesh.
            </div>
          </div>
        </body>
        </html>
        ';

        @wp_mail($email, $user_subject, $user_body, $headers);
    }

    // Send Admin Notification Email
    $admin_email = zca_get_option('email_primary', get_option('admin_email'));
    $admin_subject = sprintf('[NEW BOOKING] %s requested consultation at %s', $name, $chamber);
    $admin_body = sprintf("New Legal Consultation Request:\n\nClient Name: %s\nCompany: %s\nPhone: %s\nEmail: %s\nChamber: %s\nPractice Area: %s\nPreferred Date: %s (%s)\nNotes: %s\n\nView in WP Admin: %s",
        $name, $company, $phone, $email, $chamber, $practice, $preferred_date, $preferred_time, $notes,
        admin_url('admin.php?page=zca-legal-hub')
    );
    @wp_mail($admin_email, $admin_subject, $admin_body);

    wp_send_json_success(array(
        'message' => sprintf(__('Thank you, %s! Your appointment request for [%s] on %s has been received. A confirmation email has been sent and our chamber will contact you shortly.', 'zca-legal'), $name, $chamber, $preferred_date)
    ));
}
add_action('wp_ajax_zca_submit_booking', 'zca_legal_ajax_handle_booking');
add_action('wp_ajax_nopriv_zca_submit_booking', 'zca_legal_ajax_handle_booking');

// 2. Handle Contact Inquiry Form AJAX
function zca_legal_ajax_handle_inquiry() {
    check_ajax_referer('zca_booking_nonce_action', 'security');

    $name    = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
    $company = isset($_POST['company']) ? sanitize_text_field($_POST['company']) : '';
    $phone   = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';
    $email   = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $subject = isset($_POST['subject']) ? sanitize_text_field($_POST['subject']) : 'General Legal Inquiry';
    $message = isset($_POST['message']) ? sanitize_textarea_field($_POST['message']) : '';

    if (empty($name) || empty($phone) || empty($message)) {
        wp_send_json_error(array('message' => __('Please fill out all required fields.', 'zca-legal')));
    }

    $inquiry_id = wp_insert_post(array(
        'post_title'   => sprintf('Inquiry: %s (%s) - %s', $name, $phone, $subject),
        'post_content' => $message,
        'post_type'    => 'zca_inquiry',
        'post_status'  => 'publish',
    ));

    update_post_meta($inquiry_id, '_zca_client_name', $name);
    update_post_meta($inquiry_id, '_zca_company', $company);
    update_post_meta($inquiry_id, '_zca_phone', $phone);
    update_post_meta($inquiry_id, '_zca_email', $email);
    update_post_meta($inquiry_id, '_zca_subject', $subject);

    // Send Admin Notification
    $admin_email = zca_get_option('email_primary', get_option('admin_email'));
    @wp_mail($admin_email, "[CONTACT INQUIRY] " . $subject . " from " . $name, "Name: $name\nPhone: $phone\nEmail: $email\nCompany: $company\nMessage:\n$message");

    // Send User Confirmation
    if (!empty($email) && is_email($email)) {
        @wp_mail($email, "Message Received - ZCA LEGAL", "Dear $name,\n\nThank you for reaching out to ZCA LEGAL. Our legal team has received your message regarding '$subject' and will respond within 2-4 hours.\n\nHotline: 09617400600\nWhatsApp: +8801713203275\n\nZCA LEGAL Chambers");
    }

    wp_send_json_success(array('message' => __('Thank you! Your message has been received by ZCA Legal. An advocate will contact you shortly.', 'zca-legal')));
}
add_action('wp_ajax_zca_submit_inquiry', 'zca_legal_ajax_handle_inquiry');
add_action('wp_ajax_nopriv_zca_submit_inquiry', 'zca_legal_ajax_handle_inquiry');
