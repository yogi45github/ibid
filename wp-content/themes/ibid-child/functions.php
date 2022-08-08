<?php
function ibid_child_scripts() {
    $parent_style = 'ibid-parent-child-style-css'; 
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'themes-css', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/start/jquery-ui.css', array() );
    wp_enqueue_style( 'custom-child-css', get_stylesheet_directory_uri().'/css/custom.css');

    wp_enqueue_script( 'ls-custom-js', get_stylesheet_directory_uri() . '/js/custom.js', array() );
    wp_enqueue_script( 'ls-commonjs-js', get_stylesheet_directory_uri() . '/js/commonjs.js', array() );
    wp_localize_script('ls-commonjs-js', 'lsAjax', array(
        'ajaxurl' => admin_url('admin-ajax.php')
    ));

}
add_action( 'wp_enqueue_scripts', 'ibid_child_scripts' );

function ajax_for_wp_admin() {
 wp_enqueue_script( 'ls-commonjs-js', get_stylesheet_directory_uri() . '/js/commonjs.js', array() );
  wp_localize_script('ls-commonjs-js', 'lsAjax', array(
      'ajaxurl' => admin_url('admin-ajax.php')
  ));
}
add_action( 'admin_enqueue_scripts', 'ajax_for_wp_admin' );
/* Auto Extend Auction by 2 min when a bid is placed within the last 5mins */
add_action( 'woocommerce_simple_auctions_outbid', 'woocommerce_simple_auctions_extend_time', 50 );
add_action( 'woocommerce_simple_auctions_proxy_outbid', 'woocommerce_simple_auctions_extend_time', 50 );
 
 
function woocommerce_simple_auctions_extend_time($data) {
 
    $product = get_product( $data['product_id'] );
 
    if ('auction' === $product->get_type() ) {
        $auctionend = new DateTime($product->get_auction_dates_to());
        $auctionendformat = $auctionend->format('Y-m-d H:i:s');
        $time = current_time( 'timestamp' );
        $timeplus5 = date('Y-m-d H:i:s', strtotime('+5 minutes', $time));
 
        if ($timeplus5 > $auctionendformat) {
            $auctionend->add(new DateInterval('PT120S'));
            update_post_meta( $data['product_id'], '_auction_dates_to', $auctionend->format('Y-m-d H:i:s') );
            // wc_add_notice(sprintf(__('Anti snipping enabled - auction end time extended for 2 minutes', 'wc_simple_auctions')), 'notice'); // optional, uncomment to use
        }
    }
}
 
function vv_add_product(){
 
if(isset($_POST["submit"]))
{

  global $wpdb;
  $post_data = array(
    'post_title' => $_POST['proname'],
    'post_content'=> $_POST['prodesc'],
    'post_type' => 'post',
    'post_status' => 'draft'
  );
  //$current_post_id = get_the_ID();
  //echo 'check'.$current_post_id;
  $post_id = wp_insert_post( $post_data );
  update_post_meta($post_id,'mat_type',$_POST['mat_type']);
  update_post_meta($post_id,'ad_province',$_POST['ad_province']);
  update_post_meta($post_id,'ad_city',$_POST['ad_city']);
  update_post_meta($post_id,'custom_mat_type',$_POST['custom_mat_type']);
  update_post_meta($post_id,'mat_grade',$_POST['mat_grade']);
  update_post_meta($post_id,'adau_amount_available',$_POST['adau_amount_available']);
  update_post_meta($post_id,'asking_price_ad',$_POST['asking_price_ad']); 
  update_post_meta($post_id,'are_mats_sorted',$_POST['are_mats_sorted']); 
  if ( isset($_FILES) && isset($_FILES['image']) ) {
       
        $upload = wp_upload_bits($_FILES["image"]["name"], null, file_get_contents($_FILES["image"]["tmp_name"]));
 
        if ( ! $upload_file['error'] ) {
            $filename = $upload['file'];
            $wp_filetype = wp_check_filetype($filename, null);
            $attachment = array(
                'post_mime_type' => $wp_filetype['type'],
                'post_title' => sanitize_file_name($filename),
                'post_content' => '',
                'post_status' => 'inherit'
            );
 
           $attachment_id = wp_insert_attachment( $attachment, $filename, $post_id );
 
            if ( ! is_wp_error( $attachment_id ) ) {
                require_once(ABSPATH . 'wp-admin/includes/image.php');
 
                $attachment_data = wp_generate_attachment_metadata( $attachment_id, $filename );
                wp_update_attachment_metadata( $attachment_id, $attachment_data );
                set_post_thumbnail( $post_id, $attachment_id );
            }
        }

    }
    if ( $_FILES ) { 
      $files = $_FILES["my_product_file_upload"];  
      foreach ($files['name'] as $key => $value) { 
              if ($files['name'][$key]) { 

                  $file = array( 
                      'name' => $files['name'][$key],
                      'type' => $files['type'][$key], 
                      'tmp_name' => $files['tmp_name'][$key], 
                      'error' => $files['error'][$key],
                      'size' => $files['size'][$key]
                  ); 
                  $_FILES = array ("my_product_file_upload" => $file);
                  $newupload = my_ads_handle_attachment( "my_product_file_upload", $post_id);
              } 
          $attach_newupload_ids[]=$newupload;
      }
      $attach_ids=implode(',',$attach_newupload_ids);
      // echo'ads att_id'; print_r($attach_ids);
      if($attach_ids){
        update_post_meta( $post_id, '_ad_image_gallery', $attach_ids);
      }
  }
   echo'<div class="success_msz_ad_au">Thank You, Your ad submitted successfully.</div>';
}

?>    
      <form method="post" enctype="multipart/form-data" id="ad_form" class="custom_form_design ad_post_form">
       <!--  <div><h4>Ad Data</h4></div> -->
        <div class="form-group">
          <div><label>Title</label></div>
          <div><input type="text" name="proname" class="proname form-control"/></div>
        </div>
        <div class="form-group">
          <div><label>Description</label></div>
          <div><textarea name="prodesc" class="prodesc form-control"></textarea></div>
        </div>
        <div class="form-group">
          <label><?php _e('Select Cover Image:', 'Your text domain here');?></label>
          <input class="form-control" type="file" id="adFile" name="image" accept="image/png, image/jpeg, image/jpg">
        </div>
        <div class="form-group">
        <label>Type of Mat </label>
        <select name="mat_type" id="mat_type">
          <option value="Spruce Access">Spruce Access
          </option>
          <option value="Fir Access">Fir Access
          </option>
          <option value="Hybrid Access">Hybrid Access
          </option>
          <option value="Oak Access">Oak Access
          </option>
          <option value="Rig Mats (8x20)">Rig Mats (8x20)
          </option>
          <option value="Rig Mats (8x40)" <?php if ($mattype == 'Rig Mats (8x40)') {
              echo 'selected="true"';
            } ?>>Rig Mats (8x40)
          </option>
          <option value="Crane Mats (4x20)">Crane Mats (4x20)
          </option>
          <option value="Other">Other
          </option>
        </select>
        </div>
        <div class="form-group custom_type_matdiv">
          <label>Custom Type of Mat </label>
          <input type='text' name='custom_mat_type' value=''>
        </div>
        <div class="form-group">
          <label>Grade of Mat </label>
          <select name="mat_grade" id="mat_grade">
            <option value="New">New</option>
            <option value="Grade A">Grade A</option>
            <option value="Grade B">Grade B</option>
            <option value="Grade C">Grade C</option>
            <option value="Grade D">Grade D</option>
            <option value="Different Grades in Mix">Different Grades in Mix</option>
          </select>
        </div>
        <div class="form-group">
          <label>Amount available</label>
          <input type='number' id="adau_amount_available" name='adau_amount_available' value=''>
        </div>
        <div class="form-group">
          <label>Province</label>
          <?php 
            global $wpdb;
            $states = $wpdb->get_results( "SELECT DISTINCT province_name FROM canadacities ORDER BY province_name ASC");
            //echo "<pre>"; print_r($states); die('vgdfsg');
          ?>
          <select name="ad_province" id="ad_province">
            <?php foreach ($states as $state) {
              echo '<option value="'.$state->province_name.'">'.ucwords(strtolower($state->province_name)).'</option>';
            } 
            ?>
          </select>
         
        </div>
        <div class="form-group">
          <label>City</label>
          <select name="ad_city" id="ad_city">
          </select>
        </div>
        <div class="form-group">
          <label>Asking Price (per mat)</label>
          <input type='number' name='asking_price_ad' class="prevent_alpha" id="asking_price_ad" value=''>
          <span class="error asking_price_ad_errmsg"></span>
        </div>
        <div class="form-group">
          <label>Are mat Sorted</label>
          <select name="are_mats_sorted" id="are_mats_sorted">
            <option value="Yes" <?php if ($mattype == 'Yes') {
                echo 'selected="true"';
              } ?> >Yes
            </option>
            <option value="No" <?php if ($mattype == 'No') {
                echo 'selected="true"';
              } ?>>No
            </option>
          </select>
        </div>
        <div class="form-group">
          <div><label>Choose product gallery images</label></div>
          <input type="file" id="ad_my_product_file_upload" class="ad_au_image_validation" name="my_product_file_upload[]" multiple="multiple" accept="image/x-png, image/jpeg, image/jpg">
          <span class="ad_img_erro error"> You can not upload more than 5 files </spna>
        </div>   
        <div class="ibid-submit">
          <input type="submit" id="ad_submit_btn" name="submit" value="Submit" class="submit"/>
        </div>
       
      </form>
    <?php
 
} 
add_shortcode('vv_add_product', 'vv_add_product');

add_shortcode('vv_add_auction', 'vv_add_auction');

