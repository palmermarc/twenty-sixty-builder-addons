<?php

class HomepageHeaderModule extends FLBuilderModule {
	
	public function __construct() {
		
		parent::__construct(
			array(
				'name' => __( 'Homepage Mission Statement', 'fl-builder' ),
				'description' => __( 'Custom homepage header section for STL Gastro', 'fl-builder' ),
				'category' => __( 'Advanced Modules', 'fl-builder' ),
				'dir' => plugin_dir_path( __FILE__ ),
				'url' => plugins_url( '/', __FILE__ ),
				'editor_export' => TRUE,
				'enabled' => true
			)
		);
	}
}