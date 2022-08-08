<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package ibid
 */
?>
<?php
global $ibid_redux;
?>

    <?php if ( !class_exists( 'ReduxFrameworkPlugin' ) ) { ?>
        <!-- BACK TO TOP BUTTON -->
        <a class="back-to-top modeltheme-is-visible modeltheme-fade-out" href="<?php echo esc_url('#0'); ?>">
            <span></span>
        </a>
    <?php }else{ ?>
        <?php if (ibid_redux('ibid_backtotop_status') == true) { ?>
            <!-- BACK TO TOP BUTTON -->
           <a class="back-to-top modeltheme-is-visible modeltheme-fade-out" href="<?php echo esc_url('#0'); ?>">
                <span></span>
            </a>
        <?php } ?>
    <?php } ?>

    <?php
        $footer_widgets = 'no-footer-widgets';
        if ( is_active_sidebar( 'footer_column_1' ) || is_active_sidebar( 'footer_column_2' ) || is_active_sidebar( 'footer_column_3' ) || is_active_sidebar( 'footer_column_4' ) || is_active_sidebar( 'footer_column_5' ) ) {
            $footer_widgets = 'has-footer-widgets';
        }
    ?>
    <!-- MAIN FOOTER -->
    <footer class="<?php echo esc_attr($footer_widgets); ?>">
        <?php if ( class_exists( 'ReduxFrameworkPlugin' ) || class_exists( 'WooCommerce' ) ) { ?>
            <?php if (ibid_redux('ibid-enable-footer-top') == true) { ?>
                <div class="top-footer row">
                    <div class="container">
                        <div class="row">
                           <!--  <div class="col-md-8 left"><?php esc_html_e( 'Browse through our products library!', 'ibid' ); ?></div>
                            <div class="col-md-4">
                                <form name="myform" method="GET" class="woocommerce-product-search menu-search" action="<?php echo esc_url(home_url('/')); ?>">
                                    <input type="hidden" value="product" name="post_type">
                                    <input type="text"  name="s" class="search-field" maxlength="128" value="<?php echo esc_attr(get_search_query()); ?>" placeholder="<?php esc_attr_e('Search products...', 'ibid'); ?>">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
                                    <input type="hidden" name="post_type" value="product" />
                                </form>
                            </div> -->
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>

        <?php if ( class_exists( 'ReduxFrameworkPlugin' ) ) { ?>
            <?php if ( $ibid_redux['ibid-enable-footer-top'] == true ) { ?>
                <div class="container footer-top">
                    <?php if ( $ibid_redux['ibid-enable-footer-widgets'] ) { ?>
                        <div class="row footer-row-1">
                            <?php
                            $columns    = 12/intval($ibid_redux['ibid_number_of_footer_columns']);
                            $nr         = array("1", "2", "3", "4", "6");

                            if (in_array($ibid_redux['ibid_number_of_footer_columns'], $nr)) {
                                $class = 'col-md-'.esc_html($columns);
                                for ( $i=1; $i <= intval( $ibid_redux['ibid_number_of_footer_columns'] ) ; $i++ ) { 

                                    echo '<div class="'.esc_attr($class).' widget widget_text">';
                                        dynamic_sidebar( 'footer_column_'.esc_html($i) );
                                    echo '</div>';

                                }
                            }elseif($ibid_redux['ibid_number_of_footer_columns'] == 5){
                                #First
                                if ( is_active_sidebar( 'footer_column_1' ) ) {
                                    echo '<div class="col-md-3 widget widget_text">';
                                        dynamic_sidebar( 'footer_column_1' );
                                    echo '</div>';
                                }
                                #Second
                                if ( is_active_sidebar( 'footer_column_2' ) ) {
                                    echo '<div class="col-md-2 widget widget_text">';
                                        dynamic_sidebar( 'footer_column_2' );
                                    echo '</div>';
                                }
                                #Third
                                if ( is_active_sidebar( 'footer_column_3' ) ) {
                                    echo '<div class="col-md-2 widget widget_text">';
                                        dynamic_sidebar( 'footer_column_3' );
                                    echo '</div>';
                                }
                                #Fourth
                                if ( is_active_sidebar( 'footer_column_4' ) ) {
                                    echo '<div class="col-md-2 widget widget_text">';
                                        dynamic_sidebar( 'footer_column_4' );
                                    echo '</div>';
                                }
                                #Fifth
                                if ( is_active_sidebar( 'footer_column_5' ) ) {
                                    echo '<div class="col-md-3 widget widget_text">';
                                        dynamic_sidebar( 'footer_column_5' );
                                    echo '</div>';
                                }
                            }
                            ?>
                        </div>
                    <?php } ?>

                    <?php if ($ibid_redux['ibid-enable-footer-widgets-row2']) { ?>
                        <div class="row footer-row-2">
                            <?php
                            $columns    = 12/intval($ibid_redux['ibid_number_of_footer_columns_row2']);
                            $nr         = array("1", "2", "3", "4", "6");

                            if (in_array($ibid_redux['ibid_number_of_footer_columns_row2'], $nr)) {
                                $class = 'col-md-'.esc_html($columns);
                                for ( $i=1; $i <= intval( $ibid_redux['ibid_number_of_footer_columns_row2'] ) ; $i++ ) { 

                                    echo '<div class="'.esc_attr($class).' widget widget_text">';
                                        dynamic_sidebar( 'footer_column_row2'.esc_html($i) );
                                    echo '</div>';

                                }
                            }elseif($ibid_redux['ibid_number_of_footer_columns_row2'] == 5){
                                #First
                                if ( is_active_sidebar( 'footer_column_row21' ) ) {
                                    echo '<div class="col-md-3 widget widget_text">';
                                        dynamic_sidebar( 'footer_column_row21' );
                                    echo '</div>';
                                }
                                #Second
                                if ( is_active_sidebar( 'footer_column_row22' ) ) {
                                    echo '<div class="col-md-2 widget widget_text">';
                                        dynamic_sidebar( 'footer_column_row22' );
                                    echo '</div>';
                                }
                                #Third
                                if ( is_active_sidebar( 'footer_column_row23' ) ) {
                                    echo '<div class="col-md-2 widget widget_text">';
                                        dynamic_sidebar( 'footer_column_row23' );
                                    echo '</div>';
                                }
                                #Fourth
                                if ( is_active_sidebar( 'footer_column_row24' ) ) {
                                    echo '<div class="col-md-2 widget widget_text">';
                                        dynamic_sidebar( 'footer_column_row24' );
                                    echo '</div>';
                                }
                                #Fifth
                                if ( is_active_sidebar( 'footer_column_row25' ) ) {
                                    echo '<div class="col-md-3 widget widget_text">';
                                        dynamic_sidebar( 'footer_column_row25' );
                                    echo '</div>';
                                }
                            }
                            ?>
                        </div>
                    <?php } ?>

                    <?php if ($ibid_redux['ibid-enable-footer-widgets-row3']) { ?>
                        <div class="row footer-row-3">
                            <?php
                            $columns    = 12/intval($ibid_redux['ibid_number_of_footer_columns_row3']);
                            $nr         = array("1", "2", "3", "4", "6");

                            if (in_array($ibid_redux['ibid_number_of_footer_columns_row3'], $nr)) {
                                $class = 'col-md-'.esc_html($columns);
                                for ( $i=1; $i <= intval( $ibid_redux['ibid_number_of_footer_columns_row3'] ) ; $i++ ) { 

                                    echo '<div class="'.esc_attr($class).' widget widget_text">';
                                        dynamic_sidebar( 'footer_column_row3'.esc_html($i) );
                                    echo '</div>';

                                }
                            }elseif($ibid_redux['ibid_number_of_footer_columns_row3'] == 5){
                                #First
                                if ( is_active_sidebar( 'footer_column_row31' ) ) {
                                    echo '<div class="col-md-3 widget widget_text">';
                                        dynamic_sidebar( 'footer_column_row31' );
                                    echo '</div>';
                                }
                                #Second
                                if ( is_active_sidebar( 'footer_column_row32' ) ) {
                                    echo '<div class="col-md-2 widget widget_text">';
                                        dynamic_sidebar( 'footer_column_row32' );
                                    echo '</div>';
                                }
                                #Third
                                if ( is_active_sidebar( 'footer_column_row33' ) ) {
                                    echo '<div class="col-md-2 widget widget_text">';
                                        dynamic_sidebar( 'footer_column_row33' );
                                    echo '</div>';
                                }
                                #Fourth
                                if ( is_active_sidebar( 'footer_column_row34' ) ) {
                                    echo '<div class="col-md-2 widget widget_text">';
                                        dynamic_sidebar( 'footer_column_row34' );
                                    echo '</div>';
                                }
                                #Fifth
                                if ( is_active_sidebar( 'footer_column_row35' ) ) {
                                    echo '<div class="col-md-3 widget widget_text">';
                                        dynamic_sidebar( 'footer_column_row35' );
                                    echo '</div>';
                                }
                            }
                            ?>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        <?php } ?>

        <?php do_action('ibid_before_footer_mobile_navigation'); ?>

        <div class="footer footer-copyright">
            <div class="container">
                <div class="row">
                    <?php if ( class_exists( 'ReduxFrameworkPlugin' ) ) { ?>
                        <div class="col-md-6">
                            <p class="copyright"><?php echo wp_kses($ibid_redux['ibid_footer_text_left'], 'link'); ?></p>
                        </div>
                        <div class="col-md-6 payment-methods">
                            <p class="copyright"><?php echo wp_kses($ibid_redux['ibid_footer_text_right'], 'link'); ?></p>
                        </div>
                    <?php }else { ?>
                        <div class="col-md-6">
                            <p class="copyright"><?php esc_html_e( 'Copyright by ModelTheme. All Rights Reserved.', 'ibid' ); ?></p>
                        </div>
                        <div class="col-md-6 payment-methods">
                            <p class="copyright"><?php esc_html_e( 'Elite Author on ThemeForest', 'ibid' ); ?></p>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </footer>
</div>
<script>
jQuery(function () {
    //jQuery('#startDate').datepicker({ dateFormat: 'yy-mm-dd' });
   // jQuery('#endDate').datepicker({ dateFormat: 'yy-mm-dd 00:00' });
    // jQuery("#startDate").on("dp.change",function (e) {
    //     jQuery('#endDate').data("DateTimePicker").setMinDate(e.date);
    // });
    // jQuery("#endDate").on("dp.change",function (e) {
    //     jQuery('#startDate').data("DateTimePicker").setMaxDate(e.date);
    // });
});
</script>
 <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAzXDEebJV9MxtPAPhP1B2w5T3AYK2JOu0&callback=initMap&v=weekly"
      async
    ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OverlappingMarkerSpiderfier/1.0.3/oms.min.js"></script>
    
<!-- <script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery("#<%=TextBox1.ClientID %>").dynDateTime({
            showsTime: true,
            ifFormat: "%Y/%m/%d %H:%M",
            daFormat: "%l;%M %p, %e %m,  %Y",
            align: "BR",
            electric: false,
            singleClick: false,
            displayArea: ".siblings('.dtcDisplayArea')",
            button: ".next()",
            minDate: -2
        });
    });
</script>
<script type="text/javascript">
                jQuery(function () {
                    jQuery('#startDate').datetimepicker({
                        minDate: new Date().setDate(new Date().getDate() - 2),
                        sideBySide: false
                    });
                });
</script> -->
 <script>

   jQuery(function($){
    $('#filter').submit(function(){
        var filter = $('#filter');
        $.ajax({
            url:filter.attr('action'),
            data:filter.serialize(), // form data
            type:filter.attr('method'), // POST
            beforeSend:function(xhr){
                filter.find('button').text('Processing...'); // changing the button label
            },
            success:function(data){
                filter.find('button').text('Apply filter'); // changing the button label back
                $('#response').html(data); // insert data
            }
        });
        return false;
    });
});

</script> 
<script type="text/javascript">
    var acc = document.getElementsByClassName("filter_accordian");
    var i;
    for (i = 0; i < acc.length; i++) {
      acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
          panel.style.display = "none";
        } else {
          panel.style.display = "block";
        }
      });
    }

