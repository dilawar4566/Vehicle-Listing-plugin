<?php



if (current_user_can('administrator')) {







    if (!empty($_GET['post_id'])) {



        $listing_post_id = $_GET['post_id'];
    } else {



        $listing_post_id = '';
    }







    $car_down_pay = 0;



    $car_weekly_pay = 0;



    $car_model = '';



    $car_make = '';



    $car_location = '';



    $car_feature_names = '';



    $car_making_year = 0;



    $car_distance_travel = 0;



    $car_buy_now_url = '';



    $car_compare_url = '';



    $car_exterior_color = '';



    $car_interior_color = '';



    $car_doors = 0;



    $car_body_type = '';



    $car_engine_type = '';



    $titan_listing_media = '';



    $car_no_of_seats = 0;



    $car_highway_mpg = 0;



    $car_city_mpg = 0;



    $car_drivetrain = '';



    $car_transmission = '';



    $car_vin = '';



    $car_stock_number = 0;





    if (isset($_POST['car_down_pay'])) {



        $car_down_pay = $_POST['car_down_pay'];
    }



    if (isset($_POST['car_weekly_pay'])) {



        $car_weekly_pay = $_POST['car_weekly_pay'];
    }



    if (isset($_POST['car_model'])) {



        $car_model = $_POST['car_model'];
    }



    if (isset($_POST['car_make'])) {



        $car_make = $_POST['car_make'];
    }



    if (isset($_POST['car_location'])) {



        $car_location = $_POST['car_location'];
    }



    if (isset($_POST['car_making_year'])) {



        $car_making_year = $_POST['car_making_year'];
    }



    if (isset($_POST['car_feature_names'])) {



        $car_feature_names = $_POST['car_feature_names'];
    }



    if (isset($_POST['car_distance_travel'])) {



        $car_distance_travel = $_POST['car_distance_travel'];
    }



    if (isset($_POST['car_buy_now_url'])) {



        $car_buy_now_url = $_POST['car_buy_now_url'];
    }



    if (isset($_POST['car_compare_url'])) {



        $car_compare_url = $_POST['car_compare_url'];
    }



    if (isset($_POST['car_exterior_color'])) {



        $car_exterior_color = $_POST['car_exterior_color'];
    }



    if (isset($_POST['car_interior_color'])) {



        $car_interior_color = $_POST['car_interior_color'];
    }



    if (isset($_POST['car_doors'])) {



        $car_doors = $_POST['car_doors'];
    }



    if (isset($_POST['car_body_type'])) {



        $car_body_type = $_POST['car_body_type'];
    }



    if (isset($_POST['car_engine_type'])) {



        $car_engine_type = $_POST['car_engine_type'];
    }



    if (isset($_POST['titan_listing_media'])) {



        $titan_listing_media = $_POST['titan_listing_media'];
    }



    if (isset($_POST['car_no_of_seats'])) {



        $car_no_of_seats = $_POST['car_no_of_seats'];
    }



    if (isset($_POST['car_highway_mpg'])) {



        $car_highway_mpg = $_POST['car_highway_mpg'];
    }



    if (isset($_POST['car_city_mpg'])) {



        $car_city_mpg = $_POST['car_city_mpg'];
    }



    if (isset($_POST['car_drivetrain'])) {



        $car_drivetrain = $_POST['car_drivetrain'];
    }



    if (isset($_POST['car_vin'])) {



        $car_vin = $_POST['car_vin'];
    }



    if (isset($_POST['car_transmission'])) {



        $car_transmission = $_POST['car_transmission'];
    }



    if (isset($_POST['car_stock_number'])) {



        $car_stock_number = $_POST['car_stock_number'];
    }





    if (isset($_POST['listing_submit']) || isset($_POST['listing_submit_draft'])) {





        if (isset($_POST['listing_submit'])) {

            $car_listing_status = 'publish';
        }

        if (isset($_POST['listing_submit_draft'])) {

            $car_listing_status = 'draft';
        }



        $car_meta_field = array(





            'titan_listing_down_payment' => $car_down_pay,



            'titan_listing_weekly_payment' => $car_weekly_pay,



            'titan_listing_car_model' => $car_model,



            'titan_listing_make_name' => $car_make,



            'titan_listing_map_location' => $car_location,



            'titan_car_listing_group_meta' => $car_feature_names,



            'titan_listing_car_making_year' => $car_making_year,



            'titan_listing_distance' => $car_distance_travel,



            'titan_listing_buy_now_url' => $car_buy_now_url,



            'titan_listing_compare_url' => $car_compare_url,



            'titan_listing_exterior_color' => $car_exterior_color,



            'titan_listing_interior_color' => $car_interior_color,



            'titan_listing_doors' => $car_doors,



            'titan_listing_body_type' => $car_body_type,



            'titan_listing_engine_type' => $car_engine_type,



            'titan_listing_media' => $titan_listing_media,



            'titan_listing_no_of_seats' => $car_no_of_seats,



            'titan_listing_highway_mpg' => $car_highway_mpg,



            'titan_listing_city_mpg' => $car_city_mpg,



            'titan_listing_drivetrain' => $car_drivetrain,



            'titan_listing_transmission' => $car_transmission,



            'titan_listing_vin' => $car_vin,



            'titan_listing_stock_number' => $car_stock_number



        );





        $arg = array(



            'post_type' => 'car-listing',



            'post_title' => $_POST['car_name'],



            'post_content' => $_POST['car_desc'],



            'post_status' => $car_listing_status,



            'meta_input' => $car_meta_field



        );



        $arg_update = array(





            'ID' => $listing_post_id,



            'post_type' => 'car-listing',



            'post_title' => $_POST['car_name'],



            'post_content' => $_POST['car_desc'],



            'post_status' => $car_listing_status,



            'meta_input' => $car_meta_field



        );



        if ($listing_post_id != '') {



            $post_id = wp_update_post($arg_update);
        } else {





            $post_id = wp_insert_post($arg);
        }







        if (!empty($_FILES['car_feature_img']['tmp_name'])) {



            $upload = wp_upload_bits($_FILES["car_feature_img"]["name"], null, file_get_contents($_FILES["car_feature_img"]["tmp_name"]));



            if (!$upload['error']) {



                $filename = $upload['file'];



                $wp_filetype = wp_check_filetype($filename, null);



                $attachment = array(



                    'post_mime_type' => $wp_filetype['type'],



                    'post_title' => sanitize_file_name($filename),



                    'post_content' => '',



                    'post_status' => 'inherit'



                );



                $attachment_id = wp_insert_attachment($attachment, $filename, $post_id);



                if (!is_wp_error($attachment_id)) {



                    require_once(ABSPATH . 'wp-admin/includes/image.php');



                    $attachment_data = wp_generate_attachment_metadata($attachment_id, $filename);



                    wp_update_attachment_metadata($attachment_id, $attachment_data);



                    set_post_thumbnail($post_id, $attachment_id);
                }
            }
        }











        if (!empty($_FILES['car_gallery_img']['name'][0])) {







            require_once(ABSPATH . 'wp-admin/includes/image.php');



            require_once(ABSPATH . 'wp-admin/includes/file.php');



            require_once(ABSPATH . 'wp-admin/includes/media.php');



            $files = $_FILES['car_gallery_img'];



            $count = 0;



            $galleryImages = array();





            foreach ($files['name'] as $count => $value) {



                if ($files['name'][$count]) {



                    $file = array(



                        'name'     => $files['name'][$count],



                        'type'     => $files['type'][$count],



                        'tmp_name' => $files['tmp_name'][$count],



                        'error'    => $files['error'][$count],



                        'size'     => $files['size'][$count]



                    );



                    $upload_overrides = array('test_form' => false);



                    $upload = wp_handle_upload($file, $upload_overrides);



                    $filename = $upload['file'];



                    $parent_post_id = $post_id;



                    $filetype = wp_check_filetype(basename($filename), null);



                    $wp_upload_dir = wp_upload_dir();





                    $attachment = array(



                        'guid'           => $wp_upload_dir['url'] . '/' . basename($filename),



                        'post_mime_type' => $filetype['type'],



                        'post_title'     => preg_replace('/\.[^.]+$/', '', basename($filename)),



                        'post_content'   => '',



                        'post_status'    => 'inherit'



                    );



                    $attach_id = wp_insert_attachment($attachment, $filename, $parent_post_id);





                    require_once(ABSPATH . 'wp-admin/includes/image.php');



                    $attach_data = wp_generate_attachment_metadata($attach_id, $filename);



                    wp_update_attachment_metadata($attach_id, $attach_data);



                    array_push($galleryImages, $attach_id);
                }





                $count++;



                $galleryImages_to_string = implode(',', $galleryImages);





                if (isset($_POST['titan_listing_media']) && $_POST['titan_listing_media'] != '') {

                    $titan_listing_media = $_POST['titan_listing_media'];

                    $final_attachment_string = $galleryImages_to_string . ',' . $titan_listing_media;
                } else {
                    $final_attachment_string = $galleryImages_to_string;
                }



                update_post_meta($post_id, 'titan_listing_media', $final_attachment_string);
            }
        }







        echo '

              <div id="mycar_listing_popup" class="car_listing_popup">

                    <div class="car_listing_popup-content">

                        <h1 >

                            Your listing is successfully added!

                        </h1>

                    </div>

                </div>

                <script>

                    setTimeout(() => {

                        window.location.href = "' . get_site_url() . '/dashboard/";

                    }, 2000);

                </script>

        ';
    }



    $tian_car_listing_location_type = get_option('car_listing_location_type');



    $car_listing_features_type = get_option('car_listing_features_type');


    $tian_car_listing_body_type = get_option('car_listing_body_type');
?>







    <form id="car_listing_entery" name="car_listing_entery" method="post" action="#" enctype="multipart/form-data">







        <p class="dl-car-listing-form-field">







            <label>Headline</label>







            <input type="text" id="car_name" name="car_name" value=" <?php echo empty($listing_post_id) ? "" : get_the_title($listing_post_id); ?>" required />







        </p>



        <p class="dl-car-listing-form-field">







            <label>Vehicle Make</label>







            <input type="text" id="car_make" name="car_make" value="<?php echo get_post_meta($listing_post_id, 'titan_listing_make_name', true); ?>" />







        </p>



        <p class="dl-car-listing-form-field">







            <label>Vehicle Model</label>







            <input type="text" id="car_model" name="car_model" value="<?php echo get_post_meta($listing_post_id, 'titan_listing_car_model', true); ?>" />







        </p>



        <p class="dl-car-listing-form-field">







            <label>Location</label>



            <select name="car_location" id="car_location">







                <option value="<?php echo get_post_meta($listing_post_id, 'titan_listing_map_location', true); ?>" selected><?php echo get_post_meta($listing_post_id, 'titan_listing_map_location', true); ?></option>







                <?php



                foreach ($tian_car_listing_location_type as $location_type) {



                    if (!empty($location_type)) {



                ?>







                        <option value="<?php echo $location_type; ?>"><?php echo (empty($location_type)) ? 'No Location Added' :  $location_type;  ?></option>



                <?php



                    }
                }



                ?>











            </select>





        </p>



        <p class="dl-car-listing-form-field">







            <label>Vehicle Making Year</label>







            <input type="number" id="car_making_year" name="car_making_year" value="<?php echo get_post_meta($listing_post_id, 'titan_listing_car_making_year', true); ?>" />







        </p>







        <p class="dl-car-listing-form-field">







            <label>Distance Travel(KM)</label>







            <input type="number" id="car_distance_travel" name="car_distance_travel" value="<?php echo get_post_meta($listing_post_id, 'titan_listing_distance', true); ?>" />







        </p>

        <!-- <h2>Vehicle Price</h2> -->







        <p class="dl-car-listing-form-field">







            <label>Vehicle Down Payment($)</label>







            <input type="number" id="car_down_pay" name="car_down_pay" value="<?php echo get_post_meta($listing_post_id, 'titan_listing_down_payment', true) ?>" />







        </p>







        <p class="dl-car-listing-form-field">







            <label>Vehicle Weekly Payment($)</label>







            <input type="number" id="car_weekly_pay" name="car_weekly_pay" value="<?php echo get_post_meta($listing_post_id, 'titan_listing_weekly_payment', true); ?>" />







        </p>



        <!-- <h2>Vehicle Body Details</h2> -->







        <p class="dl-car-listing-form-field">







            <label>Exterior Color</label>







            <input id="car_exterior_color" type="text" name="car_exterior_color" value="<?php echo get_post_meta($listing_post_id, 'titan_listing_exterior_color', true); ?>" />







        </p>







        <p class="dl-car-listing-form-field">







            <label>Interior Color</label>







            <input id="car_interior_color" type="text" name="car_interior_color" value="<?php echo get_post_meta($listing_post_id, 'titan_listing_interior_color', true); ?>" />







        </p>







        <p class="dl-car-listing-form-field">







            <label>Number of Doors</label>







            <input id="car_doors" type="number" name="car_doors" value="<?php echo get_post_meta($listing_post_id, 'titan_listing_doors', true); ?>" />







        </p>





        <p class="dl-car-listing-form-field">







            <label>Number of Seats</label>







            <input id="car_no_of_seats" type="number" name="car_no_of_seats" value="<?php echo get_post_meta($listing_post_id, 'titan_listing_no_of_seats', true); ?>" />







        </p>





        <p class="dl-car-listing-form-field">







            <label>Body Type</label>

            <select name="car_body_type" id="car_body_type">


                <option value="<?php echo get_post_meta($listing_post_id, 'titan_listing_body_type', true); ?>" selected><?php echo get_post_meta($listing_post_id, 'titan_listing_body_type', true); ?></option>


                <?php

                foreach ($tian_car_listing_body_type as $body_type) {

                    if (!empty($body_type)) {
                ?>

                        <option value="<?php echo $body_type; ?>"><?php echo (empty($body_type)) ? 'No Body Type Added' :  $body_type;  ?></option>



                <?php



                    }
                }



                ?>











            </select>






        </p>



        <p class="dl-car-listing-form-field">







            <label>Highway MPG</label>







            <input id="car_highway_mpg" type="number" name="car_highway_mpg" value="<?php echo get_post_meta($listing_post_id, 'titan_listing_highway_mpg', true); ?>" />







        </p>







        <p class="dl-car-listing-form-field">







            <label>City MPG</label>







            <input id="car_city_mpg" type="number" name="car_city_mpg" value="<?php echo get_post_meta($listing_post_id, 'titan_listing_city_mpg', true); ?>" />







        </p>







        <p class="dl-car-listing-form-field">







            <label>Drivetrain</label>







            <input id="car_drivetrain" type="text" name="car_drivetrain" value="<?php echo get_post_meta($listing_post_id, 'titan_listing_drivetrain', true); ?>" />







        </p>







        <p class="dl-car-listing-form-field">







            <label>Transmission</label>







            <input id="car_transmission" type="text" name="car_transmission" value="<?php echo get_post_meta($listing_post_id, 'titan_listing_transmission', true); ?>" />







        </p>







        <p class="dl-car-listing-form-field">







            <label>VIN</label>







            <input id="car_vin" type="text" name="car_vin" value="<?php echo get_post_meta($listing_post_id, 'titan_listing_vin', true); ?>" />







        </p>







        <p class="dl-car-listing-form-field">



            <label>Stock Number</label>



            <input id="car_stock_number" type="number" name="car_stock_number" value="<?php echo get_post_meta($listing_post_id, 'titan_listing_stock_number', true); ?>" />

        </p>



        <!-- <h2>Select Gallery</h2> -->







        <p class="dl-car-listing-form-field">







            <label> Select Feature image</label>







            <input type="file" id="car_feature_img" name="car_feature_img">



            <img src="<?php echo get_the_post_thumbnail_url($listing_post_id); ?>">







        </p>





        <!-- <h2>Vehicle Details</h2> -->

        <!-- <h2>Car Details</h2> -->

        <p class="dl-car-listing-form-field">



            <label>Select Gallery Image</label>

        <div class="upload__box">

            <div class="upload__btn-box">

                <label class="upload__btn">

                    <p>Upload images</p>

                    <input type="file" name="car_gallery_img[]" multiple="" data-max_length="20" class="upload__inputfile">

                </label>

            </div>

            <div class="upload__img-wrap">

                <?php



                $gallery = get_post_meta($listing_post_id, 'titan_listing_media');



                $value = explode(",", $gallery[0]);



                foreach ($value as $image_attachment_id) {



                    $image_attributes = wp_get_attachment_image_url($image_attachment_id, 'full');



                    if ($image_attributes) {

                ?>

                        <div class="upload__img-box">

                            <div style="background-image: url(<?php echo $image_attributes; ?>)" class="img-bg">

                                <div class="upload__img-close" data-attechment-id="<?php echo $image_attachment_id; ?>"></div>

                            </div>

                        </div> <?php



                            }
                        } ?>



                <input type="hidden" class="attechments-ids titan_listing_media" name="titan_listing_media" id="titan_listing_media" value="<?php echo esc_attr(implode(',', $value)); ?>" />



            </div>

        </div>





        </p>



        <p class="dl-car-listing-form-field">





            <label> Highlights </label>

            <!-- start feature -->

            <?php

            $titan_car_listing_group = get_post_meta($listing_post_id, 'titan_car_listing_group_meta', true);

            function titan_listing_compare($val1, $val2)
            {
                return strcmp($val1['Featurename'], $val2['Featurename']);
            }
            if (!empty($titan_car_listing_group)) {

                $titan_listing_unique_val = array_uintersect($titan_car_listing_group, $car_listing_features_type, 'titan_listing_compare');
            }

            ?>


            <select name="car_feature_names[][Featurename]" id="car_feature_tags_name" multiple>
                <?php
                foreach ($titan_listing_unique_val as $feature_save_names) {
                ?>
                    <option selected value="<?php echo $feature_save_names['Featurename']; ?>"><?php echo (empty($feature_save_names['Featurename'])) ? 'No Features Added' :  $feature_save_names['Featurename'];  ?></option>
                    <?php
                }
                foreach ($car_listing_features_type as $element) {
                    if (!in_array($element, $titan_car_listing_group)) {

                    ?>
                        <option value="<?php echo $element['Featurename']; ?>"><?php echo (empty($element['Featurename'])) ? 'No Features Added' :  $element['Featurename'];  ?></option>
                <?php
                    }
                }
                ?>
            </select>

            <!-- end feature -->


        </p>



        <p class="dl-car-listing-form-field">



            <label>Vehicle Description</label>



            <textarea id="car_desc" name="car_desc" rows="12" cols="100"><?php echo empty($listing_post_id) ? "" : get_the_content(null, false, $listing_post_id); ?></textarea>



        </p>



        <p class="dl-car-listing-form-field">



            <label>Buy Now Url</label>



            <input type="url" id="car_buy_now_url" name="car_buy_now_url" value="<?php echo get_post_meta($listing_post_id, 'titan_listing_buy_now_url', true); ?>" />



        </p>







        <p class="dl-car-listing-form-field">







            <label>Compare Url</label>







            <input type="url" id="car_compare_url" name="car_compare_url" value="<?php echo get_post_meta($listing_post_id, 'titan_listing_compare_url', true); ?>" />







        </p>



        <p class="dl-car-listing-form-field titan_save">



            <input class="dl-compare dl-a-btn titan_save" type="submit" name="listing_submit" value="Save" />

            <input class="dl-compare dl-a-btn titan_save" type="submit" name="listing_submit_draft" value="Save as draft" />



        </p>







    </form>



<?php



} else {



    $returnPath = array('redirect' => get_site_url() . '/single', 'id_username' => 'user', 'id_password' => 'pass',);

?>

    <div class="titan_car_permission">

        <h1>You don't have permeission to access this page </h1>

        <?php

        wp_login_form($returnPath);

        ?>

    </div>

<?php



}
