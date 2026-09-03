<?php
/**
 * Theme Settings / Options Panel for ZCA Legal
 *
 * @package ZCA_Legal
 */

if (!defined('ABSPATH')) {
    exit;
}

// Register Settings Page under custom main menu
function zca_legal_register_theme_settings_menu() {
    add_menu_page(
        __('ZCA LEGAL Hub', 'zca-legal'),
        __('ZCA LEGAL', 'zca-legal'),
        'manage_options',
        'zca-legal-hub',
        'zca_legal_render_admin_dashboard',
        'dashicons-shield',
        3
    );

    add_submenu_page(
        'zca-legal-hub',
        __('Theme Settings', 'zca-legal'),
        __('Theme Settings', 'zca-legal'),
        'manage_options',
        'zca-theme-settings',
        'zca_legal_render_theme_settings_page'
    );
}
add_action('admin_menu', 'zca_legal_register_theme_settings_menu');

// Register Settings
function zca_legal_register_settings() {
    register_setting('zca_theme_options_group', 'zca_theme_options');
}
add_action('admin_init', 'zca_legal_register_settings');

// Helper to get option
function zca_get_option($key, $default = '') {
    $options = get_option('zca_theme_options');
    return isset($options[$key]) && $options[$key] !== '' ? $options[$key] : $default;
}

// Enqueue Media Uploader for Theme Settings
function zca_legal_admin_scripts($hook) {
    if (strpos($hook, 'zca-theme-settings') !== false) {
        wp_enqueue_media();
    }
}
add_action('admin_enqueue_scripts', 'zca_legal_admin_scripts');

