jQuery(document).ready( function($){
  
  $('#apf-product-form').on('submit', function (e) {
    e.preventDefault();
    $('.apf-modal').show();
    $('.apf-modal .apf-loading-section').show();

    // Initialize tinyMCE for wp_editor
    tinyMCE.triggerSave();

    var form_data = $(this).serializeArray();
    // Clean multiple select and transform into array
    form_data = form_data.filter(x => x.name !== 'upsell_ids');
    form_data = form_data.filter(x => x.name !== 'crossell_ids');
    form_data.push({ name: 'upsell_ids',value: $('#apf-upsell').val()});
    form_data.push({ name: 'crossell_ids',value: $('#apf-crossell').val()});

    var categories_formatted = $('input[name="apf_product_cat[]"]:checked').map(function(){ 
        return this.value; 
    }).get();
    // Attribute
    var attr_name = $('input:text.attr_name').serializeArray();
    var attr_values = $('select.attribute_value').serializeArray();
    var attr_is_visible = $('.attribute_visibility').serializeArray();
    
    var attr_formatted = {};
    for (let index = 0; index < attr_name.length; index++) {
      attr_formatted[attr_name[index].value] = {val: attr_values[index].value, visibility:  attr_is_visible[index] ? attr_is_visible[index].value : 'off'};
    }

    // Custom attribute
    var cus_attr_names = $('input:text.cus_attribute_name').serializeArray();
    var cus_attr_values = $('textarea.cus_attribute_value').serializeArray();
    var cus_attr_is_visible = $('.cus_attribute_visibility').serializeArray();
    var cus_attr_formatted = {};
    for (let index = 0; index < cus_attr_names.length; index++) {
      cus_attr_formatted[cus_attr_names[index].value] = {val: cus_attr_values[index].value, visibility:  cus_attr_is_visible[index] ? cus_attr_is_visible[index].value : 'off'};
    }
    var data = {
      action: 'save_simple_product',
      security : savesimpleproduct.security,
      formdata: form_data,
      attributes: attr_formatted,
      custom_attributes: cus_attr_formatted,
      categories: categories_formatted
    };

    $.post(savesimpleproduct.ajax_url, data, function(response) {
      if(response.success) {
        $('.apf-modal .apf-loading-section').hide();
        $('.apf-p-name span').append('<b><a href="'+response.data.permalink+'">'+response.data.prod_name+'</a></b>');
        $('.apf-modal .apf-modal-content .apf-modal-result').show();
      }
      else {
        $('.apf-modal .apf-loading-section').hide();
        $('.apf-modal .apf-modal-content .apf-modal-result-error .apf-modal-main-section p').html(response.data.description);
        $('.apf-modal .apf-modal-content .apf-modal-result-error').show();
      }

    });
  });

  $('.apf-modal .apf-modal-result button').on('click', function(e) {
    location.reload();
  });

  $('.apf-modal .apf-modal-result-error button').on('click', function(e) {
    $('.apf-modal .apf-modal-content .apf-modal-result-error').hide();
    $('.apf-modal').hide();
  });
});