function vv_add_auction()
{
    global $wp;
    ob_start();
    $myaccount_page = get_option( 'woocommerce_myaccount_page_id' );
    $myaccount_page_url = get_permalink( $myaccount_page );
    // if(!is_user_logged_in()){
    //     wp_redirect(home_url($myaccount_page_url));
    //      exit;
    // }
    if(isset($_POST["auction_submit_btn"]))
    {
      $start_au = $_POST['_auction_dates_from'];
      $end_au = $_POST['_auction_dates_to'];
      //echo 'start date'.$start_au;
      //echo 'start date'.$end_au;
      if($start_au > $end_au){
        //echo 'not allowed';
        //die('testing');
      }
      global $wpdb;
      $post_data = array(
        'post_title' => $_POST['proname'],
        'post_content'=> $_POST['prodesc'],
        'post_type' => 'product',
        'post_status' => 'draft'
      );
      $post_id = wp_insert_post( $post_data );
      // update_post_meta($post_id,'_regular_price',$_POST['proprice']);
      update_post_meta($post_id,'_auction_start_price',$_POST['_auction_start_price']);
      update_post_meta($post_id,'_auction_bid_increment',$_POST['_auction_bid_increment']);
      update_post_meta($post_id,'_auction_reserved_price',$_POST['_auction_reserved_price']);
      update_post_meta($post_id,'_auction_dates_from',$_POST['_auction_dates_from']);
      update_post_meta($post_id,'_auction_dates_to',$_POST['_auction_dates_to']);
      update_post_meta($post_id,'au_mat_type',$_POST['au_mat_type']);
      update_post_meta($post_id,'au_custom_mat_type',$_POST['au_custom_mat_type']);
      update_post_meta($post_id,'au_mat_grade',$_POST['au_mat_grade']);
      update_post_meta($post_id,'au_location',$_POST['au_location']);
      update_post_meta($post_id,'au_asking_price_ad',$_POST['au_asking_price_ad']); 
      update_post_meta($post_id,'adau_amount_available',$_POST['adau_amount_available']);
      update_post_meta($post_id,'au_are_mats_sorted',$_POST['au_are_mats_sorted']);
      wp_set_object_terms( $post_id, 'auction', 'product_type' );
      
      if ( isset($_FILES) && isset($_FILES['image']) ) {
           
            $upload = wp_upload_bits($_FILES["image"]["name"], null, file_get_contents($_FILES["image"]["tmp_name"]));
     
            if ( ! $upload_file['error'] ) {
                $filename = $upload['file'];
                $wp_filetype = wp_check_filetype($filename, null);
                $attachment = array(
                    'post_mime_type' => $wp_filetype['type'],
                    'post_title' => sanitize_file_name($filename),
                    'post_content' => '',
                    'post_status' => 'inherit'
                );
     
               $attachment_id = wp_insert_attachment( $attachment, $filename, $post_id );
     
                if ( ! is_wp_error( $attachment_id ) ) {
                    require_once(ABSPATH . 'wp-admin/includes/image.php');
     
                    $attachment_data = wp_generate_attachment_metadata( $attachment_id, $filename );
                    wp_update_attachment_metadata( $attachment_id, $attachment_data );
                    set_post_thumbnail( $post_id, $attachment_id );
                }
            }
        }
        if ( $_FILES ) { 
          $files = $_FILES["my_file_upload"];  
          foreach ($files['name'] as $key => $value) { 
                  if ($files['name'][$key]) { 
  
                      $file = array( 
                          'name' => $files['name'][$key],
                          'type' => $files['type'][$key], 
                          'tmp_name' => $files['tmp_name'][$key], 
                          'error' => $files['error'][$key],
                          'size' => $files['size'][$key]
                      ); 
                      $_FILES = array ("my_file_upload" => $file);
                      $newupload = my_handle_attachment( "my_file_upload", $post_id);
                  } 
              $attach_newupload_ids[]=$newupload;
          }
          $attach_ids=implode(',',$attach_newupload_ids);
          if($attach_ids){
            update_post_meta( $post_id, '_product_image_gallery', $attach_ids);
          }

      }
      //wp_redirect(home_url($wp->request ));
      ob_end_clean();
      echo'<div class="success_msz_ad_au">
        Thank You, Your auction submitted successfully.</div>';
    }
?>

  
      <form method="post" action="" enctype="multipart/form-data" name="add_auction_form" id="add_auction_form" class="custom_form_design ad_auction_form">
        <!-- <div><h4>Product Data</h4></div> -->
        <div class="form-group">
          <div><label>Product Name</label></div>
          <div>
            <input type="text" name="proname" class="form-control proname"/>
            <span class="auc_error" id="auc_name"></span>
          </div>
        </div>
        <div class="form-group">
          <div><label>Product Description</label></div>
          <div>
            <textarea name="prodesc" class="prodesc form-control"></textarea>
            <span class="auc_error" id="auc_desc"></span>
          </div>
        </div>
        <div class="mb-3">
          <label for="formFile" class="form-label">Select Cover Image</label>
          <input class="form-control" type="file" id="formFile" name="image" accept="image/png, image/jpeg, image/jpg">
        </div> 
        <div class="form-group">
        <label>Type of Mat </label>
        <select name="au_mat_type" id="au_mat_type">
          <option value="Spruce Access">Spruce Access
          </option>
          <option value="Fir Access">Fir Access
          </option>
          <option value="Hybrid Access">Hybrid Access
          </option>
          <option value="Oak Access">Oak Access
          </option>
          <option value="Rig Mats (8x20)">Rig Mats (8x20)
          </option>
          <option value="Rig Mats (8x40)" <?php if ($mattype == 'Rig Mats (8x40)') {
              echo 'selected="true"';
            } ?>>Rig Mats (8x40)
          </option>
          <option value="Crane Mats (4x20)">Crane Mats (4x20)
          </option>
          <option value="Other">Other
          </option>
        </select>
        </div>
        <div class="form-group au_custom_type_matdiv">
          <label>Custom Type of Mat </label>
          <input type='text' name='au_custom_mat_type' class="form-control" value=''>
        </div>
        <div class="form-group">
          <label>Grade of Mat </label>
          <select name="au_mat_grade" id="au_mat_grade">
            <option value="New">New</option>
            <option value="Grade A">Grade A</option>
            <option value="Grade B">Grade B</option>
            <option value="Grade C">Grade C</option>
            <option value="Grade D">Grade D</option>
            <option value="Different Grades in Mix">Different Grades in Mix</option>
          </select>
        </div>
        <div class="form-group">
          <label>Location</label>
          <input type='text' name='au_location' class="form-control">
        </div>
        <div class="form-group">
          <label>Asking Price (per mat)</label>
          <input type='number' name='au_asking_price_ad' id="au_asking_price_ad" class="form-control prevent_alpha">
          <span class="error au_asking_price_ad_errmsg"></span>
        </div>
        <div class="form-group">
          <label>Amount available</label>
          <input type='number' id="adau_amount_available" name='adau_amount_available' class="form-control prevent_alpha">
        </div>
        <div class="form-group">
          <label>Are mat Sorted</label>
          <select name="au_are_mats_sorted" id="au_are_mats_sorted">
            <option value="Yes" <?php if ($mattype == 'Yes') {
                echo 'selected="true"';
              } ?> >Yes
            </option>
            <option value="No" <?php if ($mattype == 'No') {
                echo 'selected="true"';
              } ?>>No
            </option>
          </select>
        </div>   
        <div class="form-group">
          <div><label>Auction Start Price (per mat)</label></div>
          <div><input type="number" name="_auction_start_price" id="_auction_start_price" class="proprice form-control prevent_alpha"/>
          <span class="error _auction_start_price_errmsg"></span>
          </div>
        </div>
        <div class="form-group">        
          <div><label>Auction Bid Increment</label></div>
          <div><input type="number" name="_auction_bid_increment" id="_auction_bid_increment" class="proprice form-control prevent_alpha"/>
          <span class="error _auction_bid_increment_errmsg" ></span>
          </div>
        </div>
        <!-- <div class="form-group">
          <div><label>Auction reserved price</label></div>
          <div><input type="text" name="_auction_reserved_price" class="proprice form-control"/></div>
        </div> -->
        <div class="form-group">
          <div><label>Auction start from</label></div>
          <div class='input-group date' id='auction_start_date'>
              <input type='text' name="_auction_dates_from" class="proprice form-control" id="startDate" />
              <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
          </div>
          <!--<div><input type="text" name="_auction_dates_from" class="proprice form-control " id="startDate" />
             <span class="startend_date_erro error"> Please enter a valid date </span>
            <span class="startend_dateformat_erro error"> wrong format please enter date in correct format yyyy-mm-dd hh:mm </span>
            <span class="beforestart_erro error"> You can't selecte perevious date selecte any future date. </span> 
          </div>-->
        </div>
        <div class="form-group">
          <div><label>Auction end on</label></div>
          <!--<div><input type="text" name="_auction_dates_to" class="proprice form-control" id="endDate" />
             <span class="startend_date_erro error"> Please enter a valid date </spna> 
          </div>-->
          <div class='input-group date' id='auction_end_date'>
              <input type='text' name="_auction_dates_to" class="proprice form-control" id="endDate" />
              <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
            </div>
            <span class="startend_date_erro error"> Please enter a valid date </spna> 
        </div>    
        <div class="form-group">
          <div><label>Choose gallery images</label></div>
          <input type="file" name="my_file_upload[]" class="ad_au_image_validation" multiple="multiple" accept="image/png, image/jpeg, image/jpg">
          <span class="ad_img_erro error"> You can not upload more than 5 files </spna>
        </div>
                  
        <div class="ibid-submit">
          <input type="submit" name="auction_submit_btn" value="Submit" class="submit" id="auction_submit_btn" />
          <!-- onclick="prodsubmit();" -->
        </div>
        
      </form>
   
  <?php 
}



add_shortcode( 'post_quote', 'post_quote' );
function post_quote( ) {
  //if(isset($_POST['quote_email'])){
    //print_r($_POST);
    //echo get_the_Title();
  //}
  $current_post_id = get_the_ID();
  $current_post_title = get_the_Title();
  //echo "admin_email: ".$admin_email;
  $html = ' <div>
           <form class="shake" role="form" method="post" id="contactForm" name="contact-form" data-toggle="validator">
                      <!-- Name -->
                      <div class="row">
                        <div class="col-md-6 form-group label-floating">
                          <label class="control-label" for="name">Name</label>
                          <input class="form-control" id="quote_name" type="text" name="quote_name" required data-error="Please enter your name" placeholder="Enter">
                          <div class="help-block with-errors"></div>
                        </div>
                        <!-- email -->
                        <div class="col-md-6 form-group label-floating">
                          <label class="control-label" for="email">Email</label>
                          <input class="form-control" id="quote_email" type="email" name="quote_email" required data-error="Please enter your Email" placeholder="Enter">
                          <div class="help-block with-errors"></div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6 form-group label-floating">
                          <label>Company</label>
                          <input class="form-control" type="text" name="ad_compony" placeholder="Enter name">
                        </div>
                        <div class="col-md-6 form-group label-floating">
                          <label>Offer Price (per mat)</label>
                          <input class="form-control" type="number" name="ad_offer_price" id="ad_offer_price" placeholder="Enter price">
                          <span class="error ad_offer_price_errmsg"></span>
                        </div>
                      </div>
                      <!-- Subject -->
                      <!--<div class="form-group label-floating">
                        <label class="control-label">Subject</label>
                        <input class="form-control" id="msg_subject" type="text" name="quote_subject" required data-error="Please enter your message subject" >
                        <div class="help-block with-errors"></div>
                      </div>-->
                      <div class="form-group label-floating">
                          <label for="contactnumber" class="control-label">Contact Number</label>
                          <input type="number" class="form-control" rows="3" id="contact_number" name="contact_number" required  placeholder="Contact Number"></input>
                          <span class="error contact_number_errmsg"></span>
                      </div>
                      <!-- Message -->
                      <div class="form-group label-floating">
                          <label for="message" class="control-label">Message</label>
                          <textarea class="form-control" rows="3" id="message" name="quote_message" required data-error="Write your message" placeholder="Message...."></textarea>
                          <div class="help-block with-errors"></div>
                      </div>
                      <div class="form-group label-floating">
                          <input class="form-control" id="cr_post_id" type="hidden" name="cr_post_id" value="'.$current_post_id.'">
                      </div>
                      <div class="form-group label-floating">
                          <input class="form-control" id="cr_post_id" type="hidden" name="cr_post_name" value="'.$current_post_title.'">
                      </div>
                      <!-- Form Submit -->
                      <div class="form-submit mt-5">
                          <button class="btn btn-common" type="submit" id="form-submit" name="quote_submit_btn"><i class="material-icons mdi mdi-message-outline"></i> Submit</button>
                          <div id="msgSubmit" class="h3 text-center hidden"></div>
                          <div class="clearfix"></div>
                      </div>
                      <div id="success_msz" style="display:none">Thank You, Your Interest submitted successfully. </div>
                  </form>
                  </div>';
                  return $html;
}


