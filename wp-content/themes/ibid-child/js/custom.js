jQuery(document).ready(function (){
	//var startdaet = jQuery('#startDate').val();
	//var enddate = jQuery('#endDate').val();
	//jQuery("#endDate").rules('add', { greaterThan: "#startDate" });
    jQuery("#add_auction_form").validate({
		
        rules: {
		    proname:"required",
		    prodesc: "required",
		    _auction_start_price: "required",  
		    _auction_bid_increment: "required",  
		    _auction_reserved_price: "required",
		   _auction_dates_from: "required",
			_auction_dates_to: "required",
		    image: "required",
			au_custom_mat_type: "required",
			au_location:"required",
		    au_asking_price_ad: "required",
			//_auction_dates_to: { greaterThan: "#startDate" }
			// _auction_dates_from: {
            //     dateBefore: '#endDate',
            //     required: true
            // },
            // _auction_dates_to: {
            //     dateAfter: '#startDate',
            //     required: true
            // }
			//_auction_dates_from: { greaterThan: "#startDate" }
		},
		messages: {
		    proname:"Auction name is required",
		    prodesc: "Auction description is required",
		    _auction_start_price: "Auction price is required",  
		    _auction_bid_increment: "Bid increment is required",  
		    _auction_reserved_price: "Bid reserved price is required",
		    image: "Auction image is required",
			au_custom_mat_type: "Mat type is required",
			au_location:"Location is required",
		    au_asking_price_ad: "Asking price is required",
		    _auction_dates_from: "start date is required",
		    _auction_dates_to: "end date is required",
			//_auction_dates_from: "not allowed this type of dates",
		},
		errorPlacement: function(error, element) {
		    var placement = jQuery(element).data('error');
		    if (placement) {
		      jQuery(placement).append(error)
		    } else {
		      error.insertAfter(element);
		    }
		},
		submitHandler: function(form) {
		    form.submit();
		}
     });
    jQuery("#ad_form").validate({
        rules: {
		    proname:"required",
		    prodesc: "required",
		    image: "required",
			custom_mat_type: "required",
			ad_location:"required",
		    asking_price_ad: "required",
		    ad_amount_available:"required",
		},
		messages: {
		    proname:"Ad name is required",
		    prodesc: "Ad description is required",
		    image: "Ad image is required",
			custom_mat_type: "Mat type is required",
			ad_location:"Location is required",
		    asking_price_ad: "Asking price is required",
		    ad_amount_available:"Available amount is required",
		},
		errorPlacement: function(error, element) {
		    var placement = jQuery(element).data('error');
		    if (placement) {
		      jQuery(placement).append(error)
		    } else {
		      error.insertAfter(element);
		    }
		},
		submitHandler: function(form) {
			
		    form.submit();
			jQuery("#ad_submit_success").css('display','block');
		}
     });
    jQuery("#intrestModal #contactForm").validate({
        rules: {
		    quote_name:"required",
		    quote_email: "required",
		    quote_subject: "required",
		    quote_message: "required",
		    ad_offer_price: "required",
		},
		messages: {
		    quote_name:"Name is required",
		    quote_email: "Email is required",
		    quote_subject: "Subject is required",
		    quote_message: "Message is required",
		    ad_offer_price: "Offer price is required",
		},
		submitHandler: function(form) {
        	var AdForm = jQuery('#intrestModal #contactForm').serialize();
	        jQuery.ajax({
	            type: 'POST',
	            dataType: 'json',
	            url    : lsAjax.ajaxurl,
	            data   : {
				    'action': 'callback_function',
				    'AdForm': AdForm
				},
	            success: function(data){
	                jQuery("#success_msz").css('display','block');
	                jQuery('#intrestModal #contactForm')[0].reset();
	            }
	        });
	        return false;
		}
     });
    jQuery('#success_msz').delay(20000).fadeOut('slow');
	jQuery('#ad_submit_success').hide();
	jQuery( ".submit" ).on( "click", function() {
		jQuery('#success_msz').hide();
	});

	jQuery('.custom_type_matdiv').hide();
    jQuery("#mat_type").change(function() {
        if (jQuery(this).val() === 'Other'){ 
            jQuery('.custom_type_matdiv').show();    
        } else {
            jQuery('.custom_type_matdiv').hide(); 
        }
    });
	jQuery('.au_custom_type_matdiv').hide();
    jQuery("#au_mat_type").change(function() {
        if (jQuery(this).val() === 'Other'){ 
            jQuery('.au_custom_type_matdiv').show();    
        } else {
            jQuery('.au_custom_type_matdiv').hide(); 
        }
    });
	jQuery('.ad_img_erro').hide();
	jQuery(".ad_au_image_validation").on("change", function() {
		if (jQuery(".ad_au_image_validation")[0].files.length > 5) {
			//alert("You can select only 2 images");
			jQuery('.ad_img_erro').show();
			jQuery('.submit').prop('disabled', true);
		} else {
			jQuery('.ad_img_erro').hide();
			jQuery('.submit').prop('disabled', false);
		}
	});
	jQuery('.startend_date_erro').hide();
	jQuery("#auction_submit_btn").click(function () {
        var startdaet = jQuery('#startDate').val();
		var enddate = jQuery('#endDate').val();
		if(Date.parse(startdaet)>=Date.parse(enddate) && startdaet != '' && enddate != ''){
			jQuery('.startend_date_erro').show();
			return false;
		}
    });		
	jQuery('#startDate').datetimepicker({
		format: 'YYYY-MM-DD HH:mm',
		minDate: new Date().setDate(new Date().getDate()),
		sideBySide: false
	});
	// jQuery('#startDate').attr('autocomplete','off');
	// jQuery('#endDate').attr('autocomplete','off');
	// jQuery('#endDate').datetimepicker({
	// 	format: 'YYYY-MM-DD HH:mm',
	// 	minDate: new Date().setDate(new Date().getDate()),
	// 	sideBySide: false
	// });
	jQuery('.prevent_alpha').attr('autocomplete','off');
	jQuery('#au_asking_price_ad').keypress(function (e) {
		if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
		   jQuery(".au_asking_price_ad_errmsg").html("Digits Only").show().fadeOut("slow");
				  return false;
	   }
	});
	jQuery('#_auction_start_price').keypress(function (e) {
		if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
		   jQuery("._auction_start_price_errmsg").html("Digits Only").show().fadeOut("slow");
				  return false;
	   }
	});
	jQuery('#_auction_bid_increment').keypress(function (e) {
		if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
		   jQuery("._auction_bid_increment_errmsg").html("Digits Only").show().fadeOut("slow");
				  return false;
	   }
	});
	jQuery('#asking_price_ad').keypress(function (e) {
		if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
		   jQuery(".asking_price_ad_errmsg").html("Digits Only").show().fadeOut("slow");
				  return false;
	   }
	});
	jQuery('#ad_offer_price').keypress(function (e) {
		if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
		   jQuery(".ad_offer_price_errmsg").html("Digits Only").show().fadeOut("slow");
				  return false;
	   }
	});
	jQuery('#contact_number').keypress(function (e) {
		if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
		   jQuery(".contact_number_errmsg").html("Digits Only").show().fadeOut("slow");
				  return false;
	   }
	});
	jQuery('.woocommerce-product-gallery__wrapper :nth-child(n+2)').nextAll().addClass('custom_product_gallery_img');
	jQuery.fn.ForceNumericOnly =
	function()
	{
	    return this.each(function()
	    {
	        $(this).keydown(function(e)
	        {
	            var key = e.charCode || e.keyCode || 0;
	            // allow backspace, tab, delete, enter, arrows, numbers and keypad numbers ONLY
	            // home, end, period, and numpad decimal
	            return (
	                key == 8 || 
	                key == 9 ||
	                key == 13 ||
	                key == 46 ||
	                key == 110 ||
	                key == 190 ||
	                (key >= 35 && key <= 40) ||
	                (key >= 48 && key <= 57) ||
	                (key >= 96 && key <= 105));
	        });
	    });
	};

	jQuery('#switcher_list_view').click(function(){ 
		jQuery('#map').hide(); 
		jQuery('#ads_listing_view').show(); 
		jQuery(this).addClass('active-view'); 
		jQuery(this).parent().addClass('active_switcher'); 
		jQuery('#switcher_map_view').removeClass('active-view'); 
		jQuery('#switcher_map_view').parent().removeClass('active_switcher'); 
	}); 
	jQuery('#switcher_map_view').click(function(){ 
		jQuery('#ads_listing_view').hide(); 
		jQuery(this).addClass('active-view');
		jQuery(this).parent().addClass('active_switcher');  
		jQuery('#switcher_list_view').removeClass('active-view'); 
		jQuery('#switcher_list_view').parent().removeClass('active_switcher'); 
		jQuery('#map').show(); 
	});
	jQuery('.filte_hide_icon').click(function(){ 
		//jQuery('#filte_hide').css("display","block");
		jQuery(".filte_hide").addClass('showHideFilter');
		//jQuery(this).toggleClass('filterClose');
		jQuery('.filte_hide').removeClass('closeFilters');
	});
	jQuery('.close_filter').click(function(){ 
		jQuery(".filte_hide").addClass('closeFilters');
		jQuery('.filte_hide').removeClass('showHideFilter');
	});
	
	//alert(selected_province);
	//console.log(selected_province);
});

