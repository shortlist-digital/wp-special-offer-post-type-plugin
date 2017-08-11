<?php

namespace WpSpecialOfferPostTypePlugin\CustomFields;

class Details {

	public function init() {

		add_action('agreable_app_theme_init', function() {

			$key = 'special_offer_details';

			register_field_group(array (
				'key' => $key,
				'title' => 'Special offer details',
				'fields' => array (
					array (
						'key' => $key . '_branch',
						'label' => 'Branch',
						'name' => 'branch',
						'required' => 1,
						'type' => 'text',
						'wrapper' => array (
							'width' => '50'
						),
						'placeholder' => 'All venues'
					),
					array (
						'key' => $key . '_image',
						'label' => 'Image',
						'name' => 'image',
						'type' => 'image',
						'return_format' => 'array',
						'preview_size' => 'thumbnail',
						'library' => 'all',
						'required' => 1,
						'wrapper' => array (
							'width' => '50'
						)
					),
					array (
						'key' => $key . '_description',
						'label' => 'Description',
						'name' => 'description',
						'required' => 1,
						'type' => 'strict_wysiwyg'
					),
					array (
						'key' => $key . '_link_text',
						'label' => 'Link text',
						'name' => 'link_text',
						'type' => 'text',
						'instructions' => 'e.g. View the menu',
						'required' => 1,
						'wrapper' => array (
							'width' => '50'
						)
					),
					array (
						'key' => $key . '_link_destination',
						'label' => 'Link destination',
						'name' => 'link_destination',
						'type' => 'url',
						'instructions' => 'What URL do you want the link to go to? (http://)',
						'required' => 1,
						'wrapper' => array (
							'width' => '50%',
						),
						'placeholder' => 'http://shortlist.com'
					),
				),
				'location' => array (
					array (
						array (
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'special_offer'
						)
					)
				),
				'menu_order' => 1,
				'hide_on_screen' => array (
					0 => 'the_content',
					1 => 'discussion',
					2 => 'comments',
					3 => 'featured_image'
				)
			));
		});
	}
}
