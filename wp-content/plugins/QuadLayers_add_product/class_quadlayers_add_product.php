<?php
class QuadLayers_class{
	public function __construct(){
		add_action('wp_head',array($this,'quadlayers_add_product'));
	}
	public function quadlayers_add_product(){
		$post_id = wp_insert_post( array(
		'post_title' => 'Great product!',
		'post_content' => 'Hey, this is our new product',
		'post_status' => 'publish',
		'post_type' => "product",
		) );
		wp_set_object_terms( $post_id, 'simple', 'product_type' );
	}
}