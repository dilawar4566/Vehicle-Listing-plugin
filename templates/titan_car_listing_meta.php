<?php







//Register Meta Box







function titan_listing_register_meta_price()



{



    add_meta_box('titan-car-price', __('Car Price', 'car-listing'), 'titan_listing_callback_price', 'car-listing');

}



add_action('add_meta_boxes', 'titan_listing_register_meta_price');











//Meta box display callback function







function titan_listing_callback_price($post)



{



?>



    <div class="titan_listing_box">



        <p class="meta-options titan_listing_field">



            <label for="titan_listing_down_payment">Down Payment</label>



            <input id="titan_listing_down_payment" type="number" name="titan_listing_down_payment" value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'titan_listing_down_payment', true)); ?>">



        </p>



        <p class="meta-options titan_listing_field">



            <label for="titan_listing_weekly_payment">Weekly Payment</label>



            <input id="titan_listing_weekly_payment" type="number" name="titan_listing_weekly_payment" value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'titan_listing_weekly_payment', true)); ?>">



        </p>



    </div>



<?php



}







//Register Meta Box







function titan_listing_register_meta()



{



    add_meta_box('titan-car', __('Car Detail', 'car-listing'), 'titan_listing_display_callback', 'car-listing');

}



add_action('add_meta_boxes', 'titan_listing_register_meta');











//Meta box display callback function







function titan_listing_display_callback($post)



{



?>



    <div class="titan_listing_box">



        <p class="meta-options titan_listing_field">



            <label for="titan_listing_car_model">Car Model</label>



            <input id="titan_listing_car_model" type="text" name="titan_listing_car_model" value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'titan_listing_car_model', true)); ?>">



        </p>



        <p class="meta-options titan_listing_field">



            <label for="titan_listing_car_making_year">Car Making Year</label>



            <input id="titan_listing_car_making_year" type="number" name="titan_listing_car_making_year" value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'titan_listing_car_making_year', true)); ?>">



        </p>



        <p class="meta-options titan_listing_field">



            <label for="titan_listing_distance">Distance Travel(KM)</label>



            <input id="titan_listing_distance" type="number" name="titan_listing_distance" value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'titan_listing_distance', true)); ?>">



        </p>



        <p class="meta-options titan_listing_field">



            <label for="titan_listing_buy_now_url">Buy Now Url</label>



            <input id="titan_listing_buy_now_url" type="url" name="titan_listing_buy_now_url" value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'titan_listing_buy_now_url', true)); ?>">



        </p>



        <p class="meta-options titan_listing_field">



            <label for="titan_listing_compare_url">Compare Url</label>



            <input id="titan_listing_compare_url" type="url" name="titan_listing_compare_url" value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'titan_listing_compare_url', true)); ?>">



        </p>



        <p class="meta-options titan_listing_field">



            <label for="titan_listing_make_name">Car Make</label>



            <input id="titan_listing_make_name" type="text" name="titan_listing_make_name" value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'titan_listing_make_name', true)); ?>">



        </p>



        <p class="meta-options titan_listing_field">



            <label for="titan_listing_map_location">Location</label>



            <input id="titan_listing_map_location" type="text" name="titan_listing_map_location" value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'titan_listing_map_location', true)); ?>">



        </p>



    </div>



<?php



}











function titan_listing_save_meta($post_id)



{



    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;



    if ($parent_id = wp_is_post_revision($post_id)) {



        $post_id = $parent_id;

    }



    $fields = [



        'titan_listing_car_model',



        'titan_listing_car_making_year',



        'titan_listing_distance',



        'titan_listing_down_payment',



        'titan_listing_weekly_payment',



        'titan_listing_buy_now_url',



        'titan_listing_compare_url',



        'titan_listing_make_name',



        'titan_listing_map_location',



    ];



    foreach ($fields as $field) {



        if (array_key_exists($field, $_POST)) {



            update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));

        }

    }

}



add_action('save_post', 'titan_listing_save_meta');







// Titan car listing inner details start







function titan_listing_inner_details()



{



    add_meta_box('car-listing-inner-detail', __('Car Body Details', 'car-listing'), 'titan_listing_inner_details_callback', 'car-listing');

}



add_action('add_meta_boxes', 'titan_listing_inner_details');











//Meta box display callback function







function titan_listing_inner_details_callback()



