<?php
/* Template Name: Single Listing */
get_header();

if (have_posts()) :

    while (have_posts()) : the_post();
        $post_id = get_the_ID();
        $titan_listing_content = get_post_field('post_content', $post_id);;
        $titan_listing_car_model = get_post_meta($post_id, 'titan_listing_car_model', true);
        $titan_listing_distance = get_post_meta($post_id, 'titan_listing_distance', true);
        $titan_listing_down_payment = get_post_meta($post_id, 'titan_listing_down_payment', true);
        $titan_listing_payment_empty = (empty($titan_listing_down_payment)) ? "0" :  $titan_listing_down_payment;
        $titan_listing_payment_format = number_format("$titan_listing_payment_empty");
        $titan_listing_weekly_payment = get_post_meta($post_id, 'titan_listing_weekly_payment', true);
        $titan_listing_payment_weekly_empty = (empty($titan_listing_weekly_payment)) ? "0" :  $titan_listing_weekly_payment;
        $titan_listing_payment_weekly_format = number_format("$titan_listing_payment_weekly_empty");
        $titan_car_listing_group = get_post_meta($post_id, 'titan_car_listing_group_meta', true);
        $titan_listing_exterior_color = get_post_meta($post_id, 'titan_listing_exterior_color', true);
        $titan_listing_interior_color = get_post_meta($post_id, 'titan_listing_interior_color', true);
        $titan_listing_doors = get_post_meta($post_id, 'titan_listing_doors', true);
        $titan_listing_body_type = get_post_meta($post_id, 'titan_listing_body_type', true);
        $titan_listing_engine_type = get_post_meta($post_id, 'titan_listing_engine_type', true);
        $titan_listing_no_of_seats = get_post_meta($post_id, 'titan_listing_no_of_seats', true);
        $titan_listing_highway_mpg = get_post_meta($post_id, 'titan_listing_highway_mpg', true);
        $titan_listing_city_mpg = get_post_meta($post_id, 'titan_listing_city_mpg', true);
        $titan_listing_drivetrain = get_post_meta($post_id, 'titan_listing_drivetrain', true);
        $titan_listing_transmission = get_post_meta($post_id, 'titan_listing_transmission', true);
        $titan_listing_vin = get_post_meta($post_id, 'titan_listing_vin', true);
        $titan_listing_stock_number = get_post_meta($post_id, 'titan_listing_stock_number', true);
        $titan_listing_gallery = get_post_meta($post_id, 'titan_listing_media');
        $titan_listing_gallery_convert_values = explode(",", $titan_listing_gallery[0]);
        $titan_listing_buy_now_url = get_post_meta($post_id, 'titan_listing_buy_now_url', true);
        $titan_listing_compare_url = get_post_meta($post_id, 'titan_listing_compare_url', true);


