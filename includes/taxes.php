<?php
/**
* Taxes
*
* @package     EDD VAT Calculator
* @subpackage  Functions/Taxes
* @copyright   Copyright (c) 2014, Carlos Hernandez
* @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
* @since       1.0
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
* Calculate tax rate
*
* @since  1.0
* @param mixed $rate
* @param bool $country
* @param bool $state
* @return mixed|void
*/
function edd_vat_calculator_tax_rate($rate, $customer_country, $customer_state) {
  global $edd_options;
  	
  if ( isset($edd_options['edd_vat_calculator_token']) && strlen(trim($edd_options['edd_vat_calculator_token'])) > 0 ) {
  	$params = http_build_query(array(
      'country' => $customer_country,
      'postal_code' => $_POST['card_zip'],
      'vat_number' => $_POST['tax_id']
    ));

    $file = edd_vat_calculator_get_upload_dir() . '/' . md5($params) . '.txt';
    $response = edd_vat_calculator_get_content($file, 'https://quadernoapp.com/api/v1/taxes/calculate/?' . $params, $edd_options['edd_vat_calculator_token'], 72);
    if ($response != '402') {
      $obj = json_decode($response);  
      if( !empty( $obj->name ) ) $rate = $obj->rate / 100;
    }    
  }
  	
  return $rate;
}
add_filter('edd_tax_rate', 'edd_vat_calculator_tax_rate', 100, 3);

?>