var container = document.getElementById('container1')
var slider = document.getElementById('slider');
var slides = document.getElementsByClassName('slide').length;
var buttons = document.getElementsByClassName('btn');


var currentPosition = 0;
var currentMargin = 0;
var slidesPerPage = 0;
var slidesCount = slides - slidesPerPage;
var containerWidth = container.offsetWidth;
var prevKeyActive = false;
var nextKeyActive = true;

window.addEventListener("resize", checkWidth);

function checkWidth() {
    containerWidth = container.offsetWidth;
    setParams(containerWidth);
}

function setParams(w) {
    if (w < 551) {
        slidesPerPage = 1;
    } else {
        if (w < 901) {
            slidesPerPage = 2;
        } else {
            if (w < 1101) {
                slidesPerPage = 3;
            } else {
                slidesPerPage = 4;
            }
        }
    }
    slidesCount = slides - slidesPerPage;
    if (currentPosition > slidesCount) {
        currentPosition -= slidesPerPage;
    };
    currentMargin = - currentPosition * (100 / slidesPerPage);
    slider.style.marginLeft = currentMargin + '%';
    if (currentPosition > 0) {
        buttons[0].classList.remove('inactive');
    }
    if (currentPosition < slidesCount) {
        buttons[1].classList.remove('inactive');
    }
    if (currentPosition >= slidesCount) {
        buttons[1].classList.add('inactive');
    }
}

