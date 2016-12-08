<?php

/**

 * The Header for our theme.

 *

 * Displays all of the <head> section and everything up till <div id="content">

 *

 * @package dazzling

 */

?><!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>

<meta charset="<?php bloginfo( 'charset' ); ?>">

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="profile" href="http://gmpg.org/xfn/11">

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<link href="https://fonts.googleapis.com/css?family=Cairo:200,300,400,600,700,900" rel="stylesheet">

<link href="https://fonts.googleapis.com/css?family=Cairo:200,300,400,600,700,900|Heebo:100,300,500,700,800,900" rel="stylesheet"> 



<?php wp_head(); ?>



</head>



<body <?php body_class(); ?>>

<div id="page" class="hfeed site">

	<div class="navbar-top">

		<div class="container">

			<div class="row">

				<div class="col-md-12">

					<ul>

						<li><a href="http://fitzsimmonsportal.com.au/restore/message/">Message</a></li>

						<li><a href="http://fitzsimmonsportal.com.au/restore/order-history/">Order History</a></li>

						<li><a href="http://fitzsimmonsportal.com.au/restore/shoping-cart/">Shopping Cart</a></li>

						<li><a href="http://fitzsimmonsportal.com.au/restore/login/">Login</a></li>

					</ul>

				</div>

			</div>

		</div>

	</div>

	



	<nav class="navbar navbar-default" role="navigation">

		<div class="container">

			<div class="row">

			<div class="col-sm-8 col-xs-12">

			<div class="navbar-header">

			  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">

			    <span class="sr-only"><?php _e( 'Toggle navigation', 'dazzling' ); ?></span>

			    <span class="icon-bar"></span>

			    <span class="icon-bar"></span>

			    <span class="icon-bar"></span>

			  </button>

				<?php if( get_header_image() != '' ) : ?>

					

					<div id="logo">

						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php header_image(); ?>"  height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="<?php bloginfo( 'name' ); ?>"/></a>

					</div><!-- end of #logo -->



				<?php endif; // header image was removed ?>



				<?php if( !get_header_image() ) : ?>

					

					<div id="logo">

						<span class="site-title"><a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>

						<a href="http://fitzsimmonsportal.com.au/restore/"><img src="http://fitzsimmonsportal.com.au/restore/wp-content/uploads/2016/12/logo.png" alt="" /></a>

					</div><!-- end of #logo -->

            <?php $description = get_bloginfo( 'description', 'display' );

            if ( $description || is_customize_preview() ) : ?>

                    <p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>

            <?php

            endif; ?>



				<?php endif; // header image was removed (again) ?>



			</div>

				<?php dazzling_header_menu(); ?>



		</div>

				<div class="col-sm-4 col-xs-12">

				<ul class="right-part">

					<li>

						<div class="uese-info">

							<img src="http://fitzsimmonsportal.com.au/restore/wp-content/uploads/2016/12/user.png" alt="" />

							<div class="dropdown">

							  <a class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">JOhn Doe

							    <span class="caret"></span>

							  </a>

							  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">

							    <li><a href="#">Action</a></li>

							    <li><a href="#">Another action</a></li>

							  </ul>

							</div>

						</div>

					</li>

					<li><a class="btn btn-default btn-venue" href="#">Venue</a></li>

					<li><a class="search-box"><img src="http://fitzsimmonsportal.com.au/restore/wp-content/uploads/2016/12/search-icon.png" alt=""/></a></li>

				</ul>

			

		</div>

		</div>

		</div>

	</nav><!-- .site-navigation -->





 <div class="top-section">

		<?php dazzling_featured_slider(); ?>

		<?php dazzling_call_for_action(); ?>

        </div>



