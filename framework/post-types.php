<?php defined( 'ABSPATH' ) or die( 'Direct access is forbidden!' );

function all_post_types(){
	
// custom post type = car
$labels = array(
	'name'                  => _x( 'Cars', 'Post Type General Name', ZITEC ),
	'singular_name'         => _x( 'Car', 'Post Type Singular Name', ZITEC ),
	'menu_name'             => __( 'Cars', ZITEC ),
	'name_admin_bar'        => __( 'Cars', ZITEC),
	'archives'              => __( 'Cars Archives', ZITEC ),
	'parent_item_colon'     => __( 'Parent Car:', ZITEC ),
	'all_items'             => __( 'All Cars', ZITEC ),
	'add_new_item'          => __( 'Add a new Car', ZITEC ),
	'add_new'               => __( 'Add Car', ZITEC ),
	'new_item'              => __( 'New Car', ZITEC ),
	'edit_item'             => __( 'Edit Car', ZITEC ),
	'update_item'           => __( 'Update Car', ZITEC ),
	'view_item'             => __( 'View Car', ZITEC ),
	'search_items'          => __( 'Search Cars', ZITEC ),
	'not_found'             => __( 'Car not found', ZITEC ),
	'not_found_in_trash'    => __( 'Car not found in trash', ZITEC ),
	'insert_into_item'      => __( 'Add in Cars', ZITEC ),
	'uploaded_to_this_item' => __( 'Upload in Cars', ZITEC ),
	'items_list'            => __( 'Items Project', ZITEC ),
	'items_list_navigation' => __( 'Car list navigation', ZITEC ),
	'filter_items_list'     => __( 'Filter items Cars', ZITEC ),
	
);

$args = array(
	'labels'             => $labels,
	'public'             => true,
	'publicly_queryable' => true,
	'show_ui'            => true,
	'show_in_menu'       => true,
	'query_var'          => true,
	'rewrite'            => array( 'slug' => 'car' ),
	'capability_type'    => 'post',
	'has_archive'        => false,
	'hierarchical'       => false,
	'menu_position'      => 15,
	'menu_icon'           => 'dashicons-car',
	'supports'           => array( 'title' ,'editor' , 'thumbnail' ,  'custom-fields',  'car' ),
);

register_post_type( 'car', $args );
	
	

// fuel taxonomy;
$labels = array(
	'name'              => _x( 'Fuel', ZITEC ),
	'singular_name'     => _x( 'Fuel', ZITEC ),
	'search_items'      => __( 'Search in Fuel', ZITEC),
	'all_items'         => __( 'Add Fuel', ZITEC  ),
	'parent_item'       => __( 'Parent Fuel', ZITEC ),
	'parent_item_colon' => __( 'Parent Fuel:', ZITEC ),
	'edit_item'         => __( 'Edit Fuel', ZITEC ),
	'update_item'       => __( 'Update Fuel de', ZITEC ),
	'add_new_item'      => __( 'Add new Fuel', ZITEC ),
	'new_item_name'     => __( 'Name Fuel', ZITEC ),
	'menu_name'         => __( 'Fuel', ZITEC ),
);

$args = array(
	'hierarchical'      => true,
	'public' 			=> true,
	'labels'            => $labels,
	'show_ui'           => true,
	'show_admin_column' => true,
	'query_var'         => true,
	'has_archive' 		=> false,//true,
	'rewrite'           => array( 'slug' => 'fuel' ),
);
register_taxonomy( 'fuel', array( 'car' ), $args );	

//manufacturer taxonomy;
$labels = array(
	'name'              => _x( 'Manufacturer', ZITEC ),
	'singular_name'     => _x( 'Manufacturer', ZITEC ),
	'search_items'      => __( 'Search in Manufacturer', ZITEC),
	'all_items'         => __( 'Add Manufacturer', ZITEC  ),
	'parent_item'       => __( 'Parent Manufacturer', ZITEC ),
	'parent_item_colon' => __( 'Parent Manufacturer:', ZITEC ),
	'edit_item'         => __( 'Edit Manufacturer', ZITEC ),
	'update_item'       => __( 'Update Manufacturer de', ZITEC ),
	'add_new_item'      => __( 'Add new Manufacturer', ZITEC ),
	'new_item_name'     => __( 'Name Manufacturer', ZITEC ),
	'menu_name'         => __( 'Manufacturer', ZITEC ),
);

$args = array(
	'hierarchical'      => true,
	'public' 			=> true,
	'labels'            => $labels,
	'show_ui'           => true,
	'show_admin_column' => true,
	'query_var'         => true,
	'has_archive' 		=> false,//true,
	'rewrite'           => array( 'slug' => 'manufacturer' ),
);

register_taxonomy( 'manufacturer', array( 'car' ), $args );	

// color taxonomy;
$labels = array(
	'name'              => _x( 'Color', ZITEC ),
	'singular_name'     => _x( 'Color', ZITEC ),
	'search_items'      => __( 'Search in Color', ZITEC),
	'all_items'         => __( 'Add Color', ZITEC  ),
	'parent_item'       => __( 'Parent Color', ZITEC ),
	'parent_item_colon' => __( 'Parent Color:', ZITEC ),
	'edit_item'         => __( 'Edit Color', ZITEC ),
	'update_item'       => __( 'Update Color de', ZITEC ),
	'add_new_item'      => __( 'Add new Color', ZITEC ),
	'new_item_name'     => __( 'Name Color', ZITEC ),
	'menu_name'         => __( 'Color', ZITEC ),
);

$args = array(
	'hierarchical'      => true,
	'public' 			=> true,
	'labels'            => $labels,
	'show_ui'           => true,
	'show_admin_column' => true,
	'query_var'         => true,
	'has_archive' 		=> false,//true,
	'rewrite'           => array( 'slug' => 'color' ),
);
register_taxonomy( 'color', array( 'car' ), $args );	
	
}

add_action( 'init', 'all_post_types', 0 );
