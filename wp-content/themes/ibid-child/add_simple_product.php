<?php
/*
Template Name: Add Simple Product
*/

if(isset($_POST["submit"]))
{

  global $wpdb;
  $post_data = array(
    'post_title' => $_POST['proname'],
    'post_content'=> $_POST['prodesc'],
    'post_type' => 'product',
    'post_status' => 'publish'
  );
  $post_id = wp_insert_post( $post_data );
  update_post_meta($post_id,'_regular_price',$_POST['proprice']);
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
   
}
?>
<?php get_header(); ?>
  <div id="primary" class="content-area">
    <main id="main" class="site-main">
      <form method="post" enctype="multipart/form-data">
        <div><h4>Product Data</h4></div>
        <div>
          <div><label>Product Name</label></div>
          <div><input type="text" name="proname" class="proname"/></div>
        </div>
        <div>
          <div><label>Product Description</label></div>
          <div><textarea name="prodesc" class="prodesc"></textarea></div>
        </div>
        <div>
          <div><label>Product Price</label></div>
          <div><input type="text" name="proprice" class="proprice"/></div>
        </div>
        <div class="form-group">
        <label><?php _e('Select Image a:', 'Your text domain here');?></label>
            <input type="file" name="image">
        </div>
          
        <div>
          <input type="submit" name="submit" value="Submit" class="submit" onclick="prodsubmit();"/>
        </div>
      </form>
    </main>
  </div>
  <?php 

get_footer(); ?>