<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.palmermarc.com/
 * @since      1.0.0
 *
 * @package    Twenty_Sixty_Builder_Addons
 * @subpackage Twenty_Sixty_Builder_Addons/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Twenty_Sixty_Builder_Addons
 * @subpackage Twenty_Sixty_Builder_Addons/public
 * @author     Marc <mpalmer@2060digital.com>
 */
class Twenty_Sixty_Builder_Addons_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		#wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/twenty-sixty-builder-addons-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		#wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/twenty-sixty-builder-addons-public.js', array( 'jquery' ), $this->version, false );
	}
	
	public function load_custom_beaver_builder_modules() {
		if( class_exists( 'FLBuilder' )  ) {
			self::register_faq_module();
			self::register_staff_module();
			self::register_homepage_header_module();
		} 
	}
	
	/**
	 * Register the FAQ Module inside of Beaver Builder
	 */
	public function register_faq_module() {
		require_once 'modules/faq-module/faq-module.php';
		
		$terms = get_terms( 'faq-category', array( 'hide_empty' => false,  'fields' => 'all' ) );
		$faq_categories = array();
		if( !empty( $terms ) && ! is_wp_error( $terms ) ) :
			foreach( $terms as $term ) :
				$faq_categories[$term->slug] = __( $term->name, 'fl-builder' );
			endforeach;
		endif;

		FLBuilder::register_module( 'FAQModule', 
			array(
				'general' => array(
					'title'=> __( 'Frequently Asked Questions', 'fl-builder' ),
					'sections' => array(
						'general' => array(
							'title' => __( 'Section Title', 'fl-builder' ),
							'fields' => array(
								'display_title' => array(
									'type' => 'checkbox',
									'label' => __( 'Display FAQ Category Title?', 'fl-builder' ),
									'default' => 0,
								),
								'faq_category' => array(
									'type' => 'select',
									'label' => __( 'FAQ Category to Display', 'fl-builder' ),
									'help' => 'Select any of the FAQ Categories to display. If the category is left blank, all FAQs will be pulled in on the same page',
									'default' => '',
									'options' => $faq_categories
								),
								'display_format' => array(
									'type' => 'select',
									'label' => __( 'Display Format', 'fl-builder' ),
									'default' => '',
									'help' => 'The display format alters how the page displays at load.
										<p><strong>Display All</strong> will display all of the questions by default.</p>
										<p><strong>Display First</strong> will display the first question and answer, and then hide all of the following answers. When a user clicks on a question, the answer will toggle open.</p>
										<p><strong>Hide All</strong> will display only the question, and then when a user clicks on the question the answer will toggle open.</p>',
									'options' => array(
										'display-all' => __( 'Display All', 'fl-builder' ),
										'show-first' => __( 'Hide All But First', 'fl-builder' ),
										'hide-all' => __( 'Hide All', 'fl-builder' )
									)
								),
								'list_format' => array(
									'type' => 'select',
									'label' => __( 'List Format', 'fl-builder' ),
									'default' => '',
									'options' => array(
										'dd-dt' => __( 'Theme Default', 'fl-builder' ),
										'bulleted-list' => __( 'Bulleted List', 'fl-builder' ),
										'numbered-list' => __( 'Numberd List', 'fl-builder' )
									)
								)
							)
						)
					)
				)
			)
		);
	}

	/**
	 * Register the FAQ Module inside of Beaver Builder
	 */
	public function register_homepage_header_module() {
		require_once 'modules/homepage-header-module/homepage-header-module.php';
		
		FLBuilder::register_module( 'HomepageHeaderModule', 
			array(
				'general' => array(
					'title'=> __( 'Mission Statement', 'fl-builder' ),
					'sections' => array(
						'mission-section' => array(
							'fields' => array(
								'mission_content' => array(
									'type' => 'editor',
									'media_buttons' => 'true',
									'rows' =>'15',
								),
							)
						)
					)
				),
				'tab1' => array(
					'title'=> __( 'Tab 1', 'fl-builder' ),
					'sections' => array(
						'tab1-content' => array(
							'title' => __( 'Mission Section', 'fl-builder' ),
							'fields' => array(
								'tab1_content' => array(
									'type' => 'editor',
									'media_buttons' => 'true',
									'rows' =>'10',
								),
							)
						)
					)
				),
				'tab2' => array(
					'title'=> __( 'Tab 2', 'fl-builder' ),
					'sections' => array(
						'tab2-content' => array(
							'title' => __( 'Mission Section', 'fl-builder' ),
							'fields' => array(
								'tab2_content' => array(
									'type' => 'editor',
									'media_buttons' => 'true',
									'rows' =>'10',
								),
							)
						)
					)
				),
				'tab3' => array(
					'title'=> __( 'Tab 3', 'fl-builder' ),
					'sections' => array(
						'tab3-content' => array(
							'title' => __( 'Mission Section', 'fl-builder' ),
							'fields' => array(
								'tab3_content' => array(
									'type' => 'editor',
									'media_buttons' => 'true',
									'rows' =>'10',
								),
							)
						)
					)
				),
			)
		);
	}

	/**
	 * Register the Staff Module inside of Beaver Builder
	 */
	public function register_staff_module() {
		require_once 'modules/staff-module/staff-module.php';
		
		$terms = get_terms( 'staff-position', array( 'hide_empty' => false,  'fields' => 'all' ) );
		$positions = array();
		if( !empty( $terms ) && ! is_wp_error( $terms ) ) :
			foreach( $terms as $term ) :
				$positions[$term->slug] = __( $term->name, 'fl-builder' );
			endforeach;
		endif;

		FLBuilder::register_module( 'StaffModule', 
			array(
				'general' => array(
					'title'=> __( 'Staff Members', 'fl-builder' ),
					'sections' => array(
						'general' => array(
							'title' => __( 'General Settings', 'fl-builder' ),
							'fields' => array(
								'staff_position' => array(
									'type' => 'select',
									'label' => __( 'Staff Position to Display', 'fl-builder' ),
									'help' => 'Select any of the Staff Positions to display the Staff Members of. If the Positions field is left unselected, then all staff members will be displayed.',
									'default' => '',
									'options' => $positions
								),
							)
						)
					)
				)
			)
		);
	}
	
	/**
	 * Registers the faq post type whenever the faq_module has been turned on from the Beaver Builder settings 
	 */
	public function register_faq_post_type() {

		$labels = array(
			'name'                  => _x( 'Frequently Asked Questions', 'Post Type General Name', 'fl-builder' ),
			'singular_name'         => _x( 'Frequently Asked Question', 'Post Type Singular Name', 'fl-builder' ),
			'menu_name'             => __( 'FAQ', 'fl-builder' ),
			'name_admin_bar'        => __( 'Frequently Asked Question', 'fl-builder' ),
			'parent_item_colon'     => __( 'Parent Item:', 'fl-builder' ),
			'all_items'             => __( 'All FAQs', 'fl-builder' ),
			'add_new_item'          => __( 'Add New FAQ', 'fl-builder' ),
			'add_new'               => __( 'Add New', 'fl-builder' ),
			'new_item'              => __( 'New FAQ', 'fl-builder' ),
			'edit_item'             => __( 'Edit FAQ', 'fl-builder' ),
			'update_item'           => __( 'Update FAQ', 'fl-builder' ),
			'view_item'             => __( 'View FAQ', 'fl-builder' ),
			'search_items'          => __( 'Search FAQs', 'fl-builder' ),
			'not_found'             => __( 'Not found', 'fl-builder' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'fl-builder' ),
			'items_list'            => __( 'Items list', 'fl-builder' ),
			'items_list_navigation' => __( 'Items list navigation', 'fl-builder' ),
			'filter_items_list'     => __( 'Filter items list', 'fl-builder' ),
		);
		$args = array(
			'label'                 => __( 'Frequently Asked Question', 'fl-builder' ),
			'description'           => __( 'Frequently Asked Questions', 'fl-builder' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'             => 'dashicons-editor-help',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => false,
			'can_export'            => true,
			'has_archive'           => true,		
			'exclude_from_search'   => true,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
		);
		register_post_type( 'faq', $args );
	
	}

	function register_faq_category_taxnomoy() {
	
		$labels = array(
			'name'                       => _x( 'FAQ Categories', 'Taxonomy General Name', 'fl-builder' ),
			'singular_name'              => _x( 'FAQ Category', 'Taxonomy Singular Name', 'fl-builder' ),
			'menu_name'                  => __( 'FAQ Category', 'fl-builder' ),
			'all_items'                  => __( 'All FAQ Categories', 'fl-builder' ),
			'parent_item'                => __( 'Parent FAQ Category', 'fl-builder' ),
			'parent_item_colon'          => __( 'Parent FAQ Category:', 'fl-builder' ),
			'new_item_name'              => __( 'New FAQ Category Name', 'fl-builder' ),
			'add_new_item'               => __( 'Add New FAQ Category', 'fl-builder' ),
			'edit_item'                  => __( 'Edit FAQ Category', 'fl-builder' ),
			'update_item'                => __( 'Update FAQ Category', 'fl-builder' ),
			'view_item'                  => __( 'View FAQ Category', 'fl-builder' ),
			'separate_items_with_commas' => __( 'Separate with commas', 'fl-builder' ),
			'add_or_remove_items'        => __( 'Add or remove faq categories', 'fl-builder' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'fl-builder' ),
			'popular_items'              => __( 'Popular FAQ Categories', 'fl-builder' ),
			'search_items'               => __( 'Search FAQ Categories', 'fl-builder' ),
			'not_found'                  => __( 'Not Found', 'fl-builder' ),
			'items_list'                 => __( 'FAQ Categories list', 'fl-builder' ),
			'items_list_navigation'      => __( 'FAQ Categories list navigation', 'fl-builder' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => false,
			'show_tagcloud'              => false,
		);
		register_taxonomy( 'faq-category', array( 'faq' ), $args );
	
	}
	
	public function fl_checkbox_field( $name, $value, $field ) {
		$is_checked = checked( 1, $value, false );
		echo "<input type='hidden' name='{$name}' value='0' />";
		echo "<input {$is_checked} type='checkbox' name='{$name}' value='1' />";
	}
	
	public function register_staff_post_type() {
	
		$labels = array(
			'name'                  => _x( 'Staff Members', 'Post Type General Name', 'fl-builder' ),
			'singular_name'         => _x( 'Staff Members', 'Post Type Singular Name', 'fl-builder' ),
			'menu_name'             => __( 'Staff Members', 'fl-builder' ),
			'name_admin_bar'        => __( 'Staff Member', 'fl-builder' ),
			'archives'              => __( 'Staff Member Archives', 'fl-builder' ),
			'parent_item_colon'     => __( 'Parent Staff Member:', 'fl-builder' ),
			'all_items'             => __( 'All Staff Members', 'fl-builder' ),
			'add_new_item'          => __( 'Add New Staff Member', 'fl-builder' ),
			'add_new'               => __( 'Add New', 'fl-builder' ),
			'new_item'              => __( 'New Staff Member', 'fl-builder' ),
			'edit_item'             => __( 'Edit Staff Member', 'fl-builder' ),
			'update_item'           => __( 'Update Staff Member', 'fl-builder' ),
			'view_item'             => __( 'View Staff Member', 'fl-builder' ),
			'search_items'          => __( 'Search Staff Member', 'fl-builder' ),
			'not_found'             => __( 'Not found', 'fl-builder' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'fl-builder' ),
			'featured_image'        => __( 'Featured Image', 'fl-builder' ),
			'set_featured_image'    => __( 'Set featured image', 'fl-builder' ),
			'remove_featured_image' => __( 'Remove featured image', 'fl-builder' ),
			'use_featured_image'    => __( 'Use as featured image', 'fl-builder' ),
			'insert_into_item'      => __( 'Insert into staff member', 'fl-builder' ),
			'uploaded_to_this_item' => __( 'Uploaded to this staff member', 'fl-builder' ),
			'items_list'            => __( 'Staff Members list', 'fl-builder' ),
			'items_list_navigation' => __( 'Staff Members list navigation', 'fl-builder' ),
			'filter_items_list'     => __( 'Filter staff members list', 'fl-builder' ),
		);
		$args = array(
			'label'                 => __( 'Staff Members', 'fl-builder' ),
			'description'           => __( 'Staff members', 'fl-builder' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'thumbnail', 'page-attributes', ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'             => 'dashicons-groups',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,		
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
		);
		register_post_type( 'staff', $args );
	
	}
	
	public function register_staff_position_taxonomy() {
	
		$labels = array(
			'name'                       => _x( 'Positions', 'Taxonomy General Name', 'fl-builder' ),
			'singular_name'              => _x( 'Position', 'Taxonomy Singular Name', 'fl-builder' ),
			'menu_name'                  => __( 'Staff Position', 'fl-builder' ),
			'all_items'                  => __( 'All Staff Positions', 'fl-builder' ),
			'parent_item'                => __( 'Parent Staff Position', 'fl-builder' ),
			'parent_item_colon'          => __( 'Parent Staff Position:', 'fl-builder' ),
			'new_item_name'              => __( 'New Staff Position Name', 'fl-builder' ),
			'add_new_item'               => __( 'Add New Staff Position', 'fl-builder' ),
			'edit_item'                  => __( 'Edit Staff Position', 'fl-builder' ),
			'update_item'                => __( 'Update Staff Position', 'fl-builder' ),
			'view_item'                  => __( 'View Staff Position', 'fl-builder' ),
			'separate_items_with_commas' => __( 'Separate staff positions with commas', 'fl-builder' ),
			'add_or_remove_items'        => __( 'Add or remove staff positions', 'fl-builder' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'fl-builder' ),
			'popular_items'              => __( 'Popular Staff Positions', 'fl-builder' ),
			'search_items'               => __( 'Search Staff Positions', 'fl-builder' ),
			'not_found'                  => __( 'Not Found', 'fl-builder' ),
			'no_terms'                   => __( 'No staff positions', 'fl-builder' ),
			'items_list'                 => __( 'Staff Positions list', 'fl-builder' ),
			'items_list_navigation'      => __( 'Staff Positions list navigation', 'fl-builder' ),
		);
		
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
		);
		
		register_taxonomy( 'staff-position', array( 'staff' ), $args );
	}
	
}
