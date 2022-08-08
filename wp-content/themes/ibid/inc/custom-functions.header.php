<?php
defined( 'ABSPATH' ) || exit;

/**
CUSTOM HEADER FUNCTIONS
*/

/**
||-> FUNCTION: GET SITE FONTS
*/
if (!function_exists('ibid_get_site_fonts')) {
	function ibid_get_site_fonts(){
	    global  $ibid_redux;
	    $fonts_string = '';
	    if (isset($ibid_redux['google_fonts_select'])) {
	        $i = 0;
	        $len = count($ibid_redux['google_fonts_select']);
	        foreach(array_keys($ibid_redux['google_fonts_select']) as $key){
	            $font_url = str_replace(' ', '+', $ibid_redux['google_fonts_select'][$key]);
	            
	            if ($i == $len - 1) {
	                // last
	                $fonts_string .= $font_url;
	            }else{
	                $fonts_string .= $font_url . '|';
	            }
	            $i++;
	        }
	        
	    }else{
	        $fonts_string = 'Montserrat:regular,500,600,700,800,900,latin|Poppins:300,regular,500,600,700,latin-ext,latin,devanagari|Nunito Sans:300,regular,700,latin|Signika:300,regular,600,700,latin-ext,latin';
	    }
	    // fonts url
	        $fonts_url = add_query_arg( 'family', $fonts_string, "//fonts.googleapis.com/css" );
	        // enqueue fonts
	        wp_enqueue_style( 'ibid-fonts', $fonts_url, array(), '1.0.0' );
	}
	add_action('wp_enqueue_scripts', 'ibid_get_site_fonts');
}

