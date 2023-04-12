<?php

/* Template Name: Archive Listing */

get_header();





global $wpdb;



$titan_car_listing_meta_distance = $wpdb->get_results("

	SELECT distinct(meta_value) 

	FROM  $wpdb->postmeta

	WHERE meta_key = 'titan_listing_distance'

	");



// $titan_car_listing_meta_exterior_color = $wpdb->get_results("

// 	SELECT distinct(meta_value) 

// 	FROM  $wpdb->postmeta

// 	WHERE meta_key = 'titan_listing_exterior_color'

// 	");

$titan_car_listing_meta_distance = $wpdb->get_results("

	SELECT distinct(meta_value) 

	FROM  $wpdb->postmeta

	WHERE meta_key = 'titan_listing_distance'

	");



$titan_car_listing_meta_model = $wpdb->get_results("

	SELECT distinct(meta_value) 

	FROM  $wpdb->postmeta

	WHERE meta_key = 'titan_listing_car_model'

	");

$titan_car_listing_car_make = $wpdb->get_results("

	SELECT distinct(meta_value) 

	FROM  $wpdb->postmeta

	WHERE meta_key = 'titan_listing_make_name'

	");



$titan_car_listing_meta_location = $wpdb->get_results("

	SELECT distinct(meta_value) 

	FROM  $wpdb->postmeta

	WHERE meta_key = 'titan_listing_map_location'

	");



// $titan_car_listing_meta_interior_color = $wpdb->get_results("

// 	SELECT distinct(meta_value) 

// 	FROM  $wpdb->postmeta

// 	WHERE meta_key = 'titan_listing_interior_color'

// 	");

// $titan_car_listing_meta_transmission = $wpdb->get_results("

// 	SELECT distinct(meta_value) 

// 	FROM  $wpdb->postmeta

// 	WHERE meta_key = 'titan_listing_transmission'

// 	");

$titan_car_listing_meta_car_making_year = $wpdb->get_results("

	SELECT distinct(meta_value) 

	FROM  $wpdb->postmeta

	WHERE meta_key = 'titan_listing_car_making_year'

	");



$titan_car_listing_meta_car_price = $wpdb->get_results("

	SELECT max(meta_value) as max_value, min(meta_value) as min_value 

	FROM  $wpdb->postmeta

	WHERE meta_key = 'titan_listing_down_payment' and meta_value!=''

	");



$titan_car_listing_meta_car_price_converted = json_decode(json_encode($titan_car_listing_meta_car_price), true);

$titan_car_listing_max_price = $titan_car_listing_meta_car_price_converted[0]['max_value'];

$titan_car_listing_min_price = $titan_car_listing_meta_car_price_converted[0]['min_value'];

$itan_car_listing_min_max_difference = ((int)$titan_car_listing_max_price - (int)$titan_car_listing_min_price) / 10;



if (!empty($titan_car_listing_min_price)) {



	$titan_car_listing_price_range = range($titan_car_listing_min_price, $titan_car_listing_max_price, $itan_car_listing_min_max_difference);

}

$tian_car_listing_popular_searches = get_option('car_listing_popular_searches');







/*filters logic*/

$titan_search_string = '';

$titan_car_listing_mileage_value = '';

$titan_car_listing_price_range_value = 0;

$titan_car_listing_year_value  = 0;

$titan_car_listing_exterior_color_value = '';

$titan_car_listing_interior_color_value = '';

$titan_car_listing_transmission_value = '';

$titan_listing_car_model_value = '';

$titan_listing_car_make_value = '';

$titan_listing_car_location_value = '';

$titan_custom_meta_query = array();







if (isset($_POST['titan_search_submit']) || isset($_POST['titan_filters_submit'])) {



	if (isset($_POST['titan_car_search']) && $_POST['titan_car_search'] != '') {

		$titan_search_string = $_POST['titan_car_search'];

	}



	if (isset($_POST['titan_car_mileage']) && $_POST['titan_car_mileage'] != '') {

		$titan_car_listing_mileage_value = $_POST['titan_car_mileage'];



		array_push($titan_custom_meta_query, array(

			'key' => 'titan_listing_distance',

			'value' => $titan_car_listing_mileage_value,

			'compare' => '=',

		));

	}





	if (isset($_POST['titan_car_price_range']) && $_POST['titan_car_price_range'] != 0) {

		$titan_car_listing_price_range_value = $_POST['titan_car_price_range'];

		array_push($titan_custom_meta_query, array(

			'key' => 'titan_listing_down_payment',

			'value' => $titan_car_listing_price_range_value,

			'compare' => '>=',

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



	if (isset($_POST['titan_listing_car_model']) && $_POST['titan_listing_car_model'] != '') {

		$titan_listing_car_model_value = $_POST['titan_listing_car_model'];

		array_push($titan_custom_meta_query, array(

			'key' => 'titan_listing_car_model',

			'value' => $titan_listing_car_model_value,

			'compare' => '=',

		));

	}



	if (isset($_POST['titan_car_make']) && $_POST['titan_car_make'] != '') {

		$titan_listing_car_make_value = $_POST['titan_car_make'];

		array_push($titan_custom_meta_query, array(

			'key' => 'titan_listing_make_name',

			'value' => $titan_listing_car_make_value,

			'compare' => '=',

		));

	}

	if (isset($_POST['titan_car_location']) && $_POST['titan_car_location'] != '') {

		$titan_listing_car_location_value = $_POST['titan_car_location'];

		array_push($titan_custom_meta_query, array(

			'key' => 'titan_listing_map_location',

			'value' => $titan_listing_car_location_value,

			'compare' => '=',

		));

	}





	if (isset($_POST['titan_car_exterior_color']) && $_POST['titan_car_exterior_color'] != '') {

		$titan_car_listing_exterior_color_value = $_POST['titan_car_exterior_color'];

		array_push($titan_custom_meta_query, array(

			'key' => 'titan_listing_exterior_color',

			'value' => $titan_car_listing_exterior_color_value,

			'compare' => '=',

		));

	}





	if (isset($_POST['titan_car_interior_color']) && $_POST['titan_car_interior_color'] != '') {

		$titan_car_listing_interior_color_value = $_POST['titan_car_interior_color'];

		array_push($titan_custom_meta_query, array(

			'key' => 'titan_listing_interior_color',

			'value' => $titan_car_listing_interior_color_value,

			'compare' => '=',

		));

	}





	if (isset($_POST['titan_car_transmission']) && $_POST['titan_car_transmission'] != '') {

		$titan_car_listing_transmission_value = $_POST['titan_car_transmission'];

		array_push($titan_custom_meta_query, array(

			'key' => 'titan_listing_transmission',

			'value' => $titan_car_listing_transmission_value,

			'compare' => '=',

		));

	}

}

























/*filters logic*/







$paged = get_query_var('paged');



$publications = new WP_Query(

	array(

		'posts_per_page' => -1,

		'post_type' => 'car-listing',

		'paged' => $paged,

		'order_by' => 'ASC',

		'meta_query' => $titan_custom_meta_query,

		's' => $titan_search_string,

	)

);



?>



<section class="dl-archeive-main">

	<!-- <form class="dl-form" action="#" method="POST" name="titan_filters_form"> -->

	<div class="dl-search-container">







		<input type="text" placeholder="Search for.." value="<?php echo $titan_search_string; ?>" name="titan_car_search" id="dl-search-field">

		<input type="text" name="titan_Car_listing_value" id="titan_car_listing_hidden_field" hidden value=" ">





		<button type="button" name="titan_search_submit" class="dl-btn dl-search">Search</button>







		<select name="titan_car_popular" id="dl-popular-searches">



			<option value="Popular Searches" selected>Popular Searches</option>



			<?php

			foreach ($tian_car_listing_popular_searches as $popular_search) {

				if (!empty($popular_search)) {

			?>



					<option value="<?php echo $popular_search; ?>"><?php echo (empty($popular_search)) ? 'No Search Added' :  $popular_search;  ?></option>

			<?php

				}

			}

			?>





		</select>

		<div id="titan_refresh_filters_button" class="car-listing-refresh">

			<img class="rotate" src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'assets/images/refresh-icon.svg' ?>" alt="Refresh Filter" width="20px">

		</div>

	</div>

	<div id="titan_search_suggestions" class="titan_suggestions">



	</div>

	<div class="dl-filter-container">



		<span class="dl-fil-text"> Filters <img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'assets/images/filter.svg' ?>" alt="" width="20px"></span>



		<select class="dl-filter" name="titan_car_mileage" id="ddlCountry">



			<?php



			$titan_mileage_20000 = $wpdb->get_results("SELECT *  FROM wpxm_postmeta JOIN wpxm_posts on wpxm_posts.ID = wpxm_postmeta.post_id WHERE wpxm_postmeta.meta_key LIKE 'titan_listing_distance' AND wpxm_posts.post_status LIKE 'publish' AND meta_value <= 20000");

			$titan_mileage_40000 = $wpdb->get_results("SELECT *  FROM wpxm_postmeta JOIN wpxm_posts on wpxm_posts.ID = wpxm_postmeta.post_id WHERE wpxm_postmeta.meta_key LIKE 'titan_listing_distance' AND wpxm_posts.post_status LIKE 'publish' AND meta_value <= 40000");

			$titan_mileage_60000 = $wpdb->get_results("SELECT *  FROM wpxm_postmeta JOIN wpxm_posts on wpxm_posts.ID = wpxm_postmeta.post_id WHERE wpxm_postmeta.meta_key LIKE 'titan_listing_distance' AND wpxm_posts.post_status LIKE 'publish' AND meta_value <= 60000");

			$titan_mileage_80000 = $wpdb->get_results("SELECT *  FROM wpxm_postmeta JOIN wpxm_posts on wpxm_posts.ID = wpxm_postmeta.post_id WHERE wpxm_postmeta.meta_key LIKE 'titan_listing_distance' AND wpxm_posts.post_status LIKE 'publish' AND meta_value <= 80000");

			$titan_mileage_100000 = $wpdb->get_results("SELECT *  FROM wpxm_postmeta JOIN wpxm_posts on wpxm_posts.ID = wpxm_postmeta.post_id WHERE wpxm_postmeta.meta_key LIKE 'titan_listing_distance' AND wpxm_posts.post_status LIKE 'publish' AND meta_value <= 100000");

			$titan_mileage_over_100000 = $wpdb->get_results("SELECT *  FROM wpxm_postmeta JOIN wpxm_posts on wpxm_posts.ID = wpxm_postmeta.post_id WHERE wpxm_postmeta.meta_key LIKE 'titan_listing_distance' AND wpxm_posts.post_status LIKE 'publish' AND meta_value >= 100000");



			?>



			<option value="0">Mileage</option>

			<option value="20000" <?php echo selected('20000', $titan_car_listing_price_range_value) ?>>Under 20,000 (<?php echo count($titan_mileage_20000); ?>)</option>

			<option value="40000" <?php echo selected('40000', $titan_car_listing_price_range_value) ?>>Under 40,000 (<?php echo count($titan_mileage_40000); ?>)</option>

			<option value="60000" <?php echo selected('60000', $titan_car_listing_price_range_value) ?>>Under 60,000 (<?php echo count($titan_mileage_60000); ?>)</option>

			<option value="80000" <?php echo selected('80000', $titan_car_listing_price_range_value) ?>>Under 80,000 (<?php echo count($titan_mileage_80000); ?>)</option>

			<option value="100000" <?php echo selected('100000', $titan_car_listing_price_range_value) ?>>Under 100,000 (<?php echo count($titan_mileage_100000); ?>)</option>

			<option value="above" <?php echo selected('above', $titan_car_listing_price_range_value) ?>>Over 100,000 (<?php echo count($titan_mileage_over_100000); ?>)</option>

			<?php

			// foreach ($titan_car_listing_meta_distance as $titan_car_distance) {

			// 	if (!empty($titan_car_distance->meta_value)) {

			// 		

			?>







			// <!-- <option value="<?php echo $titan_car_distance->meta_value; ?>" <?php echo selected($titan_car_distance->meta_value, $titan_car_listing_mileage_value) ?>><?php echo $titan_car_distance->meta_value; ?></option> -->

			// <?php

				// 	}

				// }

				?>



		</select>

		<select class="dl-filter" name="titan_car_price_range" id="ddlAge">

			<?php



			$titan_down_payment_2000 = $wpdb->get_results("SELECT *  FROM wpxm_postmeta JOIN wpxm_posts on wpxm_posts.ID = wpxm_postmeta.post_id WHERE wpxm_postmeta.meta_key LIKE 'titan_listing_down_payment' AND wpxm_posts.post_status LIKE 'publish' AND meta_value <= 2000");

			$titan_down_payment_3000 = $wpdb->get_results("SELECT *  FROM wpxm_postmeta JOIN wpxm_posts on wpxm_posts.ID = wpxm_postmeta.post_id WHERE wpxm_postmeta.meta_key LIKE 'titan_listing_down_payment' AND wpxm_posts.post_status LIKE 'publish' AND meta_value <= 3000");

			$titan_down_payment_4000 = $wpdb->get_results("SELECT *  FROM wpxm_postmeta JOIN wpxm_posts on wpxm_posts.ID = wpxm_postmeta.post_id WHERE wpxm_postmeta.meta_key LIKE 'titan_listing_down_payment' AND wpxm_posts.post_status LIKE 'publish' AND meta_value <= 4000");

			$titan_down_payment_5000 = $wpdb->get_results("SELECT *  FROM wpxm_postmeta JOIN wpxm_posts on wpxm_posts.ID = wpxm_postmeta.post_id WHERE wpxm_postmeta.meta_key LIKE 'titan_listing_down_payment' AND wpxm_posts.post_status LIKE 'publish' AND meta_value <= 5000");





			?>



			<option value="">Down Payment</option>



			<option value="2000" <?php echo selected('2000', $titan_car_listing_price_range_value) ?>>Under $2000 (<?php echo count($titan_down_payment_2000); ?>)</option>



			<option value="3000" <?php echo selected('3000', $titan_car_listing_price_range_value) ?>>Under $3000 (<?php echo count($titan_down_payment_3000); ?>)</option>



			<option value="4000" <?php echo selected('4000', $titan_car_listing_price_range_value) ?>>Under $4000 (<?php echo count($titan_down_payment_4000); ?>)</option>



			<option value="5000" <?php echo selected('5000', $titan_car_listing_price_range_value) ?>>Under $5000 (<?php echo count($titan_down_payment_5000); ?>)</option>

			<?php

			// foreach (array_slice($titan_car_listing_price_range, 0, 8) as $titan_car_price_range) {

			// 	if (!empty($titan_car_price_range)) {



			// 		

			?>



			// <!-- <option value="<?php echo $titan_car_price_range; ?>" <?php echo selected($titan_car_price_range, $titan_car_listing_price_range_value) ?>><?php echo $titan_car_price_range; ?> +</option> -->

			// <?php

				// 	}

				// }

				?>



		</select>



		<select class="dl-filter" name="titan_car_year" id="ddlAge">



			<option value="">Year</option>



			<?php

			foreach ($titan_car_listing_meta_car_making_year as $titan_car_making_year) {

				if (!empty($titan_car_making_year->meta_value)) {

			?>



					<option value="<?php echo $titan_car_making_year->meta_value; ?>" <?php echo selected($titan_car_making_year->meta_value, $titan_car_listing_year_value) ?>><?php echo $titan_car_making_year->meta_value; ?></option>

			<?php

				}

			}

			?>





		</select>



		<select class="dl-filter" name="titan_car_make" id="ddlAge">



			<option value="">Make</option>



			<?php

			foreach ($titan_car_listing_car_make as $titan_car_make) {

				if (!empty($titan_car_make->meta_value)) {

			?>



					<option value="<?php echo $titan_car_make->meta_value; ?>" <?php echo selected($titan_car_make->meta_value, $titan_listing_car_make_value) ?>><?php echo $titan_car_make->meta_value; ?></option>

			<?php

				}

			}

			?>



		</select>

		<select class="dl-filter" name="titan_car_model" id="ddlAge">



			<option value="">Model</option>



			<?php

			foreach ($titan_car_listing_meta_model as $titan_car_model) {

				if (!empty($titan_car_model->meta_value)) {

			?>



					<option value="<?php echo $titan_car_model->meta_value; ?>" <?php echo selected($titan_car_model->meta_value, $titan_listing_car_model_value) ?>><?php echo $titan_car_model->meta_value; ?></option>

			<?php

				}

			}

			?>



		</select>

		<select class="dl-filter" name="titan_car_location" id="ddlAge">



			<option value="">Location</option>



			<?php

			foreach ($titan_car_listing_meta_location as $titan_car_location) {

				if (!empty($titan_car_location->meta_value)) {

			?>



					<option value="<?php echo $titan_car_location->meta_value; ?>" <?php echo selected($titan_car_location->meta_value, $titan_listing_car_location_value) ?>><?php echo $titan_car_location->meta_value; ?></option>

			<?php

				}

			}

			?>

		</select>



		<!-- <select class="dl-filter" name="titan_car_exterior_color" id="ddlAge">



				<option value="">Exterior Color </option>



				<?php

				foreach ($titan_car_listing_meta_exterior_color as $titan_car_exterior_color) {

					if (!empty($titan_car_exterior_color->meta_value)) {

				?>



						<option value="<?php echo $titan_car_exterior_color->meta_value; ?>" <?php echo selected($titan_car_exterior_color->meta_value, $titan_car_listing_exterior_color_value) ?>><?php echo $titan_car_exterior_color->meta_value; ?></option>

						<?php

					}

				}

						?>



			</select> -->



		<!-- <select class="dl-filter" name="titan_car_interior_color" id="ddlAge">



				<option value="">Interior Color </option>



				<?php

				foreach ($titan_car_listing_meta_interior_color as $titan_car_interior_color) {

					if (!empty($titan_car_interior_color->meta_value)) {

				?>



						<option value="<?php echo $titan_car_interior_color->meta_value; ?>" <?php echo selected($titan_car_interior_color->meta_value, $titan_car_listing_interior_color_value) ?>><?php echo $titan_car_interior_color->meta_value; ?></option>

						<?php

					}

				}

						?>



			</select> -->



		<!-- <select class="dl-filter" name="titan_car_transmission" id="ddlAge">



				<option value="">Transmission </option>



				<?php

				foreach ($titan_car_listing_meta_transmission as $titan_car_transmission) {

					if (!empty($titan_car_transmission->meta_value)) {

				?>



						<option value="<?php echo $titan_car_transmission->meta_value; ?>" <?php echo selected($titan_car_transmission->meta_value, $titan_car_listing_transmission_value) ?>><?php echo $titan_car_transmission->meta_value; ?></option>

						<?php

					}

				}

						?>

			</select> -->





		<!-- <button type="submit" name="titan_filters_submit" class="dl-btn dl-search">Apply</button> -->





	</div>

	<!-- </form> -->

	<div id="titan_archieve_posts">



		<?php

		if ($publications->have_posts()) :



			while ($publications->have_posts()) : $publications->the_post();

				$post_id = get_the_ID();

				$listing_post_thumbnail = get_the_post_thumbnail_url($post_id, 'full');

				$term_list = wp_get_post_terms($post_id, 'listingtype', array('fields' => 'names'));

				$titan_listing_car_model = get_post_meta($post_id, 'titan_listing_car_model', true);

				$titan_listing_distance = get_post_meta($post_id, 'titan_listing_distance', true);

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

				if (isset($titan_listing_gallery[0]) &&  $titan_listing_gallery[0] != '') {

					$titan_listing_gallery_convert_values = explode(",", $titan_listing_gallery[0]);

				} else {

					$titan_listing_gallery_convert_values = array();

				}





		?>



				<div class="dl-single-car">

					<div class="dl-car-img">



						<div class="carousel" data-flickity='{ "wrapAround": true , "pageDots": false}'>

							<?php

							if (!empty($titan_listing_gallery_convert_values)) {

								foreach ($titan_listing_gallery_convert_values as $titan_listing_value) {

									$titan_listing_gallery_show_all = wp_get_attachment_image_url($titan_listing_value, 'full');       ?>



									<div class="carousel-cell1">





										<div class="dl-titan-car-listing" style="background-image:url('<?php echo $titan_listing_gallery_show_all; ?>');"></div>









									</div>

								<?php



								}

							} else {

								?>

								<div class="carousel-cell1">

									<div class="dl-titan-car-listing" style="background-image:url('<?php echo (empty($listing_post_thumbnail)) ? 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d1/Image_not_available.png/640px-Image_not_available.png' : $listing_post_thumbnail; ?>');"></div>





								</div>

							<?php

							}

							?>



						</div>





						<div class="dl-category-name"><?php echo (empty($term_list[0])) ? "No Category" : $term_list[0]; ?></div>

					</div>



					<div class="dl-car-name">

						<a href="<?php echo $titan_car_listing_link; ?>">

							<h2 class="dl-car-title"><?php the_title(); ?></h2>

						</a>

						<a href="<?php echo $titan_car_listing_link; ?>">

							<p class="dl-car-model"><?php echo (empty($titan_listing_car_model)) ? 'N/A' :  $titan_listing_car_model; ?></p>

							<p class="dl-miles"> <i><img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'assets/images/road-ahead-straight-perspective.png' ?>" width="15px" alt=""></i>

								<span><?php echo (empty($titan_listing_distance)) ? 'N/A' :  $titan_listing_distance; ?> KM</span>

							</p>

						</a>

					</div>





					<div class="dl-payment-type">

						<div class="btn-group">

							<a href="<?php echo $titan_car_listing_link; ?>" class="dl-button dl-down">Down Payments <p class="dl-price">$ <?php echo $titan_listing_payment_format; ?></p> </a>

							<a href="<?php echo $titan_car_listing_link; ?>" class="dl-button dl-weekly">Weekly Payment<p class="dl-price">$ <?php echo $titan_listing_payment_weekly_format; ?></p> </a>



						</div>



					</div>





					<div class="dl-car-details dl-car-archeive">

						<p class="dl-highlights"> <i><img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'assets/images/highlights.svg' ?>" width="15px" alt=""></i> <span>Highlights</span></p>

						<a href="<?php echo $titan_car_listing_link; ?>">

							<p class="dl-details">

								<?php



								if (is_array($titan_car_listing_group)) {

									foreach (array_slice($titan_car_listing_group, 0, 6) as $field) {

								?>

										<span> <?php echo $field['Featurename']; ?></span>

								<?php

									}

								}

								?>



							</p>



						</a>

					</div>

					<div id="outer">

						<div class="inner">

							<a href="<?php echo $titan_listing_buy_now_url; ?>" class="dl-buy dl-a-btn"><?php echo get_option('car_listing_buynow'); ?> </a>

						</div>

						<div class="inner">

							<a href="<?php echo $titan_listing_compare_url; ?>" class="dl-compare dl-a-btn"><?php echo get_option('car_listing_compare'); ?> </a>

						</div>

					</div>

					<!-- <div class="dl-buy-div">



						<a href="<?php echo $titan_listing_buy_now_url; ?>" class="dl-buy dl-a-btn"><?php echo get_option('car_listing_buynow'); ?> </a>



					</div>



					<div class="dl-compare-div">



						<a href="<?php echo $titan_listing_compare_url; ?>" class="dl-compare dl-a-btn"><?php echo get_option('car_listing_compare'); ?> </a>



					</div> -->



				</div>



		<?php

			endwhile;

		endif;

		wp_reset_postdata();

		?>

	</div>

</section>

<?php

get_footer();

?>