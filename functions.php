<?php
/**
 * ZCA LEGAL - Theme Functions and Definitions
 *
 * @package ZCA_Legal
 */

if (!defined('ABSPATH')) {
    exit;
}

// Require DOCX Blog Importer
require_once get_template_directory() . '/inc/docx-blog-importer.php';

// 1. Theme Setup
function zca_legal_theme_setup() {

    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Title tag management
    add_theme_support('title-tag');

    // Enable post thumbnails
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(800, 500, true);
    add_image_size('zca-card-thumb', 600, 380, true);
    add_image_size('zca-team-thumb', 400, 480, true);
    add_image_size('zca-award-thumb', 500, 350, true);

    // Register Navigation Menus
    register_nav_menus(array(
        'primary' => __('Primary Navigation Menu', 'zca-legal'),
        'footer'  => __('Footer Navigation Menu', 'zca-legal'),
    ));

    // HTML5 markup support
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script'
    ));

    // Custom Logo
    add_theme_support('custom-logo', array(
        'height'      => 80,
        'width'       => 280,
        'flex-height' => true,
        'flex-width'  => true,
    ));
}
add_action('after_setup_theme', 'zca_legal_theme_setup');

// 2. Enqueue Styles and Scripts
function zca_legal_enqueue_assets() {
    // Google Fonts: Cinzel, Outfit, Plus Jakarta Sans
    wp_enqueue_style(
        'zca-google-fonts',
        'https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700;800&family=Outfit:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap',
        array(),
        null
    );

    // FontAwesome Icons
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css',
        array(),
        '6.5.1'
    );

    // Master Theme Stylesheet
    wp_enqueue_style(
        'zca-style',
        get_template_directory_uri() . '/assets/css/style.css',
        array(),
        '1.2.0'
    );

    // Responsive Breakpoints
    wp_enqueue_style(
        'zca-responsive',
        get_template_directory_uri() . '/assets/css/responsive.css',
        array('zca-style'),
        '1.2.0'
    );

    // Main Theme JavaScript Engine
    wp_enqueue_script(
        'zca-main-js',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        '1.2.0',
        true
    );

    // AJAX Booking Handler Script
    wp_enqueue_script(
        'zca-ajax-booking',
        get_template_directory_uri() . '/assets/js/ajax-booking.js',
        array('zca-main-js'),
        '1.2.0',
        true
    );

    // Localize script with AJAX URL & Nonce
    wp_localize_script('zca-ajax-booking', 'zca_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('zca_booking_nonce_action')
    ));
}
add_action('wp_enqueue_scripts', 'zca_legal_enqueue_assets');

// 3. Include Theme Modules & Backend Features
require_once get_template_directory() . '/inc/custom-post-types.php';
require_once get_template_directory() . '/inc/taxonomies.php';
require_once get_template_directory() . '/inc/meta-boxes.php';
require_once get_template_directory() . '/inc/theme-options.php';
require_once get_template_directory() . '/inc/booking-handler.php';
require_once get_template_directory() . '/inc/admin-dashboard.php';
require_once get_template_directory() . '/inc/demo-importer.php';

// Helper for Mobile Drawer Actions
function zca_legal_get_mobile_drawer_actions_html() {
    $hotline = zca_get_option('hotline', '09617400600');
    $whatsapp = zca_get_option('whatsapp', '01713203275');
    ob_start();
    ?>
    <li class="mobile-drawer-cta-wrapper">
        <div class="mobile-drawer-divider"></div>
        <div class="mobile-drawer-actions">
            <div style="margin-bottom: 10px; width: 100%; display: flex; justify-content: center;">
                <?php echo zca_legal_render_language_switcher('mobile'); ?>
            </div>
            <button class="btn btn-primary btn-sm" onclick="openModal('consultationModal')" style="width: 100%; justify-content: center; margin-bottom: 8px;">
                <i class="fa-regular fa-calendar-check"></i> Book Consultation
            </button>
                <i class="fa-regular fa-calendar-check"></i> Book Consultation
            </button>
            <button class="btn btn-outline-gold btn-sm" onclick="openModal('paymentModal')" style="width: 100%; justify-content: center; margin-bottom: 12px;">
                <i class="fa-solid fa-credit-card"></i> Pay Online
            </button>
            <div class="mobile-drawer-contacts">
                <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $hotline)); ?>" class="mobile-drawer-contact-item">
                    <i class="fa-solid fa-phone" style="color: #c59b4e;"></i>
                    <span>Hotline: +88 <?php echo esc_html($hotline); ?></span>
                </a>
                <a href="https://wa.me/88<?php echo esc_attr(preg_replace('/[^0-9]/', '', $whatsapp)); ?>" target="_blank" class="mobile-drawer-contact-item">
                    <i class="fa-brands fa-whatsapp" style="color: #25D366;"></i>
                    <span>WhatsApp: +88 <?php echo esc_html($whatsapp); ?></span>
                </a>
            </div>
            <div class="mobile-drawer-chamber-info">
                <strong>Chamber:</strong> Mirpur DOHS & Supreme Court Bar, Dhaka
            </div>
        </div>
    </li>
    <?php
    return ob_get_clean();
}

// 4. Custom Helper: Nav Menu Fallback
function zca_legal_nav_fallback() {
    ?>
    <ul class="nav-menu">
        <li><a href="<?php echo esc_url(home_url('/')); ?>" class="nav-link <?php echo is_front_page() ? 'active' : ''; ?>">Home</a></li>
        <li><a href="<?php echo esc_url(home_url('/about-us/')); ?>" class="nav-link">About Us</a></li>
        <li><a href="<?php echo esc_url(home_url('/practice-areas/')); ?>" class="nav-link">Practice Areas</a></li>
        <li><a href="<?php echo esc_url(home_url('/our-team/')); ?>" class="nav-link">Our Team</a></li>
        <li><a href="<?php echo esc_url(home_url('/our-clients/')); ?>" class="nav-link">Our Clients</a></li>
        <li><a href="<?php echo esc_url(home_url('/monthly-retainer/')); ?>" class="nav-link">Monthly Retainer</a></li>
        <li><a href="<?php echo esc_url(home_url('/blog/')); ?>" class="nav-link">Blog</a></li>
        <li><a href="<?php echo esc_url(home_url('/gallery/')); ?>" class="nav-link">Gallery</a></li>
        <li><a href="<?php echo esc_url(home_url('/contact-us/')); ?>" class="nav-link">Contact Us</a></li>
        <?php echo zca_legal_get_mobile_drawer_actions_html(); ?>
    </ul>
    <?php
}

