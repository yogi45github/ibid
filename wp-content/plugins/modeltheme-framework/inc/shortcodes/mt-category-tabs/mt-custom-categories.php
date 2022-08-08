<?php 
require_once(__DIR__.'/../vc-shortcodes.inc.arrays.php');

function ibid_mt_custom_categories($params,  $content = NULL) {
    extract( shortcode_atts( 
        array(
          'number_columns'     => ''
        ), $params ) );

    $html = '';
      $html .= '<div class="categories-wrapper row">';
        $html .= '<div class="mt-categories-content mt_'.esc_attr($number_columns).'">';       
            $html .= do_shortcode($content);
        $html .= '</div>';
    $html .= '</div>';

    return $html;
}
add_shortcode('ibid_mt_custom_categories_short', 'ibid_mt_custom_categories');
/**
||-> Shortcode: Child Shortcode v1
*/
function ibid_mt_custom_categories_items($params, $content = NULL) {

    extract( shortcode_atts( 
        array(
          'additional_title' => '',
          'additional_link'  => '',
          'image'            => ''
        ), $params ) );

    $thumb      = wp_get_attachment_image_src($image, "ibid_post_widget_pic70x70");
    $thumb_src  = $thumb[0]; 
    $html = '';
      $html .= '<ul class="single-category-wrapper">'; 
        $html .= '<a href="'.esc_url($additional_link).'"><li class="single-category">';
          if($thumb_src) { 
              $html .= '<img src="'.$thumb_src.'" data-src="'.$thumb_src.'" alt="'.$additional_title.'">';
          }else{ 
              $html .= '<img src="http://placehold.it/50x50" alt="'.$additional_title.'" />'; 
          }
          $html .= '<span class="mt-title">'.esc_attr($additional_title).'</span>';    
        $html .= '</li></a>';
      $html .= '</ul>';

      return $html;
}
add_shortcode('ibid_mt_custom_categories_short_item', 'ibid_mt_custom_categories_items');
?>