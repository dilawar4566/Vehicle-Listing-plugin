<?php

/*
 * Plugin Name: Titan Car Listing
 *	description: Titan Car Listing Plugin allow you to Create, edit and manage your car listings .
 *	Version: 1.0.0
 *	Author: Mubashar Alee
*/



// Include car listing meta field
require_once(plugin_dir_path(__FILE__) . 'templates/titan_car_listing_meta.php');

add_action('init', 'titan_init_hook');

function titan_init_hook()
{

	add_action("wp_ajax_titan_search_cars", "titan_search_cars");
	add_action("wp_ajax_nopriv_titan_search_cars", "titan_search_cars");
	add_action("wp_ajax_titan_filter_listings", "titan_filter_listings");
	add_action("wp_ajax_nopriv_titan_filter_listings", "titan_filter_listings");
	add_action("wp_ajax_titan_filter_listings_dashboard", "titan_filter_listings_dashboard");
	add_action("wp_ajax_nopriv_titan_filter_listings_dashboard", "titan_filter_listings_dashboard");

}


function titan_search_cars()

{

	$titan_searched_string = '';
	$titan_suggestions_html = '';

	if (isset($_POST['titan_searched_string']) && $_POST['titan_searched_string'] != '') {

		$titan_searched_string = $_POST['titan_searched_string'];

	}

	if ($titan_searched_string == '') {

		echo json_encode('');

	} else {

		$publications = new WP_Query(

			array(

				'posts_per_page' => -1,
				'post_type' => 'car-listing',
				'order_by' => 'ASC',
				's' => $titan_searched_string,

			)

		);

		if ($publications->have_posts() && $titan_searched_string != '') {

			$titan_suggestions_html = '<ul>';
			while ($publications->have_posts()) {
				$publications->the_post();
				$titan_suggestions_html .= '<li data-id="' . get_the_ID() . '">' . get_the_title() . '</li>';

			}

			$titan_suggestions_html .= '</ul>';

		}

		echo json_encode($titan_suggestions_html);

	}

	die();

}

function titan_filter_listings()

