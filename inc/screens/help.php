<div class="wrap">
	<div id="icon-track-everything" class="icon32"><br /></div><h2>Track Everything > Help</h2>

	<div class="tewrap">
		<p><em>For more help than is offered here please check out the <a href="http://wordpress.org/support/plugin/track-everything">WordPress Support Forum</a> or <a href="http://www.ethoseo.com/tools/track-everything/">on our website</a>.</em></p>

		<h2 id="faq">Frequently Asked Questions</h2>

		<h3 id="inanalytics">How will things I track appear in Google Analytics?</h3>

		<p>Events tracked by Track Everything will appear under Content &gt; Events in Google Analytics.</p>

		<p>Custom events follow the <code>Category</code>, <code>Action</code>, and <code>Label</code> you define.</p>

		<p>Default events are tracked as follows:</p>
		<table>
		 <tr>
			 <th>Event</th>
			 <th>GA Category</th>
			 <th>GA Action</th>
			 <th>GA Label</th>
		 </tr>
		 <tr>
			 <th>Form Submission</th>
			 <td>Form</td>
			 <td>Submission</td>
			 <td><em>Calculated</em></td>
		 </tr>
		 <tr>
			 <th>Outbound Link</th>
			 <td>Link</td>
			 <td>Outbound</td>
			 <td><em>Calculated</em></td>
		 </tr>
		 <tr>
			 <th>Email Link</th>
			 <td>Link</td>
			 <td>Email</td>
			 <td><em>Calculated</em></td>
		 </tr>
		</table>

		<h3 id="howtostart">How do I start tracking something?</h3>

		<p>By default form submissions, clicks on external links and clicks on email links are tracked. However, you can track other things by using the &#8216;Specific Tracking&#8217; page found in the &#8216;Track Everything&#8217; menu.</p>

		<p>To track something enter its CSS (<em>or jQuery</em>) selector; Category, Action , and Label; and the select the event you want to track.</p>

		<h3 id="whatisacssselectorandhowdoifindit">What is a CSS selector and how do I find it?</h3>

		<p>A CSS selector is a way of referencing a specific object on a page. To find it we recommend you use <a href="http://www.selectorgadget.com/">Selector Gadget</a></p>

		<h3 id="specificpages">How can I ensure Track Everything only tracks things on specific pages</h3>
		<p>All WordPress pages automatically have a unique class asigned to the body tag (e.g. <code>page-id-123</code> or <code>home</code>) you can use that and descendent selectors to ensure the event only triggers on the pages you want it to.</p>

		<h3 id="whatare">What are <code>Category</code>, <code>Action</code> , and <code>Label</code>?</h3>

		<p><code>Category</code>, <code>Action</code>, and <code>Label</code> are all ways to <a href="https://developers.google.com/analytics/devguides/collection/gajs/eventTrackerGuide#Anatomy">define events in Google Analytics</a>.</p>

		<h3 id="weirdthings">Weird things are showing up as labels in my Analytics, how can I fix it?</h3>

		<p>Simply make a label on the &#8216;Tracking Labels&#8217; page for each element the event applies to.</p>

		<h3 id="customizingdefaultevents">I like the events you track by default but not how you categorize them, how can I change it?</h3>

		<p>Simply make a rule on the &#8216;Specific Tracking&#8217; page, this will overrule anything done by default. You can use the following selectors to override each event: <em>(note, you do not need to use the default event list to override the conventions of Track Everything.)</em>
		<table>
		 <tr>
		 <th>Event</th>
		 <th>Selector</th>
		 <th><em>Default Event List</em></th>
		 </tr>
		 <tr>
		 <th>Form Submission</th>
		 <td><code>form</code></td>
		 <td><code>submit</code></td>
		 </tr>
		 <tr>
		 <th>Outbound Link</th>
		 <td><code>a:outbound</code></td>
		 <td><code>click</code>,<code>keypress</code></td>
		 </tr>
		 <tr>
		 <th>Email Link</th>
		 <td><code>a[href^=&quot;mailto:&quot;]</code></td>
		 <td><code>click</code>,<code>keypress</code></td>
		 </tr>
		</table></p>

		<h3 id="canyouhelpmeout">Can you help me out?</h3>

		<p>If the plugin is causing you troubles feel free to get in touch with us via the <a href="http://wordpress.org/support/plugin/track-everything">WordPress Support Forum</a> or via email <a href="mailto:nick@ethoseo.com">nick@ethoseo.com</a>.</p>

		<p>If you want help figuring out what would be valuable to track or what insights you can gain from what you track, we can help you out there too, we offer that as a service email us at <a href="mailto:info@ethoseo.com">info@ethoseo.com</a>.</p>
	</div>

</div>