<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php 
#Redux global variable
global $ibid_redux;
?>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) { ?>
        <link rel="shortcut icon" href="<?php echo esc_url(ibid_redux('ibid_favicon', 'url')); ?>">
    <?php } ?>
    <?php wp_head(); ?>
     <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.12.0/moment.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="https://kit.fontawesome.com/c0e1c8ef94.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js"></script>
    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.4/js/bootstrap-datetimepicker.min.js"></script> -->
    <?php 
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
         $url = "https://";   
    else  
         $url = "http://";   
    // Append the host(domain name, ip) to the URL.   
    $url.= $_SERVER['HTTP_HOST'];   
    
    // Append the requested resource location to the URL   
    $url.= $_SERVER['REQUEST_URI'];    
      
    //echo $url; 
    $key = 'add-auction';
    if (strpos($url, $key) == true) {
        //echo $key . ' not exists in the URL <br>';
        ?> <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.4.min.js"></script> <?php
    } 
  ?> 
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/js/bootstrap-datetimepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/css/bootstrap-datetimepicker.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.4/css/bootstrap-datetimepicker.min.css"> 
</head>

<body <?php body_class(); ?>>
    <?php
    /**
    * Since WordPress 5.2
    */
    if ( function_exists( 'wp_body_open' ) ) {
        wp_body_open();
    }

    /**
    * Login/Register popup hooked
    */
    do_action('ibid_after_body_open_tag');

    
    if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
        if ($ibid_redux['ibid-enable-popup'] == true) {
            echo ibid_popup_modal(); 
        }
    }?>
    <div class="modeltheme-overlay"></div>

    
    <!-- Fixed Search Form -->
    <div class="fixed-search-overlay">
        <!-- Close Sidebar Menu + Close Overlay -->
        <i class="icon-close icons"></i>
        <!-- INSIDE SEARCH OVERLAY -->
        <div class="fixed-search-inside">
            <div class="modeltheme-search">
                <?php do_action('ibid_products_search_form'); ?>
            </div>
        </div>
    </div>
        
    <div id="page" class="hfeed site">
    <?php
        if (is_page()) {
            $mt_custom_header_options_status = get_post_meta( get_the_ID(), 'ibid_custom_header_options_status', true );
            $mt_header_custom_variant = get_post_meta( get_the_ID(), 'ibid_header_custom_variant', true );
            if (isset($mt_custom_header_options_status) AND $mt_custom_header_options_status == 'yes') {
                get_template_part( 'templates/header-template'.esc_html($mt_header_custom_variant) );
            }else{
                if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                    // DIFFERENT HEADER LAYOUT TEMPLATES
                    if ($ibid_redux['header_layout'] == 'first_header') {
                        // Header Layout #1
                        get_template_part( 'templates/header-template1' );
                    }elseif ($ibid_redux['header_layout'] == 'second_header') {
                        // Header Layout #2
                        get_template_part( 'templates/header-template2' );
                    }elseif ($ibid_redux['header_layout'] == 'third_header') {
                        // Header Layout #3
                        get_template_part( 'templates/header-template3' );
                    }elseif ($ibid_redux['header_layout'] == 'fourth_header') {
                        // Header Layout #4
                        get_template_part( 'templates/header-template4' );
                    }elseif ($ibid_redux['header_layout'] == 'fifth_header') {
                        // Header Layout #5
                        get_template_part( 'templates/header-template5' );
                    }elseif ($ibid_redux['header_layout'] == 'sixth_header') {
                        // Header Layout #5
                        get_template_part( 'templates/header-template6' );
                    }elseif ($ibid_redux['header_layout'] == 'seventh_header') {
                        // Header Layout #5
                        get_template_part( 'templates/header-template7' );
                    }else{
                        // if no header layout selected show header layout #1
                        get_template_part( 'templates/header-template1' );
                    } 
                }else{
                    // if no header layout selected show header layout #1
                    get_template_part( 'templates/header-template1' );
                }
            }
        }else{
            if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                // DIFFERENT HEADER LAYOUT TEMPLATES
                if ($ibid_redux['header_layout'] == 'first_header') {
                    // Header Layout #1
                    get_template_part( 'templates/header-template1' );
                }elseif ($ibid_redux['header_layout'] == 'second_header') {
                    // Header Layout #5
                    get_template_part( 'templates/header-template2' );
                }elseif ($ibid_redux['header_layout'] == 'third_header') {
                    // Header Layout #5
                    get_template_part( 'templates/header-template3' );
                }elseif ($ibid_redux['header_layout'] == 'fourth_header') {
                        // Header Layout #4
                        get_template_part( 'templates/header-template4' );
                }elseif ($ibid_redux['header_layout'] == 'fifth_header') {
                    // Header Layout #5
                    get_template_part( 'templates/header-template5' );
                }elseif ($ibid_redux['header_layout'] == 'sixth_header') {
                    // Header Layout #5
                    get_template_part( 'templates/header-template6' );
                }elseif ($ibid_redux['header_layout'] == 'seventh_header') {
                        // Header Layout #5
                        get_template_part( 'templates/header-template7' );
                }else{
                    // if no header layout selected show header layout #1
                    get_template_part( 'templates/header-template1' );
                }
            }else{
                // if no header layout selected show header layout #1
                get_template_part( 'templates/header-template1' );
            }
        }