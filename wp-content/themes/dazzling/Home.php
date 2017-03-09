<?php
/**
 * Template Name: Home Page
 *
 * @link https://codex.wordpress.org/Template_Home
 *
 * @package Dazzling
 */

get_header(); 
?>

	<div class="our-products">

	<div class="container">
		<div class="row"><div class="col-xs-12"><h2>Our Products</h2></div></div>
		<div class="row">
			<?php
			$product_categories = get_terms( 'product_cat', array('orderby' => 'id', 'parent' => 0, 'hide_empty' => 0) );
			foreach ($product_categories as $cat) {
			?>
			<div class="col-sm-4 col-xs-12">
				<div class="products-box">
					<?php
					$thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true ); 
					$link = get_term_link( $cat->term_id, 'product_cat' );
				    $image = wp_get_attachment_url( $thumbnail_id );
					?>
					<img class="img-<?php echo $cat->slug; ?>" src="<?php echo $image; ?>" alt=""/>
					<div style="width:100%;height:160px;background-color:white;"></div>
					<h3><a href="<?php echo $link; ?>"><?php echo $cat->name; ?></a></h3>
				</div>
			</div>
			<?php } ?>
			
		</div></div>
	</div>

<?php
get_footer();
