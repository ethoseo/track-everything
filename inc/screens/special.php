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