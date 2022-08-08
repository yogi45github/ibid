<?php
if ( ! defined( 'ABSPATH' ) ) exit;
?>

<!-- Product categories -->
<div class="apf-box-container apf-product-box-container apf-category-container">
    <div class="apf-header" style="border-bottom: 1px solid #ccd0d4;">
        <h2> <?php _e( 'Product categories', 'apf_plugin' ); ?></h2>
    </div>
    <div class="apf-content" style="padding: 12px;">
        <?php
              // 1 for yes, 0 for no
              $taxonomy     = 'product_cat';
              $orderby      = 'name';  
              $show_count   = 0;      
              $pad_counts   = 0;
              $hierarchical = 1;
              $title        = '';  
              $empty        = 0;
            
              $args = array(
                     'taxonomy'     => $taxonomy,
                     'orderby'      => $orderby,
                     'show_count'   => $show_count,
                     'pad_counts'   => $pad_counts,
                     'hierarchical' => $hierarchical,
                     'title_li'     => $title,
                     'hide_empty'   => $empty
              );
             $all_categories = get_categories( $args );
             foreach ($all_categories as $cat) {
                if($cat->category_parent == 0) {
                    $category_id = $cat->term_id;       
                    echo '<label class="apf-cat-list"><input value="'. $category_id.'" type="checkbox" name="apf_product_cat[]">'.$cat->name.'</label><br />';
            
                    $args2 = array(
                            'taxonomy'     => $taxonomy,
                            'child_of'     => 0,
                            'parent'       => $category_id,
                            'orderby'      => $orderby,
                            'show_count'   => $show_count,
                            'pad_counts'   => $pad_counts,
                            'hierarchical' => $hierarchical,
                            'title_li'     => $title,
                            'hide_empty'   => $empty
                    );
                    $sub_cats = get_categories( $args2 );
                    if($sub_cats) {
                        foreach($sub_cats as $sub_category) {
                            echo '<label class="apf-sub-cat-list"><input value="'. $sub_category->term_id.'" type="checkbox" name="apf_product_cat[]">'.$sub_category->name.'</label><br />';

                            $args3 = array(
                                'taxonomy'     => $taxonomy,
                                'child_of'     => 0,
                                'parent'       => $sub_category->term_id,
                                'orderby'      => $orderby,
                                'show_count'   => $show_count,
                                'pad_counts'   => $pad_counts,
                                'hierarchical' => $hierarchical,
                                'title_li'     => $title,
                                'hide_empty'   => $empty
                            );
                            $sub_sub_cats = get_categories( $args3 );
                            if($sub_sub_cats) {
                                foreach($sub_sub_cats as $sub_sub_category) {
                                    echo '<label class="apf-sub-sub-cat-list"><input value="'. $sub_sub_category->term_id.'" type="checkbox" name="apf_product_cat[]">'.$sub_sub_category->name.'</label><br />';
                                }
                            }
                        }
                    }
                }       
            }
        ?>
    </div>
</div>