?><?php
//add_action('init','sending_adquote_mail_to_admin');
//mail ('yogi45vision@gmail.com', "Test Postfix", "Test mail from postfix");
add_action('wp_ajax_callback_function','callback_function');
add_action('wp_ajax_nopriv_callback_function','callback_function');
function callback_function(){
if ($_POST['action']=='callback_function') {
      $formdata=$_POST['AdForm'];
      $admin_email = get_option( 'admin_email' );
      //$admin_email = 'manolii2@ualberta.ca';
      //$admin_email = 'lalitvisionvivante@gmail.com';
      parse_str($formdata);
      $name = $quote_name;
      $email_address = $quote_email;
      $subject = $quote_subject;
      $message = $quote_message;
      $adid = $cr_post_id;
      $adname = $cr_post_name;
      $adcompony = $ad_compony;
      $adofferprice = $ad_offer_price;
      $contactnumber = $contact_number;
      $ad_link = get_permalink($adid);
      $email_subject = "$name submitted their interest towards '$adname' Ad.";
      $email_body = "<h2 style='text-align:center;'>You have received a new Ad interest submission.</h2>".
          " <h3 style='text-align:center;'>Here are the details</h3><table> <tr> <td style='font-size: 15px; font-weight: 600; padding:5px;width: 25%;'>Interested Buyer's name</td> <td style='font-size: 15px;padding:5px;'> $name </td></tr> ".
          "<tr> <td style='font-size: 15px; font-weight: 600;padding:5px;width: 25%;'>Interested Buyer's email</td> <td style='font-size: 15px;padding:5px;'> $email_address </td></tr> <tr> <td style='font-size: 15px; font-weight: 600;padding:5px;width: 25%;'>Ad name</td> <td style='font-size: 15px;padding:5px;'> $adname </td></tr> <tr> <td style='font-size: 15px; font-weight: 600;padding:5px;width: 25%;'> Message</td> <td style='font-size: 15px;padding:5px;'> $message </td></tr> <tr> <td style='font-size: 15px; font-weight: 600;padding:5px;width: 25%;'>Company of Buyer</td> <td style='font-size: 15px;padding:5px;'> $adcompony </td></tr> <tr> <td style='font-size: 15px; font-weight: 600;padding:5px;width: 25%;'>Contact Number</td> <td style='font-size: 15px;padding:5px;'> $contactnumber </td></tr> <tr> <td style='font-size: 15px; font-weight: 600;padding:5px;width: 25%;'>Ad's Link</td> <td style='font-size: 15px;padding:5px;'> $ad_link </td></tr> <tr> <td style='font-size: 15px; font-weight: 600;padding:5px;width: 25%;'>Offer Price (per mat)</td> <td style='font-size: 15px;padding:5px;'> $adofferprice</td></tr></table>";
      $headers = "From: $myemail\n";
      $headers .= "Reply-To: $email_address";
      $response = wp_mail($admin_email,$email_subject,$email_body);
  }
}

add_action( 'template_redirect', 'custom_redirection' );
 
function custom_redirection(){
         
  /* get current page or post ID */
  $page_id = get_queried_object_id();
  /* add lists of page or post IDs for restriction */
  $behind_login_pages = [ 7475, 6817];
 
  if( ( !empty($behind_login_pages) && in_array($page_id, $behind_login_pages) ) && !is_user_logged_in() ):
    $myaccount_page = get_option( 'woocommerce_myaccount_page_id' );
    $myaccount_page_url = get_permalink( $myaccount_page );
    wp_redirect($myaccount_page_url);
      //return;
      exit;
  endif;
}

