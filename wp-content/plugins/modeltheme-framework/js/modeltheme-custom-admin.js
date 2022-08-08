/*
 File name:          Custom Admin JS
*/


(function ($) {
  'use strict';

	jQuery( document ).ready(function() {

		// ... Start Admin JS here ...

	    jQuery( "#redux_demo-ibid_skin_color .redux-image-select" ).on( "click", function() {
	      
	        if (jQuery(this).attr('class') == 'redux-image-select ibid_skin_color_1 redux-image-select-selected'){
	            var bg_color = "#00ADEF";
	            var bg_color_hover = "#0096d1";
	            var bg_color_semitransparent = "rgba(0, 173, 239, 0.95)";

		        // Links Color Option - Regular
		        jQuery('#mt_global_link_styling-regular').val(bg_color);
		        jQuery('#mt_global_link_styling-regular').parent().parent().find('.wp-color-result').css("background-color", bg_color);
		        // Links Color Option - Hover
		        jQuery('#mt_global_link_styling-hover').val(bg_color_hover);
		        jQuery('#mt_global_link_styling-hover').parent().parent().find('.wp-color-result').css("background-color", bg_color_hover);
		        // Links Color Option - Active
		        jQuery('#mt_global_link_styling-active').val(bg_color_hover);
		        jQuery('#mt_global_link_styling-active').parent().parent().find('.wp-color-result').css("background-color", bg_color_hover);
		        // Main texts color
		        jQuery('#mt_style_main_texts_color-color').val(bg_color);
		        jQuery('#mt_style_main_texts_color-color').parent().parent().find('.wp-color-result').css("background-color", bg_color);
		        // Main backgrounds color
		        jQuery('#mt_style_main_backgrounds_color-color').val(bg_color);
		        jQuery('#mt_style_main_backgrounds_color-color').parent().parent().find('.wp-color-result').css("background-color", bg_color);
		        // Main backgrounds color (hover)
		        jQuery('#mt_style_main_backgrounds_color_hover-color').val(bg_color_hover);
		        jQuery('#mt_style_main_backgrounds_color_hover-color').parent().parent().find('.wp-color-result').css("background-color", bg_color_hover);
		        // Text selection background color
		        jQuery('#mt_text_selection_background_color-color').val(bg_color);
		        jQuery('#mt_text_selection_background_color-color').parent().parent().find('.wp-color-result').css("background-color", bg_color);
		        // Nav Submenu Hover Background Color
		        jQuery('#mt_nav_submenu_hover_background_color-color').val(bg_color);
		        jQuery('#mt_nav_submenu_hover_background_color-color').parent().parent().find('.wp-color-result').css("background-color", bg_color);
		        //Semitransparent blocks background
		        jQuery('#redux_demo-mt_style_semi_opacity_backgrounds').find('.sp-preview-inner').css("background-color", bg_color_semitransparent);
		        jQuery('#mt_style_semi_opacity_backgrounds-color[data-id=mt_style_semi_opacity_backgrounds]').attr({'value': bg_color_semitransparent, 'data-color': bg_color_semitransparent});
		        jQuery('#mt_style_semi_opacity_backgrounds-color[data-id=mt_style_semi_opacity_backgrounds-rgba]').val(bg_color_semitransparent);
		        jQuery('#mt_style_semi_opacity_backgrounds-color[data-id=mt_style_semi_opacity_backgrounds-color]').val(bg_color);

	        }  



	        if (jQuery(this).attr('class') == 'redux-image-select ibid_skin_color_2 redux-image-select-selected'){
	            var bg_color = '#2DCC70';
	            var bg_color_hover = '#27ae60';
	            var bg_color_semitransparent = 'rgba(46, 204, 113, 0.95)';

		        // Links Color Option - Regular
		        jQuery('#mt_global_link_styling-regular').val(bg_color);
		        jQuery('#mt_global_link_styling-regular').parent().parent().find('.wp-color-result').css("background-color", bg_color);
		        // Links Color Option - Hover
		        jQuery('#mt_global_link_styling-hover').val(bg_color_hover);
		        jQuery('#mt_global_link_styling-hover').parent().parent().find('.wp-color-result').css("background-color", bg_color_hover);
		        // Links Color Option - Active
		        jQuery('#mt_global_link_styling-active').val(bg_color_hover);
		        jQuery('#mt_global_link_styling-active').parent().parent().find('.wp-color-result').css("background-color", bg_color_hover);
		        // Main texts color
		        jQuery('#mt_style_main_texts_color-color').val(bg_color);
		        jQuery('#mt_style_main_texts_color-color').parent().parent().find('.wp-color-result').css("background-color", bg_color);
		        // Main backgrounds color
		        jQuery('#mt_style_main_backgrounds_color-color').val(bg_color);
		        jQuery('#mt_style_main_backgrounds_color-color').parent().parent().find('.wp-color-result').css("background-color", bg_color);
		        // Main backgrounds color (hover)
		        jQuery('#mt_style_main_backgrounds_color_hover-color').val(bg_color_hover);
		        jQuery('#mt_style_main_backgrounds_color_hover-color').parent().parent().find('.wp-color-result').css("background-color", bg_color_hover);
		        // Text selection background color
		        jQuery('#mt_text_selection_background_color-color').val(bg_color);
		        jQuery('#mt_text_selection_background_color-color').parent().parent().find('.wp-color-result').css("background-color", bg_color);
		        // Nav Submenu Hover Background Color
		        jQuery('#mt_nav_submenu_hover_background_color-color').val(bg_color);
		        jQuery('#mt_nav_submenu_hover_background_color-color').parent().parent().find('.wp-color-result').css("background-color", bg_color);
		        //Semitransparent blocks background
		        jQuery('#redux_demo-mt_style_semi_opacity_backgrounds').find('.sp-preview-inner').css("background-color", bg_color_semitransparent);
		        jQuery('#mt_style_semi_opacity_backgrounds-color[data-id=mt_style_semi_opacity_backgrounds]').attr({'value': bg_color_semitransparent, 'data-color': bg_color_semitransparent});
		        jQuery('#mt_style_semi_opacity_backgrounds-color[data-id=mt_style_semi_opacity_backgrounds-rgba]').val(bg_color_semitransparent);
		        jQuery('#mt_style_semi_opacity_backgrounds-color[data-id=mt_style_semi_opacity_backgrounds-color]').val(bg_color);

	        }



	        if (jQuery(this).attr('class') == 'redux-image-select ibid_skin_color_3 redux-image-select-selected'){
	            var bg_color = '#1BBC9B';
	            var bg_color_hover = '#16a085';
	            var bg_color_semitransparent = 'rgba(26, 188, 156, 0.95)';

		        // Links Color Option - Regular
		        jQuery('#mt_global_link_styling-regular').val(bg_color);
		        jQuery('#mt_global_link_styling-regular').parent().parent().find('.wp-color-result').css("background-color", bg_color);
		        // Links Color Option - Hover
		        jQuery('#mt_global_link_styling-hover').val(bg_color_hover);
		        jQuery('#mt_global_link_styling-hover').parent().parent().find('.wp-color-result').css("background-color", bg_color_hover);
		        // Links Color Option - Active
		        jQuery('#mt_global_link_styling-active').val(bg_color_hover);
		        jQuery('#mt_global_link_styling-active').parent().parent().find('.wp-color-result').css("background-color", bg_color_hover);
		        // Main texts color
		        jQuery('#mt_style_main_texts_color-color').val(bg_color);
		        jQuery('#mt_style_main_texts_color-color').parent().parent().find('.wp-color-result').css("background-color", bg_color);
		        // Main backgrounds color
		        jQuery('#mt_style_main_backgrounds_color-color').val(bg_color);
		        jQuery('#mt_style_main_backgrounds_color-color').parent().parent().find('.wp-color-result').css("background-color", bg_color);
		        // Main backgrounds color (hover)
		        jQuery('#mt_style_main_backgrounds_color_hover-color').val(bg_color_hover);
		        jQuery('#mt_style_main_backgrounds_color_hover-color').parent().parent().find('.wp-color-result').css("background-color", bg_color_hover);
		        // Text selection background color
		        jQuery('#mt_text_selection_background_color-color').val(bg_color);
		        jQuery('#mt_text_selection_background_color-color').parent().parent().find('.wp-color-result').css("background-color", bg_color);
		        // Nav Submenu Hover Background Color
		        jQuery('#mt_nav_submenu_hover_background_color-color').val(bg_color);
		        jQuery('#mt_nav_submenu_hover_background_color-color').parent().parent().find('.wp-color-result').css("background-color", bg_color);
		        //Semitransparent blocks background
		        jQuery('#redux_demo-mt_style_semi_opacity_backgrounds').find('.sp-preview-inner').css("background-color", bg_color_semitransparent);
		        jQuery('#mt_style_semi_opacity_backgrounds-color[data-id=mt_style_semi_opacity_backgrounds]').attr({'value': bg_color_semitransparent, 'data-color': bg_color_semitransparent});
		        jQuery('#mt_style_semi_opacity_backgrounds-color[data-id=mt_style_semi_opacity_backgrounds-rgba]').val(bg_color_semitransparent);
		        jQuery('#mt_style_semi_opacity_backgrounds-color[data-id=mt_style_semi_opacity_backgrounds-color]').val(bg_color);

	        }



	        if (jQuery(this).attr('class') == 'redux-image-select ibid_skin_color_4 redux-image-select-selected'){
	            var bg_color = '#95A5A5';
	            var bg_color_hover = '#7f8c8d';
	            var bg_color_semitransparent = 'rgba(149, 165, 166, 0.95)';

		        // Links Color Option - Regular
		        jQuery('#mt_global_link_styling-regular').val(bg_color);
		        jQuery('#mt_global_link_styling-regular').parent().parent().find('.wp-color-result').css("background-color", bg_color);
		        // Links Color Option - Hover
		        jQuery('#mt_global_link_styling-hover').val(bg_color_hover);
		        jQuery('#mt_global_link_styling-hover').parent().parent().find('.wp-color-result').css("background-color", bg_color_hover);
		        // Links Color Option - Active
		        jQuery('#mt_global_link_styling-active').val(bg_color_hover);
		        jQuery('#mt_global_link_styling-active').parent().parent().find('.wp-color-result').css("background-color", bg_color_hover);
		        // Main texts color
		        jQuery('#mt_style_main_texts_color-color').val(bg_color);
		        jQuery('#mt_style_main_texts_color-color').parent().parent().find('.wp-color-result').css("background-color", bg_color);
		        // Main backgrounds color
		        jQuery('#mt_style_main_backgrounds_color-color').val(bg_color);
		        jQuery('#mt_style_main_backgrounds_color-color').parent().parent().find('.wp-color-result').css("background-color", bg_color);
		        // Main backgrounds color (hover)
		        jQuery('#mt_style_main_backgrounds_color_hover-color').val(bg_color_hover);
		        jQuery('#mt_style_main_backgrounds_color_hover-color').parent().parent().find('.wp-color-result').css("background-color", bg_color_hover);
		        // Text selection background color
		        jQuery('#mt_text_selection_background_color-color').val(bg_color);
		        jQuery('#mt_text_selection_background_color-color').parent().parent().find('.wp-color-result').css("background-color", bg_color);
		        // Nav Submenu Hover Background Color
		        jQuery('#mt_nav_submenu_hover_background_color-color').val(bg_color);
		        jQuery('#mt_nav_submenu_hover_background_color-color').parent().parent().find('.wp-color-result').css("background-color", bg_color);
		        //Semitransparent blocks background
		        jQuery('#redux_demo-mt_style_semi_opacity_backgrounds').find('.sp-preview-inner').css("background-color", bg_color_semitransparent);
		        jQuery('#mt_style_semi_opacity_backgrounds-color[data-id=mt_style_semi_opacity_backgrounds]').attr({'value': bg_color_semitransparent, 'data-color': bg_color_semitransparent});
		        jQuery('#mt_style_semi_opacity_backgrounds-color[data-id=mt_style_semi_opacity_backgrounds-rgba]').val(bg_color_semitransparent);
		        jQuery('#mt_style_semi_opacity_backgrounds-color[data-id=mt_style_semi_opacity_backgrounds-color]').val(bg_color);

	        }




	        if (jQuery(this).attr('class') == 'redux-image-select ibid_skin_color_5 redux-image-select-selected'){
	            var bg_color = '#E77E23';
	            var bg_color_hover = '#d35400';
	            var bg_color_semitransparent = 'rgba(230, 126, 34, 0.95)';

		        // Links Color Option - Regular
		        jQuery('#mt_global_link_styling-regular').val(bg_color);
		        jQuery('#mt_global_link_styling-regular').parent().parent().find('.wp-color-result').css("background-color", bg_color);
		        // Links Color Option - Hover
		        jQuery('#mt_global_link_styling-hover').val(bg_color_hover);
		        jQuery('#mt_global_link_styling-hover').parent().parent().find('.wp-color-result').css("background-color", bg_color_hover);
		        // Links Color Option - Active
		        jQuery('#mt_global_link_styling-active').val(bg_color_hover);
		        jQuery('#mt_global_link_styling-active').parent().parent().find('.wp-color-result').css("background-color", bg_color_hover);
		        // Main texts color
		        jQuery('#mt_style_main_texts_color-color').val(bg_color);
		        jQuery('#mt_style_main_texts_color-color').parent().parent().find('.wp-color-result').css("background-color", bg_color);
		        // Main backgrounds color
		        jQuery('#mt_style_main_backgrounds_color-color').val(bg_color);
		        jQuery('#mt_style_main_backgrounds_color-color').parent().parent().find('.wp-color-result').css("background-color", bg_color);
		        // Main backgrounds color (hover)
		        jQuery('#mt_style_main_backgrounds_color_hover-color').val(bg_color_hover);
		        jQuery('#mt_style_main_backgrounds_color_hover-color').parent().parent().find('.wp-color-result').css("background-color", bg_color_hover);
		        // Text selection background color
		        jQuery('#mt_text_selection_background_color-color').val(bg_color);
		        jQuery('#mt_text_selection_background_color-color').parent().parent().find('.wp-color-result').css("background-color", bg_color);
		        // Nav Submenu Hover Background Color
		        jQuery('#mt_nav_submenu_hover_background_color-color').val(bg_color);
		        jQuery('#mt_nav_submenu_hover_background_color-color').parent().parent().find('.wp-color-result').css("background-color", bg_color);
		        //Semitransparent blocks background
		        jQuery('#redux_demo-mt_style_semi_opacity_backgrounds').find('.sp-preview-inner').css("background-color", bg_color_semitransparent);
		        jQuery('#mt_style_semi_opacity_backgrounds-color[data-id=mt_style_semi_opacity_backgrounds]').attr({'value': bg_color_semitransparent, 'data-color': bg_color_semitransparent});
		        jQuery('#mt_style_semi_opacity_backgrounds-color[data-id=mt_style_semi_opacity_backgrounds-rgba]').val(bg_color_semitransparent);
		        jQuery('#mt_style_semi_opacity_backgrounds-color[data-id=mt_style_semi_opacity_backgrounds-color]').val(bg_color);

	        }




	        if (jQuery(this).attr('class') == 'redux-image-select ibid_skin_color_6 redux-image-select-selected'){
	            var bg_color = '#E84C3D';
	            var bg_color_hover = '#c0392b';
	            var bg_color_semitransparent = 'rgba(231, 76, 60, 0.95)';

		        // Links Color Option - Regular
		        jQuery('#mt_global_link_styling-regular').val(bg_color);
		        jQuery('#mt_global_link_styling-regular').parent().parent().find('.wp-color-result').css("background-color", bg_color);
		        // Links Color Option - Hover
		        jQuery('#mt_global_link_styling-hover').val(bg_color_hover);
		        jQuery('#mt_global_link_styling-hover').parent().parent().find('.wp-color-result').css("background-color", bg_color_hover);
		        // Links Color Option - Active
		        jQuery('#mt_global_link_styling-active').val(bg_color_hover);
		        jQuery('#mt_global_link_styling-active').parent().parent().find('.wp-color-result').css("background-color", bg_color_hover);
		        // Main texts color
		        jQuery('#mt_style_main_texts_color-color').val(bg_color);
		        jQuery('#mt_style_main_texts_color-color').parent().parent().find('.wp-color-result').css("background-color", bg_color);
		        // Main backgrounds color
		        jQuery('#mt_style_main_backgrounds_color-color').val(bg_color);
		        jQuery('#mt_style_main_backgrounds_color-color').parent().parent().find('.wp-color-result').css("background-color", bg_color);
		        // Main backgrounds color (hover)
		        jQuery('#mt_style_main_backgrounds_color_hover-color').val(bg_color_hover);
		        jQuery('#mt_style_main_backgrounds_color_hover-color').parent().parent().find('.wp-color-result').css("background-color", bg_color_hover);
		        // Text selection background color
		        jQuery('#mt_text_selection_background_color-color').val(bg_color);
		        jQuery('#mt_text_selection_background_color-color').parent().parent().find('.wp-color-result').css("background-color", bg_color);
		        // Nav Submenu Hover Background Color
		        jQuery('#mt_nav_submenu_hover_background_color-color').val(bg_color);
		        jQuery('#mt_nav_submenu_hover_background_color-color').parent().parent().find('.wp-color-result').css("background-color", bg_color);
		        //Semitransparent blocks background
		        jQuery('#redux_demo-mt_style_semi_opacity_backgrounds').find('.sp-preview-inner').css("background-color", bg_color_semitransparent);
		        jQuery('#mt_style_semi_opacity_backgrounds-color[data-id=mt_style_semi_opacity_backgrounds]').attr({'value': bg_color_semitransparent, 'data-color': bg_color_semitransparent});
		        jQuery('#mt_style_semi_opacity_backgrounds-color[data-id=mt_style_semi_opacity_backgrounds-rgba]').val(bg_color_semitransparent);
		        jQuery('#mt_style_semi_opacity_backgrounds-color[data-id=mt_style_semi_opacity_backgrounds-color]').val(bg_color);

	        }




	        if (jQuery(this).attr('class') == 'redux-image-select ibid_skin_color_7 redux-image-select-selected'){
	            var bg_color = '#F1C40F';
	            var bg_color_hover = '#f39c12';
	            var bg_color_semitransparent = 'rgba(241, 196, 15, 0.95)';

		        // Links Color Option - Regular
		        jQuery('#mt_global_link_styling-regular').val(bg_color);
		        jQuery('#mt_global_link_styling-regular').parent().parent().find('.wp-color-result').css("background-color", bg_color);
		        // Links Color Option - Hover
		        jQuery('#mt_global_link_styling-hover').val(bg_color_hover);
		        jQuery('#mt_global_link_styling-hover').parent().parent().find('.wp-color-result').css("background-color", bg_color_hover);
		        // Links Color Option - Active
		        jQuery('#mt_global_link_styling-active').val(bg_color_hover);
		        jQuery('#mt_global_link_styling-active').parent().parent().find('.wp-color-result').css("background-color", bg_color_hover);
		        // Main texts color
		        jQuery('#mt_style_main_texts_color-color').val(bg_color);
		        jQuery('#mt_style_main_texts_color-color').parent().parent().find('.wp-color-result').css("background-color", bg_color);
		        // Main backgrounds color
		        jQuery('#mt_style_main_backgrounds_color-color').val(bg_color);
		        jQuery('#mt_style_main_backgrounds_color-color').parent().parent().find('.wp-color-result').css("background-color", bg_color);
		        // Main backgrounds color (hover)
		        jQuery('#mt_style_main_backgrounds_color_hover-color').val(bg_color_hover);
		        jQuery('#mt_style_main_backgrounds_color_hover-color').parent().parent().find('.wp-color-result').css("background-color", bg_color_hover);
		        // Text selection background color
		        jQuery('#mt_text_selection_background_color-color').val(bg_color);
		        jQuery('#mt_text_selection_background_color-color').parent().parent().find('.wp-color-result').css("background-color", bg_color);
		        // Nav Submenu Hover Background Color
		        jQuery('#mt_nav_submenu_hover_background_color-color').val(bg_color);
		        jQuery('#mt_nav_submenu_hover_background_color-color').parent().parent().find('.wp-color-result').css("background-color", bg_color);
		        //Semitransparent blocks background
		        jQuery('#redux_demo-mt_style_semi_opacity_backgrounds').find('.sp-preview-inner').css("background-color", bg_color_semitransparent);
		        jQuery('#mt_style_semi_opacity_backgrounds-color[data-id=mt_style_semi_opacity_backgrounds]').attr({'value': bg_color_semitransparent, 'data-color': bg_color_semitransparent});
		        jQuery('#mt_style_semi_opacity_backgrounds-color[data-id=mt_style_semi_opacity_backgrounds-rgba]').val(bg_color_semitransparent);
		        jQuery('#mt_style_semi_opacity_backgrounds-color[data-id=mt_style_semi_opacity_backgrounds-color]').val(bg_color);

	        }




	        if (jQuery(this).attr('class') == 'redux-image-select ibid_skin_color_8 redux-image-select-selected'){
	            var bg_color = '#9B58B5';
	            var bg_color_hover = '#8e44ad';
	            var bg_color_semitransparent = 'rgba(155, 89, 182, 0.95)';

		        // Links Color Option - Regular
		        jQuery('#mt_global_link_styling-regular').val(bg_color);
		        jQuery('#mt_global_link_styling-regular').parent().parent().find('.wp-color-result').css("background-color", bg_color);
		        // Links Color Option - Hover
		        jQuery('#mt_global_link_styling-hover').val(bg_color_hover);
		        jQuery('#mt_global_link_styling-hover').parent().parent().find('.wp-color-result').css("background-color", bg_color_hover);
		        // Links Color Option - Active
		        jQuery('#mt_global_link_styling-active').val(bg_color_hover);
		        jQuery('#mt_global_link_styling-active').parent().parent().find('.wp-color-result').css("background-color", bg_color_hover);
		        // Main texts color
		        jQuery('#mt_style_main_texts_color-color').val(bg_color);
		        jQuery('#mt_style_main_texts_color-color').parent().parent().find('.wp-color-result').css("background-color", bg_color);
		        // Main backgrounds color
		        jQuery('#mt_style_main_backgrounds_color-color').val(bg_color);
		        jQuery('#mt_style_main_backgrounds_color-color').parent().parent().find('.wp-color-result').css("background-color", bg_color);
		        // Main backgrounds color (hover)
		        jQuery('#mt_style_main_backgrounds_color_hover-color').val(bg_color_hover);
		        jQuery('#mt_style_main_backgrounds_color_hover-color').parent().parent().find('.wp-color-result').css("background-color", bg_color_hover);
		        // Text selection background color
		        jQuery('#mt_text_selection_background_color-color').val(bg_color);
		        jQuery('#mt_text_selection_background_color-color').parent().parent().find('.wp-color-result').css("background-color", bg_color);
		        // Nav Submenu Hover Background Color
		        jQuery('#mt_nav_submenu_hover_background_color-color').val(bg_color);
		        jQuery('#mt_nav_submenu_hover_background_color-color').parent().parent().find('.wp-color-result').css("background-color", bg_color);
		        //Semitransparent blocks background
		        jQuery('#redux_demo-mt_style_semi_opacity_backgrounds').find('.sp-preview-inner').css("background-color", bg_color_semitransparent);
		        jQuery('#mt_style_semi_opacity_backgrounds-color[data-id=mt_style_semi_opacity_backgrounds]').attr({'value': bg_color_semitransparent, 'data-color': bg_color_semitransparent});
		        jQuery('#mt_style_semi_opacity_backgrounds-color[data-id=mt_style_semi_opacity_backgrounds-rgba]').val(bg_color_semitransparent);
		        jQuery('#mt_style_semi_opacity_backgrounds-color[data-id=mt_style_semi_opacity_backgrounds-color]').val(bg_color);

	        }


	      
	    });





	});
} (jQuery) )