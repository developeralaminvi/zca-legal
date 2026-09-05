<?php
/**
 * Ultra-Fast Direct Database Importer for all 639 DOCX Blog Articles
 *
 * @package ZCA_Legal
 */

function zca_legal_get_or_create_blog_attachment_id($num) {
    global $wpdb;

    $file_path = get_template_directory() . '/assets/images/blog/blog-' . $num . '.jpg';
    if (!file_exists($file_path)) {
        $file_path = get_template_directory() . '/assets/images/blog/corporate.jpg';
    }

    $attachment_id = $wpdb->get_var($wpdb->prepare(
        "SELECT ID FROM {$wpdb->posts} WHERE post_type = 'attachment' AND post_name = %s LIMIT 1",
        'zca-blog-img-' . $num
    ));

    if (!$attachment_id && file_exists($file_path)) {
        $file_type = wp_check_filetype(basename($file_path), null);
        $attachment = array(
            'post_mime_type' => $file_type['type'] ? $file_type['type'] : 'image/jpeg',
            'post_title'     => 'ZCA Legal Blog Featured Image #' . $num,
            'post_name'      => 'zca-blog-img-' . $num,
            'post_content'   => '',
            'post_status'    => 'inherit',
            'guid'           => get_template_directory_uri() . '/assets/images/blog/blog-' . $num . '.jpg'
        );
        $attachment_id = wp_insert_attachment($attachment, $file_path);
        if (!is_wp_error($attachment_id)) {
            update_post_meta($attachment_id, '_wp_attached_file', 'zca-theme-blog/blog-' . $num . '.jpg');
        }
    }

    return ( $attachment_id && !is_wp_error($attachment_id) ) ? intval($attachment_id) : 0;
}

