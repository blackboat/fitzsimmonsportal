<?php
/**
 * Template Name: About Us Page
 *
 * @link https://codex.wordpress.org/Template_About_Us
 *
 * @package Dazzling
 */

get_header(); 
?>

	<div class="top-title">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<header class="entry-header page-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header><!-- .entry-header -->
					<?php
						echo do_shortcode( '[breadcrumb]' ); 
					?>
				</div>
			</div>
		</div>
	</div>
	<div class="about-text">
	<div class="container">
		<div class="row">
			<br><br><br><br>
			<div class="col-sm-6 col-xs-12">
				<p>Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.</p>
				<br>
				<p>Wendisse quis malesuada ante. Donec tempor leo sit amet fringilla euismod. Aliquam condimen tum velit ut sapien dignissim, ut blandit neque fermentum. Suspendisse ante nunc, eleifend eget turpis sit amet, sodales porttitor felis. Pellentesque et lectus risus. Sed porttitor fermentum luctus. Aliquam condimen tum velit ut sapien dignissim, ut blandit neque fermentum. Suspendisse ante nunc, eleifend eget turpis sit amet, sodales porttitor felis.</p>
			</div>
			<div class="col-sm-6 col-xs-12">
				<img src="<?php echo get_home_url(); ?>/wp-content/uploads/2016/12/about-photo.jpg" alt="" />
			</div>
		</div>
	</div>
	</div>

	<div class="review-wp">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<?php echo do_shortcode('[sp_testimonials_slider slides_column="2" arrows="true" dots="false" sp_testimonials order="ASC"] '); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="partners-wp">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<h2>Our Partners</h2>
					<?php echo do_shortcode('[slick-carousel-slider slidestoshow="6" slick-carousel-slider order="ASC" autoplay="false" arrows="false"]'); ?>
				</div>
			</div>
		</div>
	</div>
	

<?php
get_footer();