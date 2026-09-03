<?php
/**
 * Custom Taxonomies Registration for ZCA Legal
 *
 * @package ZCA_Legal
 */

if (!defined('ABSPATH')) {
    exit;
}

function zca_legal_register_taxonomies() {
    // 1. Practice Areas Category Taxonomy
    $practice_cat_labels = array(
        'name'              => _x('Practice Categories', 'taxonomy general name', 'zca-legal'),
        'singular_name'     => _x('Practice Category', 'taxonomy singular name', 'zca-legal'),
        'search_items'      => __('Search Categories', 'zca-legal'),
        'all_items'         => __('All Categories', 'zca-legal'),
        'edit_item'         => __('Edit Category', 'zca-legal'),
        'update_item'       => __('Update Category', 'zca-legal'),
        'add_new_item'      => __('Add New Category', 'zca-legal'),
        'new_item_name'     => __('New Category Name', 'zca-legal'),
        'menu_name'         => __('Categories', 'zca-legal'),
    );

    register_taxonomy('practice_category', array('practice_area'), array(
        'hierarchical'      => true,
        'labels'            => $practice_cat_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'practice-category'),
        'show_in_rest'      => true,
    ));

    // 2. Team Department Taxonomy
    $team_dept_labels = array(
        'name'              => _x('Departments & Courts', 'taxonomy general name', 'zca-legal'),
        'singular_name'     => _x('Department', 'taxonomy singular name', 'zca-legal'),
        'all_items'         => __('All Departments', 'zca-legal'),
        'menu_name'         => __('Departments', 'zca-legal'),
    );

    register_taxonomy('team_department', array('team_member'), array(
        'hierarchical'      => true,
        'labels'            => $team_dept_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'team-department'),
        'show_in_rest'      => true,
    ));

    // 3. Gallery Category Taxonomy
    $gallery_cat_labels = array(
        'name'              => _x('Gallery Categories', 'taxonomy general name', 'zca-legal'),
        'singular_name'     => _x('Gallery Category', 'taxonomy singular name', 'zca-legal'),
        'all_items'         => __('All Gallery Categories', 'zca-legal'),
        'menu_name'         => __('Categories', 'zca-legal'),
    );

    register_taxonomy('gallery_category', array('gallery_item'), array(
        'hierarchical'      => true,
        'labels'            => $gallery_cat_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'gallery-category'),
        'show_in_rest'      => true,
    ));
}
add_action('init', 'zca_legal_register_taxonomies');
