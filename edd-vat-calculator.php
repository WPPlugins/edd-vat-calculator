<?php
/*
Plugin Name: EDD VAT Calculator
Plugin URL: http://easydigitaldownloads.com/extension/vat-calculator
Description: Automatically <strong>calculate the EU VAT</strong> on your Easy Digital Downloads checkout. To get started: 1) Sign up for a <a href="http://quaderno.io">Quaderno.io</a> account, and 2) Go to Settings > Security & Access section and get your API Key.
Version: 1.1
Author: Quaderno
Author URI: http://quaderno.io
*/

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'EDD_VAT_Calculator' ) ) :

final class EDD_VAT_Calculator {
  private static $instance;
	
	public static function instance() {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof EDD_VAT_Calculator ) ) {
			self::$instance = new EDD_VAT_Calculator;
			self::$instance->setup_constants();
			self::$instance->includes();
			self::$instance->load_textdomain();
		}
		return self::$instance;
	}
	
	private function setup_constants() {
    // Plugin Folder
    if ( ! defined( 'EDD_VAT_CALCULATOR_PLUGIN_DIR' ) ) {
    	define( 'EDD_VAT_CALCULATOR_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
    }

    // Plugin Folder URL
    if ( ! defined( 'EDD_VAT_CALCULATOR_PLUGIN_URL' ) ) {
      define('EDD_VAT_CALCULATOR_PLUGIN_URL', plugin_dir_url( __FILE__ ));
    }
  }
  
  private function includes() {
		require_once EDD_VAT_CALCULATOR_PLUGIN_DIR . 'includes/cache.php';
		require_once EDD_VAT_CALCULATOR_PLUGIN_DIR . 'includes/checkout.php';
		require_once EDD_VAT_CALCULATOR_PLUGIN_DIR . 'includes/scripts.php';
		require_once EDD_VAT_CALCULATOR_PLUGIN_DIR . 'includes/taxes.php';
		require_once EDD_VAT_CALCULATOR_PLUGIN_DIR . 'includes/settings.php';
  }
  
  public function load_textdomain() {
		$edd_lang_dir = EDD_VAT_CALCULATOR_PLUGIN_DIR. '/languages/';
		$locale = apply_filters( 'plugin_locale',  get_locale(), 'edd_vat_calculator' );
		$mofile = sprintf( '%1$s-%2$s.mo', 'edd', $locale );

		// Setup paths to current locale file
		$mofile_local  = $edd_lang_dir . $mofile;
		$mofile_global = WP_LANG_DIR . '/edd-vat-calculator/' . $mofile;

		if ( file_exists( $mofile_global ) ) {
			// Look in global /wp-content/languages/edd folder
			load_textdomain( 'edd_vat_calculator', $mofile_global );
		} elseif ( file_exists( $mofile_local ) ) {
			// Look in local /wp-content/plugins/easy-digital-downloads/languages/ folder
			load_textdomain( 'edd_vat_calculator', $mofile_local );
		} else {
			// Load the default language files
			load_plugin_textdomain( 'edd_vat_calculator', false, $edd_lang_dir );
		}
	}
	
}

endif; // End if class_exists check

function EDDVC() {
	return EDD_VAT_Calculator::instance();
}

// Get EDD VAT Calculator Running
EDDVC();

?>