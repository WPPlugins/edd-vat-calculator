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
* Add Company & VAT fields to checkout form
*
* @since  1.0
* @return mixed|void
*/
function edd_vat_calculator_add_tax_id() {
  ob_start(); 
  ?>
  <p id="edd-company-wrap">
    <label for="company" class="edd-label"><?php _e( 'Billing Company Name', 'edd_vat_calculator' ); ?></label>
    <input type="text" name="company" id="company" class="company edd-input" placeholder="<?php _e( 'Company Name', 'edd_vat_calculator' ); ?>" />
  </p>
  <p id="edd-tax-id-wrap">
    <label for="tax_id" class="edd-label"><?php _e( 'Billing Tax ID', 'edd_vat_calculator' ); ?></label>
    <input type="text" name="tax_id" id="tax-id" class="tax-id edd-input" placeholder="<?php _e( 'Tax ID / EU-VAT ID', 'edd_vat_calculator' ); ?>" />
  </p>
  <?php
  echo ob_get_clean();    
}
add_action('edd_cc_billing_top', 'edd_vat_calculator_add_tax_id', 100);

?>