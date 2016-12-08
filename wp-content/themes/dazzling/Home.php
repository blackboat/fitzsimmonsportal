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
		<div class="col-sm-4 col-xs-12">
			<div class="products-box">
				<img src="http://fitzsimmonsportal.com.au/restore/wp-content/uploads/2016/12/products-1.jpg" alt=""/>
				<h3><a href="#">Tableware</a></h3>
			</div>
		</div>
		<div class="col-sm-4 col-xs-12">
			<div class="products-box">
				<img src="http://fitzsimmonsportal.com.au/restore/wp-content/uploads/2016/12/products-2.jpg" alt=""/>
				<h3><a href="#">Cutlery</a></h3>
			</div>
		</div>
		<div class="col-sm-4 col-xs-12">
			<div class="products-box">
				<img src="http://fitzsimmonsportal.com.au/restore/wp-content/uploads/2016/12/products-3.jpg" alt=""/>
				<h3><a href="#">Drinkware</a></h3>
			</div>
		</div>
		<div class="col-sm-4 col-xs-12">
			<div class="products-box">
				<img src="http://fitzsimmonsportal.com.au/restore/wp-content/uploads/2016/12/products-4.jpg" alt=""/>
				<h3><a href="#">Barware</a></h3>
			</div>
		</div>
		<div class="col-sm-4 col-xs-12">
			<div class="products-box">
				<img src="http://fitzsimmonsportal.com.au/restore/wp-content/uploads/2016/12/products-5.jpg" alt=""/>
				<h3><a href="#">Kitchenware</a></h3>
			</div>
		</div>
		<div class="col-sm-4 col-xs-12">
			<div class="products-box all-products">
				<img src="http://fitzsimmonsportal.com.au/restore/wp-content/uploads/2016/12/products-6.jpg" alt=""/>
				<h3><a href="#">Access All Products</a></h3>
			</div></div></div></div>
	</div>

<?php
get_footer();