<?php

// Register Custom Post Type
function books_post_type() {

	$labels = array(
		'name'                  => _x( 'Books', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Book', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Books', 'text_domain' ),
		'name_admin_bar'        => __( 'Book', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Book:', 'text_domain' ),
		'all_items'             => __( 'All Books', 'text_domain' ),
		'add_new_item'          => __( 'Add New Book', 'text_domain' ),
		'add_new'               => __( 'New Book', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Book', 'text_domain' ),
		'update_item'           => __( 'Update Book', 'text_domain' ),
		'view_item'             => __( 'View Book', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search books', 'text_domain' ),
		'not_found'             => __( 'No books found', 'text_domain' ),
		'not_found_in_trash'    => __( 'No books found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Book', 'text_domain' ),
		'description'           => __( 'Book information pages.', 'text_domain' ),
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
	register_post_type( 'book', $args );

}
add_action( 'init', 'books_post_type', 0 );

/**
 * Remove meta box fields
 */
function remove_book_fields() {
    remove_meta_box( 'authordiv' , 'book' , 'normal' );
		remove_meta_box( 'commentstatusdiv' , 'book' , 'normal' );
		remove_meta_box( 'commentsdiv' , 'book' , 'normal' );
		remove_meta_box( 'postcustom' , 'book' , 'normal' );
		remove_meta_box( 'slugdiv' , 'book' , 'normal' );
}
add_action( 'admin_menu' , 'remove_book_fields' );


/**
 * Show posts of 'post', 'books' post types on home page
 */
add_action( 'pre_get_posts', 'add_my_post_types_to_query' );

function add_my_post_types_to_query( $query ) {
	$my_post_types = array( 'post', 'book' );

  if ( is_home() && $query->is_main_query() )
    $query->set( 'post_type', $my_post_types );
  return $query;
}

?>
