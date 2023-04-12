

function openModal(e) {





	var modal = document.getElementById("myModal");



	var img = document.getElementById("myImg");



	var modalImg = document.getElementById("img01");



	modal.style.display = "block";



	modalImg.src = e.src;



	var span = document.getElementsByClassName("close")[0];



	span.onclick = function () {



		modal.style.display = "none";



	}





}







// add remove gallery image







jQuery(document).ready(function () {



	// Select2 code start

	jQuery("#car_feature_tags_name").select2({

		placeholder: "Select Car Features",

		allowClear: true

	});

	// Select2 code end



	jQuery('a.delete').on('click', function (e) {



		e.preventDefault();



		imageID = jQuery(this).closest('.image')[0].id;



		// alert('Now deleting "' + imageID + '"');



		jQuery(this).closest('.image')



			.fadeTo(300, 0, function () {



				jQuery(this)



					.animate({ width: 0 }, 200, function () {



						jQuery(this)



							.remove();



					});



			});



	});











	jQuery(function () {



		jQuery('input[type="file"]').change(function () {



			if (jQuery(this).val() != "") {



				jQuery(this).css('color', '#333');



			} else {



				jQuery(this).css('color', 'transparent');



			}



		});



	});



	jQuery(function () {



		jQuery('input[type="files"]').change(function () {



			if (jQuery(this).val() != "") {



				jQuery(this).css('color', '#333');



			} else {



				jQuery(this).css('color', 'transparent');



			}



		});



	});



});











// add repeater field



jQuery(document).ready(function () {



	jQuery("#rowAdder").click(function () {



		newRowAdd =



			'<div class="input-group-prepend">' +



			'<input type="text" name="car_feature_names[][Featurename]" class="form-control m-input">' +



			'<button class="btn btn-danger" id="DeleteRow" type="button">' +



			' Delete</button> </div> ';







		jQuery('#newinput').append(newRowAdd);



	});







	jQuery("body").on("click", "#DeleteRow", function () {



		jQuery(this).parents(".input-group-prepend").remove();



	})



});







//add class for fixed sidebar







jQuery(document).ready(function () {



	var topLimit = jQuery('#bar-fixed').offset().top;



	jQuery(window).scroll(function () {



		if (topLimit <= jQuery(window).scrollTop()) {



			jQuery('#bar-fixed').addClass('car-listing-sidebar')



		} else {



			jQuery('#bar-fixed').removeClass('car-listing-sidebar')



		}



	});

});




