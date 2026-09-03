<?php
/**
 * Custom Post Types Registration for ZCA Legal
 *
 * @package ZCA_Legal
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

function zca_legal_register_custom_post_types() {
    // 1. Practice Areas CPT
    $practice_labels = array(
        'name'                  => _x('Practice Areas', 'Post type general name', 'zca-legal'),
        'singular_name'         => _x('Practice Area', 'Post type singular name', 'zca-legal'),
        'menu_name'             => _x('Practice Areas', 'Admin Menu text', 'zca-legal'),
        'name_admin_bar'        => _x('Practice Area', 'Add New on Toolbar', 'zca-legal'),
        'add_new'               => __('Add New Area', 'zca-legal'),
        'add_new_item'          => __('Add New Practice Area', 'zca-legal'),
        'new_item'              => __('New Practice Area', 'zca-legal'),
        'edit_item'             => __('Edit Practice Area', 'zca-legal'),
        'view_item'             => __('View Practice Area', 'zca-legal'),
        'all_items'             => __('All Practice Areas', 'zca-legal'),
        'search_items'          => __('Search Practice Areas', 'zca-legal'),
        'not_found'             => __('No practice areas found.', 'zca-legal'),
        'not_found_in_trash'    => __('No practice areas found in Trash.', 'zca-legal')
    );

    $practice_args = array(
        'labels'             => $practice_labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'practice-area'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-hammer',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'show_in_rest'       => true,
    );
    register_post_type('practice_area', $practice_args);

    // 2. Team Members CPT
    $team_labels = array(
        'name'                  => _x('Our Team', 'Post type general name', 'zca-legal'),
        'singular_name'         => _x('Team Member', 'Post type singular name', 'zca-legal'),
        'menu_name'             => _x('Our Team', 'Admin Menu text', 'zca-legal'),
        'add_new'               => __('Add Lawyer / Member', 'zca-legal'),
        'add_new_item'          => __('Add New Team Member', 'zca-legal'),
        'edit_item'             => __('Edit Team Member', 'zca-legal'),
        'view_item'             => __('View Team Member', 'zca-legal'),
        'all_items'             => __('All Team Members', 'zca-legal'),
        'search_items'          => __('Search Team Members', 'zca-legal'),
    );

    $team_args = array(
        'labels'             => $team_labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'team-member'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 6,
        'menu_icon'          => 'dashicons-businessperson',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest'       => true,
    );
    register_post_type('team_member', $team_args);

    // 3. Gallery Items CPT
    $gallery_labels = array(
        'name'                  => _x('Gallery & Events', 'Post type general name', 'zca-legal'),
        'singular_name'         => _x('Gallery Item', 'Post type singular name', 'zca-legal'),
        'menu_name'             => _x('Gallery', 'Admin Menu text', 'zca-legal'),
        'add_new'               => __('Add Photo / Event', 'zca-legal'),
        'add_new_item'          => __('Add New Gallery Item', 'zca-legal'),
        'all_items'             => __('All Gallery Items', 'zca-legal'),
    );

    $gallery_args = array(
        'labels'             => $gallery_labels,
        'public'             => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_position'      => 7,
        'menu_icon'          => 'dashicons-format-gallery',
        'supports'           => array('title', 'thumbnail', 'excerpt'),
        'show_in_rest'       => true,
    );
    register_post_type('gallery_item', $gallery_args);

    // 4. Consultation Bookings CPT (Admin Management)
    $booking_labels = array(
        'name'               => _x('Consultation Bookings', 'Post type general name', 'zca-legal'),
        'singular_name'      => _x('Booking', 'Post type singular name', 'zca-legal'),
        'menu_name'          => _x('Bookings', 'Admin Menu text', 'zca-legal'),
        'all_items'          => __('All Bookings', 'zca-legal'),
        'edit_item'          => __('View / Edit Booking', 'zca-legal'),
    );

    $booking_args = array(
        'labels'             => $booking_labels,
        'public'             => false,
        'show_ui'            => true,
        'show_in_menu'       => 'zca-legal-hub', // Under ZCA Legal main menu
        'capability_type'    => 'post',
        'capabilities'       => array('create_posts' => false), // Created via website form
        'map_meta_cap'       => true,
        'supports'           => array('title', 'custom-fields'),
    );
    register_post_type('zca_booking', $booking_args);

    // 5. General Contact Inquiries CPT
    $inquiry_labels = array(
        'name'               => _x('Contact Inquiries', 'Post type general name', 'zca-legal'),
        'singular_name'      => _x('Inquiry', 'Post type singular name', 'zca-legal'),
        'menu_name'          => _x('Inquiries', 'Admin Menu text', 'zca-legal'),
        'all_items'          => __('All Inquiries', 'zca-legal'),
    );

    $inquiry_args = array(
        'labels'             => $inquiry_labels,
        'public'             => false,
        'show_ui'            => true,
        'show_in_menu'       => 'zca-legal-hub',
        'capability_type'    => 'post',
        'capabilities'       => array('create_posts' => false),
        'map_meta_cap'       => true,
        'supports'           => array('title', 'editor', 'custom-fields'),
    );
    register_post_type('zca_inquiry', $inquiry_args);
}
add_action('init', 'zca_legal_register_custom_post_types');
