<?php

// Register Custom Post Type
function book_post_type()
{
    $labels = array(
        'name'                  => _x('Books', 'Post Type General Name', 'text_domain'),
        'singular_name'         => _x('Book', 'Post Type Singular Name', 'text_domain'),
        'menu_name'             => __('Books', 'text_domain'),
        'name_admin_bar'        => __('Book', 'text_domain'),
        'archives'              => __('Item Archives', 'text_domain'),
        'attributes'            => __('Item Attributes', 'text_domain'),
        'parent_item_colon'     => __('Parent Book:', 'text_domain'),
        'all_items'             => __('All Books', 'text_domain'),
        'add_new_item'          => __('Add New Book', 'text_domain'),
        'add_new'               => __('New Book', 'text_domain'),
        'new_item'              => __('New Item', 'text_domain'),
        'edit_item'             => __('Edit Book', 'text_domain'),
        'update_item'           => __('Update Book', 'text_domain'),
        'view_item'             => __('View Book', 'text_domain'),
        'view_items'            => __('View Items', 'text_domain'),
        'search_items'          => __('Search books', 'text_domain'),
        'not_found'             => __('No books found', 'text_domain'),
        'not_found_in_trash'    => __('No books found in Trash', 'text_domain'),
        'featured_image'        => __('Featured Image', 'text_domain'),
        'set_featured_image'    => __('Set featured image', 'text_domain'),
        'remove_featured_image' => __('Remove featured image', 'text_domain'),
        'use_featured_image'    => __('Use as featured image', 'text_domain'),
        'insert_into_item'      => __('Insert into item', 'text_domain'),
        'uploaded_to_this_item' => __('Uploaded to this item', 'text_domain'),
        'items_list'            => __('Items list', 'text_domain'),
        'items_list_navigation' => __('Items list navigation', 'text_domain'),
        'filter_items_list'     => __('Filter items list', 'text_domain'),
    );
    $args = array(
        'label'                 => __('Book', 'text_domain'),
        'description'           => __('Book information pages.', 'text_domain'),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'custom-fields', ),
        'taxonomies'            => array( 'category', 'post_tag' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
    );
    register_post_type('book', $args);
}
add_action('init', 'book_post_type', 0);

/**
 * Remove meta box fields
 */
function remove_book_fields()
{
    remove_meta_box('authordiv', 'book', 'normal');
    remove_meta_box('commentstatusdiv', 'book', 'normal');
    remove_meta_box('commentsdiv', 'book', 'normal');
    remove_meta_box('postcustom', 'book', 'normal');
    remove_meta_box('slugdiv', 'book', 'normal');
    remove_meta_box('postexcerpt', 'book', 'normal');
}
add_action('admin_menu', 'remove_book_fields');

function remove_book_side_fields()
{
    remove_meta_box('postimagediv', 'book', 'side');
    remove_meta_box('tagsdiv-post_tag', 'book', 'side');
}
add_action('do_meta_boxes', 'remove_book_side_fields');


