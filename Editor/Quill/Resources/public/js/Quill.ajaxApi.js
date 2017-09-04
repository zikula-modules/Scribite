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
     * Collection of editor instances by domId
     * @type Object
     */
    this.editorCollection = {};

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
        if (this.editorCollection === undefined) {
            this.editorCollection = {};
        }

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
        var textArea, editorElem, quill;

        textArea = jQuery('#' + domId);
        editorElem = jQuery('<div />', { id: domId + 'Editor' }).html(textArea.val());
        textArea.parent().append(editorElem);
        textArea.addClass('hidden');
        quill = new Quill('#' + domId + 'Editor', editorOptions);
        quill.on('text-change', function () {
            textArea.val(quill.container.firstChild.innerHTML);
        });

        if (this.editorCollection === undefined) {
            this.editorCollection = {};
        }
        this.editorCollection[domId] = quill;
    };
    window.createEditor = this.createEditor;

    /**
     * destroy the editor for one textarea
     * @param {string} domId
     * @returns {null|undefined}
     */
    this.destroyEditor = function(domId)
    {
        if (typeof this.editorCollection[domId] === 'undefined') {
            return;
        }
        this.editorCollection[domId] = null;
    };

    /**
     * Retrieve the contents of the edited textarea
     * @param {string} domId
     * @returns {string}
     */
    this.getEditorContents = function(domId)
    {
        return this.editorCollection[domId].container.firstChild.innerHTML;
    };
};
