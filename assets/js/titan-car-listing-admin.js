jQuery(function ($) {
    /*
     * Select/Upload image(s) event
     */
	jQuery('body').on('click', '.cxc_multi_upload_image_button', function (e) {
		e.preventDefault();

		var button = jQuery(this),
		custom_uploader = wp.media({
			title: 'Insert image',        
			button: {
				text: 'Use this image' 
			},
			multiple: true 
		});
		custom_uploader.on('select', function () { 
			var attech_ids = '';
			attachments
			var attachments = custom_uploader.state().get('selection'),
			attachment_ids = new Array(),
			i = 0;
			jQuery('.titan-car-listing-button').siblings('ul').empty();
			attachments.each(function (attachment) {
				attachment_ids[i] = attachment['id'];
				attech_ids += ',' + attachment['id'];
				if (attachment.attributes.type == 'image') {
					jQuery('.titan-car-listing-button').siblings('ul').append('<li data-attechment-id="' + attachment['id'] + '"><a href="' + attachment.attributes.url + '" target="_blank"><img class="true_pre_image" src="' + attachment.attributes.url + '" /></a><i class=" dashicons  dashicons-no delete-img"></i></li>');
				} else {
					jQuery('.titan-car-listing-button').siblings('ul').append('<li data-attechment-id="' + attachment['id'] + '"><a href="' + attachment.attributes.url + '" target="_blank"><img class="true_pre_image" src="' + attachment.attributes.icon + '" /></a><i class=" dashicons  dashicons-no delete-img"></i></li>');
				}

				i++;
			});

			jQuery('.titan-car-listing-button').siblings('.attechments-ids').attr('value', attachment_ids);
			jQuery('.titan-car-listing-button').siblings('.cxc_multi_remove_image_button').show();

		});
		custom_uploader.on('open',function() {
			var selection = custom_uploader.state().get('selection');
			var ids_value = jQuery('.titan-car-listing-button').siblings('.attechments-ids').val();

			if(ids_value.length > 0) {
				var ids = ids_value.split(',');

				ids.forEach(function(id) {
					attachment = wp.media.attachment(id);
					attachment.fetch();
					selection.add(attachment ? [attachment] : []);
				});
			}
		});
		custom_uploader.open();
	});

    /*
     * Remove image event
     */
	jQuery('body').on('click', '.cxc_multi_remove_image_button', function () {
		jQuery(this).hide().prev().val('').prev().addClass('titan-car-listing-button').html('Add  Media');
		jQuery(this).parent().find('ul').empty();
		return false;
	});

	jQuery(document).on('click', '.cxc-multi-upload-medias ul li i.delete-img', function () {
		var ids = [];
		var attach_id =  jQuery(this).parents('li').attr('data-attechment-id');
		jQuery('.cxc-multi-upload-medias ul li').each(function () {
			if( attach_id != jQuery(this).attr('data-attechment-id') ){
				ids.push(jQuery(this).attr('data-attechment-id'));  
			}

		});
		jQuery(this).parents('.cxc-multi-upload-medias').find('input[type="hidden"]').val(ids);
		jQuery(this).parent().remove();               
	});

});