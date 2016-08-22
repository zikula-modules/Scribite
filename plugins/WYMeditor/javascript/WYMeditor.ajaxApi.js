/**
 * initialise additional plugins
 * @param {object} wym
 * @returns {void}
 */
var initPlugins = function(wym)
{
    for (var i = 0; i < activePlugins.length; i++) {
        var pluginName = activePlugins[i];
        if (pluginName == 'embed') {
            // nothing to do
            continue;
        } else if (pluginName == 'fullscreen') {
            wym.fullscreen();
        } else if (pluginName == 'hovertools') {
            wym.hovertools();
        } else if (pluginName == 'list') {
            var listPlugin = new ListPlugin({}, wym);
        } else if (pluginName == 'rdfa') {
            wym.rdfa();
        } else if (pluginName == 'resizable') {
            wym.resizable();
        } else if (pluginName == 'structured_headings') {
            wym.structuredHeadings({});
        } else if (pluginName == 'table') {
            wym.table({});
        } else if (pluginName == 'tidy') {
            var wymtidy = wym.tidy();
            wymtidy.init(wym);
        }
    }
}

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
 * @param {object} iParams collection of editor params
 * @returns {ScribiteUtil}
 */
var ScribiteUtil = function(iParams)
{
    /**
     * Collection of editor instances by domId
     * @type Object
     */
    //this.editorCollection = {};

    /**
     * Collection of editor params
     * @type Object
     */
    //this.params = iParams;

    /**
     * Render the html to the original element from the editor
     * @param {string} domId
     * @returns {null}
     */
    this.renderToElement = function(domId)
    {
        jQuery.wymeditors(domId).update();
    };

    /**
     * Render the html to all the elements that have editors
     * @returns {undefined}
     */
    this.renderAllElements = function()
    {
        //console.log(this.editorCollection);
        wymeditors = jQuery.wymeditors;
        for (var i = 0; i < wymeditors.length; i++) {
            wymeditors(i).update();
            //wymeditors(i).setContent('');
        }
    };

    /**
     * create all the editors for the appropriate textareas
     * @returns {undefined}
     */
    this.createEditors = function()
    {
        jQuery(function() {
            jQuery('textarea').each(function(index) {
                var area = jQuery(this);
                var areaId = area.attr('id');
                // ensure textarea not in disabled list or has 'noeditor' class
                if ((jQuery.inArray(areaId, disabledTextareas) == -1) && !jQuery('#' + areaId).hasClass('noeditor')) {
                    // attach the editor
                    var lang = navigator.language || navigator.userLanguage;
                    jQuery('#' + areaId).wymeditor({
                        lang: lang,
                        skin: selectedSkin,
                        updateEvent: 'click',
                        updateSelector: '[type=submit]',
                        postInit: initPlugins
                    });
                    // notify subscriber
                    insertNotifyInput(areaId);
                }
            });
        });
    };

    /**
     * create an editor for one textarea
     * @param {string} domId
     * @returns {undefined}
     */
    this.createEditor = function(domId)
    {
        var lang = navigator.language || navigator.userLanguage;

        jQuery('#' + domId).wymeditor({
            lang: lang,
            skin: selectedSkin,
            updateEvent: 'click',
            updateSelector: '[type=submit]',
            postInit: initPlugins
        });
    };

    /**
     * destroy the editor for one textarea
     * @param {string} domId
     * @returns {null|undefined}
     */
    this.destroyEditor = function(domId)
    {
        /*if (typeof this.editorCollection[domId] === 'undefined') {
            return;
        }
        this.editorCollection[domId].destroy();
        this.editorCollection[domId] = null;
        */
        if (typeof(jQuery('#' + domId)._wym) !== 'undefined') {
            jQuery('#' + domId)._wym = null;
        }
    };

    /**
     * Retrieve the contents of the edited textarea
     * @param {string} domId
     * @returns {string}
     */
    this.getEditorContents = function(domId)
    {
        return jQuery('#' + domId).html();
    };
};
