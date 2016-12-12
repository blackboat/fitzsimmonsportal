<?php
$id = $_GET['id'];
$link = get_permalink( $id );
$_product = wc_get_product( $id );
$image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'single-post-thumbnail' );
if (!$image) {
	$image = wc_placeholder_img_src();
} else {
	$image = $image[0];
}
//$itemcode = $_product->get_attribute( 'ItemCode' );
?>
<div class="modal-dialog" role="document">
<div class="modal-content" style="margin-top: 100px;">
  <div class="modal-body">
  <div class="product product-detail-page">
	<div class="product-detail-contain">
		<div class="product-box">
			<div class="img"><img src="<?php echo $image; ?>" /></div>
				<div class="detail-box" style="text-align: center">
					<?php
					$fields = get_field_objects($id);
					if( $fields )
					{
						foreach( $fields as $field_name => $field )
						{
							echo '<div style="margin-bottom: 20px;">';
								echo '<h4><label>' . $field['label'] . '</label>  :  ' . $field['value'] . '</h4>';
							echo '</div>';
						}
					}
					?>
					<form class="cart" method="post" enctype="multipart/form-data">
					<div class="Prices">
						<div class="quantity">
							<h3>Cartons</h3>
							<input type="number" step="1" min="1" max="" name="quantity" value="1" title="Qty" size="4" pattern="[0-9]*" inputmode="numeric" style="width: 50px;">
							<input type="hidden" name="add-to-cart" value="<?php echo $id; ?>">
						</div>
					</div>
					<div class="buttom-box text-center">
						<button type="submit" class="single_add_to_cart_button btn btn-default alt" style="margin-top: 10px;">Add to Cart</button>
						<button type="button" class="btn btn-default btn-danger" data-dismiss="modal" style="margin-top: 10px;">Cancel</button>
					</div>
					</form>
				</div>
			</div>
		</div>
  </div>
</div>
</div>
</div>

