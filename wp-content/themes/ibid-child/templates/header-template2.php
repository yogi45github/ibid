<?php
  #Redux global variable
  global $ibid_redux;
  #WooCommerce global variable
  global $woocommerce;
  $cart_url = "#";
  if ( class_exists( 'WooCommerce' ) ) {
    $cart_url = wc_get_cart_url();
  }
  #YITH Wishlist rul
  if( function_exists( 'YITH_WCWL' ) ){
      $wishlist_url = YITH_WCWL()->get_wishlist_url();
  }else{
      $wishlist_url = '#';
  }
?>

<?php  
if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
  if ( ibid_redux('ibid_top_header_info_switcher') == true) {
      echo ibid_my_banner_header();
  }
} ?>

<header class="header-v2">

  <?php do_action('ibid_after_mobile_navigation_burger'); ?>
  
  <?php if ( class_exists( 'ReduxFrameworkPlugin' ) ) { ?>
    <?php if ( ibid_redux('ibid_header_language_switcher') != '0' || ibid_redux('ibid_header_currency_switcher') != '0' || ibid_redux('ibid_contact_phone') != '' || ibid_redux('ibid_contact_email') != '' || ibid_redux('ibid_work_program') != '' || ibid_redux('ibid_top_header_order_tracking_link') != '') { ?>
    <div class="top-header">
      <div class="container">
        <div class="row">
          <!-- LEFT SIDE LINKS -->
          <div class="col-md-7 col-sm-12 contact-header">
            <ul class="currency-language list-inline-block menu-list">
            <?php if(ibid_redux('ibid_header_language_switcher') != '' && ibid_redux('ibid_header_language_switcher') == '1'){ ?>
              <li>
                <div class="language-box dropdown-box">
                  <a class="language-current" href="<?php echo esc_url('#'); ?>"><?php esc_html_e('EN', 'ibid'); ?></a>
                  <ul class="language-list list-none dropdown-list">
                    <li><a href="<?php echo esc_url('#'); ?>"><?php esc_html_e('EN', 'ibid'); ?></a></li>
                    <li><a href="<?php echo esc_url('#'); ?>"><?php esc_html_e('FR', 'ibid'); ?></a></li>
                    <li><a href="<?php echo esc_url('#'); ?>"><?php esc_html_e('GE', 'ibid'); ?></a></li>
                  </ul>
                </div>
              </li>
            <?php } ?>
            <?php if(ibid_redux('ibid_header_currency_switcher') != '' && ibid_redux('ibid_header_currency_switcher') == '1'){ ?>
              <li>
                <div class="currency-box dropdown-box">
                  <a class="currency-current" href="<?php echo esc_url('#'); ?>"><?php esc_html_e('USD', 'ibid'); ?></a>
                  <ul class="currency-list list-none dropdown-list">
                    <li><a href="<?php echo esc_url('#'); ?>"><?php esc_html_e('USD', 'ibid'); ?></a></li>
                    <li><a href="<?php echo esc_url('#'); ?>"><?php esc_html_e('EUR', 'ibid'); ?></a></li>
                    <li><a href="<?php echo esc_url('#'); ?>"><?php esc_html_e('JPY', 'ibid'); ?></a></li>
                  </ul>
                </div>
              </li>
            <?php } ?>
            </ul>
            <?php if($ibid_redux['ibid_contact_phone']) { ?>
              <!-- Call Us -->
              <span>
                <?php esc_html_e('Call us toll free: ', 'ibid'); ?>
                <a href="<?php echo esc_url('tel:'.$ibid_redux['ibid_contact_phone']); ?>">
                  <?php echo esc_html($ibid_redux['ibid_contact_phone']); ?>
                </a>
              </span>
            <?php } ?>
            <?php if($ibid_redux['ibid_contact_email']) { ?>
              <!-- Mail Us -->
              <span>
                <?php esc_html_e('Send us an email: ', 'ibid'); ?>
                <a href="<?php echo esc_url('mailto:'.$ibid_redux['ibid_contact_email']); ?>">
                  <?php echo esc_html($ibid_redux['ibid_contact_email']); ?>
                </a>
              </span>
            <?php } ?>
            <?php if($ibid_redux['ibid_work_program'])  { ?>
              <!-- Work Program -->
              <span>
                <i class="fa fa-clock-o" aria-hidden="true"></i>
                <?php echo esc_html($ibid_redux['ibid_work_program']); ?>
              </span>
            <?php } ?>
          </div>
          <!-- RIGHT SIDE LINKS -->
          <div class="col-md-5 col-sm-12 account-urls">
            <?php if (isset($ibid_redux['ibid_top_header_order_tracking_link']) && $ibid_redux['ibid_top_header_order_tracking_link'] != '') { ?>
              <a class="top-order" href="<?php echo esc_url($ibid_redux['ibid_top_header_order_tracking_link']); ?>">
                <i class="fa fa-truck"></i>
                <?php esc_html_e('Order Tracking', 'ibid'); ?>
              </a>
            <?php } ?>
            <?php if( function_exists( 'YITH_WCWL' ) ){ ?>
              <a class="top-payment" href="<?php echo esc_url($wishlist_url); ?>">
                <i class="fa fa-heart-o"></i>
                <?php esc_html_e('Wishlist', 'ibid'); ?>
              </a>
            <?php } ?>

            <!-- RIGHT SIDE MY ACCOUNT DROPDOWN -->
            <!-- <div class="my-account-navbar pull-right">
              <ul>
              <?php if ( class_exists('woocommerce')) { ?>
                <?php if (is_user_logged_in()) { ?> 
                  <div id="dropdown-user-profile" class="ddmenu">
                    <li id="nav-menu-register" class="nav-menu-account"><?php echo esc_html__('My Account','ibid'); ?></li>
                    <ul>
                      
                      <?php if(class_exists('Mtsub')) {
                         do_action( 'mt_after_my_account' ); ?>
                      <?php } ?>
                      <li><a href="<?php echo esc_url(get_permalink( get_option('woocommerce_myaccount_page_id') )); ?>"><i class="icon-layers icons"></i> <?php echo esc_html__('My Dashboard','ibid'); ?></a></li>
                      
                      <?php if(class_exists('Mt_Freelancer_Mode')) {
                        do_action( 'mt_before_dashboard' ); ?>
                      <?php } ?>
                      
                      <?php if (class_exists('Dokan_Vendor') && dokan_is_user_seller( dokan_get_current_user_id() )) {  ?>            
                        <li><a href="<?php echo esc_url( home_url().'/dashboard' ); ?>"><i class="icon-trophy icons"></i> <?php echo esc_html__('Vendor Dashboard','ibid'); ?></a></li>
                      <?php } ?>
                      
                      <?php if (class_exists('WCFM') && wcfm_is_vendor()) { ?>
                        <li><a href="<?php echo apply_filters( 'wcfm_dashboard_home', get_wcfm_page() ); ?>"><i class="icon-trophy icons"></i> <?php echo esc_html__('Vendor Dashboard','ibid'); ?></a></li>
                      <?php } ?>
                      
                      <?php if (class_exists('WC_Vendors')) { ?>
                        <?php if (get_option('wcvendors_vendor_dashboard_page_id') != '') { ?>
                          <li><a href="<?php echo esc_url( get_permalink(get_option('wcvendors_vendor_dashboard_page_id')) ); ?>"><i class="icon-trophy icons"></i> <?php echo esc_html__('Vendor Dashboard','ibid'); ?></a></li>
                        <?php } ?>
                      <?php } ?>
                      
                      <li><a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id')).'orders'); ?>"><i class="icon-bag icons"></i> <?php echo esc_html__('My Orders','ibid'); ?></a></li>
                      <li><a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id')).'edit-account'); ?>"><i class="icon-user icons"></i> <?php echo esc_html__('Account Details','ibid'); ?></a></li>
                      <div class="dropdown-divider"></div>
                      <li><a href="<?php echo esc_url(wp_logout_url( home_url() )); ?>"><i class="icon-logout icons"></i> <?php echo esc_html__('Log Out','ibid'); ?></a></li>
                    </ul>
                  </div>
                <?php } else { ?> <!-- logged out -->
                  <!-- <li id="nav-menu-login" class="ibid-logoin">
                    <?php do_action('ibid_login_link_a'); ?>
                  </li> -->
                <?php } ?>
              <?php } ?>
              <!-- </ul>
            </div> -->
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
  <?php } ?>
  <div class="navbar navbar-default" id="ibid-main-head">
      <div class="container">
        <div class="row">

          <!-- LOGO -->
          <div class="navbar-header col-md-2 col-sm-12">

            <?php if ( class_exists( 'ReduxFrameworkPlugin' ) ) { ?>
              <?php if ($ibid_redux['ibid_mobile_burger_select'] == 'dropdown' || $ibid_redux['ibid_mobile_burger_select'] == '') { ?>
                  <?php do_action('ibid_burger_dropdown_button'); ?>
              <?php } ?> 
            <?php } else {?>
              <?php if ( !class_exists( 'mega_main_init' ) ) { ?>
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                      <span class="sr-only"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                  </button>
              <?php } ?>
            <?php } ?>

            <?php do_action('ibid_before_mobile_navigation_burger'); ?>

            <?php echo ibid_logo(); ?>
          </div>
             
          <div class="first-part col-md-10 col-sm-12">
            <?php if (class_exists('WooCommerce') && 1==2) : ?>
              <div class="col-md-5 search-form-product">

              <?php if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
              if ($ibid_redux['is_search_enabled'] == false) { ?>
                <div class="ibid-header-searchform">
                  <form name="header-search-form" method="GET" class="woocommerce-product-search menu-search" action="<?php echo esc_url(home_url('/')); ?>">
                    <?php 
                      if(isset($_REQUEST['product_cat']) && !empty($_REQUEST['product_cat'])) {
                        $optsetlect=$_REQUEST['product_cat'];
                      } else {
                        $optsetlect=0;  
                      }
                      $args = array(
                        'show_option_none' => esc_html__( 'Category', 'ibid' ),
                        'option_none_value'  => '',
                        'hierarchical' => 0,
                        'class' => 'cat',
                        'echo' => 1,
                        'value_field' => 'slug',
                        'hide_empty' => true,
                        'selected' => $optsetlect
                      );
                      $args['taxonomy'] = 'product_cat';
                      $args['name'] = 'product_cat';              
                      $args['class'] = 'form-control1';
                      wp_dropdown_categories($args);
                    ?>
                    <input type="text"  name="s" class="search-field" id="keyword" onkeyup="fetchs()" maxlength="128" value="<?php echo esc_attr(get_search_query()); ?>" placeholder="<?php esc_attr_e('Search products...', 'ibid'); ?>">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
                    <input type="hidden" name="post_type" value="product" />
                  </form>
                  <div id="datafetch"></div> 
                </div>
                <?php }
              } ?>
              
              </div>
            <?php endif; ?>

            <div class="col-md-7 menu-holder">
              <nav class="navbar bottom-navbar-default" id="modeltheme-main-head">
                <div id="navbar" class="navbar-collapse collapse">
                  <div class="bot_nav_wrap">
                    <ul class="menu nav navbar-nav pull-left nav-effect nav-menu">
                    <?php
                      if ( has_nav_menu( 'primary' ) ) {
                        $defaults = array(
                          'menu'            => '',
                          'container'       => false,
                          'container_class' => '',
                          'container_id'    => '',
                          'menu_class'      => 'menu',
                          'menu_id'         => '',
                          'echo'            => true,
                          'fallback_cb'     => false,
                          'before'          => '',
                          'after'           => '',
                          'link_before'     => '',
                          'link_after'      => '',
                          'items_wrap'      => '%3$s',
                          'depth'           => 0,
                          'walker'          => ''
                        );
                        $defaults['theme_location'] = 'primary';
                        wp_nav_menu( $defaults );
                      }else{
                        echo '<p class="no-menu text-right">';
                          echo esc_html__('Header 2 navigation menu is missing.', 'ibid');
                        echo '</p>';
                      }
                    ?>
                  </ul>
                 </div>
                </div>
              </nav>
            </div>


            <?php if (class_exists('WooCommerce')) { ?>
              <div class="col-md-5 menu-products">
            <?php } else { ?>
              <div class="col-md-5 menu-products">
            <?php } ?>
               <?php if ( class_exists( 'WooCommerce' ) && 1==2) { ?>
                <div class="header_mini_cart_group">
                  <?php 
                    if ( has_nav_menu( 'menu_header_2' ) ) {
                        $defaults = array(
                          'menu'            => '',
                          'container'       => false,
                          'container_class' => '',
                          'container_id'    => '',
                          'menu_class'      => 'menu',
                          'menu_id'         => '',
                          'echo'            => true,
                          'fallback_cb'     => false,
                          'before'          => '',
                          'after'           => '',
                          'link_before'     => '',
                          'link_after'      => '',
                          'items_wrap'      => '%3$s',
                          'depth'           => 0,
                          'walker'          => ''
                        );
                        $defaults['theme_location'] = 'menu_header_2';
                        wp_nav_menu( $defaults );
                      }else{
                        echo '<p class="no-menu text-right">';
                          echo esc_html__('Header 2 navigation menu is missing.', 'ibid');
                        echo '</p>';
                      }
                  ?>
                </div>
                <!-- Shop Minicart -->
                <div class="header_mini_cart">
                  <?php the_widget( 'WC_Widget_Cart' ); ?>
                </div>
              <?php } ?>
              
                <div class="add_products">
                  <?php 
                    if ( has_nav_menu( 'menu_header_2' ) ) {
                        $defaults = array(
                          'menu'            => '',
                          'container'       => false,
                          'container_class' => '',
                          'container_id'    => '',
                          'menu_class'      => 'menu',
                          'menu_id'         => '',
                          'echo'            => true,
                          'fallback_cb'     => false,
                          'before'          => '',
                          'after'           => '',
                          'link_before'     => '',
                          'link_after'      => '',
                          'items_wrap'      => '%3$s',
                          'depth'           => 0,
                          'walker'          => ''
                        );
                        $defaults['theme_location'] = 'menu_header_2';
                        wp_nav_menu( $defaults );
                      }
                  ?>
                </div>
                <div class="my-account-navbar pull-right">
              <ul>
              <?php if ( class_exists('woocommerce')) { ?>
                <?php if (is_user_logged_in()) { ?> 
                  <div id="dropdown-user-profile" class="ddmenu">
                    <li id="nav-menu-register" class="nav-menu-account"><?php echo esc_html__('My Account','ibid'); ?></li>
                    <ul>
                      
                      <?php if(class_exists('Mtsub')) {
                         do_action( 'mt_after_my_account' ); ?>
                      <?php } ?>
                      <li><a href="<?php echo esc_url(get_permalink( get_option('woocommerce_myaccount_page_id') )); ?>"><i class="icon-layers icons"></i> <?php echo esc_html__('My Dashboard','ibid'); ?></a></li>
                      
                      <?php if(class_exists('Mt_Freelancer_Mode')) {
                        do_action( 'mt_before_dashboard' ); ?>
                      <?php } ?>
                      
                      <?php if (class_exists('Dokan_Vendor') && dokan_is_user_seller( dokan_get_current_user_id() )) {  ?>            
                        <li><a href="<?php echo esc_url( home_url().'/dashboard' ); ?>"><i class="icon-trophy icons"></i> <?php echo esc_html__('Vendor Dashboard','ibid'); ?></a></li>
                      <?php } ?>
                      
                      <?php if (class_exists('WCFM') && wcfm_is_vendor()) { ?>
                        <li><a href="<?php echo apply_filters( 'wcfm_dashboard_home', get_wcfm_page() ); ?>"><i class="icon-trophy icons"></i> <?php echo esc_html__('Vendor Dashboard','ibid'); ?></a></li>
                      <?php } ?>
                      
                      <?php if (class_exists('WC_Vendors')) { ?>
                        <?php if (get_option('wcvendors_vendor_dashboard_page_id') != '') { ?>
                          <li><a href="<?php echo esc_url( get_permalink(get_option('wcvendors_vendor_dashboard_page_id')) ); ?>"><i class="icon-trophy icons"></i> <?php echo esc_html__('Vendor Dashboard','ibid'); ?></a></li>
                        <?php } ?>
                      <?php } ?>
                      
                      <li><a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id')).'orders'); ?>"><i class="icon-bag icons"></i> <?php echo esc_html__('My Orders','ibid'); ?></a></li>
                      <li><a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id')).'edit-account'); ?>"><i class="icon-user icons"></i> <?php echo esc_html__('Account Details','ibid'); ?></a></li>
                      <div class="dropdown-divider"></div>
                      <li><a href="<?php echo esc_url(wp_logout_url( home_url() )); ?>"><i class="icon-logout icons"></i> <?php echo esc_html__('Log Out','ibid'); ?></a></li>
                    </ul>
                  </div>
                <?php } else { ?> <!-- logged out -->
                  <li id="nav-menu-login" class="ibid-logoin">
                    <?php do_action('ibid_login_link_a'); ?>
                  </li>
                <?php } ?>
              <?php } ?>
              </ul>
            </div>
            </div>
        </div>
      </div>
  </div>
  </div>
</header>