{



?>



    <p class="meta-options titan_listing_field">



        <label for="titan_listing_exterior_color">Exterior Color</label>



        <input id="titan_listing_exterior_color" type="text" name="titan_listing_exterior_color" value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'titan_listing_exterior_color', true)); ?>">



    </p>



    <p class="meta-options titan_listing_field">



        <label for="titan_listing_interior_color">Interior Color</label>



        <input id="titan_listing_interior_color" type="text" name="titan_listing_interior_color" value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'titan_listing_interior_color', true)); ?>">



    </p>



    <p class="meta-options titan_listing_field">



        <label for="titan_listing_doors">Number of Doors</label>



        <input id="titan_listing_doors" type="number" name="titan_listing_doors" value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'titan_listing_doors', true)); ?>">



    </p>



    <p class="meta-options titan_listing_field">



        <label for="titan_listing_body_type">Body Type</label>



        <input id="titan_listing_body_type" type="text" name="titan_listing_body_type" value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'titan_listing_body_type', true)); ?>">



    </p>



    <p class="meta-options titan_listing_field">



        <label for="titan_listing_no_of_seats">Number of Seats</label>



        <input id="titan_listing_no_of_seats" type="number" name="titan_listing_no_of_seats" value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'titan_listing_no_of_seats', true)); ?>">



    </p>



    <p class="meta-options titan_listing_field">



        <label for="titan_listing_highway_mpg">Highway MPG</label>



        <input id="titan_listing_highway_mpg" type="number" name="titan_listing_highway_mpg" value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'titan_listing_highway_mpg', true)); ?>">



    </p>



    <p class="meta-options titan_listing_field">



        <label for="titan_listing_city_mpg">City MPG</label>



        <input id="titan_listing_city_mpg" type="number" name="titan_listing_city_mpg" value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'titan_listing_city_mpg', true)); ?>">



    </p>



    <p class="meta-options titan_listing_field">



        <label for="titan_listing_drivetrain">Drivetrain</label>



        <input id="titan_listing_drivetrain" type="text" name="titan_listing_drivetrain" value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'titan_listing_drivetrain', true)); ?>">



    </p>



    <p class="meta-options titan_listing_field">



        <label for="titan_listing_transmission">Transmission</label>



        <input id="titan_listing_transmission" type="text" name="titan_listing_transmission" value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'titan_listing_transmission', true)); ?>">



    </p>



    <p class="meta-options titan_listing_field">



        <label for="titan_listing_vin">VIN</label>



        <input id="titan_listing_vin" type="text" name="titan_listing_vin" value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'titan_listing_vin', true)); ?>">



    </p>



    <p class="meta-options titan_listing_field">



        <label for="titan_listing_stock_number">Stock Number</label>



        <input id="titan_listing_stock_number" type="number" name="titan_listing_stock_number" value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'titan_listing_stock_number', true)); ?>">



    </p>







<?php



}



function titan_listing_save_inner_details($post_id)



{



    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;



    if ($parent_id = wp_is_post_revision($post_id)) {



        $post_id = $parent_id;

    }



    $fields = [



        'titan_listing_exterior_color',



        'titan_listing_interior_color',



        'titan_listing_doors',



        'titan_listing_body_type',



        'titan_listing_no_of_seats',



        'titan_listing_highway_mpg',



        'titan_listing_city_mpg',



        'titan_listing_drivetrain',



        'titan_listing_transmission',



        'titan_listing_vin',



        'titan_listing_stock_number',







    ];



    foreach ($fields as $field) {



        if (array_key_exists($field, $_POST)) {



            update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));

        }

    }

}



add_action('save_post', 'titan_listing_save_inner_details');











// Titan car listing inner details end











// Titan car listing features start











add_action('admin_init', 'titan_car_listing_repeater_meta_boxes', 2);







function titan_car_listing_repeater_meta_boxes()



{



    add_meta_box('car-listing', 'Car Features', 'car_listing_repeatable_meta_box_display', 'car-listing', 'normal', 'default');

}







function car_listing_repeatable_meta_box_display()



