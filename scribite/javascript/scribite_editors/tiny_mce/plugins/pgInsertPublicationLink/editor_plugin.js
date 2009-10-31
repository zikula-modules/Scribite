/**
 * $Id$
 *
 * @author Moxiecode
 * @copyright Copyright © 2004-2007, Moxiecode Systems AB, All rights reserved.
 */

/* Import plugin specific language pack */
tinyMCE.importPluginLanguagePack('pgInsertPublicationLink');

var TinyMCE_pgInsertPublicationLinkPlugin = {
	getInfo : function() {
		return {
			longname	: 'Pagesetter insert publication link',
			author		: 'Bert Roefs',
			authorurl	: 'http://www.dits-sa.com',
			infourl		: 'http://www.dits-sa.com/..',
			version		: '1.1'
		};
	},

	initInstance : function(inst) {
//		inst.addShortcut('ctrl', 'k', 'lang_pgInsertPublicationLink_desc', 'mcepgInsertPublicationLink');
	},

	getControlHTML : function(cn) {
		switch (cn) {
			case "pgInsertPublicationLink":
				return tinyMCE.getButtonHTML(cn, 'lang_pgInsertPublicationLink_desc', '{$pluginurl}/images/pgInsertPublicationLink.gif', 'mcepgInsertPublicationLink');
		}

		return "";
	},

	execCommand : function(editor_id, element, command, user_interface, value) {
		switch (command) {
			case "mcepgInsertPublicationLink":
				var inst = tinyMCE.getInstanceById(editor_id), anySelection = !inst.selection.isCollapsed();
				var focusElm = inst.getFocusElement(), selectedText = inst.selection.getSelectedText();

				if (anySelection || (focusElm != null && focusElm.nodeName == "A")) {
					tinyMCE.openWindow({
						file : '../../plugins/pgInsertPublicationLink/popup.php',
						width : 640,
						height : 300
					}, {
						editor_id : editor_id,
						inline : "yes"
					});
				}

				return true;
		}

		return false;
	},

	handleNodeChange : function(editor_id, node, undo_index, undo_levels, visual_aid, any_selection) {
		if (node == null)
			return;

		do {
			if (node.nodeName == "A" && tinyMCE.getAttrib(node, 'href') != "") {
				tinyMCE.switchClass(editor_id + '_pgInsertPublicationLink', 'mceButtonDisabled');
				return true;
			}
		} while ((node = node.parentNode));

		if (any_selection) {
			tinyMCE.switchClass(editor_id + '_pgInsertPublicationLink', 'mceButtonNormal');
			return true;
		}

		tinyMCE.switchClass(editor_id + '_pgInsertPublicationLink', 'mceButtonDisabled');

		return true;
	}
};

tinyMCE.addPlugin("pgInsertPublicationLink", TinyMCE_pgInsertPublicationLinkPlugin);
