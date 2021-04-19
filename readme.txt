=== Plugin Name ===
Contributors: thedark
Donate link: https://autoaffiliatelinks.com/donations/
Tags: affiliate, links, post, plugin, posts, url, keywords, text, content, automatic
Requires at least: 3.5
Tested up to: 5.7
Stable tag: 6.0.5

Automatically display affiliate links in your website content so you can make more money. You can specify the keywords and affiliate links you want to be added or you can let the plugin to automatically decide where to add links from available affiliate networks: Amazon, Clickbank, Ebay, Walmart, Shareasale, Commission Junction, Bestbuy or Envato Marketplace.

== Description ==

Auto Affiliate Links will automatically add affiliate links into your content. You can manually set affiliate links and keywords where they should be added into your content, or you can let the plugin to automatically extract and display links from Amazon, Clickbank, Shareasale, Ebay, Walmart, Commission Junction, BestBuy and Envato Marketplace.

IMPORTANT: Your content won't be modified in any way. The links are added when the content is displayed. 

If you prefer to select your keywords and add your links manually, you can do this from "Auto Affiliate Links" menu in your administration panel. In "General Settings" you can set if you want the links to be cloaked, if you want them to be added on your homepage or not and several other options.

Also, you will have options to make the links nofollow or dofollow, to open in new page or same page and to cloak links. The plugin will give you the most used 100 keywords from your content si you can easily add affiliate links to appear when they are displayed. 

You can limit the number of links that are shown in every article. The frequency range from "Very Low" to "Very High". At Very Low level only 1 link will be displayed in every article. At "Very High" frequency a maximum of 5 links will be added to every article.

If you choose to automatically generate and display links from Amazon, Clickbank or Shareasale you have to first request an API key, and then to activate each module. The links will be added trough javascript so you do not have to worry about nofollowing and search engines. 




== Installation ==

This section describes how to install the plugin and get it working.

1. Upload the plugin to the `/wp-content/plugins/` directory or download it directly from your administration panel.
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to 'Auto Affiliate Links' menu in your Wordpress Admin panel.
4. Add your affiliate links, along with one or more keywords. Do this for every affiliate link you want to display.
5. Select if you want your links to be nofollow, cloaked, to open in new window, and the maximum number of lniks that are added to every article. On some environments, the cloaking of the links is impossible. If you experience problems, turn the cloaking off and it should work just fine.
6. If you don't get it how to make it work, or if something goes wrong, please consult https://autoaffiliatelinks.com for more info and use the contact form on the website to report the problem or to ask for help.

== Screenshots ==

1. Affiliate link management

2. General Options

3. Amazon Links

4. Post example 1

5. Post example 2

== Frequently Asked Questions ==

= The plugin will modify the content in the database ? =

No, the plugin only add the links when the page is rendered. The content remain intact in your database.

= Cloaked links are not working, what should I do ? =

Link cloaking can cause problems on some environments ( shared hosting with too many restrictions ). If you experience problems please turn cloaking off.

= Do i have to change my theme to make the plugin work? =

No theme changes are needed for this plugin. 

= How it will affect my design and blog functionality ? =

The blog functionality will not be affected in any way. Links will be added in your content and they will look just like normal links. 

= How do I make links nofollow ? =

On the plugin management page: "Auto Affiliate Links" under "Settings", you will have the option to set a link to have rel="nofollow" attribute.

= How do I make the links to open in new window ? =

On the plugin management page: "Auto Affiliate Links" under "Settings", you will have the option to set the links to open in new or in the same window. By default, links will open in a new window. As a matter of fact, it is better for external links to open in new window, so the user will notice that he is on another website right now, and to have your website still open, if he want to read more or to visit another link.

= Can I add the same affiliate link with more keywords ? =

Yes. You can add more keywords in the same box, sepparated by comma. For example: "android,smartphone,phones". If you add the same link 3 times with different keywords the result will be the same: The link will appear for all the keywords added. 

= Can I add more links for the same keyword ? =

If you add more links with the same keyword, only the first occurence of the keyword will add the first link. If the same keyword appear again in the article, the second link will be added on it.

= How Clickbank links work =

First you have to request an API key from the "API Key" menu. Then, from the "Clickbank Links" menu you will have to enter your affiliate id, category and minimum gravity ( leave 0 for all links ), and set the plugin to "active". Once you do this links from clickbank will start to show on your pages.

= The plugin makes my blog to show odd html code = 

If you encounter any problem with the plugin, please contact us using the form at https://autoaffiliatelinks.com and we will help you to solve your issue. It has been reported that some lightbox plugin my be interfeering with our plugin. 

= Is there a maximum limit on number of manual links I can import? =

There isn't a software limit of how many links you can import. However, you should take into account that uploading a big file at once might cause problems with: maximum file size upload limit on your server ( it is usually 2MB ), and the fact that the script can break or exceed maximum execution time ( 30 seconds ), and only a part of the links will be saved. You should break your uploads into 100-200 links at once.

VERY IMPORTANT. Processing big lists of links ( over 500 ), might cause high server load if you are on a shared hosting, and the page load will be affected. Make sure that you only put the amount of links that you server can handle. With under 500 links you should be safe on every server type.

= My CSV Import file is not working =

Before attempting to import a file, make sure that the csv file is encoded as text file and does not have any custom formatting in it.

Microsoft Excel adds odd formatting to the file and making problems at import and even breaking it. When you save a file in Microsoft Excel, make sure that you check the document type to be txt or csv, to prevent odd formatting, and on that page it should also let you select the separator or delimiter.

If you can't find the options to do this, try LibreOffice, as it is a bit easier to find them there.

== Changelog ==

= 6.0.5 =
* Fixed duplicate content issue

= 6.0.4 =
* Updated and tested to work with WordPress 5.7

= 6.0.3 =
* Added links to settings and main plugin page on plugin list page

= 6.0.2.2 =
* Fixed PHP 8 related warnings

= 6.0.2.1 =
* Added price to amazon widget

= 6.0.2 =
* Added option to add disclosure to internal links

= 6.0.1 =
* Enabled statistics to work for cloaked links

= 6.0 =
* Added click tracking statistics

= 5.9.6.1 =
* Fixed warning caused by invalid post id 

= 5.9.6 =
* Added option to check if the links are broken

= 5.9.5 =
* Extended support for BudyPress activities

