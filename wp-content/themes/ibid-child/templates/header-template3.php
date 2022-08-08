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

<header class="header-v3">

  <?php do_action('ibid_after_mobile_navigation_burger'); ?>

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
            <?php if (class_exists('WooCommerce')) : ?>
              
            <?php endif; ?>

            <div class="col-md-8 menu-holder">
              <nav class="navbar bottom-navbar-default pull-right" id="modeltheme-main-head">
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
                          echo esc_html__('Header 3 navigation menu is missing.', 'ibid');
                        echo '</p>';
                      }
                    ?>
                  </ul>
                 </div>
                </div>
              </nav>
            </div>
             <div class="col-md-2 my-account-navbar">
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

            <?php if (class_exists('WooCommerce')) { ?>
              <div class="col-md-2 menu-products">
            <?php } else { ?>
              <div class="col-md-12 menu-products">
            <?php } ?>
                
              <?php if ( class_exists( 'WooCommerce' ) ) { ?>
                <div class="header_mini_cart_group">
                  <a  class="shop_cart" href="<?php echo esc_url($cart_url); ?>">
                    <?php esc_html_e('My Cart', 'ibid'); ?> <span class="cart-contents_qty"><?php echo sprintf ( esc_html__('(%d)', 'ibid'), WC()->cart->get_cart_contents_count() ); ?></span>
                  </a>
                </div>
                <!-- Shop Minicart -->
                <div class="header_mini_cart">
                  <?php the_widget( 'WC_Widget_Cart' ); ?>
                </div>
              <?php } ?>
            </div>
        </div>
      </div>
  </div>
  </div>
</header>