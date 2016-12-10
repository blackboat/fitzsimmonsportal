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
	<div class="home-slider">
		<?php echo do_shortcode('[wonderplugin_slider id=1]'); ?>
	</div>

	<div class="our-products">

	<div class="container">
		<div class="row"><div class="col-xs-12"><h2>Our Products</h2></div></div>
		<div class="row">
			<?php
			$product_categories = get_terms( 'product_cat', array('orderby' => 'id', 'parent' => 0) );
			foreach ($product_categories as $cat) {
			?>
			<div class="col-sm-4 col-xs-12">
				<div class="products-box">
					<?php
					$thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true ); 
					$link = get_term_link( $cat->term_id, 'product_cat' );
				    $image = wp_get_attachment_url( $thumbnail_id );
					?>
					<img src="<?php echo $image; ?>" alt=""/>
					<h3><a href="<?php echo $link; ?>"><?php echo $cat->name; ?></a></h3>
				</div>
			</div>
			<?php } ?>
			
			<div class="col-sm-4 col-xs-12">
				<div class="products-box all-products">
					<img src="<?php echo get_home_url(); ?>/wp-content/uploads/2016/12/products-6.jpg" alt=""/>
					<h3><a href="#">Access All Products</a></h3>
				</div>
			</div>
		</div></div>
	</div>

<?php
get_footer();