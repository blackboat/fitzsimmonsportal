<?php
/**
 * Order Item Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-item.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! apply_filters( 'woocommerce_order_item_visible', true, $item ) ) {
	return;
}
?>
<?php
$unit = get_field_object('qty', $product->id);
$unit = isset($unit['value'])?$unit['value']:'';
$brand = get_field_object('brand', $product->id);
$brand = isset($brand['value'])?$brand['value']:'';
$description = get_field_object('description', $product->id);
$description = isset($description['value'])?$description['value']:'';
$description_tbl = get_field_object('product_', $product->id);
$description_tbl = isset($description_tbl['value'])?$description_tbl['value']:'';
$unit_price = get_custom_price($product->id);
?>
<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_order_item_class', 'order_item', $item, $order ) ); ?>">
	<td>
		<?php
			$thumbnail = $product->get_image(array(32, 32));
			$is_visible        = $product && $product->is_visible();			
			$product_permalink = apply_filters( 'woocommerce_order_item_permalink', $is_visible ? $product->get_permalink( $item ) : '', $item, $order );
			printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
		?>
	</td>
	<td class="product-name">
		<?php
			
			echo apply_filters( 'woocommerce_order_item_name', $product_permalink ? sprintf( '<a href="%s">%s</a>', $product_permalink, $item['name'] ) : $item['name'], $item, $is_visible );
		?>
	</td>
	<td><?php echo $brand; ?></td>
	<td><?php echo $description==''?$description_tbl:$description; ?></td>
	<td><?php echo '$'.$unit_price; ?></td>
	<td style="text-align: center;">
		<?php
			echo apply_filters( 'woocommerce_order_item_quantity_html', sprintf( '%s', $item['qty'] ), $item );
		?>
	</td>
	<td><?php echo $unit*$item['qty']; ?></td>
	<td class="product-total">
		<?php echo $order->get_formatted_line_subtotal( $item ); ?>
	</td>
</tr>
<?php if ( $show_purchase_note && $purchase_note ) : ?>
<tr class="product-purchase-note">
	<td colspan="3"><?php echo wpautop( do_shortcode( wp_kses_post( $purchase_note ) ) ); ?></td>
</tr>
<?php endif; ?>
