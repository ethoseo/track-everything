<?php
/*
Plugin Name: Track Everything
Plugin URI: http://www.ethoseo.com/tools/track-everything
Description: A plugin capable of adding Google Analytics Event Tracking to <em>everything</em> on a website.
Author: Ethoseo Internet Marketing
Version: 1.1.1
Author URI: http://www.ethoseo.com/
License: MIT License

© 2012 Ethoseo Internet Marketing

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

*/

$ethoseo_te_version = "1.0";
define( 'ETHOSEO_TE_PATH', plugin_dir_path(__FILE__) );
define( 'ETHOSEO_TE_FILE', __FILE__);

function ethoseo_te_enqueue() {
	global $ethoseo_te_version;
	$in_footer = (bool)get_option("ethoseo_te_infooter");
	wp_enqueue_script(
		'trackeverything',
		plugins_url('js/script.js', __FILE__),
		array('jquery'),
		$ethoseo_te_version,
		$in_footer
	);
}    
 
add_action('wp_enqueue_scripts', 'ethoseo_te_enqueue');

// PRINT SETTINGS
if((bool)get_option("ethoseo_te_infooter")){
	add_action('wp_footer', 'ethoseo_te_print_options');
}else{
	add_action('wp_head', 'ethoseo_te_print_options');
}

function ethoseo_te_print_options () {
	global $ethoseo_te_version;
	
	// Change Special from "click" => on to 0 => "click"
	$special = get_option("ethoseo_te_special");
	foreach($special as $key => $value){
		if($value['events']){
			$special[$key]['events'] = array_keys($value['events']);
		}else{
			unset($special[$key]);
		}
	}
	
	// Create Options
	$options = array(
		"version" => $ethoseo_te_version,
		"special" => $special,
		"dictionary" => get_option("ethoseo_te_dictionary"),
		"settings" => array(
			"forms" => (bool)get_option("ethoseo_te_trackforms"),
			"outbound" => (bool)get_option("ethoseo_te_trackoutbound"),
			"search" => (bool)get_option("ethoseo_te_tracksearchforms"),
			"email" => (bool)get_option("ethoseo_te_trackemail"),
			"googlerank" => (bool)get_option("ethoseo_te_trackgooglerank"),
			"universal" => (bool)get_option("ethoseo_te_universal"),
			"debug" => (bool)get_option("ethoseo_te_debug"),
		)
	);

	echo '<script type="text/javascript">window.trackeverything = ';
	echo json_encode($options);
	echo '</script>';

}

// DEFAULTS

register_activation_hook( __FILE__, 'ethoseo_te_activate' );
function ethoseo_te_activate() {
	if(!get_option("ethoseo_te_activated")){
		update_option("ethoseo_te_activated", true);
		update_option("ethoseo_te_special", array());
		update_option("ethoseo_te_dictionary", array());
		update_option("ethoseo_te_trackforms", true);
		update_option("ethoseo_te_trackoutbound", true);
		update_option("ethoseo_te_tracksearchforms", false);
		update_option("ethoseo_te_trackemail", true);
		update_option("ethoseo_te_trackgooglerank", false);
		update_option("ethoseo_te_universal", false);
		update_option("ethoseo_te_infooter", false);
		update_option("ethoseo_te_debug", false);
	}
}

// SETTINGS

add_action('admin_menu', 'ethoseo_te_create_menu');
function ethoseo_te_create_menu() {

	//create new top-level menu
	$ethoseo_te_options_page = add_menu_page('Track Everything Settings', 'Track Everything', 'activate_plugins', 'track-everything', 'ethoseo_te_settings_page', plugins_url('images/icon.png', __FILE__) );
	$ethoseo_te_special_page = add_submenu_page('track-everything', 'Track Everything > Specific Tracking', 'Specific Events', 'activate_plugins', 'track-everything/specific', 'ethoseo_te_special_page');
	$ethoseo_te_dictionary_page = add_submenu_page('track-everything', 'Track Everything > Labels', 'Tracking Labels', 'activate_plugins', 'track-everything/labels', 'ethoseo_te_dictionary_page');
	$ethoseo_te_help_page = add_submenu_page('track-everything', 'Track Everything > Help', 'Help', 'activate_plugins', 'track-everything/help', 'ethoseo_te_help_page');
}

add_action( 'admin_enqueue_scripts', 'ethoseo_te_admin_enque' );
function ethoseo_te_admin_enque($hook) {
	$hook_parts = explode("/",$hook);
	global $ethoseo_te_version;
	wp_enqueue_style('ethoseo_te_admin_css', plugins_url('css/admin.css', __FILE__), array(), $ethoseo_te_version, 'all');
	if($hook_parts[1] == "specific" || $hook_parts[1] == "labels"){
    	wp_enqueue_script('jquery-form-repeater', plugins_url('js/admin.js', __FILE__), array(), "0.1.0", 'all');
    }
    if($hook == "post-new.php" && $_GET['ethoseo-thanks-template'] == 1){
    	wp_enqueue_script('ethoseo-thanks', plugins_url('js/thanks.js', __FILE__), array(), "0.1.0", 'all');
    }
}

function ethoseo_te_page ($pagename){

	if (!current_user_can('activate_plugins'))	{
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}

	global $wpdb;

	include(ETHOSEO_TE_PATH . "inc/screens/$pagename.php");

}

function ethoseo_te_settings_page() {
	ethoseo_te_page('settings');
}

function ethoseo_te_special_page() {
	ethoseo_te_page('special');
}

function ethoseo_te_dictionary_page() {
	ethoseo_te_page('dictionary');
}

function ethoseo_te_help_page() {
	ethoseo_te_page('help');
}

?>