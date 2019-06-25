=== IP2Location Variables ===
Contributors: IP2Location
Donate link: http://www.ip2location.com
Tags: ip2location, geolocation, targeted content, ip2location library, ip location, php library, ipv4, ipv6
Requires at least: 2.0
Tested up to: 5.1.1
Stable tag: 2.5.2

Library enables you to easily integrate geolocation solution into your blog site. It supports both IPv4 and IPv6 address.

== Description ==

This library enables you to easily integrate geolocation solution into your blog site, plugin or template. In a nutshell, it’s a library derived from https://www.ip2location.com/developers/php but works as a Wordpress plugin to simplify the setup for the usage. It supports both the IPv4 and IPv6 address. Below are the information you can retrieve from this library:

* Country code
* Country name
* Country flag
* Region name
* City name
* Latitude and longitude
* ZIP code
* ISP
* Domain name
* Time zone
* Net speed
* IDD code
* Area code
* Weather station code & name
* MNC, MCC, mobile carrier name
* Elevation
* Usage type

This plugin supports both IP2Location BIN data and web service for geolocation queries. If you are using the BIN data, you can update the BIN data every month by using the wizard on the settings page for the accurate result. Alternatively, you can also manually download and update the BIN data file using the below links:

BIN file download: [IP2Location Commercial database](http://ip2location.com "IP2Location commercial database") | [IP2Location LITE database (free edition)](http://lite.ip2location.com "IP2Location LITE database (free edition)")

If you are using the web service, please visit [IP2Location Web Service](http://www.ip2location.com/web-service "IP2Location Web Service") for details.

= Usage =

Call the function ip2location_get_vars() in any pages, plugins, or themes to retrieve IP2Location variables. The variables are returned in object. To use lookup for a custom IP, use ip2location_get_vars('IP_ADDRESS');

= More Information =
Please visit us at [http://www.ip2location.com](http://www.ip2location.com/tutorials/wordpress-ip2location-variables "http://www.ip2location.com")

== Installation ==

We always recommend the automatic installation via the plugin menu. In case you having the difficulties to do so, below are the manual install steps:

1. Upload `ip2location` folder to the `/wp-content/plugins/` directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. You can now start using IP2Location Variables to customize your contents.

Please take note that this plugin requires minimum **PHP version 5.4**.

== Changelog ==

* 2.5.2 Updated documentation links.
* 2.5.1 Tested up to WordPress 5.1.1.
* 2.5.0 Upgraded IP2Location API to v2.
* 2.4.0 Added debug log.
* 2.3.1 Minor changes.
* 2.3.0 IP2Location database update changed to use download token.
* 2.2.0 Able to lookup specific IP address.
* 2.1.1 Fixed conflicts when multiple IP2Location plugins installed.
* 2.1.0 Use IP2Location PHP 8.0.2 library for lookup.
* 2.0.8 Use latest IP2Location library for lookup.
* 2.0.7 Fixed close sticky information panel issue.
* 2.0.6 Use latest IP2Location library and updated the setting page.
* 2.0.5 Fixed error when creating admin option.
* 2.0.4 Fixed uninstall hook warning message.
* 2.0.3 Fixed uninstall hook.
* 2.0.2 Fixed empty variable on first load.
* 2.0.1 Tested with WordPress 4.4.
* 2.0.0 Added suport to IP2Location Web Service. Rewrote the codes behind.
* 1.1 Support automated bin download and server variables for IP2Location.
* 1.0 Initial release
