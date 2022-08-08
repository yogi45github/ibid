jQuery(document).ready(function (){ 
	jQuery('#ad_province').on('change', function() {
	  	var selected_province = jQuery(this).val();
        jQuery('#ad_city').html('');
        if(selected_province != '') {
            jQuery.ajax({
                type: 'POST',
                url    : lsAjax.ajaxurl,
                dataType: 'json',
                data   : {
                    'action': 'load_city_ajax',
                    'selected_province': selected_province,
                },
                success: function(response){
                   var status=response.status;
                   var city_html=response.city_html;
                   if (status == 'success') {
                   	jQuery('#ad_city').html(city_html);
                   }
                   console.log(city_html);
                }
            });
        }
	});
});

jQuery(window).load(function() {
    var selected_province = jQuery('#ad_province :selected').text();
    var cur_postid = jQuery("#ad_province").attr("post-id");
        jQuery.ajax({
            type: 'POST',
            url    : lsAjax.ajaxurl,
            dataType: 'json',
            data   : {
                'action': 'load_city_ajax',
                'selected_province': selected_province,
                'cur_postid': cur_postid,
            },
            success: function(response){
               var status=response.status;
               var city_html=response.city_html;
               if (status == 'success') {
               	jQuery('#ad_city').html(city_html);
               }
               //console.log(city_html);
            }
        });
});
