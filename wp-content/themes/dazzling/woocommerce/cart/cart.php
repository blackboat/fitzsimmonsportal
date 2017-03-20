<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
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
 * @version 2.3.8
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $wpdb;
global $current_user;
wc_print_notices();

do_action( 'woocommerce_before_cart' ); 
$acronym = "OOS – Out of Scope
Note this product is not part of the usual range of goods that you stock in your venue";?>

<form class="cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">

<?php do_action( 'woocommerce_before_cart_table' ); ?>

<table class="shop_table shop_table_responsive cart table" cellspacing="0">
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
			<th class="product-remove">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		<?php do_action( 'woocommerce_before_cart_contents' ); ?>

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
							$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

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

					<td class="product-quantity" data-title="<?php _e( 'Quantity', 'woocommerce' ); ?>">
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

							echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
						?>
					</td>

					<td class="product-unit" data-title="<?php _e( 'Units', 'woocommerce' ); ?>" unit="<?php echo $unit['value']; ?>">
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
							echo '<div class="oos-panel"><acronym title="'.$acronym.'">OOS</acronym></div>';
						}
					}
					?>
					</td>
					<?php } ?>

					<td class="product-remove">
						<?php
							echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
								'<a href="%s" class="remove" title="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
								esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
								__( 'Remove this item', 'woocommerce' ),
								esc_attr( $product_id ),
								esc_attr( $_product->get_sku() )
							), $cart_item_key );
						?>
					</td>
				</tr>
				<?php
			}
		}

		do_action( 'woocommerce_cart_contents' );
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

		<?php do_action( 'woocommerce_after_cart_contents' ); ?>
	</tbody>
</table>

<?php do_action( 'woocommerce_after_cart_table' ); ?>

</form>

<div class="cart-collaterals">

	<?php do_action( 'woocommerce_cart_collaterals' ); ?>

</div>

<div class="row">
	<div class="col-xs-12">
		<div class="btn-row">
			<div class="btn-group"><a href="<?php echo get_home_url(); ?>" class="btn btn-default">Continue Shopping</a></div>
			<div class="btn-group"><a href="<?php echo esc_url( wc_get_checkout_url() ) ;?>" id="submit_order" class="btn btn-success">Submit Order</a></div>
		</div>
	</div>
</div>

<div id="submit_modal" title="Custom Price">
  
</div>
<script type="text/javascript">
jQuery(document).ready(function( $ ){
	$('#submit_order').on('click', function() {
		var total = parseInt($('.order-total .woocommerce-Price-amount').text().replace('$', ''));
		$('#submit_modal').append(
			'<form action="<?php echo esc_url( wc_get_checkout_url() ) ;?>" method="GET">' +
			    '<fieldset>' +
			      '<label for="name">All orders to metro capital cities under $100.00 in net value will attract a $20.00 delivery surcharge</label>' +
				'</fieldset>' +
			'</form>'
		);
		if (total<=100) {
			$('#submit_modal form').show();
			dialog = $( "#submit_modal form" ).dialog({
		      autoOpen: false,
		      width: 450,
		      position: { my: 'center', at: 'center' },
		      modal: true,
		      title: 'Notification',
		      buttons: [
		      	{
		            text: "Submit",
		            click: function() {
		            	dialog.submit();
		            }
		        },
		        {
		            text: "Close",
		            click: function() {
		                $('#submit_modal form').hide();
		                $( this ).dialog( "close" );
		            }
		        }
        	]
		    });
		    dialog.dialog( "open" );
		    return false;
		} else {
			$('#submit_modal form').hide();
		}
		return true;
	});
});
</script>

<?php do_action( 'woocommerce_after_cart' ); ?>
