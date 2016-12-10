<?php
$id = $_GET['id'];
$link = get_permalink( $id );
$_product = wc_get_product( $id );
$image = wp_get_attachment_image_src( get_post_thumbnail_id( $pid ), 'single-post-thumbnail' );
if (!$image) {
	$image = wc_placeholder_img_src();
} else {
	$image = $image[0];
}
$itemcode = $_product->get_attribute( 'ItemCode' );
?>
<div class="modal-dialog" role="document">
<div class="modal-content">  
  <div class="modal-body">
  <div class="product product-detail-page">
	<div class="product-detail-contain">
		<div class="product-box">
			<div class="img"><img src="http://fitzsimmonsportal.com.au/restore/wp-content/uploads/2016/12/product-7.jpg" /></div>
				<div class="detail-box">
					<h3><?php echo $_product->get_title(); ?></h3>
					<p><label>Item Code: <span><?php echo $itemcode; ?></span></label><p>
					<p><?php echo $_product->post->post_content; ?></p>
					<div class="Prices">
						<div class="Units">
							<h4>$<?php echo $_product->get_price(); ?></h4>
							<p>Units / Carton 12</p>
						</div>
						<div class="quantity">
							<label>Quantity</label>
							<input type="text" class="form-control" id="exampleInputtext" placeholder="02">
						</div>
					</div>
					<div class="buttom-box text-center">
						<a href="<?php echo $link; ?>" class="btn btn-info">Purchase</a>
					</div>
				</div>
			</div>
		</div>
  </div>
</div>
</div>
</div>