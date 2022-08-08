<?php 

require_once(__DIR__.'/../vc-shortcodes.inc.arrays.php');

/**
||-> Shortcode: Map pins
*/
function mt_shortcode_map_pins($params,  $content = NULL) {
    extract( shortcode_atts( 
        array(
            'el_class'              => '',
            'item_image_map'        => '',
            'animation'               => '',
        ), $params ) );


    $html = '';
        
    $html .= '
    <div class="map-shortcode wow '.$animation.'">
        <div class="bitwallet-product bitwallet-container">
            <div class="bitwallet-product-wrapper">';
                $img = wp_get_attachment_image_src($item_image_map, 'full'); 
                if (isset($item_image_map)) {
                    $html .= '<img class="menu_item_image" src="'.$img[0].'" alt="" />';
                }
                $html .= '<ul>';
                    $html .= do_shortcode($content);
                    $html .= '
                </ul>
            </div>
        </div>
    </div>';
    return $html;
}
add_shortcode('mt_map_pins', 'mt_shortcode_map_pins');


/**
||-> Shortcode: Map Single Point
*/
function mt_shortcode_map_pins_items($params, $content = NULL) {
    extract( shortcode_atts( 
        array(
            'item_title'           => '',
            'item_content'         => '',
            'item_image'           => '',
            'coordinates_x'        => '',
            'coordinates_y'        => '',
            'el_class_pin'         => '',
        ), $params ) );


    $html = '';
    $html .= '<li class="bitwallet-single-point" style="top:'.$coordinates_x.';right:'.$coordinates_y.';">';

        $html .= '<a class="bitwallet-img-replace">More</a>';

        if($el_class_pin) {
            $class_pin = $el_class_pin;
        } else {
            $class_pin = 'bottom';
        }

        $html .= '<div class="bitwallet-more-info bitwallet-'.$class_pin.'">';

            $img = wp_get_attachment_image_src($item_image, 'full'); 
            if (isset($img[0])) {
                $html .= '<img class="menu_item_image" src="'.$img[0].'" alt="" />';
            }
            $html .= '<h3 class="menu_item_title">'.$item_title.'</h3>';
            $html .= '<p class="menu_item_content">'.$item_content.'</p>';
            $html .= '<a href="#0" class="bitwallet-close-info bitwallet-img-replace">Close</a>';

        $html .= '</div>';
    
    $html .= '</li>';

    return $html;
}
add_shortcode('mt_map_pins_item', 'mt_shortcode_map_pins_items');
?>