// [START maps_custom_markers]
// let map;

// function initMap() {
//   map = new google.maps.Map(document.getElementById("map"), {
//     center: new google.maps.LatLng(-33.91722, 151.23064),
//     zoom: 16,
//   });

//   const iconBase =
//     "https://developers.google.com/maps/documentation/javascript/examples/full/images/";
//   const icons = {
//     parking: {
//       icon: iconBase + "parking_lot_maps.png",
//     }
//   };
//   const features = [
//     {
//       position: new google.maps.LatLng(61.8177664, -111.9872506),
//       type: "parking",
//     },
//     {
//       position: new google.maps.LatLng(-33.916365282092855, 151.22937399734496),
//       type: "parking",
//     },
//     {
//       position: new google.maps.LatLng(-33.91665018901448, 151.2282474695587),
//       type: "parking",
//     },
//     {
//       position: new google.maps.LatLng(-33.919543720969806, 151.23112279762267),
//       type: "parking",
//     },
//     {
//       position: new google.maps.LatLng(-33.91608037421864, 151.23288232673644),
//       type: "parking",
//     },
//     {
//       position: new google.maps.LatLng(-33.91851096391805, 151.2344058214569),
//       type: "parking",
//     },
//     {
//       position: new google.maps.LatLng(-33.91818154739766, 151.2346203981781),
//       type: "parking",
//     },
//   ];

//   // Create markers.
//   for (let i = 0; i < features.length; i++) {
//     const marker = new google.maps.Marker({
//       position: features[i].position,
//       icon: icons[features[i].type].icon,
//       map: map,
//     });
//   }
// }
// // [END maps_custom_markers]