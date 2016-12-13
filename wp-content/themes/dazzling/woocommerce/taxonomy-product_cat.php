<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
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
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

	<div class="top-title">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<header class="entry-header page-header">
						<h1 class="entry-title"><?php echo $wp_query->get_queried_object()->name; ?></h1>
					</header><!-- .entry-header -->
					
					<div class="breadcrumb-container theme1" itemprop="breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList">
						<?php
							$args = array(
									'delimiter' => '<span class="separator">»</span>'
							);
						?>
						<?php woocommerce_breadcrumb( $args ); ?>
					</div>

				</div>
			</div>
		</div>
	</div>

	<div class="content-boxs">
        <div id="content" class="site-content container">

            <div class="container main-content-area">
                <div class="row side-pull-right">
					<div id="primary" class="content-area col-sm-12 col-md-9">
						<main id="main" class="site-main" role="main">

								<?php $cat_slug = $wp_query->get_queried_object()->slug; ?>
								<div class="product">
									<?php
									$args = array( 'post_type' => 'product', 'post_status' => 'publish', 'product_cat' => $cat_slug, 'order' => 'ASC');
									$loop = new WP_Query( $args );
									$idx = 0;
									while ( $loop->have_posts() ) : $loop->the_post(); ?>
										<?php
										global $product;
										$pid = $product->post->ID;
										$link = get_permalink( $pid );
										$image = wp_get_attachment_image_src( get_post_thumbnail_id( $pid ), 'single-post-thumbnail' );
										if (!$image) {
											$image = wc_placeholder_img_src();
										} else {
											$image = $image[0];
										}
										$width = $product->get_attribute( 'Width' );
										$length = $product->get_attribute( 'Length' );
										$height = $product->get_attribute( 'Height/Depth' );
										$itemcode = $product->get_attribute( 'ItemCode' );
										$capacity = $product->get_attribute( 'Capacity' );
										?>
										<?php
										if ($idx % 3 == 0) {
											echo '<div class="row">';
										}
										?>
										<div class="col-md-4 col-sm-6 col-xs-12">
											<div class="product-box">
												<div class="img"><button type="button" class="btn btn-primary btn-lg product-thumb" style="background: transparent;" data-id="<?php echo $pid; ?>" data-toggle="modal" data-target="#myModal"><img src="<?php echo $image; ?>" /></button></div>
												<div class="detail-box">
													<h5><?php echo $product->get_title(); ?></h5>
													<?php
													$fields = get_field_objects($id);
													$qty = 1;
													if( $fields )
													{
														echo '<div class="stock-detail">';
														foreach( $fields as $field_name => $field )
														{
															if ($field['label'] && $field['value']) {
																if ($field['name'] == 'qty') {
																	$qty = $field['value'];
																}
																echo '<label>'.$field['label'].': '.'</label>';
															}
															echo '<label>Price per Unit:</label>';
														}
														echo '</div>';
														echo '<div class="stock-detail stock-right">';
														foreach( $fields as $field_name => $field )
														{
															if ($field['label'] && $field['value']) {
																echo '<label>'.$field['value'].'</label>';
															}
															echo '<label>'.$product->get_price().'</label>';
														}
														echo '</div>';
													}
													?>
												
													<div class="button-box">
														<h4 class="prig-title">$<?php echo $qty * $product->get_price(); ?></h4><a href="" class="btn btn-default product-thumb" data-id="<?php echo $pid; ?>" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Add To Cart</a>
													</div>
												</div>
											</div>
										</div>
										<?php
										if ($idx % 3 == 2) {
											echo '</div>';
										}
										$idx += 1;
										?>
									<?php endwhile; ?>
									<?php wp_reset_query(); ?>
									
								</div>
								<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"></div>

						</main><!-- #main -->
					</div><!-- #primary -->

					<script type="text/javascript">
					jQuery(function($){
			         	$('.product-thumb').click(function(ev){
			             	ev.preventDefault();
							var uid = $(this).data('id');
							$.get('/restore/product-modal?id=' + uid, function(html){
								$('#myModal').html(html);
								$('#myModal').modal('show', {backdrop: 'static'});
							});
				         });
				    });
					</script>
					<?php get_sidebar('cat'); ?>
	
<?php get_footer( 'shop' ); ?>
