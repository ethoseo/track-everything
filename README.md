# Plugin Name #
**Contributors:** [ethoseo](http://profiles.wordpress.org/ethoseo), [nquinlan](http://profiles.wordpress.org/nquinlan)
  
**Tags:** analytics, google analytics, tracking, event tracking, link tracking, email tracking, form submissions
  
**Requires at least:** 3.0.1
  
**Tested up to:** 3.4.2
  
**Stable tag:** 1.1.0
  
**License:** MIT
  
**License URI:** http://opensource.org/licenses/MIT
  

Track Everything makes using Google Analytics on a WordPress site easy. Attatch tracking to forms, links, or any CSS selector.

## Description ##

Track Everything makes event tracking simple. By default the plugin tracks form submissions, external links and emails. However, you can customize it to track nearly any common event using CSS selectors.

The plugin allows users to label events or completely customize events' `Category`, `Action` , and `Label` [as allowed by Analytics](https://developers.google.com/analytics/devguides/collection/gajs/eventTrackerGuide#Anatomy).

By using Google Analytics Event Tracking you can get a more detailed view of what users do on your site and track beyond what Google Analytics offers by default.

## Installation ##

1. Upload `track-everything/` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Configure Track Everything using the new 'Track Everything' menu in WordPress

## Frequently Asked Questions ##

### How do I start tracking something? ###

By default form submissions, clicks on external links and clicks on email links are tracked. However, you can track other things by using the 'Specific Tracking' page found in the 'Track Everything' menu.

To track something enter its CSS (_or jQuery_) selector; `Category`, `Action` , and `Label`; and the select the event you want to track.

### What is a CSS selector and how do I find it?  ###
A CSS selector is a way of referencing a specific object on a page. To find it we recommend you use [Selector Gadget](http://www.selectorgadget.com/).

### What are `Category`, `Action` , and `Label`?  ###
`Category`, `Action` , and `Label` are all ways to [define events in Google Analytics](https://developers.google.com/analytics/devguides/collection/gajs/eventTrackerGuide#Anatomy). 


## Screenshots ##

###1. The Track Everything Settings Screen
###
![The Track Everything Settings Screen
](http://s-plugins.wordpress.org/track-everything/assets/screenshot-1.png?rev=625290)

###2. The "Specific" tracking interface
###
![The "Specific" tracking interface
](http://s-plugins.wordpress.org/track-everything/assets/screenshot-2.png?rev=625290)

###3. The "Nameing" interface
###
![The "Nameing" interface
](http://s-plugins.wordpress.org/track-everything/assets/screenshot-3.png?rev=625290)


## Changelog ##

### 1.0.2 ###
* Fixes to Specific Events
* Fixes to code in Footer

### 1.0.1 ###
* Major Analytics Bug Fixes 

### 1.0 ###
* The intial release.

## Upgrade Notice ##

### 1.0.2 ###
This version allows for more accurate tracking of Specific Events and contains various bug fixes and improvements.

### 1.0.1 ###
This version fixes bugs in the way Track Everything labels items.

### 1.0 ###
Initial release.