{

	$titan_searched_string = '';
	$titan_car_listing_mileage_value = '';
	$titan_car_listing_price_range_value = 0;
	$titan_car_listing_year_value  = 0;
	$titan_car_listing_exterior_color_value = '';
	$titan_car_listing_interior_color_value = '';
	$titan_car_listing_transmission_value = '';
	$titan_custom_meta_query = array();
	$titan_listing_html = '';


	if (isset($_POST['titan_type']) && $_POST['titan_type'] != '') {

		$titan_type = $_POST['titan_type'];

	}



	if (isset($_POST['titan_searched_string']) && $_POST['titan_searched_string'] != '') {

		$titan_searched_string = $_POST['titan_searched_string'];

	}


	if (isset($_POST['titan_car_mileage']) && $_POST['titan_car_mileage'] != '') {





		$titan_car_listing_mileage_value = $_POST['titan_car_mileage'];



		if ($titan_car_listing_mileage_value == 'above') {



			array_push($titan_custom_meta_query, array(



				'key' => 'titan_listing_distance',



				'value' => 10000,



				'compare' => '>=',



				'type'     => 'numeric',



			));

		} else {



			array_push($titan_custom_meta_query, array(



				'key' => 'titan_listing_distance',



				'value' => $titan_car_listing_mileage_value,



				'compare' => '<=',



				'type'     => 'numeric',



			));

		}

	}





	if (isset($_POST['titan_car_price_range']) && $_POST['titan_car_price_range'] != 0) {





		$titan_car_listing_price_range_value = $_POST['titan_car_price_range'];





		array_push($titan_custom_meta_query, array(





			'key' => 'titan_listing_down_payment',



			'value' => $titan_car_listing_price_range_value,



			'compare' => '<=',



			'type'     => 'numeric',

		));

	}





	if (isset($_POST['titan_car_year']) && $_POST['titan_car_year'] != '') {



		$titan_car_listing_year_value = $_POST['titan_car_year'];



		array_push($titan_custom_meta_query, array(



			'key' => 'titan_listing_car_making_year',



			'value' => $titan_car_listing_year_value,



			'compare' => '=',



		));

	}





	if (isset($_POST['titan_car_make']) && $_POST['titan_car_make'] != '') {



		$titan_car_make = $_POST['titan_car_make'];



		array_push($titan_custom_meta_query, array(



			'key' => 'titan_listing_make_name',



			'value' => $titan_car_make,



			'compare' => '=',



		));

	}



	if (isset($_POST['titan_car_model']) && $_POST['titan_car_model'] != '') {



		$titan_car_model = $_POST['titan_car_model'];



		array_push($titan_custom_meta_query, array(



			'key' => 'titan_listing_car_model',



			'value' => $titan_car_model,



			'compare' => '=',



		));

	}





	if (isset($_POST['titan_car_location']) && $_POST['titan_car_location'] != '') {





		$titan_car_location = $_POST['titan_car_location'];



		array_push($titan_custom_meta_query, array(



			'key' => 'titan_listing_map_location',



			'value' => $titan_car_location,



			'compare' => '=',



		));

	}



	// echo json_encode($titan_custom_meta_query);



	// die();





	$paged = get_query_var('paged');





	if ($titan_type == 'all') {



		$publications = new WP_Query(



			array(



				'posts_per_page' => -1,



				'post_type' => 'car-listing',



				'order_by' => 'ASC',



			)

		);

	} else {





		$publications = new WP_Query(



			array(



				'posts_per_page' => -1,



				'post_type' => 'car-listing',



				// 'paged' => $paged,



				'order_by' => 'ASC',



				'meta_query' => $titan_custom_meta_query,



				's' => $titan_searched_string,







			)



		);

	}





	// echo json_encode($_POST);



	// echo json_encode($publications);



	// die();

	//building html



	if ($publications->have_posts()) {



		while ($publications->have_posts()) {



			$publications->the_post();



			$post_id = get_the_ID();





			$listing_post_thumbnail = get_the_post_thumbnail_url($post_id, 'full');



			if (empty($listing_post_thumbnail)) {





				$listing_post_thumbnail = 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d1/Image_not_available.png/640px-Image_not_available.png';

			}





			$term_list = wp_get_post_terms($post_id, 'listingtype', array('fields' => 'names'));





			if (empty($term_list[0])) {





				$term_list[0] = 'No Category';

			}





			$titan_listing_car_model = get_post_meta($post_id, 'titan_listing_car_model', true);





			if (empty($titan_listing_car_model)) {





				$titan_listing_car_model = 'N/A';

			}





			$titan_listing_distance = get_post_meta($post_id, 'titan_listing_distance', true);





			if (empty($titan_listing_distance)) {





				$titan_listing_distance = 'N/A';

			}





			$titan_listing_down_payment = get_post_meta($post_id, 'titan_listing_down_payment', true);



			$titan_listing_payment_empty = (empty($titan_listing_down_payment)) ? "0" :  $titan_listing_down_payment;



			$titan_listing_payment_format = number_format("$titan_listing_payment_empty");



			$titan_listing_weekly_payment = get_post_meta($post_id, 'titan_listing_weekly_payment', true);



			$titan_listing_payment_weekly_empty = (empty($titan_listing_weekly_payment)) ? "0" :  $titan_listing_weekly_payment;



			$titan_listing_payment_weekly_format = number_format("$titan_listing_payment_weekly_empty");



			$titan_car_listing_group = get_post_meta($post_id, 'titan_car_listing_group_meta', true);



			$titan_listing_buy_now_url = get_post_meta($post_id, 'titan_listing_buy_now_url', true);



			$titan_listing_compare_url = get_post_meta($post_id, 'titan_listing_compare_url', true);



			$titan_car_listing_link = get_permalink($post_id);



			$titan_listing_gallery = get_post_meta($post_id, 'titan_listing_media');



			$titan_listing_gallery_convert_values = explode(",", $titan_listing_gallery[0]);





			$titan_listing_html .= '<div class="dl-single-car">



				<div class="dl-car-img">

					<div class="carousel">';



			if ($titan_listing_gallery_convert_values[0] != NULL) {



				foreach ($titan_listing_gallery_convert_values as $titan_listing_value) {



					$titan_listing_gallery_show_all = wp_get_attachment_image_url($titan_listing_value, 'full');



					$titan_listing_html .= '<div class="carousel-cell1">



									<div class="dl-titan-car-listing" style="background-image:url(\'' . $titan_listing_gallery_show_all . '\');"></div>			



									</div>';

				}

			} else {



				$titan_listing_html .= '<div class="carousel-cell1">



									<div class="dl-titan-car-listing" style="background-image:url(\'' . $listing_post_thumbnail . '\');"></div>





								</div>';

			}



			$titan_listing_html .= '</div>





						<div class="dl-category-name">' . $term_list[0] . '</div>







					</div>





					<div class="dl-car-name">







						<a href="' . $titan_car_listing_link . '">







							<h2 class="dl-car-title">' . get_the_title() . '</h2>



						</a>







						<a href="' . $titan_car_listing_link . '">







							<p class="dl-car-model">' . $titan_listing_car_model . '</p>







							<p class="dl-miles"> <i><img src="' . plugin_dir_url(dirname(__FILE__)) . 'titan-car-listing/assets/images/road-ahead-straight-perspective.png" width="15px" alt=""></i>







								<span>' . $titan_listing_distance . ' KM</span>







							</p>





						</a>







					</div>





					<div class="dl-payment-type">







						<div class="btn-group">







							<a href="' . $titan_car_listing_link . '" class="dl-button dl-down">Down Payments <p class="dl-price">$ ' . $titan_listing_payment_format . '</p> </a>







							<a href="' . $titan_car_listing_link . '" class="dl-button dl-weekly">Weekly Payment<p class="dl-price">$ ' . $titan_listing_payment_weekly_format . '</p> </a>





						</div>



					</div>



					<div class="dl-car-details dl-car-archeive">

					<p class="dl-highlights"> <i><img src="' . plugin_dir_url(dirname(__FILE__)) . 'titan-car-listing/assets/images/highlights.svg " width="15px" alt=""></i> <span>Highlights</span></p>



						<a href="' . $titan_car_listing_link . '">



						<p class="dl-details">';







			if (is_array($titan_car_listing_group)) {





				foreach (array_slice($titan_car_listing_group, 0, 6) as $field) {





					$titan_listing_html .= '<span> ' . $field['Featurename'] . '</span>';

				}

			}



			$titan_listing_html .= '</p>





							</a>







					</div>



					<div id="outer">



						<div class="inner">



							<a href="' . $titan_listing_buy_now_url . '" class="dl-buy dl-a-btn">' . get_option('car_listing_buynow') . ' </a>



						</div>



						<div class="inner">





							<a href="' . $titan_listing_compare_url . '" class="dl-compare dl-a-btn">' . get_option('car_listing_compare') . ' </a>





						</div>



					</div>



				</div>';

		}



		echo json_encode($titan_listing_html);

	} else {



		echo json_encode("No Listings");

	}



	die();

}





