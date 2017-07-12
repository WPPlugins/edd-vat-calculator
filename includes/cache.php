<?php 
/**
* API Cache - http://davidwalsh.name/php-cache-function
*
* @package     EDD VAT Calculator
* @subpackage  Functions/Cache
* @copyright   Copyright (c) 2009, David Walsh
* @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
* @since       1.0
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Gets the contents of a file if it exists, otherwise grabs and caches 
function edd_vat_calculator_get_content($file, $url, $api_key, $hours = 24, $fn = '', $fn_args = '') {
	$current_time = time(); $expire_time = $hours * 60 * 60; $file_time = filemtime($file);

	//decisions, decisions
	if(file_exists($file) && ($current_time - $expire_time < $file_time)) {
		return file_get_contents($file);
	}
	else {
		$content = edd_vat_calculator_get_url($url, $api_key, 'x');
  	if($fn) { $content = $fn($content, $fn_args); }
		file_put_contents($file, $content);
		return $content;
	}
}

// Gets content from a URL via curl 
function edd_vat_calculator_get_url($url, $username, $password) {
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); 
	curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
	curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,5);
	$content = curl_exec($ch);
	$http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);
	
	if($http_status == '200') {
	  return $content;
	} else {
	  return $http_status;
	}
}

?>