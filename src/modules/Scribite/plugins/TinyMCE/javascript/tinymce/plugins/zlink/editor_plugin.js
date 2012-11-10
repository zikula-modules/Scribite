/**
 * editor_plugin_src.js
 *
 * Copyright 2009, Moxiecode Systems AB
 * Released under LGPL License.
 *
 * License: http://tinymce.moxiecode.com/license
 * Contributing: http://tinymce.moxiecode.com/contributing
 */

(function() {
	// Load plugin specific language pack
	tinymce.PluginManager.requireLangPack('zlink');

    jQuery( "#dialog-form" ).dialog({
        autoOpen: false,
        height: 220,
        width: 350,
        modal: true,
        buttons: {
            "Add link": function() {
                tinymce.activeEditor.execCommand('mceInsertLink', false, {'href': jQuery("#scribite-url").val(), 'title': jQuery("#scribite-title").val() }); /* 'target': '_blank'*/
                jQuery( this ).dialog( "close" );
            },
            Cancel: function() {
                jQuery( this ).dialog( "close" );
            }
        },
        close: function() {
        }
    });


	tinymce.create('tinymce.plugins.zLinkPlugin', {


		/**
		 * Initializes the plugin, this will be executed after the plugin has been created.
		 * This call is done before the editor instance has finished it's initialization so use the onInit event
		 * of the editor instance to intercept that event.
		 *
		 * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
		 * @param {string} url Absolute URL to where the plugin is located.
		 */
		init : function(ed, url) {
			// Register the command so that it can be invoked by using tinyMCE.activeEditor.execCommand('mceExample');
			ed.addCommand('mcezLink', function() {
                var inst = tinymce.activeEditor;
                var elm = inst.selection.getNode();
                var action = "insert";

                elm = inst.dom.getParent(elm, "A");
                if (elm == null) {
                    var prospect = inst.dom.create("p", null, inst.selection.getContent());
                    if (prospect.childNodes.length === 1) {
                        elm = prospect.firstChild;
                    }
                }

                if (elm != null && elm.nodeName == "A")
                    action = "update";

                if (action == "update") {
                    document.getElementById("scribite-url").value   = inst.dom.getAttrib(elm, 'href');
                    document.getElementById("scribite-title").value = inst.dom.getAttrib(elm, 'title');
                } else {
                    document.getElementById("scribite-url").value   = 'http://';
                    document.getElementById("scribite-title").value = '';
                }

                jQuery('#example_wrapper').hide();
                jQuery('#example_wrapper').css("margin-top", "25px");
                jQuery("#dialog-form").dialog("open");
			});

			// Register example button
			ed.addButton('link', {
				title : 'zlink.desc',
				cmd : 'mcezLink'
			});

			// Add a node change handler, selects the button in the UI when a image is selected
			ed.onNodeChange.add(function(ed, cm, n, co) {
                cm.setDisabled('link', co && n.nodeName != 'A');
				cm.setActive('link', n.nodeName == 'A' && !n.name);
			});
		},

		/**
		 * Creates control instances based in the incomming name. This method is normally not
		 * needed since the addButton method of the tinymce.Editor class is a more easy way of adding buttons
		 * but you sometimes need to create more complex controls like listboxes, split buttons etc then this
		 * method can be used to create those.
		 *
		 * @param {String} n Name of the control to create.
		 * @param {tinymce.ControlManager} cm Control manager to use inorder to create new control.
		 * @return {tinymce.ui.Control} New control instance or null if no control was created.
		 */
		createControl : function(n, cm) {
			return null;
		},

		/**
		 * Returns information about the plugin as a name/value array.
		 * The current keys are longname, author, authorurl, infourl and version.
		 *
		 * @return {Object} Name/value array containing information about the plugin.
		 */
		getInfo : function() {
			return {
				longname : 'zLink plugin',
				author : 'Zikula',
				authorurl : 'http://www.zikula.org',
				infourl : 'http://www.zikula.org',
				version : "1.0"
			};
		}
	});

	// Register plugin
	tinymce.PluginManager.add('zlink', tinymce.plugins.zLinkPlugin);
})();