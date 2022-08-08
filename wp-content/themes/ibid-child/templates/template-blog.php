<?php
/*
* Template Name: Blog
*/
get_header(); 
#Redux global variable
global $ibid_redux;
$class = "col-md-12";
$sidebar = "sidebar-1";

if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
    if ( $ibid_redux['ibid_blog_layout'] == 'ibid_blog_fullwidth' ) {
        $class = "col-md-12";
    }elseif ( $ibid_redux['ibid_blog_layout'] == 'ibid_blog_right_sidebar' or $ibid_redux['ibid_blog_layout'] == 'ibid_blog_left_sidebar') {
        $class = "col-md-9";
    }
    // Check if active sidebar
    $sidebar = $ibid_redux['ibid_blog_layout_sidebar'];
}else{
    $class = "col-md-9";
}
if (!is_active_sidebar( $sidebar )) {
    $class = "col-md-12";
}
$breadcrumbs_status = 'no';
$breadcrumbs_on_off = get_post_meta( get_the_ID(), 'breadcrumbs_on_off', true );
?>
<?php if (isset($breadcrumbs_on_off) && $breadcrumbs_on_off == 'yes') { ?>

    <!-- Breadcrumbs -->
    <?php echo ibid_header_title_breadcrumbs(); ?>
    
<?php $breadcrumbs_status = 'yes'; ?>
<?php } ?>
<!-- Page content -->
  
