 <?php
 /**
* @link https://quadlayers.com/
* @since 1.0.0
* @package QuadLayers Add Product to WooCommerce
* Plugin Name: QuadLayers Add Products
* Plugin URI: https://quadlayers.com/
* Description: Adding products programmatically to WooCommerce
* Name: Store Vendor Total
* Version: 1.0.0
* Author: Sebastopolys 
* Author URI: https://quadlayers.com/
* License: GPL-2.0+
* License URI: http://www.gnu.org/licenses/gpl-2.0.txt
* Text Domain: quadlayers_ap
*/
if(!defined('ABSPATH')){die('-1');}
function QuadLayers_init(){require plugin_dir_path( __FILE__ 
).'class_quadlayers_add_product.php';
$run = new QuadLayers_class;
}
QuadLayers_init();