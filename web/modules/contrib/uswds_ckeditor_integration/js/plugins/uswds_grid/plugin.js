/**
 * @file
 * Bootstrap Grid plugin.
 */

(function ($, Drupal, CKEDITOR) {

  "use strict";

  function findGridWrapper(element) {
    return element.getAscendant(function (el) {
      if (typeof el.hasClass === 'function') {
        return el.hasClass('uswds_grid');
      }
      return false;
    }, true);
  }

  function getSelectedGrid(editor) {
    let selection = editor.getSelection();
    let selectedElement = selection.getStartElement();

    if (selectedElement && selectedElement.hasClass('uswds_grid')) {
      return selectedElement;
    }

    return findGridWrapper(selectedElement);
  }

  function extractClasses(element, base, reverse) {
    reverse = reverse || false;
    let classes = '';

    if (typeof element.getAttribute === 'function') {
      classes = element.getAttribute('class');
    }
    else if (typeof element.className === 'string') {
      classes = element.className;
    }

    // Failsafe.
    if (!classes) {
      return '';
    }

    let classlist = classes.split(" ").filter(function (c) {
      if (c.lastIndexOf('cke_', 0) === 0) {
        return false;
      }
      return reverse ? c.lastIndexOf(base, 0) === 0 : c.lastIndexOf(base, 0) !== 0;
    });

    return classlist.length ? classlist.join(" ").trim() : '';
  }

  CKEDITOR.plugins.add('uswds_grid', {
    requires: 'widget',
    icons: 'uswds_grid',
    init: function (editor) {

      // Allow widget editing.
      editor.widgets.add('uswds_grid_widget', {
        template:
            '<div class="uswds_grid"></div>',
        allowedContent: '',
        requiredContent: 'div(uswds_grid)',
        upcast: function (element) {
          return element.name === 'div' && element.hasClass('uswds_grid');
        },
        init: function () {
          let row = this.element.findOne('.grid-row');
          if (row) {
            let cols = row.find('> div');
            for (let i = 1; i <= cols.count(); i++) {
              this.initEditable('grid-col-' + i, {
                selector: '.row > div:nth-child(' + i + ')',
                allowedContent: '',
              });
            }
          }
        },

      });

      // Add the dialog command.
      editor.addCommand('uswds_grid', {
        allowedContent: 'div[class, data-*]',
        requiredContent: 'div[class, data-*]',
        modes: {wysiwyg: 1},
        canUndo: true,
        exec: function (editor) {
          let existingValues = {};
          let existingElement = getSelectedGrid(editor);

          // Existing elements need to pull the settings.
          if (existingElement) {
            existingValues.saved = 1;
            let existing_row;

            // Parse out the data we need.
            existingValues.container_wrapper_class = extractClasses(existingElement, 'uswds_grid');
            let first_element = existingElement.findOne('> div');

            // We have a container if no row (container can have no class).
            if (!first_element.hasClass('grid-row')) {
              existingValues.add_container = 1;
              existingValues.container_class = extractClasses(first_element, 'grid-container');

              // Container can have no classes, so need direct compare.
              let container_type = extractClasses(first_element, 'grid-container', true);
              if (container_type.length) {
                if (container_type.indexOf('container-fluid') !== -1) {
                  existingValues.container_type = 'fluid';
                }
                else {
                  existingValues.container_type = 'default';
                }
              }

              // Get row info.
              existing_row = first_element.findOne('.grid-row');
            }
            else {
              existing_row = first_element;
            }

            let row_classes = extractClasses(existing_row, 'grid-row');
            existingValues.no_gutter = row_classes.indexOf('no-gutters') !== -1 ? 1 : 0;
            existingValues.row_class = row_classes.replace('no-gutters', '');

            // Cols.
            let existing_cols = existing_row.find('> div');
            existingValues.num_columns = existing_cols.count();

            // Layouts.
            existingValues.breakpoints = {
              none: {layout: existing_row.getAttribute('data-row-none')},
              card: {layout: existing_row.getAttribute('data-row-card')},
              card_lg: {layout: existing_row.getAttribute('data-row-card-lg')},
              mobile: {layout: existing_row.getAttribute('data-row-mobile')},
              mobile_lg: {layout: existing_row.getAttribute('data-row-mobile-lg')},
              tablet: {layout: existing_row.getAttribute('data-row-tablet')},
              tablet_lg: {layout: existing_row.getAttribute('data-row-tablet-lg')},
              desktop: {layout: existing_row.getAttribute('data-row-desktop')},
              desktop_lg: {layout: existing_row.getAttribute('data-row-desktop-lg')},
              widescreen: {layout: existing_row.getAttribute('data-row-widescreen')}
            };

            for (let i = 1; i <= existingValues.num_columns; i++) {
              let col = existing_cols.getItem(i - 1);
              let col_class = extractClasses(col, 'col');
              let key = 'col_' + i + '_classes';
              existingValues[key] = col_class;
            }

          }

          let uswds_wrapper;
          let existing_row;
          let existing_cols;
          // Fired when saving the dialog.
          let saveCallback = function (values) {
            editor.fire('saveSnapshot');

            // Always output a wrapper.
            let wrapper_class = 'grid-container';
            // eslint-disable-next-line no-undefined
            if (values.container_wrapper_class !== undefined) {
              wrapper_class += ' ' + values.container_wrapper_class;
            }
            if (existingElement) {
              existingElement.setAttribute('class', wrapper_class);
            }
            else {
              uswds_wrapper = editor.document.createElement('div', {attributes: {class: wrapper_class}});
            }

            let row;

            // Add the row.
            let row_attributes_array = {
              class: values.row_class,
              'data-row-none': values.breakpoints.none ? values.breakpoints.none.layout : '',
              'data-row-card': values.breakpoints.card ? values.breakpoints.card.layout : '',
              'data-row-card-lg': values.breakpoints.card_lg ? values.breakpoints.card_lg.layout : '',
              'data-row-mobile': values.breakpoints.mobile ? values.breakpoints.mobile.layout : '',
              'data-row-mobile-lg': values.breakpoints.mobile_lg ? values.breakpoints.mobile_lg.layout : '',
              'data-row-tablet': values.breakpoints.tablet ? values.breakpoints.tablet.layout : '',
              'data-row-tablet-lg': values.breakpoints.tablet_lg ? values.breakpoints.tablet_lg.layout : '',
              'data-row-desktop': values.breakpoints.desktop ? values.breakpoints.desktop.layout : '',
              'data-row-desktop-lg': values.breakpoints.desktop_lg ? values.breakpoints.desktop_lg.layout : '',
              'data-row-widescreen': values.breakpoints.widescreen ? values.breakpoints.widescreen.layout : ''
            };
            let row_attributes = {
              class: values.row_class,
            };
            for (let i = 0; i < row_attributes_array.length; i++) {
              row_attributes_array[i] && row_attributes.push(row_attributes_array[i]);
            }

            if (existingElement) {
              existing_row.setAttributes(row_attributes);
            }
            else {
              row = editor.document.createElement('div', {attributes: row_attributes});
            }

            // Iterated through the cols.
            for (let i = 1; i <= values.num_columns; i++) {
              let key = 'col_' + i + '_classes';
              if (existingElement) {
                existing_cols.getItem(i - 1).setAttribute('class', values[key]);
              }
              else {
                let col = editor.document.createElement('div', {attributes: {class: values[key]}});
                let p = editor.document.createElement('p');
                p.setHtml('Column ' + i + ' content');
                col.append(p);
                row.append(col);
              }
            }

            // Append to Wrapper. @TODO: Support for dropping existing
            // container.
            if (!existingElement) {
              if (values.add_container) {
                let container = editor.document.createElement('div', {attributes: {class: values.container_class}});
                container.append(row);
                uswds_wrapper.append(container);
              }
              else {
                uswds_wrapper.append(row);
              }
              editor.insertHtml(uswds_wrapper.getOuterHtml());
            }

            // Final save.
            editor.fire('saveSnapshot');
          };


          let dialogSettings = {
            dialogClass: 'uswds_grid-dialog',
          };

          // Open the entity embed dialog for corresponding EmbedButton.
          Drupal.ckeditor.openDialog(editor, Drupal.url('uswds_ckeditor_integration/dialog/' + editor.config.drupal.format), existingValues, saveCallback, dialogSettings);
        }
      });

      // UI Button
      editor.ui.addButton('uswds_grid', {
        label: 'Insert USWDS Grid',
        command: 'uswds_grid',
        icon: this.path + 'icons/uswds_grid.png'
      });

      // Context menu to edit existing.
      if (editor.contextMenu) {
        editor.addMenuGroup('uswdsGridGroup');
        editor.addMenuItem('uswdsGridItem', {
          label: 'Edit Grid',
          icon: this.path + 'icons/uswds_grid.png',
          command: 'uswds_grid',
          group: 'uswdsGridGroup'
        });

        // Load nearest grid.
        editor.contextMenu.addListener(function (element) {
          if (findGridWrapper(element)) {
            return {uswdsGridItem: CKEDITOR.TRISTATE_OFF};
          }
        });
      }

    }
  });

})(jQuery, Drupal, CKEDITOR);