function zca_legal_import_all_docx_blogs($force = false) {
    $json_file = get_template_directory() . '/inc/all-docx-blogs.json';
    if (!file_exists($json_file)) {
        return;
    }

    $post_count = wp_count_posts('post');
    $published_count = (isset($post_count->publish)) ? intval($post_count->publish) : 0;
    
    // If we already have 600+ published blogs and not forced, do not re-run import
    if (!$force && $published_count >= 600) {
        return;
    }

    @set_time_limit(600);
    @ini_set('memory_limit', '512M');

    wp_defer_term_counting(true);
    wp_defer_comment_counting(true);

    $json_data = file_get_contents($json_file);
    $json_data = preg_replace('/^\xEF\xBB\xBF/', '', $json_data);
    $blogs = json_decode($json_data, true);
    if (empty($blogs) || !is_array($blogs)) {
        return;
    }

    global $wpdb;

    // Clear old posts if count < 100
    if ($published_count < 100) {
        $wpdb->query("DELETE FROM {$wpdb->posts} WHERE post_type = 'post'");
        $wpdb->query("DELETE FROM {$wpdb->postmeta} WHERE post_id NOT IN (SELECT ID FROM {$wpdb->posts})");
        $wpdb->query("DELETE FROM {$wpdb->term_relationships} WHERE object_id NOT IN (SELECT ID FROM {$wpdb->posts})");
    }

    // Ensure Categories exist
    $category_map = array(
        'corporate'  => 'Startup & Corporate Law',
        'tax'        => 'Taxation, VAT & Customs',
        'property'   => 'Real Estate & Property Law',
        'litigation' => 'Litigation & Court Practice',
        'ip'         => 'Intellectual Property',
        'tech'       => 'Cyber, Tech & AI Law',
        'labor'      => 'Labor & Employment',
        'family'     => 'Family & Civil Rights',
        'banking'    => 'Banking & Financial Recoveries'
    );

    $term_ids = array();
    foreach ($category_map as $slug => $name) {
        $term = term_exists($slug, 'category');
        if (!$term) {
            $term = wp_insert_term($name, 'category', array('slug' => $slug));
        }
        if (!is_wp_error($term) && isset($term['term_id'])) {
            $term_ids[$slug] = $term['term_id'];
        }
    }

    $now = current_time('mysql');
    $now_gmt = current_time('mysql', 1);
    $user_id = get_current_user_id() ? get_current_user_id() : 1;

    foreach ($blogs as $index => $blog) {
        $title = !empty($blog['title']) ? trim($blog['title']) : '';
        $content = !empty($blog['content']) ? trim($blog['content']) : '';
        $keywords = !empty($blog['keywords']) ? trim($blog['keywords']) : '';
        $meta_desc = !empty($blog['description']) ? trim($blog['description']) : '';

        if (empty($title) || empty($content)) {
            continue;
        }

        $slug = sanitize_title($title);
        if (empty($slug)) {
            $slug = 'blog-post-' . ($index + 1);
        }

        // Format HTML
        $paragraphs = explode("\n\n", $content);
        $formatted_html = '';
        foreach ($paragraphs as $p_text) {
            $p_text = trim($p_text);
            if (empty($p_text)) continue;

            if (preg_match('/^(?:\d+[\.\)]|\#+)\s*(.+)/', $p_text) || (strlen($p_text) < 70 && !preg_match('/[\.\?\!]$/', $p_text))) {
                $formatted_html .= '<h4>' . esc_html($p_text) . '</h4>' . "\n";
            } else {
                $formatted_html .= '<p>' . esc_html($p_text) . '</p>' . "\n";
            }
        }

        $excerpt = !empty($meta_desc) ? $meta_desc : wp_trim_words(strip_tags($content), 25, '...');

        // Categorize dynamically
        $assigned_slug = 'corporate';
        $lower_title = strtolower($title . ' ' . $keywords);

        if (strpos($lower_title, 'tax') !== false || strpos($lower_title, 'vat') !== false || strpos($lower_title, 'customs') !== false || strpos($lower_title, 'nbr') !== false) {
            $assigned_slug = 'tax';
        } elseif (strpos($lower_title, 'land') !== false || strpos($lower_title, 'property') !== false || strpos($lower_title, 'rent') !== false || strpos($lower_title, 'real estate') !== false) {
            $assigned_slug = 'property';
        } elseif (strpos($lower_title, 'court') !== false || strpos($lower_title, 'writ') !== false || strpos($lower_title, 'bail') !== false || strpos($lower_title, 'criminal') !== false || strpos($lower_title, 'rape') !== false || strpos($lower_title, 'litigation') !== false || strpos($lower_title, 'ni act') !== false) {
            $assigned_slug = 'litigation';
        } elseif (strpos($lower_title, 'trademark') !== false || strpos($lower_title, 'copyright') !== false || strpos($lower_title, 'patent') !== false || strpos($lower_title, 'ip') !== false) {
            $assigned_slug = 'ip';
        } elseif (strpos($lower_title, 'cyber') !== false || strpos($lower_title, 'ai') !== false || strpos($lower_title, 'tech') !== false || strpos($lower_title, 'ecommerce') !== false || strpos($lower_title, 'online') !== false) {
            $assigned_slug = 'tech';
        } elseif (strpos($lower_title, 'labor') !== false || strpos($lower_title, 'employment') !== false || strpos($lower_title, 'worker') !== false || strpos($lower_title, 'hr') !== false) {
            $assigned_slug = 'labor';
        } elseif (strpos($lower_title, 'family') !== false || strpos($lower_title, 'marriage') !== false || strpos($lower_title, 'divorce') !== false || strpos($lower_title, 'trust') !== false || strpos($lower_title, 'ngo') !== false) {
            $assigned_slug = 'family';
        } elseif (strpos($lower_title, 'bank') !== false || strpos($lower_title, 'cheque') !== false || strpos($lower_title, 'money') !== false || strpos($lower_title, 'finance') !== false) {
            $assigned_slug = 'banking';
        }

        // Direct DB insert
        $inserted = $wpdb->insert(
            $wpdb->posts,
            array(
                'post_author'           => $user_id,
                'post_date'             => $now,
                'post_date_gmt'         => $now_gmt,
                'post_content'          => $formatted_html,
                'post_title'            => $title,
                'post_excerpt'          => $excerpt,
                'post_status'           => 'publish',
                'comment_status'        => 'closed',
                'ping_status'           => 'closed',
                'post_name'             => $slug . '-' . ($index + 1),
                'post_modified'         => $now,
                'post_modified_gmt'     => $now_gmt,
                'post_type'             => 'post',
                'to_ping'               => '',
                'pinged'                => '',
                'post_content_filtered' => '',
            )
        );

        if ($inserted) {
            $post_id = $wpdb->insert_id;

            if (isset($term_ids[$assigned_slug])) {
                $wpdb->insert(
                    $wpdb->term_relationships,
                    array(
                        'object_id'        => $post_id,
                        'term_taxonomy_id' => $term_ids[$assigned_slug],
                    )
                );
            }

            // Assign Unique Local Featured Image (_thumbnail_id)
            $num = $index + 1;
            $att_id = zca_legal_get_or_create_blog_attachment_id($num);
            if ($att_id > 0) {
                $wpdb->insert($wpdb->postmeta, array(
                    'post_id'    => $post_id,
                    'meta_key'   => '_thumbnail_id',
                    'meta_value' => $att_id
                ));
            }

            $local_img_url = get_template_directory_uri() . '/assets/images/blog/blog-' . $num . '.jpg';
            $wpdb->insert($wpdb->postmeta, array('post_id' => $post_id, 'meta_key' => '_zca_blog_image_url', 'meta_value' => $local_img_url));
            if (!empty($keywords)) {
                $wpdb->insert($wpdb->postmeta, array('post_id' => $post_id, 'meta_key' => '_zca_blog_keywords', 'meta_value' => $keywords));
            }
        }
    }

    wp_defer_term_counting(false);
    wp_defer_comment_counting(false);

    // Recalculate all category terms so database term counts are immediately accurate
    $all_cat_terms = get_terms(array(
        'taxonomy'   => 'category',
        'hide_empty' => false,
        'fields'     => 'ids',
    ));
    if (!empty($all_cat_terms) && !is_wp_error($all_cat_terms)) {
        wp_update_term_count_now($all_cat_terms, 'category');
    }
}
// Note: Auto-run on 'init' removed as requested by user. Blog import only runs via Demo Importer.