setParams();

function slideRight() {
    if (currentPosition != 0) {
        slider.style.marginLeft = currentMargin + (100 / slidesPerPage) + '%';
        currentMargin += (100 / slidesPerPage);
        currentPosition--;
    };
    if (currentPosition === 0) {
        buttons[0].classList.add('inactive');
    }
    if (currentPosition < slidesCount) {
        buttons[1].classList.remove('inactive');
    }
};

function slideLeft() {
    if (currentPosition != slidesCount) {
        slider.style.marginLeft = currentMargin - (100 / slidesPerPage) + '%';
        currentMargin -= (100 / slidesPerPage);
        currentPosition++;
    };
    if (currentPosition == slidesCount) {
        buttons[1].classList.add('inactive');
    }
    if (currentPosition > 0) {
        buttons[0].classList.remove('inactive');
    }
};

</script>
<script>
// function myFunction() {
//   var x = document.getElementById("filte_hide");
//   if (x.style.display === "none") {
//     x.style.display = "block";
//   } else {
//     x.style.display = "none";
//   }
// }
</script>
<!-- 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" integrity="sha512-bYPO5jmStZ9WI2602V2zaivdAnbAhtfzmxnEGh9RwtlI00I9s8ulGe4oBa5XxiC6tCITJH/QG70jswBhbLkxPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.js" integrity="sha512-+UiyfI4KyV1uypmEqz9cOIJNwye+u+S58/hSwKEAeUMViTTqM9/L4lqu8UxJzhmzGpms8PzFJDzEqXL9niHyjA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.js" integrity="sha512-9yoLVdmrMyzsX6TyGOawljEm8rPoM5oNmdUiQvhJuJPTk1qoycCK7HdRWZ10vRRlDlUVhCA/ytqCy78+UujHng==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" integrity="sha512-f0tzWhCwVFS3WeYaofoLWkTP62ObhewQ1EZn65oSYDZUg1+CyywGKkWzm8BxaJj5HGKI72PnMH9jYyIFz+GH7g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.js" integrity="sha512-L7jgg7T9UbYc7hXogUKssqe1B5MsgrcviNxsRbO53dDSiw/JxuA/4kVQvEORmZJ6Re3fVF3byN5TT7czo9Rdug==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->

