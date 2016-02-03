<?php

class StaffModule extends FLBuilderModule {
	
	public function __construct() {
		
		parent::__construct(
			array(
				'name' => __( 'Meet TheStaff', 'fl-builder' ),
				'description' => __( 'Add your staff to to any page or post!', 'fl-builder' ),
				'category' => __( 'Advanced Modules', 'fl-builder' ),
				'dir' => plugin_dir_path( __FILE__ ),
				'url' => plugins_url( '/', __FILE__ ),
				'editor_export' => TRUE,
				'enabled' => true
			)
		);
	}
}