{



    global $post;



    $titan_car_listing_group = get_post_meta($post->ID, 'titan_car_listing_group_meta', true);



    wp_nonce_field('titan_car_listing_repater_nonce', 'titan_car_listing_repater_nonce');



?>



    <table id="repeatable-fieldset-one" width="100%">



        <tbody>



            <?php



            if ($titan_car_listing_group) :



                foreach ($titan_car_listing_group as $field) {



            ?>



                    <tr class="dl-car-listing-tr">



                        <td width="15%">



                            <input type="text" placeholder="Feature name" name="Featurename[]" value="<?php if ($field['Featurename'] != '') echo esc_attr($field['Featurename']); ?>" />



                        </td>



                        <td width="15%"><a class="button remove-row titan-car-listing-button" href="#1">Remove</a></td>



                    </tr>



                <?php



                }



            else :







                ?>



                <tr class="dl-car-listing-tr">



                    <td>



                        <input type="text" placeholder="Feature name" title="Title" name="Featurename[]" />



                    </td>



                    <td><a class="button  cmb-remove-row-button button-disabled titan-car-listing-button" href="#">Remove</a></td>



                </tr>



            <?php endif; ?>







            <tr class="empty-row screen-reader-text">



                <td>



                    <input type="text" placeholder="Feature name" name="Featurename[]" />



                </td>



                <td><a class="button remove-row" href="#">Remove</a></td>



            </tr>



        </tbody>



    </table>



    <p><a id="add-row" class="button titan-car-listing-button" href="#">Add another feature</a></p>



<?php



}



add_action('save_post', 'custom_repeatable_meta_box_save');



function custom_repeatable_meta_box_save($post_id)



{



    if (



        !isset($_POST['titan_car_listing_repater_nonce']) ||



        !wp_verify_nonce($_POST['titan_car_listing_repater_nonce'], 'titan_car_listing_repater_nonce')



    )



        return;







    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)



        return;







    if (!current_user_can('edit_post', $post_id))



        return;







    $old = get_post_meta($post_id, 'titan_car_listing_group_meta', true);



    $new = array();



    $invoiceItems = $_POST['Featurename'];



    $count = count($invoiceItems);



    for ($i = 0; $i < $count; $i++) {



        if ($invoiceItems[$i] != '') :



            $new[$i]['Featurename'] = stripslashes(strip_tags($invoiceItems[$i]));



        endif;

    }



    if (!empty($new) && $new != $old)



        update_post_meta($post_id, 'titan_car_listing_group_meta', $new);



    elseif (empty($new) && $old)



        delete_post_meta($post_id, 'titan_car_listing_group_meta', $old);

}















// Titan car listing features end







// Titan car listing media uplaod start











add_action('add_meta_boxes', 'titan_listing_uploader_meta_box');



function titan_listing_uploader_meta_box()



{



    add_meta_box('titan-listing-media-field', 'Media Field', 'titan_listing_uploader_meta_box_callback', 'car-listing', 'normal', 'high');

}







function titan_listing_uploader_meta_box_callback($post)



{







    $titan_listing_media = get_post_meta($post->ID, 'titan_listing_media', true);







    echo titan_listing_media_uploader_field('titan_listing_media', $titan_listing_media);

}



function titan_listing_media_uploader_field($name, $value = '')



{







    $image = '">Add Media';



    $image_str = '';



    $image_size = 'full';



    $display = 'none';



    $value = explode(',', $value);







    if (!empty($value)) {



        foreach ($value as $values) {



            if ($image_attributes = wp_get_attachment_image_src($values, $image_size)) {



                $image_str .= '<li data-attechment-id=' . $values . '><a href="' . $image_attributes[0] . '" target="_blank"><img src="' . $image_attributes[0] . '" /></a><i class="dashicons dashicons-no delete-img"></i></li>';

            }

        }

    }







    if ($image_str) {



        $display = 'inline-block';

    }



    return '<div class="cxc-multi-upload-medias"><ul>' . $image_str . '</ul><a href="#" class="cxc_multi_upload_image_button titan-car-listing-button' . $image . '</a><input type="hidden" class="attechments-ids ' . $name . '" name="' . $name . '" id="' . $name . '" value="' . esc_attr(implode(',', $value)) . '" /><a href="#" class="cxc_multi_remove_image_button titan-car-listing-button" style="display:inline-block;display:' . $display . '">Remove media</a></div>';

}







add_action('save_post', 'titan_listing_meta_box_save');







function titan_listing_meta_box_save($post_id)



{







    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {



        return;

    }







    // Check the user's permissions.







    if (!current_user_can('edit_post', $post_id)) {



        return;

    }







    if (isset($_POST['titan_listing_media'])) {



        update_post_meta($post_id, 'titan_listing_media', $_POST['titan_listing_media']);

    }

}







function titan_listing_admin_media_scripts()



{







    wp_enqueue_style('titan-car-listing-style');







    wp_enqueue_script('titan-car-listing-scripts');







    // if (!did_action('wp_enqueue_media')) {



    //     wp_enqueue_media();



    // }



    wp_enqueue_media();

}



add_action('admin_enqueue_scripts', 'titan_listing_admin_media_scripts');











// Titan car listing media uplaod end