?>


        <section class="dl-single-car-container">

            <div class="dl-back-btn">

                <a href="<?php echo get_site_url(); ?>/car-listing" class="dl-back-listing    dl-a-btn"><img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'assets/images/left-arrow.svg' ?>" width="10px" alt=""> Back to

                    Listing </a>

            </div>

            <div class="dl-single-row">

                <div class="dl-left-column">

                    <div class="carousel" data-flickity='{ "wrapAround": true , "pageDots": false}'>
                        <?php

                        if ($titan_listing_gallery_convert_values[0] != NULL) {
                            foreach ($titan_listing_gallery_convert_values as $titan_listing_value) {
                                $titan_listing_gallery_show_all = wp_get_attachment_image_url($titan_listing_value, 'full');       ?>

                                <div class="carousel-cell2">
                                    <div class="dl-titan-car-listing-single" style="background-image:url('<?php echo $titan_listing_gallery_show_all; ?>');"></div>
                                    <!-- <img class="dl-car-img-carousel" src="" alt="" width="100%"> -->

                                </div>
                            <?php

                            }
                        } else {
                            ?>
                            <div class="carousel-cell2">

                                <img class="dl-car-img-carousel" src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d1/Image_not_available.png/640px-Image_not_available.png" alt="" width="100%">

                            </div>
                        <?php
                        }
                        ?>

                    </div>

                    <?php
                    if ($titan_listing_gallery_convert_values[0] != NULL) {
                        foreach ($titan_listing_gallery_convert_values as $titan_listing_value) {

                            $titan_listing_gallery_show_all = wp_get_attachment_image_url($titan_listing_value, 'full');

                    ?>
                            <div class="myGallery">

                                <img id="myImg" src="<?php echo $titan_listing_gallery_show_all; ?>" alt="" onclick="openModal(this)" />

                                <div id="myModal" class="modal"><span class="close">&times;

                                    </span><img class="modal-content" id="img01" style="width: 600px;" />

                                </div>

                            </div>
                        <?php

                        }
                    } else {
                        ?>
                        <div class="myGallery">

                            <img id="myImg" src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d1/Image_not_available.png/640px-Image_not_available.png" alt="" onclick="openModal(this)" />
                            <div id="myModal" class="modal"><span class="close">&times;

                                </span><img class="modal-content" id="img01" style="width: 600px;" />

                            </div>

                        </div><?php
                            }
                                ?>


                    <div class="dl-left-bottom-container">
                        <div class="dl-right-column-highlights">

                            <div class="dl-car-details">

                                <h2 class="dl-highlights-title"> Highlights </h2>

                            </div>

                            <div class="dl-main-point-service">
                                <?php

                                if (is_array($titan_car_listing_group)) {
                                    foreach ($titan_car_listing_group as $field) {
                                ?>

                                        <p> <i><img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'assets/images/tick-mark.svg' ?>" width="15px" alt=""></i>

                                            <span> <?php echo $field['Featurename']; ?></span>

                                        </p>

                                <?php
                                    }
                                }
                                ?>

                            </div>

                        </div>
                        <div class="dl-all-car-details">

                            <p class="dl-left-heading"> Exterior Color </p>

                            <p class="dl-right-heading"> <?php echo (empty($titan_listing_exterior_color)) ? 'N/A' :  $titan_listing_exterior_color; ?> </p>

                        </div>

                        <div class="dl-all-car-details">

                            <p class="dl-left-heading"> Interior Color </p>

                            <p class="dl-right-heading"> <?php echo (empty($titan_listing_interior_color)) ? 'N/A' :  $titan_listing_interior_color; ?> </p>

                        </div>


                        <div class="dl-all-car-details">

                            <p class="dl-left-heading">Number of Doors </p>

                            <p class="dl-right-heading"> <?php echo (empty($titan_listing_doors)) ? 'N/A' :  $titan_listing_doors; ?> </p>

                        </div>

                        <div class="dl-all-car-details">

                            <p class="dl-left-heading"> Body Type </p>

                            <p class="dl-right-heading"> <?php echo (empty($titan_listing_body_type)) ? 'N/A' :  $titan_listing_body_type; ?> </p>

                        </div>

                        <div class="dl-all-car-details">

                            <p class="dl-left-heading"> Number of Seats </p>

                            <p class="dl-right-heading"> <?php echo (empty($titan_listing_no_of_seats)) ? 'N/A' :  $titan_listing_no_of_seats; ?> </p>

                        </div>

                        <div class="dl-all-car-details">

                            <p class="dl-left-heading"> Highway MPG </p>

                            <p class="dl-right-heading"> <?php echo (empty($titan_listing_highway_mpg)) ? 'N/A' :  $titan_listing_highway_mpg; ?> </p>

                        </div>

                        <div class="dl-all-car-details">

                            <p class="dl-left-heading"> City MPG </p>

                            <p class="dl-right-heading"> <?php echo (empty($titan_listing_city_mpg)) ? 'N/A' :  $titan_listing_city_mpg; ?></p>

                        </div>


                        <div class="dl-all-car-details">

                            <p class="dl-left-heading"> Drivetrain </p>

                            <p class="dl-right-heading"> <?php echo (empty($titan_listing_drivetrain)) ? 'N/A' :  $titan_listing_drivetrain; ?> </p>

                        </div>

                        <div class="dl-all-car-details">

                            <p class="dl-left-heading"> Transmission </p>

                            <p class="dl-right-heading"> <?php echo (empty($titan_listing_transmission)) ? 'N/A' :  $titan_listing_transmission; ?> </p>

                        </div>

                        <div class="dl-all-car-details">

                            <p class="dl-left-heading"> VIN </p>

                            <p class="dl-right-heading"> <?php echo (empty($titan_listing_vin)) ? 'N/A' :  $titan_listing_vin; ?></p>

                        </div>

                        <div class="dl-all-car-details">

                            <p class="dl-left-heading"> Stock Number </p>

                            <p class="dl-right-heading"><?php echo (empty($titan_listing_content)) ? 'N/A' :  $titan_listing_stock_number; ?> </p>

                        </div>

                    </div>

                </div>

                <div class="dl-right-column">
                    <div id="bar-fixed" class="">
                        <div class="dl-car-name">

                            <h2 class="dl-car-title"><?php the_title(); ?></h2>

                            <span class="dl-car-model"><?php echo (empty($titan_listing_car_model)) ? 'N/A' :  $titan_listing_car_model; ?></span>

                        </div>

                        <div class="dl-payment-type">

                            <div class="btn-group">

                                <a href="" class="dl-button dl-down">Down Payments <p class="dl-price">$ <?php echo $titan_listing_payment_format; ?></p> </a>

                                <a href="" class="dl-button dl-weekly">Weekly Payment<p class="dl-price">$ <?php echo $titan_listing_payment_weekly_format; ?></p> </a>

                            </div>

                        </div>

                        <div class="dl-car-details dl-single-car-details">

                            <p class="dl-miles"> <i><img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'assets/images/light-distance.svg' ?>" width="4%" alt=""></i>

                                <span><?php echo (empty($titan_listing_distance)) ? 'N/A' :  $titan_listing_distance; ?></span>

                            </p>

                            <p class="dl-highlights"> <i><img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'assets/images/tick-mark.svg' ?>" width="15px" alt=""></i>

                                <span>5 Day Returns & Available Protections*</span>

                            </p>

                            <p class="dl-highlights"> <i><img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'assets/images/tick-mark.svg' ?>" width="15px" alt=""></i>

                                <span>Free Vehicle History.</span>

                            </p>

                            <p class="dl-highlights"> <i><img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'assets/images/map.svg' ?>" width="15px" alt=""></i>

                                <span>Windsore locks, CT</span>

                            </p>

                        </div>
                        <div class="btn-group btn-sidbar">

                            <a href="" class="dl-buy dl-a-btn dl-text-btn"><i><img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'assets/images/chat.svg' ?>" width="15px" style="margin-right:10px;" alt=""></i>Text yourself a link</a>

                            <a href="<?php echo $titan_listing_buy_now_url; ?>" class="dl-compare dl-a-btn"><?php echo get_option('car_listing_buynow'); ?></a>

                            <a href="<?php echo $titan_listing_compare_url; ?>" class="dl-buy-now-side dl-a-btn"><?php echo get_option('car_listing_compare'); ?></a>

                        </div>
                        <!-- <div class="dl-sidebar-btn-div">

                            <a href="" class="dl-buy dl-a-btn"><i><img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'assets/images/chat.svg' ?>" width="15px" style="margin-right:10px;" alt=""></i>Text yourself a link</a>

                        </div>

                        <div class="dl-sidebar-btn-div">

                            <a href="<?php echo $titan_listing_buy_now_url; ?>" class="dl-compare dl-a-btn"><?php echo get_option('car_listing_buynow'); ?></a>

                        </div>
                        <div class="dl-sidebar-btn-div">

                            <a href="<?php echo $titan_listing_compare_url; ?>" class="dl-buy-now-side dl-a-btn"><?php echo get_option('car_listing_compare'); ?></a>

                        </div> -->

                        <div class="dl-signle-desc">

                            <p>Buy completely online or save time at the delivery center.</p>

                        </div>

                        <div class="dl-main-point-service">

                            <p> <i><img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'assets/images/text.svg' ?>" width="15px" alt=""></i>

                                <span>I have a question</span>

                            </p>

                            <p> <i><img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'assets/images/calender.svg' ?>" width="15px" alt=""></i>

                                <span>Make appointment</span>

                            </p>

                            <p> <i><img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'assets/images/card.svg' ?>" width="15px" alt=""></i>

                                <span>Get my payment</span>

                            </p>

                            <p> <i><img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'assets/images/tick-mark.svg' ?>" width="15px" alt=""></i>

                                <span>Pre-Approve me</span>

                            </p>

                        </div>
                    </div>
                </div>


                <!-- <div class="dl-right-column-highlights">

                    <div class="dl-car-details">

                        <h2 class="dl-highlights-title"> Highlights </h2>

                    </div>

                    <div class="dl-main-point-service">
                        <?php

                        if (is_array($titan_car_listing_group)) {
                            foreach ($titan_car_listing_group as $field) {
                        ?>

                                <p> <i><img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'assets/images/tick-mark.svg' ?>" width="15px" alt=""></i>

                                    <span> <?php echo $field['Featurename']; ?></span>

                                </p>

                        <?php
                            }
                        }
                        ?>

                    </div>

                </div> -->

            </div>

            <div class="dl-about-vehicle">

                <h2>About Vehicle</h2>

                <p> <?php echo (empty($titan_listing_content)) ? 'No Content Available' :  $titan_listing_content; ?></p>

            </div>

        </section>
<?php
    endwhile;
endif;
get_footer();
?>