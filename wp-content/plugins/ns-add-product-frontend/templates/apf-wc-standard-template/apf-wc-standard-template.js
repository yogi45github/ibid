var allTags = [];
jQuery(document).ready( function($){
    // Select product options
    $('.apf-tab-option a').on('click', function(t) {
        t.preventDefault();
        $('.apf-tab-option.active.active').removeClass('active');
        $panel = $(this).attr('href'),
        $('.apf-option-panel').addClass('apf-hide-section');
        $($panel).removeClass('apf-hide-section');
        $(this).parent().addClass('active');
    });

    // Show Manage Stock
    $('#apf-manage-stock').click(function() {
        if( $(this).is(':checked')) {
            $(".apf-manage-stock-section").show();
            $('.apf-stock-status-option').hide();
        } else {
            $(".apf-manage-stock-section").hide();
            $('.apf-stock-status-option').show();
        }
    });

    // Selectize multi options
    $('.apf-selectize-multiple').selectize({
        delimiter: ',',
        persist: false,
        create: function(input) {
            return {
                value: input,
                text: input
            }
        }
    });

    // Adding tags animations
    $('#apf-add-tag').on('click', function(t) {
        let inputValues = $('#apf-input-values').val();

        if(inputValues == '') {
            return;
        }

        while(inputValues.endsWith(',')) {
            inputValues = inputValues.slice(0,-1);
            if(inputValues == '') {
                return;
            }
        }
        let inputArray = inputValues.split(',');
        $('#apf-input-values').val('');

        inputArray.forEach(element => {
            $('.apf-tagchecklist').append('<li><button type="button" onclick="apfRemoveTag(this, \''+ element +'\');" class="apf-remove-tag-button"><span class="apf-remove-tag-icon" aria-hidden="true"></span></button>'+element+'</li>');
            allTags.push(element);
        });

        $('#apf-input-values-hidden').val(allTags);
        
    });

    // WP media modal product image
    $(".apf-upload-image-button").on("click",  function (e) {
        e.preventDefault();
        var $link = $(this);

        // Create the media frame.
        var file_frame = wp.media.frames.file_frame = wp.media({
           title: 'Select or upload image',
           library: {
              type: 'image' // specific mime
           },
           button: {
              text: 'Select'
           },
           multiple: false  // Set to true to allow multiple files to be selected
        });
  
        // When an image is selected, run a callback.
        file_frame.on('select', function () {
           let attachment = file_frame.state().get('selection').first().toJSON();
           $link.siblings('input').val(attachment.id).change();
           $link.siblings('img').prop('src', attachment.url);
           $('.apf-upload-image-button').hide();
           $('.apf-remove-image-button').show();
           $('.apf-image-product-descr').show();
           $('.apf-product-image').show();
        });
        file_frame.open();
     });

    //  Emulating click on '.apf-upload-image-button', on click over image
     $('.apf-product-image').on("click",  function (e) {
        $(".apf-upload-image-button").click();
     });

    // Remove image selected
     $('.apf-remove-image-button').on("click",  function (e) {
        e.preventDefault();
        var $link = $(this);
        $link.siblings('input').val('').change();
        $link.siblings('img').prop('src', '#');
        $('.apf-upload-image-button').show();
        $('.apf-remove-image-button').hide();
        $('.apf-image-product-descr').hide();
        $('.apf-product-image').hide();
    });

    // WP media modal product gallery
    $(".apf-upload-gallery-button").on("click",  function (e) {
        e.preventDefault();
        var $link = $(this);

        // Create the media frame.
        let file_frame = wp.media.frames.file_frame = wp.media({
           title: 'Select or upload image',
           library: {
              type: 'image' // specific mime
           },
           button: {
              text: 'Select'
           },
           multiple: true  // Set to true to allow multiple files to be selected
        });
  
        // When an image is selected, run a callback.
        file_frame.on('select', function () {
            var gallery_ids = [];
            var attachments = file_frame.state().get('selection').toJSON();
            $('.apf-gallery-imgs').html('');
            attachments.forEach(element => {
                gallery_ids.push(element.id);
                $('.apf-gallery-imgs').append('<li class="apf-image-gallery" data-attachment_id="'+element.id+'" style="background-image: url(\''+element.url+'\'); background-repeat: no-repeat; background-size: cover;"><a onclick="apfRemoveGalleryImg(this, '+element.id+');" class="apf-remove-img apf-hide-section"></a></li>');
            });
            $link.siblings('input').val(gallery_ids).change();
        });
        file_frame.open();
    });

});

// Removing tags animations
function apfRemoveTag(elem, name) {
    let oldVal = jQuery('#apf-input-values-hidden').val();
    let newVal = oldVal.replace(name, "");
    newVal = newVal.replace(',,', ",");
    jQuery('#apf-input-values-hidden').val(newVal);

    allTags = allTags.filter(function(elem){
        return elem != name; 
    });

    elem.parentElement.remove();
}

// Remove image from gallery
function apfRemoveGalleryImg(elem, id) {
    
    let oldVal = jQuery('#apf-gallery-ids').val().split(',');
    let newVal = jQuery.grep(oldVal, function(value) {
        return value != id;
    });
    jQuery('#apf-gallery-ids').val(newVal)
    elem.parentElement.remove();
}