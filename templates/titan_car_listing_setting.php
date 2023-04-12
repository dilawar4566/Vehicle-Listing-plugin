<?php











if (isset($_POST['submit'])) {











    $buynow = sanitize_text_field($_POST['buynow']);





    $compare = $_POST['compare'];





    update_option('car_listing_buynow', $buynow);





    update_option('car_listing_compare', $compare);

}











if (isset($_POST['popularsubmit'])) {











    $titan_popular_searches = $_POST['popularsearches'];





    update_option('car_listing_popular_searches', $titan_popular_searches);

}





if (isset($_POST['location_type'])) {



print_r($_POST);

    $titan_location_type = $_POST['car_feature_names'];





    update_option('car_listing_location_type', $titan_location_type);

}





if (isset($_POST['features_type'])) {



    $titan_features_type = $_POST['car_feature_names'];





    update_option('car_listing_features_type', $titan_features_type);

}

if (isset($_POST['body_type'])) {



    $titan_body_type = $_POST['bodytype'];





    update_option('car_listing_body_type', $titan_body_type);

}









?>





<section>





    <div class="car-setting-container">





        <h2>Change Button Text</h2>





        <form action="#" method="post">





            <label for="buynow">Buy Now Button:</label><br>





            <input type="text" id="titan-buy-now" name="buynow" value="<?php echo get_option('car_listing_buynow'); ?>"><br>





            <label for="compare">Compare Button:</label><br>





            <input type="text" id="titan-compare-now" name="compare" value="<?php echo get_option('car_listing_compare'); ?>"><br><br>





            <input class="titan-car-listing-button update" type="submit" name="submit" value="Update">





        </form>





    </div>





</section>





<div class="car-setting-container">



    <h2>Add or Delete Popular Searches</h2>

    <form method="post" action="#">

        <div class="wrapper">

            <?php

            $tian_car_listing_popular_searches = get_option('car_listing_popular_searches');



            if (!empty($tian_car_listing_popular_searches)) {



                foreach ($tian_car_listing_popular_searches as $popular_search) {

            ?>

                    <div>

                        <input type="text" name="popularsearches[]" value="<?php echo (empty($popular_search)) ? 'No Search Added' :  $popular_search;  ?>" placeholder="Input Text Here" /><a href="javascript:void(0);" class="remove_field titan-car-listing-button">Remove</a>



                    </div>



            <?php

                }

            }

            ?>

            <div>

            </div>

        </div>



        <p><button class="add_fields titan-car-listing-button">Add More Popular Searches</button></p>

        <input class="titan-car-listing-button submit-car" type="submit" name="popularsubmit" value="Save" />



    </form>



</div>





<script>

    jQuery(document).ready(function() {



        var max_fields = 10;

        var wrapper = jQuery(".wrapper");

        var add_button = jQuery(".add_fields");

        var x = 1;

        jQuery(add_button).click(function(e) {



            e.preventDefault();



            if (x < max_fields) {

                x++;



                jQuery(wrapper).append('<div><input type="text" name="popularsearches[]" placeholder="Input Text Here" /> <a href="javascript:void(0);" class="remove_field titan-car-listing-button">Remove</a></div>');



            }

        });



        jQuery(wrapper).on("click", ".remove_field", function(e) {



            e.preventDefault();

            jQuery(this).parent('div').remove();

            x--;

        })

    });

</script>





<!-- start location -->



<div class="vehicle_location_container">



    <h2>Add Location</h2>

    <form method="post" action="#">

        <div class="wrapper_location">

            <?php

            $tian_car_listing_location_type = get_option('car_listing_location_type');



            if (!empty($tian_car_listing_location_type)) {



                foreach ($tian_car_listing_location_type as $location_type) {

            ?>

                    <div>

                        <input type="text" name="locationtype[]" value="<?php echo (empty($location_type)) ? 'No Location Added' :  $location_type;  ?>" placeholder="Type Location Here" /><a href="javascript:void(0);" class="remove_field_location titan-car-listing-button">Remove</a>



                    </div>



            <?php

                }

            }

            ?>

            <div>

            </div>

        </div>



        <p><button class="add_fields_location titan-car-listing-button">Add More Location</button></p>

        <input class="titan-car-listing-button listing_location_type" type="submit" name="location_type" value="Save" />



    </form>



</div>