function titan_filter_listings_dashboard()



{



	$titan_searched_string = '';



	$titan_car_listing_mileage_value = '';



	$titan_car_listing_price_range_value = 0;



	$titan_car_listing_year_value  = 0;



	$titan_car_listing_exterior_color_value = '';



	$titan_car_listing_interior_color_value = '';



	$titan_car_listing_transmission_value = '';



	$titan_custom_meta_query = array();



	$titan_listing_html = '';

	$titan_listing_html = '<table class="car-listing-frontend-table">

	

							<tr>



								<th>Stock Number</th>



								<th>Vehicle Name</th>

						

								<th>Make</th>

						

								<th>Model</th>

						

								<th>Year</th>

						

								<th>Location</th>

						

								<th>Listing Status</th>

						

								<th>Actions</th>



						</tr>

	';







	if (isset($_POST['titan_type']) && $_POST['titan_type'] != '') {







		$titan_type = $_POST['titan_type'];

	}



	if (isset($_POST['titan_searched_string']) && $_POST['titan_searched_string'] != '') {





		$titan_searched_string = $_POST['titan_searched_string'];

	}





	if (isset($_POST['titan_car_mileage']) && $_POST['titan_car_mileage'] != '') {





		$titan_car_listing_mileage_value = $_POST['titan_car_mileage'];



		if ($titan_car_listing_mileage_value == 'above') {



			array_push($titan_custom_meta_query, array(



				'key' => 'titan_listing_distance',



				'value' => 10000,



				'compare' => '>=',



				'type'     => 'numeric',



			));

		} else {



			array_push($titan_custom_meta_query, array(



				'key' => 'titan_listing_distance',



				'value' => $titan_car_listing_mileage_value,



				'compare' => '<=',



				'type'     => 'numeric',



			));

		}

	}





	if (isset($_POST['titan_car_price_range']) && $_POST['titan_car_price_range'] != 0) {





		$titan_car_listing_price_range_value = $_POST['titan_car_price_range'];





		array_push($titan_custom_meta_query, array(





			'key' => 'titan_listing_down_payment',



			'value' => $titan_car_listing_price_range_value,



			'compare' => '<=',



			'type'     => 'numeric',

		));

	}





	if (isset($_POST['titan_car_year']) && $_POST['titan_car_year'] != '') {



		$titan_car_listing_year_value = $_POST['titan_car_year'];



		array_push($titan_custom_meta_query, array(



			'key' => 'titan_listing_car_making_year',



			'value' => $titan_car_listing_year_value,



			'compare' => '=',



		));

	}





	if (isset($_POST['titan_car_make']) && $_POST['titan_car_make'] != '') {



		$titan_car_make = $_POST['titan_car_make'];



		array_push($titan_custom_meta_query, array(



			'key' => 'titan_listing_make_name',



			'value' => $titan_car_make,



			'compare' => '=',



		));

	}



	if (isset($_POST['titan_car_model']) && $_POST['titan_car_model'] != '') {



		$titan_car_model = $_POST['titan_car_model'];



		array_push($titan_custom_meta_query, array(



			'key' => 'titan_listing_car_model',



			'value' => $titan_car_model,



			'compare' => '=',



		));

	}





	if (isset($_POST['titan_car_location']) && $_POST['titan_car_location'] != '') {





		$titan_car_location = $_POST['titan_car_location'];



		array_push($titan_custom_meta_query, array(



			'key' => 'titan_listing_map_location',



			'value' => $titan_car_location,



			'compare' => '=',



		));

	}



	// echo json_encode($titan_custom_meta_query);



	// die();





	$paged = get_query_var('paged');





	if ($titan_type == 'all') {



		$publications = new WP_Query(



			array(



				'posts_per_page' => -1,



				'post_type' => 'car-listing',



				'order_by' => 'ASC',



			)

		);

	} else {





		$publications = new WP_Query(



			array(



				'posts_per_page' => -1,



				'post_type' => 'car-listing',



				// 'paged' => $paged,



				'order_by' => 'ASC',



				'meta_query' => $titan_custom_meta_query,



				's' => $titan_searched_string,







			)



		);

	}





	// echo json_encode($_POST);



	// echo json_encode($publications);



	// die();

	//building html



	if ($publications->have_posts()) {



		while ($publications->have_posts()) {



			$publications->the_post();



			$post_id = get_the_ID();





			$titan_listing_make_name =  get_post_meta($post_id, 'titan_listing_make_name', true);



			if (empty($titan_listing_make_name)) {





				$titan_listing_make_name = 'N/A';

			}





			$titan_listing_car_making_year =  get_post_meta($post_id, 'titan_listing_car_making_year', true);





			if (empty($titan_listing_car_making_year)) {





				$titan_listing_car_making_year = 'N/A';

			}





			$titan_listing_car_model = get_post_meta($post_id, 'titan_listing_car_model', true);





			if (empty($titan_listing_car_model)) {





				$titan_listing_car_model = 'N/A';

			}





			$titan_listing_map_location = get_post_meta($post_id, 'titan_listing_map_location', true);





			if (empty($titan_listing_map_location)) {





				$titan_listing_map_location = 'N/A';

			}







			$titan_listing_stock_number = get_post_meta($post_id, 'titan_listing_stock_number', true);



			if (empty($titan_listing_stock_number)) {





				$titan_listing_stock_number = 'N/A';

			}





			$titan_listing_down_payment = get_post_meta($post_id, 'titan_listing_down_payment', true);



			$titan_listing_payment_empty = (empty($titan_listing_down_payment)) ? "0" :  $titan_listing_down_payment;



			$titan_listing_payment_format = number_format("$titan_listing_payment_empty");



			$titan_listing_weekly_payment = get_post_meta($post_id, 'titan_listing_weekly_payment', true);



			$titan_listing_payment_weekly_empty = (empty($titan_listing_weekly_payment)) ? "0" :  $titan_listing_weekly_payment;



			$titan_listing_payment_weekly_format = number_format("$titan_listing_payment_weekly_empty");



			$titan_car_listing_group = get_post_meta($post_id, 'titan_car_listing_group_meta', true);



			$titan_listing_buy_now_url = get_post_meta($post_id, 'titan_listing_buy_now_url', true);



			$titan_car_listing_link = get_permalink($post_id);



			$titan_listing_gallery = get_post_meta($post_id, 'titan_listing_media');



			$titan_listing_gallery_convert_values = explode(",", $titan_listing_gallery[0]);



			$titan_listing_html .= '



					<tr>

						<td> ' . $titan_listing_stock_number . ' </td>



						<td> ' . get_the_title() . ' </td>



						<td> ' . $titan_listing_make_name . ' </td>



						<td> ' . $titan_listing_car_model . ' </td>



						<td> ' . $titan_listing_car_making_year . ' </td>



						<td> ' . $titan_listing_map_location . ' </td>



						<td> ' . get_post_status($post_id) . ' </td>

						

						<td class= "listing_delete_edit">

							<a class="dl-compare dl-a-btn" href="' . get_site_url() . '/vehicle-listing/?post_id=' . $post_id . '">Edit</a>



							<a class="dl-compare dl-a-btn" onclick ="return confirm(\"Are you sure you wish to delete :' . get_the_title() . '?\")" href="' . get_delete_post_link(get_the_ID()) . '">Delete</a>



			  

							

						</td>







					</tr>



					



			';

		}

		$titan_listing_html .= '</table>';



		echo json_encode($titan_listing_html);

	} else {



		echo json_encode("No Listings");

	}



	die();

}





