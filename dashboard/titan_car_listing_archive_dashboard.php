<?php



if (current_user_can('administrator')) {



  $query = new WP_Query(array(



    'post_type' => 'car-listing',



    'posts_per_page' => '-1',



    'post_status' => array(



      'publish',



      'draft'



    )



  ));



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



    <div class="car_listing_add_new">



      <a href="<?php echo get_site_url(); ?>/vehicle-listing/" class="dl-compare dl-a-btn">Add new Vehical</a>



    </div>

    <!-- <form class="dl-form" action="#" method="POST" name="titan_filters_form"> -->



    <div class="dl-filter-container">



      <span class="dl-fil-text"> Filters <img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'assets/images/filter.svg' ?>" alt="" width="20px"></span>



      <select class="dl-filter-dashboard" name="titan_car_year" id="ddlAge">



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



      <select class="dl-filter-dashboard" name="titan_car_make" id="ddlAge">



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



      <select class="dl-filter-dashboard" name="titan_car_model" id="ddlAge">







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



      <select class="dl-filter-dashboard" name="titan_car_location" id="ddlAge">



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

      <!-- <div id="titan_refresh_filters_button_dashboard" class="car-listing-refresh"> -->



      <img class="rotate" id="titan_refresh_filters_button_dashboard" src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'assets/images/refresh-icon.svg' ?>" alt="Refresh Filter" width="20px">

      <!-- </div> -->



    </div>



    <!-- </form> -->



    <div id="titan_archieve_posts">



      <table class="car-listing-frontend-table">





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





        <?php



        if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();





            $id = get_the_ID();



            $titan_listing_stock_number = get_post_meta($id, 'titan_listing_stock_number', true);



            $titan_listing_make_name = get_post_meta($id, 'titan_listing_make_name', true);



            $titan_listing_car_model = get_post_meta($id, 'titan_listing_car_model', true);



            $titan_listing_car_making_year = get_post_meta($id, 'titan_listing_car_making_year', true);



            $titan_listing_map_location = get_post_meta($id, 'titan_listing_map_location', true);



            $edit_post = add_query_arg('car-listing', get_the_ID(), get_permalink());



        ?>



            <tr>



              <td><?php echo (empty($titan_listing_stock_number)) ? 'N/A' :  $titan_listing_stock_number;  ?></td>



              <td><?php the_title(); ?></td>

              <td><?php echo (empty($titan_listing_make_name)) ? 'N/A' :  $titan_listing_make_name;  ?></td>

              <td><?php echo (empty($titan_listing_car_model)) ? 'N/A' :  $titan_listing_car_model;  ?></td>

              <td><?php echo (empty($titan_listing_car_making_year)) ? 'N/A' :  $titan_listing_car_making_year;  ?></td>

              <td><?php echo (empty($titan_listing_map_location)) ? 'N/A' :  $titan_listing_map_location;  ?></td>

              <td><?php echo get_post_status($id); ?></td>

              <td class= "listing_delete_edit">



                <a class="dl-compare dl-a-btn" href="<?php echo get_site_url(); ?>/vehicle-listing/?post_id=<?php echo $id; ?>">Edit</a>



                <a class="dl-compare dl-a-btn" onclick="return confirm('Are you sure you wish to delete : <?php echo get_the_title() ?>?')" href="<?php echo get_delete_post_link(get_the_ID()); ?>">Delete</a>



              </td>







            </tr>



        <?php endwhile;



        endif;



        wp_reset_postdata();

        ?>







      </table>



    </div>

  </section>

 <?php



} else {

 $returnPath = array('redirect' => get_site_url() . '/dashboard', 'id_username' => 'user', 'id_password' => 'pass',);

?>

 <div class="titan_car_permission">

  <h1>You don't have permeission to access this page </h1>

  <?php

  wp_login_form($returnPath);

  ?>

 </div>

<?php



 // $html = "";



 // $html .= "



 //     <div class='titan_car_permission'>



 //         <h1>You don't have permeission to access this page </h1>

 //     </div>

 //     <div class='titan_car_login'>

 //     <a href='" .  get_site_url() . "/wp-admin/' class='dl-compare dl-a-btn'>Login</a>

 //     </div>







 // ";

 // echo $html;

}