= 5.9.4.3
* Fixed breaking shortcodes

= 5.9.4.2 =
* Prevent adding links when html tags contains brackets

= 5.9.4.1 =
* Fixed notice issue created by a recent update

= 5.9.4 =
* Added support for MU network activation

= 5.9.3 =
* Added option to prevent adding links in a specific number of paragraphs

= 5.9.2.3 =
* Added support for WpForo

= 5.9.2.2 =
* Fixed database warning

= 5.9.2.1 =
* Fixed CJ form display error

= 5.9.2 =
* Added option to allow linking of part of words or when keywords finish or start with a non-character

= 5.9.1.1 =
* Limited the number of characters taken into account for automated link generation

= 5.9.1 =
* Added sponsored option for link relation

= 5.9 =
* Rebuilt the way links extracted from affiliate networks are displayed

= 5.8.9.2 =
* Added button to go back to API Management page

= 5.8.9.1 =
* Updated Amazon category list

= 5.8.9 =
* Added option to add links on category description

= 5.8.8.8 =
* Added option to add a string or character at the end of each link

= 5.8.8.7 =
* Fixed amazon products widget display

= 5.8.8.6 =
* Fixed some problems with Amazon links

= 5.8.8.5 =
* Fixed Generated Links page

= 5.8.8.4 =
* Tested and updated to work with WordPress 5.4.1

= 5.8.8.3 =
* Added an option to force special characters encoding

= 5.8.8.2 =
* Tested and updated to work with WordPress 5.4

= 5.8.8.1 =
* Added link to import/export page from main plugin administration page

= 5.8.8
* Added option to exclude posts by tags

= 5.8.7.4 =
* Fixed exclude categories page

= 5.8.7.3 =
* Fixed warning on widget display

= 5.8.7.2 =
* Fixed warning generated by post metabox

= 5.8.7.1 =
* Fixed cloaked link display on admin page

= 5.8.7 =
* Added button to copy the cloaked link

= 5.8.6.3 =
* Tested and updated for Wordpress 5.3.2

= 5.8.6.2 =
* Fixed some javascript issues

= 5.8.6.1 =
* Fixed Amazon link generation error throwing

= 5.8.6 =
* Added option to set custom link limit in each post

= 5.8.5 =
* Added custom option to set limit for each link

= 5.8.4.8 =
* Fixed show/hide advanced options on link edit form

= 5.8.4.7 =
* Fixed case sensitive link addition

= 5.8.4.6 =
* Fixed amazon localization bug

= 5.8.4.5 =
* Fixed bug dealing with special chars

= 5.8.4.4 =
* Added a fix to work with Wp Adverts plugin

= 5.8.4.3 =
* Added capability to work with special chars

= 5.8.4.2 =
* Fixed a warning generated by last update

= 5.8.4.1 =
* Fixed heading tags exclusion from replacement

= 5.8.4 =
* Added support for Elementor page builder

= 5.8.3.2 =
* Added extra sanitization on ajax calls

= 5.8.3.1 =
* Fixed admin-ajax issue

= 5.8.3 =
* Added option to set the link adding priority

= 5.8.2 =
* Added option to delete all links when importing new file and added warning messages

= 5.8.1 =
* Changed the default value for import/export
* Tested to work with Wordpress 5.2

= 5.8.0.5 =
* Increased the input field size for amazon api key

= 5.8.0.4 =
* Enabled keywords to be encapsulated in double quotes

= 5.8.0.3 =
* Added encapsulation to links exporting

= 5.8.0.2 =
* Fixed error causing javascript issues

= 5.8.0.1 =
* Fixed bug making content appear twice

= 5.8 =
* Changed the way amazon links are extracted and displayed

= 5.7.5.5 =
* Added prompt to request Amazon apikey and secret when saving

= 5.7.5.4 =
* Added support for tablepress

= 5.7.5.3 =
* Added support for Asgaros Forum

= 5.7.5.2 =
* Added support for Wp Recipe Maker plugin

= 5.7.5.1=
* Added instructions on how to obtain Amazon API key and secret

= 5.7.5 =
* Fixed some potential warnings
* Added fields to set amazon api key and secret

= 5.7.4.1 =
* Tested and updated to work with Wordpress 5.0.2

= 5.7.4 =
* Added a readonly input to show cloaked URL on main links page

= 5.7.3 =
* Added support for PeepSo Social Networking plugin

= 5.7.2 =
* Tested and updated to work with Wordpress 5.0

= 5.7.1.4 =
* Hide advanced options on link edit form

= 5.7.1.3 =
* Fixed amazon settings updating problems

= 5.7.1.2 =
* Cleared some notices appearing on widget when no post were displayed

= 5.7.1.1 =
* Fixed css class display for added links

= 5.7.1 =
* Fixed javascript error when api key was not working and updated some error messages

= 5.7.0.5 =
* Fixed situation when replacement engine taking into account html in script tags

= 5.7.0.4 =
* Fixed javascript warning showing on Firefox regarding unreachable code

= 5.7.0.3 =
* Fixed the amazon product boxes display

= 5.7.0.2 =
* Prevented Amazon product boxes to appear on text widgets and fixed the display of Amazon product boxes

= 5.7.0.1
* Tested and updated to work with the Gutemberg Editor from Wordpress 4.9.8

= 5.7 =
* Added separate plugin settings for internal links

= 5.6.2.8 =
* Added confirmation on settings update

= 5.6.2.7 =
* Fixed redirect loop when links were added without protocol

= 5.6.2.6 =
* Updated import/export to work with link titles

= 5.6.2.5 =
* Removed link target if it is internal link

= 5.6.2.4 =
* Fixed display on Exclude Post page

= 5.6.2.3 =
* Fixed display on Generated Links page

= 5.6.2.2 =
* Fixed a warning shown when displaying links in widgets

= 5.6.2.1 =
* Added a new option for link frequency

= 5.6.2 =
* Changed the way new links are added to prevent problems

= 5.6.1.8 =
* Tested and updated to work with WordPress 4.9.7 

= 5.6.1.7 =
* Added delete button on recently added links and fixed the default order

= 5.6.1.6 =
* Fixed warning breaking the headers when content is presented as array

= 5.6.1.5 =
* Cleared some warnings appearing in combination with advanced custom fields