add_action('admin_enqueue_scripts', 'titan_admin_scripts');



function titan_admin_scripts()

{



	wp_enqueue_script('titan-car-listing-js', plugins_url('/assets/js/titan-car-listing.js', __FILE__), array(), '1.0');



	wp_register_style('titan-car-listing-style', plugins_url('assets/css/titan-car-listing-admin.css', __FILE__));



	wp_enqueue_script('titan-car-listing-scripts', plugins_url('assets/js/titan-car-listing-admin.js', __FILE__));

}



add_action('wp_enqueue_scripts', 'titan_all_scripts');



function titan_all_scripts()



{



	wp_register_script('titan-car-listing-js', plugins_url('/assets/js/titan-car-listing.js', __FILE__));



	wp_register_script('titan-car-listing-media-js', plugins_url('/assets/js/titan-car-listing-admin.js', __FILE__));



	wp_localize_script('titan-car-listing-js', 'titanAjax', array('ajaxurl' => admin_url('admin-ajax.php')));



	wp_register_style('titan-car-listing-css', plugins_url('assets/css/titan-car-listing-style.css', __FILE__));



	wp_register_style('titan-car-listing-media-css', plugins_url('assets/css/titan-car-listing-admin.css', __FILE__));



	wp_register_style('titan-car-listing-flickity-slider-css', plugins_url('assets/css/titan-car-slider.css', __FILE__));



	wp_enqueue_script('titan-car-listing-flickity-slider-js', plugins_url('assets/js/titan-car-slider.js', __FILE__));



	wp_register_style( 'titan_car_listing_select_two_css', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css' );



	wp_register_script('titan_car_listing_select_two', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js', null, null, true);

}





//Register car listing post type 





function titan_car_listing_posttype()



{



	register_post_type(



		'car-listing',



		array(



			'labels' => array(



				'name' => __('Car Listings'),



				'singular_name' => __('Car Listing')



			),



			'public' => true,



			'has_archive' => true,



			'menu_icon'   => 'dashicons-car',



			'rewrite' => array('slug' => 'car-listing'),



			'show_in_rest' => true,



			'supports'            => array('title', 'editor', 'excerpt', 'thumbnail'),



			'taxonomies'          => array('listing-type', 'Vehicle Features'),



		)



	);

}







add_action('init', 'titan_car_listing_posttype');



// Create toxonomy News Type



add_action('init', 'titan_car_listing_taxonomy', 0);



function titan_car_listing_taxonomy()



{





	$labels = array(



		'name' => _x('Listing Type', 'taxonomy general name'),



		'singular_name' => _x('Listing Type', 'taxonomy singular name'),



		'search_items' =>  __('Search Listing Type'),



		'all_items' => __('All Listing Type'),



		'parent_item' => __('Parent Listing Type'),



		'parent_item_colon' => __('Parent Listing Type:'),



		'edit_item' => __('Edit Listing'),



		'update_item' => __('Update Listing Type'),



		'add_new_item' => __('Add New Listing Type'),



		'new_item_name' => __('New Listing Type Name'),



		'menu_name' => __('Listing Type'),



	);



	// Now register the taxonomy



	register_taxonomy('listingtype', array('car-listing'), array(



		'hierarchical' => true,



		'labels' => $labels,



		'show_ui' => true,



		'show_in_rest' => true,



		'show_admin_column' => true,



		'query_var' => true,



		'rewrite' => array('slug' => 'listingtype'),



	));

}



// Create toxonomy News Type



add_action('init', 'titan_car_listing_features', 0);



function titan_car_listing_features()



{





	$labels = array(



		'name' => _x('Vehicle Features', 'taxonomy general name'),



		'singular_name' => _x('Vehicle Features', 'taxonomy singular name'),



		'search_items' =>  __('Search Vehicle Features'),



		'all_items' => __('All Vehicle Features'),



		'parent_item' => __('Parent Vehicle Features'),



		'parent_item_colon' => __('Parent Vehicle Features:'),



		'edit_item' => __('Edit Listing'),



		'update_item' => __('Update Vehicle Features'),



		'add_new_item' => __('Add New Vehicle Features'),



		'new_item_name' => __('New Vehicle Features Name'),



		'menu_name' => __('Vehicle Features'),



	);



	// Now register the taxonomy



	register_taxonomy('vehicle_features', array('car-listing'), array(



		'hierarchical' => true,



		'labels' => $labels,



		'show_ui' => true,



		'show_in_rest' => true,



		'show_admin_column' => true,



		'query_var' => true,



		'rewrite' => array('slug' => 'vehicle_features'),



	));

}



// titan car listing archeive page shortcode start





add_shortcode('archeive_listing', 'titan_listing_archeive');



function titan_listing_archeive()





{



	wp_enqueue_script('titan-car-listing-js');



	wp_enqueue_style('titan-car-listing-css');



	ob_start();



	include_once(plugin_dir_path(__FILE__) . 'templates/titan_car_listing_archive.php');



	return ob_get_clean();

}



// titan car listing archeive page shortcode end





// titan car listing dashboard archeive page shortcode start





add_shortcode('car_listing_dashboard', 'titan_car_listing_dashboard');



function titan_car_listing_dashboard()



{



	wp_enqueue_script('titan-car-listing-js');



	wp_enqueue_style('titan-car-listing-css');



	ob_start();



	include_once(plugin_dir_path(__FILE__) . 'dashboard/titan_car_listing_archive_dashboard.php');



	return ob_get_clean();

}



// titan car listing dashboard archeive page shortcode end





// titan car listing dashboard single page shortcode start



add_shortcode('vehicle_listing', 'titan_car_listing_insert_dashboard');



function titan_car_listing_insert_dashboard()



{



	wp_enqueue_script('titan-car-listing-js');



	wp_enqueue_script('titan-car-listing-media-js');



	wp_enqueue_style('titan-car-listing-css');



	

	wp_enqueue_style('titan_car_listing_select_two_css');





	wp_enqueue_script('titan_car_listing_select_two');



	wp_enqueue_style('titan-car-listing-media-css');



	ob_start();



	include_once(plugin_dir_path(__FILE__) . 'dashboard/titan_car_listing_insert_form.php');



	return ob_get_clean();

}



// titan car listing dashboard single page shortcode end





//Car Listing Setting page Start





add_action('admin_menu', 'titan_car_listing_settings');



function titan_car_listing_settings()



{

	add_submenu_page(



		'edit.php?post_type=car-listing',



		'Car Listing Setting Admin',



		'Listings Setting',



		'edit_posts',



		basename(__FILE__),



		'titan_car_listing_setting'



	);

}



// Car Listing Call back function 



function titan_car_listing_setting()



{



	include_once(plugin_dir_path(__FILE__) . 'templates/titan_car_listing_setting.php');

}





//Car Listing Setting page end



// single post page create start



function titan_add_vehicle_listing_page()



{



	// Create post object



	$my_post = array(



		'post_title'    => wp_strip_all_tags('Vehicle listing'),



		'post_content'  => '[vehicle_listing]',



		'post_status'   => 'publish',



		'post_author'   => 1,



		'post_type'     => 'page',



	);







	// Insert the post into the database



	if (get_page_by_title('Vehicle listing') == NULL) {



		wp_insert_post($my_post);

	}

}





register_activation_hook(__FILE__, 'titan_add_vehicle_listing_page');



// single post page create end





add_filter('single_template', 'titan_car_listing_single_template');





function titan_car_listing_single_template($titan_Car_listing_single)



{



	global $post;



	if ($post->post_type == 'car-listing') {



		wp_enqueue_script('jquery');



		wp_enqueue_style('titan-car-listing-css');



		wp_enqueue_style('titan-car-listing-flickity-slider-css');



		wp_enqueue_script('titan-car-listing-flickity-slider-js');



		wp_enqueue_script('titan-car-listing-js');



		$titan_Car_listing_single = plugin_dir_path(__FILE__) . 'templates/titan_car_listing_single.php';

	}



	return $titan_Car_listing_single;

}



add_filter('archive_template', 'titan_car_listing_archive_template');





function titan_car_listing_archive_template($titan_car_listing_archive)



{



	global $post;





	if ($post->post_type == 'car-listing') {



		wp_enqueue_script('jquery');



		wp_enqueue_script('titan-car-listing-js');



		wp_enqueue_style('titan-car-listing-flickity-slider-css');



		wp_enqueue_script('titan-car-listing-flickity-slider-js');



		wp_enqueue_style('titan-car-listing-css');



		$titan_car_listing_archive = plugin_dir_path(__FILE__) . 'templates/titan_car_listing_archive.php';

	}

	return $titan_car_listing_archive;

}

