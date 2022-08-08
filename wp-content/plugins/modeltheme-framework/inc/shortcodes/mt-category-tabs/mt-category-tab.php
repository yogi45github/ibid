<?php

/**

||-> Shortcode: Category Tabs

*/
function modeltheme_tabs_categories_shortcode($params, $content) {
    extract( shortcode_atts( 
        array(
            'tabs_item_title_tab1'             => '',
            'tabs_item_icon1'                  => '',
            'tabs_item_icon2'                  => '',
            'tabs_item_icon3'                  => '',
            'tabs_item_icon4'                  => '',
            'tabs_item_icon5'                  => '',
            'tabs_item_title_tab2'             => '',
            'tabs_item_title_tab3'             => '',
            'tabs_item_title_tab4'             => '',
            'tabs_item_title_tab5'             => '',
            'tab_category_1'                   => '',
            'tab_category_2'                   => '',
            'tab_category_3'                   => '',
            'tab_category_4'                   => '',
            'tab_category_5'                   => '',
        ), $params ) );

    $tabs_item_icon1 = wp_get_attachment_image_src($tabs_item_icon1, "smartowl_500x500");
    $tabs_item_icon2 = wp_get_attachment_image_src($tabs_item_icon2, "smartowl_500x500");
    $tabs_item_icon3 = wp_get_attachment_image_src($tabs_item_icon3, "smartowl_500x500");
    $tabs_item_icon4 = wp_get_attachment_image_src($tabs_item_icon4, "smartowl_500x500");
    $tabs_item_icon5 = wp_get_attachment_image_src($tabs_item_icon5, "smartowl_500x500");

    $content = '';
    $content .= '<section class="mt-tabs">
            <div class="tabs tabs-style-iconbox">
                <nav>
                    <ul>';

                    if (!empty($tabs_item_icon1) || !empty($tabs_item_title_tab1)) {
                        $content .= '<li><a href="#section-iconbox-1" class="list-icon-title">
                            <img class="tabs_icon" src="'.esc_attr($tabs_item_icon1[0]).'" alt="tabs-image">
                            <h5 class="tab-title">'.$tabs_item_title_tab1.'</h5>
                        </a></li>';
                    }

                    if (!empty($tabs_item_icon2) || !empty($tabs_item_title_tab2)) {
                        $content .= '<li><a href="#section-iconbox-2" class="list-icon-title">
                            <img class="tabs_icon" src="'.esc_attr($tabs_item_icon2[0]).'" alt="tabs-image">
                            <h5 class="tab-title">'.$tabs_item_title_tab2.'</h5>
                        </a></li>';
                    }
                        
                    if (!empty($tabs_item_icon3) || !empty($tabs_item_title_tab3)) {
                        $content .= '<li><a href="#section-iconbox-3" class="list-icon-title">
                            <img class="tabs_icon" src="'.esc_attr($tabs_item_icon3[0]).'" alt="tabs-image">
                            <h5 class="tab-title">'.$tabs_item_title_tab3.'</h5>
                        </a></li>';
                    }
                        
                    if (!empty($tabs_item_icon4) || !empty($tabs_item_title_tab4)) {
                        $content .= '<li><a href="#section-iconbox-4" class="list-icon-title">
                            <img class="tabs_icon" src="'.esc_attr($tabs_item_icon4[0]).'" alt="tabs-image">
                            <h5 class="tab-title">'.$tabs_item_title_tab4.'</h5>
                        </a></li>';
                    }
                        
                    if (!empty($tabs_item_icon5) || !empty($tabs_item_title_tab5)) {
                        $content .= '<li><a href="#section-iconbox-5" class="list-icon-title">
                            <img class="tabs_icon" src="'.esc_attr($tabs_item_icon5[0]).'" alt="tabs-image">
                            <h5 class="tab-title">'.$tabs_item_title_tab5.'</h5>
                        </a></li>';
                    }
                    $content .= '</ul>
                </nav>
                <div class="content-wrap woocommerce_categories2">
                    <section id="section-iconbox-1">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="tabs_content">'.do_shortcode('[product_category category="'.$tab_category_1.'" columns="3" number_of_products_by_category="9"]').'</p>
                            </div>
                        </div>                     
                    </section>
                   
                    <section id="section-iconbox-2">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="tabs_content">'.do_shortcode('[product_category category="'.$tab_category_2.'" columns="3" number_of_products_by_category="9"]').'</p>
                            </div>
                        </div>
                    </section>
                    
                    <section id="section-iconbox-3">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="tabs_content">'.do_shortcode('[product_category category="'.$tab_category_3.'" columns="3" number_of_products_by_category="9"]').'</p>
                            </div>
                        </div>
                    </section>
                    
                    <section id="section-iconbox-4">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="tabs_content">'.do_shortcode('[product_category category="'.$tab_category_4.'" columns="3" number_of_products_by_category="9"]').'</p>
                            </div>
                        </div>
                    </section>
                    
                    <section id="section-iconbox-5">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="tabs_content">'.do_shortcode('[product_category category="'.$tab_category_5.'" columns="3" number_of_products_by_category="9"]').'</p>
                            </div>
                        </div>
                    </section>
                </div><!-- /content -->
            </div><!-- /tabs -->
        </section>';

    return $content;
}
add_shortcode('mt_tabs_categories', 'modeltheme_tabs_categories_shortcode');
