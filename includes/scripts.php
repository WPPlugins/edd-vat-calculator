<?php
/**
* Scripts
*
* @package     EDD VAT Calculator
* @subpackage  Functions/Scripts
* @copyright   Copyright (c) 2014, Carlos Hernandez
* @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
* @since       1.0
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
* Add EDD VAT Calculator scripts
*
* @since  1.0
* @return void
*/
function edd_vat_calculator_load_scripts() {
  $js_dir = EDD_VAT_CALCULATOR_PLUGIN_URL . 'assets/js/';
  
  // Use minified libraries if SCRIPT_DEBUG is turned off
  $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

  if ( edd_is_checkout() ) {
    wp_enqueue_script( 'edd-vat_calculator-tax-id', $js_dir . 'edd-vat-calculator' . $suffix . '.js', array( 'jquery' ), EDD_VERSION );
  }

}
add_action( 'wp_enqueue_scripts', 'edd_vat_calculator_load_scripts' );

?>