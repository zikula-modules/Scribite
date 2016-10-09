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
 * @param {object} editorOptions collection of editor params
 * @returns {ScribiteUtil}
 */
var ScribiteUtil = function(editorOptions)
{
    /**
     * Collection of editor params
     * @type Object
     */
    this.params = editorOptions;

    /**
     * Render the html to the original element from the editor
     * @param {string} domId
     * @returns {null}
     */
    this.renderToElement = function(domId)
    {
        editorCollection[domId].updateElement();
    };

    /**
     * Render the html to all the elements that have editors
     * @returns {undefined}
     */
    this.renderAllElements = function()
    {
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
            CKEDITOR.instances[instance].setData('', function() {
                this.checkDirty();
            });
        }
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
        // override parameters
        var oParams = new Object();
        CKEDITOR.tools.extend(oParams, this.params);
        var paramOverrideObj = window['paramOverrides_' + domId];
        if (typeof paramOverrideObj !== 'undefined') {
            // override existing values in the `params` obj
            CKEDITOR.tools.extend(oParams, paramOverrideObj, true);
        }
        if (typeof paramOverrides_all !== 'undefined') {
            // override existing values in if 'all' is set as textarea for override
            // overrides individual textarea overrides!
            CKEDITOR.tools.extend(oParams, paramOverrides_all, true);
        }

        jQuery('#' + domId).ckeditor(oParams);
    };
    window.createEditor = this.createEditor;

    /**
     * destroy the editor for one textarea
     * @param {string} domId
     * @returns {null|undefined}
     */
    this.destroyEditor = function(domId)
    {
        if (typeof jQuery('#' + domId).ckeditor().editor === 'undefined') {
            return;
        }
        jQuery('#' + domId).ckeditor().editor.destroy();
        jQuery('#' + domId).ckeditor().editor = null;
    };

    /**
     * Retrieve the contents of the edited textarea
     * @param {string} domId
     * @returns {string}
     */
    this.getEditorContents = function(domId)
    {
        // see http://docs.ckeditor.com/#!/guide/dev_jquery-section-the-.val%28%29-method
        return jQuery('#' + domId).val();
    };
};
