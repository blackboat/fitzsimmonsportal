<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package dazzling
 */
?>
	<div id="secondary" class="widget-area col-sm-12 col-md-3" role="complementary">
		<?php do_action( 'before_sidebar' ); ?>
		
			<aside id="search" class="widget widget_search">
				<h1 class="widget-title"><?php _e( 'SubCategory', 'dazzling' ); ?></h1>
			<?php
			$cat = $wp_query->get_queried_object();
		 	$args = array(
		       'hierarchical' => 1,
		       'show_option_none' => '',
		       'hide_empty' => 0,
		       'parent' => $cat->term_id,
		       'taxonomy' => 'product_cat'
		    );
		  	$subcats = get_categories($args);

		    echo '<ul class="wooc_sclist">';
		      foreach ($subcats as $sc) {
		        $link = get_term_link( $sc->slug, $sc->taxonomy );
		          echo '<li><a href="'. $link .'">'.$sc->name.'</a></li>';
		      }
		    echo '</ul>';
		    ?>
		    </aside>
		
	</div><!-- #secondary -->
