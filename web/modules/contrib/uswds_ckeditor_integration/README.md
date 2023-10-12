CONTENTS OF THIS FILE
---------------------

 * Introduction
 * Features
 * Requirements
 * Installation
 * Configuration
 * Maintainers


INTRODUCTION
------------

With the USWDS library (https://designsystem.digital.gov/) becoming
a requirement for government websites thought it would be useful to
have some integration with the ckeditor. The primary goal is to make
it easy for a user to utilize and inject USWDS classes and components
directly into the ckeditor without opening up the source.

This module will provide 2 USWDS text profiles
1. Will be USWDS components in ckeditor buttons.
2. Will be utilizing https://www.drupal.org/project/uswds_paragraph_components to embed paragraphs into the ckeditor.

For a full description of this module, visit the project page:
See https://www.drupal.org/project/uswds_ckeditor_integration

To submit bug reports and feature suggestions, or track changes:
See https://www.drupal.org/project/issues/uswds_ckeditor_integration


FEATURES
--------

* Accordions: This module includes an accordion
  button that has to be placed into the editor first. Then clicking on
  it the user can add accordions with uswds classes auto added.
  See https://designsystem.digital.gov/components/accordion/

* Alerts: This module includes an Alert button that has to be placed within the ckeditor.
  See https://designsystem.digital.gov/components/alert/

* Grid Layout: This module includes a grid template button that has to be placed
  into the ckeditor. See https://designsystem.digital.gov/utilities/layout-grid/

* Process List: Using ckeditor templates inject the markup for USWDS Process List.
  See https://designsystem.digital.gov/components/process-list/

* Summary Box: Using ckeditor templates inject the markup for USWDS Summary Box into the ckeditor.
  See https://designsystem.digital.gov/components/summary-box/

* Tables: The user can add tables just as they normally would but
  in the properties tab there are options to add uswd table features.
  Some classes are auto added.
  See https://designsystem.digital.gov/components/table/


REQUIREMENTS
------------

This module requires:

* PHP > 7.4 (for now with hopes to be only PHP8 sooner than later)
* USWDS Library (Recommend following steps for see https://www.drupal.org/project/uswds_base)
* For Ckeditor Templates to work you will need to include the templates' plugin. See Drupal page for how to install.
* For USWDS Paragraphs profile to work you will need https://www.drupal.org/project/uswds_paragraph_components.


INSTALLATION
------------

Install as you would normally install a contributed Drupal module. Visit:
https://www.drupal.org/docs/extending-drupal/installing-drupal-modules
for further information.


CONFIGURATION
-------------

Each component requires specific configuration

If filtering HTML be sure to include the following
```
<a href hreflang> <em> <strong> <cite> <blockquote cite> <code> <ul type class> <ol start type class> <li> <dl> <dt>
<dd> <h2 id class> <h3 id class> <h4 id class> <h5 id class> <h6 id class>
<img src alt data-entity-type data-entity-uuid data-align data-caption>
<table class style width height> <caption> <tbody> <thead> <tfoot> <th data-sortable scope id headers colspanv data-label>
<td id headers colspan data-label> <tr scope id> <u> <s> <sup> <sub>
<drupal-media data-entity-type data-entity-uuid> <div id class data-*> <button class aria-expanded aria-controls> <p class>
```
* Accordion
  1. Go to the text profile you wish to include USWDS accordions.
  2. Move the Accordion button into the toolbar.

* Alerts
  1. Go to the text profile you wish to include USWDS alerts.
  2. Move the Alert button into the toolbar

* Grid
  1. Go to the text profile you wish to include USWDS grid templates.
  2. Move the grid button into the toolbar.

* Lists
  1. Go to the text profile you wish to override `<ul>` and `<ol>` lists
  2. In the Ckeditor USWDS Overrides tab
  3. Check Override Lists

* Summary Box / Process List
  1. Go to the text profile you wish to include ckeditor templates
  2. Move the templates button into the toolbar.

* Table
  1. Go to the text profile you wish to include USWDS table.
  2. Under "CKEditor plugin settings" make sure "Override table plugin with USWDS"
     is checked. By default, it will be.
  3. If you want to use USWDS table stacked click "USWDS Stacked Table Attributes"
     filter

MAINTAINERS
-----------

Current maintainers:
* Stephen Mustgrave (smustgrave) (https://www.drupal.org/u/smustgrave)