jQuery(document).ready(function () {



	jQuery(".rotate").click(function () {



		jQuery(this).toggleClass("down");

	})





	jQuery("#dl-popular-searches").change(function () {



		var titan_car_listing_popular_searches = jQuery('#dl-popular-searches option:selected').val();



		jQuery('#titan_car_listing_hidden_field, #dl-search-field').val(titan_car_listing_popular_searches);



		ajaxFilters('filters');



	});







	//ajax search







	jQuery('#dl-search-field').on('keyup', function (e) {



		var titan_searched_string = jQuery('#dl-search-field').val();



		if (titan_searched_string == '') {



			jQuery('#titan_search_suggestions').html('');





		} else {



			jQuery.ajax({



				type: "post",



				dataType: "json",



				url: titanAjax.ajaxurl,



				data: {



					action: "titan_search_cars",



					titan_searched_string: titan_searched_string,



				},



				success: function (response) {



					if (response) {



						jQuery('#titan_search_suggestions').html(response);



					}



				}



			});



		}



		ajaxFilters('filters');





	});



	//ajax filters





	jQuery('.dl-filter').on('change', function () {



		ajaxFilters('filters');



	});



	jQuery('.dl-filter-dashboard').on('change', function () {



		ajaxFilters_dashboard('filters');



	});





	jQuery('body').on('click', '#titan_search_suggestions li', function () {



		jQuery('#dl-search-field').val(jQuery(this).html());



		ajaxFilters('filters');



		jQuery('#titan_search_suggestions').html('');



	});





	function ajaxFilters_dashboard(titan_type) {



		var titan_searched_string = jQuery('#dl-search-field').val();



		if (jQuery('select[name="titan_car_mileage"] option:first').val() != jQuery('select[name="titan_car_mileage"]').val()) {



			var titan_car_mileage = jQuery('select[name="titan_car_mileage"]').val();



		} else {



			var titan_car_mileage = '';



		}



		if (jQuery('select[name="titan_car_price_range"] option:first').val() != jQuery('select[name="titan_car_price_range"]').val()) {



			var titan_car_price_range = jQuery('select[name="titan_car_price_range"]').val();



		} else {



			var titan_car_price_range = '';



		}





		if (jQuery('select[name="titan_car_year"] option:first').val() != jQuery('select[name="titan_car_year"]').val()) {



			var titan_car_year = jQuery('select[name="titan_car_year"]').val();



		} else {



			var titan_car_year = '';



		}





		if (jQuery('select[name="titan_car_make"] option:first').val() != jQuery('select[name="titan_car_make"]').val()) {





			var titan_car_make = jQuery('select[name="titan_car_make"]').val();





		} else {





			var titan_car_make = '';





		}





		if (jQuery('select[name="titan_car_model"] option:first').val() != jQuery('select[name="titan_car_model"]').val()) {



			var titan_car_model = jQuery('select[name="titan_car_model"]').val();



		} else {



			var titan_car_model = '';



		}



		if (jQuery('select[name="titan_car_location"] option:first').val() != jQuery('select[name="titan_car_location"]').val()) {





			var titan_car_location = jQuery('select[name="titan_car_location"]').val();



		} else {



			var titan_car_location = '';



		}





		jQuery.ajax({



			type: "post",



			dataType: "json",



			url: titanAjax.ajaxurl,



			data: {



				action: "titan_filter_listings_dashboard",



				titan_searched_string: titan_searched_string,



				titan_car_mileage: titan_car_mileage,



				titan_car_price_range: titan_car_price_range,



				titan_car_year: titan_car_year,



				titan_car_make: titan_car_make,



				titan_car_model: titan_car_model,



				titan_car_location: titan_car_location,



				titan_type: titan_type,



			},



			success: function (response) {



				console.log(response);



				// alert(response);



				if (response) {



					if (response == 'No Listings') {



						jQuery('#titan_archieve_posts').html('No Listings');



					} else {



						jQuery('#titan_archieve_posts').html(response);



						jQuery('.carousel').flickity({



							wrapAround: true,



							pageDots: false,



						});



					}



				}



			}



		});



	}











	function ajaxFilters(titan_type) {



		var titan_searched_string = jQuery('#dl-search-field').val();



		if (jQuery('select[name="titan_car_mileage"] option:first').val() != jQuery('select[name="titan_car_mileage"]').val()) {



			var titan_car_mileage = jQuery('select[name="titan_car_mileage"]').val();



		} else {



			var titan_car_mileage = '';



		}



		if (jQuery('select[name="titan_car_price_range"] option:first').val() != jQuery('select[name="titan_car_price_range"]').val()) {



			var titan_car_price_range = jQuery('select[name="titan_car_price_range"]').val();



		} else {



			var titan_car_price_range = '';



		}



		if (jQuery('select[name="titan_car_year"] option:first').val() != jQuery('select[name="titan_car_year"]').val()) {



			var titan_car_year = jQuery('select[name="titan_car_year"]').val();



		} else {



			var titan_car_year = '';



		}



		if (jQuery('select[name="titan_car_make"] option:first').val() != jQuery('select[name="titan_car_make"]').val()) {



			var titan_car_make = jQuery('select[name="titan_car_make"]').val();



		} else {



			var titan_car_make = '';



		}



		if (jQuery('select[name="titan_car_model"] option:first').val() != jQuery('select[name="titan_car_model"]').val()) {



			var titan_car_model = jQuery('select[name="titan_car_model"]').val();



		} else {



			var titan_car_model = '';



		}



		if (jQuery('select[name="titan_car_location"] option:first').val() != jQuery('select[name="titan_car_location"]').val()) {



			var titan_car_location = jQuery('select[name="titan_car_location"]').val();



		} else {



			var titan_car_location = '';



		}



		jQuery.ajax({



			type: "post",



			dataType: "json",



			url: titanAjax.ajaxurl,



			data: {



				action: "titan_filter_listings",



				titan_searched_string: titan_searched_string,



				titan_car_mileage: titan_car_mileage,



				titan_car_price_range: titan_car_price_range,



				titan_car_year: titan_car_year,



				titan_car_make: titan_car_make,



				titan_car_model: titan_car_model,



				titan_car_location: titan_car_location,



				titan_type: titan_type,



			},





			success: function (response) {



				if (response) {



					if (response == 'No Listings') {



						jQuery('#titan_archieve_posts').html('No Listings');



					} else {



						jQuery('#titan_archieve_posts').html(response);



						jQuery('.carousel').flickity({



							wrapAround: true,

							pageDots: false,



						});



					}



				}



			}



		});



	}







	jQuery('#titan_refresh_filters_button').on('click', function () {



		jQuery('#dl-search-field').val('');



		jQuery('select[name="titan_car_popular"]').val(jQuery('select[name="titan_car_popular"] option:first').val());



		jQuery('select[name="titan_car_mileage"]').val(jQuery('select[name="titan_car_mileage"] option:first').val());



		jQuery('select[name="titan_car_price_range"]').val(jQuery('select[name="titan_car_price_range"] option:first').val());



		jQuery('select[name="titan_car_year"]').val(jQuery('select[name="titan_car_year"] option:first').val());



		jQuery('select[name="titan_car_make"]').val(jQuery('select[name="titan_car_make"] option:first').val());



		jQuery('select[name="titan_car_model"]').val(jQuery('select[name="titan_car_model"] option:first').val());



		jQuery('select[name="titan_car_location"]').val(jQuery('select[name="titan_car_location"] option:first').val());



		ajaxFilters('all');





	});





	jQuery('#titan_refresh_filters_button_dashboard').on('click', function () {





		jQuery('select[name="titan_car_popular"]').val(jQuery('select[name="titan_car_popular"] option:first').val());



		console.log(jQuery('select[name="titan_car_mileage"] option:first').val());



		jQuery('select[name="titan_car_mileage"]').val(jQuery('select[name="titan_car_mileage"] option:first').val());



		jQuery('select[name="titan_car_price_range"]').val(jQuery('select[name="titan_car_price_range"] option:first').val());



		jQuery('select[name="titan_car_year"]').val(jQuery('select[name="titan_car_year"] option:first').val());



		jQuery('select[name="titan_car_make"]').val(jQuery('select[name="titan_car_make"] option:first').val());



		jQuery('select[name="titan_car_model"]').val(jQuery('select[name="titan_car_model"] option:first').val());



		jQuery('select[name="titan_car_location"]').val(jQuery('select[name="titan_car_location"] option:first').val());







		ajaxFilters_dashboard('all');



	});













	jQuery('button[name="titan_search_submit"]').on('click', function () {







		ajaxFilters('filters');







	})

















	// var topLimit = jQuery('#bar-fixed').offset().top;







	// jQuery(window).scroll(function () {







	// 	//console.log(topLimit <= jQuery(window).scrollTop())







	// 	if (topLimit <= jQuery(window).scrollTop()) {







	// 		jQuery('#bar-fixed').addClass('stickIt')







	// 	} else {







	// 		jQuery('#bar-fixed').removeClass('stickIt')







	// 	}







	// });







});















