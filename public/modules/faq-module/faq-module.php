<?php

class FAQModule extends FLBuilderModule {
	
	public function __construct() {
		
		parent::__construct(
			array(
				'name' => __( 'Frequently Asked Questions', 'fl-builder' ),
				'description' => __( 'Add your FAQs to any page or post!', 'fl-builder' ),
				'category' => __( 'Advanced Modules', 'fl-builder' ),
				'dir' => plugin_dir_path( __FILE__ ),
				'url' => plugins_url( '/', __FILE__ ),
				'editor_export' => TRUE,
				'enabled' => true
			)
		);
		
		/**
		 * This was left in to serve as a reminder. Beaver Builder automatically enqueues
		 * the /js/frontend.js and css/frontend.css files, so there is no reason to add this at all.
		 */
		#$this->add_css( 'faq-module', $this->url . 'css/frontend.css' );
		#$this->add_js( 'faq-module', $this->url .'js/frontend.js', array( 'jquery' ), '', TRUE );
	}
}