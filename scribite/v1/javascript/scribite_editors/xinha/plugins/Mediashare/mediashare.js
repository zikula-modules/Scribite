// mediashare plugin for Xinha
// developed by sven schomacker (hilope)
//
// uses some code from pagesetter/Guppy by Jorn Lind-Nielsen (http://www.elfisk.dk)
// requires mediashare module, see url above, licensed under GPL
// imagefile taken from pagesetter/Guppy
//
// Distributed under the same terms as xinha itself.
// This notice MUST stay intact for use (see license.txt).

function Mediashare(editor) {
	this.editor = editor;
	var cfg = editor.config;
	var self = this;
	cfg.registerButton({
		id       : "Mediashare",
		tooltip  : "insert mediashare image",
		image    : _editor_url+"plugins/Mediashare/img/ed_mediashare.gif",
		textMode : false,
		action   : function(editor) {
			url = "index.php?module=mediashare&type=external&func=finditem&url=relative&mode=html";
			mediashareFindItemHtmlArea30(editor, url);
		}
	})
	cfg.addToolbarElement("Mediashare", "insertimage", 1);
}
Mediashare._pluginInfo = {
	name          : "Mediashare for xinha",
	version       : "1.2",
	developer     : "sven schomacker",
	developer_url : "http://www.schomedia.com/",
	sponsor       : "hilope.de",
	sponsor_url   : "http://www.hilope.de/",
	license       : "htmlArea"
};