/**
||-> FUNCTION: GET DYNAMIC CSS
*/
if (!function_exists('ibid_dynamic_css')) {
	add_action('wp_enqueue_scripts', 'ibid_dynamic_css' );
	function ibid_dynamic_css(){
		wp_enqueue_style(
		   'ibid-custom-style',
		    get_template_directory_uri() . '/css/custom-editor-style.css'
		);
	   	
	    $html = '';
	   	if (is_page()) {
		    $ibid_custom_page_skin_color_status = get_post_meta( get_the_ID(), 'ibid_custom_page_skin_color_status', true );
			$ibid_global_page_color = get_post_meta( get_the_ID(), 'ibid_global_page_color', true );
			$ibid_global_page_color_hover = get_post_meta( get_the_ID(), 'ibid_global_page_color_hover', true );
			list($r, $g, $b) = sscanf($ibid_global_page_color, "#%02x%02x%02x");
			if (isset($ibid_custom_page_skin_color_status) AND $ibid_custom_page_skin_color_status == 'yes') {
				$ibid_style_main_texts_color = $ibid_global_page_color;
				$ibid_style_main_backgrounds_color = $ibid_global_page_color;
				$ibid_style_main_backgrounds_color_hover = $ibid_global_page_color_hover;
				
				$back_to_top = $ibid_global_page_color;
				$html .= '	.back-to-top{
								background-color: '.esc_html($ibid_style_main_backgrounds_color).'; 
							}';
			}else{
				$ibid_style_main_texts_color = ibid_redux("ibid_style_main_texts_color");
				$ibid_style_main_backgrounds_color = ibid_redux("ibid_style_main_backgrounds_color");
				$ibid_style_main_backgrounds_color_hover = ibid_redux("ibid_style_main_backgrounds_color_hover");
				$ibid_style_semi_opacity_backgrounds = ibid_redux('ibid_style_semi_opacity_backgrounds', 'alpha');
			}
			
	   	}else{
			$ibid_style_main_texts_color = ibid_redux("ibid_style_main_texts_color");
			$ibid_style_main_backgrounds_color = ibid_redux("ibid_style_main_backgrounds_color");
			$ibid_style_main_backgrounds_color_hover = ibid_redux("ibid_style_main_backgrounds_color_hover");
			$ibid_style_semi_opacity_backgrounds = ibid_redux('ibid_style_semi_opacity_backgrounds', 'alpha');

			$html .= '	.back-to-top{
							background-color: '.esc_html($ibid_style_main_backgrounds_color).'; 
						}';
	   	}


	   	// CUSTOM CSS
	   	if (ibid_redux('ibid_css_editor') != '') {
	    	$html .= ibid_redux('ibid_css_editor');
	   	}

	    // THEME OPTIONS STYLESHEET - Responsive SmartPhones
	    if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
		    $html .= '
		    			@media only screen and (max-width: 767px) {
		    				body h1,
		    				body h1 span{
		    					font-size: '.ibid_redux('ibid_heading_h1_smartphones', 'font-size').' !important;
		    					line-height: '.ibid_redux('ibid_heading_h1_smartphones', 'line-height').' !important;
		    				}
		    				body h2{
		    					font-size: '.ibid_redux('ibid_heading_h2_smartphones', 'font-size').' !important;
		    					line-height: '.ibid_redux('ibid_heading_h2_smartphones', 'line-height').' !important;
		    				}
		    				body h3{
		    					font-size: '.ibid_redux('ibid_heading_h3_smartphones', 'font-size').' !important;
		    					line-height: '.ibid_redux('ibid_heading_h3_smartphones', 'line-height').' !important;
		    				}
		    				body h4{
		    					font-size: '.ibid_redux('ibid_heading_h4_smartphones', 'font-size').' !important;
		    					line-height: '.ibid_redux('ibid_heading_h4_smartphones', 'line-height').' !important;
		    				}
		    				body h5{
		    					font-size: '.ibid_redux('ibid_heading_h5_smartphones', 'font-size').' !important;
		    					line-height: '.ibid_redux('ibid_heading_h5_smartphones', 'line-height').' !important;
		    				}
		    				body h6{
		    					font-size: '.ibid_redux('ibid_heading_h6_smartphones', 'font-size').' !important;
		    					line-height: '.ibid_redux('ibid_heading_h6_smartphones', 'line-height').' !important;
		    				}
		    				.mega-menu-inline .menu-item-has-children{
		    					display: inline-block !important;
		    				}
		    			}
		    			';
		    // THEME OPTIONS STYLESHEET - Responsive Tablets
		    $html .= '
	    			@media only screen and (min-width: 768px) and (max-width: 1024px) {
	    				body h1,
	    				body h1 span{
	    					font-size: '.ibid_redux('ibid_heading_h1_tablets', 'font-size').' !important;
	    					line-height: '.ibid_redux('ibid_heading_h1_tablets', 'line-height').' !important;
	    				}
	    				body h2{
	    					font-size: '.ibid_redux('ibid_heading_h2_tablets', 'font-size').' !important;
	    					line-height: '.ibid_redux('ibid_heading_h2_tablets', 'line-height').' !important;
	    				}
	    				body h3{
	    					font-size: '.ibid_redux('ibid_heading_h3_tablets', 'font-size').' !important;
	    					line-height: '.ibid_redux('ibid_heading_h3_tablets', 'line-height').' !important;
	    				}
	    				body h4{
	    					font-size: '.ibid_redux('ibid_heading_h4_tablets', 'font-size').' !important;
	    					line-height: '.ibid_redux('ibid_heading_h4_tablets', 'line-height').' !important;
	    				}
	    				body h5{
	    					font-size: '.ibid_redux('ibid_heading_h5_tablets', 'font-size').' !important;
	    					line-height: '.ibid_redux('ibid_heading_h5_tablets', 'line-height').' !important;
	    				}
	    				body h6{
	    					font-size: '.ibid_redux('ibid_heading_h6_tablets', 'font-size').' !important;
	    					line-height: '.ibid_redux('ibid_heading_h6_tablets', 'line-height').' !important;
	    				}

	    			}';
		}


		if (class_exists('Dokan_Pro')) {
	    	$html .= 'body.dokan-dashboard .dokan-dash-sidebar ul.dokan-dashboard-menu li:hover a, body.dokan-dashboard .dokan-dash-sidebar ul.dokan-dashboard-menu li.active a{color: #fff !important;}';
		}


	    // THEME OPTIONS STYLESHEET
	    $html .= '
	    		footer .menu .menu-item a{
			    	color: '.ibid_redux('footer_bottom_color_links').';
			    }
    			.footer-top .widget-title, p.copyright{
			    	color: '.ibid_redux('footer_bottom_color_text').';
			    }
    			.top-footer div.left{
			    	color: '.ibid_redux('footer_top_color_text').';
			    }
    			li.nav-menu-account{
			    	color: '.ibid_redux('mt_style_bottom_header3_color').';
			    }
    			.header-v3 .navbar-default, 
    			.header-v3 nav#modeltheme-main-head{
			    	background-color: '.ibid_redux('mt_style_top_header3_color', 'background-color').';
			    }
			    .header-v2 .top-header{
			    	background-color: '.ibid_redux('mt_style_top_header2_color', 'background-color').';
			    }
			    .header-v2 .navbar-default{
			    	background-color: '.ibid_redux('mt_style_bottom_header2_color', 'background-color').';
			    }
		        .breadcrumb a::after {
		            content: "'.ibid_redux('breadcrumbs-delimitator').'";
		            content:"/";
		        }
		        .navbar-header .logo img {
		            max-width: '.esc_html(ibid_redux("logo_max_width")).'px;
		        }
			    ::selection{
			        color: '.ibid_redux('ibid_text_selection_color').';
			        background: '.ibid_redux('ibid_text_selection_background_color').';
			    }
			    ::-moz-selection { /* Code for Firefox */
			        color: '.ibid_redux('ibid_text_selection_color').';
			        background: '.ibid_redux('ibid_text_selection_background_color').';
			    }
			    a,
			    a:visited{
			        color: '.ibid_redux('ibid_global_link_styling', 'regular').';
			    }
			    a:focus,
			    a:hover{
			        color: '.ibid_redux('ibid_global_link_styling', 'hover').';
			    }
			    /*------------------------------------------------------------------
			        COLOR
			    ------------------------------------------------------------------*/
				span.amount
				table.compare-list .remove td a .remove,
				.woocommerce form .form-row .required,
				.woocommerce .woocommerce-info::before,
				.woocommerce .woocommerce-message::before,
				.woocommerce div.product p.price, 
				.woocommerce div.product span.price,
				.woocommerce div.product .woocommerce-tabs ul.tabs li.active,
				.widget_popular_recent_tabs .nav-tabs li.active a,
				.widget_product_categories .cat-item:hover,
				.widget_product_categories .cat-item a:hover,
				.widget_archive li:hover,
				.widget_archive li a:hover,
				.widget_categories .cat-item:hover,
				.widget_categories li a:hover,
				.woocommerce .star-rating span::before,
				.pricing-table.recomended .button.solid-button, 
				.pricing-table .table-content:hover .button.solid-button,
				.pricing-table.Recommended .button.solid-button, 
				.pricing-table.recommended .button.solid-button, 
				.pricing-table.recomended .button.solid-button, 
				.pricing-table .table-content:hover .button.solid-button,
				.testimonial-author,
				.testimonials-container blockquote::before,
				.testimonials-container blockquote::after,
				h1 span,
				h2 span,
				label.error,
				.woocommerce input.button:hover,
				.author-name,
				.comment_body .author_name,
				.prev-next-post a:hover,
				.prev-text,
				.next-text,
				.social ul li a:hover i,
				.wpcf7-form span.wpcf7-not-valid-tip,
				.text-dark .statistics .stats-head *,
				.wpb_button.btn-filled,
				.widget_meta a:hover,
				.logo span,
				a.shop_cart::after,
				.woocommerce ul.products li.product .archive-product-title a:hover,
				.shop_cart:hover,
				.widget_pages a:hover,
				.categories_shortcode .category.active, .categories_shortcode .category:hover,
				.widget_recent_entries_with_thumbnail li:hover a,
				.widget_recent_entries li a:hover,
				.wpb_button.btn-filled:hover,
				li.seller-name::before,
				li.store-address::before,
				li.store-name::before,
				.full-width-part .post-name a:hover,
				.full-width-part .post-category-comment-date a:hover, .article-details .post-author a:hover,
				.grid-view.col-md-12.list-view .more-link:hover,
				.woocommerce button.button:hover,
				.woocommerce button.button.alt:hover,
				.woocommerce div.product form.buy-now.cart .button:hover span.amount,
				.woocommerce a.button:hover,
				.wc_vendors_active form input[type="submit"]:hover,
				.wcv-dashboard-navigation li a:hover,
				.woocommerce ul.cart_list li:hover a, .woocommerce ul.product_list_widget li:hover a,
				a.add-wsawl.sa-watchlist-action:hover, a.remove-wsawl.sa-watchlist-action:hover,
				.top-footer .menu-search .btn.btn-primary:hover i.fa,
				footer .footer-top .menu .menu-item a:hover,
				wpcf7-form .wpcf7-submit:hover,
				.woocommerce a.button.alt:hover,
				.form-submit input:hover,
				.post-name i,
				.modal-content p i,
				#yith-wcwl-form input[type="submit"]:hover,
				.modeltheme-modal input[type="submit"]:hover,
				.modeltheme-modal button[type="submit"]:hover,
				form#login .submit_button:hover,
				blockquote::before,
				.no-results input[type="submit"]:hover,
				.form-submit input:hover,
				div#cat-drop-stack a:hover,
				.woocommerce-MyAccount-navigation-link > a:hover,
				.woocommerce-MyAccount-navigation-link.is-active > a,
				.countdown-amount,
				.featured_product_shortcode .countdown-amount,
				.featured_product_shortcode .countdown_amount,
				.sidebar-content .widget_nav_menu li a:hover,
				.woocommerce-account .woocommerce-MyAccount-content p a:hover,
				.woocommerce.single-product div.product.product-type-auction form.cart .button.single_add_to_cart_button span,
				.woocommerce.single-product div.product.product-type-auction form.cart .button.single_add_to_cart_button,
				.ibid-shop-sort-group .gridlist-toggle a span:before,
				#signup-modal-content .woocommerce-form-register.register .button[type="submit"]:hover {
				    color: '.esc_html($ibid_style_main_texts_color).';
				}
				a#register-modal:hover{
				    color: '.esc_html($ibid_style_main_texts_color).' !important;
				}
				.dokan-btn-theme a:hover, .dokan-btn-theme:hover, input[type="submit"].dokan-btn-danger:hover, input[type="submit"].dokan-btn-theme:hover,
				.woocommerce-MyAccount-navigation-link > a:hover,
				.woocommerce-MyAccount-navigation-link.is-active > a
				body .ibid_shortcode_blog .post-name a:hover,
				.masonry_banner .read-more:hover,
				.category-button a:hover,
				.dokan-single-store .profile-frame .profile-info-box .profile-info-summery-wrapper .profile-info-summery .profile-info i,
				.wpcf7-form .wpcf7-submit:hover,
				.product_meta > span a:hover,
				.dokan-dashboard .dokan-dashboard-wrap .delete a,
				.dokan-dashboard .dokan-dash-sidebar ul.dokan-dashboard-menu li.active a,
				.dokan-dashboard .dokan-dash-sidebar ul.dokan-dashboard-menu li a:hover,
				#dropdown-user-profile ul li a:hover,
				.widget_ibid_social_icons a,
				.header-v3 .menu-products .shop_cart,
				.simple-sitemap-container ul a:hover,
				.wishlist_table tr td.product-name a.button:hover,
				.dokan-dashboard .dokan-dash-sidebar ul.dokan-dashboard-menu li:hover, .dokan-dashboard .dokan-dash-sidebar ul.dokan-dashboard-menu li.dokan-common-links a:hover,
				.woocommerce div.product .woocommerce-tabs ul.tabs li.active a, .woocommerce div.product .woocommerce-tabs ul.tabs li:hover a, .mega_menu .cf-mega-menu li a:hover, .mega_menu .cf-mega-menu.sub-menu p a:hover,
				.woocommerce a.remove,
				.ibid_shortcode_cause .button-content a:hover,
				.ibid_shortcode_blog .image_top .blog-content p.author,
				.modeltheme_products_shadow .details-container > div.details-item .amount,
				.mt_products_slider .full .woocommerce-title-metas span.amount{
				    color: '.esc_html($ibid_style_main_texts_color).' !important;
				}
				.tagcloud > a:hover,
				 nav,
				.ibid-icon-search,
				.wpb_button::after,
				.rotate45,
				.latest-posts .post-date-day,
				.latest-posts h3, 
				.latest-tweets h3, 
				.latest-videos h3,
				.button.solid-button,
				.top-footer,
				.form-submit input,
				.page-template-template-blog .full-width-part .more-link, .full-width-part .more-link,
				button.vc_btn,
				.pricing-table.recomended .table-content, 
				.pricing-table .table-content:hover,
				.pricing-table.Recommended .table-content, 
				.pricing-table.recommended .table-content, 
				.pricing-table.recomended .table-content, 
				.pricing-table .table-content:hover,
				.block-triangle,
				.owl-theme .owl-controls .owl-page span,
				body .vc_btn.vc_btn-blue, 
				body a.vc_btn.vc_btn-blue, 
				body button.vc_btn.vc_btn-blue,
				.woocommerce #respond input#submit, 
				.woocommerce a.button, 
				.woocommerce button.button, 
				.woocommerce input.button,
				table.compare-list .add-to-cart td a,
				.woocommerce #respond input#submit.alt, 
				.woocommerce a.button.alt, 
				.woocommerce button.button.alt, 
				.woocommerce input.button.alt,
				.woocommerce a.remove:hover,
				.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
				.woocommerce nav.woocommerce-pagination ul li a:focus, 
				.woocommerce nav.woocommerce-pagination ul li a:hover, 
				.woocommerce nav.woocommerce-pagination ul li span.current, 
				.widget_social_icons li a:hover, 
				#subscribe > button[type="submit"],
				.social-sharer > li:hover,
				.prev-next-post a:hover .rotate45,
				.masonry_banner.default-skin,
				.member-footer .social::before, 
				.member-footer .social::after,
				.subscribe > button[type="submit"],
				.woocommerce #respond input#submit.alt.disabled, 
				.woocommerce #respond input#submit.alt.disabled:hover, 
				.woocommerce #respond input#submit.alt:disabled, 
				.woocommerce #respond input#submit.alt:disabled:hover, 
				.woocommerce #respond input#submit.alt[disabled]:disabled, 
				.woocommerce #respond input#submit.alt[disabled]:disabled:hover, 
				.woocommerce a.button.alt.disabled, 
				.woocommerce a.button.alt.disabled:hover, 
				.woocommerce a.button.alt:disabled, 
				.woocommerce a.button.alt:disabled:hover, 
				.woocommerce a.button.alt[disabled]:disabled, 
				.woocommerce a.button.alt[disabled]:disabled:hover, 
				.woocommerce button.button.alt.disabled, 
				.woocommerce button.button.alt.disabled:hover, 
				.woocommerce button.button.alt:disabled, 
				.woocommerce button.button.alt:disabled:hover, 
				.woocommerce button.button.alt[disabled]:disabled, 
				.woocommerce button.button.alt[disabled]:disabled:hover, 
				.woocommerce input.button.alt.disabled, 
				.woocommerce input.button.alt.disabled:hover, 
				.woocommerce input.button.alt:disabled, 
				.woocommerce input.button.alt:disabled:hover, 
				.woocommerce input.button.alt[disabled]:disabled, 
				.woocommerce input.button.alt[disabled]:disabled:hover,
				.no-results input[type="submit"],
				table.compare-list .add-to-cart td a,
				.shop_cart,
				h3#reply-title::after,
				.newspaper-info,
				.categories_shortcode .owl-controls .owl-buttons i:hover,
				.widget-title:after,
				h2.heading-bottom:after,
				.wpb_content_element .wpb_accordion_wrapper .wpb_accordion_header.ui-state-active,
				#primary .main-content ul li:not(.rotate45)::before,
				.wpcf7-form .wpcf7-submit,
				.menu-search .btn.btn-primary:hover,
				.btn-register, .modeltheme-modal input[type="submit"], .modeltheme-modal button[type="submit"], form#login .register_button, form#login .submit_button,
				.bottom-components .component a:hover, .bottom-components .component a:hover, .bottom-components .component a:hover, .woocommerce-page .overlay-components .component a:hover, .woocommerce-page .vc_col-md-3 .overlay-components .component a:hover,
				.woocommerce.single-product .wishlist-container .yith-wcwl-wishlistaddedbrowse.show a,
				.widget_address_social_icons .social-links a,
				.hover-components .component:hover,
				.navbar-default .navbar-toggle .icon-bar,
				#yith-wcwl-form input[type="submit"],
				.nav-previous a, .nav-next a,
				article.dokan-orders-area .dokan-panel-default > .dokan-panel-heading,
				#signup-modal-content .woocommerce-form-register.register .button[type="submit"],
				.dokan-dashboard .dokan-dashboard-content article.dashboard-content-area .dashboard-widget .widget-title,
				.woocommerce-MyAccount-navigation-link > a,
				.newsletter-footer input.submit:hover, .newsletter-footer input.submit:focus,
				 a.remove-wsawl.sa-watchlist-action,
				footer .footer-top .menu .menu-item a::before,
				.post-password-form input[type="submit"],
				.wcv-dashboard-navigation li a,
				.wc_vendors_active form input[type="submit"],
				.cd-gallery .button-bid a,
				.mt_products_slider .button-bid a,
				.wishlist-title-with-form .show-title-form,
				body .dokan-pagination-container .dokan-pagination li.active a,
				.dokan-pagination-container .dokan-pagination li a:hover,
				.categories_shortcode .category,
				.ibid_shortcode_blog.boxed .post-button a.more-link  {
				    background: '.esc_html($ibid_style_main_backgrounds_color).';
				}
				.yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a,
				.yith-wcwl-add-to-wishlist.exists .yith-wcwl-wishlistaddedbrowse.hide a,
				.bottom-components .component a:hover, .bottom-components .component a:hover, .bottom-components .component a:hover, .woocommerce-page .overlay-components .component a:hover,.woocommerce-page .vc_col-md-3 .overlay-components .component a:hover,
				.columns-4 .overlay-components .component a:hover, .vc_col-md-4 .overlay-components .component a:hover, .no-sidebar .vc_col-md-3 .overlay-components .component a:hover,
				.woocommerce div.product .woocommerce-tabs ul.tabs li,
				.overlay-components .component.add-to-cart a, .bottom-components .component.add-to-cart a,
				.woocommerce_categories2 .products .component .yith-wcwl-wishlistexistsbrowse.show a,
				body .tp-bullets.preview1 .bullet,
				div#dokan-content .overlay-components .component a:hover,
				body #mega_main_menu li.default_dropdown .mega_dropdown > li > .item_link:hover, 
				body #mega_main_menu li.widgets_dropdown .mega_dropdown > li > .item_link:hover, 
				body #mega_main_menu li.multicolumn_dropdown .mega_dropdown > li > .item_link:hover, 
				body .dokan-settings-content .dokan-settings-area a.dokan-btn-info,
				.btn-sticky-left,
				.dokan-btn-info,
				body #mega_main_menu li.grid_dropdown .mega_dropdown > li > .item_link:hover,
				.custom_ibid button,
				.woocommerce_categories.grid th,
				.ibid_shortcode_cause .button-content a,
				.domain.woocommerce_categories .button-bid a,
				.domain-but button,
				.woocommerce_simple_domain .button-bid a,
				.mt-product-search .menu-search button.form-control,
				.mt-tabs .tabs-style-iconbox nav ul li.tab-current a,
				.sale_banner_right span.read-more,
				.freelancer-list-shortcode .project-bid .button.btn,
				.woocommerce.archive .ar-projs .modeltheme-button-bid
				{
				    background: '.esc_html($ibid_style_main_backgrounds_color).' !important;
				}
				.flip-clock-wrapper ul li a div div.inn,
				.featured_product_shortcode span.amount,
				.featured_product_shortcode .featured_product_button:hover,
				.custom_ibid button:hover,
				.ibid-countdown strong,
				.categories_shortcode .category.active span, .categories_shortcode .category:hover span,
				.woocommerce_categories.grid td.product-title a,
				.woocommerce_categories.grid td.add-cart a,
				.woocommerce_categories.list span.amount,
				.cd-tab-filter a:hover,
				.no-touch .cd-filter-block h4:hover,
				.cd-gallery .woocommerce-title-metas a:hover,
				.cd-tab-filter a.selected,
				.no-touch .cd-filter-trigger:hover,
				.woocommerce .woocommerce-widget-layered-nav-dropdown__submit:hover,
				.woocommerce .woocommerce-widget-layered-nav-list .woocommerce-widget-layered-nav-list__item a:hover,
				.mt_products_slider .woocommerce-title-metas h3 a:hover,
				.ibid_shortcode_cause h3 a:hover,
				.mt_products_slider .button-bid a:hover,
				.header-v3 .menu-products .shop_cart:hover,
				.domain.woocommerce_categories .archive-product-title a:hover,
				.custom-btn button:hover,
				.modeltheme_products_carousel .modeltheme-title-metas a:hover,
				.modeltheme_products_carousel.owl-theme .owl-controls .owl-buttons div,
				.modeltheme_products_simple h3.modeltheme-archive-product-title a:hover,
				.freelancer-list-shortcode h3.archive-product-title a:hover,
				.mt-categories-content:hover span.mt-title:hover,
				.freelancer-list-shortcode .project-bid .button.btn:hover,
				.woocommerce.archive .ar-projs .modeltheme-button-bid:hover a,
				.user-information h3.user-profile-title a:hover,
				.user-information span.info-pos i,
				.work-dashboard h3.archive-product-title a:hover,
				.user-profile-info span.info-pos i{
					color: '.esc_html($ibid_style_main_backgrounds_color).' !important;
				}
				.dokan-btn-success.grant_access, input#dokan-add-tracking-number,
				.dokan-dashboard .dokan-dash-sidebar, .dokan-dashboard .dokan-dash-sidebar ul.dokan-dashboard-menu,
				input[type="submit"].dokan-btn-theme, a.dokan-btn-theme, .dokan-btn-theme,
				#cd-zoom-in, #cd-zoom-out,
				.woocommerce .woocommerce-widget-layered-nav-dropdown__submit,
				.custom-btn button,
				.modeltheme_products_carousel .modeltheme-button-bid a,
				.modeltheme_products_simple .modeltheme-product-wrapper a.button,
				.hiw-btn .button-winona{
				    background-color: '.esc_html($ibid_style_main_backgrounds_color).' !important;
				}
				.gridlist-toggle a:hover,
				.gridlist-toggle a.active,
				.dataTables_wrapper .pagination>.active>a, .dataTables_wrapper .pagination>.active>span, 
				.dataTables_wrapper .pagination>.active>a:hover, 
				.dataTables_wrapper .pagination>.active>span:hover, 
				.dataTables_wrapper .pagination>.active>a:focus, 
				.dataTables_wrapper .pagination>.active>span:focus {
					background-color: '.esc_html($ibid_style_main_backgrounds_color).' !important;
				}
				.pagination > li > a.current, 
				.pagination > li > a:hover{
					background-color: '.esc_html($ibid_style_main_backgrounds_color_hover).';
					border: 1px solid '.esc_html($ibid_style_main_backgrounds_color_hover).';
				}
				.woocommerce ul.products li.product .onsale, 
				.back-to-top,
				body .woocommerce ul.products li.product .onsale, 
				body .woocommerce ul.products li.product .onsale,
				.pagination .page-numbers.current,
				.pagination .page-numbers.current:hover,
				.category-button.boxed a,
				.masonry_banner .read-more.boxed {
					background-color: '.esc_html($ibid_style_main_backgrounds_color).';
				}
				.comment-form input, 
				.comment-form textarea,
				.author-bio,
				blockquote,
				.widget_popular_recent_tabs .nav-tabs > li.active,
				body .left-border, 
				body .right-border,
				body .member-header,
				body .member-footer .social,
				.woocommerce div.product .woocommerce-tabs ul.tabs li.active,
				.woocommerce .woocommerce-info, 
				.woocommerce .woocommerce-message,
				body .button[type="submit"],
				.navbar ul li ul.sub-menu,
				.wpb_content_element .wpb_tabs_nav li.ui-tabs-active,
				.header_mini_cart,
				.header_mini_cart.visible_cart,
				#contact-us .form-control:focus,
				.header_mini_cart .woocommerce .widget_shopping_cart .total, 
				.header_mini_cart .woocommerce.widget_shopping_cart .total,
				.sale_banner_holder:hover,
				.testimonial-img,
				.wpcf7-form input:focus, 
				.wpcf7-form textarea:focus,
				.dokan-btn-success.grant_access, input#dokan-add-tracking-number,
				.navbar-default .navbar-toggle:hover, 
				.woocommerce.single-product div.product.product-type-auction form.cart .button.single_add_to_cart_button,
				.navbar-default .navbar-toggle {
				    border-color: '.esc_html($ibid_style_main_backgrounds_color).';
				}
				.sidebar-content .widget-title::before, .dokan-widget-area .widget-title::before,
				.dokan-settings-content .dokan-settings-area a.dokan-btn-info, .dokan-btn-info,
				input[type="submit"].dokan-btn-theme, a.dokan-btn-theme, .dokan-btn-theme,
				.header-v3 .menu-products .shop_cart,
				.lvca-heading.lvca-alignleft h3.lvca-title::after{
				    border-color: '.esc_html($ibid_style_main_backgrounds_color).' !important;
				}
				.mt-tabs .tabs-style-iconbox nav ul li.tab-current a::after{
				    border-top-color: '.esc_html($ibid_style_main_backgrounds_color).' !important;
				}
				.services2 .block-triangle:hover i,
				.cd-filter::before,
				.cd-filter .cd-close {
					background-color:'.esc_html($ibid_style_main_backgrounds_color).';
				}
				#navbar .menu-item.black-friday-menu-link > a  {
					background-color:'.esc_html($ibid_style_main_backgrounds_color).' !important;
				}
				#navbar .menu-item.black-friday-menu-link > a:hover {
					background:'.esc_html(ibid_redux("header_top_bar_background","background-color")).' !important;
				}
				.woocommerce #respond input#submit:hover, 
				.woocommerce a.button:hover, 
				.wc_vendors_active form input[type="submit"]:hover,
				.wcv-dashboard-navigation li a:hover,
				.woocommerce button.button:hover, 
				.woocommerce input.button:hover,
				table.compare-list .add-to-cart td a:hover,
				.woocommerce #respond input#submit.alt:hover, 
				.woocommerce a.button.alt:hover, 
				.woocommerce button.button.alt:hover, 
				.woocommerce input.button.alt:hover,
				.ibid-search.ibid-search-open .ibid-icon-search, 
				.no-js .ibid-search .ibid-icon-search,
				.ibid-icon-search:hover,
				.latest-posts .post-date-month,
				.button.solid-button:hover,
				body .vc_btn.vc_btn-blue:hover, 
				body a.vc_btn.vc_btn-blue:hover, 
				body button.vc_btn.vc_btn-blue:hover,
				.subscribe > button[type="submit"]:hover,
				.no-results input[type="submit"]:hover,
				table.compare-list .add-to-cart td a:hover,
				.shop_cart:hover,
				.wpcf7-form .wpcf7-submit:hover,
				.widget_address_social_icons .social-links a:hover,
				.post-password-form input[type="submit"]:hover,
				.page-template-template-blog .full-width-part .more-link:hover,
				.form-submit input:hover,
				.full-width-part .more-link:hover,
				form#login .submit_button:hover,
				.modeltheme-modal input[type="submit"]:hover, 
				.modeltheme-modal button[type="submit"]:hover, 
				.modeltheme-modal p.btn-register-p a:hover,
				#yith-wcwl-form input[type="submit"]:hover,
				#signup-modal-content .woocommerce-form-register.register .button[type="submit"]:hover,
				.woocommerce_categories2 .bottom-components .component a:hover,.woocommerce_categories2 .bottom-components .component a:hover,
				woocommerce_categories2 .bottom-components .component a:hover
				 {
				    background: '.esc_html($ibid_style_main_backgrounds_color_hover).'; /*Color: Main Dark */
				}
				.woocommerce_categories.grid td.add-cart a:hover,
				.woocommerce_categories.grid td.product-title a:hover,
				.domain.woocommerce_categories .archive-product-title a
				{
					color: '.esc_html($ibid_style_main_backgrounds_color_hover).' !important;
				}
				.no-touch #cd-zoom-in:hover, .no-touch #cd-zoom-out:hover,
				.woocommerce .woocommerce-widget-layered-nav-dropdown__submit:hover,
				.ibid_shortcode_cause .button-content a:hover,
				.cd-gallery .button-bid a:hover,
				.mt_products_slider .button-bid a:hover 
				{
				    background-color: '.esc_html($ibid_style_main_backgrounds_color_hover).' !important; /*Color: Main Dark */
				}';

	    wp_add_inline_style( 'ibid-custom-style', ibid_minify_css($html) );
	}
}