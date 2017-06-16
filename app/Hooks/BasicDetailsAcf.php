<?php namespace WpSpecialOfferPlugin\Hooks;

class BasicDetailsAcf {

  public function init() {
    \add_filter('agreable_base_theme_article_basic_acf', array($this, 'basic_details_acf'), 10);
  }

  public function basic_details_acf($acf_definition) {
    $acf_definition['location'][] = [
      [
        'param' => 'post_type',
        'operator' => '==',
        'value' => 'special_offer',
      ]
    ];

    return $acf_definition;
  }
}
