<?php
/**
 * This file is a work in progress as I try to decide the absolute best way to supply this 
 * information to the front-end. The goal I would like to accomplish is to have this file
 * overwritten by the theme in a more developer-friendly way
 * 
 * @since	1.0.4 
 */

echo "<div id='twenty-sixty-products-module-{$id}' class='products-list'>";
	
	$product_args = array(
		'post_type' => 'product',
		'posts_per_page' => '-1',
	);
	
	if( '' !==  $settings->product_category ) {
		$product_args['tax_query'] = array(
			array(
				'taxonomy' => 'product_category',
				'field' => 'slug',
				'terms' => $settings->product_category
			)
		);
	}
	
	$products = new WP_Query( $product_args );
	if( $products->have_posts() ):
		
		while( $products->have_posts() ):
			$products->the_post();
			
			echo '<div class="individual-product">';

				if( has_post_thumbnail() ) 
					the_post_thumbnail( 'medium', array( 'class' => 'alignleft product-featured-image' ) );
								
				echo '<h3 class="product-name">' . get_the_title() . '</h3>';
				echo '<h5 class="product-description">' . get_the_exerpt() . '</h5>';
			echo '</div>';
		endwhile;
		
	endif;
	
echo '</div>';

wp_reset_postdata();