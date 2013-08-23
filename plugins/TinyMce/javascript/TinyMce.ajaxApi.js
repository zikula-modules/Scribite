/**
 * JS Class to implement the Scribite API to allow Modules
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
 * @returns {ScribiteUtil}
 */
var ScribiteUtil = function()
{
    /**
     * Collection of editor instances by domId
     * @type Object
     */
    var editorCollection = {};

    /**
     * Render the html to the original element from the editor
     * @param {string} domId
     * @returns {null}
     */
    this.renderToElement = function(domId)
    {
        //
    };
    /**
     * Render the html to all the elements that have editors
     * @returns {undefined}
     */
    this.renderAllElements = function()
    {
        for (var i = 0; i < tinyMCE.editors.length; i++) {
            tinyMCE.editors[i].save();
            tinyMCE.editors[i].setContent('');
        }
    };
    /**
     * create all the editors for the appropriate textareas
     * @returns {undefined}
     */
    this.createEditors = function()
    {
        scribite_init();
    };
    /**
     * create an editor for one textarea
     * @param {string} domId
     * @returns {undefined}
     */
    this.createEditor = function(domId)
    {
        //
    };
    /**
     * destroy the editor for one textarea
     * @param {string} domId
     * @returns {null|undefined}
     */
    this.destroyEditor = function(domId)
    {
        //
    };
    /**
     * Retrieve the contents of the edited textarea
     * @param {string} domId
     * @returns {string}
     */
    this.getEditorContents = function(domId)
    {
        //
    };
    /**
     * Generate a randomn string of n alpha characters
     * @see http://stackoverflow.com/questions/1349404/generate-a-string-of-5-random-characters-in-javascript
     * @param {number} n the number of characters
     * @returns {String}
     */
    this.generateString = function(n)
    {
        n = typeof n !== 'number' ? n : 5;
        var text = "";
        var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
        for( var i=0; i < n; i++ ) {
            text += possible.charAt(Math.floor(Math.random() * possible.length));
        }
        return text;
    };
};