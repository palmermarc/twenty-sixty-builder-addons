<?php
echo "<div id='testiminoals-{$id}' class='testimonial-list'>";
	$testimonial_args = array(
		'post_type' => 'testimonial',
	);
	
	$testimonials_per_page = $settings->testimonials_to_display;
	
	// If someone tried to sneak in something that doesn't belong here, set it to 10
	if( intval( $settings->testimonials_to_display ) != $settings->testimonials_to_display )
		$testimonials_per_page = 10;
	
	$testimonial_args['posts_per_page'] = $testimonials_per_page;
	
	if( '' !==  $settings->testimonial_category ) {
		$testimonial_args['tax_query'] = array(
			array(
				'taxonomy' => 'testimonial_category',
				'field' => 'slug',
				'terms' => $settings->testimonial_category
			)
		);
	}
	
	
	$testimonials = new WP_Query( $staff_args );
	if( $testimonials->have_posts() ):
		
		while( $testimonials->have_posts() ):
			$testimonials->the_post();
			?>
			<div class="testimonial">
				<?php the_content(); ?>
			</div>
			<?php
		endwhile;
		
	endif;
	
echo '</div>';
wp_reset_postdata();