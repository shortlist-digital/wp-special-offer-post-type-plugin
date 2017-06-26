<?php
/**
* @wordpress-plugin
* Plugin Name: WP Special Offer Post Type Plugin
* Plugin URI: http://github.com/shortlist-digital/wp-special-offer-post-type-plugin
* Description: A plugin to add special offers
* Version: 1.0.0
* Author: Shortlist Studio
* Author URI: http://shortlist.studio
* License: MIT
*/

require_once __DIR__ . '/../../../../vendor/autoload.php';

use WpSpecialOfferPostTypePlugin\CustomRoles\Roles;
use WpSpecialOfferPostTypePlugin\CustomPostTypes\SpecialOffer;
use WpSpecialOfferPostTypePlugin\CustomFields\LocationTaxonomy;
use WpSpecialOfferPostTypePlugin\CustomFields\Details;

class WpSpecialOfferPostTypePlugin
{
    public function __construct()
    {
		$this->add_roles_and_capabilities();
		$this->add_post_type();
		$this->add_custom_fields();
    }

	private function add_roles_and_capabilities() {
		(new Roles)->init();
	}

	private function add_post_type() {
		(new SpecialOffer)->init();
		(new LocationTaxonomy)->init();
	}

	private function add_custom_fields() {
		(new Details)->init();
	}
}
new WpSpecialOfferPostTypePlugin();
