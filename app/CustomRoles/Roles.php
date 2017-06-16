<?php

namespace WpSpecialOfferPostTypePlugin\CustomRoles;

class Roles {

	public function init() {

		add_action('admin_init', function() {

			if (!get_role('special_offers_editor')) {
				// Add special offers editor role
				add_role('special_offers_editor',
					'Special Offers Editor',
					array(
						'read' => true,
						'edit_posts' => true,
						'delete_posts' => true,
						'publish_posts' => true,
						'upload_files' => true,
					)
				);
			}
			// Add the roles you'd like to administer the custom post types
			$roles = array('special_offers_editor','administrator');
			// Loop through each role and assign capabilities
			foreach($roles as $the_role) {
				$role = get_role($the_role);
				$role->add_cap('read_longform');
				$role->add_cap('read_private_special_offers');
				$role->add_cap('edit_longform');
				$role->add_cap('edit_special_offers');
				$role->add_cap('edit_others_special_offers');
				$role->add_cap('edit_published_special_offers');
				$role->add_cap('publish_special_offers');
				$role->add_cap('delete_longform');
				$role->add_cap('delete_others_special_offers');
				$role->add_cap('delete_private_special_offers');
				$role->add_cap('delete_published_special_offers');
			}

			get_role($roles[0])->remove_cap('edit_posts');
		});
	}
}