<div class="modal fade" id="intrestModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close Make-offer-close" data-dismiss="modal">&times;</button>
            <h3 class="Make-offer-heading">Make Offer</h3>
        </div>
        <div class="modal-body">
          <?php echo do_shortcode('[post_quote]'); ?>
        </div>
        
      </div>
    </div>
</div>

<style>
.list_switcher {
    display: flex;
    justify-content: end;
}
#switcher_list_view {
    font-size: 25px;
}
#switcher_map_view svg {
    height: 30px;
    width: 25px;
    margin-left: 10px;
}

/*#container {
  height: 100vh;
  width: 100vw;
  margin: 0;
  padding: 0;
  background: teal;
  display: grid ;
  place-items: center
}*/

/*#slider-container {
  position: relative;
  overflow: hidden;
  padding: 20px;
}

#slider-container .btn {
  position: absolute;
  top: calc(50% - 30px);
  height: 30px;
  width: 30px;
  border-left: 8px solid pink;
  border-top: 8px solid pink;
}

#slider-container .btn:hover {
  transform: scale(1.2);
}

#slider-container .btn.inactive {
  border-color: rgb(153, 121, 126)
}

#slider-container .btn:first-of-type {
  transform: rotate(-45deg);
  left: 10px
}

#slider-container .btn:last-of-type {
  transform: rotate(135deg);
  right: 10px;
}

#slider-container #slider {
  display: flex;
  width: 1000%;
  height: 100%; 
  transition: all .5s;
}

#slider-container #slider .slide {
  height: 90%;
  margin: auto 10px;
  box-shadow: 2px 2px 4px 2px white, -2px -2px 4px 2px white;
  display: grid;
  place-items: center;
}

#slider-container #slider .slide span {
  color: white;
  font-size: 150px;
}

@media only screen and (min-width: 1100px) {

  #slider-container #slider .slide {
    width: calc(2.5% - 20px);
  }

}

@media only screen and (max-width: 1100px) {

  #slider-container #slider .slide {
    width: calc(3.3333333% - 20px);
  }

}

@media only screen and (max-width: 900px) {

  #slider-container #slider .slide {
    width: calc(5% - 20px);
  }

}

@media only screen and (max-width: 550px) {

  #slider-container #slider .slide {
    width: calc(10% - 20px);
  }

}*/
</style>
<?php wp_footer(); ?>
</body>
</html>