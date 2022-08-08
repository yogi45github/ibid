jQuery(document).ready( function($){
    
    $('#apf-add-attribute').on('click', function(e) {
      $('#apf-attributes-product-data .apf-option-group').hide();
      $('.apf-attribute-loader').show();
      var sel_attribute = $('#apf-attributes-select').val();
      var data = {
        action: 'add_product_attributes',
        security : productattributes.security,
        attribute: sel_attribute
      };
    
      $.post(productattributes.ajax_url, data, function(response) {
        $('.apf-product_attributes').append(response);
        $('.apf-attribute-loader').hide();
        $('#apf-attributes-product-data .apf-option-group').fadeIn();
      });
    });

  });

  function apfRemoveAttr(_this) {
    _this.parentNode.parentNode.remove();
  }