// Register Custom Post Type
function product_post_type()
{
    $labels = array(
        'name'                  => _x('Merchandise', 'Post Type General Name', 'text_domain'),
        'singular_name'         => _x('Merchandise', 'Post Type Singular Name', 'text_domain'),
        'menu_name'             => __('Merchandise', 'text_domain'),
        'name_admin_bar'        => __('Merchandise', 'text_domain'),
        'archives'              => __('Item Archives', 'text_domain'),
        'attributes'            => __('Item Attributes', 'text_domain'),
        'parent_item_colon'     => __('Parent Merchandise:', 'text_domain'),
        'all_items'             => __('All Merchandise', 'text_domain'),
        'add_new_item'          => __('Add New Merchandise', 'text_domain'),
        'add_new'               => __('New Merchandise', 'text_domain'),
        'new_item'              => __('New Item', 'text_domain'),
        'edit_item'             => __('Edit Merchandise', 'text_domain'),
        'update_item'           => __('Update Merchandise', 'text_domain'),
        'view_item'             => __('View Merchandise', 'text_domain'),
        'view_items'            => __('View Items', 'text_domain'),
        'search_items'          => __('Search merchandise', 'text_domain'),
        'not_found'             => __('No merchandise found', 'text_domain'),
        'not_found_in_trash'    => __('No merchandise found in Trash', 'text_domain'),
        'featured_image'        => __('Featured Image', 'text_domain'),
        'set_featured_image'    => __('Set featured image', 'text_domain'),
        'remove_featured_image' => __('Remove featured image', 'text_domain'),
        'use_featured_image'    => __('Use as featured image', 'text_domain'),
        'insert_into_item'      => __('Insert into item', 'text_domain'),
        'uploaded_to_this_item' => __('Uploaded to this item', 'text_domain'),
        'items_list'            => __('Items list', 'text_domain'),
        'items_list_navigation' => __('Items list navigation', 'text_domain'),
        'filter_items_list'     => __('Filter items list', 'text_domain'),
    );
    $args = array(
        'label'                 => __('Merchandise', 'text_domain'),
        'description'           => __('Merchandise information pages.', 'text_domain'),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'custom-fields', ),
        'taxonomies'            => array( 'category', 'post_tag' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
    );
    register_post_type('merchandise', $args);
}
add_action('init', 'product_post_type', 0);

/**
 * Remove meta box fields
 */
function remove_product_fields()
{
    remove_meta_box('authordiv', 'merchandise', 'normal');
    remove_meta_box('commentstatusdiv', 'merchandise', 'normal');
    remove_meta_box('commentsdiv', 'merchandise', 'normal');
    remove_meta_box('postcustom', 'merchandise', 'normal');
    remove_meta_box('slugdiv', 'merchandise', 'normal');
    remove_meta_box('postexcerpt', 'merchandise', 'normal');
}
add_action('admin_menu', 'remove_product_fields');

function remove_product_side_fields()
{
    remove_meta_box('postimagediv', 'merchandise', 'side');
    remove_meta_box('tagsdiv-post_tag', 'merchandise', 'side');
}
add_action('do_meta_boxes', 'remove_product_side_fields');


// Register Custom Post Type
function social_post_post_type()
{
    $labels = array(
        'name'                  => _x('Social Posts', 'Post Type General Name', 'text_domain'),
        'singular_name'         => _x('Social Post', 'Post Type Singular Name', 'text_domain'),
        'menu_name'             => __('Social Posts', 'text_domain'),
        'name_admin_bar'        => __('Social Post', 'text_domain'),
        'archives'              => __('Item Archives', 'text_domain'),
        'attributes'            => __('Item Attributes', 'text_domain'),
        'parent_item_colon'     => __('Parent Social Post:', 'text_domain'),
        'all_items'             => __('All Social Posts', 'text_domain'),
        'add_new_item'          => __('Add New Social Post', 'text_domain'),
        'add_new'               => __('New Social Post', 'text_domain'),
        'new_item'              => __('New Item', 'text_domain'),
        'edit_item'             => __('Edit Social Post', 'text_domain'),
        'update_item'           => __('Update Social Post', 'text_domain'),
        'view_item'             => __('View Social Post', 'text_domain'),
        'view_items'            => __('View Items', 'text_domain'),
        'search_items'          => __('Search social_posts', 'text_domain'),
        'not_found'             => __('No social_posts found', 'text_domain'),
        'not_found_in_trash'    => __('No social_posts found in Trash', 'text_domain'),
        'featured_image'        => __('Featured Image', 'text_domain'),
        'set_featured_image'    => __('Set featured image', 'text_domain'),
        'remove_featured_image' => __('Remove featured image', 'text_domain'),
        'use_featured_image'    => __('Use as featured image', 'text_domain'),
        'insert_into_item'      => __('Insert into item', 'text_domain'),
        'uploaded_to_this_item' => __('Uploaded to this item', 'text_domain'),
        'items_list'            => __('Items list', 'text_domain'),
        'items_list_navigation' => __('Items list navigation', 'text_domain'),
        'filter_items_list'     => __('Filter items list', 'text_domain'),
    );
    $args = array(
        'label'                 => __('Social Post', 'text_domain'),
        'description'           => __('Social Post information pages.', 'text_domain'),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'custom-fields', ),
        'taxonomies'            => array( 'category', 'post_tag' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
    );
    register_post_type('social_post', $args);
    remove_post_type_support('social_post', 'editor');
}
add_action('init', 'social_post_post_type', 0);

