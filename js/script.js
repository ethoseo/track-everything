function calculateLabel ($obj, possibilities){
	var possibilities = (typeof possibilities == 'object') ? possibilities : ["te_name", "name", "title", "id"];
	var eventLabel = null;
	for (var i = 0; i <= (possibilities.length - 1); i++) {
		var possibility = $obj.attr(possibilities[i]);
		if(possibility && possibility.length){
			eventLabel = possibility;
			break;
		}
	}
	return eventLabel;
}
function pushEvent ( eventInfo ) {
	if(window.trackeverything.settings.debug){ console.log(eventInfo); }
	_gaq.push(eventInfo);
}
jQuery(function ($){
	$.expr[':'].external = function(obj){
		return !obj.href.match(/^mailto:/) && !obj.href.match(/^#:/) && (obj.hostname.replace(/^www\./i, '') != document.location.hostname.replace(/^www\./i, ''));
	};

	for (var i = window.trackeverything.dictionary.length - 1; i >= 0; i--) {
		$(window.trackeverything.dictionary[i].selector).attr("te_name", window.trackeverything.dictionary[i].name);
	}
	if(window.trackeverything.settings.forms){
		$("form").on("submit.jqte.jqtedefault", function (e) {
			var formLabel = calculateLabel($(this));

			var eventInfo = ['_trackEvent', 'Form', 'Submission'];
			if(formLabel != null){
				eventInfo.push(formLabel);
			}
			if(!(window.trackeverything.settings.search == false && $(this).attr("method") && $(this).attr("method").toLowerCase() == "get" && $(this).children("input[name=s]").length)){
				pushEvent(eventInfo);
			}
		});
		if(window.trackeverything.settings.debug){
			$("form").addClass("track-everything track-everything-default track-everything-form");
		}
	}
	if(window.trackeverything.settings.outbound){
		$("a:external").on("click.jqte.jqtedefault keypress.jqte.jqtedefault", function (e) {
			var eventLabel = calculateLabel($(this), ["te_name", "href"]);

			var eventInfo = ['_trackEvent', 'Link', 'Outbound', eventLabel, null, true];
			pushEvent(eventInfo);
		});
		if(window.trackeverything.settings.debug){
			$("a:external").addClass("track-everything track-everything-default track-everything-outbound");
		}
	}
	if(window.trackeverything.settings.email){
		$('a[href^="mailto:"]').on("click.jqte.jqtedefault keypress.jqte.jqtedefault", function (e) {
			var eventLabel = $(this).attr("href").substring(7);

			var eventInfo = ['_trackEvent', 'Link', 'Email', eventLabel];
			pushEvent(eventInfo);
		});
		if(window.trackeverything.settings.debug){
			$('a[href^="mailto:"]').addClass("track-everything track-everything-default track-everything-email");
		}
	}
	for (var i = window.trackeverything.special.length - 1; i >= 0; i--) {
		var $special = window.trackeverything.special[i];
		$($special.selector).off(".jqtedefault");
		if(window.trackeverything.settings.debug){
			$($special.selector).addClass("track-everything track-everything-special").removeClass("track-everything-default");
		}
		var events = [];
		for (var j = $special.events.length - 1; j >= 0; j--) {
			events.push($special.events[j] + ".jqte.jqtespecial");
		}
		$($special.selector).on(events.join(" "), function () {
			if($special.name.length){
				$(this).attr("te_oname", $special.name);
			}
			var eventLabel = calculateLabel($(this), ["te_oname", "te_name", "name", "title", "id", "href"]);
			var eventInfo = ['_trackEvent', $special.category, $special.action, eventLabel];
			
			pushEvent(eventInfo);
		});
	};
});