= 5.6.1.4 =
* Fixed non-working delete link

= 5.6.1.3 =
* Removed the auto-completed text from the input after a link is added and the window is not scrolled to bottom any more

= 5.6.1.2 =
* Improved url checking to see it is links to own url - when used for internal linking

= 5.6.1.1 =
* Hide pagination on generated links if there is a single page

= 5.6.1 =
* Added pagination to manual generated links

= 5.6.0.4 =
* Fixed display of active post types selection in General Settings

= 5.6.0.3 =
* Tested and updated for Wordpress 4.9.6

= 5.6.0.2 =
* Added link to generated links on main plugin page

= 5.6.0.1 =
* Made generated links page visible for users without API key

= 5.6 =
* Added feature to view generated links for each post

= 5.5.2.7 =
* Fixed link limit problem when article is too big

= 5.5.2.6 =
* http is automatically added if the entered url has no protocol

= 5.5.2.5 =
* Updated the remaining links to https

= 5.5.2.4 =
* Fixed post type settings display

= 5.5.2.3 =
* Changed the placehorder for new link form and cleared a console message

= 5.5.2.2 =
* Fixed an error causing a notice to appear, and a warning when no post type is selected

= 5.5.2.1 =
* Changed link input placeholder to https

= 5.5.2 =
* Changed all links to our homepage to https

= 5.5.1.4 =
* Fixed a warning showing in exclude category admin page

= 5.5.1.3 =
* Fixed amazon widget links to show in a new window

= 5.5.1.2 =
* Fixed generated links page, broken after the widget update

= 5.5.1.1 =
* Fixed the link placement selection display in general settings

= 5.5.1 =
* Added support for Advanced custom fields

= 5.5.0.3 =
* Fixed widget not appearing when enough links added

= 5.5.0.2 =
* Fixed settings checkbox display

= 5.5.0.1 =
* Fiexed option updating over and over

= 5.5 =
* Added support to show products at the bottom of the post. Products from amazon can be displayed at the bottom of the post with a widget

= 5.4.8.8 =
* Changed the placeholder for title input text

= 5.4.8.7 =
* Tested and updated for Wordpress 4.9.2

= 5.4.8.6 =
* Fixed notice appearing on widget

= 5.4.8.5 =
* Added support for events manager plugin

= 5.4.8.4 =
* When new link is added the window is scrolled to the new link

= 5.4.8.3 =
* Removed non-working delete icon when new link is added

= 5.4.8.2 =
* Replaced delete link icon with a button

= 5.4.8.1 =
* Fixed the way link list sorting actions are displayed

= 5.4.8 =
* Fixed plugin version numbers

= 5.4.3 =
* Added option to choose if replacement is case sensitive or not

= 5.4.2.8 =
* Tested and updated for Wordpress 4.9.1

= 5.4.2.7 =
* Fixed warnings and updated to work with Wordpress 4.9

= 5.4.2.6 =
* Tested and updated for Wordpress 4.8.3

= 5.4.2.5 =
* Fixed notice appearing when url is not valid

= 5.4.2.4 =
* Added placeholder to affiliate link input

= 5.4.2.3 =
* Fixed notice that appeared on random link distribution when the keyword to replace was the last word in post

= 5.4.2.2 =
* Fixed line spaces in add link form

= 5.4.2.1 =
* Improved the add link form design

= 5.4.2 =
* Changed the way add new links form is displayed

= 5.4.1.7 =
* Fixed notice appearing on link class

= 5.4.1.6 =
* Tested and updated to work with Wordpress 4.8.2

= 5.4.1.5 =
* Changed instructions to reflect latest changes

= 5.4.1.3 =
* Added activation links for modules on api management page

= 5.4.1.2 =
* Links are not generated anymore if site is loaded in iframe

= 5.4.1.1 =
* Changed the name of api management page from "Upgrade to PRO" to "API Management".

= 5.4.1 =
* Removed apikey check when creating admin menu and removed pro modules entries from main plugin menu

= 5.4.0.2 =
* Cleared some notices appearing when debug mode is on

= 5.4.0.1 =
* Limit the maximum number of characters for which random replacement works

= 5.4 =
* Implemented random distribution to work when same keyword limit is higher than 2
* Improved performance for random link distribution

= 5.3.8.1 =
* Tested and updated for Wordpress 4.8.1

= 5.3.8 =
* Improved the add new links interface on main plugin administration page

= 5.3.7.4 =
* Removed rewrite rules flushing from plugin settings

= 5.3.7.3 =
* Changed general settings behaviour from ajax to standard submit

= 5.3.7.2 =
* Added option to choose the desired cloak url query variable

= 5.3.7.1 =
* Title text input is now hidden by default and included in advanced options

= 5.3.7 =
* Added the possibility to add links on headlines.

= 5.3.6.3 =
* Tested and updated for Wordpress 4.8

= 5.3.6.2 =
* Preventing links to be added inside code blocks

= 5.3.6 =
* Fixed critical bug that caused content to not be displayed at all

= 5.3.5.10 =
* Fixed layout on Exclude posts administration page

= 5.3.5.9 =
* Tested and updated to work with Wordpress 4.7.4

= 5.3.5.8 =
* Fixed undefined variable warning on settings display
* Removed relation attribute from links to own website

= 5.3.5.7 =
* If the link target is to own website, it will not be cloaked even if cloaking is set

= 5.3.5.6 =
* Fixed the rel attribute attribute on automatically added links

= 5.3.5.5 =
* Fixed some code that generated notices and improved the random link distribution

= 5.3.5.4 =
* Removed api key check when adding api.js javascript file

= 5.3.5.3 =
* Changed flush rewrite parameter to soft flush

= 5.3.5.2 =
* Javascript files moved to footer

= 5.3.5.1 =
* Tested and updated for Wordpress 4.7.3

= 5.3.5 =
* Added option to enable or disable showing links on excerpts

= 5.3.4.1 =
* Changed from jquery deprecated .live to .on

= 5.3.4 =
* Added the possibility to add links in widget text.

= 5.3.3 =
* Added option to select all clickbank categories

= 5.3.2.6 =
* Tested and updated for Wordpress 4.7.2

= 5.3.2.5 =
* Tested and updated for Wordpress 4.7.1

= 5.3.2.4 =
* Preventing link to be added inside other links with extra tags

= 5.3.2.3 =
* Fixed max links in every article bug