<?php
wp_reset_postdata();
    $meta_query =array();
    $spruce_access=isset($_POST['spruce_access_1']) ? $_POST['spruce_access_1'] : '';
    $fir_access=isset($_POST['fire_access']) ? $_POST['fire_access'] : '';
    $hybrid_access=isset($_POST['hybrid_access_1']) ? $_POST['hybrid_access_1'] : '';
    $oak_access=isset($_POST['oak_access_1']) ? $_POST['oak_access_1'] : '';
    $Rig_Mats_1=isset($_POST['Rig_Mats_1']) ? $_POST['Rig_Mats_1'] : '';
    $Rig_Mats_2=isset($_POST['Rig_Mats_2']) ? $_POST['Rig_Mats_2'] : '';
    $crane_mats_1=isset($_POST['crane_mats_1']) ? $_POST['crane_mats_1'] : '';
    $new=isset($_POST['new']) ? $_POST['new'] : '';
    $grade_a=isset($_POST['grade_a_1']) ? $_POST['grade_a_1'] : '';
    $grade_b=isset($_POST['grade_b_1']) ? $_POST['grade_b_1'] : '';
    $grade_c=isset($_POST['grade_c_1']) ? $_POST['grade_c_1'] : '';
    $grade_d=isset($_POST['grade_d_1']) ? $_POST['grade_d_1'] : '';
    $grades_mix=isset($_POST['grades_mix_1']) ? $_POST['grades_mix_1'] : '';
    $other=isset($_POST['other_1']) ? $_POST['other_1'] : '';
    $auction_price_1=isset($_POST['auction_price_1']) ? $_POST['auction_price_1'] : '';
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
    $auction_price_1=651;
    }if(empty($auction_price_1)){
        $end_price="0";
    }
    if(!empty($spruce_access) || !empty($fir_access) || !empty($hybrid_access) || !empty($oak_access) || !empty($Rig_Mats_1) || !empty($Rig_Mats_2) || !empty($crane_mats_1) || !empty($other) || !empty($new) || !empty($grade_a) || !empty($grade_b) || !empty($grade_c) || !empty($grade_d) || !empty($grades_mix) || !empty($auction_price_1)){
        $price_array=array();
        if (get_query_var('pagename')=='blog'){
            if(!empty($end_price)){
            $price_array=array(
                  'key' => 'asking_price_ad',
                  'value'   => array($auction_price_1, $end_price ),
                  'type'    => 'numeric',
                  'compare' => 'BETWEEN'
                );
            }else{
              $price_array=array(
                  'key' => 'asking_price_ad',
                  'value'   => $auction_price_1 ,
                  'type'    => 'numeric',
                  'compare' => '>'
                );
            }
        }
        $meta_query =array();
        $types=array('relation' => 'OR');
        if(!empty($spruce_access)){
            $types[]=array('key' => 'mat_type', 'value' => $spruce_access,'compare' => '=');
        }if(!empty($fir_access)){
            $types[]=array('key' => 'mat_type', 'value' => $fir_access,'compare' => '=');
        }if(!empty($hybrid_access)){
            $types[]=array('key' => 'mat_type', 'value' => $hybrid_access,'compare' => '=');
        }if(!empty($oak_access)){
            $types[]=array('key' => 'mat_type', 'value' => $oak_access,'compare' => '=');
        }if(!empty($Rig_Mats_1)){
             $types[]=array('key' => 'mat_type', 'value' => $Rig_Mats_1,'compare' => '=');
        }if(!empty($Rig_Mats_2)){
            $types[]=array('key' => 'mat_type', 'value' => $Rig_Mats_2,'compare' => '=');
        }if(!empty($crane_mats_1)){
            $types[]=array('key' => 'mat_type', 'value' => $crane_mats_1,'compare' => '=');
        }if(!empty($other)){
            $types[]=array('key' => 'mat_type', 'value' => $other ,'compare' => '=');
        }
        /*Grades*/
        $gardes=array('relation' => 'OR');
        if(!empty($new)){
            $gardes[]=array('key' => 'mat_grade', 'value' => $new,'compare' => '=');
        }if(!empty($grade_a)){
            $gardes[]=array('key' => 'mat_grade', 'value' => $grade_a,'compare' => '=');
        }if(!empty($grade_b)){
            $gardes[]=array('key' => 'mat_grade', 'value' => $grade_b,'compare' => '=');
        }if(!empty($grade_c)){
            $gardes[]=array('key' => 'mat_grade', 'value' => $grade_c,'compare' => '=');
        }if(!empty($grade_d)){
            $gardes[]=array('key' => 'mat_grade', 'value' => $grade_d,'compare' => '=');
        }if(!empty($grades_mix)){
            $gardes[]=array('key' => 'mat_grade', 'value' => $grades_mix,'compare' => '=');
        }
        $meta_query = array(
            'relation' => 'AND', 
            $types,
            $gardes,
            $price_array,   
        );
       /* echo "<pre>";print_r($meta_query);
        die();*/
    } 
    $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
    $args = array(
        'post_type'        => 'post',
        'post_status'      => 'publish',
        'paged'            => $paged,
        'meta_query'       => $meta_query
    );
    $posts = new WP_Query( $args );
    $postdata= $posts->posts;
    //echo "<pre>";print_r($posts);
    $argsf = array(
    'post_type'=> 'post',
    'orderby'    => 'ID',
    'post_status' => 'publish',
    'order'    => 'DESC',
    'posts_per_page' => -1 // this will retrive all the post that is published 
    );
    $allPosts = new WP_Query( $argsf );
    $postsingledata= $allPosts->posts;
    if ($postsingledata) {
        foreach ($postsingledata as $single_post){
            $post_id=$single_post->ID;
            //echo $post_id."<br>";
            $post_title=$single_post->post_title;
            $post_url = get_permalink( $post_id );
            $image_url = wp_get_attachment_url( get_post_thumbnail_id($post_id) );
            //$matlocation = get_post_meta($post_id,'ad_location',true);
            $mattype = get_post_meta($post_id,'mat_type',true);
            $matgrade = get_post_meta($post_id,'mat_grade',true);
            $matprice = get_post_meta($post_id,'asking_price_ad',true);
            $ad_city = get_post_meta($post_id,'ad_city',true);
            $ad_province = get_post_meta($post_id,'ad_province',true);
            $ad_postalcode = get_post_meta($post_id,'ad_postalcode',true);
            //$address = $matlocation;
            //$address = $ad_province . $ad_postalcode;
            $address = $ad_city;
            //$address2 = $ad_province . $ad_city;
            $address = str_replace(' ', '+', $address);
            //$address2 = str_replace(' ', '+', $address2);
            //if (!empty($address) || !empty($address2)) {
                $latlong = getGeoCode($address);
                //if (empty($latlong['lat']) || empty($latlong['lng'])) {
                    //echo "postcode: ".$ad_postalcode;
                    //echo "NotFound";
                    //$latlong = getGeoCode($address2);
                    //echo "<pre>"; print_r($latlong);
                //}
                $arr2=array("ID"=>$post_id,"title"=>$post_title,"url"=>$post_url,"image_url"=>$image_url,"mattype"=>$mattype,"matgrade"=>$matgrade,"matprice"=>$matprice,"state"=>$ad_province,"city"=>$ad_city);
                $che=array_merge($latlong,$arr2);
                //$result1[] = $result;
                $result_new[] = $che;
            //}
        }
    }
    ?>
    <!-- Blog content -->
    <?php 
        $result1 = array();
        foreach ($postdata as $single_post) {
            $post_id=$single_post->ID;
            // $post_title=$single_post->post_title;
            // $post_url = get_permalink( $post_id );
            // $image_url = wp_get_attachment_url( get_post_thumbnail_id($post_id) );
            // $matlocation = get_post_meta($post_id,'ad_location',true);
            // $mattype = get_post_meta($post_id,'mat_type',true);
            // $matgrade = get_post_meta($post_id,'mat_grade',true);
            // $matprice = get_post_meta($post_id,'asking_price_ad',true);
            // $address = $matlocation;
            // $address = str_replace(' ', '+', $address);
            // if (!empty($address)) {
            //     $result = getGeoCode($address);
            // }
            // $arr2=array("ID"=>$post_id,"title"=>$post_title,"url"=>$post_url,"image_url"=>$image_url,"mattype"=>$mattype,"matgrade"=>$matgrade,"matprice"=>$matprice,"location"=>$matlocation);
            // $che=array_merge($result,$arr2);
            // $result1[] = $result;
            // $result_new[] = $che;
            //echo $image_url;
            //echo "<pre>";print_r($result_new); echo "<br>";
            //echo 'Ad: '.$post_title .'Latitude: ' . $result['lat'] . ', Longitude: ' . $result['lng'] .'<br>';
            //$coordinates_lat = array($result['lat']);
            //$coordinates_lat = array($result['lng']);
        }
    ?>
