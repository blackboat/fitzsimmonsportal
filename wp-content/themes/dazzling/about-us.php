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
			<p>With over 17 years’ experience in the hospitality industry, Paul Fitzsimmons has owned and operated all types of venues ranging from cafes, pubs, restaurants, nightclubs and cocktail bars.</p>
			<p>In 2016, Fitzsimmons Hospitality was established with the sole mission to optimise the procurement chain for venue operators in Australia through direct sourcing. With superior access to preferential pricing, we guarantee to provide the best price. </p>
			<p>We understand the service industry and we aim to be your provider of choice for all your hospitality supplies.</p>
				<br>
			</div>
			<div class="col-sm-6 col-xs-12">
				<img src="<?php echo get_home_url(); ?>/wp-content/uploads/2016/12/Collection Bar Image.jpeg" alt="" />
			</div>
		</div>
	</div>
	</div>

	

<?php
get_footer();