= 5.3.2.2 =
* Checked and tested for wordpress 4.7

= 5.3.2.1 =
* Changed the order of some settings to make more sense

= 5.3.2 =
* Changed the settings saved alert to a lightbox confirmation

= 5.3.1.1 =
* Updated the getting started page to reflect latest changes

= 5.3.1 =
* Fixed problems appearing for PHP versions before 5.3

= 5.3 =
* Added widget support to show affiliate links in sidebars

= 5.2.7.7 =
* Cleared some notices that appeared after some recent updates

= 5.2.7.6 =
* Added verification of blank keywords

= 5.2.7.5 = 
* Links are not displayed in RSS feed anymore

= 5.2.7.4 =
* Fixed problem when new link is added and the checkbox for mass actions was not displayed

= 5.2.7.3 =
* Lowered the size of title input for a better view on smaller devices.

= 5.2.7.2 =
* Added optional placeholder to title entry

= 5.2.7.1 =
* When there is no title specified, no title is displayed

= 5.2.7 =
* Added the possibility to specify title attribute for each added link

= 5.2.6 =
* Updated the plugin to allow link that does not contain http: or https: to be added, to allow // links or inner linking

= 5.2.5.4 =
* Updated and checked for Wordpress 4.6.1

= 5.2.5.3 =
* Changed main js script name to avoid conflicts

= 5.2.5.2 =
* Fixed edit keyword problem

= 5.2.5.1 =
* Fixed the problem when words with apostrophes were not linked

= 5.2.5 =
* Reactivated Custom Feed module

= 5.2.4.3 =
* Checked and updated for Wordpress 4.6

= 5.2.4.2 =
* Added button to remove the API key

= 5.2.4.1 =
* Added an action to be executed before the link engine starts. Using action aal_before_content_display you can programatically change plugin settings from other file, or add some custom code when before links are displayed.

= 5.2.4 =
* Added a filter hook to link addition. You can add a filter to aal_link_display hook and change the way links are displayed.

= 5.2.3.13 =
* Added more options to same keyword and same link limit

= 5.2.3.12 =
* Added the cssclass setting to automatically extracted links

= 5.2.3.11 =
* Fixed some notices appearing on generated links page

= 5.2.3.10 =
* Added title to Import/Export page and fixed the html

= 5.2.3.9 =
* Added pages to consideration when keywords are being suggested

= 5.2.3.8 =
* Displayed metabox on page edit screen

= 5.2.3.7 =
* Excluded posts table is not displayed if there are no post excluded

= 5.2.3.6 =
* Changed default value of same keyword to 3

= 5.2.3.5 =
* Fixed bug when links were not displayed if same keyword was set to No Limit

= 5.2.3.4 =
* Fixed some Clickbank javascript and default issues

= 5.2.3.3 =
* Tested for Wordpress 4.5.3

= 5.2.3.2 =
* Fixed same keyword to be displayed twice if it is added more than once

= 5.2.3.1 =
* Fixed display issues on tables inside plugin admin

= 5.2.3 =
* Added support for BBpress forums

= 5.2.2.6 =
* Delete plugin options when plugin is uninstalled

= 5.2.2.5 =
* Fixed css class text input

= 5.2.2.4 =
* Added extra security check when importing links

= 5.2.2.3 =
* Prevent notification to be displayed for non-admin users

= 5.2.2.2 =
* Fixed dbdelta multiple key issue when deactivating and reactivating the plugin

= 5.2.2.1 =
* Fixed unidentified index problem causing a notice to appear.

= 5.2.2 =
* Added delimiter options for Commission Junction file upload
* Fixed Commission Junction delete problems

= 5.2.1.5 =
* Removed code for settings export feature

= 5.2.1.4 =
* Updated the list of options that are deleted when the plugin is uninstalled

= 5.2.1.3 =
* Changed required permissions for general settings
* Fixed potential memory leak in keyword suggestion

= 5.2.1.2 =
* Tested with Wordpress 4.5.2

= 5.2.1.1 =
* Changed the way settings are added and updated

= 5.2.1 =
* Fixed javascript problem causing warnings in firefox

= 5.2 =
* Changed the way replacement is made for big articles
* Fixed some settings lost when upgrading

= 5.1.10.1 =
* Changed the redirect code to 303

= 5.1.10 =
* Improved the processing speed for very big posts

= 5.1.9.6 =
* Tested wth Wordpress 4.5.1

= 5.1.9.5 =
* Removed dashboard notification

= 5.1.9.4 =
* Minor change to regexp match

= 5.1.9.3 =
* Added variable check on link import

= 5.1.9.2 =
* Changed the text shown when no custom link are available.
* Added on-page instruction to get Commission Junction product feed.

= 5.1.9.1 =
* Checked and tested for Wordpress 4.5

= 5.1.9 =
* Added option to limit the maximum times a link is added

= 5.1.8.10 =
* Fixed some more errors and notices

= 5.1.8.9 =
* Fixed some errors and notices 

= 5.1.8.8 =
* When multiple keywords are set for the same link, the limit from Same Keyword Limit will apply to all of the keywords in the group

= 5.1.8.7 =
* Removed some notices in PHP 7

= 5.1.8.6 =
* Changed the order of general settings

= 5.1.8.5 =
* Removed cloaking links warning to prevent confusion.

= 5.1.8.4 =
* When links are imported, existing links are checked for duplicates

= 5.1.8.3 =
* Set the autoload to on for plugin settings

= 5.1.8.2 =
* Changed the way default settings are set at plugin installation

= 5.1.8.1 =
* Set normal link distribution as default

= 5.1.8 =
* Added option to disable showing links on list pages like category, archives and tag pages.

= 5.1.7.1 =
* Added experimental support for WP Symposium Pro

= 5.1.7 =
* The plugin replaces links for content displayed with the_excerpt

= 5.1.6.5 =
* Fixed bug where keywords were turned into lower case

= 5.1.6.4 =
* Removed API instruction messages if it is already set

= 5.1.6.3 =
* Preventing API calls when API key is not set

= 5.1.6.2 =
* Added option in General Settings for link randomization

= 5.1.6.1 =
* Link additions is randomized for up to 2 entries of the same keyword

= 5.1.6 =
* Link addition is randomized if "Same Keyword" setting is set to 1.

