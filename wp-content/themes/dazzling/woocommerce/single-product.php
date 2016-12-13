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
					<?php get_sidebar('cat'); ?>
				</div>
			</div>
		</div>
	</div>
<?php get_footer(); ?>
