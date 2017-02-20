<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
global $wpdb;
global $current_user;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
$acronym = "OOS – Out of Scope
Note this product is not part of the usual range of goods that you stock in your venue";
?>
<li <?php post_class(); ?>>
	<?php
	$pid = $product->post->ID;
	// $dummy_venue = 'Dutchess';
	// $venue = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_title = %s AND post_type= 'venue'", $dummy_venue));
	// $venue = get_post($venue);
	$venue_id = get_current_venue_id();
	$scopes = get_field_object('product', $venue_id);

	/**
	 * woocommerce_before_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	// do_action( 'woocommerce_before_shop_loop_item' );
	$src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full', false );
	echo '<a href="' . $src[0] . '" class="yith_magnifier_zoom">';

	/**
	 * woocommerce_before_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_show_product_loop_sale_flash - 10
	 * @hooked woocommerce_template_loop_product_thumbnail - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item_title' );
	echo '</a>';

	/**
	 * woocommerce_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_template_loop_product_title - 10
	 */
	// do_action( 'woocommerce_shop_loop_item_title' );

	/**
	 * woocommerce_after_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_template_loop_rating - 5
	 * @hooked woocommerce_template_loop_price - 10
	 */
	// do_action( 'woocommerce_after_shop_loop_item_title' );
	echo '<div class="product-box"><div class="detail-box">';
	do_action( 'woocommerce_shop_loop_item_title' );
	$cat = $wp_query->get_queried_object();
	if (isset($cat->slug)) {
		$cat_slug = $cat->slug;
		if ($cat->parent != 0)
			$cat_slug = get_category($cat->parent)->slug;
	} else {
		$cat_slug = '';
	}
	$fields = get_field_objects($pid);
	$qty = 1;
	if( $fields )
	{
		if ($cat_slug == 'tableware') {
			$product_ = get_field_object('product_', $pid);
			$product_ = $product_ ? $product_['value'] : '';
			$dimensions = get_field_object('dimensions', $pid);
			$dimensions = $dimensions ? $dimensions['value'] : '';

			echo '<h6 style="color:#333;" class="dazz_head_style">' . $product_ . '&nbsp;&nbsp;&nbsp;&nbsp;' . $dimensions . '</h6>';
			echo '<table style="width:100%;">';
			foreach( $fields as $field_name => $field )
			{
				if ($field['label']) {
					echo '<tr>';
					if ($field['name'] == 'product_' || $field['name'] == 'dimensions' || $field['name'] == 'unit_price' || $field['name'] == 'custom_pricing' || $field['name'] == 'custom_prices') {
						continue;
					}
					echo '<td class="stock-detail">'.$field['label'].': '.'</td>';
					echo '<td class="stock-detail stock-right">'.$field['value'].'</td>';
					echo '</tr>';
				}
			}
			echo '</table>';
		} else if ($cat_slug == 'drinkware') {
			$range = get_field_object('range', $pid);
			$range = $range ? $range['value'] : '';
			$description = get_field_object('description', $pid);
			$description = $description ? $description['value'] : '';
			$capacity = get_field_object('capacity', $pid);
			$capacity = $capacity ? $capacity['value'] : '';

			echo '<h6 style="color:#333;" class="dazz_head_style">' . $range . '&nbsp;&nbsp;' . $description . '&nbsp;&nbsp;' . $capacity . '</h6>';
			echo '<table style="width:100%;">';
			foreach( $fields as $field_name => $field )
			{
				if ($field['label']) {
					echo '<tr>';
					if ($field['name'] == 'range' ||  $field['name'] == 'capacity' || $field['name'] == 'unit_price' || $field['name'] == 'custom_pricing' || $field['name'] == 'custom_prices') {
						continue;
					}
					echo '<td class="stock-detail">'.$field['label'].': '.'</td>';
					echo '<td class="stock-detail stock-right">'.$field['value'].'</td>';
					echo '</tr>';
				}
			}
			echo '</table>';
		} else if ($cat_slug == 'barware') {
			$description = get_field_object('description', $pid);
			$description = $description ? $description['value'] : '';
			$capacity = get_field_object('capacity', $pid);
			$capacity = $capacity ? $capacity['value'] : '';

			echo '<h6 style="color:#333;" class="dazz_head_style">' . $description . '&nbsp;&nbsp;' . $capacity . '</h6>';
			echo '<table style="width:100%;">';
			foreach( $fields as $field_name => $field )
			{
				if ($field['label']) {
					echo '<tr>';
					if ( $field['name'] == 'height_(mm)' || $field['name'] == 'diameter_(mm)' ||  $field['name'] == 'range' ||  $field['name'] == 'capacity' || $field['name'] == 'unit_price' || $field['name'] == 'custom_pricing' || $field['name'] == 'custom_prices') {
						continue;
					}
					echo '<td class="stock-detail">'.$field['label'].': '.'</td>';
					echo '<td class="stock-detail stock-right">'.$field['value'].'</td>';
					echo '</tr>';
				}
			}
			echo '</table>';
			
		}
	}
	echo '</div></div>';

	/**
	 * woocommerce_after_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item' );
	echo '<div class="button-box">';
		echo '<h4 class="prig-title">$' . get_custom_price($pid) . '  EA</h4>';
		echo '<a class="wpb_wl_preview open-popup-link btn btn-default" href="#wpb_wl_quick_view_'.$pid.'" data-effect="mfp-zoom-in"><i class="fa fa-plus"></i> Add To Cart</a>';
		
		$catid_list = wp_get_post_terms($pid,'product_cat',array('fields'=>'ids'));
		if (!current_user_can('administrator')) {
			$scope_list = array();
			if ($scopes['value'] != false) {
				foreach ($scopes['value'] as $scope) {
					$scope_list[] = $scope->ID;
				}
				if (!in_array($pid, $scope_list)) {
					echo '<div class="oos-panel"><acronym title="'.$acronym.'">OOS</acronym></div>';
				}
			} else {
				echo '<div class="oos-panel">OOS</div>';
			}
		}
	echo '</div>';
	?>
</li>