= 5.1.5.11 =
* Fixed bug when the keyword contains regex special chars and delimiters

= 5.1.5.10 =
* Removed deprecated ereg_replace function

= 5.1.5.9 =
* Javascript requests now support https

= 5.1.5.8 =
* Fixed ajax call to allow both http and https requests

= 5.1.5.7 =
* If apikey is added, Upgrade to PRO page becomes API Management

= 5.1.5.6 =
* Changed the look of module management table

= 5.1.5.5 =
* Prevent plugin from adding affiliate links into script tags

= 5.1.5.4 =
* Added option to limit repetitive API calls
* Added option to prevent API request if user overquota

= 5.1.5.3 =
* Added html_entity_decode to wp_redirect after cloaking

= 5.1.5.2 =
* Added function to handle setting options saving

= 5.1.5.1 =
* Fixed keyword count bug

= 5.1.5 =
* Increased the number of posts to get suggestions from
* Shows count for suggested keywords

= 5.1.4.3 =
* Changed permissions so Authors won't see auto affiliate links metabox when writing post

= 5.1.4.2 =
* Added post count for category exclusions
* Categories which are excluded are no longer displayed in the drop-down input 

= 5.1.4.1 =
* Fixed some JS function broken by last update

= 5.1.4 =
* Added page to handle category exclusion

= 5.1.3 =
* Reviewed and tested for Wordpress 4.4

= 5.1.2 =
* Removed configuration links for modules that are not active

= 5.1.1.4 =
* Removed unused options from amazon module

= 5.1.1.2 =
* Changed a short open tag to a normal open tag

= 5.1.1.1 =
* Provided turnaround for wp ecommerce plugin

= 5.1.1 =
* Fixed problems for amazon.co.uk 

= 5.1.0.9  =
* Flushing rewrite rules whenever new settings are saved

= 5.1.0.8 =
* Fixed the problem with dismiss notice link

= 5.1.0.7 =
* Removed some debug logging from previous versions

= 5.1.0.6 =
* Fixed problem when updating ebay affiliate ID

= 5.1.0.5 =
* Fixed compatibility issues with lazy-load plugins

= 5.1.0.4 =
* Changed the scope of some js variables from global to local to prevent conflicts

= 5.1.0.3 =
* Fixed youtube video issue

= 5.1.0.2 =
* Added autoload attribute to "no" for plugin settings saved in wordpress option table

= 5.1.0.1 =
* Fixed problem not displaying links in budypress while no post was set for exclusion

= 5.1.0 =
* Added support for Buddypress custom profile fields

= 5.0.10 =
* Changed post requests from curl to WP HTTP API

= 5.0.9.1 =
* Checked and tested for Wordpress 4.3.1

= 5.0.9 =
* Changed to PHP 5 style constructors

= 5.0.8.1 =
* Added table footer to api management table. Rearranged html in generated links table.

= 5.0.8 =
* Fixed problem with insufficient permissions

= 5.0.7 =
* Fixed some code indentation 
* Fixed exclude post by url when duplicate was found
* Added comments to some blocks of code

= 5.0.6.1 =
* Changed some input labels and some js error messages

= 5.0.6 =
* For mass actions on affiliate links, now there is the option to mass deselect after mass select

= 5.0.5 =
* Fixed getting started page layout
* Added option to disable automatic replacement

= 5.0.4 =
* Reviewed and tested for Wordpress 4.3

= 5.0.3 =
* Removed activation/deactivation drop-down from modules settings pages

= 5.0.2 =
* Reviewed and tested for Wordpress 4.2.4


= 5.0.1 =
* Checked and tested for Wordpress 4.2.3

= 5.0 =
* Reviewed and fixed security issues

= 4.9.9.5 =
* Fixed 2 security issues
* Removed import and export settings features

= 4.9.9.4 =
* Fixed bug where exclude words was not working in some environments

= 4.9.9.3 =
* Changed the submit value of the affiliate links from "Edit" to "Update"

= 4.9.9.2 =
* Added delete option for excluded words

= 4.9.9.1 =
* Added a new line before plugin content is added

= 4.9.9 =
* Added option to exclude words from automatic linking

= 4.9.8.9 =
* Added a field for stats in database

= 4.9.8.8 =
* Added a custom class to all links generated for statistical purposes

= 4.9.8.7 =
* When suggested keywords are used, the input text will be highlighted. 

= 4.9.8.6 =
* Changed the way clickbank categories are displayed

= 4.9.8.5 =
* Minor tweak on homepage display

= 4.9.8.4 =
* Minor fix for some environments

= 4.9.8.3 =
* Tested for Wordpress 4.2.2

= 4.9.8.2 =
* Removed some unused code

= 4.9.8.1 =
* Fixed cloaked links bug that gave to all links the same id

= 4.9.8 =
* Reviewed design and fixed small issues
* Added warning message when there are no links added

= 4.9.7.13 =
* Removed wp prefix from page titles

= 4.9.7.12 -
* Checked and tested with Wordpress 4.2.1

= 4.9.7.11 =
* Checked and adapted to work with Wordpress 4.2

= 4.9.7.10 =
* Stylized save button for affiliate links

= 4.9.7.9 =
* Tested and adapted for Wordpress 4.1.2

= 4.9.7.8 =
* Rearranged some javascript code
* Removed unused leftover code

= 4.9.7.7 =
* Updated plugin instructions on main page and getstarted text.

= 4.9.7.6 =
* Made keyword and url input fields bigger and responsive
* On exclude posts page, made post title column bigger and responsive

= 4.9.7.5.2 =
* Fixed bug causing the same link to be added to all keywords

= 4.9.7.5.1 =
* Fixed homepage display bug generated by previous update

= 4.9.7.5 =
* Added link priority based on the number of words in a keyphrase, and then number of characters

= 4.9.7.4 =
* Changed exclude posts administration page text to reflect latest updates

= 4.9.7.3 =
* Added option to exclude posts by URL

= 4.9.7.2 =
* Removed some debug code

= 4.9.7.1 =
* Added default values for several options

= 4.9.7 =
* Changed database collation to utf8_general_ci
* Added default value for Link frequency to Average.

= 4.9.6.3 =
* Fixed notice message bug

= 4.9.6.2 =
* Fixed exclude posts deletion problem

= 4.9.6.1 =
* Changed some and added some warning messages
* Removed some redundant code.

