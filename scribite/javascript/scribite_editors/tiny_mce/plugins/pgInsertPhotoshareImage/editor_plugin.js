/**
 * $Id$
 *
 * @author Moxiecode
 * @copyright Copyright © 2004-2007, Moxiecode Systems AB, All rights reserved.
 */

/* Import plugin specific language pack */
tinyMCE.importPluginLanguagePack('pgInsertPhotoshareImage');

var TinyMCE_pgInsertPhotoshareImagePlugin = {
	getInfo : function() {
		return {
			longname	: 'Pagesetter insert photoshare link',
			author		: 'Bert Roefs',
			authorurl	: 'http://www.dits-sa.com',
			infourl		: 'http://www.dits-sa.com/..',
			version		: '1.1'
		};
	},

	initInstance : function(inst) {
//		inst.addShortcut('ctrl', 'k', 'lang_pgInsertPhotoshareImage_desc', 'mcepgInsertPhotoshareImage');
	},

	getControlHTML : function(cn) {
		switch (cn) {
			case "pgInsertPhotoshareImage":
				return tinyMCE.getButtonHTML(cn, 'lang_pgInsertPhotoshareImage_desc', '{$pluginurl}/images/pgInsertPhotoshareImage.gif', 'mcepgInsertPhotoshareImage');
		}

		return "";
	},

	execCommand : function(editor_id, element, command, user_interface, value) {
		switch (command) {
			case "mcepgInsertPhotoshareImage":
				// Show UI/Popup
//				if (user_interface) {
					// Open a popup window and send in some custom data in a window argument
					tinyMCE.openWindow({
						file : '../../plugins/pgInsertPhotoshareImage/popup.php',
						width : 480,
						height : 200
					}, {
						editor_id : editor_id,
						inline : "yes",
						initialFolderID : 6
					});

					// Let TinyMCE know that something was modified
					tinyMCE.triggerNodeChange(false);
//				}

				return true;
		}

		return false;
	},

	handleNodeChange : function(editor_id, node, undo_index, undo_levels, visual_aid, any_selection) {
		if (node == null)
			return;

		if (any_selection) {
			tinyMCE.switchClass(editor_id + '_pgInsertPhotoshareImage', 'mceButtonDisabled');
		}
		else {
			tinyMCE.switchClass(editor_id + '_pgInsertPhotoshareImage', 'mceButtonNormal');
		}

		return true;
	}
};

tinyMCE.addPlugin("pgInsertPhotoshareImage", TinyMCE_pgInsertPhotoshareImagePlugin);
