<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $current_user;
?>
<table class="shop_table woocommerce-checkout-review-order-table">
	<thead>
		<tr>
			<th class="product-thumbnail">&nbsp;</th>
			<th class="product-itemcode"><?php _e( 'Item Code', 'woocommerce' ); ?></th>
			<th class="product-brand"><?php _e( 'Brand', 'woocommerce' ); ?></th>
			<th class="product-description"><?php _e( 'Description', 'woocommerce' ); ?></th>
			<th class="product-price"><?php _e( 'Unit Price', 'woocommerce' ); ?></th>
			<th class="product-carton"><?php _e( 'Cartons', 'woocommerce' ); ?></th>
			<th class="product-unit"><?php _e( 'Units', 'woocommerce' ); ?></th>
			<th class="product-subtotal"><?php _e( 'SubTotal', 'woocommerce' ); ?></th>
			<?php if (!current_user_can('administrator')) { ?>
			<th class="product-oos">&nbsp;</th>
			<?php } ?>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			$unit = get_field_object('qty', $product_id);
			$brand = get_field_object('brand', $product_id);
			$description = get_field_object('description', $product_id);
			$description_tbl = get_field_object('product_', $product_id);
			$unit_price = get_custom_price($product_id);

			$venue_id = get_current_venue_id();
			$scopes = get_field_object('product', $venue_id);

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
				?>
				<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

					<td class="product-thumbnail">
						<?php
							$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(array(32, 32)), $cart_item, $cart_item_key );

							if ( ! $product_permalink ) {
								echo $thumbnail;
							} else {
								printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
							}
						?>
					</td>

					<td class="product-itemcode" data-title="<?php _e( 'Product', 'woocommerce' ); ?>">
						<?php
							if ( ! $product_permalink ) {
								echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;';
							} else {
								echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_title() ), $cart_item, $cart_item_key );
							}

							// Meta data
							echo WC()->cart->get_item_data( $cart_item );

							// Backorder notification
							if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
								echo '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>';
							}
						?>
					</td>

					<td class="product-brand" data-title="<?php _e( 'Brand', 'woocommerce' ); ?>">
						<?php
							echo $brand['value'];
						?>
					</td>

					<td class="product-description" data-title="<?php _e( 'Description', 'woocommerce' ); ?>">
						<?php if($description['value']) { 
						echo $description['value']; }
						else
						{
							echo $description_tbl['value'];
						}
						?>
					</td>

					<td class="product-price" data-title="<?php _e( 'Unit Price', 'woocommerce' ); ?>">
						<?php
							echo '$'.$unit_price;
						?>
					</td>

					<td class="product-quantity" data-title="<?php _e( 'Quantity', 'woocommerce' ); ?>" style="text-align: center">
						<?php
							if ( $_product->is_sold_individually() ) {
								$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
							} else {
								$product_quantity = woocommerce_quantity_input( array(
									'input_name'  => "cart[{$cart_item_key}][qty]",
									'input_value' => $cart_item['quantity'],
									'min_value'   => '0',
									'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity()
									
								), $_product, false );
							}

							echo $cart_item['quantity'];
							// echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
						?>
					</td>

					<td class="product-unit" data-title="<?php _e( 'Units', 'woocommerce' ); ?>" unit="<?php echo $unit['value']; ?>" style="text-align: center">
						<?php
							echo $unit['value'] * $cart_item['quantity'];
						?>
					</td>

					<td class="product-subtotal" data-title="<?php _e( 'Total', 'woocommerce' ); ?>">
						<?php
							echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
						?>
					</td>

					<?php if (!current_user_can('administrator')) { ?>
					<td class="product-oos" data-title="<?php _e( 'OOS', 'woocommerce' ); ?>">
					<?php
					$scope_list = array();
					if ($scopes['value'] != false) {
						foreach ($scopes['value'] as $scope) {
							$scope_list[] = $scope->ID;
						}
						if (!in_array($product_id, $scope_list)) {
							echo '<div class="oos-panel"><acronym title="OOS – Out of Scope<br/>Note this product is not part of the usual range of goods that you stock in your venue">OOS</acronym></div>';
						}
					}
					?>
					</td>
					<?php } ?>
				</tr>
				<?php
			}
		}
		?>
		<tr style="display:none;">
			<td colspan="7" class="actions">

				<?php if ( wc_coupons_enabled() ) { ?>
					<div class="coupon">

						<label for="coupon_code"><?php _e( 'Coupon:', 'woocommerce' ); ?></label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> <input type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply Coupon', 'woocommerce' ); ?>" />

						<?php do_action( 'woocommerce_cart_coupon' ); ?>
					</div>
				<?php } ?>

				<input type="submit" class="update-cart-button button" name="update_cart" value="<?php esc_attr_e( 'Update Cart', 'woocommerce' ); ?>" />

				<?php do_action( 'woocommerce_cart_actions' ); ?>

				<?php wp_nonce_field( 'woocommerce-cart' ); ?>
			</td>
		</tr>
	</tbody>
	<tfoot>

		<tr class="cart-subtotal">
			<th colspan="7" style="text-align: right;"><?php _e( 'Subtotal', 'woocommerce' ); ?></th>
			<td colspan="2"><?php wc_cart_totals_subtotal_html(); ?></td>
		</tr>

		<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
			<tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
				<th colspan="7" style="text-align: right;"><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
				<td colspan="2"><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
			</tr>
		<?php endforeach; ?>

		<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

			<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

			<?php wc_cart_totals_shipping_html(); ?>

			<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

		<?php endif; ?>

		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
			<tr class="fee">
				<th colspan="7" style="text-align: right;"><?php echo esc_html( $fee->name ); ?></th>
				<td colspan="2"><?php wc_cart_totals_fee_html( $fee ); ?></td>
			</tr>
		<?php endforeach; ?>

		<?php if ( wc_tax_enabled() && 'excl' === WC()->cart->tax_display_cart ) : ?>
			<?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
				<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
					<tr class="tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>">
						<th colspan="7" style="text-align: right;"><?php echo esc_html( $tax->label ); ?></th>
						<td colspan="2"><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
					</tr>
				<?php endforeach; ?>
			<?php else : ?>
				<tr class="tax-total">
					<th colspan="7" style="text-align: right;"><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></th>
					<td colspan="2"><?php wc_cart_totals_taxes_total_html(); ?></td>
				</tr>
			<?php endif; ?>
		<?php endif; ?>

		<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

		<tr class="order-total">
			<th colspan="7" style="text-align: right;"><?php _e( 'Total', 'woocommerce' ); ?></th>
			<td colspan="2"><?php wc_cart_totals_order_total_html(); ?></td>
		</tr>

		<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>

	</tfoot>
</table>
