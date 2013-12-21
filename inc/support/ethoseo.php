<?php
if(isset($_POST['hide']) && $_POST['hide']){
	update_option("ethoseo_hide_ethoseo", true);
}
?>
<div style="float: right; width: 300px;">
	<a href="http://www.ethoseo.com/?utm_campaign=WordPress-Plugins&utm_medium=inplugin&utm_source=Track-Everything"><img src="<?php echo plugins_url('/images/pluginby.png', ETHOSEO_TE_FILE); ?>" alt="Plugin By Ethoseo" /></a>
<?php
if(!get_option("ethoseo_hide_ethoseo")){
?>
	<div class="about_ethoseo" style="border-top: 1px solid #dadada; margin-top: 10px;">
		<p><a href="http://www.ethoseo.com/?utm_campaign=WordPress-Plugins&utm_medium=inplugin&utm_source=Track-Everything" style="font-weight:bold;">Ethoseo</a> is a premiere internet marketing company based in Bellingham, WA. We provide expert pay-per-click (PPC) management and SEO services.</p>
		<p>If you're experiencing any trouble with Track Everything, want to to improve your analytics, or want to better your internet marketing efforts, please don't hesitate to <a href="http://www.ethoseo.com/contact-us/?utm_campaign=WordPress-Plugins&utm_medium=inplugin&utm_source=Track-Everything" style="font-weight:bold;">get in contact</a>.</p>
	</div>
	<div class="spread_the_word" style="border-top: 1px solid #dadada; margin-top: 10px;">
		<p>Thanks for using Track Everything. We've worked hard to make a great plugin and would appreciate it if you let others know about it.</p>
		<h3>Spread The Word</h3>
		<ul>
			<li><a href="<?php echo admin_url("post-new.php?ethoseo-thanks-template=1"); ?>">Write A Post About It</a></li>
			<li><a target="_blank" href="https://twitter.com/intent/tweet?text=I'm%20using%20%40ethoseo's%20Track%20Everything%20Plugin%20for%20WordPress%20to%20understand%20my%20users%20better.&related=ethoseo&url=http%3A%2F%2Fwww.ethoseo.com%2Ftools%2Ftrack-everything%3Futm_campaign%3DWordPress-Plugins%26utm_medium%3DThanks%2BShare%26utm_source%3DTrack-Everything">Tweet About It</a></li>
			<li><a target="_blank" href="https://www.facebook.com/sharer.php?u=http%3A%2F%2Fwww.ethoseo.com%2Ftools%2Ftrack-everything%3Futm_campaign%3DWordPress-Plugins%26utm_medium%3DThanks%2BShare%26utm_source%3DTrack-Everything">Facebook About It</a></li>
			<li><a target="_blank" href="https://plus.google.com/share?url=http%3A%2F%2Fwww.ethoseo.com%2Ftools%2Ftrack-everything%3Futm_campaign%3DWordPress-Plugins%26utm_medium%3DThanks%2BShare%26utm_source%3DTrack-Everything">Google+ About It</a></li>
		</ul>
	</div>
	<form method="POST" style="border-top: 1px solid #dadada;  text-align: right; margin-top: 10px; padding-top: 5px;"><input type="submit" name="hide" value="Hide This Forever" class="button" style="color: #888" /></form>
<?php
}
?>
</div>