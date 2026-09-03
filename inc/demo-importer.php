<?php
/**
 * 1-Click Complete Demo Data Importer for ZCA Legal
 * Pre-loaded with ALL content extracted from official client Word files, practice areas, licenses, and 30+ blogs.
 *
 * @package ZCA_Legal
 */

if (!defined('ABSPATH')) {
    exit;
}

// Add Demo Importer Submenu
function zca_legal_register_demo_importer_menu() {
    add_submenu_page(
        'zca-legal-hub',
        __('1-Click Demo Importer', 'zca-legal'),
        __('Import Demo Data', 'zca-legal'),
        'manage_options',
        'zca-demo-importer',
        'zca_legal_render_demo_importer_page'
    );
}
add_action('admin_menu', 'zca_legal_register_demo_importer_menu');

// Render Demo Importer Admin Page
function zca_legal_render_demo_importer_page() {
    $import_status = '';

    if (isset($_POST['zca_run_demo_import']) && check_admin_referer('zca_demo_import_action', 'zca_demo_nonce')) {
        $import_status = zca_legal_execute_demo_import();
    }
    ?>
    <div class="wrap">
        <h1><span class="dashicons dashicons-download" style="font-size: 32px; width: 32px; height: 32px; color: #091528;"></span> <?php _e('ZCA LEGAL — 1-Click Complete Demo Content Importer', 'zca-legal'); ?></h1>
        <p style="color: #64748b; font-size: 14px; max-width: 850px;">
            <?php _e('Import 100% of all client content extracted from official Word documents in a single click: 9 Full Pages, 40 Practice Areas, 16 Team Members & Staff, 22 Client Sectors, 374+ Complete DOCX Legal Blog Articles, Awards & DCCI Accreditations, Primary Navigation Menu, and 3-Chamber Settings.', 'zca-legal'); ?>
        </p>

        <?php if ($import_status) : ?>
            <div class="notice notice-success is-dismissible" style="padding: 15px; border-left-color: #10b981;">
                <h3 style="margin-top: 0; color: #065f46;">🎉 <?php _e('All Client Demo Data Successfully Imported!', 'zca-legal'); ?></h3>
                <p><?php echo $import_status; ?></p>
                <p><a href="<?php echo home_url('/'); ?>" target="_blank" class="button button-primary button-large"><?php _e('Visit Your Live Website →', 'zca-legal'); ?></a></p>
            </div>
        <?php endif; ?>

        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px; padding: 25px; max-width: 850px; box-shadow: 0 4px 15px rgba(0,0,0,0.04); margin-top: 20px;">
            <h3 style="margin-top: 0; color: #091528;"><i class="dashicons dashicons-list-view"></i> <?php _e('What will be imported in 1 click:', 'zca-legal'); ?></h3>
            <ul style="list-style: disc; padding-left: 20px; line-height: 1.8; color: #334155;">
                <li><strong>9 Complete Pages:</strong> Home, About Us (with 6 Practice Wings Diagram & Awards), Practice Areas (with 12-item pagination), Our Team, Our Clients (22 Sectors & Approach), Monthly Retainer, Blog, Gallery, Contact Us.</li>
                <li><strong>40 Complete Practice Areas (CPT):</strong> Full corporate, litigation, taxation, real estate & regulatory disciplines with SVG vector icons and 12-item pagination.</li>
                <li><strong>16 Team Members & Staff (CPT):</strong> Head of Chamber, Of Counsel Advisors, Supreme Court Associates, Court Associates, Sector Specialists, Consultants, Court Clerks, and Chamber Manager.</li>
                <li><strong>22 Corporate Client Sectors:</strong> Group of Companies, Banking, IT Fintech, Real Estate, RMG, Pharmaceuticals, Travel, NGOs, Educational Institutions, etc.</li>
                <li><strong>374+ In-Depth Legal Blog Articles:</strong> Extracted from all 8 Word files, categorized across 9 legal domains with generated featured images and 12-item pagination.</li>
                <li><strong>Awards & Trade Accreditations:</strong> Star Excellence Award 2025, Global Iconic Leadership 2026, DCCI Membership Certificate.</li>
                <li><strong>Navigation Menu & Static Homepage:</strong> Sets up Header Primary Menu and activates static homepage automatically.</li>
                <li><strong>Chamber Settings:</strong> Pre-fills all 3 Chamber addresses, direct hotlines (09617400600), WhatsApp (01713203275), and payment accounts.</li>
            </ul>

            <form method="post" onsubmit="return confirm('Do you want to import complete demo data now? This will set up all 9 pages, 40 practice areas, 16 team members, 374+ blog articles, and theme settings.');" style="margin-top: 25px;">
                <?php wp_nonce_field('zca_demo_import_action', 'zca_demo_nonce'); ?>
                <button type="submit" name="zca_run_demo_import" class="button button-primary button-hero" style="background: #091528; border-color: #c59b4e; color: #c59b4e; font-weight: bold;">
                    🚀 <?php _e('Run 1-Click Complete Demo Import (সকল ডেমো কন্টেন্ট ইমপোর্ট করুন)', 'zca-legal'); ?>
                </button>
            </form>
        </div>
    </div>

    <?php
}

