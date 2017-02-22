<?php

/**
 * Woocommerce Lighbox by WpBean
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 


add_action( 'woocommerce_after_shop_loop_item','wpb_wl_hook_quickview_link', 11 );

function wpb_wl_hook_quickview_link(){
	echo '<div class="wpb_wl_preview_area"><a class="wpb_wl_preview open-popup-link" href="#wpb_wl_quick_view_'.get_the_id().'" data-effect="mfp-zoom-in">'.__( 'Quick View','woocommerce-lightbox' ).'</a></div>';
}


add_action( 'woocommerce_after_shop_loop_item','wpb_wl_hook_quickview_content' );

function wpb_wl_hook_quickview_content(){
	global $post, $woocommerce, $product;
	?>
	<div id="wpb_wl_quick_view_<?php echo get_the_id(); ?>" class="mfp-hide mfp-with-anim wpb_wl_quick_view_content wpb_wl_clearfix">
		<div class="wpb_wl_images">
			<?php
				if ( has_post_thumbnail() ) {

				$image_title = esc_attr( get_the_title( get_post_thumbnail_id() ) );
				$image_link  = wp_get_attachment_url( get_post_thumbnail_id() );
				$image       = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
					'title' => $image_title
					) );

				$attachment_count = count( $product->get_gallery_attachment_ids() );

				if ( $attachment_count > 0 ) {
					$gallery = '[product-gallery]';
				} else {
					$gallery = '';
				}

				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a>', $image_link, $image_title, $image ), $post->ID );

				} else {

				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce-lightbox' ) ), $post->ID );

				}
			?>
		</div>
		<div class="wpb_wl_summary">
			<!-- Product Title -->
			<h2 class="wpb_wl_product_title"><?php the_title();?></h2>

			<?php
			$id = $product->post->ID;
			$fields = get_field_objects($id);
			if( $fields )
			{
				foreach( $fields as $field_name => $field )
				{
					if ($field['label'] && $field['value']) {
						if ($field['name'] == 'unit_price' || $field['name'] == 'custom_pricing' || $field['name'] == 'custom_prices') {
							continue;
						} else {
							echo '<div style="margin-bottom: 20px;">';
								echo '<h4 style="color: black;"><label style="width:50%">' . $field['label'] . ' :</label><label style="width:45%; text-align: right;">' . $field['value'] . '</label></h4>';
							echo '</div>';
						}
					}
				}
				$qty = get_field_object('qty', $id)['value'];
				$unit_price = get_custom_price($id);
			}
			?>

			<!-- Product cart link -->
			<?php //woocommerce_template_single_add_to_cart();?>
			<form class="cart" method="post" enctype="multipart/form-data">
				<div class="Prices">
					<div class="Units">
						<h5 style="font-size:22px;">Cost per Unit: $<label class="cost"><?php echo number_format($unit_price, 2); ?></label></h5>
						<p style="display:none;">Units / Carton: <label class="units"><?php echo $qty; ?></label></p>
						<h4 class="total_cost_heading">Total Carton Cost: $<label class="totalcost"><?php echo number_format($unit_price * $qty, 2); ?></label></h4>
					</div>
					<div class="quantity product-quantity">
						<label>Cartons</label>
						<div class="ordered-box">
						<input class="qty form-control" type="number" name="quantity" value="1" title="Qty" size="4" pattern="[0-9]*" inputmode="numeric" style="width: 50px; margin: 0 !important;">
						</div>
						<input type="hidden" name="add-to-cart" value="<?php echo $id; ?>">
					</div>
				</div>
				<div class="buttom-box text-center">
					<button type="submit" class="single_add_to_cart_button btn btn-default alt" style="margin-top: 10px; float:left; font-size: 17px;">Add to Cart</button>
					<button type="button" class="btn btn-default btn-danger mfp-close" style="margin-top: 10px; float:right; position:static; font-size: 17px;">Cancel</button>
				</div>
			</form>

		</div>
	</div>
	<?php
}
