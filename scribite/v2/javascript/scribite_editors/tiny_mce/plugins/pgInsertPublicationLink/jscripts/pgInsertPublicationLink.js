function insertPublicationLink(theform, allpublications) {
	var editor_id = tinyMCE.getWindowArg('editor_id');
	var inst = tinyMCE.getInstanceById(editor_id);

	var selectedpubtypes = getSelectedSelect(theform.thepubtypes);
	var pubtype = selectedpubtypes['0'].value;

	var selectedpublications = getSelectedSelect(theform.thepublications);
	var thelink = '';

	if (selectedpublications.length != 0) {
		var thepublication = selectedpublications['0'].value;

		for (var i = 0; i < allpublications.length; i++) {
			if (allpublications[i][0] == pubtype && allpublications[i][1] == thepublication) {
				therelativelink = 'index.php?module=pagesetter&func=viewpub&tid=' + allpublications[i][0] + '&pid=' + allpublications[i][1];
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, '<a href="'+therelativelink+'" target="_self">'+inst.selection.getSelectedHTML()+'</a>');

				break;
			}
		}
	}

	tinyMCEPopup.close();
}


function insertLinkInSource(therelativelink) {
	var inst = tinyMCE.getInstanceById(tinyMCE.getWindowArg('editor_id'));
	var elm = inst.getFocusElement();

	elm = tinyMCE.getParentElement(elm, "a");

	// Create new anchor elements
	if (elm == null) {
		if (tinyMCE.isSafari)
			tinyMCEPopup.execCommand("mceInsertContent", false, '<a href="#mce_temp_url#">' + inst.getSelectedHTML() + '</a>');
		else
			tinyMCEPopup.execCommand("createlink", false, "#mce_temp_url#");

		var elementArray = tinyMCE.getElementsByAttributeValue(inst.getBody(), "a", "href", "#mce_temp_url#");
		for (var i=0; i<elementArray.length; i++) {
			var elm = elementArray[i];

			// Move cursor behind the new anchor
			if (tinyMCE.isGecko) {
				var sp = inst.getDoc().createTextNode(" ");

				if (elm.nextSibling)
					elm.parentNode.insertBefore(sp, elm.nextSibling);
				else
					elm.parentNode.appendChild(sp);

				// Set range after link
				var rng = inst.getDoc().createRange();
				rng.setStartAfter(elm);
				rng.setEndAfter(elm);

				// Update selection
				var sel = inst.getSel();
				sel.removeAllRanges();
				sel.addRange(rng);
			}

			setAllAttribs(elm, therelativelink);
		}
	} else
		setAllAttribs(elm, therelativelink);

	tinyMCEPopup.close();
}


function publication_change(theform, allpublications)
{
	var selectedpubtypes = getSelectedSelect(theform.thepubtypes);
	var pubtype = selectedpubtypes['0'].value;

	var selectedpublications = getSelectedSelect(theform.thepublications);
	
	if (selectedpublications.length == 0) {
		theform.title.value = '';
		theform.author.value = '';
		theform.createdate.value = '';
		theform.revision.value = '';
	}
	else {
		var thepublication = selectedpublications['0'].value;

		for (var i = 0; i < allpublications.length; i++) {
			if (allpublications[i][0] == pubtype && allpublications[i][1] == thepublication) {
				theform.title.value = allpublications[i][2];
				theform.author.value = allpublications[i][3];
				theform.createdate.value = allpublications[i][4];
				theform.revision.value = allpublications[i][5];
				break;
			}
		}
	}
}


function pubtypes_change(theform, allpubtypes, allpublications)
{
	var selectedpubtypes = getSelectedSelect(theform.thepubtypes);
	var pubtype = selectedpubtypes['0'].value;

	removeSelectedOptions(theform.thepublications);

	for (var i = 0; i < allpublications.length; i++) {
		if (allpublications[i]['0'] == pubtype) {
			var id = allpublications[i][1];
			var title = allpublications[i][2];
			if (title.length > 80)	title = title.substr(0, 77) + '...';
			theform.thepublications.options[theform.thepublications.options.length] = new Option(title, id);
		}
	}
	
	publication_change(theform, allpublications);
}


function removeSelectedOptions(theSelect)
{
	for (; theSelect.options.length > 0;) {
		theSelect.options[0] = null;
	}
}


function getSelectOptions(theSelect)
{
	var results = new Array();
	var options = theSelect.options;

	for (var i = 0, j = 0; i < options.length; i++) {
		results[j++] = options[i];
	}

	return results;
}


function getSelectedSelect(theSelect)
{
	var results = new Array();
	var options = theSelect.options;

	for (var i = 0, j = 0; i < options.length; i++) {
		if (options[i].selected == true) {
			results[j++] = options[i];
		}
	}

	return results;
}


function in_array(needle, haystack) {
	for (var i = 0; i < haystack.length; i++) {
		if (haystack[i] == needle) {
			return true;
		}
	}
    return false;
}
