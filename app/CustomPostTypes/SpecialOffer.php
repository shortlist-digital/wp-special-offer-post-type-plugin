<?php

namespace WpSpecialOfferPostTypePlugin\CustomPostTypes;

class SpecialOffer {

	public function init() {

		add_action('init', function() {

			$labels = array (
				'name'                => _x('Special Offers', 'Post Type General Name', 'text_domain'),
				'singular_name'       => _x('Special Offer', 'Post Type Singular Name', 'text_domain'),
				'menu_name'           => __('Special Offer', 'text_domain'),
				'parent_item_colon'   => __('Parent Item:', 'text_domain'),
				'all_items'           => __('All Special Offers', 'text_domain'),
				'view_item'           => __('View Special Offer', 'text_domain'),
				'add_new_item'        => __('Add New Special Offer', 'text_domain'),
				'add_new'             => __('Add New', 'text_domain'),
				'edit_item'           => __('Edit Special Offer', 'text_domain'),
				'update_item'         => __('Update Special Offer', 'text_domain'),
				'search_items'        => __('Search Special Offers', 'text_domain'),
				'not_found'           => __('Not found', 'text_domain'),
				'not_found_in_trash'  => __('Not found in Trash', 'text_domain'),
			);

			$args = array (
				'label'               => __('special offer post', 'text_domain'),
				'description'         => __('Special offers', 'text_domain'),
				'labels'              => $labels,
				'supports'            => array ('title','thumbnail','revisions','author'),
				'taxonomies'          => array (),
				'hierarchical'        => false,
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'show_in_nav_menus'   => true,
				'show_in_admin_bar'   => true,
				'menu_position'       => 4,
				'menu_icon'           => 'dashicons-star-filled',
				'can_export'          => true,
				'has_archive'         => false,
				'exclude_from_search' => false,
				'publicly_queryable'  => true,
				'capability_type' => 'special_offer',
				'capabilities' => array (
					'publish_posts' => 'publish_special_offers',
					'edit_posts' => 'edit_special_offers',
					'edit_others_posts' => 'edit_others_special_offers',
					'delete_posts' => 'delete_special_offers',
					'delete_private_posts' => 'delete_private_special_offers',
					'delete_others_posts' => 'delete_others_special_offers',
					'read_private_posts' => 'read_private_special_offers',
					'edit_post' => 'edit_special_offer',
					'delete_post' => 'delete_special_offer',
					'read_post' => 'read_special_offer',
				),
				'map_meta_cap' => true,
				'rewrite' => false,
				'query_var' => true,
				'show_in_rest' => true
			);

			register_post_type('special_offer', $args);
		}
		,0);
	}
}