function my_custom_sidebar1() {
    register_sidebar(
        array (
            'name' => __( 'Auction Sidebar', 'your-theme-domain' ),
            'id' => 'auction sidebar',
            'description' => __( 'Custom Sidebar', 'your-theme-domain' ),
            'before_widget' => '<div class="widget-content">',
            'after_widget' => "</div>",
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );
}
add_action( 'widgets_init', 'my_custom_sidebar1' );

add_action( 'phpmailer_init', 'send_smtp_email' );
function send_smtp_email( $phpmailer ) {
  if ( ! is_object( $phpmailer ) ) {
    $phpmailer = (object) $phpmailer;
  }

  $phpmailer->Mailer     = 'smtp';
  $phpmailer->Host       = SMTP_HOST;
  $phpmailer->SMTPAuth   = SMTP_AUTH;
  $phpmailer->Port       = SMTP_PORT;
  $phpmailer->Username   = SMTP_USER;
  $phpmailer->Password   = SMTP_PASS;
  $phpmailer->SMTPSecure = SMTP_SECURE;
  $phpmailer->From       = SMTP_FROM;
  $phpmailer->FromName   = SMTP_NAME;
}

/* Request_quote button*/  
if( class_exists('YITH_YWRAQ_Frontend') ){
  remove_action( 'woocommerce_single_product_summary', array( YITH_YWRAQ_Frontend(), 'add_button_single_page' ), 35 );
  add_action( 'your_loop_hook', array( YITH_YWRAQ_Frontend(), 'add_button_single_page' ) );
}

add_filter( 'query_vars', 'ls_save_ads_query_vars', 0 );
function ls_save_ads_query_vars( $vars ) {
    $vars[] = 'save-ads';
    $vars[] = 'future-coming-auction';
    $vars[] = 'completed-auction';
    $vars[] = 'live-auction';
    return $vars;
} 
add_action( 'wp_loaded', 'my_custom_flush_rewrite_rules' );
function my_custom_flush_rewrite_rules() {
    flush_rewrite_rules();
}
add_action( 'init', 'ls_add_endpoint' );
function ls_add_endpoint() {
  add_rewrite_endpoint( 'save-ads', EP_PAGES );
  add_rewrite_endpoint( 'future-coming-auction', EP_PAGES );
  add_rewrite_endpoint( 'completed-auction', EP_PAGES );
  add_rewrite_endpoint( 'live-auction', EP_PAGES );

}
/*menu item*/
add_filter ( 'woocommerce_account_menu_items', 'ls_new_menu_link_add' );
function ls_new_menu_link_add( $menu_links ){
  $menu_links['save-ads'] = 'Save Ads';
  $menu_links['future-coming-auction'] = 'Future Coming Auction';
  $menu_links['completed-auction'] = 'Completed Auction';
  $menu_links['live-auction'] = 'Live Auction';
  return $menu_links;
}
add_action( 'woocommerce_account_save-ads_endpoint', 'ls_my_account_endpoint_content' );
function ls_my_account_endpoint_content() {
  global $wpdb;
  $results=array();
  $html='';
  $user_id=get_current_user_id();
  $args=array('numberposts'=> -1,'orderby'=> 'date','order'=>'DESC','post_type'=> 'post','post_status'=>array('publish','draft','pending'),'post_author'=>$user_id); 
  $data=get_posts($args);
  $html.='<div class="woocommerce">
          <div class="simple-auctions active-auctions clearfix">
          <h2>Your ADS</h2></div>';
          if($data){
            foreach($data as $single_data){
              $ads_id=$single_data->ID;
              $authordata = $single_data->post_author;
              $poststatus = $single_data->post_status;
              $ads_title=$single_data->post_title;
              $ads_content=$single_data->post_content;
              $ads_link=get_permalink($ads_id);
              $ads_image=get_the_post_thumbnail_url( $ads_id );
              if ($authordata == $user_id) {
                $html.='<div class="my_account_ads products columns-3 col-md-4 post-status-'.$poststatus.'">
                       <div class=" first post-'.$ads_id.' product type-product status-publish has-post-thumbnail product_cat-buldozers instock sale sold-individually shipping-taxable purchasable product-type-auction">
                          <div class="products-wrapper">
                             <div class="thumbnail-and-details">
                                <a class="woo_catalog_media_images" title="filter product" href="'.$ads_link.'">
                                  <img width="260" height="200" src="'.$ads_image.'" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" loading="lazy"></a>
                             </div>
                             <div class="woocommerce-title-metas">
                                <h3 class="archive-product-title post-name">
                                   <a href="'.$ads_link.'">
                                      '.$ads_title.'
                                   </a>
                                </h3>
                                <div class="article-detail-meta post-date margin-right0">
                                    <i class="icon-calendar"></i>
                                    '.esc_html(get_the_date('F j Y',$ads_id)).'
                                ';
                              if ($poststatus == "draft" || $poststatus == "pending") {
                              $html.='<div>Ad Status: '.$poststatus.'</div>';
                              }
                            $html.='</div></div>
                          </div>
                       </div>
                </div>';
            }
          }
  }

  $html.='  <div class="simple-auctions active-auctions clearfix row">
          <h2 class="save-ads-heading">Ads</h2>'; 
       
  if($data){
    foreach($data as $single_data){
      $ads_id=$single_data->ID;
      $authordata = $single_data->post_author;
      $poststatus = $single_data->post_status;
      //echo "Author".$authordata;
      $ads_title=$single_data->post_title;
      $ads_content=$single_data->post_content;
      $ads_link=get_permalink($ads_id);
      $ads_image=get_the_post_thumbnail_url( $ads_id );
      if($poststatus == "publish"){
      $html.='<div class="my_account_ads products columns-3 col-md-4">
             <div class=" first post-'.$ads_id.' product type-product status-publish has-post-thumbnail product_cat-buldozers instock sale sold-individually shipping-taxable purchasable product-type-auction">
                <div class="products-wrapper">
                   <div class="thumbnail-and-details">
                      <a class="woo_catalog_media_images" title="filter product" href="'.$ads_link.'">
                        <img width="260" height="200" src="'.$ads_image.'" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" loading="lazy"></a>
                   </div>
                   <div class="woocommerce-title-metas">
                      <h3 class="archive-product-title post-name">
                         <a href="'.$ads_link.'">
                            '.$ads_title.'
                         </a>
                      </h3>
                      <div class="article-detail-meta post-date margin-right0">
                          <i class="icon-calendar"></i>
                          '.esc_html(get_the_date('F j Y',$ads_id)).'
                      </div>
                   </div>
                </div>
             </div>
          </div>';
    }
    }
  }
   $html.='</div></div>';

   echo $html;

}

/*My-account page menu data */
add_action( 'woocommerce_account_future-coming-auction_endpoint', 'ls_my_account_future_auctions' );
function ls_my_account_future_auctions(){
   echo do_shortcode('[future_auctions per_page="12" columns="4" orderby="date" order="desc"]');
}
add_action( 'woocommerce_account_completed-auction_endpoint', 'ls_my_account_completed_auction' );
function ls_my_account_completed_auction(){
  echo do_shortcode('[past_auctions per_page="12" columns="4" orderby="date" order="desc"]');
}
add_action( 'woocommerce_account_live-auction_endpoint', 'ls_my_account_live_auction' );
function ls_my_account_live_auction(){
  echo do_shortcode('[ending_soon_auctions per_page="12" columns="4" order="desc" orderby="meta_value" future="yes"]');
}

add_action( 'add_meta_boxes', 'create_custom_mattype_meta_box', 10, 2 );
function create_custom_mattype_meta_box( $post_type, $post ) {
  add_meta_box( 'mat_type_dropdown', __( 'Type of Mat', 'wk-custom-meta-box' ), 'mattype_metafeild', 'post', 'side', 'high' );
}

function mattype_metafeild() {
    $id=get_the_id();
    $mattype = get_post_meta( $id, 'mat_type', true );
    //echo $mattype;
    ?>
    <select name="mat_type" id="mat_type">
      <option value="Spruce Access" <?php if ($mattype == 'Spruce Access') {
          echo 'selected="true"';
        } ?> >Spruce Access
      </option>
      <option value="Fir Access" <?php if ($mattype == 'Fir Access') {
          echo 'selected="true"';
        } ?>>Fir Access
      </option>
      <option value="Hybrid Access" <?php if ($mattype == 'Hybrid Access') {
          echo 'selected="true"';
        } ?>>Hybrid Access
      </option>
      <option value="Oak Access" <?php if ($mattype == 'Oak Access') {
          echo 'selected="true"';
        } ?>>Oak Access
      </option>
      <option value="Rig Mats (8x20)" <?php if ($mattype == 'Rig Mats (8x20)') {
          echo 'selected="true"';
        } ?>>Rig Mats (8x20)
      </option>
      <option value="Rig Mats (8x40)" <?php if ($mattype == 'Rig Mats (8x40)') {
          echo 'selected="true"';
        } ?>>Rig Mats (8x40)
      </option>
      <option value="Crane Mats (4x20)" <?php if ($mattype == 'Crane Mats (4x20)') {
          echo 'selected="true"';
        } ?>>Crane Mats (4x20)
      </option>
      <option value="Other" <?php if ($mattype == 'Other') {
          echo 'selected="true"';
        } ?>>Other
      </option>
  </select>
  <?php
}

function save_mat_type_metafeild( $post_id ) {
  $mattype_content = $_POST['mat_type'];
  if (!empty($mattype_content)) {
    update_post_meta( $post_id, 'mat_type', $mattype_content );
  }
}
add_action( 'save_post', 'save_mat_type_metafeild' );

add_action( 'add_meta_boxes', 'create_custom_custommattype_meta_box', 10, 2 );
function create_custom_custommattype_meta_box( $post_type, $post ) {
  $id=get_the_id();
  $mattype = get_post_meta( $id, 'mat_type', true );
    if($mattype == 'Other'){
  add_meta_box( 'custom-mattype_input', __( 'Custom Type of Mat', 'wk-custom-meta-box' ), 'custom_mattype_metafeild', 'post', 'side', 'high' );
  }
}
function custom_mattype_metafeild() {
    $id=get_the_id();
    $mattype_custom = get_post_meta( $id, 'custom_mat_type', true );
    $mattype = get_post_meta( $id, 'mat_type', true );
    if($mattype == 'Other'){
    ?>
      <input type='text' name='custom_mat_type' value='<?php echo $mattype_custom ?>'>
  <?php }
}
function save_custom_mat_type_metafeild( $post_id) {
  if (!empty($custom_mattype_content)) {
    update_post_meta( $post_id, 'custom_mat_type', $custom_mattype_content );
  }
}
add_action( 'save_post', 'save_custom_mat_type_metafeild' );
add_action( 'add_meta_boxes', 'mat_grade_dropdown', 10, 2 );
function mat_grade_dropdown( $post_type, $post ) {
  add_meta_box( 'mat_grade_metabox', __( 'Grade of Mat', 'wk-custom-meta-box' ), 'mat_grade_metafeild', 'post', 'side', 'high' );
}

function mat_grade_metafeild() {
    $id=get_the_id();
    $mattype = get_post_meta( $id, 'mat_grade', true );
    //echo $mattype;
    ?>
    <select name="mat_grade" id="mat_grade">
      <option value="New" <?php if ($mattype == 'New') {
          echo 'selected="true"';
        } ?> >New
      </option>
      <option value="Grade A" <?php if ($mattype == 'Grade A') {
          echo 'selected="true"';
        } ?>>Grade A
      </option>
      <option value="Grade B" <?php if ($mattype == 'Grade B') {
          echo 'selected="true"';
        } ?>>Grade B
      </option>
      <option value="Grade C" <?php if ($mattype == 'Grade C') {
          echo 'selected="true"';
        } ?>>Grade C
      </option>
      <option value="Grade D" <?php if ($mattype == 'Grade D') {
          echo 'selected="true"';
        } ?>>Grade D
      </option>
      <option value="Different Grades in Mix" <?php if ($mattype == 'Different Grades in Mix') {
          echo 'selected="true"';
        } ?>>Different Grades in Mix
      </option>
  </select>
  <?php
}

function save_mat_grade_metafeild( $post_id ) {
  $custom_mattype_content = $_POST['mat_grade'];
  if (!empty($custom_mattype_content)) {
    update_post_meta( $post_id, 'mat_grade', $custom_mattype_content );
  }
}
add_action( 'save_post', 'save_mat_grade_metafeild' );



add_action( 'add_meta_boxes', 'asking_price_for_ad', 10, 2 );
function asking_price_for_ad( $post_type, $post ) {
  add_meta_box( 'asking_price_input', __( 'Asking Price
    ', 'wk-custom-meta-box' ), 'asking_price_for_ad_metafeild', 'post', 'side', 'high' );
}
function asking_price_for_ad_metafeild() {
    $id=get_the_id();
    $mattype_custom = get_post_meta( $id, 'asking_price_ad', true );
    ?>
      <input type='text' name='asking_price_ad' value='<?php echo $mattype_custom ?>'>
      
  <?php
}

function save_asking_price_for_ad_metafeild( $post_id ) {
  $custom_mattype_content = $_POST['asking_price_ad'];
  if (!empty($custom_mattype_content)) {
    update_post_meta( $post_id, 'asking_price_ad', $custom_mattype_content );
  }
}
add_action( 'save_post', 'save_asking_price_for_ad_metafeild' );

add_action( 'add_meta_boxes', 'mat_sorted_dropdown', 10, 2 );
function mat_sorted_dropdown( $post_type, $post ) {
  add_meta_box( 'mat_sorted_metabox', __( 'Are Mat Sorted', 'wk-custom-meta-box' ), 'mat_sorted_metafeild', 'post', 'side', 'high' );
}
function mat_sorted_metafeild() {
    $id=get_the_id();
    $mattype = get_post_meta( $id, 'are_mats_sorted', true );
    //echo $mattype;
    ?>
    <select name="are_mats_sorted" id="are_mats_sorted">
      <option value="Yes" <?php if ($mattype == 'Yes') {
          echo 'selected="true"';
        } ?> >Yes
      </option>
      <option value="No" <?php if ($mattype == 'No') {
          echo 'selected="true"';
        } ?>>No
      </option>
    </select>
  <?php
}

function save_mat_sorted_metafeild( $post_id ) {
  $custom_mattype_content = $_POST['are_mats_sorted'];
  if (!empty($custom_mattype_content)) {
    update_post_meta( $post_id, 'are_mats_sorted', $custom_mattype_content );
  }
}
add_action( 'save_post', 'save_mat_sorted_metafeild' );

add_action( 'add_meta_boxes', 'ad_gallery_images', 10, 2 );
function ad_gallery_images( $post_type, $post ) {
  add_meta_box( 'ad_gallery_images_metabox', __( 'Ad Gallery Images', 'wk-custom-meta-box' ), 'ad_gallery_images_metafeild', 'post', 'side', 'high' );
}
function ad_gallery_images_metafeild() {
    $id=get_the_id();
    $mattype = get_post_meta( $id, '_ad_image_gallery', true );
    //echo $mattype;
    //print_r (explode(",",$mattype));
    $img_ids = explode(",",$mattype);
    ?> <div style="display:flex"><?php 
    foreach($img_ids as $value ){
      //echo $value.'<br>';
      ?> <div style="width:33%;"><?php
      echo wp_get_attachment_image($value, $size = 'thumbnail');
      ?> </div><?php
    }
    ?>
   </div>
  <?php
}


add_action( 'add_meta_boxes', 'ad_amount_available', 10, 2 );
function ad_amount_available( $post_type, $post ) {
  add_meta_box( 'ad_amount_available', __( 'Amount Available
    ', 'wk-custom-meta-box' ), 'ad_amount_available_metafeild', 'post', 'side', 'high' );
  add_meta_box( 'ad_amount_available', __( 'Amount Available
    ', 'wk-custom-meta-box' ), 'ad_amount_available_metafeild', 'product', 'side', 'high' );
}
function ad_amount_available_metafeild() {
    $id=get_the_id();
    $amount_available = get_post_meta( $id, 'adau_amount_available', true );
    ?>
      <input type='number' id="adau_amount_available" name='adau_amount_available' value='<?php echo $amount_available; ?>'>
  <?php
}
function save_ad_amount_available_metafeild( $post_id ) {
  $amonut_content = $_POST['adau_amount_available'];
    update_post_meta( $post_id, 'adau_amount_available', $amonut_content );
}
add_action( 'save_post', 'save_ad_amount_available_metafeild' );

add_action( 'add_meta_boxes', 'au_create_custom_mattype_meta_box', 10, 2 );
function au_create_custom_mattype_meta_box( $post_type, $post ) {
  $id=get_the_id();
    add_meta_box( 'au_mat_type_dropdown', __( 'Type of Mat', 'wk-custom-meta-box' ), 'au_mattype_metafeild', 'product', 'side', 'high' );
}
function au_mattype_metafeild() {
    $id=get_the_id();
    $mattype = get_post_meta( $id, 'au_mat_type', true );
    ?>
    <select name="au_mat_type" id="au_mat_type">
      <option value="Spruce Access" <?php if ($mattype == 'Spruce Access') {
          echo 'selected="true"';
        } ?> >Spruce Access
      </option>
      <option value="Fir Access" <?php if ($mattype == 'Fir Access') {
          echo 'selected="true"';
        } ?>>Fir Access
      </option>
      <option value="Hybrid Access" <?php if ($mattype == 'Hybrid Access') {
          echo 'selected="true"';
        } ?>>Hybrid Access
      </option>
      <option value="Oak Access" <?php if ($mattype == 'Oak Access') {
          echo 'selected="true"';
        } ?>>Oak Access
      </option>
      <option value="Rig Mats (8x20)" <?php if ($mattype == 'Rig Mats (8x20)') {
          echo 'selected="true"';
        } ?>>Rig Mats (8x20)
      </option>
      <option value="Rig Mats (8x40)" <?php if ($mattype == 'Rig Mats (8x40)') {
          echo 'selected="true"';
        } ?>>Rig Mats (8x40)
      </option>
      <option value="Crane Mats (4x20)" <?php if ($mattype == 'Crane Mats (4x20)') {
          echo 'selected="true"';
        } ?>>Crane Mats (4x20)
      </option>
      <option value="Other" <?php if ($mattype == 'Other') {
          echo 'selected="true"';
        } ?>>Other
      </option>
  </select>
  <?php 
}
function au_save_mat_type_metafeild( $post_id ) {
  $mattype_content = $_POST['au_mat_type'];
  if (!empty($mattype_content)) {
    update_post_meta( $post_id, 'au_mat_type', $mattype_content );
  }
}
add_action( 'save_post', 'au_save_mat_type_metafeild' );

add_action( 'add_meta_boxes', 'au_create_custom_custommattype_meta_box', 10, 2 );
function au_create_custom_custommattype_meta_box( $post_type, $post ) {
  $id=get_the_id();
  $product = get_product( $id );
  $mattype = get_post_meta( $id, 'au_mat_type', true );
  if($mattype == 'Other'){
    add_meta_box( 'au_custom-mattype_input', __( 'Custom Type of Mat', 'wk-custom-meta-box' ), 'au_custom_mattype_metafeild', 'product', 'side', 'high' );
  }
}
function au_custom_mattype_metafeild() {
    $id=get_the_id();
    $mattype_custom = get_post_meta( $id, 'au_custom_mat_type', true );
    $mattype = get_post_meta( $id, 'au_mat_type', true );
    if($mattype == 'Other'){
    ?>
      <input type='text' name='au_custom_mat_type' value='<?php echo $mattype_custom ?>'>
  <?php }
}

function au_custom_mat_type_metafeild( $post_id ) {
  $mattype_content = $_POST['au_custom_mat_type'];
  if (!empty($mattype_content)) {
    update_post_meta( $post_id, 'au_custom_mat_type', $mattype_content );
  }
}
add_action( 'save_post', 'au_custom_mat_type_metafeild' );

add_action( 'add_meta_boxes', 'au_mat_grade_dropdown', 10, 2 );
function au_mat_grade_dropdown( $post_type, $post ) {
  $id=get_the_id();
  $product = get_product( $id );
  add_meta_box( 'au_mat_grade_metabox', __( 'Grade of Mat', 'wk-custom-meta-box' ), 'au_mat_grade_metafeild', 'product', 'side', 'high' );
  
}

function au_mat_grade_metafeild() {
    $id=get_the_id();
    $mattype = get_post_meta( $id, 'au_mat_grade', true );
    //echo $mattype;
    $product = get_product( $id );
    ?>
    <select name="au_mat_grade" id="au_mat_grade">
      <option value="New" <?php if ($mattype == 'New') {
          echo 'selected="true"';
        } ?> >New
      </option>
      <option value="Grade A" <?php if ($mattype == 'Grade A') {
          echo 'selected="true"';
        } ?>>Grade A
      </option>
      <option value="Grade B" <?php if ($mattype == 'Grade B') {
          echo 'selected="true"';
        } ?>>Grade B
      </option>
      <option value="Grade C" <?php if ($mattype == 'Grade C') {
          echo 'selected="true"';
        } ?>>Grade C
      </option>
      <option value="Grade D" <?php if ($mattype == 'Grade D') {
          echo 'selected="true"';
        } ?>>Grade D
      </option>
      <option value="Different Grades in Mix" <?php if ($mattype == 'Different Grades in Mix') {
          echo 'selected="true"';
        } ?>>Different Grades in Mix
      </option>
  </select>
  <?php
}

function save_au_mat_grade_metafeild( $post_id ) {
  $mattype_content = $_POST['au_mat_grade'];
  if (!empty($mattype_content)) {
    update_post_meta( $post_id, 'au_mat_grade', $mattype_content );
  }
}
add_action( 'save_post', 'save_au_mat_grade_metafeild' );

add_action( 'add_meta_boxes', 'au_location', 10, 2 );
function au_location( $post_type, $post ) {
  $id=get_the_id();
  $product = get_product( $id );
  add_meta_box( 'au_location_input', __( 'Location', 'wk-custom-meta-box' ), 'au_location_metafeild', 'product', 'side', 'high' );
  
}
function au_location_metafeild() {
    $id=get_the_id();
    $mattype_custom = get_post_meta( $id, 'au_location', true );
    $product = get_product( $id );
    if ($product->get_type() == 'auction' ) {
    ?>
      <input type='text' name='au_location' value='<?php echo $mattype_custom ?>'>
  <?php
  }
}

function save_au_location_metafeild( $post_id ) {
  $mattype_content = $_POST['au_location'];
  if (!empty($mattype_content)) {
    update_post_meta( $post_id, 'au_location', $mattype_content );
  }
}
add_action( 'save_post', 'save_au_location_metafeild' );

add_action( 'add_meta_boxes', 'au_asking_price_for_ad', 10, 2 );
function au_asking_price_for_ad( $post_type, $post ) {
  $id=get_the_id();
  $product = get_product( $id );
  add_meta_box( 'au_asking_price_input', __( 'Asking price', 'wk-custom-meta-box' ), 'au_asking_price_for_ad_metafeild', 'product', 'side', 'high' );
  
}
function au_asking_price_for_ad_metafeild() {
    $id=get_the_id();
    $mattype_custom = get_post_meta( $id, 'au_asking_price_ad', true );
    $product = get_product( $id );
    if ($product->get_type() == 'auction') {
    ?>
      <input type='text' name='au_asking_price_ad' value='<?php echo $mattype_custom ?>'>
  <?php
  }
}

function save_au_asking_price_ad_metafeild( $post_id ) {
  $mattype_content = $_POST['au_asking_price_ad'];
  if (!empty($mattype_content)) {
    update_post_meta( $post_id, 'au_asking_price_ad', $mattype_content );
  }
}
add_action( 'save_post', 'save_au_asking_price_ad_metafeild' );

add_action( 'add_meta_boxes', 'au_mat_sorted_dropdown', 10, 2 );
function au_mat_sorted_dropdown( $post_type, $post ) {
  $id=get_the_id();
  $product = get_product( $id );
  add_meta_box( 'au_mat_sorted_metabox', __( 'Are Mat Sorted', 'wk-custom-meta-box' ), 'au_mat_sorted_metafeild', 'product', 'side', 'high' );
  
}
function au_mat_sorted_metafeild() {
    $id=get_the_id();
    $mattype = get_post_meta( $id, 'au_are_mats_sorted', true );
    //echo $mattype;
    $product = get_product( $id );
    ?>
    <select name="au_are_mats_sorted" id="au_are_mats_sorted">
      <option value="Yes" <?php if ($mattype == 'Yes') {
          echo 'selected="true"';
        } ?> >Yes
      </option>
      <option value="No" <?php if ($mattype == 'No') {
          echo 'selected="true"';
        } ?>>No
      </option>
    </select>
  <?php
}

function save_au_are_mats_sorted_metafeild( $post_id ) {
  $mattype_content = $_POST['au_are_mats_sorted'];
  if (!empty($mattype_content)) {
    update_post_meta( $post_id, 'au_are_mats_sorted', $mattype_content );
  }
}
add_action( 'save_post', 'save_au_are_mats_sorted_metafeild' );

add_action( 'add_meta_boxes', 'ad_provience_dropdown', 10, 2 );
function ad_provience_dropdown( $post_type, $post ) {
  add_meta_box( 'ad_provience_dropdown', __( 'provience', 'wk-custom-meta-box' ), 'ad_provience_dropdown_metafeild', 'post', 'side', 'high' );
}
function ad_provience_dropdown_metafeild() {
    $id=get_the_id();
    $saved_provience = get_post_meta( $id, 'ad_province', true );
    global $wpdb;
    $states = $wpdb->get_results( "SELECT DISTINCT province_name FROM canadacities ORDER BY province_name ASC");
    ?>
    <select name="ad_province" id="ad_province" post-id="<?php echo $id; ?>">
      <?php foreach ($states as $state) {
        if ($state->province_name == $saved_provience) {
          echo '<option value="'.$state->province_name.'" selected="true">'.ucwords(strtolower($state->province_name)).'</option>';
        }else{
          echo '<option value="'.$state->province_name.'">'.ucwords(strtolower($state->province_name)).'</option>';
        }
      } 
      ?>
    </select>
    <?php
}

function save_ad_provience_dropdown_metafeild( $post_id ) {
  $ad_province_content = $_POST['ad_province'];
  //echo $ad_province_content; die('fff');
  //if (!empty($custom_mattype_content)) {
   
    update_post_meta( $post_id, 'ad_province', $ad_province_content );
  //}
}
add_action( 'save_post', 'save_ad_provience_dropdown_metafeild' );

add_action( 'add_meta_boxes', 'ad_city_dropdown', 10, 2 );
function ad_city_dropdown( $post_type, $post ) {
  add_meta_box( 'ad_city_dropdown', __( 'City', 'wk-custom-meta-box' ), 'ad_city_dropdown_metafeild', 'post', 'side', 'high' );
}
function ad_city_dropdown_metafeild() {
  $id=get_the_id();
  $saved_city = get_post_meta( $id, 'ad_city', true );
  ?>
  <select name="ad_city" id="ad_city">
  </select>
  <?php
}

function save_ad_city_dropdown_metafeild( $post_id ) {
  $ad_city_content = $_POST['ad_city'];
  if (!empty($ad_city_content)) {
    update_post_meta( $post_id, 'ad_city', $ad_city_content );
  }
}
add_action( 'save_post', 'save_ad_city_dropdown_metafeild' );

function my_handle_attachment($file_handler,$post_id,$set_thu=false) {
  if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK) __return_false();
  require_once(ABSPATH . "wp-admin" . '/includes/image.php');
  require_once(ABSPATH . "wp-admin" . '/includes/file.php');
  require_once(ABSPATH . "wp-admin" . '/includes/media.php');
  $attach_id = media_handle_upload( $file_handler, $post_id );
  return $attach_id;  
}

function my_ads_handle_attachment($file_handler,$post_id,$set_thu=false) {
  if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK) __return_false();
  require_once(ABSPATH . "wp-admin" . '/includes/image.php');
  require_once(ABSPATH . "wp-admin" . '/includes/file.php');
  require_once(ABSPATH . "wp-admin" . '/includes/media.php');
  $attach_id = media_handle_upload( $file_handler, $post_id );
  return $attach_id;  
}

add_shortcode('searchauction', 'ls_auction_filters');
function ls_auction_filters(){
  $html='';
  $spruce_access=isset($_GET['spruce_access_1']) ? "checked" : '';
  $fir_access=isset($_GET['fire_access']) ? "checked" : '';
  $hybrid_access=isset($_GET['hybrid_access_1']) ? "checked" : '';
  $oak_access=isset($_GET['oak_access_1']) ? "checked" : '';
  $Rig_Mats_1=isset($_GET['Rig_Mats_1']) ? "checked" : '';
  $Rig_Mats_2=isset($_GET['Rig_Mats_2']) ? "checked" : '';
  $crane_mats_1=isset($_GET['crane_mats_1']) ? "checked" : '';
  $new=isset($_GET['new']) ? "checked" : '';
  $grade_a=isset($_GET['grade_a_1']) ? "checked" : '';
  $grade_b=isset($_GET['grade_b_1']) ? "checked" : '';
  $grade_c=isset($_GET['grade_c_1']) ? "checked" : '';
  $grade_d=isset($_GET['grade_d_1']) ? "checked" : '';
  $grades_mix=isset($_GET['grades_mix_1']) ? "checked" : '';
  $other=isset($_GET['other_1']) ? "checked" : '';
  $default='';$selected='';  $selected_1='';  $selected_2=''; $selected_3=''; $selected_4=''; $selected_5='';
  if($_GET){
    if($_GET['auction_price_1']=='100'){ 
      $selected="checked";
    }if($_GET['auction_price_1']=='251'){ 
      $selected_1="checked";
    }if($_GET['auction_price_1']=='351'){
      $selected_2="checked";
    }if($_GET['auction_price_1']=='451'){
      $selected_3="checked";
    }if($_GET['auction_price_1']=='551'){
      $selected_4="checked";
    }if($_GET['auction_price_1']=='651'){
      $selected_5="checked";
    }if(empty($_GET['auction_price_1'])){
      $default="checked";
    }
  }
  
  $html.='<form method="Get" action="" name="auction_filter" class="vi_auction_filter">
      <div class="inner_first">
        <!-- <div class="form-group">
            <label for="type"></label>
        </div> -->
        <h3 class="widget-title filter_accordian active">Type of Mats <span> </span></h3>
        <div class="filters_wrapper" style="display: block;">
        <div class="form-group">
            <input type="checkbox" name="spruce_access_1" class="spruce_access"  id="spruce_access" value="Spruce Access" '.$spruce_access.'/>
            <label for="spruce_access">Spruce Access</label> 
        </div>
        <div class="form-group">
            <input type="checkbox" name="fire_access" class="fir_access"  id="fir_access" value="Fir Access" '.$fir_access.'/>
            <label for="fir_access">Fir Access</label> 
        </div>
        <div class="form-group">
            <input type="checkbox" name="hybrid_access_1" class="hybrid_access"  id="hybrid_access" value="Hybrid Access" '.$hybrid_access.'/>
            <label for="hybrid_access">Hybrid Access</label> 
        </div>
        <div class="form-group">
            <input type="checkbox" name="oak_access_1" class="oak_access"  id="oak_access" value="Oak Access" '.$oak_access.'/>
            <label for="oak_access">Oak Access</label> 
        </div>
        <div class="form-group">
            <input type="checkbox" name="Rig_Mats_1" class="Rig_Mats_1"  id="Rig_Mats_1" value="Rig Mats (8x20)" '.$Rig_Mats_1.'/>
            <label for="Rig_Mats_1">Rig Mats (8x20)</label> 
        </div>
        <div class="form-group">
            <input type="checkbox" name="Rig_Mats_2" class="Rig_Mats_2"  id="Rig_Mats_2" value="Rig Mats (8x40)" '.$Rig_Mats_2.'/>
            <label for="Rig_Mats_2">Rig Mats (8x40)</label> 
        </div>
        <div class="form-group">
            <input type="checkbox" name="crane_mats_1" class="crane_mats_1"  id="crane_mats_1" value="Crane Mats (4x20)" '.$crane_mats_1.'/>
            <label for="crane_mats_1">Crane Mats (4x20)</label> 
        </div>
        <div class="form-group">
            <input type="checkbox" name="other_1" class="other"  id="other" value="Other" '.$other.'/>
            <label for="other">Other</label>
        </div>
        </div>
      </div>
      <div class="inner_first">
        <!-- <div class="form-group">
            <label for="grade"></label>
        </div> -->
        <h3 class="widget-title filter_accordian">Grade of Mat <span> </span></h3>
        <div class="filters_wrapper" style="display: none;">
         <div class="form-group">
            <input type="checkbox" name="new" class="new"  id="new" value="New" '.$new.'/>
            <label for="new">New</label> 
        </div>
         <div class="form-group">
            <input type="checkbox" name="grade_a_1" class="grade_a"  id="grade_a" value="Grade A"'.$grade_a.'/>
            <label for="grade_a">Grade A</label> 
        </div> 
        <div class="form-group">
            <input type="checkbox" name="grade_b_1" class="grade_b"  id="grade_b" value="Grade B"'.$grade_b.'/>
            <label for="grade_b">Grade B</label> 
        </div>
        <div class="form-group">
            <input type="checkbox" name="grade_c_1" class="grade_c"  id="grade_c" value="Grade C"'.$grade_c.'/>
            <label for="grade_c">Grade C</label> 
        </div>
        <div class="form-group">
            <input type="checkbox" name="grade_d_1" class="grade_d"  id="grade_d" value="Grade D"'.$grade_d.'/>
            <label for="grade_d">Grade D</label> 
        </div>
        <div class="form-group">
            <input type="checkbox" name="grades_mix_1" class="grades_mix"  id="grades_mix" value="Different Grades in Mix"'.$grades_mix.'/>
            <label for="grades_mix">Grades in Mix</label> 
        </div> 
        </div>
      </div>
      <div class="inner_first">
        <!-- <div class="form-group">
            <label for="auction_price"></label>
        </div> -->
        <h3 class="widget-title filter_accordian">Price: <span> </span></h3>
        <div class="filters_wrapper" style="display: none;">
        <div class="form-group">
            <input type="radio" name="auction_price_1" class="auction_price_1"  id="auction_price_1" value="" '.$default.'/>
            <label for="auction_price_1">All Prices</label>
        </div>
        <div class="form-group">
            <input type="radio" name="auction_price_1" class="auction_price_1"  id="auction_price_1" value="100" '.$selected.'/>
            <label for="auction_price_1">$100-$250</label>
        </div>
        <div class="form-group">
            <input type="radio" name="auction_price_1" class="auction_price_2"  id="auction_price_2" value="251" '.$selected_1.'/>
            <label for="auction_price_2">$251-$350</label>
        </div>
        <div class="form-group">
            <input type="radio" name="auction_price_1" class="auction_price_3"  id="auction_price_3" value="351" '.$selected_2.'/>
            <label for="auction_price_3">$351-$450</label>
        </div>
        <div class="form-group">
            <input type="radio" name="auction_price_1" class="auction_price_4"  id="auction_price_4" value="451" '.$selected_3.'/>
            <label for="auction_price_4">$451-$550</label>
        </div>
        <div class="form-group">
            <input type="radio" name="auction_price_1" class="auction_price_5"  id="auction_price_5" value="551" '.$selected_4.'/>
            <label for="auction_price_5">$551-$650</label> 
        </div>
        <div class="form-group">
            <input type="radio" name="auction_price_1" class="auction_price_6"  id="auction_price_6" value="651" '.$selected_5.'/>
            <label for="auction_price_6">$651+</label>
        </div>
        </div>
      </div>
      <div class="form-group submit_btn">
          <input type="submit" name="submit" class="submit" value="Submit"/>
      </div>
  </form>';
  return  $html;

}
add_filter( 'pre_get_posts', 'ls_filter_archive');
function ls_filter_archive( $query ) {
    global $wp_query;
    global $post;
    if ( is_admin() ) {
        return;
    }
    if ($query->is_main_query() && is_shop() || is_search()){
        $spruce_access=isset($_GET['spruce_access_1']) ? $_GET['spruce_access_1'] : '';
        $fir_access=isset($_GET['fire_access']) ? $_GET['fire_access'] : '';
        $hybrid_access=isset($_GET['hybrid_access_1']) ? $_GET['hybrid_access_1'] : '';
        $oak_access=isset($_GET['oak_access_1']) ? $_GET['oak_access_1'] : '';
        $Rig_Mats_1=isset($_GET['Rig_Mats_1']) ? $_GET['Rig_Mats_1'] : '';
        $Rig_Mats_2=isset($_GET['Rig_Mats_2']) ? $_GET['Rig_Mats_2'] : '';
        $crane_mats_1=isset($_GET['crane_mats_1']) ? $_GET['crane_mats_1'] : '';
        $other=isset($_GET['other_1']) ? $_GET['other_1'] : '';
        $new=isset($_GET['new']) ? $_GET['new'] : '';
        $grade_a=isset($_GET['grade_a_1']) ? $_GET['grade_a_1'] : '';
        $grade_b=isset($_GET['grade_b_1']) ? $_GET['grade_b_1'] : '';
        $grade_c=isset($_GET['grade_c_1']) ? $_GET['grade_c_1'] : '';
        $grade_d=isset($_GET['grade_d_1']) ? $_GET['grade_d_1'] : '';
        $grades_mix=isset($_GET['grades_mix_1']) ? $_GET['grades_mix_1'] : '';
        $auction_price_1=isset($_GET['auction_price_1']) ? $_GET['auction_price_1'] : '';
        if($auction_price_1=='100'){ 
          $end_price=250;
        }if($auction_price_1=='251'){ 
          $end_price=350;
        }if($auction_price_1=='351'){
          $end_price=450;
        }if($auction_price_1=='451'){
          $end_price=550;
        }if($auction_price_1=='551'){
          $end_price=650;
        }if($auction_price_1=='651'){
          $auction_price_1="651";
        }if(empty($auction_price_1)){
          $end_price="";
        }
        if(!empty($spruce_access) || !empty($fir_access) || !empty($hybrid_access) || !empty($oak_access) || !empty($Rig_Mats_1) || !empty($Rig_Mats_2) || !empty($crane_mats_1) || !empty($other) || !empty($new) || !empty($grade_a) || !empty($grade_b) || !empty($grade_c) || !empty($grade_d) || !empty($grades_mix) || !empty($auction_price_1)){
          //die('befor em');
          //echo $spruce_access;
          //die('befor empty');
          $price_array=array();
            if(is_shop() || is_search()){
              $post_type= get_query_var('post_type'); 
              //print_r($post_type);
              //die('fff');
               $query->set( 'post_type', $post_type);
              if(!empty($end_price)){
                $price_array=array('key' => '_auction_start_price', 'value'   => array($auction_price_1, $end_price ), 'type'    => 'numeric', 'compare' => 'BETWEEN'); 
              }else{
                $price_array=array('key' => '_auction_start_price', 'value'   => $auction_price_1 , 'type'    => 'numeric', 'compare' => '>='); 
              }
            }

          $meta_query =array();
          $types=array('relation' => 'OR');
          if(!empty($spruce_access)){
              $types[]=array('key' => 'au_mat_type', 'value' => $spruce_access,'compare' => '=');
          }if(!empty($fir_access)){
              $types[]=array('key' => 'au_mat_type', 'value' => $fir_access,'compare' => '=');
          }if(!empty($hybrid_access)){
              $types[]=array('key' => 'au_mat_type', 'value' => $hybrid_access,'compare' => '=');
          }if(!empty($oak_access)){
              $types[]=array('key' => 'au_mat_type', 'value' => $oak_access,'compare' => '=');
          }if(!empty($Rig_Mats_1)){
               $types[]=array('key' => 'au_mat_type', 'value' => $Rig_Mats_1,'compare' => '=');
          }if(!empty($Rig_Mats_2)){
              $types[]=array('key' => 'au_mat_type', 'value' => $Rig_Mats_2,'compare' => '=');
          }if(!empty($crane_mats_1)){
              $types[]=array('key' => 'au_mat_type', 'value' => $crane_mats_1,'compare' => '=');
          }if(!empty($other)){
              $types[]=array('key' => 'au_mat_type', 'value' => $other ,'compare' => '=');
          }
          /*Grades*/
          $gardes=array('relation' => 'OR');
          if(!empty($new)){
              $gardes[]=array('key' => 'au_mat_grade', 'value' => $new,'compare' => '=');
          }if(!empty($grade_b)){
              $gardes[]=array('key' => 'au_mat_grade', 'value' => $grade_b,'compare' => '=');
          }if(!empty($grade_c)){
              $gardes[]=array('key' => 'au_mat_grade', 'value' => $grade_c,'compare' => '=');
          }if(!empty($grade_d)){
              $gardes[]=array('key' => 'au_mat_grade', 'value' => $grade_d,'compare' => '=');
          }if(!empty($grades_mix)){
              $gardes[]=array('key' => 'au_mat_grade', 'value' => $grades_mix,'compare' => '=');
          }
          $auction_dates_current = date("Y-m-d h:i");
          //$currentdate = array('relation' => 'OR');
          $currentdate[]=array('key' => '_auction_dates_to', 'value' => $auction_dates_current,'compare' => '>=');
          $meta_query = array(
              'relation' => 'AND', 
              $types,
              $gardes,
              $price_array, 
              $currentdate,  
          );
          $query->set( 'meta_query', $meta_query );
          //echo'<pre>';print_r($meta_query);
          //die('fff');
      }  
      return $query;
    }
}



add_shortcode('searchads', 'ls_ads_filters');
function ls_ads_filters(){
  $html='';
  $spruce_access=isset($_POST['spruce_access_1']) ? "checked" : '';
  $fir_access=isset($_POST['fire_access']) ? "checked" : '';
  $hybrid_access=isset($_POST['hybrid_access_1']) ? "checked" : '';
  $oak_access=isset($_POST['oak_access_1']) ? "checked" : '';
  $Rig_Mats_1=isset($_POST['Rig_Mats_1']) ? "checked" : '';
  $Rig_Mats_2=isset($_POST['Rig_Mats_2']) ? "checked" : '';
  $crane_mats_1=isset($_POST['crane_mats_1']) ? "checked" : '';
  $new=isset($_POST['new']) ? "checked" : '';
  $grade_a=isset($_POST['grade_a_1']) ? "checked" : '';
  $grade_b=isset($_POST['grade_b_1']) ? "checked" : '';
  $grade_c=isset($_POST['grade_c_1']) ? "checked" : '';
  $grade_d=isset($_POST['grade_d_1']) ? "checked" : '';
  $grades_mix=isset($_POST['grades_mix_1']) ? "checked" : '';
  $other=isset($_POST['other_1']) ? "checked" : '';
  $auction_price_1=isset($_POST['auction_price_1']) ? $_POST['auction_price_1'] : '';
  $default='checked';$selected='';  $selected_1='';  $selected_2=''; $selected_3=''; $selected_4=''; $selected_5='';
  if($_POST){
    if($auction_price_1=='100'){ 
      $selected="checked";
    }if($auction_price_1=='251'){ 
      $selected_1="checked";
    }if($auction_price_1=='351'){
      $selected_2="checked";
    }if($auction_price_1=='451'){
      $selected_3="checked";
    }if($auction_price_1=='551'){
      $selected_4="checked";
    }if($auction_price_1=='651'){
      $selected_5="checked";
    }if(empty($auction_price_1)){
      $default="checked";
    }
  }
  
  $html.='<form method="post" name="auction_filter" class="vi_auction_filter">
      <div class="inner_first">
       <!--  <div class="form-group mb-0">
        </div>
        <label for="type"></label> -->
        <h3 class="widget-title filter_accordian active"> Type of Mats <span></span></h3>
        <div class="filters_wrapper" style="display: block;">
        <div class="form-group">
            <input type="checkbox" name="spruce_access_1" class="spruce_access"  id="spruce_access" value="Spruce Access" '.$spruce_access.'/>
            <label for="spruce_access">Spruce Access</label> 
        </div>
        <div class="form-group">
            <input type="checkbox" name="fire_access" class="fir_access"  id="fir_access" value="Fir Access" '.$fir_access.'/>
            <label for="fir_access">Fir Access</label> 
        </div>
        <div class="form-group">
            <input type="checkbox" name="hybrid_access_1" class="hybrid_access"  id="hybrid_access" value="Hybrid Access" '.$hybrid_access.'/>
            <label for="hybrid_access">Hybrid Access</label> 
        </div>
        <div class="form-group">
            <input type="checkbox" name="oak_access_1" class="oak_access"  id="oak_access" value="Oak Access" '.$oak_access.'/>
            <label for="oak_access">Oak Access</label> 
        </div>
        <div class="form-group">
            <input type="checkbox" name="Rig_Mats_1" class="Rig_Mats_1"  id="Rig_Mats_1" value="Rig Mats (8x20)" '.$Rig_Mats_1.'/>
            <label for="Rig_Mats_1">Rig Mats (8x20)</label> 
        </div>
        <div class="form-group">
            <input type="checkbox" name="Rig_Mats_2" class="Rig_Mats_2"  id="Rig_Mats_2" value="Rig Mats (8x40)" '.$Rig_Mats_2.'/>
            <label for="Rig_Mats_2">Rig Mats (8x40)</label> 
        </div>
        <div class="form-group">
            <input type="checkbox" name="crane_mats_1" class="crane_mats_1"  id="crane_mats_1" value="Crane Mats (4x20)" '.$crane_mats_1.'/>
            <label for="crane_mats_1">Crane Mats (4x20)</label> 
        </div>
        <div class="form-group">
            <input type="checkbox" name="other_1" class="other"  id="other" value="Other" '.$other.'/>
            <label for="other">Other</label>
        </div>
        </div>
      </div>
      <div class="inner_first">
        <!-- <div class="form-group">
            <label for="grade"></label>
        </div> -->
        <h3 class="widget-title filter_accordian">Grade of Mat <span></span></h3>
        <div class="filters_wrapper" style="display: none;">
         <div class="form-group">
            <input type="checkbox" name="new" class="new"  id="new" value="New" '.$new.'/>
            <label for="new">New</label> 
        </div>
         <div class="form-group">
            <input type="checkbox" name="grade_a_1" class="grade_a"  id="grade_a" value="Grade A"'.$grade_a.'/>
            <label for="grade_a">Grade A</label> 
        </div> 
        <div class="form-group">
            <input type="checkbox" name="grade_b_1" class="grade_b"  id="grade_b" value="Grade B"'.$grade_b.'/>
            <label for="grade_b">Grade B</label> 
        </div>
        <div class="form-group">
            <input type="checkbox" name="grade_c_1" class="grade_c"  id="grade_c" value="Grade C"'.$grade_c.'/>
            <label for="grade_c">Grade C</label> 
        </div>
        <div class="form-group">
            <input type="checkbox" name="grade_d_1" class="grade_d"  id="grade_d" value="Grade D"'.$grade_d.'/>
            <label for="grade_d">Grade D</label> 
        </div>
        <div class="form-group">
            <input type="checkbox" name="grades_mix_1" class="grades_mix"  id="grades_mix" value="Different Grades in Mix"'.$grades_mix.'/>
            <label for="grades_mix">Grades in Mix</label> 
        </div>
        </div> 
      </div>
      <div class="inner_first">
        <!-- <div class="form-group">
            <label for="auction_price"></label>
        </div> -->
        <h3 class="widget-title filter_accordian">Price <span></span></h3>
        <div class="filters_wrapper" style="display: none;">
        <div class="form-group">
            <input type="radio" name="auction_price_1" class="auction_price_1"  id="auction_price_1" value="" '.$default.'/>
            <label for="auction_price_1">All Prices</label>
        </div>
        <div class="form-group">
            <input type="radio" name="auction_price_1" class="auction_price_1"  id="auction_price_1" value="100" '.$selected.'/>
            <label for="auction_price_1">$100-$250</label>
        </div>
        <div class="form-group">
            <input type="radio" name="auction_price_1" class="auction_price_2"  id="auction_price_2" value="251" '.$selected_1.'/>
            <label for="auction_price_2">$251-$350</label>
        </div>
        <div class="form-group">
            <input type="radio" name="auction_price_1" class="auction_price_3"  id="auction_price_3" value="351" '.$selected_2.'/>
            <label for="auction_price_3">$351-$450</label>
        </div>
        <div class="form-group">
            <input type="radio" name="auction_price_1" class="auction_price_4"  id="auction_price_4" value="451" '.$selected_3.'/>
            <label for="auction_price_4">$451-$550</label>
        </div>
        <div class="form-group">
            <input type="radio" name="auction_price_1" class="auction_price_5"  id="auction_price_5" value="551" '.$selected_4.'/>
            <label for="auction_price_5">$551-$650</label> 
        </div>
        <div class="form-group">
            <input type="radio" name="auction_price_1" class="auction_price_6"  id="auction_price_6" value="651" '.$selected_5.'/>
            <label for="auction_price_6">$651+</label>
        </div>
      </div>
      </div>
      <div class="form-group submit_btn">
          <input type="submit" name="submit" class="submit" value="Submit"/>
      </div>
  </form>';

  return  $html;

}

function save_extra_register_fields( $user_id ) {
  $fname=$_POST['account_first_name'];
	$lname=$_POST['account_last_name'];
	$Phoneno=$_POST['company_name'];
  if ( isset( $_POST['account_first_name'] ) ) {
        update_user_meta( $user_id, 'first_name', sanitize_text_field( $_POST['account_first_name'] ) );
  }
  if ( isset( $_POST['account_last_name'] ) ) {
        update_user_meta( $user_id, 'last_name', sanitize_text_field( $_POST['account_last_name'] ) );
  }
  if ( isset( $_POST['company_name'] ) ) {
        update_user_meta( $user_id, 'company_name', sanitize_text_field( $_POST['company_name'] ) );
  }    
}
add_action( 'user_register', 'save_extra_register_fields' );

function validate_extra_register_fields( $username, $email, $errors )
{		
$first_name= $_POST['account_first_name'];
$last_name= $_POST['account_last_name'];
$company_name=$_POST['company_name'];
if ( empty($first_name) ) {
$errors->add('account_first_name', __('First name is required', 'woocommerce'));
}
if (empty($last_name) ) {
$errors->add('last_name_error', __('Last name is required', 'woocommerce'));
}
if (empty($company_name)) {
$errors->add('company_name_error', __('Company name is required', 'woocommerce'));
}
else{

}
return $errors;
}
add_action('woocommerce_register_post', 'validate_extra_register_fields', 10, 3);

add_action( 'woocommerce_save_account_details', 'save_custom_fields_edit_account_form' );
function save_custom_fields_edit_account_form( $user_id ) {
  $company_name=$_POST['company_name'];
	//global $current_user;
	//$saved_doctype = $current_user->billing_document;
	if ( isset( $_POST['company_name'] ) ) {
        update_user_meta( $user_id, 'company_name', sanitize_text_field( $_POST['company_name'] ) );
  }
}

add_action( 'woocommerce_save_account_details_errors','validate_edit_account_custom_field', 10, 1 );
function validate_edit_account_custom_field( $args )
{
  if ( empty( $_POST['company_name'] ) ) {
    $args->add( 'error', __( 'Company name is required', 'woocommerce' ),'');
  }
}

add_filter('woocommerce_save_account_details_required_fields', 'ts_hide_last_name');
function ts_hide_last_name($required_fields)
{
  unset($required_fields["account_display_name"]);
  return $required_fields;
}
/* create custom redux option settings*/
add_filter("redux/options/redux_demo/sections", 'add_social_media_options');
function add_social_media_options($sections) {
  $sections[] = array(
    'icon' => 'el-icon-wrench',
    'title' => esc_html__('Default Image Settings', 'textdomain'),
    'desc' => esc_html__('Enter default image settings', 'textdomain'),
    'fields' => array(
        array(
            'id' => 'ibid_custom_image',
            'type' => 'text',
            'title' => __('Post Default Image', 'ibid'),
            'subtitle' => __('Enter Link for default image', 'ibid'),
            'default' => ''
        ),
    )
  );
  return $sections;
}

// add_filter ( 'auth_cookie_expiration', 'wpdev_login_session' );
 
// function wpdev_login_session( $expire ) { // Set login session limit in seconds
//     return YEAR_IN_SECONDS;
//     // return MONTH_IN_SECONDS;
//     // return DAY_IN_SECONDS;
//     // return HOUR_IN_SECONDS;
// }

// add_action('template_redirect', 'redirect_single_post');
// function redirect_single_post() {
//   if (is_search()) {
//     global $wp_query;
//     $shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
//     if ($wp_query->post_count == 1) {
//       wp_redirect( get_permalink( wc_get_page_id( 'shop' ) ));
//       exit;
//     }
//   }
// }

function shapeSpace_recent_posts_shortcode($atts, $content = null) {
  
  global $post, $woocommerce;
  //global  $woocommerce;
  $currency_symbol = get_woocommerce_currency_symbol();
  extract(shortcode_atts(array(
    'cat'     => '',
    'num'     => '5',
    'order'   => 'DESC',
    'orderby' => 'post_date',
  ), $atts));
  
  $args = array(
    'cat'            => $cat,
    'posts_per_page' => $num,
    'order'          => $order,
    'orderby'        => $orderby,
  );
  
  $output = '';
  
  $posts = get_posts($args);
  $output .= '<div class="row custom-post-shortcode">';
  foreach($posts as $post) { 
    setup_postdata($post);
    $output .= '<div class="col-md-3 post custom-post-shortcode-wrapper">';
    $output .= '<div class="custom-blog-thumbnail"><a href="'. get_the_permalink() .'">'. get_the_post_thumbnail() .'</a></div>'; 
    $output .= '<div class="post-shortcode-details">';
    $output .= '<div class="custom-post-shortcode-a"><a href="'. get_the_permalink() .'">'. get_the_title() .'</a></div>
    <div class="vision shortcode_post_date"><i class="icon-calendar"></i>'. get_the_date() .'</div>';
    $output .= '<p class="post-shortcode-excerpt">'. get_the_excerpt().'</p>';
    $output .= '<div class="shortcode-view-ad"><span class="shortcode_ad_price">'.$currency_symbol .get_post_meta(get_the_ID(), 'asking_price_ad', true).'</span><a class="custom-post-shortcode-readmore" href="'.get_the_permalink().'" class="more-link">VIEW AD</a></div>';
    $output .= '</div>';
    $output .= '</div>';
  }
  $output .= '</div>';
  wp_reset_postdata();
  
  return $output;
  
}
add_shortcode('recent_posts', 'shapeSpace_recent_posts_shortcode');

function remove_image_zoom_support() {
    remove_theme_support( 'wc-product-gallery-zoom' );
}
add_action( 'after_setup_theme', 'remove_image_zoom_support', 100 );

add_action( 'woocommerce_single_product_summary', 'custom_action_after_single_product_title', 6 );
function custom_action_after_single_product_title() {
  $mattype = get_post_meta(get_the_ID(),'au_mat_type',true);
  $matgrade = get_post_meta(get_the_ID(),'au_mat_grade',true);
  $matprice = get_post_meta(get_the_ID(),'au_asking_price_ad',true);
  $matlocation = get_post_meta(get_the_ID(),'au_location',true);
  $matincrement = get_post_meta(get_the_ID(),'_auction_bid_increment',true);
  $amount_available = get_post_meta(get_the_ID(),'adau_amount_available',true);
  if ($mattype == "Other") {
      $custommattype = get_post_meta(get_the_ID(),'au_custom_mat_type',true);
  }
  ?>
  <div class="product-extra-details">
    <?php if ($mattype) { ?>
        <div> Mat Type: <?php echo $mattype; 
          if ($mattype == "Other") {
              echo " (".$custommattype.")"; 
          }
          ?>
        </div>
    <?php } ?>
    <?php if ($matgrade) { ?>
        <div> Mat Grade: <?php echo $matgrade; ?></div>
    <?php } ?>
    <?php if ($matprice) { ?>
        <div> Mat Price(per mat): $ <?php echo $matprice; ?></div>
    <?php } ?>
     <?php if ($matincrement) { ?>
        <div> Location: <?php echo $matincrement; ?></div>
    <?php } ?>
    <?php if ($matlocation) { ?>
        <div> Location: <?php echo $matlocation; ?></div>
    <?php } ?>
    <?php if ($amount_available) { ?>
        <div> Amont available: <?php echo $amount_available; ?></div>
    <?php } ?>
  </div>
  <?php 
}

function set_email_html_content_type() {
    return 'text/html';
}
add_filter('password_change_email', 'change_password_mail_message', 10, 3);
function change_password_mail_message( $change_mail, $user, $userdata ) {
    // Call Change Email to HTML function
    add_filter( 'wp_mail_content_type', 'set_email_html_content_type' );
    $message = '<div dir="ltr" style="background-color: rgba(247, 247, 247, 1); margin: 0; padding: 70px 0; width: 100%" ><table border="0" cellpadding="0" cellspacing="0" width="600" style="background-color: rgba(255, 255, 255, 1); border: 1px solid rgba(222, 222, 222, 1); border-radius: 3px"><tr><td ">
      <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: rgba(37, 124, 124, 1); color: rgba(255, 255, 255, 1); border-bottom: 0; font-weight: bold; line-height: 100%; vertical-align: middle; font-family: &quot;Helvetica Neue&quot;, Helvetica, Roboto, Arial, sans-serif; border-radius: 3px 3px 0 0">
                    <tbody><tr>
                      <td style="padding: 36px 48px; display: block">
                        <h1 style="font-family: &quot;Helvetica Neue&quot;, Helvetica, Roboto, Arial, sans-serif; font-size: 30px; font-weight: 300; line-height: 150%; margin: 0; text-align: left; color: rgba(255, 255, 255, 1); background-color: inherit">Password Changed Successfully</h1>
                      </td>
                    </tr>
                  </tbody></table>
    </td></tr>
    <tr><td valign="top" style="padding: 48px 48px 32px">
    <div style="color: rgba(99, 99, 99, 1) !important; font-family: &quot;Helvetica Neue&quot;, Helvetica, Roboto, Arial, sans-serif; font-size: 14px; line-height: 150%; text-align: left">
      <p style="margin: 0 0 16px">Hi ###USERNAME###</p>

<p style="margin: 0 0 16px">This notice confirms that your password was changed on ###SITENAME###.</p>

<p style="margin: 0 0 16px">If you did not change your password, please contact the Site Administrator at
###ADMIN_EMAIL###</p>

<p style="margin: 0 0 16px">This email has been sent to ###EMAIL###</p>

<p style="margin: 0 0 16px">Regards,
All at ###SITENAME###
###SITEURL###</p>
    </div></td></tr>
    </table></div>';

    $change_mail[ 'message' ] = $message;
    //$change_mail[ 'subject' ] = 'My new email subject';

    return $change_mail;
}
function getGeoCode($address)
{
  if (!empty($address)) {
    $url = "https://maps.googleapis.com/maps/api/geocode/json?address=$address&key=AIzaSyAzXDEebJV9MxtPAPhP1B2w5T3AYK2JOu0";
    // send api request
    $geocode = file_get_contents($url);
    $json = json_decode($geocode);
    $data['lat'] = $json->results[0]->geometry->location->lat;
    $data['lng'] = $json->results[0]->geometry->location->lng;
    return $data;
  }
}

add_filter('wp_mail_content_type', function( $content_type ) {
  return 'text/html';
});


add_action("wp_ajax_load_city_ajax", "load_city_ajax");
add_action("wp_ajax_nopriv_load_city_ajax", "load_city_ajax"); 

function load_city_ajax(){
  global $wpdb;
  $selected_province = $_POST['selected_province'];
  $cur_postid = $_POST['cur_postid'];
  $saved_city_name = get_post_meta($cur_postid, 'ad_city', true);
  //echo "Saved City:". $saved_city_name;
  $cities = $wpdb->get_results( "SELECT city FROM canadacities WHERE province_name = '$selected_province'  ORDER BY city ASC");
  foreach ($cities as $city_name) {
    if ($city_name->city == $saved_city_name) {
      $city_html .= '<option value="'.$city_name->city.'" selected="true">'.ucwords(strtolower($city_name->city)).'</option>';
    }else{
      $city_html .= '<option value="'.$city_name->city.'">'.ucwords(strtolower($city_name->city)).'</option>';
    }
  }
  $results['status']='success';
  $results['city_html']=$city_html;

  echo json_encode($results);
  die(0);
  //echo $city_html;die('gghg');
}

