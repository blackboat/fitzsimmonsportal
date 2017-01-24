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

						<li><a href="<?php echo get_home_url(); ?>/order-history/">Order History</a></li>

						<li class="header-cart"><a href="<?php echo get_home_url(); ?>/cart/">Shopping Cart</a></li>

						<?php if (!is_user_logged_in()): ?>
						<li><a href="<?php echo get_home_url(); ?>/login/">Login</a></li>
						<?php endif; ?>

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

						<a href="<?php echo get_home_url(); ?>"><img src="<?php echo get_home_url(); ?>/wp-content/uploads/2016/12/logo.png" alt="" /></a>

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

					<?php if (is_user_logged_in()) : 
						$current_user = wp_get_current_user();
					?>
					<li>

						<div class="uese-info">

							<?php

                                $user_id = get_the_author_meta('ID');
                                mt_profile_img( $user_id, array(
                                        'size' => 'thumbnail',
                                        'attr' => array( 'alt' => 'Alternative Text' ),
                                        'echo' => true )
                                );

                            ?>

							<div class="dropdown">

							  <a class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><?php echo $current_user->user_firstname . ' ' . $current_user->user_lastname; ?>

							    <span class="caret"></span>

							  </a>

							  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">

							    <!-- <li><a href="#">Action</a></li> -->
                                <li><a href="<?php echo get_page_link( get_page_by_path( 'user-profile' )->ID ); ?>">My Profile</a></li>

							    <li><a href="<?php echo wp_logout_url(home_url()); ?>">Logout</a></li>

							  </ul>

							</div>

						</div>

					</li>
					<?php endif; ?>

					<li>
<!-- <form id="search" action="" method="post">
<div id="input"><input type="text" name="s" id="search-terms" placeholder="Enter search terms..."><button type="submit"><img src="<?php echo get_home_url(); ?>/wp-content/uploads/2016/12/search-icon.png" alt=""/></button></div>
<!--<a class="search-box"><img src="<?php echo get_home_url(); ?>/wp-content/uploads/2016/12/search-icon.png" alt=""/></a>

</form> -->
<a class="search-box"><img src="<?php echo get_home_url(); ?>/wp-content/uploads/2016/12/search-icon.png" alt=""/></a>
</li>
<li class="daz_top_search"><?php echo do_shortcode('[aws_search_form]'); ?></li>

				</ul>

			

		</div>

		</div>

		</div>

	</nav><!-- .site-navigation -->





 <div class="top-section">

		<?php dazzling_featured_slider(); ?>

		<?php dazzling_call_for_action(); ?>

        </div>



