<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php
	/**
	 * woocommerce_before_single_product hook.
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>

<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="col-md-12 col-sm-12 col-xs-12">
<div class="product-box">
	<?php
		/**
		 * woocommerce_before_single_product_summary hook.
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		// do_action( 'woocommerce_before_single_product_summary' );
		woocommerce_show_product_images();
	?>

	<div class="detail-box">

		<?php
			/**
			 * woocommerce_single_product_summary hook.
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_rating - 10
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 */
			// do_action( 'woocommerce_single_product_summary' );
			woocommerce_template_single_title();
			the_content();
			global $product; 
		?>

		<?php
		$fields = get_field_objects($product->post->ID);
		if ($fields){
			$qty = 1;
			foreach( $fields as $field_name => $field )
			{
				if ($field['label'] && $field['value']) {
					if ($field['name'] == 'qty') {
						$qty = $field['value'];
					} else if ($field['name'] == 'custom_prices' || $field['name'] == 'custom_pricing') {
						continue;
					} else {
						echo '<div style="margin-bottom: 20px;">';
							echo '<h4 style="color: black;"><label style="width:50%">' . $field['label'] . ' :</label><label class="'.$field_name.'" style="width:45%; text-align: right;">' . $field['value'] . '</label></h4>';
						echo '</div>';
					}
				}
			}
			$unit_price = get_custom_price($product->post->ID);
		}
		?>
		<form class="cart" method="post" enctype="multipart/form-data">
			<div class="Price">
				<div class="Units">
					<p>Total Price: </p><h4 class="totalcost">$<?php echo number_format($unit_price * $qty, 2); ?></h4>
					<p>Units / Carton: <label class="units" style="display: inline;"><?php echo $qty; ?></label></p>
				</div>
				<div class="quantity product-quantity">
					<label>Quantity</label>
					<?php
					woocommerce_template_single_add_to_cart();
					?>
				</div>
			</div>
		</form>

		<div class="buttom-box">
			<a href="<?php echo get_home_url(); ?>" class="btn btn-default">Continue Shopping <i class="fa fa-angle-double-right"></i></a>
		</div>

	</div><!-- .summary -->

	<?php
		/**
		 * woocommerce_after_single_product_summary hook.
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		// do_action( 'woocommerce_after_single_product_summary' );
	?>

	<meta itemprop="url" content="<?php the_permalink(); ?>" />
</div>
</div>
</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>
