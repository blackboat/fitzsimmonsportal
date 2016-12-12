<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
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

get_header(); ?>
	<div class="top-title">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<header class="entry-header page-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>
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
							<div class="entry-content">
							<div class="product product-detail-page">
								&nbsp;
								&nbsp;
								<div class="row product-detail-contain">

								<?php while ( have_posts() ) : the_post(); ?>

									<?php wc_get_template_part( 'content', 'single-product' ); ?>

								<?php endwhile; // end of the loop. ?>

								</div>
							</div>
							</div>
						</main>
					</div>
					<?php get_sidebar('left'); ?>
				</div>
			</div>
		</div>
	</div>
<?php get_footer(); ?>

<!-- 
<div class="product product-detail-page">
<div class="row product-detail-contain">
<div class="col-md-12 col-sm-12 col-xs-12">
<div class="product-box">
<div class="img"><img src="http://fitzsimmonsportal.com.au/restore/wp-content/uploads/2016/12/product-detail.jpg" /></div>
<div class="detail-box">
<h3>Product Name</h3>
Sed ut perspiciatis unde omnis iste natus errorsit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae abillo inventore veritatiset quasi architecto beatae vitae dicta sunt explicabo nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit.
<div class="Price">
<div class="Units"><label>Price</label>
<h4>$54.76</h4>
Units / Carton 12

</div>
<div class="quantity"><label>Quantity</label>
<input id="exampleInputtext" class="form-control" type="text" placeholder="02" />Cartons

<a class="btn btn-default" href="#">Purchase</a>

</div>
</div>
<div class="buttom-box"><a class="btn btn-default" href="#">Continue Shopping <i class="fa fa-angle-double-right"></i></a></div>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<h3 class="title-product">Related Products</h3>
</div>
</div>
<div class="row">
<div class="col-md-4 col-sm-6 col-xs-12">
<div class="product-box">
<div class="img"><img src="http://fitzsimmonsportal.com.au/restore/wp-content/uploads/2016/12/product-4.jpg" /></div>
<div class="detail-box">
<h5>Product Name</h5>
Lorem ipsum dolor sitame consectetur adipiscing elit...
<div class="stock-detail"><label>Width: 340</label><label>Length: 66</label><label>Height/Depth: 425</label></div>
<div class="stock-detail stock-right"><label>Item Code: 2615</label><label>Capacity: 10ml</label><label class="instock">In Stock</label></div>
<div class="button-box">
<h4 class="prig-title">$54.76</h4>
<a class="btn btn-default" href="#"><i class="fa fa-plus"></i> Add To Cart</a>

</div>
</div>
</div>
</div>
<div class="col-md-4 col-sm-6 col-xs-12">
<div class="product-box">
<div class="img"><img src="http://fitzsimmonsportal.com.au/restore/wp-content/uploads/2016/12/product-5.jpg" /></div>
<div class="detail-box">
<h5>Product Name</h5>
Lorem ipsum dolor sitame consectetur adipiscing elit...
<div class="stock-detail"><label>Width: 340</label><label>Length: 66</label><label>Height/Depth: 425</label></div>
<div class="stock-detail stock-right"><label>Item Code: 2615</label><label>Capacity: 10ml</label><label class="instock">In Stock</label></div>
<div class="button-box">
<h4 class="prig-title">$54.76</h4>
<a class="btn btn-default" href="#"><i class="fa fa-plus"></i> Add To Cart</a>

</div>
</div>
</div>
</div>
<div class="col-md-4 col-sm-6 col-xs-12">
<div class="product-box">
<div class="img"><img src="http://fitzsimmonsportal.com.au/restore/wp-content/uploads/2016/12/product-6.jpg" /></div>
<div class="detail-box">
<h5>Product Name</h5>
Lorem ipsum dolor sitame consectetur adipiscing elit...
<div class="stock-detail"><label>Width: 340</label><label>Length: 66</label><label>Height/Depth: 425</label></div>
<div class="stock-detail stock-right"><label>Item Code: 2615</label><label>Capacity: 10ml</label><label class="instock">In Stock</label></div>
<div class="button-box">
<h4 class="prig-title">$54.76</h4>
<a class="btn btn-default" href="#"><i class="fa fa-plus"></i> Add To Cart</a>

</div>
</div>
</div>
</div>
</div>
</div> -->