<script>
let map;

function initMapbk() {
  var passed_array = '<?php echo json_encode($result_new); ?>';
  const coordinates = JSON.parse(passed_array);
  map = new google.maps.Map(document.getElementById("map"), {
    //center: new google.maps.LatLng(62.5155409,-118.1769449),
    center: new google.maps.LatLng(57.0280421,-111.2758134,6),
    zoom: 4,
    //mapTypeId: google.maps.MapTypeId.ROADMAP
  });
  const image =
    "<?php echo home_url('/'); ?>wp-content/uploads/2021/12/locationnew.png";
  const icons = {
    parking: {
      icon: image,
    }
  };
  const features = [
    <?php foreach ($result_new as $key => $result) { ?>
        <?php if (!empty($result['lat']) && !empty($result['lng'])) { ?>
       {
          position: new google.maps.LatLng(
            <?php echo $result['lat']; ?>, 
            <?php echo $result['lng']; ?>
            ),
          type: "parking",
          lat: "<?php echo $result['lat']; ?>",
          lng: "<?php echo $result['lng']; ?>",
          title: "<?php echo $result['title']; ?>",
          url: "<?php echo $result['url']; ?>",
          image_url: "<?php echo $result['image_url']; ?>",
          mat_type: "<?php echo $result['mattype']; ?>",
          mat_grade: "<?php echo $result['matgrade']; ?>",
          mat_price: "<?php echo $result['matprice']; ?>",
          mat_location: "<?php echo $result['city'].',' .$result['state']; ?>",
        },
    <?php } }?>
  ];

   console.log(coordinates);
   console.log(features);
  //console.log(result1);
    //const infowindow = new google.maps.InfoWindow({ content: contentString,});
  // Create markers.
  var custommarkers = [];
  for (let i = 0; i < features.length; i++) {
    if(custommarkers.length == 0){
        features[i].customContent = '<div class="map-ad-detail-div"><div><h3><a style="color:#257c7c;" href='+features[i].url+'>'+features[i].title +'</a></h3></div><div</div><img src='+features[i].image_url+'><div><table class="mat-ad-details"><tbody><tr><td>Mat Type:</td><td>'+features[i].mat_type+'</td></tr><tr><td>Mat Grade</td><td>'+features[i].mat_grade+'</td></tr><tr><td>Mat Price</td><td>$'+features[i].mat_price+'</td></tr><tr><td>Location</td><td>'+features[i].mat_location+'</td></tr></tbody></table></div><div class="view-ad-map"><a href='+features[i].url+'>View Ad</a></div></div>';
        custommarkers.push(features[i]);
    } else {
        var isfound = 0;
        for (let j = 0; j < custommarkers.length; j++) {
            if( (custommarkers[j].lat == features[i].lat)  && (custommarkers[j].lng == features[i].lng)){
                isfound = 1;
                custommarkers[j].customContent = custommarkers[j].customContent+'<div class="map-ad-detail-div"><div><h3><a style="color:#257c7c;" href='+features[i].url+'>'+features[i].title +'</a></h3></div><div</div><img src='+features[i].image_url+'><div><table class="mat-ad-details"><tbody><tr><td>Mat Type:</td><td>'+features[i].mat_type+'</td></tr><tr><td>Mat Grade</td><td>'+features[i].mat_grade+'</td></tr><tr><td>Mat Price</td><td>$'+features[i].mat_price+'</td></tr><tr><td>Location</td><td>'+features[i].mat_location+'</td></tr></tbody></table></div><div class="view-ad-map"><a href='+features[i].url+'>View Ad</a></div></div>';
                break;
            }
        }
        if(!isfound){
            features[i].customContent = '<div class="map-ad-detail-div"><div><h3><a style="color:#257c7c;" href='+features[i].url+'>'+features[i].title +'</a></h3></div><div</div><img src='+features[i].image_url+'><div><table class="mat-ad-details"><tbody><tr><td>Mat Type:</td><td>'+features[i].mat_type+'</td></tr><tr><td>Mat Grade</td><td>'+features[i].mat_grade+'</td></tr><tr><td>Mat Price</td><td>$'+features[i].mat_price+'</td></tr><tr><td>Location</td><td>'+features[i].mat_location+'</td></tr></tbody></table></div><div class="view-ad-map"><a href='+features[i].url+'>View Ad</a></div></div>';
            custommarkers.push(features[i]);
        }
    }
  }
  console.log(custommarkers);
  var markers = [];
  for (let i = 0; i < custommarkers.length; i++) {
    const marker = new google.maps.Marker({
      position: custommarkers[i].position,
      icon: icons[custommarkers[i].type].icon,
      map: map,
    });
    const infowindow = new google.maps.InfoWindow({ content: custommarkers[i].customContent});
    marker.addListener("click", () => {
        infowindow.open({anchor: marker, map, shouldFocus: false, });
    });
    markers.push(marker);
  }
  const markerCluster = new markerClusterer.MarkerClusterer({ map, markers });
  //new MarkerClusterer({ markers, map });
}
// [END maps_custom_markers]