jQuery(document).ready(function (jQuery) {







	jQuery('#add-row').on('click', function () {







		var row = jQuery('.empty-row.screen-reader-text').clone(true);







		row.removeClass('empty-row screen-reader-text');







		row.insertBefore('#repeatable-fieldset-one tbody>tr:last');







		return false;







	});









	jQuery('.remove-row').on('click', function () {



		jQuery(this).parents('tr').remove();



		return false;



	});



});





// upload media js start



jQuery(document).ready(function () {

	ImgUpload();

});



function ImgUpload() {

	var imgWrap = "";

	var imgArray = [];



	jQuery(".upload__inputfile").each(function () {

		jQuery(this).on("change", function (e) {

			imgWrap = jQuery(this).closest(".upload__box").find(".upload__img-wrap");

			var maxLength = jQuery(this).attr("data-max_length");



			var files = e.target.files;

			var filesArr = Array.prototype.slice.call(files);

			var iterator = 0;

			filesArr.forEach(function (f, index) {

				if (!f.type.match("image.*")) {

					return;

				}



				if (imgArray.length > maxLength) {

					return false;

				} else {

					var len = 0;

					for (var i = 0; i < imgArray.length; i++) {

						if (imgArray[i] !== undefined) {

							len++;

						}

					}

					if (len > maxLength) {

						return false;

					} else {

						imgArray.push(f);



						var reader = new FileReader();

						reader.onload = function (e) {

							var html =

								"<div class='upload__img-box'><div style='background-image: url(" +

								e.target.result +

								")' data-number='" +

								jQuery(".upload__img-close").length +

								"' data-file='" +

								f.name +

								"' class='img-bg'><div class='upload__img-close'></div></div></div>";

							imgWrap.append(html);

							iterator++;

						};

						reader.readAsDataURL(f);

					}

				}

			});

		});

	});



	jQuery("body").on("click", ".upload__img-close", function (e) {

		var file = jQuery(this).parent().data("file");

		for (var i = 0; i < imgArray.length; i++) {

			if (imgArray[i].name === file) {

				imgArray.splice(i, 1);

				break;

			}

		}

		jQuery(this).parent().parent().remove();



		// start



		var ids = [];

		// var attach_id = jQuery(this).attr('data-attechment-id');



		jQuery('.upload__img-close').each(function () {

			console.log();



			if (jQuery(this).attr('data-attechment-id') != '') {

				ids.push(jQuery(this).attr('data-attechment-id'))



			}

		});



		ids_string = ids.toString();

		if (ids_string != '') {

			jQuery('#titan_listing_media').val(ids_string);

		}



	});

}



// upload media js end



// disable form submission on enter key start

jQuery(window).ready(function () {

	jQuery("#car_listing_entery").on("keypress", function (event) {



		var keyPressed = event.keyCode || event.which;

		if (keyPressed === 13) {

			alert("To save listing click on save button!");

			event.preventDefault();

			return false;

		}

	});

});



// disable form submission on enter key end























