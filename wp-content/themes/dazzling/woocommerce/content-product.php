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

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<li <?php post_class(); ?>>
	<?php
	/**
	 * woocommerce_before_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item' );

	/**
	 * woocommerce_before_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_show_product_loop_sale_flash - 10
	 * @hooked woocommerce_template_loop_product_thumbnail - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item_title' );

	/**
	 * woocommerce_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_template_loop_product_title - 10
	 */
	do_action( 'woocommerce_shop_loop_item_title' );

	/**
	 * woocommerce_after_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_template_loop_rating - 5
	 * @hooked woocommerce_template_loop_price - 10
	 */
	// do_action( 'woocommerce_after_shop_loop_item_title' );
	echo '<div class="product-box"><div class="detail-box">';
	$cat = $wp_query->get_queried_object();
	$cat_slug = $cat->slug;
	if ($cat->parent != 0)
		$cat_slug = get_category($cat->parent)->slug;
	$pid = $product->post->ID;
	$link = get_permalink( $pid );
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $pid ), 'single-post-thumbnail' );
	if (!$image) {
		$image = wc_placeholder_img_src();
	} else {
		$image = $image[0];
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

			echo '<h6 style="color:#333;">' . $product_ . '&nbsp;&nbsp;&nbsp;&nbsp;' . $dimensions . '</h6>';
			echo '<div class="stock-detail">';

			foreach( $fields as $field_name => $field )
			{
				if ($field['label']) {
					if ($field['name'] == 'qty') {
						$qty = $field['value'];
					}
					if ($field['name'] == 'product_' || $field['name'] == 'dimensions') {
						continue;
					}
					echo '<label>'.$field['label'].': '.'</label>';
				}
			}
			echo '</div>';
			echo '<div class="stock-detail stock-right">';
			foreach( $fields as $field_name => $field )
			{
				if ($field['label']) {
					if ($field['name'] == 'product_' || $field['name'] == 'dimensions') {
						continue;
					}
					echo '<label>'.$field['value'].'</label>';
				}
			}
			echo '</div>';
		} else if ($cat_slug == 'drinkware') {
			$range = get_field_object('range', $pid);
			$range = $range ? $range['value'] : '';
			$description = get_field_object('description', $pid);
			$description = $description ? $description['value'] : '';
			$capacity = get_field_object('capacity', $pid);
			$capacity = $capacity ? $capacity['value'] : '';

			echo '<h6 style="color:#333;">' . $range . '&nbsp;&nbsp;' . $description . '&nbsp;&nbsp;' . $capacity . '</h6>';
			echo '<div class="stock-detail">';
			foreach( $fields as $field_name => $field )
			{
				if ($field['label']) {
					if ($field['name'] == 'range' || $field['name'] == 'description' || $field['name'] == 'capacity') {
						continue;
					}
					echo '<label>'.$field['label'].': '.'</label>';
				}
			}
			echo '</div>';
			echo '<div class="stock-detail stock-right">';
			foreach( $fields as $field_name => $field )
			{
				if ($field['label']) {
					if ($field['name'] == 'range' || $field['name'] == 'description' || $field['name'] == 'capacity') {
						continue;
					}
					echo '<label>'.$field['value'].'</label>';
				}
			}
			echo '</div>';
		} else if ($cat_slug == 'barware') {
			$description = get_field_object('description', $pid);
			$description = $description ? $description['value'] : '';
			$capacity = get_field_object('capacity', $pid);
			$capacity = $capacity ? $capacity['value'] : '';

			echo '<h6 style="color:#333;">' . $description . '&nbsp;&nbsp;' . $capacity . '</h6>';
			echo '<div class="stock-detail">';
			foreach( $fields as $field_name => $field )
			{
				if ($field['label']) {
					if ($field['name'] == 'description' || $field['name'] == 'capacity') {
						continue;
					}
					echo '<label>'.$field['label'].': '.'</label>';
				}
			}
			echo '</div>';
			echo '<div class="stock-detail stock-right">';
			foreach( $fields as $field_name => $field )
			{
				if ($field['label']) {
					if ($field['name'] == 'description' || $field['name'] == 'capacity') {
						continue;
					}
					echo '<label>'.$field['value'].'</label>';
				}
			}
			echo '</div>';
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
		$unit_price = get_field_object('unit_price', $pid);
		echo '<h4 class="prig-title">$' . $unit_price['value'] . '  EA</h4>';
		// echo '<a href="" class="btn btn-default"><i class="fa fa-plus"></i> Add To Cart</a>';
		echo '<a class="wpb_wl_preview open-popup-link btn btn-default" href="#wpb_wl_quick_view_'.$pid.'" data-effect="mfp-zoom-in"><i class="fa fa-plus"></i> Add To Cart</a>';
	echo '</div>';
	?>
</li>
