<?php

namespace WpSpecialOfferPostTypePlugin\CustomFields;

class LocationTaxonomy {

	public function init()
	{
		add_action('init', array ($this, 'register_custom_taxonomy'));
		add_filter('timber_context', array ($this, 'add_special_offer_location_to_context'), 10, 3);
		add_filter('admin_menu', array ($this, 'remove_special_offer_location_box'), 10, 1);
		add_filter('init', array ($this, 'add_nice_special_offer_location_selector'), 10, 2);
		add_action('wp_head', array ($this, 'create_special_offer_location_reference'));
	}
	private function get_special_offer_location() {
		global $post;
		if (!empty($post)) {
	   		return get_the_terms($post->ID, 'special_offer_location')[0];
		} else {
			return null;
		}
	}
	public function remove_special_offer_location_box()
	{
		remove_meta_box('tagsdiv-special_offer_location', 'special_offer', 'normal');
	}
	public function add_nice_special_offer_location_selector()
	{
		acf_add_local_field_group(array (
			'key' => 'group_special_offer_location',
			'title' => 'Special Offer Location',
			'fields' => array (
				array (
					'key' => 'specials_special_offer_location',
					'label' => 'Special Offer Location',
					'name' => 'special_offer_location',
					'type' => 'taxonomy',
					'instructions' => 'Select a Special Offer Location for this content',
					'required' => 1,
					'taxonomy' => 'special_offer_location',
					'field_type' => 'multi_select',
					'allow_null' => 0,
					'add_term' => 0,
					'save_terms' => 1,
					'load_terms' => 1,
					'return_format' => 'object',
					'multiple' => 1,
				),
			),
			'location' => array (
				array (
					array (
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'special_offer'
					),
				),
			),
				'hide_on_screen' => array (
					0 => 'the_content',
					1 => 'discussion',
					2 => 'comments',
					3 => 'featured_image'
			),
			'menu_order' => 3,
			'description' => 'Select a Special Offer Location for this content'
		));
	}
	public function apply_acf_to_special_offer_location($acf_fields)
	{
		array_push($acf_fields['special_offer_location'], array (
			array (
				'param' => 'taxonomy',
				'operator' => '==',
				'value' => 'special_offer_location',
			),
		));
		return $acf_fields;
	}
	public function add_special_offer_location_to_context($context)
	{
		global $post;
		if ($post) {
			$context['special_offer_locations'] = $this->get_special_offer_location();
		}
		return $context;
	}

	// Register Custom Taxonomy
	public function register_custom_taxonomy()
	{
		$labels = array(
			'name'                       => _x( 'Special Offer Location', 'Taxonomy General Name', 'text_domain' ),
			'singular_name'              => _x( 'Special Offer Location', 'Taxonomy Singular Name', 'text_domain' ),
			'menu_name'                  => __( 'Special Offer Location', 'text_domain' ),
			'all_items'                  => __( 'All special offer locations', 'text_domain' ),
			'parent_item'                => __( 'Parent special offer location', 'text_domain' ),
			'parent_item_colon'          => __( 'Parent special offer location:', 'text_domain' ),
			'new_item_name'              => __( 'New special offer location', 'text_domain' ),
			'add_new_item'               => __( 'Add special offer location', 'text_domain' ),
			'edit_item'                  => __( 'Edit special offer location', 'text_domain' ),
			'update_item'                => __( 'Update special offer location', 'text_domain' ),
			'view_item'                  => __( 'View special offer location', 'text_domain' ),
			'separate_items_with_commas' => __( 'Separate special offer locations with commas', 'text_domain' ),
			'add_or_remove_items'        => __( 'Add or remove special offer locations', 'text_domain' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
			'popular_items'              => __( 'Popular special offer locations', 'text_domain' ),
			'search_items'               => __( 'Search special offer locations', 'text_domain' ),
			'not_found'                  => __( 'Not Found', 'text_domain' ),
			'no_terms'                   => __( 'No special offer locations', 'text_domain' ),
			'items_list'                 => __( 'Special Offer Locations list', 'text_domain' ),
			'items_list_navigation'      => __( 'Special Offer Locations list navigation', 'text_domain' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => false,
			'rewrite'                      => array (
				'with_front' => false
			),
			'show_in_rest'       => true,
			'rest_base'          => 'special_offer_locations',
			'rest_controller_class' => 'WP_REST_Terms_Controller',
		);
		register_taxonomy('special_offer_location', array ( 'special_offer' ), $args);
	}
	public function create_special_offer_location_reference() {
		$special_offer_location_object = json_encode($this->get_special_offer_location());
		echo "<script>window.agreableSpecialOfferLocation = " . $special_offer_location_object . "</script>";
	}
}