/**
 * Remove meta box fields
 */
function remove_social_post_fields()
{
    remove_meta_box('authordiv', 'social_post', 'normal');
    remove_meta_box('commentstatusdiv', 'social_post', 'normal');
    remove_meta_box('commentsdiv', 'social_post', 'normal');
    remove_meta_box('postcustom', 'social_post', 'normal');
    remove_meta_box('slugdiv', 'social_post', 'normal');
    remove_meta_box('postexcerpt', 'social_post', 'normal');
}
add_action('admin_menu', 'remove_social_post_fields');

function remove_social_post_side_fields()
{
    remove_meta_box('postimagediv', 'social_post', 'side');
    remove_meta_box('tagsdiv-post_tag', 'social_post', 'side');
}
add_action('do_meta_boxes', 'remove_social_post_side_fields');

// Register Custom Post Type
function sticky_post_type()
{
    $labels = array(
        'name'                  => _x('Stickies', 'Post Type General Name', 'text_domain'),
        'singular_name'         => _x('Sticky', 'Post Type Singular Name', 'text_domain'),
        'menu_name'             => __('Stickies', 'text_domain'),
        'name_admin_bar'        => __('Sticky', 'text_domain'),
        'archives'              => __('Item Archives', 'text_domain'),
        'attributes'            => __('Item Attributes', 'text_domain'),
        'parent_item_colon'     => __('Parent Sticky:', 'text_domain'),
        'all_items'             => __('All Stickies', 'text_domain'),
        'add_new_item'          => __('Add New Sticky', 'text_domain'),
        'add_new'               => __('New Sticky', 'text_domain'),
        'new_item'              => __('New Item', 'text_domain'),
        'edit_item'             => __('Edit Sticky', 'text_domain'),
        'update_item'           => __('Update Sticky', 'text_domain'),
        'view_item'             => __('View Sticky', 'text_domain'),
        'view_items'            => __('View Items', 'text_domain'),
        'search_items'          => __('Search stickies', 'text_domain'),
        'not_found'             => __('No stickies found', 'text_domain'),
        'not_found_in_trash'    => __('No stickies found in Trash', 'text_domain'),
        'featured_image'        => __('Featured Image', 'text_domain'),
        'set_featured_image'    => __('Set featured image', 'text_domain'),
        'remove_featured_image' => __('Remove featured image', 'text_domain'),
        'use_featured_image'    => __('Use as featured image', 'text_domain'),
        'insert_into_item'      => __('Insert into item', 'text_domain'),
        'uploaded_to_this_item' => __('Uploaded to this item', 'text_domain'),
        'items_list'            => __('Items list', 'text_domain'),
        'items_list_navigation' => __('Items list navigation', 'text_domain'),
        'filter_items_list'     => __('Filter items list', 'text_domain'),
    );
    $args = array(
        'label'                 => __('Sticky', 'text_domain'),
        'description'           => __('Sticky information pages.', 'text_domain'),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'custom-fields', ),
        'taxonomies'            => array( 'category', 'post_tag' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
    );
    register_post_type('sticky', $args);
    remove_post_type_support('sticky', 'editor');
}
add_action('init', 'sticky_post_type', 0);

/**
 * Remove meta box fields
 */