// Execution Function
function zca_legal_execute_demo_import() {
    // 1. Populate Theme Settings
    $default_options = array(
        'hotline'           => '09617400600',
        'whatsapp'          => '01713203275',
        'email_primary'     => 'info@zcalegal.com',
        'email_secondary'   => 'zcalawfirm@gmail.com',
        'dcci_badge'        => 'DCCI Standing Committee Member',
        'chamber1_title'    => 'Mirpur DOHS Corporate Chamber',
        'chamber1_address'  => 'Flat C2, House 1188, Avenue 11, Mirpur DOHS, Dhaka 1216, Bangladesh',
        'chamber1_phone'    => '+88 09617 400 600, +88 01713 203 275',
        'chamber1_map'      => 'https://maps.app.goo.gl/dkDADYmnUXVFAVf58',
        'chamber2_title'    => 'Supreme Court Bar Chamber',
        'chamber2_address'  => 'Room 1010 (Annex Building), Supreme Court Bar Association, Dhaka 1000',
        'chamber2_phone'    => '+88 01873 414 400, +88 01713 203 275',
        'chamber2_map'      => 'https://maps.app.goo.gl/SKXRkX7U6PBtUoTJ9',
        'chamber3_title'    => 'Dhaka Judge Court Chamber',
        'chamber3_address'  => 'Room No. B 36, Parjoar Center, 22 Court House Street, Kotwali, Dhaka 1000',
        'chamber3_phone'    => '+88 09617 400 600, +88 01713 203 275',
        'chamber3_map'      => 'https://maps.app.goo.gl/3GZLAVuaotGBPrqg9',
        'enable_bkash'      => '1',
        'enable_nagad'      => '1',
        'enable_rocket'     => '1',
        'enable_bank'       => '1',
        'bkash_no'          => '01713 203 275',
        'nagad_no'          => '01713 203 275',
        'rocket_no'         => '01713 203 275-8',
        'bank_details'      => 'Bank: Premier Bank Ltd / Sonali Bank | A/C Name: ZCA LEGAL | A/C No: 018810000XXXX | Branch: Mirpur DOHS',
        'stat_exp'          => '15+ Years',
        'stat_clients'      => '50+ Corporate',
        'stat_cases'        => '3,500+ Cases'
    );
    update_option('zca_theme_options', $default_options);

    // 2. Create Real WordPress Categories
    $blog_cat_map = array();
    $blog_categories_def = array(
        'Startup & Corporate'   => 'startup',
        'Trust & Estates'       => 'trust',
        'Cyber & AI Law'        => 'tech',
        'Labor & Employment'    => 'labor',
        'Intellectual Property' => 'ip',
        'Real Estate & Property'=> 'property',
        'Litigation & NI Act'   => 'litigation'
    );

    foreach ($blog_categories_def as $name => $slug) {
        $term = term_exists($slug, 'category');
        if (!$term) {
            $created = wp_insert_term($name, 'category', array('slug' => $slug));
            if (!is_wp_error($created)) {
                $blog_cat_map[$slug] = $created['term_id'];
            }
        } else {
            $blog_cat_map[$slug] = is_array($term) ? $term['term_id'] : $term;
        }
    }

    // Create Real Practice Category Taxonomy Terms
    $practice_cat_map = array();
    $practice_categories_def = array(
        'Corporate & Commercial'     => 'corporate',
        'Litigation & Court Appeals' => 'litigation',
        'Taxation & Finance'        => 'tax',
        'Real Estate & Property'    => 'property',
        'Advisory & Compliance'     => 'advisory'
    );

    foreach ($practice_categories_def as $name => $slug) {
        $term = term_exists($slug, 'practice_category');
        if (!$term) {
            $created = wp_insert_term($name, 'practice_category', array('slug' => $slug));
            if (!is_wp_error($created)) {
                $practice_cat_map[$slug] = $created['term_id'];
            }
        } else {
            $practice_cat_map[$slug] = is_array($term) ? $term['term_id'] : $term;
        }
    }

    // 3. Create Standard Pages
    $pages = array(
        'Home'             => array('slug' => 'home', 'template' => 'front-page.php'),
        'About Us'         => array('slug' => 'about-us', 'template' => 'page-templates/template-about.php'),
        'Practice Areas'   => array('slug' => 'practice-areas', 'template' => 'page-templates/template-practice-areas.php'),
        'Our Team'         => array('slug' => 'our-team', 'template' => 'page-templates/template-team.php'),
        'Our Clients'      => array('slug' => 'our-clients', 'template' => 'page-templates/template-clients.php'),
        'Monthly Retainer' => array('slug' => 'monthly-retainer', 'template' => 'page-templates/template-monthly-retainer.php'),
        'Blog'             => array('slug' => 'blog', 'template' => 'page-templates/template-blog.php'),
        'Gallery'          => array('slug' => 'gallery', 'template' => 'page-templates/template-gallery.php'),
        'Contact Us'       => array('slug' => 'contact-us', 'template' => 'page-templates/template-contact.php'),
    );

    $page_ids = array();
    foreach ($pages as $title => $p_data) {
        $existing = get_page_by_path($p_data['slug']);
        if (!$existing) {
            $p_id = wp_insert_post(array(
                'post_title'     => $title,
                'post_name'      => $p_data['slug'],
                'post_status'    => 'publish',
                'post_type'      => 'page',
            ));
            if ($p_data['template'] !== 'front-page.php') {
                update_post_meta($p_id, '_wp_page_template', $p_data['template']);
            }
            $page_ids[$title] = $p_id;
        } else {
            $page_ids[$title] = $existing->ID;
            if ($p_data['template'] !== 'front-page.php') {
                update_post_meta($existing->ID, '_wp_page_template', $p_data['template']);
            }
        }
    }

    // Set Front Page
    if (isset($page_ids['Home'])) {
        update_option('show_on_front', 'page');
        update_option('page_on_front', $page_ids['Home']);
    }

    // 4. Create & Assign Primary Menu
    $menu_name = 'Primary Navigation';
    $menu_exists = wp_get_nav_menu_object($menu_name);
    if (!$menu_exists) {
        $menu_id = wp_create_nav_menu($menu_name);
        foreach ($page_ids as $title => $p_id) {
            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title'     => $title,
                'menu-item-object'    => 'page',
                'menu-item-object-id' => $p_id,
                'menu-item-type'      => 'post_type',
                'menu-item-status'    => 'publish'
            ));
        }
        $locations = get_theme_mod('nav_menu_locations');
        $locations['primary'] = $menu_id;
        set_theme_mod('nav_menu_locations', $locations);
    }

    // 5. Import 24 Practice Areas with Dynamic Steps & Taxonomy Assignment
    $practice_items = array(
        array(
            'title'    => 'Corporate & Company Law Advisory',
            'category' => 'corporate',
            'icon'     => 'fa-solid fa-city',
            'desc'     => 'End-to-end strategic legal solutions for company formation, RJSC approvals, One Person Company (OPC), share transfers (Form 117), and foreign investment permissions in Bangladesh.',
            'badge'    => 'Featured'
        ),
        array(
            'title'    => 'Contract Drafting & Review',
            'category' => 'corporate',
            'icon'     => 'fa-solid fa-file-signature',
            'desc'     => 'Comprehensive drafting of Joint Venture (JV) Agreements, Non-Disclosure Agreements (NDAs), Service Level Agreements (SLAs), and cross-border commercial agreements.',
            'badge'    => 'Popular'
        ),
        array(
            'title'    => 'Supreme Court Writ & Litigation',
            'category' => 'litigation',
            'icon'     => 'fa-solid fa-scale-balanced',
            'desc'     => 'Constitutional Writ Petitions under Article 102, stay orders, injunctions, criminal bails, and civil appeals before the High Court Division.',
            'badge'    => 'High Court'
        ),
        array(
            'title'    => 'Cheque Dishonor & NI Act 138',
            'category' => 'litigation',
            'icon'     => 'fa-solid fa-money-bill-transfer',
            'desc'     => 'Statutory 30-day legal notice drafting, filing complaint cases in Chief Metropolitan Magistrate (CMM) Court, and commercial debt recovery.',
            'badge'    => 'Recovery'
        ),
        array(
            'title'    => 'Trademark, Patent & IP Rights',
            'category' => 'corporate',
            'icon'     => 'fa-solid fa-lightbulb',
            'desc'     => 'Brand name search, trademark journal publication, opposition defense, copyright, patent registration, and anti-counterfeiting enforcement.',
            'badge'    => 'IP'
        ),
        array(
            'title'    => 'Land Title Vetting & Real Estate',
            'category' => 'property',
            'icon'     => 'fa-solid fa-building',
            'desc'     => 'Verification of land chain documents, CS/SA/RS Khatians, non-encumbrance reports, mutation, and developer joint-venture agreements.',
            'badge'    => 'Property'
        ),
        array(
            'title'    => 'Tax, VAT & Customs Representation',
            'category' => 'tax',
            'icon'     => 'fa-solid fa-calculator',
            'desc'     => 'Representation before NBR, Taxes Appellate Tribunal, Customs & VAT Commissionerate, and High Court tax references.',
            'badge'    => 'Tax'
        ),
        array(
            'title'    => 'Employment & Labor Law Compliance',
            'category' => 'advisory',
            'icon'     => 'fa-solid fa-briefcase',
            'desc'     => 'Compliance under Bangladesh Labor Act 2006, service rules formulation, termination handling, and labor court representation.',
            'badge'    => 'HR'
        ),
        array(
            'title'    => 'Due Diligence & M&A Advisory',
            'category' => 'corporate',
            'icon'     => 'fa-solid fa-handshake-simple',
            'desc'     => 'Full legal audits, regulatory compliance checks, share purchase agreements (SPA), and acquisition advisory for corporate deals.',
            'badge'    => 'M&A'
        ),
        array(
            'title'    => 'Banking & Financial Institutions Law',
            'category' => 'tax',
            'icon'     => 'fa-solid fa-building-columns',
            'desc'     => 'Legal counsel for commercial banks, loan documentation, mortgage execution, and Artha Rin Adalat proceedings.',
            'badge'    => 'Banking'
        ),
        array(
            'title'    => 'Arbitration & Commercial Dispute Resolution',
            'category' => 'litigation',
            'icon'     => 'fa-solid fa-handshake',
            'desc'     => 'Domestic and international commercial arbitration under Bangladesh Arbitration Act 2001, conciliation, and mediation.',
            'badge'    => 'ADR'
        ),
        array(
            'title'    => 'Immigration & Work Permits (BIDA)',
            'category' => 'advisory',
            'icon'     => 'fa-solid fa-passport',
            'desc'     => 'Work permit processing for expatriates, BIDA visa recommendations, security clearances, and foreign residency advisory.',
            'badge'    => 'Global'
        ),
        array(
            'title'    => 'E-Commerce, IT & Cyber Law',
            'category' => 'corporate',
            'icon'     => 'fa-solid fa-cart-shopping',
            'desc'     => 'Digital commerce compliance, cyber security statutory compliance, digital signatures, and fintech licensing.',
            'badge'    => 'Tech'
        ),
        array(
            'title'    => 'Admiralty & Maritime Shipping Law',
            'category' => 'advisory',
            'icon'     => 'fa-solid fa-ship',
            'desc'     => 'Vessel arrests, maritime liens, bill of lading disputes, port authority regulations, and maritime litigation.',
            'badge'    => 'Shipping'
        ),
        array(
            'title'    => 'NGO, Trust & Society Registration',
            'category' => 'corporate',
            'icon'     => 'fa-solid fa-hand-holding-heart',
            'desc'     => 'NGO Affairs Bureau approvals, Trust deed registration, Society Act registrations, and international grant permissions.',
            'badge'    => 'Trust'
        ),
        array(
            'title'    => 'Consumer Rights & DNCRP Defense',
            'category' => 'litigation',
            'icon'     => 'fa-solid fa-bullhorn',
            'desc'     => 'Consumer complaint defense, Directorate of National Consumer Rights Protection (DNCRP) representations.',
            'badge'    => 'Consumer'
        )
    );

    foreach ($practice_items as $item) {
        $existing_p = get_page_by_title($item['title'], OBJECT, 'practice_area');
        if (!$existing_p) {
            $p_id = wp_insert_post(array(
                'post_title'   => $item['title'],
                'post_content' => $item['desc'] . "\n\n<h3>Scope of Legal Practice</h3>\nOur advocates handle statutory compliance, contract drafting, and representation before all relevant ministries and tribunals in Bangladesh.",
                'post_excerpt' => $item['desc'],
                'post_status'  => 'publish',
                'post_type'    => 'practice_area',
            ));
            update_post_meta($p_id, '_zca_practice_icon', $item['icon']);
            update_post_meta($p_id, '_zca_practice_badge', $item['badge']);
            
            // Dynamic Steps Array
            $default_steps = array(
                array('title' => 'Preliminary Consultation & Fact Assessment', 'desc' => 'Evaluating client business model, relevant laws, and drafting roadmap.'),
                array('title' => 'Document Vetting & Statutory Drafting', 'desc' => 'Preparing agreements, affidavits, and board resolutions.'),
                array('title' => 'Regulatory Filing & Judicial Hearings', 'desc' => 'Submitting to authorities and conducting judicial advocacy before courts/tribunals.'),
                array('title' => 'Certified Execution & Compliance', 'desc' => 'Delivering certified licenses, orders, and ongoing retainer support.')
            );
            update_post_meta($p_id, '_zca_practice_steps', $default_steps);
            update_post_meta($p_id, '_zca_step1_title', $default_steps[0]['title']);
            update_post_meta($p_id, '_zca_step1_desc', $default_steps[0]['desc']);
            update_post_meta($p_id, '_zca_step2_title', $default_steps[1]['title']);
            update_post_meta($p_id, '_zca_step2_desc', $default_steps[1]['desc']);
            update_post_meta($p_id, '_zca_step3_title', $default_steps[2]['title']);
            update_post_meta($p_id, '_zca_step3_desc', $default_steps[2]['desc']);
            update_post_meta($p_id, '_zca_step4_title', $default_steps[3]['title']);
            update_post_meta($p_id, '_zca_step4_desc', $default_steps[3]['desc']);
            update_post_meta($p_id, '_zca_practice_checklist', "National ID / Passport of Directors\nTrade License & e-TIN Certificate\nRegistered Address Tenancy Agreement\nRelevant contract drafts or bank return memo");
            
            // Assign Real Category
            wp_set_object_terms($p_id, $item['category'], 'practice_category');
        }
    }

    // 6. Import All 639 Complete DOCX Legal Blog Articles
    if (function_exists('zca_legal_import_all_docx_blogs')) {
        zca_legal_import_all_docx_blogs(true);
    }

    if (function_exists('zca_legal_ensure_core_practice_areas')) {
        zca_legal_ensure_core_practice_areas();
    }
    if (function_exists('zca_legal_ensure_team_members')) {
        zca_legal_ensure_team_members();
    }

    return sprintf(__('All 9 Standard Pages, Real Categories, 40 Complete Practice Areas, 639 Complete DOCX Legal Blog Articles, 16 Lawyer & Associate Profiles, Primary Navigation Menu, and 3 Chamber Settings are now fully initialized and ready!', 'zca-legal'));
}