function initMapbkkk() {

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 7,
      center: new google.maps.LatLng(57.0280421,-111.2758134,6),
      zoom: 4,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      disableDefaultUI: true,
      zoomControl: true
    });
    var oms = new OverlappingMarkerSpiderfier(map, {
  markersWontMove: true,
  markersWontHide: true,
  basicFormatEvents: true
});
    const image =
    "<?php echo home_url('/'); ?>wp-content/uploads/2021/12/locationnew.png";
  const icons = {
    parking: {
      icon: image,
    }
  };
  //https://server.visionvivante.com:8080/ibid1/wp-content/uploads/2022/05/plusmarker.png
  //https://server.visionvivante.com:8080/ibid1/wp-content/uploads/2021/12/locationnew.png
    //var locations =[ [40.0000, 48.0000],[40.0000, 48.0000],[40.0000, 48.0000]];
    const features = [
    <?php foreach ($result_new as $key => $result) { ?>
        <?php if (!empty($result['lat']) && !empty($result['lng'])) { ?>
       {
          position: new google.maps.LatLng(
            <?php echo $result['lat']; ?>, 
            <?php echo $result['lng']; ?>
            ),
          type: "parking",
          lat: "<?php echo $result['lat']; ?>",
          lng: "<?php echo $result['lng']; ?>",
          title: "<?php echo $result['title']; ?>",
          url: "<?php echo $result['url']; ?>",
          image_url: "<?php echo $result['image_url']; ?>",
          mat_type: "<?php echo $result['mattype']; ?>",
          mat_grade: "<?php echo $result['matgrade']; ?>",
          mat_price: "<?php echo $result['matprice']; ?>",
          mat_location: "<?php echo $result['city'].',' .$result['state']; ?>",
        },
    <?php } }?>
  ];
    oms = new OverlappingMarkerSpiderfier(map,
        {markersWontMove: true, markersWontHide: true, keepSpiderfied: true, circleSpiralSwitchover: 40, basicFormatEvents: true });

    var marker, i;
      for (i = 0; i < features.length; i++) {  
         const marker = new google.maps.Marker({
              position: features[i].position,
              icon: {url: "https://server.visionvivante.com:8080/ibid1/wp-content/uploads/2021/12/locationnew.png"},
              map: map,
            });
         console.log(marker);
         const infowindow = new google.maps.InfoWindow({ content: '<div class="map-ad-detail-div"><div><h3><a style="color:#257c7c;" href='+features[i].url+'>'+features[i].title +'</a></h3></div><div</div><img src='+features[i].image_url+'><div><table class="mat-ad-details"><tbody><tr><td>Mat Type:</td><td>'+features[i].mat_type+'</td></tr><tr><td>Mat Grade</td><td>'+features[i].mat_grade+'</td></tr><tr><td>Mat Price</td><td>$'+features[i].mat_price+'</td></tr><tr><td>Location</td><td>'+features[i].mat_location+'</td></tr></tbody></table></div><div class="view-ad-map"><a href='+features[i].url+'>View Ad</a></div></div>',});
            marker.addListener("click", () => {
                infowindow.open({anchor: marker, map, shouldFocus: false, });
            });
        oms.addMarker(marker);
      }
}
//google.maps.event.addDomListener(window, 'load', initialize);


