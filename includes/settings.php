<?php
/**
* Settings
*
* @package     EDD VAT Calculator
* @subpackage  Functions/Settings
* @copyright   Copyright (c) 2014, Carlos Hernandez
* @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
* @since       1.0
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
* Add quaderno authentication code to misc section
*
* @since  1.0
* @return array $settings New settings
*/
function edd_vat_calculator_misc_settings($settings) {
  $edd_vat_calculator_settings = array(
    array(
      'id' => 'edd_vat_calculator_settings',
      'name' => '<strong>' . __('Quaderno Settings', 'edd_vat_calculator') . '</strong>',
      'type' => 'header'
    ),
    array(
      'id' => 'edd_vat_calculator_token',
      'name' => __('Authentication Token', 'edd_vat_calculator'),
      'desc' => __('Get this from your Quaderno.io account: Settings > Access & Security > API Token.', 'edd_vat_calculator'),
      'type' => 'text',
      'size' => 'regular'
    )
  );

  return array_merge($settings, $edd_vat_calculator_settings);
}
add_filter('edd_settings_misc', 'edd_vat_calculator_misc_settings');

/**
* Retrieve the absolute path to the file upload directory without the trailing slash
*
* @since  1.0
* @return string $path Absolute path to the EDD VAT Calculator upload directory
*/
function edd_vat_calculator_get_upload_dir() {
  $wp_upload_dir = wp_upload_dir();
  wp_mkdir_p( $wp_upload_dir['basedir'] . '/edd-vat-calculator' );
  $path = $wp_upload_dir['basedir'] . '/edd-vat-calculator';

  return apply_filters( 'edd_vat_calculator_get_upload_dir', $path );
}

?>