// Append mobile actions to WP Nav Menu
function zca_legal_append_mobile_menu_items($items, $args) {
    if (isset($args->theme_location) && $args->theme_location === 'primary') {
        $items .= zca_legal_get_mobile_drawer_actions_html();
    }
    return $items;
}
add_filter('wp_nav_menu_items', 'zca_legal_append_mobile_menu_items', 10, 2);

// 5. Custom Walker / Class for wp_nav_menu links
function zca_legal_nav_menu_link_attributes($atts, $item, $args) {
    $atts['class'] = isset($atts['class']) ? $atts['class'] . ' nav-link' : 'nav-link';
    if (in_array('current-menu-item', $item->classes) || in_array('current_page_item', $item->classes)) {
        $atts['class'] .= ' active';
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'zca_legal_nav_menu_link_attributes', 10, 3);

// 6. Ensure Real WordPress Categories & Taxonomies Exist
function zca_legal_ensure_default_taxonomies() {
    // 1. Ensure Blog Categories exist in WordPress
    $default_blog_cats = array(
        'Startup & Corporate'   => 'startup',
        'Trust & Estates'       => 'trust',
        'Cyber & AI Law'        => 'tech',
        'Labor & Employment'    => 'labor',
        'Intellectual Property' => 'ip',
        'Litigation & NI Act'   => 'litigation'
    );
    foreach ($default_blog_cats as $name => $slug) {
        if (!term_exists($slug, 'category')) {
            wp_insert_term($name, 'category', array('slug' => $slug));
        }
    }

    // 2. Ensure Practice Categories exist in taxonomy
    $default_practice_cats = array(
        'Corporate & Commercial'     => 'corporate',
        'Litigation & Court Appeals' => 'litigation',
        'Taxation & Finance'        => 'tax',
        'Real Estate & Property'    => 'property',
        'Advisory & Compliance'     => 'advisory'
    );
    foreach ($default_practice_cats as $name => $slug) {
        if (!term_exists($slug, 'practice_category')) {
            wp_insert_term($name, 'practice_category', array('slug' => $slug));
        }
    }
}
add_action('init', 'zca_legal_ensure_default_taxonomies', 20);

// 7. Custom High-Quality SVG Icons for Practice Areas
function zca_get_practice_svg_icon($name = '') {
    $slug = strtolower(trim($name));
    $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
    
    if (strpos($slug, 'civil') !== false) {
        return '<svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" class="help-svg-icon">
            <path d="M4 22L32 6L60 22V26H4V22Z" fill="currentColor"/>
            <path d="M10 26H16V48H10V26ZM22 26H28V48H22V26ZM36 26H42V48H36V26ZM48 26H54V48H48V26Z" fill="currentColor"/>
            <path d="M4 48H60V56H4V48Z" fill="currentColor"/>
        </svg>';
    }
    if (strpos($slug, 'criminal') !== false) {
        return '<svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" class="help-svg-icon">
            <path d="M32 4L8 14V30C8 44.8 18.2 55.4 32 60C45.8 55.4 56 44.8 56 30V14L32 4Z" fill="currentColor" fill-opacity="0.12" stroke="currentColor" stroke-width="3.5" stroke-linejoin="round"/>
            <path d="M32 16V42M20 22H44M20 22L12 34M20 22L28 34M12 34C12 37 15.6 37 15.6 37C15.6 37 20 37 20 34M44 22L36 34M44 22L52 34M36 34C36 37 39.6 37 39.6 37C39.6 37 44 37 44 34M24 42H40" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>';
    }
    if (strpos($slug, 'writ') !== false) {
        return '<svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" class="help-svg-icon">
            <path d="M12 8C12 5.79086 13.7909 4 16 4H40L52 16V56C52 58.2091 50.2091 60 48 60H16C13.7909 60 12 58.2091 12 56V8Z" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linejoin="round"/>
            <path d="M38 4V18H52" stroke="currentColor" stroke-width="3.5" stroke-linejoin="round"/>
            <path d="M20 26H36M20 34H44M20 42H34" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
            <path d="M46 36L34 50L28 51L29 45L41 31L46 36Z" fill="currentColor" stroke="currentColor" stroke-width="1.5"/>
        </svg>';
    }
    if (strpos($slug, 'bail') !== false) {
        return '<svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" class="help-svg-icon">
            <circle cx="20" cy="36" r="13" stroke="currentColor" stroke-width="4"/>
            <circle cx="44" cy="36" r="13" stroke="currentColor" stroke-width="4"/>
            <path d="M20 23V16C20 12.6863 22.6863 10 26 10H38C41.3137 10 44 12.6863 44 16V23" stroke="currentColor" stroke-width="3.5" stroke-linecap="round"/>
            <path d="M31 36H33" stroke="currentColor" stroke-width="4" stroke-linecap="round"/>
            <circle cx="20" cy="40" r="2" fill="currentColor"/>
            <circle cx="44" cy="40" r="2" fill="currentColor"/>
        </svg>';
    }
    if (strpos($slug, 'cheque') !== false || strpos($slug, 'money') !== false) {
        return '<svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" class="help-svg-icon">
            <rect x="6" y="14" width="52" height="36" rx="4" fill="none" stroke="currentColor" stroke-width="3.5"/>
            <path d="M14 24H38M14 32H30M14 40H24" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
            <rect x="42" y="22" width="10" height="12" rx="1.5" stroke="currentColor" stroke-width="2.5"/>
            <path d="M40 42C44 38 48 44 54 36" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
        </svg>';
    }
    if (strpos($slug, 'company') !== false || strpos($slug, 'corporate') !== false || strpos($slug, 'city') !== false) {
        return '<svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" class="help-svg-icon">
            <path d="M6 58V24L24 14V58H6Z" fill="currentColor" fill-opacity="0.1" stroke="currentColor" stroke-width="3.5" stroke-linejoin="round"/>
            <path d="M24 58V8L58 18V58H24Z" fill="currentColor" fill-opacity="0.15" stroke="currentColor" stroke-width="3.5" stroke-linejoin="round"/>
            <path d="M12 32H18M12 40H18M12 48H18" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
            <path d="M32 20H40M32 28H40M32 36H40M32 44H40M46 24H50M46 32H50M46 40H50" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/>
            <path d="M2 58H62" stroke="currentColor" stroke-width="4" stroke-linecap="round"/>
        </svg>';
    }
    if (strpos($slug, 'trademark') !== false || strpos($slug, 'ip') !== false || strpos($slug, 'patent') !== false || strpos($slug, 'lightbulb') !== false) {
        return '<svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" class="help-svg-icon">
            <circle cx="32" cy="32" r="26" stroke="currentColor" stroke-width="4"/>
            <path d="M24 44V20H34C38.4183 20 42 23.134 42 27C42 30.866 38.4183 34 34 34H24M33 34L41 44" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>';
    }
    if (strpos($slug, 'share') !== false) {
        return '<svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" class="help-svg-icon">
            <circle cx="18" cy="32" r="8" fill="currentColor" stroke="currentColor" stroke-width="2"/>
            <circle cx="46" cy="18" r="8" fill="currentColor" stroke="currentColor" stroke-width="2"/>
            <circle cx="46" cy="46" r="8" fill="currentColor" stroke="currentColor" stroke-width="2"/>
            <path d="M25 28.5L39 21.5M25 35.5L39 42.5" stroke="currentColor" stroke-width="4" stroke-linecap="round"/>
        </svg>';
    }
    if (strpos($slug, 'tax') !== false || strpos($slug, 'vat') !== false || strpos($slug, 'calculator') !== false || strpos($slug, 'customs') !== false) {
        return '<svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" class="help-svg-icon">
            <rect x="10" y="6" width="44" height="52" rx="6" fill="none" stroke="currentColor" stroke-width="3.5"/>
            <rect x="18" y="14" width="28" height="12" rx="2" fill="currentColor" fill-opacity="0.15" stroke="currentColor" stroke-width="2.5"/>
            <rect x="18" y="32" width="7" height="6" rx="1" fill="currentColor"/>
            <rect x="28" y="32" width="7" height="6" rx="1" fill="currentColor"/>
            <rect x="38" y="32" width="8" height="6" rx="1" fill="currentColor"/>
            <rect x="18" y="42" width="7" height="6" rx="1" fill="currentColor"/>
            <rect x="28" y="42" width="7" height="6" rx="1" fill="currentColor"/>
            <rect x="38" y="42" width="8" height="6" rx="1" fill="currentColor"/>
        </svg>';
    }
    if (strpos($slug, 'family') !== false || strpos($slug, 'divorce') !== false) {
        return '<svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" class="help-svg-icon">
            <circle cx="18" cy="16" r="6" fill="currentColor"/>
            <path d="M8 48V36C8 31.5817 11.5817 28 16 28H20C24.4183 28 28 31.5817 28 36V48" stroke="currentColor" stroke-width="3.5" stroke-linecap="round"/>
            <circle cx="46" cy="16" r="6" fill="currentColor"/>
            <path d="M36 48V36C36 31.5817 39.5817 28 44 28H48C52.4183 28 56 31.5817 56 36V48" stroke="currentColor" stroke-width="3.5" stroke-linecap="round"/>
            <circle cx="32" cy="34" r="4" fill="currentColor"/>
            <path d="M26 56V48C26 45.7909 27.7909 44 30 44H34C36.2091 44 38 45.7909 38 48V56" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
        </svg>';
    }
    if (strpos($slug, 'contract') !== false || strpos($slug, 'signature') !== false || strpos($slug, 'agreement') !== false) {
        return '<svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" class="help-svg-icon">
            <rect x="10" y="8" width="44" height="48" rx="4" fill="none" stroke="currentColor" stroke-width="3.5"/>
            <path d="M18 20H46M18 28H46M18 36H34" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
            <path d="M26 46C32 42 36 48 42 42" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
        </svg>';
    }
    if (strpos($slug, 'land') !== false || strpos($slug, 'property') !== false || strpos($slug, 'estate') !== false || strpos($slug, 'building') !== false) {
        return '<svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" class="help-svg-icon">
            <path d="M8 56V26L32 8L56 26V56H8Z" fill="currentColor" fill-opacity="0.12" stroke="currentColor" stroke-width="3.5" stroke-linejoin="round"/>
            <path d="M24 56V36H40V56" stroke="currentColor" stroke-width="3.5" stroke-linejoin="round"/>
        </svg>';
    }
    if (strpos($slug, 'labor') !== false || strpos($slug, 'employment') !== false || strpos($slug, 'briefcase') !== false || strpos($slug, 'hr') !== false) {
        return '<svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" class="help-svg-icon">
            <rect x="8" y="20" width="48" height="36" rx="4" fill="none" stroke="currentColor" stroke-width="3.5"/>
            <path d="M22 20V12C22 9.79086 23.7909 8 26 8H38C40.2091 8 42 9.79086 42 12V20" stroke="currentColor" stroke-width="3.5"/>
            <path d="M8 32H56" stroke="currentColor" stroke-width="3"/>
        </svg>';
    }
    if (strpos($slug, 'bank') !== false || strpos($slug, 'finance') !== false) {
        return '<svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" class="help-svg-icon">
            <path d="M4 22L32 6L60 22V26H4V22Z" fill="currentColor"/>
            <path d="M12 26H18V48H12V26ZM26 26H32V48H26V26ZM40 26H46V48H40V26Z" fill="currentColor"/>
            <path d="M4 48H60V56H4V48Z" fill="currentColor"/>
        </svg>';
    }
    if (strpos($slug, 'arbitration') !== false || strpos($slug, 'dispute') !== false || strpos($slug, 'adr') !== false || strpos($slug, 'handshake') !== false) {
        return '<svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" class="help-svg-icon">
            <path d="M18 44L46 16M46 16H34M46 16V28" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
            <circle cx="16" cy="46" r="8" stroke="currentColor" stroke-width="3.5"/>
        </svg>';
    }
    if (strpos($slug, 'ngo') !== false || strpos($slug, 'trust') !== false || strpos($slug, 'heart') !== false) {
        return '<svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" class="help-svg-icon">
            <path d="M32 52C32 52 10 36 10 22C10 14 16 8 24 8C28.5 8 32 11 32 11C32 11 35.5 8 40 8C48 8 54 14 54 22C54 36 32 52 32 52Z" fill="currentColor" fill-opacity="0.15" stroke="currentColor" stroke-width="3.5" stroke-linejoin="round"/>
        </svg>';
    }
    if (strpos($slug, 'ship') !== false || strpos($slug, 'maritime') !== false || strpos($slug, 'admiralty') !== false) {
        return '<svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" class="help-svg-icon">
            <path d="M32 6V38M32 6L44 20H32M12 34L32 38L52 34M8 48C14 44 22 44 32 48C42 52 50 52 56 48" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>';
    }
    if (strpos($slug, 'cyber') !== false || strpos($slug, 'ecommerce') !== false || strpos($slug, 'tech') !== false || strpos($slug, 'shopping') !== false || strpos($slug, 'cart') !== false) {
        return '<svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" class="help-svg-icon">
            <rect x="8" y="12" width="48" height="34" rx="4" fill="none" stroke="currentColor" stroke-width="3.5"/>
            <path d="M20 52H44M32 46V52" stroke="currentColor" stroke-width="3.5" stroke-linecap="round"/>
            <path d="M22 24L16 30L22 36M42 24L48 30L42 36M34 22L30 38" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>';
    }
    if (strpos($slug, 'consumer') !== false || strpos($slug, 'bullhorn') !== false) {
        return '<svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" class="help-svg-icon">
            <path d="M12 24V40M12 24L38 12V52L12 40M12 24H6V40H12M38 24H50M38 32H54M38 40H48" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>';
    }
    if (strpos($slug, 'immigration') !== false || strpos($slug, 'passport') !== false) {
        return '<svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" class="help-svg-icon">
            <rect x="12" y="6" width="40" height="52" rx="5" fill="none" stroke="currentColor" stroke-width="3.5"/>
            <circle cx="32" cy="30" r="12" stroke="currentColor" stroke-width="3"/>
            <path d="M22 46H42" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
        </svg>';
    }

    // Default Courthouse SVG
    return '<svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" class="help-svg-icon">
        <path d="M4 22L32 6L60 22V26H4V22Z" fill="currentColor"/>
        <path d="M10 26H16V48H10V26ZM22 26H28V48H22V26ZM36 26H42V48H36V26ZM48 26H54V48H48V26Z" fill="currentColor"/>
        <path d="M4 48H60V56H4V48Z" fill="currentColor"/>
    </svg>';
}


// 8. Ensure 40 Complete Practice Area Posts Exist & Update Contents
function zca_legal_ensure_core_practice_areas() {
    $core_areas = array(
        array(
            'title'   => 'Civil Cases & Property Litigation',
            'slug'    => 'civil-cases',
            'excerpt' => 'Representation in all types of civil litigation, title suits, partition, injunctions, and property disputes before all courts.',
            'cat'     => 'litigation',
        ),
        array(
            'title'   => 'Criminal Cases & Special Tribunal Defense',
            'slug'    => 'criminal-cases',
            'excerpt' => 'Defense in criminal cases at all stages — Magistrate Court, Sessions Tribunal, High Court Division, and ACC quashments.',
            'cat'     => 'litigation',
        ),
        array(
            'title'   => 'Writ Petitions & High Court Division',
            'slug'    => 'writ-file',
            'excerpt' => 'Filing Constitutional Writ Petitions (Mandamus, Certiorari, Habeas Corpus, Prohibition) for fundamental rights before High Court Division.',
            'cat'     => 'litigation',
        ),
        array(
            'title'   => 'Bail Matters (Anticipatory, Interim & Regular)',
            'slug'    => 'bail',
            'excerpt' => 'Urgent bail applications, anticipatory bail before High Court Division, interim bail, and surrender before Magistrate & Sessions courts.',
            'cat'     => 'litigation',
        ),
        array(
            'title'   => 'Cheque Dishonor & NI Act 138 Litigation',
            'slug'    => 'cheque-matter',
            'excerpt' => 'Legal assistance, statutory notice drafting, trial defense, and appeal in Section 138/140 Negotiable Instruments Act cheque dishonor cases.',
            'cat'     => 'litigation',
        ),
        array(
            'title'   => 'Company Registration & RJSC Approval',
            'slug'    => 'company-registration',
            'excerpt' => 'Company formation (Private Limited, OPC, Public), RJSC name clearance, Memorandum (MOA) & Articles (AOA) drafting, and foreign branch setup.',
            'cat'     => 'corporate',
        ),
        array(
            'title'   => 'Trademark & IP Rights Registration',
            'slug'    => 'trademark-registration',
            'excerpt' => 'Trademark search, filing, opposition, copyright, patent registration at DPFDT, and High Court IP infringement litigation.',
            'cat'     => 'corporate',
        ),
        array(
            'title'   => 'Share Transfer, Allotment & RJSC Form 117',
            'slug'    => 'share-transfer',
            'excerpt' => 'Executing Form 117 share transfers, fresh share allotment, shareholder agreements, capital increase, and Board resolution filings.',
            'cat'     => 'corporate',
        ),
        array(
            'title'   => 'Income Tax, VAT & Customs Law',
            'slug'    => 'income-tax-vat-customs',
            'excerpt' => 'Corporate tax planning, Income Tax Act 2023 assessment defense, VAT audit resolution, Customs Appellate Tribunal, and High Court tax references.',
            'cat'     => 'tax',
        ),
        array(
            'title'   => 'Family Law, Divorce, Dower & Custody',
            'slug'    => 'family-matters',
            'excerpt' => 'Family Court litigation — Dissolution of Marriage (Divorce), Dower (Mahr), Maintenance, Child Custody & Guardianship petitions.',
            'cat'     => 'advisory',
        ),
        array(
            'title'   => 'Administrative & Constitutional Matters',
            'slug'    => 'administrative-constitutional-matters',
            'excerpt' => 'Constitutional litigation, writ petitions (Mandamus, Certiorari, Habeas Corpus) and judicial review before High Court Division.',
            'cat'     => 'litigation',
        ),
        array(
            'title'   => 'Admiralty & Maritime',
            'slug'    => 'admiralty-maritime',
            'excerpt' => 'Vessel arrest proceedings, bill of lading disputes, charterparty litigation, marine insurance and port authority compliance.',
            'cat'     => 'litigation',
        ),
        array(
            'title'   => 'Aerospace & Defense',
            'slug'    => 'aerospace-defense',
            'excerpt' => 'Defense procurement contracts, aviation regulatory compliance (CAAB), aircraft leasing and aerospace legal advisory.',
            'cat'     => 'advisory',
        ),
        array(
            'title'   => 'Antitrust & Competition',
            'slug'    => 'antitrust-competition',
            'excerpt' => 'Bangladesh Competition Commission advisory, anti-competitive practice defense, merger clearance and cartel investigations.',
            'cat'     => 'advisory',
        ),
        array(
            'title'   => 'Artwork Advisory',
            'slug'    => 'artwork-advisory',
            'excerpt' => 'Art provenance verification, visual artist copyright protection, cultural property preservation and art acquisition contracts.',
            'cat'     => 'advisory',
        ),
        array(
            'title'   => 'Banking, Artha Rin, Money Laundering & Cheque Dishonor',
            'slug'    => 'banking-finance-artha-rin-money-laundering-cheque-dishonor',
            'excerpt' => 'Artha Rin Adalat loan recovery, Section 138 NI Act cheque dishonor prosecutions, anti-money laundering (BFIU) compliance.',
            'cat'     => 'tax',
        ),
        array(
            'title'   => 'Compliance, Bribery & Anti-corruption',
            'slug'    => 'compliance-bribery-anti-corruption',
            'excerpt' => 'Anti-Corruption Commission (ACC) defense, corporate compliance audits, FCPA compliance and integrity policies.',
            'cat'     => 'advisory',
        ),
        array(
            'title'   => 'Company Law Service (RJSC, OPC, Foreign Branch, NGO, Trust)',
            'slug'    => 'company-law-service',
            'excerpt' => 'Company registration (Public/Private/OPC), BIDA Foreign Branch setup, NGO Affairs Bureau, Share Transfer, AGM & Return Filing.',
            'cat'     => 'corporate',
        ),
        array(
            'title'   => 'Corporate, Securities & Commercial Advisory',
            'slug'    => 'corporate-securities-commercial-advisory',
            'excerpt' => 'Bangladesh Securities & Exchange Commission (BSEC) compliance, commercial contract drafting and corporate governance.',
            'cat'     => 'corporate',
        ),
        array(
            'title'   => 'Corporate Insolvency & Restructuring',
            'slug'    => 'corporate-insolvency-restructuring',
            'excerpt' => 'High Court Company Bench winding-up proceedings, corporate debt restructuring, liquidation and insolvency litigation.',
            'cat'     => 'corporate',
        ),
        array(
            'title'   => 'Crisis Management & Regulatory Response',
            'slug'    => 'crisis-management',
            'excerpt' => '24/7 crisis intervention, emergency High Court injunctions, regulatory enforcement mitigation and reputation protection.',
            'cat'     => 'advisory',
        ),
        array(
            'title'   => 'Dispute Resolution & Arbitration (ADR)',
            'slug'    => 'dispute-resolution',
            'excerpt' => 'BIAC, ICC, and SIAC commercial arbitration, arbitral award enforcement, mediation and alternative dispute resolution.',
            'cat'     => 'litigation',
        ),
        array(
            'title'   => 'Family Matters (Marriage, Divorce, Custody, Dower)',
            'slug'    => 'family-matters',
            'excerpt' => 'Family Court litigation — Dissolution of Marriage, Dower (Mahr), Maintenance, Child Custody & Guardianship petitions.',
            'cat'     => 'advisory',
        ),
        array(
            'title'   => 'General Civil Litigations',
            'slug'    => 'general-civil-litigations',
            'excerpt' => 'Title suits, Partition suits, Specific Performance of Contract, Declaratory suits and Civil Injunctions before all courts.',
            'cat'     => 'litigation',
        ),
        array(
            'title'   => 'General Criminal Litigations',
            'slug'    => 'general-criminal-litigations',
            'excerpt' => 'Sessions trials, Magistrate Court proceedings, Nari O Shishu Tribunals, Criminal Appeals and High Court 561A Quashments.',
            'cat'     => 'litigation',
        ),
        array(
            'title'   => 'Labour, Employment & Industrial Relations',
            'slug'    => 'labour-employment-benefits-industrial-relations',
            'excerpt' => 'Labour Court litigation, Bangladesh Labour Act 2006 compliance, service rules drafting, provident fund and gratuity disputes.',
            'cat'     => 'advisory',
        ),
        array(
            'title'   => 'E-Commerce & Digital Commerce',
            'slug'    => 'e-commerce',
            'excerpt' => 'Digital Commerce Operation Guidelines compliance, DBID registration, payment gateway integration & Consumer Protection suits.',
            'cat'     => 'corporate',
        ),
        array(
            'title'   => 'Education Sector Advisory',
            'slug'    => 'education-sector',
            'excerpt' => 'Private University Act 2010 compliance, UGC regulatory approvals, school/college managing committee constitution & trusts.',
            'cat'     => 'advisory',
        ),
        array(
            'title'   => 'ESG – Environment, Social & Governance',
            'slug'    => 'esg-environment-social-governance',
            'excerpt' => 'Environmental Clearance Certificates (ECC), DoE Tribunal defense, EIA approvals and corporate ESG policy auditing.',
            'cat'     => 'advisory',
        ),
        array(
            'title'   => 'Fintech & Digital Payments',
            'slug'    => 'fintech',
            'excerpt' => 'Bangladesh Bank PSP/PSO licensing, Mobile Financial Services (MFS) compliance, cross-border remittance & data security.',
            'cat'     => 'tax',
        ),
        array(
            'title'   => 'Foreign Investment & Exchange Control',
            'slug'    => 'foreign-investment-exchange-control',
            'excerpt' => 'BIDA 100% foreign-owned entity setup, Foreign Exchange Regulation Act compliance, dividend repatriation & foreign loans.',
            'cat'     => 'corporate',
        ),
        array(
            'title'   => 'Insurance & Reinsurance',
            'slug'    => 'insurance-reinsurance',
            'excerpt' => 'Insurance Development & Regulatory Authority (IDRA) compliance, policy claim litigation and reinsurance treaties.',
            'cat'     => 'tax',
        ),
        array(
            'title'   => 'Intellectual Property Rights (IPR)',
            'slug'    => 'intellectual-property-rights',
            'excerpt' => 'Trademark, Copyright, Patent & Design registration at DPFDT, High Court IP Bench appeals, anti-counterfeiting raids.',
            'cat'     => 'corporate',
        ),
        array(
            'title'   => 'International Trade & Customs',
            'slug'    => 'international-trade-customs',
            'excerpt' => 'Customs duty disputes, NBR High Court references, Customs Appellate Tribunal, Bonded Warehouse & Letter of Credit (L/C) suits.',
            'cat'     => 'tax',
        ),
        array(
            'title'   => 'Joint Ventures & Foreign Collaborations',
            'slug'    => 'joint-ventures-foreign-technical-collaborations',
            'excerpt' => 'Cross-border Joint Venture Agreements (JVA), BIDA technology transfer registration, royalty repatriation & shareholder protection.',
            'cat'     => 'corporate',
        ),
        array(
            'title'   => 'Media, Entertainment & Sports',
            'slug'    => 'media-entertainment-sports',
            'excerpt' => 'OTT platform licensing, broadcast rights contracts, artist endorsement vetting, media censorship & sports sponsorship.',
            'cat'     => 'advisory',
        ),
        array(
            'title'   => 'Mergers & Acquisitions (M&A)',
            'slug'    => 'mergers-acquisitions',
            'excerpt' => 'High Court amalgamation scheme sanction, Share Purchase Agreements (SPA), legal due diligence audits and asset transfers.',
            'cat'     => 'corporate',
        ),
        array(
            'title'   => 'Ministerial Permission Support',
            'slug'    => 'ministerial-permission-support',
            'excerpt' => 'Inter-ministerial statutory license support, Ministry of Commerce, Ministry of Home Affairs & Ministry of Power NOCs.',
            'cat'     => 'advisory',
        ),
        array(
            'title'   => 'Notary Public Office',
            'slug'    => 'notary-public-office',
            'excerpt' => 'Official notary public attestation, Power of Attorney verification, sworn affidavits & Foreign Ministry legalizations.',
            'cat'     => 'advisory',
        ),
        array(
            'title'   => 'Oil & Gas, Energy & Infrastructure',
            'slug'    => 'oil-gas-energy-infrastructure',
            'excerpt' => 'Power Purchase Agreements (PPA) with BPDB, Independent Power Producer (IPP) legal setup, BERC licensing & PPP concessions.',
            'cat'     => 'advisory',
        ),
        array(
            'title'   => 'Pharmaceuticals, Healthcare & Life Science',
            'slug'    => 'pharmaceuticals-healthcare-life-science',
            'excerpt' => 'Directorate General of Drug Administration (DGDA) recipe & factory licensing, clinical trial contracts & pharma patent defense.',
            'cat'     => 'advisory',
        ),
        array(
            'title'   => 'Private Clients, Estate Planning & Probate',
            'slug'    => 'private-clients-estate-planning',
            'excerpt' => 'Will & Codicil drafting, District & High Court Probate petitions, Letters of Administration, Heba deeds & private family trusts.',
            'cat'     => 'property',
        ),
        array(
            'title'   => 'Private Equity, Venture Capital & Funds',
            'slug'    => 'private-equity-venture-capital-funds',
            'excerpt' => 'BSEC Alternative Investment Fund registration, Venture Capital term sheets, SAFE Convertible Notes & portfolio exits.',
            'cat'     => 'corporate',
        ),
        array(
            'title'   => 'Project Finance & Structured Syndication',
            'slug'    => 'project-finance',
            'excerpt' => 'Large-scale infrastructure project finance, cross-border loan syndication, mortgage packages & Bangladesh Bank offshore loans.',
            'cat'     => 'tax',
        ),
        array(
            'title'   => 'Real Estate, Property & Construction Law',
            'slug'    => 'real-estate',
            'excerpt' => '100-year chain of title vetting, RAJUK clearance, Joint Venture Landowner-Developer agreements, REHAB dispute arbitration.',
            'cat'     => 'property',
        ),
        array(
            'title'   => 'Regulatory Affairs & Statutory Licensing',
            'slug'    => 'regulatory-affairs',
            'excerpt' => 'BIDA, NBR, Bangladesh Bank, CCI&E Import/Export Certificates (IRC/ERC), Fire & Factory license statutory compliance.',
            'cat'     => 'advisory',
        ),
        array(
            'title'   => 'Taxation, Audit Report Support & VAT',
            'slug'    => 'taxation-audit-report-support',
            'excerpt' => 'Income Tax Act 2023 assessment defense, Taxes Appellate Tribunal appeals, NBR High Court references & VAT audit resolution.',
            'cat'     => 'tax',
        ),
        array(
            'title'   => 'Technology, Telecommunication & Data Privacy',
            'slug'    => 'technology-telecommunication',
            'excerpt' => 'BTRC license applications, Cyber Security Act litigation, software licensing agreements, SLA drafting & data protection.',
            'cat'     => 'advisory',
        ),
        array(
            'title'   => 'Vetting & Legal Document Verification',
            'slug'    => 'vetting-document-verification',
            'excerpt' => 'High-volume property title deed searching, bank mortgage document vetting, legal opinion reports & due diligence certificates.',
            'cat'     => 'advisory',
        ),
        array(
            'title'   => 'White Collar Crime & Financial Fraud Defense',
            'slug'    => 'white-collar-crime',
            'excerpt' => 'Corporate embezzlement defense, Anti-Corruption Commission prosecutions, forgery, trade-based money laundering & quashments.',
            'cat'     => 'litigation',
        )
    );

    foreach ($core_areas as $area) {
        $existing = get_page_by_path($area['slug'], OBJECT, 'practice_area');
        $body_content = $area['excerpt'] . "\n\n<h3>Comprehensive Legal Representation & Strategic Advisory</h3>\n<p>ZCA LEGAL chambers provide experienced advocate representation, statutory vetting, document preparation, and advocacy before all relevant courts, tribunals, and regulatory bodies in Bangladesh.</p>\n\n<h4>Key Legal Services Included:</h4>\n<ul>\n<li>Direct High Court & Subordinate Court Advocacy</li>\n<li>Statutory Vetting & Legal Due Diligence Reports</li>\n<li>Regulatory Liaison with Government Ministries & Autonomous Bodies</li>\n<li>Continuous Corporate Retainer & Dispute Resolution</li>\n</ul>";

        if ($existing) {
            wp_update_post(array(
                'ID'           => $existing->ID,
                'post_title'   => $area['title'],
                'post_excerpt' => $area['excerpt'],
                'post_content' => $body_content,
            ));
            wp_set_object_terms($existing->ID, $area['cat'], 'practice_category');
        } else {
            $p_id = wp_insert_post(array(
                'post_title'   => $area['title'],
                'post_name'    => $area['slug'],
                'post_excerpt' => $area['excerpt'],
                'post_content' => $body_content,
                'post_status'  => 'publish',
                'post_type'    => 'practice_area',
            ));
            if ($p_id && !is_wp_error($p_id)) {
                wp_set_object_terms($p_id, $area['cat'], 'practice_category');
            }
        }
    }
}
add_action('init', 'zca_legal_ensure_core_practice_areas', 30);


// 9. Ensure Complete 16 Team Members & Associates Exist
function zca_legal_ensure_team_members() {
    $team_members = array(
        array(
            'title'       => 'Md. Zahid Chowdhury',
            'designation' => 'Founder & Head of Chamber',
            'degree'      => 'LL.B. (Hons.), LL.M. | Advocate, Supreme Court of Bangladesh',
            'role'        => 'Head of Chamber',
            'order'       => 1
        ),
        array(
            'title'       => 'Md. Nurul Islam Matubber',
            'designation' => 'Advisor / Of Counsel (Ex-Assistant Attorney General)',
            'degree'      => 'Advocate, Supreme Court of Bangladesh',
            'role'        => 'Advisor',
            'order'       => 2
        ),
        array(
            'title'       => 'Saiful Islam',
            'designation' => 'Associate — Supreme Court Practice',
            'degree'      => 'Advocate, LL.B. (Hons.), LL.M. | Supreme Court of Bangladesh',
            'role'        => 'Associate',
            'order'       => 3
        ),
        array(
            'title'       => 'Masud Parvez',
            'designation' => 'Associate — Supreme Court Practice',
            'degree'      => 'Advocate, LL.B. (Hons.), LL.M. | Supreme Court of Bangladesh',
            'role'        => 'Associate',
            'order'       => 4
        ),
        array(
            'title'       => 'Polas Kanti Das',
            'designation' => 'Associate — Supreme Court Practice',
            'degree'      => 'Advocate, LL.B. (Hons.), LL.M. | Supreme Court of Bangladesh',
            'role'        => 'Associate',
            'order'       => 5
        ),
        array(
            'title'       => 'Md. Liton Ahmed',
            'designation' => 'Associate — Dhaka Judge Court',
            'degree'      => 'Advocate, LL.B. (Hons.), LL.M. | Dhaka Judge Court',
            'role'        => 'Associate',
            'order'       => 6
        ),
        array(
            'title'       => 'Md. Amin Khan',
            'designation' => 'Associate — Dhaka Judge Court',
            'degree'      => 'Advocate, LL.B. (Hons.), LL.M. | Dhaka Judge Court',
            'role'        => 'Associate',
            'order'       => 7
        ),
        array(
            'title'       => 'Muhammad Abdur Rahman',
            'designation' => 'Associate — RJSC & Joint Stock Matters',
            'degree'      => 'Company Law Practitioner',
            'role'        => 'Associate',
            'order'       => 8
        ),
        array(
            'title'       => 'Satyaki Das',
            'designation' => 'Associate — Income Tax, VAT & Customs',
            'degree'      => 'LL.B. (Hons.), LL.M. | Tax Practitioner',
            'role'        => 'Associate',
            'order'       => 9
        ),
        array(
            'title'       => 'Rafsan Jani',
            'designation' => 'Associate — Trademark, Copyright, Design & Patent',
            'degree'      => 'LL.B. (Hons.), LL.M. | IP Specialist',
            'role'        => 'Associate',
            'order'       => 10
        ),
        array(
            'title'       => 'Mojibor Rahman',
            'designation' => 'Associate — Land Registration & Property Vetting',
            'degree'      => 'Land Revenue & Registry Specialist',
            'role'        => 'Associate',
            'order'       => 11
        ),
        array(
            'title'       => 'Nadim Hussain',
            'designation' => 'Consultant — Immigration & Foreign Affairs',
            'degree'      => 'LL.B. (Hons.), LL.M. | Immigration Advisor',
            'role'        => 'Consultant',
            'order'       => 12
        ),
        array(
            'title'       => 'Md. Monir',
            'designation' => 'Court Clerk — High Court Division',
            'degree'      => 'Chambers Senior Court Clerk',
            'role'        => 'Court Clerk',
            'order'       => 13
        ),
        array(
            'title'       => 'Md. Alal',
            'designation' => 'Court Clerk — Judge Court',
            'degree'      => 'Chambers Court Clerk',
            'role'        => 'Court Clerk',
            'order'       => 14
        ),
        array(
            'title'       => 'Md. Iqbal Hossain',
            'designation' => 'Court Clerk — Registry & Filing',
            'degree'      => 'Chambers Filing Clerk',
            'role'        => 'Court Clerk',
            'order'       => 15
        ),
        array(
            'title'       => 'Md. Moin Uddin',
            'designation' => 'Chamber Manager',
            'degree'      => 'Chambers Executive Administration',
            'role'        => 'Chamber Manager',
            'order'       => 16
        )
    );

    foreach ($team_members as $tm) {
        $existing = get_page_by_title($tm['title'], OBJECT, 'team_member');
        if ($existing) {
            wp_update_post(array(
                'ID'         => $existing->ID,
                'menu_order' => $tm['order']
            ));
            update_post_meta($existing->ID, '_zca_team_designation', $tm['designation']);
            update_post_meta($existing->ID, '_zca_team_degree', $tm['degree']);
            update_post_meta($existing->ID, '_zca_team_role', $tm['role']);
        } else {
            $t_id = wp_insert_post(array(
                'post_title'  => $tm['title'],
                'post_status' => 'publish',
                'post_type'   => 'team_member',
                'menu_order'  => $tm['order']
            ));
            if ($t_id && !is_wp_error($t_id)) {
                update_post_meta($t_id, '_zca_team_designation', $tm['designation']);
                update_post_meta($t_id, '_zca_team_degree', $tm['degree']);
                update_post_meta($t_id, '_zca_team_role', $tm['role']);
            }
        }
    }
}
add_action('init', 'zca_legal_ensure_team_members', 35);



// 9. Custom Smart Flag Language Switcher Renderer
function zca_legal_render_language_switcher($id_suffix = 'desktop') {
    ob_start();
    ?>
    <div class="zca-lang-switcher" id="zcaLangSwitcher_<?php echo esc_attr($id_suffix); ?>">
      <button type="button" class="zca-lang-btn" onclick="toggleZcaLangDropdown(event, '<?php echo esc_attr($id_suffix); ?>')">
        <span class="zca-curr-flag">🇬🇧</span>
        <span class="zca-curr-name">English</span>
        <i class="fa-solid fa-chevron-down zca-lang-chevron"></i>
      </button>
      
      <div class="zca-lang-menu" id="zcaLangMenu_<?php echo esc_attr($id_suffix); ?>">
        <a href="javascript:void(0)" onclick="zcaTriggerTranslate('en', '🇬🇧', 'English', '<?php echo esc_attr($id_suffix); ?>')" class="zca-lang-item active" data-lang="en">
          <span class="zca-item-flag">🇬🇧</span> <span class="zca-item-name">English</span>
        </a>
        <a href="javascript:void(0)" onclick="zcaTriggerTranslate('bn', '🇧🇩', 'Bangla', '<?php echo esc_attr($id_suffix); ?>')" class="zca-lang-item" data-lang="bn">
          <span class="zca-item-flag">🇧🇩</span> <span class="zca-item-name">Bangla (বাংলা)</span>
        </a>
        <a href="javascript:void(0)" onclick="zcaTriggerTranslate('ar', '🇸🇦', 'Arabic', '<?php echo esc_attr($id_suffix); ?>')" class="zca-lang-item" data-lang="ar">
          <span class="zca-item-flag">🇸🇦</span> <span class="zca-item-name">Arabic (العربية)</span>
        </a>
        <a href="javascript:void(0)" onclick="zcaTriggerTranslate('fr', '🇫🇷', 'French', '<?php echo esc_attr($id_suffix); ?>')" class="zca-lang-item" data-lang="fr">
          <span class="zca-item-flag">🇫🇷</span> <span class="zca-item-name">French (Français)</span>
        </a>
        <a href="javascript:void(0)" onclick="zcaTriggerTranslate('zh-CN', '🇨🇳', 'Chinese', '<?php echo esc_attr($id_suffix); ?>')" class="zca-lang-item" data-lang="zh-CN">
          <span class="zca-item-flag">🇨🇳</span> <span class="zca-item-name">Chinese (中文)</span>
        </a>
        <a href="javascript:void(0)" onclick="zcaTriggerTranslate('es', '🇪🇸', 'Spanish', '<?php echo esc_attr($id_suffix); ?>')" class="zca-lang-item" data-lang="es">
          <span class="zca-item-flag">🇪🇸</span> <span class="zca-item-name">Spanish (Español)</span>
        </a>
      </div>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * Get Blog Featured Image URL with Chamber Logo Fallback
 */
function zca_legal_get_blog_image_url($post_id = 0) {
    $fallback_url = get_template_directory_uri() . '/assets/images/default-blog-fallback.jpg';

    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    if ($post_id && has_post_thumbnail($post_id)) {
        $img_url = get_the_post_thumbnail_url($post_id, 'full');
        if (!empty($img_url)) {
            $upload_dir = wp_upload_dir();
            if (strpos($img_url, $upload_dir['baseurl']) !== false) {
                $rel = str_replace($upload_dir['baseurl'], '', $img_url);
                $disk = $upload_dir['basedir'] . $rel;
                if (file_exists($disk)) {
                    return $img_url;
                }
            } else {
                return $img_url;
            }
        }
    }
    
    if ($post_id) {
        $meta_url = get_post_meta($post_id, '_zca_blog_image_url', true);
        if (!empty($meta_url)) {
            $theme_uri = get_template_directory_uri();
            $theme_dir = get_template_directory();
            if (strpos($meta_url, $theme_uri) !== false) {
                $rel = str_replace($theme_uri, '', $meta_url);
                $disk = $theme_dir . $rel;
                if (file_exists($disk)) {
                    return $meta_url;
                }
            } else {
                return $meta_url;
            }
        }
    }
    
    return $fallback_url;
}

/**
 * Auto-update Chamber Google Map links to short URLs if defaults were present
 */
add_action('admin_init', function() {
    $options = get_option('zca_theme_options');
    if (is_array($options)) {
        $updated = false;
        if (empty($options['chamber1_map']) || strpos($options['chamber1_map'], 'maps.google.com') !== false) {
            $options['chamber1_map'] = 'https://maps.app.goo.gl/dkDADYmnUXVFAVf58';
            $updated = true;
        }
        if (empty($options['chamber2_map']) || strpos($options['chamber2_map'], 'maps.google.com') !== false) {
            $options['chamber2_map'] = 'https://maps.app.goo.gl/SKXRkX7U6PBtUoTJ9';
            $updated = true;
        }
        if (empty($options['chamber3_map']) || strpos($options['chamber3_map'], 'maps.google.com') !== false) {
            $options['chamber3_map'] = 'https://maps.app.goo.gl/3GZLAVuaotGBPrqg9';
            $updated = true;
        }
        if ($updated) {
            update_option('zca_theme_options', $options);
        }
    }
});