var mapLibsReady = 0;
    function initMap() {
      //if (++ mapLibsReady < 2) return;

      var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 7,
      center: new google.maps.LatLng(57.0280421,-111.2758134,6),
      zoom: 4,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      disableDefaultUI: true,
      zoomControl: true
        });
      //var iw = new google.maps.InfoWindow();
      //function iwClose() { iw.close(); }
      //google.maps.event.addListener(map, 'click', iwClose);

      var oms = new OverlappingMarkerSpiderfier(map, { markersWontMove: true, markersWontHide: false });

      oms.addListener('format', function(marker, status) {
        var iconURL = status == OverlappingMarkerSpiderfier.markerStatus.SPIDERFIED ? '<?php echo home_url(); ?>/wp-content/uploads/2022/04/locationnew.png' :
          status == OverlappingMarkerSpiderfier.markerStatus.SPIDERFIABLE ? '<?php echo home_url(); ?>/wp-content/uploads/2022/05/locationplus.png' :
          status == OverlappingMarkerSpiderfier.markerStatus.UNSPIDERFIABLE ? '<?php echo home_url(); ?>/wp-content/uploads/2022/04/locationnew.png' : 
          null;
        var iconSize = new google.maps.Size(23, 32);
        marker.setIcon({
          url: iconURL,
          size: iconSize,
          scaledSize: iconSize  // makes SVG icons work in IE
        });
      });

      const features = [
    <?php foreach ($result_new as $key => $result) { ?>
        <?php if (!empty($result['lat']) && !empty($result['lng'])) { ?>
       {
          position: new google.maps.LatLng(
            <?php echo $result['lat']; ?>, 
            <?php echo $result['lng']; ?>
            ),
          type: "parking",
          lat: "<?php echo $result['lat']; ?>",
          lng: "<?php echo $result['lng']; ?>",
          title: "<?php echo $result['title']; ?>",
          url: "<?php echo $result['url']; ?>",
          image_url: "<?php echo $result['image_url']; ?>",
          mat_type: "<?php echo $result['mattype']; ?>",
          mat_grade: "<?php echo $result['matgrade']; ?>",
          mat_price: "<?php echo $result['matprice']; ?>",
          mat_location: "<?php echo $result['city'].',' .$result['state']; ?>",
        },
    <?php } }?>
  ];
      var marker, i;
      for (i = 0; i < features.length; i++) {  
         const marker = new google.maps.Marker({
              position: features[i].position,
              icon: {url: "https://server.visionvivante.com:8080/ibid1/wp-content/uploads/2021/12/locationnew.png"},
              map: map,
            });
         console.log(marker);
         const infowindow = new google.maps.InfoWindow({ content: '<div class="map-ad-detail-div"><div><h3><a style="color:#257c7c;" href='+features[i].url+'>'+features[i].title +'</a></h3></div><div</div><img src='+features[i].image_url+'><div><table class="mat-ad-details"><tbody><tr><td>Mat Type:</td><td>'+features[i].mat_type+'</td></tr><tr><td>Mat Grade</td><td>'+features[i].mat_grade+'</td></tr><tr><td>Mat Price</td><td>$'+features[i].mat_price+'</td></tr><tr><td>Location</td><td>'+features[i].mat_location+'</td></tr></tbody></table></div><div class="view-ad-map"><a href='+features[i].url+'>View Ad</a></div></div>',});
            marker.addListener("click", () => {
                infowindow.open({anchor: marker, map});
            });
        oms.addMarker(marker);
      }

      window.map = map;  // for debugging/exploratory use in console
      window.oms = oms;  // ditto
    }

    // randomize some overlapping map data -- more normally we'd load some JSON data instead
    
    // var baseJitter = 2.5;
    // var clusterJitterMax = 0.1;
    // var rnd = Math.random;
    // var data = [];
    // var clusterSizes = [1, 1, 1, 1, 1, 2, 2, 2, 2, 2, 2, 2, 3, 3, 4, 5, 6, 7, 8, 9, 12, 18, 24];
    // for (var i = 0; i < clusterSizes.length; i++) {
    //   var baseLon = -1 - baseJitter / 2 + rnd() * baseJitter;
    //   var baseLat = 52 - baseJitter / 2 + rnd() * baseJitter;
    //   var clusterJitter = clusterJitterMax * rnd();
    //   for (var j = 0; j < clusterSizes[i]; j ++) data.push({
    //     lng:  baseLon - clusterJitter + rnd() * clusterJitter,
    //     lat:  baseLat - clusterJitter + rnd() * clusterJitter,
    //     text: Math.round(rnd() * 100) + '% happy'
    //   });
    // }
    // window.features = data;
