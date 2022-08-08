<?php

/**

||-> Shortcode: Typed

*/
function modeltheme_mt_typed_text_shortcode($params, $content) {
    extract( shortcode_atts( 
        array(
            'texts'          => '',
            'font_size'          => '',
            'aftertext'      => '',
            'beforetext'     => '',
            'animation'      => '',
            'typespeed'          => '',
            'backdelay'          => '',
        ), $params ) );

    $typed_unique_id = 'mt_typed_text_'.uniqid();

    $skill = '';
    $skill .= '<script>
                jQuery(function(){
                    jQuery(".'.esc_attr($typed_unique_id).'").typed({
                      strings: ['.$texts.'],
                      typeSpeed: '.$typespeed.',
                      backDelay: '.$backdelay.',
                      loop: true
                    });
                });
              </script>';
    $skill .= '<div class="parent-typed-text wow '.$animation.'">';
      $skill .= '<span  style="font-size:'.$font_size.'" class="mt_typed-beforetext">'.$beforetext.' </span>';
      $skill .= '<span  style="font-size:'.$font_size.'" class="mt_typed_text '.esc_attr($typed_unique_id).'"></span>';
      $skill .= '<span  style="font-size:'.$font_size.'" class="mt_typed-aftertext"> '.$aftertext.'</span>';
    $skill .= '</div>';

    $skill .= '<style> span.typed-cursor { font-size:'.$font_size.'; } </style>';

    return $skill;
}
add_shortcode('mt_typed_text', 'modeltheme_mt_typed_text_shortcode');
?>