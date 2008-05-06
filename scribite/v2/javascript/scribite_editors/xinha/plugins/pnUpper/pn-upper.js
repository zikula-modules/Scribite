// pnUpper plugin for Xinha
// developed by Axel Guckelsberger (Guite)
//
// requires pnUpper module (http://guite.de), licensed under GPL
// imagefile taken from pagesetter/Guppy
//
// Distributed under the same terms as xinha itself.
// This notice MUST stay intact for use (see license.txt).

function pnUpper(editor) {
    this.editor = editor;
    var cfg = editor.config;
    var self = this;

    cfg.registerButton({
        id       : "pnUpper",
        tooltip  : "insert pnUpper file",
        image    : _editor_url+"plugins/pnUpper/img/ed_pnUpper.gif",
        textMode : false,
        action   : function(editor) {
            url = document.location.pnbaseURL + document.location.entrypoint + "?module=pnUpper&type=external&func=finditem";
            pnUpperFindItemXinha(editor, url);
        }
    })
    cfg.addToolbarElement("pnUpper", "insertimage", 1);
}
pnUpper._pluginInfo = {
    name          : "pnUpper for xinha",
    version       : "1.1",
    developer     : "Axel Guckelsberger",
    developer_url : "http://guite.de/",
    sponsor       : "Guite",
    sponsor_url   : "http://guite.de/",
    license       : "htmlArea"
};