</script>
<div class="ads_bg_color">
    <div class="container blog-posts breadcrumbs_status-<?php echo esc_attr($breadcrumbs_status); ?>">
        <div class="custom_ad_search">
            <?php echo do_shortcode( '[searchandfilter fields="search"]' ); ?>
            <!-- <form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
                <label>
                    <span class="screen-reader-text">Search for:</span>
                    <input type="search" class="search-field" placeholder="Search …" value="" name="s">
                </label>
                <input type="submit" class="search-submit" value="Search">
            </form> -->

        </div>
        <div class="list_switcher">
            <div class="map_view_switcher active_switcher tooltip">
                <span class="tooltiptext">List View</span>
                <a href="javascript:void(0)" id="switcher_list_view" class="map_view_switcher active-view">
                    <i class="fa-solid fa-list-ul"></i>
                </a>
            </div>
            <!-- <div id="switcher_list_view">
            </div> -->
            <div class="map_view_switcher tooltip">
                <span class="tooltiptext">Map View</span>
                <a href="javascript:void(0)" id="switcher_map_view" class="map_view_switcher">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pin-map-fill" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M3.1 11.2a.5.5 0 0 1 .4-.2H6a.5.5 0 0 1 0 1H3.75L1.5 15h13l-2.25-3H10a.5.5 0 0 1 0-1h2.5a.5.5 0 0 1 .4.2l3 4a.5.5 0 0 1-.4.8H.5a.5.5 0 0 1-.4-.8l3-4z"/>
                      <path fill-rule="evenodd" d="M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999z"/>
                    </svg>
                </a>
            </div>
            <!-- <div id="switcher_map_view">
                
            </div> -->
        </div>
        <div class="row cutsom_ads_listing_page">
            <?php if (  class_exists( 'ReduxFrameworkPlugin' ) ) { ?>
                <?php if ( $ibid_redux['ibid_blog_layout'] == 'ibid_blog_left_sidebar' && is_active_sidebar( $sidebar )) { ?>
                    <button class="filte_hide_icon"><i class="fa-solid fa-filter"></i></button>
                    <div class="col-md-3 sidebar-content filte_hide">
                        <button class="close_filter">Close</button>
                        <?php dynamic_sidebar( $sidebar ); ?>
                    </div>
                <?php } ?>
            <?php } ?>
            <div class="<?php echo esc_attr($class); ?> main-content">
            <div class="map_listing_view" id="map" style="display: none;"></div>
                <div class="row" id="ads_listing_view" style="display: block;">
                    <?php if ( $posts->have_posts() ) : ?>
                        <?php /* Start the Loop */ ?>
                        <?php
                        while ( $posts->have_posts() ) : $posts->the_post(); ?>
                        <?php
                            /* Include the Post-Format-specific template for the content.
                             * If you want to override this in a child theme, then include a file
                             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                             */
                            get_template_part( 'content', get_post_format() );
                        ?>
                        <?php endwhile; ?>
                        <?php echo '<div class="clearfix"></div>'; ?>
                    <?php else : ?>
                        <?php get_template_part( 'content', 'none' ); ?>
                    <?php endif; ?>

                    <div class="clearfix"></div>
                    <?php 
                    $wp_query = new WP_Query($args);
                    global  $wp_query;
                    if ($wp_query->max_num_pages != 1) { ?>                
                        <div class="modeltheme-pagination-holder col-md-12">           
                            <div class="modeltheme-pagination pagination">           
                                <?php the_posts_pagination(); ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <?php if (  class_exists( 'ReduxFrameworkPlugin' ) ) { ?>
                <?php if ( $ibid_redux['ibid_blog_layout'] == 'ibid_blog_right_sidebar' && is_active_sidebar( $sidebar )) { ?>
                    <div class="col-md-3 sidebar-content sidebar-content-right-side">
                        <?php  dynamic_sidebar( $sidebar ); ?>
                    </div>
                <?php } ?>
            <?php }else{ ?>
                <?php if ( is_active_sidebar( $sidebar )) { ?>
                    <div class="col-md-3 sidebar-content sidebar-content-right-side">
                        <?php  dynamic_sidebar( $sidebar ); ?>
                    </div>
                <?php } ?>                    
            <?php } ?>
        </div>
    </div>
</div>
<?php
get_footer();
?>