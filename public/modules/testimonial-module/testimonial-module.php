<?php

class TestimonialModule extends FLBuilderModule {
	
	public function __construct() {
		
		parent::__construct(
			array(
				'name' => __( 'Testimonials', 'fl-builder' ),
				'description' => __( 'Add any testimonial to a page or post!', 'fl-builder' ),
				'category' => __( 'Advanced Modules', 'fl-builder' ),
				'dir' => plugin_dir_path( __FILE__ ),
				'url' => plugins_url( '/', __FILE__ ),
				'editor_export' => TRUE,
				'enabled' => true
			)
		);
	}
}