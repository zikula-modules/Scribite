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
 * @param {object} iParams collection of editor params
 * @returns {ScribiteUtil}
 */
var ScribiteUtil = function(editorOptions)
{
    /**
     * Render the html to the original element from the editor
     * @param {string} domId
     * @returns {null}
     */
    this.renderToElement = function(domId)
    {
    };

    /**
     * Render the html to all the elements that have editors
     * @returns {undefined}
     */
    this.renderAllElements = function()
    {
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
        jQuery('#' + domId).quill(editorOptions);
    };
    window.createEditor = this.createEditor;

    /**
     * destroy the editor for one textarea
     * @param {string} domId
     * @returns {null|undefined}
     */
    this.destroyEditor = function(domId)
    {
        jQuery('#' + domId).quill('destroy');
    };

    /**
     * Retrieve the contents of the edited textarea
     * @param {string} domId
     * @returns {string}
     */
    this.getEditorContents = function(domId)
    {
        return jQuery('#' + domId).quill('code');
    };
};
