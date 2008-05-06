function insertPhotoshareImage() {
	var imageIdElement = document.getElementById("imageId");
	var image_id = imageIdElement.value;

	var imageSelectorElement = document.getElementById("imageSelector");
	var image_title = imageSelectorElement.options[imageSelectorElement.selectedIndex].text;

	var htmlFormat = document.getElementById("htmlFormat");
	var image_format = htmlFormat.value;

	var thelink = '';

	switch (image_format) {
		case 'fullImage':
			thelink = '<img src="index.php?module=photoshare&type=show&func=viewimage&iid=' + image_id  + '">'
			break;
		case 'thumbnail':
			thelink = '<img src="index.php?module=photoshare&type=show&func=viewimage&iid=' + image_id + '&thumbnail=1">'
			formatLink = '&thumbnail=1';
			break;
		case 'thumbnailPopup':
			thelink = '<a href="javascript:{ var imageWindow = window.open(\'index.php?module=photoshare&type=show&func=viewimage&iid=' + image_id  + '\', \'image\', \'toolbar=0,location=0,directories=0,menuBar=0,scrollbars=0,resizable=1\'); imageWindow.focus(); }"><img src="index.php?module=photoshare&type=show&func=viewimage&iid=' + image_id  + '&thumbnail=1"></a>';
			break;
		case 'fullImageURL':
			thelink = '<a href=\"index.php?module=photoshare&type=show&func=viewimage&iid=' + image_id  + '\">' + image_title + '</a>';
			break;
		case 'fullImageURLPopup':
			thelink = '<a href="javascript:{ var imageWindow = window.open(\'index.php?module=photoshare&type=show&func=viewimage&iid=' + image_id  + '\', \'image\', \'toolbar=0,location=0,directories=0,menuBar=0,scrollbars=0,resizable=1\'); imageWindow.focus(); }">' + image_title + '</a>';
			break;
	}
	
	tinyMCE.execCommand('mceInsertContent', false, thelink);

	tinyMCEPopup.close();
}


//=============================================================================
// Stand alone image selector for Photoshare
// (C) Jorn Lind-Nielsen
//=============================================================================

  // htmlArea 3.0 editor for access in selector window
var currentPhotoshareEditor = null;


// OnLoad handler ensures an initial image is selected
function handleOnLoad()
{
	var initialFolderID = tinyMCE.getWindowArg('initialFolderID');
	if (!initialFolderID)	initialFolderID = 0;

	selectFolder(initialFolderID);

	// Move focus initially to folder selector
	var folderSelect = document.getElementById("folderSelect");
	folderSelect.focus();
}


// A new folder is selected (user changed value of folder selector)
function handleFolderSelect(folderSelect)
{
	var folderID = folderSelect.value;
	selectFolder(folderID);
}


// Do actual folder selction
function selectFolder(folderID)
{
	// select folder if not selected yet
	var folderSelect = document.getElementById("folderSelect");
	var selectedFolder = folderSelect.selectedIndex;
	if (!selectedFolder) {
		for (var i = 0; i < folderSelect.options.length; i++) {
			if (folderSelect.options[i].value == folderID) {
				folderSelect.options[i].selected = true;
				break;
			}
		}
	}

	// Get set of images in the selected folder
	var imageSet = imageInfo[folderID];

	// Resize image selector for new number of options (images)
	var imageSelect = document.getElementById("imageSelector");
	imageSelect.options.length = imageSet.length;
 
	// Iterate through alle images and create new selector options for each of them
	for (var i in imageSet) {
		imageSelect.options[i].value = imageSet[i].id;
		imageSelect.options[i].text = imageSet[i].title;
	}

	// Select the first image
	selectImage(imageSet[0].id);
}


// User changed value of image selector
function handleImageSelect(imgSelect)
{
	var imageID = imgSelect.value;
	selectImage(imageID);
}


// Do actual updates related to changing of image
function selectImage(imageID)
{
	// Update image with new source address
	var imageElement = document.getElementById("previewImage");
	imageElement.src = thumbnailBaseURL + imageID;

	var imageIdElement = document.getElementById("imageId");
	imageIdElement.value = imageID;
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
