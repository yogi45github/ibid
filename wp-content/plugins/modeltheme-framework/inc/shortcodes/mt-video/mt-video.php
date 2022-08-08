<?php

/**

||-> Shortcode: Video

*/

function modeltheme_shortcode_video($params, $content) {

    extract( shortcode_atts( 
        array(
            'animation'                 => '',
            'source_vimeo'              => '',
            'source_youtube'            => '',
            'video_source'              => '',
            'vimeo_link_id'             => '',
            'youtube_link_id'           => '',
            'button_image'              => ''
        ), $params ) );

    $thumb      = wp_get_attachment_image_src($button_image, "full");
    $thumb_src  = $thumb[0];

    $html = '';

    // custom javascript
    $html .= '<script>
                jQuery(document).ready(function() {
                  jQuery(".popup-vimeo-video").magnificPopup({
                  	type:"iframe",
	              	disableOn: 700,
					removalDelay: 160,
					preloader: false,
					fixedContentPos: false
				});


                  jQuery(".popup-vimeo-youtube").magnificPopup({
                  	type:"iframe",
             		disableOn: 700,
					removalDelay: 160,
					preloader: false,
					fixedContentPos: false});
                });
                
              </script>';

    

      $html .= '<div class="mt_video text-center row">';
        $html .= '<div class="wow '.esc_attr($animation).'">';
        if ($video_source == 'source_vimeo') {
          $html .= '<a class="popup-vimeo-video" href="https://vimeo.com/'.$vimeo_link_id.'"><img class="buton_image_class" src="'.esc_attr($thumb_src).'" data-src="'.esc_attr($thumb_src).'" alt=""></a>';
          } elseif ($video_source == 'source_youtube') {
            $html .= '<a class="popup-vimeo-youtube" href="https://www.youtube.com/watch?v='.$youtube_link_id.'"><img class="buton_image_class" src="'.esc_attr($thumb_src).'" data-src="'.esc_attr($thumb_src).'" alt=""></a>';
          }
        $html .= '</div>';
      $html .= '</div>';

    return $html;
}

add_shortcode('shortcode_video', 'modeltheme_shortcode_video');
?>