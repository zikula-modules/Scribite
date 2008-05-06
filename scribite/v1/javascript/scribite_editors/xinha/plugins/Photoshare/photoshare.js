// photoshare plugin for Xinha
// developed by sven schomacker (hilope)
//
// uses some code from pagesetter/Guppy by Jorn Lind-Nielsen (http://www.elfisk.dk)
// requires photoshare module, see url above, licensed under GPL
// imagefile taken from pagesetter/Guppy
//
// Distributed under the same terms as xinha itself.
// This notice MUST stay intact for use (see license.txt).

function Photoshare(editor) {
	this.editor = editor;
	var cfg = editor.config;
	var self = this;
	cfg.registerButton({
		id       : "Photoshare",
		tooltip  : "insert photoshare image",
		image    : _editor_url+"plugins/Photoshare/img/ed_photoshare.gif",
		textMode : false,
		action   : function(editor) {
			url = "index.php?module=photoshare&func=findimage&url=relative&html=img&targetID=" + editor;
			photoshareFindImageHtmlArea30(editor, url, photoshareThumbnailSize);
		}
	})
	cfg.addToolbarElement("Photoshare", "insertimage", 1);
}
Photoshare._pluginInfo = {
	name          : "Photoshare for xinha",
	version       : "1.2",
	developer     : "sven schomacker",
	developer_url : "http://www.schomedia.com/",
	sponsor       : "hilope.de",
	sponsor_url   : "http://www.hilope.de/",
	license       : "htmlArea"
};