= 4.9.6 =
* Added extra input filtering for more security

= 4.9.5.1 =
* Added description to exclude rules form

= 4.9.5 =
* Removed "Wp" reference from plugin name and menu titles

= 4.9.4 =
* Added option to exclude posts created before a specific date

= 4.9.3.7 =
* Changed some links to more information.

= 4.9.3.6 =
* Cleaned some jquery code

= 4.9.3.5 =
* Added "no limit" option to same keyword limit

= 4.9.3.2 =
* Tested and updated for wordpress 4.1.1

= 4.9.3.1 =
* Fixed some minor display bugs
* Removed old unused code

= 4.9.3 =
* If the value for "links in every article" is set to 0, then no automated links are added.
* Added "No Links" option to "Link Frequency" select. If this option is set, then the plugins won't display any links
* If the link frequency is set to custom, then the word count will have no effect to the number of links shown

= 4.9.2 =
* Applied wordpress style to submit buttons
* Rearranged some code, removed unnecessary comments, fixed the indenting, removed unnecessary blank lines

= 4.9.1 =
* Updated plugin description

= 4.9 =
* Created a Getting Started page with information on how to use the plugin.

= 4.8.5 =
* Removed some unused content added by the plugin
* Clean javascript debug code
* Rearranged items in main plugin page
* Moved notification message from Amazon page to main plugin page

= 4.8.4 =
* Added option to import previously exported settings
* Updates export option list

= 4.8.3 =
* Fixed API key status reporting messages
* Cache is now reset every 3 days
* Added a comma between keyphrases in generated links page

= 4.8.2 =
* Added mass delete actions for Shareasale and Commission Junction custom links added trough datafeed

= 4.8.1 =
* Removed code not needed anymore
* Added some messages regarding api key status

= 4.8 =
* Updated instructions and messages to reflect recent features added to the plugin
* Cleared the code for debugging variables and old commented code
* Checked and tested the plugin for Wordpress 4.1

= 4.7.6 =
* Custom uploaded links for modules can now be removed directly

= 4.7.5 =
* Uploaded affiliate links will be shown in the Shareasale links page

= 4.7.4 =
* Generated links are now requested, parsed and displayed trough javascript

= 4.7.3.3 =
* Removed a warning message on "generated links page" when there are no links to display
* Added a warning message for server configurations that prevent loading external files trough php.

= 4.7.3.2 =
* Minor fix for some webhosting configuration when validating api key

= 3.7.3.1 =
* Excluded attachments, nav menu items and revisions for content type selection
* Changed some text inside the plugin

= 4.7.3 =
* Improved the way which content is auto affiliate links activated for
* Let user to select any content type for affiliate linking

= 4.7.2 =
* Module submenu items are not shown if they are not activated from API management page.

= 4.7.1 =
* Added Envato options and settings link on API management page

= 4.7 =
* Added module for Envato Marketplace links

= 4.6.4.8 =
* Performance improvement for API users

= 4.6.4.7 =
* Fixed Exclude post bug. Whenever general settings were saved, excluded posts were reset.

= 4.6.4.6 =
* Displayed links from CJ affiliates on the module page

= 4.6.4.6 =
* Checked and tested for wordpress 4.0.1 compatibility issues

= 4.6.4.4 =
* Quick change to general settings: hide the custom link frequency input unless selector is set to custom

= 4.6.4.3 =
* For the situation when the plugin is used for internal linking, now it won't show a link if the target is the same with the post permalink

= 4.6.4.2 =
* Added the ability to export the settings

= 4.6.4.1 =
* Updated texts into the plugin to reflect the latest updates

= 4.6.4 =
* Added walmart activation into module configuration page
* Reordered modules links in main menu
* Changed plugin subpage slugs to prevent conflicts

= 4.6.3 =
* Created module to automatically add Walmart affiliate links

= 4.6.2 =
* Added activation/deactivation options for the latest modules added.
* Added links on API management page to module configuration pages.

= 4.6.1 =
* Created module to automatically add BestBuy links ( trought bestbuy api, working with linkshare affiliates )

= 4.6 =
* Created module to automatically add Ebay affiliate links

= 4.5 =
* Created module to automatically add Commission Junction affiliate links

= 4.4.3.2 =
* Fixed shareasale link addition

= 4.4.3.1 =
* Added an info message on api management page

= 4.4.3 =
* Modules can be activated/deactivated from "Activate PRO Features" page

= 4.4.2.3 =
* Minor fix for plugin notice

= 4.4.2.2 =
* Fixed the way new exclude posts are displayed into the "Exclude Posts" page. Also fixed the exclude posts delete button

= 4.4.2.1 =
* Added option to add a custom value for the number of links to be added in every article 

= 4.4.2 =
* Checked and tested for Wordpress 4.0 release

= 4.4.1 =
* Fixed tld issues for co.jp and co.uk amazon websites

= 4.4 =
* Added support for other amazon websites (de,it,uk,cn,in,es,fr)

= 4.3.5.1 =
* Added alternation for table row background in generated links page

= 4.3.5 =
* Changed the layout of generated links page

= 4.3.4.4 =
* Fixed minor issue when selecting all links

= 4.3.4.3 =
* The same keyword can be set to be linked more than once

= 4.3.4.2 =
* Added list sorting options on the bottom of the list too

= 4.3.4.1 = 
* Fixed a minor issue caused by recent debuggings. 

= 4.3.4 =
* The link frequency is not adjusted by the lenght of the post

= 4.3.3.6 =
* Fixed the problems with adding links on fresh installs.

= 4.3.3.5 =
* Checked the compatibility with the latest wordpress version ( 3.9.2 )

= 4.3.3.4 =
* Added links to support forum and faq section from different pages of the plugin

= 4.3.3.3 =
* Small tweak for ssl installations

= 4.3.3.2 =
* Affiliate links now open in new windows by default on a fresh installation

= 4.3.3.1 =
* Added links to support forum and FAQ section.

= 4.3.3 =
* Added option to select if links should be displayed on posts only, pages only, or both.
* Excluded all other post types except posts and pages for execution.

= 4.3.2 =
* Order capability for affiliate links added

= 4.3.1.1 =
* Updated FAQ section
* Added some more info text inside the plugin

= 4.3.1 =
* Added option to delete multiple links at the same time
* Added option to select all links on the page

