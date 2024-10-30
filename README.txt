=== Plugin Name ===
Contributors: vohotv
Tags: coronavirus, virus
Tested up to: 5.9
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A wordpress plugin for displaying data about the corona virus.

== Description ==

This wordpress plugin lets you display a widget like component with data about the corona virus. 
Some options you can choose are as following:

* Total cases
* Today's cases
* Total deaths
* Today's deaths
* Recovered
* Active cases
* Critical
* Cases per one million

You choose what data you want to display in the settings page. On top of that you also have the option to fully customize the widgets. 
To display the widget you need to use the [coronavirus] shortcode, this will display the global data. 
There is also an optional country attribute which you can use to display data about a specific country.
Append the country attribute like this [coronavirus country="name_of_the_country"]. Usually the full name of the country with spaces where needed is required.
A very select set of countries has been abbreviated to:

* United States Of America = USA
* United Kingdom = UK
* South Korea = S. Korea

The coronavirus pugin relies on the API by NovelCOVID for all it's data.
The API its Github page: https://github.com/novelcovid/api
The API its privacy policy: https://github.com/NovelCOVID/API/blob/master/privacy.md

== Installation ==

1. Upload `coronavirus.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Add the [coronavirus] shortcode in your posts/pages or place `<?php do_shortcode('coronavirus'); ?>` in your templates. 

== Frequently Asked Questions ==

= Where does the coronavirus plugin get it data from? =

The coronavirus plugin gets its data from https://github.com/novelcovid/api

= Can I choose to see the data of a specific country? =

Yes, you can display the data of a specific country by adding the country attribute to the shortcode like this [coronavirus country="name_of_the_country"]. 
Look at the description for more information.

== Changelog ==

= 2.0.0 =
* Upgraded to the v3 API endpoint.
* Front-end now shows error when country is not found.
* Added a check around the corona_data_options which fixes the errors being displayed besides the checkboxes on the admin page when activating the plugin for the first time.
* If you decide to uninstall the coronavirus plugin :( It now deletes all options you chose on the admin page.

= 1.3.5 =
* Changed to different API endpoint to fix the issue of empty widgets.

= 1.3.4 =
* Updated the API to the v2 endpoint. All data should now be displayed again.

= 1.3.3 =
* Fixed a bug which incorrectly rendered the admin page for the coronavirus plugin.

= 1.3.2 =
* CSS now only gets added to the plugin admin page to avoid conflicts.

= 1.3.1 =
* Coronavirus is now compatible with WordPress version 5.4

= 1.3.0 =
* Errors when saving options has been fixed.
* Selected options now get deleted from the database when the plugin is deactivated.
* Added option to display total tests and tests per one million.
* Fixed bug which could lead to the wrong country data being displayed.