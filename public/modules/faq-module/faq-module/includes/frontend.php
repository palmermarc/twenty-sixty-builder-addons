<?php

echo "<div id='faq-module-{$id}' class='frequently-asked-questions {$settings->list_format} {$settings->display_format}'>";
	$faq_args = array(
		'post_type' => 'faq',
		'posts_per_page' => '-1',
	);
	
	if( '' !==  $settings->faq_category ) {
		$faq_args['tax_query'] = array(
			array(
				'taxonomy' => 'faq-category',
				'field' => 'slug',
				'terms' => $settings->faq_category
			)
		);
	}
	
	$faqs = new WP_Query( $faq_args );
	if( $faqs->have_posts() ):
		
		if( '' !== $settings->faq_category && $settings->display_title ) :
			$term_title = get_term_by( 'slug', $settings->faq_category, 'faq-category' );
			if( !empty( $term_title->name ) && !is_wp_error( $term_title->name ) )
				echo "<h3>" . $term_title->name . "</h3>";
		
		endif;
		
		if( 'numbered-list' == $settings->list_format ):
			echo '<ol>';
		elseif( 'bulleted-list' == $settings->list_format ):
			echo '<ul>';
		endif;
		
		while( $faqs->have_posts() ):
			$faqs->the_post();
			$faq_question = get_the_title();
			$faq_answer = apply_filters( 'the_content', get_the_content() );
			
			switch( $settings->list_format ) {
				case 'dd-dt':
					echo "<div class='faq-bin'>";
					echo "	<dt class='faq-question'>{$faq_question}</dt>";
					echo "	<dd class='faq-answer'>{$faq_answer}</dd>";
					echo"</div>";
					break;
				default:
					echo "<li class='faq-bin'>";
					echo "	<dt class='faq-question'>{$faq_question}</dt>";
					echo "	<dd class='faq-answer'>{$faq_answer}</dd>";
					echo "</li>";
			}
		endwhile;
		
		if( 'numbered-list' == $settings->list_format ) :
			echo '</ol>';
		elseif( 'bulleted-list' == $settings->list_format ) :
			echo '</ul>';
		endif;
		
	endif;
	
echo '</div>';

wp_reset_postdata();