= 4.3.0.3 =
* Added a confirmation box when the settings are updated

= 4.3.0.2 =
* Added an index.php file in every directory so directory content won't be seen from outside in certain environments

= 4.3.0.1 =
* Fixed a small bug caused by the latest update

= 4.3 =
* Added support for international chars ( european, russian, chinese, japanese, korean ). This has to be activated from plugin General settings page and the database should have the right charset, utf8_general_ci seems to be working well with this.

= 4.2.8 =
* Removed some development code  from metabox
* If a post does not have any links generated, it will show a message instead of a blank cell
* After a link is added, the link input will show again http:// so the user can add only the link after.

= 4.2.7 =
* Rearranged items in excluded post page

= 4.2.6.1 =
* Fixed some error messages

= 4.2.6 =
* Generated links page won't show if there is not an api key added.

= 4.2.5 =
* User have the option to add his own css class to be assigned to automated links.

= 4.2.4 =
* performance improvements

= 4.2.3 =
* Prevented duplicate posts to show in generated links

= 4.2.2 =
* Show post exclusion status in generated links page

= 4.2.1 =
* Added a metabox when editing posts to exclude them from link addition

= 4.2 =
* Created a new page for displaying Automated generated links.
* The generated links page shows Amazon, Clickbank and Shareasale links.
* The generated links page has its own submenu item

= 4.1.2 =
* Fixed a bug that displayed column headers in every row from last update

= 4.1.1 =
* Displaying generated links on clickbank page

= 4.1.0 =
* More details added to api management page

= 4.0.9 =
* Additional check on exclude post adding. If there is already a post added with that id.

= 4.0.8 = 
* Removed unused input box on exclude posts page

= 4.0.7 =
* Fixed some issues with amazon categories.

= 4.0.6 =
* Added api key verification

= 4.0.5 =
* Minor bug fixes

= 4.0.4 =
* Rearranged API management page

= 4.0.3 =
* Removed revenue sharing.

= 4.0.2 =
* Removed unused Modules menu

= 4.0.1 =
* Tested with Wordpress 3.9.1 version

= 4.0 =
* Added Premium features into the plugin
* Amazon links can be added automatically based on your content
* Clickbanks links will be added automatically based on your content
* Removed some old code

= 3.10.9 =
* Fixed a minor bug created in previous release

= 3.10.8 =
* Removed some backup files

= 3.10.7 =
* Fixed the bug that made links to be added inside <h> tags

= 3.10.6 =
* Updated plugin description

= 3.10.5 =
* Fixed links home page display when using amazon, clickbank or shareasale modules.

* 3.10.4 = 
* Added a notice about PRO features

= 3.10.3 =
* Rearrenged keyword suggestion and removed short ( under 5 chars ) and all numeric keyphrases

= 3.10.2 =
* Removed some debug leftover code

= 3.10.1 =
* Hide the advanced features if the api key is not set

= 3.10 =
* Added a new premium feature: fully automated shareasale links

= 3.9.2.2 =
* Prepared the plugin for 3.9 Wordpress update

= 3.9.1 =
* Moved the api script from wp head to wp_print_scripts

= 3.9 =
* New feature: Amazon links can be added automatically. 

= 3.8.3.3 =
* Fixed a bug that caused the api connection to fire multiple times.

= 3.8.3.2 =
* Now post url is sent to ajax

= 3.8.3.1 =
* Added notice about the recent bug fix

= 3.8.3 =
* Fixed a major bug that prevented users adding new links.

= 3.8.2.1 =
* Added value for submit affiliate links button so the browser won't translate it. 

= 3.8.2 =
* Cleaned the code generated by the plugin
* Rearranged javascript code.

= 3.8.1 =
* Removed a notice message

= 3.8 =
* Major improvements on replacement engine, site speed and keyword matching
* New functionality added: Clickbank links can be automatically extracted and displayed, based on user selection
* To reduce page load on the plugin, the clickbank link search and replacement is done on our servers
* The access to the servers is done trough an API key
* For clickbank links, the user inputs his affiliate code, prefered category and minimum gravity. All links are automatically generated, there is no need to add keywords for amazon.

= 3.7.2 =
* Reordered some code for better performance and visibility

= 3.7.1 =
* Tweaked the code for better performance
* Started to change the coding style for future development

= 3.7 =
* Added is_main_query check to prevent the plugin to process anything if it is outside of the main loop

= 3.6.9 =
* Improved significantly the processing time of the affiliate links replacement, lowering the loading speed by more than 10 times

= 3.6.8.1 =
* Renamed the main css file

= 3.6.8 =
* Completely removed the tabs user interface

= 3.6.7 =
* Now the modules add a new submenu item under Wp Auto Affiliate Links instead of a tab on the main page.

= 3.6.2.7 =
* Moved Import and Export to their own submenu pages

= 3.6.2.6 =
* Fixed a bug reported by some users regarding the php short tags usage

= 3.6.2.5 =
* Instead of a text box to enter the maximum number of link to be displayed in an article, there is a select input with Link Frequency options, from Low to High with 5 levels

= 3.6.2.4 =
* Module section have a separate menu item

= 3.6.2.3 =
* Exclude posts have a separate menu item

= 3.6.2.2 =
* Code cleaning and separated in multiple files

= 3.6.2 =
* Separated the code in more files ( install and cloaking )

= 3.6.1 =
* Improved the design for settings page

= 3.6.0.2 =
* Fixed edit links forms

= 3.7.0.1 =
* Fixed wrong permissions problems, based on the following ticket: http://wordpress.org/support/topic/permission-errors-2

= 3.6 =
* Moved General Settings page outside of plugin main page, in order to separate the options from the main linking area

= 3.5.7 =
* Keywords with the same affiliate link will be combined
* Added a notice to let people know about the pro version

= 3.5.6.1 =
* Changed permisions from "manage_options" to "publish_pages" so the editors can use the plugin

= 3.5.6 =
* Added a top menu for the plugin

= 3.5.5 = 
* Changed the order of the panels. Now the panel with affiliate links is loaded first.

= 3.5.4.4 =
* Eliminated keyword suggestion if they were already added

= 3.5.4.3 = 
* All suggested keywords are not hidden to avoid confusion.

= 3.5.4.2 = 
* When suggested keywords are added, they will be appended to the current input, instead of replacing the text inside