<script>

    jQuery(document).ready(function() {



        var location_max_fields = 30;

        var wrapper_location = jQuery(".wrapper_location");

        var add_button_location = jQuery(".add_fields_location");

        var y = 1;

        jQuery(add_button_location).click(function(e) {



            e.preventDefault();



            if (y < location_max_fields) {

                y++;



                jQuery(wrapper_location).append('<div><input type="text" name="locationtype[]" placeholder="Type Location Here" /> <a href="javascript:void(0);" class="remove_field_location titan-car-listing-button">Remove</a></div>');



            }

        });



        jQuery(wrapper).on("click", ".remove_field_location", function(e) {



            e.preventDefault();

            jQuery(this).parent('div').remove();

            y--;

        })

    });

</script>

<!-- end location -->



<!-- start Features -->



<div class="vehicle_features_container">



    <h2>Add vehicle features</h2>

    <form method="post" action="#">

        <div class="wrapper_features">

            <?php

            $tian_car_listing_features_type = get_option('car_listing_features_type');



            if (!empty($tian_car_listing_features_type)) {



                foreach ($tian_car_listing_features_type as $features_type) {

            ?>

                    <div>

                        <input type="text" name="car_feature_names[][Featurename]" value="<?php echo (empty($features_type['Featurename'])) ? 'No features Added' :  $features_type['Featurename'];  ?>" placeholder="Type features Here" /><a href="javascript:void(0);" class="remove_field_features titan-car-listing-button">Remove</a>



                    </div>



            <?php

                }

            }

            ?>

            <div>

            </div>

        </div>



        <p><button class="add_fields_features titan-car-listing-button">Add More features</button></p>

        <input class="titan-car-listing-button listing_features_type" type="submit" name="features_type" value="Save" />



    </form>



</div>





<script>

    jQuery(document).ready(function() {



        var features_max_fields = 30;

        var wrapper_features = jQuery(".wrapper_features");

        var add_button_features = jQuery(".add_fields_features");

        var y = 1;

        jQuery(add_button_features).click(function(e) {



            e.preventDefault();



            if (y < features_max_fields) {

                y++;



                jQuery(wrapper_features).append('<div><input type="text" name="car_feature_names[][Featurename]" placeholder="Type features Here" /> <a href="javascript:void(0);" class="remove_field_features titan-car-listing-button">Remove</a></div>');



            }

        });



        jQuery(wrapper).on("click", ".remove_field_features", function(e) {



            e.preventDefault();

            jQuery(this).parent('div').remove();

            y--;

        })

    });

</script>

<!-- end features -->

<!-- start Body Type -->



<div class="vehicle_body_container">



    <h2>Add vehicle body type</h2>

    <form method="post" action="#">

        <div class="wrapper_body">

            <?php

            $tian_car_listing_body_type = get_option('car_listing_body_type');



            if (!empty($tian_car_listing_body_type)) {



                foreach ($tian_car_listing_body_type as $body_type) {

            ?>

                    <div>

                        <input type="text" name="bodytype[]" value="<?php echo (empty($body_type)) ? 'No body type Added' :  $body_type;  ?>" placeholder="Type body Here" /><a href="javascript:void(0);" class="remove_field_body titan-car-listing-button">Remove</a>



                    </div>



            <?php

                }

            }

            ?>

            <div>

            </div>

        </div>



        <p><button class="add_fields_body titan-car-listing-button">Add More body</button></p>

        <input class="titan-car-listing-button listing_body_type" type="submit" name="body_type" value="Save" />



    </form>



</div>





<script>

    jQuery(document).ready(function() {



        var body_max_fields = 30;

        var wrapper_body = jQuery(".wrapper_body");

        var add_button_body = jQuery(".add_fields_body");

        var y = 1;

        jQuery(add_button_body).click(function(e) {



            e.preventDefault();



            if (y < body_max_fields) {

                y++;



                jQuery(wrapper_body).append('<div><input type="text" name="bodytype[]" placeholder="Type body Here" /> <a href="javascript:void(0);" class="remove_field_body titan-car-listing-button">Remove</a></div>');



            }

        });



        jQuery(wrapper).on("click", ".remove_field_body", function(e) {



            e.preventDefault();

            jQuery(this).parent('div').remove();

            y--;

        })

    });

</script>

<!-- end Body Type -->