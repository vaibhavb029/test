<?php 
/*
Plugin Name: v_Countries
Description: Declares a plugin that will create a custom post type displaying movie reviews.
Version: 1.0
Author: Vaibhav B.
*/

add_action('init', 'create_countries_details');

function create_countries_details(){
	register_post_type('countries_details',
	array(
	'labels' =>array(
					'name' => 'Countries Details',
					'singular_name' =>'Country Detail',
					'add_new' =>'Add New',
					'add_new_item'=>'Add New Countries Details',
					'edit' =>'Edit',
					'edit_item'=>'Edit Countries Details',
					'new_item' =>'New Country Detail',
					'view' =>'View',
					'view_item'=>'View Countries Details',
					'search_items'=>'Serach Countries Details',
					'not_found'=>'No Countries details found',
					'not_found_in_trash'=>'No Countries Details found in trash',
					'parent'=>'Parent Countries Details'
					),
		 'public' =>true,
		 'menu_position'=>15,
		 'supports' =>array('title','editor','comments','thumbnail', 'custom-fields'),
		 'taxonomies' =>array(''),
		 'has_archive' => true
		 )
	);
}



add_action('rest_api_init', function(){
	register_rest_route('https://restcountries.eu/rest/v2/all', array(
				'methods'=> 'GET',
				'callback' =>'my_awesome_func',
	
	));
		
});


function my_awesome_func( WP_REST_Request $request ) {
  // You can access parameters via direct array access on the object:
  $param = $request['some_param'];
  
  // Or via the helper method:
  $param = $request->get_param( 'some_param' );
 
  // You can get the combined, merged set of parameters:
  $parameters = $request->get_params();
 
  // The individual sets of parameters are also available, if needed:
  $parameters = $request->get_url_params();
  $parameters = $request->get_query_params();
  $parameters = $request->get_body_params();
  $parameters = $request->get_json_params();
  $parameters = $request->get_default_params();
 
  // Uploads aren't merged in, but can be accessed separately:
  $parameters = $request->get_file_params();
}
/*add_action('admin_init','my_admin' );

function my_admin(){
	
	add_meta_box('countries_details_meta_box',
				'countries_details_description',
				'display_countries_details_meta_box',
				'countries_details','normal','high'
		);
}

function display_countries_details_meta_box(){ */
	
	
	
	



?>