<?php
/*
Plugin Name: Track Everything
Plugin URI: http://www.ethoseo.com/tools/track-everything
Description: A plugin capable of adding Google Analytics Event Tracking to <em>everything</em> on a website.
Author: Ethoseo Internet Marketing
Version: 1.0.2
Author URI: http://www.ethoseo.com/
License: MIT License

© 2012 Ethoseo Internet Marketing

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

*/

$ethoseo_te_version = "1.0";

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

function ethoseo_te_settings_page() {

	if (!current_user_can('activate_plugins'))	{
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
	global $wpdb;

	?>
<div class="wrap">
<!--
Hi There <?php 
global $current_user;
echo $current_user->display_name;
?>!
You're reading the code, that means I think you're pretty awesome. <?php /* Especially if you're reading the PHP code. */ ?>
This plugin uses the Google Analytics async API to track _everything_.
If you have a better way of doing this or anything else, or want to talk WordPress, PHP, internet marketing, or similarly nerdy things drop me an email: <nick@ethoseo.com>.
Enjoy The Plugin!
--
Nick of Ethoseo Internet Marketing
-->
	<div id="icon-track-everything" class="icon32"><br /></div><h2>Track Everything</h2>
	<?php
		if($_POST['submit'] == "Save Changes"){
			update_option("ethoseo_te_trackforms", $_POST['trackforms']);
			update_option("ethoseo_te_trackoutbound", $_POST['trackoutbound']);
			update_option("ethoseo_te_tracksearchforms", $_POST['tracksearchforms']);
			update_option("ethoseo_te_trackemail", $_POST['trackemail']);

			update_option("ethoseo_te_infooter", $_POST['infooter']);
			update_option("ethoseo_te_debug", $_POST['debug']);

			echo '<div id="setting-error-settings_updated" class="updated settings-error"><p><strong>Settings saved.</strong></p></div>';
		}
	?>
	<?php include "ethoseo.php"; ?>
	<form method="POST">
		<h3>General Tracking</h3>
		<p>By default Track Eveything tracks <em>everything</em>. You can toggle this default functionality.</p>
		<table class="form-table" style="clear: left; width: auto;">
			<tr valign="top">
				<th scope="row"><label for="trackforms">Track Form Submissions</label></th>
				<td>
					<input name="trackforms" type="checkbox" id="trackforms" value="true" <?php echo get_option("ethoseo_te_trackforms") ? 'checked="checked"' : ""; ?>/>
					<span class="description">This will trigger an Event any time a form is submitted.</span>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="tracksearchforms">Track Search Form Submissions</label></th>
				<td>
					<input name="tracksearchforms" type="checkbox" id="tracksearchforms" value="true" <?php echo get_option("ethoseo_te_tracksearchforms") ? 'checked="checked"' : ""; ?>/>
					<span class="description">Unless this is checked search forms are not tracked.</span>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="trackoutbound">Track Outbound Links</label></th>
				<td>
					<input name="trackoutbound" type="checkbox" id="trackoutbound" value="true" <?php echo get_option("ethoseo_te_trackoutbound") ? 'checked="checked"' : ""; ?>/>
					<span class="description">This will trigger an Event any time an outbound link is triggered. <em>(These will be counted as non-interactions)</em></span>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="trackemail">Track Email Links</label></th>
				<td>
					<input name="trackemail" type="checkbox" id="trackemail" value="true" <?php echo get_option("ethoseo_te_trackemail") ? 'checked="checked"' : ""; ?>/>
					<span class="description">This will trigger an Event any time a <code>mailto:</code> is triggered.</span>
				</td>
			</tr>
		</table>
		<h3>Advanced</h3>
		<table class="form-table" style="clear: left; width: auto;">
			<tr valign="top">
				<th scope="row"><label for="infooter">Place in Footer</label></th>
				<td>
					<input name="infooter" type="checkbox" id="infooter" value="true" <?php echo get_option("ethoseo_te_infooter") ? 'checked="checked"' : ""; ?>/>
					<span class="description">If things are going wrong with your site try enabling this.</span>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="debug">Debug</label></th>
				<td>
					<input name="debug" type="checkbox" id="debug" value="true" <?php echo get_option("ethoseo_te_debug") ? 'checked="checked"' : ""; ?>/>
					<span class="description">Debug makes Track Everything louder, it will <code>console.log</code> and add classes.</span>
				</td>
			</tr>
		</table>
		<p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="Save Changes"	/></p>
	</form>
</div>
<?php

}

function ethoseo_te_special_page() {

	if (!current_user_can('activate_plugins'))	{
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
	global $wpdb;

	?>
<div class="wrap">
	<div id="icon-track-everything" class="icon32"><br /></div><h2>Track Everything > Specifics</h2>
	<?php
		if($_POST['submit'] == "Save Changes"){
			update_option("ethoseo_te_special", stripslashes_deep($_POST['special']) );

			echo '<div id="setting-error-settings_updated" class="updated settings-error"><p><strong>Settings saved.</strong></p></div>';
		}
		$special = get_option("ethoseo_te_special");
	?>
	<form method="POST">
		<p>With Track Eveything, you can track specific events. If you decided to track something, we'll make sure it doesn't get tracked twice.</p>
		<table id="special-tracking" class="form-table" style="clear: left; width: auto;">
			<tr valign="top">
				<th>Selector</th>
				<th>Category</th>
				<th>Action</th>
				<th>Label</th>
				<th class="event">Event</th>
				<th></th>
				<th></th>
			</tr>
			<?php
				$possible_events = array("click","dblclick","submit","focus","change","keypress");
				if(!$special[0]) { 
					$special = array( array() );
				}
				foreach ($special as $key => $item) {
			?>
			<tr valign="top" class="special-group">
				<td><input type="text" name="special[<?php echo $key; ?>][selector]" id="special_<?php echo $key; ?>_selector" placeholder="#myContactForm" data-pattern-name="special[++][selector]" data-pattern-id="special_++_selector" value="<?php echo htmlspecialchars($item['selector']); ?>" /></td>
				<td><input type="text" name="special[<?php echo $key; ?>][category]" id="special_<?php echo $key; ?>_category" placeholder="Forms" data-pattern-name="special[++][category]" data-pattern-id="special_++_category" value="<?php echo htmlspecialchars($item['category']); ?>" /></td>
				<td><input type="text" name="special[<?php echo $key; ?>][action]" id="special_<?php echo $key; ?>_action" placeholder="Submission" data-pattern-name="special[++][action]" data-pattern-id="special_++_action" value="<?php echo htmlspecialchars($item['action']); ?>" /></td>
				<td><input type="text" name="special[<?php echo $key; ?>][label]" id="special_<?php echo $key; ?>_label" placeholder="Contact Form" data-pattern-name="special[++][label]" data-pattern-id="special_++_label" value="<?php echo htmlspecialchars($item['label']); ?>" /></td>
				<td class="event">
					<?php foreach($possible_events as $event){ ?>
						<label><input type="checkbox" name="special[<?php echo $key; ?>][events][<?php echo $event; ?>]" id="special_<?php echo $key; ?>_events_<?php echo $event; ?>" data-pattern-name="special[++][events][<?php echo $event; ?>]" data-pattern-id="special_++_events_<?php echo $event; ?>"<?php if($item['events'][$event]){ echo 'checked="checked"'; } ?>> <?php echo $event; ?></label>
					<?php } ?>
				</td>
				<td><button type="button" class="btnRemove">Remove -</button></td>
				<td><button type="button" class="btnAdd">Add +</button></td>
			</tr>
			<?php } ?>
		</table>
		<p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="Save Changes"	/></p>
	</form>
</div>
<script>
jQuery(function ($){
	repeater( "#special-tracking", ".special-group" );
});

</script>
<?php

}

function ethoseo_te_dictionary_page() {

	if (!current_user_can('activate_plugins'))	{
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
	global $wpdb;

	?>
<div class="wrap">
	<div id="icon-track-everything" class="icon32"><br /></div><h2>Track Everything > Labels</h2>
	<?php
		if($_POST['submit'] == "Save Changes"){
			update_option("ethoseo_te_dictionary", stripslashes_deep($_POST['dictionary']) );

			echo '<div id="setting-error-settings_updated" class="updated settings-error"><p><strong>Settings saved.</strong></p></div>';
		}
		$dictionary = get_option("ethoseo_te_dictionary");
	?>
	<form method="POST">
		<p>Track Everything does its best to create descriptive labels for events. However if you want to customize these use CSS selectors to make labels.</p>
		<table id="event-dictionary" class="form-table" style="clear: left; width: auto;">
			<tr valign="top">
				<th>Selector</th>
				<th>Label</th>
				<th></th>
				<th></th>
			</tr>
			<?php
				if(!$dictionary[0]) { 
					$dictionary = array( array() );
				}
				foreach ($dictionary as $key => $item) {
			?>
			<tr valign="top" class="dictionary-group">
				<td><input type="text" name="dictionary[<?php echo $key; ?>][selector]" id="dictionary_<?php echo $key; ?>_selector" placeholder="#myContactForm" data-pattern-name="dictionary[++][selector]" data-pattern-id="dictionary_++_selector"  value="<?php echo htmlspecialchars($item['selector']); ?>" /></td>
				<td><input type="text" name="dictionary[<?php echo $key; ?>][name]" id="dictionary_<?php echo $key; ?>_name" placeholder="Contact Form" data-pattern-name="dictionary[++][name]" data-pattern-id="dictionary_++_name"  value="<?php echo htmlspecialchars($item['name']); ?>"  /></td>
				<td><button type="button" class="btnRemove">Remove -</button></td>
				<td><button type="button" class="btnAdd">Add +</button></td>
			</tr>
		<?php } ?>
		</table>
		<p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="Save Changes"	/></p>
	</form>
</div>
<script>
jQuery(function ($){
	repeater( "#event-dictionary", ".dictionary-group" );
});

</script>
<?php

}

?>