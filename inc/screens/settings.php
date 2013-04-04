<?php
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
			update_option("ethoseo_te_trackgooglerank", $_POST['trackgooglerank']);

			update_option("ethoseo_te_universal", $_POST['universal']);
			update_option("ethoseo_te_infooter", $_POST['infooter']);
			update_option("ethoseo_te_debug", $_POST['debug']);

			echo '<div id="setting-error-settings_updated" class="updated settings-error"><p><strong>Settings saved.</strong></p></div>';
		}
	?>
	<?php include(ETHOSEO_TE_PATH . "inc/support/ethoseo.php"); ?>
	<form method="POST">
		<h3>General Tracking</h3>
		<p>By default Track Eveything tracks <em>everything</em>. You can toggle this default functionality.</p>
		<table class="form-table" style="clear: left; width: auto;">
			<tr valign="top">
				<th scope="row"><label for="trackforms" id="trackformslabel">Track Form Submissions</label></th>
				<td>
					<input name="trackforms" type="checkbox" id="trackforms" aria-labelledby="trackformslabel" value="true" <?php echo get_option("ethoseo_te_trackforms") ? 'checked="checked"' : ""; ?>/>
					<label for="trackforms" class="description">This will trigger an Event any time a form is submitted.</label>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="tracksearchforms" id="tracksearchformslabel">Track Search Form Submissions</label></th>
				<td>
					<input name="tracksearchforms" type="checkbox" id="tracksearchforms" aria-labelledby="tracksearchforms" value="true" <?php echo get_option("ethoseo_te_tracksearchforms") ? 'checked="checked"' : ""; ?>/>
					<label for="tracksearchforms" class="description">Unless this is checked search forms are not tracked.</label>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="trackoutbound" id="trackoutboundlabel">Track Outbound Links</label></th>
				<td>
					<input name="trackoutbound" type="checkbox" id="trackoutbound" aria-labelledby="trackoutboundlabel" value="true" <?php echo get_option("ethoseo_te_trackoutbound") ? 'checked="checked"' : ""; ?>/>
					<label for="trackoutbound" class="description">This will trigger an Event any time an outbound link is triggered. <em>(These will be counted as non-interactions)</em></label>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="trackemail" id="trackemaillabel">Track Email Links</label></th>
				<td>
					<input name="trackemail" type="checkbox" id="trackemail" aria-labelledby="trackemaillabel" value="true" <?php echo get_option("ethoseo_te_trackemail") ? 'checked="checked"' : ""; ?>/>
					<label for="trackemail" class="description">This will trigger an Event any time a <code>mailto:</code> is triggered.</label>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="trackgooglerank" id="trackgoogleranklabel">Track Google Rank</label></th>
				<td>
					<input name="trackgooglerank" type="checkbox" id="trackgooglerank" aria-labelledby="trackgoogleranklabel" value="true" <?php echo get_option("ethoseo_te_trackgooglerank") ? 'checked="checked"' : ""; ?>/>
					<label for="trackgooglerank" class="description">This will trigger an Event any time a visitor comes from a Google Search, recording the keyword and rank. <em>(These will be counted as non-interactions)</em></label>
				</td>
			</tr>
		</table>
		<h3>Advanced</h3>
		<table class="form-table" style="clear: left; width: auto;">
			<tr valign="top">
				<th scope="row"><label for="infooter" id="infooterlabel">Place in Footer</label></th>
				<td>
					<input name="infooter" type="checkbox" id="infooter" aria-labelledby="infooterlabel" value="true" <?php echo get_option("ethoseo_te_infooter") ? 'checked="checked"' : ""; ?>/>
					<label for="infooter" class="description">If things are going wrong with your site try enabling this.</label>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="universal" id="universallabel">Use GA Universal</label></th>
				<td>
					<input name="universal" type="checkbox" id="universal" aria-labelledby="universallabel" value="true" <?php echo get_option("ethoseo_te_universal") ? 'checked="checked"' : ""; ?>/>
					<label for="universal" class="description">Only select this if you're using Google's new <code>Analytics.js</code> on your site.</label>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="debug" id="debuglabel">Debug</label></th>
				<td>
					<input name="debug" type="checkbox" id="debug" aria-labelledby="debuglabel" value="true" <?php echo get_option("ethoseo_te_debug") ? 'checked="checked"' : ""; ?>/>
					<label for="debug" class="description">Debug makes Track Everything louder, it will <code>console.log</code> and add classes.</label>
				</td>
			</tr>
		</table>
		<p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="Save Changes"	/></p>
	</form>
</div>