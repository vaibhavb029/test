<?php
/**
 * Post Types
 *
 * Registers post types and taxonomies.
 *
 * @class    FT_Post_Types
 * @version  1.0.0
 * @package  FlashToolkit/Classes/Portfolio
 * @category Class
 * @author   ThemeGrill
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * FT_Post_Types Class
 */
class FT_Post_Types {

	/**
	 * Hook in methods.
	 */
	public static function init() {
		add_action( 'init', array( __CLASS__, 'register_taxonomies' ), 5 );
		add_action( 'init', array( __CLASS__, 'register_post_types' ), 5 );
		add_action( 'init', array( __CLASS__, 'support_jetpack_omnisearch' ) );
		add_filter( 'rest_api_allowed_post_types', array( __CLASS__, 'rest_api_allowed_post_types' ) );
		add_action( 'flash_toolkit_flush_rewrite_rules', array( __CLASS__, 'flush_rewrite_rules' ) );
	}

	/**
	 * Register core taxonomies.
	 */
	public static function register_taxonomies() {
		if ( ! is_blog_installed() || taxonomy_exists( 'portfolio_cat' ) ) {
			return;
		}

		do_action( 'flash_toolkit_register_taxonomy' );

		$permalinks = flash_get_permalink_structure();

		register_taxonomy( 'portfolio_cat',
			apply_filters( 'flash_toolkit_taxonomy_objects_portfolio_cat', array( 'portfolio' ) ),
			apply_filters( 'flash_toolkit_taxonomy_args_portfolio_cat', array(
				'hierarchical' => true,
				'label'        => __( 'Categories', 'flash-toolkit' ),
				'labels'       => array(
						'name'              => __( 'Project Categories', 'flash-toolkit' ),
						'singular_name'     => __( 'Category', 'flash-toolkit' ),
						'menu_name'         => _x( 'Categories', 'Admin menu name', 'flash-toolkit' ),
						'search_items'      => __( 'Search Categories', 'flash-toolkit' ),
						'all_items'         => __( 'All Categories', 'flash-toolkit' ),
						'parent_item'       => __( 'Parent Category', 'flash-toolkit' ),
						'parent_item_colon' => __( 'Parent Category:', 'flash-toolkit' ),
						'edit_item'         => __( 'Edit Category', 'flash-toolkit' ),
						'update_item'       => __( 'Update Category', 'flash-toolkit' ),
						'add_new_item'      => __( 'Add New Category', 'flash-toolkit' ),
						'new_item_name'     => __( 'New Category Name', 'flash-toolkit' ),
						'not_found'         => __( 'No categories found', 'flash-toolkit' ),
					),
				'show_ui'      => true,
				'query_var'    => true,
				'capabilities' => array(
					'manage_terms' => 'manage_portfolio_terms',
					'edit_terms'   => 'edit_portfolio_terms',
					'delete_terms' => 'delete_portfolio_terms',
					'assign_terms' => 'assign_portfolio_terms',
				),
				'rewrite'      => array(
					'slug'         => $permalinks['category_rewrite_slug'],
					'with_front'   => false,
					'hierarchical' => true,
				),
			) )
		);

		register_taxonomy( 'portfolio_tag',
			apply_filters( 'flash_toolkit_taxonomy_objects_portfolio_tag', array( 'portfolio' ) ),
			apply_filters( 'flash_toolkit_taxonomy_args_portfolio_tag', array(
				'hierarchical' => false,
				'label'        => __( 'Tags', 'flash-toolkit' ),
				'labels'       => array(
						'name'                       => __( 'Project Tags', 'flash-toolkit' ),
						'singular_name'              => __( 'Tag', 'flash-toolkit' ),
						'menu_name'                  => _x( 'Tags', 'Admin menu name', 'flash-toolkit' ),
						'search_items'               => __( 'Search Tags', 'flash-toolkit' ),
						'all_items'                  => __( 'All Tags', 'flash-toolkit' ),
						'edit_item'                  => __( 'Edit Tag', 'flash-toolkit' ),
						'update_item'                => __( 'Update Tag', 'flash-toolkit' ),
						'add_new_item'               => __( 'Add New Tag', 'flash-toolkit' ),
						'new_item_name'              => __( 'New Tag Name', 'flash-toolkit' ),
						'popular_items'              => __( 'Popular Tags', 'flash-toolkit' ),
						'separate_items_with_commas' => __( 'Separate Tags with commas', 'flash-toolkit' ),
						'add_or_remove_items'        => __( 'Add or remove Tags', 'flash-toolkit' ),
						'choose_from_most_used'      => __( 'Choose from the most used tags', 'flash-toolkit' ),
						'not_found'                  => __( 'No tags found', 'flash-toolkit' ),
					),
				'show_ui'      => true,
				'query_var'    => true,
				'capabilities' => array(
					'manage_terms' => 'manage_portfolio_terms',
					'edit_terms'   => 'edit_portfolio_terms',
					'delete_terms' => 'delete_portfolio_terms',
					'assign_terms' => 'assign_portfolio_terms',
				),
				'rewrite'      => array(
					'slug'       => $permalinks['tag_rewrite_slug'],
					'with_front' => false
				),
			) )
		);

		do_action( 'flash_toolkit_after_register_taxonomy' );
	}