= 3.5.4.1 = 
* Changed some simple javascript code into jquery ( for suggested keywords )

= 3.5.4 = 
* Added 100 more keywords to suggestion list. The list will be hidden but upon a click it will expand and the most 100 keywords will be displayed with the possibility to be added to the form.

= 3.5.3.1 =
* Fixing some code that could cause problems to some environments

= 3.5.3 =
* Corrected some spelling errors

= 3.5.2 =
* Trying to fix the nofollow radio selector which semms to not working on some environments

= 3.5.1 = 
* Fixed Nofollow radio selector
* Tested the plugin with 3.6.1 Wordpress version
* Minor interface changes

= 3.4 =
* Exclude posts area now have instant post title and status recognition trough AJAX
* If the excluded post does not exist then it will be not added and a warning message will be triggered.

= 3.3.1 = 
* Fixed some minor issues and removed some unused code

= 3.3 =
* Fixed the way rewrite engine works, and made it available for non-permalinks structures.

= 3.2.2 =
* Module integration completed. Now modules can be added into /modules under plugin directory.

= 3.2.1 =
* Added module support, and created first dummy module

= 3.2 =
* Added the baselines for modules support

= 3.1.4 =
* Changed the JS code of tabs management

= 3.1.3 =
* Added the option to choose a different separator ( than those suggested in dropdown ) for datafeed import

= 3.1.2 =
* Changed the input type to select for separator option on file export

= 3.1.1 =
* Added separator option for export

= 3.1 =
* Added option to export all links

= 3.0.3 =
* Exclude post list will indicate the status of a post, and if it exist or not

= 3.0.2 =
* Added select instead of input for datafeed column delimiter

= 3.0.1 =
* Added option to select the delimiter for importing datafeed.

= 3.0 =
* Added option to import links trough a datafeed

= 2.9.5.8 =
* In exclude links menu you can now view the article

= 2.9.5.7 =
* Fixed menu design (current tab has different style)

= 2.9.5.6 =
* In Exclude ID's and Add Affiliates Link you can now delete just after delete 
* Also this update should fix some bugs that users has been reported
  
= 2.9.5.5 =
* Fixed edit bug and made some modifications that fixed some compatibility problems

= 2.9.5.4 =
* Fixed add new link problem (link was visible just after refresh)

= 2.9.5.3 =
* Fixed the conflict with the "add media" button

= 2.9.5.2 =
* Update to fix the bug from previous release that prevented users to add new links. 
* Update to fix the insert link and add media conflicts

= 2.9.5.1 =
* Changed the name of an included file to avoid any conflicts

= 2.9.5 =
* Moved exclude posts into separate tab
* Make delete and add exclude posts AJAX based

= 2.9.4 =
* General setings also converted to AJAX 

= 2.9.3 =
* Imported tabs menu from paid version and
* Some changes to the design 
* Better file and folder structure

= 2.9.2 =
* Added icon for delete button
* Add link is also done through AJAX for a better user experience

= 2.9.1 =
* Delete link functionality is done now through AJAX (without refreshing page)

= 2.9 =
* Updated the database table fields to match the pro version of the plugin.

= 2.8 =
* Made dbDelta function to work. When the plugin is upgraded, the database tables are also upgraded. 

= 2.7.3 =
* Added uninstall file. When the plugin is uninstalled ( deleted from the plugins administration ), the database is cleaned. 

= 2.7.2 =
* Added a class attribute to every automated links, so they can have a different desing from other links, if required.

= 2.7.1 =
* Removed some reduntant code, blank lines and spaces to clean the code and make it smaller

= 2.7 =
* Fixed some minor issues and display disorders

= 2.6.1 =
* Changed description to match the latest udpates

= 2.6 =
* Modified the cloaking system to work with the latest versions of wordpress

= 2.5.1 =
* Fixed an error that generated a warning and in some configurations prevented the execution

= 2.5 = 
* Added option to make the links nofollow or dofollow

= 2.4.1 =
* Removed an error reporting issue

= 2.4 =
* Added the ability to selest do open links in same or new window.

= 2.3.3 =
* Fetching the most used 20 words instead of 10

= 2.3.2 =
* Changed the admin panel settings menu link name from Manage Affiliate Links to Wp Auto Affiliate Links to eliminate any confusion.
* Changed some function names to prevent clashes with other plugins

= 2.3.1 =
* Added option to choose if you want to show original or cloaked links. 

= 2.3 = 
* Now all affiliate links are cloaked. Contribution of Jos Steenbergen

= 2.2.3.2 =
* Verification, reindenting and commenting the plugin code

= 2.2.3.1 = 
* Fixed some notifications to not be displayed

= 2.2.3 =
* Fixed a bug where some odd characters were added if an extra comma was added

= 2.2.2 =
* Added option to exclude specific posts or pages from displaying affiliate links, based on post ID.

= 2.2.1 =
* Fixed a bug when links were limited to 1 on post pages

= 2.2 =
* Added option to limit the number of times a keyword appear in a post

= 2.1.1 =
* Fixed some bugs from previous releases: errors generated when no keyword was set

= 2.1 =
* Added select option to choose if the links should be added on the homepage too

= 2.0 =
* Added auto-suggestions for keywords based on most used words in the content

= 0.1.9.2 =
* Made changes to the user interface for a better experience
* Added confirmation alert for delete links

= 0.1.9.1 =
* Added option to donate to support the continued development

= 0.1.9 =
* Made the link to open in a new window by default

= 0.1.8 =
* Fixed the bug when if no keyword was set, a warning message appears

= 0.1.7 =
* Revamped the replacing engine to solve the bugs and problems with the code.

= 0.1.6 =
* Changed some actions on forms to minimize the risks of collision with other plugins

= 0.1.5 =
* Fixed the bug where the apostrophe character was rendered inappropiate and displaying wrong code

= 0.1.4 =
* Added option to edit links and keywords that already exist

= 0.1.3 =
* Moved the add/delete actions to admin_init
* Added redirects for add/delete actions so if you hit refresh the same action won't be repeated

= 0.1.2 =
* Fixed the issue where all links were decapitalized.

= 0.1.1 =
* Fixed the issue where links are accidentaly break html code. 

= 0.1 =
* This is the first version of the plugin. Any suggestions and feedback is highly appreciated.