function remove_sticky_fields()
{
    remove_meta_box('authordiv', 'sticky', 'normal');
    remove_meta_box('commentstatusdiv', 'sticky', 'normal');
    remove_meta_box('commentsdiv', 'sticky', 'normal');
    remove_meta_box('postcustom', 'sticky', 'normal');
    remove_meta_box('slugdiv', 'sticky', 'normal');
    remove_meta_box('postexcerpt', 'sticky', 'normal');
    remove_meta_box('categorydiv', 'sticky', 'normal');
    remove_meta_box('tagsdiv-post_tag', 'sticky', 'normal');
}
add_action('admin_menu', 'remove_sticky_fields');

function remove_sticky_side_fields()
{
    remove_meta_box('postimagediv', 'sticky', 'side');
    remove_meta_box('tagsdiv-post_tag', 'sticky', 'side');
}
add_action('do_meta_boxes', 'remove_sticky_side_fields');


// Register Custom Post Type
function topic_post_type()
{
    $labels = array(
        'name'                  => _x('Topics', 'Post Type General Name', 'text_domain'),
        'singular_name'         => _x('Topic', 'Post Type Singular Name', 'text_domain'),
        'menu_name'             => __('Topics', 'text_domain'),
        'name_admin_bar'        => __('Topic', 'text_domain'),
        'archives'              => __('Item Archives', 'text_domain'),
        'attributes'            => __('Item Attributes', 'text_domain'),
        'parent_item_colon'     => __('Parent Topic:', 'text_domain'),
        'all_items'             => __('All Topics', 'text_domain'),
        'add_new_item'          => __('Add New Topic', 'text_domain'),
        'add_new'               => __('New Topic', 'text_domain'),
        'new_item'              => __('New Item', 'text_domain'),
        'edit_item'             => __('Edit Topic', 'text_domain'),
        'update_item'           => __('Update Topic', 'text_domain'),
        'view_item'             => __('View Topic', 'text_domain'),
        'view_items'            => __('View Items', 'text_domain'),
        'search_items'          => __('Search topics', 'text_domain'),
        'not_found'             => __('No topics found', 'text_domain'),
        'not_found_in_trash'    => __('No topics found in Trash', 'text_domain'),
        'featured_image'        => __('Featured Image', 'text_domain'),
        'set_featured_image'    => __('Set featured image', 'text_domain'),
        'remove_featured_image' => __('Remove featured image', 'text_domain'),
        'use_featured_image'    => __('Use as featured image', 'text_domain'),
        'insert_into_item'      => __('Insert into item', 'text_domain'),
        'uploaded_to_this_item' => __('Uploaded to this item', 'text_domain'),
        'items_list'            => __('Items list', 'text_domain'),
        'items_list_navigation' => __('Items list navigation', 'text_domain'),
        'filter_items_list'     => __('Filter items list', 'text_domain'),
    );
    $args = array(
        'label'                 => __('Topic', 'text_domain'),
        'description'           => __('Topic information pages.', 'text_domain'),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'custom-fields', ),
        'taxonomies'            => array( 'category', 'post_tag' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
    );
    register_post_type('topic', $args);
}
add_action('init', 'topic_post_type', 0);

/**
 * Remove meta box fields
 */
function remove_topic_fields()
{
    remove_meta_box('authordiv', 'topic', 'normal');
    remove_meta_box('commentstatusdiv', 'topic', 'normal');
    remove_meta_box('commentsdiv', 'topic', 'normal');
    remove_meta_box('postcustom', 'topic', 'normal');
    remove_meta_box('slugdiv', 'topic', 'normal');
    remove_meta_box('postexcerpt', 'topic', 'normal');
}
add_action('admin_menu', 'remove_topic_fields');

function remove_topic_side_fields()
{
    remove_meta_box('postimagediv', 'topic', 'side');
    remove_meta_box('tagsdiv-post_tag', 'topic', 'side');
}
add_action('do_meta_boxes', 'remove_topic_side_fields');

/**
 * Remove meta box fields WooCommerce Product
 */
function remove_woo_product_fields()
{
    remove_post_type_support( 'product', 'editor' );
}
add_action('init', 'remove_woo_product_fields');
