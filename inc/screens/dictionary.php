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