	/**
	 * Register core post types.
	 */
	public static function register_post_types() {
		if ( ! is_blog_installed() || post_type_exists( 'portfolio' ) ) {
			return;
		}

		do_action( 'flash_toolkit_register_post_type' );

		$permalinks = flash_get_permalink_structure();

		register_post_type( 'portfolio',
			apply_filters( 'flash_toolkit_register_post_type_portfolio',
				array(
					'labels'              => array(
							'name'                  => __( 'Projects', 'flash-toolkit' ),
							'singular_name'         => __( 'Project', 'flash-toolkit' ),
							'menu_name'             => _x( 'Portfolio', 'Admin menu name', 'flash-toolkit' ),
							'all_items'             => __( 'All Projects', 'flash-toolkit' ),
							'add_new'               => __( 'Add Project', 'flash-toolkit' ),
							'add_new_item'          => __( 'Add New Project', 'flash-toolkit' ),
							'edit'                  => __( 'Edit', 'flash-toolkit' ),
							'edit_item'             => __( 'Edit Project', 'flash-toolkit' ),
							'new_item'              => __( 'New Project', 'flash-toolkit' ),
							'view'                  => __( 'View Project', 'flash-toolkit' ),
							'view_item'             => __( 'View Project', 'flash-toolkit' ),
							'search_items'          => __( 'Search Projects', 'flash-toolkit' ),
							'not_found'             => __( 'No Projects found', 'flash-toolkit' ),
							'not_found_in_trash'    => __( 'No Projects found in trash', 'flash-toolkit' ),
							'parent'                => __( 'Parent Project', 'flash-toolkit' ),
							'featured_image'        => __( 'Project Image', 'flash-toolkit' ),
							'set_featured_image'    => __( 'Set project image', 'flash-toolkit' ),
							'remove_featured_image' => __( 'Remove project image', 'flash-toolkit' ),
							'use_featured_image'    => __( 'Use as project image', 'flash-toolkit' ),
							'insert_into_item'      => __( 'Insert into project', 'flash-toolkit' ),
							'uploaded_to_this_item' => __( 'Uploaded to this project', 'flash-toolkit' ),
							'filter_items_list'     => __( 'Filter Projects', 'flash-toolkit' ),
							'items_list_navigation' => __( 'Projects navigation', 'flash-toolkit' ),
							'items_list'            => __( 'Projects list', 'flash-toolkit' ),
						),
					'description'         => __( 'This is where you can add new portfolio items to your project.', 'flash-toolkit' ),
					'public'              => true,
					'show_ui'             => true,
					'capability_type'     => 'portfolio',
					'map_meta_cap'        => true,
					'publicly_queryable'  => true,
					'exclude_from_search' => false,
					'hierarchical'        => false,
					'query_var'           => true,
					'menu_icon'           => 'dashicons-portfolio',
					'rewrite'             => $permalinks['portfolio_rewrite_slug'] ? array( 'slug' => untrailingslashit( $permalinks['portfolio_rewrite_slug'] ), 'with_front' => false, 'feeds' => true ) : false,
					'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'comments', 'author', 'custom-fields', 'page-attributes', 'publicize', 'wpcom-markdown' ),
					'has_archive'         => $permalinks['portfolio_has_archive'],
					'show_in_nav_menus'   => true
				)
			)
		);
	}

	/**
	 * Add Portfolio Support to Jetpack Omnisearch.
	 */
	public static function support_jetpack_omnisearch() {
		if ( class_exists( 'Jetpack_Omnisearch_Posts' ) ) {
			new Jetpack_Omnisearch_Posts( 'portfolio' );
		}
	}

	/**
	 * Added portfolio for Jetpack related posts.
	 * @param  array $post_types
	 * @return array
	 */
	public static function rest_api_allowed_post_types( $post_types ) {
		$post_types[] = 'portfolio';

		return $post_types;
	}

	/**
	 * Flush rewrite rules.
	 */
	public static function flush_rewrite_rules() {
		flush_rewrite_rules();
	}
}

FT_Post_Types::init();
