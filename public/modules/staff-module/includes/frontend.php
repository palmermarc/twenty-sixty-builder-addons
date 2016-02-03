<?php

echo "<div id='staff-module-{$id}' class='staff-list'>";
	$staff_args = array(
		'post_type' => 'staff',
		'posts_per_page' => '-1',
	);
	
	if( '' !==  $settings->staff_position ) {
		$staff_args['tax_query'] = array(
			array(
				'taxonomy' => 'staff-position',
				'field' => 'slug',
				'terms' => $settings->staff_position
			)
		);
	}
	
	$staff_members = new WP_Query( $staff_args );
	if( $staff_members->have_posts() ):
		
		while( $staff_members->have_posts() ):
			$staff_members->the_post();
			?>
			<div class="staff-member-name">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</div>
			<?php 
			if ( has_post_thumbnail() ) {
				echo "<div class='staff-member-image'>"; 
					the_post_thumbnail();
				echo "</div>";
			} 
			?>
			<div class="staff-member-image">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</div>
			<div class="staff-member-bio">
				<?php the_excerpt(); ?>
			</div>
			<?php
		endwhile;
		
	endif;
	
echo '</div>';

wp_reset_postdata();