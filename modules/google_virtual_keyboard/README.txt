$Id: README.txt,v 1.1 2010/09/03 11:43:52 confiz Exp $ 

CONTENTS OF THIS FILE
---------------------
* Introduction
* Requirements
* Installation
* Settings
* Contact

INTRODUCTION
------------
This module allows you to provide multi-language text input for your drupal website
-- using google virtual keyboard

The module brings extra features:

1. User can specify 'drupal paths' over which google virtual keyboard is to be enabled.

2. User can select as many languages as google supports for their website text input.

3. User can also customize the theme for language drop down widget to be shown on their
   site pages

REQUIREMENTS
------------
PHP 5.2 or higher.
Drupal 6.x.
Jquery Plugin: http://jqueryui.com/download [VERSION: 1.8.4 and COMPONENT: Draggable]

MODULE DEPENDENCY
-----------------
jquery_colorpicker: http://drupal.org/project/jquery_colorpicker

INSTALLATION
------------
Following steps are needed to install google_virtual_keyboard:

1. Install module as usual, see http://drupal.org/node/70151 for further information.
2. Go to http://jqueryui.com/download and download jquery-ui-1.8.4.custom.zip
  [VERSION: 1.8.4 and COMPONENT: Draggable]
3.Extract the js folder from the zip file to the folder google_virtual_keyboard/js.
4.If you have extracted the contents right, make sure the following files should exists:
   i. [path to modules folder]/google_virtual_keyboard/js/jquery-1.4.2.min.js
  ii. [path to modules folder]/google_virtual_keyboard/js/jquery-ui-1.8.4.custom.min.js

SETTINGS
--------
1. Go to the Site Configuration >> Google virtual keyboard settings page
2. Follow these steps to setup Google virtual keyboard:
    i. Specify paths for drupal pages on which you want google virtual keyboard to be enabled
   ii. Select languages for which you want to enable google virtual keyboard.
  iii. Change the background and foreground color for the language dropdown widget to be shown at
       top right corner on drupal paths specified on  step 1.

NOTE
-----
The keyboard would be enabled for either text field or text area on a given path in the settings page.
It would not be shown on pages with missing text input.

CONTACT
-------
Confiz Solutions: http://www.confiz.com
Developer Contact: shahzadi.samia@confiz.com
Developer Contact: asim.bashir@confiz.com
