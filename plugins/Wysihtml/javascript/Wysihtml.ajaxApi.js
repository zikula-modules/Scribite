/**
 * Collection of editor instances by domId
 * @type Object
 */
var editorCollection = {};

/**
 * JS Class to implement the Scribite API to allow modules
 * to initialize Scribite editors and manipulate via ajax
 *
 * methods that are mandatory:
 *   createEditors();
 *
 * methods that are used typical JS/ajax calls
 *   renderAllElements();
 *
 * Other methods can be useful if defined
 *
 * @param {text} ihtml the html for the toolbar
 * @returns {ScribiteUtil}
 */
var ScribiteUtil = function()
{
    /**
     * Render the html to the original element from the editor
     * @param {string} domId
     * @returns {null}
     */
    this.renderToElement = function(domId)
    {
        // the textarea automatically contains the rendered html so there is
        // nothing to do here
    };

    /**
     * Render the html to all the elements that have editors
     * @returns {undefined}
     */
    this.renderAllElements = function()
    {
        // the textarea automatically contains the rendered html so there is
        // nothing to do here
    };

    /**
     * create all the editors for the appropriate textareas
     * @returns {undefined}
     */
    this.createEditors = function()
    {
        jQuery('textarea').each(function(index) {
            var areaId = jQuery(this).attr('id');
            // ensure textarea not in disabled list or has 'noeditor' class
            if (jQuery.inArray(areaId, disabledTextareas) == -1 && !jQuery('#' + areaId).hasClass('noeditor')) {
                // attach the editor
                createEditor(areaId);
                // notify subscriber
                insertNotifyInput(areaId);
            }
        });
    };

    /**
     * create an editor for one textarea
     * @param {string} domId
     * @returns {undefined}
     */
    this.createEditor = function(domId)
    {
        // Insert editor header
        var toolbar = jQuery('<div>', {
            id: 'toolbar_' + domId,
            style: 'display: none'
        });
        // toolbarHtml is a global var
        toolbar.html(toolbarHtml);

        var textArea = jQuery('#' + domId);
        textArea.parent().prepend(toolbar);

        editorCollection[domId] = new wysihtml.Editor(domId, {
            toolbar: 'toolbar_' + domId,
            parserRules: wysihtmlParserRules
        });
    };
    window.createEditor = this.createEditor;

    /**
     * destroy the editor for one textarea
     * @param {string} domId
     * @returns {null|undefined}
     */
    this.destroyEditor = function(domId)
    {
        if (typeof editorCollection[domId] === 'undefined') {
            return;
        }
        editorCollection[domId].destroy();
        editorCollection[domId] = null;
    };

    /**
     * Retrieve the contents of the edited textarea
     * @param {string} domId
     * @returns {string}
     */
    this.getEditorContents = function(domId)
    {
        // the textarea automatically contains the rendered html
        return jQuery('#' + domId).val();
    };
};
