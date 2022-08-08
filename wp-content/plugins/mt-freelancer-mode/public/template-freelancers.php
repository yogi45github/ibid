<?php
/*
* Template Name: Freelancers List
*/
get_header(); 
?>


<!-- Page content -->
<?php
if (isset($_GET['username']) && !empty($_GET['username'])) {
    $user = get_user_by( 'slug', $_GET['username'] );
    if($user) {
      $user_id  = $user->ID;
      $listings_loop_argument = array('post_type' => 'product','meta_query' => array(array('key' => '_auction_current_bider','value' => $user_id,)), 'posts_per_page' => -1,'show_past_auctions'    =>  TRUE, 'auction_arhive' => TRUE);
      $listings_loop = new WP_Query( $listings_loop_argument ); ?>

      <?php echo do_action('mtfm_breadcrumb'); ?>

      <div class="high-padding">
          <!-- Blog content -->
          <div class="container blog-posts">
            <div class="col-md-12 main-user-content"> 
              <div class="user-profile-avatar">
                <?php echo get_avatar( $user->ID, 150); ?>
                <ul class="social-info">
                  <?php if ($user->user_url) { ?>
                    <li><a href="<?php echo esc_attr($user->user_url); ?>"><i class="fa fa-globe"></i></a></li>
                  <?php } ?>

                  <?php if ($user->fb_link) { ?>
                    <li><a href="<?php echo esc_attr($user->fb_link); ?>"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>
                  <?php } ?>

                  <?php if ($user->tw_link) { ?>
                    <li><a href="<?php echo esc_attr($user->tw_link); ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                  <?php } ?>

                  <?php if ($user->user_email) { ?>
                    <li><a href="mailto:<?php echo esc_attr($user->user_email); ?>"><i class="fa fa-envelope" aria-hidden="true"></i></a></li>
                  <?php } ?>
                </ul>
              </div>
              <div class="user-profile-info">  
                <h2><?php echo esc_attr($user->first_name); ?> <?php echo esc_attr($user->last_name); ?></h2>
                <p class="job_position"><?php echo esc_attr($user->job_position); ?></p>

                <?php if ($user->job_experience) { ?>
                  <span class="info-pos"><i class="fa fa-user"></i><?php echo esc_attr($user->job_experience); ?><?php echo esc_html__(' experience','mt-freelancer-mode')?></span>
                <?php } ?>

                <?php if ($user->fee_hour) { ?>
                  <span class="info-pos"><i class="fa fa-money"></i><?php echo esc_attr($user->fee_hour); ?></span>
                <?php } ?>

                <?php if ($listings_loop->post_count > 0) { ?>
                  <span class="info-pos"><i class="fa fa-briefcase"></i><?php _e('Jobs Completed:','mt-freelancer-mode') ?><?php echo esc_attr($listings_loop->post_count); ?> </span>
                <?php } ?>

                <?php if ($user->location) { ?>
                  <span class="info-pos"><i class="fa fa-globe"></i><?php echo esc_attr($user->location); ?></span>
                <?php } ?>

                <?php if ($user->skills) { ?>
                  <p class="job_skills"><strong><?php echo esc_html__('Job Skills: ','mt-freelancer-mode')?></strong><?php echo esc_attr($user->skills); ?></p>
                <?php } ?>

                <p class="about_me"><?php echo wp_trim_words( $user->description, 144); ?></p>
              </div>
            </div>

            <div class="col-md-12 work-dashboard">
            <?php 
            global $woocommerce, $wpdb;
            $user_id  = $user->ID;
            $postids = get_user_meta($user_id, 'wsa_my_auctions', false);
            ?>
                      
            <h2><?php _e( 'Work History', 'mt-freelancer-mode' ); ?>(<?php echo esc_html($listings_loop->post_count); ?>)</h2>      
            <?php
            $auction_closed_type[] = '2';

            $args = array(
              'post_type'         => 'product',
              'posts_per_page'    => '-1',
              'order'     => 'ASC',
              'orderby'   => 'meta_value',
              'meta_key'  => '_auction_dates_to',
              'meta_query' => array(
                array(
                  'key' => '_auction_closed',
                  'value' => $auction_closed_type,
                  'compare' => 'IN' 
                ),
                array(
                  'key' => '_auction_current_bider',
                  'value' => $user_id,
                )
              ),
              'show_past_auctions'    =>  TRUE,
              'auction_arhive' => TRUE,     
            );
                                  
            $winningloop = new WP_Query( $args );
                      
            if ( $winningloop->have_posts() && !empty($postids) ) {
              woocommerce_product_loop_start();
              while ( $winningloop->have_posts()): $winningloop->the_post() ;
                wc_get_template_part( 'content', 'project' );
              endwhile;
              woocommerce_product_loop_end(); 
            } else { ?>
              <p><?php _e( 'No work history yet', 'mt-freelancer-mode' ); ?></p>
            <?php }           
            wp_reset_postdata(); ?>                     
        </div>        
      </div>
    </div>
  <?php } else { ?>
    <div class="high-padding">
      <div class="container blog-posts">
        <div class="col-md-12"> 
          <?php get_template_part( 'content', 'none' ); ?>
        </div>
      </div>
    </div>
  <?php } ?>

<?php }else{ ?>
<?php
  $admin_user = get_user_by( 'id', $user_ID );
  $args = array(
    'role' => 'customer'
  );
  $users = get_users($args);
?>  

<?php echo do_action('mtfm_breadcrumb'); ?>

<!-- Page content -->
  <div class="high-padding">
    <!-- Blog content -->
    <div class="container blog-posts">
      <div class="row">
        <div class="col-md-12 main-content row">  
        <?php /* Start the Loop */ ?>
        <?php foreach ( $users as $key => $user )  :?>
          <?php $profile_url = get_the_permalink().'?username='.$user->user_nicename; ?>
            <?php if ($user->first_name or $user->last_name) { ?>
              <div class=" single-freelancer list-view col-md-6">
                <div class="freelancer-wrapper">

                  <div class="user-information">
                    <div class="user-profile-avatar"><a href="<?php echo esc_url($profile_url); ?>">
                      <?php echo get_avatar( $user->ID, 196); ?>
                    </a></div>
                    <h3 class="user-profile-title">
                      <a href="<?php echo esc_url($profile_url); ?>"><?php echo esc_attr($user->first_name); ?> <?php echo esc_attr($user->last_name); ?></a>
                    </h3>
                    <p class="job_position"><?php echo esc_attr($user->job_position); ?></p>

                    <?php if ($user->job_experience) { ?>
                      <span class="info-pos"><i class="fa fa-user"></i><?php echo esc_attr($user->job_experience); ?><?php echo esc_html__(' experience','mt-freelancer-mode')?></span>
                    <?php } ?>

                    <?php if ($user->fee_hour) { ?>
                      <span class="info-pos"><i class="fa fa-money"></i><?php echo esc_attr($user->fee_hour); ?></span>
                    <?php } ?>

                    <p class="about_me"><?php echo wp_trim_words( $user->description, 15); ?></p>
                  </div>
                </div>
              </div>
            <?php } ?>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>

<?php }
get_footer();
?>