// Render Theme Settings Page
function zca_legal_render_theme_settings_page() {
    $options = get_option('zca_theme_options');
    ?>
    <div class="wrap">
        <h1><span class="dashicons dashicons-admin-settings" style="font-size: 32px; width: 32px; height: 32px;"></span> <?php _e('ZCA LEGAL — Theme Settings & Chamber Controls', 'zca-legal'); ?></h1>
        <p style="color: #666;"><?php _e('Control website logos, chamber locations, hotlines, WhatsApp numbers, emails, payment gateway details, hero portrait, and website metrics from this single dashboard.', 'zca-legal'); ?></p>

        <?php if (isset($_GET['settings-updated']) && $_GET['settings-updated']) : ?>
            <div class="notice notice-success is-dismissible"><p><strong><?php _e('Theme settings successfully updated!', 'zca-legal'); ?></strong></p></div>
        <?php endif; ?>

        <form method="post" action="options.php">
            <?php
            settings_fields('zca_theme_options_group');
            ?>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 20px;">
                
                <!-- 1. Custom Logo & Branding -->
                <div class="postbox" style="padding: 20px; grid-column: 1 / -1;">
                    <h2 class="hndle"><span>🎨 <?php _e('Website Brand Logo Settings (কাস্টম লোগো)', 'zca-legal'); ?></span></h2>
                    <table class="form-table">
                        <tr>
                            <th><label><?php _e('Custom Logo Image URL:', 'zca-legal'); ?></label></th>
                            <td>
                                <div style="display: flex; gap: 10px; align-items: center; max-width: 650px;">
                                    <input type="text" id="zca_custom_logo_url" name="zca_theme_options[custom_logo_url]" value="<?php echo esc_attr(zca_get_option('custom_logo_url', '')); ?>" class="large-text" placeholder="https://example.com/wp-content/uploads/logo.png">
                                    <button type="button" class="button button-secondary" id="zca_upload_logo_btn"><?php _e('Upload / Choose Image', 'zca-legal'); ?></button>
                                </div>
                                <small style="color: #64748b; display: block; margin-top: 6px;">
                                    <?php _e('Upload your custom PNG/SVG/JPG logo here. If left blank, the built-in golden Pillar icon and text logo will be displayed automatically.', 'zca-legal'); ?>
                                </small>
                                <?php if (zca_get_option('custom_logo_url')) : ?>
                                    <div style="margin-top: 10px; padding: 10px; background: #091528; display: inline-block; border-radius: 4px;">
                                        <img src="<?php echo esc_url(zca_get_option('custom_logo_url')); ?>" style="max-height: 50px; display: block;">
                                    </div>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- 2. Global Hotline & WhatsApp -->
                <div class="postbox" style="padding: 20px;">
                    <h2 class="hndle"><span>📞 <?php _e('Global Direct Contact Lines & Hero', 'zca-legal'); ?></span></h2>
                    <table class="form-table">
                        <tr>
                            <th><label><?php _e('Direct Hotline Phone:', 'zca-legal'); ?></label></th>
                            <td><input type="text" name="zca_theme_options[hotline]" value="<?php echo esc_attr(zca_get_option('hotline', '09617400600')); ?>" class="regular-text"></td>
                        </tr>
                        <tr>
                            <th><label><?php _e('WhatsApp Chat Number:', 'zca-legal'); ?></label></th>
                            <td><input type="text" name="zca_theme_options[whatsapp]" value="<?php echo esc_attr(zca_get_option('whatsapp', '01713203275')); ?>" class="regular-text"></td>
                        </tr>
                        <tr>
                            <th><label><?php _e('Primary Email Address:', 'zca-legal'); ?></label></th>
                            <td><input type="email" name="zca_theme_options[email_primary]" value="<?php echo esc_attr(zca_get_option('email_primary', 'info@zcalegal.com')); ?>" class="regular-text"></td>
                        </tr>
                        <tr>
                            <th><label><?php _e('Secondary / Chamber Email:', 'zca-legal'); ?></label></th>
                            <td><input type="email" name="zca_theme_options[email_secondary]" value="<?php echo esc_attr(zca_get_option('email_secondary', 'zcalawfirm@gmail.com')); ?>" class="regular-text"></td>
                        </tr>
                        <tr>
                            <th><label><?php _e('DCCI Standing Committee Title:', 'zca-legal'); ?></label></th>
                            <td><input type="text" name="zca_theme_options[dcci_badge]" value="<?php echo esc_attr(zca_get_option('dcci_badge', 'DCCI Standing Committee Member')); ?>" class="regular-text"></td>
                        </tr>
                        <tr>
                            <th><label><?php _e('Hero Section Portrait Image URL:', 'zca-legal'); ?></label></th>
                            <td>
                                <input type="text" name="zca_theme_options[hero_image]" value="<?php echo esc_attr(zca_get_option('hero_image', '')); ?>" class="large-text" placeholder="Leave empty for default advocate portrait">
                                <small style="color: #666;">Default: Adv. Md. Zahid Chowdhury chamber portrait</small>
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- 3. Chamber 1 (Mirpur DOHS Corporate) -->
                <div class="postbox" style="padding: 20px;">
                    <h2 class="hndle"><span>🏢 <?php _e('Chamber 1: Mirpur DOHS Corporate Chamber', 'zca-legal'); ?></span></h2>
                    <table class="form-table">
                        <tr>
                            <th><label><?php _e('Chamber Name:', 'zca-legal'); ?></label></th>
                            <td><input type="text" name="zca_theme_options[chamber1_title]" value="<?php echo esc_attr(zca_get_option('chamber1_title', 'Mirpur DOHS Corporate Chamber')); ?>" class="regular-text"></td>
                        </tr>
                        <tr>
                            <th><label><?php _e('Full Address:', 'zca-legal'); ?></label></th>
                            <td><textarea name="zca_theme_options[chamber1_address]" rows="2" class="large-text"><?php echo esc_textarea(zca_get_option('chamber1_address', 'Flat C2, House 1188, Avenue 11, Mirpur DOHS, Dhaka 1216, Bangladesh')); ?></textarea></td>
                        </tr>
                        <tr>
                            <th><label><?php _e('Phone Numbers:', 'zca-legal'); ?></label></th>
                            <td><input type="text" name="zca_theme_options[chamber1_phone]" value="<?php echo esc_attr(zca_get_option('chamber1_phone', '+88 09617 400 600, +88 01713 203 275')); ?>" class="regular-text"></td>
                        </tr>
                        <tr>
                            <th><label><?php _e('Google Maps URL:', 'zca-legal'); ?></label></th>
                            <td><input type="url" name="zca_theme_options[chamber1_map]" value="<?php echo esc_attr(zca_get_option('chamber1_map', 'https://maps.app.goo.gl/dkDADYmnUXVFAVf58')); ?>" class="large-text"></td>
                        </tr>
                    </table>
                </div>

                <!-- 4. Chamber 2 (Supreme Court) -->
                <div class="postbox" style="padding: 20px;">
                    <h2 class="hndle"><span>🏛️ <?php _e('Chamber 2: Supreme Court Bar Chamber', 'zca-legal'); ?></span></h2>
                    <table class="form-table">
                        <tr>
                            <th><label><?php _e('Chamber Name:', 'zca-legal'); ?></label></th>
                            <td><input type="text" name="zca_theme_options[chamber2_title]" value="<?php echo esc_attr(zca_get_option('chamber2_title', 'Supreme Court Bar Chamber')); ?>" class="regular-text"></td>
                        </tr>
                        <tr>
                            <th><label><?php _e('Full Address:', 'zca-legal'); ?></label></th>
                            <td><textarea name="zca_theme_options[chamber2_address]" rows="2" class="large-text"><?php echo esc_textarea(zca_get_option('chamber2_address', 'Room 1010 (Annex Building), Supreme Court Bar Association, Dhaka 1000')); ?></textarea></td>
                        </tr>
                        <tr>
                            <th><label><?php _e('Phone Numbers:', 'zca-legal'); ?></label></th>
                            <td><input type="text" name="zca_theme_options[chamber2_phone]" value="<?php echo esc_attr(zca_get_option('chamber2_phone', '+88 01873 414 400, +88 01713 203 275')); ?>" class="regular-text"></td>
                        </tr>
                        <tr>
                            <th><label><?php _e('Google Maps URL:', 'zca-legal'); ?></label></th>
                            <td><input type="url" name="zca_theme_options[chamber2_map]" value="<?php echo esc_attr(zca_get_option('chamber2_map', 'https://maps.app.goo.gl/SKXRkX7U6PBtUoTJ9')); ?>" class="large-text"></td>
                        </tr>
                    </table>
                </div>

                <!-- 5. Chamber 3 (Judge Court Kotwali) -->
                <div class="postbox" style="padding: 20px;">
                    <h2 class="hndle"><span>⚖️ <?php _e('Chamber 3: Dhaka Judge Court Chamber', 'zca-legal'); ?></span></h2>
                    <table class="form-table">
                        <tr>
                            <th><label><?php _e('Chamber Name:', 'zca-legal'); ?></label></th>
                            <td><input type="text" name="zca_theme_options[chamber3_title]" value="<?php echo esc_attr(zca_get_option('chamber3_title', 'Dhaka Judge Court Chamber')); ?>" class="regular-text"></td>
                        </tr>
                        <tr>
                            <th><label><?php _e('Full Address:', 'zca-legal'); ?></label></th>
                            <td><textarea name="zca_theme_options[chamber3_address]" rows="2" class="large-text"><?php echo esc_textarea(zca_get_option('chamber3_address', 'Room No. B 36, Parjoar Center, 22 Court House Street, Kotwali, Dhaka 1000')); ?></textarea></td>
                        </tr>
                        <tr>
                            <th><label><?php _e('Phone Numbers:', 'zca-legal'); ?></label></th>
                            <td><input type="text" name="zca_theme_options[chamber3_phone]" value="<?php echo esc_attr(zca_get_option('chamber3_phone', '+88 09617 400 600, +88 01713 203 275')); ?>" class="regular-text"></td>
                        </tr>
                        <tr>
                            <th><label><?php _e('Google Maps URL:', 'zca-legal'); ?></label></th>
                            <td><input type="url" name="zca_theme_options[chamber3_map]" value="<?php echo esc_attr(zca_get_option('chamber3_map', 'https://maps.app.goo.gl/3GZLAVuaotGBPrqg9')); ?>" class="large-text"></td>
                        </tr>
                    </table>
                </div>

                <!-- 6. Online Payment Gateway Accounts & Visibility Switches -->
                <div class="postbox" style="padding: 20px;">
                    <h2 class="hndle"><span>💳 <?php _e('Online Payment Gateway Accounts & Visibility Toggles', 'zca-legal'); ?></span></h2>
                    <p class="description" style="margin-bottom: 15px;">
                        <?php _e('Use the switches below to easily show or hide specific payment options in the client fee payment modal.', 'zca-legal'); ?>
                    </p>
                    
                    <style>
                    .zca-switch {
                        position: relative;
                        display: inline-block;
                        width: 46px;
                        height: 24px;
                        vertical-align: middle;
                    }
                    .zca-switch input {
                        opacity: 0;
                        width: 0;
                        height: 0;
                    }
                    .zca-slider {
                        position: absolute;
                        cursor: pointer;
                        top: 0; left: 0; right: 0; bottom: 0;
                        background-color: #cbd5e1;
                        transition: .3s;
                        border-radius: 24px;
                    }
                    .zca-slider:before {
                        position: absolute;
                        content: "";
                        height: 18px;
                        width: 18px;
                        left: 3px;
                        bottom: 3px;
                        background-color: white;
                        transition: .3s;
                        border-radius: 50%;
                    }
                    .zca-switch input:checked + .zca-slider {
                        background-color: #10b981;
                    }
                    .zca-switch input:checked + .zca-slider:before {
                        transform: translateX(22px);
                    }
                    .zca-gateway-row {
                        background: #f8fafc;
                        border: 1px solid #e2e8f0;
                        border-radius: 8px;
                        padding: 12px 16px;
                        margin-bottom: 12px;
                    }
                    </style>

                    <table class="form-table">
                        <!-- 1. bKash -->
                        <tr>
                            <th><label><?php _e('bKash Account Settings:', 'zca-legal'); ?></label></th>
                            <td>
                                <div class="zca-gateway-row">
                                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 10px;">
                                        <input type="hidden" name="zca_theme_options[enable_bkash]" value="0">
                                        <label class="zca-switch">
                                            <input type="checkbox" name="zca_theme_options[enable_bkash]" value="1" <?php checked(zca_get_option('enable_bkash', '1'), '1'); ?>>
                                            <span class="zca-slider"></span>
                                        </label>
                                        <strong style="font-size: 0.95rem; color: #0f172a;"><?php _e('Show / Enable bKash in Payment Modal', 'zca-legal'); ?></strong>
                                    </div>
                                    <input type="text" name="zca_theme_options[bkash_no]" value="<?php echo esc_attr(zca_get_option('bkash_no', '01713 203 275')); ?>" class="regular-text" placeholder="bKash Phone Number">
                                </div>
                            </td>
                        </tr>

                        <!-- 2. Nagad -->
                        <tr>
                            <th><label><?php _e('Nagad Account Settings:', 'zca-legal'); ?></label></th>
                            <td>
                                <div class="zca-gateway-row">
                                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 10px;">
                                        <input type="hidden" name="zca_theme_options[enable_nagad]" value="0">
                                        <label class="zca-switch">
                                            <input type="checkbox" name="zca_theme_options[enable_nagad]" value="1" <?php checked(zca_get_option('enable_nagad', '1'), '1'); ?>>
                                            <span class="zca-slider"></span>
                                        </label>
                                        <strong style="font-size: 0.95rem; color: #0f172a;"><?php _e('Show / Enable Nagad in Payment Modal', 'zca-legal'); ?></strong>
                                    </div>
                                    <input type="text" name="zca_theme_options[nagad_no]" value="<?php echo esc_attr(zca_get_option('nagad_no', '01713 203 275')); ?>" class="regular-text" placeholder="Nagad Phone Number">
                                </div>
                            </td>
                        </tr>

                        <!-- 3. Rocket -->
                        <tr>
                            <th><label><?php _e('Rocket Account Settings:', 'zca-legal'); ?></label></th>
                            <td>
                                <div class="zca-gateway-row">
                                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 10px;">
                                        <input type="hidden" name="zca_theme_options[enable_rocket]" value="0">
                                        <label class="zca-switch">
                                            <input type="checkbox" name="zca_theme_options[enable_rocket]" value="1" <?php checked(zca_get_option('enable_rocket', '1'), '1'); ?>>
                                            <span class="zca-slider"></span>
                                        </label>
                                        <strong style="font-size: 0.95rem; color: #0f172a;"><?php _e('Show / Enable Rocket in Payment Modal', 'zca-legal'); ?></strong>
                                    </div>
                                    <input type="text" name="zca_theme_options[rocket_no]" value="<?php echo esc_attr(zca_get_option('rocket_no', '01713 203 275-8')); ?>" class="regular-text" placeholder="Rocket Account Number">
                                </div>
                            </td>
                        </tr>

                        <!-- 4. Bank Transfer -->
                        <tr>
                            <th><label><?php _e('Bank Account Settings:', 'zca-legal'); ?></label></th>
                            <td>
                                <div class="zca-gateway-row">
                                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 10px;">
                                        <input type="hidden" name="zca_theme_options[enable_bank]" value="0">
                                        <label class="zca-switch">
                                            <input type="checkbox" name="zca_theme_options[enable_bank]" value="1" <?php checked(zca_get_option('enable_bank', '1'), '1'); ?>>
                                            <span class="zca-slider"></span>
                                        </label>
                                        <strong style="font-size: 0.95rem; color: #0f172a;"><?php _e('Show / Enable Bank Transfer in Payment Modal', 'zca-legal'); ?></strong>
                                    </div>
                                    <textarea name="zca_theme_options[bank_details]" rows="3" class="large-text"><?php echo esc_textarea(zca_get_option('bank_details', 'Bank: Premier Bank Ltd / Sonali Bank | A/C Name: ZCA LEGAL | A/C No: 018810000XXXX | Branch: Mirpur DOHS')); ?></textarea>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- 7. Trust Statistics & Metrics -->
                <div class="postbox" style="padding: 20px;">
                    <h2 class="hndle"><span>📊 <?php _e('Homepage Trust Metrics', 'zca-legal'); ?></span></h2>
                    <table class="form-table">
                        <tr>
                            <th><label><?php _e('Experience Stat:', 'zca-legal'); ?></label></th>
                            <td><input type="text" name="zca_theme_options[stat_exp]" value="<?php echo esc_attr(zca_get_option('stat_exp', '15+ Years')); ?>" class="regular-text"></td>
                        </tr>
                        <tr>
                            <th><label><?php _e('Corporate Clients Stat:', 'zca-legal'); ?></label></th>
                            <td><input type="text" name="zca_theme_options[stat_clients]" value="<?php echo esc_attr(zca_get_option('stat_clients', '50+ Corporate')); ?>" class="regular-text"></td>
                        </tr>
                        <tr>
                            <th><label><?php _e('Cases Resolved Stat:', 'zca-legal'); ?></label></th>
                            <td><input type="text" name="zca_theme_options[stat_cases]" value="<?php echo esc_attr(zca_get_option('stat_cases', '3,500+ Cases')); ?>" class="regular-text"></td>
                        </tr>
                    </table>
                </div>

            </div>

            <p class="submit">
                <input type="submit" name="submit" id="submit" class="button button-primary button-large" value="<?php _e('Save All Settings', 'zca-legal'); ?>">
            </p>
        </form>
    </div>

    <script>
    jQuery(document).ready(function($){
        $('#zca_upload_logo_btn').click(function(e) {
            e.preventDefault();
            var imageUploader = wp.media({
                title: 'Select or Upload Brand Logo',
                button: { text: 'Use this Logo' },
                multiple: false
            }).on('select', function() {
                var attachment = imageUploader.state().get('selection').first().toJSON();
                $('#zca_custom_logo_url').val(attachment.url);
            }).open();
        });
    });
    </script>
    <?php
}
